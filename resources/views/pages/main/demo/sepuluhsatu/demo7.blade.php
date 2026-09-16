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
                <!--begin::Container-->
                <div class="container-xxl" id="kt_content_container">
                    <!--begin::Row-->
                    <div class="row gy-5 g-xxl-8">
                        <!--begin::Col-->
                        <div class="col-xxl-4">
                            <x-widget-include-badge name="mixed.__widget-12" />
                            @include('partials.widgets-demo.mixed.__widget-12', ['variant' => 'd'])
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xxl-8">
                            <x-widget-include-badge name="table.__widget-33" />
                            @include('partials.widgets-demo.table.__widget-33', [
                                'vars' => [
                                    'card_class' => 'card card-xxl-stretch mb-5 mb-xl-8',
                                    'link_href' => '#',
                                    'avatar_14' => 'assets/media/avatars/300-14.jpg',
                                    'avatar_2' => 'assets/media/avatars/300-2.jpg',
                                    'avatar_5' => 'assets/media/avatars/300-5.jpg',
                                    'avatar_20' => 'assets/media/avatars/300-20.jpg',
                                    'avatar_23' => 'assets/media/avatars/300-23.jpg',
                                ],
                            ])
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xxl-4">
                            <x-widget-include-badge name="statistics.__widget-4" />
                            @include('partials.widgets-demo.statistics.__widget-4')
                            <x-widget-include-badge name="statistics.__widget-4" />
                            @include('partials.widgets-demo.statistics.__widget-4', [
                                'vars' => ['p16_1' => '+259', 'p17_1' => 'Sales Change', 'p21_0' => 'success'],
                            ])
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xxl-4">
                            <x-widget-include-badge name="list.__widget-9m" />
                            @include('partials.widgets-demo.list.__widget-9m')
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xxl-4">
                            <x-widget-include-badge name="list.__widget-4" />
                            @include('partials.widgets-demo.list.__widget-4', ['widgetClass' => 'card card-xxl-stretch mb-5 mb-xl-8'])
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xxl-4">
                            <x-widget-include-badge name="list.__widget-3" />
                            @include('partials.widgets-demo.list.__widget-3', ['widgetClass' => 'card card-xxl-stretch mb-xxl-3'])
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xxl-8">
                            <x-widget-include-badge name="table.__widget-33" />
                            @include('partials.widgets-demo.table.__widget-33', [
                                'vars' => [
                                    'card_class' => 'card card-xxl-stretch mb-5 mb-xl-8',
                                    'link_href' => '#',
                                    'avatar_14' => 'assets/media/avatars/300-14.jpg',
                                    'avatar_2' => 'assets/media/avatars/300-2.jpg',
                                    'avatar_5' => 'assets/media/avatars/300-5.jpg',
                                    'avatar_20' => 'assets/media/avatars/300-20.jpg',
                                    'avatar_23' => 'assets/media/avatars/300-23.jpg',
                                ],
                            ])
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <x-widget-include-badge name="list.__widget-2" />
                            @include('partials.widgets-demo.list.__widget-2', [
                                'vars' => [
                                    'card_class' => 'card card-xl-stretch mb-xl-8',
                                    'menu_href' => '#',
                                    'item_href' => '#',
                                    'avatar_1_src' => 'assets/media/avatars/300-6.jpg',
                                    'avatar_2_src' => 'assets/media/avatars/300-5.jpg',
                                    'avatar_3_src' => 'assets/media/avatars/300-11.jpg',
                                    'avatar_4_src' => 'assets/media/avatars/300-9.jpg',
                                    'avatar_5_src' => 'assets/media/avatars/300-23.jpg',
                                ],
                            ])
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <x-widget-include-badge name="list.__widget-6" />
                            @include('partials.widgets-demo.list.__widget-6', ['widgetClass' => 'card card-xl-stretch mb-xl-8'])
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <x-widget-include-badge name="list.__widget-4" />
                            @include('partials.widgets-demo.list.__widget-4', ['widgetClass' => 'card card-xl-stretch mb-5 mb-xl-8'])
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row g-5 gx-xxl-8">
                        <!--begin::Col-->
                        <div class="col-xxl-4">
                            <x-widget-include-badge name="mixed.__widget-5" />
                            @include('partials.widgets-demo.mixed.__widget-5', ['variant' => 'e'])
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xxl-8">
                            <x-widget-include-badge name="table.__widget-26" />
                            @include('partials.widgets-demo.table.__widget-26', [
                                'vars' => [
                                    'card_class' => 'card card-xxl-stretch mb-5 mb-xxl-8',
                                    'link_href' => '#',
                                ],
                            ])
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
        </div>
        <!--end::Container-->
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
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-app.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection



