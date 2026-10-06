<?php

namespace App\Models\AppSupport;

use App\Models\UserManagement\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppNotification extends Model
{
    use HasFactory;

    protected $table = 'app_notifications';

    protected $fillable = [
        'user_id',
        'target_role',
        'category',
        'type',
        'title',
        'message',
        'icon',
        'color',
        'action_url',
        'data',
        'action_state',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Target user relationship.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope for a specific authenticated user (directed to user ID or targeted by user's roles).
     */
    public function scopeForUser(Builder $query, User $user): Builder
    {
        $userRoles = [];
        if (method_exists($user, 'getRoleNames')) {
            $userRoles = $user->getRoleNames()->map(fn($r) => strtolower($r))->toArray();
        }
        if (empty($userRoles) && isset($user->roles)) {
            $userRoles = $user->roles->pluck('name')->map(fn($r) => strtolower($r))->toArray();
        }
        if (!empty($user->role)) {
            $userRoles[] = strtolower($user->role);
        }
        if (method_exists($user, 'hasRole')) {
            if ($user->hasRole('master')) $userRoles[] = 'master';
            if ($user->hasRole('admin')) $userRoles[] = 'admin';
        }
        $userRoles = array_values(array_unique(array_filter($userRoles)));

        return $query->where(function (Builder $q) use ($user, $userRoles) {
            $q->where('user_id', $user->id);

            if (!empty($userRoles)) {
                $q->orWhere(function (Builder $sub) use ($userRoles) {
                    $sub->whereNull('user_id')
                        ->whereIn('target_role', array_merge($userRoles, ['all']));
                });
            }
        });
    }

    /**
     * Scope for unread notifications.
     */
    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope by category.
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(): bool
    {
        return $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }
}
