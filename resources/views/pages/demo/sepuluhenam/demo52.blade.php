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
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row gy-5 g-xl-10 draggable-zone">
                    <!--begin::Col-->
                    <div class="col-xl-6 draggable">
                        <x-widget-include-badge name="chart.__widget-4" />
                        @include('partials.widgets-demo.chart.__widget-4', [
                            'vars' => [
                                'card_class' => 'card card-flush overflow-hidden draggable-handle h-md-100',
                            ],
                        ])
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6 draggable">
                        <x-widget-include-badge name="table.__widget-2" />
                        @include('partials.widgets-demo.table.__widget-2', ['variant' => 'a'])
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6 draggable">
                        <x-widget-include-badge name="card.__widget-19" />
                        @include('partials.widgets-demo.card.__widget-19')
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6 draggable">
                        <x-widget-include-badge name="engage.__widget-9" />
                        @include('partials.widgets-demo.engage.__widget-9')
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6 draggable">
                        <x-widget-include-badge name="table.__widget-9" />
                        @include('partials.widgets-demo.table.__widget-9', [
                            'vars' => [
                                'card_class' => 'card card-flush draggable-handle h-xl-100',
                            ],
                        ])
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6 draggable">
                        <x-widget-include-badge name="table.__widget-10" />
                        @include('partials.widgets-demo.table.__widget-10', [
                            'vars' => [
                                'card_class' => 'card card-flush draggable-handle h-xl-100',
                            ],
                        ])
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
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
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-campaign.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection


