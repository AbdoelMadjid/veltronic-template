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
<html lang="en">
<!--begin::Head-->

<head>
    <base href="{{ url('/') }}/" />
    <title>{{ trim($__env->yieldContent('title')) ?: getPageTitle() }} - Demo 2 Metronic 832</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="
            The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo,
            Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions.
            Grab your copy now and get life-time updates for free.
        " />
    <meta name="keywords"
        content="
            tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js,
            Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates,
            free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button,
            bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon
        " />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
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
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Javascript-->
    @yield('scripts')
    <!--end::Page Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
