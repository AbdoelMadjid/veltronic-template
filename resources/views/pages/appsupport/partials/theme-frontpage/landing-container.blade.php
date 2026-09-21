<!--begin::Landing Container-->
<div class="d-flex flex-column gap-6">
    <!--begin::Landing Subnavs Card-->
    <div class="card shadow-sm">
        <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
            <div class="d-flex flex-column flex-md-row align-items-center gap-3 text-center text-md-start w-100 w-md-auto">
                <div class="symbol symbol-45px symbol-circle bg-light-primary d-flex align-items-center justify-content-center flex-shrink-0 mb-1 mb-md-0">
                    <i class="ki-outline ki-rocket text-primary fs-2"></i>
                </div>
                <div class="d-flex flex-column align-items-center align-items-md-start">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 flex-wrap">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Konfigurasi Landing Page (Metronic 8)</h3>
                        <span class="badge badge-light-info fw-bold fs-8 px-2 py-1">
                            Versi {{ strtoupper($currentLandingVersion ?? 'V1') }}
                        </span>
                    </div>
                    <span class="text-muted fs-7 mt-1">Kelola hero banner, navigasi menu anchor, seksi konten dinamis, dan footer promosi</span>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 w-100 w-md-auto mt-2 mt-md-0" id="header_landing_active_status">
                @if(($currentFrontpage ?? 'landing') === 'landing')
                    <span class="badge badge-success fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                        <i class="ki-outline ki-check-circle fs-6 me-1 text-white"></i> Tema Aktif Publik
                    </span>
                @else
                    <span class="badge badge-light-secondary fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">Tidak Aktif</span>
                    <button type="button" class="btn btn-primary btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px px-3 px-md-4 w-100 w-md-auto kt-btn-switch-frontpage" data-theme="landing"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Jadikan Tema Landing Page Aktif di Publik">
                        <span class="indicator-label d-inline-flex align-items-center justify-content-center">
                            <i class="ki-outline ki-rocket fs-4 me-1"></i>
                            <span>Jadikan Tema Aktif</span>
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                            <span>Mengaktifkan...</span>
                        </span>
                    </button>
                @endif
                <a href="{{ url('/landing') }}" target="_blank" class="btn btn-light-primary btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px px-3 px-md-4 w-100 w-md-auto"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Buka Halaman /landing di Tab Baru">
                    <i class="ki-outline ki-exit-right-corner fs-4 me-1"></i>
                    <span>Buka /landing</span>
                </a>
            </div>
        </div>

        <div class="card-body py-0 px-4 px-md-6">
            <!--begin::Subnav Tabs-->
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold overflow-x-auto overflow-y-hidden flex-nowrap" id="landing_subnav_tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary active d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_landing_subtab_hero" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Branding & Hero Banner">
                        <i class="ki-outline ki-crown-2 fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Branding & Hero</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_landing_subtab_menu" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Menu Navigasi Header">
                        <i class="ki-outline ki-row-horizontal fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Menu Navigasi</span>
                        <span class="badge badge-light-success fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1 d-none d-md-inline-block">{{ $stats['active_menus'] ?? 0 }}</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_landing_subtab_sections" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Manajemen Section Konten">
                        <i class="ki-outline ki-abstract-26 fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Section Konten</span>
                        <span class="badge badge-light-info fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1 d-none d-md-inline-block">{{ $stats['active_sections'] ?? 0 }}</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_landing_subtab_footer" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Footer Profil & Tautan Sosial">
                        <i class="ki-outline ki-sms fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Footer & Kontak</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4" data-bs-toggle="tab" href="#kt_landing_subtab_preview" role="tab"
                       data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pratinjau Live Landing Page">
                        <i class="ki-outline ki-tablet fs-2 fs-md-4 me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Pratinjau Live</span>
                    </a>
                </li>
            </ul>
            <!--end::Subnav Tabs-->
        </div>
    </div>
    <!--end::Landing Subnavs Card-->

    <!--begin::Subtab Content-->
    <div class="tab-content" id="kt_landing_subtab_content">
        <!--begin::Pane Hero-->
        <div class="tab-pane fade show active" id="kt_landing_subtab_hero" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.hero')
        </div>
        <!--end::Pane Hero-->

        <!--begin::Pane Menu-->
        <div class="tab-pane fade" id="kt_landing_subtab_menu" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.menu')
        </div>
        <!--end::Pane Menu-->

        <!--begin::Pane Sections-->
        <div class="tab-pane fade" id="kt_landing_subtab_sections" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.sections')
        </div>
        <!--end::Pane Sections-->

        <!--begin::Pane Footer-->
        <div class="tab-pane fade" id="kt_landing_subtab_footer" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.footer')
        </div>
        <!--end::Pane Footer-->

        <!--begin::Pane Preview-->
        <div class="tab-pane fade" id="kt_landing_subtab_preview" role="tabpanel">
            @include('pages.appsupport.partials.theme-frontpage.tabs.landing-preview')
        </div>
        <!--end::Pane Preview-->
    </div>
    <!--end::Subtab Content-->
</div>
<!--end::Landing Container-->
