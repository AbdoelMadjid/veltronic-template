<?php

namespace App\Models\AppSupport;

use App\Models\UserManagement\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppChatMessage extends Model
{
    use HasFactory;

    protected $table = 'app_chat_messages';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'reply_to_id',
        'message',
        'attachment_path',
        'attachment_name',
        'attachment_type',
        'attachment_size',
        'is_read',
        'read_at',
        'is_edited',
        'edited_at',
        'is_pinned',
        'pinned_at',
        'pinned_by',
        'reactions',
        'is_forwarded',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'is_edited' => 'boolean',
        'edited_at' => 'datetime',
        'is_pinned' => 'boolean',
        'pinned_at' => 'datetime',
        'reactions' => 'array',
        'is_forwarded' => 'boolean',
        'attachment_size' => 'integer',
    ];

    protected $appends = [
        'formatted_time',
        'attachment_url',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function replyTo(): BelongsTo
    {
        return $this->belongsTo(self::class, 'reply_to_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'reply_to_id');
    }

    public function pinnedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pinned_by');
    }

    /**
     * Scope messages between two specific users
     */
    public function scopeConversation(Builder $query, int $userA, int $userB): Builder
    {
        return $query->where(function ($q) use ($userA, $userB) {
            $q->where('sender_id', $userA)->where('receiver_id', $userB);
        })->orWhere(function ($q) use ($userA, $userB) {
            $q->where('sender_id', $userB)->where('receiver_id', $userA);
        });
    }

    /**
     * Scope unread messages for a specific receiver
     */
    public function scopeUnreadFor(Builder $query, int $userId): Builder
    {
        return $query->where('receiver_id', $userId)->where('is_read', false);
    }

    public function getFormattedTimeAttribute(): string
    {
        if (!$this->created_at) {
            return '';
        }

        if ($this->created_at->isToday()) {
            return $this->created_at->format('H:i');
        }

        if ($this->created_at->isYesterday()) {
            return 'Kemarin ' . $this->created_at->format('H:i');
        }

        return $this->created_at->translatedFormat('d M, H:i');
    }

    public function getAttachmentUrlAttribute(): ?string
    {
        if (!$this->attachment_path) {
            return null;
        }

        return asset('storage/' . $this->attachment_path);
    }
}
