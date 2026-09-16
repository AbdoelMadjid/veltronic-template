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
            <div class="row g-5 g-lg-10">
                <!--begin::Col-->
                <div class="col-xxl-4 col-md-4 mb-xxl-10">
                    <x-widget-include-badge name="mixed.__widget-17" />
                    @include('partials.widgets-demo.mixed.__widget-17')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4 col-md-4 mb-xxl-10">
                    <x-widget-include-badge name="list.__widget-2" />
                    @include('partials.widgets-demo.list.__widget-2')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4 col-md-4 mb-xxl-10">
                    <x-widget-include-badge name="list.__widget-7" />
                    @include('partials.widgets-demo.list.__widget-7')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-lg-10">
                <!--begin::Col-->
                <div class="col-xxl-4 col-md-4 mb-xxl-10">
                    <x-widget-include-badge name="mixed.__widget-5" />
                    @include('partials.widgets-demo.mixed.__widget-5')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4 col-md-4 mb-xxl-10">
                    <x-widget-include-badge name="list.__widget-5b" />
                    @include('partials.widgets-demo.list.__widget-5b', ['widgetClass' => 'card h-md-100'])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4 col-md-4 mb-xxl-10">
                    <x-widget-include-badge name="mixed.__widget-1" />
                    @include('partials.widgets-demo.mixed.__widget-1')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-lg-10">
                <!--begin::Col-->
                <div class="col-xxl-3 col-md-3 mb-xxl-10">
                    <x-widget-include-badge name="list.__widget-1" />
                    @include('partials.widgets-demo.list.__widget-1')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-3 col-md-3 mb-xxl-10">
                    <x-widget-include-badge name="list.__widget-3" />
                    @include('partials.widgets-demo.list.__widget-3', ['widgetClass' => 'card h-md-100'])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-6 col-md-6 mb-xxl-10">
                    <x-widget-include-badge name="table.__widget-26" />
                    @include('partials.widgets-demo.table.__widget-26')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-lg-10">
                <!--begin::Col-->
                <div class="col-xxl-4 col-md-4 mb-xxl-10">
                    <x-widget-include-badge name="list.__widget-4" />
                    @include('partials.widgets-demo.list.__widget-4', ['widgetClass' => 'card h-md-100'])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-8 col-md-8 mb-xxl-10">
                    <x-widget-include-badge name="table.__widget-33" />
                    @include('partials.widgets-demo.table.__widget-33')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
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



