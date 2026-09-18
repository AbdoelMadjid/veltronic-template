<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" role="tablist">
    <!--begin::Nav item Tema Switcher-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-6 py-4 {{ ($active ?? 'theme') === 'theme' ? 'active' : '' }}" 
           data-bs-toggle="tab" href="#kt_theme_tab_switcher" role="tab">
            <i class="ki-outline ki-element-11 fs-4 me-2"></i> Pilihan Tema
            <span class="badge badge-light-primary ms-2 fs-8">{{ strtoupper($currentFrontpage ?? 'LANDING') }}</span>
        </a>
    </li>
    <!--end::Nav item Tema Switcher-->

    <!--begin::Nav item Branding & Hero-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-6 py-4 {{ ($active ?? '') === 'hero' ? 'active' : '' }}" 
           data-bs-toggle="tab" href="#kt_theme_tab_hero" role="tab">
            <i class="ki-outline ki-crown-2 fs-4 me-2"></i> Branding & Hero
        </a>
    </li>
    <!--end::Nav item Branding & Hero-->

    <!--begin::Nav item Menu Navigasi-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-6 py-4 {{ ($active ?? '') === 'menu' ? 'active' : '' }}" 
           data-bs-toggle="tab" href="#kt_theme_tab_menu" role="tab">
            <i class="ki-outline ki-row-horizontal fs-4 me-2"></i> Menu Navigasi
            <span class="badge badge-light-success ms-2 fs-8" id="badge_active_menus_count">{{ $stats['active_menus'] ?? 0 }}</span>
        </a>
    </li>
    <!--end::Nav item Menu Navigasi-->

    <!--begin::Nav item Sections Konten-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-6 py-4 {{ ($active ?? '') === 'sections' ? 'active' : '' }}" 
           data-bs-toggle="tab" href="#kt_theme_tab_sections" role="tab">
            <i class="ki-outline ki-abstract-26 fs-4 me-2"></i> Section Konten
            <span class="badge badge-light-info ms-2 fs-8" id="badge_active_sections_count">{{ $stats['active_sections'] ?? 0 }}</span>
        </a>
    </li>
    <!--end::Nav item Sections Konten-->

    <!--begin::Nav item Footer & Kontak-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-6 py-4 {{ ($active ?? '') === 'footer' ? 'active' : '' }}" 
           data-bs-toggle="tab" href="#kt_theme_tab_footer" role="tab">
            <i class="ki-outline ki-sms fs-4 me-2"></i> Footer & Kontak
        </a>
    </li>
    <!--end::Nav item Footer & Kontak-->

    <!--begin::Nav item Pratinjau-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-6 py-4 {{ ($active ?? '') === 'preview' ? 'active' : '' }}" 
           data-bs-toggle="tab" href="#kt_theme_tab_preview" role="tab">
            <i class="ki-outline ki-tablet fs-4 me-2"></i> Pratinjau
        </a>
    </li>
    <!--end::Nav item Pratinjau-->
</ul>
<!--end::Navs-->
