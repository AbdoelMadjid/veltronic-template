<!--begin::Petunjuk Operasional Modul Users-->
<div class="card card-flush border-0 bg-light-primary mb-6 shadow-sm">
    <div class="card-body py-6 px-8">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-4">
            <!-- Sisi Kiri: Judul & Deskripsi -->
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3">Petunjuk Operasional & Panduan Pengguna</h3>
                    <span class="badge badge-primary fw-bold fs-8 px-3 py-1">Modul User Management</span>
                </div>
                <span class="text-muted fs-7 d-block mt-1">
                    Pelajari alur operasional pengelolaan akun pengguna, struktur peran (*roles*), dan panduan penyaringan data.
                </span>
            </div>

            <!-- Sisi Kanan: Tombol Buka Detail Petunjuk (Right-Aligned & Responsive) -->
            <div class="d-flex align-items-center justify-content-end w-100 w-md-auto flex-shrink-0 ms-md-auto gap-2">
                <button type="button" class="btn btn-sm btn-light-primary fw-bold" data-bs-toggle="collapse"
                    data-bs-target="#kt_users_petunjuk_content" aria-expanded="false"
                    aria-controls="kt_users_petunjuk_content">
                    <span class="d-none d-sm-inline">Buka / Tutup Panduan</span>
                    <i class="ki-duotone ki-down fs-5 ms-0 ms-sm-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>
        </div>

        <!--begin::Collapse Content-->
        <div class="collapse mt-6" id="kt_users_petunjuk_content">
            <div class="separator separator-dashed my-4"></div>
            <div class="row g-6">
                <!-- Panduan 1: Otorisasi & Peran Pengguna -->
                <div class="col-md-4">
                    <div class="bg-body rounded p-5 h-100 border border-dashed border-gray-300">
                        <h5 class="fw-bolder text-gray-900 mb-3">1. Otorisasi & Peran Akun</h5>
                        <p class="text-muted fs-7 mb-3">
                            Setiap pengguna memiliki peran (*role*) yang mengatur hak akses modul dan izin tindakan dalam sistem:
                        </p>
                        <ul class="text-gray-700 fs-7 ps-4 mb-0 space-y-2">
                            <li><strong>Penugasan Peran:</strong> Peran dipilih saat membuat atau mengubah data akun pengguna.</li>
                            <li><strong>Izin Fitur:</strong> Hak akses menu dan fungsionalitas mengikuti konfigurasi peran yang berlaku.</li>
                            <li><strong>Dinamis:</strong> Penambahan atau perubahan daftar peran dapat dikelola fleksibel sesuai kebutuhan organisasi.</li>
                        </ul>
                    </div>
                </div>

                <!-- Panduan 2: Operasi CRUD & Zero-Reload -->
                <div class="col-md-4">
                    <div class="bg-body rounded p-5 h-100 border border-dashed border-gray-300">
                        <h5 class="fw-bolder text-gray-900 mb-3">2. Pengelolaan Akun Realtime</h5>
                        <p class="text-muted fs-7 mb-3">
                            Semua tindakan pada modul ini diproses secara instan tanpa me-reload halaman (*Zero-Reload*):
                        </p>
                        <ul class="text-gray-700 fs-7 ps-4 mb-0 space-y-2">
                            <li><strong>Tambah/Ubah:</strong> Gunakan modal untuk memperbarui profil dan foto avatar.</li>
                            <li><strong>Reset Sandi:</strong> Mengembalikan kata sandi ke standar <code>password123</code>.</li>
                            <li><strong>Hapus Akun:</strong> Akun yang dihapus bersifat permanen. Akun login Anda sendiri diproteksi dari penghapusan mandiri.</li>
                        </ul>
                    </div>
                </div>

                <!-- Panduan 3: Pencarian & Mode Tampilan -->
                <div class="col-md-4">
                    <div class="bg-body rounded p-5 h-100 border border-dashed border-gray-300">
                        <h5 class="fw-bolder text-gray-900 mb-3">3. Pencarian & Mode Tampilan</h5>
                        <p class="text-muted fs-7 mb-3">
                            Gunakan sidebar filter kiri untuk menyaring pengguna berdasarkan nama, email, peran, status verifikasi, dan urutan:
                        </p>
                        <ul class="text-gray-700 fs-7 ps-4 mb-0 space-y-2">
                            <li><strong>Card View:</strong> Menampilkan ringkasan visual kartu profil pengguna yang interaktif.</li>
                            <li><strong>Table View:</strong> Menampilkan tabel data yang mendukung sorting dan pencarian dinamis.</li>
                            <li><strong>Sidebar Filter:</strong> Klik <em>Terapkan Filter</em> untuk memperbarui daftar data secara realtime.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Collapse Content-->
    </div>
</div>
<!--end::Petunjuk Operasional Modul Users-->
