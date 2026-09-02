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
                    <span class="schema-pill">Naming Convention</span>
                    <h2 class="fw-bold">Konvensi Penamaan</h2>
                    <p class="schema-lead">
                        Standar penamaan agar route otomatis, translasi menu, dan helper title berjalan konsisten di semua halaman.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Konvensi Nama File View</h4>
                            <ul class="schema-list">
                                <li>Gunakan huruf kecil + pemisah <code>-</code> untuk nama file Blade.</li>
                                <li>Contoh: <code>panduan-tambah-halaman.blade.php</code>.</li>
                                <li>Struktur folder menentukan route URL dan route name.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Konvensi Route Name</h4>
                            <pre class="schema-code"><code>resources/views/pages/help/pemrograman/operasional/konvensi-penamaan.blade.php
-> route name: help.pemrograman.operasional.konvensi-penamaan
-> URL: /help/pemrograman/operasional/konvensi-penamaan</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Konvensi Key Translasi Menu</h4>
                            <ul class="schema-list">
                                <li>Sumber text menu berasal dari <code>title</code> di config.</li>
                                <li>Normalisasi key: spasi -> underscore, <code>&</code> -> <code>and</code>.</li>
                                <li>Contoh: <code>Skema Error Handling & Fallback</code> -> <code>menu.skema_error_handling_and_fallback</code>.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Aturan Wajib EN + ID</h4>
                            <ul class="schema-list">
                                <li>Setiap title user-facing baru wajib punya key pada <code>lang/en/menu.php</code> dan <code>lang/id/menu.php</code>.</li>
                                <li>Hindari ketergantungan fallback title mentah untuk menu utama.</li>
                                <li>Lakukan review key agar tidak duplikat secara semantik.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Checklist Naming Sebelum Merge</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Nama file Blade konsisten (kebab-case, deskriptif).</div>
                                <div class="schema-step">Route name terbentuk sesuai ekspektasi (cek <code>route:list</code>).</div>
                                <div class="schema-step">Title config map ke key translasi yang benar.</div>
                                <div class="schema-step">Key EN dan ID tersedia dan tidak typo.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection