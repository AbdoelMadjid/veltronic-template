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
                <!--begin::Secondary button-->
                <a href="/apps/subscriptions/list" class="btn btn-sm fw-bold btn-secondary">My Subscriptions</a>
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="javascript:void(0)" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_top_up_wallet">Top Up</a>
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
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Row-->
                    <div class="row g-5 gx-xl-10">
                        <!--begin::Col-->
                        <div class="col-md-4">
                            <!--begin::Card widget 11-->
                            <x-widget-include-badge name="card.__widget-11" />
                            @include('partials.widgets.cards._widget-11')
                            <!--end::Card widget 11-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-4">
                            <!--begin::Card widget 11-->
                            <x-widget-include-badge name="card.__widget-11" flexible />
                            @include('partials.widgets.cards._widget-11', [
                                'widget11CardStyle' => 'background-color: #f3d6ef',
                                'widget11Title' => 'Etherium',
                                'widget11Subtitle' => '325,035 USD for 1 ETH',
                                'widget11Image' => 'media/svg/shapes/ethereum.svg',
                                'widget11Amount' => '29.33460000 ETH',
                                'widget11AmountUsd' => '7,336,00 USD',
                                'widget11ButtonClass' => 'btn btn-icon justify-content-end',
                                'widget11ButtonIconClass' => 'ki-duotone ki-dots-square fs-1',
                            ])
                            <!--end::Card widget 11-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-4">
                            <!--begin::Card widget 11-->
                            <x-widget-include-badge name="card.__widget-11" flexible />
                            @include('partials.widgets.cards._widget-11', [
                                'widget11CardStyle' => 'background-color: #bfdde3',
                                'widget11Title' => 'Dogecoin',
                                'widget11Subtitle' => '0.12,045 USD for 1 DOGE',
                                'widget11Image' => 'media/svg/shapes/dogecoin.svg',
                                'widget11Amount' => '4703.7589 DOGE',
                                'widget11AmountUsd' => '503,005,56 USD',
                                'widget11ButtonClass' => 'btn btn-icon justify-content-end',
                                'widget11ButtonIconClass' => 'ki-duotone ki-dots-square fs-1',
                            ])
                            <!--end::Card widget 11-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::Forms widget 1-->
                    <x-widget-include-badge name="forms.__widget-1" />
                    @include('partials.widgets.forms._widget-1')
                    <!--end::Forms widget 1-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Chart widget 26-->
                    <x-widget-include-badge name="chart.__widget-26" />
                    @include('partials.widgets.charts._widget-26')
                    <!--end::Chart widget 26-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::Engage widget 1-->
                    <x-widget-include-badge name="engage.__widget-1" flexible />
                    @include('partials.widgets.engage._widget-1', [
                        'engageTitlePrefix' => 'Try out our',
                        'engageTitleMiddle' => 'new',
                        'engageTitleHighlight' => 'Invoice Manager',
                        'engagePrimaryTarget' => '#kt_modal_create_account',
                        'engagePrimaryText' => 'Try Now',
                        'engageSecondaryHref' => route('apps.ecommerce.sales.listing'),
                        'engageSecondaryText' => 'Learn More',
                        'engageIllustrationLight' => 'media/svg/illustrations/easy/2.svg',
                        'engageIllustrationDark' => 'media/svg/illustrations/easy/2-dark.svg',
                    ])
                    {{--  --}}
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Table widget 7-->
                    <x-widget-include-badge name="table.__widget-7" />
                    @include('partials.widgets.tables._widget-7')
                    <!--end::Table widget 7-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::List widget 22-->
                    <x-widget-include-badge name="list.__widget-22" />
                    @include('partials.widgets.lists._widget-22')
                    <!--end::List widget 22-->
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
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/vis-timeline/vis-timeline.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/top-up-wallet.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-account.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection
