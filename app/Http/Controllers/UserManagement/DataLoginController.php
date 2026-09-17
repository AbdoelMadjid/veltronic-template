<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Profil\UserLog;
use App\Models\UserManagement\User;
use App\Models\UserManagement\UserLogin;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class DataLoginController extends Controller
{
    /**
     * Display a listing of user login activity history.
     */
    public function index(Request $request): View|JsonResponse
    {
        $roles = Role::all();

        // Base Query with Eager Loading
        $query = UserLogin::with(['user.roles']);

        // 1. Filter: Keyword Search
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

        // 2. Filter: Tipe Aksi (Login Web vs Buka Layar Kunci)
        $type = $request->input('type');
        if (is_array($type)) {
            $type = $type[0] ?? '';
        }
        if (!empty($type) && $type !== 'all') {
            $query->where('type', $type);
        }

        // 3. Filter: Poin Didapat (1 vs 0)
        $pointEarned = $request->input('point_earned');
        if (is_array($pointEarned)) {
            $pointEarned = $pointEarned[0] ?? '';
        }
        if ($pointEarned === 'yes' || $pointEarned === '1') {
            $query->where('point_earned', 1);
        } elseif ($pointEarned === 'no' || $pointEarned === '0') {
            $query->where('point_earned', 0);
        }

        // 4. Filter: Peran Pengguna (Role)
        $roleName = $request->input('role');
        if (is_array($roleName)) {
            $roleName = $roleName[0] ?? '';
        }
        if (!empty($roleName) && $roleName !== 'all') {
            $query->whereHas('user.roles', function ($q) use ($roleName) {
                $q->where('name', $roleName);
            });
        }

        // 5. Filter: Rentang Waktu (Date Range)
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
                        // Ignore date format error
                    }
                }
            }
        }

        // 6. Sorting
        if ($request->has('order') && is_array($request->input('order')) && isset($request->input('order')[0])) {
            $orderColIndex = (int) ($request->input('order')[0]['column'] ?? 6);
            $orderDir = strtolower($request->input('order')[0]['dir'] ?? 'desc') === 'asc' ? 'asc' : 'desc';

            $columnMap = [
                1 => 'user_id',
                2 => 'type',
                3 => 'point_earned',
                4 => 'device',
                5 => 'ip_address',
                6 => 'created_at',
            ];

            $sortColumn = $columnMap[$orderColIndex] ?? 'created_at';
            $query->orderBy($sortColumn, $orderDir);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Return DataTables JSON if requested
        if ($request->expectsJson() || $request->ajax()) {
            $start = (int) $request->input('start', 0);
            $length = (int) $request->input('length', 10);
            if ($length <= 0) $length = 10;

            $totalRecords = UserLogin::count();
            $filteredRecords = (clone $query)->count();

            $logins = $query->skip($start)->take($length)->get();

            $data = $logins->map(function (UserLogin $login) {
                $user = $login->user;
                $roleBadge = '<span class="badge badge-light-secondary fs-8">Pengguna</span>';
                if ($user) {
                    $primaryRole = $user->roles->first()?->name ?? 'User';
                    $isProtected = in_array(strtolower($primaryRole), ['master', 'admin']);
                    $roleBadgeClass = $isProtected ? 'badge-light-danger' : 'badge-light-primary';
                    $roleBadge = '<span class="badge ' . $roleBadgeClass . ' fs-8 fw-semibold">' . htmlspecialchars(ucfirst($primaryRole)) . '</span>';
                }

                $avatarHtml = $user ? (string) $user->renderAvatar('35px', 'rounded-3 me-3') : '<div class="symbol symbol-35px symbol-circle bg-light-danger me-3"><span class="symbol-label text-danger fw-bold">?</span></div>';
                $userName = $user ? htmlspecialchars($user->name) : '<span class="text-muted fst-italic">Pengguna Dihapus</span>';
                $userEmail = $user ? htmlspecialchars($user->email) : '-';

                $typeBadge = $login->type === 'lockscreen'
                    ? '<span class="badge badge-light-warning fw-bold px-3 py-2"><i class="ki-outline ki-lock fs-7 me-1 text-warning"></i> Buka Layar Kunci</span>'
                    : '<span class="badge badge-light-primary fw-bold px-3 py-2"><i class="ki-outline ki-entrance-right fs-7 me-1 text-primary"></i> Login Web</span>';

                $pointBadge = $login->point_earned > 0
                    ? '<span class="badge badge-light-success fw-bolder px-3 py-2"><i class="ki-outline ki-crown-2 fs-7 me-1 text-success"></i> +1 Poin (24 Jam)</span>'
                    : '<span class="badge badge-light-secondary fw-semibold px-2 py-1 text-muted fs-8">0 Poin (Sudah Klaim)</span>';

                $deviceIcon = 'ki-laptop';
                if (strtolower($login->device ?? '') === 'mobile') {
                    $deviceIcon = 'ki-phone';
                } elseif (strtolower($login->device ?? '') === 'tablet') {
                    $deviceIcon = 'ki-tablet';
                }

                return [
                    'id' => $login->id,
                    'user' => [
                        'id' => $user?->id,
                        'name' => $user?->name,
                        'email' => $user?->email,
                        'points' => (int) ($user?->points ?? 0),
                        'login_count' => (int) ($user?->login_count ?? 0),
                        'avatar_html' => $avatarHtml,
                        'role_badge' => $roleBadge,
                    ],
                    'type' => $login->type,
                    'type_badge' => $typeBadge,
                    'point_earned' => $login->point_earned,
                    'point_badge' => $pointBadge,
                    'device' => $login->device ?? 'Desktop',
                    'device_icon' => $deviceIcon,
                    'browser' => $login->browser ?? 'Browser',
                    'platform' => $login->platform ?? 'OS',
                    'ip_address' => $login->ip_address ?? '-',
                    'user_agent' => $login->user_agent ?? '-',
                    'created_at_formatted' => $login->created_at ? $login->created_at->translatedFormat('d M Y, H:i:s') : '-',
                    'created_at_relative' => $login->created_at ? $login->created_at->diffForHumans() : '-',
                ];
            });

            // Calculate live statistics
            $stats = $this->calculateStats();

            return response()->json([
                'draw' => (int) $request->input('draw', 1),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data,
                'stats' => $stats,
            ]);
        }

        // Live statistics for initial page load
        $stats = $this->calculateStats();

        return view('pages.usermanagement.data-login', [
            'roles' => $roles,
            'stats' => $stats,
            'title' => 'Riwayat Data Login Pengguna',
            'subtitle' => 'Pantau log aktivitas login, buka layar kunci (lock screen), dan perolehan reward 1 poin per 24 jam.',
        ]);
    }

    /**
     * Calculate summary statistics for login events & points.
     */
    private function calculateStats(): array
    {
        $today = Carbon::today();

        $totalLogins = UserLogin::count();
        $webLogins = UserLogin::where('type', 'login')->count();
        $lockscreenLogins = UserLogin::where('type', 'lockscreen')->count();
        $totalPointsEarned = UserLogin::where('point_earned', 1)->count();
        $todayPointsEarned = UserLogin::where('point_earned', 1)->whereDate('created_at', $today)->count();
        $activeUsersToday = UserLogin::whereDate('created_at', $today)->distinct('user_id')->count('user_id');

        return [
            'total_logins' => $totalLogins,
            'web_logins' => $webLogins,
            'lockscreen_logins' => $lockscreenLogins,
            'total_points_earned' => $totalPointsEarned,
            'today_points_earned' => $todayPointsEarned,
            'active_users_today' => $activeUsersToday,
        ];
    }

    /**
     * Remove the specified login history record from storage (Zero-Reload).
     */
    public function destroy(UserLogin $login, Request $request): JsonResponse|RedirectResponse
    {
        $targetUserName = $login->user?->name ?? 'Pengguna ID #'.$login->user_id;
        $login->delete();

        UserLog::record(
            'usermanagement',
            'data-login',
            'Hapus Riwayat Login',
            "Menghapus riwayat login milik {$targetUserName} (ID #{$login->id})"
        );

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Riwayat data login berhasil dihapus.',
                'stats' => $this->calculateStats(),
            ]);
        }

        return redirect()->route('usermanagement.data-login')
            ->with('success', 'Riwayat data login berhasil dihapus.');
    }

    /**
     * Bulk delete selected login history records (Zero-Reload).
     */
    public function bulkDestroy(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:users_logins,id'],
        ]);

        $ids = $request->input('ids', []);
        $deletedCount = UserLogin::whereIn('id', $ids)->delete();

        UserLog::record(
            'usermanagement',
            'data-login',
            'Hapus Massal Riwayat Login',
            "Menghapus secara massal {$deletedCount} catatan riwayat login pengguna"
        );

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Sebanyak {$deletedCount} data riwayat login berhasil dihapus.",
                'stats' => $this->calculateStats(),
            ]);
        }

        return redirect()->route('usermanagement.data-login')
            ->with('success', "Sebanyak {$deletedCount} data riwayat login berhasil dihapus.");
    }

    /**
     * Clear login history by age (Zero-Reload).
     */
    public function clear(Request $request): JsonResponse|RedirectResponse
    {
        $period = $request->input('period', 'all'); // 'all', '30days', '90days'

        $query = UserLogin::query();
        if ($period === '30days') {
            $query->where('created_at', '<', Carbon::now()->subDays(30));
        } elseif ($period === '90days') {
            $query->where('created_at', '<', Carbon::now()->subDays(90));
        }

        $deletedCount = $query->delete();

        UserLog::record(
            'usermanagement',
            'data-login',
            'Bersihkan Riwayat Login',
            "Membersihkan {$deletedCount} riwayat login dengan periode filter: {$period}"
        );

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Pembersihan selesai. {$deletedCount} data riwayat login berhasil dibersihkan.",
                'stats' => $this->calculateStats(),
            ]);
        }

        return redirect()->route('usermanagement.data-login')
            ->with('success', "Pembersihan selesai. {$deletedCount} data riwayat login berhasil dibersihkan.");
    }
}
