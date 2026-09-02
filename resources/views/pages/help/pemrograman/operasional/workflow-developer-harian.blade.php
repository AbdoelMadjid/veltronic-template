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
                    <span class="schema-pill">Daily Engineering Flow</span>
                    <h2 class="fw-bold">Workflow Developer Harian</h2>
                    <p class="schema-lead">
                        Alur kerja harian developer untuk proyek Metronic Laravel ini: mulai setup, development loop, quality gate, hingga release readiness.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1) Start of Day</h4>
                            <ul class="schema-list">
                                <li>Pull perubahan terbaru branch kerja.</li>
                                <li>Pastikan dependency sinkron (<code>composer install</code>, <code>npm install</code> jika perlu).</li>
                                <li>Pastikan environment siap (<code>.env</code>, DB, cache).</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2) Development Loop</h4>
                            <pre class="schema-code"><code>composer dev
# menjalankan server + queue listener + logs + vite</code></pre>
                            <ul class="schema-list mt-4">
                                <li>Ubah Blade/config sesuai scope task.</li>
                                <li>Gunakan route otomatis dari <code>resources/views/pages</code>.</li>
                                <li>Cek active state menu di desktop dan mobile.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3) Quality Gate Lokal</h4>
                            <pre class="schema-code"><code>php artisan optimize:clear
composer test
npm run build</code></pre>
                            <div class="schema-note mt-4">Jalankan clear cache saat ada perubahan route/config/lang agar hasil verifikasi akurat.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4) Documentation Sync</h4>
                            <ul class="schema-list">
                                <li>Jika menambah halaman/menu baru, update dokumen help terkait.</li>
                                <li>Pastikan key translasi EN + ID tersedia.</li>
                                <li>Validasi helper title tidak fallback ke teks mentah.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Definition of Done (Praktis)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Perubahan berfungsi sesuai acceptance criteria.</div>
                                <div class="schema-step">Route/menu/title/translasi tervalidasi.</div>
                                <div class="schema-step">Smoke test inti lulus tanpa regresi terlihat.</div>
                                <div class="schema-step">Catatan perubahan dan dampak deploy sudah jelas.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection