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
                    <h2 class="fw-bold">Panduan Operasional Backup &amp; Restore Database</h2>
                    <p class="schema-lead">
                        Panduan langkah demi langkah untuk membuat cadangan database secara manual maupun otomatis, mengunduh arsip SQL terkompresi, menginspeksi relasi tabel, serta melakukan prosedur pemulihan (<em>Restore</em>) yang aman.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Membuat Backup Manual-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Membuat Backup Database Instan (On-Demand)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Langkah 1: Masuk ke Modul Backup</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Buka menu <strong>App Support &rarr; Backup DB</strong> dari sidebar navigasi.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 2: Klik Tombol "Buat Backup Baru"</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Klik tombol aksi utama di header banner. Indikator loading spinner akan aktif selama proses pencadangan berlangsung.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 3: Konfirmasi File Berhasil Dibuat</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Setelah selesai, file arsip baru <code>backup_xxx.sql.gz</code> akan otomatis muncul di tabel riwayat cadangan tanpa reload halaman.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Mengunduh & Memeriksa Relasi-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Mengunduh File &amp; Inspeksi Relasi Tabel</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Mengunduh Arsip Cadangan:</strong>
                                    <p class="text-gray-600 fs-8 mb-1">Klik tombol <strong>"Download"</strong> pada baris backup yang diinginkan untuk menyimpan file <code>.sql.gz</code> ke komputer lokal.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Inspeksi Relasi Foreign Key:</strong>
                                    <p class="text-gray-600 fs-8 mb-1">Klik ikon link/relasi pada daftar tabel di panel kiri untuk membuka diagram modal struktur foreign key dan referensi tabel tujuan.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Pengecekan Ukuran Data:</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Pantau estimasi baris data dan ukuran fisik tabel untuk mengidentifikasi tabel dengan beban memori terbesar.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Prosedur Restore Aman-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Prosedur Pemulihan (Restore Database)</h4>
                            <div class="p-3 bg-light-danger rounded border border-danger border-dashed mb-3">
                                <span class="fs-8 text-danger fw-bold d-block mb-1">
                                    <i class="ki-duotone ki-information-5 text-danger fs-6 align-middle me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    Peringatan Kritikal:
                                </span>
                                <p class="fs-8 text-gray-700 mb-0">Proses restore akan menimpa (overwrite) seluruh data aktif di database dengan data yang tersimpan pada file arsip!</p>
                            </div>
                            <div class="schema-flow">
                                <div class="schema-step">1. Pilih file arsip yang valid dari tabel riwayat cadangan.</div>
                                <div class="schema-step">2. Klik tombol <strong>"Restore"</strong> (ikon putar <code>ki-arrows-circle</code>).</div>
                                <div class="schema-step">3. Masukkan teks konfirmasi pada modal SweetAlert2 untuk menyetujui penimpaan data.</div>
                                <div class="schema-step">4. Tunggu hingga proses selesai; sistem akan memperbarui status secara otomatis.</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Mengatur Jadwal Auto-Backup-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Pengaturan Cadangan Otomatis (Auto-Backup)</h4>
                            <p class="text-gray-700 fs-7 mb-2">
                                Mengonfigurasi penjadwalan backup otomatis tanpa perlu mengedit file crontab manual:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Langkah 1: Buka Modal Pengaturan</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Klik tombol <strong>"Pengaturan Auto-Backup"</strong> di toolbar halaman backup.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 2: Pilih Frekuensi &amp; Waktu Eksekusi</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Tentukan frekuensi (Harian/Mingguan), jam eksekusi (misal: <code>02:00 WIB</code>), dan batas maksimum arsip yang disimpan (retensi).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 3: Uji Coba Penjadwalan</strong>
                                    <p class="text-gray-600 fs-8 mb-0">Klik tombol <strong>"Uji Auto Backup"</strong> untuk memvalidasi apakah izin direktori dan fungsi cron berfungsi sempurna.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Troubleshooting-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Checklist Troubleshooting &amp; Kendala Umum</h4>
                            <div class="schema-grid">
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">1. Izin Folder Storage (Permission Denied)</h5>
                                        <p class="fs-8 text-gray-700 mb-0">Pastikan folder <code>storage/app/backups</code> memiliki permission tulis (<code>chmod 775</code> atau <code>777</code> di Linux).</p>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">2. PHP Execution Timeout</h5>
                                        <p class="fs-8 text-gray-700 mb-0">Untuk database berukuran besar (> 500MB), tingkatkan nilai <code>max_execution_time</code> dan <code>memory_limit</code> di <code>php.ini</code>.</p>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">3. Binary mysqldump Tidak Terdeteksi</h5>
                                        <p class="fs-8 text-gray-700 mb-0">Sistem otomatis menggunakan Pure PHP Chunking generator sehingga proses backup tetap berjalan 100% sukses.</p>
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
