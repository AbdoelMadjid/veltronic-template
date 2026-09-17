<!--begin::Stats Grid-->
<div class="row g-5 g-xl-8 mb-6">
    <!--begin::Stat Col 1: Total Riwayat Login-->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-flush shadow-sm border-0 h-100 bg-body">
            <div class="card-body p-5 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold fs-7 d-block mb-1">Total Sesi Login</span>
                    <h3 class="fw-bolder text-gray-900 fs-2hx m-0" id="stat_total_logins">{{ number_format($stats['total_logins'] ?? 0) }}</h3>
                    <span class="text-muted fs-8">Seluruh riwayat sesi tercatat</span>
                </div>
                <div class="symbol symbol-50px symbol-circle bg-light-primary d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-entrance-right text-primary fs-2hx"></i>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stat Col 1-->

    <!--begin::Stat Col 2: Login Web vs Layar Kunci-->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-flush shadow-sm border-0 h-100 bg-body">
            <div class="card-body p-5 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold fs-7 d-block mb-1">Metode Autentikasi</span>
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <span class="badge badge-light-primary fw-bold fs-7" id="stat_web_logins">{{ number_format($stats['web_logins'] ?? 0) }} Web</span>
                        <span class="badge badge-light-warning fw-bold fs-7" id="stat_lockscreen_logins">{{ number_format($stats['lockscreen_logins'] ?? 0) }} Kunci</span>
                    </div>
                    <span class="text-muted fs-8">Login Web vs Layar Kunci</span>
                </div>
                <div class="symbol symbol-50px symbol-circle bg-light-warning d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-lock text-warning fs-2hx"></i>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stat Col 2-->

    <!--begin::Stat Col 3: Poin Terbagikan 24 Jam-->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-flush shadow-sm border-0 h-100 bg-body">
            <div class="card-body p-5 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold fs-7 d-block mb-1">Reward Poin (24 Jam)</span>
                    <h3 class="fw-bolder text-success fs-2hx m-0" id="stat_total_points_earned">{{ number_format($stats['total_points_earned'] ?? 0) }} <span class="fs-6 fw-semibold text-muted">Poin</span></h3>
                    <span class="text-success fs-8 fw-semibold" id="stat_today_points_earned">+{{ number_format($stats['today_points_earned'] ?? 0) }} poin hari ini</span>
                </div>
                <div class="symbol symbol-50px symbol-circle bg-light-success d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-crown-2 text-success fs-2hx"></i>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stat Col 3-->

    <!--begin::Stat Col 4: Pengguna Aktif Hari Ini-->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-flush shadow-sm border-0 h-100 bg-body">
            <div class="card-body p-5 d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold fs-7 d-block mb-1">Pengguna Aktif Hari Ini</span>
                    <h3 class="fw-bolder text-gray-900 fs-2hx m-0" id="stat_active_users_today">{{ number_format($stats['active_users_today'] ?? 0) }}</h3>
                    <span class="text-muted fs-8">Pengguna yang login per hari ini</span>
                </div>
                <div class="symbol symbol-50px symbol-circle bg-light-info d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-people text-info fs-2hx"></i>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stat Col 4-->
</div>
<!--end::Stats Grid-->
