<?php

use App\Models\AppSupport\Menu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (!function_exists('menuCanReadUrl')) {
    function menuCanReadUrl(string $url): bool
    {
        if (!auth()->check() || $url === '') {
            return false;
        }

        $user = auth()->user();
        if (
            (method_exists($user, 'isMasterOrAdmin') && $user->isMasterOrAdmin()) ||
            (method_exists($user, 'hasAnyRole') && $user->hasAnyRole(['master', 'admin'])) ||
            in_array($user->role ?? '', ['master', 'admin'])
        ) {
            return true;
        }

        $keys = [$url];
        $normalizedPath = menuNormalizePath($url);
        if ($normalizedPath !== '') {
            $keys[] = $normalizedPath;
            $keys[] = menuNormalizeKey($normalizedPath);
        } else {
            $normalized = menuNormalizeKey($url);
            if ($normalized !== '') {
                $keys[] = $normalized;
                $keys[] = str_replace('.', '/', $normalized);
            }
        }

        $allKeys = [];
        foreach ($keys as $k) {
            $k = trim((string) $k, '/.');
            if ($k === '') {
                continue;
            }
            $allKeys[] = $k;
            $baseK = preg_replace('/(\.index|\/index)$/', '', $k);
            if ($baseK !== '' && $baseK !== $k) {
                $allKeys[] = $baseK;
                $allKeys[] = str_replace('.', '/', $baseK);
                $allKeys[] = str_replace('/', '.', $baseK);
            }
        }

        foreach (array_values(array_unique($allKeys)) as $key) {
            if ($user->can("read {$key}")) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('menuNormalizeKey')) {
    function menuNormalizeKey(string $value): string
    {
        $normalized = trim($value);
        $normalized = str_replace(['\\', '/'], '.', $normalized);
        $normalized = preg_replace('/\.+/', '.', $normalized) ?? $normalized;

        return trim($normalized, '.');
    }
}

if (!function_exists('menuNormalizePath')) {
    function menuNormalizePath(string $value): string
    {
        $normalized = trim($value);
        $normalized = str_replace(['\\', '.'], '/', $normalized);
        $normalized = preg_replace('#/+#', '/', $normalized) ?? $normalized;

        return trim($normalized, '/');
    }
}

if (!function_exists('sidebarAdditionalMenuSections')) {
    function sidebarAdditionalMenuSections(bool $fresh = false): array
    {
        static $cachedSections = [];

        if (!auth()->check()) {
            return [];
        }

        $cacheKey = (string) (auth()->id() ?? 'guest') . '_' . app()->getLocale();
        if (!$fresh && !app()->runningUnitTests() && isset($cachedSections[$cacheKey])) {
            return $cachedSections[$cacheKey];
        }

        // Tentukan jenis link:
        // - route Laravel jika nama route ada
        // - href eksternal jika http/https
        // - href internal (prefix "/") untuk path biasa
        $resolveMenuLink = function (string $url): array {
            $urlPath = menuNormalizePath($url);
            $routeKey = menuNormalizeKey($urlPath !== '' ? $urlPath : $url);
            if ($routeKey !== '') {
                if (Route::has($routeKey)) {
                    return ['route' => $routeKey];
                }
                if (Route::has($routeKey . '.index')) {
                    return ['route' => $routeKey . '.index'];
                }
            }

            if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
                return ['href' => $url];
            }

            if ($urlPath !== '') {
                return ['href' => '/' . $urlPath];
            }

            return ['href' => '#'];
        };

        $customOrder = array_keys(config('menu_seeder.categories', []));
        if (empty($customOrder)) {
            return [];
        }

        $rows = Menu::query()
            ->active()
            ->whereIn('category', $customOrder)
            ->orderBy('orders')
            ->get(['id', 'name', 'url', 'category', 'icon', 'paths', 'meta', 'main_menu_id', 'orders']);

        $categories = $rows->pluck('category')->filter()->unique()->values()->all();
        $preferredOrder = array_values(array_unique($customOrder));

        usort($categories, function ($a, $b) use ($preferredOrder) {
            $ai = array_search($a, $preferredOrder, true);
            $bi = array_search($b, $preferredOrder, true);
            $ai = $ai === false ? PHP_INT_MAX : $ai;
            $bi = $bi === false ? PHP_INT_MAX : $bi;

            return $ai <=> $bi ?: strcmp((string) $a, (string) $b);
        });

        $sections = [];
        foreach ($categories as $category) {
            $catLower = strtolower(trim($category));
            if ($catLower === 'pages' && !isFeatureActive('group_pages')) continue;
            if ($catLower === 'apps' && !isFeatureActive('group_apps')) continue;
            if ($catLower === 'layouts' && !isFeatureActive('group_layouts')) continue;
            if ($catLower === 'help' && !isFeatureActive('group_help')) continue;

            $categoryRows = $rows->where('category', $category)->values();
            // Bentuk adjacency list: parent_id => children.
            $childrenByParent = $categoryRows->groupBy('main_menu_id');

            $mapNode = function ($node) use (&$mapNode, $childrenByParent, $resolveMenuLink) {
                // Map node secara rekursif dan urutkan anak sesuai kolom orders.
                $childrenMapped = $childrenByParent->get($node->id, collect())
                    ->sortBy('orders')
                    ->values()
                    ->map(fn($child) => $mapNode($child))
                    ->filter()
                    ->values();

                // Leaf tanpa izin read tidak ditampilkan.
                $allowedSelf = menuCanReadUrl((string) $node->url);
                if ($childrenMapped->isEmpty() && !$allowedSelf) {
                    return null;
                }

                $meta = is_array($node->meta) ? $node->meta : [];
                $mapped = ['title' => $node->name];

                if ($node->main_menu_id === null) {
                    $mapped['icon'] = $node->icon ?: 'ki-duotone ki-element-11 fs-2';
                    $mapped['paths'] = (int) ($node->paths ?? 0);
                }

                if ($childrenMapped->isEmpty()) {
                    $mapped = array_merge($mapped, $resolveMenuLink((string) $node->url));
                } else {
                    // Anak bisa dipisah menjadi normal vs collapsed (berdasarkan meta.collapsed).
                    $children = $childrenMapped->filter(function ($child) {
                        return !((bool) (($child['__meta']['collapsed'] ?? false)));
                    })->values()->all();

                    $childrenCollapsed = $childrenMapped->filter(function ($child) {
                        return (bool) (($child['__meta']['collapsed'] ?? false));
                    })->values()->all();

                    foreach ($children as &$child) {
                        unset($child['__meta']);
                    }
                    foreach ($childrenCollapsed as &$child) {
                        unset($child['__meta']);
                    }

                    $mapped['children'] = $children;
                    if (!empty($childrenCollapsed)) {
                        $mapped['children_collapsed'] = $childrenCollapsed;
                    }
                }

                foreach (['dropdown', 'target', 'badge', 'title_key'] as $key) {
                    if (array_key_exists($key, $meta)) {
                        $mapped[$key] = $meta[$key];
                    }
                }

                $mapped['__meta'] = $meta;

                return $mapped;
            };

            $menus = $childrenByParent->get(null, collect())
                ->sortBy('orders')
                ->values()
                ->map(fn($node) => $mapNode($node))
                ->filter()
                ->values()
                ->all();

            foreach ($menus as &$menu) {
                unset($menu['__meta']);
            }

            if (empty($menus)) {
                continue;
            }

            // Label section prioritaskan title_key dari config seeder kategori.
            $categoryConfig = config("menu_seeder.categories.{$category}", []);
            $categoryTitleKey = trim((string) ($categoryConfig['title_key'] ?? ''));
            $label = null;
            if ($categoryTitleKey !== '') {
                $label = translateMenuTitleSafely('menu.' . $categoryTitleKey);
            }
            if (!$label) {
                $categorySlug = Str::of($category)->lower()->replace(' ', '_')->toString();
                $label = translateMenuTitleSafely('menu.' . $categorySlug) ?? translateMenuTitleSafely($category);
            }
            if (!$label) {
                $label = Str::headline(strtolower($category));
            }
            $sections[] = [
                'key' => $category,
                'label' => $label,
                'menus' => $menus,
            ];
        }

        $cachedSections[$cacheKey] = $sections;

        return $sections;
    }
}

if (!function_exists('sidebarMenuSections')) {
    function sidebarMenuSections(): array
    {
        // Backward-compatible alias.
        return sidebarAdditionalMenuSections();
    }
}

if (!function_exists('isFeatureActive')) {
    function isFeatureActive(string $featureKey, bool $default = true): bool
    {
        if (function_exists('app_fitur')) {
            return app_fitur($featureKey, $default);
        }

        return \App\Models\AppSupport\AppFitur::isEnabled($featureKey, $default);
    }
}

if (!function_exists('getActiveThemeMode')) {
    function getActiveThemeMode(): string
    {
        // 1. Prioritize user cookie from browser request
        $cookieMode = request()->cookie('kt_theme_mode') ?: (request()->cookie('data-bs-theme') ?: request()->cookie('data-bs-theme-mode'));
        if (!empty($cookieMode) && in_array($cookieMode, ['light', 'dark', 'system'], true)) {
            return $cookieMode;
        }

        // 2. Check session
        if (session()->has('kt_theme_mode')) {
            $sessionMode = session('kt_theme_mode');
            if (in_array($sessionMode, ['light', 'dark', 'system'], true)) {
                return $sessionMode;
            }
        }

        // 3. Check DB default setting
        try {
            if (class_exists(\App\Models\AppSupport\AppSetting::class) && \Illuminate\Support\Facades\Schema::hasTable('app_settings')) {
                $dbMode = \App\Models\AppSupport\AppSetting::get('default_theme_mode');
                if (!empty($dbMode) && in_array($dbMode, ['light', 'dark', 'system'], true)) {
                    return $dbMode;
                }
            }
        } catch (\Throwable $e) {}

        return 'light';
    }
}

if (!function_exists('getActiveIconStyle')) {
    function getActiveIconStyle(): string
    {
        // 1. Prioritize user cookie from browser request
        $cookieStyle = request()->cookie('kt_icon_style');
        if (!empty($cookieStyle) && in_array($cookieStyle, ['duotone', 'solid', 'outline'], true)) {
            return $cookieStyle;
        }

        // 2. Check session
        if (session()->has('kt_icon_style')) {
            $sessionStyle = session('kt_icon_style');
            if (in_array($sessionStyle, ['duotone', 'solid', 'outline'], true)) {
                return $sessionStyle;
            }
        }

        // 3. Check DB default setting
        try {
            if (class_exists(\App\Models\AppSupport\AppSetting::class) && \Illuminate\Support\Facades\Schema::hasTable('app_settings')) {
                $dbStyle = \App\Models\AppSupport\AppSetting::get('default_icon_style');
                if (!empty($dbStyle) && in_array($dbStyle, ['duotone', 'solid', 'outline'], true)) {
                    return $dbStyle;
                }
            }
        } catch (\Throwable $e) {}

        return 'duotone';
    }
}

if (!function_exists('formatIconClass')) {
    function formatIconClass(?string $icon): string
    {
        $icon = trim((string) $icon);
        if ($icon === '') {
            return '';
        }

        $activeStyle = getActiveIconStyle();

        if (preg_match('/\bki-(duotone|outline|solid)\b/', $icon)) {
            return (string) preg_replace('/\bki-(duotone|outline|solid)\b/', 'ki-' . $activeStyle, $icon);
        }

        if (str_starts_with($icon, 'ki-')) {
            return 'ki-' . $activeStyle . ' ' . $icon;
        }

        return $icon;
    }
}

if (!function_exists('keenicon_paths')) {
    function keenicon_paths(?string $icon, int $paths = 0): int
    {
        if ($paths > 0) {
            return $paths;
        }

        return 4;
    }
}
