<!--begin::Tab Pane Education Navigasi & Topbar-->
<form id="kt_form_edu_nav" class="form">
    @csrf
    <div class="card shadow-sm mb-6">
        <!--begin::Card header-->
        <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
            <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100">
                <h3 class="fw-bolder text-gray-900 m-0 fs-4">Navigasi Header & Topbar Portal</h3>
                <span class="text-muted fs-7 mt-1">Konfigurasi toolbar atas, tombol pendaftaran intake, dan elemen navigasi header</span>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-6 px-4 px-md-6">
            <!--begin::Row Topbar Actions-->
            <h5 class="fw-bolder text-gray-800 mb-4 fs-6">
                Tombol Pendaftaran Topbar (Apply Intake)
            </h5>
            <div class="row mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <label class="form-label fs-7 fw-bold text-gray-800 required">Teks Tombol Topbar</label>
                    <input type="text" name="education_topbar_apply_text" class="form-control form-control-solid form-control-sm"
                           placeholder="Apply for Fall Intake" value="{{ $educationConfig['education_topbar_apply_text'] ?? 'Apply for Fall Intake' }}" required />
                    <div class="text-muted fs-8 mt-1">Tombol aksi pendaftaran di bilah atas kiri (Topbar)</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fs-7 fw-bold text-gray-800 required">Tautan Tombol Topbar (URL/Route)</label>
                    <input type="text" name="education_topbar_apply_url" class="form-control form-control-solid form-control-sm"
                           placeholder="/education/apply-for-all-intake" value="{{ $educationConfig['education_topbar_apply_url'] ?? '/education/apply-for-all-intake' }}" required />
                </div>
            </div>
            <!--end::Row Topbar Actions-->

            <div class="separator separator-dashed my-6"></div>

            <!--begin::Row Toolbar Features-->
            <h5 class="fw-bolder text-gray-800 mb-4 fs-6">
                Fitur & Menu Toolbar Atas
            </h5>
            <div class="row g-4 mb-6">
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-between p-4 bg-light-subtle rounded-3 border border-gray-200">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-gray-800 fs-7">Switcher Bahasa</span>
                            <span class="text-muted fs-8">Pilihan bahasa ID & EN di topbar</span>
                        </div>
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input h-20px w-35px" type="checkbox" name="education_topbar_show_lang" value="1"
                                   {{ !empty($educationConfig['education_topbar_show_lang']) ? 'checked' : '' }} />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-between p-4 bg-light-subtle rounded-3 border border-gray-200">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-gray-800 fs-7">Menu Pintas (Jump To)</span>
                            <span class="text-muted fs-8">Dropdown tautan cepat ke fakultas/layanan</span>
                        </div>
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input h-20px w-35px" type="checkbox" name="education_topbar_show_jump_to" value="1"
                                   {{ !empty($educationConfig['education_topbar_show_jump_to']) ? 'checked' : '' }} />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-between p-4 bg-light-subtle rounded-3 border border-gray-200">
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-gray-800 fs-7">Pencarian Cepat</span>
                            <span class="text-muted fs-8">Modal pencarian jurusan & program</span>
                        </div>
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input h-20px w-35px" type="checkbox" name="education_topbar_show_search" value="1"
                                   {{ !empty($educationConfig['education_topbar_show_search']) ? 'checked' : '' }} />
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row Toolbar Features-->

            <div class="separator separator-dashed my-6"></div>

            <!--begin::Mega Menu Structure Overview-->
            <h5 class="fw-bolder text-gray-800 mb-3 fs-6">
                Struktur Navigasi Mega-Menu Navbar
            </h5>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 bg-light-subtle rounded-3 border border-gray-200 h-100">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="bullet bullet-dot bg-warning me-1"></span>
                            <span class="fw-bolder text-gray-800 fs-7">Grup 1: Pages & Portal</span>
                        </div>
                        <ul class="text-gray-700 fs-8 mb-0 ps-3">
                            <li><a href="{{ url('/education/programs') }}" target="_blank" class="text-muted text-hover-primary">Programs (Program Studi)</a></li>
                            <li><a href="{{ url('/education/future-students') }}" target="_blank" class="text-muted text-hover-primary">Future Students (Calon Mahasiswa)</a></li>
                            <li><a href="{{ url('/education/current-students') }}" target="_blank" class="text-muted text-hover-primary">Current Students (Mahasiswa Aktif)</a></li>
                            <li><a href="{{ url('/education/faculty-and-staff') }}" target="_blank" class="text-muted text-hover-primary">Faculty & Staff (Dosen)</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-light-subtle rounded-3 border border-gray-200 h-100">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="bullet bullet-dot bg-warning me-1"></span>
                            <span class="fw-bolder text-gray-800 fs-7">Grup 2: Riset & Komunitas</span>
                        </div>
                        <ul class="text-gray-700 fs-8 mb-0 ps-3">
                            <li><a href="{{ url('/education/research') }}" target="_blank" class="text-muted text-hover-primary">Research & Innovation</a></li>
                            <li><a href="{{ url('/education/events') }}" target="_blank" class="text-muted text-hover-primary">Events & Seminars</a></li>
                            <li><a href="{{ url('/education/campus-life') }}" target="_blank" class="text-muted text-hover-primary">Campus Life & Sports</a></li>
                            <li><a href="{{ url('/education/alumni') }}" target="_blank" class="text-muted text-hover-primary">Alumni Network</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-light-subtle rounded-3 border border-gray-200 h-100">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="bullet bullet-dot bg-warning me-1"></span>
                            <span class="fw-bolder text-gray-800 fs-7">Grup 3: Layanan & Akses</span>
                        </div>
                        <ul class="text-gray-700 fs-8 mb-0 ps-3">
                            <li><a href="{{ url('/education/apply-for-all-intake') }}" target="_blank" class="text-muted text-hover-primary">Apply Online Intake</a></li>
                            <li><a href="{{ url('/education/signin') }}" target="_blank" class="text-muted text-hover-primary">Sign-in Portal SSO</a></li>
                            <li><a href="{{ url('/education/help') }}" target="_blank" class="text-muted text-hover-primary">Helpdesk & FAQ</a></li>
                            <li><a href="{{ url('/education/contacts') }}" target="_blank" class="text-muted text-hover-primary">Contacts & Map</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--end::Mega Menu Structure Overview-->
        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-center justify-content-sm-end py-4 px-4 px-md-6">
            <button type="submit" class="btn btn-warning text-white btn-sm fw-bold px-6" id="kt_btn_save_edu_nav">
                <span class="indicator-label">
                    <i class="ki-outline ki-check fs-4 me-1 text-white"></i> Simpan Pengaturan Navigasi
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-2"></span> Menyimpan...
                </span>
            </button>
        </div>
        <!--end::Card footer-->
    </div>
</form>
<!--end::Tab Pane Education Navigasi & Topbar-->
