<!--begin::Modal - Section Form-->
<div class="modal fade" id="kt_modal_section_form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content border-0 shadow">
            <form class="form" id="kt_form_section_modal">
                @csrf
                <input type="hidden" name="section_id" id="input_section_id" value="" />
                <input type="hidden" name="is_custom" id="input_section_is_custom" value="0" />

                <div class="modal-header border-0 pb-0 position-relative p-4 p-sm-6">
                    <div class="d-flex flex-column flex-sm-row align-items-center text-center text-sm-start w-100 pe-0 pe-sm-8">
                        <div class="symbol symbol-45px symbol-sm-40px symbol-circle bg-light-primary mb-2 mb-sm-0 me-0 me-sm-4 d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ki-outline ki-abstract-26 text-primary fs-2 fs-sm-3"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h2 class="fw-bold text-gray-900 m-0 fs-4" id="modal_section_title">Konfigurasi Bagian Konten (Section)</h2>
                            <span class="text-muted fs-8 mt-1">Pengaturan judul, anchor, dan konten section</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary position-absolute top-0 end-0 m-3 m-sm-4" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-outline ki-cross fs-1 fs-sm-2"></i>
                    </button>
                </div>

                <div class="modal-body py-4 py-md-6 px-4 px-md-8">
                    <!--begin::Row Anchor & Name-->
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label class="required fs-7 fw-bold mb-2">Nama Bagian (Label Identifikasi)</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" placeholder="Contoh: FAQ / Tanya Jawab" name="name" id="input_section_name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-7 fw-bold mb-2">Slug Anchor ID</label>
                            <div class="input-group input-group-sm input-group-solid">
                                <span class="input-group-text">#</span>
                                <input type="text" class="form-control font-monospace" placeholder="faq atau timeline" name="anchor" id="input_section_anchor" required />
                            </div>
                            <div class="text-muted fs-8 mt-1">ID anchor HTML unik untuk navigasi menu.</div>
                        </div>
                    </div>
                    <!--end::Row Anchor & Name-->

                    <!--begin::Row Title & Badge-->
                    <div class="row mb-5">
                        <div class="col-md-8 mb-4 mb-md-0">
                            <label class="required fs-7 fw-bold mb-2">Judul Heading Utama Section</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" placeholder="Judul besar section..." name="title" id="input_section_title" required />
                        </div>
                        <div class="col-md-4">
                            <label class="fs-7 fw-bold mb-2">Badge Kategori</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" placeholder="Highlights / Custom" name="badge" id="input_section_badge" />
                        </div>
                    </div>
                    <!--end::Row Title & Badge-->

                    <!--begin::Input Subtitle-->
                    <div class="mb-5">
                        <label class="fs-7 fw-bold mb-2">Keterangan / Subtitle</label>
                        <textarea class="form-control form-control-solid form-control-sm" rows="2" placeholder="Deskripsi ringkas yang muncul di bawah judul..." name="subtitle" id="input_section_subtitle"></textarea>
                    </div>
                    <!--end::Input Subtitle-->

                    <!--begin::Row Icon & Order-->
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label class="fs-7 fw-bold mb-2">Ikon Section (KeenIcons)</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" placeholder="ki-element-11" name="icon" id="input_section_icon" />
                        </div>
                        <div class="col-md-6">
                            <label class="fs-7 fw-bold mb-2">Urutan Tampilan</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" name="order" id="input_section_order" min="1" value="1" />
                        </div>
                    </div>
                    <!--end::Row Icon & Order-->

                    <!--begin::Custom HTML Content Wrapper-->
                    <div class="mb-5" id="wrapper_custom_html_content">
                        <label class="fs-7 fw-bold mb-2">Konten HTML Kustom (Opsional untuk Section Kustom)</label>
                        <textarea class="form-control form-control-solid form-control-sm font-monospace fs-8" rows="6" placeholder="<div>Isi konten HTML kustom...</div>" name="content_html" id="input_section_content_html"></textarea>
                        <div class="text-muted fs-8 mt-1">Gunakan kode HTML Bootstrap 5 untuk membuat blok konten tambahan khusus.</div>
                    </div>
                    <!--end::Custom HTML Content Wrapper-->

                    <!--begin::Active Toggle-->
                    <div class="p-4 bg-light-subtle rounded-3 border border-gray-200 d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column pe-2">
                            <span class="fw-bold text-gray-800 fs-7">Status Tampilan Section</span>
                            <span class="text-muted fs-8">Jika nonaktif, section ini tidak akan dirender di landing page</span>
                        </div>
                        <div class="form-check form-switch form-check-custom form-check-solid flex-shrink-0">
                            <input class="form-check-input h-20px w-35px" type="checkbox" name="is_active" id="input_section_active" value="1" checked />
                        </div>
                    </div>
                    <!--end::Active Toggle-->
                </div>

                <div class="modal-footer border-0 pt-0 px-4 px-md-8 pb-6 justify-content-center justify-content-sm-end gap-2">
                    <button type="reset" class="btn btn-light btn-sm fw-bold px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm fw-bold px-6" id="kt_btn_submit_section">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-4 me-1"></i> Simpan Section
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
<!--end::Modal - Section Form-->
