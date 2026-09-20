<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 text-center text-md-start">
        <!-- Baris 1-3 di Mobile (Logo, Judul, Deskripsi) / Sisi Kiri di Desktop -->
        <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-4 w-100 w-md-auto">
            <!-- Baris 1: Logo / Ikon Utama -->
            <div class="symbol symbol-55px symbol-md-45px symbol-circle bg-light-primary mb-1 mb-md-0 me-0 me-md-4 d-flex align-items-center justify-content-center flex-shrink-0">
                <i class="ki-outline ki-screen text-primary fs-2x fs-md-2"></i>
            </div>
            <!-- Baris 2 & 3: Judul & Deskripsi -->
            <div class="d-flex flex-column align-items-center align-items-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 flex-wrap">
                    <h2 class="fw-bolder text-gray-900 m-0 fs-3">Pengaturan Tema Halaman Depan</h2>
                    <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1">
                        {{ strtoupper($currentFrontpage ?? 'LANDING') }}
                    </span>
                    @if(($currentFrontpage ?? 'landing') === 'landing')
                        <span class="badge badge-light-info fw-bold fs-8 px-2 py-1">
                            Versi {{ strtoupper($currentLandingVersion ?? 'V1') }}
                        </span>
                    @endif
                </div>
                <span class="text-muted fs-7 mt-1">
                    Kelola pemilihan tema publik, tata letak navigasi anchor, branding logo, serta dinamisasi section konten & footer.
                </span>
            </div>
        </div>

        <!-- Baris 4: Kumpulan Tombol Aksi (Icon-only di mobile dengan Tooltip Hover) / Sisi Kanan di Desktop -->
        <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-2 gap-md-3 w-100 w-md-auto mt-2 mt-md-0 flex-wrap flex-md-nowrap">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-light-primary btn-sm fw-bold px-3 px-md-4"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Lihat Halaman Depan di Tab Baru">
                <i class="ki-outline ki-exit-right-corner fs-4 me-0 me-md-1"></i>
                <span class="d-none d-md-inline">Lihat Halaman Depan</span>
            </a>
            <button type="button" class="btn btn-light-danger btn-sm fw-bold px-3 px-md-4" id="kt_btn_clear_frontpage_cache"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Bersihkan Cache Tampilan Frontpage">
                <span class="indicator-label">
                    <i class="ki-outline ki-arrows-circle fs-4 me-0 me-md-1"></i>
                    <span class="d-none d-md-inline">Bersihkan Cache</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-1"></span>
                    <span class="d-none d-md-inline">Memproses...</span>
                </span>
            </button>
            <button type="button" class="btn btn-light-warning btn-sm fw-bold px-3 px-md-4" id="kt_btn_reset_frontpage_all"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Kembalikan Pengaturan ke Bawaan Sistem">
                <span class="indicator-label">
                    <i class="ki-outline ki-arrows-loop fs-4 me-0 me-md-1"></i>
                    <span class="d-none d-md-inline">Reset Default</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-1"></span>
                    <span class="d-none d-md-inline">Memproses...</span>
                </span>
            </button>
        </div>
    </div>
</div>
<!--end::Header Banner-->
