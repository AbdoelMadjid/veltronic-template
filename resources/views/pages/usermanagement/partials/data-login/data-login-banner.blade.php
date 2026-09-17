<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-wrap align-items-center justify-content-between gap-4">
        <!-- Sisi Kiri: Ikon, Judul, & Deskripsi -->
        <div class="d-flex align-items-center">
            <div class="symbol symbol-45px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center">
                <i class="ki-outline ki-shield-search text-primary fs-2"></i>
            </div>
            <div>
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">{{ $title ?? 'Riwayat Data Login Pengguna' }}</h2>
                <span class="text-muted fs-7">{{ $subtitle ?? 'Pantau log aktivitas login, buka layar kunci (lock screen), dan reward 1 poin per 24 jam.' }}</span>
            </div>
        </div>

        <!-- Sisi Kanan: Tombol-tombol Aksi Utama -->
        <div class="d-flex align-items-center gap-3">
            <!--begin::Tombol Refresh-->
            <button type="button" class="btn btn-light-primary btn-sm fw-bold rounded-pill px-4" id="kt_btn_refresh_data_login">
                <span class="indicator-label">
                    <i class="ki-outline ki-arrows-circle fs-4 me-1"></i> Segarkan Data
                </span>
                <span class="indicator-progress">
                    Memuat... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <!--end::Tombol Refresh-->

            <!--begin::Tombol Bersihkan Log-->
            <button type="button" class="btn btn-light-danger btn-sm fw-bold rounded-pill px-4" id="kt_btn_clear_logs" data-bs-toggle="modal" data-bs-target="#kt_modal_clear_logs">
                <span class="indicator-label">
                    <i class="ki-outline ki-trash fs-4 me-1"></i> Bersihkan Log
                </span>
                <span class="indicator-progress">
                    Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <!--end::Tombol Bersihkan Log-->
        </div>
    </div>
</div>
<!--end::Header Banner-->
