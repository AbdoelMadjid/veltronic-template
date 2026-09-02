@extends('layouts.index')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/vis-timeline/vis-timeline.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
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
                <a href="javascript:void(0)" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_new_target">Add Target</a>
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
            <div class="row gy-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', ['widget2IconClass' => 'ki-compass', 'widget2IconPathCount' => 2, 'widget2Value' => '327', 'widget2Label' => 'Projects', 'widget2BadgeClass' => 'badge badge-light-success fs-base', 'widget2BadgeIconClass' => 'ki-arrow-up fs-5 text-success ms-n1', 'widget2BadgeValue' => '2.1%'])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', ['widget2IconClass' => 'ki-chart-simple', 'widget2IconPathCount' => 4, 'widget2Value' => '27,5M', 'widget2Label' => 'Stock Qty', 'widget2BadgeClass' => 'badge badge-light-success fs-base', 'widget2BadgeIconClass' => 'ki-arrow-up fs-5 text-success ms-n1', 'widget2BadgeValue' => '2.1%'])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', ['widget2IconClass' => 'ki-abstract-39', 'widget2IconPathCount' => 2, 'widget2Value' => '149M', 'widget2Label' => 'Stock Value', 'widget2BadgeClass' => 'badge badge-light-danger fs-base', 'widget2BadgeIconClass' => 'ki-arrow-down fs-5 text-danger ms-n1', 'widget2BadgeValue' => '0.47%'])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', ['widget2IconClass' => 'ki-map', 'widget2IconPathCount' => 3, 'widget2Value' => '89M', 'widget2Label' => 'C APEX', 'widget2BadgeClass' => 'badge badge-light-success fs-base', 'widget2BadgeIconClass' => 'ki-arrow-up fs-5 text-success ms-n1', 'widget2BadgeValue' => '2.1%'])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', ['widget2IconClass' => 'ki-abstract-35', 'widget2IconPathCount' => 2, 'widget2Value' => '72.4%', 'widget2Label' => 'OPEX', 'widget2BadgeClass' => 'badge badge-light-danger fs-base', 'widget2BadgeIconClass' => 'ki-arrow-down fs-5 text-danger ms-n1', 'widget2BadgeValue' => '0.647%'])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2', ['widget2IconClass' => 'ki-abstract-26', 'widget2IconPathCount' => 2, 'widget2Value' => '106M', 'widget2Label' => 'Saving', 'widget2BadgeClass' => 'badge badge-light-success fs-base', 'widget2BadgeIconClass' => 'ki-arrow-up fs-5 text-success ms-n1', 'widget2BadgeValue' => '2.1%'])
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Chart widget 19-->
                    <x-widget-include-badge name="chart.__widget-19" />
                    @include('partials.widgets.charts._widget-19')
                    <!--end::Chart widget 19-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-xl-10">
                    <!--begin::Chart widget 38-->
                    <x-widget-include-badge name="chart.__widget-38" />
                    @include('partials.widgets.charts._widget-38')
                    <!--end::Chart widget 38-->
                    <!--begin::Chart widget 20-->
                    <x-widget-include-badge name="chart.__widget-20" />
                    @include('partials.widgets.charts._widget-20')
                    <!--end::Chart widget 20-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::Engage widget 1-->
                    <x-widget-include-badge name="engage.__widget-1" flexible />
                    @include('partials.widgets.engage._widget-1', ['engageTitlePrefix' => 'Try out our', 'engageTitleMiddle' => 'new', 'engageTitleHighlight' => 'Invoice Manager', 'engagePrimaryTarget' => '#kt_modal_new_address', 'engagePrimaryText' => 'Try Now', 'engageSecondaryHref' => '/apps/user-management/users/view', 'engageSecondaryText' => 'Learn More', 'engageIllustrationLight' => 'media/svg/illustrations/easy/2.svg', 'engageIllustrationDark' => 'media/svg/illustrations/easy/2-dark.svg'])
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Chart widget 23-->
                    <x-widget-include-badge name="chart.__widget-23" />
                    @include('partials.widgets.charts._widget-23')
                    <!--end::Chart widget 23-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::Chart widget 25-->
                    <x-widget-include-badge name="chart.__widget-25" />
                    @include('partials.widgets.charts._widget-25')
                    <!--end::Chart widget 25-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Chart widget 24-->
                    <x-widget-include-badge name="chart.__widget-24" flexible />
                    @include('partials.widgets.charts._widget-24', ['chart24CardClass' => 'card card-flush overflow-hidden h-md-100', 'chart24ChartHeight' => '400px'])
                    <!--end::Chart widget 24-->
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
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/vis-timeline/vis-timeline.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/new-target.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/new-address.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Custom Javascript-->
@endsection


