@extends('layouts.index')

@section('styles')
    @include('pages.help.pemrograman._schema-ui')
@endsection

@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Help
        @endslot
        @slot('li_2')
            Skema Pemrograman
        @endslot
        @slot('li_3')
            Skema
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <div class="schema-shell">
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Database &amp; Resilience Architecture</span>
                    <h2 class="fw-bold">Skema Backup Database &amp; Relasi Tabel Dinamis</h2>
                    <p class="schema-lead">
                        Blueprint arsitektur manajemen pencadangan basis data (<em>Database Backup Engine</em>), inspeksi relasi foreign key dinamis, deteksi urutan ketergantungan tabel (<em>Dependency Tree</em>), serta mekanisme restore aman.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Dual-Engine Backup Architecture-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Arsitektur Dual-Engine Backup (mysqldump &amp; Pure PHP)</h4>
                            <p class="text-gray-700 fs-7">
                                Engine backup dirancang adaptif terhadap beragam lingkungan hosting (Shared Hosting, VPS, Docker, Laragon):
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Primary Engine (mysqldump CLI):</strong>
                                    <p class="fs-8 text-muted mb-1">Jika binary <code>mysqldump</code> tersedia pada PATH sistem, eksekusi CLI dijalankan untuk kecepatan dan efisiensi memori maksimal.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Fallback Engine (Pure PHP Chunking Dump):</strong>
                                    <p class="fs-8 text-muted mb-1">Jika <code>exec()</code> atau <code>mysqldump</code> tidak diizinkan oleh konfigurasi server, engine beralih otomatis ke generator SQL berbasis PHP chunking dengan proteksi timeout memori.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Gzip Compression &amp; Format Penamaan:</strong>
                                    <p class="fs-8 text-muted mb-0">File disimpan dalam direktori aman <code>storage/app/backups/</code> dengan format <code>backup_{database}_{Y-m-d_H-i-s}.sql.gz</code>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Inspector Relasi Tabel & Foreign Keys-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Database Relation &amp; Foreign Key Inspector</h4>
                            <p class="text-gray-700 fs-7">
                                Modul <code>BackupDbController</code> memindai metadata skema secara realtime dari <code>information_schema</code>:
                            </p>
                            <pre class="schema-code"><code>// Query Analisis Relasi Tabel:
SELECT 
    TABLE_NAME, 
    COLUMN_NAME, 
    CONSTRAINT_NAME, 
    REFERENCED_TABLE_NAME, 
    REFERENCED_COLUMN_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = DATABASE() 
  AND REFERENCED_TABLE_NAME IS NOT NULL;</code></pre>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">Foreign Key Tree</span>
                                <span class="schema-chip">Row Count &amp; Data Size</span>
                                <span class="schema-chip">Engine Metadata</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Urutan Ketergantungan Restore-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Topological Sort &amp; Urutan Restore Aman</h4>
                            <p class="text-gray-700 fs-7">
                                Untuk mencegah kegagalan <em>Foreign Key Constraint Violated</em> saat restore data:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>1. Nonaktifkan FK Checks:</strong>
                                    <p class="fs-8 text-muted mb-1">Header SQL dump selalu diawali dengan <code>SET FOREIGN_KEY_CHECKS=0;</code> dan diakhiri dengan <code>SET FOREIGN_KEY_CHECKS=1;</code>.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>2. Dependency Graph Sorting:</strong>
                                    <p class="fs-8 text-muted mb-1">Tabel master independen (misal: <code>roles</code>, <code>permissions</code>) diekspor/diimpor sebelum tabel transaksi turunan (misal: <code>model_has_roles</code>, <code>users_logs</code>).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>3. Transaction Wrap (ACID Safe):</strong>
                                    <p class="fs-8 text-muted mb-0">Setiap batch impor dibungkus dalam transaksi database untuk mencegah kerusakan data parsial jika terjadi kegagalan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Pengaturan Retensi & Auto Backup-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Konfigurasi Otomatis &amp; Kebijakan Retensi</h4>
                            <p class="text-gray-700 fs-7">
                                Konfigurasi jadwal dan pembersihan otomatis disimpan di <code>app_settings</code>:
                            </p>
                            <pre class="schema-code"><code>// Konfigurasi Disimpan di app_settings:
{
    "auto_backup_enabled": true,
    "backup_frequency": "daily",       // daily, weekly, monthly
    "backup_time": "02:00",
    "max_backups_retention": 7,        // Simpan 7 backup terakhir
    "notify_on_failure": true
}

// Scheduled Task di app/Console/Kernel.php:
$schedule->command('backup:auto-run')
         ->dailyAt('02:00')
         ->when(fn() => AppSetting::get('auto_backup_enabled', false));</code></pre>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Komponen & API Endpoint-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Daftar Endpoint API &amp; Komponen Partials (<code>appsupport/backup-db</code>)</h4>
                            <div class="schema-grid">
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Endpoint Rute Admin</h5>
                                        <ul class="fs-8 text-gray-700 mb-0 ps-3">
                                            <li class="mb-1"><code>GET /appsupport/backup-db</code>: Halaman dashboard backup.</li>
                                            <li class="mb-1"><code>GET /appsupport/backup-db/tables</code>: JSON daftar tabel &amp; relasi.</li>
                                            <li class="mb-1"><code>POST /appsupport/backup-db/create</code>: Buat backup instan.</li>
                                            <li class="mb-1"><code>GET /appsupport/backup-db/download/{file}</code>: Unduh file backup.</li>
                                            <li class="mb-1"><code>POST /appsupport/backup-db/restore</code>: Pulihkan database dari arsip.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Struktur Partials Blade</h5>
                                        <ul class="fs-8 text-gray-700 mb-0 ps-3">
                                            <li class="mb-1"><code>_tables-list.blade.php</code>: Tabel metrik ukuran &amp; baris data.</li>
                                            <li class="mb-1"><code>_relation-modal.blade.php</code>: Modal inspeksi relasi foreign key.</li>
                                            <li class="mb-1"><code>_backup-files.blade.php</code>: Tabel daftar arsip file cadangan.</li>
                                            <li class="mb-1"><code>_settings-modal.blade.php</code>: Modal pengaturan auto-backup.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 5-->
                </div>
                <!--end::Grid-->
            </div>
        </div>
    </div>
@endsection
