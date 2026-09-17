<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserLogin extends Model
{
    use HasFactory;

    protected $table = 'users_logins';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type',
        'ip_address',
        'user_agent',
        'device',
        'browser',
        'platform',
        'point_earned',
        'created_at',
    ];

    protected $casts = [
        'point_earned' => 'integer',
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope query by action type ('login' or 'lockscreen').
     */
    public function scopeOfType($query, ?string $type)
    {
        if (!empty($type) && $type !== 'all') {
            return $query->where('type', $type);
        }
        return $query;
    }

    /**
     * Scope query by point earned (1 or 0).
     */
    public function scopePointEarned($query, ?string $pointEarned)
    {
        if ($pointEarned === 'yes' || $pointEarned === '1') {
            return $query->where('point_earned', 1);
        } elseif ($pointEarned === 'no' || $pointEarned === '0') {
            return $query->where('point_earned', 0);
        }
        return $query;
    }

    /**
     * Scope query by keyword search (User Name, Email, IP, Browser, Platform).
     */
    public function scopeSearchKeyword($query, ?string $search)
    {
        if (!empty($search)) {
            $search = trim($search);
            return $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                  ->orWhere('device', 'like', "%{$search}%")
                  ->orWhere('browser', 'like', "%{$search}%")
                  ->orWhere('platform', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        return $query;
    }

    /**
     * Helper to parse user agent for device, browser, and OS platform.
     */
    public static function parseUserAgent(?string $userAgent): array
    {
        if (empty($userAgent)) {
            return [
                'device' => 'Desktop',
                'browser' => 'Browser Tidak Dikenal',
                'platform' => 'Sistem Tidak Dikenal',
            ];
        }

        // Platform detection
        $platform = 'Lainnya';
        if (preg_match('/windows nt 10/i', $userAgent)) {
            $platform = 'Windows 10/11';
        } elseif (preg_match('/windows nt 6\.3/i', $userAgent)) {
            $platform = 'Windows 8.1';
        } elseif (preg_match('/windows nt 6\.2/i', $userAgent)) {
            $platform = 'Windows 8';
        } elseif (preg_match('/windows nt 6\.1/i', $userAgent)) {
            $platform = 'Windows 7';
        } elseif (preg_match('/windows/i', $userAgent)) {
            $platform = 'Windows';
        } elseif (preg_match('/android/i', $userAgent)) {
            $platform = 'Android';
        } elseif (preg_match('/iphone/i', $userAgent)) {
            $platform = 'iOS (iPhone)';
        } elseif (preg_match('/ipad/i', $userAgent)) {
            $platform = 'iOS (iPad)';
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            $platform = 'MacOS';
        } elseif (preg_match('/linux/i', $userAgent)) {
            $platform = 'Linux';
        }

        // Device detection
        $device = 'Desktop';
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $userAgent)) {
            $device = 'Tablet';
        } elseif (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', $userAgent)) {
            $device = 'Mobile';
        }

        // Browser detection
        $browser = 'Browser';
        if (preg_match('/edg/i', $userAgent)) {
            $browser = 'Microsoft Edge';
        } elseif (preg_match('/chrome|crios/i', $userAgent) && !preg_match('/opr|opera/i', $userAgent)) {
            $browser = 'Google Chrome';
        } elseif (preg_match('/firefox|fxios/i', $userAgent)) {
            $browser = 'Mozilla Firefox';
        } elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome|crios/i', $userAgent)) {
            $browser = 'Apple Safari';
        } elseif (preg_match('/opr|opera/i', $userAgent)) {
            $browser = 'Opera';
        }

        return [
            'device' => $device,
            'browser' => $browser,
            'platform' => $platform,
        ];
    }
}
