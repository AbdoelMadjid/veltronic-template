<!--begin::Database Backup Header Banner-->
<div class="card card-flush shadow-sm mb-6 border-0 bg-light-primary">
    <div class="card-body py-7 px-8">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-4">
            <!-- Sisi Kiri: Judul & Deskripsi (Tanpa Ikon sesuai aturan) -->
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h2 class="fw-bolder text-gray-900 m-0 fs-2">Manajemen Cadangan & Relasi Database</h2>
                    <span class="badge badge-primary fw-bold fs-8 px-3 py-1">{{ $overview['driver'] ?? 'MYSQL' }} ({{ $overview['database_name'] ?? 'DB' }})</span>
                </div>
                <span class="text-muted fs-7 d-block mt-1">
                    Inspeksi struktur relasi foreign key antar tabel, buat cadangan penuh atau selektif, dan konfigurasi penjadwalan otomatis.
                </span>
            </div>

            <!-- Sisi Kanan: Tombol Aksi Header (Rata Kanan & Responsif Mobile) -->
            <div class="d-flex align-items-center justify-content-end w-100 w-md-auto flex-shrink-0 ms-md-auto gap-2">
                <button type="button" class="btn btn-sm btn-light-primary fw-bold" id="kt_btn_refresh_tables"
                    data-bs-toggle="tooltip" title="Muat Ulang Data Tabel & Relasi">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-arrows-circle fs-5 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
                        <span class="d-none d-sm-inline">Segarkan Data</span>
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                        <span class="d-none d-sm-inline">Memuat...</span>
                    </span>
                </button>

                <button type="button" class="btn btn-sm btn-light-success fw-bold" id="kt_btn_test_auto_backup"
                    data-bs-toggle="tooltip" title="Jalankan Uji Coba Backup Otomatis Langsung">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-timer fs-5 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <span class="d-none d-sm-inline">Uji Auto-Backup</span>
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                        <span class="d-none d-sm-inline">Memproses...</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--end::Database Backup Header Banner-->

<!--begin::Overview Statistics Widgets-->
<div class="row g-5 g-xl-6 mb-6">
    <!-- Total Tabel -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-flush h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column justify-content-between p-6">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold fs-7 text-uppercase">Total Tabel DB</span>
                    <span class="badge badge-light-primary fs-8 fw-bolder">{{ count($tables) }} Tables</span>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <span class="fs-2hx fw-boldest text-gray-900" id="stat_total_tables">{{ $overview['total_tables'] ?? count($tables) }}</span>
                    <span class="text-muted fs-7">Entitas skema</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Baris Data -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-flush h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column justify-content-between p-6">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold fs-7 text-uppercase">Total Rekaman Data</span>
                    <span class="badge badge-light-success fs-8 fw-bolder">Records</span>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <span class="fs-2hx fw-boldest text-gray-900" id="stat_total_rows">{{ number_format($overview['total_rows'] ?? 0) }}</span>
                    <span class="text-muted fs-7">Baris data aktif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Relasi Foreign Key -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-flush h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column justify-content-between p-6">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold fs-7 text-uppercase">Relasi Foreign Keys</span>
                    <span class="badge badge-light-info fs-8 fw-bolder">Constraints</span>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <span class="fs-2hx fw-boldest text-gray-900" id="stat_total_relations">{{ $overview['total_relations'] ?? 0 }}</span>
                    <span class="text-muted fs-7">Hubungan relasional</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Ukuran Skema DB -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-flush h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column justify-content-between p-6">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold fs-7 text-uppercase">Ukuran Database</span>
                    <span class="badge badge-light-warning fs-8 fw-bolder">Data + Index</span>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <span class="fs-2hx fw-boldest text-gray-900" id="stat_total_size">{{ $overview['total_size_mb'] ?? 0 }}</span>
                    <span class="text-muted fs-7">Megabytes (MB)</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Overview Statistics Widgets-->
