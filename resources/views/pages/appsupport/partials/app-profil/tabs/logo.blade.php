<form id="kt_form_app_logo" method="POST" action="{{ route('appsupport.app-profil.logo') }}" enctype="multipart/form-data">
    @csrf

    <div class="row g-6">
        <!--begin::Logo Default (Light Mode)-->
        <div class="col-md-6 col-xl-6">
            <div class="card card-flush shadow-sm border-0 h-100">
                <div class="card-header border-0 pt-6">
                    <div class="card-title d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle bg-light-warning me-3 d-flex align-items-center justify-content-center">
                            <i class="ki-outline ki-sun text-warning fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold text-gray-900 m-0 fs-5">Logo Mode Terang (Light Mode)</h3>
                            <span class="text-muted fs-8">Ditampilkan pada sidebar terang & header terang</span>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-light-danger btn-sm btn-icon btn-reset-logo" data-target="default" title="Kembalikan ke logo default tema">
                            <i class="ki-outline ki-arrows-circle fs-5"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body pt-2 d-flex flex-column justify-content-between">
                    <!--begin::Preview Box-->
                    <div class="logo-preview-box-light mb-3 position-relative">
                        <img src="{{ app_logo_url('default') }}" id="img_preview_logo_default" alt="Logo Light Preview" class="mh-60px mw-100" />
                    </div>
                    <!--end::Preview Box-->

                    <!--begin::Dimension Constraints Badges-->
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge badge-light-primary fs-8 py-2 px-3">
                            <i class="ki-outline ki-maximize fs-7 me-1"></i> Min: 100×20 px
                        </span>
                        <span class="badge badge-light-primary fs-8 py-2 px-3">
                            <i class="ki-outline ki-arrow-up-right fs-7 me-1"></i> Max: 600×150 px
                        </span>
                        <span class="badge badge-light-info fs-8 py-2 px-3">
                            <i class="ki-outline ki-star fs-7 me-1"></i> Ideal: 200×50 px
                        </span>
                        <span class="badge badge-light-secondary text-gray-700 fs-8 py-2 px-3">
                            Maks 1 MB (PNG/SVG/WebP)
                        </span>
                    </div>
                    <!--end::Dimension Constraints Badges-->

                    <div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-gray-800 fs-7">Unggah Berkas Logo Baru</label>
                            <input type="file" class="form-control form-control-solid form-control-sm input-validated-image" 
                                   name="logo_default_file" 
                                   id="input_file_logo_default" 
                                   data-target-preview="img_preview_logo_default"
                                   data-min-w="100" data-max-w="600" 
                                   data-min-h="20" data-max-h="150" 
                                   data-max-size-kb="1024"
                                   data-label="Logo Mode Terang"
                                   accept=".png,.svg,.webp,.jpg,.jpeg" />
                            <div class="form-text fs-8 text-muted mt-1" id="info_dim_logo_default">
                                File harus berasio lanskap dengan lebar lebih besar dari tinggi.
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold text-gray-700 fs-7">Atau Path / URL Logo Kustom</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="app_logo_default_url" value="{{ $settings['app_logo_default'] ?? '' }}" placeholder="media/logos/default.svg atau https://..." />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Logo Default-->

        <!--begin::Logo Dark Mode-->
        <div class="col-md-6 col-xl-6">
            <div class="card card-flush shadow-sm border-0 h-100">
                <div class="card-header border-0 pt-6">
                    <div class="card-title d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle bg-light-primary me-3 d-flex align-items-center justify-content-center">
                            <i class="ki-outline ki-moon text-primary fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold text-gray-900 m-0 fs-5">Logo Mode Gelap (Dark Mode)</h3>
                            <span class="text-muted fs-8">Ditampilkan pada sidebar gelap & header gelap</span>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-light-danger btn-sm btn-icon btn-reset-logo" data-target="dark" title="Kembalikan ke logo default tema">
                            <i class="ki-outline ki-arrows-circle fs-5"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body pt-2 d-flex flex-column justify-content-between">
                    <!--begin::Preview Box-->
                    <div class="logo-preview-box-dark mb-3 position-relative">
                        <img src="{{ app_logo_url('dark') }}" id="img_preview_logo_dark" alt="Logo Dark Preview" class="mh-60px mw-100" />
                    </div>
                    <!--end::Preview Box-->

                    <!--begin::Dimension Constraints Badges-->
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge badge-light-primary fs-8 py-2 px-3">
                            <i class="ki-outline ki-maximize fs-7 me-1"></i> Min: 100×20 px
                        </span>
                        <span class="badge badge-light-primary fs-8 py-2 px-3">
                            <i class="ki-outline ki-arrow-up-right fs-7 me-1"></i> Max: 600×150 px
                        </span>
                        <span class="badge badge-light-info fs-8 py-2 px-3">
                            <i class="ki-outline ki-star fs-7 me-1"></i> Ideal: 200×50 px
                        </span>
                        <span class="badge badge-light-secondary text-gray-700 fs-8 py-2 px-3">
                            Maks 1 MB (Transparan/Terang)
                        </span>
                    </div>
                    <!--end::Dimension Constraints Badges-->

                    <div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-gray-800 fs-7">Unggah Berkas Logo Baru</label>
                            <input type="file" class="form-control form-control-solid form-control-sm input-validated-image" 
                                   name="logo_dark_file" 
                                   id="input_file_logo_dark" 
                                   data-target-preview="img_preview_logo_dark"
                                   data-min-w="100" data-max-w="600" 
                                   data-min-h="20" data-max-h="150" 
                                   data-max-size-kb="1024"
                                   data-label="Logo Mode Gelap"
                                   accept=".png,.svg,.webp,.jpg,.jpeg" />
                            <div class="form-text fs-8 text-muted mt-1" id="info_dim_logo_dark">
                                Disarankan menggunakan warna terang/putih atau latar belakang transparan.
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold text-gray-700 fs-7">Atau Path / URL Logo Kustom</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="app_logo_dark_url" value="{{ $settings['app_logo_dark'] ?? '' }}" placeholder="media/logos/default-dark.svg atau https://..." />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Logo Dark Mode-->

        <!--begin::Logo Minimize-->
        <div class="col-md-6 col-xl-6">
            <div class="card card-flush shadow-sm border-0 h-100">
                <div class="card-header border-0 pt-6">
                    <div class="card-title d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle bg-light-info me-3 d-flex align-items-center justify-content-center">
                            <i class="ki-outline ki-abstract-26 text-info fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold text-gray-900 m-0 fs-5">Logo Mini / Minimize Icon</h3>
                            <span class="text-muted fs-8">Ditampilkan saat sidebar ditutup / diciutkan</span>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-light-danger btn-sm btn-icon btn-reset-logo" data-target="minimize" title="Kembalikan ke icon default tema">
                            <i class="ki-outline ki-arrows-circle fs-5"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body pt-2 d-flex flex-column justify-content-between">
                    <!--begin::Preview Box-->
                    <div class="logo-preview-box-dark mb-3 position-relative">
                        <img src="{{ app_logo_url('minimize') }}" id="img_preview_logo_minimize" alt="Logo Mini Preview" class="mh-40px mw-40px" />
                    </div>
                    <!--end::Preview Box-->

                    <!--begin::Dimension Constraints Badges-->
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge badge-light-info fs-8 py-2 px-3">
                            <i class="ki-outline ki-size fs-7 me-1"></i> Rasio 1:1 (Persegi)
                        </span>
                        <span class="badge badge-light-primary fs-8 py-2 px-3">
                            <i class="ki-outline ki-maximize fs-7 me-1"></i> Min: 30×30 px
                        </span>
                        <span class="badge badge-light-primary fs-8 py-2 px-3">
                            <i class="ki-outline ki-arrow-up-right fs-7 me-1"></i> Max: 200×200 px
                        </span>
                        <span class="badge badge-light-success fs-8 py-2 px-3">
                            <i class="ki-outline ki-star fs-7 me-1"></i> Ideal: 40×40 px
                        </span>
                        <span class="badge badge-light-secondary text-gray-700 fs-8 py-2 px-3">
                            Maks 512 KB
                        </span>
                    </div>
                    <!--end::Dimension Constraints Badges-->

                    <div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-gray-800 fs-7">Unggah Berkas Icon Mini Baru</label>
                            <input type="file" class="form-control form-control-solid form-control-sm input-validated-image" 
                                   name="logo_minimize_file" 
                                   id="input_file_logo_minimize" 
                                   data-target-preview="img_preview_logo_minimize"
                                   data-min-w="30" data-max-w="200" 
                                   data-min-h="30" data-max-h="200" 
                                   data-square="true"
                                   data-max-size-kb="512"
                                   data-label="Logo Mini (Icon)"
                                   accept=".png,.svg,.webp,.jpg,.jpeg" />
                            <div class="form-text fs-8 text-muted mt-1" id="info_dim_logo_minimize">
                                Wajib berasio 1:1 (lebar dan tinggi sama persis).
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold text-gray-700 fs-7">Atau Path / URL Icon Kustom</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="app_logo_minimize_url" value="{{ $settings['app_logo_minimize'] ?? '' }}" placeholder="media/logos/default-small.svg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Logo Minimize-->

        <!--begin::Favicon-->
        <div class="col-md-6 col-xl-6">
            <div class="card card-flush shadow-sm border-0 h-100">
                <div class="card-header border-0 pt-6">
                    <div class="card-title d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle bg-light-success me-3 d-flex align-items-center justify-content-center">
                            <i class="ki-outline ki-bookmark text-success fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold text-gray-900 m-0 fs-5">Favicon Browser (.ico / .png)</h3>
                            <span class="text-muted fs-8">Ditampilkan pada tab browser & bookmark</span>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-light-danger btn-sm btn-icon btn-reset-logo" data-target="favicon" title="Kembalikan ke favicon default tema">
                            <i class="ki-outline ki-arrows-circle fs-5"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body pt-2 d-flex flex-column justify-content-between">
                    <!--begin::Preview Box-->
                    <div class="d-flex align-items-center gap-4 p-4 bg-light rounded-3 mb-3">
                        <div class="favicon-preview-box">
                            <img src="{{ app_favicon_url() }}" id="img_preview_favicon" alt="Favicon Preview" class="w-25px h-25px" />
                        </div>
                        <div>
                            <div class="fw-bold text-gray-800 fs-6">Tab Browser Icon Preview</div>
                            <span class="text-muted fs-8">Simulasi icon kecil pada tab peramban web.</span>
                        </div>
                    </div>
                    <!--end::Preview Box-->

                    <!--begin::Dimension Constraints Badges-->
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge badge-light-info fs-8 py-2 px-3">
                            <i class="ki-outline ki-size fs-7 me-1"></i> Rasio 1:1 (Persegi)
                        </span>
                        <span class="badge badge-light-primary fs-8 py-2 px-3">
                            <i class="ki-outline ki-maximize fs-7 me-1"></i> Min: 16×16 px
                        </span>
                        <span class="badge badge-light-primary fs-8 py-2 px-3">
                            <i class="ki-outline ki-arrow-up-right fs-7 me-1"></i> Max: 128×128 px
                        </span>
                        <span class="badge badge-light-success fs-8 py-2 px-3">
                            <i class="ki-outline ki-star fs-7 me-1"></i> Ideal: 32×32 / 64×64 px
                        </span>
                        <span class="badge badge-light-secondary text-gray-700 fs-8 py-2 px-3">
                            Maks 256 KB (.ico/.png/.svg)
                        </span>
                    </div>
                    <!--end::Dimension Constraints Badges-->

                    <div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-gray-800 fs-7">Unggah Berkas Favicon Baru</label>
                            <input type="file" class="form-control form-control-solid form-control-sm input-validated-image" 
                                   name="favicon_file" 
                                   id="input_file_favicon" 
                                   data-target-preview="img_preview_favicon"
                                   data-min-w="16" data-max-w="128" 
                                   data-min-h="16" data-max-h="128" 
                                   data-square="true"
                                   data-max-size-kb="256"
                                   data-label="Favicon Tab Browser"
                                   accept=".ico,.png,.svg,.webp" />
                            <div class="form-text fs-8 text-muted mt-1" id="info_dim_favicon">
                                Format terbaik: .ico, .png, .svg dengan ukuran rasio 1:1.
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold text-gray-700 fs-7">Atau Path / URL Favicon Kustom</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" name="app_favicon_url" value="{{ $settings['app_favicon'] ?? '' }}" placeholder="media/logos/favicon.ico" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Favicon-->
    </div>

    <!--begin::Submit Bar-->
    <div class="card card-flush shadow-sm border-0 mt-6">
        <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="text-muted fs-7">
                <i class="ki-outline ki-shield-tick fs-5 me-1 text-success"></i>
                Setiap berkas divalidasi secara ketat berdasarkan resolusi minimal, maksimal, rasio aspek, dan ukuran berkas sebelum disimpan langsung ke <code>public/assets/logo/</code>.
            </div>
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary btn-sm fw-bold rounded-pill px-6" id="kt_btn_save_logo">
                    <span class="indicator-label">
                        <i class="ki-outline ki-check fs-4 me-1"></i> Simpan & Terapkan Logo
                    </span>
                    <span class="indicator-progress">
                        Memvalidasi & Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <!--end::Submit Bar-->
</form>
