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
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-8">
                    <x-widget-include-badge name="chart.__widget-1" />
                    @include('partials.widgets-demo.chart.__widget-1')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4">
                    <x-widget-include-badge name="engage.__widget-15" />
                    @include('partials.widgets-demo.engage.__widget-15', [
                        'vars' => [
                            'card_class' => 'card bg-primary bg-opacity-15 h-md-100',
                            'single_image' => true,
                            'single_image_src' => \App\Support\ThemeAsset::url('media/svg/illustrations/easy/9.svg', $theme_asset_pack ?? null),
                            'single_image_class' => 'w-200px',
                            'action_class' => 'btn btn-sm btn-primary me-2',
                        ],
                    ])
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-8">
                    <x-widget-include-badge name="table.__widget-14" />
                    @include('partials.widgets-demo.table.__widget-14', [
                        'vars' => [
                            'history_href' => url('apps/ecommerce/catalog/add-product'),
                            'link_href' => 'javascript:void(0)',
                        ],
                    ])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-4">
                    <x-widget-include-badge name="chart.__widget-35" />
                    @include('partials.widgets-demo.chart.__widget-35', [
                        'vars' => [
                            'link_href' => 'javascript:void(0)',
                        ],
                    ])
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <x-widget-include-badge name="list.__widget-10b" />
                    @include('partials.widgets-demo.list.__widget-10b')
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10 h-xxl-50 mb-0 mb-xl-10">
                        <!--begin::Col-->
                        <div class="col-xxl-6">
                            <x-widget-include-badge name="chart.__widget-6" />
                            @include('partials.widgets-demo.chart.__widget-6')
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xxl-6 mb-5 mb-xl-0">
                            <x-widget-include-badge name="list.__widget-8" />
                            @include('partials.widgets-demo.list.__widget-8', ['widgetClass' => 'card card-flush h-lg-100'])
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row h-xxl-50">
                        <!--begin::Col-->
                        <div class="col">
                            <x-widget-include-badge name="chart.__widget-10" />
                            @include('partials.widgets-demo.chart.__widget-10', [
                                'vars' => [
                                    'calendar_icon_class' => 'ki-duotone ki-calendar-8 text-gray-500 lh-0 fs-2 ms-2 me-0',
                                    'calendar_icon_duotone' => true,
                                    'tab1_icon_class' => 'ki-duotone ki-ship fs-1 p-0',
                                    'tab1_icon_duotone' => true,
                                    'tab2_icon_class' => 'ki-duotone ki-truck fs-1 p-0',
                                    'tab2_icon_duotone' => true,
                                    'tab3_icon_class' => 'ki-duotone ki-airplane-square fs-1 p-0',
                                    'tab3_icon_duotone' => true,
                                    'tab4_icon_class' => 'ki-duotone ki-bus fs-1 p-0',
                                    'tab4_icon_duotone' => true,
                                ],
                            ])
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
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

