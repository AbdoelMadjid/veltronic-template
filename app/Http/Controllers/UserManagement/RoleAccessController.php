<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\UserManagement\Permission;
use App\Models\UserManagement\Role;
use App\Services\UserManagement\PermissionMatrixService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleAccessController extends Controller
{
    /**
     * Tampilan utama Matriks Hak Akses Peran (Role-Permission Matrix)
     */
    public function index(Request $request)
    {
        $roles = Role::with('permissions')->orderBy('id')->get();
        $matrixTree = PermissionMatrixService::getMatrixTree();
        $permissions = Permission::all();

        // Buat map [role_id] => [permission_name, ...]
        $matrix = [];
        foreach ($roles as $role) {
            $matrix[$role->id] = $role->permissions->pluck('name')->toArray();
        }

        $totalRoles = $roles->count();
        $totalPermissions = $permissions->count();

        return view('pages.usermanagement.akses-role', compact(
            'roles',
            'matrixTree',
            'matrix',
            'totalRoles',
            'totalPermissions'
        ));
    }

    /**
     * Simpan / Sinkronisasi seluruh izin untuk satu Peran (AJAX Zero-Reload)
     */
    public function syncRole(Request $request): JsonResponse
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::findOrFail($request->role_id);
        $permissions = $request->input('permissions', []);

        $role->syncPermissions($permissions);

        return response()->json([
            'success' => true,
            'message' => "Matriks hak akses untuk peran '{$role->name}' berhasil diperbarui.",
            'role_id' => $role->id,
            'total_permissions' => count($permissions),
        ]);
    }

    /**
     * Toggle status satu permission untuk satu role (AJAX Zero-Reload)
     */
    public function togglePermission(Request $request): JsonResponse
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_name' => 'required|exists:permissions,name',
            'grant' => 'required|boolean',
        ]);

        $role = Role::findOrFail($request->role_id);
        $permission = Permission::where('name', $request->permission_name)->firstOrFail();
        $grant = filter_var($request->grant, FILTER_VALIDATE_BOOLEAN);

        if ($grant) {
            $role->givePermissionTo($permission);
            $message = "Izin '{$permission->name}' berhasil diberikan ke peran '{$role->name}'.";
        } else {
            $role->revokePermissionTo($permission);
            $message = "Izin '{$permission->name}' berhasil dicabut dari peran '{$role->name}'.";
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'role_id' => $role->id,
            'permission_name' => $permission->name,
            'is_granted' => $grant,
            'total_role_permissions' => $role->permissions()->count(),
        ]);
    }

    /**
     * Bulk Toggle status permissions (Grant All / Revoke All per Modul atau per Role)
     */
    public function bulkToggle(Request $request): JsonResponse
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'action' => 'required|in:grant_module,revoke_module,grant_all,revoke_all',
            'module_key' => 'nullable|string',
        ]);

        $role = Role::findOrFail($request->role_id);
        $action = $request->action;
        $moduleKey = $request->module_key;

        if ($action === 'grant_all') {
            $allPermissions = Permission::all();
            $role->syncPermissions($allPermissions);
            $message = "Semua hak akses berhasil diberikan ke peran '{$role->name}'.";
        } elseif ($action === 'revoke_all') {
            $role->syncPermissions([]);
            $message = "Semua hak akses berhasil dicabut dari peran '{$role->name}'.";
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Aksi massal tidak valid.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'role_id' => $role->id,
            'total_role_permissions' => $role->permissions()->count(),
        ]);
    }
}
