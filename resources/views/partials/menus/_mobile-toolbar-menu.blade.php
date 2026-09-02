@php
    $currentVersion = \App\Support\ThemeVersion::current();
    $themeVersions = \App\Support\ThemeVersion::available();
    $isV2 = ($version ?? $currentVersion) === 'v2';
    $btnClass = 'btn btn-icon btn-color-gray-600 btn-active-light-primary btn-active-color-primary w-35px h-35px rounded-3 position-relative';
    $iconSize = 'fs-2';
@endphp

<!--begin::Mobile Toolbar Items Dropdown-->
<div class="menu-sub menu-sub-dropdown menu-column mobile-toolbar-hub-menu p-3 shadow-lg rounded-4 bg-body border border-gray-200"
    data-kt-menu="true" id="kt_mobile_toolbar_hub_menu">
    <!--begin::Top Toolbar Icons Row-->
    <div class="d-flex align-items-center justify-content-between gap-1 mobile-hub-tabs">
        <!--begin::Activities-->
        <button type="button" class="{{ $btnClass }}"
            data-kt-drawer-show="true" data-kt-drawer-target="#kt_activities"
            onclick="if(typeof KTMenu!=='undefined'&&KTMenu.hideDropdowns){KTMenu.hideDropdowns();}"
            title="Activities">
            <i class="ki-duotone {{ $isV2 ? 'ki-chart-simple' : 'ki-messages' }} {{ $iconSize }}">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>@if(!$isV2)<span class="path5"></span>@endif
            </i>
        </button>
        <!--end::Activities-->

        <!--begin::Chat-->
        <button type="button" class="{{ $btnClass }}"
            data-kt-drawer-show="true" data-kt-drawer-target="#kt_drawer_chat"
            onclick="if(typeof KTMenu!=='undefined'&&KTMenu.hideDropdowns){KTMenu.hideDropdowns();}"
            title="Chat">
            <i class="ki-duotone ki-message-text-2 {{ $iconSize }}">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
            </i>
            <span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
        </button>
        <!--end::Chat-->

        <!--begin::My apps Tab Toggle-->
        <button type="button" class="{{ $btnClass }} mobile-hub-tab-btn" data-hub-target="#hub_panel_apps" title="{{ $isV2 ? 'Quick Links' : 'My Apps' }}">
            <i class="ki-duotone ki-element-11 {{ $iconSize }}">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
            </i>
        </button>
        <!--end::My apps Tab Toggle-->

        <!--begin::Notifications Tab Toggle-->
        <button type="button" class="{{ $btnClass }} mobile-hub-tab-btn" data-hub-target="#hub_panel_notif" title="Notifications">
            <i class="ki-duotone {{ $isV2 ? 'ki-binance' : 'ki-notification-status' }} {{ $iconSize }}">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>@if($isV2)<span class="path5"></span>@endif
            </i>
        </button>
        <!--end::Notifications Tab Toggle-->

        <!--begin::Theme mode Tab Toggle-->
        <button type="button" class="{{ $btnClass }} mobile-hub-tab-btn" data-hub-target="#hub_panel_theme" title="Theme Mode">
            <i class="ki-duotone ki-night-day theme-light-show {{ $iconSize }}">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
            </i>
            <i class="ki-duotone ki-moon theme-dark-show {{ $iconSize }}">
                <span class="path1"></span><span class="path2"></span>
            </i>
        </button>
        <!--end::Theme mode Tab Toggle-->

        <!--begin::Icon style Tab Toggle-->
        <button type="button" class="{{ $btnClass }} mobile-hub-tab-btn" data-hub-target="#hub_panel_icons" title="Gaya Icon (Duotone / Solid / Outline)">
            <span class="icon-style-preview" data-kt-icon-preview-style="duotone">
                <i class="ki-duotone ki-chart {{ $iconSize }}">
                    <span class="path1"></span><span class="path2"></span>
                </i>
            </span>
            <span class="icon-style-preview d-none" data-kt-icon-preview-style="solid">
                <i class="ki-solid ki-chart {{ $iconSize }}"></i>
            </span>
            <span class="icon-style-preview d-none" data-kt-icon-preview-style="outline">
                <i class="ki-outline ki-chart {{ $iconSize }}"></i>
            </span>
        </button>
        <!--end::Icon style Tab Toggle-->

        <!--begin::Version switcher Tab Toggle-->
        <button type="button" class="{{ $btnClass }} mobile-hub-tab-btn" data-hub-target="#hub_panel_version" title="Theme Version">
            <i class="ki-duotone ki-cube-2 {{ $iconSize }}">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
            </i>
        </button>
        <!--end::Version switcher Tab Toggle-->
    </div>
    <!--end::Top Toolbar Icons Row-->

    <!--begin::Hub Panels Container-->
    <div class="mobile-hub-panels d-none mt-3 pt-3 border-top border-gray-200">
        <!--begin::Panel My Apps-->
        <div class="mobile-hub-panel d-none" id="hub_panel_apps">
            @if ($isV2)
                @include('partials.menus._quick-links-menu')
            @else
                @include('partials.menus._my-apps-menu')
            @endif
        </div>
        <!--end::Panel My Apps-->

        <!--begin::Panel Notifications-->
        <div class="mobile-hub-panel d-none" id="hub_panel_notif">
            @include('partials.menus._notifications-menu')
        </div>
        <!--end::Panel Notifications-->

        <!--begin::Panel Theme Mode-->
        <div class="mobile-hub-panel d-none" id="hub_panel_theme">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-7 fw-bold text-gray-700 text-uppercase">Pilih Theme Mode</span>
                <span class="badge badge-light-primary fs-8 py-1 px-2" id="mobile_active_theme_label">Light</span>
            </div>
            <div class="d-flex flex-column gap-1">
                <!--Light-->
                <a href="javascript:void(0)" class="menu-link px-3 py-2 rounded-2 d-flex align-items-center justify-content-between mobile-theme-item" data-kt-mobile-mode="light">
                    <div class="d-flex align-items-center">
                        <span class="menu-icon me-2">
                            <i class="ki-duotone ki-night-day fs-2 text-warning">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span>
                            </i>
                        </span>
                        <span class="fw-semibold fs-7 text-gray-800">Light Mode</span>
                    </div>
                    <i class="ki-duotone ki-check fs-2 text-primary mobile-check-icon d-none"></i>
                </a>
                <!--Dark-->
                <a href="javascript:void(0)" class="menu-link px-3 py-2 rounded-2 d-flex align-items-center justify-content-between mobile-theme-item" data-kt-mobile-mode="dark">
                    <div class="d-flex align-items-center">
                        <span class="menu-icon me-2">
                            <i class="ki-duotone ki-moon fs-2 text-primary">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </span>
                        <span class="fw-semibold fs-7 text-gray-800">Dark Mode</span>
                    </div>
                    <i class="ki-duotone ki-check fs-2 text-primary mobile-check-icon d-none"></i>
                </a>
                <!--System-->
                <a href="javascript:void(0)" class="menu-link px-3 py-2 rounded-2 d-flex align-items-center justify-content-between mobile-theme-item" data-kt-mobile-mode="system">
                    <div class="d-flex align-items-center">
                        <span class="menu-icon me-2">
                            <i class="ki-duotone ki-screen fs-2 text-info">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                            </i>
                        </span>
                        <span class="fw-semibold fs-7 text-gray-800">System Mode</span>
                    </div>
                    <i class="ki-duotone ki-check fs-2 text-primary mobile-check-icon d-none"></i>
                </a>
            </div>
        </div>
        <!--end::Panel Theme Mode-->

        <!--begin::Panel Icon Style-->
        <div class="mobile-hub-panel d-none" id="hub_panel_icons">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-7 fw-bold text-gray-700 text-uppercase">Pilih Gaya Icon</span>
                <span class="badge badge-light-primary fs-8 py-1 px-2" id="mobile_active_icon_label">Duotone</span>
            </div>
            <div class="d-flex flex-column gap-1">
                <!--Duotone-->
                <a href="javascript:void(0)" class="menu-link px-3 py-2 rounded-2 d-flex align-items-center justify-content-between mobile-icon-item" data-kt-mobile-icon-style="duotone">
                    <div class="d-flex align-items-center">
                        <span class="menu-icon me-2">
                            <i class="ki-duotone ki-chart fs-2 text-primary">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </span>
                        <div class="d-flex flex-column">
                            <span class="fw-semibold fs-7 text-gray-800">Duotone</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge badge-light-primary fs-8 px-2 py-1">Default</span>
                        <i class="ki-duotone ki-check fs-2 text-primary mobile-check-icon d-none"></i>
                    </div>
                </a>
                <!--Solid-->
                <a href="javascript:void(0)" class="menu-link px-3 py-2 rounded-2 d-flex align-items-center justify-content-between mobile-icon-item" data-kt-mobile-icon-style="solid">
                    <div class="d-flex align-items-center">
                        <span class="menu-icon me-2">
                            <i class="ki-solid ki-chart fs-2 text-primary"></i>
                        </span>
                        <span class="fw-semibold fs-7 text-gray-800">Solid</span>
                    </div>
                    <i class="ki-duotone ki-check fs-2 text-primary mobile-check-icon d-none"></i>
                </a>
                <!--Outline-->
                <a href="javascript:void(0)" class="menu-link px-3 py-2 rounded-2 d-flex align-items-center justify-content-between mobile-icon-item" data-kt-mobile-icon-style="outline">
                    <div class="d-flex align-items-center">
                        <span class="menu-icon me-2">
                            <i class="ki-outline ki-chart fs-2 text-primary"></i>
                        </span>
                        <span class="fw-semibold fs-7 text-gray-800">Outline</span>
                    </div>
                    <i class="ki-duotone ki-check fs-2 text-primary mobile-check-icon d-none"></i>
                </a>
            </div>
        </div>
        <!--end::Panel Icon Style-->

        <!--begin::Panel Theme Version-->
        <div class="mobile-hub-panel d-none" id="hub_panel_version">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-7 fw-bold text-gray-700 text-uppercase">Theme Version</span>
                <span class="badge badge-light-primary fs-8 py-1 px-2">{{ strtoupper($currentVersion) }}</span>
            </div>
            <div class="d-flex flex-column gap-1">
                @foreach ($themeVersions as $versionItem)
                    <a href="{{ route('theme.version.switch', $versionItem) }}"
                        class="menu-link px-3 py-2 rounded-2 d-flex align-items-center justify-content-between {{ $currentVersion === $versionItem ? 'active bg-light-primary text-primary' : '' }}">
                        <div class="d-flex align-items-center">
                            <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1 me-2">{{ strtoupper($versionItem) }}</span>
                            <span class="fw-semibold fs-7 text-gray-800">{{ 'Metronic ' . strtoupper($versionItem) }}</span>
                        </div>
                        @if ($currentVersion === $versionItem)
                            <i class="ki-duotone ki-check fs-2 text-primary"></i>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
        <!--end::Panel Theme Version-->
    </div>
    <!--end::Hub Panels Container-->
</div>
<!--end::Mobile Toolbar Items Dropdown-->

<style>
    /* Mobile Toolbar Hub Menu Positioning & Styling */
    #kt_mobile_toolbar_hub_menu,
    .mobile-toolbar-hub-menu {
        background-color: var(--bs-body-bg, #ffffff) !important;
        color: var(--bs-body-color, #181c32) !important;
    }

    #kt_mobile_toolbar_hub_menu .mobile-hub-tabs .btn,
    .mobile-toolbar-hub-menu .mobile-hub-tabs .btn {
        color: var(--bs-gray-600, #7e8299) !important;
        background-color: transparent !important;
    }

    #kt_mobile_toolbar_hub_menu .mobile-hub-tabs .btn i,
    .mobile-toolbar-hub-menu .mobile-hub-tabs .btn i {
        color: var(--bs-gray-600, #7e8299) !important;
    }

    #kt_mobile_toolbar_hub_menu .mobile-hub-tabs .btn:hover,
    #kt_mobile_toolbar_hub_menu .mobile-hub-tabs .btn:focus {
        background-color: var(--bs-light-primary, #f1faff) !important;
        color: var(--bs-primary, #009ef7) !important;
    }

    #kt_mobile_toolbar_hub_menu .mobile-hub-tabs .btn:hover i,
    #kt_mobile_toolbar_hub_menu .mobile-hub-tabs .btn:focus i {
        color: var(--bs-primary, #009ef7) !important;
    }

    #kt_mobile_toolbar_hub_menu .mobile-hub-tabs .btn.active,
    .mobile-toolbar-hub-menu .mobile-hub-tabs .btn.active {
        background-color: var(--bs-light-primary, #f1faff) !important;
        color: var(--bs-primary, #009ef7) !important;
    }

    #kt_mobile_toolbar_hub_menu .mobile-hub-tabs .btn.active i,
    .mobile-toolbar-hub-menu .mobile-hub-tabs .btn.active i {
        color: var(--bs-primary, #009ef7) !important;
    }

    #kt_mobile_toolbar_hub_menu .menu-link,
    .mobile-toolbar-hub-menu .menu-link {
        color: var(--bs-gray-800, #3f4254) !important;
    }

    #kt_mobile_toolbar_hub_menu .menu-link.active,
    .mobile-toolbar-hub-menu .menu-link.active {
        background-color: var(--bs-light-primary, #f1faff) !important;
        color: var(--bs-primary, #009ef7) !important;
    }

    #kt_mobile_toolbar_hub_menu .menu-link.active .mobile-check-icon {
        display: inline-block !important;
    }

    #kt_mobile_toolbar_hub_menu .menu-link:hover,
    .mobile-toolbar-hub-menu .menu-link:hover {
        background-color: var(--bs-gray-100, #f5f8fa) !important;
    }

    @media (max-width: 991.98px) {
        #kt_mobile_toolbar_hub_menu.show {
            position: fixed !important;
            top: 65px !important;
            left: 50% !important;
            right: auto !important;
            bottom: auto !important;
            transform: translateX(-50%) !important;
            width: calc(100vw - 20px) !important;
            max-width: 380px !important;
            max-height: calc(100vh - 85px) !important;
            overflow-y: auto !important;
            z-index: 1060 !important;
            margin: 0 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.22) !important;
            border: 1px solid var(--bs-gray-200, #eff2f5) !important;
            border-radius: 1rem !important;
        }

        /* Embed Full Menus seamlessly inside panel without nested popper breaking */
        #kt_mobile_toolbar_hub_menu .mobile-hub-panel > .menu-sub,
        #kt_mobile_toolbar_hub_menu .mobile-hub-panel > .menu,
        #kt_mobile_toolbar_hub_menu .mobile-hub-panel #kt_menu_notifications {
            display: block !important;
            position: static !important;
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border: none !important;
            opacity: 1 !important;
            transform: none !important;
            visibility: visible !important;
            z-index: auto !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        #kt_mobile_toolbar_hub_menu .mobile-hub-panel .card {
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }

        #kt_mobile_toolbar_hub_menu .mobile-hub-panel .card-header {
            padding: 0 0 1rem 0 !important;
            min-height: auto !important;
        }

        #kt_mobile_toolbar_hub_menu .mobile-hub-panel .card-body {
            padding: 0 !important;
        }
    }
</style>

<script>
    (function() {
        // Tab switching & toggle logic inside mobile toolbar hub
        function initMobileHub() {
            var hub = document.getElementById('kt_mobile_toolbar_hub_menu');
            if (!hub) return;

            var panelsContainer = hub.querySelector('.mobile-hub-panels');
            var tabBtns = hub.querySelectorAll('.mobile-hub-tab-btn');

            // Handle Tab Toggle Buttons (Click / Tap)
            tabBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var targetSelector = btn.getAttribute('data-hub-target');
                    if (!targetSelector) return;

                    var isAlreadyActive = btn.classList.contains('active');

                    // If already active, toggle collapse
                    if (isAlreadyActive) {
                        btn.classList.remove('active');
                        if (panelsContainer) panelsContainer.classList.add('d-none');
                        var panels = hub.querySelectorAll('.mobile-hub-panel');
                        panels.forEach(function(p) { p.classList.add('d-none'); });
                        return;
                    }

                    // Otherwise, activate this button and open its panel
                    tabBtns.forEach(function(b) { b.classList.remove('active'); });
                    btn.classList.add('active');

                    if (panelsContainer) panelsContainer.classList.remove('d-none');

                    var panels = hub.querySelectorAll('.mobile-hub-panel');
                    panels.forEach(function(p) { p.classList.add('d-none'); });

                    var activePanel = hub.querySelector(targetSelector);
                    if (activePanel) {
                        activePanel.classList.remove('d-none');
                    }
                });
            });

            // Update Theme Mode Active State
            function syncThemeModeUI() {
                var currentMode = 'light';
                if (document.documentElement.hasAttribute('data-bs-theme-mode')) {
                    currentMode = document.documentElement.getAttribute('data-bs-theme-mode');
                } else if (document.documentElement.hasAttribute('data-bs-theme')) {
                    currentMode = document.documentElement.getAttribute('data-bs-theme');
                } else {
                    try {
                        currentMode = localStorage.getItem('data-bs-theme-mode') || 'light';
                    } catch(e) {}
                }

                var labelEl = document.getElementById('mobile_active_theme_label');
                if (labelEl) {
                    labelEl.textContent = currentMode.charAt(0).toUpperCase() + currentMode.slice(1);
                }

                var themeItems = hub.querySelectorAll('.mobile-theme-item');
                themeItems.forEach(function(item) {
                    var val = item.getAttribute('data-kt-mobile-mode');
                    if (val === currentMode) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
            }

            // Update Icon Style Active State
            function syncIconStyleUI() {
                var currentStyle = 'duotone';
                if (typeof KTIconStyle !== 'undefined' && KTIconStyle.getStyle) {
                    currentStyle = KTIconStyle.getStyle();
                } else if (document.documentElement.hasAttribute('data-kt-icon-style')) {
                    currentStyle = document.documentElement.getAttribute('data-kt-icon-style');
                }

                var labelEl = document.getElementById('mobile_active_icon_label');
                if (labelEl) {
                    labelEl.textContent = currentStyle.charAt(0).toUpperCase() + currentStyle.slice(1);
                }

                var iconItems = hub.querySelectorAll('.mobile-icon-item');
                iconItems.forEach(function(item) {
                    var val = item.getAttribute('data-kt-mobile-icon-style');
                    if (val === currentStyle) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
            }

            // Bind Theme Mode item click
            var themeItems = hub.querySelectorAll('.mobile-theme-item');
            themeItems.forEach(function(item) {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    var mode = item.getAttribute('data-kt-mobile-mode');
                    if (mode) {
                        if (typeof KTThemeMode !== 'undefined' && KTThemeMode.setMode) {
                            KTThemeMode.setMode(mode);
                        } else {
                            var targetVal = mode === 'system' ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light') : mode;
                            document.documentElement.setAttribute('data-bs-theme', targetVal);
                            document.documentElement.setAttribute('data-bs-theme-mode', mode);
                            try {
                                localStorage.setItem('data-bs-theme', targetVal);
                                localStorage.setItem('data-bs-theme-mode', mode);
                            } catch(err) {}
                            if (typeof KTEventHandler !== 'undefined') {
                                KTEventHandler.trigger(document.documentElement, 'kt.thememode.change');
                            }
                        }
                        syncThemeModeUI();
                    }
                });
            });

            // Bind Icon Style item click
            var iconItems = hub.querySelectorAll('.mobile-icon-item');
            iconItems.forEach(function(item) {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    var style = item.getAttribute('data-kt-mobile-icon-style');
                    if (style && typeof KTIconStyle !== 'undefined' && KTIconStyle.setStyle) {
                        KTIconStyle.setStyle(style, true);
                        syncIconStyleUI();
                    }
                });
            });

            // Initial sync
            syncThemeModeUI();
            syncIconStyleUI();

            // Listen to global changes
            document.documentElement.addEventListener('kt.thememode.change', syncThemeModeUI);
            document.documentElement.addEventListener('kt.iconstyle.change', syncIconStyleUI);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMobileHub);
        } else {
            initMobileHub();
        }
    })();
</script>
