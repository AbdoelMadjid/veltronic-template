<?php

namespace App\Models\Profil;

use App\Models\UserManagement\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLog extends Model
{
    use HasFactory;

    protected $table = 'users_logs';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'module',
        'menu',
        'level',
        'activity',
        'description',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Primary centralized method to record activity and error logs.
     */
    public static function record(
        string $module = 'sistem',
        string $menu = 'umum',
        string $activity = 'Aktivitas Sistem',
        ?string $description = null,
        ?User $user = null,
        string $level = 'info'
    ): self {
        $targetUser = $user ?? (auth()->check() ? auth()->user() : null);
        $req = request();

        return self::create([
            'user_id' => $targetUser?->id,
            'module' => $module,
            'menu' => $menu,
            'level' => in_array($level, ['info', 'warning', 'error', 'success'], true) ? $level : 'info',
            'activity' => $activity,
            'description' => $description,
            'ip_address' => $req ? $req->ip() : '127.0.0.1',
            'user_agent' => $req ? $req->userAgent() : 'CLI / System Process',
            'created_at' => now(),
        ]);
    }

    /**
     * Backward-compatible legacy log method.
     */
    public static function log(string $activity, ?string $description = null, ?User $user = null): self
    {
        return self::record(
            module: 'profil',
            menu: 'profil-pengguna',
            activity: $activity,
            description: $description,
            user: $user,
            level: 'info'
        );
    }

    /**
     * Scope query by module category.
     */
    public function scopeModule($query, ?string $module)
    {
        if (!empty($module) && $module !== 'all') {
            return $query->where('module', $module);
        }
        return $query;
    }

    /**
     * Scope query by menu.
     */
    public function scopeMenu($query, ?string $menu)
    {
        if (!empty($menu) && $menu !== 'all') {
            return $query->where('menu', $menu);
        }
        return $query;
    }

    /**
     * Scope query by log level (info, warning, error, success).
     */
    public function scopeLevel($query, ?string $level)
    {
        if (!empty($level) && $level !== 'all') {
            return $query->where('level', $level);
        }
        return $query;
    }

    /**
     * Scope query by keyword search.
     */
    public function scopeSearchKeyword($query, ?string $search)
    {
        if (!empty($search)) {
            $search = trim($search);
            return $query->where(function ($q) use ($search) {
                $q->where('activity', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('module', 'like', "%{$search}%")
                  ->orWhere('menu', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        return $query;
    }
}
