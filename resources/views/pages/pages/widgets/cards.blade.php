@extends('layouts.index')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <style>
        .widget-showcase-row+.widget-showcase-row {
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
            display: flex;
            flex-wrap: wrap;
            column-span: all;
            break-inside: avoid;
            margin-top: 2rem;
        }

        .widget-showcase-masonry .widget-showcase-row.widget-showcase-featured .widget-showcase-item {
            width: 50%;
            padding-right: 0.75rem;
            padding-left: 0.75rem;
            margin-bottom: 0;
        }

        @media (max-width: 991.98px) {
            .widget-showcase-masonry .widget-showcase-row.widget-showcase-featured .widget-showcase-item {
                width: 100%;
                padding-right: 0;
                padding-left: 0;
            }
        }

        @media (min-width: 992px) {
            .widget-showcase-masonry {
                column-count: 2;
            }
        }

        @media (min-width: 1400px) {
            .widget-showcase-masonry {
                column-count: 3;
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
            Widgets / Cards
        @endslot
    @endcomponent
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid widget-showcase-masonry">
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-1" flexible />
                    @include('partials.widgets.cards._widget-1')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-3" flexible />
                    @include('partials.widgets.cards._widget-3')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-17" />
                    @include('partials.widgets.cards._widget-17')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-10" />
                    @include('partials.widgets.cards._widget-10')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-4" />
                    @include('partials.widgets.cards._widget-4')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-5" />
                    @include('partials.widgets.cards._widget-5')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-6" flexible />
                    @include('partials.widgets.cards._widget-6')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-7" flexible />
                    @include('partials.widgets.cards._widget-7')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-8" />
                    @include('partials.widgets.cards._widget-8')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-9" />
                    @include('partials.widgets.cards._widget-9')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-12" />
                    @include('partials.widgets.cards._widget-12')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-13" />
                    @include('partials.widgets.cards._widget-13')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">

                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-11" flexible />
                    @include('partials.widgets.cards._widget-11')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">

                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-14" flexible />
                    @include('partials.widgets.cards._widget-14')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-19" />
                    @include('partials.widgets.cards._widget-19')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-16" />
                    @include('partials.widgets.cards._widget-16')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-20" />
                    @include('partials.widgets.cards._widget-20')
                </div>
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-22" />
                    @include('partials.widgets.cards._widget-22')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-md-6 col-xl-4 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-23" />
                    @include('partials.widgets.cards._widget-23')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row">
                <div class="col-md-6 col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-28" />
                    @include('partials.widgets.cards._widget-28')
                </div>
                <div class="col-md-6 col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-2" flexible />
                    @include('partials.widgets.cards._widget-2')
                </div>
            </div>
            <div class="row g-5 g-xl-8 mb-10 widget-showcase-row widget-showcase-featured">
                <div class="col-md-6 col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-15" />
                    @include('partials.widgets.cards._widget-15')
                </div>
                <div class="col-md-6 col-xl-6 widget-showcase-item">
                    <x-widget-include-badge name="card.__widget-18" />
                    @include('partials.widgets.cards._widget-18')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
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
