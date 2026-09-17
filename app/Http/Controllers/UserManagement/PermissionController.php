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
     * Tampilan utama daftar Permissions (Tampilan Modul & Fitur Hirarkis)
     */
    public function index()
    {
        $permissions = Permission::with('roles')->get();
        $totalPermissions = $permissions->count();
        $roles = Role::all();

        // Ambil hierarki modul dari PermissionMatrixService
        $matrixTree = \App\Services\UserManagement\PermissionMatrixService::getMatrixTree();
        
        $totalModules = count($matrixTree);
        $unassignedModulesCount = 0;

        // Proses setiap modul agar memiliki list actions badge dan list assigned roles
        $modulesTree = [];
        foreach ($matrixTree as $mod) {
            $matchedPerms = $permissions->filter(function ($p) use ($mod) {
                return in_array($p->name, $mod['all_permissions'] ?? []);
            });

            $assignedRoleNames = $matchedPerms->flatMap(function ($p) {
                return $p->roles->pluck('name');
            })->unique()->values()->all();

            $mod['assigned_roles'] = $assignedRoleNames;

            // List actions yang tersedia
            $actions = [];
            if (!empty($mod['read'])) $actions[] = 'READ';
            if (!empty($mod['create'])) $actions[] = 'CREATE';
            if (!empty($mod['update'])) $actions[] = 'UPDATE';
            if (!empty($mod['delete'])) $actions[] = 'DELETE';
            foreach ($mod['other'] ?? [] as $op) {
                $actions[] = strtoupper($op['action_label'] ?? 'OTHER');
            }
            $mod['registered_actions'] = $actions;

            if (empty($assignedRoleNames)) {
                $unassignedModulesCount++;
            }

            $modulesTree[] = $mod;
        }

        return view('pages.usermanagement.permissions', compact(
            'permissions',
            'totalPermissions',
            'totalModules',
            'unassignedModulesCount',
            'modulesTree',
            'roles'
        ));
    }

    /**
     * Simpan Permission Baru (Single)
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:permissions,name',
            'guard_name' => 'nullable|string|max:50',
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $permName = trim($request->input('name'));
        $guardName = $request->input('guard_name', 'web') ?: 'web';

        $permission = Permission::create([
            'name' => $permName,
            'guard_name' => $guardName,
        ]);

        if ($request->has('roles') && !empty($request->input('roles'))) {
            $roles = Role::whereIn('name', $request->input('roles'))->get();
            foreach ($roles as $r) {
                $r->givePermissionTo($permission);
            }
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

        $permName = trim($request->input('name'));
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
     * Generate Otomatis Izin CRUD untuk Modul Tertentu (Batch CRUD & Edit Modul)
     */
    public function generateModulePermissions(Request $request): JsonResponse
    {
        $request->validate([
            'module_prefix' => 'required|string|max:100',
            'actions' => 'required|array|min:1',
            'actions.*' => 'string',
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name',
            'assign_to_master' => 'nullable|boolean',
        ]);

        $prefix = trim($request->input('module_prefix'));
        $actions = $request->input('actions', []);
        $selectedRoles = $request->input('roles', []);

        $allRoles = Role::all();
        $rolesToAssign = !empty($selectedRoles) ? Role::whereIn('name', $selectedRoles)->get() : collect();

        if ($request->boolean('assign_to_master', false) && !$rolesToAssign->contains('name', 'master')) {
            $masterRole = Role::where('name', 'master')->first();
            if ($masterRole) $rolesToAssign->push($masterRole);
        }

        $allPossibleActions = ['create', 'read', 'update', 'delete'];
        $createdPermObjects = [];

        foreach ($actions as $act) {
            $actLower = strtolower($act);
            $permName = "{$actLower} {$prefix}";

            $perm = Permission::firstOrCreate([
                'name' => $permName,
                'guard_name' => 'web',
            ]);

            // Sinkronisasi roles pada permission ini
            foreach ($allRoles as $role) {
                if ($rolesToAssign->contains('name', $role->name)) {
                    $role->givePermissionTo($perm);
                } else {
                    $role->revokePermissionTo($perm);
                }
            }

            $perm->load('roles');
            $createdPermObjects[] = $perm;
        }

        // Cabut role dari aksi CRUD yang tidak dipilih jika permission lama pernah ada
        $unselectedActions = array_diff($allPossibleActions, array_map('strtolower', $actions));
        foreach ($unselectedActions as $unAct) {
            $unPermName = "{$unAct} {$prefix}";
            $unPerm = Permission::where('name', $unPermName)->first();
            if ($unPerm) {
                foreach ($allRoles as $role) {
                    $role->revokePermissionTo($unPerm);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => count($createdPermObjects) . " izin akses untuk modul `{$prefix}` berhasil diperbarui dan disinkronkan.",
            'permissions' => $createdPermObjects,
        ]);
    }
}
