@extends('layouts.index')

@section('title', 'Hak Akses Pengguna')

@section('toolbar')
    @include('layouts.partials._toolbar')
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Petunjuk Operasional Akses User-->
        @include('pages.usermanagement.partials.akses-user.akses-user-petunjuk')
        <!--end::Petunjuk Operasional Akses User-->

        <!--begin::Tabel Hak Akses Pengguna-->
        @include('pages.usermanagement.partials.akses-user.user-access-table')
        <!--end::Tabel Hak Akses Pengguna-->

    </div>
    <!--end::Content container-->
</div>

<!--begin::Modals-->
@include('pages.usermanagement.partials.akses-user.user-access-modal')
<!--end::Modals-->
@endsection

@section('scripts')
<script>
    window.AKSES_USER_ROUTES = {
        assignRole: "{{ route('usermanagement.akses-user.assign-role') }}",
        base: "{{ url('usermanagement/akses-user') }}",
        csrfToken: "{{ csrf_token() }}"
    };
</script>
<script src="{{ asset('assets/js/usermanagement/crud-matrix-helper.js') }}"></script>
<script src="{{ asset('assets/js/usermanagement/akses-user.js') }}"></script>
@endsection
