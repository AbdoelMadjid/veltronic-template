@extends('layouts.index')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endsection
@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Dashboards
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
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-6">
                    <!--begin::Card widget 15-->
                    <x-widget-include-badge name="card.__widget-15" />
                    @include('partials.widgets.cards._widget-15')
                    <!--end::Card widget 15-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xxl-3">
                    <!--begin::Card widget 14-->
                    <x-widget-include-badge name="card.__widget-14" />
                    @include('partials.widgets.cards._widget-14')
                    <!--end::Card widget 14-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xxl-3">
                    <!--begin::Card widget 14a-->
                    <x-widget-include-badge name="card.__widget-14" flexible />
                    @include('partials.widgets.cards._widget-14', [
                        'widget14Image' => 'media/stock/600x600/img-47.jpg',
                        'widget14Title' => 'Happy Kitty Art',
                        'widget14LastBid' => '7.83 ETH',
                        'widget14Total' => '$17,035',
                        'widget14ViewHref' => route('apps.ecommerce.sales.listing'),
                    ])
                    <!--end::Card widget 14-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Chart Widget 33-->
                    <x-widget-include-badge name="chart.__widget-33" />
                    @include('partials.widgets.charts._widget-33')
                    <!--end::Chart Widget 33-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Table widget 12-->
                    <x-widget-include-badge name="table.__widget-12" />
                    @include('partials.widgets.tables._widget-12')
                    <!--end::Table widget 12-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::List widget 23-->
                    <x-widget-include-badge name="list.__widget-23" />
                    @include('partials.widgets.lists._widget-23')
                    <!--end::List widget 23-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Table widget 13-->
                    <x-widget-include-badge name="table.__widget-13" />
                    @include('partials.widgets.tables._widget-13')
                    <!--end::Table widget 13-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Engage widget 1-->
                    <x-widget-include-badge name="engage.__widget-1" flexible />
                    @include('partials.widgets.engage._widget-1', [
                        'engageTitlePrefix' => 'Have you tried',
                        'engageTitleMiddle' => 'new',
                        'engageTitleHighlight' => 'Invoice Manager ?',
                        'engagePrimaryHref' => route('apps.ecommerce.customers.listing'),
                        'engagePrimaryText' => 'Try now',
                        'engageSecondaryHref' => route('apps.invoices.view.invoice-1'),
                        'engageSecondaryText' => 'Learn more',
                        'engageIllustrationLight' => 'media/svg/illustrations/easy/2.svg',
                        'engageIllustrationDark' => 'media/svg/illustrations/easy/2-dark.svg',
                    ])
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Table Widget 4-->
                    <x-widget-include-badge name="table.__widget-4" />
                    @include('partials.widgets.tables._widget-4')
                    <!--end::Table Widget 4-->
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
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/fslightbox/fslightbox.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/typedjs/typedjs.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
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
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-project/type.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-project/budget.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-project/settings.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-project/team.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-project/targets.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-project/files.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-project/complete.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-project/main.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-campaign.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/bidding.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-app.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection
