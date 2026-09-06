@php
    $currentVersion = \App\Support\ThemeVersion::current();
    $menuStyle = \App\Support\ThemeVersion::normalize($theme_menu_style ?? null);
    $isAltMenu = $menuStyle !== \App\Support\ThemeVersion::default();
    $assetBase = $theme_asset_base ?? \App\Support\ThemeVersion::assetBase($menuStyle);
    $themeVersions = \App\Support\ThemeVersion::available();
    $profileAvatar =
        $current_user_display['avatar'] ??
        asset(($theme_asset_base ?? \App\Support\ThemeVersion::assetBase($menuStyle)) . '/media/avatars/300-1.jpg');
    $profileName = $current_user_display['name'] ?? 'Guest User';
    $profileEmail = $current_user_display['email'] ?? '';
@endphp
<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
    data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img alt="Logo" src="{{ $profileAvatar }}" />
            </div>
            <!--end::Avatar-->
            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bold d-flex align-items-center fs-5">
                    {{ $profileName }} <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                </div>
                @if ($profileEmail !== '')
                    <a href="javascript:void(0)" class="fw-semibold text-muted text-hover-primary fs-7">
                        {{ $profileEmail }} </a>
                @endif
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="{{ route('pages.account.overview') }}" class="menu-link px-5" data-kt-translate="menu.my_profile">
            {{ $isAltMenu ? 'My Profile' : __('menu.my_profile') }}
        </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="{{ route('apps.projects.list') }}" class="menu-link px-5">
            <span class="menu-text" data-kt-translate="menu.my_projects">{{ $isAltMenu ? 'My Projects' : __('menu.my_projects') }}</span>
            <span class="menu-badge">
                <span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
            </span>
        </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
        <a href="javascript:void(0)" class="menu-link px-5">
            <span class="menu-title" data-kt-translate="menu.my_subscription">{{ $isAltMenu ? 'My Subscription' : __('menu.my_subscription') }}</span>
            <span class="menu-arrow"></span>
        </a>
        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-dropdown w-175px py-4">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('pages.account.referrals') }}" class="menu-link px-5" data-kt-translate="menu.referrals">
                    {{ $isAltMenu ? 'Referrals' : __('menu.referrals') }}
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('pages.account.billing') }}" class="menu-link px-5" data-kt-translate="menu.billing">
                    {{ $isAltMenu ? 'Billing' : __('menu.billing') }}
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('pages.account.statements') }}" class="menu-link px-5" data-kt-translate="menu.payments">
                    {{ $isAltMenu ? 'Payments' : __('menu.payments') }}
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('pages.account.statements') }}" class="menu-link d-flex flex-stack px-5">
                    <span data-kt-translate="menu.statements">{{ $isAltMenu ? 'Statements' : __('menu.statements') }}</span>
                    <span class="ms-2 lh-0" data-bs-toggle="tooltip"
                        title="{{ __('menu.view_your_statements') ?? 'View your statements' }}">
                        <i class="ki-duotone ki-information-5 fs-5"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span></i> </span>
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu separator-->
            <div class="separator my-2"></div>
            <!--end::Menu separator-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <div class="menu-content px-3">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked"
                            name="notifications" />
                        <span class="form-check-label text-muted fs-7" data-kt-translate="menu.notifications">
                            {{ $isAltMenu ? 'Notifications' : __('menu.notifications') }}
                        </span>
                    </label>
                </div>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="{{ route('pages.account.statements') }}" class="menu-link px-5" data-kt-translate="menu.my_statements">
            {{ $isAltMenu ? 'My Statements' : __('menu.my_statements') }}
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item Language Selection-->
    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
        <a href="javascript:void(0)" class="menu-link px-5">
            <span class="menu-title position-relative">
                <span data-kt-translate="menu.language_selection">Language</span>
                <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                    <span data-kt-element="lang-current-label">{{ \App\Support\LanguageManager::current() === 'id' ? 'Bahasa Indonesia' : 'English' }}</span>
                    <img class="w-15px h-15px rounded-1 ms-2" data-kt-element="lang-flag-current"
                        src="{{ asset(($theme_asset_base ?? 'assets') . '/media/flags/' . (\App\Support\LanguageManager::current() === 'id' ? 'indonesia.svg' : 'united-states.svg')) }}" alt="" />
                </span>
            </span>
        </a>
        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-dropdown w-175px py-4">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="javascript:void(0)" class="menu-link d-flex px-5 {{ \App\Support\LanguageManager::current() === 'en' ? 'active' : '' }}" data-kt-element="lang-item" data-kt-value="en">
                    <span class="symbol symbol-20px me-4">
                        <img class="rounded-1" src="{{ asset(($theme_asset_base ?? 'assets') . '/media/flags/united-states.svg') }}" alt="English" />
                    </span>
                    English
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="javascript:void(0)" class="menu-link d-flex px-5 {{ \App\Support\LanguageManager::current() === 'id' ? 'active' : '' }}" data-kt-element="lang-item" data-kt-value="id">
                    <span class="symbol symbol-20px me-4">
                        <img class="rounded-1" src="{{ asset(($theme_asset_base ?? 'assets') . '/media/flags/indonesia.svg') }}" alt="Bahasa Indonesia" />
                    </span>
                    Bahasa Indonesia
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item Language Selection-->

    <!--begin::Menu item-->
    <div class="menu-item px-5 my-1">
        <a href="{{ route('pages.account.settings') }}" class="menu-link px-5" data-kt-translate="menu.account_settings">
            {{ $isAltMenu ? 'Account Settings' : __('menu.account_settings') }}
        </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="javascript:void(0)" class="menu-link px-5"
                onclick="event.preventDefault(); this.closest('form').submit();" data-kt-translate="menu.sign_out">
                {{ $isAltMenu ? 'Sign Out' : __('menu.sign_out') }}
            </a>
        </form>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->
