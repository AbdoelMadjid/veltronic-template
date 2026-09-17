@extends('layouts.index')

@section('toolbar')
    @include('layouts.partials._toolbar', [
        'action' => view()->make('layouts.partials._action-petunjuk-button', [
            'targetModal' => '#kt_modal_permissions_petunjuk',
            'title' => 'Petunjuk Operasional Izin',
        ]),
    ])
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!--begin::Permissions Table-->
            @include('pages.usermanagement.partials.permissions.permissions-table')
            <!--end::Permissions Table-->

        </div>
        <!--end::Content container-->
    </div>

    <!--begin::Modals-->
    @include('pages.usermanagement.partials.permissions.permissions-petunjuk')
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
    <script
        src="{{ asset('assets/js/usermanagement/permissions.js') }}?v={{ filemtime(public_path('assets/js/usermanagement/permissions.js')) }}">
    </script>
@endsection
