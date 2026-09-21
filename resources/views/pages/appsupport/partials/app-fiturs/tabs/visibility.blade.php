<!-- Filter & Search Bar -->
<div class="card shadow-sm border border-gray-200 mb-6">
    <div class="card-body py-4 px-4 px-md-6 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
        <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3 w-100">
            <!-- Search Input -->
            <div class="position-relative w-100 w-md-350px">
                <i class="ki-outline ki-magnifier fs-3 position-absolute top-50 translate-middle-y ms-4 text-gray-500"></i>
                <input type="text" id="search_features_input" class="form-control form-control-solid form-control-sm ps-11" placeholder="Cari nama fitur, tools, menu..." />
            </div>

            <!-- Status Filter -->
            <div class="w-100 w-sm-175px">
                <select id="filter_feature_status" class="form-select form-select-solid form-select-sm">
                    <option value="all">Semua Status</option>
                    <option value="active">Hanya Aktif</option>
                    <option value="disabled">Hanya Tersembunyi</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- CARD 1: FITUR & TOOLS DI TOPBAR NAVBAR         -->
<!-- ============================================== -->
<div class="card shadow-sm border border-gray-200 mb-6">
    <!--begin::Card header-->
    <div class="card-header border-bottom border-gray-200 px-4 px-sm-6 py-5 py-md-0 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 min-h-65px">
        <div class="card-title d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto mb-0">
            <h3 class="fw-bolder text-gray-900 m-0 fs-4">Fitur & Tools di Topbar Navbar</h3>
            <span class="text-muted fs-7 mt-1">Tombol aksi cepat di sudut kanan atas navbar (dari ikon search hingga frontpage switcher).</span>
        </div>
        <div class="card-toolbar d-flex flex-wrap align-items-center justify-content-center justify-content-md-end gap-2 w-100 w-md-auto mt-2 mt-md-0">
            <!-- Dynamic Bulk Action Toolbar (Muncul saat ada item diceklis) -->
            <div class="d-none flex-wrap align-items-center justify-content-center justify-content-md-end gap-1 gap-sm-2 bulk-selected-toolbar" data-category="topbar_tools">
                <span class="btn btn-sm btn-light-primary fw-bold fs-7 pe-none d-inline-flex align-items-center px-2 px-sm-3">
                    <span class="selected-count me-1">0</span>Dipilih
                </span>
                <button type="button" class="btn btn-sm btn-success fs-7 d-inline-flex align-items-center px-2 px-sm-3 btn-bulk-apply" data-action="enable_selected" data-category="topbar_tools" data-bs-toggle="tooltip" title="Tampilkan fitur yang dipilih">
                    <i class="ki-outline ki-check fs-5 me-1 text-white"></i>
                    <span class="indicator-label fw-bold">Tampilkan</span>
                </button>
                <button type="button" class="btn btn-sm btn-danger fs-7 d-inline-flex align-items-center px-2 px-sm-3 btn-bulk-apply" data-action="disable_selected" data-category="topbar_tools" data-bs-toggle="tooltip" title="Sembunyikan fitur yang dipilih">
                    <i class="ki-outline ki-cross fs-5 me-1 text-white"></i>
                    <span class="indicator-label fw-bold">Sembunyikan</span>
                </button>
            </div>

            <!-- Checkbox Pilih Semua -->
            <div class="form-check form-check-custom form-check-solid form-check-sm d-flex align-items-center my-1 ms-0 ms-md-2">
                <input class="form-check-input select-all-section-checkbox" type="checkbox" data-category="topbar_tools" id="select_all_topbar_tools" />
                <label class="form-check-label fs-7 fw-semibold text-gray-700 cursor-pointer ms-2" for="select_all_topbar_tools">Pilih Semua</label>
            </div>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-6 px-4 px-md-6">
        <div class="row g-4">
            @foreach($fitursGrouped['topbar_tools'] as $fitur)
                <div class="col-md-6 col-lg-4 feature-card-wrapper" data-category="topbar_tools">
                    <div class="card card-bordered card-flush shadow-sm h-100 p-5 feature-card {{ !$fitur->is_enabled ? 'bg-light opacity-75' : '' }}" data-feature-key="{{ $fitur->key }}" data-is-enabled="{{ $fitur->is_enabled ? '1' : '0' }}">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <i class="ki-duotone {{ $fitur->icon ?? 'ki-wrench' }} fs-2x text-primary">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                </i>
                                <div>
                                    <h6 class="fw-bold text-gray-900 m-0 feature-title">{{ $fitur->name }}</h6>
                                    <span class="badge {{ $fitur->is_enabled ? 'badge-light-success' : 'badge-light-danger' }} fs-8 fw-semibold feature-status-badge mt-1 cursor-pointer" data-bs-toggle="tooltip" title="Klik untuk ubah status">
                                        {{ $fitur->is_enabled ? 'Aktif' : 'Tersembunyi' }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- Checkbox Ceklist Per Item -->
                                <div class="form-check form-check-custom form-check-solid form-check-sm" data-bs-toggle="tooltip" title="Pilih fitur ini">
                                    <input class="form-check-input feature-item-checkbox" type="checkbox" data-feature-key="{{ $fitur->key }}" data-category="topbar_tools" />
                                </div>
                            </div>
                        </div>
                        <p class="text-muted fs-7 mt-3 mb-0 feature-desc">{{ $fitur->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--end::Card body-->

    <!--begin::Card footer-->
    <div class="card-footer border-top border-gray-200 py-4 px-4 px-md-6 mt-auto bg-light bg-opacity-50 d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between text-center text-sm-start gap-2">
        <div class="text-muted fs-7">
            Menampilkan <span class="fw-bold text-gray-800">{{ count($fitursGrouped['topbar_tools']) }}</span> modul aksi cepat navbar
        </div>
        <div class="d-flex align-items-center justify-content-center gap-2">
            <span class="badge badge-light-primary fw-semibold fs-8">Top Navbar Tools</span>
        </div>
    </div>
    <!--end::Card footer-->
</div>

<!-- ============================================== -->
<!-- CARD 2: MENU UTAMA DI TOPBAR HEADER            -->
<!-- ============================================== -->
<div class="card shadow-sm border border-gray-200 mb-6">
    <!--begin::Card header-->
    <div class="card-header border-bottom border-gray-200 px-4 px-sm-6 py-5 py-md-0 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 min-h-65px">
        <div class="card-title d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto mb-0">
            <h3 class="fw-bolder text-gray-900 m-0 fs-4">Menu Utama di Topbar Header</h3>
            <span class="text-muted fs-7 mt-1">Navigasi horizontal utama di bilah header atas (mulai dari menu Dashboard hingga Help).</span>
        </div>
        <div class="card-toolbar d-flex flex-wrap align-items-center justify-content-center justify-content-md-end gap-2 w-100 w-md-auto mt-2 mt-md-0">
            <!-- Dynamic Bulk Action Toolbar (Muncul saat ada item diceklis) -->
            <div class="d-none flex-wrap align-items-center justify-content-center justify-content-md-end gap-1 gap-sm-2 bulk-selected-toolbar" data-category="topbar_menus">
                <span class="btn btn-sm btn-light-primary fw-bold fs-7 pe-none d-inline-flex align-items-center px-2 px-sm-3">
                    <span class="selected-count me-1">0</span>Dipilih
                </span>
                <button type="button" class="btn btn-sm btn-success fs-7 d-inline-flex align-items-center px-2 px-sm-3 btn-bulk-apply" data-action="enable_selected" data-category="topbar_menus" data-bs-toggle="tooltip" title="Tampilkan fitur yang dipilih">
                    <i class="ki-outline ki-check fs-5 me-1 text-white"></i>
                    <span class="indicator-label fw-bold">Tampilkan</span>
                </button>
                <button type="button" class="btn btn-sm btn-danger fs-7 d-inline-flex align-items-center px-2 px-sm-3 btn-bulk-apply" data-action="disable_selected" data-category="topbar_menus" data-bs-toggle="tooltip" title="Sembunyikan fitur yang dipilih">
                    <i class="ki-outline ki-cross fs-5 me-1 text-white"></i>
                    <span class="indicator-label fw-bold">Sembunyikan</span>
                </button>
            </div>

            <!-- Checkbox Pilih Semua -->
            <div class="form-check form-check-custom form-check-solid form-check-sm d-flex align-items-center my-1 ms-0 ms-md-2">
                <input class="form-check-input select-all-section-checkbox" type="checkbox" data-category="topbar_menus" id="select_all_topbar_menus" />
                <label class="form-check-label fs-7 fw-semibold text-gray-700 cursor-pointer ms-2" for="select_all_topbar_menus">Pilih Semua</label>
            </div>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-6 px-4 px-md-6">
        <div class="row g-4">
            @foreach($fitursGrouped['topbar_menus'] as $fitur)
                <div class="col-md-6 col-lg-4 feature-card-wrapper" data-category="topbar_menus">
                    <div class="card card-bordered card-flush shadow-sm h-100 p-5 feature-card {{ !$fitur->is_enabled ? 'bg-light opacity-75' : '' }}" data-feature-key="{{ $fitur->key }}" data-is-enabled="{{ $fitur->is_enabled ? '1' : '0' }}">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <i class="ki-duotone {{ $fitur->icon ?? 'ki-element-11' }} fs-2x text-info">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                </i>
                                <div>
                                    <h6 class="fw-bold text-gray-900 m-0 feature-title">{{ $fitur->name }}</h6>
                                    <span class="badge {{ $fitur->is_enabled ? 'badge-light-success' : 'badge-light-danger' }} fs-8 fw-semibold feature-status-badge mt-1 cursor-pointer" data-bs-toggle="tooltip" title="Klik untuk ubah status">
                                        {{ $fitur->is_enabled ? 'Aktif' : 'Tersembunyi' }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- Checkbox Ceklist Per Item -->
                                <div class="form-check form-check-custom form-check-solid form-check-sm" data-bs-toggle="tooltip" title="Pilih fitur ini">
                                    <input class="form-check-input feature-item-checkbox" type="checkbox" data-feature-key="{{ $fitur->key }}" data-category="topbar_menus" />
                                </div>
                            </div>
                        </div>
                        <p class="text-muted fs-7 mt-3 mb-0 feature-desc">{{ $fitur->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--end::Card body-->

    <!--begin::Card footer-->
    <div class="card-footer border-top border-gray-200 py-4 px-4 px-md-6 mt-auto bg-light bg-opacity-50 d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between text-center text-sm-start gap-2">
        <div class="text-muted fs-7">
            Menampilkan <span class="fw-bold text-gray-800">{{ count($fitursGrouped['topbar_menus']) }}</span> menu navigasi header
        </div>
        <div class="d-flex align-items-center justify-content-center gap-2">
            <span class="badge badge-light-info fw-semibold fs-8">Header Horizontal Menus</span>
        </div>
    </div>
    <!--end::Card footer-->
</div>

<!-- ============================================== -->
<!-- CARD 3: MENU TEMPLATE DI SIDEBAR               -->
<!-- ============================================== -->
<div class="card shadow-sm border border-gray-200 mb-6">
    <!--begin::Card header-->
    <div class="card-header border-bottom border-gray-200 px-4 px-sm-6 py-5 py-md-0 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 min-h-65px">
        <div class="card-title d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto mb-0">
            <h3 class="fw-bolder text-gray-900 m-0 fs-4">Menu Template di Sidebar</h3>
            <span class="text-muted fs-7 mt-1">Blok section menu vertikal di sidebar kiri (mulai dari label Dashboard hingga Help).</span>
        </div>
        <div class="card-toolbar d-flex flex-wrap align-items-center justify-content-center justify-content-md-end gap-2 w-100 w-md-auto mt-2 mt-md-0">
            <!-- Dynamic Bulk Action Toolbar (Muncul saat ada item diceklis) -->
            <div class="d-none flex-wrap align-items-center justify-content-center justify-content-md-end gap-1 gap-sm-2 bulk-selected-toolbar" data-category="sidebar_menus">
                <span class="btn btn-sm btn-light-primary fw-bold fs-7 pe-none d-inline-flex align-items-center px-2 px-sm-3">
                    <span class="selected-count me-1">0</span>Dipilih
                </span>
                <button type="button" class="btn btn-sm btn-success fs-7 d-inline-flex align-items-center px-2 px-sm-3 btn-bulk-apply" data-action="enable_selected" data-category="sidebar_menus" data-bs-toggle="tooltip" title="Tampilkan fitur yang dipilih">
                    <i class="ki-outline ki-check fs-5 me-1 text-white"></i>
                    <span class="indicator-label fw-bold">Tampilkan</span>
                </button>
                <button type="button" class="btn btn-sm btn-danger fs-7 d-inline-flex align-items-center px-2 px-sm-3 btn-bulk-apply" data-action="disable_selected" data-category="sidebar_menus" data-bs-toggle="tooltip" title="Sembunyikan fitur yang dipilih">
                    <i class="ki-outline ki-cross fs-5 me-1 text-white"></i>
                    <span class="indicator-label fw-bold">Sembunyikan</span>
                </button>
            </div>

            <!-- Checkbox Pilih Semua -->
            <div class="form-check form-check-custom form-check-solid form-check-sm d-flex align-items-center my-1 ms-0 ms-md-2">
                <input class="form-check-input select-all-section-checkbox" type="checkbox" data-category="sidebar_menus" id="select_all_sidebar_menus" />
                <label class="form-check-label fs-7 fw-semibold text-gray-700 cursor-pointer ms-2" for="select_all_sidebar_menus">Pilih Semua</label>
            </div>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-6 px-4 px-md-6">
        <div class="row g-4">
            @foreach($fitursGrouped['sidebar_menus'] as $fitur)
                <div class="col-md-6 col-lg-4 feature-card-wrapper" data-category="sidebar_menus">
                    <div class="card card-bordered card-flush shadow-sm h-100 p-5 feature-card {{ !$fitur->is_enabled ? 'bg-light opacity-75' : '' }}" data-feature-key="{{ $fitur->key }}" data-is-enabled="{{ $fitur->is_enabled ? '1' : '0' }}">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <i class="ki-duotone {{ $fitur->icon ?? 'ki-menu' }} fs-2x text-warning">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                </i>
                                <div>
                                    <h6 class="fw-bold text-gray-900 m-0 feature-title">{{ $fitur->name }}</h6>
                                    <span class="badge {{ $fitur->is_enabled ? 'badge-light-success' : 'badge-light-danger' }} fs-8 fw-semibold feature-status-badge mt-1 cursor-pointer" data-bs-toggle="tooltip" title="Klik untuk ubah status">
                                        {{ $fitur->is_enabled ? 'Aktif' : 'Tersembunyi' }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- Checkbox Ceklist Per Item -->
                                <div class="form-check form-check-custom form-check-solid form-check-sm" data-bs-toggle="tooltip" title="Pilih fitur ini">
                                    <input class="form-check-input feature-item-checkbox" type="checkbox" data-feature-key="{{ $fitur->key }}" data-category="sidebar_menus" />
                                </div>
                            </div>
                        </div>
                        <p class="text-muted fs-7 mt-3 mb-0 feature-desc">{{ $fitur->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--end::Card body-->

    <!--begin::Card footer-->
    <div class="card-footer border-top border-gray-200 py-4 px-4 px-md-6 mt-auto bg-light bg-opacity-50 d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between text-center text-sm-start gap-2">
        <div class="text-muted fs-7">
            Menampilkan <span class="fw-bold text-gray-800">{{ count($fitursGrouped['sidebar_menus']) }}</span> section menu vertikal sidebar
        </div>
        <div class="d-flex align-items-center justify-content-center gap-2">
            <span class="badge badge-light-warning fw-semibold fs-8">Sidebar Vertical Menus</span>
        </div>
    </div>
    <!--end::Card footer-->
</div>
