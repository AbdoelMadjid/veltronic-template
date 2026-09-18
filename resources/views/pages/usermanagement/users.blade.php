@extends('layouts.index')

@section('toolbar')
    @include('layouts.partials._toolbar', [
        'action' => view()->make('layouts.partials._action-petunjuk-button', [
            'targetModal' => '#kt_modal_users_petunjuk',
            'title' => 'Petunjuk Operasional Pengguna',
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

            <!--begin::Top Filter & Search Bar-->
            @include('pages.usermanagement.partials.users.users-filter-top')
            <!--end::Top Filter & Search Bar-->

            <!--begin::Toolbar Konten & Actions-->
            <div class="d-flex flex-wrap flex-stack pb-6">
                <!--begin::Title / Counter-->
                <div class="d-flex flex-wrap align-items-center my-1">
                    <h3 class="fw-bold me-5 my-1" id="users_count_heading">
                        <span id="users_total_count">{{ $users->total() }}</span> Pengguna Ditemukan
                        <span class="text-gray-500 fs-6 ms-1" id="users_sort_label">
                            {{ ($filters['sort'] ?? '') === 'oldest' ? '• Terlama' : (($filters['sort'] ?? '') === 'name_asc' ? '• Nama A-Z' : (($filters['sort'] ?? '') === 'name_desc' ? '• Nama Z-A' : '• Terbaru')) }}
                        </span>
                    </h3>
                </div>
                <!--end::Title / Counter-->

                <!--begin::Controls & Action Buttons (Right-Aligned & Responsive)-->
                <div class="d-flex flex-wrap align-items-center my-1 gap-3 ms-auto flex-shrink-0">
                    <!--begin::Tab nav-->
                    <ul class="nav nav-pills me-2">
                        <li class="nav-item m-0">
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-2 active"
                                data-bs-toggle="tab" href="#kt_project_users_card_pane" data-bs-toggle="tooltip"
                                title="Tampilan Kartu">
                                <i class="ki-outline ki-element-plus fs-2"></i>
                            </a>
                        </li>
                        <li class="nav-item m-0">
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary"
                                data-bs-toggle="tab" href="#kt_project_users_table_pane" data-bs-toggle="tooltip"
                                title="Tampilan Tabel">
                                <i class="ki-outline ki-row-horizontal fs-2"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end::Tab nav-->

                    <!--begin::Tombol Beri Peran Massal-->
                    <button type="button" id="btn_open_bulk_role" class="btn btn-sm btn-light-primary fw-bold d-none"
                        data-bs-toggle="tooltip" title="Berikan Peran Massal ke Pengguna Terpilih">
                        <i class="ki-outline ki-shield-tick fs-4 me-1"></i>
                        <span id="bulk_role_selected_badge" class="badge badge-primary me-1">0</span>
                        <span>Beri Peran Massal</span>
                    </button>
                    <!--end::Tombol Beri Peran Massal-->

                    <!--begin::Tombol Tambah Pengguna-->
                    <button type="button" id="btn_open_add_user" class="btn btn-sm btn-primary fw-bold"
                        data-bs-toggle="tooltip" title="Tambah Pengguna Baru">
                        <i class="ki-outline ki-plus fs-4 me-0 me-sm-1"></i>
                        <span class="d-none d-sm-inline">Tambah Pengguna</span>
                    </button>
                    <!--end::Tombol Tambah Pengguna-->
                </div>
                <!--end::Controls & Action Buttons-->
            </div>
            <!--end::Toolbar Konten & Actions-->

            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tab pane: Card View-->
                @include('pages.usermanagement.partials.users.users-cards-pane')
                <!--end::Tab pane: Card View-->

                <!--begin::Tab pane: Table View-->
                @include('pages.usermanagement.partials.users.users-table-pane')
                <!--end::Tab pane: Table View-->
            </div>
            <!--end::Tab Content-->

        </div>
        <!--end::Content container-->
    </div>

    <!--begin::Modals-->
    @include('pages.usermanagement.partials.users.users-petunjuk')
    @include('pages.usermanagement.partials.users.users-bulk-role-modal')
    @include('pages.usermanagement.partials.users.users-form-modal')
    @include('pages.usermanagement.partials.users.users-detail-modal')
    <!--end::Modals-->
@endsection

@section('scripts')
    <!--begin::Vendors Javascript-->
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Vendors Javascript-->

    <!--begin::Modul Script Config & Routes-->
    <script>
        window.USER_MANAGEMENT_ROUTES = {
            datatable: "{{ route('usermanagement.users.index') }}",
            store: "{{ route('usermanagement.users.store') }}",
            bulkAssignRole: "{{ route('usermanagement.users.bulk-assign-role') }}",
            base: "{{ url('usermanagement/users') }}",
            auth_id: "{{ auth()->id() }}"
        };
    </script>
    <!--end::Modul Script Config & Routes-->

    <!--begin::Modul Javascript Logic-->
    <script src="{{ asset('assets/js/usermanagement/users.js') }}"></script>
    <!--end::Modul Javascript Logic-->
@endsection
