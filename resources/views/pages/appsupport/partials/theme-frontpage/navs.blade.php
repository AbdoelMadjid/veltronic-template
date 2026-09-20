<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold overflow-x-auto overflow-y-hidden flex-nowrap" id="theme_frontpage_nav_tabs" role="tablist">
    <!--begin::Nav item Tema Switcher-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? 'theme') === 'theme' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_theme_tab_switcher" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pilihan Tema"
           aria-selected="{{ ($active ?? 'theme') === 'theme' ? 'true' : 'false' }}">
            <i class="ki-outline ki-element-11 fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Pilihan Tema</span>
            <span class="badge badge-light-primary fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1">{{ strtoupper($currentFrontpage ?? 'LANDING') }}</span>
        </a>
    </li>
    <!--end::Nav item Tema Switcher-->

    <!--begin::Nav item Branding & Hero-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'hero' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_theme_tab_hero" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Branding & Hero"
           aria-selected="{{ ($active ?? '') === 'hero' ? 'true' : 'false' }}">
            <i class="ki-outline ki-crown-2 fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Branding & Hero</span>
        </a>
    </li>
    <!--end::Nav item Branding & Hero-->

    <!--begin::Nav item Menu Navigasi-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'menu' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_theme_tab_menu" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Menu Navigasi"
           aria-selected="{{ ($active ?? '') === 'menu' ? 'true' : 'false' }}">
            <i class="ki-outline ki-row-horizontal fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Menu Navigasi</span>
            <span class="badge badge-light-success fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1" id="badge_active_menus_count">{{ $stats['active_menus'] ?? 0 }}</span>
        </a>
    </li>
    <!--end::Nav item Menu Navigasi-->

    <!--begin::Nav item Sections Konten-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'sections' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_theme_tab_sections" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Section Konten"
           aria-selected="{{ ($active ?? '') === 'sections' ? 'true' : 'false' }}">
            <i class="ki-outline ki-abstract-26 fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Section Konten</span>
            <span class="badge badge-light-info fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1" id="badge_active_sections_count">{{ $stats['active_sections'] ?? 0 }}</span>
        </a>
    </li>
    <!--end::Nav item Sections Konten-->

    <!--begin::Nav item Footer & Kontak-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'footer' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_theme_tab_footer" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Footer & Kontak"
           aria-selected="{{ ($active ?? '') === 'footer' ? 'true' : 'false' }}">
            <i class="ki-outline ki-sms fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Footer & Kontak</span>
        </a>
    </li>
    <!--end::Nav item Footer & Kontak-->

    <!--begin::Nav item Pratinjau-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'preview' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_theme_tab_preview" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pratinjau"
           aria-selected="{{ ($active ?? '') === 'preview' ? 'true' : 'false' }}">
            <i class="ki-outline ki-tablet fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Pratinjau</span>
        </a>
    </li>
    <!--end::Nav item Pratinjau-->
</ul>
<!--end::Navs-->
