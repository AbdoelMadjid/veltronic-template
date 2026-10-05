@php
    $topUsers = \App\Services\UserManagement\UserPresenceService::getTopLeaderboard(5);
@endphp

<!--begin::Leaderboard Widget-->
<div class="card card-flush shadow-sm border-0 h-100 mb-0" id="dashboard_leaderboard_widget">
    <!--begin::Header-->
    <div class="card-header pt-5 pb-3 border-0 min-h-auto d-flex align-items-center justify-content-between flex-nowrap gap-2">
        <div class="card-title d-flex flex-column min-w-0 me-2">
            <div class="d-flex align-items-center gap-2">
                <span class="bullet bullet-vertical bg-warning h-20px w-4px"></span>
                <h3 class="fw-bolder text-gray-900 fs-5 mb-0 text-truncate">Papan Peringkat</h3>
            </div>
            <span class="text-muted fw-semibold fs-8 mt-1 text-truncate">Pengguna paling aktif &amp; berprestasi</span>
        </div>
        <div class="card-toolbar m-0 flex-shrink-0">
            <span class="badge badge-light-warning fw-bold fs-8 px-2 py-1 d-flex align-items-center gap-1">
                <i class="ki-duotone ki-medal-star fs-6 text-warning"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                Top 5
            </span>
        </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-2 pb-4 px-6">
        @if(empty($topUsers))
            <div class="text-center py-6 text-muted fs-8">Belum ada data peringkat.</div>
        @else
            <div class="d-flex flex-column gap-3">
                @foreach($topUsers as $topUser)
                    @php
                        $rankClass = match($topUser['rank']) {
                            1 => 'bg-warning text-white',
                            2 => 'bg-secondary text-gray-800',
                            3 => 'bg-light-warning text-warning border border-warning',
                            default => 'bg-light text-muted',
                        };
                        $medalIcon = match($topUser['rank']) {
                            1 => '🥇',
                            2 => '🥈',
                            3 => '🥉',
                            default => "#{$topUser['rank']}",
                        };
                    @endphp
                    <div class="d-flex align-items-center justify-content-between p-2 rounded bg-hover-light transition-all">
                        <div class="d-flex align-items-center gap-3 overflow-hidden">
                            <!-- Rank Badge -->
                            <div class="symbol symbol-30px flex-shrink-0">
                                <span class="symbol-label fw-bold fs-7 {{ $rankClass }} rounded-circle">
                                    {{ $medalIcon }}
                                </span>
                            </div>

                            <!-- Avatar -->
                            <div class="symbol symbol-35px symbol-circle position-relative flex-shrink-0">
                                @if($topUser['has_avatar'] && $topUser['avatar_style'])
                                    <div class="symbol-label shadow-xs border border-2 border-body symbol-circle" style="{{ $topUser['avatar_style'] }}"></div>
                                @elseif($topUser['has_avatar'] && $topUser['avatar_url'])
                                    <div class="symbol-label shadow-xs border border-2 border-body symbol-circle" style="background-image: url('{{ $topUser['avatar_url'] }}'); background-size: cover; background-position: center;"></div>
                                @else
                                    <span class="symbol-label bg-light-primary text-primary fs-7 fw-bolder shadow-xs border border-2 border-body symbol-circle">
                                        {{ $topUser['initial'] }}
                                    </span>
                                @endif
                                @if($topUser['status'] === 'online')
                                    <div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="overflow-hidden text-start">
                                <a href="javascript:void(0)" class="fs-7 fw-bold text-gray-900 text-hover-primary d-block text-truncate btn-view-public-profile btn-open-public-profile" data-user-id="{{ $topUser['id'] }}">
                                    {{ $topUser['name'] }}
                                </a>
                            </div>
                        </div>

                        <!-- Points -->
                        <div class="text-end flex-shrink-0 ms-2">
                            <span class="badge badge-light-primary fw-bolder fs-8 px-2 py-1">
                                {{ number_format($topUser['points'], 0, ',', '.') }} pts
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <!--end::Body-->
</div>
<!--end::Leaderboard Widget-->
