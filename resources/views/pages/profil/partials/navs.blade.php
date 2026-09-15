@php
    $currentTab = $activeTab ?? ($active ?? 'profil-saya');
@endphp
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" role="tablist">
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-8 py-5 {{ $currentTab === 'profil-saya' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_profil_saya">
            <i class="ki-duotone ki-user fs-4 me-2">
                <span class="path1"></span><span class="path2"></span>
            </i>
            Profil Saya
        </a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-8 py-5 {{ $currentTab === 'identitas-diri' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_identitas_diri">
            <i class="ki-duotone ki-badge fs-4 me-2">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
            </i>
            Identitas Diri
        </a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-8 py-5 {{ $currentTab === 'ganti-password' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_ganti_password">
            <i class="ki-duotone ki-key fs-4 me-2">
                <span class="path1"></span><span class="path2"></span>
            </i>
            Ganti Password
        </a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-8 py-5 {{ $currentTab === 'konfigurasi' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_konfigurasi">
            <i class="ki-duotone ki-setting-2 fs-4 me-2">
                <span class="path1"></span><span class="path2"></span>
            </i>
            Konfigurasi
        </a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-8 py-5 {{ $currentTab === 'riwayat-pengguna' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_riwayat_pengguna">
            <i class="ki-duotone ki-time fs-4 me-2">
                <span class="path1"></span><span class="path2"></span>
            </i>
            Riwayat Pengguna
        </a>
    </li>
</ul>
