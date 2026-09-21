<!--begin::Tab Pane Theme Switcher-->
<div class="row g-6 g-xl-9">
    <!--begin::Col Card Landing-->
    <div class="col-md-6 col-xl-6">
        <div class="card shadow-sm h-100 border d-flex flex-column {{ ($currentFrontpage ?? 'landing') === 'landing' ? 'border-primary border-2' : 'border-gray-200' }}" id="card_theme_landing">
            <!--begin::Card header-->
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
                <div class="d-flex flex-column flex-md-row align-items-center gap-3 text-center text-md-start w-100 w-md-auto">
                    <div class="symbol symbol-45px symbol-circle bg-light-primary d-flex align-items-center justify-content-center flex-shrink-0 mb-1 mb-md-0">
                        <i class="ki-outline ki-rocket text-primary fs-2"></i>
                    </div>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Landing Page (Metronic 8)</h3>
                        <span class="text-muted fs-7 mt-1">Satu halaman tunggal (One-Page) dengan Navigasi Anchor</span>
                    </div>
                </div>
                <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0" id="card_theme_landing_badge">
                    @if(($currentFrontpage ?? 'landing') === 'landing')
                        <span class="badge badge-success fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                            <i class="ki-outline ki-check-circle fs-6 me-1 text-white"></i> Tema Aktif
                        </span>
                    @else
                        <span class="badge badge-light-secondary fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">Tidak Aktif</span>
                    @endif
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-6 px-4 px-md-6 d-flex flex-column flex-grow-1">
                <p class="text-gray-600 fs-6 mb-5">
                    Halaman promosi & pemasaran elegan bergaya korporat dari <strong>Metronic 8.3.2</strong>. Dilengkapi hero banner gradien, navigasi menu anchor otomatis, katalog fitur, showcase portofolio, tabel harga fleksibel, dan footer interaktif.
                </p>

                <!--begin::Version Selector for Landing-->
                <div class="bg-light-subtle rounded-3 p-4 mb-5 border border-gray-200">
                    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                        <div class="d-flex align-items-center">
                            <span class="fw-bold text-gray-800 fs-7">Varian Versi Landing:</span>
                        </div>
                        <span class="badge badge-light-info fs-8 fw-semibold px-2 py-1">
                            Tersedia: {{ count($landingVersions ?? ['v1']) }} Versi
                        </span>
                    </div>

                    <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2 gap-sm-3">
                        <select class="form-select form-select-solid form-select-sm h-35px" id="kt_select_landing_version">
                            @foreach($landingVersions as $v)
                                <option value="{{ $v }}" {{ ($currentLandingVersion ?? 'v1') === $v ? 'selected' : '' }}>
                                    Versi {{ strtoupper($v) }} (frontpages/landing/{{ $v }})
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-sm btn-primary fw-bold text-nowrap d-inline-flex align-items-center justify-content-center h-35px px-4" id="kt_btn_apply_landing_version">
                            <span class="indicator-label">Terapkan Versi</span>
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle"></span>
                            </span>
                        </button>
                    </div>
                    <div class="text-muted fs-8 mt-2">
                        Anda dapat menambahkan template varian lain dengan membuat subfolder baru di <code>resources/views/frontpages/landing/</code> (misal: <code>v2</code>).
                    </div>
                </div>
                <!--end::Version Selector for Landing-->

                <!--begin::Features list-->
                <div class="d-flex flex-column gap-2 mb-2">
                    <div class="d-flex align-items-center text-gray-700 fs-7">
                        <i class="ki-outline ki-check-circle text-success fs-5 me-2 flex-shrink-0"></i>
                        Navigasi Anchor Halus (Smooth Scrolling)
                    </div>
                    <div class="d-flex align-items-center text-gray-700 fs-7">
                        <i class="ki-outline ki-check-circle text-success fs-5 me-2 flex-shrink-0"></i>
                        Dinamisasi Logo Terang & Mode Gelap
                    </div>
                    <div class="d-flex align-items-center text-gray-700 fs-7">
                        <i class="ki-outline ki-check-circle text-success fs-5 me-2 flex-shrink-0"></i>
                        Dukungan Multi-Bahasa (ID & EN) Realtime
                    </div>
                    <div class="d-flex align-items-center text-gray-700 fs-7">
                        <i class="ki-outline ki-check-circle text-success fs-5 me-2 flex-shrink-0"></i>
                        Pengurutan & On/Off Section Konten Realtime
                    </div>
                </div>
                <!--end::Features list-->
            </div>
            <!--end::Card body-->

            <!--begin::Card footer-->
            <div class="card-footer py-4 px-4 px-md-6 mt-auto">
                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2 gap-sm-3" id="card_theme_landing_actions">
                    @if(($currentFrontpage ?? 'landing') === 'landing')
                        <button type="button" class="btn btn-success btn-sm w-100 fw-bold disabled d-inline-flex align-items-center justify-content-center h-38px" disabled>
                            <i class="ki-outline ki-check fs-4 me-1"></i> Sedang Aktif
                        </button>
                    @else
                        <button type="button" class="btn btn-primary btn-sm w-100 fw-bold d-inline-flex align-items-center justify-content-center h-38px kt-btn-switch-frontpage" data-theme="landing">
                            <span class="indicator-label d-inline-flex align-items-center">
                                <i class="ki-outline ki-rocket fs-4 me-1"></i> Aktifkan Landing Page
                            </span>
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle me-2"></span> Mengaktifkan...
                            </span>
                        </button>
                    @endif
                    <a href="{{ url('/landing') }}" target="_blank" class="btn btn-light-primary btn-sm fw-bold px-4 text-nowrap text-center d-inline-flex align-items-center justify-content-center h-38px">
                        <i class="ki-outline ki-eye fs-4 me-1"></i> Preview
                    </a>
                </div>
            </div>
            <!--end::Card footer-->
        </div>
    </div>
    <!--end::Col Card Landing-->

    <!--begin::Col Card Education-->
    <div class="col-md-6 col-xl-6">
        <div class="card shadow-sm h-100 border d-flex flex-column {{ ($currentFrontpage ?? 'landing') === 'education' ? 'border-warning border-2' : 'border-gray-200' }}" id="card_theme_education">
            <!--begin::Card header-->
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
                <div class="d-flex flex-column flex-md-row align-items-center gap-3 text-center text-md-start w-100 w-md-auto">
                    <div class="symbol symbol-45px symbol-circle bg-light-warning d-flex align-items-center justify-content-center flex-shrink-0 mb-1 mb-md-0">
                        <i class="ki-outline ki-teacher text-warning fs-2"></i>
                    </div>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Education Portal (Unify v2.6)</h3>
                        <span class="text-muted fs-7 mt-1">Portal Akademik Multipage Kompleks</span>
                    </div>
                </div>
                <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0" id="card_theme_education_badge">
                    @if(($currentFrontpage ?? 'landing') === 'education')
                        <span class="badge badge-warning fw-bold px-3 fs-7 text-white d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                            <i class="ki-outline ki-check-circle fs-6 me-1 text-white"></i> Tema Aktif
                        </span>
                    @else
                        <span class="badge badge-light-secondary fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">Tidak Aktif</span>
                    @endif
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-6 px-4 px-md-6 d-flex flex-column flex-grow-1">
                <p class="text-gray-600 fs-6 mb-5">
                    Template portal akademik & universitas multi-halaman berbasis <strong>Unify v2.6</strong>. Terdiri dari berbagai halaman terpisah (Programs, Future Students, Campus Life, Research, Sign-in, dan Faculty Pages).
                </p>

                <!--begin::Info Note-->
                <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row p-4 mb-5 border border-warning border-opacity-25 rounded-3">
                    <i class="ki-outline ki-information-5 fs-2 text-warning me-3 mb-2 mb-sm-0 flex-shrink-0"></i>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <span class="fw-bold text-gray-800 fs-7">Struktur Multipage Kompleks</span>
                        <span class="text-gray-600 fs-8">Tema Education menggunakan routing terpisah di <code>routes/website.php</code> dengan rute <code>/education/*</code>. Seluruh tab konfigurasi khusus Education tersedia di menu tab navigasi saat tema ini aktif.</span>
                    </div>
                </div>
                <!--end::Info Note-->

                <!--begin::Features list-->
                <div class="d-flex flex-column gap-2 mb-2">
                    <div class="d-flex align-items-center text-gray-700 fs-7">
                        <i class="ki-outline ki-check-circle text-success fs-5 me-2 flex-shrink-0"></i>
                        Arsitektur Multi-Halaman Lengkap (Programs, Research, Events)
                    </div>
                    <div class="d-flex align-items-center text-gray-700 fs-7">
                        <i class="ki-outline ki-check-circle text-success fs-5 me-2 flex-shrink-0"></i>
                        Struktur Header & Navbar Pendidikan Terintegrasi
                    </div>
                    <div class="d-flex align-items-center text-gray-700 fs-7">
                        <i class="ki-outline ki-check-circle text-success fs-5 me-2 flex-shrink-0"></i>
                        Dukungan Switcher Bahasa (ID / EN)
                    </div>
                </div>
                <!--end::Features list-->
            </div>
            <!--end::Card body-->

            <!--begin::Card footer-->
            <div class="card-footer py-4 px-4 px-md-6 mt-auto">
                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2 gap-sm-3" id="card_theme_education_actions">
                    @if(($currentFrontpage ?? 'landing') === 'education')
                        <button type="button" class="btn btn-warning text-white btn-sm w-100 fw-bold disabled d-inline-flex align-items-center justify-content-center h-38px" disabled>
                            <i class="ki-outline ki-check fs-4 me-1"></i> Sedang Aktif
                        </button>
                    @else
                        <button type="button" class="btn btn-warning text-white btn-sm w-100 fw-bold d-inline-flex align-items-center justify-content-center h-38px kt-btn-switch-frontpage" data-theme="education">
                            <span class="indicator-label d-inline-flex align-items-center">
                                <i class="ki-outline ki-teacher fs-4 me-1"></i> Aktifkan Education Portal
                            </span>
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle me-2"></span> Mengaktifkan...
                            </span>
                        </button>
                    @endif
                    <a href="{{ url('/education') }}" target="_blank" class="btn btn-light-warning btn-sm fw-bold px-4 text-nowrap text-center d-inline-flex align-items-center justify-content-center h-38px">
                        <i class="ki-outline ki-eye fs-4 me-1"></i> Preview
                    </a>
                </div>
            </div>
            <!--end::Card footer-->
        </div>
    </div>
    <!--end::Col Card Education-->
</div>
<!--end::Tab Pane Theme Switcher-->
