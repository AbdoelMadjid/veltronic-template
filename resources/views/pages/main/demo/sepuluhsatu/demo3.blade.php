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
    <!--begin::Content container-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Container-->
        <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
            <div class="container-xxl" id="kt_content_container">
                <!--begin::Row-->
                <div class="row gy-5 g-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <x-widget-include-badge name="mixed.__widget-14" />
                        @include('partials.widgets-demo.mixed.__widget-14', [
                            'vars' => [
                                'card_class' => 'card card-xl-stretch mb-xl-10 theme-dark-bg-body',
                                'background_color' => '#F7D9E3',
                                'title' => 'Earnings',
                                'chart_class' => 'mixed-widget-13-chart',
                                'stat_prefix' => '$',
                                'stat_value' => '560',
                                'stat_text' => '+ 28% this week',
                            ],
                        ])
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <x-widget-include-badge name="mixed.__widget-14" />
                        @include('partials.widgets-demo.mixed.__widget-14')
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <x-widget-include-badge name="mixed.__widget-14a" />
                        @include('partials.widgets-demo.mixed.__widget-14a')
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <x-widget-include-badge name="table.__widget-33" />
                @include('partials.widgets-demo.table.__widget-33', [
                    'vars' => [
                        'card_class' => 'card mb-5 mb-xl-10',
                        'link_href' => '#',
                        'avatar_14' => 'assets/media/avatars/300-14.jpg',
                        'avatar_2' => 'assets/media/avatars/300-2.jpg',
                        'avatar_5' => 'assets/media/avatars/300-5.jpg',
                        'avatar_20' => 'assets/media/avatars/300-20.jpg',
                        'avatar_23' => 'assets/media/avatars/300-23.jpg',
                    ],
                ])
                <!--begin::Row-->
                <div class="row gy-5 g-xl-10">
                    <!--begin::Col-->
                    <div class="col-xxl-6">
                        <x-widget-include-badge name="list.__widget-5b" />
                        @include('partials.widgets-demo.list.__widget-5b', [
                            'widgetClass' => 'card card-xl-stretch mb-xl-10',
                        ])
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xxl-6">
                        <x-widget-include-badge name="list.__widget-4" />
                        @include('partials.widgets-demo.list.__widget-4', [
                            'widgetClass' => 'card card-xl-stretch mb-5 mb-xl-10',
                        ])
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <div class="row gy-5 g-xl-8">
                    <div class="col-xl-6">
                        <x-widget-include-badge name="feed.__widget-3" />
                        @include('partials.widgets-demo.feeds.__widget-3')
                        <x-widget-include-badge name="feed.__widget-4" />
                        @include('partials.widgets-demo.feeds.__widget-4')
                    </div>
                    <div class="col-xl-6">
                        <x-widget-include-badge name="feed.__widget-5" />
                        @include('partials.widgets-demo.feeds.__widget-5')
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Container-->
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
