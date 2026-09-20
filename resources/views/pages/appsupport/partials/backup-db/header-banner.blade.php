<!--begin::Database Backup Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 text-center text-md-start">
        <!-- Baris 1-3 di Mobile (Logo, Judul, Deskripsi) / Sisi Kiri di Desktop -->
        <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-4 w-100 w-md-auto">
            <!-- Baris 1: Logo / Ikon Utama (Ukuran Lebih Besar di Mobile) -->
            <div class="symbol symbol-55px symbol-md-45px symbol-circle bg-light-primary mb-1 mb-md-0 me-0 me-md-4 d-flex align-items-center justify-content-center flex-shrink-0">
                <i class="ki-outline ki-data text-primary fs-2x fs-md-2"></i>
            </div>
            <!-- Baris 2 & 3: Judul & Deskripsi -->
            <div class="d-flex flex-column align-items-center align-items-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 flex-wrap">
                    <h2 class="fw-bolder text-gray-900 m-0 fs-3">Manajemen Cadangan & Relasi Database</h2>
                    <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1">{{ $overview['driver'] ?? 'MYSQL' }} ({{ $overview['database_name'] ?? 'DB' }})</span>
                </div>
                <span class="text-muted fs-7 mt-1">
                    Inspeksi struktur relasi foreign key antar tabel, buat cadangan penuh atau selektif, dan konfigurasi penjadwalan otomatis.
                </span>
            </div>
        </div>

        <!-- Baris 4: Kumpulan Tombol Aksi (Icon-only di mobile dengan Tooltip Hover) / Sisi Kanan di Desktop -->
        <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-2 gap-md-3 w-100 w-md-auto mt-2 mt-md-0 flex-wrap flex-md-nowrap">
            <button type="button" class="btn btn-light-primary btn-sm fw-bold px-3 px-md-4" id="kt_btn_refresh_tables"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Segarkan Data Tabel & Relasi">
                <span class="indicator-label">
                    <i class="ki-outline ki-arrows-circle fs-4 me-0 me-md-1"></i>
                    <span class="d-none d-md-inline">Segarkan Data</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-1"></span>
                    <span class="d-none d-md-inline">Memuat...</span>
                </span>
            </button>

            <button type="button" class="btn btn-light-success btn-sm fw-bold px-3 px-md-4" id="kt_btn_test_auto_backup"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Jalankan Uji Coba Backup Otomatis">
                <span class="indicator-label">
                    <i class="ki-outline ki-timer fs-4 me-0 me-md-1"></i>
                    <span class="d-none d-md-inline">Uji Auto-Backup</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-1"></span>
                    <span class="d-none d-md-inline">Memproses...</span>
                </span>
            </button>
        </div>
    </div>
</div>
<!--end::Database Backup Header Banner-->

<!--begin::Overview Statistics Widgets-->
<div class="row g-3 g-md-5 g-xl-6 mb-6">
    <!-- Total Tabel -->
    <div class="col-6 col-md-3">
        <div class="card card-flush h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column justify-content-between p-4 p-md-6">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold fs-8 fs-md-7 text-uppercase">Total Tabel DB</span>
                    <span class="badge badge-light-primary fs-9 fs-md-8 fw-bolder">{{ count($tables) }} Tables</span>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <span class="fs-2 fs-md-2hx fw-boldest text-gray-900" id="stat_total_tables">{{ $overview['total_tables'] ?? count($tables) }}</span>
                    <span class="text-muted fs-8 fs-md-7 d-none d-sm-inline">Entitas skema</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Baris Data -->
    <div class="col-6 col-md-3">
        <div class="card card-flush h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column justify-content-between p-4 p-md-6">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold fs-8 fs-md-7 text-uppercase">Total Rekaman</span>
                    <span class="badge badge-light-success fs-9 fs-md-8 fw-bolder">Records</span>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <span class="fs-2 fs-md-2hx fw-boldest text-gray-900" id="stat_total_rows">{{ number_format($overview['total_rows'] ?? 0) }}</span>
                    <span class="text-muted fs-8 fs-md-7 d-none d-sm-inline">Baris aktif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Relasi Foreign Key -->
    <div class="col-6 col-md-3">
        <div class="card card-flush h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column justify-content-between p-4 p-md-6">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold fs-8 fs-md-7 text-uppercase">Relasi FK</span>
                    <span class="badge badge-light-info fs-9 fs-md-8 fw-bolder">Relations</span>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <span class="fs-2 fs-md-2hx fw-boldest text-gray-900" id="stat_total_relations">{{ $overview['total_relations'] ?? 0 }}</span>
                    <span class="text-muted fs-8 fs-md-7 d-none d-sm-inline">Hubungan FK</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Ukuran Skema DB -->
    <div class="col-6 col-md-3">
        <div class="card card-flush h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column justify-content-between p-4 p-md-6">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold fs-8 fs-md-7 text-uppercase">Ukuran Database</span>
                    <span class="badge badge-light-warning fs-9 fs-md-8 fw-bolder">MB</span>
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <span class="fs-2 fs-md-2hx fw-boldest text-gray-900" id="stat_total_size">{{ $overview['total_size_mb'] ?? 0 }}</span>
                    <span class="text-muted fs-8 fs-md-7 d-none d-sm-inline">Megabytes</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Overview Statistics Widgets-->
