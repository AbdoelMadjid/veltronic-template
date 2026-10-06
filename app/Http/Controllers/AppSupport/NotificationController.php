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
        $stats = AppNotificationService::getUnreadStats($user);

        return response()->json([
            'status' => $success ? 'success' : 'not_found',
            'id' => $id,
            'stats' => $stats,
            'unread_total' => $stats['total'],
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

                $stats = AppNotificationService::getUnreadStats($user);

                return response()->json([
                    'status' => 'success',
                    'action_state' => 'accepted',
                    'message' => 'Permintaan pertemanan berhasil diterima!',
                    'stats' => $stats,
                    'unread_total' => $stats['total'],
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

                $stats = AppNotificationService::getUnreadStats($user);

                return response()->json([
                    'status' => 'success',
                    'action_state' => 'declined',
                    'message' => 'Permintaan pertemanan ditolak.',
                    'stats' => $stats,
                    'unread_total' => $stats['total'],
                ]);
            }
        }

        // Handle Account Deletion Request Action (Master / Admin only)
        if ($notif->type === 'account_deletion_request' || ($notif->category === 'security' && isset($data['request_user_id']))) {
            if (!$user->isMasterOrAdmin()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda tidak memiliki hak akses untuk memproses permintaan keluar akun.',
                ], 403);
            }

            $targetUserId = $data['request_user_id'] ?? null;
            $requestId = $data['request_id'] ?? null;

            $deletionRequest = $requestId
                ? \App\Models\Profil\AccountDeletionRequest::find($requestId)
                : ($targetUserId ? \App\Models\Profil\AccountDeletionRequest::where('user_id', $targetUserId)->pending()->latest()->first() : null);

            if ($action === 'accept' || $action === 'accept_account_deletion') {
                $targetUser = $targetUserId ? User::find($targetUserId) : null;
                $targetUserName = $targetUser ? $targetUser->name : ($data['request_user_name'] ?? 'Pengguna');

                if ($targetUser) {
                    // Clean up files
                    if ($targetUser->avatar && \Illuminate\Support\Facades\Storage::disk('public')->exists($targetUser->avatar)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($targetUser->avatar);
                    }
                    if ($targetUser->detail?->foto_ktp && \Illuminate\Support\Facades\Storage::disk('public')->exists($targetUser->detail->foto_ktp)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($targetUser->detail->foto_ktp);
                    }

                    // Invalidate active sessions
                    try {
                        if (\Illuminate\Support\Facades\DB::getSchemaBuilder()->hasTable('sessions')) {
                            \Illuminate\Support\Facades\DB::table('sessions')->where('user_id', $targetUser->id)->delete();
                        }
                    } catch (\Throwable $e) {}

                    $targetUser->delete();
                }

                if ($deletionRequest) {
                    $deletionRequest->update([
                        'status' => 'approved',
                        'processed_by' => $user->id,
                        'processed_at' => now(),
                    ]);
                }

                // Update all master/admin notifications for this request
                AppNotification::where('type', 'account_deletion_request')
                    ->where(function ($q) use ($requestId, $targetUserId) {
                        if ($requestId) {
                            $q->whereJsonContains('data->request_id', (int) $requestId);
                        }
                        if ($targetUserId) {
                            $q->orWhereJsonContains('data->request_user_id', (int) $targetUserId);
                        }
                    })
                    ->update([
                        'action_state' => 'accepted',
                        'is_read' => true,
                        'read_at' => now(),
                    ]);

                $stats = AppNotificationService::getUnreadStats($user);

                return response()->json([
                    'status' => 'success',
                    'action_state' => 'accepted',
                    'message' => "Permintaan disetujui. Akun {$targetUserName} telah berhasil dihapus dari sistem.",
                    'stats' => $stats,
                    'unread_total' => $stats['total'],
                ]);
            } elseif ($action === 'decline' || $action === 'decline_account_deletion') {
                if ($deletionRequest) {
                    $deletionRequest->update([
                        'status' => 'rejected',
                        'processed_by' => $user->id,
                        'processed_at' => now(),
                        'admin_notes' => $request->input('admin_notes', 'Permintaan keluar akun ditolak oleh Administrator.'),
                    ]);
                }

                // Send notification to target user if still exists
                if ($targetUserId && User::find($targetUserId)) {
                    AppNotificationService::send([
                        'user_id' => $targetUserId,
                        'category' => 'security',
                        'type' => 'account_deletion_declined',
                        'title' => 'Permintaan Keluar Akun Ditolak',
                        'message' => 'Permintaan keluar akun Anda telah ditolak oleh Administrator. Akun Anda tetap aktif.',
                        'icon' => 'ki-shield-cross',
                        'color' => 'warning',
                        'action_state' => 'declined',
                    ]);
                }

                // Update all master/admin notifications for this request
                AppNotification::where('type', 'account_deletion_request')
                    ->where(function ($q) use ($requestId, $targetUserId) {
                        if ($requestId) {
                            $q->whereJsonContains('data->request_id', (int) $requestId);
                        }
                        if ($targetUserId) {
                            $q->orWhereJsonContains('data->request_user_id', (int) $targetUserId);
                        }
                    })
                    ->update([
                        'action_state' => 'declined',
                        'is_read' => true,
                        'read_at' => now(),
                    ]);

                $stats = AppNotificationService::getUnreadStats($user);

                return response()->json([
                    'status' => 'success',
                    'action_state' => 'declined',
                    'message' => 'Permintaan keluar akun telah ditolak.',
                    'stats' => $stats,
                    'unread_total' => $stats['total'],
                ]);
            }
        }

        // Generic dismiss / read
        $notif->markAsRead();
        $stats = AppNotificationService::getUnreadStats($user);

        return response()->json([
            'status' => 'success',
            'action_state' => 'read',
            'message' => 'Notifikasi telah diproses.',
            'stats' => $stats,
            'unread_total' => $stats['total'],
        ]);
    }
}
