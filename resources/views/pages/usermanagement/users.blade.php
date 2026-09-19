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
    <style>
        /* Mobile: 3 Baris Terstruktur (Baris 1: Show x data, Baris 2: Menampilkan... data, Baris 3: Navigasi) */
        @media (max-width: 767.98px) {
            #kt_table_users_wrapper .row:last-child {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 0.65rem !important;
                text-align: center !important;
                margin-top: 1rem !important;
                padding-top: 0.75rem !important;
            }
            #kt_table_users_wrapper .row:last-child > div {
                width: 100% !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                text-align: center !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            #kt_table_users_wrapper .dataTables_length {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 100% !important;
                text-align: center !important;
                white-space: nowrap !important;
                font-size: 0.85rem !important;
                margin-bottom: 0.35rem !important;
            }
            #kt_table_users_wrapper .dataTables_length select {
                width: auto !important;
                display: inline-block !important;
                margin: 0 4px !important;
                padding: 0.25rem 1.75rem 0.25rem 0.5rem !important;
                font-size: 0.85rem !important;
            }
            #kt_table_users_wrapper .dataTables_info {
                display: block !important;
                width: 100% !important;
                white-space: nowrap !important;
                text-align: center !important;
                padding: 0 !important;
                margin: 0 !important;
                font-size: 0.85rem !important;
                color: var(--bs-gray-600) !important;
            }
            #kt_table_users_wrapper .dataTables_paginate {
                display: flex !important;
                justify-content: center !important;
                width: 100% !important;
                text-align: center !important;
                margin-top: 0.25rem !important;
            }
            #kt_table_users_wrapper .dataTables_paginate .pagination {
                display: inline-flex !important;
                flex-wrap: nowrap !important;
                justify-content: center !important;
                margin: 0 !important;
            }
            #kt_table_users_wrapper .dataTables_paginate .pagination .page-item .page-link {
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
            #kt_table_users_wrapper .row:last-child {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                margin-top: 1.25rem !important;
                padding-top: 1rem !important;
                border-top: 1px solid var(--bs-gray-200) !important;
            }
            #kt_table_users_wrapper .dataTables_length {
                display: inline-flex !important;
                align-items: center !important;
                margin-right: 1.25rem !important;
                white-space: nowrap !important;
            }
            #kt_table_users_wrapper .dataTables_length select {
                margin: 0 4px !important;
                width: auto !important;
                display: inline-block !important;
            }
            #kt_table_users_wrapper .dataTables_info {
                display: inline-block !important;
                padding: 0 !important;
                white-space: nowrap !important;
            }
            #kt_table_users_wrapper .dataTables_paginate {
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

            <!--begin::Top Filter & Search Bar-->
            @include('pages.usermanagement.partials.users.users-filter-top')
            <!--end::Top Filter & Search Bar-->

            <!--begin::Toolbar Konten & Actions-->
            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-between gap-3 pb-6">
                <!--begin::Title / Counter-->
                <div class="d-flex align-items-center justify-content-between justify-content-sm-start flex-wrap gap-2">
                    <h3 class="fw-bolder text-gray-900 m-0 fs-5 fs-sm-4" id="users_count_heading">
                        <span id="users_total_count" class="text-primary">{{ $users->total() }}</span> Pengguna Ditemukan
                    </h3>
                    <span class="badge badge-light-primary fw-semibold fs-8 px-3 py-2" id="users_sort_label">
                        {{ ($filters['sort'] ?? '') === 'oldest' ? 'Terlama' : (($filters['sort'] ?? '') === 'name_asc' ? 'Nama A-Z' : (($filters['sort'] ?? '') === 'name_desc' ? 'Nama Z-A' : 'Terbaru')) }}
                    </span>
                </div>
                <!--end::Title / Counter-->

                <!--begin::Controls & Action Buttons (Responsive on Mobile & Desktop)-->
                <div class="d-flex align-items-center justify-content-between justify-content-sm-end gap-2 gap-sm-3">
                    <!--begin::View Mode Switcher (Card vs Table)-->
                    <div class="d-inline-flex align-items-center bg-light-subtle rounded-3 p-1 border border-gray-200">
                        <ul class="nav nav-pills p-0 m-0 gap-1" role="tablist">
                            <li class="nav-item m-0" role="presentation" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tampilan Kartu">
                                <a class="btn btn-sm btn-icon btn-color-gray-600 btn-active-primary active rounded-2 w-32px h-32px w-sm-35px h-sm-35px"
                                    data-bs-toggle="tab" href="#kt_project_users_card_pane" role="tab">
                                    <i class="ki-outline ki-element-plus fs-3"></i>
                                </a>
                            </li>
                            <li class="nav-item m-0" role="presentation" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tampilan Tabel">
                                <a class="btn btn-sm btn-icon btn-color-gray-600 btn-active-primary rounded-2 w-32px h-32px w-sm-35px h-sm-35px"
                                    data-bs-toggle="tab" href="#kt_project_users_table_pane" role="tab">
                                    <i class="ki-outline ki-row-horizontal fs-3"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--end::View Mode Switcher-->

                    <div class="d-flex align-items-center gap-2">
                        <!--begin::Tombol Beri Peran Massal-->
                        <button type="button" id="btn_open_bulk_role" class="btn btn-sm btn-light-primary fw-bold d-none px-3"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Berikan Peran Massal ke Pengguna Terpilih">
                            <i class="ki-outline ki-shield-tick fs-4 me-0 me-sm-1"></i>
                            <span id="bulk_role_selected_badge" class="badge badge-primary me-1">0</span>
                            <span class="d-none d-sm-inline">Beri Peran Massal</span>
                        </button>
                        <!--end::Tombol Beri Peran Massal-->

                        <!--begin::Tombol Tambah Pengguna-->
                        <button type="button" id="btn_open_add_user" class="btn btn-sm btn-primary fw-bold px-3 px-sm-4"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Pengguna Baru">
                            <i class="ki-outline ki-plus fs-4 me-0 me-sm-1"></i>
                            <span class="d-none d-sm-inline">Tambah Pengguna</span>
                        </button>
                        <!--end::Tombol Tambah Pengguna-->
                    </div>
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
    <script src="{{ asset('assets/js/usermanagement/users.js') }}?v={{ time() }}"></script>
    <!--end::Modul Javascript Logic-->
@endsection
