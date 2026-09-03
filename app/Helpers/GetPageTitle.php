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

        $currentRoute = Route::current()->getName();

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

        foreach ($items as $item) {
            $itemRoute = isset($item['route']) ? str_replace(['/', '\\'], '.', trim((string) $item['route'], '/')) : null;

            if ($itemRoute !== null && ($itemRoute === $normalizedCurrent || ($item['route'] ?? '') === $currentRoute)) {
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
