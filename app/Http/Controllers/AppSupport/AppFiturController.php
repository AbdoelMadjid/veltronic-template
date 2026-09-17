<?php

namespace App\Http\Controllers\AppSupport;

use App\Http\Controllers\Controller;
use App\Models\AppSupport\AppFitur;
use App\Models\AppSupport\AppSetting;
use App\Models\Profil\UserLog;
use Carbon\Carbon;
use Database\Seeders\AppFiturSeeder;
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
            // Re-run the seeder to restore defaults
            $seeder = new AppFiturSeeder();
            $seeder->run();

            UserLog::record(
                'appsupport',
                'app-fiturs',
                'Reset Pengaturan Fitur',
                "Mengembalikan konfigurasi fitur aplikasi ke pengaturan bawaan (default seeder)"
            );

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

