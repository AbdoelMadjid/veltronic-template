<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('translateMenuTitleSafely')) {
    /**
     * Menerjemahkan string title atau kunci menu secara aman dan bilingual.
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

        // 1. Tangani string majemuk dengan garis miring (contoh: "Widgets / Cards" atau "Widgets/Cards")
        if (str_contains($key, '/')) {
            $parts = array_map('trim', explode('/', $key));
            $translatedParts = [];
            foreach ($parts as $part) {
                if ($part !== '') {
                    $transPart = translateMenuTitleSafely($part);
                    $translatedParts[] = $transPart ?? $part;
                }
            }
            if (!empty($translatedParts)) {
                return implode(' / ', $translatedParts);
            }
        }

        $locale = app()->getLocale();

        // 2. Cek langsung jika itu translation key lengkap
        $res = __($key);
        if (is_string($res) && $res !== $key) {
            return $res;
        }

        // 3. Cek dengan prefix 'menu.'
        if (!str_starts_with($key, 'menu.')) {
            $resMenu = __('menu.' . $key);
            if (is_string($resMenu) && $resMenu !== 'menu.' . $key) {
                return $resMenu;
            }

            $slug = strtolower(preg_replace('/[\s\/\-_&]+/', '_', $key));
            $resSlug = __('menu.' . $slug);
            if (is_string($resSlug) && $resSlug !== 'menu.' . $slug) {
                return $resSlug;
            }
        }

        // 4. Cek TextMap bidirectional dari LanguageManager (id <-> en)
        try {
            if (class_exists(\App\Support\LanguageManager::class)) {
                $payload = \App\Support\LanguageManager::getClientPayload();
                $textMap = $payload['textMap'] ?? [];

                if ($locale === 'en') {
                    $map = $textMap['id_to_en'] ?? [];
                    $lowerMap = $textMap['lower_id_to_en'] ?? [];
                } else {
                    $map = $textMap['en_to_id'] ?? [];
                    $lowerMap = $textMap['lower_en_to_id'] ?? [];
                }

                if (isset($map[$key])) {
                    return $map[$key];
                }

                $norm = preg_replace('/\s+/', ' ', $key);
                if (isset($map[$norm])) {
                    return $map[$norm];
                }

                $lower = strtolower($norm);
                if (isset($lowerMap[$lower])) {
                    return $lowerMap[$lower];
                }

                $cleanKey = str_replace('_', ' ', $lower);
                if (isset($lowerMap[$cleanKey])) {
                    return $lowerMap[$cleanKey];
                }
            }
        } catch (\Throwable $e) {
            // fallback if LanguageManager encounters issue
        }

        // 5. Fallback kamus dasar umum untuk menjamin bilingualitas saat key tidak ditemukan
        $fallbackMap = [
            'id' => [
                'dashboards' => 'Dasbor',
                'pages' => 'Halaman',
                'apps' => 'Aplikasi',
                'layouts' => 'Tata Letak',
                'help' => 'Bantuan',
                'demo' => 'Demo Widget',
                'widgets_demos' => 'Demo Widget',
                'widgets' => 'Widget',
                'cards' => 'Kartu',
                'calendar' => 'Kalender',
                'charts' => 'Grafik',
                'engage' => 'Engage',
                'feeds' => 'Feed',
                'forms' => 'Formulir',
                'general' => 'Umum',
                'lists' => 'Daftar',
                'maps' => 'Peta',
                'misc' => 'Lain-lain',
                'mixed' => 'Campuran',
                'player' => 'Pemutar',
                'sliders' => 'Slider',
                'social' => 'Sosial',
                'statistics' => 'Statistik',
                'tables' => 'Tabel',
                'tiles' => 'Tile',
                'timeline' => 'Linimasa',
                'video' => 'Video',
                'utilities' => 'Utilitas',
                'wizards' => 'Wizard',
                'search' => 'Pencarian',
                'account' => 'Akun',
                'overview' => 'Ringkasan',
                'settings' => 'Pengaturan',
                'security' => 'Keamanan',
                'activity' => 'Aktivitas',
                'billing' => 'Tagihan',
                'statements' => 'Laporan',
                'referrals' => 'Referral',
                'api_keys' => 'Kunci API',
                'logs' => 'Log Aktivitas',
                'projects' => 'Proyek',
                'campaigns' => 'Kampanye',
                'documents' => 'Dokumen',
                'followers' => 'Pengikut',
                'user_profile' => 'Profil Pengguna',
                'corporate' => 'Perusahaan',
                'careers' => 'Karir',
                'faq' => 'FAQ',
                'blog' => 'Blog',
                'pricing' => 'Harga',
                'documentation' => 'Dokumentasi',
                'home' => 'Beranda',
                'dashboard' => 'Dasbor',
                'homepage' => 'Beranda',
            ],
            'en' => [
                'dasbor' => 'Dashboards',
                'halaman' => 'Pages',
                'aplikasi' => 'Apps',
                'tata_letak' => 'Layouts',
                'bantuan' => 'Help',
                'demo_widget' => 'Widgets Demos',
                'widget' => 'Widgets',
                'kartu' => 'Cards',
                'kalender' => 'Calendar',
                'grafik' => 'Charts',
                'formulir' => 'Forms',
                'umum' => 'General',
                'daftar' => 'Lists',
                'peta' => 'Maps',
                'lain_lain' => 'Misc',
                'campuran' => 'Mixed',
                'pemutar' => 'Player',
                'slider' => 'Sliders',
                'sosial' => 'Social',
                'statistik' => 'Statistics',
                'tabel' => 'Tables',
                'linimasa' => 'Timeline',
                'utilitas' => 'Utilities',
                'pencarian' => 'Search',
                'akun' => 'Account',
                'ringkasan' => 'Overview',
                'pengaturan' => 'Settings',
                'keamanan' => 'Security',
                'aktivitas' => 'Activity',
                'tagihan' => 'Billing',
                'laporan' => 'Statements',
                'kunci_api' => 'API Keys',
                'log_aktivitas' => 'Logs',
                'proyek' => 'Projects',
                'kampanye' => 'Campaigns',
                'dokumen' => 'Documents',
                'pengikut' => 'Followers',
                'profil_pengguna' => 'User Profile',
                'perusahaan' => 'Corporate',
                'karir' => 'Careers',
                'harga' => 'Pricing',
                'dokumentasi' => 'Documentation',
                'beranda' => 'Home',
                'dashboards' => 'Dashboards',
                'pages' => 'Pages',
                'apps' => 'Apps',
                'layouts' => 'Layouts',
                'help' => 'Help',
                'demo' => 'Widgets Demos',
                'widgets' => 'Widgets',
                'cards' => 'Cards',
                'calendar' => 'Calendar',
                'charts' => 'Charts',
                'engage' => 'Engage',
                'feeds' => 'Feeds',
                'forms' => 'Forms',
                'general' => 'General',
                'lists' => 'Lists',
                'maps' => 'Maps',
                'misc' => 'Misc',
                'mixed' => 'Mixed',
                'player' => 'Player',
                'sliders' => 'Sliders',
                'social' => 'Social',
                'statistics' => 'Statistics',
                'tables' => 'Tables',
                'tiles' => 'Tiles',
                'timeline' => 'Timeline',
                'video' => 'Video',
                'utilities' => 'Utilities',
                'wizards' => 'Wizards',
                'search' => 'Search',
                'account' => 'Account',
                'overview' => 'Overview',
                'settings' => 'Settings',
                'security' => 'Security',
                'activity' => 'Activity',
                'billing' => 'Billing',
                'statements' => 'Statements',
                'referrals' => 'Referrals',
                'api_keys' => 'API Keys',
                'logs' => 'Logs',
                'projects' => 'Projects',
                'campaigns' => 'Campaigns',
                'documents' => 'Documents',
                'followers' => 'Followers',
                'user_profile' => 'User Profile',
                'corporate' => 'Corporate',
                'careers' => 'Careers',
                'faq' => 'FAQ',
                'blog' => 'Blog',
                'pricing' => 'Pricing',
                'documentation' => 'Documentation',
                'home' => 'Home',
                'dashboard' => 'Dashboard',
            ]
        ];

        $cleanSlug = strtolower(preg_replace('/[\s\/\-_&]+/', '_', $key));
        if (isset($fallbackMap[$locale][$cleanSlug])) {
            return $fallbackMap[$locale][$cleanSlug];
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
     * membedakan sumber Database Menu dan Config Menu, tanpa menduplikasi judul halaman aktif di ujung breadcrumb.
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

        // =========================================================================
        // SUMBER 1: Database Menu (Tabel 'menus' dengan relasi parentMenu & category)
        // =========================================================================
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
            // Silently fallback to config sources
        }

        // =========================================================================
        // SUMBER 2: Dynamic Config Menu (config/menu_seeder.php)
        // =========================================================================
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

        // =========================================================================
        // SUMBER 3: Static Config Menus (config/sidebar/*, config/header/*, config/docs/*)
        // =========================================================================
        $staticConfigGroups = [
            [
                'group' => 'menu.dashboards',
                'configs' => [
                    'sidebar._sidebar_dashboard' => ['menus_dashboard', 'menus_dashboard_collapsed'],
                    'header._header_dashboard' => ['header_dashboard_other', 'header_dashboard_card'],
                ],
            ],
            [
                'group' => 'menu.demo',
                'configs' => [
                    'sidebar._sidebar_demo' => ['menu_demos'],
                    'header._header_demo' => ['demo_menus', 'menu_demos'],
                ],
            ],
            [
                'group' => 'menu.pages',
                'configs' => [
                    'sidebar._sidebar_pages' => ['pages_menus'],
                    'header._header_pages' => [
                        'user_profile' => 'menu.user_profile',
                        'corporate' => 'menu.corporate',
                        'careers' => 'menu.careers',
                        'faq' => 'menu.faq',
                        'blog' => 'menu.blog',
                        'pricing' => 'menu.pricing',
                        'social' => 'menu.social',
                        'account_col1' => 'menu.account',
                        'account_col2' => 'menu.account',
                        'search_modal' => 'menu.search',
                        'search' => 'menu.search',
                        'wizards' => 'menu.wizards',
                        'widgets' => 'menu.widgets',
                    ],
                ],
            ],
            [
                'group' => 'menu.apps',
                'configs' => [
                    'sidebar._sidebar_apps' => ['apps_menus'],
                    'header._header_apps' => ['apps_menus'],
                ],
            ],
            [
                'group' => 'menu.layouts',
                'configs' => [
                    'sidebar._sidebar_layouts' => ['layout_menus'],
                    'header._header_layouts' => ['layout_menus', 'header_layouts_left', 'header_layouts_right', 'header_layouts_columns'],
                ],
            ],
            [
                'group' => 'menu.help',
                'configs' => [
                    'sidebar._sidebar_helps' => ['help_menus'],
                    'header._header_help' => ['help_menus'],
                ],
            ],
            [
                'group' => 'menu.documentation',
                'configs' => [
                    'docs._getting' => ['menus_getting'],
                    'docs._base' => ['menus_base'],
                    'docs._forms' => ['menus_forms'],
                    'docs._editor' => ['menus_editor'],
                    'docs._charts' => ['menus_charts'],
                    'docs._general' => ['menus_general'],
                    'docs._icons' => ['menus_icons'],
                ],
            ],
        ];

        foreach ($staticConfigGroups as $groupInfo) {
            $rootLabel = translateMenuTitleSafely($groupInfo['group']) ?? $groupInfo['group'];

            foreach ($groupInfo['configs'] as $configFile => $keyDefinitions) {
                $configData = config($configFile, []);
                if (empty($configData)) {
                    continue;
                }

                if (is_array($keyDefinitions) && array_is_list($keyDefinitions)) {
                    foreach ($keyDefinitions as $key) {
                        $menus = isset($configData[$key]) && is_array($configData[$key]) ? $configData[$key] : [];
                        if (!empty($menus)) {
                            $trail = searchMenuBreadcrumbTrail($menus, $currentRoute);
                            if ($trail !== null) {
                                array_unshift($trail, $rootLabel);
                                return array_values(array_filter($trail));
                            }
                        }
                    }
                } elseif (is_array($keyDefinitions)) {
                    // Associative mapping of sub-sections (e.g. in _header_pages)
                    foreach ($keyDefinitions as $sectionKey => $sectionTitleKey) {
                        $menus = isset($configData[$sectionKey]) && is_array($configData[$sectionKey]) ? $configData[$sectionKey] : [];
                        if (!empty($menus)) {
                            $sectionLabel = translateMenuTitleSafely($sectionTitleKey) ?? $sectionTitleKey;
                            $trail = searchMenuBreadcrumbTrail($menus, $currentRoute);
                            if ($trail !== null) {
                                array_unshift($trail, $sectionLabel);
                                array_unshift($trail, $rootLabel);
                                return array_values(array_filter($trail));
                            }
                        }
                    }
                }
            }
        }

        // =========================================================================
        // SUMBER 4: Fallback URL Segments (Penerjemahan Otomatis Segmen URL)
        // =========================================================================
        $segments = request()->segments();
        $breadcrumbSegments = count($segments) > 1 ? array_slice($segments, 0, -1) : [];
        $trail = [];
        foreach ($breadcrumbSegments as $segment) {
            $decoded = urldecode($segment);
            $clean = str_replace(['-', '_'], ' ', $decoded);
            $clean = preg_replace('/([a-zA-Z])([0-9])/', '$1 $2', $clean);
            $clean = trim((string) $clean);
            $trail[] = translateMenuTitleSafely($clean) ?? ucwords($clean);
        }

        return array_values(array_filter($trail));
    }
}

if (!function_exists('getPageTitle')) {
    /**
     * Mendapatkan title berdasarkan route aktif dari Database Menu, Config Menu, atau URL.
     *
     * @return string
     */
    function getPageTitle(): string
    {
        $currentRoute = Route::current() ? Route::current()->getName() : '';
        if (empty($currentRoute)) {
            $currentRoute = trim(request()->path(), '/');
        }
        if (empty($currentRoute) || $currentRoute === 'dashboard') {
            return translateMenuTitleSafely('menu.homepage') ?? 'Dashboard';
        }

        // 1. Cek dari database Menu
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
                        $trans = translateMenuTitleSafely($key);
                        if ($trans !== null) {
                            return $trans;
                        }
                    }
                    return translateMenuTitleSafely($menuRow->name) ?? $menuRow->name;
                }
            }
        } catch (\Throwable $e) {
            // Silently fallback
        }

        // 2. Cek dari konfigurasi menu_seeder dinamis
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

        // 3. Cek dari konfigurasi statis sidebar, header, dan docs
        $configs = [
            'sidebar._sidebar_dashboard' => ['menus_dashboard', 'menus_dashboard_collapsed'],
            'header._header_dashboard' => ['header_dashboard_other', 'header_dashboard_card'],
            'sidebar._sidebar_demo' => ['menu_demos'],
            'header._header_demo' => ['demo_menus', 'menu_demos'],
            'sidebar._sidebar_pages' => ['pages_menus'],
            'header._header_pages' => ['user_profile', 'corporate', 'careers', 'faq', 'blog', 'pricing', 'social', 'account_col1', 'account_col2', 'search_modal', 'search', 'wizards', 'widgets'],
            'sidebar._sidebar_apps' => ['apps_menus'],
            'header._header_apps' => ['apps_menus'],
            'sidebar._sidebar_layouts' => ['layout_menus'],
            'header._header_layouts' => ['layout_menus', 'header_layouts_left', 'header_layouts_right', 'header_layouts_columns'],
            'sidebar._sidebar_helps' => ['help_menus'],
            'header._header_help' => ['help_menus'],
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
                    $title = searchMenuTitle($menus, $currentRoute);
                    if ($title) {
                        return $title;
                    }
                }
            }
        }

        // 4. Fallback dari segmen terakhir URL
        $segments = request()->segments();
        if (!empty($segments)) {
            $lastSegment = end($segments);
            $decoded = urldecode($lastSegment);
            $clean = str_replace(['-', '_'], ' ', $decoded);
            $clean = preg_replace('/([a-zA-Z])([0-9])/', '$1 $2', $clean);
            $clean = trim((string) $clean);
            $translated = translateMenuTitleSafely($clean);
            if ($translated !== null) {
                return $translated;
            }
            return ucwords($clean);
        }

        return config('app.name', 'Metronic v.8.3.2 - Laravel 13');
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

