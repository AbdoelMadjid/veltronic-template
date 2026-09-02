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
                    <span class="schema-pill">Theme Versioning</span>
                    <h2 class="fw-bold">Panduan Pergantian Versi Metronic</h2>
                    <p class="schema-lead">
                        Panduan standar untuk menambah versi tema baru (misalnya v3, v55) tanpa hardcode versi, tanpa folder aset terpisah, dan tetap aman terhadap regresi.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Prinsip Utama</h4>
                            <ul class="schema-list">
                                <li>Jangan hardcode string versi seperti <code>'v2'</code> di Blade.</li>
                                <li>Pakai resolver versi: <code>App\Support\ThemeVersion</code>.</li>
                                <li>Pakai resolver aset: <code>App\Support\ThemeAsset::url(...)</code>.</li>
                                <li>Jangan buat folder <code>assets-v3</code>, gunakan suffix file <code>-v3</code>.</li>
                                <li>Buat file <code>-vN.blade.php</code> hanya jika memang ada perbedaan layout/style.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Komponen Inti</h4>
                            <pre class="schema-code"><code>app/Support/ThemeVersion.php
app/Support/ThemeAsset.php
app/Console/Commands/ThemeAssetsDiff.php
config/theme.php
tests/Feature/ThemeVersionRenderTest.php
tests/Unit/ThemeAssetTest.php</code></pre>
                            <div class="schema-note mt-4">Seluruh komponen di atas sudah disiapkan untuk flow multi-versi agar penambahan versi baru tinggal konfigurasi + file yang berbeda saja.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Rincian Komponen Inti (Core Resolver)</h4>

                            <h5 class="fs-6 fw-bold mb-2"><code>app/Support/ThemeVersion.php</code></h5>
                            <ul class="schema-list">
                                <li><code>default()</code>: mengambil versi default dari <code>config/theme.php</code>.</li>
                                <li><code>available()</code>: daftar versi legal untuk switch runtime.</li>
                                <li><code>normalize($version)</code>: validasi versi input; fallback ke default jika tidak valid.</li>
                                <li><code>current()</code>: membaca <code>session('theme_version')</code> lalu dinormalisasi.</li>
                                <li><code>resolveView($baseView, $version)</code>: pilih view <code>-vN</code> jika ada; jika tidak, pakai base view.</li>
                                <li><code>assetBase($assetPack)</code>: menentukan root folder assets berdasarkan mapping config.</li>
                            </ul>
                            <div class="schema-note mt-3">Efek praktis: view dispatcher cukup memanggil satu helper, tanpa if-else hardcode v1/v2/v3.</div>

                            <h5 class="fs-6 fw-bold mt-5 mb-2"><code>app/Support/ThemeAsset.php</code></h5>
                            <ul class="schema-list">
                                <li>Menerima path relatif, contoh: <code>css/style.bundle.css</code>.</li>
                                <li>Jika versi aktif bukan default, command mencoba file suffix terlebih dahulu: <code>css/style.bundle-vN.css</code>.</li>
                                <li>Jika file suffix ada, dipakai; jika tidak, fallback ke file base.</li>
                                <li>Method internal <code>versionedPath()</code> yang membentuk nama file suffix otomatis.</li>
                            </ul>
                            <pre class="schema-code mt-3"><code>ThemeAsset::url("css/style.bundle.css", "v3")
-> cek assets/css/style.bundle-v3.css
-> jika ada pakai -v3, jika tidak pakai assets/css/style.bundle.css</code></pre>

                            <h5 class="fs-6 fw-bold mb-2">Contoh Pattern yang Benar</h5>
                            <pre class="schema-code"><code>&lt;!-- CSS page/plugin --&gt;
&lt;link rel="stylesheet" href="{{ ThemeAsset::url("css/datatables.bundle.css") }}" /&gt;

&lt;!-- CSS global (layout) --&gt;
&lt;link rel="stylesheet" href="{{ ThemeAsset::url("css/style.bundle.css") }}" /&gt;

&lt;!-- JS global --&gt;
&lt;script src="{{ ThemeAsset::url("js/scripts.bundle.js") }}"&gt;&lt;/script&gt;</code></pre>

                            <h5 class="fs-6 fw-bold mb-2">Signature</h5>
                            <pre class="schema-code"><code>php artisan theme:assets-diff {theme_version}
  [--source=...]
  [--base=assets]
  [--dry-run]
  [--keep-source]
  [--force]</code></pre>

                            <h5 class="fs-6 fw-bold mt-5 mb-2">Arti Parameter & Opsi</h5>
                            <ul class="schema-list">
                                <li><code>{theme_version}</code>: versi target, contoh <code>v3</code>.</li>
                                <li><code>--source</code>: path source relatif ke <code>public/</code> (contoh <code>assets-v3</code>).</li>
                                <li><code>--base</code>: base assets relatif ke <code>public/</code> (default <code>assets</code>).</li>
                                <li><code>--dry-run</code>: simulasi, tidak ada perubahan file.</li>
                                <li><code>--keep-source</code>: source tidak dibersihkan setelah proses.</li>
                                <li><code>--force</code>: timpa file suffix versi yang sudah ada.</li>
                            </ul>

                            <h5 class="fs-6 fw-bold mt-5 mb-2">Logika Proses per File</h5>
                            <div class="schema-flow">
                                <div class="schema-step">Jika file source belum ada di base: dipindah ke base dengan path yang sama (<code>moved_unique</code>).</div>
                                <div class="schema-step">Jika file source sama persis dengan base (hash sama): ditandai <code>deleted_same</code> lalu file source dibersihkan.</div>
                                <div class="schema-step">Jika file beda dan extension <code>css/js</code>: file di-rename ke format suffix <code>-vN</code> pada path base.</div>
                                <div class="schema-step">Jika file beda tapi bukan <code>css/js</code>: ikuti kebijakan media/non-code (dipindah/ditahan) dan tandai untuk review jika perlu.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Rincian Komponen Inti (Config & Quality Gate)</h4>
                            <h5 class="fs-6 fw-bold mb-2">Contoh Skema Pemakaian</h5>
                            <pre class="schema-code"><code># 1) Lihat dampak dulu\nphp artisan theme:assets-diff v3 --source=assets-v3 --dry-run\n\n# 2) Eksekusi aktual\nphp artisan theme:assets-diff v3 --source=assets-v3\n\n# 3) Jika ingin simpan source (audit/manual compare)\nphp artisan theme:assets-diff v3 --source=assets-v3 --keep-source\n\n# 4) Jika suffix -v3 sudah ada dan harus di-replace\nphp artisan theme:assets-diff v3 --source=assets-v3 --force</code></pre>

                            <h5 class="fs-6 fw-bold mt-5 mb-2">Interpretasi Ringkasan Output</h5>
                            <pre class="schema-code"><code>- moved_unique
- renamed_css_js
- deleted_same
- deleted_diff_media
- skipped_exists
- errors</code></pre>
                            <div class="schema-note mt-4">Standar aman: jalankan <code>--dry-run</code> dulu, review angka ringkasan, baru jalankan mode apply.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Pola Wajib di Blade: <code>ThemeAsset::url()</code></h4>
                            <pre class="schema-code"><code>php artisan route:list --name=help.pemrograman
php artisan test tests/Feature/ThemeVersionRenderTest.php
php artisan test tests/Unit/ThemeAssetTest.php
php artisan optimize:clear</code></pre>
                            <div class="schema-warn mt-4">Jika route help baru belum muncul, cek nama file dan path: <code>resources/views/pages/help/pemrograman/...</code>.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Flow Tambah Versi (Bagian 1: Setup)</h4>
                            <ul class="schema-list">
                                <li>Case 2: fallback ke base file jika suffix tidak ada.</li>
                                <li>Mencegah hardcode path <code>public/assets</code> di Blade.</li>
                                <li>Mencegah hardcode path <code>public/assets</code> di Blade.</li>
                                <li>Jika file suffix tidak ada, helper fallback otomatis ke file base tanpa error.</li>
                                <li>Jika file suffix tidak ada, helper fallback otomatis ke file base tanpa error.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Flow Tambah Versi (Bagian 2: Validasi)</h4>
                            <ul class="schema-list">
                                <li><code>{theme_version}</code>: versi target, contoh <code>v3</code>.</li>
                                <li><code>--source</code>: path source relatif ke <code>public/</code> (contoh <code>assets-v3</code>).</li>
                                <li><code>--base</code>: base assets relatif ke <code>public/</code> (default <code>assets</code>).</li>
                                <li><code>--dry-run</code>: simulasi, tidak ada perubahan file.</li>
                            </ul>
                            <div class="schema-meta mt-4">
                                <span class="schema-chip">suffix-based versioning</span>
                                <span class="schema-chip">single assets root</span>
                                <span class="schema-chip">config-driven</span>
                                <span class="schema-chip">regression-safe</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Rincian Command <code>ThemeAssetsDiff</code></h4>
                            <ul class="schema-list">
                                <li><code>--keep-source</code>: source tidak dibersihkan setelah proses.</li>
                                <li><code>--force</code>: timpa file suffix versi yang sudah ada.</li>
                                <li>Tidak ada hardcode <code>'v2'</code> untuk behavior inti.</li>
                                <li>Tidak ada path <code>assets-vN</code> di Blade/layout shared.</li>
                                <li>Semua file versi pakai suffix <code>-vN</code>.</li>
                            </ul>
                            <div class="schema-note mt-4">Tujuan akhirnya: scalable untuk v3, v10, atau v55 tanpa perlu mengubah pola arsitektur.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
