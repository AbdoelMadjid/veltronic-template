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
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Container-->
                <div class="container-xxl" id="kt_content_container">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <x-widget-include-badge name="misc.__widget-1" />
                            @include('partials.widgets-demo.misc.__widget-1', [
                                'variant' => 'compact_duotone_static',
                            ])
                            <x-widget-include-badge name="list.__widget-5b" />
                            @include('partials.widgets-demo.list.__widget-5b', [
                                'widgetClass' => 'card mb-5 mb-xl-8',
                            ])
                            <x-widget-include-badge name="list.__widget-4" />
                            @include('partials.widgets-demo.list.__widget-4', [
                                'widgetClass' => 'card mb-xl-8',
                            ])
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8 ps-xl-12">
                            <x-widget-include-badge name="engage.__widget-1" />
                            @include('partials.widgets-demo.engage.__widget-1', [
                                'vars' => [
                                    'card_class' =>
                                        'card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px bg-primary mb-5 mb-xl-8 border-0',
                                    'background_image' => 'assets/media/misc/city.png',
                                    'title_class' => 'text-white fs-2qx fw-bold mb-7',
                                    'action_href' => '#',
                                    'action_class' => 'btn btn-success fw-semibold px-6 py-3',
                                ],
                            ])
                            <!--begin::Row-->
                            <div class="row g-5 g-xl-8">
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <x-widget-include-badge name="mixed.__widget-5" />
                                    @include('partials.widgets-demo.mixed.__widget-5', ['variant' => 'f'])
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <x-widget-include-badge name="list.__widget-3" />
                                    @include('partials.widgets-demo.list.__widget-3', [
                                        'widgetClass' => 'card card-xl-stretch mb-5 mb-xl-8',
                                    ])
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <x-widget-include-badge name="table.__widget-26" />
                            @include('partials.widgets-demo.table.__widget-26', [
                                'vars' => [
                                    'card_class' => 'card mb-5 mb-xl-8',
                                    'link_href' => '#',
                                ],
                            ])
                            <!--begin::Row-->
                            <div class="row g-5 g-xl-8">
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <x-widget-include-badge name="mixed.__widget-8" />
                                    @include('partials.widgets-demo.mixed.__widget-8', ['variant' => 'b'])
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <x-widget-include-badge name="mixed.__widget-8" />
                                    @include('partials.widgets-demo.mixed.__widget-8', ['variant' => 'c'])
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <div class="row gy-5 g-xl-8">
                        <div class="col-xl-8">
                            <x-widget-include-badge name="feeds.__widget-6" />
                            @include('partials.widgets-demo.feeds.__widget-6')
                        </div>
                        <div class="col-xl-4">
                            <x-widget-include-badge name="list.__widget-1a" />
                            @include('partials.widgets-demo.list.__widget-1a')
                            <br>
                            <br>
                            <br>
                            <x-widget-include-badge name="list.__widget-2b" />
                            @include('partials.widgets-demo.list.__widget-2b')
                        </div>
                    </div>
                </div>
                <!--end::Container-->
            </div>
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
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-app.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection
