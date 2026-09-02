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
                    <span class="schema-pill">Header Navigation</span>
                    <h2 class="fw-bold">Skema Header Menu</h2>
                    <p class="schema-lead">
                        Header memadukan beberapa pattern sekaligus: mega menu card, mega menu tab, dropdown recursive, dan compact help menu.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Orkestrasi Utama</h4>
                            <ul class="schema-list">
                                <li>Entry point: <code>resources/views/layouts/partials/header/_menu/_menu.blade.php</code>.</li>
                                <li>Trigger top-level: <code>data-kt-menu-trigger="{default:'click', lg:'hover'}"</code>.</li>
                                <li>Mode mobile: header menjadi drawer menggunakan <code>data-kt-drawer</code>.</li>
                                <li>Active state top-level: <code>request()->routeIs(...)</code>.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Skema Per Menu Utama</h4>
                            <div class="schema-meta mb-3">
                                <span class="schema-chip">Dashboards = mega card</span>
                                <span class="schema-chip">Pages = mega tab</span>
                                <span class="schema-chip">Apps = recursive dropdown</span>
                                <span class="schema-chip">Layouts = mega columns</span>
                                <span class="schema-chip">Help = compact icon list</span>
                            </div>
                            <div class="schema-note">Satu top bar, lima karakter submenu berbeda. Ini memudahkan UX menyesuaikan volume konten tiap domain.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Dashboards: Mega Menu Card</h4>
                            <ul class="schema-list">
                                <li>Partial: <code>__dashboards.blade.php</code>.</li>
                                <li>Dashboards: Mega Menu Card</li>
                                <li>Kanan: list "More Dashboards" dari <code>header_dashboard_other</code>.</li>
                                <li>Partial: <code>__dashboards.blade.php</code>.</li>
                                <li>Kiri: card dashboard dari <code>header_dashboard_card</code>.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Pages: Mega Menu Tab</h4>
                            <ul class="schema-list">
                                <li>Partial: <code>__pages.blade.php</code>.</li>
                                <li>Pages: Mega Menu Tab</li>
                                <li>Tiap tab memanggil partial berbeda (<code>__pages-*</code>).</li>
                                <li>Partial: <code>__pages.blade.php</code>.</li>
                                <li>Lebar pane adaptif: <code>w-lg-1000px</code>, <code>w-lg-600px</code>, <code>w-lg-500px</code>.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Apps: Recursive Dropdown</h4>
                            <ul class="schema-list">
                                <li>Data source: <code>config/header/_header_apps.php</code>.</li>
                                <li>Apps: Recursive Dropdown</li>
                                <li>Level 1 default flyout; level lanjutan bisa pakai <code>'dropdown' => true</code>.</li>
                                <li>Data source: <code>config/header/_header_apps.php</code>.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Layouts: Mega Menu Kolom</h4>
                            <ul class="schema-list">
                                <li>Partial: <code>__layouts.blade.php</code>.</li>
                                <li>Layouts: Mega Menu Kolom</li>
                                <li>Ada panel promosi "Layout Builder" dan gambar visual.</li>
                                <li>Partial: <code>__layouts.blade.php</code>.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Help: Compact Hybrid Menu</h4>
                            <ul class="schema-list">
                                <li>Data source: <code>config/header/_header_help.php</code>.</li>
                                <li>Help: Compact Hybrid Menu</li>
                                <li>Eksternal default ke <code>target="_blank"</code> bila target tidak diisi.</li>
                                <li>Data source: <code>config/header/_header_help.php</code>.</li>
                            </ul>
                            <pre class="schema-code"><code>[
  'title' => 'Skema Pemrograman',
  'route' => 'help.pemrograman.skema.overview',
  'tooltip' => '...'
]</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Mega Menu vs Dropdown: Pemilihan Pattern</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Mega menu cocok untuk konten besar + kategorisasi visual + CTA.</div>
                                <div class="schema-step">Dropdown cocok untuk list singkat dengan kedalaman rendah.</div>
                                <div class="schema-step">Selalu verifikasi desktop hover behavior dan mobile click behavior.</div>
                            </div>
                            <div class="schema-note mt-4">Praktik terbaik: tentukan pattern dulu (mega atau dropdown), lalu tetapkan file config dan partial agar struktur konsisten.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) Header Menu</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> top-level baru harus punya pattern jelas (mega/tab/dropdown) sebelum implementasi.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> konfigurasi header dan partial renderer harus tetap domain-specific (hindari logika campur).</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> active state route wajib tervalidasi untuk perilaku desktop hover dan mobile click.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> link eksternal harus eksplisit mendefinisikan <code>target</code> dan tetap aman untuk UX.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Troubleshooting Header Menu</h4>
                            <ul class="schema-list">
                                <li><strong>Submenu tidak tampil:</strong> cek trigger attribute dan struktur submenu wrapper.</li>
                                <li><strong>Tab pages tidak pindah konten:</strong> cek target id tab dan state active awal.</li>
                                <li><strong>Dropdown salah posisi:</strong> cek <code>data-kt-menu-placement</code> dan responsive behavior.</li>
                                <li><strong>Link help tidak aktif:</strong> cek route internal dan request()->routeIs pattern.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection