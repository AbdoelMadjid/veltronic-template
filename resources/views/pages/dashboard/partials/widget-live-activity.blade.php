@php
    $activities = \App\Services\UserManagement\UserPresenceService::getActivityStream(5);
@endphp

<!--begin::Live Activity Stream Widget-->
<div class="card card-flush shadow-sm border-0 mb-6" id="dashboard_live_activity_widget">
    <!--begin::Header-->
    <div class="card-header pt-5 pb-3 border-0 min-h-auto d-flex align-items-center justify-content-between flex-nowrap gap-2">
        <div class="card-title d-flex flex-column min-w-0 me-2">
            <div class="d-flex align-items-center gap-2">
                <span class="bullet bullet-vertical bg-success h-20px w-4px"></span>
                <h3 class="fw-bolder text-gray-900 fs-5 mb-0 text-truncate">Aktivitas Komunitas</h3>
            </div>
            <span class="text-muted fw-semibold fs-8 mt-1 text-truncate">Aliran interaksi sosial terbaru</span>
        </div>
        <div class="card-toolbar m-0 flex-shrink-0">
            <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 d-flex align-items-center gap-1">
                <span class="w-6px h-6px rounded-circle bg-success"></span>
                Live
            </span>
        </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-2 pb-4 px-6">
        @if(empty($activities))
            <div class="text-center py-6 text-muted fs-8">Belum ada aktivitas tercatat.</div>
        @else
            <!--begin::Timeline-->
            <div class="timeline-label position-relative ps-6">
                @foreach($activities as $act)
                    <div class="timeline-item d-flex align-items-start mb-4 position-relative">
                        <!-- Timeline Point -->
                        <div class="timeline-point position-absolute start-0 top-0 mt-1 ms-n6 d-flex align-items-center justify-content-center bg-light-{{ $act['color'] }} text-{{ $act['color'] }} rounded-circle w-24px h-24px shadow-xs">
                            <i class="ki-duotone {{ $act['icon'] }} fs-7 text-{{ $act['color'] }}">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                        </div>

                        <!-- Content -->
                        <div class="timeline-content ps-2 overflow-hidden w-100">
                            <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                <span class="fs-8 fw-bolder text-gray-800">{{ $act['title'] }}</span>
                                <span class="fs-9 text-muted text-nowrap">{{ $act['time_human'] }}</span>
                            </div>
                            <div class="fs-8 text-muted text-break">
                                {!! $act['description'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--end::Timeline-->
        @endif
    </div>
    <!--end::Body-->
</div>
<!--end::Live Activity Stream Widget-->
