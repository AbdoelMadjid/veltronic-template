<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 text-center text-md-start">
        <!-- Baris 1-3 di Mobile (Logo, Judul, Deskripsi) / Sisi Kiri di Desktop -->
        <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-4 w-100 w-md-auto">
            <!-- Baris 1: Logo / Ikon Utama -->
            <div class="symbol symbol-55px symbol-md-45px symbol-circle bg-light-primary mb-1 mb-md-0 me-0 me-md-4 d-flex align-items-center justify-content-center flex-shrink-0">
                <i class="ki-outline ki-shield-search text-primary fs-2x fs-md-2"></i>
            </div>
            <!-- Baris 2 & 3: Judul & Deskripsi -->
            <div class="d-flex flex-column align-items-center align-items-md-start">
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">{{ $title ?? 'Riwayat Data Login Pengguna' }}</h2>
                <span class="text-muted fs-7 mt-1">{{ $subtitle ?? 'Pantau log aktivitas login, buka layar kunci (lock screen), dan reward 1 poin per 24 jam.' }}</span>
            </div>
        </div>

        <!-- Baris 4: Kumpulan Tombol Aksi (Full Button di Mobile & Desktop) / Sisi Kanan di Desktop -->
        <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-center justify-content-md-end gap-2 gap-md-3 w-100 w-md-auto mt-3 mt-md-0">
            <!--begin::Tombol Refresh-->
            <button type="button" class="btn btn-light-primary btn-sm fw-bold px-4 h-38px d-inline-flex align-items-center justify-content-center flex-grow-1 flex-md-grow-0 text-nowrap" id="kt_btn_refresh_data_login"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Segarkan Data">
                <span class="indicator-label d-inline-flex align-items-center">
                    <i class="ki-outline ki-arrows-circle fs-4 me-1"></i>
                    <span>Segarkan Data</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-1"></span>
                    <span>Memuat...</span>
                </span>
            </button>
            <!--end::Tombol Refresh-->

            <!--begin::Tombol Bersihkan Log-->
            <button type="button" class="btn btn-light-danger btn-sm fw-bold px-4 h-38px d-inline-flex align-items-center justify-content-center flex-grow-1 flex-md-grow-0 text-nowrap" id="kt_btn_clear_logs" data-bs-toggle="modal" data-bs-target="#kt_modal_clear_logs"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Bersihkan Log">
                <span class="indicator-label d-inline-flex align-items-center">
                    <i class="ki-outline ki-trash fs-4 me-1"></i>
                    <span>Bersihkan Log</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-1"></span>
                    <span>Memproses...</span>
                </span>
            </button>
            <!--end::Tombol Bersihkan Log-->
        </div>
    </div>
</div>
<!--end::Header Banner-->
