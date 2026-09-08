<!--begin::Stats Summary Bar-->
<div class="row g-4 mb-6">
    <div class="col-6 col-md-3 col-xl-2">
        <div class="card card-flush shadow-sm bg-body border-0 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-8 fw-bold text-muted text-uppercase">Fitur Aktif</span>
                <i class="ki-duotone ki-check-circle fs-4 text-success"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <h3 class="fs-2hx fw-bolder text-success m-0" id="stat_total_active">{{ $stats['active'] ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl-2">
        <div class="card card-flush shadow-sm bg-body border-0 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-8 fw-bold text-muted text-uppercase">Disembunyikan</span>
                <i class="ki-duotone ki-cross-circle fs-4 text-danger"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <h3 class="fs-2hx fw-bolder text-danger m-0" id="stat_total_disabled">{{ $stats['disabled'] ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl-2">
        <div class="card card-flush shadow-sm stat-summary-card bg-body border-0 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-8 fw-bold text-muted text-uppercase">Topbar Tools</span>
                <i class="ki-duotone ki-wrench fs-4 text-primary"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <h3 class="fs-2hx fw-bolder text-primary m-0" id="stat_topbar_active">{{ $stats['topbar_tools_active'] ?? 0 }}/{{ $stats['topbar_tools_total'] ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl-2">
        <div class="card card-flush shadow-sm stat-summary-card bg-body border-0 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-8 fw-bold text-muted text-uppercase">Header Menus</span>
                <i class="ki-duotone ki-row-horizontal fs-4 text-info"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <h3 class="fs-2hx fw-bolder text-info m-0" id="stat_topmenu_active">{{ $stats['topbar_menus_active'] ?? 0 }}/{{ $stats['topbar_menus_total'] ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl-2">
        <div class="card card-flush shadow-sm stat-summary-card bg-body border-0 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-8 fw-bold text-muted text-uppercase">Sidebar Sections</span>
                <i class="ki-duotone ki-menu fs-4 text-warning"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
            </div>
            <h3 class="fs-2hx fw-bolder text-warning m-0" id="stat_sidebar_active">{{ $stats['sidebar_menus_active'] ?? 0 }}/{{ $stats['sidebar_menus_total'] ?? 0 }}</h3>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl-2">
        <div class="card card-flush shadow-sm stat-summary-card bg-body border-0 p-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-8 fw-bold text-muted text-uppercase">Penyimpanan</span>
                <span class="badge badge-light-primary fs-9">Database</span>
            </div>
            <h3 class="fs-4 fw-bolder text-gray-800 m-0 pt-2">Zero FOUC</h3>
        </div>
    </div>
</div>
<!--end::Stats Summary Bar-->
