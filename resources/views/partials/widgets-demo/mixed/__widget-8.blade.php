@php
    $vars = $vars ?? [];

    $variant = $vars['variant'] ?? ($variant ?? 'default');
    $variantConfig = [
        'default' => [
            'widgetClass' => 'card h-xl-100 mb-xl-8',
            'symbolBgClass' => 'bg-danger-light',
            'logo' => 'media/svg/brand-logos/plurk.svg',
            'progressBarClass' => 'bg-danger',
            'menuVariant' => 'menu2',
            'iconVariant' => 'outline',
            'linkHref' => 'javascript:void(0)',
        ],
        'a' => [
            'widgetClass' => 'card h-xl-100 mb-xl-8',
            'symbolBgClass' => 'bg-primary-light',
            'logo' => 'media/svg/brand-logos/vimeo.svg',
            'progressBarClass' => 'bg-primary',
            'menuVariant' => 'menu2',
            'iconVariant' => 'outline',
            'linkHref' => 'javascript:void(0)',
        ],
        'b' => [
            'widgetClass' => 'card card-xl-stretch mb-xl-8',
            'symbolBgClass' => 'bg-danger-light',
            'logo' => 'media/svg/brand-logos/plurk.svg',
            'progressBarClass' => 'bg-danger',
            'menuVariant' => 'quick_actions',
            'iconVariant' => 'duotone',
            'linkHref' => '#',
        ],
        'c' => [
            'widgetClass' => 'card card-xl-stretch mb-xl-8',
            'symbolBgClass' => 'bg-primary-light',
            'logo' => 'media/svg/brand-logos/vimeo.svg',
            'progressBarClass' => 'bg-primary',
            'menuVariant' => 'quick_actions',
            'iconVariant' => 'duotone',
            'linkHref' => '#',
        ],
    ];
    $selectedVariant = $variantConfig[$variant] ?? $variantConfig['default'];

    $widgetClass = $vars['widgetClass'] ?? ($widgetClass ?? $selectedVariant['widgetClass']);
    $symbolBgClass = $vars['symbolBgClass'] ?? ($symbolBgClass ?? $selectedVariant['symbolBgClass']);
    $logo = $vars['logo'] ?? ($logo ?? $selectedVariant['logo']);
    $title = $vars['title'] ?? ($title ?? 'Monthly Subscription');
    $subtitle = $vars['subtitle'] ?? ($subtitle ?? 'Due: 27 Apr 2020');
    $progressLabel = $vars['progressLabel'] ?? ($progressLabel ?? 'Progress');
    $progressValue = (int) ($vars['progressValue'] ?? ($progressValue ?? 75));
    $progressBarClass = $vars['progressBarClass'] ?? ($progressBarClass ?? $selectedVariant['progressBarClass']);
    $teamLabel = $vars['teamLabel'] ?? ($teamLabel ?? 'Team');
    $menuVariant = $vars['menuVariant'] ?? ($menuVariant ?? $selectedVariant['menuVariant']);
    $iconVariant = $vars['iconVariant'] ?? ($iconVariant ?? $selectedVariant['iconVariant']);
    $linkHref = $vars['linkHref'] ?? ($linkHref ?? $selectedVariant['linkHref']);

    $teamMembers = $vars['teamMembers'] ?? ($teamMembers ?? [
        ['name' => 'Ana Stone', 'avatar' => 'media/avatars/300-6.jpg'],
        ['name' => 'Mark Larson', 'avatar' => 'media/avatars/300-5.jpg'],
        ['name' => 'Sam Harris', 'avatar' => 'media/avatars/300-9.jpg'],
        ['name' => 'Alice Micto', 'avatar' => 'media/avatars/300-10.jpg'],
    ]);
@endphp

<!--begin::Mixed Widget 8-->
<div class="{{ $widgetClass }}">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Heading-->
        <div class="d-flex flex-stack">
            <!--begin:Info-->
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60px me-5">
                    <span class="symbol-label {{ $symbolBgClass }}">
                        <img src="{{ \App\Support\ThemeAsset::url($logo, $theme_asset_pack ?? null) }}"
                            class="h-50 align-self-center" alt="" />
                    </span>
                </div>
                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                    <a href="{{ $linkHref }}"
                        class="text-gray-900 fw-bold text-hover-primary fs-5">{{ $title }}</a>
                    <span class="text-muted fw-bold">{{ $subtitle }}</span>
                </div>
            </div>
            <!--begin:Info-->
            <!--begin:Menu-->
            <div class="ms-1">
                <button type="button"
                    class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    @if ($iconVariant === 'duotone')
                        <i class="ki-duotone ki-category fs-6">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    @else
                        <i class="ki-outline ki-category fs-6"></i>
                    @endif
                </button>
                @if ($menuVariant === 'quick_actions')
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                        </div>
                        <div class="separator mb-3 opacity-75"></div>
                        <div class="menu-item px-3"><a href="{{ $linkHref }}" class="menu-link px-3">New Ticket</a></div>
                        <div class="menu-item px-3"><a href="{{ $linkHref }}" class="menu-link px-3">New Customer</a></div>
                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                            <a href="{{ $linkHref }}" class="menu-link px-3">
                                <span class="menu-title">New Group</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <div class="menu-item px-3"><a href="{{ $linkHref }}" class="menu-link px-3">Admin Group</a></div>
                                <div class="menu-item px-3"><a href="{{ $linkHref }}" class="menu-link px-3">Staff Group</a></div>
                                <div class="menu-item px-3"><a href="{{ $linkHref }}" class="menu-link px-3">Member Group</a></div>
                            </div>
                        </div>
                        <div class="menu-item px-3"><a href="{{ $linkHref }}" class="menu-link px-3">New Contact</a></div>
                        <div class="separator mt-3 opacity-75"></div>
                        <div class="menu-item px-3">
                            <div class="menu-content px-3 py-3">
                                <a class="btn btn-primary btn-sm px-4" href="{{ $linkHref }}">Generate Reports</a>
                            </div>
                        </div>
                    </div>
                @else
                    @include('partials.menus._menu-2')
                @endif
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Heading-->
        <!--begin:Stats-->
        <div class="d-flex flex-column w-100 mt-12">
            <span class="text-gray-900 me-2 fw-bold pb-3">{{ $progressLabel }}</span>
            <div class="progress h-5px w-100">
                <div class="progress-bar {{ $progressBarClass }}" role="progressbar"
                    style="width: {{ $progressValue }}%" aria-valuenow="{{ $progressValue }}"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <!--end:Stats-->
        <!--begin:Team-->
        <div class="d-flex flex-column mt-10">
            <div class="text-gray-900 me-2 fw-bold pb-4">{{ $teamLabel }}</div>
            <div class="d-flex">
                @foreach ($teamMembers as $member)
                    <a href="{{ $member['href'] ?? $linkHref }}"
                        class="symbol symbol-35px{{ !$loop->last ? ' me-2' : '' }}"
                        data-bs-toggle="tooltip" title="{{ $member['name'] ?? '' }}">
                        <img src="{{ \App\Support\ThemeAsset::url($member['avatar'], $theme_asset_pack ?? null) }}" alt="" />
                    </a>
                @endforeach
            </div>
        </div>
        <!--end:Team-->
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 8-->
