@php
    $userLogs = $logs ?? collect();
    $activeSessions = $sessions ?? [];
@endphp

<div class="row g-5 g-xl-10">
    <!--begin::Col Riwayat Sesi Login-->
    <div class="col-xl-5">
        <div class="card shadow-sm border border-gray-200 h-100 d-flex flex-column">
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
                <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                    <h3 class="fw-bolder text-gray-900 m-0 fs-4">Sesi Login Aktif</h3>
                    <span class="text-muted fs-7 mt-1">Daftar perangkat yang sedang mengakses akun</span>
                </div>
                <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                    <span class="badge badge-light-success fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                        Sesi Aktif
                    </span>
                </div>
            </div>
            <div class="card-body py-6 px-4 px-md-6 flex-grow-1">
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
        <div class="card shadow-sm border border-gray-200 h-100 d-flex flex-column">
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
                <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                    <h3 class="fw-bolder text-gray-900 m-0 fs-4">Riwayat Aktivitas &amp; Perubahan Data</h3>
                    <span class="text-muted fs-7 mt-1">Audit log riwayat tindakan pada akun Anda</span>
                </div>
                <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                    <span class="badge badge-light-info fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                        Audit Log
                    </span>
                </div>
            </div>
            <div class="card-body py-6 px-4 px-md-6 flex-grow-1">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted fs-7 text-uppercase">
                                <th class="min-w-150px">Aktivitas</th>
                                <th class="min-w-150px">Keterangan</th>
                                <th class="min-w-120px text-end">Waktu</th>
                            </tr>
                        </thead>
                        <tbody id="user_logs_tbody">
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
                                    <td colspan="3" class="text-center py-10">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="symbol symbol-55px symbol-circle bg-light-primary mb-3 d-flex align-items-center justify-content-center">
                                                <i class="ki-duotone ki-time fs-2x text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <span class="fs-6 fw-bold text-gray-800 mb-1">Belum Ada Rekaman Riwayat Aktivitas</span>
                                            <span class="fs-7 text-muted max-w-350px">Seluruh aktivitas login, pembaruan data identitas, atau perubahan kata sandi akun Anda akan tercatat otomatis di sini.</span>
                                        </div>
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
