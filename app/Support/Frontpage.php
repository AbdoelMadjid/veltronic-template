<?php

namespace App\Support;

class Frontpage
{
    protected static ?string $cachedDefault = null;
    protected static ?array $cachedAll = null;
    protected static ?array $cachedAvailable = null;

    public static function default(): string
    {
        if (self::$cachedDefault !== null) {
            return self::$cachedDefault;
        }

        try {
            if (class_exists(\App\Models\AppSetting::class)) {
                $dbDefault = \App\Models\AppSetting::get('default_frontpage');
                if (!empty($dbDefault) && in_array($dbDefault, self::available(), true)) {
                    self::$cachedDefault = (string) $dbDefault;
                    return self::$cachedDefault;
                }
            }
        } catch (\Throwable $e) {
            // fallback if db/cache error
        }

        self::$cachedDefault = (string) config('frontpage.default', 'landing');
        return self::$cachedDefault;
    }

    public static function all(): array
    {
        if (self::$cachedAll === null) {
            self::$cachedAll = (array) config('frontpage.pages', []);
        }
        return self::$cachedAll;
    }

    public static function available(): array
    {
        if (self::$cachedAvailable === null) {
            self::$cachedAvailable = array_keys(self::all());
        }
        return self::$cachedAvailable;
    }

    public static function normalize(?string $key): string
    {
        $key = (string) ($key ?? '');
        $available = self::available();

        if (in_array($key, $available, true)) {
            return $key;
        }

        return self::default();
    }

    public static function current(): string
    {
        $sessionValue = session('frontpage');
        if ($sessionValue !== null && in_array($sessionValue, self::available(), true)) {
            return (string) $sessionValue;
        }

        $cookieValue = request()?->cookie('frontpage');
        if ($cookieValue !== null && in_array($cookieValue, self::available(), true)) {
            return (string) $cookieValue;
        }

        return self::default();
    }

    public static function currentView(): string
    {
        $current = self::current();
        $pages = self::all();

        return $pages[$current]['view'] ?? 'frontpages.landing.v1.landing';
    }

    public static function get(string $key): ?array
    {
        $pages = self::all();

        return $pages[$key] ?? null;
    }
}
