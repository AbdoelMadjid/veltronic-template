<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\UserManagement\Permission;
use App\Models\UserManagement\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Tampilan utama daftar Permissions
     */
    public function index()
    {
        $permissions = Permission::withCount('roles')
            ->with(['roles' => function ($q) {
                $q->limit(4);
            }])
            ->get();

        $totalPermissions = $permissions->count();
        $totalRoles = Role::count();

        // Kelompokkan nama modul unik untuk filter
        $modules = [];
        foreach ($permissions as $p) {
            $parts = explode('.', $p->name);
            if (count($parts) > 1) {
                array_pop($parts);
                $mod = implode('.', $parts);
            } else {
                $mod = 'general';
            }
            $modules[$mod] = ucwords(str_replace(['_', '-'], ' ', $mod));
        }

        return view('pages.usermanagement.permissions', compact(
            'permissions',
            'totalPermissions',
            'totalRoles',
            'modules'
        ));
    }

    /**
     * Simpan Permission Baru
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:permissions,name',
            'guard_name' => 'nullable|string|max:50',
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $permName = strtolower(trim($request->input('name')));
        $guardName = $request->input('guard_name', 'web') ?: 'web';

        $permission = Permission::create([
            'name' => $permName,
            'guard_name' => $guardName,
        ]);

        if ($request->has('roles')) {
            $permission->syncRoles($request->input('roles'));
        }

        $permission->loadCount('roles');
        $permission->load('roles');

        return response()->json([
            'success' => true,
            'message' => "Permission `{$permName}` berhasil ditambahkan.",
            'permission' => $permission,
        ]);
    }

    /**
     * Detail 1 Permission
     */
    public function show(Permission $permission): JsonResponse
    {
        $permission->load('roles');
        $permission->loadCount('roles');

        return response()->json([
            'success' => true,
            'permission' => $permission,
        ]);
    }

    /**
     * Update Permission
     */
    public function update(Request $request, Permission $permission): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:permissions,name,' . $permission->id,
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $permName = strtolower(trim($request->input('name')));
        $permission->update(['name' => $permName]);

        if ($request->has('roles')) {
            $permission->syncRoles($request->input('roles', []));
        }

        $permission->loadCount('roles');
        $permission->load('roles');

        return response()->json([
            'success' => true,
            'message' => "Permission `{$permName}` berhasil diperbarui.",
            'permission' => $permission,
        ]);
    }

    /**
     * Hapus Permission
     */
    public function destroy(Permission $permission): JsonResponse
    {
        $permName = $permission->name;
        $permission->delete();

        return response()->json([
            'success' => true,
            'message' => "Permission `{$permName}` berhasil dihapus.",
        ]);
    }

    /**
     * Generate Otomatis Izin CRUD untuk Modul Tertentu
     */
    public function generateModulePermissions(Request $request): JsonResponse
    {
        $request->validate([
            'module_prefix' => 'required|string|max:50',
            'actions' => 'required|array|min:1',
            'actions.*' => 'string|in:create,read,update,delete,sort,export,import',
            'assign_to_master' => 'nullable|boolean',
        ]);

        $prefix = Str::slug($request->input('module_prefix'), '.');
        $actions = $request->input('actions', []);
        $assignToMaster = $request->boolean('assign_to_master', true);

        $masterRole = Role::where('name', 'master')->first();
        $createdPerms = [];

        foreach ($actions as $act) {
            $permName = "{$prefix}.{$act}";
            $perm = Permission::firstOrCreate([
                'name' => $permName,
                'guard_name' => 'web',
            ]);

            if ($assignToMaster && $masterRole) {
                $masterRole->givePermissionTo($perm);
            }

            $createdPerms[] = $permName;
        }

        return response()->json([
            'success' => true,
            'message' => count($createdPerms) . " izin akses untuk modul `{$prefix}` berhasil digenerate.",
            'permissions' => $createdPerms,
        ]);
    }
}
