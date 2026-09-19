<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Profil\UserLog;
use App\Models\UserManagement\Permission;
use App\Models\UserManagement\Role;
use App\Models\UserManagement\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAccessController extends Controller
{
    /**
     * Tampilan utama Manajemen Hak Akses Pengguna
     */
    public function index(Request $request)
    {
        $query = User::with(['roles', 'permissions']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->filled('role') && $request->role !== 'all') {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('roles.id', $request->role);
            });
        }

        $users = $query->latest('id')->paginate(10)->withQueryString();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'html_rows' => view('pages.usermanagement.partials.akses-user.user-access-rows', compact('users'))->render(),
                'html_pagination' => $users->links('pagination::bootstrap-5')->render(),
                'total' => $users->total(),
            ]);
        }

        $roles = Role::orderBy('name')->get();
        $matrixTree = \App\Services\UserManagement\PermissionMatrixService::getMatrixTree();
        $totalUsers = User::count();
        $usersWithDirectPermissions = User::has('permissions')->count();
        $totalRoles = $roles->count();

        return view('pages.usermanagement.akses-user', compact(
            'users',
            'roles',
            'matrixTree',
            'totalUsers',
            'usersWithDirectPermissions',
            'totalRoles'
        ));
    }

    /**
     * Tetapkan peran (Assign Roles) ke Pengguna
     */
    public function assignRole(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->syncRoles($request->roles);
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        UserLog::record('usermanagement', 'akses-user', 'Penetapan Peran Pengguna', "Menetapkan peran [" . implode(', ', $request->roles) . "] untuk pengguna: {$user->name}", null, 'info');

        $roleBadges = $user->roles->map(function ($r) {
            return [
                'id' => $r->id,
                'name' => $r->name,
                'display_name' => $r->display_name ?? ucwords(str_replace(['_', '-'], ' ', $r->name)),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => "Peran untuk pengguna '{$user->name}' berhasil diperbarui.",
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'roles' => $roleBadges,
            ],
        ]);
    }

    /**
     * Ambil rincian direct permissions dan role permissions milik user
     */
    public function getUserPermissions(User $user): JsonResponse
    {
        $user->load(['roles.permissions', 'permissions']);

        $directPermissions = $user->getDirectPermissions()->pluck('name')->toArray();
        $inheritedMap = [];

        foreach ($user->roles as $role) {
            $roleLabel = $role->display_name ?? ucwords(str_replace(['_', '-'], ' ', $role->name));
            foreach ($role->permissions as $perm) {
                if (!isset($inheritedMap[$perm->name])) {
                    $inheritedMap[$perm->name] = [];
                }
                $inheritedMap[$perm->name][] = $roleLabel;
            }
        }

        $rolePermissions = array_keys($inheritedMap);
        $userRoles = $user->roles->pluck('name')->toArray();

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'roles' => $userRoles,
            ],
            'direct_permissions' => $directPermissions,
            'role_permissions' => $rolePermissions,
            'inherited_map' => $inheritedMap,
        ]);
    }

    /**
     * Simpan direct permissions override untuk pengguna
     */
    public function updateDirectPermissions(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $permissions = $request->input('permissions', []);
        $user->syncPermissions($permissions);
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        UserLog::record('usermanagement', 'akses-user', 'Penetapan Izin Langsung', "Menetapkan " . count($permissions) . " perizinan langsung untuk pengguna: {$user->name}", null, 'info');

        return response()->json([
            'success' => true,
            'message' => "Izin langsung (direct permissions) pengguna '{$user->name}' berhasil diperbarui.",
            'user_id' => $user->id,
            'direct_count' => count($permissions),
        ]);
    }
}
