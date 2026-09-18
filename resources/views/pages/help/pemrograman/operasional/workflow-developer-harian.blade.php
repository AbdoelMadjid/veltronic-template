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
                    <span class="schema-pill">Engineering Lifecycle</span>
                    <h2 class="fw-bold">Workflow Developer Harian &amp; Standar Operasi</h2>
                    <p class="schema-lead">
                        Ritme kerja harian engineer: sinkronisasi branch, targeted verification, kebijakan Zero-Reload CRUD, standarisasi spinner tombol, preservasi logika anti-regresi, hingga Definition of Done.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Start of Day-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Start of Day &amp; Environment Ready</h4>
                            <ul class="schema-list">
                                <li>Tarik perubahan terbaru branch utama (<code>git pull origin main</code>).</li>
                                <li>Pastikan dependensi dan database tersinkron (<code>composer install</code>, <code>php artisan migrate</code>).</li>
                                <li>Jalankan dev environment: <code>php artisan serve</code> atau buka host lokal di Laragon.</li>
                                <li>Pastikan cache bersih saat mulai pengujian: <code>php artisan optimize:clear</code>.</li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Anti-Regresi & Targeted Verification-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Preservasi Logika Eksisting (Anti-Regresi)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Non-Destructive Coding:</strong>
                                    <p class="fs-8 text-muted mb-1">Saat menambahkan Logika C, pastikan Logika A &amp; B yang sebelumnya sudah berjalan <strong>TIDAK BOLEH RUSAK</strong> atau berubah perilakunya.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Targeted Verification (No Full-Suite Blocking):</strong>
                                    <p class="fs-8 text-muted mb-0">Lakukan verifikasi cepat dan terfokus pada titik perubahan spesifik tanpa membuang waktu menjalankan full test suite yang lambat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Standard Zero-Reload & Spinner-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Kebijakan Zero-Reload &amp; Button Spinner</h4>
                            <ul class="schema-list">
                                <li><strong>Zero-Reload:</strong> Seluruh aksi simpan, hapus, upload, dan toggle wajib berbasis AJAX tanpa refresh halaman.</li>
                                <li><strong>Button Loading:</strong> Setiap tombol aksi wajib mengaktifkan <code>data-kt-indicator="on"</code> dan <code>disabled = true</code> selama proses.</li>
                                <li><strong>Tab Locking:</strong> Tab yang sedang aktif harus tetap dipertahankan posisinya setelah notifikasi SweetAlert2 ditutup.</li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Header Banner & Dynamic Tokens-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Standar Tampilan &amp; Token Tema Dinamis</h4>
                            <ul class="schema-list">
                                <li>Gunakan kartu Header Banner (<code>card card-flush shadow-sm border-0 mb-6 bg-body</code>) dengan tombol aksi utama di kanan.</li>
                                <li>Gunakan token warna tema bawaan (<code>bg-body</code>, <code>text-gray-900</code>, <code>border-gray-200</code>) agar sempurna di Light &amp; Dark Mode.</li>
                                <li>Sertakan partial petunjuk modul (<code>[modul]-petunjuk.blade.php</code>) pada setiap halaman baru.</li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Definition of Done-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Definition of Done (DoD) &amp; Checklist Rilis</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>1. Fungsionalitas:</strong> Fitur berjalan 100% sesuai kebutuhan tanpa error console/backend.</div>
                                <div class="schema-step"><strong>2. Zero-Reload UX:</strong> Sukses/gagal menampilkan SweetAlert2/Toastr dan memutasi DOM secara realtime.</div>
                                <div class="schema-step"><strong>3. Dokumentasi Help &amp; Kamus Dwibahasa:</strong> Ditambahkan ke <code>help/pemrograman</code> serta kamus <code>lang/id</code> &amp; <code>lang/en</code>.</div>
                                <div class="schema-step"><strong>4. Changelog &amp; Tags:</strong> Diperbarui di <code>CHANGELOG.md</code> dan <code>help/log/changelog</code> sebelum tag rilis di-push ke GitHub.</div>
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