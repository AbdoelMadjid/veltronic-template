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
                    <span class="schema-pill">Audit &amp; Diagnostic Engine</span>
                    <h2 class="fw-bold">Skema Audit Log &amp; Perekaman Error Backend</h2>
                    <p class="schema-lead">
                        Arsitektur sentral untuk perekaman jejak aktivitas pengguna (<em>Audit Trail</em>), pencatatan otomatis kegagalan/exception sistem backend, visualisasi statistik log realtime, serta isolasi keamanan riwayat aktivitas profil.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Struktur Tabel users_logs-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Skema Database Terindeks (<code>users_logs</code>)</h4>
                            <p class="text-gray-700 fs-7">
                                Tabel <code>users_logs</code> didesain untuk pencatatan performa tinggi dengan indexing pada kolom-kolom filter utama:
                            </p>
                            <pre class="schema-code"><code>// Skema Migration users_logs
Schema::create('users_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->string('module', 50)->index();      // usermanagement, appsupport, profil, system
    $table->string('menu', 50)->nullable()->index(); // users, roles, permissions, backup-db, dll
    $table->string('action', 50)->index();      // create, update, delete, login, toggle, error
    $table->string('level', 20)->default('info')->index(); // info, warning, error, critical
    $table->text('description');               // Ringkasan aktivitas ramah manusia
    $table->json('payload')->nullable();       // Detail perubahan data / trace stack error
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->timestamps();
    
    // Composite Indexes untuk query filter kilat
    $table->index(['module', 'created_at']);
    $table->index(['level', 'created_at']);
});</code></pre>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">Indexed Query</span>
                                <span class="schema-chip">JSON Payload</span>
                                <span class="schema-chip">Nullable User FK</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Helper Universal UserLog-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Helper Perekaman Terpusat (<code>UserLog::record()</code>)</h4>
                            <p class="text-gray-700 fs-7">
                                Pengembang dapat mencatat aktivitas atau error dari controller manapun melalui satu baris kode tanpa boilerplate:
                            </p>
                            <pre class="schema-code"><code>use App\Models\UserManagement\UserLog;

// 1. Mencatat aktivitas sukses standar (Level: info)
UserLog::record(
    module: 'usermanagement',
    menu: 'roles',
    action: 'update',
    description: 'Mengubah izin akses pada Role: Editor',
    payload: ['role_id' => $role->id, 'new_permissions' => $permissions]
);

// 2. Mencatat peringatan keamanan (Level: warning)
UserLog::record(
    module: 'usermanagement',
    menu: 'users',
    action: 'blocked_attempt',
    description: 'Upaya akses ditolak karena tidak memiliki izin',
    level: 'warning'
);

// 3. Mencatat exception / kegagalan backend (Level: error)
UserLog::record(
    module: 'system',
    menu: 'backup-db',
    action: 'backup_failed',
    description: 'Gagal membuat file backup: ' . $e->getMessage(),
    payload: ['file' => $e->getFile(), 'line' => $e->getLine()],
    level: 'error'
);</code></pre>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Auto Exception Catcher di bootstrap/app.php-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Penangkapan Otomatis Error Backend (Global Catcher)</h4>
                            <p class="text-gray-700 fs-7">
                                Seluruh kegagalan atau unhandled exception pada aplikasi otomatis ditangkap pada level kernel tanpa menghentikan alur aplikasi:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Hook di <code>bootstrap/app.php</code>:</strong>
                                    <p class="fs-8 text-muted mb-1">Mendaftarkan closure <code>$exceptions->reportable(function (Throwable $e) { ... })</code>.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Pencegahan Loop Rekursif:</strong>
                                    <p class="fs-8 text-muted mb-1">Pengecekan khusus agar error koneksi database tidak memicu error baru saat menyimpan log.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Pencatatan Metadata Error:</strong>
                                    <p class="fs-8 text-muted mb-0">Menyimpan nama class Exception, pesan error, nama file sumber, baris kode (line), URL request aktif, dan data user yang sedang login.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Isolasi Hak Akses & Profil-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Isolasi Audit Profil &amp; Keamanan Privasi</h4>
                            <p class="text-gray-700 fs-7">
                                Mekanisme partisi data log untuk menjamin privasi dan keamanan sistem:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Tab Log Sistem (Master &amp; Admin):</strong>
                                    <p class="fs-8 text-muted mb-0">Dapat melihat seluruh aktivitas sistem lintas pengguna, ringkasan 6 metrik statistik (Total Log, Error, Warning, Info, Aksi CRUD, Log Hari Ini), serta tombol inspeksi payload teknis.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Tab Riwayat Profil Pengguna:</strong>
                                    <p class="fs-8 text-muted mb-0">Hanya menampilkan log yang berkaitan langsung dengan akun user yang login (<code>user_id = Auth::id()</code>) dan modul profil (<code>module = 'profil'</code>).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Zero-Reload Live Append:</strong>
                                    <p class="fs-8 text-muted mb-0">Setiap aksi pembaruan profil (ubah identitas, ganti password, ganti avatar) otomatis menyuntikkan baris timeline baru ke DOM secara realtime tanpa refresh.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Komponen Antarmuka & Filter-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Arsitektur Antarmuka &amp; DataTables Zero-Reload</h4>
                            <div class="schema-grid">
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Komponen Blade Partials</h5>
                                        <ul class="fs-8 text-gray-700 mb-0 ps-3">
                                            <li class="mb-1"><code>_logs.blade.php</code>: Tab kontainer utama di menu App Fitur.</li>
                                            <li class="mb-1"><code>_stats.blade.php</code>: 6 kartu metrik status log realtime.</li>
                                            <li class="mb-1"><code>_filter.blade.php</code>: Panel filter dinamis (Modul, Level, Rentang Tanggal).</li>
                                            <li class="mb-1"><code>_detail-modal.blade.php</code>: Modal inspeksi JSON payload &amp; request stack trace.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Engine DataTables Dinamis</h5>
                                        <pre class="schema-code mb-0"><code>// Endpoint DataTables AJAX:
GET /appsupport/app-fiturs/activity-logs?module=usermanagement&level=error

// Response Format:
{
    "draw": 1,
    "recordsTotal": 1420,
    "recordsFiltered": 18,
    "data": [ ... ]
}</code></pre>
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
