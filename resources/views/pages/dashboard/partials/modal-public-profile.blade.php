<!--begin::Modal - Profil Pengguna Publik (Sosmed Style)-->
<div class="modal fade" id="kt_modal_public_user_profile" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <!--begin::Modal content-->
        <div class="modal-content rounded-4 overflow-hidden border-0 shadow-lg">
            <!--begin::Cover Header-->
            <div class="position-relative overflow-hidden rounded-top p-6 p-lg-8 min-h-180px d-flex flex-column justify-content-between" id="pub_user_cover_wrapper">
                <!-- Cover Background Image from Database -->
                <div id="pub_user_cover_bg" class="w-100 h-100 position-absolute top-0 start-0" style="
                    background-image: url('{{ asset('assets/img-temp/1200x800/img1.jpg') }}');
                    background-size: cover;
                    background-position: center 30%;
                    background-repeat: no-repeat;
                    transition: background-image 0.3s ease;
                "></div>

                <!-- Adjustable Overlay Layer -->
                <div id="pub_user_cover_overlay" class="w-100 h-100 position-absolute top-0 start-0" style="
                    background-color: #000000;
                    opacity: 0.6;
                "></div>

                <!--begin::Close Button-->
                <div class="position-absolute top-0 end-0 m-4 z-index-3">
                    <button type="button" class="btn btn-sm btn-icon btn-color-white bg-black bg-opacity-25 bg-hover-opacity-50 text-hover-white shadow-xs rounded-circle" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <!--end::Close Button-->

                <!--begin::Header Elements on Top of Cover-->
                <div class="position-relative z-index-2 d-flex flex-column align-items-center text-center mt-2 mb-2">
                    <!--begin::Avatar Container with Presence Dot-->
                    <div class="position-relative mb-3">
                        <div class="symbol symbol-85px symbol-circle">
                            <div id="pub_user_avatar_img" class="symbol-label shadow-sm border border-4 border-white rounded-circle d-none"
                                style="background-position: center; background-size: cover;">
                            </div>
                            <div id="pub_user_symbol" class="symbol-label fs-1 fw-bold bg-light-primary text-primary shadow-sm border border-4 border-white rounded-circle">
                                U
                            </div>
                        </div>

                        <!-- Live Presence Dot on Modal Avatar -->
                        <span id="pub_user_presence_dot" class="position-absolute bottom-0 end-0 w-16px h-16px rounded-circle bg-success border border-3 border-white shadow-xs" style="transform: translate(5%, -5%);"></span>
                    </div>
                    <!--end::Avatar Container-->

                    <!--begin::Name-->
                    <h2 class="fw-bolder text-white mb-1 drop-shadow-sm fs-3" id="pub_user_name">-</h2>
                    <!--end::Name-->

                    <!--begin::Email (Safe Public view)-->
                    <div class="text-white text-opacity-75 fw-semibold fs-7 mb-2" id="pub_user_email">-</div>
                    <!--end::Email-->

                    <!--begin::Badges-->
                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                        <div id="pub_user_roles" class="d-flex flex-wrap justify-content-center gap-1">
                            <span class="badge bg-white bg-opacity-90 text-gray-800 fw-bold fs-8 px-3 py-1 text-uppercase shadow-xs rounded-pill">PENGGUNA</span>
                        </div>
                        <span id="pub_user_presence_badge" class="badge bg-success text-white fw-bold fs-8 px-3 py-1 shadow-xs rounded-pill">Online</span>
                    </div>
                    <!--end::Badges-->
                </div>
                <!--end::Header Elements on Top of Cover-->
            </div>
            <!--end::Cover Header-->

            <!--begin::Modal body-->
            <div class="modal-body px-6 px-lg-8 pt-5 pb-6">
                <!--begin::Moto Hidup / Status Post-->
                <div class="card card-dashed bg-light-primary p-4 rounded-3 mb-5 border-primary border-opacity-25">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="ki-duotone ki-quote fs-4 text-primary"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-8 fw-bolder text-primary text-uppercase">Moto Hidup & Status</span>
                    </div>
                    <p class="fs-7 text-gray-700 fw-medium fst-italic mb-0" id="pub_user_moto">-</p>
                </div>
                <!--end::Moto Hidup / Status Post-->

                <!--begin::Info Grid-->
                <div class="row g-3 mb-5">
                    <div class="col-6">
                        <div class="border border-gray-200 border-dashed rounded-3 p-3 text-center bg-body">
                            <span class="fs-8 text-muted fw-semibold d-block">Poin Aktivitas</span>
                            <span class="fs-6 fw-bolder text-success" id="pub_user_points">0 Poin</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border border-gray-200 border-dashed rounded-3 p-3 text-center bg-body">
                            <span class="fs-8 text-muted fw-semibold d-block">Bergabung Sejak</span>
                            <span class="fs-7 fw-bolder text-gray-800" id="pub_user_joined">-</span>
                        </div>
                    </div>
                </div>
                <!--end::Info Grid-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center justify-content-center gap-3 pt-2">
                    <button type="button" class="btn btn-sm btn-primary fw-bold px-5 btn-social-friend-request" id="pub_user_btn_friend" data-user-id="" data-user-name="">
                        <i class="ki-duotone ki-user-tick fs-5 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <span class="indicator-label">Tambah Teman</span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-sm btn-light fw-bold px-5" data-bs-dismiss="modal">
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
<!--end::Modal - Profil Pengguna Publik-->
