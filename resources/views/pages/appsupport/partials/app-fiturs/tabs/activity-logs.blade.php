<!--begin::Activity Logs Tab-->
<div class="d-flex flex-column gap-6">

    <!--begin::Stats Summary Cards-->
    <div class="row g-5 g-xl-6">
        <!-- Total Log -->
        <div class="col-sm-6 col-xl-2">
            <div class="card card-flush bg-body border border-gray-200 shadow-sm h-100">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-2">
                        <div class="symbol symbol-40px symbol-circle bg-light-primary me-3">
                            <span class="symbol-label text-primary">
                                <i class="ki-outline ki-document fs-3"></i>
                            </span>
                        </div>
                        <div>
                            <span class="fs-7 fw-bold text-muted d-block">Total Rekaman</span>
                            <span class="fs-3 fw-bolder text-gray-900" id="stat_total_logs">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Log Hari Ini -->
        <div class="col-sm-6 col-xl-2">
            <div class="card card-flush bg-body border border-gray-200 shadow-sm h-100">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-2">
                        <div class="symbol symbol-40px symbol-circle bg-light-success me-3">
                            <span class="symbol-label text-success">
                                <i class="ki-outline ki-calendar-tick fs-3"></i>
                            </span>
                        </div>
                        <div>
                            <span class="fs-7 fw-bold text-muted d-block">Aktivitas Hari Ini</span>
                            <span class="fs-3 fw-bolder text-success" id="stat_today_logs">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backend Error Logs -->
        <div class="col-sm-6 col-xl-2">
            <div class="card card-flush bg-body border border-gray-200 shadow-sm h-100">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-2">
                        <div class="symbol symbol-40px symbol-circle bg-light-danger me-3">
                            <span class="symbol-label text-danger">
                                <i class="ki-outline ki-cross-circle fs-3"></i>
                            </span>
                        </div>
                        <div>
                            <span class="fs-7 fw-bold text-muted d-block">Backend Errors</span>
                            <span class="fs-3 fw-bolder text-danger" id="stat_error_logs">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management Logs -->
        <div class="col-sm-6 col-xl-2">
            <div class="card card-flush bg-body border border-gray-200 shadow-sm h-100">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-2">
                        <div class="symbol symbol-40px symbol-circle bg-light-info me-3">
                            <span class="symbol-label text-info">
                                <i class="ki-outline ki-people fs-3"></i>
                            </span>
                        </div>
                        <div>
                            <span class="fs-7 fw-bold text-muted d-block">User Mgmt</span>
                            <span class="fs-3 fw-bolder text-info" id="stat_um_logs">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- App Support Logs -->
        <div class="col-sm-6 col-xl-2">
            <div class="card card-flush bg-body border border-gray-200 shadow-sm h-100">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-2">
                        <div class="symbol symbol-40px symbol-circle bg-light-warning me-3">
                            <span class="symbol-label text-warning">
                                <i class="ki-outline ki-setting-3 fs-3"></i>
                            </span>
                        </div>
                        <div>
                            <span class="fs-7 fw-bold text-muted d-block">App Support</span>
                            <span class="fs-3 fw-bolder text-warning" id="stat_app_logs">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profil Pengguna Logs -->
        <div class="col-sm-6 col-xl-2">
            <div class="card card-flush bg-body border border-gray-200 shadow-sm h-100">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-2">
                        <div class="symbol symbol-40px symbol-circle bg-light-primary me-3">
                            <span class="symbol-label text-primary">
                                <i class="ki-outline ki-user fs-3"></i>
                            </span>
                        </div>
                        <div>
                            <span class="fs-7 fw-bold text-muted d-block">Profil User</span>
                            <span class="fs-3 fw-bolder text-primary" id="stat_profil_logs">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stats Summary Cards-->

    <!--begin::Main Table Card-->
    <div class="card card-flush bg-body border border-gray-200 shadow-sm">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5 text-gray-500"></i>
                    <input type="text" id="log_search_input" class="form-control form-control-solid w-250px w-md-300px ps-13"
                        placeholder="Cari aktivitas, user, IP..." />
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-3 flex-wrap">
                <!--begin::Filter Modul-->
                <div class="w-150px">
                    <select id="filter_log_module" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Semua Modul">
                        <option value="all">Semua Modul</option>
                        <option value="usermanagement">User Management</option>
                        <option value="appsupport">App Support</option>
                        <option value="profil">Profil Pengguna</option>
                        <option value="sistem">Sistem Backend</option>
                    </select>
                </div>
                <!--end::Filter Modul-->

                <!--begin::Filter Level-->
                <div class="w-130px">
                    <select id="filter_log_level" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Semua Level">
                        <option value="all">Semua Level</option>
                        <option value="info">Info</option>
                        <option value="success">Success</option>
                        <option value="warning">Warning</option>
                        <option value="error">Error</option>
                    </select>
                </div>
                <!--end::Filter Level-->

                <!--begin::Filter Date Range-->
                <div class="w-150px">
                    <select id="filter_log_date_range" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Semua Waktu">
                        <option value="">Semua Waktu</option>
                        <option value="today">Hari Ini</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="this_month">Bulan Ini</option>
                    </select>
                </div>
                <!--end::Filter Date Range-->

                <!--begin::Reset & Refresh-->
                <button type="button" class="btn btn-icon btn-light btn-active-light-primary" id="btn_reset_log_filter" data-bs-toggle="tooltip" title="Reset Semua Filter">
                    <i class="ki-outline ki-arrows-circle fs-3"></i>
                </button>
                <button type="button" class="btn btn-icon btn-light-primary" id="btn_refresh_logs" data-bs-toggle="tooltip" title="Muat Ulang Data">
                    <i class="ki-outline ki-arrows-loop fs-3"></i>
                </button>
                <!--end::Reset & Refresh-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_activity_logs_table">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-50px text-center">No</th>
                            <th class="min-w-175px">Pengguna / Pelaku</th>
                            <th class="min-w-120px">Modul & Menu</th>
                            <th class="min-w-200px">Aktivitas & Keterangan</th>
                            <th class="min-w-90px text-center">Level</th>
                            <th class="min-w-125px">IP & Perangkat</th>
                            <th class="min-w-150px">Waktu Kejadian</th>
                            <th class="text-end min-w-80px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        <!-- Data populated via AJAX DataTables -->
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Main Table Card-->

</div>
<!--end::Activity Logs Tab-->
