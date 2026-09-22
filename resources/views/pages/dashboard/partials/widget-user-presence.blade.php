@php
    $presenceResult = \App\Services\UserManagement\UserPresenceService::getDashboardUsersPresence(auth()->user(), 8, 'all');
    $presenceUsers = $presenceResult['users'];
    $presenceStats = $presenceResult['stats'];
@endphp

<!--begin::User Presence & Social Widget-->
<div class="card card-flush shadow-sm border-0 mb-6" id="dashboard_presence_widget">
    <!--begin::Header-->
    <div class="card-header pt-5 pb-3 border-0 min-h-auto d-flex align-items-center justify-content-between flex-nowrap gap-2">
        <div class="card-title d-flex flex-column min-w-0 me-2">
            <div class="d-flex align-items-center gap-2">
                <span class="bullet bullet-vertical bg-primary h-20px w-4px"></span>
                <h3 class="fw-bolder text-gray-900 fs-5 mb-0 text-truncate">Pengguna &amp; Teman</h3>
            </div>
            <span class="text-muted fw-semibold fs-8 mt-1 text-truncate">Status realtime &amp; aktivitas pengguna</span>
        </div>
        <div class="card-toolbar m-0 flex-shrink-0 d-flex align-items-center gap-2">
            <!--begin::Live Online Pill-->
            <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 d-flex align-items-center gap-1 text-nowrap" id="presence_stat_online">
                <span class="w-6px h-6px rounded-circle bg-success"></span>
                {{ $presenceStats['online'] }} Online
            </span>
            <!--end::Live Online Pill-->

            <!--begin::Refresh Button-->
            <button type="button" class="btn btn-icon btn-sm btn-light btn-active-light-primary w-28px h-28px rounded-circle shadow-xs" id="btn_refresh_presence" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Segarkan Data Kehadiran">
                <i class="ki-duotone ki-arrows-circle fs-5"><span class="path1"></span><span class="path2"></span></i>
            </button>
            <!--end::Refresh Button-->
        </div>
    </div>
    <!--end::Header-->

    <!--begin::Filter Bar-->
    <div class="px-7 py-2">
        <div class="d-flex align-items-center justify-content-between gap-1 p-1 bg-light rounded-2 border border-gray-200">
            <button type="button" class="btn btn-xs presence-filter-btn active btn-primary text-white flex-grow-1 fw-bold fs-9 py-1 px-2 d-flex align-items-center justify-content-center gap-1" data-status="all">
                Semua (<span id="filter_count_all">{{ $presenceStats['total'] }}</span>)
            </button>
            <button type="button" class="btn btn-xs presence-filter-btn btn-light-primary text-muted flex-grow-1 fw-bold fs-9 py-1 px-2 d-flex align-items-center justify-content-center gap-1" data-status="online">
                Online (<span id="filter_count_online">{{ $presenceStats['online'] }}</span>)
            </button>
            <button type="button" class="btn btn-xs presence-filter-btn btn-light-primary text-muted flex-grow-1 fw-bold fs-9 py-1 px-2 d-flex align-items-center justify-content-center gap-1" data-status="idle">
                Idle (<span id="filter_count_idle">{{ $presenceStats['idle'] }}</span>)
            </button>
            <button type="button" class="btn btn-xs presence-filter-btn btn-light-primary text-muted flex-grow-1 fw-bold fs-9 py-1 px-2 d-flex align-items-center justify-content-center gap-1" data-status="offline">
                Offline (<span id="filter_count_offline">{{ $presenceStats['offline'] }}</span>)
            </button>
        </div>
    </div>
    <!--end::Filter Bar-->

    <!--begin::Body-->
    <div class="card-body pt-3 pb-4 px-6">
        <!--begin::User Items Container (Live Updated via JS)-->
        <div id="presence_users_list" class="max-h-450px overflow-auto pe-1">
            @include('pages.dashboard.partials.widget-user-presence-items', ['presenceUsers' => $presenceUsers])
        </div>
        <!--end::User Items Container-->
    </div>
    <!--end::Body-->

    <!--begin::Footer-->
    <div class="card-footer py-3 px-6 bg-light bg-opacity-50 border-top d-flex align-items-center justify-content-between">
        <span class="text-muted fs-8 fw-semibold">
            Total Terdaftar: <strong class="text-gray-800" id="presence_stat_total">{{ $presenceStats['total'] }}</strong> Pengguna
        </span>
        <span class="text-muted fs-8 d-flex align-items-center gap-1">
            <i class="ki-duotone ki-people fs-6 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
            Komunitas Aktif
        </span>
    </div>
    <!--end::Footer-->
</div>
<!--end::User Presence & Social Widget-->

<!--begin::Public User Profile Modal-->
@include('pages.dashboard.partials.modal-public-profile')
<!--end::Public User Profile Modal-->

