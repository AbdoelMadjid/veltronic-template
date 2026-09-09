<?php

namespace App\Support;

class ThemeVersion
{
    protected static ?string $cachedDefault = null;
    protected static ?array $cachedAvailable = null;

    public static function default(): string
    {
        if (self::$cachedDefault !== null) {
            return self::$cachedDefault;
        }

        try {
            if (class_exists(\App\Models\AppSetting::class)) {
                $dbDefault = \App\Models\AppSetting::get('default_theme_version');
                if (!empty($dbDefault)) {
                    self::$cachedDefault = (string) $dbDefault;
                    return self::$cachedDefault;
                }
            }
        } catch (\Throwable $e) {
            // fallback if db/cache error
        }

        self::$cachedDefault = (string) config('theme.default_version', 'v1');
        return self::$cachedDefault;
    }

    public static function available(): array
    {
        if (self::$cachedAvailable !== null) {
            return self::$cachedAvailable;
        }

        $versions = config('theme.versions', [self::default()]);

        if (!is_array($versions) || $versions === []) {
            self::$cachedAvailable = [self::default()];
            return self::$cachedAvailable;
        }

        self::$cachedAvailable = array_values(array_unique(array_map('strval', $versions)));
        return self::$cachedAvailable;
    }

    public static function normalize(?string $version): string
    {
        $version = (string) ($version ?? '');
        $available = self::available();

        if (in_array($version, $available, true)) {
            return $version;
        }

        return self::default();
    }

    public static function current(): string
    {
        return self::normalize(session('theme_version', self::default()));
    }

    public static function resolveView(string $baseView, ?string $version = null): string
    {
        $version = self::normalize($version ?? self::current());
        $candidate = $baseView.'-'.$version;

        return view()->exists($candidate) ? $candidate : $baseView;
    }

    public static function assetBase(?string $assetPack = null): string
    {
        $assetPack = self::normalize($assetPack ?? self::current());
        $bases = config('theme.asset_bases', []);

        if (is_array($bases) && isset($bases[$assetPack])) {
            return (string) $bases[$assetPack];
        }

        $default = self::default();

        if (is_array($bases) && isset($bases[$default])) {
            return (string) $bases[$default];
        }

        return 'assets';
    }
}

