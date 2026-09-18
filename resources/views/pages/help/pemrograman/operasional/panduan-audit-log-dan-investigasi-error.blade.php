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
            Operasional
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <div class="schema-shell">
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Operational Guide</span>
                    <h2 class="fw-bold">Panduan Pengelolaan Audit Log &amp; Investigasi Error Backend</h2>
                    <p class="schema-lead">
                        Prosedur operasional standar (SOP) untuk memantau jejak aktivitas pengguna, menganalisis kegagalan sistem secara cepat, memfilter log berdasarkan tingkat keparahan, serta menginspeksi payload teknis.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Memantau Log Sistem-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Memantau Log Sistem di Menu Fitur Aplikasi</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Langkah 1: Buka Tab Log Aktivitas</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Navigasikan ke menu <strong>App Support &rarr; Fitur &amp; Setting</strong>, lalu klik tab <strong>"Log Aktivitas Sistem"</strong>.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 2: Pantau 6 Kartu Statistik Realtime</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Periksa metrik Total Log, Error, Warning, Info, Aksi CRUD, dan Aktivitas Hari Ini di bagian atas halaman.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 3: Filter Berdasarkan Kebutuhan</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Gunakan dropdown filter <strong>Modul</strong> (User Management, App Support, Profil) atau filter <strong>Level</strong> (Error, Warning, Info).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Investigasi Error Teknis-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Investigasi Error Teknis (Level: Error)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Langkah 1: Identifikasi Baris Berstatus Error</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Cari baris data dengan badge merah <strong>"Error"</strong> atau filter tabel dengan memilih Level = Error.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 2: Buka Modal Detail Log</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Klik tombol <strong>"Lihat Detail"</strong> (ikon mata <code>ki-eye</code>) pada baris error tersebut.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 3: Analisis Payload JSON &amp; Stack Trace</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Periksa nama file sumber, baris kode kegagalan (line number), parameter request, dan user pengakses untuk mendiagnosis bug.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Mencatat Log dari Kode Pengembang-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Menambahkan Perekaman Log di Modul Baru</h4>
                            <p class="text-gray-700 fs-7 mb-2">
                                Setiap kali membuat controller CRUD baru, tambahkan pencatatan log pada titik-titik krusial:
                            </p>
                            <pre class="schema-code"><code>// Di dalam method controller Anda:
try {
    // ... proses bisnis ...
    UserLog::record('masterdata', 'produk', 'create', 'Menambah produk baru: ' . $produk->nama, [
        'id' => $produk->id,
        'harga' => $produk->harga
    ]);
} catch (\Throwable $e) {
    UserLog::record('masterdata', 'produk', 'create_failed', $e->getMessage(), [
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ], 'error');
    throw $e;
}</code></pre>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Pembersihan Log Otomatis-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Kebijakan Pemeliharaan &amp; Retensi Log</h4>
                            <p class="text-gray-700 fs-7 mb-2">
                                Untuk menjaga performa database tetap optimal, log lama diarsipkan atau dibersihkan secara berkala:
                            </p>
                            <pre class="schema-code"><code># Menjalankan pembersihan log berusia > 30 hari via Artisan:
php artisan log:clean --days=30

# Scheduled Command berjalan otomatis setiap awal bulan via cron.</code></pre>
                            <div class="p-3 bg-light-primary rounded border border-primary border-dashed mt-3">
                                <span class="fs-8 text-primary fw-semibold d-block mb-1">
                                    <i class="ki-duotone ki-shield-tick text-primary fs-6 align-middle me-1"><span class="path1"></span><span class="path2"></span></i>
                                    Keamanan Data Sensitif:
                                </span>
                                <p class="fs-8 text-gray-700 mb-0">Jangan pernah menyertakan password mentah, token rahasia, atau nomor kartu kredit di dalam parameter <code>payload</code> log.</p>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Troubleshooting-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Panduan Cepat Eskalasi &amp; Penanganan Insiden</h4>
                            <div class="schema-grid">
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Level Info &amp; Warning</h5>
                                        <p class="fs-8 text-gray-700 mb-0">Aktivitas normal dan peringatan non-kritis (misal: validasi formulir gagal). Cukup dipantau secara mingguan.</p>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Level Error</h5>
                                        <p class="fs-8 text-gray-700 mb-0">Kegagalan query SQL, file not found, atau response API eksternal gagal. Lakukan investigasi dalam 1x24 jam.</p>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Level Critical</h5>
                                        <p class="fs-8 text-gray-700 mb-0">Database crash atau outage sistem total. Segera rujuk ke <strong>Playbook Incident Response</strong>.</p>
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
