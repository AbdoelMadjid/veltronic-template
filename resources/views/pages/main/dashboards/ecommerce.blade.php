@extends('layouts.index')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/vis-timeline/vis-timeline.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endsection
@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Pages
        @endslot
        @slot('li_2')
            Dashboards
        @endslot
        @slot('action')
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="/apps/ecommerce/sales/listing" class="btn btn-sm fw-bold btn-secondary">Manage Sales</a>
                <a href="/apps/ecommerce/catalog/add-product" class="btn btn-sm fw-bold btn-primary">Add
                    Product</a>
            </div>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row gx-5 gx-xl-10 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-10">
                    <!--begin::Card widget 4-->
                    <x-widget-include-badge name="card.__widget-4" />
                    @include('partials.widgets.cards._widget-4')
                    <!--end::Card widget 4-->
                    <!--begin::Card widget 5-->
                    <x-widget-include-badge name="card.__widget-5" />
                    @include('partials.widgets.cards._widget-5')
                    <!--end::Card widget 5-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-10">
                    <!--begin::Card widget 6-->
                    <x-widget-include-badge name="card.__widget-6" flexible />
                    @include('partials.widgets.cards._widget-6', [
                        'widget6CardClass' => 'card card-flush h-md-50 mb-5 mb-xl-10',
                    ])
                    <!--end::Card widget 6-->
                    <!--begin::Card widget 7-->
                    <x-widget-include-badge name="card.__widget-7" flexible />
                    @include('partials.widgets.cards._widget-7', [
                        'widget7CardClass' => 'card card-flush h-md-50 mb-xl-10',
                    ])
                    <!--end::Card widget 7-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                    <!--begin::Chart widget 3-->
                    <x-widget-include-badge name="chart.__widget-3" />
                    @include('partials.widgets.charts._widget-3')
                    <!--end::Chart widget 3-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-6 mb-xl-10">
                    <!--begin::Table widget 2-->
                    <x-widget-include-badge name="table.__widget-2" />
                    @include('partials.widgets.tables._widget-2')
                    <!--end::Table widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <!--begin::Chart widget 4-->
                    <x-widget-include-badge name="chart.__widget-4" />
                    @include('partials.widgets.charts._widget-4')
                    <!--end::Chart widget 4-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::Engage widget 1-->
                    <x-widget-include-badge name="engage.__widget-1" flexible />
                    @include('partials.widgets.engage._widget-1', [
                        'engageTitleHighlight' => 'eCommerce App ?',
                    ])
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <!--begin::Table Widget 4-->
                    <x-widget-include-badge name="table.__widget-4" flexible />
                    @include('partials.widgets.tables._widget-4', [
                        'tableWidget4Title' => 'Product Orders',
                    ])
                    <!--end::Table Widget 4-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::List widget 5-->
                    <x-widget-include-badge name="list.__widget-5" />
                    @include('partials.widgets.lists._widget-5')
                    <!--end::List widget 5-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Table Widget 5-->
                    <x-widget-include-badge name="table.__widget-5" />
                    @include('partials.widgets.tables._widget-5')
                    <!--end::Table Widget 5-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    @if (($theme_version ?? \App\Support\ThemeVersion::current()) === \App\Support\ThemeVersion::default())
        <script
            src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}">
        </script>
    @endif
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/vis-timeline/vis-timeline.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    @if (($theme_version ?? \App\Support\ThemeVersion::current()) === \App\Support\ThemeVersion::default())
        <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
        <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
        <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
        <script
            src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}">
        </script>
        <script
            src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
        </script>
    @endif
    <!--end::Custom Javascript-->
@endsection
