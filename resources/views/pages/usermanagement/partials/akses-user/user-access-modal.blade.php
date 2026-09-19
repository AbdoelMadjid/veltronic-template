<!--begin::Modal - Assign Role-->
<div class="modal fade" id="kt_modal_assign_role" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <form id="kt_form_assign_role" class="modal-content border-0 shadow">
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
                            <i class="ki-outline ki-profile-user fs-2x text-primary"></i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3">
                        Ubah Peran Pengguna
                    </h3>

                    <!-- Row 3: Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0">
                        Pilih peran sistem yang akan ditetapkan ke akun pengguna terpilih.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--end::Modal header-->

            <input type="hidden" name="user_id" id="assign_role_user_id" value="">
            <div class="modal-body py-6 px-8">
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-6 p-5">
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-semibold">
                            <h5 class="text-gray-900 fw-bolder m-0" id="assign_role_user_name_display">Nama Pengguna</h5>
                            <div class="fs-7 text-gray-700">Pilih peran sistem yang akan ditetapkan ke akun pengguna ini.</div>
                        </div>
                    </div>
                </div>

                <div class="fv-row mb-4">
                    <label class="required fs-6 fw-bold form-label mb-3 text-gray-800">Pilih Peran Sistem</label>
                    <div class="row g-4">
                        @foreach($roles as $role)
                            <div class="col-md-6">
                                <div class="border border-dashed rounded p-4 d-flex align-items-center justify-content-between">
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-900 fw-bold fs-6">{{ $role->display_name ?? ucwords(str_replace(['_', '-'], ' ', $role->name)) }}</span>
                                        <span class="text-muted fs-8 font-monospace">{{ $role->name }}</span>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input role-checkbox-item" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_check_{{ $role->id }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 pt-0 px-6 px-lg-8 pb-6 justify-content-center justify-content-sm-end gap-2">
                <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal">
                    <i class="ki-outline ki-cross fs-4 me-1"></i>
                    <span>Batal</span>
                </button>
                <button type="submit" id="kt_modal_assign_role_submit" class="btn btn-primary fw-bold"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan Peran">
                    <span class="indicator-label">
                        <i class="ki-outline ki-disk fs-5 me-1"></i>
                        <span>Simpan Peran</span>
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                        <span>Memproses...</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
<!--end::Modal - Assign Role-->

<!--begin::Modal - Direct Permissions Override-->
<div class="modal fade" id="kt_modal_direct_permissions" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <form id="kt_form_direct_permissions" class="modal-content border-0 shadow">
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
                            <i class="ki-outline ki-shield-search fs-2x text-primary"></i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3">
                        Izin Khusus (Direct Permissions Override)
                    </h3>

                    <!-- Row 3: Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0">
                        Tetapkan izin akses spesifik perorangan di luar hak akses peran.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-6 px-8">
                <input type="hidden" name="user_id" id="direct_perm_user_id" value="">
                
                <!-- User Info Banner & Legend -->
                <div class="card card-flush bg-light-subtle border border-gray-200 border-opacity-50 rounded-3 mb-6">
                    <div class="card-body p-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start">
                        <!-- Baris 1-3 di Mobile (Logo, Nama, Peran) / Sisi Kiri di Desktop -->
                        <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-3">
                            <!-- Baris 1: Logo -->
                            <div class="symbol symbol-45px symbol-circle bg-light-primary text-primary mb-1 mb-md-0 me-0 me-md-2 d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="ki-outline ki-security-user text-primary fs-2"></i>
                            </div>
                            <!-- Baris 2 & 3: Nama & Peran Aktif -->
                            <div class="d-flex flex-column align-items-center align-items-md-start">
                                <h6 class="text-gray-900 fw-bold m-0 fs-6" id="direct_perm_user_name_display">Nama Pengguna</h6>
                                <div class="text-muted fs-8 mt-1">Peran Aktif: <span id="direct_perm_user_roles_display" class="badge badge-light-primary fw-bold fs-9 py-0 px-2"></span></div>
                            </div>
                        </div>

                        <!-- Baris 4 di Mobile (2 Badge) / Sisi Kanan di Desktop -->
                        <div class="d-flex align-items-center justify-content-center justify-content-md-end flex-wrap gap-2 mt-2 mt-md-0">
                            <span class="badge badge-light-primary fw-semibold fs-8 px-3 py-2 d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Izin aktif otomatis yang diperoleh dari peran pengguna">
                                <i class="ki-outline ki-shield-tick text-primary fs-6 me-1"></i> Izin Peran (Inherited)
                            </span>
                            <span class="badge badge-light-warning fw-semibold fs-8 px-3 py-2 d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Izin khusus perorangan yang dicentang langsung">
                                <i class="ki-outline ki-key text-warning fs-6 me-1"></i> Izin Khusus (Direct)
                            </span>
                        </div>
                    </div>
                </div>

                <!-- CRUD Matrix Component -->
                <div class="fv-row">
                    @include('pages.usermanagement.partials.shared.crud-matrix-table', [
                        'matrixTree' => $matrixTree,
                        'prefixId' => 'user_direct_matrix',
                        'inputName' => 'permissions[]',
                        'matrixTitle' => 'Matriks Hak Akses Khusus Pengguna',
                        'matrixSubtitle' => 'Pilih kotak centang untuk memberikan izin langsung khusus kepada pengguna ini',
                        'scrollable' => false,
                    ])
                </div>
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0 px-6 px-lg-8 pb-6 justify-content-center justify-content-sm-end gap-2">
                <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal">
                    <i class="ki-outline ki-cross fs-4 me-1"></i>
                    <span>Batal</span>
                </button>
                <button type="submit" id="kt_modal_direct_permissions_submit" class="btn btn-warning fw-bold"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan Izin Khusus">
                    <span class="indicator-label">
                        <i class="ki-outline ki-disk fs-5 me-1"></i>
                        <span>Simpan Izin Khusus</span>
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                        <span>Menyimpan...</span>
                    </span>
                </button>
            </div>
            <!--end::Modal footer-->
        </form>
    </div>
</div>
<!--end::Modal - Direct Permissions Override-->
