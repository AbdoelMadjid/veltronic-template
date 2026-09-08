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
     * Check if a specific feature key is enabled.
     * Cached forever until modified.
     *
     * @param string $key
     * @param bool $default
     * @return bool
     */
    public static function isEnabled(string $key, bool $default = true): bool
    {
        try {
            $map = Cache::rememberForever(self::CACHE_KEY, function () {
                return self::query()->pluck('is_enabled', 'key')->toArray();
            });

            if (array_key_exists($key, $map)) {
                return (bool) $map[$key];
            }
        } catch (\Throwable $e) {
            // Fallback gracefully during migrations or setup
            return $default;
        }

        return $default;
    }

    /**
     * Clear the cached features map.
     */
    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
