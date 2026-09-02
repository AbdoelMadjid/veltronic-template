<!--begin::Toolbar wrapper-->
<div class="topbar d-flex align-items-stretch flex-shrink-0">
    <!--begin::Search-->
    <div class="d-flex align-items-stretch ms-1 ms-lg-3">
        <!--layout-partial:partials/search/_dropdown.html-->
        @include('partials.search._dropdown')
    </div>
    <!--end::Search-->
    <!--begin::Activities-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
        <!--begin::Drawer toggle-->
        <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
            id="kt_activities_toggle">
            <i class="ki-duotone ki-chart-simple fs-1"><span class="path1"></span><span class="path2"></span><span
                    class="path3"></span><span class="path4"></span></i>
        </div>
        <!--end::Drawer toggle-->
    </div>
    <!--end::Activities-->
    <!--begin::Notifications-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
        <!--begin::Menu- wrapper-->
        <div class="position-relative btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
            data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="ki-duotone ki-binance fs-1"><span class="path1"></span><span class="path2"></span><span
                    class="path3"></span><span class="path4"></span><span class="path5"></span></i>
        </div>
        <!--layout-partial:partials/menus/_notifications-menu.html-->
        @include('partials.menus._notifications-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Notifications-->
    <!--begin::Chat-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
        <!--begin::Menu wrapper-->
        <div class="position-relative btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
            id="kt_drawer_chat_toggle">
            <i class="ki-duotone ki-message-text-2 fs-1"><span class="path1"></span><span class="path2"></span><span
                    class="path3"></span></i>
            <span
                class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink">
            </span>
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::Chat-->
    <!--begin::Quick links-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
            data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="ki-duotone ki-element-11 fs-1"><span class="path1"></span><span class="path2"></span><span
                    class="path3"></span><span class="path4"></span></i>
        </div>
        <!--layout-partial:partials/menus/_quick-links-menu.html-->
        @include('partials.menus._quick-links-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Quick links-->
    <!--begin::Theme mode-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
        <!--layout-partial:partials/theme-mode/_main.html-->
        @include('partials.theme-mode._main')
    </div>
    <!--end::Theme mode-->
    <!--begin::Icon style-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
        @include('partials.icon-style._main')
    </div>
    <!--end::Icon style-->
    <!--begin::Language-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            @if (app()->getLocale() == 'id')
                <img class="w-20px h-20px rounded-1"
                    src="{{ asset(($theme_asset_base ?? 'assets') . '/media/flags/indonesia.svg') }}" alt="Indonesia" />
            @else
                <img class="w-20px h-20px rounded-1"
                    src="{{ asset(($theme_asset_base ?? 'assets') . '/media/flags/united-states.svg') }}" alt="English" />
            @endif
        </div>
        <!--begin::Menu sub-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-175px py-4 fs-7"
            data-kt-menu="true">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('lang.switch', 'en') }}"
                    class="menu-link d-flex px-5 {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                    <span class="symbol symbol-20px me-4">
                        <img class="rounded-1"
                            src="{{ asset(($theme_asset_base ?? 'assets') . '/media/flags/united-states.svg') }}"
                            alt="" />
                    </span>
                    {{ __('menu.english') }}
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('lang.switch', 'id') }}"
                    class="menu-link d-flex px-5 {{ app()->getLocale() == 'id' ? 'active' : '' }}">
                    <span class="symbol symbol-20px me-4">
                        <img class="rounded-1"
                            src="{{ asset(($theme_asset_base ?? 'assets') . '/media/flags/indonesia.svg') }}" alt="" />
                    </span>
                    {{ __('menu.indonesian') }}
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu sub-->
        <!--end::Menu wrapper-->
    </div>
    <!--end::Language-->
    <!--begin::Version switcher-->
    @php
        $currentVersion = \App\Support\ThemeVersion::current();
        $themeVersions = \App\Support\ThemeVersion::available();
    @endphp
    <div class="d-flex align-items-center ms-1 ms-lg-3">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end" title="Theme Version">
            <i class="ki-duotone ki-cube-2 fs-1">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
        </div>
        <!--begin::Menu sub-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-175px py-4 fs-7"
            data-kt-menu="true">
            <div class="menu-item px-3">
                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                    Theme Version
                </div>
            </div>
            @foreach ($themeVersions as $version)
                <div class="menu-item px-3">
                    <a href="{{ route('theme.version.switch', $version) }}"
                        class="menu-link d-flex px-5 {{ $currentVersion === $version ? 'active' : '' }}">
                        <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1 me-2">{{ strtoupper($version) }}</span>
                        {{ 'Metronic ' . strtoupper($version) }}
                    </a>
                </div>
            @endforeach
        </div>
        <!--end::Menu sub-->
        <!--end::Menu wrapper-->
    </div>
    <!--end::Version switcher-->
    <!--begin::Frontpages-->
    <div class="d-flex align-items-center ms-1 ms-lg-3">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" title="Frontpages & Templates">
            <i class="ki-duotone ki-screen fs-1">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
            </i>
        </div>
        <!--layout-partial:partials/menus/_frontpages-menu.blade.php-->
        @include('partials.menus._frontpages-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Frontpages-->
    <!--begin::User-->
    <div class="d-flex align-items-center me-lg-n2 ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        @php($avatar = $current_user_display['avatar'] ?? asset(($theme_asset_base ?? 'assets') . '/media/avatars/300-1.jpg'))
        <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
            data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <img class="h-30px w-30px rounded" src="{{ $avatar }}" alt="" />
        </div>
        <!--layout-partial:partials/menus/_user-account-menu.html-->
        @include('partials.menus._user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User -->
    <!--begin::Aside mobile toggle-->
    <!--end::Aside mobile toggle-->
</div>
<!--end::Toolbar wrapper-->
