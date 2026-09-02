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
                <!--begin::Secondary button-->
                <a href="/apps/customers/list" class="btn btn-sm fw-bold btn-secondary">Add Customer</a>
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="/apps/ecommerce/sales/add-order" class="btn btn-sm fw-bold btn-primary">New Shipment</a>
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
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::Engage widget 1-->
                    <x-widget-include-badge name="engage.__widget-1" flexible />
                    @include('partials.widgets.engage._widget-1', [
                        'engageTitlePrefix' => 'Quick form to',
                        'engageTitleMiddle' => '',
                        'engageTitleHighlight' => 'Bid a New Shipment',
                        'engagePrimaryTarget' => '#kt_modal_bidding',
                        'engagePrimaryText' => 'Start Now',
                        'engageSecondaryHref' => url('apps/invoices/view/invoice-2'),
                        'engageSecondaryText' => 'Quick Guide',
                        'engageIllustrationLight' => 'media/svg/illustrations/easy/3.svg',
                        'engageIllustrationDark' => 'media/svg/illustrations/easy/3-dark.svg',
                    ])
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <!--begin::Row-->
                    <div class="row g-lg-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-5 mb-xl-10">
                            <!--begin::Card widget 12-->
                            <x-widget-include-badge name="card.__widget-12" />
                            @include('partials.widgets.cards._widget-12')
                            <!--end::Card widget 12-->
                            <!--begin::Card widget 10-->
                            <x-widget-include-badge name="card.__widget-10" />
                            @include('partials.widgets.cards._widget-10')
                            <!--end::Card widget 10-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-md-5 mb-xl-10">
                            <!--begin::Card widget 13-->
                            <x-widget-include-badge name="card.__widget-13" />
                            @include('partials.widgets.cards._widget-13')
                            <!--end::Card widget 13-->
                            <!--begin::Card widget 7-->
                            <x-widget-include-badge name="card.__widget-7" flexible />
                            @include('partials.widgets.cards._widget-7', [
                                'widget7CardClass' => 'card card-flush h-md-50 mb-lg-10',
                                'widget7Amount' => '604',
                                'widget7Subtitle' => 'New Customers This Month',
                                'widget7MoreBadgeClass' => 'bg-light text-gray-400',
                            ])
                            <!--end::Card widget 7-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::List widget 10-->
                    <x-widget-include-badge name="list.__widget-10" />
                    @include('partials.widgets.lists._widget-10')
                    <!--end::List widget 10-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10 h-xxl-50 mb-0 mb-xl-10">
                        <!--begin::Col-->
                        <div class="col-xxl-6">
                            <!--begin::Chart widget 6-->
                            <x-widget-include-badge name="chart.__widget-6" />
                            @include('partials.widgets.charts._widget-6')
                            <!--end::Chart widget 6-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xxl-6 mb-5 mb-xl-0">
                            <!--begin::List widget 8-->
                            <x-widget-include-badge name="list.__widget-8" />
                            @include('partials.widgets.lists._widget-8')
                            <!--end::LIst widget 8-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row h-xxl-50">
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Chart widget 10-->
                            <x-widget-include-badge name="chart.__widget-10" />
                            @include('partials.widgets.charts._widget-10')
                            <!--end::Chart widget 10-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::List widget 11-->
                    <x-widget-include-badge name="list.__widget-11" />
                    @include('partials.widgets.lists._widget-11')
                    <!--end::List widget 11-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Chart widget 17-->
                    <x-widget-include-badge name="chart.__widget-17" flexible />
                    @include('partials.widgets.charts._widget-17', [
                        'chart17Subtitle' => 'Top Selling Countries',
                        'chart17ChartId' => 'kt_charts_widget_16_chart',
                        'chart17ChartClass' => 'w-100 h-350px',
                        'chart17MenuVariant' => 'simple',
                    ])
                    <!--end::Chart widget 17-->
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
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/bidding.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection
