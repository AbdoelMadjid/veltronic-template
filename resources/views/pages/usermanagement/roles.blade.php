@extends('layouts.index')

@section('title', 'Manajemen Peran (Roles)')

@section('toolbar')
    @include('layouts.partials._toolbar', [
        'action' => view()->make('layouts.partials._action-petunjuk-button', [
            'targetModal' => '#kt_modal_role_petunjuk',
            'title' => 'Petunjuk Operasional Peran'
        ])
    ])
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Roles Cards Grid-->
        @include('pages.usermanagement.partials.roles.roles-cards-list')
        <!--end::Roles Cards Grid-->

    </div>
    <!--end::Content container-->
</div>

<!--begin::Modals-->
@include('pages.usermanagement.partials.roles.roles-petunjuk')
@include('pages.usermanagement.partials.roles.roles-form-modal')
@include('pages.usermanagement.partials.roles.roles-view-modal')
<!--end::Modals-->
@endsection

@section('scripts')
<script>
    window.ROLE_ROUTES = {
        store: "{{ route('usermanagement.roles.store') }}",
        base: "{{ url('usermanagement/roles') }}",
        csrfToken: "{{ csrf_token() }}"
    };
</script>
<script src="{{ asset('assets/js/usermanagement/crud-matrix-helper.js') }}?v={{ filemtime(public_path('assets/js/usermanagement/crud-matrix-helper.js')) }}"></script>
<script src="{{ asset('assets/js/usermanagement/roles.js') }}?v={{ filemtime(public_path('assets/js/usermanagement/roles.js')) }}"></script>
@endsection
