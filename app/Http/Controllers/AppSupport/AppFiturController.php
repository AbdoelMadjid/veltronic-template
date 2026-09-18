<?php

namespace App\Http\Controllers\AppSupport;

use App\Http\Controllers\Controller;
use App\Models\AppSupport\AppFitur;
use App\Models\AppSupport\AppSetting;
use App\Models\AppSupport\AppShortcut;
use App\Models\AppSupport\Menu;
use App\Models\Profil\UserLog;
use App\Models\UserManagement\Role;
use Carbon\Carbon;
use Database\Seeders\AppFiturSeeder;
use Database\Seeders\AppShortcutSeeder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class AppFiturController extends Controller
{
    /**
     * Display the App Fiturs & Settings Management page.
     */
    public function index()
    {
        $allFiturs = AppFitur::orderBy('order')->get();

        $fitursGrouped = [
            'topbar_tools' => $allFiturs->where('category', 'topbar_tools')->values(),
            'topbar_menus' => $allFiturs->where('category', 'topbar_menus')->values(),
            'sidebar_menus' => $allFiturs->where('category', 'sidebar_menus')->values(),
        ];

        $dbSettings = AppSetting::all()->pluck('value', 'key')->toArray();
        $settings = array_merge([
            'default_icon_style' => 'duotone',
            'default_language' => 'id',
            'default_theme_version' => 'v1',
            'default_frontpage' => 'landing',
            'enable_registration' => '1',
            'session_lifetime' => '120',
        ], $dbSettings);

        $stats = [
            'total' => $allFiturs->count(),
            'active' => $allFiturs->where('is_enabled', true)->count(),
            'disabled' => $allFiturs->where('is_enabled', false)->count(),
            'topbar_tools_total' => $fitursGrouped['topbar_tools']->count(),
            'topbar_tools_active' => $fitursGrouped['topbar_tools']->where('is_enabled', true)->count(),
            'topbar_menus_total' => $fitursGrouped['topbar_menus']->count(),
            'topbar_menus_active' => $fitursGrouped['topbar_menus']->where('is_enabled', true)->count(),
            'sidebar_menus_total' => $fitursGrouped['sidebar_menus']->count(),
            'sidebar_menus_active' => $fitursGrouped['sidebar_menus']->where('is_enabled', true)->count(),
        ];

        // Shortcuts & Action Targets Catalog
        $shortcuts = AppShortcut::orderBy('order')->get();
        
        $availableRoles = [];
        try {
            $availableRoles = Role::pluck('name')->toArray();
        } catch (\Throwable $e) {
            $availableRoles = ['master', 'admin', 'operator', 'user'];
        }
        if (empty($availableRoles)) {
            $availableRoles = ['master', 'admin', 'operator', 'user'];
        }

        $menuTargets = [];
        try {
            $menuTargets = Menu::orderBy('name')->get()->map(function($m) {
                return [
                    'id' => 'menu_' . $m->id,
                    'label' => $m->name . ' (' . ($m->url ?: '-') . ')',
                    'type' => 'open_url',
                    'target' => $m->url,
                    'category' => 'navigation',
                ];
            })->values()->toArray();
        } catch (\Throwable $e) {
            $menuTargets = [];
        }

        $shortcutCategories = [
            'visibility' => [
                'name' => 'Toggle Visibilitas UI',
                'icon' => 'ki-eye',
                'color' => 'primary',
                'badge_class' => 'badge-light-primary',
                'description' => 'Menampilkan atau menyembunyikan elemen UI seperti toolbar, navbar, header, atau sidebar secara realtime dan tersimpan persisten ke basis data.',
                'targets' => [
                    ['id' => 'sys_toggle_topbar_tools', 'label' => 'Fitur & Tools di Topbar Navbar (Ctrl + Alt + T)', 'type' => 'toggle_topbar_tools', 'target' => 'topbar_tools', 'default_name' => 'Toggle Fitur & Tools di Topbar Navbar', 'default_key' => 't', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_toggle_topbar_menus', 'label' => 'Menu Utama di Topbar Header (Ctrl + Alt + H)', 'type' => 'toggle_topbar_menus', 'target' => 'topbar_menus', 'default_name' => 'Toggle Menu Utama di Topbar Header', 'default_key' => 'h', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_toggle_sidebar', 'label' => 'Menu Template di Sidebar (Ctrl + Alt + M)', 'type' => 'toggle_sidebar_menus', 'target' => 'sidebar_menus', 'default_name' => 'Toggle Menu Template di Sidebar', 'default_key' => 'm', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'custom_visibility', 'label' => '+ Target Visibilitas Kustom (Selector Elemen)', 'type' => 'visibility_toggle', 'target' => 'custom', 'default_name' => 'Toggle Visibilitas Elemen Kustom', 'default_key' => '', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                ]
            ],
            'navigation' => [
                'name' => 'Navigasi Menu & Rute',
                'icon' => 'ki-route',
                'color' => 'info',
                'badge_class' => 'badge-light-info',
                'description' => 'Membuka halaman navigasi aplikasi atau URL eksternal tertentu secara instan.',
                'targets' => array_merge($menuTargets, [
                    ['id' => 'custom_url', 'label' => '+ Tambah Rute / URL Kustom Baru...', 'type' => 'open_url', 'target' => 'custom', 'default_name' => 'Buka Halaman Kustom', 'default_key' => '', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true]
                ])
            ],
            'appearance' => [
                'name' => 'Tema, Gaya Ikon & Bahasa',
                'icon' => 'ki-color-filter',
                'color' => 'success',
                'badge_class' => 'badge-light-success',
                'description' => 'Mengubah mode tema (Dark/Light), berganti varian KeenIcons, beralih bahasa antarmuka, atau beralih versi layout aplikasi secara instan.',
                'targets' => [
                    ['id' => 'sys_theme_mode', 'label' => 'Beralih Mode Gelap / Terang (Ctrl + Alt + B)', 'type' => 'theme_mode', 'target' => 'theme_mode', 'default_name' => 'Beralih Mode Gelap & Terang', 'default_key' => 'b', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_lang_id', 'label' => 'Pilihan Bahasa: Indonesia (Ctrl + Alt + I)', 'type' => 'switch_language', 'target' => 'id', 'default_name' => 'Ganti Bahasa: Indonesia', 'default_key' => 'i', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_lang_en', 'label' => 'Pilihan Bahasa: English (Ctrl + Alt + E)', 'type' => 'switch_language', 'target' => 'en', 'default_name' => 'Ganti Bahasa: English', 'default_key' => 'e', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_version_v1', 'label' => 'Pilihan Versi: Layout Versi 1 (Ctrl + Alt + 1)', 'type' => 'switch_version', 'target' => 'v1', 'default_name' => 'Beralih ke Layout Versi 1', 'default_key' => '1', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_version_v2', 'label' => 'Pilihan Versi: Layout Versi 2 (Ctrl + Alt + 2)', 'type' => 'switch_version', 'target' => 'v2', 'default_name' => 'Beralih ke Layout Versi 2', 'default_key' => '2', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_icon_duotone', 'label' => 'Gaya Ikon: Duotone (Ctrl + Alt + D)', 'type' => 'icon_style', 'target' => 'duotone', 'default_name' => 'Gaya Ikon: Duotone', 'default_key' => 'd', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_icon_solid', 'label' => 'Gaya Ikon: Solid (Ctrl + Alt + S)', 'type' => 'icon_style', 'target' => 'solid', 'default_name' => 'Gaya Ikon: Solid', 'default_key' => 's', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_icon_outline', 'label' => 'Gaya Ikon: Outline (Ctrl + Alt + O)', 'type' => 'icon_style', 'target' => 'outline', 'default_name' => 'Gaya Ikon: Outline', 'default_key' => 'o', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                ]
            ],
            'system' => [
                'name' => 'Aksi Sistem & Keamanan',
                'icon' => 'ki-shield-tick',
                'color' => 'danger',
                'badge_class' => 'badge-light-danger',
                'description' => 'Memicu utilitas sistem seperti modal pencarian global terpusat atau kunci layar sesi saat meninggalkan workstation.',
                'targets' => [
                    ['id' => 'sys_search', 'label' => 'Pencarian Cepat Global (Ctrl + Alt + F)', 'type' => 'search', 'target' => 'global_search', 'default_name' => 'Pencarian Cepat Global (Global Search)', 'default_key' => 'f', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                    ['id' => 'sys_lock_screen', 'label' => 'Kunci Layar Pengguna / Lock Screen (Ctrl + Alt + L)', 'type' => 'lock_screen', 'target' => 'lock_screen', 'default_name' => 'Kunci Layar Pengguna (Lock Screen)', 'default_key' => 'l', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => true],
                ]
            ],
            'element' => [
                'name' => 'Klik Elemen / Drawer',
                'icon' => 'ki-cursor',
                'color' => 'warning',
                'badge_class' => 'badge-light-warning',
                'description' => 'Memicu aksi klik JavaScript pada tombol, panel samping (drawer), atau modal interaktif secara otomatis.',
                'targets' => [
                    ['id' => 'sys_chat_drawer', 'label' => 'Buka Quick Chat Drawer', 'type' => 'click_element', 'target' => '#kt_drawer_chat_toggle', 'default_name' => 'Buka Quick Chat Drawer', 'default_key' => '', 'default_ctrl' => true, 'default_shift' => true, 'default_alt' => false],
                    ['id' => 'sys_activities_drawer', 'label' => 'Buka Activities Drawer', 'type' => 'click_element', 'target' => '#kt_activities_toggle', 'default_name' => 'Buka Activities Drawer', 'default_key' => '', 'default_ctrl' => true, 'default_shift' => true, 'default_alt' => false],
                    ['id' => 'custom_element', 'label' => '+ Target Selector Elemen Kustom (#ID / .Class)', 'type' => 'click_element', 'target' => 'custom', 'default_name' => 'Klik Elemen Kustom', 'default_key' => '', 'default_ctrl' => true, 'default_shift' => false, 'default_alt' => false],
                ]
            ]
        ];

        // Flat actionTargets list for backward compatibility
        $actionTargets = [];
        foreach ($shortcutCategories as $catKey => $catData) {
            foreach ($catData['targets'] as $tgt) {
                $tgt['category'] = $catKey;
                $actionTargets[] = $tgt;
            }
        }

        $shortcutStats = [
            'total' => $shortcuts->count(),
            'active' => $shortcuts->where('is_enabled', true)->count(),
            'admin_restricted' => $shortcuts->filter(fn($s) => !empty($s->roles))->count(),
            'by_category' => [
                'visibility' => $shortcuts->filter(fn($s) => $s->category === 'visibility')->count(),
                'navigation' => $shortcuts->filter(fn($s) => $s->category === 'navigation')->count(),
                'appearance' => $shortcuts->filter(fn($s) => $s->category === 'appearance')->count(),
                'system' => $shortcuts->filter(fn($s) => $s->category === 'system')->count(),
                'element' => $shortcuts->filter(fn($s) => $s->category === 'element')->count(),
            ]
        ];

        return view('pages.appsupport.app-fiturs', compact(
            'allFiturs', 
            'fitursGrouped', 
            'settings', 
            'stats',
            'shortcuts',
            'availableRoles',
            'actionTargets',
            'shortcutCategories',
            'shortcutStats'
        ));
    }

    /**
     * Store a newly created shortcut.
     */
    public function shortcutStore(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:20',
            'action_type' => 'required|string|in:toggle_sidebar_menus,toggle_topbar_tools,toggle_topbar_menus,open_url,click_element,search,theme_mode,lock_screen,icon_style,switch_language,switch_version,custom',
            'action_target' => 'nullable|string|max:500',
            'roles' => 'nullable|array',
            'roles.*' => 'string',
            'description' => 'nullable|string|max:500',
            'is_enabled' => 'nullable|boolean',
        ]);

        $roles = $request->input('roles', []);
        if (empty($roles) || in_array('all', $roles)) {
            $roles = null; // All roles
        }

        $shortcut = AppShortcut::create([
            'name' => $request->name,
            'key' => strtolower(trim($request->key)),
            'ctrl' => $request->boolean('ctrl'),
            'alt' => $request->boolean('alt'),
            'shift' => $request->boolean('shift'),
            'meta' => $request->boolean('meta'),
            'action_type' => $request->action_type,
            'action_target' => $request->action_target,
            'roles' => $roles,
            'description' => $request->description,
            'is_enabled' => $request->boolean('is_enabled', true),
            'order' => (AppShortcut::max('order') ?? 0) + 1,
        ]);

        UserLog::record(
            'appsupport',
            'app-fiturs',
            'Tambah Pintasan Keyboard',
            "Menambahkan pintasan keyboard baru '{$shortcut->name}' ({$shortcut->formatted_combination})"
        );

        return response()->json([
            'success' => true,
            'message' => "Pintasan keyboard '{$shortcut->name}' berhasil ditambahkan.",
            'data' => $shortcut,
            'formatted_combination' => $shortcut->formatted_combination,
            'mac_combination' => $shortcut->mac_combination,
            'user_shortcuts' => AppShortcut::getActiveForCurrentUser(),
        ]);
    }

    /**
     * Show shortcut data.
     */
    public function shortcutShow(AppShortcut $appShortcut): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $appShortcut,
        ]);
    }

    /**
     * Update shortcut.
     */
    public function shortcutUpdate(Request $request, AppShortcut $appShortcut): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:20',
            'action_type' => 'required|string|in:toggle_sidebar_menus,toggle_topbar_tools,toggle_topbar_menus,open_url,click_element,search,theme_mode,lock_screen,icon_style,switch_language,switch_version,custom',
            'action_target' => 'nullable|string|max:500',
            'roles' => 'nullable|array',
            'roles.*' => 'string',
            'description' => 'nullable|string|max:500',
            'is_enabled' => 'nullable|boolean',
        ]);

        $roles = $request->input('roles', []);
        if (empty($roles) || in_array('all', $roles)) {
            $roles = null;
        }

        $appShortcut->update([
            'name' => $request->name,
            'key' => strtolower(trim($request->key)),
            'ctrl' => $request->boolean('ctrl'),
            'alt' => $request->boolean('alt'),
            'shift' => $request->boolean('shift'),
            'meta' => $request->boolean('meta'),
            'action_type' => $request->action_type,
            'action_target' => $request->action_target,
            'roles' => $roles,
            'description' => $request->description,
            'is_enabled' => $request->has('is_enabled') ? $request->boolean('is_enabled') : $appShortcut->is_enabled,
        ]);

        UserLog::record(
            'appsupport',
            'app-fiturs',
            'Perbarui Pintasan Keyboard',
            "Memperbarui konfigurasi pintasan keyboard '{$appShortcut->name}' ({$appShortcut->formatted_combination})"
        );

        return response()->json([
            'success' => true,
            'message' => "Pintasan keyboard '{$appShortcut->name}' berhasil diperbarui.",
            'data' => $appShortcut->fresh(),
            'formatted_combination' => $appShortcut->fresh()->formatted_combination,
            'mac_combination' => $appShortcut->fresh()->mac_combination,
            'user_shortcuts' => AppShortcut::getActiveForCurrentUser(),
        ]);
    }

    /**
     * Toggle shortcut active state.
     */
    public function shortcutToggle(Request $request, AppShortcut $appShortcut): JsonResponse
    {
        $appShortcut->is_enabled = !$appShortcut->is_enabled;
        $appShortcut->save();

        $statusStr = $appShortcut->is_enabled ? 'diaktifkan' : 'dinonaktifkan';
        UserLog::record(
            'appsupport',
            'app-fiturs',
            'Toggle Pintasan Keyboard',
            "Mengubah status pintasan '{$appShortcut->name}' menjadi {$statusStr}"
        );

        return response()->json([
            'success' => true,
            'message' => "Pintasan '{$appShortcut->name}' berhasil {$statusStr}.",
            'data' => $appShortcut,
            'user_shortcuts' => AppShortcut::getActiveForCurrentUser(),
        ]);
    }

    /**
     * Delete shortcut.
     */
    public function shortcutDestroy(Request $request, AppShortcut $appShortcut): JsonResponse
    {
        $name = $appShortcut->name;
        $combo = $appShortcut->formatted_combination;
        $id = $appShortcut->id;
        $appShortcut->delete();

        UserLog::record(
            'appsupport',
            'app-fiturs',
            'Hapus Pintasan Keyboard',
            "Menghapus pintasan keyboard '{$name}' ({$combo})"
        );

        return response()->json([
            'success' => true,
            'message' => "Pintasan keyboard '{$name}' berhasil dihapus.",
            'id' => $id,
            'user_shortcuts' => AppShortcut::getActiveForCurrentUser(),
        ]);
    }

    /**
     * Get active shortcuts for current user.
     */
    public function getUserShortcutsJson(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'shortcuts' => AppShortcut::getActiveForCurrentUser(),
        ]);
    }

    /**
     * AJAX Toggle single feature state.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'key' => 'required|string|exists:app_fiturs,key',
            'is_enabled' => 'required|boolean',
        ]);

        $fitur = AppFitur::where('key', $request->key)->firstOrFail();
        $fitur->is_enabled = (bool) $request->is_enabled;
        $fitur->save();

        $statusText = $fitur->is_enabled ? 'diaktifkan' : 'dinonaktifkan/disembunyikan';
        UserLog::record(
            'appsupport',
            'app-fiturs',
            'Toggle Fitur Aplikasi',
            "Mengubah status fitur '{$fitur->name}' ({$fitur->key}) menjadi {$statusText}"
        );

        return response()->json([
            'success' => true,
            'message' => $fitur->is_enabled
                ? "Fitur {$fitur->name} berhasil diaktifkan."
                : "Fitur {$fitur->name} berhasil disembunyikan.",
            'data' => [
                'key' => $fitur->key,
                'name' => $fitur->name,
                'is_enabled' => $fitur->is_enabled,
                'category' => $fitur->category,
            ],
            'stats' => $this->getStatsSummary(),
        ]);
    }

    /**
     * AJAX Bulk toggle features.
     */
    public function bulkToggle(Request $request)
    {
        $request->validate([
            'action' => 'required|string|in:enable_all,disable_all,enable_selected,disable_selected,reset_all,reset_category',
            'category' => 'nullable|string|in:all,topbar_tools,topbar_menus,sidebar_menus',
            'keys' => 'nullable|array',
            'keys.*' => 'string|exists:app_fiturs,key',
        ]);

        $action = $request->action;
        $category = $request->category ?? 'all';

        if ($action === 'enable_selected' || $action === 'disable_selected') {
            $isEnabled = ($action === 'enable_selected');
            $keys = $request->keys ?? [];

            if (!empty($keys)) {
                AppFitur::whereIn('key', $keys)->update(['is_enabled' => $isEnabled]);
                AppFitur::clearCache();
            }

            $count = count($keys);
            $msg = $isEnabled
                ? "{$count} fitur terpilih berhasil diaktifkan."
                : "{$count} fitur terpilih berhasil disembunyikan.";

            UserLog::record(
                'appsupport',
                'app-fiturs',
                'Bulk Toggle Fitur',
                "Mengubah status " . ($isEnabled ? 'aktif' : 'nonaktif') . " untuk {$count} fitur terpilih: " . implode(', ', $keys)
            );

            return response()->json([
                'success' => true,
                'message' => $msg,
                'stats' => $this->getStatsSummary(),
            ]);
        }

        if ($action === 'enable_all' || $action === 'disable_all') {
            $isEnabled = ($action === 'enable_all');
            $query = AppFitur::query();

            if ($category !== 'all') {
                $query->where('category', $category);
            }

            $query->update(['is_enabled' => $isEnabled]);
            AppFitur::clearCache();

            $msg = $isEnabled
                ? "Semua fitur " . ($category !== 'all' ? "kategori {$category}" : "") . " berhasil diaktifkan."
                : "Semua fitur " . ($category !== 'all' ? "kategori {$category}" : "") . " berhasil disembunyikan.";

            UserLog::record(
                'appsupport',
                'app-fiturs',
                'Bulk Toggle Semua Fitur',
                "Mengubah semua fitur pada kategori '{$category}' menjadi " . ($isEnabled ? 'aktif' : 'nonaktif')
            );

            return response()->json([
                'success' => true,
                'message' => $msg,
                'stats' => $this->getStatsSummary(),
            ]);
        }

        if ($action === 'reset_all' || $action === 'reset_category') {
            // Re-run the seeders to restore defaults
            $seeder = new AppFiturSeeder();
            $seeder->run();

            if ($action === 'reset_all') {
                $shortcutSeeder = new AppShortcutSeeder();
                $shortcutSeeder->run();
            }

            UserLog::record(
                'appsupport',
                'app-fiturs',
                'Reset Pengaturan Fitur & Pintasan',
                "Mengembalikan konfigurasi fitur dan pintasan keyboard aplikasi ke pengaturan bawaan (default seeder)"
            );

            return response()->json([
                'success' => true,
                'message' => 'Pengaturan fitur dan pintasan keyboard berhasil dikembalikan ke kondisi default!',
                'stats' => $this->getStatsSummary(),
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Aksi tidak valid.'], 422);
    }

    /**
     * Save application settings.
     */
    public function saveSettings(Request $request)
    {
        $data = $request->except(['_token']);

        // Handle checkbox fields that might not be present if unchecked
        if (!$request->has('enable_registration')) {
            $data['enable_registration'] = '0';
        }

        foreach ($data as $key => $value) {
            $group = 'general';
            if (in_array($key, ['default_theme_mode', 'default_icon_style', 'default_language', 'default_theme_version', 'default_frontpage', 'sidebar_default_state'])) {
                $group = 'appearance';
            } elseif (in_array($key, ['enable_registration', 'session_lifetime'])) {
                $group = 'security';
            } elseif (in_array($key, ['enable_notifications_sound'])) {
                $group = 'system';
            }

            AppSetting::set($key, $value, $group);
        }

        // Synchronize active admin session & cookies
        if (isset($data['default_theme_version'])) {
            session(['theme_version' => $data['default_theme_version']]);
        }
        if (isset($data['default_frontpage'])) {
            session(['frontpage' => $data['default_frontpage']]);
            \Illuminate\Support\Facades\Cookie::queue('frontpage', $data['default_frontpage'], 525600);
        }
        if (isset($data['default_icon_style'])) {
            session(['kt_icon_style' => $data['default_icon_style']]);
            \Illuminate\Support\Facades\Cookie::queue('kt_icon_style', $data['default_icon_style'], 525600);
        }
        if (isset($data['default_language'])) {
            session(['locale' => $data['default_language']]);
            \Illuminate\Support\Facades\Cookie::queue('kt_lang', $data['default_language'], 525600);
        }

        UserLog::record(
            'appsupport',
            'app-fiturs',
            'Simpan Pengaturan Aplikasi',
            'Memperbarui konfigurasi parameter sistem & preferensi tampilan aplikasi'
        );

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan aplikasi berhasil disimpan ke database.',
            'settings' => $data,
        ]);
    }

    /**
     * Clear application caches.
     */
    public function clearCache(Request $request)
    {
        $type = $request->input('type', 'all');

        try {
            switch ($type) {
                case 'view':
                    Artisan::call('view:clear');
                    break;
                case 'config':
                    Artisan::call('config:clear');
                    break;
                case 'route':
                    Artisan::call('route:clear');
                    break;
                case 'data':
                    Cache::flush();
                    AppFitur::clearCache();
                    break;
                case 'all':
                default:
                    Artisan::call('view:clear');
                    Artisan::call('config:clear');
                    Artisan::call('route:clear');
                    Cache::flush();
                    AppFitur::clearCache();
                    break;
            }

            UserLog::record(
                'appsupport',
                'app-fiturs',
                'Bersihkan Cache',
                "Membersihkan cache sistem aplikasi (Tipe: " . strtoupper($type) . ")"
            );

            return response()->json([
                'success' => true,
                'message' => "Cache " . strtoupper($type) . " berhasil dibersihkan & di-refresh!",
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => "Gagal membersihkan cache: " . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * AJAX DataTables endpoint for System Activity Logs.
     */
    public function activityLogs(Request $request): JsonResponse
    {
        $query = UserLog::with(['user.roles']);

        // 1. Search keyword
        $rawSearch = $request->input('search');
        $search = '';
        if (is_array($rawSearch)) {
            $search = trim($rawSearch['value'] ?? '');
        } elseif (is_string($rawSearch)) {
            $search = trim($rawSearch);
        }

        if (!empty($search)) {
            $query->searchKeyword($search);
        }

        // 2. Filter Module
        $module = $request->input('module');
        if (is_array($module)) {
            $module = $module[0] ?? '';
        }
        if (!empty($module) && $module !== 'all') {
            $query->module($module);
        }

        // 3. Filter Menu
        $menu = $request->input('menu');
        if (is_array($menu)) {
            $menu = $menu[0] ?? '';
        }
        if (!empty($menu) && $menu !== 'all') {
            $query->menu($menu);
        }

        // 4. Filter Level
        $level = $request->input('level');
        if (is_array($level)) {
            $level = $level[0] ?? '';
        }
        if (!empty($level) && $level !== 'all') {
            $query->level($level);
        }

        // 5. Filter Date Range
        $dateRange = $request->input('date_range');
        if (!empty($dateRange)) {
            if ($dateRange === 'today') {
                $query->whereDate('created_at', Carbon::today());
            } elseif ($dateRange === 'yesterday') {
                $query->whereDate('created_at', Carbon::yesterday());
            } elseif ($dateRange === 'this_week') {
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($dateRange === 'this_month') {
                $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
            } elseif (str_contains($dateRange, ' - ')) {
                $parts = explode(' - ', $dateRange);
                if (count($parts) === 2) {
                    try {
                        $start = Carbon::createFromFormat('Y-m-d', trim($parts[0]))->startOfDay();
                        $end = Carbon::createFromFormat('Y-m-d', trim($parts[1]))->endOfDay();
                        $query->whereBetween('created_at', [$start, $end]);
                    } catch (\Throwable $e) {
                        // Ignore date parse errors
                    }
                }
            }
        }

        // 6. Sorting
        if ($request->has('order') && is_array($request->input('order')) && isset($request->input('order')[0])) {
            $orderColIndex = (int) ($request->input('order')[0]['column'] ?? 6);
            $orderDir = strtolower($request->input('order')[0]['dir'] ?? 'desc') === 'asc' ? 'asc' : 'desc';

            $columnMap = [
                0 => 'id',
                1 => 'user_id',
                2 => 'module',
                3 => 'activity',
                4 => 'level',
                5 => 'ip_address',
                6 => 'created_at',
            ];

            $sortColumn = $columnMap[$orderColIndex] ?? 'created_at';
            $query->orderBy($sortColumn, $orderDir);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $start = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);
        if ($length <= 0) $length = 10;

        $totalRecords = UserLog::count();
        $filteredRecords = (clone $query)->count();

        $logs = $query->skip($start)->take($length)->get();

        $data = $logs->map(function (UserLog $log) {
            $user = $log->user;
            $avatarHtml = $user
                ? (string) $user->renderAvatar('35px', 'rounded-3 me-3')
                : '<div class="symbol symbol-35px symbol-circle bg-light-primary me-3"><span class="symbol-label text-primary fw-bold"><i class="ki-outline ki-shield-tick fs-5"></i></span></div>';

            $userName = $user ? htmlspecialchars($user->name) : '<span class="text-muted fw-semibold">Sistem / Otomatis</span>';
            $userRole = $user ? htmlspecialchars($user->roles->first()?->name ?? 'User') : 'System';

            // Module Badge Color & Label
            $moduleConfig = [
                'usermanagement' => ['label' => 'User Management', 'class' => 'badge-light-primary'],
                'appsupport' => ['label' => 'App Support', 'class' => 'badge-light-info'],
                'profil' => ['label' => 'Profil Pengguna', 'class' => 'badge-light-success'],
                'sistem' => ['label' => 'Sistem Backend', 'class' => 'badge-light-danger'],
            ];
            $modInfo = $moduleConfig[$log->module] ?? ['label' => ucfirst($log->module ?? 'Sistem'), 'class' => 'badge-light-secondary'];
            $moduleBadge = '<span class="badge ' . $modInfo['class'] . ' fw-bold px-2 py-1 fs-8">' . $modInfo['label'] . '</span>';

            // Level Badge
            $levelBadge = match ($log->level ?? 'info') {
                'error' => '<span class="badge badge-light-danger fw-bolder px-2 py-1 fs-8"><i class="ki-outline ki-cross-circle fs-8 text-danger me-1"></i> Error</span>',
                'warning' => '<span class="badge badge-light-warning fw-bolder px-2 py-1 fs-8"><i class="ki-outline ki-information fs-8 text-warning me-1"></i> Warning</span>',
                'success' => '<span class="badge badge-light-success fw-bolder px-2 py-1 fs-8"><i class="ki-outline ki-check-circle fs-8 text-success me-1"></i> Success</span>',
                default => '<span class="badge badge-light-primary fw-bolder px-2 py-1 fs-8"><i class="ki-outline ki-information-2 fs-8 text-primary me-1"></i> Info</span>',
            };

            return [
                'id' => $log->id,
                'user' => [
                    'id' => $user?->id,
                    'name' => $user?->name ?? 'Sistem / Otomatis',
                    'email' => $user?->email ?? 'system@veltronic',
                    'role' => $userRole,
                    'avatar_html' => $avatarHtml,
                ],
                'module' => $log->module ?? 'sistem',
                'module_badge' => $moduleBadge,
                'menu' => $log->menu ?? '-',
                'activity' => htmlspecialchars($log->activity ?? '-'),
                'description' => htmlspecialchars($log->description ?? '-'),
                'level' => $log->level ?? 'info',
                'level_badge' => $levelBadge,
                'ip_address' => $log->ip_address ?? '-',
                'user_agent' => $log->user_agent ?? '-',
                'created_at_formatted' => $log->created_at ? $log->created_at->translatedFormat('d M Y, H:i:s') : '-',
                'created_at_relative' => $log->created_at ? $log->created_at->diffForHumans() : '-',
            ];
        });

        // Live stats for activity logs tab
        $stats = [
            'total_logs' => $totalRecords,
            'today_logs' => UserLog::whereDate('created_at', Carbon::today())->count(),
            'error_logs' => UserLog::where('level', 'error')->count(),
            'user_management_logs' => UserLog::where('module', 'usermanagement')->count(),
            'app_support_logs' => UserLog::where('module', 'appsupport')->count(),
            'profil_logs' => UserLog::where('module', 'profil')->count(),
        ];

        return response()->json([
            'draw' => (int) $request->input('draw', 1),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
            'stats' => $stats,
        ]);
    }

    /**
     * Helper to get quick stats summary.
     */
    protected function getStatsSummary(): array
    {
        $all = AppFitur::all();
        return [
            'total' => $all->count(),
            'active' => $all->where('is_enabled', true)->count(),
            'disabled' => $all->where('is_enabled', false)->count(),
            'topbar_tools_total' => $all->where('category', 'topbar_tools')->count(),
            'topbar_tools_active' => $all->where('category', 'topbar_tools')->where('is_enabled', true)->count(),
            'topbar_menus_total' => $all->where('category', 'topbar_menus')->count(),
            'topbar_menus_active' => $all->where('category', 'topbar_menus')->where('is_enabled', true)->count(),
            'sidebar_menus_total' => $all->where('category', 'sidebar_menus')->count(),
            'sidebar_menus_active' => $all->where('category', 'sidebar_menus')->where('is_enabled', true)->count(),
        ];
    }
}

