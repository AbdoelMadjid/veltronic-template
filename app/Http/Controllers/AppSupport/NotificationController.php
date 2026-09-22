<?php

namespace App\Http\Controllers\AppSupport;

use App\Http\Controllers\Controller;
use App\Models\AppSupport\AppNotification;
use App\Models\UserManagement\User;
use App\Models\UserManagement\UserFriendship;
use App\Services\AppSupport\AppNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Get live notification feed (JSON & Unread Counts).
     */
    public function feed(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        $feed = AppNotificationService::getNotificationFeed($user, 20);

        return response()->json([
            'status' => 'success',
            'unread_total' => $feed['unread_total'],
            'stats' => $feed['stats'],
            'items' => $feed['items'],
        ]);
    }

    /**
     * Mark all user notifications as read.
     */
    public function markAllAsRead(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        $count = AppNotificationService::markAllRead($user);

        return response()->json([
            'status' => 'success',
            'marked_count' => $count,
            'message' => 'Semua notifikasi telah ditandai sudah dibaca.',
        ]);
    }

    /**
     * Mark single notification as read.
     */
    public function markAsRead(Request $request, int $id): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        $success = AppNotificationService::markAsRead($id, $user);

        return response()->json([
            'status' => $success ? 'success' : 'not_found',
            'id' => $id,
        ]);
    }

    /**
     * Handle quick inline actions from notifications (e.g. Accept/Decline friendship).
     */
    public function handleAction(Request $request, int $id): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        $notif = AppNotification::forUser($user)->find($id);
        if (!$notif) {
            return response()->json(['status' => 'error', 'message' => 'Notifikasi tidak ditemukan.'], 404);
        }

        $action = $request->input('action'); // 'accept' | 'decline' | 'dismiss'
        $data = $notif->data ?? [];

        // Handle Friendship Action
        if ($notif->category === 'friendship') {
            $senderId = $data['sender_id'] ?? null;
            $friendshipId = $data['friendship_id'] ?? null;

            $friendship = $friendshipId
                ? UserFriendship::find($friendshipId)
                : ($senderId ? UserFriendship::where('user_id', $senderId)->where('friend_id', $user->id)->first() : null);

            if ($action === 'accept') {
                if ($friendship) {
                    $friendship->update(['status' => 'accepted']);
                } else if ($senderId) {
                    UserFriendship::create([
                        'user_id' => $senderId,
                        'friend_id' => $user->id,
                        'status' => 'accepted',
                    ]);
                }

                $notif->update([
                    'action_state' => 'accepted',
                    'is_read' => true,
                    'read_at' => now(),
                ]);

                // Send pleasant response notification to the original sender
                if ($senderId) {
                    AppNotificationService::send([
                        'user_id' => $senderId,
                        'category' => 'friendship',
                        'type' => 'friend_accepted',
                        'title' => 'Permintaan Pertemanan Diterima',
                        'message' => "{$user->name} telah menerima permintaan pertemanan Anda.",
                        'icon' => 'ki-user-tick',
                        'color' => 'success',
                        'data' => ['friend_id' => $user->id, 'friend_name' => $user->name],
                        'action_state' => 'accepted',
                    ]);
                }

                return response()->json([
                    'status' => 'success',
                    'action_state' => 'accepted',
                    'message' => 'Permintaan pertemanan berhasil diterima!',
                ]);
            } elseif ($action === 'decline') {
                if ($friendship) {
                    $friendship->update(['status' => 'declined']);
                }

                $notif->update([
                    'action_state' => 'declined',
                    'is_read' => true,
                    'read_at' => now(),
                ]);

                return response()->json([
                    'status' => 'success',
                    'action_state' => 'declined',
                    'message' => 'Permintaan pertemanan ditolak.',
                ]);
            }
        }

        // Generic dismiss / read
        $notif->markAsRead();

        return response()->json([
            'status' => 'success',
            'action_state' => 'read',
            'message' => 'Notifikasi telah diproses.',
        ]);
    }
}
