<!--begin::Modal Form Permission-->
<div class="modal fade" id="kt_modal_permission_form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow">
            <form id="kt_form_permission" action="{{ route('usermanagement.permissions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="perm_form_method" value="POST" />
                <input type="hidden" name="perm_id" id="perm_form_id" value="" />

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
                                <i class="ki-outline ki-key fs-2x text-primary"></i>
                            </div>
                        </div>

                        <!-- Row 2: Title -->
                        <h3 class="fw-bolder text-gray-900 m-0 fs-3" id="perm_modal_title">
                            Tambah Izin Akses
                        </h3>

                        <!-- Row 3: Description -->
                        <div class="text-muted fw-semibold fs-7 mt-2 mb-0">
                            Buat izin akses baru untuk mengontrol wewenang fitur.
                        </div>
                    </div>
                    <!--end::Header Info-->
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body py-6 px-6 px-lg-8">
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
                <div class="modal-footer border-0 pt-0 px-6 px-lg-8 pb-6 justify-content-center justify-content-sm-end gap-2">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal">
                        <i class="ki-outline ki-cross fs-4 me-1"></i>
                        <span>Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary fw-bold" id="kt_btn_save_permission"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan Izin">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-5 me-1"></i>
                            <span>Simpan Izin</span>
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
</div>
<!--end::Modal Form Permission-->
