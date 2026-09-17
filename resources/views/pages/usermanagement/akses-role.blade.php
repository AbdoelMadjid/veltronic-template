@extends('layouts.index')

@section('title', 'Matriks Hak Akses Peran')

@section('toolbar')
    @include('layouts.partials._toolbar')
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Petunjuk Operasional Akses Role-->
        @include('pages.usermanagement.partials.akses-role.akses-role-petunjuk')
        <!--end::Petunjuk Operasional Akses Role-->

        <!--begin::Matriks Hak Akses Table-->
        @include('pages.usermanagement.partials.akses-role.matrix-table')
        <!--end::Matriks Hak Akses Table-->

    </div>
    <!--end::Content container-->
</div>
@endsection

@section('scripts')
<script>
    window.AKSES_ROLE_ROUTES = {
        sync: "{{ route('usermanagement.akses-role.sync') }}",
        toggle: "{{ route('usermanagement.akses-role.toggle') }}",
        bulkToggle: "{{ route('usermanagement.akses-role.bulk-toggle') }}",
        csrfToken: "{{ csrf_token() }}"
    };
    window.AKSES_ROLE_MATRIX = @json($matrix);
</script>
<script src="{{ asset('assets/js/usermanagement/crud-matrix-helper.js') }}"></script>
<script src="{{ asset('assets/js/usermanagement/akses-role.js') }}"></script>
@endsection
