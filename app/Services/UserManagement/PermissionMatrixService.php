<?php

namespace App\Services\UserManagement;

use App\Models\AppSupport\Menu;
use App\Models\UserManagement\Permission;

class PermissionMatrixService
{
    /**
     * Membangun representasi hirarki Menu & CRUD Matrix Permissions
     *
     * @return array
     */
    public static function getMatrixTree(): array
    {
        $menus = Menu::with(['subMenus' => function ($q) {
            $q->orderBy('orders', 'asc');
        }])
        ->whereNull('main_menu_id')
        ->orderBy('orders', 'asc')
        ->get();

        $allPermissions = Permission::all();

        // Helper map permissions berdasarkan url & aksi
        // Format di DB: "read profil/profil-pengguna", "create usermanagement/roles", "sort appsupport/menu"
        // Atau dot format: "usermanagement.roles.create"
        $tree = [];

        foreach ($menus as $mainMenu) {
            $mainRow = self::buildModuleRow($mainMenu, null, $allPermissions);
            $tree[] = $mainRow;

            // Jika punya sub-menus
            if ($mainMenu->subMenus && $mainMenu->subMenus->count() > 0) {
                foreach ($mainMenu->subMenus as $subMenu) {
                    $subRow = self::buildModuleRow($subMenu, $mainMenu->name, $allPermissions);
                    $tree[] = $subRow;
                }
            }
        }

        return $tree;
    }

    /**
     * Membangun 1 baris modul pada matriks CRUD
     */
    protected static function buildModuleRow($menu, ?string $parentName, $allPermissions): array
    {
        $url = trim($menu->url ?? '', '/');
        $isParent = empty($parentName);

        // Cari permission yang berkaitan dengan menu ini
        // Pola pencarian: "create {$url}", "read {$url}", "update {$url}", "delete {$url}", "sort {$url}", dll.
        // Atau penamaan titik: "{$url}.create"
        $matchedPermissions = $allPermissions->filter(function ($perm) use ($url) {
            $pName = trim($perm->name);
            if (empty($url)) return false;

            // Cek format spasi "read usermanagement/roles"
            if (str_ends_with($pName, " {$url}") || $pName === $url) {
                return true;
            }

            // Cek format dot "usermanagement.roles.read"
            $dotUrl = str_replace('/', '.', $url);
            if (str_starts_with($pName, "{$dotUrl}.") || str_ends_with($pName, ".{$dotUrl}")) {
                return true;
            }

            return false;
        });

        // Kategorikan ke dalam CRUD + Other
        $createPerm = null;
        $readPerm = null;
        $updatePerm = null;
        $deletePerm = null;
        $otherPerms = [];
        $allRowPerms = [];

        foreach ($matchedPermissions as $perm) {
            $pName = trim($perm->name);
            $action = strtolower(explode(' ', $pName)[0]);

            // Jika format dot "usermanagement.roles.create"
            if (str_contains($pName, '.')) {
                $parts = explode('.', $pName);
                $action = strtolower(end($parts));
            }

            $permItem = [
                'id' => $perm->id,
                'name' => $perm->name,
                'guard_name' => $perm->guard_name,
            ];

            $allRowPerms[] = $perm->name;

            if (in_array($action, ['create', 'store', 'add', 'tambah'])) {
                $createPerm = $permItem;
            } elseif (in_array($action, ['read', 'index', 'view', 'show', 'lihat'])) {
                $readPerm = $permItem;
            } elseif (in_array($action, ['update', 'edit', 'ubah', 'toggle'])) {
                $updatePerm = $permItem;
            } elseif (in_array($action, ['delete', 'destroy', 'hapus'])) {
                $deletePerm = $permItem;
            } else {
                $permItem['action_label'] = ucfirst($action);
                $otherPerms[] = $permItem;
            }
        }

        // Tentukan Icon & Style
        $defaultIcon = $isParent ? 'ki-duotone ki-element-11 fs-2' : 'ki-duotone ki-abstract-14 fs-3';
        $icon = !empty($menu->icon) ? $menu->icon : $defaultIcon;

        return [
            'id' => $menu->id,
            'name' => $menu->name,
            'url' => $url,
            'icon' => $icon,
            'is_parent' => $isParent,
            'parent_name' => $parentName,
            'create' => $createPerm,
            'read' => $readPerm,
            'update' => $updatePerm,
            'delete' => $deletePerm,
            'other' => $otherPerms,
            'all_permissions' => $allRowPerms,
            'total_permissions' => count($allRowPerms),
        ];
    }
}
