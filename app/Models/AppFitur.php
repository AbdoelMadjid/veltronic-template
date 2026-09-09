<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AppFitur extends Model
{
    use HasFactory;

    protected $table = 'app_fiturs';

    protected $fillable = [
        'key',
        'name',
        'category',
        'description',
        'icon',
        'is_enabled',
        'order',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'order' => 'integer',
    ];

    const CACHE_KEY = 'app_fiturs_status_map';

    /**
     * In-memory request lifecycle cache.
     *
     * @var array<string, bool>|null
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
     * Check if a specific feature key is enabled.
     * Cached in memory and persistent cache.
     *
     * @param string $key
     * @param bool $default
     * @return bool
     */
    public static function isEnabled(string $key, bool $default = true): bool
    {
        if (self::$memoryMap !== null) {
            return array_key_exists($key, self::$memoryMap) ? (bool) self::$memoryMap[$key] : $default;
        }

        try {
            $map = Cache::rememberForever(self::CACHE_KEY, function () {
                return self::query()->pluck('is_enabled', 'key')->toArray();
            });

            self::$memoryMap = is_array($map) ? $map : [];

            if (array_key_exists($key, self::$memoryMap)) {
                return (bool) self::$memoryMap[$key];
            }
        } catch (\Throwable $e) {
            // Fallback gracefully during migrations or setup
            return $default;
        }

        return $default;
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
