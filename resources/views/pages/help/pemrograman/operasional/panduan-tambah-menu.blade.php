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
                    <span class="schema-pill">Menu Operation Guide</span>
                    <h2 class="fw-bold">Panduan Tambah Menu</h2>
                    <p class="schema-lead">
                        Standar menambah item menu agar konsisten di sidebar/header: struktur data, active state, translasi, dan edge case yang perlu diuji.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Pilih Domain Menu</h4>
                            <ul class="schema-list">
                                <li><code>config/sidebar/_sidebar_*.php</code> untuk navigasi utama kiri.</li>
                                <li><code>config/header/_header_*.php</code> untuk menu atas.</li>
                                <li><code>config/header/_header_help.php</code> untuk quick help menu.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Skema Data Leaf vs Parent</h4>
                            <pre class="schema-code"><code>// leaf
[
  'title' => 'Panduan Tambah Menu',
  'route' => 'help.pemrograman.operasional.panduan-tambah-menu',
]

// parent
[
  'title' => 'Skema Pemrograman',
  'children' => [ ... ]
]</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Kapan Pakai route vs href</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><code>route</code>: untuk halaman internal Laravel.</div>
                                <div class="schema-step"><code>href</code>: untuk URL eksternal atau non-route.</div>
                                <div class="schema-step"><code>target</code>: tetapkan eksplisit untuk UX yang konsisten.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Fitur Opsional</h4>
                            <ul class="schema-list">
                                <li><code>badge</code> untuk status/beta/info.</li>
                                <li><code>dropdown => true</code> untuk flyout menu.</li>
                                <li><code>icon</code> + <code>paths</code> untuk top-level visual consistency.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Checklist Uji Setelah Tambah Menu</h4>
                            <ul class="schema-list">
                                <li>Parent otomatis open saat child route aktif.</li>
                                <li>Item baru aktif di desktop dan mobile.</li>
                                <li>Title menu tertranslate di EN dan ID.</li>
                                <li>Tidak ada route missing saat klik menu.</li>
                            </ul>
                            <div class="schema-note mt-4">Untuk menu nested, validasi minimal pada child terdalam agar recursive active state benar.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection