<!--begin::Menu wrapper-->
<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend"
    data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
    <!--begin::Menu-->
    <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold my-5 my-lg-0 align-items-stretch px-2 px-lg-0"
        id="#kt_header_menu" data-kt-menu="true">

        {{-- Menu tambahan: sumber seeder / database --}}
        @php
            $additionalSections = sidebarAdditionalMenuSections();
        @endphp

        @foreach ($additionalSections as $section)
            @php
                $checkActiveRecursive = null;
                $checkActiveRecursive = function ($items) use (&$checkActiveRecursive) {
                    foreach ($items as $item) {
                        if (isset($item['route']) && request()->routeIs($item['route'] . '*')) {
                            return true;
                        }
                        $allKids = array_merge($item['children'] ?? [], $item['children_collapsed'] ?? []);
                        if (!empty($allKids) && $checkActiveRecursive($allKids)) {
                            return true;
                        }
                    }
                    return false;
                };
                $isSectionActive = $checkActiveRecursive($section['menus'] ?? []);
            @endphp
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                class="menu-item {{ $isSectionActive ? 'here show' : '' }} menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                <!--begin:Menu link-->
                <span class="menu-link py-3">
                    <span class="menu-title">{{ $section['label'] }}</span>
                    <span class="menu-arrow d-lg-none"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                    <!--begin:Menu item-->
                    @foreach ($section['menus'] as $menuItem)
                        @include('layouts.partials.header._menu._menu_item_apps', ['menu' => $menuItem])
                    @endforeach
                    <!--end:Menu item-->
                </div><!--end:Menu sub-->
            </div><!--end:Menu item-->
        @endforeach

        <!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
            data-kt-feature-menu="top_menu_dashboard"
            style="{{ !app_fitur('top_menu_dashboard') ? 'display: none !important;' : '' }}"
            class="menu-item {{ request()->routeIs(['dashboard', 'dashboards.*']) ? 'here show' : '' }} {{ !app_fitur('top_menu_dashboard') ? 'd-none' : '' }} menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title" data-kt-translate="menu.dashboards">{{ __('menu.dashboards') }}</span>
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
            data-kt-feature-menu="top_menu_pages"
            style="{{ !app_fitur('top_menu_pages') ? 'display: none !important;' : '' }}"
            class="menu-item {{ request()->routeIs('pages.*') ? 'here show' : '' }} {{ !app_fitur('top_menu_pages') ? 'd-none' : '' }} menu-lg-down-accordion me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title" data-kt-translate="menu.pages">{{ __('menu.pages') }}</span>
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
            data-kt-feature-menu="top_menu_apps"
            style="{{ !app_fitur('top_menu_apps') ? 'display: none !important;' : '' }}"
            class="menu-item {{ request()->routeIs(['apps.*']) ? 'here show' : '' }} {{ !app_fitur('top_menu_apps') ? 'd-none' : '' }} menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title" data-kt-translate="menu.apps">{{ __('menu.apps') }}</span>
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
            data-kt-feature-menu="top_menu_demo"
            style="{{ !app_fitur('top_menu_demo') ? 'display: none !important;' : '' }}"
            class="menu-item {{ request()->routeIs(['demo.*']) ? 'here show' : '' }} {{ !app_fitur('top_menu_demo') ? 'd-none' : '' }} menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title" data-kt-translate="menu.demo">{{ __('menu.demo') }}</span>
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
            data-kt-feature-menu="top_menu_help"
            style="{{ !app_fitur('top_menu_help') ? 'display: none !important;' : '' }}"
            class="menu-item {{ request()->routeIs(['help.*']) ? 'here show' : '' }} {{ !app_fitur('top_menu_help') ? 'd-none' : '' }} menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link py-3">
                <span class="menu-title" data-kt-translate="menu.help">{{ __('menu.help') }}</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-225px">
                <!--begin:Menu item-->
                @foreach (config('header._header_help.help_menus') as $menuHelp)
                    @include('layouts.partials.header._menu._menu_item_apps', ['menu' => $menuHelp])
                @endforeach
                <!--end:Menu item-->
            </div><!--end:Menu sub-->
        </div><!--end:Menu item-->
    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->
