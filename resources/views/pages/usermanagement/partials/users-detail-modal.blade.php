<!--begin::Modal - Detail Pengguna-->
<div class="modal fade" id="kt_modal_user_detail" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded overflow-hidden border-0 shadow">
            <!--begin::Cover Header-->
            <div class="position-relative overflow-hidden rounded-top p-6 p-lg-8 min-h-180px d-flex flex-column justify-content-between" id="detail_user_cover_wrapper">
                <!-- Cover Background Image from Database -->
                <div id="detail_user_cover_bg" class="w-100 h-100 position-absolute top-0 start-0" style="
                    background-image: url('{{ asset('assets/img-temp/1200x800/img1.jpg') }}');
                    background-size: cover;
                    background-position: center 30%;
                    background-repeat: no-repeat;
                    transition: background-image 0.3s ease, background-position 0.2s ease, filter 0.2s ease;
                "></div>

                <!-- Adjustable Overlay Layer from Database -->
                <div id="detail_user_cover_overlay" class="w-100 h-100 position-absolute top-0 start-0" style="
                    background-color: #000000;
                    opacity: 0.6;
                    transition: opacity 0.2s ease, background-color 0.2s ease;
                "></div>

                <!--begin::Close Button-->
                <div class="position-absolute top-0 end-0 m-4 z-index-3">
                    <button type="button" class="btn btn-sm btn-icon btn-color-white bg-black bg-opacity-25 bg-hover-opacity-50 text-hover-white shadow-xs" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <!--end::Close Button-->

                <!--begin::Header Elements on Top of Cover-->
                <div class="position-relative z-index-2 d-flex flex-column align-items-center text-center mt-2 mb-2">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-85px mb-3">
                        <div id="detail_user_avatar_img" class="symbol-label shadow-sm border border-4 border-white rounded-3 d-none"
                            style="background-position: top center; background-size: cover;">
                        </div>
                        <div id="detail_user_symbol" class="symbol-label fs-1 fw-bold bg-light-primary text-primary shadow-sm border border-4 border-white rounded-3">
                            U
                        </div>
                    </div>
                    <!--end::Avatar-->

                    <!--begin::Name-->
                    <h2 class="fw-bolder text-white mb-1 drop-shadow-sm" id="detail_user_name">-</h2>
                    <!--end::Name-->

                    <!--begin::Email-->
                    <div class="text-white text-opacity-75 fw-semibold fs-6 mb-3" id="detail_user_email">-</div>
                    <!--end::Email-->

                    <!--begin::Badges-->
                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                        <div id="detail_user_roles" class="d-flex flex-wrap justify-content-center gap-1">
                            <span class="badge bg-white bg-opacity-90 text-gray-800 fw-bold fs-7 px-3 py-1 text-uppercase shadow-xs">USER</span>
                        </div>
                        <span id="detail_user_verified" class="badge bg-success text-white fw-bold fs-7 px-3 py-1 shadow-xs">Terverifikasi</span>
                    </div>
                    <!--end::Badges-->
                </div>
                <!--end::Header Elements on Top of Cover-->
            </div>
            <!--end::Cover Header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-8 px-lg-12 pt-6 pb-10">
                <!--begin::Heading Description-->
                <div class="text-center mb-6">
                    <span class="badge badge-light-primary fw-semibold px-4 py-2 fs-7">Rincian Informasi Akun</span>
                </div>
                <!--end::Heading Description-->

                <!--begin::Detail List-->
                <div class="border border-gray-200 rounded p-6 bg-light bg-opacity-50">
                    <div class="row g-4 fs-7">
                        <div class="col-sm-4 text-muted fw-semibold">ID Pengguna:</div>
                        <div class="col-sm-8 fw-bold text-gray-800" id="detail_user_id">-</div>

                        <div class="col-sm-4 text-muted fw-semibold">Nomor Telepon:</div>
                        <div class="col-sm-8 fw-bold text-gray-800" id="detail_user_phone">-</div>

                        <div class="col-sm-4 text-muted fw-semibold">NIK KTP:</div>
                        <div class="col-sm-8 fw-bold text-gray-800" id="detail_user_nik">-</div>

                        <div class="col-sm-4 text-muted fw-semibold">Alamat Domisili:</div>
                        <div class="col-sm-8 fw-bold text-gray-800" id="detail_user_address">-</div>

                        <div class="col-sm-4 text-muted fw-semibold">Tanggal Registrasi:</div>
                        <div class="col-sm-8 fw-bold text-gray-800" id="detail_user_created_at">-</div>

                        <div class="col-sm-4 text-muted fw-semibold">Terakhir Diperbarui:</div>
                        <div class="col-sm-8 fw-bold text-gray-800" id="detail_user_updated_at">-</div>
                    </div>
                </div>
                <!--end::Detail List-->

                <!--begin::Actions-->
                <div class="text-center pt-8">
                    <button type="button" class="btn btn-light-primary fw-bold px-8" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Detail Pengguna-->
