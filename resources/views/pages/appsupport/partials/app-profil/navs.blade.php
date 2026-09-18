<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" role="tablist">
    <!--begin::Nav item 1-->
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-6 py-4 {{ ($active ?? 'meta') === 'meta' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_app_profil_tab_meta" 
           role="tab"
           aria-selected="{{ ($active ?? 'meta') === 'meta' ? 'true' : 'false' }}">
            <i class="ki-outline ki-code fs-4 me-2"></i> Identitas & Meta SEO
        </a>
    </li>
    <!--end::Nav item 1-->

    <!--begin::Nav item 2-->
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary me-6 py-4 {{ ($active ?? '') === 'logo' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_app_profil_tab_logo" 
           role="tab"
           aria-selected="{{ ($active ?? '') === 'logo' ? 'true' : 'false' }}">
            <i class="ki-outline ki-picture fs-4 me-2"></i> Logo & Favicon
        </a>
    </li>
    <!--end::Nav item 2-->

    <!--begin::Nav item 3-->
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary me-6 py-4 {{ ($active ?? '') === 'footer' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_app_profil_tab_footer" 
           role="tab"
           aria-selected="{{ ($active ?? '') === 'footer' ? 'true' : 'false' }}">
            <i class="ki-outline ki-document fs-4 me-2"></i> Pengaturan Footer
        </a>
    </li>
    <!--end::Nav item 3-->

    <!--begin::Nav item 4-->
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary me-6 py-4 {{ ($active ?? '') === 'overview' ? 'active' : '' }}" 
           data-bs-toggle="tab" 
           href="#kt_app_profil_tab_overview" 
           role="tab"
           aria-selected="{{ ($active ?? '') === 'overview' ? 'true' : 'false' }}">
            <i class="ki-outline ki-chart-simple fs-4 me-2"></i> Status & Ringkasan
        </a>
    </li>
    <!--end::Nav item 4-->
</ul>
<!--end::Navs-->
