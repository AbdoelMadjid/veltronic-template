<!--begin::Education Container-->
<div class="d-flex flex-column gap-6">
    <!--begin::Education Subnavs Card-->
    <div class="card shadow-sm">
        <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
            <div class="d-flex flex-column flex-md-row align-items-center gap-3 text-center text-md-start w-100 w-md-auto">
                <div class="symbol symbol-45px symbol-circle bg-light-warning d-flex align-items-center justify-content-center flex-shrink-0 mb-1 mb-md-0">
                    <i class="ki-outline ki-teacher text-warning fs-2"></i>
                </div>
                <div class="d-flex flex-column align-items-center align-items-md-start">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 flex-wrap">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Konfigurasi Education Portal (Unify v2.6)</h3>
                        <span class="badge badge-light-warning fw-bold fs-8 px-2 py-1">
                            13 Modul Halaman
                        </span>
                    </div>
                    <span class="text-muted fs-7 mt-1">Kelola identitas kampus, direktori rute multipage, topbar admisi, dan kontak universitas</span>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 w-100 w-md-auto mt-2 mt-md-0" id="header_education_active_status">
                @if(($currentFrontpage ?? 'landing') === 'education')
                    <span class="badge badge-warning fw-bold px-3 fs-7 text-white d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                        <i class="ki-outline ki-check-circle fs-6 me-1 text-white"></i> Tema Aktif Publik
                    </span>
                @else
                    <span class="badge badge-light-secondary fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">Tidak Aktif</span>
                    <button type="button" class="btn btn-warning text-white btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px px-3 px-md-4 w-100 w-md-auto kt-btn-switch-frontpage" data-theme="education"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Jadikan Tema Education Portal Aktif di Publik">
                        <span class="indicator-label d-inline-flex align-items-center justify-content-center">
                            <i class="ki-outline ki-teacher fs-4 me-1"></i>
                            <span>Jadikan Tema Aktif</span>
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                            <span>Mengaktifkan...</span>
                        </span>
                    </button>
                @endif
                <a href="{{ url('/education') }}" target="_blank" class="btn btn-light-warning btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px px-3 px-md-4 w-100 w-md-auto"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Buka Halaman /education di Tab Baru">
                    <i class="ki-outline ki-exit-right-corner fs-4 me-1"></i>
                    <span>Buka /education</span>
                </a>
            </div>
        </div>

        <div class="card-body py-0 px-4 px-md-6">
            <!--begin::Subnav Tabs-->
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold overflow-x-auto overflow-y-hidden flex-nowrap" id="education_subnav_tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-warning active d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_edu_subtab_info" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Info & Identitas Portal">
                        <i class="ki-outline ki-crown-2 fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Info & Identitas</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-warning d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_edu_subtab_pages" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Katalog 13 Halaman">
                        <i class="ki-outline ki-book-open fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Katalog Halaman</span>
                        <span class="badge badge-light-warning fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1 d-none d-md-inline-block">{{ count($educationPages ?? []) }}</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-warning d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_edu_subtab_nav" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Navigasi & Topbar">
                        <i class="ki-outline ki-row-horizontal fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Navigasi & Topbar</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-warning d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_edu_subtab_footer" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Footer & Kontak">
                        <i class="ki-outline ki-sms fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Footer & Kontak</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-warning d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_edu_subtab_preview" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pratinjau Portal Education">
                        <i class="ki-outline ki-tablet fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Pratinjau Live</span>
                    </a>
                </li>
            </ul>
            <!--end::Subnav Tabs-->
        </div>
    </div>
    <!--end::Education Subnavs Card-->

    <!--begin::Subtab Content-->
    <div class="tab-content" id="kt_edu_subtab_content">
        <!--begin::Pane Info-->
        <div class="tab-pane fade show active" id="kt_edu_subtab_info" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.edu-info')
        </div>
        <!--end::Pane Info-->

        <!--begin::Pane Pages-->
        <div class="tab-pane fade" id="kt_edu_subtab_pages" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.edu-pages')
        </div>
        <!--end::Pane Pages-->

        <!--begin::Pane Nav-->
        <div class="tab-pane fade" id="kt_edu_subtab_nav" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.edu-nav')
        </div>
        <!--end::Pane Nav-->

        <!--begin::Pane Footer-->
        <div class="tab-pane fade" id="kt_edu_subtab_footer" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.edu-footer')
        </div>
        <!--end::Pane Footer-->

        <!--begin::Pane Preview-->
        <div class="tab-pane fade" id="kt_edu_subtab_preview" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.edu-preview')
        </div>
        <!--end::Pane Preview-->
    </div>
    <!--end::Subtab Content-->
</div>
<!--end::Education Container-->
