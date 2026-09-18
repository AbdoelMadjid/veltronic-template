<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-wrap align-items-center justify-content-between gap-4">
        <!-- Sisi Kiri: Ikon, Judul, & Deskripsi -->
        <div class="d-flex align-items-center">
            <div class="symbol symbol-45px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center">
                <i class="ki-outline ki-setting-2 text-primary fs-2"></i>
            </div>
            <div>
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">Profil & Identitas Aplikasi Dashboard</h2>
                <span class="text-muted fs-7">Kelola nama sistem, data meta SEO, aset logo terang/gelap, favicon, dan footer dashboard secara realtime.</span>
            </div>
        </div>

        <!-- Sisi Kanan: Tombol-tombol Aksi Utama / Badge Info -->
        <div class="d-flex align-items-center gap-3">
            <button type="button" class="btn btn-light-success btn-sm fw-bold rounded-pill px-4" id="kt_btn_sync_seeder" title="Perbarui file database/seeders/AppProfilSeeder.php dari konfigurasi aktif saat ini">
                <span class="indicator-label">
                    <i class="ki-outline ki-file-up fs-4 me-1"></i> Perbarui File Seeder
                </span>
                <span class="indicator-progress">
                    Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>

            <button type="button" class="btn btn-light-primary btn-sm fw-bold rounded-pill px-4" id="kt_btn_run_seeder" title="Jalankan ulang AppProfilSeeder untuk memuat ulang data default">
                <span class="indicator-label">
                    <i class="ki-outline ki-arrows-circle fs-4 me-1"></i> Jalankan Seeder
                </span>
                <span class="indicator-progress">
                    Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>

            <button type="button" class="btn btn-light-danger btn-sm fw-bold rounded-pill px-4" id="kt_btn_clear_profile_cache" title="Bersihkan cache profil & tampilan">
                <span class="indicator-label">
                    <i class="ki-outline ki-trash fs-4 me-1"></i> Bersihkan Cache
                </span>
                <span class="indicator-progress">
                    Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>

            <a href="{{ url('/dashboard') }}" target="_blank" class="btn btn-primary btn-sm fw-bold rounded-pill px-4" title="Buka dashboard untuk melihat hasil">
                <i class="ki-outline ki-external-drive fs-4 me-1"></i> Lihat Dashboard
            </a>
        </div>
    </div>
</div>
<!--end::Header Banner-->
