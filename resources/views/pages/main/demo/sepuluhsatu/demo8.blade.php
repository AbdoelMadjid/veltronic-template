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
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-8">
                            <div class="col-xl-4">
                                <x-widget-include-badge name="statistics.__widget-5" />
                                @include('partials.widgets-demo.statistics.__widget-5')
                            </div>
                            <div class="col-xl-4">
                                <x-widget-include-badge name="statistics.__widget-5" />
                                @include('partials.widgets-demo.statistics.__widget-5', [
                                    'vars' => [
                                        'p1_1' => 'card bg-primary hoverable card-xl-stretch mb-xl-8',
                                        'p10_0' => 'text-white fw-bold fs-2 mb-2 mt-5',
                                        'p10_1' => 'Appartments',
                                        'p11_0' => 'fw-semibold text-white',
                                        'p11_1' => 'Flats, Shared Rooms, Duplex',
                                    ],
                                ])
                            </div>
                            <div class="col-xl-4">
                                <x-widget-include-badge name="statistics.__widget-5" />
                                @include('partials.widgets-demo.statistics.__widget-5', [
                                    'vars' => [
                                        'p1_1' => 'card bg-gray-900 hoverable card-xl-stretch mb-5 mb-xl-8',
                                        'p10_0' => 'text-gray-100 fw-bold fs-2 mb-2 mt-5',
                                        'p10_1' => 'Sales Stats',
                                        'p11_0' => 'fw-semibold text-gray-100',
                                        'p11_1' => '50% Increased for FY20',
                                    ],
                                ])
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-8">
                            <!--begin::Col-->
                            <div class="col-xl-4">
                                <x-widget-include-badge name="list.__widget-1" />
                                @include('partials.widgets-demo.list.__widget-1', [
                                    'vars' => [
                                        'card_class' => 'card card-xl-stretch mb-xl-8',
                                        'menu_id' => 'kt_menu_65a10a3d1c536',
                                        'item_href' => '#',
                                    ],
                                ])
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-8">
                                <x-widget-include-badge name="table.__widget-26" />
                                @include('partials.widgets-demo.table.__widget-26', [
                                    'vars' => [
                                        'card_class' => 'card card-xl-stretch mb-5 mb-xl-8',
                                        'link_href' => '#',
                                    ],
                                ])
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-8">
                            <div class="col-xl-4">
                                <x-widget-include-badge name="list.__widget-3" />
                                @include('partials.widgets-demo.list.__widget-3', ['widgetClass' => 'card card-xl-stretch mb-xl-8'])
                            </div>
                            <div class="col-xl-8">
                                <x-widget-include-badge name="chart.__widget-49" />
                                @include('partials.widgets-demo.chart.__widget-49', [
                                    'vars' => [
                                        'card_class' => 'card card-xl-stretch mb-5 mb-xl-8',
                                        'menu_id' => 'kt_menu_65a10a3d1c75a',
                                    ],
                                ])
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-8">
                            <div class="col-xl-6">
                                <x-widget-include-badge name="list.__widget-7" />
                                @include('partials.widgets-demo.list.__widget-7', ['widgetClass' => 'card card-xl-stretch mb-xl-8'])
                            </div>
                            <div class="col-xl-6">
                                <x-widget-include-badge name="list.__widget-6" />
                                @include('partials.widgets-demo.list.__widget-6', ['widgetClass' => 'card card-xl-stretch mb-5 mb-xl-8'])
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
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
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection




