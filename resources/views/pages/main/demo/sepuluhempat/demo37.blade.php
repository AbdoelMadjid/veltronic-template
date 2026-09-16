@extends('layouts.index')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/fullcalendar/fullcalendar.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endsection
@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('li_2')
            Demo
        @endslot
        @slot('action')
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                <a href="javascript:void(0)" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_project">Manage Bids</a>
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="javascript:void(0)" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_campaign">Start Auction</a>
                <!--end::Primary button-->
            </div>
        @endslot
    @endcomponent
@endsection

@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
                <!--begin::Col-->
                <div class="col-md-4 mb-xl-10">
                    <x-widget-include-badge name="card.__widget-28" />
                    @include('partials.widgets-demo.card.__widget-28')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 mb-xl-10">
                    <x-widget-include-badge name="card.__widget-28" />
                    @include('partials.widgets-demo.card.__widget-28', [
                        'vars' => [
                            'p17_0' => 'ki-outline ki-arrow-down fs-5 text-danger ms-n1',
                            'p17_1' => '2.5%',
                            'p29_1' => '$6,526.00',
                        ],
                    ])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 mb-xl-10">
                    <x-widget-include-badge name="card.__widget-28" />
                    @include('partials.widgets-demo.card.__widget-28', [
                        'vars' => ['p17_1' => '2.7%', 'p29_1' => '$45,142.00'],
                    ])
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <x-widget-include-badge name="list.__widget-23" />
                    @include('partials.widgets-demo.list.__widget-23')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <x-widget-include-badge name="chart.__widget-33" />
                    @include('partials.widgets-demo.chart.__widget-33')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-lg-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-xl-6 mb-5 mb-xl-10">
                    <x-widget-include-badge name="card.__widget-12" />
                    @include('partials.widgets-demo.card.__widget-12')
                    <x-widget-include-badge name="card.__widget-10" />
                    @include('partials.widgets-demo.card.__widget-10')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-xl-6 mb-md-5 mb-xl-10">
                    <x-widget-include-badge name="card.__widget-13" />
                    @include('partials.widgets-demo.card.__widget-13')
                    <x-widget-include-badge name="card.__widget-7" />
                    @include('partials.widgets-demo.card.__widget-7', [
                        'vars' => [
                            'card_class' => 'card card-flush h-md-50 mb-lg-10',
                            'amount' => '604',
                            'subtitle' => 'New Customers This Month',
                            'more_href' => 'javascript:void(0)',
                            'more_label_class' => 'symbol-label bg-light text-gray-400 fs-8 fw-bold',
                        ],
                    ])
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content-->
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/fullcalendar/fullcalendar.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
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
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/new-target.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection

