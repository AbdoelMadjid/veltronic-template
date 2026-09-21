<?php

namespace App\Services\UserManagement;

use App\Models\UserManagement\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserPresenceService
{
    const CACHE_PREFIX = 'veltronic_user_presence_';
    const ONLINE_TIMEOUT_SECONDS = 180; // 3 menit
    const IDLE_TIMEOUT_SECONDS = 600;   // 10 menit
    const CACHE_TTL_SECONDS = 900;      // 15 menit

    /**
     * Record or update user heartbeat presence state.
     *
     * @param User $user
     * @param string $status 'online' | 'idle' | 'offline'
     * @return array
     */
    public static function recordHeartbeat(User $user, string $status = 'online'): array
    {
        $validStatuses = ['online', 'idle', 'offline'];
        if (!in_array($status, $validStatuses, true)) {
            $status = 'online';
        }

        $now = Carbon::now();
        $cacheKey = self::CACHE_PREFIX . $user->id;

        $presenceData = [
            'user_id' => $user->id,
            'name' => $user->name,
            'status' => $status,
            'last_seen_at' => $now->toDateTimeString(),
            'updated_at_timestamp' => $now->timestamp,
            'ip' => request()->ip(),
        ];

        if ($status === 'offline') {
            Cache::forget($cacheKey);
        } else {
            Cache::put($cacheKey, $presenceData, $now->copy()->addSeconds(self::CACHE_TTL_SECONDS));
        }

        // Throttle database update to once every 2 minutes or when becoming offline
        $shouldUpdateDb = false;
        if ($status === 'offline') {
            $shouldUpdateDb = true;
        } elseif (!$user->last_login_at || $now->diffInMinutes($user->last_login_at) >= 2) {
            $shouldUpdateDb = true;
        }

        if ($shouldUpdateDb) {
            try {
                // Update timestamp without touching other columns
                $user->timestamps = false;
                $user->last_login_at = $now;
                $user->saveQuietly();
            } catch (\Throwable $e) {
                // Ignore DB error during background ping
            }
        }

        return $presenceData;
    }

    /**
     * Set a user status to offline.
     *
     * @param int|User $user
     * @return void
     */
    public static function setUserOffline(int|User $user): void
    {
        $userId = is_object($user) ? $user->id : (int) $user;
        if ($userId > 0) {
            Cache::forget(self::CACHE_PREFIX . $userId);
        }
    }

    /**
     * Get presence details for a single user.
     *
     * @param User $user
     * @return array
     */
    public static function getUserPresence(User $user): array
    {
        $cacheKey = self::CACHE_PREFIX . $user->id;
        $cached = Cache::get($cacheKey);

        $status = 'offline';
        $lastSeen = $user->last_login_at ? Carbon::parse($user->last_login_at) : null;

        if ($cached && is_array($cached)) {
            $lastTimestamp = $cached['updated_at_timestamp'] ?? 0;
            $secondsDiff = Carbon::now()->timestamp - $lastTimestamp;

            if ($secondsDiff <= self::ONLINE_TIMEOUT_SECONDS) {
                $status = ($cached['status'] === 'idle') ? 'idle' : 'online';
            } elseif ($secondsDiff <= self::IDLE_TIMEOUT_SECONDS) {
                $status = 'idle';
            } else {
                $status = 'offline';
            }

            if (!empty($cached['last_seen_at'])) {
                $lastSeen = Carbon::parse($cached['last_seen_at']);
            }
        } elseif ($lastSeen) {
            // Fallback to database last_login_at timestamp if cache key is cold
            $dbSecondsDiff = Carbon::now()->diffInSeconds($lastSeen);
            if ($dbSecondsDiff <= self::ONLINE_TIMEOUT_SECONDS) {
                $status = 'online';
            } elseif ($dbSecondsDiff <= self::IDLE_TIMEOUT_SECONDS) {
                $status = 'idle';
            } else {
                $status = 'offline';
            }
        }

        $badgeClass = match ($status) {
            'online' => 'bg-success',
            'idle' => 'bg-warning',
            default => 'bg-secondary',
        };

        $label = match ($status) {
            'online' => 'Online',
            'idle' => 'Idle',
            default => 'Offline',
        };

        $lastSeenHuman = $lastSeen ? $lastSeen->diffForHumans() : 'Belum pernah';

        return [
            'status' => $status,
            'badge_class' => $badgeClass,
            'label' => $label,
            'last_seen_at' => $lastSeen ? $lastSeen->toDateTimeString() : null,
            'last_seen_human' => ($status === 'online') ? 'Aktif sekarang' : $lastSeenHuman,
        ];
    }

    /**
     * Get user list with presence data formatted for Dashboard Widget & Social Feeds.
     *
     * @param int|User|null $currentUser
     * @param int $limit
     * @param string|null $filterStatus 'all' | 'online' | 'idle' | 'offline'
     * @return array
     */
    public static function getDashboardUsersPresence(int|User|null $currentUser = null, int $limit = 10, ?string $filterStatus = 'all'): array
    {
        $currentUserId = is_object($currentUser) ? $currentUser->id : ($currentUser ? (int) $currentUser : auth()->id());

        // Get all active users with roles
        $usersQuery = User::with(['roles', 'settingRecord'])
            ->where('id', '!=', $currentUserId ?: 0)
            ->latest('id');

        $users = $usersQuery->get();

        $onlineCount = 0;
        $idleCount = 0;
        $offlineCount = 0;

        $decoratedUsers = $users->map(function ($u) use (&$onlineCount, &$idleCount, &$offlineCount) {
            $presence = self::getUserPresence($u);

            if ($presence['status'] === 'online') {
                $onlineCount++;
                $sortWeight = 1;
            } elseif ($presence['status'] === 'idle') {
                $idleCount++;
                $sortWeight = 2;
            } else {
                $offlineCount++;
                $sortWeight = 3;
            }

            $primaryRole = $u->roles->first()?->name ?? 'Pengguna';
            $roleBadgeClass = match (strtolower($primaryRole)) {
                'master' => 'badge-light-danger text-danger',
                'admin' => 'badge-light-primary text-primary',
                default => 'badge-light-info text-info',
            };

            return [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'avatar' => $u->avatar,
                'avatar_url' => $u->avatar_url,
                'avatar_style' => $u->avatar_style,
                'initial' => $u->initial,
                'role' => strtoupper($primaryRole),
                'role_badge_class' => $roleBadgeClass,
                'status' => $presence['status'],
                'badge_class' => $presence['badge_class'],
                'label' => $presence['label'],
                'last_seen_human' => $presence['last_seen_human'],
                'sort_weight' => $sortWeight,
                // Social connection placeholders (Sosmed ready)
                'is_friend' => false,
                'friend_request_sent' => false,
            ];
        });

        // Filter if requested
        if (!empty($filterStatus) && in_array($filterStatus, ['online', 'idle', 'offline'], true)) {
            $filtered = $decoratedUsers->filter(fn($item) => $item['status'] === $filterStatus);
        } else {
            $filtered = $decoratedUsers;
        }

        // Sort by Online first, then Idle, then Offline, then Name
        $sorted = $filtered->sortBy([
            ['sort_weight', 'asc'],
            ['name', 'asc'],
        ])->take($limit)->values();

        return [
            'users' => $sorted,
            'stats' => [
                'total' => $users->count(),
                'online' => $onlineCount,
                'idle' => $idleCount,
                'offline' => $offlineCount,
            ],
            'timestamp' => Carbon::now()->toIso8601String(),
        ];
    }
}
