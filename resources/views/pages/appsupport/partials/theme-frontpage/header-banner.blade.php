<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-wrap align-items-center justify-content-between gap-4">
        <!-- Sisi Kiri: Ikon, Judul, & Deskripsi -->
        <div class="d-flex align-items-center">
            <div class="symbol symbol-45px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center">
                <i class="ki-outline ki-screen text-primary fs-2"></i>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2">
                    <h2 class="fw-bolder text-gray-900 m-0 fs-3">Pengaturan Tema Halaman Depan (Frontpage)</h2>
                    <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1">
                        {{ strtoupper($currentFrontpage ?? 'LANDING') }}
                    </span>
                    @if(($currentFrontpage ?? 'landing') === 'landing')
                        <span class="badge badge-light-info fw-bold fs-8 px-2 py-1">
                            Versi {{ strtoupper($currentLandingVersion ?? 'V1') }}
                        </span>
                    @endif
                </div>
                <span class="text-muted fs-7">
                    Kelola pemilihan tema publik (Landing & Education), tata letak navigasi anchor, branding logo, serta dinamisasi section konten & footer.
                </span>
            </div>
        </div>

        <!-- Sisi Kanan: Tombol-tombol Aksi Utama -->
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-light-primary btn-sm fw-bold rounded-pill px-4">
                <i class="ki-outline ki-exit-right-corner fs-4 me-1"></i> Lihat Halaman Depan
            </a>
            <button type="button" class="btn btn-light-danger btn-sm fw-bold rounded-pill px-4" id="kt_btn_clear_frontpage_cache">
                <span class="indicator-label">
                    <i class="ki-outline ki-arrows-circle fs-4 me-1"></i> Bersihkan Cache
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-2"></span> Memproses...
                </span>
            </button>
            <button type="button" class="btn btn-light-warning btn-sm fw-bold rounded-pill px-4" id="kt_btn_reset_frontpage_all">
                <span class="indicator-label">
                    <i class="ki-outline ki-arrows-loop fs-4 me-1"></i> Reset Default
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-2"></span> Memproses...
                </span>
            </button>
        </div>
    </div>
</div>
<!--end::Header Banner-->
