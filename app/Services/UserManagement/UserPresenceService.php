<?php

namespace App\Services\UserManagement;

use App\Models\UserManagement\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class UserPresenceService
{
    const CACHE_PREFIX = 'veltronic_user_presence_';
    const ONLINE_TIMEOUT_SECONDS = 90; // 90 detik (2x interval heartbeat 45 detik)
    const IDLE_TIMEOUT_SECONDS = 300;  // 5 menit
    const CACHE_TTL_SECONDS = 600;     // 10 menit

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
        }

        $badgeClass = match ($status) {
            'online' => 'bg-success',
            'idle' => 'bg-warning',
            default => 'bg-secondary',
        };

        $badgeTextClass = match ($status) {
            'online' => 'text-white',
            'idle' => 'text-white',
            default => 'text-gray-800',
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
            'badge_text_class' => $badgeTextClass,
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

        // Load all friendships involving current user in one query
        $friendships = collect();
        if ($currentUserId) {
            $friendships = \App\Models\UserManagement\UserFriendship::where('user_id', $currentUserId)
                ->orWhere('friend_id', $currentUserId)
                ->get();
        }

        // Get all active users with roles
        $usersQuery = User::with(['roles', 'settingRecord'])
            ->where('id', '!=', $currentUserId ?: 0)
            ->latest('id');

        $users = $usersQuery->get();

        $onlineCount = 0;
        $idleCount = 0;
        $offlineCount = 0;

        $decoratedUsers = $users->map(function ($u) use (&$onlineCount, &$idleCount, &$offlineCount, $currentUserId, $friendships) {
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

            // Resolve real friendship relation
            $friendship = $friendships->first(function ($f) use ($currentUserId, $u) {
                return ($f->user_id == $currentUserId && $f->friend_id == $u->id) ||
                       ($f->user_id == $u->id && $f->friend_id == $currentUserId);
            });

            $friendshipStatus = 'none'; // 'none' | 'pending_sent' | 'pending_received' | 'accepted' | 'declined'
            $friendshipId = null;

            if ($friendship) {
                $friendshipId = $friendship->id;
                if ($friendship->status === 'accepted') {
                    $friendshipStatus = 'accepted';
                } elseif ($friendship->status === 'pending') {
                    $friendshipStatus = ($friendship->user_id == $currentUserId) ? 'pending_sent' : 'pending_received';
                } else {
                    $friendshipStatus = 'declined';
                }
            }

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
                // Real friendship properties
                'is_friend' => ($friendshipStatus === 'accepted'),
                'friendship_status' => $friendshipStatus,
                'friendship_id' => $friendshipId,
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

    /**
     * Get Top users leaderboard ranked by activity points.
     *
     * @param int $limit
     * @return array
     */
    public static function getTopLeaderboard(int $limit = 5): array
    {
        $users = User::with(['roles'])
            ->orderBy('points', 'desc')
            ->take($limit)
            ->get();

        return $users->map(function ($u, $index) {
            $presence = self::getUserPresence($u);
            $primaryRole = $u->roles->first()?->name ?? 'Pengguna';

            return [
                'rank' => $index + 1,
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'avatar_url' => $u->avatar_url,
                'avatar_style' => $u->avatar_style,
                'has_avatar' => !empty($u->avatar),
                'initial' => $u->initial,
                'points' => (int) ($u->points ?? 0),
                'role' => strtoupper($primaryRole),
                'status' => $presence['status'],
                'badge_class' => $presence['badge_class'],
            ];
        })->toArray();
    }

    /**
     * Get Live Activity Stream for Dashboard.
     *
     * @param int $limit
     * @return array
     */
    public static function getActivityStream(int $limit = 6): array
    {
        $activities = [];

        // 1. Recent Friendships
        $recentFriends = \App\Models\UserManagement\UserFriendship::with(['user', 'friend'])
            ->where('status', 'accepted')
            ->latest('updated_at')
            ->take($limit)
            ->get();

        foreach ($recentFriends as $rf) {
            if ($rf->user && $rf->friend) {
                $activities[] = [
                    'type' => 'friendship',
                    'icon' => 'ki-people',
                    'color' => 'success',
                    'title' => 'Pertemanan Baru',
                    'description' => "<strong>{$rf->user->name}</strong> dan <strong>{$rf->friend->name}</strong> kini berteman.",
                    'time_human' => $rf->updated_at ? $rf->updated_at->diffForHumans() : 'Baru saja',
                    'timestamp' => $rf->updated_at ? $rf->updated_at->timestamp : 0,
                ];
            }
        }

        // 2. Recent Profile & Media Updates (Avatar, Background Cover, Moto Hidup / Identitas)
        $recentProfileLogs = \App\Models\Profil\UserLog::with('user')
            ->where(function ($q) {
                $q->where('activity', 'like', '%Avatar%')
                  ->orWhere('activity', 'like', '%Foto Profil%')
                  ->orWhere('activity', 'like', '%Background%')
                  ->orWhere('activity', 'like', '%Cover%')
                  ->orWhere('activity', 'like', '%Identitas%')
                  ->orWhere('activity', 'like', '%Moto Hidup%');
            })
            ->latest('id')
            ->take($limit)
            ->get();

        foreach ($recentProfileLogs as $pl) {
            if ($pl->user) {
                $actLower = strtolower($pl->activity);
                $icon = 'ki-user-edit';
                $color = 'primary';
                $title = $pl->activity;

                if (str_contains($actLower, 'avatar') || str_contains($actLower, 'foto profil')) {
                    $icon = 'ki-picture';
                    $color = 'primary';
                    $title = 'Pembaruan Avatar';
                } elseif (str_contains($actLower, 'background') || str_contains($actLower, 'cover')) {
                    $icon = 'ki-gallery';
                    $color = 'warning';
                    $title = 'Pembaruan Background';
                } elseif (str_contains($actLower, 'identitas') || str_contains($actLower, 'moto')) {
                    $icon = 'ki-quote';
                    $color = 'info';
                    $title = 'Pembaruan Profil';
                }

                $activities[] = [
                    'type' => 'profile_update',
                    'icon' => $icon,
                    'color' => $color,
                    'title' => $title,
                    'description' => "<strong>{$pl->user->name}</strong>: {$pl->description}",
                    'time_human' => $pl->created_at ? $pl->created_at->diffForHumans() : 'Baru saja',
                    'timestamp' => $pl->created_at ? $pl->created_at->timestamp : 0,
                ];
            }
        }

        // 3. Recent Active / Logged-in Users
        $recentLogins = User::whereNotNull('last_login_at')
            ->latest('last_login_at')
            ->take($limit)
            ->get();

        foreach ($recentLogins as $rl) {
            $activities[] = [
                'type' => 'login',
                'icon' => 'ki-entrance-left',
                'color' => 'primary',
                'title' => 'Aktivitas Masuk',
                'description' => "<strong>{$rl->name}</strong> baru saja aktif di sistem.",
                'time_human' => $rl->last_login_at ? Carbon::parse($rl->last_login_at)->diffForHumans() : 'Baru saja',
                'timestamp' => $rl->last_login_at ? Carbon::parse($rl->last_login_at)->timestamp : 0,
            ];
        }

        // Sort combined activities by latest timestamp descending
        usort($activities, fn($a, $b) => $b['timestamp'] <=> $a['timestamp']);

        return array_slice($activities, 0, $limit);
    }
}
