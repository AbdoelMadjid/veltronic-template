<form id="system_settings_form" class="form">
    
    <!-- Group 1: Keamanan & Akses -->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">1. Keamanan & Kebijakan Akses</h3>
            </div>
            <div class="card-toolbar">
                <span class="badge badge-light-danger fw-semibold fs-8">Security</span>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Buka Pendaftaran Akun (Public Register)</label>
                <div class="col-lg-8 d-flex align-items-center">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" name="enable_registration" value="1" {{ ($settings['enable_registration'] ?? '1') == '1' ? 'checked' : '' }} />
                        <span class="form-check-label fs-7 text-muted ms-2">Izinkan pengunjung publik membuat akun melalui halaman register.</span>
                    </div>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Durasi Sesi Otomatis Timeout (Menit)</label>
                <div class="col-lg-8 fv-row">
                    <input type="number" class="form-control form-control-solid w-150px" name="session_lifetime" value="{{ $settings['session_lifetime'] ?? '120' }}" min="15" max="1440" />
                </div>
            </div>
        </div>
    </div>

    <!-- Group 2: Pemeliharaan & Quick Cache Tools -->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">2. Pemeliharaan Sistem & Cache Tools</h3>
            </div>
            <div class="card-toolbar">
                <span class="badge badge-light-dark fw-semibold fs-8">Maintenance</span>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
                <div>
                    <h6 class="fw-bold text-gray-900 m-0">Pembersihan Cache Seketika</h6>
                    <span class="text-muted fs-7">Bersihkan kompilasi Blade view, route cache, dan file konfigurasi bila ada perubahan yang belum ter-refresh.</span>
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
