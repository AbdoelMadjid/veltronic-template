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
                    <span class="schema-pill">Asset Blueprint</span>
                    <h2 class="fw-bold">Skema Theme Assets</h2>
                    <p class="schema-lead">
                        Urutan load asset global dan page-specific agar UI Metronic stabil, ringan, dan mudah dirawat.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Urutan Load di Base Layout</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. <code>@@yield('styles')</code> untuk CSS vendor khusus halaman.</div>
                                <div class="schema-step">2. Global CSS wajib: <code>assets/plugins/global/plugins.bundle.css</code>.</div>
                                <div class="schema-step">3. Theme CSS wajib: <code>assets/css/style.bundle.css</code>.</div>
                                <div class="schema-step">4. Di footer: Global JS wajib <code>plugins.bundle.js</code> lalu <code>scripts.bundle.js</code>.</div>
                                <div class="schema-step">5. Terakhir <code>@@yield('scripts')</code> untuk JS page-specific.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Contoh Nyata di <code>layouts/index.blade.php</code></h4>
                            <pre class="schema-code"><code>&lt;!-- head --&gt;
@@yield('styles')
&lt;link href="assets/plugins/global/plugins.bundle.css" ... /&gt;
&lt;link href="assets/css/style.bundle.css" ... /&gt;

&lt;!-- before closing body --&gt;
&lt;script src="assets/plugins/global/plugins.bundle.js"&gt;&lt;/script&gt;
&lt;script src="assets/js/scripts.bundle.js"&gt;&lt;/script&gt;
@@yield('scripts')</code></pre>
                            <div class="schema-meta">
                                <span class="schema-chip">global first</span>
                                <span class="schema-chip">page assets last</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Resolver Asset di Blade</h4>
                            <p class="text-gray-700 fs-7 mb-4">
                                Untuk CSS/JS/image, gunakan
                                <code>\App\Support\ThemeAsset::url('path/file.ext', $theme_asset_pack ?? null)</code>
                                supaya source asset tetap kompatibel dengan mekanisme switch versi Metronic.
                            </p>
                            <pre class="schema-code"><code>&lt;link href="@{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
      rel="stylesheet" type="text/css" /&gt;

&lt;script src="@{{ \App\Support\ThemeAsset::url('js/custom/apps/subscriptions/add/advanced.js', $theme_asset_pack ?? null) }}"&gt;&lt;/script&gt;

&lt;img src="@{{ \App\Support\ThemeAsset::url('media/svg/card-logos/visa.svg', $theme_asset_pack ?? null) }}"
     alt="" class="h-25px" /&gt;</code></pre>
                            <ul class="schema-list">
                                <li><code>ThemeAsset::url()</code> untuk file asset tema (css/js/media).</li>
                                <li><code>url()</code>/<code>route()</code> untuk URL halaman (navigasi).</li>
                                <li>Jangan hardcode <code>/assets</code> atau <code>/assets-vN</code> di Blade.</li>
                            </ul>
                            <div class="schema-note mt-4">Penjelasan versi lanjut lihat: <code>help/pemrograman/operasional/panduan-pergantian-versi-metronic</code>.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Pola Asset per Halaman</h4>
                            <ul class="schema-list">
                                <li>Halaman bisa menambah CSS khusus via <code>@@section('styles')</code>.</li>
                                <li>Halaman bisa menambah JS khusus via <code>@@section('scripts')</code>.</li>
                                <li>Contoh dashboard memuat plugin tambahan: fullcalendar, datatables, widget scripts.</li>
                                <li>Asset custom berat jangan dimasukkan global jika hanya dipakai satu-dua halaman.</li>
                            </ul>
                            <div class="schema-note mt-4">Prinsip utama: global asset untuk fondasi UI, page-specific asset untuk kebutuhan fitur halaman.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Mode Theme dan Data Attribute</h4>
                            <ul class="schema-list">
                                <li><code>partials.theme-mode._init</code> inisialisasi mode theme.</li>
                                <li><code>data-kt-app-layout</code> dan atribut turunan di body mengontrol mode layout (dark-sidebar, light-header, dll).</li>
                                <li>Layout mode mempengaruhi struktur visual dan behavior JS komponen Metronic.</li>
                            </ul>
                            <div class="schema-warn mt-4">Perubahan atribut layout di body tanpa sinkronisasi asset/script dapat menimbulkan anomali UI.</div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Checklist Saat Menambah Asset Baru</h4>
                            <ol class="schema-list">
                                <li>Tentukan asset itu global atau page-specific.</li>
                                <li>Pastikan dependency order benar (plugin sebelum script pemanggil).</li>
                                <li>Hindari duplikasi load file yang sama di global dan page-specific.</li>
                                <li>Uji performa awal halaman (first render) setelah penambahan asset.</li>
                                <li>Jika ada build/caching, dokumentasikan command dan clear cache yang diperlukan.</li>
                            </ol>
                            <div class="schema-meta">
                                <span class="schema-chip">load order</span>
                                <span class="schema-chip">dependency safety</span>
                                <span class="schema-chip">performance aware</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) Theme Assets</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> plugin baru harus dicatat dependency chain-nya (CSS/JS urutan load).</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> asset page-specific tidak boleh dimasukkan global tanpa alasan performa yang jelas.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> duplikasi file asset lintas section harus dihilangkan sebelum merge.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> setiap perubahan asset wajib dites desktop + mobile.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Troubleshooting Asset</h4>
                            <ul class="schema-list">
                                <li><strong>UI berantakan:</strong> cek urutan CSS dan apakah file global theme termuat.</li>
                                <li><strong>Komponen JS mati:</strong> cek urutan load plugin -> scripts bundle -> page script.</li>
                                <li><strong>Perubahan style tidak terlihat:</strong> cek cache browser dan cache view/framework.</li>
                                <li><strong>Error plugin undefined:</strong> pastikan vendor file tersedia dan path benar.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
