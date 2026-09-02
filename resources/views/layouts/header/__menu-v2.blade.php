<!--begin::Menu wrapper-->
<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend"
    data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
    <!--begin::Menu-->
    <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold my-5 my-lg-0 align-items-stretch px-2 px-lg-0"
        id="#kt_header_menu" data-kt-menu="true">
        <!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
            class="menu-item {{ request()->routeIs(['dashboard', 'dashboards.*']) ? 'here show' : '' }} menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title">{{ __('menu.dashboards') }}</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
                <!--layout-partial:layout/partials/header/_menu/__dashboards.html-->
                @include('layouts.partials.header._menu.__dashboards')
            </div><!--end:Menu sub-->
        </div><!--end:Menu item-->
        <!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
            class="menu-item {{ request()->routeIs('pages.*') ? 'here show' : '' }} menu-lg-down-accordion me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title">{{ __('menu.pages') }}</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0">
                <!--layout-partial:layout/partials/header/_menu/__pages.html-->
                @include('layouts.partials.header._menu.__pages')
            </div><!--end:Menu sub-->
        </div><!--end:Menu item--><!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
            class="menu-item {{ request()->routeIs(['apps.*']) ? 'here show' : '' }} menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title">{{ __('menu.apps') }}</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                <!--begin:Menu item-->
                <!--begin:Menu item-->
                @foreach (config('header._header_apps.apps_menus') as $menuApps)
                    @include('layouts.partials.header._menu._menu_item_apps', ['menu' => $menuApps])
                @endforeach
                <!--end:Menu item-->
            </div><!--end:Menu sub-->
        </div><!--end:Menu item-->
        <!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
            class="menu-item {{ request()->routeIs(['demo.*']) ? 'here show' : '' }} menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title">{{ __('menu.demo') }}</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                <!--begin:Menu item-->
                <!--begin:Menu item-->
                @foreach (config('header._header_demo.demos_menu') as $menuDemo)
                    @include('layouts.partials.header._menu._menu_item_apps', ['menu' => $menuDemo])
                @endforeach
                <!--end:Menu item-->
            </div><!--end:Menu sub-->
        </div><!--end:Menu item-->
        <!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
            class="menu-item {{ request()->routeIs(['help.*']) ? 'here show' : '' }} menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title">{{ __('menu.help') }}</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-860px">
                @php
                    $helpMenus = config('header._header_help.help_menus');
                    $schemaMenu = collect($helpMenus)->first(fn($m) => !empty($m['children']));
                    $otherHelpMenus = collect($helpMenus)->filter(fn($m) => empty($m['children']))->values();
                    $schemaChildren = collect($schemaMenu['children'] ?? [])
                        ->sortBy(function ($child) {
                            $title = strtolower((string) ($child['title'] ?? ''));
                            return match ($title) {
                                'overview' => 1,
                                'operasional' => 2,
                                'skema' => 3,
                                default => 9,
                            };
                        })
                        ->values();
                @endphp

                <div class="p-4 p-lg-5">
                    <div class="row g-4">
                        @if (!empty($schemaMenu))
                            @foreach ($schemaChildren as $child)
                                @php
                                    $childTitleKey =
                                        'menu.' .
                                        strtolower(str_replace([' ', '&', '/'], ['_', 'and', '_'], $child['title']));
                                    $childHasChildren = !empty($child['children']);
                                @endphp
                                <div class="col-lg-4">
                                    <div class="rounded border border-gray-200 p-3 h-100">
                                        <div class="fw-bold text-gray-700 text-uppercase fs-8 mb-2">
                                            {{ __($childTitleKey) != $childTitleKey ? __($childTitleKey) : $child['title'] }}
                                        </div>

                                        <div class="overflow-auto pe-1" style="max-height: 320px;">
                                            @if ($childHasChildren)
                                                @foreach ($child['children'] as $grandchild)
                                                    @php
                                                        $grandchildTitleKey =
                                                            'menu.' .
                                                            strtolower(
                                                                str_replace(
                                                                    [' ', '&', '/'],
                                                                    ['_', 'and', '_'],
                                                                    $grandchild['title'],
                                                                ),
                                                            );
                                                        $grandchildHref = isset($grandchild['route'])
                                                            ? route($grandchild['route'])
                                                            : $grandchild['href'] ?? '#';
                                                        $grandchildActive =
                                                            isset($grandchild['route']) &&
                                                            request()->routeIs($grandchild['route'] . '*');
                                                    @endphp
                                                    <div class="menu-item">
                                                        <a class="menu-link px-0 py-1 {{ $grandchildActive ? 'active' : '' }}"
                                                            href="{{ $grandchildHref }}">
                                                            <span class="menu-bullet"><span
                                                                    class="bullet bullet-dot"></span></span>
                                                            <span class="menu-title fs-7">
                                                                {{ __($grandchildTitleKey) != $grandchildTitleKey ? __($grandchildTitleKey) : $grandchild['title'] }}
                                                            </span>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @else
                                                @php
                                                    $childHref = isset($child['route'])
                                                        ? route($child['route'])
                                                        : $child['href'] ?? '#';
                                                    $childActive =
                                                        isset($child['route']) &&
                                                        request()->routeIs($child['route'] . '*');
                                                @endphp
                                                <div class="menu-item">
                                                    <a class="menu-link px-0 py-1 {{ $childActive ? 'active' : '' }}"
                                                        href="{{ $childHref }}">
                                                        <span class="menu-bullet"><span
                                                                class="bullet bullet-dot"></span></span>
                                                        <span class="menu-title fs-7">
                                                            {{ __($childTitleKey) != $childTitleKey ? __($childTitleKey) : $child['title'] }}
                                                        </span>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @if ($otherHelpMenus->isNotEmpty())
                        <div class="separator my-4"></div>
                        <div class="row g-2">
                            @foreach ($otherHelpMenus as $menu)
                                @php
                                    $titleKey =
                                        'menu.' .
                                        strtolower(str_replace([' ', '&', '/'], ['_', 'and', '_'], $menu['title']));
                                    $menuHref = isset($menu['route']) ? route($menu['route']) : $menu['href'] ?? '#';
                                    $isExternal = !isset($menu['route']);
                                    $isActive = isset($menu['route']) && request()->routeIs($menu['route'] . '*');
                                @endphp
                                <div class="col-lg-4">
                                    <a class="menu-link rounded border border-gray-200 py-2 {{ $isActive ? 'active' : '' }}"
                                        href="{{ $menuHref }}"
                                        @if (isset($menu['target'])) target="{{ $menu['target'] }}" @elseif($isExternal) target="_blank" @endif>
                                        <span class="menu-icon">
                                            <i class="{{ $menu['icon'] }}">
                                                @for ($i = 1; $i <= $menu['paths']; $i++)
                                                    <span class="path{{ $i }}"></span>
                                                @endfor
                                            </i>
                                        </span>
                                        <span class="menu-title">
                                            {{ __($titleKey) != $titleKey ? __($titleKey) : $menu['title'] }}
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div><!--end:Menu sub-->
        </div><!--end:Menu item-->
    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->
