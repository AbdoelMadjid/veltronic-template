@extends('layouts.index')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/vis-timeline/vis-timeline.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endsection
@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Pages
        @endslot
        @slot('li_2')
            Dashboards
        @endslot
        @slot('action')
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                    class="btn btn-sm fw-bold btn-secondary d-flex align-items-center px-4">
                    <!--begin::Display range-->
                    <div class="text-gray-600 fw-bold">
                        Loading date range...
                    </div>
                    <!--end::Display range-->
                    <i class="ki-duotone ki-calendar-8 fs-2 ms-2 me-0">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                        <span class="path6"></span>
                    </i>
                </div>
                <!--end::Daterangepicker-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="/pages/general/social/feeds" class="btn btn-sm fw-bold btn-primary">Feeds</a>
                <!--end::Primary button-->
            </div>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Chart Widget 1-->
                    <x-widget-include-badge name="chart.__widget-1" />
                    @include('partials.widgets.charts._widget-1')
                    <!--end::Chart Widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Engage widget 1-->
                    <x-widget-include-badge name="engage.__widget-1" flexible />
                    @include('partials.widgets.engage._widget-1', [
                        'engageSecondaryHref' => url('pages/general/user-profile/activity'),
                    ])
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', [
                        'widget2Image' => 'media/svg/brand-logos/instagram-2-1.svg',
                        'widget2Value' => '320k',
                        'widget2Label' => 'Followers',
                        'widget2BadgeClass' => 'badge badge-light-success fs-base',
                        'widget2BadgeIconClass' => 'ki-arrow-up fs-5 text-success ms-n1',
                        'widget2BadgeValue' => '2.1%',
                    ])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', [
                        'widget2Image' => 'media/svg/brand-logos/facebook-3.svg',
                        'widget2Value' => '1.5M',
                        'widget2Label' => 'Followers',
                        'widget2BadgeClass' => 'badge badge-light-danger fs-base',
                        'widget2BadgeIconClass' => 'ki-arrow-down fs-5 text-danger ms-n1',
                        'widget2BadgeValue' => '0.47%',
                    ])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', [
                        'widget2Image' => 'media/svg/brand-logos/dribbble-icon-1.svg',
                        'widget2Value' => '84k',
                        'widget2Label' => 'Followers',
                        'widget2BadgeClass' => 'badge badge-light-success fs-base',
                        'widget2BadgeIconClass' => 'ki-arrow-up fs-5 text-success ms-n1',
                        'widget2BadgeValue' => '0.6%',
                    ])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', [
                        'widget2Image' => 'media/svg/brand-logos/twitter.svg',
                        'widget2Value' => '570k',
                        'widget2Label' => 'Followers',
                        'widget2BadgeClass' => 'badge badge-light-success fs-base',
                        'widget2BadgeIconClass' => 'ki-arrow-up fs-5 text-success ms-n1',
                        'widget2BadgeValue' => '3%',
                    ])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4 mb-5 mb-xl-10">
                    <!--begin::Card widget 1-->
                    <x-widget-include-badge name="card.__widget-1" flexible />
                    @include('partials.widgets.cards._widget-1', [
                        'widget1CardClass' => 'card card-flush border-0 h-lg-100',
                        'widget1BackgroundColor' => '#7239ea',
                        'widget1BorderOpacity' => '0.2',
                        'widget1ChartColor' => '#8F5FF4',
                    ])
                    <!--end::Card widget 1-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-8 mb-xl-10">
                    <!--begin::Timeline Widget 1-->
                    <x-widget-include-badge name="timeline.__widget-1" />
                    @include('partials.widgets.timeline._widget-1')
                    <!--end::Timeline Widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4 mb-5 mb-xl-10">
                    <!--begin::List widget 4-->
                    <x-widget-include-badge name="list.__widget-4" />
                    @include('partials.widgets.lists._widget-4')
                    <!--end::List widget 4-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Table Widget 3-->
                    <x-widget-include-badge name="table.__widget-3" flexible />
                    @include('partials.widgets.tables._widget-3', [
                        'tableWidget3CardClass' => 'card card-flush h-lg-100',
                        'tableWidget3FilterMenuId' => 'kt_menu_6606385f16a4e',
                    ])
                    <!--end::Table Widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Chart widget 2-->
                    <x-widget-include-badge name="chart.__widget-2" />
                    @include('partials.widgets.charts._widget-2')
                    <!--end::Chart widget 2-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/vis-timeline/vis-timeline.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-app.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-campaign.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection
