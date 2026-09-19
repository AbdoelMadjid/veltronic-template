<!--begin::Modal View Detail Role-->
<div class="modal fade" id="kt_modal_role_view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow-lg">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 position-relative pt-7 pt-sm-6 px-6 px-lg-8">
                <!--begin::Close Button-->
                <div class="position-absolute top-0 end-0 m-3 m-sm-4 z-index-2">
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tutup">
                        <i class="ki-outline ki-cross fs-2"></i>
                    </button>
                </div>
                <!--end::Close Button-->

                <!--begin::Header Info (3-Baris Center pada Mobile)-->
                <div class="w-100 text-center text-sm-start pe-0 pe-sm-10">
                    <!-- Row 1 (Mobile only): Icon Logo Lingkaran Sempurna -->
                    <div class="d-flex justify-content-center d-sm-none mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light-primary text-primary rounded-circle" 
                             style="width: 60px; height: 60px; min-width: 60px; min-height: 60px;">
                            <i class="ki-outline ki-shield-search text-primary fs-2x"></i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-start">
                        <div class="symbol symbol-45px symbol-circle bg-light-primary me-4 d-none d-sm-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ki-outline ki-shield-search text-primary fs-2"></i>
                        </div>
                        <div>
                            <h3 class="fw-bolder text-gray-900 m-0 fs-3" id="role_view_title">Rincian Peran</h3>
                            <span class="text-muted fs-7 d-none d-sm-inline" id="role_view_subtitle">Daftar pengguna pemegang peran dan matriks hak akses yang berlaku.</span>
                        </div>
                    </div>

                    <!-- Row 3 (Mobile only): Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0 d-sm-none" id="role_view_subtitle_mobile">
                        Daftar pengguna pemegang peran dan matriks hak akses yang berlaku.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-6 px-6 px-lg-8">
                <!--begin::Mini Stats Row-->
                <div class="row g-4 mb-7">
                    <!-- Stat 1: Total Anggota -->
                    <div class="col-sm-4">
                        <div class="border border-dashed border-gray-300 rounded p-4 d-flex align-items-center bg-body">
                            <div class="symbol symbol-40px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="ki-outline ki-profile-user text-primary fs-3"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-muted fs-8 fw-bold text-uppercase">Total Anggota</span>
                                <div class="d-flex align-items-baseline gap-1">
                                    <span class="fw-bolder fs-4 text-gray-900" id="role_view_total_users">0</span>
                                    <span class="text-muted fs-7 fw-semibold">Pengguna</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stat 2: Total Izin -->
                    <div class="col-sm-4">
                        <div class="border border-dashed border-gray-300 rounded p-4 d-flex align-items-center bg-body">
                            <div class="symbol symbol-40px symbol-circle bg-light-info me-4 d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="ki-outline ki-shield-tick text-info fs-3"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-muted fs-8 fw-bold text-uppercase">Total Hak Akses</span>
                                <div class="d-flex align-items-baseline gap-1">
                                    <span class="fw-bolder fs-4 text-gray-900" id="role_view_total_perms">0</span>
                                    <span class="text-muted fs-7 fw-semibold">Permissions</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stat 3: Guard & Proteksi -->
                    <div class="col-sm-4">
                        <div class="border border-dashed border-gray-300 rounded p-4 d-flex align-items-center bg-body">
                            <div class="symbol symbol-40px symbol-circle bg-light-success me-4 d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="ki-outline ki-security-user text-success fs-3"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-muted fs-8 fw-bold text-uppercase">Guard & Tipe</span>
                                <div class="d-flex align-items-center gap-2 mt-1">
                                    <span class="badge badge-light-success fw-bold font-monospace fs-8">web</span>
                                    <span class="badge badge-light-primary fw-bold fs-8" id="role_view_status_badge">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Mini Stats Row-->

                <!--begin::Section: Anggota Pengguna-->
                <div class="mb-7">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bolder text-gray-900 m-0 fs-6">Daftar Pengguna Pemilik Peran</h6>
                    </div>
                    <div class="border border-gray-200 rounded p-3 bg-light-subtle" style="max-height: 160px; overflow-y: auto;" id="role_view_users_list">
                        <span class="text-muted fs-8">Memuat daftar pengguna...</span>
                    </div>
                </div>
                <!--end::Section: Anggota Pengguna-->

                <!--begin::Section: CRUD Matrix Readonly-->
                <div class="mt-2">
                    @include('pages.usermanagement.partials.shared.crud-matrix-table', [
                        'matrixTree' => $matrixTree,
                        'prefixId' => 'role_view_matrix',
                        'readonly' => true,
                        'matrixTitle' => 'Matriks Hak Akses Peran (Read-Only)',
                        'matrixSubtitle' => 'Izin modul yang aktif pada peran ini ditandai dengan kotak centang'
                    ])
                </div>
                <!--end::Section: CRUD Matrix Readonly-->
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0 px-6 px-lg-8 pb-6 justify-content-center justify-content-sm-end">
                <button type="button" class="btn btn-primary fw-bold" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tutup Modal">
                    <i class="ki-outline ki-cross fs-4 me-1"></i>
                    <span>Tutup</span>
                </button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal View Detail Role-->
