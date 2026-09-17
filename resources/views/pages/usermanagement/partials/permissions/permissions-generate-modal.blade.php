<!--begin::Modal Generate Permissions Modul-->
<div class="modal fade" id="kt_modal_permission_generate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form id="kt_form_generate_permissions" action="{{ route('usermanagement.permissions.generate') }}" method="POST">
                @csrf

                <!--begin::Modal header-->
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h3 class="fw-bolder text-gray-900 m-0">Generate Otomatis Izin CRUD Modul</h3>
                        <span class="text-muted fs-8">Buat paket izin akses lengkap untuk satu modul baru secara instan.</span>
                    </div>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body py-6 px-8">
                    <!-- Prefix Modul -->
                    <div class="fv-row mb-6">
                        <label class="fs-6 fw-bold form-label mb-2 required text-gray-800">
                            Prefix / Nama Modul
                        </label>
                        <input type="text" class="form-control form-control-solid font-monospace" placeholder="Contoh: masterdata.kategori atau transaksi.penjualan" name="module_prefix" id="gen_input_prefix" required />
                        <div class="form-text text-muted fs-8">Nama dasar modul yang akan digabungkan dengan masing-masing aksi.</div>
                    </div>

                    <!-- Checklist Aksi -->
                    <div class="fv-row mb-6">
                        <label class="fs-6 fw-bolder text-gray-900 mb-3 d-block">
                            Pilih Aksi yang Digenerate:
                        </label>

                        <div class="d-flex flex-wrap gap-4 p-4 bg-light rounded">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="actions[]" value="read" id="gen_act_read" checked />
                                <label class="form-check-label text-gray-800 fw-bold fs-7 cursor-pointer" for="gen_act_read">
                                    READ (Lihat Data)
                                </label>
                            </div>

                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="actions[]" value="create" id="gen_act_create" checked />
                                <label class="form-check-label text-gray-800 fw-bold fs-7 cursor-pointer" for="gen_act_create">
                                    CREATE (Tambah Data)
                                </label>
                            </div>

                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="actions[]" value="update" id="gen_act_update" checked />
                                <label class="form-check-label text-gray-800 fw-bold fs-7 cursor-pointer" for="gen_act_update">
                                    UPDATE (Ubah Data)
                                </label>
                            </div>

                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="actions[]" value="delete" id="gen_act_delete" checked />
                                <label class="form-check-label text-gray-800 fw-bold fs-7 cursor-pointer" for="gen_act_delete">
                                    DELETE (Hapus Data)
                                </label>
                            </div>

                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="actions[]" value="sort" id="gen_act_sort" />
                                <label class="form-check-label text-gray-800 fw-bold fs-7 cursor-pointer" for="gen_act_sort">
                                    SORT (Urutan Data)
                                </label>
                            </div>

                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="actions[]" value="export" id="gen_act_export" />
                                <label class="form-check-label text-gray-800 fw-bold fs-7 cursor-pointer" for="gen_act_export">
                                    EXPORT (Unduh Excel/PDF)
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Assign to Master Role Switch -->
                    <div class="fv-row mb-2">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input h-20px w-35px" type="checkbox" name="assign_to_master" value="1" id="gen_switch_master" checked />
                            <label class="form-check-label text-gray-800 fw-bold fs-7 cursor-pointer" for="gen_switch_master">
                                Otomatis berikan izin baru ini ke peran <strong>Master</strong>
                            </label>
                        </div>
                    </div>
                </div>
                <!--end::Modal body-->

                <!--begin::Modal footer-->
                <div class="modal-footer border-0 pt-0 px-8 pb-6">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold" id="kt_btn_submit_generate_perm">
                        <span class="indicator-label">
                            <i class="ki-duotone ki-element-plus fs-5 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            Generate Izin Sekarang
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                            Memproses...
                        </span>
                    </button>
                </div>
                <!--end::Modal footer-->
            </form>
        </div>
    </div>
</div>
<!--end::Modal Generate Permissions Modul-->
