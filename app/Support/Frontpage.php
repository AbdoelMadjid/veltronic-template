<?php

namespace App\Support;

class Frontpage
{
    public static function default(): string
    {
        try {
            if (class_exists(\App\Models\AppSetting::class)) {
                $dbDefault = \App\Models\AppSetting::get('default_frontpage');
                if (!empty($dbDefault) && in_array($dbDefault, self::available(), true)) {
                    return (string) $dbDefault;
                }
            }
        } catch (\Throwable $e) {
            // fallback if db/cache error
        }

        return (string) config('frontpage.default', 'landing');
    }

    public static function all(): array
    {
        return (array) config('frontpage.pages', []);
    }

    public static function available(): array
    {
        return array_keys(self::all());
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
