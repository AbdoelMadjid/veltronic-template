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
                    <span class="schema-pill">Localization Flow</span>
                    <h2 class="fw-bold">Skema Pemilihan Bahasa</h2>
                    <p class="schema-lead">
                        Locale dipilih dari user menu, disimpan di session, lalu diterapkan oleh middleware web pada setiap request.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Flow Bahasa dari UI ke Runtime</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. User klik English / Indonesian di user account menu.</div>
                                <div class="schema-step">2. Link menuju <code>route('lang.switch', '{locale}')</code>.</div>
                                <div class="schema-step">3. Route <code>/lang/{locale}</code> validasi whitelist locale.</div>
                                <div class="schema-step">4. Locale valid disimpan dengan <code>session(['locale' => $locale])</code>.</div>
                                <div class="schema-step">5. Redirect kembali ke halaman sebelumnya.</div>
                                <div class="schema-step">6. Middleware <code>SetLocale</code> menjalankan <code>App::setLocale()</code>.</div>
                                <div class="schema-step">7. Seluruh <code>__()</code> membaca file bahasa sesuai locale aktif.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Titik Implementasi</h4>
                            <ul class="schema-list">
                                <li><code>routes/web.php</code>: endpoint switch locale <code>/lang/{locale}</code>.</li>
                                <li><code>app/Http/Middleware/SetLocale.php</code>: baca session locale dan set ke runtime.</li>
                                <li><code>bootstrap/app.php</code>: registrasi middleware <code>SetLocale</code> pada group <code>web</code>.</li>
                                <li><code>resources/views/partials/menus/_user-account-menu.blade.php</code>: UI selector bahasa.</li>
                                <li><code>config/app.php</code>: default locale dan fallback locale.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Default dan Fallback</h4>
                            <ul class="schema-list">
                                <li>Session kosong -> pakai <code>config('app.locale')</code> (default <code>en</code>).</li>
                                <li>Key tidak ada -> fallback ke <code>config('app.fallback_locale')</code>.</li>
                                <li>Jika tetap tidak ada -> key mentah bisa tampil di UI.</li>
                            </ul>
                            <div class="schema-meta">
                                <span class="schema-chip">locale default: en</span>
                                <span class="schema-chip">fallback default: en</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Pola Translasi Menu Dinamis</h4>
                            <pre class="schema-code"><code>// title config menu
'Skema Pemrograman'

// key yang dicari
menu.skema_pemrograman</code></pre>
                            <ul class="schema-list mt-4">
                                <li>Sumber string: <code>lang/en/menu.php</code> dan <code>lang/id/menu.php</code>.</li>
                                <li>Jika key tidak tersedia, renderer fallback ke text title asli.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Whitelist Locale</h4>
                            <pre class="schema-code"><code>if (in_array($locale, ['en', 'id'])) {
    session(['locale' => $locale]);
}</code></pre>
                            <div class="schema-warn mt-4">Saat menambah bahasa baru, whitelist wajib diperbarui. Jika tidak, locale baru tidak akan tersimpan.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Tambah Bahasa Baru (contoh: ja)</h4>
                            <ol class="schema-list">
                                <li>Buat <code>lang/ja/menu.php</code>.</li>
                                <li>Update whitelist locale jadi <code>['en', 'id', 'ja']</code>.</li>
                                <li>Tambah opsi language selector di user menu.</li>
                                <li>Tambah key label bahasa baru pada menu translation.</li>
                                <li>Uji perpindahan bahasa dan cek key yang belum terisi.</li>
                            </ol>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Edge Cases dan Debug Checklist</h4>
                            <ul class="schema-list">
                                <li><code>redirect()->back()</code> bergantung referer; tanpa referer perilaku redirect bisa berbeda.</li>
                                <li>File translasi yang tidak sinkron antar locale menimbulkan UI campuran bahasa.</li>
                                <li>Cache aktif dapat membuat perubahan bahasa terlihat terlambat.</li>
                            </ul>
                            <div class="schema-note mt-4">Checklist cepat: cek session locale -> cek middleware terpasang -> cek key translation -> clear cache.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) Locale Switch</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> locale switch harus melalui whitelist eksplisit, tidak menerima input bebas.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> saat menambah locale baru, update route whitelist + UI selector + file lang domain utama.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> fallback locale harus tetap terdefinisi untuk mencegah UI kosong.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> perubahan locale harus teruji lintas halaman dan lintas role user.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Checklist Validasi Tambah Locale Baru</h4>
                            <ul class="schema-list">
                                <li>Menu utama tertranslate penuh tanpa key mentah tampil.</li>
                                <li>Halaman auth/error/validation tidak campur bahasa.</li>
                                <li>Switch locale tetap konsisten setelah login/logout.</li>
                                <li>Tidak ada overflow layout pada teks lebih panjang.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection