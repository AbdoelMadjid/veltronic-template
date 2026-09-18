@extends('layouts.index')

@section('toolbar')
    @include('layouts.partials._toolbar', [
        'action' => view()->make('layouts.partials._action-petunjuk-button', [
            'targetModal' => '#kt_modal_app_fiturs_petunjuk',
            'title' => 'Petunjuk Operasional Manajer Fitur & Pengaturan Sistem',
        ]),
    ])
@endsection

@section('styles')
    <!--begin::Vendor Stylesheets-->
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Overview Header Banner-->
        @include('pages.appsupport.partials.app-fiturs.header-banner')
        <!--end::Overview Header Banner-->

        <!--begin::Navs Card-->
        <div class="card card-flush shadow-sm border-0 mb-6">
            <div class="card-header border-0 pt-2 px-6">
                @include('pages.appsupport.partials.app-fiturs.navs', ['active' => 'visibility'])
            </div>
        </div>
        <!--end::Navs Card-->

        <!--begin::Tab Content-->
        <div class="tab-content" id="kt_app_fiturs_tabs">
            <!--begin:::Tab pane visibility-->
            <div class="tab-pane fade show active" id="kt_app_fiturs_tab_visibility" role="tabpanel">
                @include('pages.appsupport.partials.app-fiturs.tabs.visibility')
            </div>
            <!--end:::Tab pane visibility-->

            <!--begin:::Tab pane settings-->
            <div class="tab-pane fade" id="kt_app_fiturs_tab_settings" role="tabpanel">
                @include('pages.appsupport.partials.app-fiturs.tabs.settings')
            </div>
            <!--end:::Tab pane settings-->

            <!--begin:::Tab pane shortcuts-->
            <div class="tab-pane fade" id="kt_app_fiturs_tab_shortcuts" role="tabpanel">
                @include('pages.appsupport.partials.app-fiturs.tabs.shortcuts')
            </div>
            <!--end:::Tab pane shortcuts-->

            <!--begin:::Tab pane activity logs-->
            <div class="tab-pane fade" id="kt_app_fiturs_tab_activity_logs" role="tabpanel">
                @include('pages.appsupport.partials.app-fiturs.tabs.activity-logs')
            </div>
            <!--end:::Tab pane activity logs-->
        </div>
        <!--end::Tab Content-->

        <!--begin::Modals-->
        @include('pages.appsupport.partials.app-fiturs.modals.app-fiturs-petunjuk')
        @include('pages.appsupport.partials.app-fiturs.modals.log-detail-modal')
        <!--end::Modals-->

    </div>
    <!--end::Content container-->
</div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Vendors Javascript-->
    <script src="{{ asset('assets/js/appsupport/app-fiturs.js') }}"></script>
@endsection
