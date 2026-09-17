<!--begin::Modal View Detail Role-->
<div class="modal fade" id="kt_modal_role_view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow-lg">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-45px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ki-outline ki-shield-search text-primary fs-2"></i>
                    </div>
                    <div>
                        <h3 class="fw-bolder text-gray-900 m-0 fs-3" id="role_view_title">Rincian Peran</h3>
                        <span class="text-muted fs-7" id="role_view_subtitle">Daftar pengguna pemegang peran dan matriks hak akses yang berlaku.</span>
                    </div>
                </div>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-outline ki-cross fs-2"></i>
                </div>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-6 px-8">
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
            <div class="modal-footer border-0 pt-0 px-8 pb-6">
                <button type="button" class="btn btn-primary fw-bold" data-bs-dismiss="modal">Tutup</button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal View Detail Role-->
