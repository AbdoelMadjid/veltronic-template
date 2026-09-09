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
            $currentRoute = trim(request()->path(), '/');
        }
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
                        if (isset($item['route']) && ($item['route'] === $currentRoute || trim((string)$item['route'], '/') === $currentRoute)) {
                            if (!empty($item['title_key'])) {
                                $transKey = 'menu.' . $item['title_key'];
                                if (__($transKey) !== $transKey) {
                                    return __($transKey);
                                }
                            }
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
                $path = trim(request()->path(), '/');
                $normalizedDot = str_replace(['/', '\\'], '.', trim($currentRoute, '/'));
                $normalizedSlash = str_replace(['.', '\\'], '/', trim($currentRoute, '/'));
                $normalizedPathDot = str_replace(['/', '\\'], '.', $path);
                $normalizedPathSlash = str_replace(['.', '\\'], '/', $path);

                $menuRow = \App\Models\Menu::where(function ($q) use ($currentRoute, $normalizedDot, $normalizedSlash, $path, $normalizedPathDot, $normalizedPathSlash) {
                    $q->where('url', $currentRoute)
                        ->orWhere('url', $normalizedDot)
                        ->orWhere('url', $normalizedSlash)
                        ->orWhere('url', '/' . $normalizedSlash)
                        ->orWhere('url', $path)
                        ->orWhere('url', $normalizedPathDot)
                        ->orWhere('url', $normalizedPathSlash)
                        ->orWhere('url', '/' . $normalizedPathSlash);
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

if (!function_exists('translateMenuTitleSafely')) {
    /**
     * Menerjemahkan string title atau kunci menu secara aman (menolak return bernilai array).
     *
     * @param string|null $key
     * @return string|null
     */
    function translateMenuTitleSafely(?string $key): ?string
    {
        if ($key === null) {
            return null;
        }
        $key = trim($key);
        if ($key === '' || in_array(strtolower($key), ['menu', 'auth', 'pagination', 'validation', 'passwords'], true)) {
            return null;
        }

        // Cek langsung jika itu translation key lengkap
        $res = __($key);
        if (is_string($res) && $res !== $key) {
            return $res;
        }

        // Cek dengan prefix 'menu.'
        if (!str_starts_with($key, 'menu.')) {
            $resMenu = __('menu.' . $key);
            if (is_string($resMenu) && $resMenu !== 'menu.' . $key) {
                return $resMenu;
            }

            $slug = strtolower(str_replace([' ', '&', '/', '-'], ['_', 'and', '_', '_'], $key));
            $resSlug = __('menu.' . $slug);
            if (is_string($resSlug) && $resSlug !== 'menu.' . $slug) {
                return $resSlug;
            }
        }

        return null;
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
                    $trans = translateMenuTitleSafely('menu.' . $item['title_key']);
                    if ($trans !== null) {
                        return $trans;
                    }
                }

                $title = $item['title'] ?? $item['name'] ?? null;
                if ($title) {
                    return translateMenuTitleSafely($title) ?? $title;
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

if (!function_exists('searchMenuBreadcrumbTrail')) {
    /**
     * Mencari jejak breadcrumb leluhur (ancestor trail) secara rekursif tanpa mengikutsertakan judul halaman aktif.
     *
     * @param array $items
     * @param string $currentRoute
     * @param array $currentTrail
     * @return array|null
     */
    function searchMenuBreadcrumbTrail(array $items, string $currentRoute, array $currentTrail = []): ?array
    {
        $normalizedCurrent = str_replace(['/', '\\'], '.', trim($currentRoute, '/'));
        $baseCurrent = preg_replace('/\.index$/', '', $normalizedCurrent);

        foreach ($items as $item) {
            $itemRoute = isset($item['route']) ? str_replace(['/', '\\'], '.', trim((string) $item['route'], '/')) : null;
            $itemRouteBase = $itemRoute ? preg_replace('/\.index$/', '', $itemRoute) : null;

            $isMatch = $itemRoute !== null && (
                $itemRoute === $normalizedCurrent ||
                $itemRoute === $baseCurrent ||
                $itemRouteBase === $baseCurrent ||
                ($item['route'] ?? '') === $currentRoute ||
                ($item['route'] ?? '') === $baseCurrent
            );

            if ($isMatch) {
                // Ditemukan halaman target! Kembalikan jejak leluhur saja (tanpa judul menu ini)
                return $currentTrail;
            }

            // Dapatkan label terjemahan item saat ini untuk dijadikan leluhur bagi anak-anaknya
            $itemTitleKey = $item['title_key'] ?? null;
            $itemLabel = null;
            if ($itemTitleKey) {
                $itemLabel = translateMenuTitleSafely('menu.' . $itemTitleKey);
            }
            if (!$itemLabel) {
                $rawTitle = $item['title'] ?? $item['name'] ?? '';
                $itemLabel = translateMenuTitleSafely($rawTitle) ?? $rawTitle;
            }

            $nextTrail = array_merge($currentTrail, [$itemLabel]);

            if (!empty($item['children']) && is_array($item['children'])) {
                $found = searchMenuBreadcrumbTrail($item['children'], $currentRoute, $nextTrail);
                if ($found !== null) {
                    return $found;
                }
            }

            if (!empty($item['children_collapsed']) && is_array($item['children_collapsed'])) {
                $found = searchMenuBreadcrumbTrail($item['children_collapsed'], $currentRoute, $nextTrail);
                if ($found !== null) {
                    return $found;
                }
            }
        }

        return null;
    }
}

if (!function_exists('getPageBreadcrumbs')) {
    /**
     * Menghasilkan array breadcrumbs hierarkis secara otomatis berdasarkan rute aktif (Leluhur Menu & Kategori),
     * tanpa menduplikasi judul halaman aktif di ujung breadcrumb.
     *
     * @param string|null $currentRoute
     * @return array
     */
    function getPageBreadcrumbs(?string $currentRoute = null): array
    {
        if (empty($currentRoute)) {
            $currentRoute = Route::current() ? Route::current()->getName() : '';
        }
        if (empty($currentRoute)) {
            $currentRoute = trim(request()->path(), '/');
        }
        if (empty($currentRoute) || $currentRoute === 'dashboard') {
            return [];
        }

        // 1. Cek dari konfigurasi menu_seeder dinamis
        $customCategories = config('menu_seeder.categories', []);
        foreach ($customCategories as $categoryName => $categoryConfig) {
            $catTitleKey = $categoryConfig['title_key'] ?? null;
            $catLabel = null;
            if ($catTitleKey) {
                $catLabel = translateMenuTitleSafely('menu.' . $catTitleKey);
            }
            if (!$catLabel) {
                $rawCat = $categoryConfig['title'] ?? $categoryName;
                $catLabel = translateMenuTitleSafely($rawCat) ?? $rawCat;
            }

            $menus = $categoryConfig['menus'] ?? [];
            if (!empty($menus) && is_array($menus)) {
                $trail = searchMenuBreadcrumbTrail($menus, $currentRoute);
                if ($trail !== null) {
                    array_unshift($trail, $catLabel);
                    return array_values(array_filter($trail));
                }
            }
        }

        // 2. Cek dari database Menu
        try {
            if (class_exists(\App\Models\Menu::class) && \Illuminate\Support\Facades\Schema::hasTable('menus')) {
                $path = trim(request()->path(), '/');
                $normalizedDot = str_replace(['/', '\\'], '.', trim($currentRoute, '/'));
                $normalizedSlash = str_replace(['.', '\\'], '/', trim($currentRoute, '/'));
                $normalizedPathDot = str_replace(['/', '\\'], '.', $path);
                $normalizedPathSlash = str_replace(['.', '\\'], '/', $path);

                $menuRow = \App\Models\Menu::where(function ($q) use ($currentRoute, $normalizedDot, $normalizedSlash, $path, $normalizedPathDot, $normalizedPathSlash) {
                    $q->where('url', $currentRoute)
                        ->orWhere('url', $normalizedDot)
                        ->orWhere('url', $normalizedSlash)
                        ->orWhere('url', '/' . $normalizedSlash)
                        ->orWhere('url', $path)
                        ->orWhere('url', $normalizedPathDot)
                        ->orWhere('url', $normalizedPathSlash)
                        ->orWhere('url', '/' . $normalizedPathSlash);
                })->first();

                if ($menuRow) {
                    $trail = [];
                    $curr = $menuRow->parentMenu;
                    while ($curr) {
                        $meta = is_array($curr->meta) ? $curr->meta : [];
                        $lbl = null;
                        if (!empty($meta['title_key'])) {
                            $lbl = translateMenuTitleSafely('menu.' . $meta['title_key']);
                        }
                        if (!$lbl) {
                            $lbl = translateMenuTitleSafely($curr->name) ?? $curr->name;
                        }
                        array_unshift($trail, $lbl);
                        $curr = $curr->parentMenu;
                    }
                    if (!empty($menuRow->category)) {
                        $cat = $menuRow->category;
                        $catLabel = translateMenuTitleSafely($cat) ?? $cat;
                        array_unshift($trail, $catLabel);
                    }
                    return array_values(array_filter($trail));
                }
            }
        } catch (\Throwable $e) {
            // Silently fallback
        }

        // 3. Cek dari konfigurasi statis sidebar
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

        foreach ($configs as $config => $menuKeys) {
            $configData = config($config, []);
            foreach ($menuKeys as $key) {
                $menus = isset($configData[$key]) && is_array($configData[$key]) ? $configData[$key] : [];
                if (!empty($menus)) {
                    $trail = searchMenuBreadcrumbTrail($menus, $currentRoute);
                    if ($trail !== null) {
                        return array_values(array_filter($trail));
                    }
                }
            }
        }

        // 4. Fallback segment URL tanpa segment terakhir (halaman aktif)
        $segments = request()->segments();
        $breadcrumbSegments = count($segments) > 1 ? array_slice($segments, 0, -1) : [];
        $trail = [];
        foreach ($breadcrumbSegments as $segment) {
            $decoded = urldecode($segment);
            $clean = str_replace(['-', '_'], ' ', $decoded);
            $clean = preg_replace('/([a-zA-Z])([0-9])/', '$1 $2', $clean);
            $trail[] = translateMenuTitleSafely($clean) ?? ucwords(trim((string) $clean));
        }

        return array_values(array_filter($trail));
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

