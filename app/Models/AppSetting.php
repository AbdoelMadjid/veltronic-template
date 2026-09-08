<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AppSetting extends Model
{
    use HasFactory;

    protected $table = 'app_settings';

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'description',
    ];

    const CACHE_KEY = 'app_settings_map';

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget(self::CACHE_KEY);
        });

        static::deleted(function () {
            Cache::forget(self::CACHE_KEY);
        });
    }

    /**
     * Get a setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        try {
            $settings = Cache::rememberForever(self::CACHE_KEY, function () {
                return self::query()->pluck('value', 'key')->toArray();
            });

            return $settings[$key] ?? $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Set/Update a setting value.
     *
     * @param string $key
     * @param mixed $value
     * @param string $group
     * @param string $type
     * @return self
     */
    public static function set(string $key, $value, string $group = 'general', string $type = 'string')
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_array($value) ? json_encode($value) : (string) $value,
                'group' => $group,
                'type' => $type,
            ]
        );

        Cache::forget(self::CACHE_KEY);

        return $setting;
    }
}
