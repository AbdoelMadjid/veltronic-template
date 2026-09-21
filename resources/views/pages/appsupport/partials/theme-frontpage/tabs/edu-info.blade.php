<!--begin::Tab Pane Education Info & Identitas-->
<div class="row g-6 g-xl-9">
    <!--begin::Col Form Info & Branding-->
    <div class="col-xl-8">
        <!--begin::Card Info Settings-->
        <form id="kt_form_edu_info" class="form">
            @csrf
            <div class="card shadow-sm mb-6">
                <!--begin::Card header-->
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
                    <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Identitas & Informasi Umum Portal</h3>
                        <span class="text-muted fs-7 mt-1">Kelola nama institusi, tagline, deskripsi umum, dan panggilan aksi portal akademik</span>
                    </div>
                    <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                        <span class="badge badge-light-warning fw-bold fs-8 px-3 py-2">
                            {{ $educationConfig['education_badge'] ?? 'Unify v2.6' }}
                        </span>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-6 px-4 px-md-6">
                    <!--begin::Row Title & Tagline-->
                    <div class="row mb-5">
                        <div class="col-md-7 mb-4 mb-md-0">
                            <label class="form-label fs-7 fw-bold text-gray-800 required">Nama Portal / Universitas</label>
                            <input type="text" name="education_portal_title" class="form-control form-control-solid form-control-sm"
                                   placeholder="Contoh: Unify University - Higher Education Portal" value="{{ $educationConfig['education_portal_title'] ?? '' }}" required />
                            <div class="text-muted fs-8 mt-1">Nama resmi institusi yang tampil pada judul halaman & header</div>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fs-7 fw-bold text-gray-800">Badge Label Tema</label>
                            <input type="text" name="education_badge" class="form-control form-control-solid form-control-sm"
                                   placeholder="Contoh: Unify v2.6 Multipage" value="{{ $educationConfig['education_badge'] ?? 'Unify v2.6 Multipage' }}" />
                        </div>
                    </div>
                    <!--end::Row Title & Tagline-->

                    <!--begin::Row Tagline-->
                    <div class="mb-5">
                        <label class="form-label fs-7 fw-bold text-gray-800">Slogan / Tagline Institusi</label>
                        <input type="text" name="education_portal_tagline" class="form-control form-control-solid form-control-sm"
                               placeholder="Contoh: Empowering Minds, Shaping the Future of Excellence" value="{{ $educationConfig['education_portal_tagline'] ?? '' }}" />
                    </div>
                    <!--end::Row Tagline-->

                    <!--begin::Row Description-->
                    <div class="mb-5">
                        <label class="form-label fs-7 fw-bold text-gray-800">Deskripsi Singkat Portal (Meta & Ringkasan)</label>
                        <textarea name="education_portal_description" class="form-control form-control-solid form-control-sm" rows="3"
                                  placeholder="Deskripsi singkat mengenai portal pendidikan...">{{ $educationConfig['education_portal_description'] ?? '' }}</textarea>
                    </div>
                    <!--end::Row Description-->

                    <div class="separator separator-dashed my-6"></div>

                    <!--begin::Row Hero Banner Info-->
                    <h5 class="fw-bolder text-gray-800 mb-4 fs-6">
                        Konten Banner Depan (Hero Carousel)
                    </h5>
                    <div class="row mb-5">
                        <div class="col-md-12 mb-4">
                            <label class="form-label fs-7 fw-bold text-gray-800">Judul Utama Banner Beranda</label>
                            <input type="text" name="education_hero_title" class="form-control form-control-solid form-control-sm"
                                   placeholder="Contoh: Find Your Future at Unify University" value="{{ $educationConfig['education_hero_title'] ?? '' }}" />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fs-7 fw-bold text-gray-800">Sub-judul / Penjelasan Banner</label>
                            <input type="text" name="education_hero_subtitle" class="form-control form-control-solid form-control-sm"
                                   placeholder="Penjelasan singkat banner..." value="{{ $educationConfig['education_hero_subtitle'] ?? '' }}" />
                        </div>
                    </div>
                    <!--end::Row Hero Banner Info-->

                    <div class="separator separator-dashed my-6"></div>

                    <!--begin::Row CTA Action-->
                    <h5 class="fw-bolder text-gray-800 mb-4 fs-6">
                        Tombol Aksi Utama (Hero CTA)
                    </h5>
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label class="form-label fs-7 fw-bold text-gray-800 required">Teks Tombol Aksi</label>
                            <input type="text" name="education_hero_cta_text" class="form-control form-control-solid form-control-sm mb-2"
                                   placeholder="Contoh: Explore All Programs" value="{{ $educationConfig['education_hero_cta_text'] ?? '' }}" required />
                            <label class="form-label fs-8 text-muted">URL / Link Tombol</label>
                            <input type="text" name="education_hero_cta_url" class="form-control form-control-solid form-control-sm"
                                   placeholder="Contoh: /education/courses" value="{{ $educationConfig['education_hero_cta_url'] ?? '/education/courses' }}" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-7 fw-bold text-gray-800">Teks Tombol Sekunder</label>
                            <input type="text" name="education_hero_cta2_text" class="form-control form-control-solid form-control-sm mb-2"
                                   placeholder="Contoh: Virtual Campus Tour" value="{{ $educationConfig['education_hero_cta2_text'] ?? '' }}" />
                            <label class="form-label fs-8 text-muted">URL / Link Tombol</label>
                            <input type="text" name="education_hero_cta2_url" class="form-control form-control-solid form-control-sm"
                                   placeholder="Contoh: /education/about" value="{{ $educationConfig['education_hero_cta2_url'] ?? '/education/about' }}" />
                        </div>
                    </div>
                    <!--end::Row CTA Action-->

                    <div class="separator separator-dashed my-6"></div>

                    <!--begin::Row Meta Keywords-->
                    <h5 class="fw-bolder text-gray-800 mb-4 fs-6">
                        Pengaturan Meta & SEO Halaman
                    </h5>
                    <div class="mb-2">
                        <label class="form-label fs-7 fw-bold text-gray-800">Kata Kunci Meta (Keywords)</label>
                        <input type="text" name="education_meta_keywords" class="form-control form-control-solid form-control-sm"
                               placeholder="education, university, academic, campus..." value="{{ $educationConfig['education_meta_keywords'] ?? '' }}" />
                        <div class="text-muted fs-8 mt-1">Pisahkan dengan tanda koma untuk kata kunci SEO portal pendidikan</div>
                    </div>
                    <!--end::Row Meta Keywords-->
                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer d-flex justify-content-center justify-content-sm-end py-4 px-4 px-md-6">
                    <button type="submit" class="btn btn-warning text-white btn-sm fw-bold" id="kt_btn_save_edu_info">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-4 me-1 text-white"></i> Simpan Informasi Portal
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span> Menyimpan...
                        </span>
                    </button>
                </div>
                <!--end::Card footer-->
            </div>
        </form>
        <!--end::Card Info Settings-->
    </div>
    <!--end::Col Form Info & Branding-->

    <!--begin::Col Logo Assets-->
    <div class="col-xl-4">
        <!--begin::Card Logo Settings-->
        <form id="kt_form_edu_logos" class="form" enctype="multipart/form-data">
            @csrf
            <div class="card shadow-sm mb-6">
                <!--begin::Card header-->
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
                    <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Aset Logo & Favicon</h3>
                        <span class="text-muted fs-7 mt-1">Identitas visual portal pendidikan (Logo utama, logo gelap, favicon)</span>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-6 px-4 px-md-6">
                    <!--begin::Logo Light-->
                    <div class="mb-5">
                        <label class="form-label fs-7 fw-bold text-gray-800 mb-2">Logo Utama (Header Navbar)</label>
                        <div class="d-flex align-items-center gap-3 p-3 bg-light-subtle rounded-3 border border-gray-200 mb-2">
                            <div class="symbol symbol-50px symbol-2by1 bg-white p-2 border rounded d-flex align-items-center justify-content-center">
                                <img src="{{ asset($educationConfig['education_logo_light'] ?? 'assets/img/logo/logo.png') }}" 
                                     id="img_preview_edu_logo_light" alt="Logo Light" style="max-height: 35px; max-width: 100%; object-fit: contain;" />
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="text-gray-800 fw-bold fs-8 text-truncate">{{ basename($educationConfig['education_logo_light'] ?? 'logo.png') }}</div>
                                <span class="text-muted fs-9">Format: PNG, SVG, WEBP</span>
                            </div>
                        </div>
                        <input type="file" name="education_logo_light_file" class="form-control form-control-solid form-control-sm mb-1" accept="image/*" />
                        <input type="text" name="education_logo_light_url" class="form-control form-control-solid form-control-sm"
                               placeholder="Atau URL aset..." value="{{ $educationConfig['education_logo_light'] ?? '' }}" />
                    </div>
                    <!--end::Logo Light-->

                    <div class="separator separator-dashed my-5"></div>

                    <!--begin::Logo Mini / Dark-->
                    <div class="mb-5">
                        <label class="form-label fs-7 fw-bold text-gray-800 mb-2">Logo Mini / Mobile</label>
                        <div class="d-flex align-items-center gap-3 p-3 bg-light-subtle rounded-3 border border-gray-200 mb-2">
                            <div class="symbol symbol-45px bg-white p-2 border rounded d-flex align-items-center justify-content-center">
                                <img src="{{ asset($educationConfig['education_logo_dark'] ?? 'assets/img/logo/logo-mini.png') }}" 
                                     id="img_preview_edu_logo_dark" alt="Logo Mini" style="max-height: 30px; max-width: 100%; object-fit: contain;" />
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="text-gray-800 fw-bold fs-8 text-truncate">{{ basename($educationConfig['education_logo_dark'] ?? 'logo-mini.png') }}</div>
                                <span class="text-muted fs-9">Format: PNG, SVG, WEBP</span>
                            </div>
                        </div>
                        <input type="file" name="education_logo_dark_file" class="form-control form-control-solid form-control-sm mb-1" accept="image/*" />
                        <input type="text" name="education_logo_dark_url" class="form-control form-control-solid form-control-sm"
                               placeholder="Atau URL aset..." value="{{ $educationConfig['education_logo_dark'] ?? '' }}" />
                    </div>
                    <!--end::Logo Mini / Dark-->

                    <div class="separator separator-dashed my-5"></div>

                    <!--begin::Favicon-->
                    <div class="mb-4">
                        <label class="form-label fs-7 fw-bold text-gray-800 mb-2">Favicon Tab Browser</label>
                        <div class="d-flex align-items-center gap-3 p-3 bg-light-subtle rounded-3 border border-gray-200 mb-2">
                            <div class="symbol symbol-35px bg-white p-1 border rounded d-flex align-items-center justify-content-center">
                                <img src="{{ asset($educationConfig['education_favicon'] ?? 'assets/img/logo/logo-mini.png') }}" 
                                     id="img_preview_edu_favicon" alt="Favicon" style="max-height: 25px; max-width: 100%; object-fit: contain;" />
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="text-gray-800 fw-bold fs-8 text-truncate">{{ basename($educationConfig['education_favicon'] ?? 'favicon.ico') }}</div>
                                <span class="text-muted fs-9">Format: ICO, PNG, SVG</span>
                            </div>
                        </div>
                        <input type="file" name="education_favicon_file" class="form-control form-control-solid form-control-sm mb-1" accept="image/*" />
                        <input type="text" name="education_favicon_url" class="form-control form-control-solid form-control-sm"
                               placeholder="Atau URL aset..." value="{{ $educationConfig['education_favicon'] ?? '' }}" />
                    </div>
                    <!--end::Favicon-->
                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2 py-4 px-4 px-md-6">
                    <button type="button" class="btn btn-light-danger btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px" id="kt_btn_reset_edu_logo">
                        <i class="ki-outline ki-arrows-loop fs-5 me-1"></i> Reset Default
                    </button>
                    <button type="submit" class="btn btn-warning text-white btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px px-4" id="kt_btn_save_edu_logo">
                        <span class="indicator-label d-inline-flex align-items-center">
                            <i class="ki-outline ki-check fs-4 me-1 text-white"></i> Simpan Logo
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span> Mengunggah...
                        </span>
                    </button>
                </div>
                <!--end::Card footer-->
            </div>
        </form>
        <!--end::Card Logo Settings-->
    </div>
    <!--end::Col Logo Assets-->
</div>
<!--end::Tab Pane Education Info & Identitas-->
