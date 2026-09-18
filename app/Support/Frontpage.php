<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class Frontpage
{
    protected static ?string $cachedDefault = null;
    protected static ?array $cachedAll = null;
    protected static ?array $cachedAvailable = null;
    protected static ?array $cachedLandingVersions = null;

    public static function clearCache(): void
    {
        self::$cachedDefault = null;
        self::$cachedAll = null;
        self::$cachedAvailable = null;
        self::$cachedLandingVersions = null;
    }

    public static function default(): string
    {
        if (self::$cachedDefault !== null) {
            return self::$cachedDefault;
        }

        try {
            if (class_exists(\App\Models\AppSupport\AppSetting::class)) {
                $dbDefault = \App\Models\AppSupport\AppSetting::get('default_frontpage');
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

    /**
     * Get available landing versions dynamically from filesystem.
     *
     * @return array<string>
     */
    public static function availableLandingVersions(): array
    {
        if (self::$cachedLandingVersions !== null) {
            return self::$cachedLandingVersions;
        }

        $landingPath = resource_path('views/frontpages/landing');
        $versions = [];

        if (File::isDirectory($landingPath)) {
            $directories = File::directories($landingPath);
            foreach ($directories as $dir) {
                $versions[] = basename($dir);
            }
        }

        if (empty($versions)) {
            $versions = ['v1'];
        }

        sort($versions);
        self::$cachedLandingVersions = $versions;

        return self::$cachedLandingVersions;
    }

    /**
     * Get currently active landing version (e.g. 'v1', 'v2').
     */
    public static function currentLandingVersion(): string
    {
        $sessionVersion = session('landing_version');
        $available = self::availableLandingVersions();

        if ($sessionVersion !== null && in_array($sessionVersion, $available, true)) {
            return (string) $sessionVersion;
        }

        try {
            if (class_exists(\App\Models\AppSupport\AppSetting::class)) {
                $dbVersion = \App\Models\AppSupport\AppSetting::get('landing_version', 'v1');
                if (!empty($dbVersion) && in_array($dbVersion, $available, true)) {
                    return (string) $dbVersion;
                }
            }
        } catch (\Throwable $e) {
            // fallback
        }

        return 'v1';
    }

    public static function currentView(): string
    {
        $current = self::current();
        $pages = self::all();

        if ($current === 'landing') {
            $version = self::currentLandingVersion();
            $viewName = "frontpages.landing.{$version}.landing";
            if (view()->exists($viewName)) {
                return $viewName;
            }
            return 'frontpages.landing.v1.landing';
        }

        return $pages[$current]['view'] ?? 'frontpages.landing.v1.landing';
    }

    public static function get(string $key): ?array
    {
        $pages = self::all();

        return $pages[$key] ?? null;
    }
}
