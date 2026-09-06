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
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <div class="schema-shell">
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Live Bilingual Engine</span>
                    <h2 class="fw-bold">Skema Pemilihan Bahasa (No-Reload Dynamic Switcher)</h2>
                    <p class="schema-lead">
                        Blueprint arsitektur lokalisasi bilingual <strong>English &amp; Indonesian</strong> secara real-time di seluruh aplikasi tanpa reload layar (< 5ms), terintegrasi dengan engine <code>KTLanguage</code>, anti-flicker init, background session sync, dan pengamatan DOM dinamis.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Alur Perpindahan Bahasa-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Alur Siklus Hidup (Live Zero-Reload Flow)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>1. Load Awal Anti-Flicker:</strong> <code>partials.lang._init</code> membaca <code>localStorage['data-kt-lang']</code> / Cookie <code>kt_lang</code> dan menyematkan <code>&lt;html data-kt-lang="id" lang="id"&gt;</code> sebelum render selesai.
                                </div>
                                <div class="schema-step">
                                    <strong>2. Inisialisasi KTLanguage Engine:</strong> <code>KTLanguage.init()</code> memuat kamus inti secara offline dan mengambil kamus penuh secara asinkron dari <code>/lang/translations.json</code>.
                                </div>
                                <div class="schema-step">
                                    <strong>3. User Mengubah Bahasa:</strong> Saat user memilih English / Indonesia dari dropdown navbar, mobile toolbar, atau user menu:
                                    <ul class="fs-8 text-gray-700 mt-1 mb-0 ps-3">
                                        <li>Memperbarui atribut <code>data-kt-lang</code> dan <code>lang</code> pada <code>&lt;html&gt;</code>.</li>
                                        <li>Menyimpan preferensi ke <code>localStorage</code> dan Cookie <code>kt_lang</code>.</li>
                                        <li>Mengirim request fetch asinkron ke <code>/lang/{locale}</code> untuk sinkronisasi Session Laravel di latar belakang.</li>
                                        <li>Memperbarui ikon bendera aktif dan status link pada dropdown seketika.</li>
                                        <li>Menerjemahkan teks DOM secara live via <code>data-kt-translate</code> dan kamus dua arah (EN &harr; ID).</li>
                                        <li>Memicu event kustom <code>kt.lang.change</code>.</li>
                                    </ul>
                                </div>
                                <div class="schema-step">
                                    <strong>4. Observasi Dinamis (MutationObserver):</strong> Elemen baru yang dimasukkan via modal, AJAX, atau collapse otomatis diterjemahkan sesuai bahasa aktif.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Struktur Komponen & Modul-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Struktur Komponen &amp; File Terkait</h4>
                            <ul class="schema-list">
                                <li><code>public/assets/js/custom/language.js</code>: Engine utama <code>KTLanguage</code> untuk manipulasi DOM dan sync.</li>
                                <li><code>resources/views/partials/lang/_init.blade.php</code>: Script inisialisasi awal di layout head.</li>
                                <li><code>resources/views/partials/lang/_main.blade.php</code>: Komponen dropdown pilihan bahasa universal (navbar, topbar v2).</li>
                                <li><code>app/Support/LanguageManager.php</code>: Backend helper untuk mengelola locale dan kompilasi kamus terjemahan JSON.</li>
                                <li><code>app/Http/Middleware/SetLocale.php</code>: Middleware runtime dengan fallback session dan cookie <code>kt_lang</code>.</li>
                                <li><code>routes/web.php</code>: Endpoint <code>/lang/{locale}</code> (AJAX JSON) dan <code>/lang/translations.json</code>.</li>
                            </ul>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">Zero Reload</span>
                                <span class="schema-chip">Offline Ready</span>
                                <span class="schema-chip">Cookie &amp; Session Sync</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: API JavaScript-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. API JavaScript (<code>KTLanguage</code>)</h4>
                            <p class="text-gray-700 fs-7">
                                Modul <code>KTLanguage</code> dapat diakses secara global untuk kontrol terprogram di JavaScript:
                            </p>
                            <pre class="schema-code"><code>// Mengambil bahasa yang aktif saat ini ('en' | 'id')
var currentLang = KTLanguage.getLanguage();

// Mengubah bahasa secara programatik tanpa reload
KTLanguage.setLanguage('id'); // 'en' atau 'id'

// Mengambil string terjemahan berdasarkan key
var text = KTLanguage.translate('menu.dashboards', 'id'); // "Dasbor"

// Menerapkan terjemahan pada kontainer tertentu (misal setelah load ajax)
KTLanguage.apply(document.querySelector('#modal_content'), 'id');

// Mendengarkan event perubahan bahasa
document.documentElement.addEventListener('kt.lang.change', function (e) {
    console.log('Language changed to:', e.detail.locale);
});</code></pre>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Panduan Menulis Elemen Bilingual di Blade-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Panduan Menulis Elemen di Blade</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Opsi A: Menggunakan data-kt-translate (Direkomendasikan)</strong>
                                    <pre class="schema-code"><code>&lt;span class="menu-title" data-kt-translate="menu.my_profile"&gt;
    @{{ __('menu.my_profile') }}
&lt;/span&gt;</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Opsi B: Placeholder &amp; Title Input</strong>
                                    <pre class="schema-code"><code>&lt;input type="text"
    data-kt-translate-placeholder="menu.search_menu_placeholder"
    placeholder="@{{ __('menu.search_menu_placeholder') }}" /&gt;</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Opsi C: Inline Bilingual Custom Text</strong>
                                    <pre class="schema-code"><code>&lt;span data-kt-lang-en="Download Report" data-kt-lang-id="Unduh Laporan"&gt;
    Download Report
&lt;/span&gt;</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Whitelist & Kamus Bahasa-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Menambah Bahasa Baru (Ekspansi Masa Depan)</h4>
                            <div class="schema-grid">
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light">
                                        <h5 class="fs-6 fw-bold mb-2">Langkah Backend</h5>
                                        <ol class="fs-8 text-gray-700 ps-3 mb-0">
                                            <li>Buat direktori <code>lang/{kode_bahasa}/</code> (misal <code>lang/ja/</code>).</li>
                                            <li>Tambahkan kode bahasa ke <code>LanguageManager::availableLocales()</code>.</li>
                                            <li>Tambahkan file terjemahan <code>menu.php</code>, <code>auth.php</code>, dsb.</li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light">
                                        <h5 class="fs-6 fw-bold mb-2">Langkah Frontend</h5>
                                        <ol class="fs-8 text-gray-700 ps-3 mb-0">
                                            <li>Tambahkan kode bahasa ke <code>supportedLocales</code> di <code>language.js</code> &amp; <code>_init.blade.php</code>.</li>
                                            <li>Tambahkan item pilihan bahasa pada dropdown <code>partials.lang._main</code>.</li>
                                            <li>Sediakan asset bendera SVG di <code>assets/media/flags/{nama}.svg</code>.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 5-->
                </div>
                <!--end::Grid-->
            </div>
        </div>
    </div>
@endsection