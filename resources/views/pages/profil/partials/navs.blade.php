@php
    $currentTab = $activeTab ?? ($active ?? 'profil-saya');
    $unreadChatCount = auth()->check() ? auth()->user()->unreadChatCount() : 0;
@endphp
<div class="d-flex align-items-center justify-content-between flex-nowrap w-100 overflow-x-auto overflow-y-hidden">
    <!--begin::Tabs Nav-->
    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold flex-nowrap" role="tablist">
        <li class="nav-item mt-2" role="presentation">
            <a class="nav-link text-active-primary ms-0 me-4 me-md-8 py-5 {{ $currentTab === 'profil-saya' ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_profil_saya"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Profil Saya">
                <i class="ki-duotone ki-user fs-2 fs-md-4 me-0 me-md-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Profil Saya">
                    <span class="path1"></span><span class="path2"></span>
                </i>
                <span class="d-none d-md-inline">Profil Saya</span>
            </a>
        </li>
        <li class="nav-item mt-2" role="presentation">
            <a class="nav-link text-active-primary ms-0 me-4 me-md-8 py-5 {{ $currentTab === 'identitas-diri' ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_identitas_diri"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Identitas Diri">
                <i class="ki-duotone ki-badge fs-2 fs-md-4 me-0 me-md-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Identitas Diri">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                </i>
                <span class="d-none d-md-inline">Identitas Diri</span>
            </a>
        </li>
        <li class="nav-item mt-2" role="presentation">
            <a class="nav-link text-active-primary ms-0 me-4 me-md-8 py-5 {{ $currentTab === 'ganti-password' ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_ganti_password"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ganti Password">
                <i class="ki-duotone ki-key fs-2 fs-md-4 me-0 me-md-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Ganti Password">
                    <span class="path1"></span><span class="path2"></span>
                </i>
                <span class="d-none d-md-inline">Ganti Password</span>
            </a>
        </li>
        <li class="nav-item mt-2" role="presentation">
            <a class="nav-link text-active-primary ms-0 me-4 me-md-8 py-5 {{ $currentTab === 'konfigurasi' ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_konfigurasi"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Konfigurasi">
                <i class="ki-duotone ki-setting-2 fs-2 fs-md-4 me-0 me-md-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Konfigurasi">
                    <span class="path1"></span><span class="path2"></span>
                </i>
                <span class="d-none d-md-inline">Konfigurasi</span>
            </a>
        </li>
        <li class="nav-item mt-2" role="presentation">
            <a class="nav-link text-active-primary ms-0 me-4 me-md-8 py-5 {{ $currentTab === 'riwayat-pengguna' ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_riwayat_pengguna"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Riwayat Pengguna">
                <i class="ki-duotone ki-time fs-2 fs-md-4 me-0 me-md-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Riwayat Pengguna">
                    <span class="path1"></span><span class="path2"></span>
                </i>
                <span class="d-none d-md-inline">Riwayat Pengguna</span>
            </a>
        </li>
    </ul>
    <!--end::Tabs Nav-->

    <!--begin::Chat Action Link-->
    <div class="d-flex align-items-center my-2 ms-3 flex-shrink-0">
        <a href="{{ route('profil.profil-pengguna.chat') }}" 
           class="btn btn-sm btn-primary fw-bold d-inline-flex align-items-center gap-2 shadow-xs hover-elevate-up"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Buka Ruang Obrolan & Pesan">
            <i class="ki-duotone ki-messages fs-3 text-white"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
            <span class="d-none d-sm-inline text-white">Ruang Chat</span>
            @if($unreadChatCount > 0)
                <span class="badge badge-sm badge-circle bg-white text-primary fw-bolder ms-1">{{ $unreadChatCount > 99 ? '99+' : $unreadChatCount }}</span>
            @endif
        </a>
    </div>
    <!--end::Chat Action Link-->
</div>
