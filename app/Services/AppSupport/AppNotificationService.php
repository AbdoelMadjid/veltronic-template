<?php

namespace App\Services\AppSupport;

use App\Models\AppSupport\AppChatMessage;
use App\Models\AppSupport\AppNotification;
use App\Models\UserManagement\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class AppNotificationService
{
    /**
     * Send or consolidate chat notification from a sender to a target user.
     */
    public static function sendChatNotification(User $sender, int $targetUserId, AppChatMessage $chatMessage, string $previewText): AppNotification
    {
        $targetUser = User::find($targetUserId);
        if (!$targetUser) {
            return self::send([
                'user_id' => $targetUserId,
                'category' => 'chat',
                'type' => 'new_chat_message',
                'title' => 'Pesan Baru dari ' . $sender->name,
                'message' => Str::limit($previewText, 60),
                'icon' => 'ki-messages',
                'color' => 'info',
                'action_url' => route('profil.profil-pengguna.chat'),
                'data' => [
                    'sender_id' => $sender->id,
                    'sender_name' => $sender->name,
                    'message_id' => $chatMessage->id,
                    'unread_count' => 1,
                ],
            ]);
        }

        // Real count of unread messages from this sender to target user
        $unreadCount = AppChatMessage::where('sender_id', $sender->id)
            ->where('receiver_id', $targetUserId)
            ->where('is_read', false)
            ->count();

        if ($unreadCount <= 0) {
            $unreadCount = 1;
        }

        $title = $unreadCount > 1 
            ? "{$unreadCount} Pesan Baru dari {$sender->name}" 
            : "Pesan Baru dari {$sender->name}";

        // Find existing unread chat notification from this sender
        $existing = AppNotification::forUser($targetUser)
            ->byCategory('chat')
            ->unread()
            ->whereJsonContains('data->sender_id', $sender->id)
            ->latest('id')
            ->first();

        if ($existing) {
            $existing->update([
                'title' => $title,
                'message' => Str::limit($previewText, 60),
                'icon' => 'ki-messages',
                'color' => 'info',
                'action_url' => route('profil.profil-pengguna.chat'),
                'data' => [
                    'sender_id' => $sender->id,
                    'sender_name' => $sender->name,
                    'message_id' => $chatMessage->id,
                    'unread_count' => $unreadCount,
                ],
                'updated_at' => Carbon::now(),
            ]);

            // Clean up any other duplicate unread notifications from this sender
            AppNotification::forUser($targetUser)
                ->byCategory('chat')
                ->unread()
                ->whereJsonContains('data->sender_id', $sender->id)
                ->where('id', '!=', $existing->id)
                ->delete();

            return $existing;
        }

        return self::send([
            'user_id' => $targetUserId,
            'category' => 'chat',
            'type' => 'new_chat_message',
            'title' => $title,
            'message' => Str::limit($previewText, 60),
            'icon' => 'ki-messages',
            'color' => 'info',
            'action_url' => route('profil.profil-pengguna.chat'),
            'data' => [
                'sender_id' => $sender->id,
                'sender_name' => $sender->name,
                'message_id' => $chatMessage->id,
                'unread_count' => $unreadCount,
            ],
            'action_state' => null,
        ]);
    }

    /**
     * Consolidate unread chat notifications for a user by sender.
     */
    public static function consolidateUnreadChatNotifications(User $user): void
    {
        $unreadChatNotifs = AppNotification::forUser($user)
            ->byCategory('chat')
            ->unread()
            ->latest('id')
            ->get();

        $bySender = $unreadChatNotifs->groupBy(function ($notif) {
            return $notif->data['sender_id'] ?? null;
        });

        foreach ($bySender as $senderId => $notifs) {
            if (!$senderId) continue;

            $sender = User::find($senderId);
            $senderName = $sender ? $sender->name : 'Pengguna';

            $unreadMsgCount = AppChatMessage::where('sender_id', $senderId)
                ->where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();

            if ($unreadMsgCount === 0) {
                foreach ($notifs as $n) {
                    $n->update(['is_read' => true, 'read_at' => Carbon::now()]);
                }
                continue;
            }

            $primaryNotif = $notifs->first();
            $title = $unreadMsgCount > 1 
                ? "{$unreadMsgCount} Pesan Baru dari {$senderName}" 
                : "Pesan Baru dari {$senderName}";

            $notifData = $primaryNotif->data ?? [];
            $notifData['unread_count'] = $unreadMsgCount;

            $primaryNotif->update([
                'title' => $title,
                'data' => $notifData,
            ]);

            if ($notifs->count() > 1) {
                $extraIds = $notifs->slice(1)->pluck('id')->toArray();
                AppNotification::whereIn('id', $extraIds)->delete();
            }
        }
    }

    /**
     * Send a notification to a specific user.
     *
     * @param array $payload
     * [
     *    'user_id' => int,
     *    'category' => 'friendship'|'security'|'account'|'chat'|'system',
     *    'type' => string,
     *    'title' => string,
     *    'message' => string,
     *    'icon' => string (optional),
     *    'color' => string (optional: primary|success|danger|warning|info),
     *    'action_url' => string (optional),
     *    'data' => array (optional),
     *    'action_state' => string (optional: pending|accepted|declined),
     * ]
     * @return AppNotification
     */
    public static function send(array $payload): AppNotification
    {
        return AppNotification::create([
            'user_id' => $payload['user_id'] ?? null,
            'target_role' => $payload['target_role'] ?? null,
            'category' => $payload['category'] ?? 'system',
            'type' => $payload['type'] ?? 'general',
            'title' => $payload['title'] ?? 'Pemberitahuan Sistem',
            'message' => $payload['message'] ?? '',
            'icon' => $payload['icon'] ?? 'ki-notification-status',
            'color' => $payload['color'] ?? 'primary',
            'action_url' => $payload['action_url'] ?? null,
            'data' => $payload['data'] ?? null,
            'action_state' => $payload['action_state'] ?? null,
            'is_read' => false,
        ]);
    }

    /**
     * Send a notification broadcasted to one or multiple roles (e.g. Master, Admin).
     *
     * @param string|array $roles 'master' | ['master', 'admin']
     * @param array $payload
     * @return array<AppNotification>
     */
    public static function sendToRole(string|array $roles, array $payload): array
    {
        $roleList = is_array($roles) ? $roles : [$roles];
        $created = [];

        foreach ($roleList as $role) {
            $data = $payload;
            $data['user_id'] = null;
            $data['target_role'] = strtolower($role);
            $created[] = self::send($data);
        }

        return $created;
    }

    /**
     * Get unread notification counts for a user by categories.
     *
     * @param User $user
     * @return array
     */
    public static function getUnreadStats(User $user): array
    {
        self::consolidateUnreadChatNotifications($user);

        $base = AppNotification::forUser($user)->unread();

        return [
            'total' => (clone $base)->count(),
            'friendship' => (clone $base)->byCategory('friendship')->count(),
            'security' => (clone $base)->whereIn('category', ['security', 'account'])->count(),
            'chat' => (clone $base)->byCategory('chat')->count(),
            'system' => (clone $base)->byCategory('system')->count(),
        ];
    }

    /**
     * Get feed of notifications grouped by categories for Topbar Menu.
     *
     * @param User $user
     * @param int $limit
     * @return array
     */
    public static function getNotificationFeed(User $user, int $limit = 15): array
    {
        self::consolidateUnreadChatNotifications($user);

        $all = AppNotification::forUser($user)
            ->latest('id')
            ->take($limit)
            ->get();

        $stats = self::getUnreadStats($user);

        // Decorate items with relative timestamps and formatted attributes
        $decorated = $all->map(function (AppNotification $n) {
            return [
                'id' => $n->id,
                'category' => $n->category,
                'type' => $n->type,
                'title' => $n->title,
                'message' => $n->message,
                'icon' => $n->icon ?: 'ki-notification-status',
                'color' => $n->color ?: 'primary',
                'action_url' => $n->action_url,
                'data' => $n->data ?: [],
                'action_state' => $n->action_state,
                'is_read' => $n->is_read,
                'created_at_human' => $n->created_at ? $n->created_at->diffForHumans() : 'Baru saja',
                'created_at_time' => $n->created_at ? $n->created_at->format('H:i') : '',
            ];
        });

        return [
            'stats' => $stats,
            'items' => [
                'all' => $decorated->values(),
                'friendship' => $decorated->where('category', 'friendship')->values(),
                'security' => $decorated->whereIn('category', ['security', 'account'])->values(),
                'chat' => $decorated->where('category', 'chat')->values(),
                'system' => $decorated->where('category', 'system')->values(),
            ],
            'unread_total' => $stats['total'],
        ];
    }

    /**
     * Mark all notifications for a user as read.
     *
     * @param User $user
     * @return int
     */
    public static function markAllRead(User $user): int
    {
        return AppNotification::forUser($user)
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => Carbon::now(),
            ]);
    }

    /**
     * Mark single notification as read.
     *
     * @param int $notificationId
     * @param User $user
     * @return bool
     */
    public static function markAsRead(int $notificationId, User $user): bool
    {
        $notif = AppNotification::forUser($user)->find($notificationId);
        if ($notif) {
            return $notif->markAsRead();
        }
        return false;
    }
}
