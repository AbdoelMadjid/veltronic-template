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

    /**
     * In-memory request lifecycle cache.
     *
     * @var array<string, mixed>|null
     */
    protected static ?array $memoryMap = null;

    protected static function booted()
    {
        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
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
        if (self::$memoryMap !== null) {
            return self::$memoryMap[$key] ?? $default;
        }

        try {
            $settings = Cache::rememberForever(self::CACHE_KEY, function () {
                return self::query()->pluck('value', 'key')->toArray();
            });

            self::$memoryMap = is_array($settings) ? $settings : [];

            return self::$memoryMap[$key] ?? $default;
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

        self::clearCache();

        return $setting;
    }

    /**
     * Clear both in-memory and persistent cache.
     */
    public static function clearCache(): void
    {
        self::$memoryMap = null;
        Cache::forget(self::CACHE_KEY);
    }
}
