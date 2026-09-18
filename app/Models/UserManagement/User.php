<?php

namespace App\Models\UserManagement;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Profil\UserDetail;
use App\Models\Profil\UserLog;
use App\Models\Profil\UserSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserManagement\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return \Database\Factories\UserManagement\UserFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'points',
        'login_count',
        'last_login_at',
        'last_point_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'avatar_url',
        'cover_bg_url',
        'avatar_style',
        'avatar_pos_x',
        'avatar_pos_y',
        'avatar_zoom',
        'initial',
    ];

    /**
     * Get avatar URL attribute.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            if (str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
                return $this->avatar;
            }
            return asset('storage/' . $this->avatar);
        }
        return \App\Support\ThemeAsset::url('media/svg/avatars/blank.svg');
    }

    /**
     * Get avatar horizontal focus position (X).
     */
    public function getAvatarPosXAttribute(): int
    {
        return (int) ($this->setting('avatar_position_x', '50') ?? 50);
    }

    /**
     * Get avatar vertical focus position (Y).
     */
    public function getAvatarPosYAttribute(): int
    {
        $default = $this->avatar ? '0' : '50';
        return (int) ($this->setting('avatar_position_y', $default) ?? $default);
    }

    /**
     * Get avatar zoom level percentage.
     */
    public function getAvatarZoomAttribute(): int
    {
        return (int) ($this->setting('avatar_zoom', '100') ?? 100);
    }

    /**
     * Get avatar CSS background-size value ('cover' or '{zoom}%').
     */
    public function getAvatarBgSizeAttribute(): string
    {
        $zoom = $this->avatar_zoom;
        return ($zoom && $zoom !== 100) ? $zoom . '%' : 'cover';
    }

    /**
     * Get complete dynamic avatar inline CSS style.
     */
    public function getAvatarStyleAttribute(): string
    {
        return "background-image: url('{$this->avatar_url}'); background-position: {$this->avatar_pos_x}% {$this->avatar_pos_y}%; background-size: {$this->avatar_bg_size};";
    }

    /**
     * Get single letter initial uppercase.
     */
    public function getInitialAttribute(): string
    {
        return strtoupper(substr(trim($this->name ?? 'U'), 0, 1)) ?: 'U';
    }

    /**
     * Render HTML avatar element with dynamic sizing and user's saved position & zoom.
     */
    public function renderAvatar(
        string|int $size = '40px',
        string $class = 'rounded-3',
        string $id = '',
        array $attributes = [],
        bool $asSymbol = false
    ): \Illuminate\Support\HtmlString {
        if (function_exists('user_avatar')) {
            return user_avatar($this, $size, $class, $id, $attributes, $asSymbol);
        }

        $style = $this->avatar_style;
        if (is_numeric($size)) $size .= 'px';
        $sizeClass = (str_contains($size, 'w-') || str_contains($size, 'h-')) ? $size : '';
        $inlineStyle = $style . ($sizeClass ? '' : " width: {$size}; height: {$size};");
        $classes = trim("image-input-wrapper {$sizeClass} {$class}");
        $idAttr = $id ? ' id="' . htmlspecialchars($id) . '"' : '';

        return new \Illuminate\Support\HtmlString('<div class="' . htmlspecialchars($classes) . '"' . $idAttr . ' style="' . $inlineStyle . '"></div>');
    }

    /**
     * Get list of curated default stock cover backgrounds.
     *
     * @return array<int, string>
     */
    public static function getDefaultCovers(): array
    {
        return [
            'assets/img-temp/1200x800/img1.jpg',
            'assets/img-temp/1200x800/img2.jpg',
            'assets/media/stock/1600x800/img-1.jpg',
            'assets/media/stock/1600x800/img-2.jpg',
            'assets/media/stock/1600x800/img-3.jpg',
            'assets/media/stock/1600x800/img-4.jpg',
            'assets/media/stock/900x600/1.jpg',
            'assets/media/stock/900x600/3.jpg',
            'assets/media/stock/900x600/8.jpg',
            'assets/media/stock/900x600/12.jpg',
            'assets/media/stock/900x600/15.jpg',
            'assets/media/stock/900x600/17.jpg',
            'assets/media/stock/900x600/20.jpg',
            'assets/media/stock/900x600/23.jpg',
            'assets/media/stock/900x600/27.jpg',
            'assets/media/stock/900x600/33.jpg',
            'assets/media/stock/900x600/40.jpg',
            'assets/media/stock/900x600/48.jpg',
            'assets/media/stock/900x600/51.jpg',
            'assets/media/stock/900x600/59.jpg',
            'assets/media/stock/900x600/69.jpg',
            'assets/media/stock/900x600/81.jpg',
        ];
    }

    /**
     * Get default random cover background URL based on user ID / seed.
     */
    public static function getDefaultCoverUrl(int|string|null $seed = 1): string
    {
        $covers = static::getDefaultCovers();
        $intSeed = is_numeric($seed) ? (int) $seed : abs(crc32((string) ($seed ?: '1')));
        if ($intSeed <= 0) {
            $intSeed = 1;
        }

        $index = ($intSeed - 1) % count($covers);
        return asset($covers[$index]);
    }

    /**
     * Get cover background URL attribute (custom user cover or deterministic default cover).
     */
    public function getCoverBgUrlAttribute(): string
    {
        $cover = $this->setting('cover_background');
        if ($cover) {
            if (str_starts_with($cover, 'http://') || str_starts_with($cover, 'https://')) {
                return $cover;
            }
            return asset('storage/' . $cover);
        }
        return static::getDefaultCoverUrl($this->id ?? 1);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'points' => 'integer',
            'login_count' => 'integer',
            'last_login_at' => 'datetime',
            'last_point_at' => 'datetime',
        ];
    }

    /**
     * Check if user has master or admin role.
     */
    public function isMasterOrAdmin(): bool
    {
        try {
            return $this->hasAnyRole(['master', 'admin']);
        } catch (\Throwable $e) {
            return in_array($this->role ?? '', ['master', 'admin']);
        }
    }

    /**
     * Get user details (KTP & Address data).
     */
    public function detail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    /**
     * Get user custom setting record (1 User = 1 Baris).
     */
    public function settingRecord(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserSetting::class, 'user_id');
    }

    /**
     * Get user custom setting record (Alias hasOne for settings).
     */
    public function settings(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserSetting::class, 'user_id');
    }

    /**
     * Get user activity logs.
     */
    public function logs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserLog::class, 'user_id')->latest('created_at');
    }

    /**
     * Get user login history.
     */
    public function logins(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserLogin::class, 'user_id')->latest('created_at');
    }

    /**
     * Record login / lockscreen unlock session & award 1 point per 24 hours.
     */
    public function recordLogin(string $type = 'login', ?\Illuminate\Http\Request $request = null): UserLogin
    {
        $req = $request ?? request();
        $now = now();

        // Check if 24 hours have elapsed since the last point reward
        $canEarnPoint = is_null($this->last_point_at) || \Carbon\Carbon::parse($this->last_point_at)->diffInHours($now) >= 24;
        $pointEarned = 0;

        if ($canEarnPoint) {
            $this->points = (int) ($this->points ?? 0) + 1;
            $this->last_point_at = $now;
            $pointEarned = 1;
        }

        // Increment total login count & update last login time
        $this->login_count = (int) ($this->login_count ?? 0) + 1;
        $this->last_login_at = $now;
        $this->save();

        // Parse user agent
        $userAgent = $req->userAgent();
        $agentInfo = UserLogin::parseUserAgent($userAgent);

        // Create login history record
        return UserLogin::create([
            'user_id' => $this->id,
            'type' => $type, // 'login' or 'lockscreen'
            'ip_address' => $req->ip(),
            'user_agent' => $userAgent,
            'device' => $agentInfo['device'],
            'browser' => $agentInfo['browser'],
            'platform' => $agentInfo['platform'],
            'point_earned' => $pointEarned,
            'created_at' => $now,
        ]);
    }

    /**
     * Get single setting value by key.
     */
    public function setting(string $key, $default = null)
    {
        $setting = $this->settingRecord;
        return $setting ? $setting->getSetting($key, $default) : $default;
    }

    /**
     * Set / update single setting value.
     */
    public function setSetting(string $key, $value, string $group = 'general'): UserSetting
    {
        $record = $this->settingRecord ?? new UserSetting(['user_id' => $this->id]);
        $record->user_id = $this->id;
        $record->setSetting($key, $value, $group);
        $record->save();

        $this->setRelation('settingRecord', $record);
        $this->setRelation('settings', $record);

        return $record;
    }
}
