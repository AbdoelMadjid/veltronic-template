<!--begin::Menu Notifications-->
<div class="menu menu-sub menu-sub-dropdown menu-column w-375px w-sm-400px w-md-425px" data-kt-menu="true" id="kt_menu_notifications">
    <!--begin::Heading-->
    <div class="d-flex flex-column bgi-no-repeat rounded-top px-6 pt-6 pb-2"
        style="background-image:url('{{ \App\Support\ThemeAsset::url('media/misc/menu-header-bg.jpg', $theme_asset_pack ?? null) }}'); background-size: cover; background-position: center;">
        <!--begin::Title & Action Header-->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="text-white fw-bold mb-0 fs-4">
                    Pemberitahuan
                </h3>
                <span class="fs-8 text-white opacity-75" id="notif_header_badge">0 belum dibaca</span>
            </div>
            <button type="button" class="btn btn-xs btn-color-white btn-active-color-primary bg-white bg-opacity-10 py-1 px-3 border-0 fs-8 rounded-pill shadow-xs" id="btn_mark_all_read">
                <i class="ki-duotone ki-double-check fs-7 me-1 text-white"><span class="path1"></span><span class="path2"></span></i>
                Tandai Dibaca
            </button>
        </div>
        <!--end::Title & Action Header-->

        <!--begin::Tabs Navigation (No Horizontal Scrollbar, Evenly Distributed)-->
        <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold border-0 d-flex justify-content-between px-0 overflow-hidden">
            <li class="nav-item">
                <a class="nav-link text-white opacity-75 opacity-state-100 pb-3 active fs-7 px-2" data-bs-toggle="tab"
                    href="#kt_topbar_notif_all">
                    Semua
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white opacity-75 opacity-state-100 pb-3 fs-7 px-2 d-inline-flex align-items-center gap-1" data-bs-toggle="tab"
                    href="#kt_topbar_notif_friendship">
                    Pertemanan
                    <span class="badge badge-circle badge-success fs-9 w-16px h-16px d-none" id="notif_tab_count_friends">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white opacity-75 opacity-state-100 pb-3 fs-7 px-2 d-inline-flex align-items-center gap-1" data-bs-toggle="tab"
                    href="#kt_topbar_notif_security">
                    Keamanan
                    <span class="badge badge-circle badge-warning fs-9 w-16px h-16px d-none" id="notif_tab_count_security">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white opacity-75 opacity-state-100 pb-3 fs-7 px-2 d-inline-flex align-items-center gap-1" data-bs-toggle="tab"
                    href="#kt_topbar_notif_chat">
                    Pesan
                    <span class="badge badge-circle badge-info fs-9 w-16px h-16px d-none" id="notif_tab_count_chat">0</span>
                </a>
            </li>
        </ul>
        <!--end::Tabs Navigation-->
    </div>
    <!--end::Heading-->

    <!--begin::Tab content-->
    <div class="tab-content">
        <!--begin::Tab panel: Semua-->
        <div class="tab-pane fade show active" id="kt_topbar_notif_all" role="tabpanel">
            <div class="scroll-y mh-350px my-2 px-6" id="notif_list_all">
                <div class="text-center py-10 px-4" id="notif_empty_all">
                    <div class="symbol symbol-45px symbol-circle bg-light-primary mb-3">
                        <i class="ki-duotone ki-notification-status fs-2 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                    </div>
                    <div class="fw-bold text-gray-800 fs-7 mb-1">Belum Ada Pemberitahuan</div>
                    <p class="text-muted fs-8 mb-0">Pemberitahuan aktivitas sistem dan akun akan muncul di sini.</p>
                </div>
            </div>
        </div>
        <!--end::Tab panel: Semua-->

        <!--begin::Tab panel: Pertemanan-->
        <div class="tab-pane fade" id="kt_topbar_notif_friendship" role="tabpanel">
            <div class="scroll-y mh-350px my-2 px-6" id="notif_list_friendship">
                <div class="text-center py-10 px-4" id="notif_empty_friendship">
                    <div class="symbol symbol-45px symbol-circle bg-light-success mb-3">
                        <i class="ki-duotone ki-people fs-2 text-success"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                    </div>
                    <div class="fw-bold text-gray-800 fs-7 mb-1">Tidak Ada Permintaan Pertemanan</div>
                    <p class="text-muted fs-8 mb-0">Ajakan berteman dari pengguna lain akan tampil di tab ini.</p>
                </div>
            </div>
        </div>
        <!--end::Tab panel: Pertemanan-->

        <!--begin::Tab panel: Keamanan & Akun-->
        <div class="tab-pane fade" id="kt_topbar_notif_security" role="tabpanel">
            <div class="scroll-y mh-350px my-2 px-6" id="notif_list_security">
                <div class="text-center py-10 px-4" id="notif_empty_security">
                    <div class="symbol symbol-45px symbol-circle bg-light-warning mb-3">
                        <i class="ki-duotone ki-shield-tick fs-2 text-warning"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <div class="fw-bold text-gray-800 fs-7 mb-1">Tidak Ada Notifikasi Keamanan</div>
                    <p class="text-muted fs-8 mb-0">Pengajuan reset password dan permohonan akun akan muncul di sini.</p>
                </div>
            </div>
        </div>
        <!--end::Tab panel: Keamanan & Akun-->

        <!--begin::Tab panel: Pesan / Chat-->
        <div class="tab-pane fade" id="kt_topbar_notif_chat" role="tabpanel">
            <div class="scroll-y mh-350px my-2 px-6" id="notif_list_chat">
                <div class="text-center py-10 px-4" id="notif_empty_chat">
                    <div class="symbol symbol-45px symbol-circle bg-light-info mb-3">
                        <i class="ki-duotone ki-messages fs-2 text-info"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                    </div>
                    <div class="fw-bold text-gray-800 fs-7 mb-1">Belum Ada Pesan Masuk</div>
                    <p class="text-muted fs-8 mb-0">Pesan dan percakapan baru akan muncul di tab ini.</p>
                </div>
            </div>
        </div>
        <!--end::Tab panel: Pesan / Chat-->
    </div>
    <!--end::Tab content-->

    <!--begin::Footer-->
    <div class="py-3 text-center border-top border-gray-200 bg-light bg-opacity-50 rounded-bottom">
        <span class="text-muted fs-8 fw-semibold">Pusat Notifikasi &amp; Aktivitas Terpadu</span>
    </div>
    <!--end::Footer-->
</div>
<!--end::Menu Notifications-->
