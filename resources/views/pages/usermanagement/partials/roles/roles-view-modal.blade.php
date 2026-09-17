<!--begin::Modal View Detail Role-->
<div class="modal fade" id="kt_modal_role_view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0">
                <div>
                    <h3 class="fw-bolder text-gray-900 m-0" id="role_view_title">Rincian Peran</h3>
                    <span class="text-muted fs-8" id="role_view_subtitle">Daftar pengguna dan matriks hak akses aktif.</span>
                </div>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-outline ki-cross fs-2"></i>
                </div>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-6 px-8">
                <!-- Metadata Badges -->
                <div class="d-flex flex-wrap align-items-center gap-3 mb-6 p-4 bg-light rounded">
                    <div class="badge badge-light-primary fs-8 fw-bold px-3 py-2">
                        Total Anggota: <span id="role_view_total_users" class="text-gray-900 fw-bolder ms-1">0</span> Pengguna
                    </div>
                    <div class="badge badge-light-info fs-8 fw-bold px-3 py-2">
                        Total Izin: <span id="role_view_total_perms" class="text-gray-900 fw-bolder ms-1">0</span> Permissions
                    </div>
                    <div class="badge badge-light-success fs-8 fw-bold px-3 py-2">
                        Guard: <span class="text-gray-900 fw-bolder ms-1">web</span>
                    </div>
                </div>

                <!-- Section: Anggota Pengguna -->
                <div class="mb-6">
                    <h6 class="fw-bolder text-gray-900 mb-3">Daftar Pengguna Pemilik Peran</h6>
                    <div class="mh-125px overflow-auto border rounded p-3 bg-white" id="role_view_users_list">
                        <span class="text-muted fs-8">Memuat pengguna...</span>
                    </div>
                </div>

                <!-- Section: CRUD Matrix Readonly -->
                <div>
                    @include('pages.usermanagement.partials.shared.crud-matrix-table', [
                        'matrixTree' => $matrixTree,
                        'prefixId' => 'role_view_matrix',
                        'readonly' => true,
                        'matrixTitle' => 'Matriks Hak Akses Peran (Read-Only)',
                        'matrixSubtitle' => 'Izin modul yang aktif ditandai dengan kotak centang'
                    ])
                </div>
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0 px-8 pb-6">
                <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Tutup</button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal View Detail Role-->
