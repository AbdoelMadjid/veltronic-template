@php
    $currentVersion = \App\Support\ThemeVersion::current();
    $themeVersions = \App\Support\ThemeVersion::available();
    $isV2 = ($version ?? $currentVersion) === 'v2';
    $btnClass = $isV2
        ? 'btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px'
        : 'btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px';
    $iconSize = $isV2 ? 'fs-1' : 'fs-2';
@endphp

<!--begin::Mobile Toolbar Items Dropdown-->
<div class="menu-sub menu-sub-dropdown menu-column w-275px p-4 shadow-sm rounded-3 bg-body" data-kt-menu="true" id="kt_mobile_toolbar_hub_menu">
    <div class="d-flex flex-wrap align-items-center justify-content-center gap-2">
        <!--begin::Activities-->
        <div class="{{ $btnClass }}"
            data-kt-drawer-show="true" data-kt-drawer-target="#kt_activities"
            onclick="if(typeof KTMenu!=='undefined'&&KTMenu.hideDropdowns){KTMenu.hideDropdowns();}"
            title="Activities">
            <i class="ki-duotone {{ $isV2 ? 'ki-chart-simple' : 'ki-messages' }} {{ $iconSize }}">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>@if(!$isV2)<span class="path5"></span>@endif
            </i>
        </div>
        <!--end::Activities-->

        <!--begin::Notifications-->
        <div class="position-relative">
            <div class="{{ $btnClass }} position-relative"
                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                data-kt-menu-overflow="true" data-kt-menu-placement="bottom-end" title="Notifications">
                <i class="ki-duotone {{ $isV2 ? 'ki-binance' : 'ki-notification-status' }} {{ $iconSize }}">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>@if($isV2)<span class="path5"></span>@endif
                </i>
            </div>
            <!--layout-partial:partials/menus/_notifications-menu.html-->
            @include('partials.menus._notifications-menu')
        </div>
        <!--end::Notifications-->

        <!--begin::Chat-->
        <div class="{{ $btnClass }} position-relative"
            data-kt-drawer-show="true" data-kt-drawer-target="#kt_drawer_chat"
            onclick="if(typeof KTMenu!=='undefined'&&KTMenu.hideDropdowns){KTMenu.hideDropdowns();}"
            title="Chat">
            <i class="ki-duotone ki-message-text-2 {{ $iconSize }}">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
            </i>
            <span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
        </div>
        <!--end::Chat-->

        <!--begin::My apps / Quick links-->
        <div class="position-relative">
            <div class="{{ $btnClass }}"
                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                data-kt-menu-overflow="true" data-kt-menu-placement="bottom-end" title="{{ $isV2 ? 'Quick Links' : 'My Apps' }}">
                <i class="ki-duotone ki-element-11 {{ $iconSize }}">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </div>
            @if ($isV2)
                @include('partials.menus._quick-links-menu')
            @else
                @include('partials.menus._my-apps-menu')
            @endif
        </div>
        <!--end::My apps / Quick links-->

        <!--begin::Theme mode-->
        <div class="position-relative">
            @include('partials.theme-mode._main')
        </div>
        <!--end::Theme mode-->

        <!--begin::Icon style-->
        @include('partials.icon-style._main', ['wrapper_class' => 'position-relative', 'button_class' => $btnClass])
        <!--end::Icon style-->

        <!--begin::Version switcher-->
        <div class="position-relative">
            <div class="{{ $btnClass }}"
                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                data-kt-menu-overflow="true" data-kt-menu-placement="bottom-end" title="Theme Version">
                <i class="ki-duotone ki-cube-2 {{ $iconSize }}">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                </i>
            </div>
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
        </div>
        <!--end::Version switcher-->
    </div>
</div>
<!--end::Mobile Toolbar Items Dropdown-->

<script>
    // Ensure all menus inside mobile toolbar hub are initialized with KTMenu
    if (typeof KTMenu !== 'undefined') {
        KTUtil.onDOMContentLoaded(function() {
            KTMenu.createInstances('#kt_mobile_toolbar_hub_menu [data-kt-menu="true"]');
        });
    }

    // Global delegation for KTThemeMode
    if (!window.ktThemeModeDelegated) {
        window.ktThemeModeDelegated = true;
        document.addEventListener('click', function(e) {
            var modeItem = e.target.closest('[data-kt-element="mode"]');
            if (modeItem) {
                var modeVal = modeItem.getAttribute('data-kt-value');
                if (modeVal && typeof KTThemeMode !== 'undefined') {
                    var targetVal = modeVal === 'system' ? KTThemeMode.getSystemMode() : modeVal;
                    document.documentElement.setAttribute('data-bs-theme', targetVal);
                    document.documentElement.setAttribute('data-bs-theme-mode', modeVal);
                    try {
                        localStorage.setItem('data-bs-theme', targetVal);
                        localStorage.setItem('data-bs-theme-mode', modeVal);
                    } catch (err) {}
                    if (typeof KTEventHandler !== 'undefined') {
                        KTEventHandler.trigger(document.documentElement, 'kt.thememode.change');
                    }
                }
            }
        });
    }
</script>
