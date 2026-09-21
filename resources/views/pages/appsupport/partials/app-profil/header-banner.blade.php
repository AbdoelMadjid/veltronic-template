<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 text-center text-md-start">
        <!-- Baris 1-3 di Mobile (Logo, Judul, Deskripsi) / Sisi Kiri di Desktop -->
        <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-4 w-100 w-md-auto">
            <!-- Baris 1: Logo / Ikon Utama -->
            <div class="symbol symbol-55px symbol-md-45px symbol-circle bg-light-primary mb-1 mb-md-0 me-0 me-md-4 d-flex align-items-center justify-content-center flex-shrink-0">
                <i class="ki-outline ki-setting-2 text-primary fs-2x fs-md-2"></i>
            </div>
            <!-- Baris 2 & 3: Judul & Deskripsi -->
            <div class="d-flex flex-column align-items-center align-items-md-start">
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">Profil & Identitas Aplikasi Dashboard</h2>
                <span class="text-muted fs-7 mt-1">Kelola nama sistem, data meta SEO, aset logo terang/gelap, favicon, dan footer dashboard secara realtime.</span>
            </div>
        </div>

        <!-- Baris 4: Kumpulan Tombol Aksi (Full tombol informatif di mobile, horizontal di desktop) -->
        <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-center justify-content-md-end gap-2 gap-md-3 w-100 w-md-auto mt-3 mt-md-0">
            <button type="button" class="btn btn-light-success btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px px-3 px-md-4 w-100 w-md-auto" id="kt_btn_sync_seeder">
                <span class="indicator-label d-inline-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-file-up fs-4 me-1"></i>
                    <span>Perbarui File Seeder</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                    <span>Menyimpan...</span>
                </span>
            </button>

            <button type="button" class="btn btn-light-primary btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px px-3 px-md-4 w-100 w-md-auto" id="kt_btn_run_seeder">
                <span class="indicator-label d-inline-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-arrows-circle fs-4 me-1"></i>
                    <span>Jalankan Seeder</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                    <span>Memproses...</span>
                </span>
            </button>

            <button type="button" class="btn btn-light-danger btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px px-3 px-md-4 w-100 w-md-auto" id="kt_btn_clear_profile_cache">
                <span class="indicator-label d-inline-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-trash fs-4 me-1"></i>
                    <span>Bersihkan Cache</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                    <span>Memproses...</span>
                </span>
            </button>

            <a href="{{ url('/dashboard') }}" target="_blank" class="btn btn-primary btn-sm fw-bold d-inline-flex align-items-center justify-content-center h-35px px-3 px-md-4 w-100 w-md-auto">
                <i class="ki-outline ki-external-drive fs-4 me-1"></i>
                <span>Lihat Dashboard</span>
            </a>
        </div>
    </div>
</div>
<!--end::Header Banner-->
