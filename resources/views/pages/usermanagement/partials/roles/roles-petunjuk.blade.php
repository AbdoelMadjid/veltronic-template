<!--begin::Petunjuk Operasional Role-->
<div class="card card-flush shadow-sm border-0 mb-6 bg-light-primary">
    <div class="card-body py-6 px-8">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-4">
            <div>
                <h4 class="fw-bolder text-gray-900 m-0 fs-3">Manajemen Peran & Hak Akses (Roles)</h4>
                <span class="text-muted fs-7 d-block mt-1">
                    Kelola kelompok wewenang pengguna dalam sistem, tetapkan izin akses fitur (*Permissions*), dan kontrol batasan operasional setiap peran.
                </span>
            </div>
            <div class="d-flex align-items-center gap-2 flex-shrink-0 ms-md-auto">
                <span class="badge badge-primary fw-bold fs-8 px-3 py-2">Spatie RBAC Guard: web</span>
            </div>
        </div>

        <div class="separator separator-dashed my-4"></div>

        <div class="row g-4 text-gray-700 fs-7">
            <div class="col-md-4">
                <div class="p-3 bg-white rounded border border-gray-200 h-100">
                    <strong class="text-gray-900 d-block mb-1">1. Peran Sistem Bawaan</strong>
                    Role <code>master</code> dan <code>admin</code> merupakan peran vital inti sistem yang diproteksi dari penghapusan demi menjaga integritas aplikasi.
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-white rounded border border-gray-200 h-100">
                    <strong class="text-gray-900 d-block mb-1">2. Peran Kustom & Anggota</strong>
                    Anda dapat membuat peran tambahan sesuai struktur organisasi. Role yang masih memiliki anggota aktif wajib dialihkan terlebih dahulu sebelum dihapus.
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-white rounded border border-gray-200 h-100">
                    <strong class="text-gray-900 d-block mb-1">3. Sinkronisasi Izin Otomatis</strong>
                    Setiap perubahan izin pada peran akan langsung berdampak kepada seluruh pengguna yang memiliki peran tersebut secara realtime.
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Petunjuk Operasional Role-->
