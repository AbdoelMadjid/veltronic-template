<!--begin::Modal - Assign Role-->
<div class="modal fade" id="kt_modal_assign_role" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h3 class="fw-bolder text-gray-900 m-0">Ubah Peran Pengguna</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-2"></i>
                </div>
            </div>
            <form id="kt_form_assign_role" class="form">
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

                <div class="modal-footer border-0 pt-0 px-8 pb-6">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="kt_modal_assign_role_submit" class="btn btn-primary fw-bold">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-5 me-1"></i>Simpan Peran
                        </span>
                        <span class="indicator-progress">Memproses...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Assign Role-->

<!--begin::Modal - Direct Permissions Override-->
<div class="modal fade" id="kt_modal_direct_permissions" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h3 class="fw-bolder text-gray-900 m-0">Izin Khusus (Direct Permissions Override)</h3>
                    <span class="text-muted fs-8">Tetapkan izin akses spesifik perorangan di luar hak akses peran.</span>
                </div>
                <div class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-2"></i>
                </div>
            </div>
            <form id="kt_form_direct_permissions" class="form">
                <input type="hidden" name="user_id" id="direct_perm_user_id" value="">
                <div class="modal-body py-6 px-8">
                    <!-- User Info Banner -->
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-6 p-4 align-items-center justify-content-between">
                        <div>
                            <span class="text-gray-900 fw-bolder fs-6" id="direct_perm_user_name_display">Nama Pengguna</span>
                            <div class="text-muted fs-8">Peran Saat Ini: <span id="direct_perm_user_roles_display" class="fw-bold text-primary"></span></div>
                        </div>
                        <div class="text-end">
                            <span class="badge badge-light-warning fs-8">Direct Permissions Mode</span>
                        </div>
                    </div>

                    <!-- CRUD Matrix Component -->
                    <div class="fv-row">
                        @include('pages.usermanagement.partials.shared.crud-matrix-table', [
                            'matrixTree' => $matrixTree,
                            'prefixId' => 'user_direct_matrix',
                            'inputName' => 'permissions[]',
                            'matrixTitle' => 'Matriks Hak Akses Khusus Pengguna',
                            'matrixSubtitle' => 'Pilih kotak centang untuk memberikan izin langsung khusus kepada pengguna ini'
                        ])
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0 px-8 pb-6">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="kt_modal_direct_permissions_submit" class="btn btn-warning fw-bold">
                        <span class="indicator-label">
                            <i class="ki-outline ki-shield-search fs-5 me-1"></i>Simpan Izin Khusus
                        </span>
                        <span class="indicator-progress">Menyimpan...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Direct Permissions Override-->
