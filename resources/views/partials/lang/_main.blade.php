@php
    $currentLocale = \App\Support\LanguageManager::current();
    $assetBase = $theme_asset_base ?? 'assets';
    $wrapperClass = $wrapper_class ?? 'app-navbar-item ms-1 ms-md-4';
    $btnClass = $button_class ?? 'btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px';
@endphp

<!--begin::Language dropdown-->
<div class="{{ $wrapperClass }}" data-kt-feature-tool="tool_language">
    <!--begin::Menu toggle-->
    <a href="javascript:void(0)"
        class="{{ $btnClass }}"
        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end" title="Pilih Bahasa / Language"
        data-kt-element="lang-toggle">
        <img class="w-20px h-20px rounded-1"
            data-kt-element="lang-flag-current"
            src="{{ asset($assetBase . '/media/flags/' . ($currentLocale === 'id' ? 'indonesia.svg' : 'united-states.svg')) }}"
            alt="{{ $currentLocale === 'id' ? 'Indonesia' : 'English' }}" />
    </a>
    <!--end::Menu toggle-->

    <!--begin::Menu sub-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-175px"
        data-kt-menu="true" data-kt-element="lang-menu">
        <!--begin::Menu header-->
        <div class="menu-item px-3 mb-1">
            <div class="menu-content text-muted pb-1 px-3 fs-7 text-uppercase fw-bold" data-kt-translate="menu.language_selection">
                Bahasa
            </div>
        </div>
        <!--end::Menu header-->

        <!--begin::Menu item English-->
        <div class="menu-item px-3 my-0">
            <a href="javascript:void(0)"
                class="menu-link px-3 py-2 {{ $currentLocale === 'en' ? 'active' : '' }}"
                data-kt-element="lang-item" data-kt-value="en">
                <span class="menu-icon" data-kt-element="icon">
                    <img class="w-20px h-20px rounded-1"
                        src="{{ asset($assetBase . '/media/flags/united-states.svg') }}"
                        alt="English" />
                </span>
                <span class="menu-title d-flex justify-content-between align-items-center w-100">
                    <span data-kt-element="lang-name">English</span>
                    <i class="ki-duotone ki-check fs-2 text-primary {{ $currentLocale === 'en' ? '' : 'd-none' }}" data-kt-lang-check="en"></i>
                </span>
            </a>
        </div>
        <!--end::Menu item-->

        <!--begin::Menu item Indonesian-->
        <div class="menu-item px-3 my-0">
            <a href="javascript:void(0)"
                class="menu-link px-3 py-2 {{ $currentLocale === 'id' ? 'active' : '' }}"
                data-kt-element="lang-item" data-kt-value="id">
                <span class="menu-icon" data-kt-element="icon">
                    <img class="w-20px h-20px rounded-1"
                        src="{{ asset($assetBase . '/media/flags/indonesia.svg') }}"
                        alt="Indonesia" />
                </span>
                <span class="menu-title d-flex justify-content-between align-items-center w-100">
                    <span data-kt-element="lang-name">Bahasa Indonesia</span>
                    <i class="ki-duotone ki-check fs-2 text-primary {{ $currentLocale === 'id' ? '' : 'd-none' }}" data-kt-lang-check="id"></i>
                </span>
            </a>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end::Menu sub-->
</div>
<!--end::Language dropdown-->
