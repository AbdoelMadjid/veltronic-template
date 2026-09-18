<!--begin::Header & Hero Section-->
<div class="mb-0" id="home">
    <!--begin::Wrapper-->
    <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg"
        style="background-image: url({{ \App\Support\ThemeAsset::url('media/svg/illustrations/landing.svg', $theme_asset_pack ?? null) }});">
        <!--begin::Header-->
        <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
            data-kt-sticky-offset="{default: '200px', lg: '300px'}">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center justify-content-between">
                    <!--begin::Logo-->
                    <div class="d-flex align-items-center flex-equal">
                        <!--begin::Mobile menu toggle-->
                        <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                            id="kt_landing_menu_toggle">
                            <i class="ki-duotone ki-abstract-14 fs-2hx">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                        <!--end::Mobile menu toggle-->
                        <!--begin::Logo image-->
                        <a href="/">
                            <img alt="Logo" src="{{ $logoLightUrl }}"
                                class="logo-default h-25px h-lg-30px" />
                            <img alt="Logo" src="{{ $logoDarkUrl }}"
                                class="logo-sticky h-20px h-lg-25px" />
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Logo-->
                    <!--begin::Menu wrapper-->
                    <div class="d-lg-block" id="kt_header_nav_wrapper">
                        <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true"
                            data-kt-drawer-name="landing-menu"
                            data-kt-drawer-activate="{default: true, lg: false}"
                            data-kt-drawer-overlay="true" data-kt-drawer-width="200px"
                            data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle"
                            data-kt-swapper="true" data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                            <!--begin::Menu-->
                            <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-600 menu-state-title-primary nav nav-flush fs-5 fw-semibold"
                                id="kt_landing_menu">
                                @foreach($landingMenus as $mIndex => $mItem)
                                    @php
                                        $isFirst = $mIndex === 0;
                                        $target = $mItem['target'] ?? '#';
                                        $isExt = !empty($mItem['is_external']);
                                        $label = app()->getLocale() === 'en' && !empty($mItem['title_en']) ? $mItem['title_en'] : ($mItem['title'] ?? '');
                                    @endphp
                                    <!--begin::Menu item-->
                                    <div class="menu-item">
                                        <!--begin::Menu link-->
                                        <a class="menu-link nav-link {{ $isFirst ? 'active' : '' }} py-3 px-4 px-xxl-6" href="{{ $target }}"
                                            @if($isExt) target="_blank" @else data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true" @endif>
                                            {{ $label }}
                                        </a>
                                        <!--end::Menu link-->
                                    </div>
                                    <!--end::Menu item-->
                                @endforeach
                            </div>
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Menu wrapper-->
                    <!--begin::Toolbar-->
                    <div class="flex-equal d-flex align-items-center justify-content-end ms-1">
                        @include('partials.lang._main', [
                            'wrapper_class' => 'd-inline-flex align-items-center me-2 me-lg-3',
                            'button_class' => 'btn btn-icon btn-custom bg-white bg-opacity-10 bg-hover-opacity-20 border border-white border-opacity-15 shadow-sm btn-active-light btn-active-color-primary w-35px h-35px',
                            'show_tooltip' => false
                        ])

                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-success fw-bold d-inline-flex align-items-center justify-content-center h-35px px-4" data-kt-translate="landing.dashboard">
                                    {{ __('landing.dashboard') }}
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-sm btn-success fw-bold d-inline-flex align-items-center justify-content-center h-35px px-4" data-kt-translate="landing.login">
                                    {{ __('landing.login') }}
                                </a>
                            @endauth
                        @endif
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Header-->
        <!--begin::Landing hero-->
        <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
            <!--begin::Heading-->
            <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                @if(!empty($landingConfig['landing_hero_badge']))
                    <span class="badge badge-light-primary fw-bold fs-7 px-3 py-2 mb-4 rounded-pill">
                        {{ $landingConfig['landing_hero_badge'] }}
                    </span>
                @endif
                <!--begin::Title-->
                <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-10">
                    <span>{{ $landingConfig['landing_hero_title'] ?? __('landing.hero_title') }}</span> <br />
                    @if(!empty($landingConfig['landing_hero_with']))
                        <span>{{ $landingConfig['landing_hero_with'] }}</span>
                    @endif
                    <span
                        style="
                        background: linear-gradient(
                        to right,
                        #12ce5d 0%,
                        #ffd80c 100%
                        );
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                    ">
                        <span id="kt_landing_hero_text">{{ $landingConfig['landing_hero_highlight'] ?? __('landing.hero_highlight') }}</span>
                    </span>
                </h1>
                <!--end::Title-->
                <!--begin::Action-->
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <a href="{{ $landingConfig['landing_hero_cta_url'] ?? '/#pricing' }}" class="btn btn-primary fw-bold" data-kt-translate="landing.try_metronic">
                        {{ $landingConfig['landing_hero_cta_text'] ?? __('landing.try_metronic') }}
                    </a>
                    @if(!empty($landingConfig['landing_hero_cta2_text']) && !empty($landingConfig['landing_hero_cta2_url']))
                        <a href="{{ $landingConfig['landing_hero_cta2_url'] }}" class="btn btn-light-primary fw-bold" target="_blank">
                            {{ $landingConfig['landing_hero_cta2_text'] }}
                        </a>
                    @endif
                </div>
                <!--end::Action-->
            </div>
            <!--end::Heading-->
            @if(!empty($landingConfig['landing_show_clients']))
            <!--begin::Clients-->
            <div class="d-flex flex-center flex-wrap position-relative px-5">
                <!--begin::Client-->
                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Fujifilm">
                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/fujifilm.svg', $theme_asset_pack ?? null) }}"
                        class="mh-30px mh-lg-40px" alt="" />
                </div>
                <!--end::Client-->
                <!--begin::Client-->
                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Vodafone">
                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/vodafone.svg', $theme_asset_pack ?? null) }}"
                        class="mh-30px mh-lg-40px" alt="" />
                </div>
                <!--end::Client-->
                <!--begin::Client-->
                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                    title="KPMG International">
                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/kpmg.svg', $theme_asset_pack ?? null) }}"
                        class="mh-30px mh-lg-40px" alt="" />
                </div>
                <!--end::Client-->
                <!--begin::Client-->
                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Nasa">
                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/nasa.svg', $theme_asset_pack ?? null) }}"
                        class="mh-30px mh-lg-40px" alt="" />
                </div>
                <!--end::Client-->
                <!--begin::Client-->
                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Aspnetzero">
                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/aspnetzero.svg', $theme_asset_pack ?? null) }}"
                        class="mh-30px mh-lg-40px" alt="" />
                </div>
                <!--end::Client-->
                <!--begin::Client-->
                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                    title="AON - Empower Results">
                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/aon.svg', $theme_asset_pack ?? null) }}"
                        class="mh-30px mh-lg-40px" alt="" />
                </div>
                <!--end::Client-->
                <!--begin::Client-->
                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                    title="Hewlett-Packard">
                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/hp-3.svg', $theme_asset_pack ?? null) }}"
                        class="mh-30px mh-lg-40px" alt="" />
                </div>
                <!--end::Client-->
                <!--begin::Client-->
                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Truman">
                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/truman.svg', $theme_asset_pack ?? null) }}"
                        class="mh-30px mh-lg-40px" alt="" />
                </div>
                <!--end::Client-->
            </div>
            <!--end::Clients-->
            @endif
        </div>
        <!--end::Landing hero-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Curve bottom-->
    <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
        <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                fill="currentColor"></path>
        </svg>
    </div>
    <!--end::Curve bottom-->
</div>
<!--end::Header & Hero Section-->
