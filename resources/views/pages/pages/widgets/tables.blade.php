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
        .tables-masonry {
            column-gap: 1.5rem;
            column-count: 1;
        }

        .tables-masonry .widget-showcase-item {
            width: 100%;
            display: inline-block;
            vertical-align: top;
            break-inside: avoid;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 992px) {
            .tables-masonry {
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
            Widgets / Tables
        @endslot
    @endcomponent
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-3" flexible />
                    @include('partials.widgets.tables._widget-3')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-8" />
                    @include('partials.widgets.tables._widget-8')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-4" flexible />
                    @include('partials.widgets.tables._widget-4')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-5" />
                    @include('partials.widgets.tables._widget-5')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-6" />
                    @include('partials.widgets.tables._widget-6')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-7" />
                    @include('partials.widgets.tables._widget-7')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-12" />
                    @include('partials.widgets.tables._widget-12')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-13" />
                    @include('partials.widgets.tables._widget-13')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-14" />
                    @include('partials.widgets.tables._widget-14')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-15" />
                    @include('partials.widgets.tables._widget-15')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12 widget-showcase-item">
                    <x-widget-include-badge name="table.__widget-17" />
                    @include('partials.widgets.tables._widget-17')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-12">
                    <div class="tables-masonry">
                        <div class="col-xl-6 widget-showcase-item">
                            <x-widget-include-badge name="table.__widget-1" />
                            @include('partials.widgets.tables._widget-1')
                        </div>
                        <div class="col-xl-6 widget-showcase-item">
                            <x-widget-include-badge name="table.__widget-2" />
                            @include('partials.widgets.tables._widget-2')
                        </div>
                        <div class="col-xl-6 widget-showcase-item">
                            <x-widget-include-badge name="table.__widget-9" />
                            @include('partials.widgets.tables._widget-9')
                        </div>
                        <div class="col-xl-6 widget-showcase-item">
                            <x-widget-include-badge name="table.__widget-10" />
                            @include('partials.widgets.tables._widget-10')
                        </div>
                        <div class="col-xl-6 widget-showcase-item">
                            <x-widget-include-badge name="table.__widget-11" />
                            @include('partials.widgets.tables._widget-11')
                        </div>
                        <div class="col-xl-6 widget-showcase-item">
                            <x-widget-include-badge name="table.__widget-16" />
                            @include('partials.widgets.tables._widget-16')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
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


