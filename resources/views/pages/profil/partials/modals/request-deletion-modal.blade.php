<!--begin::Modal Permintaan Keluar Akun (Pola Breeze)-->
<div class="modal fade" id="modal_request_account_deletion" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-550px">
        <!--begin::Modal content-->
        <div class="modal-content rounded-3 shadow-lg border-0">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 d-flex flex-column align-items-center justify-content-center text-center position-relative pt-8 px-6 px-sm-8">
                <!--begin::Close button-->
                <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary position-absolute top-0 end-0 m-3 m-sm-4" data-bs-dismiss="modal" aria-label="Tutup" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Tutup Jendela">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
                <!--end::Close button-->

                <!--begin::Icon Circle 60px-->
                <div class="symbol symbol-60px symbol-circle bg-light-danger mx-auto mb-4 d-flex align-items-center justify-content-center shadow-xs">
                    <i class="ki-duotone ki-trash fs-2x text-danger"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                </div>
                <!--end::Icon Circle-->

                <!--begin::Title & Subtitle-->
                <h2 class="fw-bolder text-gray-900 mb-1 fs-3">Permintaan Keluar Akun</h2>
                <div class="text-muted fs-7">Konfirmasi permohonan penonaktifan dan penghapusan akun Anda ke Administrator</div>
                <!--end::Title & Subtitle-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-6 px-6 px-sm-8">
                <form id="form_request_account_deletion" action="{{ route('profil.profil-pengguna.request-deletion') }}" method="POST">
                    @csrf

                    <!--begin::Alert Warning Notice-->
                    <div class="alert alert-light-danger d-flex align-items-start p-4 mb-6 rounded-3 border border-danger border-dashed">
                        <i class="ki-duotone ki-information-5 fs-2hx text-danger me-3 flex-shrink-0 mt-1">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                        </i>
                        <div class="d-flex flex-column fs-7">
                            <span class="fw-bold text-danger mb-1">Perhatian Penting</span>
                            <span class="text-gray-700">
                                Setelah akun Anda disetujui untuk dihapus oleh Master/Admin, semua data profil, berkas, dan hak akses Anda akan dihapus permanen. Masukkan password Anda untuk konfirmasi keamanan.
                            </span>
                        </div>
                    </div>
                    <!--end::Alert Warning Notice-->

                    <!--begin::Field Reason-->
                    <div class="mb-5">
                        <label class="form-label fw-semibold fs-6 text-gray-800 mb-2">
                            Alasan Keluar Akun <span class="text-muted fs-8">(Opsional)</span>
                        </label>
                        <textarea name="reason" id="input_deletion_reason" class="form-control form-control-solid" rows="3" placeholder="Tuliskan alasan atau catatan mengapa Anda ingin keluar dari akun ini..."></textarea>
                    </div>
                    <!--end::Field Reason-->

                    <!--begin::Field Password Verification-->
                    <div class="mb-4">
                        <label class="required form-label fw-semibold fs-6 text-gray-800 mb-2">
                            Konfirmasi Password Saat Ini
                        </label>
                        <div class="position-relative">
                            <input type="password" name="password" id="input_deletion_password" class="form-control form-control-solid pe-12" placeholder="Masukkan password Anda" required autocomplete="current-password" />
                            <button type="button" class="btn btn-icon btn-sm btn-active-color-primary position-absolute top-50 end-0 translate-middle-y me-2" 
                                    onclick="const inp=document.getElementById('input_deletion_password'); inp.type = inp.type==='password'?'text':'password';">
                                <i class="ki-duotone ki-eye fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            </button>
                        </div>
                        <div class="text-danger fs-8 mt-1 d-none" id="error_deletion_password"></div>
                    </div>
                    <!--end::Field Password Verification-->
                </form>
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0 pb-8 px-6 px-sm-8 d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-end gap-2">
                <button type="button" class="btn btn-light w-100 w-sm-auto" data-bs-dismiss="modal" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Batalkan dan tutup dialog">
                    Batal
                </button>
                <button type="button" class="btn btn-danger w-100 w-sm-auto" id="btn_submit_account_deletion" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kirim permohonan ke Master & Admin">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-trash fs-4 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                        Kirim Permintaan Keluar
                    </span>
                    <span class="indicator-progress">
                        Mengirim Permintaan...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
            <!--end::Modal footer-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal Permintaan Keluar Akun-->
