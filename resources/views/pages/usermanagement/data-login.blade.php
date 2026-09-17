@extends('layouts.index')

@section('toolbar')
@include('layouts.partials._toolbar', [
'action' => view()->make('layouts.partials._action-petunjuk-button', [
'targetModal' => '#kt_modal_data_login_petunjuk',
'title' => 'Petunjuk Operasional Data Login Pengguna',
]),
])
@endsection

@section('styles')
<!--begin::Vendor Stylesheets-->
<link
    href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
    rel="stylesheet" type="text/css" />
<!--end::Vendor Stylesheets-->
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Header Banner-->
        @include('pages.usermanagement.partials.data-login.data-login-banner')
        <!--end::Header Banner-->

        <!--begin::Statistics Cards-->
        @include('pages.usermanagement.partials.data-login.data-login-stats')
        <!--end::Statistics Cards-->

        <!--begin::Table Container-->
        @include('pages.usermanagement.partials.data-login.data-login-table')
        <!--end::Table Container-->

    </div>
    <!--end::Content container-->
</div>

<!--begin::Modals-->
@include('pages.usermanagement.partials.data-login.data-login-petunjuk')
@include('pages.usermanagement.partials.data-login.data-login-detail-modal')
<!--end::Modals-->
@endsection

@section('scripts')
<!--begin::Vendors Javascript-->
<script
    src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}">
</script>
<!--end::Vendors Javascript-->

<!--begin::Custom Javascript-->
<script>
    window.DATA_LOGIN_CONFIG = {
            urlIndex: "{{ route('usermanagement.data-login') }}",
            urlBulkDelete: "{{ route('usermanagement.data-login.bulk-delete') }}",
            urlClear: "{{ route('usermanagement.data-login.clear') }}",
            csrfToken: "{{ csrf_token() }}"
        };
</script>
<script
    src="{{ asset('assets/js/usermanagement/data-login.js') }}?v={{ file_exists(public_path('assets/js/usermanagement/data-login.js')) ? filemtime(public_path('assets/js/usermanagement/data-login.js')) : time() }}">
</script>
<!--end::Custom Javascript-->
@endsection
