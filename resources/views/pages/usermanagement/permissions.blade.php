@extends('layouts.index')

@section('title', 'Manajemen Izin (Permissions)')

@section('toolbar')
    @include('layouts.partials._toolbar')
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Petunjuk Operasional Permissions-->
        @include('pages.usermanagement.partials.permissions.permissions-petunjuk')
        <!--end::Petunjuk Operasional Permissions-->

        <!--begin::Permissions Table-->
        @include('pages.usermanagement.partials.permissions.permissions-table')
        <!--end::Permissions Table-->

    </div>
    <!--end::Content container-->
</div>

<!--begin::Modals-->
@include('pages.usermanagement.partials.permissions.permissions-form-modal')
@include('pages.usermanagement.partials.permissions.permissions-generate-modal')
<!--end::Modals-->
@endsection

@section('scripts')
<script>
    window.PERMISSION_ROUTES = {
        store: "{{ route('usermanagement.permissions.store') }}",
        generate: "{{ route('usermanagement.permissions.generate') }}",
        base: "{{ url('usermanagement/permissions') }}",
        csrfToken: "{{ csrf_token() }}"
    };
</script>
<script src="{{ asset('assets/js/usermanagement/permissions.js') }}"></script>
@endsection
