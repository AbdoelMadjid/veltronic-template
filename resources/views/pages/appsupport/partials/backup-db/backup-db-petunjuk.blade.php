<!--begin::Petunjuk Operasional Card-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <!--begin::Card header (Judul tanpa ikon sesuai aturan)-->
    <div class="card-header border-0 pt-6 px-6">
        <div>
            <h4 class="fw-bolder text-gray-900 m-0">Petunjuk Operasional & Panduan Modul Database Backup</h4>
            <span class="text-muted fs-8">Panduan komprehensif mengenai prosedur pencadangan, inspeksi relasi skema, dan pemulihan data aplikasi.</span>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4 px-6">
        <div class="row g-6">
            <!-- Seksi 1: Tujuan & Fungsi Modul -->
            <div class="col-lg-6">
                <div class="card card-bordered p-6 bg-light h-100">
                    <h5 class="fw-bolder text-gray-900 mb-3">1. Tujuan & Fungsi Modul</h5>
                    <p class="text-gray-700 fs-7 mb-3">
                        Modul ini dirancang untuk menjaga keberlangsungan data (*Data Continuity & Disaster Recovery*) sistem Veltronic. Pengguna dapat memantau keterhubungan antar tabel dalam database dan menghasilkan berkas dump SQL yang valid secara instan.
                    </p>
                    <ul class="text-gray-700 fs-7 ps-4 mb-0">
                        <li class="mb-2"><strong>Inspeksi Relasi Skema:</strong> Memetakan Foreign Key untuk mencegah terjadinya *orphaned data* saat proses migrasi atau backup sebagian.</li>
                        <li class="mb-2"><strong>Full vs Selective Backup:</strong> Mendukung pembuatan cadangan keseluruhan database maupun tabel spesifik yang dipilih.</li>
                        <li><strong>Kompresi GZIP:</strong> Mengurangi ukuran berkas hingga 80% untuk menghemat kapasitas penyimpanan server.</li>
                    </ul>
                </div>
            </div>

            <!-- Seksi 2: Alur Pembuatan Cadangan (Backup) -->
            <div class="col-lg-6">
                <div class="card card-bordered p-6 bg-light h-100">
                    <h5 class="fw-bolder text-gray-900 mb-3">2. Alur & Prosedur Pencadangan</h5>
                    <p class="text-gray-700 fs-7 mb-3">
                        Terdapat dua metode pencadangan data yang dapat digunakan sesuai kebutuhan:
                    </p>
                    <ul class="text-gray-700 fs-7 ps-4 mb-0">
                        <li class="mb-2"><strong>Backup Seluruh DB:</strong> Klik tombol "Backup Seluruh DB" pada toolbar tabel. Seluruh struktur (DDL) dan rekaman (DML) akan diekspor dalam satu berkas terpadu.</li>
                        <li class="mb-2"><strong>Backup Selektif:</strong> Centang satu atau beberapa checkbox tabel pada tabel skema, lalu klik "Backup Terpilih".</li>
                        <li><strong>Backup Satuan:</strong> Klik tombol ikon download pada kolom aksi baris tabel tertentu untuk mencadangkan tabel tersebut secara cepat.</li>
                    </ul>
                </div>
            </div>

            <!-- Seksi 3: Pemulihan Data & Keamanan (Disaster Recovery) -->
            <div class="col-lg-6">
                <div class="card card-bordered p-6 bg-light-warning h-100 border-warning border-opacity-25">
                    <h5 class="fw-bolder text-gray-900 mb-3">3. Pemulihan Data (Restore) & Catatan Kritis</h5>
                    <div class="notice d-flex bg-white rounded p-4 mb-3 border border-warning border-dashed">
                        <div class="fs-7 text-gray-800">
                            <strong>PERINGATAN RESTORE:</strong> Proses pemulihan data (*restore*) akan menimpa (*drop & recreate*) tabel yang ada di dalam database dengan data yang tersimpan pada berkas cadangan.
                        </div>
                    </div>
                    <ul class="text-gray-700 fs-7 ps-4 mb-0">
                        <li class="mb-2">Pastikan telah membuat cadangan terbaru sebelum melakukan proses <em>Restore</em>.</li>
                        <li class="mb-2">Proses restore menonaktifkan sementara Foreign Key Checks agar penyisipan data relasional berjalan tanpa konflik *foreign constraint*.</li>
                        <li>Jangan menutup peramban web selama proses restore berlangsung.</li>
                    </ul>
                </div>
            </div>

            <!-- Seksi 4: Otomatisasi & Cron Scheduler -->
            <div class="col-lg-6">
                <div class="card card-bordered p-6 bg-light h-100">
                    <h5 class="fw-bolder text-gray-900 mb-3">4. Penjadwalan Otomatis (Cron Scheduler)</h5>
                    <p class="text-gray-700 fs-7 mb-3">
                        Sistem mendukung eksekusi otomatis tanpa intervensi manual menggunakan Laravel Task Scheduling:
                    </p>
                    <ul class="text-gray-700 fs-7 ps-4 mb-0">
                        <li class="mb-2"><strong>Cron Server:</strong> Pastikan cron job server Laravel telah aktif: <code>* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1</code></li>
                        <li class="mb-2"><strong>Artisan Manual:</strong> Eksekusi cadangan otomatis dapat diuji manual melalui command <code>php artisan backup:auto-run</code>.</li>
                        <li><strong>Pembersihan Otomatis:</strong> Berkas yang usianya melebihi masa retensi (misal 7 hari) akan dibersihkan otomatis oleh sistem.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Petunjuk Operasional Card-->
