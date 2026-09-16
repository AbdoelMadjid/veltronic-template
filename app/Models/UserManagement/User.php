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
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'avatar_url',
        'cover_bg_url',
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
     * Get cover background URL attribute.
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
        return asset('assets/img-temp/1200x800/img1.jpg');
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
