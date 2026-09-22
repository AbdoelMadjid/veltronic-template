<!--begin::Modal - Teruskan Pesan Chat-->
<div class="modal fade" id="kt_modal_chat_forward" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 position-relative pt-7 pt-sm-6 px-6 px-lg-8">
                <!--begin::Close Button-->
                <div class="position-absolute top-0 end-0 m-3 m-sm-4 z-index-2">
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tutup">
                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <!--end::Close Button-->

                <!--begin::Header Info (3-Baris Center pada Mobile)-->
                <div class="w-100 text-center text-sm-start pe-0 pe-sm-10">
                    <!-- Row 1: Icon Logo Lingkaran Sempurna (Mobile Only) -->
                    <div class="d-flex justify-content-center d-sm-none mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light-info text-info rounded-circle" 
                             style="width: 60px; height: 60px; min-width: 60px; min-height: 60px;">
                            <i class="ki-duotone ki-share fs-2x text-info"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3">Teruskan Pesan</h3>

                    <!-- Row 3: Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0">
                        Pilih satu atau beberapa kontak untuk meneruskan pesan ini.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-5 px-6 px-lg-8">
                <input type="hidden" id="chat_forward_source_message_id" value="" />

                <!--begin::Message Preview Box-->
                <div class="p-3 bg-light rounded-3 border border-gray-200 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="ki-duotone ki-share fs-4 text-info"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                        <span class="fs-8 fw-bold text-gray-700">Pesan yang Diteruskan:</span>
                    </div>
                    <div class="fs-7 text-gray-800 fst-italic text-truncate-2" id="chat_forward_preview_text">...</div>
                </div>
                <!--end::Message Preview Box-->

                <!--begin::Search Contact-->
                <div class="position-relative mb-4">
                    <i class="ki-duotone ki-magnifier fs-4 text-gray-500 position-absolute top-50 ms-4 translate-middle-y">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                    <input type="text" class="form-control form-control-solid ps-12" id="chat_forward_search_input" placeholder="Cari kontak tujuan..." />
                </div>
                <!--end::Search Contact-->

                <!--begin::Contacts List-->
                <div class="text-muted fs-8 fw-semibold mb-2">Pilih Kontak Tujuan:</div>
                <div class="rounded-3 border border-gray-200 p-2 overflow-auto" id="chat_forward_contacts_list" style="max-height: 280px;">
                    <!-- Dynamically rendered contacts with checkboxes -->
                    <div class="d-flex align-items-center justify-content-center py-6">
                        <div class="spinner-border spinner-border-sm text-primary me-2"></div>
                        <span class="text-muted fs-8">Memuat daftar kontak...</span>
                    </div>
                </div>
                <!--end::Contacts List-->
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0 pb-6 px-6 px-lg-8 d-flex justify-content-center justify-content-sm-end gap-2">
                <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal Meneruskan">
                    Batal
                </button>
                <button type="button" class="btn btn-primary fw-bold" id="chat_btn_execute_forward"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Kirim Pesan ke Kontak Terpilih">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-send fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                        Teruskan (<span id="chat_forward_selected_count">0</span>)
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle"></span>
                    </span>
                </button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal - Teruskan Pesan Chat-->
