<form id="system_settings_form" class="form">

    <!-- Group 1: Preferensi Default Tampilan & Antarmuka -->
    <div class="card mb-5 mb-xl-10 shadow-sm border-0">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-gray-900">1. Preferensi Default Tampilan & Antarmuka</h3>
            </div>
            <div class="card-toolbar">
                <span class="badge badge-light-primary fw-semibold fs-8">Appearance</span>
            </div>
        </div>
        <div class="card-body border-top p-9">

            <!-- 1.1 Gaya Icon Default -->
            <div class="row mb-8">
                <label class="col-lg-3 col-form-label fw-bold fs-6 text-gray-800">
                    Gaya Icon Default
                    <i class="ki-duotone ki-information-5 ms-1 fs-7 text-muted" data-bs-toggle="tooltip" title="Gaya KeenIcons default saat pengguna pertama kali membuka website.">
                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                    </i>
                </label>
                <div class="col-lg-9">
                    <div class="row g-4" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]" data-kt-icon-preview="true">
                        @php
                            $currentIconStyle = $settings['default_icon_style'] ?? 'duotone';
                        @endphp
                        
                        <!-- Duotone -->
                        <div class="col-md-4">
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 mb-0 w-100 {{ $currentIconStyle === 'duotone' ? 'active' : '' }}" data-kt-button="true">
                                <div class="d-flex align-items-center me-2">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                        <input class="form-check-input" type="radio" name="default_icon_style" value="duotone" {{ $currentIconStyle === 'duotone' ? 'checked' : '' }} />
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block fs-6 text-gray-800">Duotone</span>
                                        <span class="text-muted fs-8">Multi-layer SVG</span>
                                    </div>
                                </div>
                                <i class="ki-duotone ki-chart-simple fs-2x text-primary" data-kt-icon-style-ignore="true"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            </label>
                        </div>

                        <!-- Solid -->
                        <div class="col-md-4">
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 mb-0 w-100 {{ $currentIconStyle === 'solid' ? 'active' : '' }}" data-kt-button="true">
                                <div class="d-flex align-items-center me-2">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                        <input class="form-check-input" type="radio" name="default_icon_style" value="solid" {{ $currentIconStyle === 'solid' ? 'checked' : '' }} />
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block fs-6 text-gray-800">Solid</span>
                                        <span class="text-muted fs-8">Filled Bold Icon</span>
                                    </div>
                                </div>
                                <i class="ki-solid ki-chart-simple fs-2x text-success" data-kt-icon-style-ignore="true"></i>
                            </label>
                        </div>

                        <!-- Outline -->
                        <div class="col-md-4">
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 mb-0 w-100 {{ $currentIconStyle === 'outline' ? 'active' : '' }}" data-kt-button="true">
                                <div class="d-flex align-items-center me-2">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                        <input class="form-check-input" type="radio" name="default_icon_style" value="outline" {{ $currentIconStyle === 'outline' ? 'checked' : '' }} />
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block fs-6 text-gray-800">Outline</span>
                                        <span class="text-muted fs-8">Minimalist Line</span>
                                    </div>
                                </div>
                                <i class="ki-outline ki-chart-simple fs-2x text-info" data-kt-icon-style-ignore="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator separator-dashed my-6"></div>

            <!-- 1.2 Bahasa Default -->
            <div class="row mb-8">
                <label class="col-lg-3 col-form-label fw-bold fs-6 text-gray-800">
                    Bahasa Default
                    <i class="ki-duotone ki-information-5 ms-1 fs-7 text-muted" data-bs-toggle="tooltip" title="Bahasa pengantar awal saat pengguna belum memilih preferensi bahasa.">
                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                    </i>
                </label>
                <div class="col-lg-9">
                    <div class="row g-4" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        @php
                            $currentLang = $settings['default_language'] ?? 'id';
                        @endphp

                        <!-- Bahasa Indonesia -->
                        <div class="col-md-6">
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 mb-0 w-100 {{ $currentLang === 'id' ? 'active' : '' }}" data-kt-button="true">
                                <div class="d-flex align-items-center me-2">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                        <input class="form-check-input" type="radio" name="default_language" value="id" {{ $currentLang === 'id' ? 'checked' : '' }} />
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block fs-6 text-gray-800">Bahasa Indonesia</span>
                                        <span class="text-muted fs-8">Standar Nasional (ID)</span>
                                    </div>
                                </div>
                                <img src="{{ asset('assets/media/flags/indonesia.svg') }}" class="w-30px h-30px rounded-1 shadow-xs" alt="Indonesia Flag" />
                            </label>
                        </div>

                        <!-- English -->
                        <div class="col-md-6">
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 mb-0 w-100 {{ $currentLang === 'en' ? 'active' : '' }}" data-kt-button="true">
                                <div class="d-flex align-items-center me-2">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                        <input class="form-check-input" type="radio" name="default_language" value="en" {{ $currentLang === 'en' ? 'checked' : '' }} />
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block fs-6 text-gray-800">English</span>
                                        <span class="text-muted fs-8">International Standard (EN)</span>
                                    </div>
                                </div>
                                <img src="{{ asset('assets/media/flags/united-states.svg') }}" class="w-30px h-30px rounded-1 shadow-xs" alt="United States Flag" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator separator-dashed my-6"></div>

            <!-- 1.3 Versi Tema Default -->
            <div class="row mb-8">
                <label class="col-lg-3 col-form-label fw-bold fs-6 text-gray-800">
                    Versi Tema Default
                    <i class="ki-duotone ki-information-5 ms-1 fs-7 text-muted" data-bs-toggle="tooltip" title="Tata letak tata ruang dashboard bawaan (Theme v1 Sidebar vs Theme v2 Header Navbar).">
                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                    </i>
                </label>
                <div class="col-lg-9">
                    <div class="row g-4" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        @php
                            $currentThemeVersion = $settings['default_theme_version'] ?? 'v1';
                        @endphp

                        <!-- Theme v1 -->
                        <div class="col-md-6">
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 mb-0 w-100 {{ $currentThemeVersion === 'v1' ? 'active' : '' }}" data-kt-button="true">
                                <div class="d-flex align-items-center me-2">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                        <input class="form-check-input" type="radio" name="default_theme_version" value="v1" {{ $currentThemeVersion === 'v1' ? 'checked' : '' }} />
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block fs-6 text-gray-800">Theme v1 (Sidebar Classic)</span>
                                        <span class="text-muted fs-8">Navigasi Vertikal Metronic Demo 1</span>
                                    </div>
                                </div>
                                <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1">Demo 1</span>
                            </label>
                        </div>

                        <!-- Theme v2 -->
                        <div class="col-md-6">
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 mb-0 w-100 {{ $currentThemeVersion === 'v2' ? 'active' : '' }}" data-kt-button="true">
                                <div class="d-flex align-items-center me-2">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                        <input class="form-check-input" type="radio" name="default_theme_version" value="v2" {{ $currentThemeVersion === 'v2' ? 'checked' : '' }} />
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block fs-6 text-gray-800">Theme v2 (Header Navbar)</span>
                                        <span class="text-muted fs-8">Navigasi Horizontal Metronic Demo 2</span>
                                    </div>
                                </div>
                                <span class="badge badge-light-success fw-bold fs-8 px-2 py-1">Demo 2</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator separator-dashed my-6"></div>

            <!-- 1.4 Halaman Depan Default -->
            <div class="row mb-0">
                <label class="col-lg-3 col-form-label fw-bold fs-6 text-gray-800">
                    Halaman Depan Default
                    <i class="ki-duotone ki-information-5 ms-1 fs-7 text-muted" data-bs-toggle="tooltip" title="Landing page yang diakses pada rute root website ('/').">
                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                    </i>
                </label>
                <div class="col-lg-9">
                    <div class="row g-4" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        @php
                            $currentFrontpage = $settings['default_frontpage'] ?? 'landing';
                        @endphp

                        <!-- Landing Metronic -->
                        <div class="col-md-6">
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 mb-0 w-100 {{ $currentFrontpage === 'landing' ? 'active' : '' }}" data-kt-button="true">
                                <div class="d-flex align-items-center me-2">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                        <input class="form-check-input" type="radio" name="default_frontpage" value="landing" {{ $currentFrontpage === 'landing' ? 'checked' : '' }} />
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block fs-6 text-gray-800">Landing Page Corporate</span>
                                        <span class="text-muted fs-8">Metronic 8 SaaS & Marketing (/landing)</span>
                                    </div>
                                </div>
                                <i class="ki-duotone ki-rocket fs-2x text-primary"><span class="path1"></span><span class="path2"></span></i>
                            </label>
                        </div>

                        <!-- Education Portal -->
                        <div class="col-md-6">
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 mb-0 w-100 {{ $currentFrontpage === 'education' ? 'active' : '' }}" data-kt-button="true">
                                <div class="d-flex align-items-center me-2">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                        <input class="form-check-input" type="radio" name="default_frontpage" value="education" {{ $currentFrontpage === 'education' ? 'checked' : '' }} />
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-bold d-block fs-6 text-gray-800">Education Portal</span>
                                        <span class="text-muted fs-8">Portal Akademik & Pendidikan (/education)</span>
                                    </div>
                                </div>
                                <i class="ki-duotone ki-teacher fs-2x text-warning"><span class="path1"></span><span class="path2"></span></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Group 2: Keamanan & Akses -->
    <div class="card mb-5 mb-xl-10 shadow-sm border-0">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-gray-900">2. Keamanan & Kebijakan Akses</h3>
            </div>
            <div class="card-toolbar">
                <span class="badge badge-light-danger fw-semibold fs-8">Security</span>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="row mb-6">
                <label class="col-lg-3 col-form-label fw-semibold fs-6 text-gray-800">Pendaftaran Akun Publik</label>
                <div class="col-lg-9 d-flex align-items-center">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" name="enable_registration" value="1" {{ ($settings['enable_registration'] ?? '1') == '1' ? 'checked' : '' }} />
                        <span class="form-check-label fs-7 text-muted ms-2">Izinkan pengunjung publik membuat akun melalui halaman register.</span>
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <label class="col-lg-3 col-form-label fw-semibold fs-6 text-gray-800">Durasi Sesi Timeout</label>
                <div class="col-lg-9 fv-row d-flex align-items-center">
                    <input type="number" class="form-control form-control-solid w-150px me-3" name="session_lifetime" value="{{ $settings['session_lifetime'] ?? '120' }}" min="15" max="1440" />
                    <span class="text-muted fs-7">Menit (Otomatis logout saat tidak ada aktivitas).</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Group 3: Pemeliharaan & Quick Cache Tools -->
    <div class="card mb-5 mb-xl-10 shadow-sm border-0">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-gray-900">3. Pemeliharaan Sistem & Cache Tools</h3>
            </div>
            <div class="card-toolbar">
                <span class="badge badge-light-dark fw-semibold fs-8">Maintenance</span>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
                <div>
                    <h6 class="fw-bold text-gray-900 m-0">Pembersihan Cache Seketika</h6>
                    <span class="text-muted fs-7">Pilih kategori cache yang ingin dibersihkan secara instan dari server.</span>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2 ms-auto flex-shrink-0">
                    <button type="button" class="btn btn-sm btn-light-primary fw-bold btn-clear-cache-action" data-cache-type="view" data-bs-toggle="tooltip" title="Bersihkan Cache Blade View">
                        <i class="ki-duotone ki-element-plus fs-5 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                        <span class="d-none d-sm-inline">Clear Views</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-light-warning fw-bold btn-clear-cache-action" data-cache-type="route" data-bs-toggle="tooltip" title="Bersihkan Cache Routing">
                        <i class="ki-duotone ki-route fs-5 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                        <span class="d-none d-sm-inline">Clear Routes</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-light-success fw-bold btn-clear-cache-action" data-cache-type="config" data-bs-toggle="tooltip" title="Bersihkan Cache Konfigurasi">
                        <i class="ki-duotone ki-gear fs-5 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                        <span class="d-none d-sm-inline">Clear Config</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-light-danger fw-bold btn-clear-cache-action" data-cache-type="all" data-bs-toggle="tooltip" title="Bersihkan Semua Cache Sistem">
                        <i class="ki-duotone ki-arrows-circle fs-5 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                        <span class="d-none d-sm-inline">Clear All Cache</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Reset Action Bar -->
    <div class="d-flex align-items-center justify-content-end gap-3 pt-4">
        <button type="button" class="btn btn-light fw-bold" id="btn_reset_system_settings" onclick="document.getElementById('system_settings_form').reset()">
            Reset Formulir
        </button>
        <button type="submit" class="btn btn-primary fw-bold px-8" id="btn_save_system_settings">
            <i class="ki-duotone ki-check fs-4 me-1 text-white"><span class="path1"></span><span class="path2"></span></i> Simpan Pengaturan
        </button>
    </div>

</form>
