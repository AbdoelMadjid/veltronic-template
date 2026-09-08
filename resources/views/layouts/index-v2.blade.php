<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.3.1
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-kt-lang="{{ app()->getLocale() }}">
<!--begin::Head-->

<head>
    <base href="{{ url('/') }}/" />
    <title>{{ trim($__env->yieldContent('title')) ?: getPageTitle() }} - Demo 2 Metronic 832</title>
    <meta charset="utf-8" />
    <meta name="description" data-kt-translate="menu.meta_description"
        content="{{ __('menu.meta_description') }}" />
    <meta name="keywords" data-kt-translate="menu.meta_keywords"
        content="{{ __('menu.meta_keywords') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="{{ app()->getLocale() === 'id' ? 'id_ID' : 'en_US' }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" data-kt-translate="menu.og_title"
        content="{{ __('menu.og_title') }}" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://preview.keenthemes.com?page=index" />
    <link rel="shortcut icon"
        href="{{ \App\Support\ThemeAsset::url('media/logos/favicon.ico', $theme_asset_pack ?? null) }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/fullcalendar/fullcalendar.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    @yield('styles')
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ \App\Support\ThemeAsset::url('plugins/global/plugins.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ \App\Support\ThemeAsset::url('css/style.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/css/custom-icon-style.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <!--layout-partial:partials/theme-mode/_init.html-->
    @include('partials.theme-mode._init')
    <!--layout-partial:partials/icon-style/_init.html-->
    @include('partials.icon-style._init')
    <!--layout-partial:partials/lang/_init.html-->
    @include('partials.lang._init')
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--layout-partial:layout/header/_base.html-->
                @include('layouts.header._base-v2')
                <!--layout-partial:layout/_toolbar.html-->
                @include('layouts._toolbar-v2')
                <!--begin::Container-->
                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start  container-xxl ">
                    <!--begin::Post-->
                    <div class="content flex-row-fluid" id="kt_content">
                        @yield('content')
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Container-->
                <!--layout-partial:layout/_footer.html-->
                @include('layouts._footer-v2')
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--layout-partial:partials/_drawers.html-->
    @include('partials._drawers')
    <!--end::Main-->
    <!--layout-partial:partials/_scrolltop.html-->
    @include('partials._scrolltop')
    <!--begin::Modals-->
    @include('partials.modals._global')
    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ $theme_asset_base }}/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/global/plugins.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="{{ \App\Support\ThemeAsset::url('js/scripts.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ asset('assets/js/custom/icon-style.js') }}"></script>
    <script src="{{ asset('assets/js/custom/language.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Javascript-->
    @yield('scripts')
    <!--end::Page Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
