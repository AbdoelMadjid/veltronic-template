<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFriendship extends Model
{
    use HasFactory;

    protected $table = 'user_friendships';

    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
    ];

    /**
     * Sender of the friend request.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Receiver of the friend request.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    /**
     * Scope pending requests.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope accepted requests.
     */
    public function scopeAccepted(Builder $query): Builder
    {
        return $query->where('status', 'accepted');
    }

    /**
     * Scope friendship relation between two specific users (either direction).
     */
    public function scopeBetweenUsers(Builder $query, int $userA, int $userB): Builder
    {
        return $query->where(function ($q) use ($userA, $userB) {
            $q->where('user_id', $userA)->where('friend_id', $userB);
        })->orWhere(function ($q) use ($userA, $userB) {
            $q->where('user_id', $userB)->where('friend_id', $userA);
        });
    }

    /**
     * Scope all accepted friends for a given user.
     */
    public function scopeAcceptedFriends(Builder $query, int $userId): Builder
    {
        return $query->where('status', 'accepted')
            ->where(function ($q) use ($userId) {
                $q->where('user_id', $userId)->orWhere('friend_id', $userId);
            });
    }
}
