@extends('layouts.index')

@section('toolbar')
    @include('layouts.partials._toolbar')
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
        </div>
        <!--end::Tab Content-->

    </div>
    <!--end::Content container-->
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/appsupport/app-fiturs.js') }}"></script>
@endsection
