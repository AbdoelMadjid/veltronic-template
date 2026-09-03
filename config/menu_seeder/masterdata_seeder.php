<?php

$parentMenuFiles = [
    __DIR__ . '/identitaspengguna_seeder.php',
    __DIR__ . '/masterdata/masterdata-manajemenpengguna_seeder.php',
    __DIR__ . '/masterdata/masterdata-appsupport_seeder.php',
];

$menus = [];
foreach ($parentMenuFiles as $parentMenuFile) {
    if (!is_file($parentMenuFile)) {
        continue;
    }

    $menu = require $parentMenuFile;
    if (is_array($menu) && !empty($menu)) {
        $menus[] = $menu;
    }
}

return [
    'Master Data' => [
        'title_en' => 'Master Data',
        'title_key' => 'md_masterdata',
        'default_permissions' => ['read'],
        'default_roles' => ['admin', 'master'],
        'menus' => $menus,
    ],
];
