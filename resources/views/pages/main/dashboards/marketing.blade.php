@extends('layouts.index')
@section('styles')
    {{-- css_halaman_ini --}}
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
                <!--begin::Secondary button-->
                <a href="/apps/customers/view" class="btn btn-sm fw-bold btn-secondary">Add Customer</a>
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="javascript:void(0)" class="btn btn-sm fw-bold btn-primary">New Campaign</a>
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
            <div class="row gy-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-6">
                    <!--begin::Row-->
                    <div class="row gx-5 gx-xl-10">
                        <!--begin::Col-->
                        <div class="col-sm-6 mb-5 mb-xl-10">
                            <!--begin::List widget 1-->
                            <x-widget-include-badge name="list.__widget-1" />
                            @include('partials.widgets.lists._widget-1')
                            <!--end::LIst widget 1-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-sm-6 mb-5 mb-xl-10">
                            <!--begin::List widget 2-->
                            <x-widget-include-badge name="list.__widget-2" />
                            @include('partials.widgets.lists._widget-2')
                            <!--end::List widget 2-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Table widget 1-->
                    <x-widget-include-badge name="table.__widget-1" />
                    @include('partials.widgets.tables._widget-1')
                    <!--end::Table widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <x-widget-include-badge name="chart.__widget-8" />
                    @include('partials.widgets.charts._widget-8')
                    <!--end::Chart widget 8-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-12 col-xxl-4">
                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-12">
                            <!--begin::Card widget 1-->
                            <x-widget-include-badge name="card.__widget-1" />
                            @include('partials.widgets.cards._widget-1')
                            <!--end::Card widget 1-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xxl-12">
                            <!--begin::List widget 3-->
                            <x-widget-include-badge name="list.__widget-3" />
                            @include('partials.widgets.lists._widget-3')
                            <!--end::List widget 3-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-12 col-xxl-8 mb-5 mb-xl-10">
                    <!--begin::Table Widget 3-->
                    <x-widget-include-badge name="table.__widget-3" />
                    @include('partials.widgets.tables._widget-3')
                    <!--end::Table Widget 3-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Engage widget 1-->
                    <x-widget-include-badge name="engage.__widget-1" flexible />
                    @include('partials.widgets.engage._widget-1', [
                        'engageCardClass' => 'card h-xl-100',
                        'engagePrimaryTarget' => '#kt_modal_new_card',
                        'engageSecondaryHref' => '/pages/general/user-profile/followers',
                    ])
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Timeline Widget 1-->
                    <x-widget-include-badge name="timeline.__widget-1" />
                    @include('partials.widgets.timeline._widget-1')
                    <!--end::Timeline Widget 1-->
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
            src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-campaign.js', $theme_asset_pack ?? null) }}">
        </script>
    @endif
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/new-card.js', $theme_asset_pack ?? null) }}">
    </script>
    @if (($theme_version ?? \App\Support\ThemeVersion::current()) === \App\Support\ThemeVersion::default())
        <script
            src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
        </script>
    @endif
    <!--end::Custom Javascript-->
@endsection
