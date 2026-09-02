<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Search-->
    <div class="app-navbar-item align-items-stretch ms-1 ms-md-4">
        <!--layout-partial:partials/search/_dropdown.html-->
        @include('partials.search._dropdown')
    </div>
    <!--end::Search-->
    <!--begin::Activities-->
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Drawer toggle-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
            id="kt_activities_toggle">
            <i class="ki-duotone ki-messages fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
            </i>
        </div>
        <!--end::Drawer toggle-->
    </div>
    <!--end::Activities-->
    <!--begin::Notifications-->
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
            <i class="ki-duotone ki-notification-status fs-2">
                <span class="path1"></span>
                <span
                    class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
        </div>
        <!--layout-partial:partials/menus/_notifications-menu.html-->
        @include('partials.menus._notifications-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Notifications-->
    <!--begin::Chat-->
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative"
            id="kt_drawer_chat_toggle">
            <i class="ki-duotone ki-message-text-2 fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span
                    class="path3"></span>
                </i>
            <span
                class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink">
            </span>
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::Chat-->
    <!--begin::My apps links-->
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <i class="ki-duotone ki-element-11 fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span
                    class="path3"></span>
                    <span class="path4"></span>
                </i>
        </div>
        <!--layout-partial:partials/menus/_my-apps-menu.html-->
        @include('partials.menus._my-apps-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::My apps links-->
    <!--begin::Theme mode-->
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--layout-partial:partials/theme-mode/_main.html-->
        @include('partials.theme-mode._main')
    </div>
    <!--end::Theme mode-->
    <!--begin::Language-->
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
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
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end" title="Theme Version">
            <i class="ki-duotone ki-cube-2 fs-2">
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
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end" title="Frontpages & Templates">
            <i class="ki-duotone ki-screen fs-2">
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
    <!--begin::User menu-->
    <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        @php
            $assetBase = $theme_asset_base ?? 'assets';
            $authUser = auth()->user();
            $avatar =
                $authUser?->profile_photo_url ??
                ($authUser?->avatar_url ??
                    ((isset($authUser?->avatar) && is_string($authUser->avatar)
                        ? (str_starts_with($authUser->avatar, 'http')
                            ? $authUser->avatar
                            : asset(ltrim($authUser->avatar, '/')))
                        : null) ??
                        asset($assetBase . '/media/avatars/300-1.jpg')));
        @endphp
        <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <img src="{{ $avatar }}" class="rounded-3" alt="user" />
        </div>
        <!--layout-partial:partials/menus/_user-account-menu.html-->
        @include('partials.menus._user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Header menu toggle-->
    <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
        <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
            <i class="ki-duotone ki-element-4 fs-1">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    <!--end::Header menu toggle-->
    
    @if (
        request()->is('layouts/asides/aside-1') ||
            request()->is('layouts/asides/aside-2') ||
            request()->is('layouts/asides/aside-3') ||
            request()->is('layouts/asides/aside-4') ||
            request()->is('layouts/asides/aside-5'))
        <!--begin::Aside toggle-->
        <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show aside">
            <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_aside_toggle">
                <i class="ki-duotone ki-trello fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </div>
        </div>
        <!--end::Header menu toggle-->
    @endif
</div>
<!--end::Navbar-->
