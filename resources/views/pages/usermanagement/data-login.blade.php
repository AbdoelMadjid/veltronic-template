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
<style>
    /* Mobile: 3 Baris Terstruktur (Baris 1: Show x data, Baris 2: Menampilkan... data, Baris 3: Navigasi) */
    @media (max-width: 767.98px) {
        #kt_table_data_login_wrapper .row:last-child {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.65rem !important;
            text-align: center !important;
            margin-top: 1rem !important;
            padding-top: 0.75rem !important;
        }
        #kt_table_data_login_wrapper .row:last-child > div {
            width: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        #kt_table_data_login_wrapper .dataTables_length {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            text-align: center !important;
            white-space: nowrap !important;
            font-size: 0.85rem !important;
            margin-bottom: 0.35rem !important;
        }
        #kt_table_data_login_wrapper .dataTables_length select {
            width: auto !important;
            display: inline-block !important;
            margin: 0 4px !important;
            padding: 0.25rem 1.75rem 0.25rem 0.5rem !important;
            font-size: 0.85rem !important;
        }
        #kt_table_data_login_wrapper .dataTables_info {
            display: block !important;
            width: 100% !important;
            white-space: nowrap !important;
            text-align: center !important;
            padding: 0 !important;
            margin: 0 !important;
            font-size: 0.85rem !important;
            color: var(--bs-gray-600) !important;
        }
        #kt_table_data_login_wrapper .dataTables_paginate {
            display: flex !important;
            justify-content: center !important;
            width: 100% !important;
            text-align: center !important;
            margin-top: 0.25rem !important;
        }
        #kt_table_data_login_wrapper .dataTables_paginate .pagination {
            display: inline-flex !important;
            flex-wrap: nowrap !important;
            justify-content: center !important;
            margin: 0 !important;
        }
        #kt_table_data_login_wrapper .dataTables_paginate .pagination .page-item .page-link {
            min-width: 32px !important;
            height: 32px !important;
            padding: 0 6px !important;
            font-size: 0.85rem !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 2px !important;
        }
    }

    /* Desktop: Baris 1 & 2 Sejajar di Kiri, Baris 3 Navigasi di Kanan */
    @media (min-width: 768px) {
        #kt_table_data_login_wrapper .row:last-child {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            margin-top: 1.25rem !important;
            padding-top: 1rem !important;
            border-top: 1px solid var(--bs-gray-200) !important;
        }
        #kt_table_data_login_wrapper .dataTables_length {
            display: inline-flex !important;
            align-items: center !important;
            margin-right: 1.25rem !important;
            white-space: nowrap !important;
        }
        #kt_table_data_login_wrapper .dataTables_length select {
            margin: 0 4px !important;
            width: auto !important;
            display: inline-block !important;
        }
        #kt_table_data_login_wrapper .dataTables_info {
            display: inline-block !important;
            padding: 0 !important;
            white-space: nowrap !important;
        }
        #kt_table_data_login_wrapper .dataTables_paginate {
            display: flex !important;
            justify-content: flex-end !important;
        }
    }
</style>
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
