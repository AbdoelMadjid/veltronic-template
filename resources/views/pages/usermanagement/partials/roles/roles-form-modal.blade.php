<!--begin::Modal Form Tambah / Ubah Role-->
<div class="modal fade" id="kt_modal_role_form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow">
            <form id="kt_form_role" action="{{ route('usermanagement.roles.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="role_form_method" value="POST" />
                <input type="hidden" name="role_id" id="role_form_id" value="" />

                <!--begin::Modal header-->
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h3 class="fw-bolder text-gray-900 m-0" id="role_modal_title">Tambah Peran Baru</h3>
                        <span class="text-muted fs-8">Tentukan nama peran dan pilih izin akses modul yang diberikan.</span>
                    </div>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-outline ki-cross fs-2"></i>
                    </div>
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body py-6 px-8">
                    <!-- 1. Input Nama Role -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-bold form-label mb-2 required text-gray-800">
                            Nama Role
                        </label>
                        <input type="text" class="form-control form-control-solid" placeholder="Contoh: master, admin, operator, staf_keuangan" name="name" id="role_input_name" required />
                        <div class="form-text text-muted fs-8">Gunakan format slug/nama peran standar sistem.</div>
                    </div>

                    <!-- 2. CRUD Matrix Permissions Table -->
                    <div class="fv-row mb-4">
                        @include('pages.usermanagement.partials.shared.crud-matrix-table', [
                            'matrixTree' => $matrixTree,
                            'prefixId' => 'role_form_matrix',
                            'inputName' => 'permissions[]',
                            'matrixTitle' => 'Hak Akses / Permissions (CRUD Matrix)',
                            'matrixSubtitle' => 'Pilih izin fitur yang berlaku untuk role ini'
                        ])
                    </div>
                </div>
                <!--end::Modal body-->

                <!--begin::Modal footer-->
                <div class="modal-footer border-0 pt-0 px-8 pb-6">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold" id="kt_btn_save_role">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-5 me-1"></i>
                            Simpan Peran
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>
                <!--end::Modal footer-->
            </form>
        </div>
    </div>
</div>
<!--end::Modal Form Tambah / Ubah Role-->
