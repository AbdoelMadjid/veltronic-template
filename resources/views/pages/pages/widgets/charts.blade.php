@extends('layouts.index')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
    <style>
        .widget-showcase-row + .widget-showcase-row {
            margin-top: 2rem;
        }

        .widget-showcase-item {
            position: relative;
        }
        .widget-showcase-masonry {
            column-gap: 1.5rem;
            column-count: 1;
        }

        .widget-showcase-masonry .widget-showcase-row {
            display: contents;
        }

        .widget-showcase-masonry .widget-showcase-item {
            width: 100%;
            display: inline-block;
            vertical-align: top;
            break-inside: avoid;
            margin-bottom: 1.5rem;
        }

        .widget-showcase-masonry .widget-showcase-row.widget-showcase-featured {
            display: block;
            column-span: all;
            break-inside: avoid;
            margin-bottom: 1.5rem;
        }

        .widget-showcase-masonry .widget-showcase-row.widget-showcase-featured .widget-showcase-item {
            width: 100%;
            display: block;
        }

        @media (min-width: 992px) {
            .widget-showcase-masonry {
                column-count: 2;
            }
        }


    </style>
    <!--end::Vendor Stylesheets-->
@endsection
@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Pages
        @endslot
        @slot('li_2')
            Widgets / Charts
        @endslot
    @endcomponent
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid widget-showcase-masonry">
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row widget-showcase-featured">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-22" />
                    @include('partials.widgets.charts._widget-22')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-1" />
                    @include('partials.widgets.charts._widget-1')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-2" />
                    @include('partials.widgets.charts._widget-2')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-3" />
                    @include('partials.widgets.charts._widget-3')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-4" />
                    @include('partials.widgets.charts._widget-4')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-5" />
                    @include('partials.widgets.charts._widget-5')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-6" />
                    @include('partials.widgets.charts._widget-6')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-7" />
                    @include('partials.widgets.charts._widget-7')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-8" />
                    @include('partials.widgets.charts._widget-8')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-10" />
                    @include('partials.widgets.charts._widget-10')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-11" />
                    @include('partials.widgets.charts._widget-11')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-13" />
                    @include('partials.widgets.charts._widget-13')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-14" />
                    @include('partials.widgets.charts._widget-14')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-15" />
                    @include('partials.widgets.charts._widget-15')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-16" />
                    @include('partials.widgets.charts._widget-16')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-17" flexible />
                    @include('partials.widgets.charts._widget-17')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-18" />
                    @include('partials.widgets.charts._widget-18')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-19" />
                    @include('partials.widgets.charts._widget-19')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-20" />
                    @include('partials.widgets.charts._widget-20')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-23" />
                    @include('partials.widgets.charts._widget-23')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-24" flexible />
                    @include('partials.widgets.charts._widget-24')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-25" />
                    @include('partials.widgets.charts._widget-25')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-26" />
                    @include('partials.widgets.charts._widget-26')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-27" />
                    @include('partials.widgets.charts._widget-27')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-28" />
                    @include('partials.widgets.charts._widget-28')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-29" />
                    @include('partials.widgets.charts._widget-29')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-30" />
                    @include('partials.widgets.charts._widget-30')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-31" flexible />
                    @include('partials.widgets.charts._widget-31')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-32" />
                    @include('partials.widgets.charts._widget-32')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-33" />
                    @include('partials.widgets.charts._widget-33')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-34" />
                    @include('partials.widgets.charts._widget-34')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-35" />
                    @include('partials.widgets.charts._widget-35')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-36" />
                    @include('partials.widgets.charts._widget-36')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-37" />
                    @include('partials.widgets.charts._widget-37')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-38" />
                    @include('partials.widgets.charts._widget-38')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-45" />
                    @include('partials.widgets.charts._widget-45')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-46" />
                    @include('partials.widgets.charts._widget-46')
                </div>
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-47" />
                    @include('partials.widgets.charts._widget-47')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="chart.__widget-48" />
                    @include('partials.widgets.charts._widget-48')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/fullcalendar/fullcalendar.bundle.js', $theme_asset_pack ?? null) }}"></script>
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
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-app.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Custom Javascript-->
@endsection










