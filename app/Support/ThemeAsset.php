<?php

namespace App\Support;

class ThemeAsset
{
    public static function url(string $relativePath, ?string $version = null): string
    {
        $path = ltrim($relativePath, '/');
        $defaultVersion = ThemeVersion::default();
        $activeVersion = ThemeVersion::normalize($version ?? ThemeVersion::current());
        $base = ThemeVersion::assetBase($defaultVersion);

        if ($activeVersion !== $defaultVersion) {
            $versionedPath = self::versionedPath($path, $activeVersion);

            if (is_file(public_path($base.'/'.$versionedPath))) {
                return asset($base.'/'.$versionedPath);
            }
        }

        return asset($base.'/'.$path);
    }

    private static function versionedPath(string $path, string $version): string
    {
        $info = pathinfo($path);
        $dir = ($info['dirname'] ?? '.') === '.' ? '' : $info['dirname'].'/';
        $filename = $info['filename'] ?? $path;
        $ext = isset($info['extension']) ? '.'.$info['extension'] : '';

        return $dir.$filename.'-'.$version.$ext;
    }
}
