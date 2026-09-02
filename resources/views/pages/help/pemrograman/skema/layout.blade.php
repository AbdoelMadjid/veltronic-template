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
                    <span class="schema-pill">Layout Blueprint</span>
                    <h2 class="fw-bold">Skema Layout</h2>
                    <p class="schema-lead">
                        Alur struktur layout dari base template, partial, toolbar, sampai konten halaman di Metronic Laravel.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Flow Render Halaman</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Route memanggil view page (contoh: <code>pages.help.pemrograman.skema.layout</code>).</div>
                                <div class="schema-step">2. Halaman mewarisi base layout dengan <code>@@extends('layouts.index')</code>.</div>
                                <div class="schema-step">3. Layout utama memuat partial global: header, sidebar, footer, drawer, script.</div>
                                <div class="schema-step">4. Section halaman (<code>styles</code>, <code>toolbar</code>, <code>content</code>, <code>scripts</code>) disuntik ke slot layout.</div>
                                <div class="schema-step">5. Komponen Metronic JS mengaktivasi behavior menu, drawer, tooltip, dan widget.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Struktur Folder Kunci</h4>
                            <pre class="schema-code"><code>resources/views/
├─ layouts/
│  ├─ index.blade.php
│  └─ partials/
│     ├─ header/
│     ├─ sidebar/
│     ├─ _toolbar.blade.php
│     └─ _footer.blade.php
├─ pages/
│  └─ ...
└─ partials/
   └─ menus/</code></pre>
                            <div class="schema-meta">
                                <span class="schema-chip">base layout</span>
                                <span class="schema-chip">shared partials</span>
                                <span class="schema-chip">page sections</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Pola Standar Halaman</h4>
                            <pre class="schema-code"><code>@@extends('layouts.index')

@@section('toolbar')
  @@component('layouts.partials._toolbar')
    @@slot('li_1') Help @@endslot
    @@slot('li_2') Skema Pemrograman @@endslot
    @@slot('li_3') Skema @@endslot
  @@endcomponent
@@endsection

@@section('content')
  ...
@@endsection</code></pre>
                            <div class="schema-note mt-4">Pola ini menjaga konsistensi breadcrumb, spacing, dan struktur visual di seluruh halaman.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Peran Section di Layout</h4>
                            <ul class="schema-list">
                                <li><code>@@section('styles')</code>: CSS khusus halaman.</li>
                                <li><code>@@section('toolbar')</code>: breadcrumb, title konteks, action button.</li>
                                <li><code>@@section('content')</code>: isi utama halaman.</li>
                                <li><code>@@section('scripts')</code>: JS vendor/custom khusus halaman.</li>
                            </ul>
                            <div class="schema-warn mt-4">Hindari menaruh script berat global di semua halaman jika hanya dipakai satu halaman.</div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Checklist Saat Membuat Layout/Page Baru</h4>
                            <ol class="schema-list">
                                <li>Pilih base layout yang tepat (umumnya <code>layouts.index</code>).</li>
                                <li>Pastikan section <code>toolbar</code> dan <code>content</code> terdefinisi dengan jelas.</li>
                                <li>Gunakan partial yang sudah ada sebelum membuat markup baru.</li>
                                <li>Tambahkan styles/scripts hanya bila dibutuhkan halaman tersebut.</li>
                                <li>Uji di desktop dan mobile untuk memastikan sidebar/header/drawer tetap sinkron.</li>
                            </ol>
                            <div class="schema-meta">
                                <span class="schema-chip">reuse before create</span>
                                <span class="schema-chip">minimal custom CSS</span>
                                <span class="schema-chip">mobile-safe layout</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Anti-Pattern Layout</h4>
                            <ul class="schema-list">
                                <li>Menaruh logika bisnis di view/layout.</li>
                                <li>Mengcopy-paste blok header/sidebar alih-alih memanggil partial.</li>
                                <li>Menggunakan CSS inline berlebihan untuk override cepat tanpa dokumentasi.</li>
                                <li>Memuat semua JS plugin di global layout meski dipakai sedikit halaman.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) Layout</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> halaman baru harus meng-extend <code>layouts.index</code> kecuali ada alasan arsitektural.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> section <code>toolbar</code> dan <code>content</code> harus eksplisit.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> reusable markup diekstrak ke partial/component setelah dipakai berulang.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> perubahan layout global wajib diuji minimal 3 halaman berbeda.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection