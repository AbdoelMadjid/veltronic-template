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
                    <h2 class="fw-bold">Panduan Operasional &amp; Kustomisasi Keyboard Shortcuts</h2>
                    <p class="schema-lead">
                        Panduan komprehensif langkah demi langkah untuk mengelola pintasan keyboard via antarmuka admin, mendaftarkan shortcut kustom baru, menghubungkan fungsi JavaScript, serta mengatur hak akses peran.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Manajemen Shortcut via UI-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Mengelola Shortcut via Menu App Support</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Langkah 1: Buka Tab Keyboard Shortcuts</strong>
                                    <p class="text-gray-600 fs-8 mb-0">
                                        Navigasikan ke menu <strong>App Support &rarr; Fitur &amp; Setting</strong>, lalu klik tab <strong>"Keyboard Shortcuts"</strong>.
                                    </p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 2: Navigasi 2-Kolom &amp; Filter Kategori</strong>
                                    <p class="text-gray-600 fs-8 mb-0">
                                        Gunakan panel navigasi kiri untuk memfilter kategori (Semua, Visibilitas UI, Tema &amp; Visual, Sistem &amp; Keamanan, Navigasi Cepat, Elemen &amp; Modal).
                                    </p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 3: Toggle Aktif/Nonaktif Seketika</strong>
                                    <p class="text-gray-600 fs-8 mb-0">
                                        Klik switch toggle pada baris pintasan untuk mengaktifkan atau menonaktifkan hotkey. Perubahan disimpan secara realtime tanpa reload halaman.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Tambah & Edit Shortcut Baru-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Menambah &amp; Mengedit Pintasan Baru</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Langkah 1: Buka Formulir Modal</strong>
                                    <p class="text-gray-600 fs-8 mb-0">
                                        Klik tombol <strong>"Tambah Shortcut"</strong> atau ikon edit pada baris shortcut yang ingin diubah.
                                    </p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 2: Isi Parameter Lengkap</strong>
                                    <p class="text-gray-600 fs-8 mb-0">
                                        Tentukan <strong>Nama</strong>, <strong>Kode Aksi</strong> (identifier unik), <strong>Kategori</strong>, <strong>Kombinasi Key</strong> (contoh: <code>Ctrl + Alt + E</code>), dan <strong>Target Role</strong>.
                                    </p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 3: Deteksi Tabrakan Key Realtime</strong>
                                    <p class="text-gray-600 fs-8 mb-0">
                                        Formulir dilengkapi sistem deteksi tabrakan realtime. Jika kombinasi tombol sudah digunakan oleh aksi lain, sistem akan menampilkan peringatan instan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Mendaftarkan Aksi Baru di JavaScript-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Menghubungkan Fungsi Aksi di JavaScript</h4>
                            <p class="text-gray-700 fs-7 mb-2">
                                Setiap shortcut dihubungkan ke logika JavaScript melalui <code>kode_aksi</code>. Berikut contoh mendaftarkan handler untuk aksi kustom:
                            </p>
                            <pre class="schema-code"><code>// Contoh 1: Di file JS modul Anda (misal: orders.js)
document.addEventListener('DOMContentLoaded', function() {
    if (window.VeltronicShortcuts) {
        window.VeltronicShortcuts.registerActionHandler('export_orders_excel', function() {
            // Trigger tombol export atau fungsi AJAX
            $('#btn_export_excel').click();
            toastr.info('Memulai export data Excel...');
        });
    }
});

// Contoh 2: Menangani navigasi kustom
window.VeltronicShortcuts.registerActionHandler('quick_open_pos', function() {
    window.location.href = '/pos/transaksi-baru';
});</code></pre>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Seeder & Reset Default-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Seeder Database &amp; Reset Pintasan Bawaan</h4>
                            <p class="text-gray-700 fs-7 mb-2">
                                Aplikasi menyediakan 13 pintasan default yang siap pakai. Untuk menjalankan atau mereset daftar seeder default:
                            </p>
                            <pre class="schema-code"><code># Menjalankan seeder pintasan keyboard:
php artisan db:seed --class=AppShortcutSeeder

# Menjalankan full database seeder (termasuk AppShortcutSeeder):
php artisan db:seed</code></pre>
                            <div class="p-3 bg-light-info rounded border border-info border-dashed mt-3">
                                <span class="fs-8 text-info fw-semibold d-block mb-1">
                                    <i class="ki-duotone ki-information-5 text-info fs-6 align-middle me-1">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                    </i>
                                    Tips Konvensi Kombinasi Tombol:
                                </span>
                                <p class="fs-8 text-gray-700 mb-0">
                                    Selalu gunakan awalan <code>Ctrl + Alt + [Karakter]</code> untuk semua shortcut aplikasi agar tidak bertabrakan dengan tombol fungsi bawaan sistem operasi (Windows/macOS/Linux) maupun shortcut internal browser (Google Chrome, Firefox, Safari, Edge).
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Troubleshooting-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Checklist Troubleshooting &amp; Diagnostik</h4>
                            <div class="schema-grid">
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">1. Shortcut Tidak Merespons?</h5>
                                        <p class="fs-8 text-gray-700 mb-0">
                                            Periksa apakah kursor sedang berada di dalam field input atau textarea. Pastikan juga status shortcut bernilai <strong>Aktif (ON)</strong> di tabel App Support.
                                        </p>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">2. Batasan Hak Akses Role?</h5>
                                        <p class="fs-8 text-gray-700 mb-0">
                                            Periksa kolom role pada shortcut tersebut. Jika role diset hanya untuk <code>master</code> dan <code>admin</code>, maka user dengan role lain tidak akan mengeksekusinya.
                                        </p>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">3. Handler JS Belum Terdaftar?</h5>
                                        <p class="fs-8 text-gray-700 mb-0">
                                            Buka Console browser (F12) untuk melihat log. Pastikan <code>kode_aksi</code> di database persis sama dengan nama action di <code>ActionRegistry</code>.
                                        </p>
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
