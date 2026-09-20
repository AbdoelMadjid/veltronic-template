<!--begin::Tab Pane Hero & Branding-->
<div class="row g-6 g-xl-9">
    <!--begin::Col Form Hero-->
    <div class="col-xl-8">
        <!--begin::Card Hero Settings-->
        <form id="kt_form_landing_hero" class="form">
            @csrf
            <div class="card card-flush shadow-sm mb-6 border-0">
                <!--begin::Card header-->
                <div class="card-header pt-6 px-4 px-md-6 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                    <div class="card-title">
                        <i class="ki-outline ki-crown-2 text-primary fs-2 me-2"></i>
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Konten Hero Banner & Panggilan Aksi</h3>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-light-info btn-sm fw-bold btn-edit-section-code"
                                data-id="hero" data-name="Hero Banner & Navbar" data-custom="0">
                            <i class="ki-outline ki-code fs-4 me-1"></i> Edit Script Blade
                        </button>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-2 pb-6 px-4 px-md-6">
                    <!--begin::Row Badge & Title-->
                    <div class="row mb-5">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <label class="form-label fs-7 fw-bold text-gray-800">Badge Label Atas</label>
                            <input type="text" name="landing_hero_badge" class="form-control form-control-solid form-control-sm"
                                   placeholder="Contoh: Metronic 8 v8.3.2" value="{{ $config['landing_hero_badge'] ?? '' }}" />
                            <div class="text-muted fs-8 mt-1">Label kecil di atas judul hero</div>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fs-7 fw-bold text-gray-800 required">Judul Utama Hero</label>
                            <input type="text" name="landing_hero_title" class="form-control form-control-solid form-control-sm"
                                   placeholder="Contoh: Bangun Solusi yang Luar Biasa" value="{{ $config['landing_hero_title'] ?? '' }}" required />
                        </div>
                    </div>
                    <!--end::Row Badge & Title-->

                    <!--begin::Row Highlight & With-->
                    <div class="row mb-5">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <label class="form-label fs-7 fw-bold text-gray-800">Kata Penghubung</label>
                            <input type="text" name="landing_hero_with" class="form-control form-control-solid form-control-sm"
                                   placeholder="dengan" value="{{ $config['landing_hero_with'] ?? 'dengan' }}" />
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fs-7 fw-bold text-gray-800">Teks Gradien (Hero Highlight)</label>
                            <input type="text" name="landing_hero_highlight" class="form-control form-control-solid form-control-sm"
                                   placeholder="Contoh: Tema Terbaik Sepanjang Masa" value="{{ $config['landing_hero_highlight'] ?? '' }}" />
                            <div class="text-muted fs-8 mt-1">Teks ini akan ditampilkan dengan efek gradien warna menyala</div>
                        </div>
                    </div>
                    <!--end::Row Highlight & With-->

                    <div class="separator separator-dashed my-6"></div>

                    <!--begin::Row CTA Buttons-->
                    <h5 class="fw-bolder text-gray-800 mb-4 fs-6">
                        <i class="ki-outline ki-click text-primary fs-5 me-1"></i> Tombol Aksi (Call To Action)
                    </h5>
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label class="form-label fs-7 fw-bold text-gray-800 required">Teks Tombol Utama (Primary CTA)</label>
                            <input type="text" name="landing_hero_cta_text" class="form-control form-control-solid form-control-sm"
                                   placeholder="Coba Metronic" value="{{ $config['landing_hero_cta_text'] ?? 'Coba Metronic' }}" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-7 fw-bold text-gray-800 required">Tautan Tombol Utama (URL/Anchor)</label>
                            <input type="text" name="landing_hero_cta_url" class="form-control form-control-solid form-control-sm"
                                   placeholder="/#pricing atau /login" value="{{ $config['landing_hero_cta_url'] ?? '/#pricing' }}" required />
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label class="form-label fs-7 fw-bold text-gray-800">Teks Tombol Sekunder</label>
                            <input type="text" name="landing_hero_cta2_text" class="form-control form-control-solid form-control-sm"
                                   placeholder="Dokumentasi" value="{{ $config['landing_hero_cta2_text'] ?? '' }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-7 fw-bold text-gray-800">Tautan Tombol Sekunder</label>
                            <input type="text" name="landing_hero_cta2_url" class="form-control form-control-solid form-control-sm"
                                   placeholder="https://..." value="{{ $config['landing_hero_cta2_url'] ?? '' }}" />
                        </div>
                    </div>
                    <!--end::Row CTA Buttons-->

                    <div class="separator separator-dashed my-6"></div>

                    <!--begin::Row Meta & SEO-->
                    <h5 class="fw-bolder text-gray-800 mb-4 fs-6">
                        <i class="ki-outline ki-magnifier text-primary fs-5 me-1"></i> Pengaturan Meta & SEO Halaman
                    </h5>
                    <div class="mb-4">
                        <label class="form-label fs-7 fw-bold text-gray-800 required">Judul Halaman Web (Page Title)</label>
                        <input type="text" name="landing_page_title" class="form-control form-control-solid form-control-sm"
                               placeholder="Judul Landing Page..." value="{{ $config['landing_page_title'] ?? '' }}" required />
                    </div>

                    <div class="mb-4">
                        <label class="form-label fs-7 fw-bold text-gray-800">Meta Deskripsi</label>
                        <textarea name="landing_meta_description" rows="2" class="form-control form-control-solid form-control-sm"
                                  placeholder="Deskripsi ringkas untuk mesin pencari...">{{ $config['landing_meta_description'] ?? '' }}</textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fs-7 fw-bold text-gray-800">Meta Keywords</label>
                        <input type="text" name="landing_meta_keywords" class="form-control form-control-solid form-control-sm"
                               placeholder="metronic, template, dashboard, laravel" value="{{ $config['landing_meta_keywords'] ?? '' }}" />
                    </div>

                    <!--begin::Toggle Clients-->
                    <div class="d-flex align-items-center justify-content-between p-4 bg-light-subtle rounded-3 border border-gray-200">
                        <div class="d-flex flex-column pe-2">
                            <span class="fw-bold text-gray-800 fs-7">Tampilkan Logo Mitra & Klien di Hero</span>
                            <span class="text-muted fs-8">Tampilkan deretan logo brand di bawah tombol hero</span>
                        </div>
                        <div class="form-check form-switch form-check-custom form-check-solid flex-shrink-0">
                            <input class="form-check-input" type="checkbox" name="landing_show_clients" value="1" 
                                   {{ !empty($config['landing_show_clients']) ? 'checked' : '' }} />
                        </div>
                    </div>
                    <!--end::Toggle Clients-->
                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer d-flex justify-content-center justify-content-sm-end py-4 px-4 px-md-6 border-0">
                    <button type="submit" class="btn btn-primary btn-sm fw-bold px-6" id="kt_btn_save_hero">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-4 me-1"></i> Simpan Pengaturan Hero
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span> Menyimpan...
                        </span>
                    </button>
                </div>
                <!--end::Card footer-->
            </div>
        </form>
        <!--end::Card Hero Settings-->
    </div>
    <!--end::Col Form Hero-->

    <!--begin::Col Logo Assets-->
    <div class="col-xl-4">
        <!--begin::Card Logo-->
        <form id="kt_form_landing_logos" class="form" enctype="multipart/form-data">
            @csrf
            <div class="card card-flush shadow-sm mb-6 border-0">
                <div class="card-header pt-6 px-4 px-md-6 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                    <div class="card-title">
                        <i class="ki-outline ki-picture text-primary fs-2 me-2"></i>
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Logo & Favicon Landing</h3>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-icon btn-light-warning btn-sm" id="kt_btn_reset_landing_logos" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Reset Logo ke Default">
                            <i class="ki-outline ki-arrows-loop fs-5"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body pt-2 pb-6 px-4 px-md-6">
                    <!--begin::Logo Light Header-->
                    <div class="mb-6">
                        <label class="form-label fs-7 fw-bold text-gray-800">Logo Header Transparan / Terang</label>
                        <div class="d-flex align-items-center justify-content-center p-3 rounded-3 mb-2 bg-dark" style="min-height: 70px;">
                            <img src="{{ Str::startsWith($config['landing_logo_light'] ?? '', 'http') || Str::startsWith($config['landing_logo_light'] ?? '', 'assets/') ? asset($config['landing_logo_light']) : \App\Support\ThemeAsset::url($config['landing_logo_light'] ?? 'media/logos/landing.svg') }}"
                                 alt="Logo Light" id="preview_landing_logo_light" class="mh-35px" />
                        </div>
                        <input type="file" name="landing_logo_light_file" class="form-control form-control-solid form-control-sm mb-2" accept=".svg,.png,.jpg,.jpeg,.webp" />
                        <input type="text" name="landing_logo_light_url" class="form-control form-control-solid form-control-sm" placeholder="Atau URL logo (misal: media/logos/landing.svg)" value="{{ $config['landing_logo_light'] ?? '' }}" />
                    </div>
                    <!--end::Logo Light Header-->

                    <!--begin::Logo Dark / Sticky Header-->
                    <div class="mb-6">
                        <label class="form-label fs-7 fw-bold text-gray-800">Logo Sticky Header (Dark)</label>
                        <div class="d-flex align-items-center justify-content-center p-3 rounded-3 mb-2 bg-light border border-gray-200" style="min-height: 70px;">
                            <img src="{{ Str::startsWith($config['landing_logo_dark'] ?? '', 'http') || Str::startsWith($config['landing_logo_dark'] ?? '', 'assets/') ? asset($config['landing_logo_dark']) : \App\Support\ThemeAsset::url($config['landing_logo_dark'] ?? 'media/logos/landing-dark.svg') }}"
                                 alt="Logo Dark" id="preview_landing_logo_dark" class="mh-35px" />
                        </div>
                        <input type="file" name="landing_logo_dark_file" class="form-control form-control-solid form-control-sm mb-2" accept=".svg,.png,.jpg,.jpeg,.webp" />
                        <input type="text" name="landing_logo_dark_url" class="form-control form-control-solid form-control-sm" placeholder="Atau URL logo sticky" value="{{ $config['landing_logo_dark'] ?? '' }}" />
                    </div>
                    <!--end::Logo Dark / Sticky Header-->

                    <!--begin::Favicon-->
                    <div class="mb-4">
                        <label class="form-label fs-7 fw-bold text-gray-800">Favicon Landing</label>
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="w-45px h-45px rounded-3 border border-gray-300 d-flex align-items-center justify-content-center bg-body flex-shrink-0">
                                <img src="{{ Str::startsWith($config['landing_favicon'] ?? '', 'http') || Str::startsWith($config['landing_favicon'] ?? '', 'assets/') ? asset($config['landing_favicon']) : \App\Support\ThemeAsset::url($config['landing_favicon'] ?? 'media/logos/favicon.ico') }}"
                                     alt="Favicon" id="preview_landing_favicon" class="w-25px h-25px" />
                            </div>
                            <input type="file" name="landing_favicon_file" class="form-control form-control-solid form-control-sm" accept=".ico,.png,.svg" />
                        </div>
                    </div>
                    <!--end::Favicon-->
                </div>

                <div class="card-footer d-flex justify-content-center justify-content-sm-end py-4 px-4 px-md-6 border-0">
                    <button type="submit" class="btn btn-primary btn-sm fw-bold px-6" id="kt_btn_save_logos">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-4 me-1"></i> Upload & Simpan Logo
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span> Mengunggah...
                        </span>
                    </button>
                </div>
            </div>
        </form>
        <!--end::Card Logo-->
    </div>
    <!--end::Col Logo Assets-->
</div>
<!--end::Tab Pane Hero & Branding-->
