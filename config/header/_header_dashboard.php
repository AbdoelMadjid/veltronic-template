<?php

return [
    'header_dashboard_other' => [
        ['route' => 'main.dashboards.logistics', 'title' => 'Logistics'],
        ['route' => 'main.dashboards.website-analytics', 'title' => 'Website Analytics'],
        ['route' => 'main.dashboards.finance-performance', 'title' => 'Finance Performance'],
        ['route' => 'main.dashboards.store-analytics', 'title' => 'Store Analytics'],
        ['route' => 'main.dashboards.social', 'title' => 'Social'],
        ['route' => 'main.dashboards.delivery', 'title' => 'Delivery'],
        ['route' => 'main.dashboards.crypto', 'title' => 'Crypto'],
        ['route' => 'main.dashboards.school', 'title' => 'School'],
        ['route' => 'main.dashboards.podcast', 'title' => 'Podcast'],
    ],

    'header_dashboard_card' => [
        [
            'route'       => 'dashboard',
            'icon'        => 'ki-duotone ki-element-11 text-primary fs-1',
            'paths'       => 4,
            'title'       => 'Default',
            'description' => 'Reports & statistics',
        ],
        [
            'route'       => 'main.dashboards.ecommerce',
            'icon'        => 'ki-duotone ki-basket text-danger fs-1',
            'paths'       => 4,
            'title'       => 'eCommerce',
            'description' => 'Sales reports',
        ],
        [
            'route'       => 'main.dashboards.projects',
            'icon'        => 'ki-duotone ki-abstract-44 text-info fs-1',
            'paths'       => 2,
            'title'       => 'Projects',
            'description' => 'Tasks, graphs & charts',
        ],
        [
            'route'       => 'main.dashboards.online-courses',
            'icon'        => 'ki-duotone ki-color-swatch text-success fs-1',
            'paths'       => 21,
            'title'       => 'Online Courses',
            'description' => 'Student progress',
        ],
        [
            'route'       => 'main.dashboards.marketing',
            'icon'        => 'ki-duotone ki-chart-simple text-gray-900 fs-1',
            'paths'       => 4,
            'title'       => 'Marketing',
            'description' => 'Campaings & conversions',
        ],
        [
            'route'       => 'main.dashboards.bidding',
            'icon'        => 'ki-duotone ki-switch text-warning fs-1',
            'paths'       => 2,
            'title'       => 'Bidding',
            'description' => 'Campaings & conversions',
        ],
        [
            'route'       => 'main.dashboards.pos',
            'icon'        => 'ki-duotone ki-abstract-42 text-danger fs-1',
            'paths'       => 2,
            'title'       => 'POS System',
            'description' => 'Campaings & conversions',
        ],
        [
            'route'       => 'main.dashboards.call-center',
            'icon'        => 'ki-duotone ki-call text-primary fs-1',
            'paths'       => 8,
            'title'       => 'Call Center',
            'description' => 'Campaings & conversions',
        ],
    ],

];
