<div class="row g-6">
    <!--begin::Left Column: Meta Form-->
    <div class="col-xl-7">
        <div class="card card-flush shadow-sm border-0">
            <div class="card-header card-header-mobile-center border-0 pt-6">
                <div class="card-title d-flex flex-column flex-md-row align-items-center text-center text-md-start">
                    <div class="symbol symbol-45px symbol-md-35px symbol-circle bg-light-primary mb-2 mb-md-0 me-0 me-md-3 d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ki-outline ki-code text-primary fs-2 fs-md-3"></i>
                    </div>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <h3 class="fw-bold text-gray-900 m-0 fs-4">Formulir Identitas & Meta SEO Dashboard</h3>
                        <span class="text-muted fs-7 mt-1">Atur judul, deskripsi, kata kunci pencarian, dan informasi author aplikasi.</span>
                    </div>
                </div>
            </div>

            <div class="card-body pt-4">
                <form id="kt_form_app_meta" method="POST" action="{{ route('appsupport.app-profil.meta') }}">
                    @csrf

                    <!--begin::Input Group: App Name-->
                    <div class="mb-5">
                        <label class="form-label required fw-bold text-gray-800 fs-6">Nama Aplikasi / Dashboard</label>
                        <input type="text" class="form-control form-control-solid" id="input_app_name" name="app_name" value="{{ $settings['app_name'] ?? 'Veltronic Template' }}" required placeholder="Contoh: Veltronic Template" />
                        <div class="form-text">Nama utama sistem yang tampil pada header, sidebar, judul tab browser, dan meta title.</div>
                    </div>
                    <!--end::Input Group-->

                    <!--begin::Input Group: Tagline & Versi-->
                    <div class="row g-5 mb-5">
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-gray-800 fs-6">Tagline / Slogan Aplikasi</label>
                            <input type="text" class="form-control form-control-solid" id="input_app_tagline" name="app_tagline" value="{{ $settings['app_tagline'] ?? 'Modern Metronic 8.3.2 Admin Dashboard' }}" placeholder="Contoh: Modern Metronic 8.3.2 Admin Dashboard" />
                            <div class="form-text">Deskripsi singkat fungsi atau motto aplikasi.</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-gray-800 fs-6">Versi Aplikasi</label>
                            <input type="text" class="form-control form-control-solid" id="input_app_version" name="app_version" value="{{ $settings['app_version'] ?? 'v1.0.0' }}" placeholder="Contoh: v1.0.0" />
                            <div class="form-text">Kode rilis/versi dashboard.</div>
                        </div>
                    </div>
                    <!--end::Input Group-->

                    <!--begin::Input Group: Meta Description-->
                    <div class="mb-5">
                        <label class="form-label fw-bold text-gray-800 fs-6">Deskripsi Meta (SEO)</label>
                        <textarea class="form-control form-control-solid" id="input_meta_description" name="meta_description" rows="3" placeholder="Tuliskan deskripsi ringkas aplikasi untuk mesin pencari...">{{ $settings['meta_description'] ?? 'Sistem dashboard administrasi modern dengan Metronic 8.3.2 dan Laravel 12/13.' }}</textarea>
                        <div class="d-flex justify-content-between form-text">
                            <span>Direkomendasikan antara 120 - 160 karakter agar optimal di mesin pencari.</span>
                            <span id="char_count_meta_desc" class="fw-semibold text-primary">0 karakter</span>
                        </div>
                    </div>
                    <!--end::Input Group-->

                    <!--begin::Input Group: Meta Keywords-->
                    <div class="mb-5">
                        <label class="form-label fw-bold text-gray-800 fs-6">Kata Kunci Meta (Keywords)</label>
                        <input type="text" class="form-control form-control-solid" id="input_meta_keywords" name="meta_keywords" value="{{ $settings['meta_keywords'] ?? 'laravel, metronic, dashboard, veltronic, admin template, bootstrap 5' }}" placeholder="Pisahkan dengan koma (contoh: dashboard, admin, laravel)" />
                        <div class="form-text">Kata kunci penelusuran yang relevan dengan modul dan layanan dashboard.</div>
                    </div>
                    <!--end::Input Group-->

                    <!--begin::Input Group: Author & OG Site Name-->
                    <div class="row g-5 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-gray-800 fs-6">Meta Author / Pembuat</label>
                            <input type="text" class="form-control form-control-solid" id="input_meta_author" name="meta_author" value="{{ $settings['meta_author'] ?? 'Veltronic Team' }}" placeholder="Contoh: Veltronic Team" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-gray-800 fs-6">Open Graph Site Name</label>
                            <input type="text" class="form-control form-control-solid" id="input_og_site_name" name="og_site_name" value="{{ $settings['og_site_name'] ?? 'Veltronic' }}" placeholder="Contoh: Veltronic" />
                        </div>
                    </div>
                    <!--end::Input Group-->

                    <!--begin::Input Group: OG Title-->
                    <div class="mb-8">
                        <label class="form-label fw-bold text-gray-800 fs-6">Open Graph Title</label>
                        <input type="text" class="form-control form-control-solid" id="input_og_title" name="og_title" value="{{ $settings['og_title'] ?? 'Veltronic - Metronic 8.3.2 Admin Dashboard' }}" placeholder="Contoh: Veltronic - Metronic 8.3.2 Admin Dashboard" />
                        <div class="form-text">Judul yang muncul saat tautan dashboard dibagikan di media sosial (WhatsApp, Telegram, Facebook, Twitter).</div>
                    </div>
                    <!--end::Input Group-->

                    <!--begin::Form Actions-->
                    <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-2 gap-md-3 pt-4 border-top flex-wrap flex-md-nowrap">
                        <button type="reset" class="btn btn-light btn-sm fw-bold px-4 px-md-5"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Kembalikan nilai awal formulir">
                            <i class="ki-outline ki-arrows-circle fs-5 me-1"></i>
                            <span>Reset Nilai</span>
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold px-5 px-md-6" id="kt_btn_save_meta"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan perubahan identitas & SEO">
                            <span class="indicator-label">
                                <i class="ki-outline ki-check fs-4 me-1"></i>
                                <span>Simpan Data Meta</span>
                            </span>
                            <span class="indicator-progress">
                                <span>Menyimpan...</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Form Actions-->
                </form>
            </div>
        </div>
    </div>
    <!--end::Left Column-->

    <!--begin::Right Column: Live Preview Card-->
    <div class="col-xl-5">
        <!--begin::Google Search Preview-->
        <div class="card card-flush shadow-sm border-0 mb-6">
            <div class="card-header card-header-mobile-center border-0 pt-6">
                <div class="card-title d-flex flex-column flex-md-row align-items-center text-center text-md-start">
                    <div class="symbol symbol-45px symbol-md-35px symbol-circle bg-light-danger mb-2 mb-md-0 me-0 me-md-3 d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ki-outline ki-google text-danger fs-2 fs-md-3"></i>
                    </div>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <h3 class="fw-bold text-gray-900 m-0 fs-5">Simulasi Google Search Snippet</h3>
                        <span class="text-muted fs-8 mt-1">Pratinjau tampilan di hasil pencarian Google</span>
                    </div>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="google-preview-card">
                    <div class="google-preview-url">
                        <span class="symbol symbol-15px symbol-circle bg-light me-1">
                            <i class="ki-outline ki-abstract-26 text-primary fs-8"></i>
                        </span>
                        <span>{{ url('/') }}</span>
                        <span class="text-muted fs-8">› dashboard</span>
                    </div>
                    <div class="google-preview-title mt-1" id="preview_google_title">
                        {{ $settings['app_name'] ?? 'Veltronic Template' }} - Dashboard
                    </div>
                    <div class="google-preview-desc" id="preview_google_desc">
                        {{ $settings['meta_description'] ?? 'Sistem dashboard administrasi modern dengan Metronic 8.3.2 dan Laravel 12/13.' }}
                    </div>
                </div>
                <div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-md-row p-4 mt-4 mb-0">
                    <i class="ki-outline ki-information-5 fs-2 text-primary me-3 mb-2 mb-md-0"></i>
                    <div class="d-flex flex-column pe-0 pe-md-6">
                        <span class="fw-bold fs-7 text-primary">Info SEO</span>
                        <span class="text-gray-700 fs-8">Snippet ini disinkronkan secara realtime dengan field input di sebelah kiri saat Anda mengetik.</span>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Google Search Preview-->

        <!--begin::Social Card Preview-->
        <div class="card card-flush shadow-sm border-0">
            <div class="card-header card-header-mobile-center border-0 pt-6">
                <div class="card-title d-flex flex-column flex-md-row align-items-center text-center text-md-start">
                    <div class="symbol symbol-45px symbol-md-35px symbol-circle bg-light-info mb-2 mb-md-0 me-0 me-md-3 d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ki-outline ki-share text-info fs-2 fs-md-3"></i>
                    </div>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <h3 class="fw-bold text-gray-900 m-0 fs-5">Simulasi Open Graph Social Card</h3>
                        <span class="text-muted fs-8 mt-1">Pratinjau saat link dibagikan ke media sosial</span>
                    </div>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="social-preview-card">
                    <div class="social-preview-img">
                        <div class="text-center p-4">
                            <i class="ki-outline ki-element-11 fs-3x text-white opacity-75 mb-2"></i>
                            <h4 class="text-white fw-bold m-0" id="preview_og_badge_title">{{ $settings['app_name'] ?? 'Veltronic Template' }}</h4>
                            <span class="text-white opacity-75 fs-8" id="preview_og_badge_tagline">{{ $settings['app_tagline'] ?? 'Admin Dashboard' }}</span>
                        </div>
                    </div>
                    <div class="p-4 bg-body">
                        <div class="text-muted text-uppercase fs-9 fw-bolder mb-1" id="preview_og_domain">{{ request()->getHost() }}</div>
                        <div class="fw-bolder text-gray-900 fs-6 mb-1" id="preview_og_title">{{ $settings['og_title'] ?? ($settings['app_name'] ?? 'Veltronic') }}</div>
                        <div class="text-muted fs-7 line-clamp-2" id="preview_og_desc">{{ $settings['meta_description'] ?? 'Modern Admin Dashboard' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Social Card Preview-->
    </div>
    <!--end::Right Column-->
</div>
