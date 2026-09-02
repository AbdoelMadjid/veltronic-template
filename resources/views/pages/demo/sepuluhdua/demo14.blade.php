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
            <!--begin::Row-->
            <div class="row g-5 g-lg-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <x-widget-include-badge name="mixed.__widget-19" />
                    @include('partials.widgets-demo.mixed.__widget-19', [
                        'vars' => [
                            'menuVariant' => 'filter',
                            'menuId' => 'kt_menu_mixed_widget_18',
                            'chartId' => 'kt_charts_mixed_widget_18_chart',
                            'items' => [
                                [
                                    'logo' => 'media/svg/brand-logos/plurk.svg',
                                    'title' => 'Top Authors',
                                    'subtitle' => 'Mark, Rowling, Esther',
                                    'badge' => '+82$',
                                    'itemClass' => 'd-flex align-items-sm-center mb-7',
                                ],
                                [
                                    'logo' => 'media/svg/brand-logos/telegram.svg',
                                    'title' => 'Popular Authors',
                                    'subtitle' => 'Randy, Steve, Mike',
                                    'badge' => '+280$',
                                    'itemClass' => 'd-flex align-items-sm-center mb-7',
                                ],
                                [
                                    'logo' => 'media/svg/brand-logos/vimeo.svg',
                                    'title' => 'New Users',
                                    'subtitle' => 'John, Pat, Jimmy',
                                    'badge' => '+4500$',
                                    'itemClass' => 'd-flex align-items-sm-center mb-7',
                                ],
                                [
                                    'logo' => 'media/svg/brand-logos/bebo.svg',
                                    'title' => 'Active Customers',
                                    'subtitle' => 'Mark, Rowling, Esther',
                                    'badge' => '+686$',
                                    'itemClass' => 'd-flex align-items-sm-center',
                                ],
                            ],
                        ],
                    ])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Row-->
                    <div class="row g-5 g-lg-10">
                        <!--begin::Col-->
                        <div class="col-lg-6 mb-5 mb-lg-10">
                            <x-widget-include-badge name="tiles.__widget-1" />
                            @include('partials.widgets-demo.tiles.__widget-1')
                            <x-widget-include-badge name="tiles.__widget-5" />
                            @include('partials.widgets-demo.tiles.__widget-5')
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-6 mb-5 mb-lg-10">
                            <x-widget-include-badge name="mixed.__widget-3" />
                            @include('partials.widgets-demo.mixed.__widget-3')
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <x-widget-include-badge name="tiles.__widget-2" />
                    @include('partials.widgets-demo.tiles.__widget-2')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-lg-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <x-widget-include-badge name="list.__widget-3" />
                    @include('partials.widgets-demo.list.__widget-3')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <x-widget-include-badge name="list.__widget-5b" />
                    @include('partials.widgets-demo.list.__widget-5b', ['widgetClass' => 'card h-xl-100'])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <x-widget-include-badge name="list.__widget-6" />
                    @include('partials.widgets-demo.list.__widget-6')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-lg-10">
                <!--begin::Col-->
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <x-widget-include-badge name="table.__widget-20" />
                    @include('partials.widgets-demo.table.__widget-20')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <x-widget-include-badge name="table.__widget-6" />
                    @include('partials.widgets-demo.table.__widget-6')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--end::Post-->
        </div>
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



