<?php

namespace App\Support;

class ThemeVersion
{
    public static function default(): string
    {
        return (string) config('theme.default_version', 'v1');
    }

    public static function available(): array
    {
        $versions = config('theme.versions', [self::default()]);

        if (!is_array($versions) || $versions === []) {
            return [self::default()];
        }

        return array_values(array_unique(array_map('strval', $versions)));
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

