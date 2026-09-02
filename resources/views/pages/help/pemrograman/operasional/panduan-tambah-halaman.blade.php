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
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="schema-shell">
                <div class="schema-hero">
                    <span class="schema-pill">Developer Workflow</span>
                    <h2 class="fw-bold">Panduan Tambah Halaman</h2>
                    <p class="schema-lead">
                        Alur standar menambahkan halaman baru pada proyek ini: dari file Blade, auto route, menu config, translasi, sampai validasi akhir.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Flow End-to-End</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Buat file baru di <code>resources/views/pages/... .blade.php</code>.</div>
                                <div class="schema-step">2. Route otomatis terbentuk via <code>routes/menu.php</code>.</div>
                                <div class="schema-step">3. Tambahkan item menu di <code>config/sidebar</code> atau <code>config/header</code>.</div>
                                <div class="schema-step">4. Tambah key translasi di <code>lang/en/menu.php</code> dan <code>lang/id/menu.php</code>.</div>
                                <div class="schema-step">5. Uji akses URL, active state menu, dan page title.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Contoh Struktur File</h4>
                            <pre class="schema-code"><code>resources/views/pages/help/pemrograman/operasional/
  panduan-foo.blade.php</code></pre>
                            <pre class="schema-code mt-4"><code>// route name otomatis
help.pemrograman.operasional.panduan-foo

// URL otomatis
/help/pemrograman/operasional/panduan-foo</code></pre>
                            <div class="schema-note mt-4">Pada proyek ini, route halaman `pages` tidak ditulis satu per satu, tetapi di-scan otomatis.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Template Minimal Halaman</h4>
                            <ul class="schema-list">
                                <li><code>@@extends('layouts.index')</code></li>
                                <li><code>@@section('title', ...)</code></li>
                                <li><code>@@section('toolbar')</code></li>
                                <li><code>@@section('content')</code></li>
                            </ul>
                            <div class="schema-meta">
                                <span class="schema-chip">konsisten layout</span>
                                <span class="schema-chip">mudah maintain</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Checklist Validasi</h4>
                            <ul class="schema-list">
                                <li>Halaman dapat diakses saat login (middleware <code>auth</code> aktif).</li>
                                <li>Menu mengarah ke route yang benar.</li>
                                <li>Judul halaman tampil sesuai translasi.</li>
                                <li>Tampilan desktop dan mobile tetap stabil.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Perintah Verifikasi Cepat</h4>
                            <pre class="schema-code"><code>php artisan route:list --name=help.pemrograman
php artisan optimize:clear
composer test</code></pre>
                            <div class="schema-warn mt-4">Jika route baru tidak terlihat, pastikan nama file Blade valid dan tidak ada typo folder/path.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection