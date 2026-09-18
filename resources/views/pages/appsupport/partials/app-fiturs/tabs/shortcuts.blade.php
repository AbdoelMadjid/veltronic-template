<!--begin::Shortcuts 2-Column Layout (Matching add-order.blade.php format)-->
<div class="d-flex flex-column flex-lg-row">

    <!-- ======================================================== -->
    <!-- BEGIN::ASIDE COLUMN (Kolom Kiri / Form & Master Status)  -->
    <!-- ======================================================== -->
    <div class="w-100 flex-lg-row-auto w-lg-350px w-xl-375px mb-7 me-7 me-lg-10">

        <!--begin::Master Switch & Status Card-->
        <div class="card card-flush shadow-sm mb-6 border-0 bg-light-primary">
            <div class="card-body p-6">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="symbol symbol-40px symbol-circle bg-primary text-white d-flex align-items-center justify-content-center">
                            <i class="ki-outline ki-keyboard fs-2 text-white"></i>
                        </div>
                        <div>
                            <h5 class="fw-bolder text-gray-900 m-0">Pintasan Global</h5>
                            <span class="text-muted fs-8">Status Listener Sistem</span>
                        </div>
                    </div>
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input h-20px w-35px" type="checkbox" id="global_shortcuts_master_switch" checked />
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 pt-2 border-top border-primary border-opacity-25">
                    <div class="d-flex justify-content-between align-items-center fs-8">
                        <span class="text-gray-700 fw-semibold">Total Pintasan:</span>
                        <span class="badge badge-light-primary fw-bold" id="stat_shortcut_total">{{ $shortcutStats['total'] ?? $shortcuts->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center fs-8">
                        <span class="text-gray-700 fw-semibold">Pintasan Aktif:</span>
                        <span class="badge badge-light-success fw-bold" id="stat_shortcut_active">{{ $shortcutStats['active'] ?? $shortcuts->where('is_enabled', true)->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center fs-8">
                        <span class="text-gray-700 fw-semibold">Dibatasi Role Admin/Master:</span>
                        <span class="badge badge-light-danger fw-bold" id="stat_shortcut_restricted">{{ $shortcutStats['admin_restricted'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Master Switch & Status Card-->

        <!--begin::Formulir Pintasan Keyboard Card-->
        <div class="card card-flush shadow-sm border-0" id="card_shortcut_form">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6 pb-2">
                <div class="card-title d-flex flex-column">
                    <h4 class="fw-bolder text-gray-900 m-0" id="shortcut_form_card_title">
                        <i class="ki-outline ki-plus-circle fs-3 text-primary me-2"></i> Tambah Pintasan Baru
                    </h4>
                    <span class="text-muted fs-8 mt-1" id="shortcut_form_card_subtitle">
                        Pilih kelompok aksi, kombinasi tombol, dan filter hak akses
                    </span>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-2">
                <form id="form_shortcut_manage" method="POST" action="{{ route('appsupport.shortcuts.store') }}">
                    @csrf
                    <input type="hidden" name="_method" id="shortcut_form_method" value="POST" />
                    <input type="hidden" name="id" id="shortcut_form_id" value="" />

                    <!-- Step 1: Pemilihan Kelompok / Kategori Pintasan -->
                    <div class="fv-row mb-5">
                        <label class="required fs-8 fw-bold text-gray-800 mb-2 d-flex align-items-center justify-content-between">
                            <span><i class="ki-outline ki-category fs-7 text-primary me-1"></i> 1. Kelompok Jenis Pintasan</span>
                            <span class="badge badge-light-primary fs-9" id="badge_selected_category">Visibilitas UI</span>
                        </label>
                        
                        <div class="row g-2" id="shortcut_category_selector_grid">
                            <div class="col-4">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-sm w-100 p-2 text-start btn-category-select active" data-category="visibility">
                                    <i class="ki-outline ki-eye fs-4 d-block mb-1 text-primary"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Visibilitas</span>
                                    <span class="text-muted fs-10">Toolbar/Menu</span>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-info btn-sm w-100 p-2 text-start btn-category-select" data-category="navigation">
                                    <i class="ki-outline ki-route fs-4 d-block mb-1 text-info"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Navigasi</span>
                                    <span class="text-muted fs-10">Buka Menu/URL</span>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-success btn-sm w-100 p-2 text-start btn-category-select" data-category="appearance">
                                    <i class="ki-outline ki-color-filter fs-4 d-block mb-1 text-success"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Tema & Ikon</span>
                                    <span class="text-muted fs-10">Dark/Light/Gaya</span>
                                </button>
                            </div>
                            <div class="col-6 mt-2">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-sm w-100 p-2 text-start btn-category-select" data-category="system">
                                    <i class="ki-outline ki-shield-tick fs-4 d-block mb-1 text-danger"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Aksi Sistem</span>
                                    <span class="text-muted fs-10">Search, Lock Screen</span>
                                </button>
                            </div>
                            <div class="col-6 mt-2">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-warning btn-sm w-100 p-2 text-start btn-category-select" data-category="element">
                                    <i class="ki-outline ki-cursor fs-4 d-block mb-1 text-warning"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Klik Elemen</span>
                                    <span class="text-muted fs-10">Drawer / Modal</span>
                                </button>
                            </div>
                        </div>
                        <div class="text-muted fs-9 mt-2 p-2 bg-light rounded-2 border" id="category_description_hint">
                            Menampilkan atau menyembunyikan elemen UI seperti toolbar, navbar, header, atau sidebar secara realtime dan tersimpan persisten ke basis data.
                        </div>
                    </div>

                    <!-- Step 2: Target Aksi Spesifik Sesuai Kelompok -->
                    <div class="fv-row mb-5">
                        <label class="required fs-8 fw-bold text-gray-800 mb-1">
                            <i class="ki-outline ki-route fs-7 text-primary me-1"></i> 2. Target Aksi Spesifik
                        </label>
                        <select id="shortcut_target_select" class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="false" data-placeholder="Pilih target aksi...">
                            <!-- Populated dynamically via JS based on selected category -->
                        </select>
                    </div>

                    <!-- Input Target Kustom (URL atau Selector) -->
                    <div id="wrapper_custom_target" class="fv-row mb-5 p-3 bg-light-info rounded-3 border border-info border-opacity-25 d-none">
                        <label class="fs-8 fw-bold text-gray-800 mb-1 d-block" id="custom_target_input_label">
                            URL Target Halaman:
                        </label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-body text-primary fw-bold" id="custom_target_addon">/</span>
                            <input type="text" id="custom_target_value_input" class="form-control form-control-solid" placeholder="admin/users atau #id-elemen" />
                        </div>
                        <span class="text-muted fs-9 mt-1 d-block" id="custom_target_help_text">
                            Ketik URL relatif (misal: <code>usermanagement/users</code>) atau selector elemen DOM.
                        </span>
                    </div>

                    <!-- Hidden Fields untuk Aksi & Target -->
                    <input type="hidden" name="action_type" id="hidden_action_type" value="toggle_topbar_tools" />
                    <input type="hidden" name="action_target" id="hidden_action_target" value="topbar_tools" />

                    <!-- Step 3: Nama & Deskripsi Pintasan -->
                    <div class="fv-row mb-5">
                        <label class="required fs-8 fw-bold text-gray-800 mb-1">
                            <i class="ki-outline ki-notepad fs-7 text-primary me-1"></i> 3. Nama Pintasan
                        </label>
                        <input type="text" name="name" id="shortcut_input_name" class="form-control form-control-solid form-control-sm" placeholder="Contoh: Toggle Fitur & Tools Topbar" value="Toggle Fitur & Tools di Topbar Navbar" required />
                    </div>

                    <!-- Step 4: Kombinasi Tombol Keyboard Interaktif -->
                    <div class="fv-row mb-5 p-3 bg-light rounded-3 border">
                        <label class="required fs-8 fw-bold text-gray-800 mb-2 d-flex align-items-center justify-content-between">
                            <span><i class="ki-outline ki-electricity fs-7 text-primary me-1"></i> 4. Kombinasi Tombol</span>
                            <span class="fs-9 text-muted">Modifier + Huruf</span>
                        </label>
                        
                        <!-- Checkboxes Modifiers -->
                        <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input shortcut-modifier-check" type="checkbox" name="ctrl" value="1" id="shortcut_check_ctrl" checked />
                                <label class="form-check-label fs-8 fw-semibold cursor-pointer" for="shortcut_check_ctrl">Ctrl / ⌘</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input shortcut-modifier-check" type="checkbox" name="alt" value="1" id="shortcut_check_alt" />
                                <label class="form-check-label fs-8 fw-semibold cursor-pointer" for="shortcut_check_alt">Alt / ⌥</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input shortcut-modifier-check" type="checkbox" name="shift" value="1" id="shortcut_check_shift" checked />
                                <label class="form-check-label fs-8 fw-semibold cursor-pointer" for="shortcut_check_shift">Shift</label>
                            </div>
                        </div>

                        <!-- Tombol Utama Input -->
                        <div class="d-flex align-items-center gap-2">
                            <span class="fs-8 text-muted fw-semibold">Tombol:</span>
                            <input type="text" name="key" id="shortcut_input_key" class="form-control form-control-solid form-control-sm text-center fw-bold text-uppercase w-85px shadow-sm" maxlength="15" placeholder="T" value="t" required />
                            <span class="fs-9 text-muted">(A-Z, 0-9, /, dll.)</span>
                        </div>

                        <!-- Live Conflict Detector Alert -->
                        <div id="shortcut_conflict_warning" class="alert alert-warning py-2 px-3 mt-3 mb-0 d-none fs-9 d-flex align-items-center">
                            <i class="ki-outline ki-information-5 text-warning fs-5 me-2 flex-shrink-0"></i>
                            <span id="conflict_warning_message">Kombinasi ini sudah digunakan.</span>
                        </div>

                        <!-- Live Preview Badge -->
                        <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top border-gray-300">
                            <span class="fs-9 text-muted">Pratinjau Tombol:</span>
                            <div id="shortcut_live_badge_preview">
                                <kbd class="bg-primary text-white px-2 py-1 rounded fw-bold fs-8 shadow-sm">Ctrl + Shift + T</kbd>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Batasan Hak Akses Role -->
                    <div class="fv-row mb-5">
                        <label class="fs-8 fw-bold text-gray-800 mb-1 d-block">
                            <i class="ki-outline ki-shield-tick fs-7 text-primary me-1"></i> 5. Filter Hak Akses Role
                        </label>
                        <span class="fs-9 text-muted mb-2 d-block">Hanya role yang dipilih yang dapat mengeksekusi pintasan ini</span>
                        
                        <div class="d-flex flex-column gap-2 p-3 bg-light rounded-3 border">
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input" type="checkbox" id="shortcut_role_all" />
                                <label class="form-check-label fs-8 fw-bold text-gray-800" for="shortcut_role_all">
                                    Semua Role (Dapat Diakses Seluruh Pengguna)
                                </label>
                            </div>
                            <div class="separator my-1"></div>
                            <div class="d-flex flex-wrap gap-3" id="wrapper_role_checkboxes">
                                @foreach($availableRoles as $roleName)
                                    @php
                                        $roleLower = strtolower($roleName);
                                        $isChecked = in_array($roleLower, ['master', 'admin']);
                                    @endphp
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input role-item-checkbox" type="checkbox" name="roles[]" value="{{ $roleName }}" id="role_chk_{{ $roleName }}" {{ $isChecked ? 'checked' : '' }} />
                                        <label class="form-check-label fs-8 fw-semibold" for="role_chk_{{ $roleName }}">
                                            {{ ucfirst($roleName) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Tambahan -->
                    <div class="fv-row mb-5">
                        <label class="fs-8 fw-bold text-gray-700 mb-1">Deskripsi Tambahan (Opsional)</label>
                        <textarea name="description" id="shortcut_input_description" class="form-control form-control-solid form-control-sm" rows="2" placeholder="Jelaskan kegunaan pintasan ini..."></textarea>
                    </div>

                    <!-- Status Aktif Switch -->
                    <div class="d-flex align-items-center justify-content-between mb-6 p-3 bg-light rounded-3 border">
                        <div class="d-flex flex-column">
                            <span class="fs-8 fw-bold text-gray-800">Status Pintasan</span>
                            <span class="fs-9 text-muted">Aktifkan agar dapat langsung digunakan</span>
                        </div>
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input h-20px w-35px" type="checkbox" name="is_enabled" value="1" id="shortcut_input_is_enabled" checked />
                        </div>
                    </div>

                    <!-- Tombol Aksi Simpan & Batal -->
                    <div class="d-flex gap-2">
                        <button type="submit" id="btn_save_shortcut_manage" class="btn btn-primary btn-sm flex-grow-1">
                            <span class="indicator-label">
                                <i class="ki-outline ki-check fs-5 me-1"></i> Simpan Pintasan
                            </span>
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle me-2"></span> Menyimpan...
                            </span>
                        </button>
                        <button type="button" id="btn_reset_shortcut_form" class="btn btn-light btn-sm" data-bs-toggle="tooltip" title="Reset Formulir ke Tambah Baru">
                            <i class="ki-outline ki-arrows-circle fs-5"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Formulir Pintasan Keyboard Card-->

    </div>
    <!-- ======================================================== -->
    <!-- END::ASIDE COLUMN                                        -->
    <!-- ======================================================== -->


    <!-- ======================================================== -->
    <!-- BEGIN::MAIN COLUMN (Kolom Kanan / Tabel & Cheatsheet)    -->
    <!-- ======================================================== -->
    <div class="flex-lg-row-fluid">

        <!--begin::Tabel Daftar Pintasan Keyboard Card-->
        <div class="card card-flush shadow-sm border-0 mb-6">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <div class="card-title d-flex flex-column">
                    <h3 class="fw-bolder text-gray-900 m-0">
                        <i class="ki-outline ki-keyboard fs-2 text-primary me-2"></i> Daftar Pintasan Keyboard Terdaftar
                    </h3>
                    <span class="text-muted fs-8 mt-1">
                        Pintasan aktif langsung sinkron dengan event listener browser & basis data
                    </span>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-light-primary btn-sm" id="btn_new_shortcut_focus">
                        <i class="ki-outline ki-plus fs-5 me-1"></i> Tambah Pintasan Baru
                    </button>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-2">
                <!-- Filter Kategori & Search Toolbar -->
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-5">
                    <!-- Search Input -->
                    <div class="d-flex align-items-center position-relative w-100 w-md-250px">
                        <i class="ki-outline ki-magnifier fs-4 position-absolute ms-3 text-gray-500"></i>
                        <input type="text" id="shortcut_table_search" class="form-control form-control-solid form-control-sm ps-10" placeholder="Cari nama, tombol, atau role..." />
                    </div>

                    <!-- Category Filter Tabs -->
                    <div class="d-flex align-items-center gap-1 overflow-auto pb-1">
                        <button type="button" class="btn btn-sm btn-light-primary py-1 px-3 fs-9 active btn-filter-table-category" data-filter="all">
                            Semua ({{ $shortcuts->count() }})
                        </button>
                        <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-9 btn-filter-table-category" data-filter="visibility">
                            <i class="ki-outline ki-eye fs-7 me-1"></i> Visibilitas
                        </button>
                        <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-9 btn-filter-table-category" data-filter="appearance">
                            <i class="ki-outline ki-color-filter fs-7 me-1"></i> Tema & Ikon
                        </button>
                        <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-9 btn-filter-table-category" data-filter="system">
                            <i class="ki-outline ki-shield-tick fs-7 me-1"></i> Sistem
                        </button>
                        <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-9 btn-filter-table-category" data-filter="navigation">
                            <i class="ki-outline ki-route fs-7 me-1"></i> Navigasi
                        </button>
                        <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-9 btn-filter-table-category" data-filter="element">
                            <i class="ki-outline ki-cursor fs-7 me-1"></i> Elemen
                        </button>
                    </div>
                </div>

                <!-- Tabel Data Shortcuts -->
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-3 gs-4 mb-0" id="table_app_shortcuts">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-8 text-uppercase gs-0 bg-light">
                                <th class="min-w-160px ps-4">Nama Pintasan & Kelompok</th>
                                <th class="text-center min-w-100px">Kombinasi Tombol</th>
                                <th class="min-w-140px">Target Aksi</th>
                                <th class="text-center min-w-110px">Hak Akses Role</th>
                                <th class="text-center min-w-70px">Status</th>
                                <th class="text-end min-w-100px pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 fw-semibold" id="tbody_app_shortcuts">
                            @forelse($shortcuts as $sc)
                                @php
                                    $catMeta = $sc->category_meta;
                                    $rolesArr = is_array($sc->roles) ? $sc->roles : [];
                                    $searchData = strtolower($sc->name . ' ' . $sc->formatted_combination . ' ' . $sc->action_type . ' ' . $sc->action_target . ' ' . implode(' ', $rolesArr) . ' ' . $sc->category);
                                @endphp
                                <tr class="shortcut-row" data-id="{{ $sc->id }}" data-category="{{ $sc->category }}" data-search="{{ $searchData }}">
                                    <!-- Nama & Kelompok -->
                                    <td class="ps-4">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span class="badge {{ $catMeta['badge_class'] }} fs-9 px-2 py-0 fw-bold">
                                                    <i class="ki-outline {{ $catMeta['icon'] }} fs-8 me-1"></i> {{ $catMeta['name'] }}
                                                </span>
                                            </div>
                                            <span class="fw-bold text-gray-900 shortcut-name-text">{{ $sc->name }}</span>
                                            <span class="text-muted fs-9 shortcut-desc-text">{{ $sc->description ?: '-' }}</span>
                                        </div>
                                    </td>

                                    <!-- Kombinasi Tombol -->
                                    <td class="text-center">
                                        <div class="d-flex flex-column align-items-center gap-1">
                                            <kbd class="bg-light-primary text-primary px-2 py-1 rounded fw-bold border fs-8 shortcut-combo-badge shadow-xs">
                                                {{ $sc->formatted_combination }}
                                            </kbd>
                                            <span class="text-muted fs-9 font-monospace shortcut-mac-combo">{{ $sc->mac_combination }}</span>
                                        </div>
                                    </td>

                                    <!-- Target Aksi -->
                                    <td>
                                        <div class="d-flex flex-column">
                                            @if($sc->action_type === 'toggle_topbar_tools')
                                                <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Toggle Topbar Navbar Tools</span>
                                                <span class="text-muted fs-9 font-monospace">topbar_tools</span>
                                            @elseif($sc->action_type === 'toggle_topbar_menus')
                                                <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Toggle Topbar Header Menus</span>
                                                <span class="text-muted fs-9 font-monospace">topbar_menus</span>
                                            @elseif($sc->action_type === 'toggle_sidebar_menus')
                                                <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Toggle Menu Template Sidebar</span>
                                                <span class="text-muted fs-9 font-monospace">sidebar_menus</span>
                                            @elseif($sc->action_type === 'visibility_toggle')
                                                <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Toggle Elemen Kustom</span>
                                                <span class="text-muted fs-9 font-monospace text-truncate mw-150px">{{ $sc->action_target }}</span>
                                            @elseif($sc->action_type === 'open_url' || $sc->action_type === 'nav_link')
                                                <span class="badge badge-light-info fw-bold fs-8 w-fit mb-1">Buka Halaman (URL)</span>
                                                <span class="text-muted fs-9 font-monospace text-truncate mw-150px" title="{{ $sc->action_target }}">{{ $sc->action_target ?: '/' }}</span>
                                            @elseif($sc->action_type === 'click_element')
                                                <span class="badge badge-light-warning fw-bold fs-8 w-fit mb-1">Klik Elemen Tombol</span>
                                                <span class="text-muted fs-9 font-monospace text-truncate mw-150px">{{ $sc->action_target }}</span>
                                            @elseif($sc->action_type === 'search')
                                                <span class="badge badge-light-danger fw-bold fs-8 w-fit mb-1">Pencarian Global</span>
                                                <span class="text-muted fs-9">global_search</span>
                                            @elseif($sc->action_type === 'theme_mode')
                                                <span class="badge badge-light-success fw-bold fs-8 w-fit mb-1">Mode Gelap / Terang</span>
                                                <span class="text-muted fs-9">theme_mode</span>
                                            @elseif($sc->action_type === 'icon_style')
                                                @php
                                                    $styleTarget = strtolower($sc->action_target ?: 'duotone');
                                                    $styleLabel = ucfirst($styleTarget);
                                                    $styleBadgeColor = match($styleTarget) {
                                                        'duotone' => 'badge-light-primary',
                                                        'solid' => 'badge-light-success',
                                                        'outline' => 'badge-light-info',
                                                        default => 'badge-light-secondary'
                                                    };
                                                @endphp
                                                <span class="badge {{ $styleBadgeColor }} fw-bold fs-8 w-fit mb-1">Gaya Ikon: {{ $styleLabel }}</span>
                                                <span class="text-muted fs-9 font-monospace">icon_style:{{ $styleTarget }}</span>
                                            @elseif($sc->action_type === 'switch_language')
                                                @php
                                                    $langLabel = strtolower($sc->action_target) === 'en' ? 'English' : 'Indonesia';
                                                @endphp
                                                <span class="badge badge-light-success fw-bold fs-8 w-fit mb-1">Ganti Bahasa: {{ $langLabel }}</span>
                                                <span class="text-muted fs-9 font-monospace">locale:{{ $sc->action_target }}</span>
                                            @elseif($sc->action_type === 'switch_version')
                                                <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Versi Layout: {{ strtoupper($sc->action_target) }}</span>
                                                <span class="text-muted fs-9 font-monospace">version:{{ $sc->action_target }}</span>
                                            @elseif($sc->action_type === 'lock_screen')
                                                <span class="badge badge-light-danger fw-bold fs-8 w-fit mb-1">Kunci Layar (Lock Screen)</span>
                                                <span class="text-muted fs-9">lock_screen</span>
                                            @else
                                                <span class="badge badge-light-secondary fw-bold fs-8 w-fit mb-1">{{ ucfirst($sc->action_type) }}</span>
                                                <span class="text-muted fs-9 font-monospace">{{ $sc->action_target }}</span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Batasan Hak Akses Role -->
                                    <td class="text-center">
                                        <div class="d-flex flex-wrap justify-content-center gap-1">
                                            @if(empty($sc->roles))
                                                <span class="badge badge-light-success fs-9 fw-semibold" data-bs-toggle="tooltip" title="Dapat digunakan oleh semua pengguna">Semua Role</span>
                                            @else
                                                @foreach($sc->roles as $r)
                                                    @php
                                                        $rColor = match(strtolower($r)) {
                                                            'master' => 'badge-light-danger',
                                                            'admin' => 'badge-light-primary',
                                                            'operator' => 'badge-light-warning',
                                                            default => 'badge-light-secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $rColor }} fs-9 fw-bold">{{ ucfirst($r) }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Status Toggle Switch -->
                                    <td class="text-center">
                                        <div class="form-check form-switch form-check-custom form-check-solid d-inline-block">
                                            <input class="form-check-input h-18px w-30px btn-toggle-shortcut-row" type="checkbox" data-id="{{ $sc->id }}" {{ $sc->is_enabled ? 'checked' : '' }} />
                                        </div>
                                    </td>

                                    <!-- Aksi Tombol -->
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end align-items-center gap-1">
                                            <button type="button" class="btn btn-icon btn-light-success btn-sm btn-test-single-shortcut" data-id="{{ $sc->id }}" data-action-type="{{ $sc->action_type }}" data-action-target="{{ $sc->action_target }}" data-bs-toggle="tooltip" title="Uji Coba Langsung">
                                                <i class="ki-outline ki-eye fs-5"></i>
                                            </button>
                                            <button type="button" class="btn btn-icon btn-light-info btn-sm btn-edit-shortcut-row" data-id="{{ $sc->id }}" data-bs-toggle="tooltip" title="Edit Pintasan">
                                                <i class="ki-outline ki-pencil fs-5"></i>
                                            </button>
                                            <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-delete-shortcut-row" data-id="{{ $sc->id }}" data-name="{{ $sc->name }}" data-bs-toggle="tooltip" title="Hapus Pintasan">
                                                <i class="ki-outline ki-trash fs-5"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="tr_empty_shortcuts">
                                    <td colspan="6" class="text-center py-8 text-muted fs-7">
                                        <i class="ki-outline ki-keyboard fs-3x text-gray-400 d-block mb-2"></i>
                                        Belum ada pintasan keyboard yang dibuat. Gunakan form di sebelah kiri untuk menambah pintasan baru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Tabel Daftar Pintasan Keyboard Card-->


        <!--begin::Panduan Lengkap Cheatsheet Card (Categorized Reference)-->
        <div class="card card-flush shadow-sm border-0">
            <div class="card-header pt-6">
                <div class="card-title">
                    <h5 class="fw-bolder text-gray-900 m-0">
                        <i class="ki-outline ki-book-open fs-3 text-primary me-2"></i> Panduan Kelompok Pintasan & Tata Cara Penggunaan
                    </h5>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="row g-4 fs-7 text-gray-700">
                    <div class="col-md-6">
                        <div class="p-4 bg-light rounded-3 border h-100">
                            <h6 class="fw-bold text-gray-900 mb-2">
                                <i class="ki-outline ki-eye text-primary fs-5 me-1"></i> 1. Toggle Visibilitas Elemen
                            </h6>
                            <p class="fs-8 text-muted mb-0">
                                Digunakan untuk menyembunyikan / menampilkan bagian toolbar, header menu, atau sidebar:
                                <br>• <kbd class="bg-light-primary text-primary border px-1">Ctrl + Alt + T</kbd> : Fitur & Tools di Topbar Navbar
                                <br>• <kbd class="bg-light-primary text-primary border px-1">Ctrl + Alt + H</kbd> : Menu Utama di Topbar Header
                                <br>• <kbd class="bg-light-primary text-primary border px-1">Ctrl + Alt + M</kbd> : Menu Template di Sidebar
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 bg-light rounded-3 border h-100">
                            <h6 class="fw-bold text-gray-900 mb-2">
                                <i class="ki-outline ki-color-filter text-success fs-5 me-1"></i> 2. Tema, Bahasa & Versi Layout
                            </h6>
                            <p class="fs-8 text-muted mb-0">
                                Beralih varian tampilan visual seketika:
                                <br>• <kbd class="bg-light-success text-success border px-1">Ctrl + Alt + B</kbd> : Beralih Mode Gelap & Terang
                                <br>• <kbd class="bg-light-success text-success border px-1">Ctrl + Alt + I</kbd> : Ganti Bahasa: Indonesia
                                <br>• <kbd class="bg-light-success text-success border px-1">Ctrl + Alt + E</kbd> : Ganti Bahasa: English
                                <br>• <kbd class="bg-light-primary text-primary border px-1">Ctrl + Alt + 1</kbd> : Layout Versi 1 (V1)
                                <br>• <kbd class="bg-light-primary text-primary border px-1">Ctrl + Alt + 2</kbd> : Layout Versi 2 (V2)
                                <br>• <kbd class="bg-light-info text-info border px-1">Ctrl + Alt + D / S / O</kbd> : Ikon Duotone / Solid / Outline
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 bg-light rounded-3 border h-100">
                            <h6 class="fw-bold text-gray-900 mb-2">
                                <i class="ki-outline ki-shield-tick text-danger fs-5 me-1"></i> 3. Aksi Sistem & Keamanan
                            </h6>
                            <p class="fs-8 text-muted mb-0">
                                Akses cepat fungsi utilitas dashboard:
                                <br>• <kbd class="bg-light-info text-info border px-1">Ctrl + Alt + F</kbd> : Pencarian Cepat Global (Global Search)
                                <br>• <kbd class="bg-light-danger text-danger border px-1">Ctrl + Alt + L</kbd> : Kunci Layar Pengguna (Lock Screen)
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 bg-light rounded-3 border h-100">
                            <h6 class="fw-bold text-gray-900 mb-2">
                                <i class="ki-outline ki-route text-info fs-5 me-1"></i> 4. Navigasi Rute & Proteksi Form
                            </h6>
                            <p class="fs-8 text-muted mb-0">
                                • <strong>Navigasi Menu:</strong> Langsung membuka rute halaman pilihan pengguna.
                                <br>• <strong>Pencegahan Konflik:</strong> Saat kursor aktif di input teks/textarea, pintasan navigasi dinonaktifkan otomatis agar tidak mengganggu pengetikan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Panduan Lengkap Cheatsheet Card-->

    </div>
    <!-- ======================================================== -->
    <!-- END::MAIN COLUMN                                         -->
    <!-- ======================================================== -->

</div>
<!--end::Shortcuts 2-Column Layout-->

<!-- Data Catalog JSON untuk Javascript Frontend -->
<script type="text/javascript">
    window.SHORTCUT_CATEGORIES_CATALOG = @json($shortcutCategories);
</script>
