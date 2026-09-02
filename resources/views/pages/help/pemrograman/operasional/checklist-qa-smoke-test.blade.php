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
                    <span class="schema-pill">QA Minimal Gate</span>
                    <h2 class="fw-bold">Checklist QA Smoke Test</h2>
                    <p class="schema-lead">
                        Checklist smoke test minimum yang wajib dilalui sebelum merge/release untuk menekan regresi.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>A. Routing dan Akses</h4>
                            <ul class="schema-list">
                                <li>Halaman baru bisa diakses saat login.</li>
                                <li>Route penting tidak menghasilkan 404/500.</li>
                                <li>Fallback 404 tampil benar untuk URL invalid.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>B. Sidebar/Header Menu</h4>
                            <ul class="schema-list">
                                <li>Menu baru tampil di posisi yang tepat.</li>
                                <li>Active state parent/child benar (recursive).</li>
                                <li>Perilaku desktop hover dan mobile click konsisten.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>C. Locale dan Translasi</h4>
                            <ul class="schema-list">
                                <li>Switch bahasa EN/ID berjalan normal.</li>
                                <li>Tidak ada key mentah <code>menu.*</code> yang tampil.</li>
                                <li>Title halaman sesuai locale aktif.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>D. Asset dan UI</h4>
                            <ul class="schema-list">
                                <li>Tidak ada style/layout break di desktop/mobile utama.</li>
                                <li>Komponen interaktif tidak error di console browser.</li>
                                <li>Build asset berhasil (<code>npm run build</code>).</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Command Checklist Cepat</h4>
                            <pre class="schema-code"><code>php artisan optimize:clear
php artisan route:list --name=help.pemrograman
composer test
npm run build</code></pre>
                            <div class="schema-warn mt-4">Jika ada perubahan config/menu/lang, lakukan verifikasi ulang setelah cache clear.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection