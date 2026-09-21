<?php

namespace App\Http\Controllers\AppSupport;

use App\Http\Controllers\Controller;
use App\Models\AppSupport\AppSetting;
use App\Models\Profil\UserLog;
use App\Support\EducationPageConfig;
use App\Support\Frontpage;
use App\Support\LandingPageConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ThemeFrontpageController extends Controller
{
    /**
     * Display the Theme Frontpage Management Page.
     */
    public function index()
    {
        $currentFrontpage = Frontpage::current();
        $defaultFrontpage = Frontpage::default();
        $availableFrontpages = Frontpage::all();

        $landingVersions = Frontpage::availableLandingVersions();
        $currentLandingVersion = Frontpage::currentLandingVersion();

        $config = LandingPageConfig::get();
        $menuItems = LandingPageConfig::getMenuItems();
        $sections = LandingPageConfig::getSections();
        $socialLinks = LandingPageConfig::getSocialLinks();
        $footerLinks = LandingPageConfig::getFooterLinks();

        // Education Portal Config & Pages
        $educationConfig = EducationPageConfig::get();
        $educationPages = EducationPageConfig::getPages();

        // Diagnostics & stats
        $activeSectionsCount = count(array_filter($sections, fn($s) => !empty($s['is_active'])));
        $activeMenusCount = count(array_filter($menuItems, fn($m) => !empty($m['is_active'])));

        $stats = [
            'current_frontpage' => $currentFrontpage,
            'default_frontpage' => $defaultFrontpage,
            'landing_version' => $currentLandingVersion,
            'total_landing_versions' => count($landingVersions),
            'total_menus' => count($menuItems),
            'active_menus' => $activeMenusCount,
            'total_sections' => count($sections),
            'active_sections' => $activeSectionsCount,
            'social_links_count' => count($socialLinks),
            'footer_groups_count' => count($footerLinks),
            'total_edu_pages' => count($educationPages),
        ];

        return view('pages.appsupport.theme-frontpage', compact(
            'currentFrontpage',
            'defaultFrontpage',
            'availableFrontpages',
            'landingVersions',
            'currentLandingVersion',
            'config',
            'menuItems',
            'sections',
            'socialLinks',
            'footerLinks',
            'stats',
            'educationConfig',
            'educationPages'
        ));
    }

    /**
     * Switch Active Frontpage Theme (Landing vs Education).
     */
    public function switchTheme(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'frontpage' => 'required|string|in:' . implode(',', Frontpage::available()),
        ]);

        $theme = $validated['frontpage'];
        session(['frontpage' => $theme]);
        \Illuminate\Support\Facades\Cookie::queue('frontpage', $theme, 525600);
        AppSetting::set('default_frontpage', $theme, 'appearance');

        Frontpage::clearCache();

        $themeLabel = match ($theme) {
            'landing' => 'Landing Page (Marketing & Corporate)',
            'education' => 'Education Portal (Academic Multipage)',
            default => ucfirst($theme),
        };

        $this->logActivity(
            'Ganti Tema Halaman Depan',
            'Mengubah tema default halaman depan menjadi: ' . $themeLabel,
            'success'
        );

        return response()->json([
            'success' => true,
            'status' => 'success',
            'frontpage' => $theme,
            'message' => 'Tema halaman depan berhasil diubah menjadi ' . $themeLabel . '.',
        ]);
    }

    /**
     * Switch Active Landing Page Version (e.g. v1, v2).
     */
    public function switchLandingVersion(Request $request): JsonResponse
    {
        $available = Frontpage::availableLandingVersions();
        $validated = $request->validate([
            'version' => 'required|string|in:' . implode(',', $available),
        ]);

        $version = $validated['version'];
        session(['landing_version' => $version]);
        AppSetting::set('landing_version', $version, 'landing');

        Frontpage::clearCache();

        $this->logActivity(
            'Ganti Versi Landing Page',
            'Mengubah versi landing page aktif menjadi: ' . strtoupper($version),
            'success'
        );

        return response()->json([
            'success' => true,
            'status' => 'success',
            'version' => $version,
            'message' => 'Versi tata letak landing page berhasil diubah ke ' . strtoupper($version) . '.',
        ]);
    }

    /**
     * Update Hero & Branding Information for Landing Page.
     */
    public function updateHero(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'landing_page_title' => 'required|string|max:200',
            'landing_meta_description' => 'nullable|string|max:500',
            'landing_meta_keywords' => 'nullable|string|max:500',
            'landing_hero_badge' => 'nullable|string|max:100',
            'landing_hero_title' => 'required|string|max:200',
            'landing_hero_with' => 'nullable|string|max:50',
            'landing_hero_highlight' => 'nullable|string|max:200',
            'landing_hero_cta_text' => 'required|string|max:100',
            'landing_hero_cta_url' => 'required|string|max:255',
            'landing_hero_cta2_text' => 'nullable|string|max:100',
            'landing_hero_cta2_url' => 'nullable|string|max:255',
            'landing_show_clients' => 'nullable|boolean',
        ]);

        $validated['landing_show_clients'] = $request->boolean('landing_show_clients') ? '1' : '0';

        foreach ($validated as $key => $value) {
            AppSetting::set($key, (string) ($value ?? ''), 'landing', 'string');
        }

        LandingPageConfig::clearCache();

        $this->logActivity(
            'Ubah Hero & Branding Landing Page',
            'Memperbarui teks hero banner dan informasi branding landing page',
            'success'
        );

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Pengaturan Hero Banner & Branding Landing Page berhasil disimpan.',
            'data' => $validated,
        ]);
    }

    /**
     * Update Landing Page Logo Assets.
     */
    public function updateLogo(Request $request): JsonResponse
    {
        $request->validate([
            'landing_logo_light_file' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'landing_logo_dark_file' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'landing_favicon_file' => 'nullable|file|mimes:png,ico,svg,webp|max:256',
            'landing_logo_light_url' => 'nullable|string|max:500',
            'landing_logo_dark_url' => 'nullable|string|max:500',
            'landing_favicon_url' => 'nullable|string|max:500',
        ]);

        $uploadDir = public_path('assets/logo');
        if (!File::isDirectory($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true, true);
        }

        $saved = [];

        // 1. Logo Light
        if ($request->hasFile('landing_logo_light_file')) {
            $file = $request->file('landing_logo_light_file');
            $filename = 'landing-logo-light.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('landing_logo_light', $path, 'landing');
            $saved['landing_logo_light'] = asset($path);
        } elseif ($request->filled('landing_logo_light_url')) {
            AppSetting::set('landing_logo_light', $request->input('landing_logo_light_url'), 'landing');
            $saved['landing_logo_light'] = $request->input('landing_logo_light_url');
        }

        // 2. Logo Dark / Sticky
        if ($request->hasFile('landing_logo_dark_file')) {
            $file = $request->file('landing_logo_dark_file');
            $filename = 'landing-logo-dark.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('landing_logo_dark', $path, 'landing');
            $saved['landing_logo_dark'] = asset($path);
        } elseif ($request->filled('landing_logo_dark_url')) {
            AppSetting::set('landing_logo_dark', $request->input('landing_logo_dark_url'), 'landing');
            $saved['landing_logo_dark'] = $request->input('landing_logo_dark_url');
        }

        // 3. Favicon
        if ($request->hasFile('landing_favicon_file')) {
            $file = $request->file('landing_favicon_file');
            $filename = 'landing-favicon.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('landing_favicon', $path, 'landing');
            $saved['landing_favicon'] = asset($path);
        } elseif ($request->filled('landing_favicon_url')) {
            AppSetting::set('landing_favicon', $request->input('landing_favicon_url'), 'landing');
            $saved['landing_favicon'] = $request->input('landing_favicon_url');
        }

        LandingPageConfig::clearCache();

        $this->logActivity(
            'Ubah Logo Landing Page',
            'Memperbarui logo terang/gelap dan favicon landing page',
            'success'
        );

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Aset logo & favicon Landing Page berhasil diperbarui.',
            'data' => $saved,
        ]);
    }

    /**
     * Reset Landing Page Logo to Theme Defaults.
     */
    public function resetLogo(Request $request): JsonResponse
    {
        $type = $request->input('type', 'all');

        if ($type === 'light' || $type === 'all') {
            AppSetting::set('landing_logo_light', 'media/logos/landing.svg', 'landing');
        }
        if ($type === 'dark' || $type === 'all') {
            AppSetting::set('landing_logo_dark', 'media/logos/landing-dark.svg', 'landing');
        }
        if ($type === 'favicon' || $type === 'all') {
            AppSetting::set('landing_favicon', 'media/logos/favicon.ico', 'landing');
        }

        LandingPageConfig::clearCache();

        $this->logActivity('Reset Logo Landing', 'Mereset aset logo landing ke bawaan template', 'info');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Logo Landing Page berhasil dikembalikan ke standar tema bawaan.',
        ]);
    }

    /**
     * Save/Update Navigation Menu Item with Anchor Target.
     */
    public function saveMenu(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'menu_id' => 'nullable|string|max:50',
            'title' => 'required|string|max:100',
            'title_en' => 'nullable|string|max:100',
            'target' => 'required|string|max:200',
            'order' => 'nullable|integer|min:1',
            'is_active' => 'nullable|boolean',
            'is_external' => 'nullable|boolean',
        ]);

        $menuItems = LandingPageConfig::getMenuItems();
        $menuId = $validated['menu_id'] ?? null;
        $isActive = $request->boolean('is_active', true);
        $isExternal = $request->boolean('is_external', false);

        if (!empty($menuId)) {
            // Update existing
            $found = false;
            foreach ($menuItems as &$item) {
                if (($item['id'] ?? '') === $menuId) {
                    $item['title'] = $validated['title'];
                    $item['title_en'] = $validated['title_en'] ?? $validated['title'];
                    $item['target'] = $validated['target'];
                    if (isset($validated['order'])) {
                        $item['order'] = (int) $validated['order'];
                    }
                    $item['is_active'] = $isActive;
                    $item['is_external'] = $isExternal;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $menuItems[] = [
                    'id' => $menuId,
                    'title' => $validated['title'],
                    'title_en' => $validated['title_en'] ?? $validated['title'],
                    'target' => $validated['target'],
                    'order' => $validated['order'] ?? (count($menuItems) + 1),
                    'is_active' => $isActive,
                    'is_external' => $isExternal,
                ];
            }
        } else {
            // Create new
            $newId = 'menu-' . Str::slug($validated['title']) . '-' . rand(100, 999);
            $menuItems[] = [
                'id' => $newId,
                'title' => $validated['title'],
                'title_en' => $validated['title_en'] ?? $validated['title'],
                'target' => $validated['target'],
                'order' => $validated['order'] ?? (count($menuItems) + 1),
                'is_active' => $isActive,
                'is_external' => $isExternal,
            ];
        }

        usort($menuItems, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        AppSetting::set('landing_menu_items', json_encode($menuItems), 'landing', 'json');
        LandingPageConfig::clearCache();

        $this->logActivity('Simpan Menu Landing', 'Menyimpan menu navigasi: ' . $validated['title'], 'success');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Item menu navigasi landing page berhasil disimpan.',
            'items' => $menuItems,
        ]);
    }

    /**
     * Reorder Navigation Menu Items.
     */
    public function reorderMenu(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|string',
            'orders.*.order' => 'required|integer|min:1',
        ]);

        $menuItems = LandingPageConfig::getMenuItems();
        $orderMap = collect($validated['orders'])->pluck('order', 'id')->toArray();

        foreach ($menuItems as &$item) {
            $id = $item['id'] ?? '';
            if (isset($orderMap[$id])) {
                $item['order'] = (int) $orderMap[$id];
            }
        }

        usort($menuItems, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        AppSetting::set('landing_menu_items', json_encode($menuItems), 'landing', 'json');
        LandingPageConfig::clearCache();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Urutan menu navigasi berhasil diperbarui.',
            'items' => $menuItems,
        ]);
    }

    /**
     * Toggle Menu Item Active Status.
     */
    public function toggleMenu(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|string',
        ]);

        $menuItems = LandingPageConfig::getMenuItems();
        $targetId = $validated['id'];
        $newStatus = false;

        foreach ($menuItems as &$item) {
            if (($item['id'] ?? '') === $targetId) {
                $item['is_active'] = !($item['is_active'] ?? true);
                $newStatus = $item['is_active'];
                break;
            }
        }

        AppSetting::set('landing_menu_items', json_encode($menuItems), 'landing', 'json');
        LandingPageConfig::clearCache();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'is_active' => $newStatus,
            'message' => 'Status menu navigasi berhasil diubah menjadi ' . ($newStatus ? 'Aktif' : 'Nonaktif') . '.',
        ]);
    }

    /**
     * Delete Navigation Menu Item.
     */
    public function deleteMenu(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|string',
        ]);

        $menuItems = LandingPageConfig::getMenuItems();
        $menuItems = array_values(array_filter($menuItems, fn($m) => ($m['id'] ?? '') !== $validated['id']));

        // Reindex order
        $i = 1;
        foreach ($menuItems as &$item) {
            $item['order'] = $i++;
        }

        AppSetting::set('landing_menu_items', json_encode($menuItems), 'landing', 'json');
        LandingPageConfig::clearCache();

        $this->logActivity('Hapus Menu Landing', 'Menghapus item menu navigasi ' . $validated['id'], 'warning');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Item menu navigasi berhasil dihapus.',
            'items' => $menuItems,
        ]);
    }

    /**
     * Reset Navigation Menu Items to Default.
     */
    public function resetMenu(): JsonResponse
    {
        $defaults = LandingPageConfig::defaultMenuItems();
        AppSetting::set('landing_menu_items', json_encode($defaults), 'landing', 'json');
        LandingPageConfig::clearCache();

        $this->logActivity('Reset Menu Landing', 'Mereset menu navigasi landing page ke default', 'info');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Menu navigasi landing page berhasil dikembalikan ke standar awal.',
            'items' => $defaults,
        ]);
    }

    /**
     * Save/Update Content Section (Predefined or Custom Section).
     */
    public function saveSection(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'section_id' => 'nullable|string|max:50',
            'anchor' => 'required|string|max:100',
            'name' => 'required|string|max:150',
            'title' => 'required|string|max:200',
            'subtitle' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'order' => 'nullable|integer|min:1',
            'is_active' => 'nullable|boolean',
            'is_custom' => 'nullable|boolean',
            'content_html' => 'nullable|string',
        ]);

        $sections = LandingPageConfig::getSections();
        $sectionId = $validated['section_id'] ?? null;
        $anchor = Str::slug($validated['anchor']);
        $isActive = $request->boolean('is_active', true);
        $isCustom = $request->boolean('is_custom', false);

        if (!empty($sectionId)) {
            // Update existing section
            $found = false;
            foreach ($sections as &$sec) {
                if (($sec['id'] ?? '') === $sectionId) {
                    $sec['anchor'] = $anchor;
                    $sec['name'] = $validated['name'];
                    $sec['title'] = $validated['title'];
                    $sec['subtitle'] = $validated['subtitle'] ?? '';
                    $sec['icon'] = $validated['icon'] ?? ($sec['icon'] ?? 'ki-element-11');
                    $sec['badge'] = $validated['badge'] ?? '';
                    if (isset($validated['order'])) {
                        $sec['order'] = (int) $validated['order'];
                    }
                    $sec['is_active'] = $isActive;
                    if (isset($validated['content_html'])) {
                        $sec['content_html'] = $validated['content_html'];
                    }
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $sections[] = [
                    'id' => $sectionId,
                    'anchor' => $anchor,
                    'name' => $validated['name'],
                    'title' => $validated['title'],
                    'subtitle' => $validated['subtitle'] ?? '',
                    'icon' => $validated['icon'] ?? 'ki-element-11',
                    'badge' => $validated['badge'] ?? '',
                    'order' => $validated['order'] ?? (count($sections) + 1),
                    'is_active' => $isActive,
                    'is_custom' => $isCustom,
                    'content_html' => $validated['content_html'] ?? '',
                ];
            }
        } else {
            // Create new custom section
            $newId = 'section-custom-' . $anchor . '-' . rand(100, 999);
            $sections[] = [
                'id' => $newId,
                'anchor' => $anchor,
                'name' => $validated['name'],
                'title' => $validated['title'],
                'subtitle' => $validated['subtitle'] ?? '',
                'icon' => $validated['icon'] ?? 'ki-element-plus',
                'badge' => $validated['badge'] ?? 'Custom',
                'order' => $validated['order'] ?? (count($sections) + 1),
                'is_active' => $isActive,
                'is_custom' => true,
                'content_html' => $validated['content_html'] ?? '',
            ];
        }

        usort($sections, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        AppSetting::set('landing_sections', json_encode($sections), 'landing', 'json');
        LandingPageConfig::clearCache();

        $this->logActivity('Simpan Section Landing', 'Menyimpan konfigurasi section: ' . $validated['name'], 'success');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Konfigurasi section konten landing page berhasil disimpan.',
            'sections' => $sections,
        ]);
    }

    /**
     * Toggle Section Active Status.
     */
    public function toggleSection(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|string',
        ]);

        $sections = LandingPageConfig::getSections();
        $targetId = $validated['id'];
        $newStatus = false;

        foreach ($sections as &$sec) {
            if (($sec['id'] ?? '') === $targetId) {
                $sec['is_active'] = !($sec['is_active'] ?? true);
                $newStatus = $sec['is_active'];
                break;
            }
        }

        AppSetting::set('landing_sections', json_encode($sections), 'landing', 'json');
        LandingPageConfig::clearCache();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'is_active' => $newStatus,
            'message' => 'Status section berhasil diubah menjadi ' . ($newStatus ? 'Aktif' : 'Nonaktif') . '.',
        ]);
    }

    /**
     * Reorder Content Sections.
     */
    public function reorderSections(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|string',
            'orders.*.order' => 'required|integer|min:1',
        ]);

        $sections = LandingPageConfig::getSections();
        $orderMap = collect($validated['orders'])->pluck('order', 'id')->toArray();

        foreach ($sections as &$sec) {
            $id = $sec['id'] ?? '';
            if (isset($orderMap[$id])) {
                $sec['order'] = (int) $orderMap[$id];
            }
        }

        usort($sections, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        AppSetting::set('landing_sections', json_encode($sections), 'landing', 'json');
        LandingPageConfig::clearCache();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Urutan susunan section landing page berhasil diperbarui.',
            'sections' => $sections,
        ]);
    }

    /**
     * Delete Custom Section.
     */
    public function deleteSection(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|string',
        ]);

        $sections = LandingPageConfig::getSections();
        $sections = array_values(array_filter($sections, fn($s) => ($s['id'] ?? '') !== $validated['id']));

        // Reindex order
        $i = 1;
        foreach ($sections as &$sec) {
            $sec['order'] = $i++;
        }

        AppSetting::set('landing_sections', json_encode($sections), 'landing', 'json');
        LandingPageConfig::clearCache();

        $this->logActivity('Hapus Section Landing', 'Menghapus section ' . $validated['id'], 'warning');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Section konten berhasil dihapus.',
            'sections' => $sections,
        ]);
    }

    /**
     * Reset Sections to Default.
     */
    public function resetSections(): JsonResponse
    {
        $defaults = LandingPageConfig::defaultSections();
        AppSetting::set('landing_sections', json_encode($defaults), 'landing', 'json');
        LandingPageConfig::clearCache();

        $this->logActivity('Reset Section Landing', 'Mereset daftar section landing ke konfigurasi standar', 'info');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Daftar section landing page berhasil dikembalikan ke pengaturan standar.',
            'sections' => $defaults,
        ]);
    }

    /**
     * Update Footer & Contact & Social Information for Landing Page.
     */
    public function updateFooter(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'landing_footer_about' => 'nullable|string|max:500',
            'landing_footer_copyright' => 'nullable|string|max:200',
            'landing_footer_email' => 'nullable|email|max:150',
            'landing_footer_phone' => 'nullable|string|max:50',
            'landing_footer_address' => 'nullable|string|max:300',
            'landing_social_links' => 'nullable|string',
            'landing_footer_links' => 'nullable|string',
        ]);

        foreach (['landing_footer_about', 'landing_footer_copyright', 'landing_footer_email', 'landing_footer_phone', 'landing_footer_address'] as $field) {
            if (isset($validated[$field])) {
                AppSetting::set($field, (string) $validated[$field], 'landing');
            }
        }

        if ($request->filled('landing_social_links')) {
            $decodedSocial = json_decode($request->input('landing_social_links'), true);
            if (is_array($decodedSocial)) {
                AppSetting::set('landing_social_links', json_encode($decodedSocial), 'landing', 'json');
            }
        }

        if ($request->filled('landing_footer_links')) {
            $decodedFooter = json_decode($request->input('landing_footer_links'), true);
            if (is_array($decodedFooter)) {
                AppSetting::set('landing_footer_links', json_encode($decodedFooter), 'landing', 'json');
            }
        }

        LandingPageConfig::clearCache();

        $this->logActivity('Ubah Footer Landing', 'Memperbarui data footer, kontak, dan link sosial media landing', 'success');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Pengaturan Footer, Kontak & Tautan Sosial Media berhasil disimpan.',
        ]);
    }

    /**
     * Update Education Portal Information & Branding.
     */
    public function updateEducationInfo(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'education_portal_title' => 'required|string|max:200',
            'education_portal_tagline' => 'nullable|string|max:255',
            'education_portal_description' => 'nullable|string|max:500',
            'education_meta_keywords' => 'nullable|string|max:500',
            'education_badge' => 'nullable|string|max:100',
            'education_hero_title' => 'nullable|string|max:200',
            'education_hero_subtitle' => 'nullable|string|max:500',
            'education_hero_cta_text' => 'nullable|string|max:100',
            'education_hero_cta_url' => 'nullable|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            AppSetting::set($key, (string) ($value ?? ''), 'education', 'string');
        }

        EducationPageConfig::clearCache();

        $this->logActivity(
            'Ubah Info Portal Education',
            'Memperbarui informasi umum dan identitas portal education',
            'success'
        );

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Informasi & Identitas Education Portal berhasil disimpan.',
            'data' => $validated,
        ]);
    }

    /**
     * Update Education Portal Logo Assets.
     */
    public function updateEducationLogo(Request $request): JsonResponse
    {
        $request->validate([
            'education_logo_light_file' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'education_logo_dark_file' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'education_favicon_file' => 'nullable|file|mimes:png,ico,svg,webp|max:256',
            'education_logo_light_url' => 'nullable|string|max:500',
            'education_logo_dark_url' => 'nullable|string|max:500',
            'education_favicon_url' => 'nullable|string|max:500',
        ]);

        $uploadDir = public_path('assets/logo');
        if (!File::isDirectory($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true, true);
        }

        $saved = [];

        // 1. Logo Light
        if ($request->hasFile('education_logo_light_file')) {
            $file = $request->file('education_logo_light_file');
            $filename = 'education-logo-light.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('education_logo_light', $path, 'education');
            $saved['education_logo_light'] = asset($path);
        } elseif ($request->filled('education_logo_light_url')) {
            AppSetting::set('education_logo_light', $request->input('education_logo_light_url'), 'education');
            $saved['education_logo_light'] = $request->input('education_logo_light_url');
        }

        // 2. Logo Dark / Mini
        if ($request->hasFile('education_logo_dark_file')) {
            $file = $request->file('education_logo_dark_file');
            $filename = 'education-logo-dark.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('education_logo_dark', $path, 'education');
            $saved['education_logo_dark'] = asset($path);
        } elseif ($request->filled('education_logo_dark_url')) {
            AppSetting::set('education_logo_dark', $request->input('education_logo_dark_url'), 'education');
            $saved['education_logo_dark'] = $request->input('education_logo_dark_url');
        }

        // 3. Favicon
        if ($request->hasFile('education_favicon_file')) {
            $file = $request->file('education_favicon_file');
            $filename = 'education-favicon.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('education_favicon', $path, 'education');
            $saved['education_favicon'] = asset($path);
        } elseif ($request->filled('education_favicon_url')) {
            AppSetting::set('education_favicon', $request->input('education_favicon_url'), 'education');
            $saved['education_favicon'] = $request->input('education_favicon_url');
        }

        EducationPageConfig::clearCache();

        $this->logActivity(
            'Ubah Logo Education Portal',
            'Memperbarui logo dan favicon Education Portal',
            'success'
        );

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Aset logo & favicon Education Portal berhasil diperbarui.',
            'data' => $saved,
        ]);
    }

    /**
     * Reset Education Portal Logo to Theme Defaults.
     */
    public function resetEducationLogo(Request $request): JsonResponse
    {
        $type = $request->input('type', 'all');

        if ($type === 'light' || $type === 'all') {
            AppSetting::set('education_logo_light', 'assets/img/logo/logo.png', 'education');
        }
        if ($type === 'dark' || $type === 'all') {
            AppSetting::set('education_logo_dark', 'assets/img/logo/logo-mini.png', 'education');
        }
        if ($type === 'favicon' || $type === 'all') {
            AppSetting::set('education_favicon', 'assets/img/logo/logo-mini.png', 'education');
        }

        EducationPageConfig::clearCache();

        $this->logActivity('Reset Logo Education', 'Mereset logo education ke bawaan template', 'info');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Logo Education Portal berhasil dikembalikan ke standar tema bawaan.',
        ]);
    }

    /**
     * Update Education Topbar & Navigation Preferences.
     */
    public function updateEducationNav(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'education_topbar_apply_text' => 'required|string|max:100',
            'education_topbar_apply_url' => 'required|string|max:255',
            'education_topbar_show_lang' => 'nullable|boolean',
            'education_topbar_show_jump_to' => 'nullable|boolean',
            'education_topbar_show_search' => 'nullable|boolean',
        ]);

        $validated['education_topbar_show_lang'] = $request->boolean('education_topbar_show_lang') ? '1' : '0';
        $validated['education_topbar_show_jump_to'] = $request->boolean('education_topbar_show_jump_to') ? '1' : '0';
        $validated['education_topbar_show_search'] = $request->boolean('education_topbar_show_search') ? '1' : '0';

        foreach ($validated as $key => $value) {
            AppSetting::set($key, (string) ($value ?? ''), 'education', 'string');
        }

        EducationPageConfig::clearCache();

        $this->logActivity(
            'Ubah Navigasi Education Portal',
            'Memperbarui preferensi topbar dan navigasi portal education',
            'success'
        );

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Pengaturan Topbar & Navigasi Education Portal berhasil disimpan.',
            'data' => $validated,
        ]);
    }

    /**
     * Update Education Footer, Contact & Social Media.
     */
    public function updateEducationFooter(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'education_footer_about' => 'nullable|string|max:1000',
            'education_footer_copyright' => 'nullable|string|max:255',
            'education_footer_email' => 'nullable|email|max:150',
            'education_footer_phone' => 'nullable|string|max:50',
            'education_footer_address' => 'nullable|string|max:255',
            'education_social_facebook' => 'nullable|url|max:255',
            'education_social_twitter' => 'nullable|url|max:255',
            'education_social_instagram' => 'nullable|url|max:255',
            'education_social_youtube' => 'nullable|url|max:255',
            'education_social_linkedin' => 'nullable|url|max:255',
        ]);

        foreach ($validated as $key => $val) {
            AppSetting::set($key, (string) ($val ?? ''), 'education', 'string');
        }

        EducationPageConfig::clearCache();

        $this->logActivity(
            'Ubah Footer Education Portal',
            'Memperbarui data footer, kontak, dan tautan sosial media education portal',
            'success'
        );

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Pengaturan Footer & Kontak Education Portal berhasil disimpan.',
        ]);
    }

    /**
     * Clear Cache for Theme Frontpage.
     */
    public function clearCache(): JsonResponse
    {
        EducationPageConfig::clearCache();
        LandingPageConfig::clearCache();
        Frontpage::clearCache();
        AppSetting::clearCache();

        $this->logActivity('Bersihkan Cache Frontpage', 'Membersihkan seluruh cache konfigurasi tema frontpage', 'info');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Seluruh cache preferensi tema dan halaman depan berhasil disegarkan.',
        ]);
    }

    /**
     * Reset All Theme Settings to Defaults.
     */
    public function resetAll(): JsonResponse
    {
        $defaults = LandingPageConfig::defaults();
        foreach ($defaults as $key => $val) {
            AppSetting::set($key, (string) $val, 'landing');
        }

        $eduDefaults = EducationPageConfig::defaults();
        foreach ($eduDefaults as $key => $val) {
            AppSetting::set($key, (string) $val, 'education');
        }

        AppSetting::set('landing_version', 'v1', 'landing');
        AppSetting::set('default_frontpage', 'landing', 'appearance');

        EducationPageConfig::clearCache();
        LandingPageConfig::clearCache();
        Frontpage::clearCache();
        AppSetting::clearCache();

        $this->logActivity('Reset Total Tema Frontpage', 'Mengembalikan seluruh konfigurasi frontpage (landing & education) ke kondisi default', 'warning');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Seluruh pengaturan tema Landing Page dan Education Portal berhasil dikembalikan ke standar awal pabrikan.',
        ]);
    }

    /**
     * Helper to resolve section blade file path.
     */
    protected function resolveSectionFile(string $version, string $sectionId, ?array $matched = null): array
    {
        $safeId = preg_replace('/[^a-zA-Z0-9_\-]/', '', $sectionId);
        $cleanId = Str::replaceFirst('section-', '', $safeId);
        $anchor = !empty($matched['anchor']) ? preg_replace('/[^a-zA-Z0-9_\-]/', '', $matched['anchor']) : '';

        $dir = resource_path("views/frontpages/landing/{$version}/sections");
        $relDir = "resources/views/frontpages/landing/{$version}/sections";

        // Candidate file names
        $candidates = array_unique(array_filter([$safeId, $cleanId, $anchor]));

        foreach ($candidates as $name) {
            $path = $dir . DIRECTORY_SEPARATOR . "{$name}.blade.php";
            if (File::exists($path)) {
                return [
                    'full_path' => $path,
                    'rel_path' => "{$relDir}/{$name}.blade.php",
                    'file_name' => "{$name}.blade.php",
                    'exists' => true,
                ];
            }
        }

        // Default write target if file doesn't exist yet
        $targetName = !empty($cleanId) ? $cleanId : $safeId;
        return [
            'full_path' => $dir . DIRECTORY_SEPARATOR . "{$targetName}.blade.php",
            'rel_path' => "{$relDir}/{$targetName}.blade.php",
            'file_name' => "{$targetName}.blade.php",
            'exists' => false,
        ];
    }

    /**
     * Get section source code (Blade / HTML) for GUI editing.
     */
    public function getSectionCode(Request $request): JsonResponse
    {
        $sectionId = trim((string) $request->input('section_id', ''));
        $version = trim((string) $request->input('version', Frontpage::currentLandingVersion()));
        $version = preg_replace('/[^a-zA-Z0-9_\-]/', '', $version) ?: 'v1';

        if (empty($sectionId)) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'ID seksi tidak valid.',
            ], 422);
        }

        $sections = LandingPageConfig::getSections();
        $matched = null;
        foreach ($sections as $s) {
            if (($s['id'] ?? '') === $sectionId || ($s['anchor'] ?? '') === $sectionId || Str::replaceFirst('section-', '', $s['id'] ?? '') === $sectionId) {
                $matched = $s;
                break;
            }
        }

        $isCustom = !empty($matched['is_custom']);
        $sectionName = $matched['name'] ?? ucfirst(str_replace(['section-', '-'], ['', ' '], $sectionId));

        $fileInfo = $this->resolveSectionFile($version, $sectionId, $matched);

        $code = '';
        $filePath = $fileInfo['rel_path'];

        if ($isCustom) {
            $code = $matched['content_html'] ?? '';
            $filePath = "Database AppSetting (Custom Section HTML)";
        } else {
            if ($fileInfo['exists']) {
                $code = File::get($fileInfo['full_path']);
            } else {
                $code = "<!-- Section: {$sectionName} -->\n<div class=\"py-10\">\n    <div class=\"container\">\n        <h3>{$sectionName}</h3>\n    </div>\n</div>";
            }
        }

        return response()->json([
            'success' => true,
            'status' => 'success',
            'section_id' => $sectionId,
            'section_name' => $sectionName,
            'is_custom' => $isCustom,
            'version' => $version,
            'file_path' => $filePath,
            'code' => $code,
        ]);
    }

    /**
     * Save section source code (Blade / HTML) from GUI editor.
     */
    public function saveSectionCode(Request $request): JsonResponse
    {
        $sectionId = trim((string) $request->input('section_id', ''));
        $version = trim((string) $request->input('version', Frontpage::currentLandingVersion()));
        $version = preg_replace('/[^a-zA-Z0-9_\-]/', '', $version) ?: 'v1';
        $code = (string) $request->input('code', '');

        if (empty($sectionId)) {
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'ID seksi tidak valid.',
            ], 422);
        }

        $sections = LandingPageConfig::getSections();
        $matchedIndex = null;
        foreach ($sections as $idx => $s) {
            if (($s['id'] ?? '') === $sectionId || ($s['anchor'] ?? '') === $sectionId || Str::replaceFirst('section-', '', $s['id'] ?? '') === $sectionId) {
                $matchedIndex = $idx;
                break;
            }
        }

        $matched = $matchedIndex !== null ? $sections[$matchedIndex] : null;

        if ($matchedIndex !== null && !empty($sections[$matchedIndex]['is_custom'])) {
            // Update custom section HTML in database
            $sections[$matchedIndex]['content_html'] = $code;
            AppSetting::set('landing_sections', json_encode(array_values($sections)), 'landing');
        } else {
            // Save to blade partial file
            $fileInfo = $this->resolveSectionFile($version, $sectionId, $matched);
            $dir = dirname($fileInfo['full_path']);
            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true, true);
            }
            File::put($fileInfo['full_path'], $code);
        }

        LandingPageConfig::clearCache();

        $this->logActivity('Ubah Script Seksi', "Memperbarui kode Blade/HTML untuk section: {$sectionId} (Versi {$version})", 'info');

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => "Script seksi '{$sectionId}' berhasil diperbarui.",
        ]);
    }

    /**
     * Reset section source code to factory default.
     */
    public function resetSectionCode(Request $request): JsonResponse
    {
        $sectionId = trim((string) $request->input('section_id', ''));
        LandingPageConfig::clearCache();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => "Script seksi '{$sectionId}' telah disegarkan.",
        ]);
    }

    /**
     * Internal helper to record user activity logs.
     */
    protected function logActivity(string $activity, string $description, string $level = 'info'): void
    {
        if (class_exists(UserLog::class)) {
            UserLog::record(
                module: 'appsupport',
                menu: 'theme-frontpage',
                activity: $activity,
                description: $description,
                user: auth()->user(),
                level: $level
            );
        }
    }
}
