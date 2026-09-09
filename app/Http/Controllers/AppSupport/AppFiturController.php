<?php

namespace App\Http\Controllers\AppSupport;

use App\Http\Controllers\Controller;
use App\Models\AppFitur;
use App\Models\AppSetting;
use Database\Seeders\AppFiturSeeder;
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

        $settings = AppSetting::all()->pluck('value', 'key')->toArray();

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

        return view('pages.appsupport.app-fiturs', compact('allFiturs', 'fitursGrouped', 'settings', 'stats'));
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

            return response()->json([
                'success' => true,
                'message' => $msg,
                'stats' => $this->getStatsSummary(),
            ]);
        }

        if ($action === 'reset_all' || $action === 'reset_category') {
            // Re-run the seeder to restore defaults
            $seeder = new AppFiturSeeder();
            $seeder->run();

            return response()->json([
                'success' => true,
                'message' => 'Pengaturan fitur berhasil dikembalikan ke kondisi default!',
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

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan aplikasi berhasil disimpan ke database.',
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
