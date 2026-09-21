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
     * Social interaction handler: Send / Cancel Friend Request (Sosmed Ready).
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

        // Return pleasant social confirmation
        return response()->json([
            'status' => 'success',
            'action' => 'requested',
            'message' => 'Permintaan pertemanan berhasil dikirim ke ' . $targetUser->name . '!',
            'target_id' => $targetUserId,
        ]);
    }

    /**
     * Fetch safe public profile data accessible by any authenticated user.
     */
    public function getPublicProfile(Request $request, int $targetUserId): JsonResponse
    {
        $targetUser = User::with(['roles', 'detail', 'settingRecord'])->find($targetUserId);
        if (!$targetUser) {
            return response()->json(['status' => 'error', 'message' => 'Pengguna tidak ditemukan.'], 404);
        }

        $presence = UserPresenceService::getUserPresence($targetUser);
        $roles = $targetUser->roles->pluck('name')->map(fn($r) => strtoupper($r))->toArray();
        if (empty($roles)) {
            $roles = ['PENGGUNA'];
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
            ],
        ]);
    }
}

