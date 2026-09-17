<!--begin::Modal Form Permission-->
<div class="modal fade" id="kt_modal_permission_form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow">
            <form id="kt_form_permission" action="{{ route('usermanagement.permissions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="perm_form_method" value="POST" />
                <input type="hidden" name="perm_id" id="perm_form_id" value="" />

                <!--begin::Modal header-->
                <div class="modal-header border-0 pb-0 justify-content-between">
                    <div>
                        <h3 class="fw-bolder text-gray-900 m-0" id="perm_modal_title">Tambah Izin Akses</h3>
                        <span class="text-muted fs-8">Buat izin akses baru untuk mengontrol wewenang fitur.</span>
                    </div>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-outline ki-cross fs-2"></i>
                    </div>
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body py-6 px-8">
                    <!-- Input Nama Permission -->
                    <div class="fv-row mb-6">
                        <label class="fs-6 fw-bold form-label mb-2 required text-gray-800">
                            Nama Izin (Permission Name)
                        </label>
                        <input type="text" class="form-control form-control-solid font-monospace" placeholder="Contoh: masterdata.produk.create" name="name" id="perm_input_name" required />
                        <div class="form-text text-muted fs-8">Gunakan format pemisah titik (misal: <code>modul.fitur.aksi</code>).</div>
                    </div>

                    <!-- Input Guard -->
                    <div class="fv-row mb-2">
                        <label class="fs-6 fw-bold form-label mb-2 text-gray-800">
                            Guard Name
                        </label>
                        <input type="text" class="form-control form-control-solid" name="guard_name" value="web" readonly />
                    </div>
                </div>
                <!--end::Modal body-->

                <!--begin::Modal footer-->
                <div class="modal-footer border-0 pt-0 px-8 pb-6">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold" id="kt_btn_save_permission">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-5 me-1"></i>
                            Simpan Izin
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
<!--end::Modal Form Permission-->
