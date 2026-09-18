@php
    $landingConfig = \App\Support\LandingPageConfig::get();
    $landingMenus = \App\Support\LandingPageConfig::getActiveMenuItems();
    $landingSections = \App\Support\LandingPageConfig::getActiveSections();
    $landingSocials = \App\Support\LandingPageConfig::getSocialLinks();

    $logoLight = $landingConfig['landing_logo_light'] ?? 'media/logos/landing.svg';
    $logoLightUrl = \Illuminate\Support\Str::startsWith($logoLight, 'http') || \Illuminate\Support\Str::startsWith($logoLight, 'assets/')
        ? asset($logoLight)
        : \App\Support\ThemeAsset::url($logoLight, $theme_asset_pack ?? null);

    $logoDark = $landingConfig['landing_logo_dark'] ?? 'media/logos/landing-dark.svg';
    $logoDarkUrl = \Illuminate\Support\Str::startsWith($logoDark, 'http') || \Illuminate\Support\Str::startsWith($logoDark, 'assets/')
        ? asset($logoDark)
        : \App\Support\ThemeAsset::url($logoDark, $theme_asset_pack ?? null);

    $favicon = $landingConfig['landing_favicon'] ?? 'media/logos/favicon.ico';
    $faviconUrl = \Illuminate\Support\Str::startsWith($favicon, 'http') || \Illuminate\Support\Str::startsWith($favicon, 'assets/')
        ? asset($favicon)
        : \App\Support\ThemeAsset::url($favicon, $theme_asset_pack ?? null);
@endphp
<!doctype html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.2.5
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-kt-lang="{{ app()->getLocale() }}" data-kt-icon-style="{{ getActiveIconStyle() }}">
    <!--begin::Head-->

    <head>
        <title data-kt-translate="landing.page_title">
            {{ $landingConfig['landing_page_title'] ?? __('landing.page_title') }}
        </title>
        <meta charset="utf-8" />
        <meta name="description" data-kt-translate="landing.meta_description"
            content="{{ $landingConfig['landing_meta_description'] ?? __('landing.meta_description') }}" />
        <meta name="keywords" data-kt-translate="landing.meta_keywords"
            content="{{ $landingConfig['landing_meta_keywords'] ?? __('landing.meta_keywords') }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="{{ app()->getLocale() === 'id' ? 'id_ID' : 'en_US' }}" />
        <meta property="og:type" content="article" />
        <meta property="og:title" data-kt-translate="landing.og_title"
            content="{{ $landingConfig['landing_og_title'] ?? __('landing.og_title') }}" />
        <meta property="og:url" content="https://keenthemes.com/metronic" />
        <meta property="og:site_name" content="Metronic by Keenthemes" />
        <link rel="canonical" href="/dashboard/landing" />
        <link rel="shortcut icon" href="{{ $faviconUrl }}" />
        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ \App\Support\ThemeAsset::url('plugins/global/plugins.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
        <link href="{{ \App\Support\ThemeAsset::url('css/style.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
        <link href="{{ \App\Support\ThemeAsset::url('css/custom-icon-style.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        @include('partials.icon-style._init')
        @include('partials.lang._init')
        <script>
            // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
        </script>
    </head>
    <!--end::Head-->
    <!--begin::Body-->

    <body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu"
        class="bg-body position-relative app-blank">
        <!--begin::Theme mode setup on page load-->
        <script>
            var defaultThemeMode = "light";
            var themeMode;
            if (document.documentElement) {
                if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode =
                        document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if (localStorage.getItem("data-bs-theme") !== null) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }
                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ?
                        "dark" :
                        "light";
                }
                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }
        </script>
        <!--end::Theme mode setup on page load-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            
            {{-- 1. Hero & Navbar Section --}}
            @include('frontpages.landing.v1.sections.hero')

            {{-- 2. How It Works Section --}}
            @if(\App\Support\LandingPageConfig::isSectionActive('how-it-works'))
                @include('frontpages.landing.v1.sections.how-it-works')
            @endif

            {{-- 3. Achievements / Statistics Section --}}
            @if(\App\Support\LandingPageConfig::isSectionActive('achievements'))
                @include('frontpages.landing.v1.sections.achievements')
            @endif

            {{-- 4. Team Slider Section --}}
            @if(\App\Support\LandingPageConfig::isSectionActive('team'))
                @include('frontpages.landing.v1.sections.team')
            @endif

            {{-- 5. Projects / Portfolio Section --}}
            @if(\App\Support\LandingPageConfig::isSectionActive('portfolio'))
                @include('frontpages.landing.v1.sections.portfolio')
            @endif

            {{-- 6. Pricing Section --}}
            @if(\App\Support\LandingPageConfig::isSectionActive('pricing'))
                @include('frontpages.landing.v1.sections.pricing')
            @endif

            {{-- 7. Testimonials & Clients Section --}}
            @if(\App\Support\LandingPageConfig::isSectionActive('clients'))
                @include('frontpages.landing.v1.sections.clients')
            @endif

            {{-- 8. Custom Sections --}}
            @include('frontpages.landing.v1.sections.custom')

            {{-- 9. Footer Section --}}
            @include('frontpages.landing.v1.sections.footer')

            <!--begin::Scrolltop-->
            <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
                <i class="ki-duotone ki-arrow-up">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <!--end::Scrolltop-->
        </div>
        <!--end::Root-->

        <!--begin::Javascript-->
        <script>
            var hostUrl = "{{ asset(\App\Support\ThemeVersion::assetBase($theme_asset_pack ?? null).'/') }}";
        </script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{ \App\Support\ThemeAsset::url('plugins/global/plugins.bundle.js', $theme_asset_pack ?? null) }}"></script>
        <script src="{{ \App\Support\ThemeAsset::url('js/scripts.bundle.js', $theme_asset_pack ?? null) }}"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/fslightbox/fslightbox.bundle.js', $theme_asset_pack ?? null) }}"></script>
        <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/typedjs/typedjs.bundle.js', $theme_asset_pack ?? null) }}"></script>
        <!--end::Vendors Javascript-->
        <!--begin::Custom Javascript(used for this page only)-->
        <script src="{{ \App\Support\ThemeAsset::url('js/custom/icon-style.js', $theme_asset_pack ?? null) }}"></script>
        <script src="{{ \App\Support\ThemeAsset::url('js/custom/language.js', $theme_asset_pack ?? null) }}"></script>
        <script src="{{ \App\Support\ThemeAsset::url('js/custom/landing.js', $theme_asset_pack ?? null) }}"></script>
        <script src="{{ \App\Support\ThemeAsset::url('js/custom/pages/pricing/general.js', $theme_asset_pack ?? null) }}"></script>
        <!--end::Custom Javascript-->
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>
