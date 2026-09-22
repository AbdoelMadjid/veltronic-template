<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Models\AppSupport\AppChatMessage;
use App\Models\AppSupport\AppNotification;
use App\Models\UserManagement\User;
use App\Services\AppSupport\AppNotificationService;
use App\Services\UserManagement\UserPresenceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ChatController extends Controller
{
    /**
     * Display the Chat interface under the User Profile layout.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $selectedUserId = $request->query('user') ? (int) $request->query('user') : null;
        $selectedUser = null;

        if ($selectedUserId && $selectedUserId !== $user->id) {
            $selectedUser = User::find($selectedUserId);
        }

        $title = 'Pesan & Chat';

        return view('pages.profil.chat', compact('user', 'title', 'selectedUserId', 'selectedUser'));
    }

    /**
     * Get list of chat contacts (conversations + friends + search query).
     */
    public function getContacts(Request $request): JsonResponse
    {
        $currentUser = $request->user() ?? auth()->user();
        if (!$currentUser) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
        }

        $search = trim((string) $request->query('q', ''));

        // Query all users except current user
        $usersQuery = User::where('id', '!=', $currentUser->id);

        if ($search !== '') {
            $usersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $usersQuery->with(['detail', 'settingRecord'])->get();

        $contacts = $users->map(function ($targetUser) use ($currentUser) {
            $presence = UserPresenceService::getUserPresence($targetUser);

            // Last message between current user and target user
            $lastMessage = AppChatMessage::conversation($currentUser->id, $targetUser->id)
                ->latest('created_at')
                ->first();

            // Unread count from this target user
            $unreadCount = AppChatMessage::where('sender_id', $targetUser->id)
                ->where('receiver_id', $currentUser->id)
                ->where('is_read', false)
                ->count();

            $lastMsgText = $lastMessage ? $lastMessage->message : null;
            if ($lastMessage && (empty($lastMsgText) || $lastMsgText === '[Foto Lampiran]' || $lastMsgText === '[Berkas Lampiran]')) {
                if ($lastMessage->attachment_type === 'image') {
                    $lastMsgText = '📷 Foto';
                } elseif ($lastMessage->attachment_path) {
                    $lastMsgText = '📎 ' . ($lastMessage->attachment_name ?: 'Berkas');
                }
            }

            return [
                'id' => $targetUser->id,
                'name' => $targetUser->name,
                'email' => $targetUser->email,
                'avatar_url' => $targetUser->avatar_url,
                'avatar_style' => $targetUser->avatar_style,
                'has_avatar' => !empty($targetUser->avatar),
                'initial' => $targetUser->initial,
                'presence' => $presence,
                'unread_count' => $unreadCount,
                'last_message' => $lastMessage ? [
                    'text' => Str::limit($lastMsgText ?: '', 45),
                    'time' => $lastMessage->formatted_time,
                    'is_sender' => ($lastMessage->sender_id === $currentUser->id),
                    'is_read' => $lastMessage->is_read,
                    'created_at' => $lastMessage->created_at ? $lastMessage->created_at->toIso8601String() : null,
                ] : null,
            ];
        });

        // Sort: Contacts with most recent messages first, then unread, then online status
        $sortedContacts = $contacts->sortByDesc(function ($c) {
            $msgTime = $c['last_message']['created_at'] ?? '2000-01-01T00:00:00Z';
            $unreadBonus = $c['unread_count'] > 0 ? 1000000000 : 0;
            $onlineBonus = ($c['presence']['status'] ?? 'offline') === 'online' ? 500000 : 0;
            return strtotime($msgTime) + $unreadBonus + $onlineBonus;
        })->values();

        return response()->json([
            'status' => 'success',
            'contacts' => $sortedContacts,
            'total_unread' => $currentUser->unreadChatCount(),
        ]);
    }

    /**
     * Get message conversation between authenticated user and target user.
     */
    public function getConversation(Request $request, int $targetUserId): JsonResponse
    {
        $currentUser = $request->user() ?? auth()->user();
        if (!$currentUser) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
        }
        $targetUser = User::find($targetUserId);

        if (!$targetUser) {
            return response()->json(['status' => 'error', 'message' => 'Pengguna tidak ditemukan.'], 404);
        }

        // Mark incoming messages as read
        AppChatMessage::where('sender_id', $targetUserId)
            ->where('receiver_id', $currentUser->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        // Also mark corresponding chat notifications as read
        AppNotification::forUser($currentUser)
            ->where('category', 'chat')
            ->whereJsonContains('data->sender_id', $targetUserId)
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        // Fetch conversation messages
        $messages = AppChatMessage::conversation($currentUser->id, $targetUserId)
            ->with(['replyTo.sender'])
            ->orderBy('created_at', 'asc')
            ->limit(150)
            ->get();

        $formattedMessages = $messages->map(function ($msg) use ($currentUser, $targetUser) {
            return $this->formatMessage($msg, $currentUser, $targetUser);
        });

        // Pinned messages in this conversation
        $pinnedMessages = $messages->where('is_pinned', true)->values()->map(function ($msg) use ($currentUser, $targetUser) {
            return $this->formatMessage($msg, $currentUser, $targetUser);
        });

        $presence = UserPresenceService::getUserPresence($targetUser);

        return response()->json([
            'status' => 'success',
            'target_user' => [
                'id' => $targetUser->id,
                'name' => $targetUser->name,
                'email' => $targetUser->email,
                'avatar_url' => $targetUser->avatar_url,
                'avatar_style' => $targetUser->avatar_style,
                'has_avatar' => !empty($targetUser->avatar),
                'initial' => $targetUser->initial,
                'presence' => $presence,
            ],
            'messages' => $formattedMessages,
            'pinned_messages' => $pinnedMessages,
            'total_unread' => $currentUser->unreadChatCount(),
        ]);
    }

    /**
     * Send a private chat message to target user.
     */
    public function sendMessage(Request $request, int $targetUserId): JsonResponse
    {
        $currentUser = $request->user();
        $targetUser = User::find($targetUserId);

        if (!$targetUser) {
            return response()->json(['status' => 'error', 'message' => 'Pengguna tujuan tidak ditemukan.'], 404);
        }

        $request->validate([
            'message' => 'nullable|string|max:5000',
            'reply_to_id' => 'nullable|integer|exists:app_chat_messages,id',
            'attachment' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif,webp,pdf,doc,docx,zip,xls,xlsx,txt',
        ]);

        $messageText = trim((string) $request->input('message', ''));
        $replyToId = $request->input('reply_to_id') ? (int) $request->input('reply_to_id') : null;
        $attachment = $request->file('attachment');

        if ($messageText === '' && !$attachment) {
            return response()->json(['status' => 'error', 'message' => 'Silakan tulis pesan atau pilih lampiran berkas.'], 422);
        }

        $attachmentPath = null;
        $attachmentName = null;
        $attachmentType = null;
        $attachmentSize = null;

        if ($attachment) {
            $attachmentName = $attachment->getClientOriginalName();
            $mime = $attachment->getMimeType();
            $attachmentType = str_starts_with($mime, 'image/') ? 'image' : 'file';
            $attachmentSize = $attachment->getSize();
            $attachmentPath = $attachment->store('chat-attachments/' . date('Y/m'), 'public');
        }

        $chatMessage = AppChatMessage::create([
            'sender_id' => $currentUser->id,
            'receiver_id' => $targetUserId,
            'reply_to_id' => $replyToId,
            'message' => $messageText ?: '',
            'attachment_path' => $attachmentPath,
            'attachment_name' => $attachmentName,
            'attachment_type' => $attachmentType,
            'attachment_size' => $attachmentSize,
            'is_read' => false,
        ]);

        $chatMessage->load(['replyTo.sender']);

        $notifMessage = $messageText;
        if (empty($notifMessage)) {
            $notifMessage = ($attachmentType === 'image') ? 'Mengirim foto' : ('Mengirim berkas: ' . ($attachmentName ?: 'lampiran'));
        }

        // Send or consolidate System Notification to Receiver via AppNotificationService
        AppNotificationService::sendChatNotification($currentUser, $targetUserId, $chatMessage, $notifMessage);

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan berhasil dikirim.',
            'chat' => $this->formatMessage($chatMessage, $currentUser, $targetUser),
        ]);
    }

    /**
     * Edit a chat message text (only by sender).
     */
    public function editMessage(Request $request, int $id): JsonResponse
    {
        $currentUser = $request->user();
        $message = AppChatMessage::where('id', $id)
            ->where('sender_id', $currentUser->id)
            ->first();

        if (!$message) {
            return response()->json(['status' => 'error', 'message' => 'Pesan tidak ditemukan atau Anda tidak memiliki izin untuk mengeditnya.'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $newText = trim((string) $request->input('message'));
        if ($newText === '') {
            return response()->json(['status' => 'error', 'message' => 'Teks pesan tidak boleh kosong.'], 422);
        }

        $message->update([
            'message' => $newText,
            'is_edited' => true,
            'edited_at' => now(),
        ]);

        $targetUser = User::find($message->receiver_id);

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan berhasil diedit.',
            'chat' => $this->formatMessage($message, $currentUser, $targetUser ?? $currentUser),
        ]);
    }

    /**
     * Toggle Pin/Unpin message in conversation.
     */
    public function togglePinMessage(Request $request, int $id): JsonResponse
    {
        $currentUser = $request->user();
        $message = AppChatMessage::where('id', $id)
            ->where(function ($q) use ($currentUser) {
                $q->where('sender_id', $currentUser->id)
                  ->orWhere('receiver_id', $currentUser->id);
            })
            ->first();

        if (!$message) {
            return response()->json(['status' => 'error', 'message' => 'Pesan tidak ditemukan.'], 404);
        }

        $newPinnedState = !$message->is_pinned;
        $message->update([
            'is_pinned' => $newPinnedState,
            'pinned_at' => $newPinnedState ? now() : null,
            'pinned_by' => $newPinnedState ? $currentUser->id : null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $newPinnedState ? 'Pesan berhasil disematkan (Pin).' : 'Sematkan pesan dilepas.',
            'is_pinned' => $newPinnedState,
            'message_id' => $message->id,
        ]);
    }

    /**
     * Add or Toggle Reaction (Emoji) on message.
     */
    public function reactMessage(Request $request, int $id): JsonResponse
    {
        $currentUser = $request->user();
        $message = AppChatMessage::where('id', $id)
            ->where(function ($q) use ($currentUser) {
                $q->where('sender_id', $currentUser->id)
                  ->orWhere('receiver_id', $currentUser->id);
            })
            ->first();

        if (!$message) {
            return response()->json(['status' => 'error', 'message' => 'Pesan tidak ditemukan.'], 404);
        }

        $request->validate([
            'emoji' => 'required|string|max:30',
        ]);

        $emoji = trim((string) $request->input('emoji'));
        $reactions = is_array($message->reactions) ? $message->reactions : [];

        $alreadyReactedSame = isset($reactions[$emoji]) && is_array($reactions[$emoji]) && in_array($currentUser->id, $reactions[$emoji]);

        // Remove user's previous reaction from ALL emojis on this message
        foreach ($reactions as $em => $userIds) {
            $cleaned = array_values(array_filter((array) $userIds, fn($uid) => $uid !== $currentUser->id));
            if (empty($cleaned)) {
                unset($reactions[$em]);
            } else {
                $reactions[$em] = $cleaned;
            }
        }

        // If user was not previously reacting with this same emoji, add the new reaction
        if (!$alreadyReactedSame) {
            $newUids = $reactions[$emoji] ?? [];
            $newUids[] = $currentUser->id;
            $reactions[$emoji] = array_values(array_unique($newUids));
        }

        $message->reactions = empty($reactions) ? null : $reactions;
        $message->save();

        $targetUser = User::find($message->sender_id === $currentUser->id ? $message->receiver_id : $message->sender_id);
        $formatted = $this->formatMessage($message, $currentUser, $targetUser ?? $currentUser);

        return response()->json([
            'status' => 'success',
            'message' => 'Reaksi berhasil diperbarui.',
            'reactions' => $formatted['reactions'],
            'message_id' => $message->id,
        ]);
    }

    /**
     * Forward message to one or more selected users.
     */
    public function forwardMessage(Request $request, int $id): JsonResponse
    {
        $currentUser = $request->user();
        $sourceMessage = AppChatMessage::where('id', $id)
            ->where(function ($q) use ($currentUser) {
                $q->where('sender_id', $currentUser->id)
                  ->orWhere('receiver_id', $currentUser->id);
            })
            ->first();

        if (!$sourceMessage) {
            return response()->json(['status' => 'error', 'message' => 'Pesan asal tidak ditemukan.'], 404);
        }

        $request->validate([
            'target_user_ids' => 'required|array|min:1',
            'target_user_ids.*' => 'integer|exists:users,id',
        ]);

        $targetUserIds = array_unique(array_map('intval', $request->input('target_user_ids')));

        $sentCount = 0;
        foreach ($targetUserIds as $tId) {
            if ($tId === $currentUser->id) continue;

            $fwdMsg = AppChatMessage::create([
                'sender_id' => $currentUser->id,
                'receiver_id' => $tId,
                'message' => $sourceMessage->message,
                'attachment_path' => $sourceMessage->attachment_path,
                'attachment_name' => $sourceMessage->attachment_name,
                'attachment_type' => $sourceMessage->attachment_type,
                'attachment_size' => $sourceMessage->attachment_size,
                'is_forwarded' => true,
                'is_read' => false,
            ]);

            $fwdPreview = $fwdMsg->message;
            if (empty($fwdPreview)) {
                $fwdPreview = ($fwdMsg->attachment_type === 'image') ? 'Meneruskan foto lampiran' : ('Meneruskan berkas: ' . ($fwdMsg->attachment_name ?: 'lampiran'));
            }
            AppNotificationService::sendChatNotification($currentUser, $tId, $fwdMsg, $fwdPreview);

            $sentCount++;
        }

        return response()->json([
            'status' => 'success',
            'message' => "Pesan berhasil diteruskan ke {$sentCount} kontak.",
        ]);
    }

    /**
     * Delete a message (only sender can delete).
     */
    public function deleteMessage(Request $request, int $id): JsonResponse
    {
        $currentUser = $request->user();
        $message = AppChatMessage::where('id', $id)
            ->where(function ($q) use ($currentUser) {
                $q->where('sender_id', $currentUser->id)
                  ->orWhere('receiver_id', $currentUser->id);
            })
            ->first();

        if (!$message) {
            return response()->json(['status' => 'error', 'message' => 'Pesan tidak ditemukan atau Anda tidak memiliki izin.'], 403);
        }

        if ($message->attachment_path && Storage::disk('public')->exists($message->attachment_path)) {
            Storage::disk('public')->delete($message->attachment_path);
        }

        $message->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan berhasil dihapus.',
            'message_id' => $id,
        ]);
    }

    /**
     * Format a message model into standardized array payload.
     */
    private function formatMessage(AppChatMessage $msg, User $currentUser, User $targetUser): array
    {
        $isSender = ($msg->sender_id === $currentUser->id);
        $sender = $isSender ? $currentUser : ($msg->sender ?? $targetUser);

        $replyData = null;
        if ($msg->replyTo) {
            $replySender = $msg->replyTo->sender_id === $currentUser->id ? 'Anda' : ($msg->replyTo->sender->name ?? 'Pengguna');
            $replyMsgText = $msg->replyTo->message;
            if (empty($replyMsgText) || $replyMsgText === '[Foto Lampiran]' || $replyMsgText === '[Berkas Lampiran]') {
                if ($msg->replyTo->attachment_type === 'image') {
                    $replyMsgText = 'Foto';
                } elseif ($msg->replyTo->attachment_path) {
                    $replyMsgText = $msg->replyTo->attachment_name ?: 'Berkas';
                }
            }
            $replyData = [
                'id' => $msg->replyTo->id,
                'sender_name' => $replySender,
                'message' => Str::limit($replyMsgText ?: '', 80),
                'attachment_type' => $msg->replyTo->attachment_type,
                'attachment_name' => $msg->replyTo->attachment_name,
                'attachment_url' => $msg->replyTo->attachment_url,
            ];
        }

        $reactionsSummary = [];
        if (!empty($msg->reactions) && is_array($msg->reactions)) {
            foreach ($msg->reactions as $emoji => $userIds) {
                if (!is_array($userIds) || empty($userIds)) continue;
                $reactionsSummary[] = [
                    'emoji' => $emoji,
                    'count' => count($userIds),
                    'user_reacted' => in_array($currentUser->id, $userIds),
                ];
            }
        }

        return [
            'id' => $msg->id,
            'sender_id' => $msg->sender_id,
            'receiver_id' => $msg->receiver_id,
            'is_sender' => $isSender,
            'message' => $msg->message,
            'attachment_url' => $msg->attachment_url,
            'attachment_name' => $msg->attachment_name,
            'attachment_type' => $msg->attachment_type,
            'is_read' => $msg->is_read,
            'is_edited' => (bool) $msg->is_edited,
            'is_pinned' => (bool) $msg->is_pinned,
            'is_forwarded' => (bool) $msg->is_forwarded,
            'reply_to' => $replyData,
            'reactions' => $reactionsSummary,
            'time' => $msg->formatted_time,
            'sender_name' => $sender->name,
            'sender_avatar' => $sender->avatar_url,
            'sender_avatar_style' => $sender->avatar_style,
            'sender_initial' => $sender->initial,
            'sender_has_avatar' => !empty($sender->avatar),
        ];
    }
}
