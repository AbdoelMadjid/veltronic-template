@php
    $userLogs = $logs ?? collect();
    $activeSessions = $sessions ?? [];
@endphp

<div class="row g-5 g-xl-10">
    <!--begin::Col Riwayat Sesi Login-->
    <div class="col-xl-5">
        <div class="card card-flush h-xl-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800 fs-4">Sesi Login Aktif</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-7">Daftar perangkat yang sedang mengakses akun</span>
                </h3>
            </div>
            <div class="card-body pt-5">
                @forelse ($activeSessions as $s)
                    <div class="d-flex align-items-center mb-6 pb-6 border-bottom border-gray-200">
                        <div class="symbol symbol-45px me-4">
                            <div class="symbol-label bg-light-primary text-primary">
                                <i class="ki-duotone ki-screen fs-2 text-primary">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                                </i>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-grow-1 pe-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-gray-800 fw-bold fs-6">{{ $s->ip_address ?? '127.0.0.1' }}</span>
                                <span class="badge badge-light-success fs-8">Aktif</span>
                            </div>
                            <span class="text-muted fs-7 text-truncate max-w-200px" title="{{ $s->user_agent }}">
                                {{ $s->user_agent ? Str::limit($s->user_agent, 35) : 'Browser Session' }}
                            </span>
                            <span class="text-gray-400 fs-8 mt-1">
                                Terakhir aktif: {{ date('d M Y, H:i', $s->last_activity) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="d-flex align-items-center mb-6">
                        <div class="symbol symbol-45px me-4">
                            <div class="symbol-label bg-light-primary text-primary">
                                <i class="ki-duotone ki-screen fs-2 text-primary">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                                </i>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-grow-1">
                            <span class="text-gray-800 fw-bold fs-6">Sesi Saat Ini</span>
                            <span class="text-muted fs-7">{{ request()->ip() }} &bull; Perangkat Aktif</span>
                        </div>
                        <span class="badge badge-light-success fs-8">Aktif</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!--end::Col Riwayat Sesi Login-->

    <!--begin::Col Log Aktivitas & Perubahan Data-->
    <div class="col-xl-7">
        <div class="card card-flush h-xl-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800 fs-4">Riwayat Aktivitas & Perubahan Data</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-7">Audit log riwayat tindakan pada akun Anda</span>
                </h3>
            </div>
            <div class="card-body pt-5">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted fs-7 text-uppercase">
                                <th class="min-w-150px">Aktivitas</th>
                                <th class="min-w-150px">Keterangan</th>
                                <th class="min-w-120px text-end">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($userLogs as $log)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-35px me-3">
                                                <span class="symbol-label bg-light-info text-info">
                                                    <i class="ki-duotone ki-abstract-26 fs-4">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 fw-bold fs-7">{{ $log->activity }}</span>
                                                <span class="text-gray-400 fs-8">{{ $log->ip_address ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-gray-600 fs-7">{{ $log->description ?? '-' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="text-gray-500 fs-8 fw-semibold">
                                            {{ $log->created_at ? $log->created_at->diffForHumans() : '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-8">
                                        <i class="ki-duotone ki-time fs-2tx text-gray-400 d-block mb-2">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        Belum ada rekaman riwayat aktivitas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end::Col Log Aktivitas & Perubahan Data-->
</div>
