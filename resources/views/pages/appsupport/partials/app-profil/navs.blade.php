<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold overflow-x-auto overflow-y-hidden flex-nowrap" role="tablist">
    <!--begin::Nav item 1-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? 'meta') === 'meta' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_app_profil_tab_meta" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Identitas & Meta SEO"
           aria-selected="{{ ($active ?? 'meta') === 'meta' ? 'true' : 'false' }}">
            <i class="ki-outline ki-code fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Identitas & Meta SEO</span>
        </a>
    </li>
    <!--end::Nav item 1-->

    <!--begin::Nav item 2-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'logo' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_app_profil_tab_logo" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Logo & Favicon"
           aria-selected="{{ ($active ?? '') === 'logo' ? 'true' : 'false' }}">
            <i class="ki-outline ki-picture fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Logo & Favicon</span>
        </a>
    </li>
    <!--end::Nav item 2-->

    <!--begin::Nav item 3-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'footer' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_app_profil_tab_footer" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pengaturan Footer"
           aria-selected="{{ ($active ?? '') === 'footer' ? 'true' : 'false' }}">
            <i class="ki-outline ki-document fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Pengaturan Footer</span>
        </a>
    </li>
    <!--end::Nav item 3-->

    <!--begin::Nav item 4-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'overview' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_app_profil_tab_overview" 
           role="tab"
           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Status & Ringkasan"
           aria-selected="{{ ($active ?? '') === 'overview' ? 'true' : 'false' }}">
            <i class="ki-outline ki-chart-simple fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Status & Ringkasan</span>
        </a>
    </li>
    <!--end::Nav item 4-->
</ul>
<!--end::Navs-->
