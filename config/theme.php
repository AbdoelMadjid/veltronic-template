<?php

return [
    'default_version' => env('THEME_DEFAULT_VERSION', 'v1'),

    // daftar versi yang diizinkan untuk switch runtime
    'versions' => ['v1', 'v2'],

    // mapping versi -> base folder assets
    'asset_bases' => [
        'v1' => 'assets',
        'v2' => 'assets',
    ],

    // auto => ikut session theme_version
    'asset_pack' => env('THEME_ASSET_PACK', 'auto'),

    // auto => ikut session theme_version
    'menu_style' => env('THEME_MENU_STYLE', 'auto'),
];
