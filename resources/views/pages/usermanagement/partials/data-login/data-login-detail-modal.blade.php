<!--begin::Modal Detail Sesi Login-->
<div class="modal fade" id="kt_modal_detail_login" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content rounded-3 border-0 shadow-lg bg-body">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40px symbol-circle bg-light-primary me-3 d-flex align-items-center justify-content-center">
                        <i class="ki-outline ki-shield-search text-primary fs-2"></i>
                    </div>
                    <div>
                        <h3 class="fw-bolder text-gray-900 m-0 fs-5">Detail Riwayat Sesi Login</h3>
                        <span class="text-muted fs-8">Informasi teknis dan perolehan reward poin sesi.</span>
                    </div>
                </div>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-2"></i>
                </div>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-5 px-6">
                <!--begin::User Profile Snapshot-->
                <div class="d-flex align-items-center p-4 bg-light rounded-3 mb-5">
                    <div id="modal_detail_avatar" class="me-3"></div>
                    <div class="d-flex flex-column">
                        <span class="fw-bold text-gray-900 fs-6" id="modal_detail_name">-</span>
                        <span class="text-muted fs-7" id="modal_detail_email">-</span>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <span id="modal_detail_role">-</span>
                            <span class="badge badge-light-success fs-8 fw-bold" id="modal_detail_user_points">0 Total Poin</span>
                            <span class="badge badge-light-info fs-8 fw-bold" id="modal_detail_login_count">0x Total Login</span>
                        </div>
                    </div>
                </div>
                <!--end::User Profile Snapshot-->

                <!--begin::Detail Info List-->
                <div class="table-responsive">
                    <table class="table table-row-dashed fs-7 gy-3">
                        <tbody>
                            <tr>
                                <td class="text-muted fw-semibold w-150px">Tipe Sesi</td>
                                <td class="text-gray-900 fw-bold" id="modal_detail_type">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Reward Poin (24 Jam)</td>
                                <td class="text-gray-900 fw-bold" id="modal_detail_point">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Alamat IP</td>
                                <td class="text-gray-900 fw-bold font-monospace" id="modal_detail_ip">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Perangkat / Device</td>
                                <td class="text-gray-900 fw-bold" id="modal_detail_device">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Browser & OS</td>
                                <td class="text-gray-900 fw-bold" id="modal_detail_browser_os">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Waktu Tercatat</td>
                                <td class="text-gray-900 fw-bold" id="modal_detail_time">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold align-top">User Agent Mentah</td>
                                <td class="text-muted font-monospace fs-8 text-break" id="modal_detail_user_agent">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--end::Detail Info List-->
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-5 btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal Detail Sesi Login-->

<!--begin::Modal Clear Logs-->
<div class="modal fade" id="kt_modal_clear_logs" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-3 border-0 shadow-lg bg-body">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-35px symbol-circle bg-light-danger me-2 d-flex align-items-center justify-content-center">
                        <i class="ki-outline ki-trash text-danger fs-3"></i>
                    </div>
                    <h3 class="fw-bolder text-gray-900 m-0 fs-6">Pembersihan Riwayat Log</h3>
                </div>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-2"></i>
                </div>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-4 px-5">
                <p class="text-muted fs-7 mb-3">Pilih rentang waktu riwayat login yang ingin dibersihkan:</p>
                <div class="mb-3">
                    <select class="form-select form-select-solid rounded-3" id="kt_clear_period_select">
                        <option value="30days">Log Lebih dari 30 Hari Lalu</option>
                        <option value="90days">Log Lebih dari 90 Hari Lalu</option>
                        <option value="all">Semua Riwayat Log (Reset Total)</option>
                    </select>
                </div>
                <div class="alert alert-light-warning d-flex align-items-center p-3 rounded-3 mb-0">
                    <i class="ki-outline ki-information-5 fs-4 text-warning me-2"></i>
                    <span class="fs-8 text-muted">Aksi ini permanen dan tidak dapat dibatalkan.</span>
                </div>
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light rounded-pill px-4 btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger rounded-pill px-4 btn-sm" id="kt_btn_confirm_clear_logs">
                    <span class="indicator-label">Eksekusi Bersihkan</span>
                    <span class="indicator-progress">
                        Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal Clear Logs-->
