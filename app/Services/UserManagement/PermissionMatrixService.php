<?php

namespace App\Services\UserManagement;

use App\Models\AppSupport\Menu;
use App\Models\UserManagement\Permission;

class PermissionMatrixService
{
    /**
     * Membangun representasi hirarki Menu & CRUD Matrix Permissions (Multi-Level 1, 2, 3)
     *
     * @return array
     */
    public static function getMatrixTree(): array
    {
        $menus = Menu::with(['subMenus.subMenus'])
            ->whereNull('main_menu_id')
            ->orderBy('orders', 'asc')
            ->get();

        $allPermissions = Permission::all();
        $tree = [];

        foreach ($menus as $mainMenu) {
            $hasLevel2 = $mainMenu->subMenus && $mainMenu->subMenus->count() > 0;
            $mainRow = self::buildModuleRow($mainMenu, null, $allPermissions, 1, null, $hasLevel2);
            $tree[] = $mainRow;

            if ($hasLevel2) {
                foreach ($mainMenu->subMenus as $subMenu) {
                    $hasLevel3 = $subMenu->subMenus && $subMenu->subMenus->count() > 0;
                    $subRow = self::buildModuleRow($subMenu, $mainMenu->name, $allPermissions, 2, $mainMenu->id, $hasLevel3);
                    $tree[] = $subRow;

                    if ($hasLevel3) {
                        foreach ($subMenu->subMenus as $ssMenu) {
                            $ssRow = self::buildModuleRow($ssMenu, $subMenu->name, $allPermissions, 3, $subMenu->id, false);
                            $tree[] = $ssRow;
                        }
                    }
                }
            }
        }

        return $tree;
    }

    /**
     * Membangun 1 baris modul pada matriks CRUD
     */
    protected static function buildModuleRow($menu, ?string $parentName, $allPermissions, int $level = 1, ?int $parentId = null, bool $hasChildren = false): array
    {
        $url = trim($menu->url ?? '', '/');
        $isParent = ($level === 1);

        $slugName = \Illuminate\Support\Str::slug($menu->name);
        $dotUrl = !empty($url) ? str_replace('/', '.', $url) : '';

        // Cari permission yang berkaitan dengan menu ini
        $matchedPermissions = $allPermissions->filter(function ($perm) use ($url, $dotUrl, $slugName, $menu) {
            $pName = trim($perm->name);
            if (empty($pName)) return false;

            // Cek format spasi "read usermanagement/roles" atau "read manajemen-pengguna"
            if (!empty($url) && (str_ends_with($pName, " {$url}") || $pName === $url)) {
                return true;
            }

            // Cek format dot "usermanagement.roles.read"
            if (!empty($dotUrl) && (str_starts_with($pName, "{$dotUrl}.") || str_ends_with($pName, ".{$dotUrl}"))) {
                return true;
            }

            // Cek format slug nama "read roles" atau "read master-barang"
            if (!empty($slugName) && (str_ends_with($pName, " {$slugName}") || $pName === $slugName)) {
                return true;
            }

            // Cek nama menu langsung
            if (str_ends_with(strtolower($pName), " " . strtolower($menu->name))) {
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
        $defaultIcon = $isParent ? 'ki-duotone ki-element-11 fs-2' : ($level === 2 ? 'ki-duotone ki-abstract-14 fs-3' : 'ki-duotone ki-dots-square fs-4');
        $icon = !empty($menu->icon) ? $menu->icon : $defaultIcon;

        return [
            'id' => $menu->id,
            'name' => $menu->name,
            'url' => $url,
            'icon' => $icon,
            'level' => $level,
            'parent_id' => $parentId,
            'has_children' => $hasChildren,
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
