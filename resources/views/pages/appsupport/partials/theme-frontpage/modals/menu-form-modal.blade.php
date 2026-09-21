<!--begin::Modal - Menu Form-->
<div class="modal fade" id="kt_modal_menu_form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content border-0 shadow">
            <form class="form" id="kt_form_menu_modal">
                @csrf
                <input type="hidden" name="menu_id" id="input_menu_id" value="" />

                <div class="modal-header border-0 pb-0 position-relative pt-7 pt-sm-6 px-6 px-lg-8">
                    <div class="position-absolute top-0 end-0 m-3 m-sm-4 z-index-2">
                        <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tutup">
                            <i class="ki-outline ki-cross fs-2"></i>
                        </button>
                    </div>
                    <div class="w-100 text-center text-sm-start pe-0 pe-sm-10">
                        <div class="d-flex justify-content-center d-sm-none mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center bg-light-primary text-primary rounded-circle" style="width: 60px; height: 60px; min-width: 60px; min-height: 60px;">
                                <i class="ki-outline ki-row-horizontal fs-2x text-primary"></i>
                            </div>
                        </div>
                        <h3 class="fw-bolder text-gray-900 m-0 fs-3" id="modal_menu_title">Tambah Menu Navigasi Header</h3>
                        <div class="text-muted fw-semibold fs-7 mt-1 mb-0">Konfigurasi label dan target anchor menu</div>
                    </div>
                </div>

                <div class="modal-body py-4 py-md-6 px-4 px-md-8">
                    <!--begin::Input Label ID-->
                    <div class="mb-5">
                        <label class="required fs-7 fw-bold mb-2">Label Menu (Bahasa Indonesia)</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" placeholder="Contoh: Cara Kerja" name="title" id="input_menu_title" required />
                    </div>
                    <!--end::Input Label ID-->

                    <!--begin::Input Label EN-->
                    <div class="mb-5">
                        <label class="fs-7 fw-bold mb-2">Label Menu (English)</label>
                        <input type="text" class="form-control form-control-solid form-control-sm" placeholder="Contoh: How It Works" name="title_en" id="input_menu_title_en" />
                    </div>
                    <!--end::Input Label EN-->

                    <!--begin::Input Target Anchor-->
                    <div class="mb-5">
                        <label class="required fs-7 fw-bold mb-2">Target Anchor / URL</label>
                        <div class="input-group input-group-sm input-group-solid">
                            <input type="text" class="form-control" placeholder="#how-it-works atau https://..." name="target" id="input_menu_target" required />
                            <button class="btn btn-light-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Anchor
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end fs-7">
                                <li><a class="dropdown-item select-anchor-opt" href="#" data-anchor="#kt_body">#kt_body (Paling Atas)</a></li>
                                @foreach($sections as $s)
                                    <li><a class="dropdown-item select-anchor-opt" href="#" data-anchor="#{{ $s['anchor'] ?? '' }}">#{{ $s['anchor'] ?? '' }} ({{ $s['name'] ?? '' }})</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="text-muted fs-8 mt-1">Awali dengan <code>#</code> untuk melompat ke section pada halaman yang sama.</div>
                    </div>
                    <!--end::Input Target Anchor-->

                    <!--begin::Row Order & External-->
                    <div class="row mb-5">
                        <div class="col-sm-6 mb-4 mb-sm-0">
                            <label class="fs-7 fw-bold mb-2">Urutan Tampilan</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="order" id="input_menu_order" min="1" value="1" />
                        </div>
                        <div class="col-sm-6 d-flex align-items-center pt-sm-6">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-35px" type="checkbox" name="is_external" id="input_menu_external" value="1" />
                                <label class="form-check-label fs-7 fw-bold text-gray-800 ms-2" for="input_menu_external">
                                    Buka Tab Baru (_blank)
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--end::Row Order & External-->

                    <!--begin::Active Toggle-->
                    <div class="p-4 bg-light-subtle rounded-3 border border-gray-200 d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column pe-2">
                            <span class="fw-bold text-gray-800 fs-7">Status Menu Navigasi</span>
                            <span class="text-muted fs-8">Aktifkan agar menu tampil di header landing page</span>
                        </div>
                        <div class="form-check form-switch form-check-custom form-check-solid flex-shrink-0">
                            <input class="form-check-input h-20px w-35px" type="checkbox" name="is_active" id="input_menu_active" value="1" checked />
                        </div>
                    </div>
                    <!--end::Active Toggle-->
                </div>

                <div class="modal-footer border-0 pt-0 px-6 px-lg-8 pb-6 justify-content-center justify-content-sm-end gap-2">
                    <button type="reset" class="btn btn-light btn-sm fw-bold px-4" data-bs-dismiss="modal" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batalkan perubahan">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm fw-bold px-6" id="kt_btn_submit_menu" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan konfigurasi menu">
                        <span class="indicator-label d-inline-flex align-items-center">
                            <i class="ki-outline ki-check fs-4 me-1"></i> Simpan Menu
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span> Menyimpan...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Menu Form-->
