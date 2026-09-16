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
            <div class="row g-5 g-xl-10 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <x-widget-include-badge name="card.__widget-4" />
                    @include('partials.widgets-demo.card.__widget-4', [
                        'vars' => [
                            'badge_class' => 'badge badge-light-primary fs-base',
                            'badge_icon_class' => 'ki-duotone ki-arrow-up fs-5 text-success ms-n1',
                            'badge_icon_duotone' => true,
                        ],
                    ])
                    <x-widget-include-badge name="card.__widget-5" />
                    @include('partials.widgets-demo.card.__widget-5', [
                        'vars' => [
                            'subtitle' => 'Orders This Month',
                        ],
                    ])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <x-widget-include-badge name="card.__widget-6" />
                    @include('partials.widgets-demo.card.__widget-6', [
                        'vars' => [
                            'badge_class' => 'badge badge-light-primary fs-base',
                            'badge_icon_class' => 'ki-duotone ki-arrow-up fs-5 text-success ms-n1',
                            'badge_icon_duotone' => true,
                        ],
                    ])
                    <x-widget-include-badge name="card.__widget-7" />
                    @include('partials.widgets-demo.card.__widget-7', [
                        'vars' => [
                            'card_class' => 'card card-flush h-md-50 mb-xl-10',
                            'amount' => '6.3k',
                            'subtitle' => 'New Customers This Month',
                            'more_href' => 'javascript:void(0)',
                            'more_label_class' => 'symbol-label bg-light text-gray-400 fs-8 fw-bold',
                        ],
                    ])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                    <x-widget-include-badge name="chart.__widget-3" />
                    @include('partials.widgets-demo.chart.__widget-3', [
                        'vars' => [
                            'menu_icon_class' => 'ki-duotone ki-dots-square fs-1',
                            'menu_icon_duotone' => true,
                        ],
                    ])
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-6 mb-xl-10">
                    <x-widget-include-badge name="table.__widget-2" />
                    @include('partials.widgets-demo.table.__widget-2', ['variant' => 'd'])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <x-widget-include-badge name="chart.__widget-4" />
                    @include('partials.widgets-demo.chart.__widget-4', [
                        'vars' => [
                            'menu_icon_class' => 'ki-duotone ki-dots-square fs-1',
                            'menu_icon_duotone' => true,
                            'badge_icon_class' => 'ki-duotone ki-arrow-down fs-5 text-success ms-n1',
                            'badge_icon_duotone' => true,
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
                    <x-widget-include-badge name="card.__widget-1" />
                    @include('partials.widgets-demo.card.__widget-1')
                    <br>
                    <br>
                    <br>
                    <br>
                    <x-widget-include-badge name="statistics.__widget-6" />
                    @include('partials.widgets-demo.statistics.__widget-6')

                    {{-- @include('partials.widgets-demo.engage.__widget-1', [
                        'vars' => [
                            'layout' => 'invoice',
                            'title_line_1' => 'Have you tried',
                            'title_line_2' => 'new',
                            'title_highlight' => 'eCommerce App ?',
                            'primary_btn_href' => url('apps/ecommerce/sales/listing'),
                            'primary_btn_text' => 'View App',
                            'secondary_btn_href' => url('apps/ecommerce/catalog/add-product'),
                            'secondary_btn_text' => 'New Product',
                        ],
                    ]) --}}
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <x-widget-include-badge name="table.__widget-4" />
                    @include('partials.widgets-demo.table.__widget-4', ['iconVariant' => 'duotone'])
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <x-widget-include-badge name="list.__widget-5b" />
                    @include('partials.widgets-demo.list.__widget-5b', ['widgetClass' => 'card h-xl-100'])
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <x-widget-include-badge name="table.__widget-5" />
                    @include('partials.widgets-demo.table.__widget-5')
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
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection
