@extends('layouts.index')

@section('title', 'Manajemen Pengguna')

@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endsection

@section('toolbar')
    @include('layouts.partials._toolbar')
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!--begin::Header Banner (Tanpa Ikon sesuai aturan UI)-->
            <div class="card card-flush shadow-sm mb-6 border-0 bg-light-primary">
                <div class="card-body py-7 px-8">
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-4">
                        <!-- Sisi Kiri: Judul & Keterangan Murni Teks -->
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <h2 class="fw-bolder text-gray-900 m-0 fs-2">Manajemen Pengguna</h2>
                                <span class="badge badge-primary fw-bold fs-8 px-3 py-1">Data Master</span>
                            </div>
                            <span class="text-muted fs-7 d-block mt-1">
                                Kelola daftar akun pengguna sistem, konfigurasi hak akses peran pengguna, serta status autentikasi.
                            </span>
                        </div>

                        <!-- Sisi Kanan: Tombol Aksi Rata Kanan & Responsif Mobile -->
                        <div class="d-flex align-items-center justify-content-end w-100 w-md-auto flex-shrink-0 ms-md-auto gap-2">
                            <button type="button" class="btn btn-sm btn-primary fw-bold d-inline-flex align-items-center" id="btn_open_add_user"
                                data-bs-toggle="tooltip" data-bs-trigger="hover" title="Tambah Pengguna Baru">
                                <i class="ki-duotone ki-plus fs-5 me-1"></i>
                                <span class="d-none d-sm-inline">Tambah Pengguna</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header Banner-->

            <!--begin::Card Daftar Pengguna-->
            <div class="card card-flush shadow-sm">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title (Pencarian Sisi Kiri Merapat ke Kiri)-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" id="kt_filter_search" class="form-control form-control-solid w-200px w-md-250px ps-12"
                                placeholder="Cari nama atau email..." />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar (Filter Peran, Reset, dan Segarkan Rata Kanan)-->
                    <div class="card-toolbar d-flex align-items-center gap-2 gap-md-3 flex-wrap">
                        <!--begin::Filter Peran-->
                        <div class="w-130px w-md-150px">
                            <select id="kt_filter_role" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Semua Peran">
                                <option value="">Semua Peran</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Filter Peran-->

                        <!--begin::Atur Ulang Filter-->
                        <button type="button" id="kt_filter_reset" class="btn btn-light d-inline-flex align-items-center px-3"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" title="Atur Ulang Filter">
                            <i class="ki-duotone ki-cross fs-6 me-1"><span class="path1"></span><span class="path2"></span></i>
                            <span>Atur Ulang</span>
                        </button>
                        <!--end::Atur Ulang Filter-->

                        <!--begin::Segarkan-->
                        <button type="button" id="btn_refresh_datatable" class="btn btn-light-primary fw-bold d-inline-flex align-items-center"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" title="Segarkan Data Tabel">
                            <i class="ki-duotone ki-arrows-circle fs-5 me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="d-none d-sm-inline">Segarkan</span>
                        </button>
                        <!--end::Segarkan-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">#</th>
                                    <th class="min-w-200px">Pengguna</th>
                                    <th class="min-w-125px">Peran</th>
                                    <th class="min-w-125px">Status Email</th>
                                    <th class="min-w-150px">Tanggal Bergabung</th>
                                    <th class="text-end min-w-100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                <!-- Data diisi otomatis oleh Yajra DataTables -->
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card Daftar Pengguna-->

        </div>
        <!--end::Content container-->
    </div>

    <!-- Modals -->
    @include('pages.manajemenpengguna.partials.users-form-modal')
    @include('pages.manajemenpengguna.partials.users-detail-modal')
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script>
        window.USER_MANAGEMENT_ROUTES = {
            datatable: "{{ route('manajemenpengguna.users.index') }}",
            store: "{{ route('manajemenpengguna.users.store') }}",
            base: "{{ url('manajemenpengguna/users') }}",
            auth_id: {{ auth()->id() ?? 'null' }}
        };
    </script>
    <script src="{{ asset('assets/js/manajemenpengguna/users.js') }}"></script>
    <!--end::Custom Javascript-->
@endsection
