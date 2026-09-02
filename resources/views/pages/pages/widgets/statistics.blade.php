@extends('layouts.index')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/apexcharts/apexcharts.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
    <style>
        .widget-showcase-row + .widget-showcase-row {
            margin-top: 2rem;
        }

        .widget-showcase-item {
            position: relative;
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
            Widgets / Statistics
        @endslot
    @endcomponent
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="statistics.__widget-1" />
                    @include('partials.widgets.statistics._widget-1')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="statistics.__widget-2" />
                    @include('partials.widgets.statistics._widget-2')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="statistics.__widget-3" />
                    @include('partials.widgets.statistics._widget-3')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="statistics.__widget-4" />
                    @include('partials.widgets.statistics._widget-4')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="statistics.__widget-5" />
                    @include('partials.widgets.statistics._widget-5')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="statistics.__widget-7" />
                    @include('partials.widgets.statistics._widget-7')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/apexcharts/apexcharts.bundle.js', $theme_asset_pack ?? null) }}"></script>
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










