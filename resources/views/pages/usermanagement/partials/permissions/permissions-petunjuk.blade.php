<!--begin::Petunjuk Operasional Permissions-->
<div class="card card-flush shadow-sm border-0 mb-6 bg-light-primary">
    <div class="card-body py-6 px-8">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-4">
            <div>
                <h4 class="fw-bolder text-gray-900 m-0 fs-3">Manajemen Izin Akses Sistem (Permissions)</h4>
                <span class="text-muted fs-7 d-block mt-1">
                    Daftar izin operasional granular berbasis Spatie Permission untuk mengontrol hak eksekusi Create, Read, Update, dan Delete di setiap fitur.
                </span>
            </div>
            <div class="d-flex align-items-center gap-2 flex-shrink-0 ms-md-auto">
                <span class="badge badge-primary fw-bold fs-8 px-3 py-2">Konvensi: modul.aksi</span>
            </div>
        </div>

        <div class="separator separator-dashed my-4"></div>

        <div class="row g-4 text-gray-700 fs-7">
            <div class="col-md-4">
                <div class="p-3 bg-white rounded border border-gray-200 h-100">
                    <strong class="text-gray-900 d-block mb-1">1. Format Standar Penamaan</strong>
                    Gunakan format titik pemisah <code>kategori.modul.aksi</code> (contoh: <code>appsupport.menu.create</code>, <code>usermanagement.users.delete</code>).
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-white rounded border border-gray-200 h-100">
                    <strong class="text-gray-900 d-block mb-1">2. Generate Otomatis</strong>
                    Gunakan tombol "Generate CRUD Modul" untuk langsung membuat 4 izin standar (create, read, update, delete) sekaligus.
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-white rounded border border-gray-200 h-100">
                    <strong class="text-gray-900 d-block mb-1">3. Integrasi Middleware</strong>
                    Izin yang terdaftar otomatis dapat diproteksi di Blade via <code>@@can('nama.izin')</code> dan Controller via <code>permission:nama.izin</code>.
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Petunjuk Operasional Permissions-->
