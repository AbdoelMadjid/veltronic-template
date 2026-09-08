<!-- Filter & Search Bar -->
<div class="card card-flush shadow-sm mb-6">
    <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex flex-wrap align-items-center gap-3 flex-grow-1">
            <!-- Search Input -->
            <div class="position-relative w-100 mw-300px">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute top-50 translate-middle-y ms-4 text-gray-500">
                    <span class="path1"></span><span class="path2"></span>
                </i>
                <input type="text" id="search_features_input" class="form-control form-control-solid form-control-sm ps-11" placeholder="Cari nama fitur, tools, menu..." />
            </div>

            <!-- Status Filter -->
            <div class="w-100 mw-175px">
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
<!-- SECTION 1: FITUR & TOOLS DI TOPBAR NAVBAR      -->
<!-- ============================================== -->
<div class="mb-10">
    <div class="d-flex align-items-center justify-content-between mb-5 gap-3 pb-2 border-bottom flex-wrap">
        <div class="pe-2">
            <h4 class="fw-bolder text-gray-900 m-0">1. Fitur & Tools di Topbar Navbar</h4>
            <span class="text-muted fs-7">Tombol aksi cepat di sudut kanan atas navbar (dari ikon search hingga frontpage switcher).</span>
        </div>
        <div class="d-flex align-items-center gap-3 ms-auto flex-shrink-0">
            <!-- Dynamic Bulk Action Toolbar (Muncul saat ada item diceklis) -->
            <div class="d-none align-items-center gap-2 bulk-selected-toolbar" data-category="topbar_tools">
                <span class="badge badge-light-primary fw-bold fs-8"><span class="selected-count me-1">0</span>Dipilih</span>
                <button type="button" class="btn btn-xs btn-light-success py-1 px-3 btn-bulk-apply" data-action="enable_selected" data-category="topbar_tools" data-bs-toggle="tooltip" title="Aktifkan fitur yang dipilih">
                    <i class="ki-duotone ki-check fs-6 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                    <span class="d-none d-sm-inline">Aktifkan</span>
                </button>
                <button type="button" class="btn btn-xs btn-light-danger py-1 px-3 btn-bulk-apply" data-action="disable_selected" data-category="topbar_tools" data-bs-toggle="tooltip" title="Sembunyikan fitur yang dipilih">
                    <i class="ki-duotone ki-cross fs-6 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                    <span class="d-none d-sm-inline">Sembunyikan</span>
                </button>
            </div>

            <!-- Checkbox Pilih Semua -->
            <div class="form-check form-check-custom form-check-solid form-check-sm">
                <input class="form-check-input select-all-section-checkbox" type="checkbox" data-category="topbar_tools" id="select_all_topbar_tools" />
                <label class="form-check-label fs-7 fw-semibold text-gray-700 cursor-pointer" for="select_all_topbar_tools">Pilih Semua</label>
            </div>
        </div>
    </div>

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
                                <span class="badge {{ $fitur->is_enabled ? 'badge-light-success' : 'badge-light-danger' }} fs-8 fw-semibold feature-status-badge mt-1">
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

<!-- ============================================== -->
<!-- SECTION 2: MENU UTAMA DI TOPBAR HEADER         -->
<!-- ============================================== -->
<div class="mb-10">
    <div class="d-flex align-items-center justify-content-between mb-5 gap-3 pb-2 border-bottom flex-wrap">
        <div class="pe-2">
            <h4 class="fw-bolder text-gray-900 m-0">2. Menu Utama di Topbar Header</h4>
            <span class="text-muted fs-7">Navigasi horizontal utama di bilah header atas (mulai dari menu Dashboard hingga Help).</span>
        </div>
        <div class="d-flex align-items-center gap-3 ms-auto flex-shrink-0">
            <!-- Dynamic Bulk Action Toolbar (Muncul saat ada item diceklis) -->
            <div class="d-none align-items-center gap-2 bulk-selected-toolbar" data-category="topbar_menus">
                <span class="badge badge-light-primary fw-bold fs-8"><span class="selected-count me-1">0</span>Dipilih</span>
                <button type="button" class="btn btn-xs btn-light-success py-1 px-3 btn-bulk-apply" data-action="enable_selected" data-category="topbar_menus" data-bs-toggle="tooltip" title="Aktifkan fitur yang dipilih">
                    <i class="ki-duotone ki-check fs-6 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                    <span class="d-none d-sm-inline">Aktifkan</span>
                </button>
                <button type="button" class="btn btn-xs btn-light-danger py-1 px-3 btn-bulk-apply" data-action="disable_selected" data-category="topbar_menus" data-bs-toggle="tooltip" title="Sembunyikan fitur yang dipilih">
                    <i class="ki-duotone ki-cross fs-6 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                    <span class="d-none d-sm-inline">Sembunyikan</span>
                </button>
            </div>

            <!-- Checkbox Pilih Semua -->
            <div class="form-check form-check-custom form-check-solid form-check-sm">
                <input class="form-check-input select-all-section-checkbox" type="checkbox" data-category="topbar_menus" id="select_all_topbar_menus" />
                <label class="form-check-label fs-7 fw-semibold text-gray-700 cursor-pointer" for="select_all_topbar_menus">Pilih Semua</label>
            </div>
        </div>
    </div>

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
                                <span class="badge {{ $fitur->is_enabled ? 'badge-light-success' : 'badge-light-danger' }} fs-8 fw-semibold feature-status-badge mt-1">
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

<!-- ============================================== -->
<!-- SECTION 3: MENU TEMPLATE DI SIDEBAR            -->
<!-- ============================================== -->
<div class="mb-5">
    <div class="d-flex align-items-center justify-content-between mb-5 gap-3 pb-2 border-bottom flex-wrap">
        <div class="pe-2">
            <h4 class="fw-bolder text-gray-900 m-0">3. Menu Template di Sidebar</h4>
            <span class="text-muted fs-7">Blok section menu vertikal di sidebar kiri (mulai dari label Dashboard hingga Help).</span>
        </div>
        <div class="d-flex align-items-center gap-3 ms-auto flex-shrink-0">
            <!-- Dynamic Bulk Action Toolbar (Muncul saat ada item diceklis) -->
            <div class="d-none align-items-center gap-2 bulk-selected-toolbar" data-category="sidebar_menus">
                <span class="badge badge-light-primary fw-bold fs-8"><span class="selected-count me-1">0</span>Dipilih</span>
                <button type="button" class="btn btn-xs btn-light-success py-1 px-3 btn-bulk-apply" data-action="enable_selected" data-category="sidebar_menus" data-bs-toggle="tooltip" title="Aktifkan fitur yang dipilih">
                    <i class="ki-duotone ki-check fs-6 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                    <span class="d-none d-sm-inline">Aktifkan</span>
                </button>
                <button type="button" class="btn btn-xs btn-light-danger py-1 px-3 btn-bulk-apply" data-action="disable_selected" data-category="sidebar_menus" data-bs-toggle="tooltip" title="Sembunyikan fitur yang dipilih">
                    <i class="ki-duotone ki-cross fs-6 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                    <span class="d-none d-sm-inline">Sembunyikan</span>
                </button>
            </div>

            <!-- Checkbox Pilih Semua -->
            <div class="form-check form-check-custom form-check-solid form-check-sm">
                <input class="form-check-input select-all-section-checkbox" type="checkbox" data-category="sidebar_menus" id="select_all_sidebar_menus" />
                <label class="form-check-label fs-7 fw-semibold text-gray-700 cursor-pointer" for="select_all_sidebar_menus">Pilih Semua</label>
            </div>
        </div>
    </div>

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
                                <span class="badge {{ $fitur->is_enabled ? 'badge-light-success' : 'badge-light-danger' }} fs-8 fw-semibold feature-status-badge mt-1">
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
