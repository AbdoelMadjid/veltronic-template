@php
    $variant = $variant ?? 'full_duotone_route';

    $baseItems = [
        [
            'title' => 'User Profile',
            'icon' => 'gift',
            'paths' => 4,
            'route' => url('pages/account/overview'),
            'static' => 'account/overview.html',
        ],
        [
            'title' => 'Statements',
            'icon' => 'technology-2',
            'paths' => 2,
            'route' => url('pages/account/statements'),
            'static' => 'account/statements.html',
        ],
        [
            'title' => 'Best Referrals',
            'icon' => 'fingerprint-scanning',
            'paths' => 5,
            'route' => url('pages/account/referrals'),
            'static' => 'account/referrals.html',
        ],
        [
            'title' => 'Hot Picks',
            'icon' => 'abstract-26',
            'paths' => 2,
            'route' => url('apps/customers/view'),
            'static' => 'apps/customers/view.html',
        ],
        [
            'title' => 'Latest Trands',
            'icon' => 'basket',
            'paths' => 4,
            'route' => url('apps/projects/view'),
            'static' => 'apps/projects/project.html',
        ],
        [
            'title' => 'New Arrivals',
            'icon' => 'rocket',
            'paths' => 2,
            'route' => url('apps/projects/users'),
            'static' => 'apps/projects/users.html',
        ],
        [
            'title' => 'Customers',
            'icon' => 'abstract-36',
            'paths' => 2,
            'route' => url('apps/customers/list'),
            'static' => 'apps/customers/list.html',
        ],
        [
            'title' => 'Messages',
            'icon' => 'timer',
            'paths' => 3,
            'route' => url('apps/chat/private'),
            'static' => 'apps/chat/private.html',
        ],
    ];

    $variants = [
        'full_duotone_route' => [
            'limit' => 8,
            'iconStyle' => 'duotone',
            'hrefType' => 'route',
        ],
        'compact_outline_route' => [
            'limit' => 6,
            'iconStyle' => 'outline',
            'hrefType' => 'route',
        ],
        'compact_duotone_static' => [
            'limit' => 6,
            'iconStyle' => 'duotone',
            'hrefType' => 'static',
        ],
    ];

    $config = $variants[$variant] ?? $variants['full_duotone_route'];
    $items = array_slice($baseItems, 0, $config['limit']);
@endphp

<!--begin::Misc Widget 1-->
<div class="row mb-5 mb-xl-8 g-5 g-xl-8">
    @foreach ($items as $item)
        <!--begin::Col-->
        <div class="col-6">
            <!--begin::Card-->
            <a class="card flex-column justfiy-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10"
                href="{{ $config['hrefType'] === 'route' ? $item['route'] : $item['static'] }}">
                @if ($config['iconStyle'] === 'duotone')
                    <i class="ki-duotone ki-{{ $item['icon'] }} fs-2tx mb-5 ms-n1 text-gray-500">
                        @for ($i = 1; $i <= $item['paths']; $i++)
                            <span class="path{{ $i }}"></span>
                        @endfor
                    </i>
                @else
                    <i class="ki-outline ki-{{ $item['icon'] }} fs-2tx mb-5 ms-n1 text-gray-500"></i>
                @endif
                <span class="fs-4 fw-bold">{{ $item['title'] }}</span>
            </a>
            <!--end::Card-->
        </div>
        <!--end::Col-->
    @endforeach
</div>
<!--end::Misc Widget 1-->
