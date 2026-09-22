<!--begin::Modal - Pratinjau Foto Chat-->
<div class="modal fade" id="kt_modal_chat_image_preview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
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
                        <div class="d-inline-flex align-items-center justify-content-center bg-light-primary text-primary rounded-circle" 
                             style="width: 60px; height: 60px; min-width: 60px; min-height: 60px;">
                            <i class="ki-duotone ki-picture fs-2x text-primary"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3">Pratinjau Foto Lampiran</h3>

                    <!-- Row 3: Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0">
                        Lihat foto dalam ukuran penuh dan unduh berkas ke penyimpanan perangkat Anda.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-5 px-6 px-lg-8">
                <!--begin::Image Container-->
                <div class="text-center bg-light bg-opacity-75 rounded-3 p-3 mb-4 border border-gray-200 overflow-hidden d-flex align-items-center justify-content-center min-h-200px">
                    <img id="chat_modal_preview_image" src="" alt="Foto Lampiran" class="mw-100 mh-450px object-fit-contain rounded-2 shadow-xs" />
                </div>
                <!--end::Image Container-->

                <!--begin::File Info Box-->
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between p-3 bg-light rounded-3 border border-gray-200 gap-2">
                    <div class="d-flex align-items-center gap-3 overflow-hidden">
                        <div class="symbol symbol-35px symbol-circle bg-light-primary flex-shrink-0">
                            <i class="ki-duotone ki-picture fs-3 text-primary"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <div class="text-start overflow-hidden">
                            <div class="fw-bold text-gray-900 fs-7 text-truncate" id="chat_modal_preview_filename">foto.jpg</div>
                            <div class="text-muted fs-8" id="chat_modal_preview_meta">Lampiran Pesan</div>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="badge badge-light-primary fw-semibold fs-8 px-3 py-2 rounded-pill" id="chat_modal_preview_badge">
                            <i class="ki-duotone ki-time fs-8 text-primary me-1"><span class="path1"></span><span class="path2"></span></i>
                            <span id="chat_modal_preview_time">Waktu</span>
                        </span>
                    </div>
                </div>
                <!--end::File Info Box-->
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0 pb-6 px-6 px-lg-8 d-flex justify-content-center justify-content-sm-end gap-2">
                <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tutup Pratinjau">
                    <i class="ki-duotone ki-cross fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                    Tutup
                </button>
                <a href="#" id="chat_modal_btn_download" download class="btn btn-primary fw-bold"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Unduh Foto ke Perangkat">
                    <i class="ki-duotone ki-down-square fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                    Unduh Foto
                </a>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal - Pratinjau Foto Chat-->
