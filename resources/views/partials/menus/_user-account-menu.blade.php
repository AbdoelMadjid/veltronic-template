@php
    $currentVersion = \App\Support\ThemeVersion::current();
    $menuStyle = \App\Support\ThemeVersion::normalize($theme_menu_style ?? null);
    $isAltMenu = $menuStyle !== \App\Support\ThemeVersion::default();
    $assetBase = $theme_asset_base ?? \App\Support\ThemeVersion::assetBase($menuStyle);
    $themeVersions = \App\Support\ThemeVersion::available();
    $authUser = auth()->user();
@endphp
<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-3 fs-6 w-225px"
    data-kt-menu="true">
    <!--begin::Menu item (User Points Display)-->
    <div class="menu-item px-3 my-1">
        <div class="d-flex align-items-center justify-content-between px-3 py-2 bg-light rounded-3">
            <span class="fs-7 text-muted fw-semibold"><i class="ki-outline ki-crown-2 fs-6 text-success me-1"></i> Reward Poin</span>
            <span class="badge badge-light-success fw-bolder fs-7 px-2 py-1">{{ number_format($authUser?->points ?? 0) }} Poin</span>
        </div>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3 my-1">
        <a href="{{ Route::has('profil.profil-pengguna') ? route('profil.profil-pengguna') : route('pages.account.overview') }}" class="menu-link px-3">
            <span class="menu-icon">
                <i class="ki-duotone ki-user fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
            <span class="menu-title" data-kt-translate="menu.my_profile">{{ __('menu.my_profile') }}</span>
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3 my-1">
        <a href="{{ Route::has('profil.profil-pengguna') ? route('profil.profil-pengguna', ['tab' => 'konfigurasi']) : route('pages.account.settings') }}" class="menu-link px-3">
            <span class="menu-icon">
                <i class="ki-duotone ki-setting-2 fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
            <span class="menu-title" data-kt-translate="menu.account_settings">{{ __('menu.account_settings') }}</span>
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3 my-1">
        <a href="javascript:void(0)" class="menu-link px-3" onclick="if(window.KTLockScreen){window.KTLockScreen.lock();}">
            <span class="menu-icon">
                <i class="ki-duotone ki-lock fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </span>
            <span class="menu-title" data-kt-translate="menu.lock_screen">{{ __('menu.lock_screen') }}</span>
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->
    <div class="menu-item px-3 my-1">
        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
            @csrf
            <a href="javascript:void(0)" class="menu-link px-3 text-hover-danger"
                onclick="event.preventDefault(); this.closest('form').submit();">
                <span class="menu-icon">
                    <i class="ki-duotone ki-exit-right fs-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
                <span class="menu-title" data-kt-translate="menu.sign_out">{{ __('menu.sign_out') }}</span>
            </a>
        </form>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->
