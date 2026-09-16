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
                <a href="/apps/ecommerce/sales/details" class="btn btn-sm fw-bold btn-primary">Show</a>
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
            <div class="row g-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-6 mb-md-5 mb-xl-10">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            <!--begin::Card widget 8-->
                            <x-widget-include-badge name="card.__widget-8" />
                            @include('partials.widgets.cards._widget-8')
                            {{--   --}}
                            <!--end::Card widget 8-->
                            <!--begin::Card widget 5-->
                            <x-widget-include-badge name="card.__widget-5" />
                            @include('partials.widgets.cards._widget-5')
                            {{-- --}}
                            <!--end::Card widget 5-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            <!--begin::Card widget 9-->
                            <x-widget-include-badge name="card.__widget-9" />
                            @include('partials.widgets.cards._widget-9')
                            {{--  --}}
                            <!--end::Card widget 9-->
                            <!--begin::Card widget 7-->
                            <x-widget-include-badge name="card.__widget-7" flexible />
                            @include('partials.widgets.cards._widget-7', [
                                'widget7CardClass' => 'card card-flush h-md-50 mb-xl-10',
                                'widget7Amount' => '6.3k',
                                'widget7Subtitle' => 'Total New Customers',
                                'widget7MoreBadgeClass' => 'bg-light text-gray-400',
                            ])
                            {{--   --}}
                            <!--end::Card widget 7-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    <!--begin::Maps widget 1-->
                    <x-widget-include-badge name="maps.__widget-1" />
                    @include('partials.widgets.maps._widget-1')
                    <!--end::Maps widget 1-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::Engage widget 1-->
                    <x-widget-include-badge name="engage.__widget-1" flexible />
                    @include('partials.widgets.engage._widget-1', [
                        'engageTitlePrefix' => 'Have you tried',
                        'engageTitleMiddle' => 'new',
                        'engageTitleHighlight' => 'Invoice Manager ?',
                        'engagePrimaryHref' => route('apps.ecommerce.customers.listing'),
                        'engagePrimaryText' => 'Try now',
                        'engageSecondaryHref' => route('apps.invoices.view.invoice-1'),
                        'engageSecondaryText' => 'Learn more',
                        'engageIllustrationLight' => 'media/svg/illustrations/easy/2.svg',
                        'engageIllustrationDark' => 'media/svg/illustrations/easy/2-dark.svg',
                    ])
                    {{--  --}}
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::Chart widget 5-->
                    <x-widget-include-badge name="chart.__widget-5" />
                    @include('partials.widgets.charts._widget-5')
                    {{--   --}}
                    <!--end::Chart widget 5-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4 mb-5 mb-xl-10">
                    <!--begin::List widget 6-->
                    <x-widget-include-badge name="list.__widget-6" flexible />
                    @include('partials.widgets.lists._widget-6', [
                        'listWidget6CardClass' => 'card card-xl-stretch mb-5 mb-xl-8',
                    ])
                    {{--  --}}
                    <!--end::List widget 6-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-4 mb-xxl-10">
                    <!--begin::List widget 7-->
                    <x-widget-include-badge name="list.__widget-7" />
                    @include('partials.widgets.lists._widget-7')
                    <!--end::List widget 7-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-8 mb-5 mb-xl-10">
                    <!--begin::Chart widget 13-->
                    <x-widget-include-badge name="chart.__widget-13" />
                    @include('partials.widgets.charts._widget-13')
                    <!--end::Chart widget 13-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::List widget 8-->
                    <x-widget-include-badge name="list.__widget-8" />
                    @include('partials.widgets.lists._widget-8')
                    <!--end::List widget 8-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::List widget 9-->
                    <x-widget-include-badge name="list.__widget-9" />
                    @include('partials.widgets.lists._widget-9')
                    <!--end::List widget 9-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4 mb-5 mb-xl-10">
                    <!--begin::Chart widget 14-->
                    <x-widget-include-badge name="chart.__widget-14" />
                    @include('partials.widgets.charts._widget-14')
                    <!--end::Chart widget 14-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::List widget 12-->
                    <x-widget-include-badge name="list.__widget-12" />
                    @include('partials.widgets.lists._widget-12')
                    <!--end::List widget 12-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Chart widget 15-->
                    <x-widget-include-badge name="chart.__widget-15" />
                    @include('partials.widgets.charts._widget-15')
                    <!--end::Chart widget 15-->
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
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Custom Javascript-->
@endsection

