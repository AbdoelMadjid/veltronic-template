<?php

return [
    'default_version' => env('THEME_DEFAULT_VERSION', 'v1'),

    // Satu registri untuk versi yang bisa dipilih, lokasi view, dan lokasi asset.
    // View/asset lama tetap didukung sebagai fallback selama migrasi bertahap.
    'themes' => [
        'v1' => ['label' => 'Tema V1', 'view_path' => 'themes/v1', 'asset_base' => 'assets'],
        'v2' => ['label' => 'Tema V2', 'view_path' => 'themes/v2', 'asset_base' => 'assets'],
    ],

    // Alias kompatibilitas untuk kode lama.
    'versions' => ['v1', 'v2'],
    'asset_bases' => ['v1' => 'assets', 'v2' => 'assets'],

    // auto => ikut session theme_version
    'asset_pack' => env('THEME_ASSET_PACK', 'auto'),

    // auto => ikut session theme_version
    'menu_style' => env('THEME_MENU_STYLE', 'auto'),
];
