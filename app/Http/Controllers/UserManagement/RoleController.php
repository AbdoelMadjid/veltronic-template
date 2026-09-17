<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Profil\UserLog;
use App\Models\UserManagement\Permission;
use App\Models\UserManagement\Role;
use App\Models\UserManagement\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Daftar role sistem yang diproteksi dari penghapusan
     */
    protected array $protectedRoles = ['master', 'admin'];

    /**
     * Tampilan utama daftar Role & Permissions
     */
    public function index()
    {
        $roles = Role::withCount(['users', 'permissions'])
            ->with(['permissions', 'users' => function ($q) {
                $q->limit(5);
            }])
            ->get();

        $totalUsers = User::count();
        $totalRoles = $roles->count();
        $totalPermissions = Permission::count();

        // Ambil struktur hirarki Menu & CRUD Matrix Permissions
        $matrixTree = \App\Services\UserManagement\PermissionMatrixService::getMatrixTree();
        $allPermissions = Permission::all();
        $groupedPermissions = $this->groupPermissions($allPermissions);

        return view('pages.usermanagement.roles', compact(
            'roles',
            'totalUsers',
            'totalRoles',
            'totalPermissions',
            'groupedPermissions',
            'allPermissions',
            'matrixTree'
        ));
    }

    /**
     * Simpan Role Baru
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $roleName = Str::slug($request->input('name'), '_');

        $role = Role::create([
            'name' => $roleName,
            'guard_name' => 'web',
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->input('permissions'));
        }

        $role->loadCount(['users', 'permissions']);

        UserLog::record('usermanagement', 'roles', 'Tambah Peran Baru', "Membuat peran baru: {$roleName}", null, 'success');

        return response()->json([
            'success' => true,
            'message' => "Role `{$roleName}` berhasil dibuat.",
            'role' => $role,
        ]);
    }

    /**
     * Detail Role beserta anggota & permissions
     */
    public function show(Role $role): JsonResponse
    {
        $role->load(['permissions', 'users']);
        $role->loadCount(['users', 'permissions']);

        return response()->json([
            'success' => true,
            'role' => $role,
            'is_protected' => in_array(strtolower($role->name), $this->protectedRoles),
        ]);
    }

    /**
     * Ambil daftar nama permission yang dimiliki oleh Role
     */
    public function getPermissions(Role $role): JsonResponse
    {
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return response()->json([
            'success' => true,
            'role' => $role,
            'permissions' => $rolePermissions,
            'is_protected' => in_array(strtolower($role->name), $this->protectedRoles),
        ]);
    }

    /**
     * Update Role & Permissions
     */
    public function update(Request $request, Role $role): JsonResponse
    {
        $isProtected = in_array(strtolower($role->name), $this->protectedRoles);

        if (!$isProtected) {
            $request->validate([
                'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
                'permissions' => 'nullable|array',
                'permissions.*' => 'string|exists:permissions,name',
            ]);

            $roleName = Str::slug($request->input('name'), '_');
            $role->update(['name' => $roleName]);
        } else {
            $request->validate([
                'permissions' => 'nullable|array',
                'permissions.*' => 'string|exists:permissions,name',
            ]);
        }

        if ($request->has('permissions')) {
            $role->syncPermissions($request->input('permissions', []));
        } else {
            $role->syncPermissions([]);
        }

        $role->loadCount(['users', 'permissions']);

        UserLog::record('usermanagement', 'roles', 'Ubah Peran & Izin', "Memperbarui peran {$role->name} dan menyelaraskan perizinan", null, 'info');

        return response()->json([
            'success' => true,
            'message' => "Peran `{$role->name}` berhasil diperbarui.",
            'role' => $role,
        ]);
    }

    /**
     * Hapus Role (Role sistem master/admin dilindungi)
     */
    public function destroy(Role $role): JsonResponse
    {
        if (in_array(strtolower($role->name), $this->protectedRoles)) {
            return response()->json([
                'success' => false,
                'message' => "Role `{$role->name}` adalah peran sistem bawaan dan tidak dapat dihapus demi keamanan.",
            ], 403);
        }

        if ($role->users()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => "Role `{$role->name}` masih memiliki {$role->users()->count()} pengguna aktif. Pindahkan role pengguna terlebih dahulu.",
            ], 422);
        }

        $roleName = $role->name;
        $role->delete();

        UserLog::record('usermanagement', 'roles', 'Hapus Peran', "Menghapus peran: {$roleName}", null, 'warning');

        return response()->json([
            'success' => true,
            'message' => "Role `{$roleName}` berhasil dihapus dari sistem.",
        ]);
    }

    /**
     * Helper Mengelompokkan Permissions per Modul
     */
    protected function groupPermissions($permissions): array
    {
        $grouped = [];

        foreach ($permissions as $perm) {
            $name = $perm->name;
            // Format penamaan umumnya: 'appsupport.menu.read' atau 'users.create' atau 'read'
            $parts = explode('.', $name);

            if (count($parts) > 1) {
                $action = array_pop($parts);
                $module = implode('.', $parts);
            } else {
                $module = 'General / Global';
                $action = $name;
            }

            $moduleTitle = ucwords(str_replace(['_', '-'], ' ', $module));

            if (!isset($grouped[$moduleTitle])) {
                $grouped[$moduleTitle] = [];
            }

            $grouped[$moduleTitle][] = [
                'id' => $perm->id,
                'name' => $perm->name,
                'action' => $action,
                'guard_name' => $perm->guard_name,
            ];
        }

        ksort($grouped);
        return $grouped;
    }
}
