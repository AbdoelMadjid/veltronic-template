<!--begin::Modal - Log Detail-->
<div class="modal fade" id="modal_activity_log_detail" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <!--begin::Modal content-->
        <div class="modal-content border-0 shadow-lg">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-between">
                <!--begin::Title-->
                <div class="d-flex align-items-center gap-3">
                    <div class="symbol symbol-45px symbol-circle bg-light-primary" id="modal_log_icon_wrapper">
                        <span class="symbol-label text-primary" id="modal_log_icon">
                            <i class="ki-outline ki-document fs-2"></i>
                        </span>
                    </div>
                    <div>
                        <h3 class="fw-bolder text-gray-900 m-0" id="modal_log_title">Rincian Log Aktivitas</h3>
                        <span class="text-muted fs-7" id="modal_log_subtitle">Informasi lengkap jejak audit & transaksi</span>
                    </div>
                </div>
                <!--end::Title-->

                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-6 px-lg-9">
                <!--begin::Top Badges-->
                <div class="d-flex align-items-center gap-2 mb-6 flex-wrap">
                    <span id="modal_log_level_badge"></span>
                    <span id="modal_log_module_badge"></span>
                    <span class="badge badge-light-secondary fs-8 fw-semibold" id="modal_log_menu_badge"></span>
                    <span class="text-muted fs-8 ms-auto" id="modal_log_time"></span>
                </div>
                <!--end::Top Badges-->

                <!--begin::Detail Cards-->
                <div class="d-flex flex-column gap-5">
                    <!-- User & IP Info -->
                    <div class="p-4 rounded-3 bg-light border border-gray-200">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <span class="fs-8 fw-bold text-muted text-uppercase d-block mb-1">Pelaku / Pengguna</span>
                                <div class="d-flex align-items-center" id="modal_log_user_info">
                                    <!-- Populated via JS -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span class="fs-8 fw-bold text-muted text-uppercase d-block mb-1">Alamat IP</span>
                                <span class="fs-7 fw-bold text-gray-800 d-block" id="modal_log_ip">-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Description / Payload / Error Traces -->
                    <div>
                        <span class="fs-8 fw-bold text-muted text-uppercase d-block mb-2">Deskripsi / Pesan Kejadian</span>
                        <div class="p-4 rounded-3 bg-body border border-gray-200 fs-7 text-gray-800 text-break font-monospace" style="max-height: 250px; overflow-y: auto;" id="modal_log_description">
                            -
                        </div>
                    </div>

                    <!-- User Agent -->
                    <div>
                        <span class="fs-8 fw-bold text-muted text-uppercase d-block mb-2">User Agent / Perangkat</span>
                        <div class="p-3 rounded-3 bg-light border border-gray-200 fs-8 text-muted text-break" id="modal_log_user_agent">
                            -
                        </div>
                    </div>
                </div>
                <!--end::Detail Cards-->
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light-primary fw-bold" data-bs-dismiss="modal">Tutup</button>
            </div>
            <!--end::Modal footer-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Log Detail-->
