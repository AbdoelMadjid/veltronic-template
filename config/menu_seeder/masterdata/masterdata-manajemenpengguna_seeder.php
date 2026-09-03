<?php

return [
    'title' => 'Manajemen Pengguna',
    'title_en' => 'User Management',
    'title_key' => 'md_manajemen_pengguna',
    'route' => 'datamaster.manajemenpengguna',
    'icon' => 'ki-duotone ki-lock-3 fs-2',
    'paths' => 3,
    'permissions' => ['read'],
    'roles' => ['admin', 'master'],
    'children' => [
        [
            'title' => 'Role',
            'title_en' => 'Role',
            'title_key' => 'md_role',
            'route' => 'datamaster.manajemenpengguna.roles',
            'permissions' => ['create', 'read', 'update', 'delete'],
            'roles' => ['admin', 'master'],
        ],
        [
            'title' => 'Permission',
            'title_en' => 'Permission',
            'title_key' => 'md_permission',
            'route' => 'datamaster.manajemenpengguna.permissions',
            'permissions' => ['create', 'read', 'update', 'delete'],
            'roles' => ['admin', 'master'],
        ],
        [
            'title' => 'Akses Role',
            'title_en' => 'Role Access',
            'title_key' => 'md_akses_role',
            'route' => 'datamaster.manajemenpengguna.akses-role',
            'permissions' => ['read', 'update'],
            'roles' => ['admin', 'master'],
        ],
        [
            'title' => 'Akses User',
            'title_en' => 'User Access',
            'title_key' => 'md_akses_user',
            'route' => 'datamaster.manajemenpengguna.akses-user',
            'permissions' => ['read', 'update'],
            'roles' => ['admin', 'master'],
        ],
        [
            'title' => 'User',
            'title_en' => 'Users',
            'title_key' => 'md_user',
            'route' => 'datamaster.manajemenpengguna.users',
            'permissions' => ['create', 'read', 'update', 'delete'],
            'roles' => ['admin', 'master'],
        ],
    ],
];
