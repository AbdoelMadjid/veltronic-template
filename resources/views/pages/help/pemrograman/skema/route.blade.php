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
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="schema-shell">
                <div class="schema-hero">
                    <span class="schema-pill">Route Blueprint</span>
                    <h2 class="fw-bold">Skema Route</h2>
                    <p class="schema-lead">
                        Jalur request dari URL ke Blade di proyek ini: manual route + auto route generator.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Flow Request</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. User request URL.</div>
                                <div class="schema-step">2. <code>routes/web.php</code> diproses.</div>
                                <div class="schema-step">3. <code>require routes/menu.php</code> dipanggil.</div>
                                <div class="schema-step">4. <code>routes/menu.php</code> scan semua <code>resources/views/pages/*.blade.php</code>.</div>
                                <div class="schema-step">5. Setiap file menjadi route GET + route name otomatis dalam middleware <code>auth</code>.</div>
                                <div class="schema-step">6. URL tidak match -> fallback error 404.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Konversi File ke Route</h4>
                            <pre class="schema-code"><code>// contoh file
resources/views/pages/help/pemrograman/skema/route.blade.php

// hasil mapping
relative path: help/skema-pemrograman/route.blade.php
trim extension: help/skema-pemrograman/route
route name: help.pemrograman.skema.route
route url: /help/pemrograman/skema/route
view: pages.help.pemrograman.skema.route</code></pre>
                            <div class="schema-meta">
                                <span class="schema-chip">Source of truth: folder structure</span>
                                <span class="schema-chip">Auto route naming</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Komponen Tanggung Jawab</h4>
                            <ul class="schema-list">
                                <li><code>routes/web.php</code>: route khusus, auth, profile, language switch, bootstrap route lain.</li>
                                <li><code>routes/menu.php</code>: generator route berbasis file view.</li>
                                <li><code>routes/auth.php</code>: route autentikasi bawaan.</li>
                            </ul>
                            <div class="schema-note mt-4">Semua route generator dibungkus middleware <code>auth</code>, sementara fallback 404 tetap di luar middleware.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Quick Add Page</h4>
                            <ol class="schema-list">
                                <li>Buat file Blade baru di <code>resources/views/pages</code>.</li>
                                <li>Route name dan URL langsung terbentuk otomatis.</li>
                                <li>Tambahkan konfigurasi menu jika ingin tampil di navigasi.</li>
                            </ol>
                            <div class="schema-warn mt-4">Hindari nama file duplikat dan gunakan format <code>kebab-case</code> untuk URL yang rapi.</div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Contoh Pemetaan Aktual</h4>
                            <pre class="schema-code"><code>resources/views/pages/help/pemrograman/skema/route.blade.php
=> URL: /help/pemrograman/skema/route
=> route name: help.pemrograman.skema.route</code></pre>
                            <div class="schema-meta">
                                <span class="schema-chip">php artisan route:list --name=help.pemrograman</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Prioritas Evaluasi Route</h4>
                            <ul class="schema-list">
                                <li>Route yang didefinisikan lebih dulu akan dievaluasi lebih awal.</li>
                                <li>Route spesifik harus diletakkan sebelum route dinamis yang lebih generik.</li>
                                <li>Fallback selalu ditempatkan paling akhir.</li>
                                <li>Pada proyek ini, <code>routes/menu.php</code> dan <code>fallback</code> memegang peran besar untuk halaman konten.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) Route</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> route name harus konsisten dan deskriptif berbasis struktur view.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> route internal halaman aplikasi wajib di-protect middleware <code>auth</code>.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> hindari route closure untuk route yang ingin di-cache.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> setiap route baru harus muncul di <code>route:list</code> saat PR review.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Troubleshooting Route</h4>
                            <ul class="schema-list">
                                <li><strong>Route tidak ditemukan:</strong> cek penamaan file blade dan lokasi di <code>resources/views/pages</code>.</li>
                                <li><strong>Route ada tapi tidak bisa diakses:</strong> cek middleware auth/verified dan status login.</li>
                                <li><strong>Perubahan route belum terbaca:</strong> jalankan clear/cache command sesuai environment.</li>
                                <li><strong>Nama route bentrok:</strong> cek hasil <code>php artisan route:list</code> untuk duplikasi.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection