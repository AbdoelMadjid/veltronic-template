<form id="system_settings_form" class="form">

    <div class="row g-6 mb-6">

        <!-- ======================================================== -->
        <!-- KOLOM KIRI: PREFERENSI DEFAULT TAMPILAN & ANTARMUKA     -->
        <!-- ======================================================== -->
        <div class="col-lg-6">
            <div class="card shadow-sm border border-gray-200 h-100 d-flex flex-column justify-content-between">
                <!--begin::Card header-->
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
                    <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Preferensi Default Tampilan & Antarmuka</h3>
                        <span class="text-muted fs-7 mt-1">Konfigurasi visual, ikonografi, translasi, serta tata letak awal</span>
                    </div>
                    <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                        <span class="badge badge-light-primary fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                            Tampilan
                        </span>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-6 px-4 px-md-6 flex-grow-1">

                    <!-- 1.1 Gaya Icon Default -->
                    <div class="mb-7">
                        <label class="form-label fw-bold fs-7 text-gray-800 mb-2 d-flex align-items-center justify-content-between">
                            <span>
                                Gaya Ikon Bawaan
                                <i class="ki-outline ki-information-5 ms-1 fs-7 text-muted" data-bs-toggle="tooltip" title="Gaya ikon default saat pengguna pertama kali membuka website."></i>
                            </span>
                            <span class="text-muted fs-9">Varian Ikon</span>
                        </label>

                        @php
                            $currentIconStyle = $settings['default_icon_style'] ?? \App\Models\AppSupport\AppSetting::get('default_icon_style', 'duotone');
                        @endphp

                        <div class="row g-3" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]" data-kt-icon-preview="true">
                            <!-- Duotone -->
                            <div class="col-4">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-column align-items-center text-center p-3 w-100 h-100 {{ $currentIconStyle === 'duotone' ? 'active' : '' }}" data-kt-button="true">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary d-none">
                                        <input class="form-check-input" type="radio" name="default_icon_style" value="duotone" {{ $currentIconStyle === 'duotone' ? 'checked' : '' }} />
                                    </div>
                                    <i class="ki-duotone ki-chart-simple fs-2x text-primary mb-2" data-kt-icon-style-ignore="true"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    <span class="fw-bold fs-7 text-gray-900 d-block">Duotone</span>
                                    <span class="text-muted fs-10">Dua Nada (SVG)</span>
                                </label>
                            </div>

                            <!-- Solid -->
                            <div class="col-4">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-column align-items-center text-center p-3 w-100 h-100 {{ $currentIconStyle === 'solid' ? 'active' : '' }}" data-kt-button="true">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary d-none">
                                        <input class="form-check-input" type="radio" name="default_icon_style" value="solid" {{ $currentIconStyle === 'solid' ? 'checked' : '' }} />
                                    </div>
                                    <i class="ki-solid ki-chart-simple fs-2x text-success mb-2" data-kt-icon-style-ignore="true"></i>
                                    <span class="fw-bold fs-7 text-gray-900 d-block">Solid</span>
                                    <span class="text-muted fs-10">Penuh Tebal</span>
                                </label>
                            </div>

                            <!-- Outline -->
                            <div class="col-4">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-column align-items-center text-center p-3 w-100 h-100 {{ $currentIconStyle === 'outline' ? 'active' : '' }}" data-kt-button="true">
                                    <div class="form-check form-check-custom form-check-solid form-check-primary d-none">
                                        <input class="form-check-input" type="radio" name="default_icon_style" value="outline" {{ $currentIconStyle === 'outline' ? 'checked' : '' }} />
                                    </div>
                                    <i class="ki-outline ki-chart-simple fs-2x text-info mb-2" data-kt-icon-style-ignore="true"></i>
                                    <span class="fw-bold fs-7 text-gray-900 d-block">Outline</span>
                                    <span class="text-muted fs-10">Garis Minimalis</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-5"></div>

                    <!-- 1.2 Bahasa Default -->
                    <div class="mb-7">
                        <label class="form-label fw-bold fs-7 text-gray-800 mb-2 d-flex align-items-center justify-content-between">
                            <span>
                                Bahasa Bawaan
                                <i class="ki-outline ki-information-5 ms-1 fs-7 text-muted" data-bs-toggle="tooltip" title="Bahasa pengantar awal saat pengguna belum memilih preferensi bahasa."></i>
                            </span>
                            <span class="text-muted fs-9">Pengaturan Bahasa</span>
                        </label>

                        @php
                            $currentLang = $settings['default_language'] ?? \App\Models\AppSupport\AppSetting::get('default_language', 'id');
                        @endphp

                        <div class="row g-3" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                            <!-- Bahasa Indonesia -->
                            <div class="col-12 col-sm-6">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex align-items-center justify-content-between p-3 w-100 {{ $currentLang === 'id' ? 'active' : '' }}" data-kt-button="true">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-2">
                                            <input class="form-check-input" type="radio" name="default_language" value="id" {{ $currentLang === 'id' ? 'checked' : '' }} />
                                        </div>
                                        <div class="text-start">
                                            <span class="fw-bold d-block fs-7 text-gray-900">Indonesia</span>
                                            <span class="text-muted fs-10">Standar Nasional (ID)</span>
                                        </div>
                                    </div>
                                    <img src="{{ asset('assets/media/flags/indonesia.svg') }}" class="w-25px h-25px rounded-1 shadow-xs" alt="Bendera Indonesia" />
                                </label>
                            </div>

                            <!-- English -->
                            <div class="col-12 col-sm-6">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex align-items-center justify-content-between p-3 w-100 {{ $currentLang === 'en' ? 'active' : '' }}" data-kt-button="true">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-2">
                                            <input class="form-check-input" type="radio" name="default_language" value="en" {{ $currentLang === 'en' ? 'checked' : '' }} />
                                        </div>
                                        <div class="text-start">
                                            <span class="fw-bold d-block fs-7 text-gray-900">Inggris (English)</span>
                                            <span class="text-muted fs-10">Internasional (EN)</span>
                                        </div>
                                    </div>
                                    <img src="{{ asset('assets/media/flags/united-states.svg') }}" class="w-25px h-25px rounded-1 shadow-xs" alt="Bendera Inggris" />
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-5"></div>

                    <!-- 1.3 Versi Tema Default -->
                    <div class="mb-7">
                        <label class="form-label fw-bold fs-7 text-gray-800 mb-2 d-flex align-items-center justify-content-between">
                            <span>
                                Versi Tata Letak Bawaan
                                <i class="ki-outline ki-information-5 ms-1 fs-7 text-muted" data-bs-toggle="tooltip" title="Tata letak tata ruang dashboard bawaan (Menu Samping vs Menu Atas)."></i>
                            </span>
                            <span class="text-muted fs-9">Varian Tata Letak</span>
                        </label>

                        @php
                            $currentThemeVersion = $settings['default_theme_version'] ?? \App\Models\AppSupport\AppSetting::get('default_theme_version', 'v1');
                        @endphp

                        <div class="row g-3" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                            <!-- Theme v1 -->
                            <div class="col-12 col-sm-6">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex align-items-center justify-content-between p-3 w-100 {{ $currentThemeVersion === 'v1' ? 'active' : '' }}" data-kt-button="true">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-2">
                                            <input class="form-check-input" type="radio" name="default_theme_version" value="v1" {{ $currentThemeVersion === 'v1' ? 'checked' : '' }} />
                                        </div>
                                        <div class="text-start">
                                            <span class="fw-bold d-block fs-7 text-gray-900">Tema V1 (Menu Samping)</span>
                                            <span class="text-muted fs-10">Navigasi Vertikal</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-light-primary fw-bold fs-9 px-2 py-1">V1</span>
                                </label>
                            </div>

                            <!-- Theme v2 -->
                            <div class="col-12 col-sm-6">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex align-items-center justify-content-between p-3 w-100 {{ $currentThemeVersion === 'v2' ? 'active' : '' }}" data-kt-button="true">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-2">
                                            <input class="form-check-input" type="radio" name="default_theme_version" value="v2" {{ $currentThemeVersion === 'v2' ? 'checked' : '' }} />
                                        </div>
                                        <div class="text-start">
                                            <span class="fw-bold d-block fs-7 text-gray-900">Tema V2 (Menu Atas)</span>
                                            <span class="text-muted fs-10">Navigasi Horizontal</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-light-success fw-bold fs-9 px-2 py-1">V2</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-5"></div>

                    <!-- 1.4 Halaman Depan Default -->
                    <div class="mb-0">
                        <label class="form-label fw-bold fs-7 text-gray-800 mb-2 d-flex align-items-center justify-content-between">
                            <span>
                                Halaman Depan Bawaan
                                <i class="ki-outline ki-information-5 ms-1 fs-7 text-muted" data-bs-toggle="tooltip" title="Halaman awal yang diakses pada rute beranda website ('/')."></i>
                            </span>
                            <span class="text-muted fs-9">Tujuan Beranda</span>
                        </label>

                        @php
                            $currentFrontpage = $settings['default_frontpage'] ?? \App\Models\AppSupport\AppSetting::get('default_frontpage', 'landing');
                        @endphp

                        <div class="row g-3" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                            <!-- Landing Metronic -->
                            <div class="col-12 col-sm-6">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex align-items-center justify-content-between p-3 w-100 {{ $currentFrontpage === 'landing' ? 'active' : '' }}" data-kt-button="true">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-2">
                                            <input class="form-check-input" type="radio" name="default_frontpage" value="landing" {{ $currentFrontpage === 'landing' ? 'checked' : '' }} />
                                        </div>
                                        <div class="text-start">
                                            <span class="fw-bold d-block fs-7 text-gray-900">Halaman Utama Perusahaan</span>
                                            <span class="text-muted fs-10">Promosi & Layanan (/landing)</span>
                                        </div>
                                    </div>
                                    <i class="ki-outline ki-rocket fs-3 text-primary"></i>
                                </label>
                            </div>

                            <!-- Education Portal -->
                            <div class="col-12 col-sm-6">
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex align-items-center justify-content-between p-3 w-100 {{ $currentFrontpage === 'education' ? 'active' : '' }}" data-kt-button="true">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-custom form-check-solid form-check-primary me-2">
                                            <input class="form-check-input" type="radio" name="default_frontpage" value="education" {{ $currentFrontpage === 'education' ? 'checked' : '' }} />
                                        </div>
                                        <div class="text-start">
                                            <span class="fw-bold d-block fs-7 text-gray-900">Portal Pendidikan</span>
                                            <span class="text-muted fs-10">Portal Edukasi (/education)</span>
                                        </div>
                                    </div>
                                    <i class="ki-outline ki-teacher fs-3 text-warning"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer py-4 px-4 px-md-6 mt-auto">
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between text-center text-sm-start gap-2">
                        <div class="d-flex align-items-center gap-2 text-muted fs-7">
                            <i class="ki-outline ki-information-2 fs-5 text-primary"></i>
                            <span>4 preferensi tampilan antarmuka terkonfigurasi</span>
                        </div>
                        <span class="badge badge-light-primary fw-semibold fs-8">UI / UX Preferences</span>
                    </div>
                </div>
                <!--end::Card footer-->
            </div>
        </div>
        <!-- ======================================================== -->
        <!-- END KOLOM KIRI                                           -->
        <!-- ======================================================== -->


        <!-- ======================================================== -->
        <!-- KOLOM KANAN: KEAMANAN & PEMELIHARAAN CACHE TOOLS         -->
        <!-- ======================================================== -->
        <div class="col-lg-6 d-flex flex-column gap-6">

            <!-- Card: Keamanan & Kebijakan Akses -->
            <div class="card shadow-sm border border-gray-200">
                <!--begin::Card header-->
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
                    <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Keamanan & Kebijakan Akses</h3>
                        <span class="text-muted fs-7 mt-1">Proteksi sesi otentikasi dan registrasi publik</span>
                    </div>
                    <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                        <span class="badge badge-light-danger fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                            Keamanan
                        </span>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-6 px-4 px-md-6">

                    <!-- Pendaftaran Akun Publik -->
                    <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded-3 border mb-5">
                        <div class="d-flex flex-column me-3">
                            <span class="fs-7 fw-bold text-gray-900">Pendaftaran Akun Publik</span>
                            <span class="fs-9 text-muted mt-1">Izinkan pengunjung umum membuat akun baru melalui halaman pendaftaran.</span>
                        </div>
                        <div class="form-check form-switch form-check-custom form-check-solid flex-shrink-0">
                            <input class="form-check-input h-20px w-35px cursor-pointer" type="checkbox" name="enable_registration" value="1" {{ ($settings['enable_registration'] ?? '1') == '1' ? 'checked' : '' }} />
                        </div>
                    </div>

                    <!-- Durasi Sesi Timeout -->
                    <div class="p-4 bg-light rounded-3 border">
                        <label class="fs-7 fw-bold text-gray-900 d-block mb-1">Batas Waktu Sesi (Kunci Layar)</label>
                        <span class="fs-9 text-muted d-block mb-3">Waktu jeda pengguna sebelum sistem mengunci layar otomatis (menit).</span>
                        <div class="d-flex align-items-center gap-3">
                            <div class="input-group input-group-sm w-150px">
                                <input type="number" class="form-control form-control-solid fw-bold text-center" name="session_lifetime" value="{{ $settings['session_lifetime'] ?? '120' }}" min="1" max="1440" />
                                <span class="input-group-text bg-body text-gray-700 fw-semibold">Menit</span>
                            </div>
                            <span class="fs-9 text-muted">(Bawaan: 120 Menit / 2 Jam)</span>
                        </div>
                    </div>

                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer py-4 px-4 px-md-6">
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between text-center text-sm-start gap-2">
                        <div class="d-flex align-items-center gap-2 text-muted fs-7">
                            <i class="ki-outline ki-shield-search fs-5 text-danger"></i>
                            <span>Kebijakan autentikasi & batas sesi aktif</span>
                        </div>
                        <span class="badge badge-light-danger fw-semibold fs-8">Security & Session</span>
                    </div>
                </div>
                <!--end::Card footer-->
            </div>

            <!-- Card: Pemeliharaan Sistem & Cache Tools -->
            <div class="card shadow-sm border border-gray-200 flex-grow-1 d-flex flex-column justify-content-between">
                <!--begin::Card header-->
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
                    <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Pemeliharaan Sistem & Alat Cache</h3>
                        <span class="text-muted fs-7 mt-1">Pembersihan memori cache dan optimasi server seketika</span>
                    </div>
                    <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                        <span class="badge badge-light-warning fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                            Pemeliharaan
                        </span>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-6 px-4 px-md-6 flex-grow-1">
                    <p class="fs-8 text-muted mb-4">
                        Pilih jenis cache yang ingin dibersihkan secara instan untuk memperbarui template, routing, dan konfigurasi tanpa merestart web server:
                    </p>

                    <div class="row g-3">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-sm w-100 p-3 text-start btn-clear-cache-action" data-cache-type="view" data-bs-toggle="tooltip" title="Membersihkan compiled Blade template view">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="ki-outline ki-element-plus fs-4 text-primary"></i>
                                    <span class="fw-bold fs-7 text-gray-900">Bersihkan Tampilan</span>
                                </div>
                                <span class="text-muted fs-10 d-block">Cache Blade UI</span>
                            </button>
                        </div>

                        <div class="col-6">
                            <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-info btn-sm w-100 p-3 text-start btn-clear-cache-action" data-cache-type="route" data-bs-toggle="tooltip" title="Membersihkan route cache list aplikasi">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="ki-outline ki-route fs-4 text-info"></i>
                                    <span class="fw-bold fs-7 text-gray-900">Bersihkan Rute</span>
                                </div>
                                <span class="text-muted fs-10 d-block">Daftar Rute URL</span>
                            </button>
                        </div>

                        <div class="col-6">
                            <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-success btn-sm w-100 p-3 text-start btn-clear-cache-action" data-cache-type="config" data-bs-toggle="tooltip" title="Membersihkan cache konfigurasi config/">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="ki-outline ki-setting-2 fs-4 text-success"></i>
                                    <span class="fw-bold fs-7 text-gray-900">Bersihkan Konfigurasi</span>
                                </div>
                                <span class="text-muted fs-10 d-block">Konfigurasi Sistem</span>
                            </button>
                        </div>

                        <div class="col-6">
                            <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-sm w-100 p-3 text-start btn-clear-cache-action" data-cache-type="all" data-bs-toggle="tooltip" title="Membersihkan seluruh cache aplikasi sekaligus">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="ki-outline ki-trash fs-4 text-danger"></i>
                                    <span class="fw-bold fs-7 text-gray-900">Bersihkan Semua Cache</span>
                                </div>
                                <span class="text-muted fs-10 d-block">Semua Cache Server</span>
                            </button>
                        </div>
                    </div>

                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer py-4 px-4 px-md-6 mt-auto">
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between text-center text-sm-start gap-2">
                        <div class="d-flex align-items-center gap-2 text-muted fs-7">
                            <i class="ki-outline ki-wrench fs-5 text-warning"></i>
                            <span>4 alat utilitas cache sistem siap dieksekusi</span>
                        </div>
                        <span class="badge badge-light-warning fw-semibold fs-8">Cache Tools</span>
                    </div>
                </div>
                <!--end::Card footer-->
            </div>

        </div>
        <!-- ======================================================== -->
        <!-- END KOLOM KANAN                                          -->
        <!-- ======================================================== -->

    </div>

    <!-- Save & Reset Action Bar (Bottom Bar) -->
    <div class="card shadow-sm border border-gray-200">
        <div class="card-body py-4 px-4 px-md-6">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between text-center text-sm-start gap-3">
                <div class="d-flex align-items-center justify-content-center gap-2 text-gray-700 fs-7">
                    <i class="ki-outline ki-shield-tick text-success fs-3"></i>
                    <span>Perubahan pengaturan akan langsung diterapkan persisten ke basis data.</span>
                </div>
                <div class="d-flex align-items-center justify-content-center justify-content-sm-end gap-3 w-100 w-sm-auto">
                    <button type="button" class="btn btn-light btn-sm fw-bold px-4 h-38px d-inline-flex align-items-center justify-content-center" id="btn_reset_system_settings" onclick="document.getElementById('system_settings_form').reset()">
                        <i class="ki-outline ki-arrows-circle fs-5 me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm fw-bold px-6 h-38px d-inline-flex align-items-center justify-content-center" id="btn_save_system_settings">
                        <i class="ki-outline ki-check fs-4 me-1 text-white"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>
