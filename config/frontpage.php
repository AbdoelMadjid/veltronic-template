<?php

return [
    'default' => env('DEFAULT_FRONTPAGE', 'landing'),

    'pages' => [
        'landing' => [
            'name' => 'Landing Page',
            'desc' => 'Metronic 8 Marketing & Corporate Landing',
            'view' => 'frontpages.landing.v1.landing',
            'url' => '/landing',
            'icon' => 'ki-rocket',
            'badge' => 'Metronic 8',
            'color' => 'primary',
        ],
        'education' => [
            'name' => 'Education Portal',
            'desc' => 'University & Academic Multipage',
            'view' => 'frontpages.education.home-page',
            'url' => '/education',
            'icon' => 'ki-teacher',
            'badge' => 'Unify v2.6',
            'color' => 'warning',
        ],
    ],
];
