<!--begin::Navs Top-Level-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold overflow-x-auto overflow-y-hidden flex-nowrap" id="theme_frontpage_main_nav_tabs" role="tablist">
    <!--begin::Nav item 1: Status & Pilihan Tema-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? 'theme') === 'theme' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_theme_main_tab_switcher" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pusat Status & Pilihan Tema Publik"
           aria-selected="{{ ($active ?? 'theme') === 'theme' ? 'true' : 'false' }}">
            <i class="ki-outline ki-element-11 fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Status & Pilihan Tema</span>
            <span class="badge {{ ($currentFrontpage ?? 'landing') === 'education' ? 'badge-light-warning' : 'badge-light-primary' }} fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1 d-none d-md-inline-block" id="nav_badge_theme_label">
                Aktif: {{ strtoupper($currentFrontpage ?? 'LANDING') }}
            </span>
        </a>
    </li>
    <!--end::Nav item 1-->

    <!--begin::Nav item 2: Konfigurasi Landing Page-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'landing' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_theme_main_tab_landing" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Konfigurasi & Pratinjau Landing Page (Metronic 8)"
           aria-selected="{{ ($active ?? '') === 'landing' ? 'true' : 'false' }}">
            <i class="ki-outline ki-rocket fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Landing Page</span>
            <span class="badge badge-light-primary fw-bold fs-8 ms-1 ms-md-2 px-2 py-1 d-none d-md-inline-block">Metronic 8</span>
        </a>
    </li>
    <!--end::Nav item 2-->

    <!--begin::Nav item 3: Konfigurasi Education Portal-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-warning d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'education' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_theme_main_tab_education" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Konfigurasi & Pratinjau Education Portal (Unify v2.6)"
           aria-selected="{{ ($active ?? '') === 'education' ? 'true' : 'false' }}">
            <i class="ki-outline ki-teacher fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Education Portal</span>
            <span class="badge badge-light-warning fw-bold fs-8 ms-1 ms-md-2 px-2 py-1 d-none d-md-inline-block">Unify v2.6</span>
        </a>
    </li>
    <!--end::Nav item 3-->
</ul>
<!--end::Navs Top-Level-->


