<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Search-->
    <div class="app-navbar-item align-items-stretch ms-1 ms-md-4 {{ !app_fitur('tool_search') ? 'feature-hidden' : '' }}"
        style="{{ !app_fitur('tool_search') ? 'display: none !important;' : '' }}"
        data-kt-feature-tool="tool_search">
        <!--layout-partial:partials/search/_dropdown.html-->
        @include('partials.search._dropdown')
    </div>
    <!--end::Search-->

    <!--begin::Activities-->
    <div class="app-navbar-item d-none d-lg-flex ms-1 ms-md-4 {{ !app_fitur('tool_activities') ? 'feature-hidden' : '' }}"
        style="{{ !app_fitur('tool_activities') ? 'display: none !important;' : '' }}"
        data-kt-feature-tool="tool_activities">
        <!--begin::Drawer toggle-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
            id="kt_activities_toggle"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
            data-kt-translate-title="menu.activities"
            title="{{ __('menu.activities') }}">
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
    <div class="app-navbar-item d-none d-lg-flex ms-1 ms-md-4 {{ !app_fitur('tool_notifications') ? 'feature-hidden' : '' }}"
        style="{{ !app_fitur('tool_notifications') ? 'display: none !important;' : '' }}"
        data-kt-feature-tool="tool_notifications">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end" id="kt_menu_item_wow"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
            data-kt-translate-title="menu.notifications"
            title="{{ __('menu.notifications') }}">
            <i class="ki-duotone ki-notification-status fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
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
    <div class="app-navbar-item d-none d-lg-flex ms-1 ms-md-4 {{ !app_fitur('tool_chat') ? 'feature-hidden' : '' }}"
        style="{{ !app_fitur('tool_chat') ? 'display: none !important;' : '' }}"
        data-kt-feature-tool="tool_chat">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative"
            id="kt_drawer_chat_toggle"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
            data-kt-translate-title="menu.chat"
            title="{{ __('menu.chat') }}">
            <i class="ki-duotone ki-message-text-2 fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            <span
                class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink">
            </span>
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::Chat-->

    <!--begin::My apps links-->
    <div class="app-navbar-item d-none d-lg-flex ms-1 ms-md-4 {{ !app_fitur('tool_my_apps') ? 'feature-hidden' : '' }}"
        style="{{ !app_fitur('tool_my_apps') ? 'display: none !important;' : '' }}"
        data-kt-feature-tool="tool_my_apps">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
            data-kt-translate-title="menu.my_apps"
            title="{{ __('menu.my_apps') }}">
            <i class="ki-duotone ki-element-11 fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
            </i>
        </div>
        <!--layout-partial:partials/menus/_my-apps-menu.html-->
        @include('partials.menus._my-apps-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::My apps links-->

    <!--begin::Theme mode-->
    <div class="app-navbar-item d-none d-lg-flex ms-1 ms-md-4 {{ !app_fitur('tool_theme_mode') ? 'feature-hidden' : '' }}"
        style="{{ !app_fitur('tool_theme_mode') ? 'display: none !important;' : '' }}"
        data-kt-feature-tool="tool_theme_mode">
        <!--layout-partial:partials/theme-mode/_main.html-->
        @include('partials.theme-mode._main')
    </div>
    <!--end::Theme mode-->

    <!--begin::Icon style-->
    @if(auth()->user()?->isMasterOrAdmin())
    @include('partials.icon-style._main', [
        'wrapper_class' => 'app-navbar-item d-none d-lg-flex ms-1 ms-md-4 ' . (!app_fitur('tool_icon_style') ? 'feature-hidden' : '')
    ])
    @endif
    <!--end::Icon style-->

    <!--begin::Language-->
    @include('partials.lang._main', [
        'wrapper_class' => 'app-navbar-item d-none d-lg-flex ms-1 ms-md-4 ' . (!app_fitur('tool_language') ? 'feature-hidden' : '')
    ])
    <!--end::Language-->

    <!--begin::Version switcher-->
    @if(auth()->user()?->isMasterOrAdmin())
    @php
        $currentVersion = \App\Support\ThemeVersion::current();
        $themeVersions = \App\Support\ThemeVersion::available();
    @endphp
    <div class="app-navbar-item d-none d-lg-flex ms-1 ms-md-4 {{ !app_fitur('tool_theme_version') ? 'feature-hidden' : '' }}"
        style="{{ !app_fitur('tool_theme_version') ? 'display: none !important;' : '' }}"
        data-kt-feature-tool="tool_theme_version">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
            data-kt-translate-title="menu.theme_version"
            title="{{ __('menu.theme_version') }}">
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
                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase" data-kt-translate="menu.theme_version">
                    {{ __('menu.theme_version') }}
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
    @endif
    <!--end::Version switcher-->

    <!--begin::Frontpages-->
    @if(auth()->user()?->isMasterOrAdmin())
    <div class="app-navbar-item ms-1 ms-md-4 {{ !app_fitur('tool_frontpages') ? 'feature-hidden' : '' }}"
        style="{{ !app_fitur('tool_frontpages') ? 'display: none !important;' : '' }}"
        data-kt-feature-tool="tool_frontpages">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
            data-kt-translate-title="menu.frontpages_and_templates"
            title="{{ __('menu.frontpages_and_templates') }}">
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
    @endif
    <!--end::Frontpages-->

    <!--begin::Mobile Toolbar Hub-->
    <div class="app-navbar-item d-flex d-lg-none ms-1 ms-md-4">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
            data-kt-translate-title="menu.quick_tools"
            title="{{ __('menu.quick_tools') }}">
            <i class="ki-duotone ki-element-11 fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
            </i>
        </div>
        <!--layout-partial:partials/menus/_mobile-toolbar-menu.blade.php-->
        @include('partials.menus._mobile-toolbar-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Mobile Toolbar Hub-->

    <!--begin::User menu-->
    <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        @php
            $authUser = auth()->user();
            $hasAvatar = !empty($authUser?->avatar_url);
            $profileName = $authUser?->name ?? ($current_user_display['name'] ?? 'Guest User');
            $profileEmail = $authUser?->email ?? ($current_user_display['email'] ?? '');
            $initial = strtoupper(substr($profileName, 0, 1));
        @endphp
        <div class="cursor-pointer d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" id="header_user_avatar_toggle">
            <!--begin::Avatar-->
            <div class="symbol symbol-35px symbol-md-40px">
                <div class="image-input-wrapper w-35px h-35px w-md-40px h-md-40px rounded-3" id="header_navbar_user_avatar"
                    style="{{ user_avatar_style($authUser) }}">
                </div>
            </div>
            <!--end::Avatar-->
            <!--begin::User Info-->
            <div class="d-none d-md-flex flex-column align-items-start justify-content-center ms-3 me-1 text-start">
                <span class="text-gray-800 fs-7 fw-bold lh-1 mb-1 header-user-name" id="header_navbar_user_name">{{ $profileName }}</span>
                <span class="text-muted fs-8 fw-semibold lh-1 header-user-email" id="header_navbar_user_email">{{ $profileEmail }}</span>
            </div>
            <!--end::User Info-->
        </div>
        <!--layout-partial:partials/menus/_user-account-menu.html-->
        @include('partials.menus._user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->

    <!--begin::Header menu toggle-->
    <div class="app-navbar-item d-lg-none ms-2 me-n2"
        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
        data-kt-translate-title="menu.show_header_menu"
        title="{{ __('menu.show_header_menu') }}">
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
        <div class="app-navbar-item d-lg-none ms-2 me-n2"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
            data-kt-translate-title="menu.show_aside"
            title="{{ __('menu.show_aside') }}">
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
