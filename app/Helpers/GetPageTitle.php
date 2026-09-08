<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('getPageTitle')) {
    /**
     * Mendapatkan title berdasarkan route aktif dari file konfigurasi menu.
     *
     * @return string
     */
    function getPageTitle(): string
    {
        // Daftar file config dan kunci menu masing-masing
        $configs = [
            'sidebar._sidebar_dashboard' => ['menus_dashboard', 'menus_dashboard_collapsed'],
            'sidebar._sidebar_demo' => ['menu_demos'],
            'sidebar._sidebar_pages' => ['pages_menus'],
            'sidebar._sidebar_apps' => ['apps_menus'],
            'sidebar._sidebar_layouts' => ['layout_menus'],
            'sidebar._sidebar_helps' => ['help_menus'],
            'docs._getting' => ['menus_getting'],
            'docs._base' => ['menus_base'],
            'docs._forms' => ['menus_forms'],
            'docs._editor' => ['menus_editor'],
            'docs._charts' => ['menus_charts'],
            'docs._general' => ['menus_general'],
            'docs._icons' => ['menus_icons'],
        ];

        $currentRoute = Route::current() ? Route::current()->getName() : '';
        if (empty($currentRoute)) {
            return config('app.name', 'Veltronic');
        }

        foreach ($configs as $config => $menuKeys) {
            $configData = config($config, []);

            // Cek setiap kunci menu untuk config ini
            foreach ($menuKeys as $key) {
                $menus = isset($configData[$key]) && is_array($configData[$key]) ? $configData[$key] : [];

                if (!empty($menus)) {
                    foreach ($menus as $item) {
                        // Periksa route di level utama
                        if (isset($item['route']) && $item['route'] === $currentRoute) {
                            $title = $item['title'] ?? config('app.name', 'Metronic v.8.3.2 - Laravel 12');
                            $key = 'menu.' . strtolower(str_replace([' ', '&', '/'], ['_', 'and', '_'], $title));
                            return __($key) !== $key ? __($key) : $title;
                        }

                        // Periksa children jika ada
                        if (!empty($item['children'])) {
                            $title = searchMenuTitle($item['children'], $currentRoute);
                            if ($title) {
                                return $title;
                            }
                        }
                    }
                }
            }
        }

        // Cek dari konfigurasi menu_seeder dinamis
        $customCategories = config('menu_seeder.categories', []);
        foreach ($customCategories as $categoryConfig) {
            $menus = $categoryConfig['menus'] ?? [];
            if (!empty($menus) && is_array($menus)) {
                $title = searchMenuTitle($menus, $currentRoute);
                if ($title) {
                    return $title;
                }
            }
        }

        // Cek dari database Menu jika route terdaftar di database
        try {
            if (class_exists(\App\Models\Menu::class) && \Illuminate\Support\Facades\Schema::hasTable('menus')) {
                $menuRow = \App\Models\Menu::where(function ($q) use ($currentRoute) {
                    $normalizedDot = str_replace(['/', '\\'], '.', trim($currentRoute, '/'));
                    $normalizedSlash = str_replace(['.', '\\'], '/', trim($currentRoute, '/'));
                    $q->where('url', $currentRoute)
                        ->orWhere('url', $normalizedDot)
                        ->orWhere('url', $normalizedSlash)
                        ->orWhere('url', '/' . $normalizedSlash);
                })->first();

                if ($menuRow) {
                    $meta = is_array($menuRow->meta) ? $menuRow->meta : [];
                    if (!empty($meta['title_key'])) {
                        $key = 'menu.' . $meta['title_key'];
                        if (__($key) !== $key) {
                            return __($key);
                        }
                    }
                    $titleKey = 'menu.' . strtolower(str_replace([' ', '&', '/'], ['_', 'and', '_'], $menuRow->name));
                    return __($titleKey) !== $titleKey ? __($titleKey) : $menuRow->name;
                }
            }
        } catch (\Throwable $e) {
            // Silently fallback to default app name
        }

        return config('app.name', 'Metronic v.8.3.2 - Laravel 12');
    }
}

if (!function_exists('searchMenuTitle')) {
    /**
     * Mencari title secara rekursif di dalam array menu berdasarkan route.
     *
     * @param array $items
     * @param string $currentRoute
     * @return string|null
     */
    function searchMenuTitle(array $items, string $currentRoute): ?string
    {
        $normalizedCurrent = str_replace(['/', '\\'], '.', trim($currentRoute, '/'));
        $baseCurrent = preg_replace('/\.index$/', '', $normalizedCurrent);

        foreach ($items as $item) {
            $itemRoute = isset($item['route']) ? str_replace(['/', '\\'], '.', trim((string) $item['route'], '/')) : null;
            $itemRouteBase = $itemRoute ? preg_replace('/\.index$/', '', $itemRoute) : null;

            if ($itemRoute !== null && (
                $itemRoute === $normalizedCurrent ||
                $itemRoute === $baseCurrent ||
                $itemRouteBase === $baseCurrent ||
                ($item['route'] ?? '') === $currentRoute ||
                ($item['route'] ?? '') === $baseCurrent
            )) {
                // Prioritaskan title_key untuk translasi bilingual
                if (!empty($item['title_key'])) {
                    $transKey = 'menu.' . $item['title_key'];
                    if (__($transKey) !== $transKey) {
                        return __($transKey);
                    }
                }

                $title = $item['title'] ?? null;
                if ($title) {
                    $key = 'menu.' . strtolower(str_replace([' ', '&', '/'], ['_', 'and', '_'], $title));
                    return __($key) !== $key ? __($key) : $title;
                }
                return null;
            }

            if (!empty($item['children']) && is_array($item['children'])) {
                $found = searchMenuTitle($item['children'], $currentRoute);
                if ($found) {
                    return $found;
                }
            }

            if (!empty($item['children_collapsed']) && is_array($item['children_collapsed'])) {
                $found = searchMenuTitle($item['children_collapsed'], $currentRoute);
                if ($found) {
                    return $found;
                }
            }
        }

        return null;
    }
}

if (!function_exists('app_fitur')) {
    /**
     * Cek apakah fitur aplikasi aktif berdasarkan key fitur.
     * Menggunakan cache performa tinggi dari model AppFitur.
     *
     * @param string $key
     * @param bool $default
     * @return bool
     */
    function app_fitur(string $key, bool $default = true): bool
    {
        return \App\Models\AppFitur::isEnabled($key, $default);
    }
}

if (!function_exists('app_setting')) {
    /**
     * Ambil nilai konfigurasi sistem aplikasi berdasarkan key setting.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function app_setting(string $key, $default = null)
    {
        return \App\Models\AppSetting::get($key, $default);
    }
}

