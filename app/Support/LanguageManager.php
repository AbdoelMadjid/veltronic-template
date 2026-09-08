<?php

namespace App\Support;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class LanguageManager
{
    /**
     * Supported locales list.
     *
     * @return array<int, string>
     */
    public static function availableLocales(): array
    {
        return ['en', 'id'];
    }

    /**
     * Default locale.
     */
    public static function defaultLocale(): string
    {
        try {
            if (function_exists('config')) {
                $locale = config('app.locale', 'en');
                if (!empty($locale)) {
                    return $locale;
                }
            }
        } catch (\Throwable $e) {
            // fallback if container config not bound
        }

        return 'en';
    }

    /**
     * Get current active locale.
     */
    public static function current(): string
    {
        try {
            if (class_exists(App::class) && method_exists(App::class, 'getLocale')) {
                $locale = App::getLocale();
                if (in_array($locale, self::availableLocales(), true)) {
                    return $locale;
                }
            }

            if (class_exists(Session::class) && method_exists(Session::class, 'has') && Session::has('locale')) {
                $sessLocale = Session::get('locale');
                if (in_array($sessLocale, self::availableLocales(), true)) {
                    return $sessLocale;
                }
            }
        } catch (\Throwable $e) {
            // fallback if container not fully booted
        }

        return self::defaultLocale();
    }

    /**
     * In-memory cached payload for request lifecycle.
     */
    protected static ?array $memoryPayload = null;

    /**
     * Get all translation files merged for given or all locales.
     *
     * @param string|null $locale
     * @return array
     */
    public static function getTranslations(?string $locale = null): array
    {
        $locales = $locale ? [$locale] : self::availableLocales();
        $translations = [];

        foreach ($locales as $loc) {
            $langPath = dirname(__DIR__, 2) . '/lang/' . $loc;
            if (function_exists('app') && app()->has('path.base')) {
                try {
                    $langPath = base_path('lang/' . $loc);
                } catch (\Throwable $e) {
                    $langPath = dirname(__DIR__, 2) . '/lang/' . $loc;
                }
            }
            $translations[$loc] = [];

            if (is_dir($langPath)) {
                $files = scandir($langPath);
                foreach ($files as $fileName) {
                    if ($fileName === '.' || $fileName === '..') {
                        continue;
                    }
                    $filePath = $langPath . '/' . $fileName;
                    if (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
                        $group = pathinfo($filePath, PATHINFO_FILENAME);
                        $content = include $filePath;
                        if (is_array($content)) {
                            $translations[$loc][$group] = $content;
                        }
                    }
                }
            }
        }

        return $locale ? ($translations[$locale] ?? []) : $translations;
    }

    /**
     * Get flattened key-value pairs (e.g. 'menu.my_profile' => 'My Profile')
     * and string dictionary mappings for instant DOM translation.
     *
     * @return array
     */
    public static function getClientPayload(): array
    {
        if (self::$memoryPayload !== null) {
            return self::$memoryPayload;
        }

        try {
            if (class_exists(\Illuminate\Support\Facades\Cache::class)) {
                $cached = \Illuminate\Support\Facades\Cache::get('kt_language_client_payload');
                if (is_array($cached)) {
                    self::$memoryPayload = $cached;
                    return $cached;
                }
            }
        } catch (\Throwable $e) {
            // cache driver fallback
        }

        $all = self::getTranslations();
        $flat = [
            'en' => [],
            'id' => [],
        ];
        $textMap = [
            'en_to_id' => [],
            'id_to_en' => [],
            'lower_en_to_id' => [],
            'lower_id_to_en' => [],
        ];

        foreach (['en', 'id'] as $loc) {
            foreach ($all[$loc] ?? [] as $group => $items) {
                self::flattenGroup($flat[$loc], $group, $items);
            }
        }

        // Build direct text mappings for phrases that differ between en and id
        foreach ($flat['en'] as $key => $enText) {
            if (isset($flat['id'][$key])) {
                $idText = $flat['id'][$key];
                if (is_string($enText) && is_string($idText) && $enText !== '' && $idText !== '' && $enText !== $idText) {
                    $trimEn = trim($enText);
                    $trimId = trim($idText);
                    $normEn = preg_replace('/\s+/', ' ', $trimEn);
                    $normId = preg_replace('/\s+/', ' ', $trimId);

                    $textMap['en_to_id'][$trimEn] = $trimId;
                    $textMap['id_to_en'][$trimId] = $trimEn;
                    $textMap['en_to_id'][$normEn] = $normId;
                    $textMap['id_to_en'][$normId] = $normEn;
                    $textMap['lower_en_to_id'][strtolower($normEn)] = $normId;
                    $textMap['lower_id_to_en'][strtolower($normId)] = $normEn;
                }
            }
        }

        $payload = [
            'current' => self::current(),
            'locales' => self::availableLocales(),
            'translations' => $flat,
            'textMap' => $textMap,
        ];

        self::$memoryPayload = $payload;

        try {
            if (class_exists(\Illuminate\Support\Facades\Cache::class)) {
                \Illuminate\Support\Facades\Cache::put('kt_language_client_payload', $payload, 86400);
            }
        } catch (\Throwable $e) {
            // ignore cache write error
        }

        return $payload;
    }

    /**
     * Recursively flatten translation arrays.
     */
    protected static function flattenGroup(array &$target, string $prefix, array $items): void
    {
        foreach ($items as $key => $value) {
            $fullKey = $prefix . '.' . $key;
            if (is_array($value)) {
                self::flattenGroup($target, $fullKey, $value);
            } elseif (is_string($value) || is_numeric($value)) {
                $target[$fullKey] = (string) $value;
            }
        }
    }
}
