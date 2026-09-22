<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\UserManagement\User;
use App\Services\UserManagement\UserPresenceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPresenceController extends Controller
{
    /**
     * Heartbeat endpoint for active user presence & idle tracking.
     */
    public function heartbeat(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        $status = $request->input('status', 'online');
        $presence = UserPresenceService::recordHeartbeat($user, $status);

        return response()->json([
            'status' => 'success',
            'data' => $presence,
        ]);
    }

    /**
     * Mark current user as offline (e.g. before unload / tab close / logout).
     */
    public function setOffline(Request $request): JsonResponse
    {
        $user = $request->user();
        if ($user) {
            UserPresenceService::setUserOffline($user);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Fetch user presence list for Dashboard Widget (JSON / Partial HTML).
     */
    public function getDashboardWidget(Request $request): JsonResponse
    {
        $user = $request->user();
        $filterStatus = $request->input('status', 'all');
        $limit = (int) $request->input('limit', 10);
        if ($limit <= 0 || $limit > 50) {
            $limit = 10;
        }

        $result = UserPresenceService::getDashboardUsersPresence($user, $limit, $filterStatus);

        // Render HTML items partial for direct zero-reload injection
        $htmlItems = view('pages.dashboard.partials.widget-user-presence-items', [
            'presenceUsers' => $result['users'],
        ])->render();

        return response()->json([
            'status' => 'success',
            'stats' => $result['stats'],
            'count' => count($result['users']),
            'html' => $htmlItems,
            'users' => $result['users'],
            'timestamp' => $result['timestamp'],
        ]);
    }

    /**
     * Social interaction handler: Send / Accept / Cancel Friend Request.
     */
    public function toggleFriendRequest(Request $request, int $targetUserId): JsonResponse
    {
        $currentUser = $request->user();
        if (!$currentUser || $currentUser->id === $targetUserId) {
            return response()->json(['status' => 'error', 'message' => 'Aksi tidak valid.'], 422);
        }

        $targetUser = User::find($targetUserId);
        if (!$targetUser) {
            return response()->json(['status' => 'error', 'message' => 'Pengguna tidak ditemukan.'], 404);
        }

        // Check existing friendship
        $friendship = \App\Models\UserManagement\UserFriendship::betweenUsers($currentUser->id, $targetUserId)->first();

        if (!$friendship) {
            // Send new friend request
            $friendship = \App\Models\UserManagement\UserFriendship::create([
                'user_id' => $currentUser->id,
                'friend_id' => $targetUserId,
                'status' => 'pending',
            ]);

            // Dispatch notification to receiver
            \App\Services\AppSupport\AppNotificationService::send([
                'user_id' => $targetUserId,
                'category' => 'friendship',
                'type' => 'friend_request',
                'title' => 'Ajakan Pertemanan Baru',
                'message' => "{$currentUser->name} ingin berteman dengan Anda.",
                'icon' => 'ki-user-tick',
                'color' => 'primary',
                'data' => [
                    'friendship_id' => $friendship->id,
                    'sender_id' => $currentUser->id,
                    'sender_name' => $currentUser->name,
                    'sender_avatar' => $currentUser->avatar_url,
                ],
                'action_state' => 'pending',
            ]);

            return response()->json([
                'status' => 'success',
                'action' => 'requested',
                'friendship_status' => 'pending_sent',
                'message' => 'Permintaan pertemanan berhasil dikirim ke ' . $targetUser->name . '!',
                'target_id' => $targetUserId,
            ]);
        }

        if ($friendship->status === 'pending') {
            if ($friendship->user_id === $currentUser->id) {
                // Cancel sent request
                $friendship->delete();

                return response()->json([
                    'status' => 'success',
                    'action' => 'cancelled',
                    'friendship_status' => 'none',
                    'message' => 'Permintaan pertemanan telah dibatalkan.',
                    'target_id' => $targetUserId,
                ]);
            } else {
                // Accept incoming request
                $friendship->update(['status' => 'accepted']);

                // Notify sender that request was accepted
                \App\Services\AppSupport\AppNotificationService::send([
                    'user_id' => $friendship->user_id,
                    'category' => 'friendship',
                    'type' => 'friend_accepted',
                    'title' => 'Permintaan Pertemanan Diterima',
                    'message' => "{$currentUser->name} telah menerima permintaan pertemanan Anda.",
                    'icon' => 'ki-user-tick',
                    'color' => 'success',
                    'data' => [
                        'friend_id' => $currentUser->id,
                        'friend_name' => $currentUser->name,
                    ],
                    'action_state' => 'accepted',
                ]);

                return response()->json([
                    'status' => 'success',
                    'action' => 'accepted',
                    'friendship_status' => 'accepted',
                    'message' => 'Sekarang Anda telah berteman dengan ' . $targetUser->name . '!',
                    'target_id' => $targetUserId,
                ]);
            }
        }

        if ($friendship->status === 'accepted') {
            // Already friends
            return response()->json([
                'status' => 'success',
                'action' => 'already_friends',
                'friendship_status' => 'accepted',
                'message' => 'Anda sudah berteman dengan ' . $targetUser->name . '.',
                'target_id' => $targetUserId,
            ]);
        }

        // If previously declined, re-send request
        $friendship->update([
            'user_id' => $currentUser->id,
            'friend_id' => $targetUserId,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => 'success',
            'action' => 'requested',
            'friendship_status' => 'pending_sent',
            'message' => 'Permintaan pertemanan berhasil dikirim ke ' . $targetUser->name . '!',
            'target_id' => $targetUserId,
        ]);
    }

    /**
     * Fetch safe public profile data accessible by any authenticated user.
     */
    public function getPublicProfile(Request $request, int $targetUserId): JsonResponse
    {
        $currentUser = $request->user();
        $targetUser = User::with(['roles', 'detail', 'settingRecord'])->find($targetUserId);
        if (!$targetUser) {
            return response()->json(['status' => 'error', 'message' => 'Pengguna tidak ditemukan.'], 404);
        }

        $presence = UserPresenceService::getUserPresence($targetUser);
        $roles = $targetUser->roles->pluck('name')->map(fn($r) => strtoupper($r))->toArray();
        if (empty($roles)) {
            $roles = ['PENGGUNA'];
        }

        // Resolve friendship status
        $friendshipStatus = 'none';
        $friendshipId = null;
        if ($currentUser && $currentUser->id !== $targetUserId) {
            $f = \App\Models\UserManagement\UserFriendship::betweenUsers($currentUser->id, $targetUserId)->first();
            if ($f) {
                $friendshipId = $f->id;
                if ($f->status === 'accepted') {
                    $friendshipStatus = 'accepted';
                } elseif ($f->status === 'pending') {
                    $friendshipStatus = ($f->user_id === $currentUser->id) ? 'pending_sent' : 'pending_received';
                } else {
                    $friendshipStatus = 'declined';
                }
            }
        }

        $coverBgUrl = $targetUser->cover_bg_url ?: asset('assets/img-temp/1200x800/img1.jpg');
        $coverOpacity = (int) ($targetUser->setting('cover_opacity', '60') ?? '60');
        $coverOverlayColor = $targetUser->setting('cover_overlay_color', '#000000') ?? '#000000';
        $coverPositionY = (int) ($targetUser->setting('cover_position_y', '30') ?? '30');
        $coverBlur = (int) ($targetUser->setting('cover_blur', '0') ?? '0');

        $motoHidup = $targetUser->detail?->moto_hidup ?: 'Belum ada moto hidup / status yang dibagikan.';

        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $targetUser->id,
                'name' => $targetUser->name,
                'email' => $targetUser->email,
                'avatar_url' => $targetUser->avatar_url,
                'avatar_style' => $targetUser->avatar_style,
                'has_avatar' => !empty($targetUser->avatar),
                'initial' => $targetUser->initial,
                'cover_bg_url' => $coverBgUrl,
                'cover_opacity' => $coverOpacity / 100,
                'cover_overlay_color' => $coverOverlayColor,
                'cover_position_y' => $coverPositionY,
                'cover_blur' => $coverBlur,
                'roles' => $roles,
                'moto_hidup' => $motoHidup,
                'points' => (int) ($targetUser->points ?? 0),
                'joined_at' => $targetUser->created_at ? $targetUser->created_at->translatedFormat('d F Y') : '-',
                'presence' => $presence,
                'friendship_status' => $friendshipStatus,
                'friendship_id' => $friendshipId,
                'is_friend' => ($friendshipStatus === 'accepted'),
            ],
        ]);
    }
}

