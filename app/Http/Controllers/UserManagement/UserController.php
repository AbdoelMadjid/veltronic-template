<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\UserStoreRequest;
use App\Http\Requests\UserManagement\UserUpdateRequest;
use App\Models\UserManagement\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|JsonResponse
    {
        $roles = Role::all();

        // Base Query with Eager Loading
        $query = User::with(['roles', 'detail', 'settings']);

        // 1. Filter: Keyword Search (Name or Email)
        $rawSearch = $request->input('search');
        $search = '';
        if (is_array($rawSearch)) {
            $search = trim($rawSearch['value'] ?? '');
        } elseif (is_string($rawSearch)) {
            $search = trim($rawSearch);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 2. Filter: Role
        $roleName = $request->input('role');
        if (is_array($roleName)) {
            $roleName = $roleName[0] ?? '';
        }
        if (!empty($roleName)) {
            $query->whereHas('roles', function ($q) use ($roleName) {
                $q->where('name', $roleName);
            });
        }

        // 3. Filter: Status Email Verification
        $status = $request->input('status');
        if (is_array($status)) {
            $status = $status[0] ?? '';
        }
        if (!empty($status)) {
            if ($status === 'verified') {
                $query->whereNotNull('email_verified_at');
            } elseif ($status === 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }

        // 4. Sorting
        if ($request->has('order') && is_array($request->input('order')) && isset($request->input('order')[0])) {
            $orderColIndex = (int) ($request->input('order')[0]['column'] ?? 5);
            $orderDir = strtolower($request->input('order')[0]['dir'] ?? 'desc') === 'asc' ? 'asc' : 'desc';

            // Map DataTables column index to database table column
            $columnMap = [
                2 => 'name',
                4 => 'email_verified_at',
                5 => 'created_at',
            ];

            if (isset($columnMap[$orderColIndex])) {
                $query->orderBy($columnMap[$orderColIndex], $orderDir);
            } else {
                $query->latest('updated_at');
            }
        } else {
            $sort = $request->input('sort', 'recent');
            if (is_array($sort)) {
                $sort = $sort[0] ?? 'recent';
            }
            switch ($sort) {
                case 'oldest':
                    $query->oldest('created_at');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'recent':
                default:
                    $query->latest('updated_at');
                    break;
            }
        }

        // Total Counts for Statistics
        $totalUsers = User::count();
        $verifiedCount = User::whereNotNull('email_verified_at')->count();
        $unverifiedCount = User::whereNull('email_verified_at')->count();

        // Handle AJAX DataTable Server-Side Request
        if ($request->ajax() && $request->has('draw')) {
            $recordsTotal = User::count();
            $recordsFiltered = (clone $query)->count();

            $start = (int) $request->input('start', 0);
            $length = (int) $request->input('length', 10);
            $users = $query->skip($start)->take($length)->get();

            $data = $users->map(function (User $user, $index) use ($start) {
                $userRoles = $user->roles;
                $roleBadgesHtml = '';
                if ($userRoles->isNotEmpty()) {
                    $roleBadgesHtml = '<div class="d-flex flex-wrap gap-1">' . $userRoles->map(function ($r) {
                        $badgeClass = match (strtolower($r->name)) {
                            'master' => 'badge-light-danger',
                            'admin' => 'badge-light-primary',
                            default => 'badge-light-info',
                        };
                        return '<span class="badge ' . $badgeClass . ' fw-bold px-2 py-1 text-uppercase fs-8">' . htmlspecialchars(strtoupper($r->name)) . '</span>';
                    })->implode('') . '</div>';
                } else {
                    $roleBadgesHtml = '<span class="badge badge-light-secondary fw-bold px-2 py-1 fs-8">USER</span>';
                }

                return [
                    'DT_RowIndex' => $start + $index + 1,
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $userRoles->pluck('name')->toArray(),
                    'role_badge' => $roleBadgesHtml,
                    'email_status' => $user->email_verified_at
                        ? '<span class="badge badge-light-success fw-bold px-3 py-1 fs-8">Terverifikasi</span>'
                        : '<span class="badge badge-light-secondary fw-bold px-3 py-1 fs-8">Belum Verifikasi</span>',
                    'joined_at' => $user->created_at ? $user->created_at->translatedFormat('d M Y') : '-',
                    'avatar_url' => $user->avatar_url,
                    'avatar_position_x' => (int) ($user->setting('avatar_position_x', '50') ?? '50'),
                    'avatar_position_y' => (int) ($user->setting('avatar_position_y', '0') ?? '0'),
                    'avatar_zoom' => (int) ($user->setting('avatar_zoom', '100') ?? '100'),
                    'user_info' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'avatar' => $user->avatar ? $user->avatar_url : null,
                        'avatar_position_x' => (int) ($user->setting('avatar_position_x', '50') ?? '50'),
                        'avatar_position_y' => (int) ($user->setting('avatar_position_y', '0') ?? '0'),
                        'avatar_zoom' => (int) ($user->setting('avatar_zoom', '100') ?? '100'),
                        'initial' => strtoupper(substr($user->name, 0, 1)),
                    ],
                    'actions' => '
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <button type="button" class="btn btn-icon btn-light btn-active-light-primary btn-sm btn-view-user" data-id="' . $user->id . '" data-bs-toggle="tooltip" title="Lihat Detail">
                                <i class="ki-duotone ki-eye fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-light btn-active-light-warning btn-sm btn-edit-user" data-id="' . $user->id . '" data-bs-toggle="tooltip" title="Ubah Data">
                                <i class="ki-duotone ki-pencil fs-5"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-light btn-active-light-info btn-sm btn-reset-password" data-id="' . $user->id . '" data-name="' . htmlspecialchars($user->name) . '" data-bs-toggle="tooltip" title="Reset Password">
                                <i class="ki-duotone ki-key fs-5"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-light btn-active-light-danger btn-sm btn-delete-user" data-id="' . $user->id . '" data-name="' . htmlspecialchars($user->name) . '" data-bs-toggle="tooltip" title="Hapus Pengguna">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </div>
                    '
                ];
            });

            return response()->json([
                'draw' => (int) $request->input('draw'),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data,
            ]);
        }

        // Pagination for Card View (12 items per page)
        $perPage = (int) $request->input('per_page', 12);
        $users = $query->paginate($perPage)->withQueryString();

        if ($request->expectsJson() && $request->header('X-Fetch-Cards')) {
            $cardsHtml = view('pages.usermanagement.partials.users.users-cards-list', compact('users'))->render();
            $paginationHtml = $users->links('pagination::bootstrap-5')->render();

            return response()->json([
                'status' => 'success',
                'total' => $users->total(),
                'first_item' => $users->firstItem() ?? 0,
                'last_item' => $users->lastItem() ?? 0,
                'html' => $cardsHtml,
                'pagination' => $paginationHtml,
            ]);
        }

        return view('pages.usermanagement.users', [
            'users' => $users,
            'roles' => $roles,
            'totalUsers' => $totalUsers,
            'verifiedCount' => $verifiedCount,
            'unverifiedCount' => $unverifiedCount,
            'filters' => [
                'search' => $request->input('search', ''),
                'role' => $request->input('role', ''),
                'status' => $request->input('status', ''),
                'sort' => $sort,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'avatar' => $avatarPath,
                'email_verified_at' => now(),
            ]);

            if (!empty($validated['roles'])) {
                $user->syncRoles($validated['roles']);
            } elseif (!empty($validated['role'])) {
                $user->syncRoles([$validated['role']]);
            } else {
                $user->assignRole('user');
            }

            DB::commit();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'success' => true,
                    'message' => 'Pengguna baru berhasil ditambahkan.',
                    'data' => $user->load('roles'),
                ], 201);
            }

            return redirect()->route('usermanagement.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'success' => false,
                    'message' => 'Gagal menambahkan pengguna: ' . $e->getMessage(),
                ], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse|View
    {
        $user->load(['roles', 'detail', 'settings']);

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar ? $user->avatar_url : null,
                    'avatar_position_x' => (int) ($user->setting('avatar_position_x', '50') ?? '50'),
                    'avatar_position_y' => (int) ($user->setting('avatar_position_y', '0') ?? '0'),
                    'avatar_zoom' => (int) ($user->setting('avatar_zoom', '100') ?? '100'),
                    'cover_bg_url' => $user->cover_bg_url,
                    'cover_opacity' => (int) ($user->setting('cover_opacity', '60') ?? '60'),
                    'cover_overlay_color' => $user->setting('cover_overlay_color', '#000000') ?? '#000000',
                    'cover_position_y' => (int) ($user->setting('cover_position_y', '30') ?? '30'),
                    'cover_blur' => (int) ($user->setting('cover_blur', '0') ?? '0'),
                    'roles' => $user->roles->pluck('name')->toArray(),
                    'role' => $user->roles->first()?->name ?? 'user',
                    'email_verified_at' => $user->email_verified_at ? $user->email_verified_at->translatedFormat('d M Y H:i') : null,
                    'created_at' => $user->created_at ? $user->created_at->translatedFormat('d F Y, H:i') : '-',
                    'updated_at' => $user->updated_at ? $user->updated_at->translatedFormat('d F Y, H:i') : '-',
                    'phone' => $user->detail?->no_hp ?? '-',
                    'nik' => $user->detail?->nik ?? '-',
                    'address' => $user->detail?->alamat_lengkap ?? '-',
                ],
            ]);
        }

        return view('pages.usermanagement.users', compact('user'));
    }

    /**
     * Show form for editing the resource.
     */
    public function edit(User $user): JsonResponse
    {
        $user->load('roles');

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles->pluck('name')->toArray(),
                'role' => $user->roles->first()?->name ?? 'user',
                'avatar' => $user->avatar ? $user->avatar_url : null,
                'avatar_position_x' => (int) ($user->setting('avatar_position_x', '50') ?? '50'),
                'avatar_position_y' => (int) ($user->setting('avatar_position_y', '0') ?? '0'),
                'avatar_zoom' => (int) ($user->setting('avatar_zoom', '100') ?? '100'),
                'avatar_style' => $user->avatar_style,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $updateData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            if (!empty($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            // Handle Avatar Upload / Removal
            if ($request->hasFile('avatar')) {
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $updateData['avatar'] = $request->file('avatar')->store('avatars', 'public');
            } elseif (!empty($validated['remove_avatar']) && $validated['remove_avatar']) {
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $updateData['avatar'] = null;
            }

            $user->update($updateData);

            if (isset($validated['roles'])) {
                $user->syncRoles($validated['roles']);
            } elseif (isset($validated['role'])) {
                $user->syncRoles([$validated['role']]);
            }

            DB::commit();

            $isAuthUser = (Auth::id() === $user->id);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'success' => true,
                    'message' => 'Data pengguna berhasil diperbarui.',
                    'data' => array_merge($user->fresh(['roles'])->toArray(), [
                        'avatar_url' => $user->fresh()->avatar_url,
                        'is_auth_user' => $isAuthUser,
                    ]),
                ]);
            }

            return redirect()->route('usermanagement.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'success' => false,
                    'message' => 'Gagal memperbarui pengguna: ' . $e->getMessage(),
                ], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse|RedirectResponse
    {
        if (Auth::id() === $user->id) {
            $msg = 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.';
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json(['status' => 'error', 'success' => false, 'message' => $msg], 403);
            }
            return back()->withErrors(['error' => $msg]);
        }

        try {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->delete();

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'success' => true,
                    'message' => 'Pengguna berhasil dihapus secara permanen.',
                ]);
            }

            return redirect()->route('usermanagement.users.index')->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Throwable $e) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'success' => false,
                    'message' => 'Gagal menghapus pengguna: ' . $e->getMessage(),
                ], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Reset user password to default.
     */
    public function resetPassword(Request $request, User $user): JsonResponse|RedirectResponse
    {
        $newPassword = $request->input('password', 'password123');

        try {
            $user->update([
                'password' => Hash::make($newPassword),
            ]);

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'success' => true,
                    'message' => 'Kata sandi pengguna berhasil diatur ulang ke "' . $newPassword . '".',
                ]);
            }

            return redirect()->route('usermanagement.users.index')->with('success', 'Kata sandi pengguna berhasil direset.');
        } catch (\Throwable $e) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'success' => false,
                    'message' => 'Gagal mereset kata sandi: ' . $e->getMessage(),
                ], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Assign roles in bulk to selected users.
     */
    public function bulkAssignRole(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_ids' => ['required', 'array', 'min:1'],
            'user_ids.*' => ['required', 'integer', 'exists:users,id'],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['required', 'string', 'exists:roles,name'],
            'mode' => ['required', 'in:append,replace'],
        ], [
            'user_ids.required' => 'Pilih minimal satu pengguna.',
            'user_ids.min' => 'Pilih minimal satu pengguna.',
            'roles.required' => 'Pilih minimal satu peran yang akan diberikan.',
            'roles.min' => 'Pilih minimal satu peran yang akan diberikan.',
            'mode.required' => 'Pilih metode penerapan peran.',
        ]);

        $userIds = $validated['user_ids'];
        $roleNames = $validated['roles'];
        $mode = $validated['mode'];

        DB::beginTransaction();
        try {
            $users = User::whereIn('id', $userIds)->get();
            $count = 0;

            foreach ($users as $user) {
                if ($mode === 'replace') {
                    $user->syncRoles($roleNames);
                } else {
                    $user->assignRole($roleNames);
                }
                $count++;
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'success' => true,
                'message' => "Berhasil menerapkan peran kepada {$count} pengguna terpilih.",
                'data' => [
                    'updated_count' => $count,
                    'roles' => $roleNames,
                    'mode' => $mode,
                ],
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'success' => false,
                'message' => 'Gagal menerapkan peran secara massal: ' . $e->getMessage(),
            ], 500);
        }
    }
}
