<?php

namespace App\Models\Profil;

use App\Models\UserManagement\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Model
{
    use HasFactory;

    protected $table = 'users_settings';

    protected $fillable = [
        'user_id',
        'profile_cover',
        'preferences',
        'custom',
    ];

    protected $casts = [
        'profile_cover' => 'array',
        'preferences' => 'array',
        'custom' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Map setting key / group to corresponding JSON column.
     */
    public static function getColumnForKey(string $key, ?string $group = null): string
    {
        if ($group === 'profile_cover' || in_array($key, [
            'cover_background', 'cover_opacity', 'cover_overlay_color',
            'cover_position_y', 'cover_height', 'cover_blur'
        ])) {
            return 'profile_cover';
        }

        if ($group === 'preferences' || in_array($key, [
            'notifikasi_email', 'notifikasi_wa', 'autolock_screen',
            'bahasa_default', 'tema_default', 'dua_faktor',
            'hemat_data', 'rekap_mingguan'
        ])) {
            return 'preferences';
        }

        return 'custom';
    }

    /**
     * Get a setting value by key across JSON columns.
     */
    public function getSetting(string $key, $default = null)
    {
        $primaryCol = self::getColumnForKey($key);
        $primaryData = $this->{$primaryCol} ?? [];

        if (is_array($primaryData) && array_key_exists($key, $primaryData)) {
            return $primaryData[$key];
        }

        // Fallback check all JSON columns
        foreach (['profile_cover', 'preferences', 'custom'] as $col) {
            $data = $this->{$col} ?? [];
            if (is_array($data) && array_key_exists($key, $data)) {
                return $data[$key];
            }
        }

        return $default;
    }

    /**
     * Set a setting value by key into the appropriate JSON column.
     */
    public function setSetting(string $key, $value, ?string $group = null): void
    {
        $column = self::getColumnForKey($key, $group);
        $data = $this->{$column} ?? [];
        if (!is_array($data)) {
            $data = [];
        }

        $data[$key] = $value;
        $this->{$column} = $data;
    }

    /**
     * Get all categorized settings merged into a flat key-value array.
     */
    public function toFlatArray(): array
    {
        $custom = is_array($this->custom) ? $this->custom : [];
        $preferences = is_array($this->preferences) ? $this->preferences : [];
        $profileCover = is_array($this->profile_cover) ? $this->profile_cover : [];

        return array_merge($custom, $preferences, $profileCover);
    }
}
