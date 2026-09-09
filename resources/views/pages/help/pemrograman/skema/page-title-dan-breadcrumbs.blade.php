@extends('layouts.index')

@section('styles')
    @include('pages.help.pemrograman._schema-ui')
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <div class="schema-shell">
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Zero-Boilerplate Architecture</span>
                    <h2 class="fw-bold">Skema Page Title &amp; Hierarchical Breadcrumb</h2>
                    <p class="schema-lead">
                        Blueprint arsitektur resolusi <strong>Judul Halaman (Page Title)</strong> dan <strong>Breadcrumb Hierarkis</strong> otomatis tanpa perlu deklarasi <code>@@slot</code> manual di setiap file Blade. Mengintegrasikan pencarian multi-layer (Seeder, Database, Config Sidebar/Header, dan Fallback Segmen URL) dengan dukungan multibahasa (i18n) real-time.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Filosofi & Aturan Breadcrumb-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Filosofi &amp; Kaidah Hierarki Breadcrumb</h4>
                            <p class="text-gray-700 fs-7">
                                Breadcrumb berfungsi sebagai <strong>penunjuk lokasi hierarkis</strong> tempat menu berada, bukan pengulang judul yang sedang aktif.
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Kaidah Utama:</strong> Breadcrumb hanya menampilkan <em>jalur leluhur (Ancestor Trail)</em>: <code>Home &rarr; Category &rarr; Parent Menu</code>.
                                </div>
                                <div class="schema-step">
                                    <strong>Tanpa Duplikasi Ujung:</strong> Judul halaman yang sedang aktif <strong>tidak</strong> disertakan lagi di ujung breadcrumb karena sudah ditampilkan secara tegas dan berukuran besar pada judul utama (<code>&lt;h1&gt;</code>).
                                </div>
                                <div class="schema-step">
                                    <strong>Contoh Kasus 1 (Modul Database/Seeder):</strong>
                                    <div class="bg-light p-2 rounded mt-1 fs-8">
                                        Route: <code>/appsupport/menu</code><br>
                                        &bull; <strong>Judul Halaman:</strong> <code>Menu</code><br>
                                        &bull; <strong>Breadcrumb (EN):</strong> <code>Home &rarr; Master Data &rarr; App Support</code><br>
                                        &bull; <strong>Breadcrumb (ID):</strong> <code>Beranda &rarr; Master Data &rarr; Dukungan Aplikasi</code>
                                    </div>
                                </div>
                                <div class="schema-step">
                                    <strong>Contoh Kasus 2 (Modul Profil):</strong>
                                    <div class="bg-light p-2 rounded mt-1 fs-8">
                                        Route: <code>/profil/profil-pengguna</code><br>
                                        &bull; <strong>Judul Halaman:</strong> <code>Profil Pengguna</code> (ID) / <code>User Profile</code> (EN)<br>
                                        &bull; <strong>Breadcrumb:</strong> <code>Home &rarr; Master Data</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Alur Resolusi Multi-Layer-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Alur Resolusi 4 Layer (Fallback Waterfall)</h4>
                            <p class="text-gray-700 fs-7">
                                Fungsi <code>getPageBreadcrumbs()</code> dan <code>getPageTitle()</code> di <code>app/Helpers/GetPageTitle.php</code> menyelesaikan rantai hierarki melalui 4 lapis pencarian:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Layer 1 &mdash; Dynamic Menu Seeder:</strong> Membaca <code>config('menu_seeder.categories')</code> secara rekursif hingga menemukan item yang cocok dengan <code>route()</code> atau URL aktif beserta nama kategorinya.
                                </div>
                                <div class="schema-step">
                                    <strong>Layer 2 &mdash; Database Table (<code>menus</code>):</strong> Jika belum ditemukan di Layer 1, mencari record di database dan menelusuri relasi <code>parent_id</code> ke atas sampai ke kategori root.
                                </div>
                                <div class="schema-step">
                                    <strong>Layer 3 &mdash; Static Sidebar &amp; Header Config:</strong> Menelusuri seluruh file <code>config/sidebar/_sidebar_*.php</code> dan <code>config/docs/_*.php</code> untuk menu bertingkat.
                                </div>
                                <div class="schema-step">
                                    <strong>Layer 4 &mdash; Fallback Segmen URL:</strong> Memecah segmen URL saat ini, mengabaikan segmen terakhir (karena milik judul), lalu memformat nama segmen menjadi teks yang dapat dibaca.
                                </div>
                            </div>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">Auto Match</span>
                                <span class="schema-chip">Zero Manual Code</span>
                                <span class="schema-chip">High Performance</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Arsitektur File & Helper-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Struktur Komponen &amp; File Terkait</h4>
                            <ul class="schema-list">
                                <li><code>app/Helpers/GetPageTitle.php</code>: Engine inti kalkulasi title, breadcrumbs trail, dan safe translation.</li>
                                <li><code>resources/views/layouts/partials/_page-title.blade.php</code>: Renderer judul dan breadcrumb untuk Metronic v1.</li>
                                <li><code>resources/views/layouts/_page-title-v2.blade.php</code>: Renderer judul dan breadcrumb untuk Metronic v2.</li>
                                <li><code>config/menu_seeder.php</code>: Master data konfigurasi hierarki kategori dan menu database.</li>
                                <li><code>app/Support/LanguageManager.php</code>: Penyedia kamus translasi bilingual.</li>
                                <li><code>lang/en/menu.php</code> &amp; <code>lang/id/menu.php</code>: Kamus terjemahan bilingual.</li>
                            </ul>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">Metronic v1 &amp; v2</span>
                                <span class="schema-chip">i18n Compatible</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Mekanisme i18n Safely-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Engine Translasi Aman (<code>translateMenuTitleSafely</code>)</h4>
                            <p class="text-gray-700 fs-7">
                                Mencegah fatal error atau salah tipe data (seperti kembalian array saat key collision) dengan sanitasi bertingkat:
                            </p>
                            <pre class="schema-code"><code>// Algoritma di translateMenuTitleSafely($key):
// 1. Abaikan key kosong atau namespace terlarang ('menu', 'auth', dsb)
// 2. Coba terjemahan langsung via __($key)
// 3. Coba prefix '__("menu." . $key)'
// 4. Coba slugified '__("menu." . strtolower(str_replace(...)))'
// 5. Kembalikan string hasil terjemahan jika valid, atau null/fallback asli.</code></pre>
                            <div class="schema-note mt-3">
                                Hal ini memastikan judul dan setiap node breadcrumb diterjemahkan secara otomatis saat user beralih bahasa antara Indonesia dan English.
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Contoh Perbandingan Kode (Sebelum vs Sesudah)-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Perbandingan Efisiensi Kode (Sebelum vs Sesudah Arsitektur Baru)</h4>
                            <div class="schema-grid">
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light-danger">
                                        <h5 class="fs-6 fw-bold text-danger mb-2">❌ Pola Lama (Ribet &amp; Rentan Error)</h5>
                                        <p class="fs-8 text-gray-700 mb-2">Setiap halaman Blade wajib menulis puluhan baris toolbar dan slot secara manual:</p>
                                        <pre class="schema-code"><code>@@section('toolbar')
    @@component('layouts.partials._toolbar')
        @@slot('li_1')
            @{{ __('menu.md_masterdata') }}
        @@endslot
        @@slot('li_2')
            @{{ __('menu.md_app_support') }}
        @@endslot
    @@endcomponent
@@endsection</code></pre>
                                        <ul class="fs-8 text-danger mt-2 mb-0 ps-3">
                                            <li>Harus ditulis berulang di ratusan modul.</li>
                                            <li>Rentan typo dan inkonsistensi bahasa saat switch.</li>
                                            <li>Duplikasi judul di ujung breadcrumb.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light-success">
                                        <h5 class="fs-6 fw-bold text-success mb-2">✅ Pola Baru (Zero Boilerplate &amp; Otomatis)</h5>
                                        <p class="fs-8 text-gray-700 mb-2">Cukup extend layout dan isi section content. Judul &amp; Breadcrumb 100% otomatis:</p>
                                        <pre class="schema-code"><code>@@extends('layouts.index')

@@section('content')
    &lt;div class="card"&gt;
        &lt;div class="card-body"&gt;
            &lt;!-- Konten Modul Anda --&gt;
        &lt;/div&gt;
    &lt;/div&gt;
@@endsection</code></pre>
                                        <ul class="fs-8 text-success mt-2 mb-0 ps-3">
                                            <li>0 baris kode boilerplate di file view.</li>
                                            <li>Breadcrumb dan Title otomatis sinkron dari struktur menu.</li>
                                            <li>Bilingual real-time tanpa setup tambahan.</li>
                                        </ul>
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
