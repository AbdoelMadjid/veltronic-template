@extends('layouts.index')

@section('styles')
    @include('pages.help.pemrograman._schema-ui')
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <!--begin::Version & Tags History Card-->
            <div class="card mb-5 mb-xl-8 border" data-kt-lang-ignore="true">
                <div class="card-header border-0 pt-6">
                    <div class="card-title d-flex align-items-center gap-3">
                        <div class="symbol symbol-40px">
                            <span class="symbol-label bg-light-primary text-primary">
                                <i class="ki-duotone ki-tag fs-2 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </div>
                        <div>
                            <h3 class="fw-bold text-gray-900 mb-0">Riwayat Versi & Release Tags</h3>
                            <span class="text-muted fs-7">Catatan rilis dan riwayat perubahan versi template Veltronic</span>
                        </div>
                    </div>
                    <div class="card-toolbar d-flex align-items-center gap-2">
                        <span class="badge badge-light-danger fw-semibold fs-8">Major</span>
                        <span class="badge badge-light-primary fw-semibold fs-8">Minor</span>
                        <span class="badge badge-light-warning fw-semibold fs-8">Patch</span>
                        <span class="badge badge-light-success fw-bold fs-7 px-3 py-2 ms-2">
                            <i class="ki-duotone ki-check-circle fs-6 text-success me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Versi Saat Ini: v1.34.0
                        </span>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <!--begin::Timeline-->
                    <div class="timeline-label">
                        <!--begin::Item v1.34.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.34.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.34.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>19 Sep 2026, 01:10 WIB
                                    </span>
                                    <span class="badge badge-light-success fs-8 ms-auto">Latest Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Modernisasi Top Filter Pengguna (Single-Row Pure Indonesian), Pengaturan Fitur Aplikasi 2-Kolom &amp; Modal Pintasan Terisolasi, serta Random Deterministik Cover Default Pengguna</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penyempurnaan tata letak dan fungsionalitas modul antarmuka: pemindahan filter pengguna ke posisi atas tabel (1 baris rapi) dengan elemen select solid bawaan berbahasa Indonesia murni bebas kedipan (<em>Zero Layout Shift &amp; Silent Live Search</em>), restrukturisasi tab Pengaturan Aplikasi (<code>appsupport/app-fiturs</code>) menjadi 2 kolom terstruktur beserta modularisasi modal formulir pintasan keyboard, serta implementasi sistem <strong>Random Deterministik Cover Default</strong> pada model <code>User</code> menggunakan 22 gambar pemandangan resolusi tinggi yang konsisten per ID pengguna di halaman profil, manajemen pengguna, dan hero dasbor.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Top Filter Pengguna 1 Baris (<code>/usermanagement/users</code>)</strong>: Pemindahan filter ke atas tabel dengan dropdown native solid murni Indonesia (<em>Terbaru</em>, <em>Terlama</em>, <em>Nama A-Z</em>, <em>Nama Z-A</em>), tombol <em>Saring</em> &amp; <em>Atur Ulang</em> fixed width 90px/38px, dan debounced live search bebas kedap-kedip.</li>
                                        <li><strong>Restrukturisasi Pengaturan Fitur Aplikasi (<code>/appsupport/app-fiturs</code>)</strong>: Pembagian tab Pengaturan menjadi 2 kolom (Kiri: Preferensi Tampilan, Kanan: Keamanan &amp; Pemeliharaan Cache) serta modularisasi modal pintasan keyboard di <code>shortcut-form-modal.blade.php</code>.</li>
                                        <li><strong>Random Deterministik Cover Default Pengguna (<code>User.php</code>)</strong>: Penambahan metode <code>getDefaultCovers()</code> dan <code>getDefaultCoverUrl($seed)</code> untuk memberikan cover unik dan bervariasi bagi setiap pengguna yang belum mengunggah cover kustom secara konsisten.</li>
                                        <li><strong>Integrasi Lintas Modul</strong>: Cover default otomatis aktif di header <code>profil-pengguna</code>, kartu &amp; modal detail <code>usermanagement/users</code>, dan banner hero dasbor tanpa mengubah preferensi cover pengguna yang sudah ada.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.34.0-->

                        <!--begin::Item v1.33.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.33.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.33.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>18 Sep 2026, 16:35 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Modul Inti Manajemen Theme Frontpage, Multi-Versi Dinamis Landing Page (v1, v2), Modularisasi Partials Seksi, serta GUI Script &amp; Source Code Editor</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh modul manajemen <strong>Theme Frontpage</strong> (<code>appsupport/theme-frontpage</code>) dengan arsitektur peralihan dinamis tema utama (<em>Landing Single Page</em> vs <em>Education Portal</em>), selektor versi landing dinamis (<code>v1</code>, <code>v2</code>, dst.), pemisahan seluruh struktur landing menjadi 9 file partial modular di <code>resources/views/frontpages/landing/v1/sections/</code>, penyediaan modal <strong>GUI Script &amp; Source Code Editor</strong> (<code>#modal_section_code</code>) untuk mengedit kode HTML/Blade tiap section secara langsung dari browser, serta kepatuhan standar Veltronic (Zero-Reload Realtime CRUD, Button Loading Indicator <code>data-kt-indicator="on"</code>, dan modal petunjuk terstruktur <code>&lt;x-petunjuk-modal&gt;</code>).
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Dukungan Multi-Versi Landing Dinamis</strong>: Deteksi otomatis direktori versi template landing (<code>availableLandingVersions()</code>) dan rendering dinamis <code>frontpages.landing.{$version}.landing</code>.</li>
                                        <li><strong>Modularisasi Script Seksi</strong>: Pemisahan partial <code>hero.blade.php</code>, <code>how-it-works.blade.php</code>, <code>achievements.blade.php</code>, <code>team.blade.php</code>, <code>portfolio.blade.php</code>, <code>pricing.blade.php</code>, <code>clients.blade.php</code>, <code>custom.blade.php</code>, dan <code>footer.blade.php</code> dengan koordinator layout bersih di <code>landing.blade.php</code>.</li>
                                        <li><strong>Editor Source Code / Blade GUI Seksi (<code>#modal_section_code</code>)</strong>: Tombol <em>Edit Script</em> pada setiap seksi konten dengan editor gelap monospace, auto-wrap, reset, dan penyimpanan instan via AJAX.</li>
                                        <li><strong>Resolusi Cerdas File Partial (<code>resolveSectionFile</code>)</strong>: Pemetaan otomatis ID seksi bawaan ber-prefix <code>section-</code> maupun ID ringkas ke file Blade fisik secara presisi tanpa fallback kosong.</li>
                                        <li><strong>Backend Terpadu</strong>: Penyediaan 19 endpoint AJAX di <code>ThemeFrontpageController.php</code> dan integrasi helper <code>LandingPageConfig</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.33.0-->

                        <!--begin::Item v1.32.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.32.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.32.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>18 Sep 2026, 15:30 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Peremajaan Modal Tentang Aplikasi (10 Fitur Arsitektur &amp; Tech Stack Badges), Sinkronisasi Kamus Dwibahasa, serta Revamp Komprehensif README.md &amp; Indeks 34 Dokumentasi Pengembang</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penyempurnaan menyeluruh modal <strong>Tentang Aplikasi</strong> (<code>kt_modal_about_app.blade.php</code>) dengan desain KeenThemes Metronic modern yang elegan, responsif, dan adaptif (*Dark/Light Mode*), badge status <em>Enterprise Ready</em>, baris spesifikasi <em>Tech Stack</em> (Laravel 13, PHP 8.3+, Metronic 8.3.2, Bootstrap 5.3, Vite &amp; Realtime AJAX, Spatie Security), penataan grid 10 modul arsitektur sistem berikon duotone, profil pengembang terstandarisasi, tautan cepat ke repositori GitHub, Portal Dokumentasi (<code>help/pemrograman/overview</code>), dan Changelog (<code>help/log/changelog</code>), serta restrukturisasi total berkas <code>README.md</code> menjadi panduan utama proyek yang informatif, rapi, dan bebas ambiguitas dengan tabel 13 pintasan keyboard global, diagram arsitektur alur kerja Mermaid, spesifikasi sistem, dan indeks lengkap 34 topik dokumentasi pengembang.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Redesain Modal Tentang Aplikasi (<code>kt_modal_about_app.blade.php</code>)</strong>: Tampilan modern berlebar <code>mw-850px</code> dengan 10 modul arsitektur enterprise (Bilingual, Hotkeys Hub, Audit Logging, DB Backup, App Profile &amp; SEO, Zero-Reload AJAX CRUD, Theme Versions, KeenIcons Engine, Dynamic Menu &amp; Routing, Operational Guidelines Component).</li>
                                        <li><strong>Baris Spesifikasi Tech Stack Badges</strong>: Menampilkan pil badge Laravel 13, PHP 8.3+, Metronic 8.3.2, Bootstrap 5.3, Vite, dan Spatie Security.</li>
                                        <li><strong>Sinkronisasi Kamus Dwibahasa (<code>lang/id/about.php</code> &amp; <code>lang/en/about.php</code>)</strong>: Penambahan kunci terjemahan lengkap dan pendaftaran prefix <code>about.</code> pada <code>public/assets/js/custom/language.js</code>.</li>
                                        <li><strong>Revamp Total README.md</strong>: Penataan ulang dokumentasi repositori utama dengan header badges estetik, tabel persyaratan sistem, panduan instalasi langkah-demi-langkah, tabel 13 hotkeys global <code>Ctrl+Alt+[Key]</code>, diagram Mermaid MVC &amp; auto-routing, indeks lengkap 34 topik skema pemrograman (21 Skema Arsitektur &amp; 13 Panduan Operasional), serta checklist deployment production.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.32.0-->

                        <!--begin::Item v1.31.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.31.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.31.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>18 Sep 2026, 15:20 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Zero-Flicker &amp; Zero-Flash Global Layout &amp; Content Rendering Engine (Server-Side Theme Mode Pre-Rendering, Synchronous Head Inits, Zero-Shift Sidebar State &amp; Anti-FOIT Font Engine)</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh arsitektur <em>Zero-Flicker &amp; Zero-Flash Global Layout Engine</em> untuk mengeliminasi kedipan tema (*theme mode flashing*), pergeseran layout sidebar (*layout snap / shift*), dan kedipan teks (*Flash of Invisible Text / FOIT*) saat memuat atau me-refresh halaman melalui pre-rendering server-side atribut tema, inisialisasi sinkron di tag <code>&lt;head&gt;</code>, sinkronisasi cookie unencrypted, dan optimasi CSS rendering.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Server-Side Theme Mode Pre-Rendering</strong>: Helper <code>getActiveThemeMode()</code> membaca cookie dan mencetak <code>data-bs-theme</code> langsung ke tag <code>&lt;html&gt;</code> sebelum browser mulai menggambar layout.</li>
                                        <li><strong>Synchronous Head Inits</strong>: Pemindahan pemanggilan <code>_init.blade.php</code> langsung ke dalam <code>&lt;head&gt;</code> untuk inisialisasi tema dan bahasa secara instan 0 ms.</li>
                                        <li><strong>Zero-Shift Sidebar Minimization</strong>: Membaca status cookie <code>sidebar_minimize_state</code> dan mencetak <code>data-kt-app-sidebar-minimize="on"</code> dari server tanpa pergeseran transisi saat navigasi.</li>
                                        <li><strong>Anti-FOIT Font &amp; CSS Smoothing</strong>: Pemuatan Google Fonts Inter dengan <code>display=swap</code> serta optimasi <code>text-rendering: optimizeLegibility</code> pada CSS custom.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.31.0-->

                        <!--begin::Item v1.30.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.30.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.30.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>18 Sep 2026, 15:15 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Zero-Flicker Server-Side Icon Rendering Engine (ApplyIconStyle Middleware), Card Wrapping Overview Dokumentasi, Standardisasi Ikon &amp; Perbaikan Empty State Profil</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi arsitektur <em>Zero-Flicker Server-Side Icon Rendering Engine</em> melalui middleware <code>\App\Http\Middleware\ApplyIconStyle</code> untuk menormalisasi kelas ikon KeenIcons langsung dari perenderan backend sesuai preferensi pengguna (Duotone, Solid, Outline) tanpa kedipan saat muat/refresh halaman, pembaharuan tata visual halaman ikhtisar skema &amp; dokumentasi di <code>help/pemrograman/overview</code> dengan pengelompokan card rapi per kategori, perbaikan kontainer empty state audit log pada profil pengguna, serta standardisasi elemen ikon duotone dan proteksi layer path pada seluruh master layout.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Zero-Flicker Icon Rendering Engine (<code>ApplyIconStyle Middleware</code>)</strong>: Middleware backend otomatis membaca cookie/session preferensi ikon pengguna dan mengonversi kelas HTML ke <code>ki-solid</code>, <code>ki-outline</code>, atau <code>ki-duotone</code> sebelum respon dikirim ke browser, mengeliminasi kedipan (flicker/FOIT) secara 100%.</li>
                                        <li><strong>Sinkronisasi &amp; Live Switching Client-Side (<code>icon-style.js</code> &amp; <code>custom-icon-style.css</code>)</strong>: Integrasi pergantian gaya instan di sisi klien dengan proteksi penyembunyian layer span path pada mode solid/outline dan pembuatan span dinamis pada mode duotone.</li>
                                        <li><strong>Card Pengelompokan Kategori Ikhtisar Dokumentasi (<code>help/pemrograman/overview</code>)</strong>: Membungkus seluruh 34 topik skema dan panduan operasional ke dalam kartu komponen Card Metronic bernomor urut dengan badge jumlah topik, bilah penyaring kategori interaktif, dan pencarian cepat.</li>
                                        <li><strong>Penyempurnaan Empty State Ikon Riwayat Pengguna</strong>: Memperbaiki kontainer simbol jam tabel audit log di <code>pages/profil/partials/tabs/riwayat-pengguna.blade.php</code> dengan lingkaran <code>symbol symbol-55px symbol-circle bg-light-primary</code>.</li>
                                        <li><strong>Standardisasi Ikon Komponen Layout</strong>: Penyelarasan ikon toolbar petunjuk, footer sidebar, menu project, dan menu akun pengguna ke standar duotone multi-path.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.30.0-->

                        <!--begin::Item v1.29.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.29.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.29.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>18 Sep 2026, 14:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Modul Manajemen Profil Aplikasi &amp; Meta SEO, Validasi Logo Resolusi Ketat, Dinamisasi Seluruh Layout, Audit Log Otomatis, Polishing Layout V2 &amp; Proteksi Database Pengujian</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh modul manajemen profil aplikasi (<em>App Profile &amp; SEO Engine</em>) berbasis basis data di <code>appsupport/app-profil</code>, live preview Google Search snippet &amp; Open Graph card, validasi ketat dimensi logo dan favicon, penyimpanan permanen git-tracked di <code>public/assets/logo/</code>, repeater footer link dinamis, otomatisasi seeder <code>AppProfilSeeder</code> (sinkronisasi file &amp; eksekusi ulang), pencatatan audit log otomatis untuk 5 switcher topbar, standarisasi komponen <code>&lt;x-petunjuk-modal&gt;</code>, penyempurnaan estetika header/toolbar Layout V2 (kontras teks profil pengguna, warna hari Jumat, adaptasi logo), serta proteksi SQLite in-memory pada <code>phpunit.xml</code> untuk mencegah wipe database MySQL.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Modul App Profile &amp; Meta SEO (<code>appsupport/app-profil</code>)</strong>: Konfigurasi nama aplikasi, tagline, versi, deskripsi SEO, kata kunci, author, dan Open Graph dengan Live Google Preview &amp; Social Card Preview.</li>
                                        <li><strong>Validasi Resolusi &amp; Rasio Logo/Favicon</strong>: Validasi ketat dimensi logo terang/gelap (100×20 s/d 600×150 px lanskap), logo mini 1:1 (30×30 s/d 200×200 px), dan favicon 1:1 (16×16 s/d 128×128 px), tersimpan aman di <code>public/assets/logo/</code>.</li>
                                        <li><strong>Footer Dinamis &amp; Link Repeater</strong>: Tabel interaktif untuk menambah, mengurutkan, dan menghapus tautan navigasi footer secara realtime serta toggle info server.</li>
                                        <li><strong>Dinamisasi Seluruh Layout Template</strong>: Integrasi helper teroptimasi cache (<code>app_profile()</code>, <code>app_logo_url()</code>, <code>app_favicon_url()</code>, <code>app_footer_links()</code>) ke seluruh varian layout V1 &amp; V2.</li>
                                        <li><strong>Otomatisasi Seeder</strong>: Fitur "Perbarui File Seeder" (ekspor DB ke <code>AppProfilSeeder.php</code>) dan "Jalankan Seeder" secara langsung dari dashboard.</li>
                                        <li><strong>Audit Log Otomatis 5 Fitur Topbar</strong>: Pencatatan mutasi ke <code>users_logs</code> untuk switch Icon Style, Theme Mode (Dark/Light), Bahasa, Versi Layout, dan Frontpage.</li>
                                        <li><strong>Penyempurnaan Varian Tema V2 (Layout Versi 2)</strong>: Kontras teks profil pengguna topbar, pewarnaan kalender hari Jumat (mint green Metronic), adaptasi logo header default/sticky, dan penataan tombol minimize sidebar dengan kelas bawaan template.</li>
                                        <li><strong>Proteksi Database Pengujian (Testing Isolation)</strong>: Penyelarasan <code>phpunit.xml</code> ke SQLite in-memory untuk mengisolasi pengujian dan melindungi database MySQL dari reset/penghapusan data.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.29.0-->

                        <!--begin::Item v1.28.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.28.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.28.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>18 Sep 2026, 10:45 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Sistem Pintasan Keyboard Dinamis (Keyboard Shortcuts Engine), Action Registry Modular, Standar Hotkey Bebas Konflik &amp; Dokumentasi Developer</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh sistem pintasan keyboard (<em>Global Hotkeys Engine</em>) berbasis basis data dengan arsitektur <em>Action Registry</em> modular pada antarmuka, pembagian 5 kategori tindakan, standar kombinasi <code>Ctrl + Alt + [Key]</code> yang kebal konflik peramban, form terpandu 2-kolom dengan deteksi tabrakan tombol secara seketika (<em>realtime collision detector</em>), eksekusi CRUD Zero-Reload, 13 seeder pintasan bawaan, perbaikan penampung notifikasi toastr, serta integrasi lengkap skema dan panduan operasional pada portal dokumentasi pengembang.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Database &amp; Model Architecture</strong>: Pembuatan tabel <code>app_shortcuts</code> dan model <code>AppShortcut</code> dengan otorisasi berbasis peran JSON (<code>isAllowedForUser</code>), accessor kombinasi tombol (<code>formatted_combination</code>, <code>mac_combination</code>), katalog kategori <code>CATEGORIES</code>, dan scope query <code>getActiveForCurrentUser</code>.</li>
                                        <li><strong>Struktur 5 Kategori Tindakan</strong>:
                                            <ul class="ps-3 mt-1 mb-1">
                                                <li><strong>Visibilitas Fitur (<code>visibility</code>)</strong>: Toggle global untuk Tools Topbar Navbar (<code>Ctrl+Alt+T</code>), Menu Header Topbar (<code>Ctrl+Alt+H</code>), dan Menu Template Sidebar (<code>Ctrl+Alt+M</code>) dengan sinkronisasi status backend secara persisten.</li>
                                                <li><strong>Tema, Gaya Ikon, Bahasa &amp; Versi (<code>appearance</code>)</strong>: Beralih mode gelap/terang (<code>Ctrl+Alt+B</code>), switcher gaya KeenIcons (<code>Ctrl+Alt+D/S/O</code>), switcher dwibahasa (<code>Ctrl+Alt+I/E</code>), dan switcher versi layout tampilan (<code>Ctrl+Alt+1/2</code>).</li>
                                                <li><strong>Aksi Sistem &amp; Keamanan (<code>system</code>)</strong>: Pencarian global (<code>Ctrl+Alt+F</code>), kunci layar instan / lock screen (<code>Ctrl+Alt+L</code>), dan pembuka modal petunjuk operasional modul.</li>
                                                <li><strong>Navigasi Cepat (<code>navigation</code>)</strong>: Membuka rute cepat ke Dashboard, Fitur Aplikasi, Profil Pengguna, dan Manajemen Pengguna.</li>
                                                <li><strong>Aksi Elemen (<code>element</code>)</strong>: Trigger klik otomatis pada drawer samping dan modal interaktif Metronic.</li>
                                            </ul>
                                        </li>
                                        <li><strong>Modular Frontend Action Registry (<code>shortcuts.js</code>)</strong>: Pemisahan logika event listener global dengan penanganan aksi spesifik (<code>ActionRegistry</code>), public API <code>window.VeltronicShortcuts.registerActionHandler()</code>, pencocokan ganda <code>e.key</code> &amp; <code>e.code</code> yang kebal Caps Lock/Shift/AltGr, serta pencegahan eksekusi saat mengetik di field input.</li>
                                        <li><strong>Form Terpandu 2-Kolom &amp; Realtime Collision Warning</strong>: Pemilihan target aksi dinamis dari katalog JSON, deteksi tabrakan kombinasi tombol secara realtime dengan peringatan visual, serta AJAX CRUD Zero-Reload dengan spinner indikator proses.</li>
                                        <li><strong>Optimalisasi Kontainer Toastr</strong>: Penonaktifan <code>progressBar</code> mentah dan penataan CSS <code>#toast-container</code> pada <code>custom.css</code> untuk menghilangkan garis hitam tebal melintang di layar.</li>
                                        <li><strong>Database Seeder Bawaan</strong>: Pembuatan <code>AppShortcutSeeder</code> dengan 13 pintasan default yang siap pakai dan terintegrasi di <code>DatabaseSeeder.php</code> serta tombol reset default di controller.</li>
                                        <li><strong>Dokumentasi Developer Skema &amp; Operasional Lengkap</strong>:
                                            <ul class="ps-3 mt-1 mb-0">
                                                <li>Penambahan <strong>Skema Keyboard Shortcuts</strong> (<code>help/pemrograman/skema/keyboard-shortcuts</code>) &amp; <strong>Panduan Keyboard Shortcuts</strong> (<code>help/pemrograman/operasional/panduan-keyboard-shortcuts</code>).</li>
                                                <li>Penambahan <strong>Skema Audit Log &amp; Error Tracking</strong> (<code>help/pemrograman/skema/audit-log-dan-error-tracking</code>) &amp; <strong>Panduan Audit Log &amp; Investigasi Error</strong> (<code>help/pemrograman/operasional/panduan-audit-log-dan-investigasi-error</code>).</li>
                                                <li>Penambahan <strong>Skema Database Backup &amp; Relasi</strong> (<code>help/pemrograman/skema/database-backup-dan-relasi-tabel</code>) &amp; <strong>Panduan Backup &amp; Restore DB</strong> (<code>help/pemrograman/operasional/panduan-backup-dan-restore-database</code>).</li>
                                                <li>Penambahan <strong>Skema Profil &amp; Avatar Studio</strong> (<code>help/pemrograman/skema/profil-pengguna-dan-avatar-studio</code>) &amp; <strong>Panduan Zero-Reload &amp; Button Loading</strong> (<code>help/pemrograman/operasional/panduan-standar-zero-reload-dan-button-loading</code>).</li>
                                                <li>Pembaruan modern <strong>Skema Auth &amp; Middleware</strong> (Spatie Matrix, Izin Terwarisi vs Langsung) &amp; <strong>Workflow Developer Harian</strong> (Rules 4, 5, 6, 7).</li>
                                                <li>Penyelarasan Overview Daftar Isi dalam 100% Bahasa Indonesia murni terstruktur per kategori, registrasi sidebar navigasi lengkap, perbaikan rendering variabel Blade dokumentasi, dan kamus dwibahasa (ID/EN).</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.28.0-->

                        <!--begin::Item v1.27.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.27.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.27.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>17 Sep 2026, 21:55 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Sistem Log Aktivitas Sentral (Audit Log Engine), Pencatatan Error Backend, Isolasi Riwayat Profil &amp; Petunjuk App Fiturs</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi arsitektur perekaman log aktivitas terpusat (<em>System Activity &amp; Audit Engine</em>) pada seluruh modul Manajemen Pengguna &amp; Pendukung Aplikasi, penangkapan error backend otomatis (<code>level = 'error'</code>), tab interaktif <strong>Log Aktivitas Sistem</strong> di modul Fitur Aplikasi dengan DataTables Zero-Reload, isolasi ketat riwayat aktivitas profil pengguna, pembaruan realtime dinamis tanpa reload halaman, serta penambahan modal petunjuk operasional <code>&lt;x-petunjuk-modal&gt;</code>.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Centralized Audit Logging Engine</strong>: Perluasan skema tabel <code>users_logs</code> dengan kolom terindeks <code>module</code>, <code>menu</code>, <code>level</code>, dan <code>user_id</code> (nullable), didukung helper serbaguna <code>UserLog::record()</code>.</li>
                                        <li><strong>Comprehensive Audit Across Modules</strong>: Perekaman audit di seluruh aksi <em>User Management</em> (User, Role, Permission, Akses Role, Akses User, Data Login) dan <em>App Support</em> (App Fitur, Backup Database, Menu Management).</li>
                                        <li><strong>Automatic Backend Exception Catcher</strong>: Integrasi penanganan error di <code>bootstrap/app.php</code> untuk mencatat pesan error, file, dan baris kode ke log sistem secara otomatis tanpa mengganggu alur aplikasi.</li>
                                        <li><strong>Interactive Activity Logs Tab (<code>appsupport/app-fiturs</code>)</strong>: Tab baru <em>Log Aktivitas Sistem</em> dilengkapi 6 widget statistik realtime, filter dinamis (Modul, Level, Rentang Tanggal), DataTables Zero-Reload, dan modal inspeksi detail log teknis.</li>
                                        <li><strong>Profile Audit Isolation &amp; Realtime Sync</strong>: Isolasi tampilan riwayat di <em>Profil Pengguna</em> khusus untuk aktivitas profil pengguna (<code>module = 'profil'</code>) dengan penyuntikan instan entri baru ke timeline tanpa reload halaman.</li>
                                        <li><strong>Operational Guidelines Modal &amp; Badge Toggle</strong>: Penambahan modal petunjuk operasional <code>&lt;x-petunjuk-modal&gt;</code> untuk modul Fitur Aplikasi serta aktivasi toggle status langsung via klik badge di tabel.</li>
                                        <li><strong>Standarisasi Avatar Lock Screen &amp; Modal Tentang</strong>: Penyesuaian bentuk avatar layar kunci ke kotak rounded-3 squircle standar dan integrasi link cepat Changelog pada modal Tentang Aplikasi dengan dukungan dwibahasa (EN/ID).</li>
                                        <li><strong>Penyelarasan Rute Distribusi Widget Demo</strong>: Pembaruan seluruh link pratinjau demo pada modul Distribusi Widget ke rute kanonikal <code>main/demo/*</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.27.0-->

                        <!--begin::Item v1.26.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.26.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.26.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>17 Sep 2026, 20:55 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Sistem Reward 1 Poin Login 24 Jam, Pencatatan Sesi Layar Kunci, &amp; Modul Riwayat Data Login</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi sistem reward otomatis 1 poin per siklus 24 jam saat pengguna login, pencatatan komprehensif seluruh frekuensi sesi Login Web dan Buka Layar Kunci (<em>Lock Screen</em>), modul antarmuka Data Login terstandarisasi (<code>usermanagement/data-login</code>) dengan 4 widget statistik, filter dinamis, DataTables Zero-Reload, modal inspeksi detail teknis, petunjuk operasional <code>&lt;x-petunjuk-modal&gt;</code>, serta visualisasi badge poin pengguna di seluruh antarmuka.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>24-Hour Point Reward Engine</strong>: Penambahan kolom <code>points</code>, <code>login_count</code>, <code>last_login_at</code>, dan <code>last_point_at</code> pada tabel <code>users</code>. Pengguna mendapatkan reward +1 poin pada login pertama dalam interval &ge; 24 jam. Login berulang dalam rentang &lt; 24 jam tidak menduplikasi poin.</li>
                                        <li><strong>Comprehensive Session Activity Logging</strong>: Pembuatan tabel <code>users_logins</code> untuk mencatat seluruh sesi masuk sistem via <em>Login Web</em> maupun <em>Buka Layar Kunci (Lock Screen)</em> memuat tipe aksi, IP klien, peramban (browser), sistem operasi (platform), perangkat (desktop/mobile/tablet), dan user agent mentah.</li>
                                        <li><strong>Data Login Module (<code>usermanagement/data-login</code>)</strong>: Antarmuka pemantauan log dengan Header Banner mandiri, 4 widget statistik realtime (Total Logins, Web vs Kunci, Reward Poin 24 Jam, Pengguna Aktif Hari Ini), filter interaktif (Tipe, Poin, Peran, Tanggal), DataTables Zero-Reload, modal detail teknis, hapus massal (<em>Bulk Delete</em>), dan pembersihan log (<em>Clear Logs</em>).</li>
                                        <li><strong>Operational Guidelines Standardization</strong>: Integrasi modal panduan <code>&lt;x-petunjuk-modal&gt;</code> terstruktur dengan 4 kotak informasi sesuai standar Manajemen Pengguna.</li>
                                        <li><strong>Global User Points Visualization</strong>: Penambahan indikator poin pada menu dropdown akun navbar, header profil pengguna, dan kartu daftar pengguna.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.26.0-->

                        <!--begin::Item v1.25.2 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.25.2</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold text-white">v1.25.2</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>17 Sep 2026, 15:15 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Pemisahan &amp; Restrukturisasi Folder Log (Changelog &amp; Console Developer)</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pemisahan modul riwayat versi (<em>Changelog</em>) dan alat bantu pengembang (<em>Console Developer</em>) ke dalam folder khusus <code>views/pages/help/log/</code>, penyesuaian konfigurasi sub-menu sidebar <code>_sidebar_helps.php</code>, penyelarasan route name (<code>help.log.changelog</code> &amp; <code>help.log.console-developer</code>), serta penambahan kamus lokalisasi.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Dedicated Log Directory</strong>: Pemindahan berkas <code>changelog.blade.php</code> dan <code>console-developer.blade.php</code> ke sub-folder <code>pages/help/log/</code>.</li>
                                        <li><strong>Sidebar Menu &amp; Route Sync</strong>: Pembaruan route <code>help.log.changelog</code> dan <code>help.log.console-developer</code> di bawah grup menu <em>Log</em> pada <code>_sidebar_helps.php</code>.</li>
                                        <li><strong>Bilingual &amp; Breadcrumb Alignment</strong>: Penambahan kunci terjemahan <code>'log' =&gt; 'Log'</code> pada kamus EN/ID dan pembaruan breadcrumb toolbar.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.25.2-->

                        <!--begin::Item v1.25.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.25.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold text-white">v1.25.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>17 Sep 2026, 14:55 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Restrukturisasi Direktori Partials User Management &amp; App Support Menu</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penyelarasan arsitektur folder modular partials dengan memindahkan berkas-berkas parsial Pengguna ke sub-folder <code>partials/users/</code> dan Menu ke <code>partials/menu/</code> agar konsisten dengan standar sub-folder modul lainnya (Rule #6).
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>User Management Partials</strong>: Pengelompokan 8 berkas partials pengguna ke folder <code>resources/views/pages/usermanagement/partials/users/</code>.</li>
                                        <li><strong>App Support Menu Partials</strong>: Pengelompokan berkas modal &amp; petunjuk menu ke folder <code>resources/views/pages/appsupport/partials/menu/</code>.</li>
                                        <li><strong>Sinkronisasi View &amp; Controller</strong>: Penyesuaian seluruh pemanggilan <code>&#64;include</code> di Blade dan render view AJAX di <code>UserController@index</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.25.1-->

                        <!--begin::Item v1.25.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.25.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.25.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>17 Sep 2026, 14:40 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Pemberian Role Massal (Bulk Assign Role), Checkbox Seleksi Pengguna, Komponen Universal Petunjuk Modal, Perbaikan Filter Multi-Role, &amp; Pratinjau Avatar Fokus Atas</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi fitur pemberian peran secara massal (<em>Bulk Assign Role</em>) lengkap dengan checkbox seleksi di tampilan Kartu &amp; Tabel, modal penetapan peran multi-opsi (<em>Append</em> / <em>Replace</em>), perbaikan <em>type-safety</em> pencarian dan filter multi-role pada DataTables, optimalisasi pratinjau unggah foto avatar langsung fokus bagian atas (<em>top-aligned</em> 50% 0%), standarisasi komponen Blade universal <code>&lt;x-petunjuk-modal&gt;</code> di seluruh modul sistem, serta perombakan layout matriks Akses Role menjadi 2-kolom dengan sidebar vertikal.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Bulk Assign Role Engine</strong>: Checkbox seleksi pada kartu dan tabel, tombol aksi massal dinamis di toolbar, modal <code>users-bulk-role-modal.blade.php</code>, dan controller <code>UserController@bulkAssignRole</code> berbasis database transaction.</li>
                                        <li><strong>DataTables Multi-Role &amp; Filter Robustness</strong>: Penanganan aman tipe input pencarian (mencegah error PHP 8+) dan optimasi query <code>whereHas('roles')</code> untuk pengguna multi-role.</li>
                                        <li><strong>Top-Aligned Avatar Preview</strong>: Penyelarasan pratinjau unggah avatar baru agar langsung terfokus pada bagian atas gambar (<code>50% 0%</code>), konsisten dengan profil pengguna.</li>
                                        <li><strong>Universal Reusable Petunjuk Modal Component</strong>: Pembuatan <code>&lt;x-petunjuk-modal&gt;</code> Blade component dan standarisasi toolbar pemicu petunjuk di <code>users</code>, <code>roles</code>, <code>permissions</code>, <code>akses-role</code>, <code>akses-user</code>, <code>backup-db</code>, dan <code>menu</code>.</li>
                                        <li><strong>Akses Role 2-Column Sidebar Layout</strong>: Restrukturisasi visual matriks hak akses dengan tab vertikal role di sebelah kiri dan tabel matriks di sebelah kanan.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.25.0-->

                        <!--begin::Item v1.24.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.24.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.24.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>17 Sep 2026, 12:40 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Penyelarasan Spatie Laravel Permission, Visualisasi Izin Terwarisi vs Langsung, Standarisasi Header Banner (Rule #7), dan Optimasi Scroll Akses Role</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penyelarasan menyeluruh resolusi hak akses menu sidebar dengan dukungan multi-format (titik dan garis miring) serta penghapusan otomatis suffix <code>.index</code>, standarisasi format izin GUI Tambah Menu sesuai seeder, penambahan visualisasi badge <code>[🛡️ Peran]</code> untuk izin terwarisi pada modal Izin Khusus Akses User, pelepasan scroll internal tabel matriks pada halaman Akses Role untuk scrolling halaman yang lebih alami, serta formalisasi aturan sistem Rule #7 (Header Banner, Toolbar Petunjuk &amp; Tema Dinamis).
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Sidebar Permission Resolution</strong>: Peningkatan <code>menuCanReadUrl()</code> dan <code>$canReadRoute</code> untuk mengenali format izin slash maupun dot serta auto-strip <code>.index</code>.</li>
                                        <li><strong>Visualisasi Izin Terwarisi (Inherited vs Direct)</strong>: Cell tabel modal izin khusus menampilkan badge elegan simetris untuk izin bawaan peran dan checkbox bersih untuk izin langsung.</li>
                                        <li><strong>Standar Header Banner &amp; Toolbar Petunjuk (Rule #7)</strong>: Standardisasi kartu banner judul modul mandiri dan penempatan petunjuk di toolbar atas.</li>
                                        <li><strong>Optimasi Full Scroll Akses Role</strong>: Penambahan parameter <code>scrollable</code> untuk menonaktifkan kotak scroll ganda pada halaman matriks peran.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.24.0-->

                        <!--begin::Item v1.23.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.23.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.23.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>17 Sep 2026, 09:30 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Database Backup Engine Berelasi Cerdas, Auto-Backup Scheduler, Matriks CRUD Izin Visual Hierarki, dan Rangkaian User Management</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh modul Backup Database Cerdas (<code>appsupport/backup-db</code>) dengan inspeksi skema relasional, penghitungan baris tepat (<code>SELECT COUNT(*)</code>), auto-select Foreign Key dependensi, kompresi streaming gzip, pencatatan jejak audit pelaksana cadangan, inspeksi struktur &amp; preview baris data live, serta scheduler otomatis. Dilengkapi antarmuka Matriks Izin Visual CRUD berhierarki interaktif (<code>PermissionMatrixService</code>, <code>crud-matrix-table.blade.php</code>) pada seluruh modul Manajemen Peran, Izin, Akses Peran, dan Akses Pengguna.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Mesin Backup Database Berelasi (<code>DatabaseBackupService</code>)</strong>: Ekstraksi skema tabel, auto-select relasi tabel anak/induk, kompresi <code>.sql.gz</code>, dan pencatatan nama eksekutor backup.</li>
                                        <li><strong>Preview Struktur Skema &amp; Data Live</strong>: Modal multi-tab untuk memeriksa kolom, tipe data, indeks, FK, dan 10 baris live data tabel.</li>
                                        <li><strong>Scheduler Auto-Backup Database</strong>: Perintah artisan <code>db:auto-backup</code> terjadwal otomatis dengan konfigurasi retensi cadangan.</li>
                                        <li><strong>Matriks Izin CRUD Visual Interaktif</strong>: Visual tree hierarki menu utama &amp; sub-menu dengan toggle CRUD (create, read, update, delete, sort, export) dan checkbox massal.</li>
                                        <li><strong>Modul User Management Suite</strong>: Manajemen Peran (Roles), Izin (Permissions), Akses Peran (Akses Role), dan Akses Pengguna (Akses User) dengan Zero-Reload Realtime CRUD dan Button Loading Spinner.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.23.0-->

                        <!--begin::Item v1.22.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.22.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.22.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>16 Sep 2026, 23:45 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Avatar Studio Modal Khusus, Kontrol Zoom Dinamis hingga 5x &amp; Fokus 2-Axis (X/Y), Penataan Grid Tab Profil Saya, serta Helper Render Avatar Global</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pemisahan formulir penggantian avatar dan pengaturan fokus/zoom ke dalam modal pop-up interaktif (<code>avatar-modal.blade.php</code>) yang dipicu langsung dari avatar header profil, penyediaan kontrol zooming hingga 5x (500%) serta slider posisi 2-axis (Vertikal Y dan Horizontal X) dengan live preview berukuran 160x160px kotak <code>rounded-3</code>, restrukturisasi tata letak kartu pada tab Profil Saya (Informasi Akun berdampingan dengan Foto KTP, Data Kependudukan &amp; Alamat Domisili di baris bawah), standarisasi helper avatar global (<code>user_avatar()</code>, <code>user_avatar_style()</code>), serta reset nilai posisi default (50% X, 50% Y, 100% zoom) saat avatar dihapus atau belum diunggah.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Modal Avatar Terdedikasi</strong>: Pemindahan komponen upload avatar dari tab Profil Saya ke modal khusus yang langsung dapat diakses dengan mengklik foto avatar atau tombol pensil di header profil.</li>
                                        <li><strong>Zooming Dinamis hingga 5x (500%)</strong>: Slider perbesaran gambar avatar dari skala normal 100% (1x) hingga 500% (5x) dilengkapi tombol preset instan (1x, 1.5x, 2x, 3x, 4x, 5x).</li>
                                        <li><strong>Fokus 2-Axis (Vertikal &amp; Horizontal)</strong>: Kontrol posisi bebas pada sumbu Y (0%-100% Atas/Tengah/Bawah) dan sumbu X (0%-100% Kiri/Tengah/Kanan) dengan pratinjau langsung 1:1.</li>
                                        <li><strong>Grid Tab Profil Saya Rapi &amp; Proporsional</strong>: Card Foto KTP mandiri di sebelah kanan Informasi Akun, sementara Data Kependudukan KTP dan Alamat Domisili tertata rapi di baris kedua.</li>
                                        <li><strong>Helper Rendering Avatar Global</strong>: Fungsi helper <code>user_avatar($user, $size, $class, ...)</code> dan <code>user_avatar_style($user)</code> untuk keseragaman visual di seluruh modul.</li>
                                        <li><strong>Penanganan Default Center &amp; Zero-Reload Sync</strong>: Pengaturan otomatis posisi ke tengah (50% 50%) dan zoom 100% saat pengguna belum memiliki foto avatar atau saat foto profil dihapus, dengan sinkronisasi realtime di semua antarmuka (header, topbar navbar, lock screen).</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.22.0-->

                        <!--begin::Item v1.21.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.21.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.21.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>16 Sep 2026, 15:10 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Implementasi Penuh Modul User Management, Arsitektur Partials &amp; Petunjuk Modul, Multi-Role Badges, serta Header Cover Dinamis</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembangunan modul User Management (<code>usermanagement/users</code>) lengkap dengan arsitektur MVC dan Form Request, modularisasi komponen Blade ke sub-folder <code>partials/</code>, penyertaan petunjuk operasional modul dinamis, penanganan Multi-Role (Select2 multi-select &amp; badge per peran), visualisasi Card View dengan header cover dari basis data profil pengguna, modal rincian pengguna berlatar cover dinamis, avatar kotak sudut tumpul (<code>rounded-3</code>) tanpa penanda dot, serta integrasi Yajra DataTables AJAX Zero-Reload.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Modul User Management Lengkap</strong>: Endpoint CRUD, Form Requests (<code>UserStoreRequest</code>, <code>UserUpdateRequest</code>), pencarian instan, filter peran, status verifikasi email, dan pengurutan dinamis.</li>
                                        <li><strong>Standar Partials &amp; Petunjuk Modul</strong>: Pemisahan 6 sub-komponen (filter, cards-pane, cards-list, table-pane, form-modal, detail-modal) dan panduan operasional (<code>users-petunjuk.blade.php</code>) sesuai aturan baku <code>module-partials-and-operational-guidelines.md</code>.</li>
                                        <li><strong>Multi-Role Assignment &amp; Presentation</strong>: Dukungan banyak peran per pengguna dengan Select2 multi-select, sinkronisasi <code>syncRoles</code>, dan multi-badge berpenampilan harmonis.</li>
                                        <li><strong>Header Cover Kartu &amp; Modal Detail</strong>: Header kartu dan modal detail terintegrasi langsung dengan database cover profil pengguna (<code>cover_background</code>, <code>cover_opacity</code>, <code>cover_overlay_color</code>, <code>cover_position_y</code>, <code>cover_blur</code>).</li>
                                        <li><strong>Standarisasi Avatar</strong>: Avatar kotak sudut tumpul (<code>rounded-3</code>) fokus bagian atas gambar (<code>background-position: top center; background-size: cover;</code>) tanpa bulatan status dot.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.21.0-->

                        <!--begin::Item v1.20.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.20.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.20.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>16 Sep 2026, 13:45 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Integrasi Profil Hero Banner Dashboard (v1 &amp; v2), Input &amp; Field Moto Hidup Pengguna, serta Penyelarasan Topbar Avatar v2</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Integrasi penuh hero banner dashboard utama (versi v1 dan v2) yang menampilkan cover background dinamis, letak avatar berdampingan di kiri nama dan moto hidup, penambahan kolom dan formulir Moto Hidup pada tab Profil Saya dan Identitas Diri dengan indikator loading spinner dan sinkronisasi realtime, serta standarisasi avatar user pada topbar v2.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Sorotan Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li><strong>Dashboard Hero Banner (v1 &amp; v2)</strong>: Merender cover background, posisi vertikal, efek blur/overlay kontras dinamis pengguna, serta avatar berdampingan dengan nama dan moto hidup.</li>
                                        <li><strong>Field Moto Hidup Database</strong>: Migrasi <code>2026_09_16_061820_add_moto_hidup_to_users_details_table.php</code> menambahkan kolom <code>moto_hidup</code> pada <code>users_details</code>.</li>
                                        <li><strong>Manajemen Moto Hidup Multi-Tab</strong>: Form input Moto Hidup di Tab Profil Saya dan Identitas Diri dengan AJAX Zero-Reload dan button loading spinner.</li>
                                        <li><strong>Penyelarasan Avatar Topbar v2</strong>: Standarisasi <code>__topbar-v2.blade.php</code> dengan wrapper <code>image-input-wrapper</code> dan ID elemen yang sinkron dengan v1.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.20.0-->

                        <!--begin::Item v1.19.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.19.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.19.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>16 Sep 2026, 12:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Arsitektur 1-User-1-Baris JSON Settings, Sinkronisasi Avatar Realtime Lock Screen, &amp; Layout 2 Kolom Preferensi</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan arsitektur basis data yang mentransformasi tabel konfigurasi pengguna (<code>users_settings</code>) menjadi format 1 baris per user dengan kolom JSON terstruktur per kategori, implementasi sinkronisasi foto avatar modal lock screen secara realtime tanpa reload, penyesuaian nilai default banner cover profil, serta restrukturisasi kartu preferensi menjadi 2 kolom responsif.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Skema Database 1-User-1-Baris JSON:</strong> Mengubah <code>users_settings</code> menjadi tabel berbasis kolom JSON (<code>profile_cover</code>, <code>preferences</code>, <code>custom</code>) dengan migrasi otomatis tanpa kehilangan data (*Zero Data Loss*).</li>
                                        <li class="mb-1"><strong>Model &amp; Helper Harmonization:</strong> Menjaga kompabilitas fungsi <code>$user->setting()</code> dan <code>$user->setSetting()</code> secara transparan.</li>
                                        <li class="mb-1"><strong>Realtime Lock Screen Avatar Sync:</strong> Sinkronisasi instan elemen <code>#lock_screen_avatar_img</code> saat avatar diunggah/dihapus via event global <code>kt.user.updated</code> dan API <code>KTLockScreen.updateUser()</code>.</li>
                                        <li class="mb-1"><strong>Default Profile Cover Banner:</strong> Mengatur default fokus vertikal ke 30%, tinggi cover 250px, ketebalan penutup 60%, dan warna penutup gelap (#000000).</li>
                                        <li class="mb-1"><strong>Tata Letak 2 Kolom Preferensi:</strong> Membagi form preferensi menjadi Kolom 1 (Notifikasi, Keamanan, Bahasa, Tema) dan Kolom 2 (Area Kustomisasi Khusus, Hemat Data, Rekap Mingguan).</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.19.0 (Minor)-->

                        <!--begin::Item v1.18.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.18.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.18.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>16 Sep 2026, 10:15 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Profile Cover Background Studio &amp; Kontras Dinamis Header Profil</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan fitur kustomisasi banner header profil pengguna dengan live preview client-side, slider posisi vertikal, pengaturan tinggi cover, ketebalan overlay kontras, filter blur, dan pemisahan formulir konfigurasi profil.
                                </p>
                            </div>
                        </div>
                        <!--end::Item v1.18.0 (Minor)-->

                        <!--begin::Item v1.17.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.17.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold text-white">v1.17.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>16 Sep 2026, 08:55 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Dukungan Dark Mode Adaptif &amp; Penyelarasan Kontras Visual Seluruh Rute Dokumentasi Help (Skema &amp; Operasional)</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan perbaikan visual yang mengimplementasikan dukungan penuh mode gelap (dark mode) pada seluruh 26 halaman dokumentasi skema arsitektur dan panduan operasional pemrograman melalui design tokens adaptif, optimasi kontras blok kode, kontainer shell, kartu, dan kartu overview.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Design Tokens Dark Mode (<code>_schema-ui.blade.php</code>):</strong> Mendefinisikan rule scoped <code>[data-bs-theme="dark"]</code>, <code>[data-theme="dark"]</code>, dan <code>.dark-mode</code> untuk seluruh variabel warna surface, teks, border, dan gradient.</li>
                                        <li class="mb-1"><strong>Kontras Blok Kode &amp; Shell:</strong> Menyesuaikan blok kode terminal <code>pre.schema-code</code>, inline <code>&lt;code&gt;</code>, dan <code>.schema-step</code> agar memiliki kontras tajam, bebas pantulan putih menyilaukan, dan nyaman dibaca dalam kondisi gelap.</li>
                                        <li class="mb-1"><strong>Penyelarasan Kartu Catatan &amp; Peringatan:</strong> Optimasi saturasi transparan untuk <code>.schema-note</code>, <code>.schema-warn</code>, dan <code>.schema-chip</code>.</li>
                                        <li class="mb-1"><strong>Penyelarasan Kartu Overview (<code>overview.blade.php</code>):</strong> Memperbaiki perpaduan warna latar dan ikon agar tidak terjadi benturan warna gelap pada mode dark.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.17.1 (Patch)-->

                        <!--begin::Item v1.17.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.17.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.17.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>16 Sep 2026, 08:40 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Restrukturisasi Arsitektur Domain Main Menu (Dashboards &amp; Demo), Routing Prefix, dan Penyelarasan Hierarki Breadcrumbs</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan arsitektural yang menata ulang views domain Dashboards dan Demo ke dalam folder modular <code>resources/views/pages/main/</code>, konsolidasi konfigurasi ke <code>config/sidebar/_sidebar_main.php</code>, standardisasi prefix URL <code>/main/dashboards/*</code> dan <code>/main/demo/*</code> dengan route names <code>main.dashboards.*</code> &amp; <code>main.demo.*</code>, penyelarasan header dropdown, pembersihan file legacy <code>_sidebar_dashboard.php</code> &amp; <code>_sidebar_demo.php</code>, serta penambahan hierarki breadcrumbs 3-tingkat (<code>Home</code> &rarr; <code>Main Menu</code> &rarr; <code>Dashboard / Demo</code>).
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Folder View Modular:</strong> Pemindahan blade templates dari <code>pages/dashboards/</code> dan <code>pages/demo/</code> ke <code>resources/views/pages/main/dashboards/</code> dan <code>resources/views/pages/main/demo/</code> agar 100% selaras dengan pola domain <code>pages</code>, <code>apps</code>, <code>layouts</code>, dan <code>help</code>.</li>
                                        <li class="mb-1"><strong>Konsolidasi Config Sidebar:</strong> Seluruh item menu dashboard dan demo disatukan dalam <code>config/sidebar/_sidebar_main.php</code> (<code>menus_dashboard</code>, <code>menus_dashboard_collapsed</code>, <code>menu_demos</code>). File usang <code>_sidebar_dashboard.php</code> dan <code>_sidebar_demo.php</code> telah dihapus bersih.</li>
                                        <li class="mb-1"><strong>Routing Otomatis &amp; URL Prefix:</strong> Router generator dinamis pada <code>routes/menu.php</code> memetakan URL <code>/main/dashboards/*</code> dan <code>/main/demo/*</code> dengan route name <code>main.dashboards.*</code> dan <code>main.demo.*</code> serta target view <code>pages.main.*</code>. Termasuk route widget demo preview pada <code>/main/demo/widget-preview</code>.</li>
                                        <li class="mb-1"><strong>Sinkronisasi Header Dropdown Menu:</strong> Konfigurasi <code>config/header/_header_dashboard.php</code> dan <code>config/header/_header_demo.php</code> diperbarui menggunakan route baru, menyelesaikan potensi <code>RouteNotFoundException</code>.</li>
                                        <li class="mb-1"><strong>Hierarki Breadcrumbs 3 Lapis:</strong> Engine <code>app/Helpers/GetPageTitle.php</code> kini menghasilkan jejak breadcrumb <code>Home</code> &rarr; <code>Main Menu</code> &rarr; <code>Dashboard</code> (atau <code>Demo</code>) &rarr; <code>[Judul Halaman]</code>.</li>
                                        <li class="mb-1"><strong>Kamus Bahasa (i18n):</strong> Menambahkan key translasi <code>mainmenu</code>, <code>main_menu</code>, <code>main</code>, <code>dashboard</code>, dan <code>dashboards</code> di <code>lang/id/menu.php</code>, <code>lang/en/menu.php</code>, dan <code>public/assets/js/custom/language.js</code>.</li>
                                        <li class="mb-1"><strong>Automation Scripts:</strong> Pembaruan path pemindaian widget pada <code>distribusi-widget.blade.php</code>, <code>distribusi-demo.blade.php</code>, <code>sync-widgets-demo.ps1</code>, dan <code>merge-flexible-widgets.ps1</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.17.0 (Minor)-->

                        <!--begin::Item v1.16.2 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.16.2</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold text-white">v1.16.2</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>16 Sep 2026, 07:55 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Standardisasi Indikator Loading Spinner Tombol, Ikon Validasi Password, &amp; Penyelarasan Header Welcome</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan pemeliharaan yang menetapkan kebijakan baku indikator proses loading spinner pada seluruh tombol submit/eksekusi aksi, perbaikan ikon validasi seru merah tunggal dengan pemisahan jarak dari tombol toggle password, penyelarasan tampilan toolbar landing/welcome page, serta pembaruan teks pemisah autentikasi.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Kebijakan Loading Spinner Tombol:</strong> Implementasi utilitas <code>KTButtonLoader</code> pada <code>notification-helper.js</code> dan penerapan class <code>.indicator-label</code> &amp; <code>.indicator-progress</code> pada tombol submit halaman autentikasi (Login, Register, Forgot Password, Reset Password) untuk mencegah double-click.</li>
                                        <li class="mb-1"><strong>Aturan Standar Agen:</strong> Pembuatan aturan resmi <code>.agents/rules/button-loading-spinner-standards.md</code> dan penambahan poin pedoman ke <code>AGENTS.md</code>.</li>
                                        <li class="mb-1"><strong>Ikon Validasi Password &amp; Spacing:</strong> Menghilangkan duplikasi ikon validasi browser, memastikan warna merah solid (#f1416c) universal untuk <code>.is-invalid</code>, dan memberikan jarak aman (~30px) antara ikon seru dengan ikon eye toggle show/hide password.</li>
                                        <li class="mb-1"><strong>Penyelarasan Toolbar Welcome / Landing:</strong> Menyamakan tinggi tombol Login/Dashboard menjadi 35px, menonaktifkan tooltip tombol di header welcome, dan memberikan efek frosted non-transparan pada tombol dropdown bahasa.</li>
                                        <li class="mb-1"><strong>Penyederhanaan Teks Pemisah Autentikasi:</strong> Mengubah teks pemisah autentikasi <em>"Or with email"</em> menjadi <em>"Or"</em> (EN) dan <em>"Atau"</em> (ID) di view dan sistem terjemahan.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.16.2-->

                        <!--begin::Item v1.16.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.16.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold text-white">v1.16.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>15 Sep 2026, 23:45 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Penyempurnaan Auto Lock Screen, Sinkronisasi Ukuran Avatar Profil &amp; .env.example</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan pemeliharaan yang menyelaraskan fitur penguncian layar otomatis (Auto Lock Screen) dengan preferensi profil pengguna, standardisasi ukuran avatar details profil sesuai template asli Metronic, penanganan tooltip dan state tombol hapus avatar saat reload, serta sinkronisasi penuh berkas <code>.env.example</code>.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Auto Lock Screen &amp; User Preference:</strong> Penambahan atribut <code>data-autolock-enabled</code> untuk mematuhi preferensi pengguna dan penanganan respons 401 unauthenticated session expiry yang elegan.</li>
                                        <li class="mb-1"><strong>Ukuran Avatar Details Profil:</strong> Menyelaraskan ukuran avatar ke standar template Metronic (160px desktop / 100px mobile) via class <code>.symbol-label</code> tanpa mengubah fungsionalitas background-image dan zero-reload.</li>
                                        <li class="mb-1"><strong>State Tombol Hapus &amp; Tooltip Cleanup:</strong> Penambahan class dinamis <code>.image-input-empty</code> saat reload serta pembersihan otomatis tooltip Bootstrap saat tombol hapus diklik.</li>
                                        <li class="mb-1"><strong>Sinkronisasi .env.example:</strong> Penyelarasan konfigurasi <code>CACHE_STORE=database</code> dan variabel environment pada <code>.env.example</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.16.1-->

                        <!--begin::Item v1.16.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.16.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold text-white">v1.16.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>15 Sep 2026, 23:15 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Reorganisasi Domain Namespace Model, Controller, &amp; Factory</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Restrukturisasi menyeluruh arsitektur kode backend ke dalam namespace domain modular (<code>AppSupport</code>, <code>UserManagement</code>, dan <code>Profil</code>) untuk meningkatkan maintainability dan standardisasi proyek, merapikan model duplikat di root <code>app/Models</code>, memindahkan <code>UserController</code> ke <code>UserManagement</code>, serta menyelaraskan database factory dan seeders.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Domain Models Sub-Namespaces:</strong> Pengelompokan model ke <code>App\Models\AppSupport</code> (<code>AppFitur</code>, <code>AppSetting</code>, <code>Menu</code>), <code>App\Models\UserManagement</code> (<code>User</code>, <code>Role</code>, <code>Permission</code>), dan <code>App\Models\Profil</code> (<code>UserDetail</code>, <code>UserLog</code>, <code>UserSetting</code>).</li>
                                        <li class="mb-1"><strong>Controller &amp; Asset Realignment:</strong> Memindahkan <code>UserController</code> ke <code>App\Http\Controllers\UserManagement\UserController</code>, menyelaraskan route prefix ke <code>usermanagement.users.*</code>, dan merelokasi asset JS ke <code>public/assets/js/usermanagement/users.js</code>.</li>
                                        <li class="mb-1"><strong>UserFactory &amp; Config Alignment:</strong> Memindahkan factory ke <code>Database\Factories\UserManagement\UserFactory</code> serta memperbarui konfigurasi <code>config/auth.php</code> dan <code>config/permission.php</code>.</li>
                                        <li class="mb-1"><strong>Full Seeders &amp; Test Suite Synchronization:</strong> Memperbarui seluruh seeder dan unit/feature tests agar mengacu ke namespace baru tanpa regresi.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.16.0-->

                        <!--begin::Item v1.15.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.15.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold text-dark">v1.15.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>15 Sep 2026, 22:35 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Zero-Flicker Bilingual Multi-Environment &amp; Fresh-Seed Hardening</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penyempurnaan arsitektur <i>Zero-Flicker Bilingual Engine</i> agar berjalan 100% konsisten lintas perangkat (PC &amp; Laptop) serta sesudah eksekusi <code>php artisan migrate:fresh --seed</code>, memastikan locale dinamis pada payload kamus backend, pembacaan cookie ganda (<code>kt_lang</code> &amp; <code>data-kt-lang</code>) di middleware <code>SetLocale</code>, serta pembersihan cache otomatis di seeder.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Dynamic Locale In-Memory Payload:</strong> Memperbarui <code>LanguageManager::getClientPayload()</code> agar menyuntikkan locale aktif request secara dinamis sehingga cache kamus tidak mengunci locale sebelumnya saat berpindah bahasa.</li>
                                        <li class="mb-1"><strong>Multi-Variant Cookie Middleware:</strong> Memperkuat <code>SetLocale.php</code> untuk membaca seluruh varian cookie klien secara prioritas dan menambahkan <code>Cookie::queue()</code> agar request navigasi berikutnya selalu sinkron dari milidetik pertama di sisi server (SSR).</li>
                                        <li class="mb-1"><strong>Synchronous Dual-Cookie Persistence:</strong> Menuliskan cookie <code>kt_lang</code> dan <code>data-kt-lang</code> secara sinkron di <code>language.js</code> dan <code>_init.blade.php</code> sebelum translasi DOM dijalankan.</li>
                                        <li class="mb-1"><strong>Automated Seeder Cache Invalidation:</strong> Menambahkan pembersihan cache otomatis di <code>DatabaseSeeder.php</code>, <code>MenuSeeder.php</code>, dan <code>AppSettingSeeder.php</code> untuk menjamin fresh database migration bersih dari residu cache lama.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.15.1-->

                        <!--begin::Item v1.15.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.15.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.15.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>15 Sep 2026, 22:15 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Modul Profil Pengguna 5-Tab, Direct Upload KTP &amp; Avatar Realtime, Zero-Reload CRUD Engine &amp; Aturan Standar</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi komprehensif modul Profil Pengguna dengan 5 tab interaktif (Profil Saya, Identitas Diri &amp; KTP terpisah, Ganti Password, Konfigurasi Preferensi, Riwayat Aktivitas), direct upload KTP dengan modal preview &amp; direct download, animated Profile Completion Percentage, standardisasi Zero-Reload Realtime CRUD Policy tanpa reload halaman, serta preservasi murni styling Metronic 8 tanpa custom CSS tambahan.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Modul Profil Pengguna 5 Tab:</strong> Antarmuka lengkap mencakup tab Profil Saya, Identitas Diri &amp; KTP terpisah, Ganti Password, Konfigurasi Pengguna, dan Riwayat Log Aktivitas Akun (<code>UserLog</code>).</li>
                                        <li class="mb-1"><strong>Direct Upload KTP &amp; Modal Preview:</strong> Upload, ubah, dan hapus berkas foto KTP langsung dari tab <i>Profil Saya</i> dengan modal popup bawaan Metronic 8 dan tombol <i>Download / Simpan Gambar</i> otomatis.</li>
                                        <li class="mb-1"><strong>Profile Completion Animation:</strong> Kalkulasi persentase kelengkapan data identitas &amp; berkas KTP terpusat dari backend dengan animasi countup dan progress bar interaktif.</li>
                                        <li class="mb-1"><strong>Zero-Reload Realtime Engine:</strong> Seluruh aksi simpan identitas, ganti avatar, upload KTP, ubah password, dan toggle preferensi berjalan via AJAX murni tanpa reload browser (<code>window.location.reload()</code>), state data DOM langsung terupdate seketika notifikasi SweetAlert2/Toastr ditutup dan tab aktif tetap terjaga.</li>
                                        <li class="mb-1"><strong>Aturan Standar Agen:</strong> Pembuatan <code>.agents/rules/crud-zero-reload-realtime-standards.md</code> dan pembaruan <code>AGENTS.md</code> untuk menjamin konsistensi zero-reload realtime CRUD pada seluruh modul.</li>
                                        <li class="mb-1"><strong>Pure Metronic 8 Utility Styling:</strong> 100% menggunakan komponen bawaan template tanpa menambah file/kode custom CSS baru.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.15.0-->

                        <!--begin::Item v1.14.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.14.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.14.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>15 Sep 2026, 14:35 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Islamic Hijri Day Names &amp; Two-Line Toolbar Date, Zero-Flicker Bilingual Engine, and Realtime Icon Style Switcher</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penambahan nama hari Islam pada helper kalender Hijriah dan penataan tampilan tanggal 2-baris (Masehi &amp; Hijriah) di toolbar tanpa menambah tinggi header, eliminasi kedipan bahasa (<i>zero-flicker bilingual engine</i>) pada Server-Side Rendering (SSR) dan DOM TreeWalker, perbaikan gaya ikon realtime di toolbar dengan preservasi ikon duotone, preservasi route publik welcome/landing page, serta pencatatan aturan ketat anti-regresi agen.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Islamic Hijri Day Names &amp; 2-Baris Toolbar:</strong> Integrasi nama hari Islam (<i>Al-Ahad</i>, <i>Al-Ithnayn</i>, <i>Al-Thulatha</i>, <i>Al-Arbi'a</i>, <i>Al-Khamis</i>, <i>Al-Jum'ah</i>, <i>Al-Sabt</i>) pada helper <code>toHijriah()</code> dan tata letak 2 baris tanggal di toolbar dengan tooltip responsif.</li>
                                        <li class="mb-1"><strong>Zero-Flicker Bilingual SSR:</strong> Peningkatan fungsi <code>translateMenuTitleSafely()</code> dengan pemetaan dua arah otomatis (<i>textMap id $\leftrightarrow$ en</i>) dari <code>LanguageManager</code>, partisi cache locale pada <code>sidebarAdditionalMenuSections()</code>, dan atribut <code>data-kt-translate</code> pada seluruh komponen menu header, sidebar, dan judul halaman.</li>
                                        <li class="mb-1"><strong>Realtime Icon Style Switcher:</strong> Perbaikan switcher gaya ikon (<code>duotone</code>, <code>solid</code>, <code>outline</code>) dengan isolasi <code>data-kt-icon-style-ignore="true"</code>, pemulihan 4-paths duotone pada sidebar, dan sinkronisasi realtime ke database &amp; tab Settings.</li>
                                        <li class="mb-1"><strong>Public Welcome Route:</strong> Akses rute halaman landing / welcome tetap terbuka untuk publik dan tamu setelah logout tanpa redirect tak diinginkan.</li>
                                        <li class="mb-1"><strong>Antigravity Agent Rules:</strong> Pembuatan <code>AGENTS.md</code> dan <code>.agents/rules/efficiency-and-targeted-execution.md</code> untuk mencegah eksekusi full test suite yang memakan waktu dan menjamin kompatibilitas ke belakang tanpa regresi.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.14.0-->

                        <!--begin::Item v1.13.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.13.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.13.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>09 Sep 2026, 18:45 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Modul CRUD Manajemen Pengguna, UserDataTable QueryBuilder Service, &amp; Antarmuka Murni Bahasa Indonesia</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh modul <b>Manajemen Pengguna</b> (<code>manajemenpengguna/users</code>) dengan class service <code>UserDataTable</code> berbasis <code>use Illuminate\Database\Eloquent\Builder as QueryBuilder;</code>, upload avatar foto profil dengan sinkronisasi realtime pada avatar header, modal CRUD interaktif, validasi <code>UserRequest</code>, serta standardisasi antarmuka murni Bahasa Indonesia tanpa istilah bilingual / dual language.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Dedicated Yajra UserDataTable Service:</strong> Pemisahan logika datatable ke <code>app/DataTable/ManajemenPengguna/UserDataTable.php</code> menggunakan Eloquent QueryBuilder dan inject di <code>UserController@@index</code>.</li>
                                        <li class="mb-1"><strong>Full CRUD &amp; Transaction Safety:</strong> Controller <code>UserController.php</code> menangani operasi store, edit, update, delete, dan reset password default (<code>password123</code>) berbalut DB transaction.</li>
                                        <li class="mb-1"><strong>Avatar Management &amp; Realtime Header Sync:</strong> Dukungan upload dan preview foto profil, serta update dinamis avatar pojok kanan atas secara realtime jika akun aktif diedit.</li>
                                        <li class="mb-1"><strong>Standardisasi Bahasa Indonesia Murni:</strong> Pembersihan seluruh notasi ganda/bilingual (menghapus <code>(Role)</code>, <code>(Avatar)</code>, mengubah <code>Master Data</code> &rarr; <code>Data Master</code>, <code>Refresh</code> &rarr; <code>Segarkan</code>, <code>Reset</code> &rarr; <code>Atur Ulang</code>) pada view, modal form, modal detail, DataTables language, dan notifikasi SweetAlert.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.13.0-->

                        <!--begin::Item v1.12.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.12.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold">v1.12.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>09 Sep 2026, 14:30 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">High-Performance In-Memory Static Memoization &amp; Query Overhead Elimination</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Peningkatan performa backend secara masif dengan mengimplementasikan <i>In-Memory Static Memoization</i> pada model <code>AppSetting</code> dan <code>AppFitur</code>, memangkas 2.850+ query database berulang menjadi hanya ~5 query per request (reduksi overhead 99.8%), memoization rute helper &amp; theme assets, preconnect Google Fonts, dan konfigurasi driver cache file.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>In-Memory Static Memoization:</strong> Penambahan properti <code>protected static ?array $memoryMap</code> pada <code>AppSetting.php</code> dan <code>AppFitur.php</code> untuk menyimpan hasil query dalam memori RAM PHP selama siklus request HTTP.</li>
                                        <li class="mb-1"><strong>99.8% Database Query Reduction:</strong> Menghilangkan 2.855 kali query SQL <code>select * from cache where key in ('veltronic-cache-app_settings_map')</code> sehingga hanya dieksekusi 1 kali dan dirender dalam waktu &lt; 200ms.</li>
                                        <li class="mb-1"><strong>Theme &amp; Frontpage Request Memoization:</strong> Mengoptimasi <code>ThemeVersion.php</code> dan <code>Frontpage.php</code> agar tidak melakukan parsing konfigurasi berulang pada setiap ikon sidebar.</li>
                                        <li class="mb-1"><strong>Sidebar Additional Sections Caching:</strong> Penambahan static memoization pada <code>sidebarAdditionalMenuSections()</code> dan unifikasi <code>isFeatureActive()</code> ke <code>app_fitur()</code>.</li>
                                        <li class="mb-1"><strong>Google Fonts Preconnect:</strong> Menambahkan tag <code>&lt;link rel="preconnect"&gt;</code> ke Google Fonts di layout utama untuk mencegah <i>render-blocking latency</i>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.12.1-->

                        <!--begin::Item v1.12.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.12.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.12.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>09 Sep 2026, 10:30 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Zero-Boilerplate Hierarchical Page Title &amp; Breadcrumbs Engine, Skema &amp; Operasional Documentation, and Bilingual Menu Parity</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Engine otomatisasi hierarki <i>Page Title</i> dan <i>Breadcrumbs</i> tanpa <i>boilerplate</i> pada view anak, penataan breadcrumb cerdas yang hanya menampilkan jejak leluhur (<i>ancestor trail</i>) tanpa pengulangan judul halaman aktif, dokumentasi lengkap skema dan operasional di menu Help, penambahan grid selebar 100% (<code>.schema-col-4</code>) untuk checklist QA pengembang, serta sinkronisasi bilingual penuh pada menu dan sidebar.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Zero-Boilerplate Automatic Page Title &amp; Breadcrumbs:</strong> Helper <code>app/Helpers/GetPageTitle.php</code> menyelesaikan resolusi 4 lapis (<code>config/menu_seeder.php</code>, database <code>menus</code>, <code>sidebar.*</code>, dan URL segments) dengan fungsi translasi aman <code>translateMenuTitleSafely()</code>.</li>
                                        <li class="mb-1"><strong>Ancestor Breadcrumb Hierarchy:</strong> Breadcrumbs secara eksklusif hanya menampilkan hierarki leluhur induk (misal: <code>Home &gt; Master Data &gt; App Support</code> untuk halaman <code>Menu</code>), menghindari redundansi judul halaman di ujung breadcrumb.</li>
                                        <li class="mb-1"><strong>Smart Layout Toolbar Fallback:</strong> Penataan <code>resources/views/layouts/_default.blade.php</code> dengan pengecekan <code>@@hasSection('toolbar')</code> otomatis merender toolbar default bila view anak tidak mendeklarasikan toolbar kustom.</li>
                                        <li class="mb-1"><strong>Dokumentasi Skema &amp; Operasional Help:</strong> Penambahan halaman panduan komprehensif di <code>help/pemrograman/skema/page-title-dan-breadcrumbs</code> dan <code>help/pemrograman/operasional/panduan-page-title-dan-breadcrumbs</code> beserta file Markdown di <code>docs/skema-pemrograman/</code>.</li>
                                        <li class="mb-1"><strong>Schema UI Full-Width Grid:</strong> Penambahan class CSS <code>.schema-col-4</code> pada <code>_schema-ui.blade.php</code> untuk merentangkan 3 kolom kartu QA Checklist Pengembang hingga 100% lebar kontainer.</li>
                                        <li class="mb-1"><strong>Selective Localization Boundary:</strong> Sidebar dan Toolbar tetap mengusung dwibahasa penuh (EN &amp; ID) dengan <code>title_key</code> sinkron, sementara isi konten bantuan Help dilindungi dalam bahasa Indonesia murni via <code>data-kt-lang-ignore="true"</code>.</li>
                                        <li class="mb-1"><strong>Realtime Language Engine Sync:</strong> Pembaruan peta kamus <code>help.*</code> pada <code>public/assets/js/custom/language.js</code> dan pembaruan versi cache ke <code>v: 6</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.12.0-->

                        <!--begin::Item v1.11.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.11.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.11.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>09 Sep 2026, 03:30 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Toolbar Gregorian &amp; Hijri Bilingual Date Widget, Responsive Mobile Tooltip &amp; Dual-Language Sync</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Integrasi widget penanggalan ganda Masehi dan Hijriah dwibahasa pada area aksi toolbar, penambahan helper global <code>renderDate()</code>, <code>toHijriah()</code>, dan <code>renderGreeting()</code>, tampilan responsif mobile dengan tooltip Bootstrap/Metronic interaktif, serta sinkronisasi dinamis pada modul <code>language.js</code>.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Toolbar Date Widget:</strong> Menampilkan tanggal Masehi dan Hijriah lengkap pada <code>resources/views/layouts/partials/_toolbar.blade.php</code>.</li>
                                        <li class="mb-1"><strong>Global Date Helpers:</strong> Fungsi helper penanggalan dan salam di <code>app/Helpers/helpers.php</code> yang dimuat otomatis via <code>composer.json</code>.</li>
                                        <li class="mb-1"><strong>Bilingual Dictionaries:</strong> Penambahan kamus nama bulan, imbuhan (M/AD, H/AH), dan sapaan di <code>lang/id/translation.php</code> dan <code>lang/en/translation.php</code>.</li>
                                        <li class="mb-1"><strong>Responsive Mobile Display:</strong> Mode ringkas ikon pada layar <code>&lt; 768px</code> dengan tooltip interaktif saat di-hover/tap.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.11.0-->

                        <!--begin::Item v1.10.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.10.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.10.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>08 Sep 2026, 17:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">App Feature Visibility &amp; Settings Module, Theme v2 Topbar/Menu Feature Integration, and Dynamic Page Title Database Lookup</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Modul manajemen visibilitas fitur (<code>appsupport/app-fiturs</code>) berbasis database dan cache dengan helper <code>app_fitur()</code>, integrasi kendali fitur pada Theme v2 (Demo 2), proteksi hak akses menu sidebar template untuk role master/admin, serta resolusi judul halaman dinamis dari tabel database.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Database Feature Toggle Management:</strong> Model <code>AppFitur</code> &amp; <code>AppSetting</code> dengan kontrol granular untuk Topbar Tools, Topbar Menus, dan Sidebar Menus.</li>
                                        <li class="mb-1"><strong>Theme v2 Feature Integration:</strong> Sinkronisasi pengecekan fitur pada <code>__topbar-v2.blade.php</code> dan <code>__menu-v2.blade.php</code>.</li>
                                        <li class="mb-1"><strong>Template Sidebar Role Restriction:</strong> Pembatasan menu template khusus role <code>master</code> dan <code>admin</code> tanpa terhalang permission database.</li>
                                        <li class="mb-1"><strong>Dynamic Bilingual Page Title:</strong> Resolusi otomatis kunci terjemahan <code>title_key</code> untuk menu yang bersumber dari tabel database.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.10.0-->

                        <!--begin::Item v1.9.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.9.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.9.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>08 Sep 2026, 08:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Frontpage Landing v1 Bilingual Localization, Realtime Instant Head &amp; Meta Engine &amp; Zero-Delay O(1) Performance</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi fitur bilingual penuh pada Frontpage Landing v1, engine translasi instan untuk <code>&lt;title&gt;</code> dan seluruh tag <code>&lt;meta&gt;</code> di <i>head</i> halaman (Landing &amp; Dashboard), perbaikan layout dropdown Help menu topbar, serta optimasi performa <i>instant $O(1)$ lookup</i> tanpa jeda.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Frontpage Landing v1 Bilingual Localization:</strong> Translasi menyeluruh dwiarah English &harr; Indonesian di <code>resources/views/frontpages/landing/v1/landing.blade.php</code> dengan kamus <code>lang/en/landing.php</code> dan <code>lang/id/landing.php</code> serta dropdown pemilih bahasa di header toolbar.</li>
                                        <li class="mb-1"><strong>Realtime Instant Head &amp; Meta Engine:</strong> Penambahan fungsi <code>applyHeadTranslations()</code> di <code>language.js</code> yang secara langsung memperbarui <code>&lt;title&gt;</code>, <code>document.title</code>, <code>&lt;meta name="description"&gt;</code>, <code>&lt;meta name="keywords"&gt;</code>, <code>&lt;meta property="og:title"&gt;</code>, dan <code>&lt;meta property="og:locale"&gt;</code> tanpa reload halaman.</li>
                                        <li class="mb-1"><strong>Smart Dashboard Compound Titles:</strong> Parsing cerdas untuk judul tab browser majemuk di dashboard (misal: <code>Dashboards - Metronic 832</code> &harr; <code>Dasbor - Metronic 832</code>) pada layout utama, layout v2, dan layout dokumentasi.</li>
                                        <li class="mb-1"><strong>High-Performance O(1) Zero-Delay Optimization:</strong> Penghapusan loop linier pencarian kata pada <code>translateText()</code>, beralih 100% ke hash map instan sehingga translasi seluruh DOM dan metadata selesai dalam <code>&lt; 2ms</code> (tanpa jeda).</li>
                                        <li class="mb-1"><strong>Topbar Help Menu &amp; Theme v2 Seeder Menu:</strong> Perbaikan ukuran full-screen dropdown Help menu di topbar navbar dan penataan urutan menu hasil seeder sebelum dasbor pada layout v2 dengan pola tampilan Apps.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.9.0-->
                        <!--begin::Item v1.8.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.8.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold">v1.8.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>07 Sep 2026, 15:25 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Tree-Aware Drag &amp; Drop Menu Reordering Engine &amp; Live Real-Time Sidebar Synchronization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Peningkatan fungsionalitas manajemen menu (<code>appsupport/menu</code>) dengan sistem pengurutan menu interaktif berbasis <i>Drag &amp; Drop</i> berhirarki cerdas serta pembaruan tampilan navigasi sidebar secara sinkron dan <i>real-time</i> tanpa memerlukan <i>reload</i> halaman.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Tree-Aware Hierarchical Drag &amp; Drop:</strong> Ketika Menu Utama (Level 1) digeser, seluruh sub menu dan anak-cucunya otomatis ikut berpindah sebagai satu blok utuh. Sedangkan untuk Sub Menu (Level 2 &amp; 3) pergeseran dibatasi secara ketat hanya pada lingkup saudara di bawah induk yang sama.</li>
                                        <li class="mb-1"><strong>Real-Time Live Sidebar DOM Sync:</strong> Respon AJAX langsung merender ulang potongan HTML sidebar database menu (<code>_menu-section-additional.blade.php</code>) dan memperbarui sidebar DOM secara instan.</li>
                                        <li class="mb-1"><strong>Re-initialization KTMenu &amp; Language Engine:</strong> Otomatis memperbarui instance <code>KTMenu</code> dan <code>KTComponents</code> serta menerjemahkan kembali label sidebar dengan <code>KTLanguage.translateDOM()</code>.</li>
                                        <li class="mb-1"><strong>Batch Order Update Endpoint:</strong> Penambahan endpoint khusus <code>POST /appsupport/menu/reorder</code> pada controller untuk persistensi urutan ke database secara transaksional.</li>
                                        <li class="mb-1"><strong>Elegance Metronic Feedback:</strong> Tombol drag handle <code>ki-abstract-14</code> dengan cursor grab/grabbing, garis indikator drop biru, highlight animasi flash hijau pada baris dan sidebar, serta notifikasi toast mengambang.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.8.1-->

                        <!--begin::Item v1.8.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.8.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.8.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>07 Sep 2026, 13:15 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Interactive Seeder Blueprint Builder for Menu Management &amp; Realtime Code Generator</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan menyeluruh pada modul manajemen menu (<code>appsupport/menu</code>) dengan menghadirkan antarmuka perancangan menu visual elegan yang menganut 100% pola blueprint seeder (<code>config/menu_seeder/</code>). Dilengkapi real-time auto-translation, auto key &amp; route generator, live Keenicons preview &amp; quick picker, permission presets, role pills, serta generator array PHP seeder instan siap salin.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Real-time Smart Auto-Generator:</strong> Pengetikan nama menu bahasa Indonesia secara otomatis mengonversi title bahasa Inggris, menghasilkan kunci terjemahan standar (<code>title_key</code> seperti <code>md_*</code>, <code>app_*</code>), dan menyusun route name/URL yang presisi.</li>
                                        <li class="mb-1"><strong>Live Keenicons Picker &amp; Quick Palette:</strong> Visualisasi live preview kotak ikon Keenicons dengan deteksi jumlah <code>paths</code> otomatis dan tombol shortcut 1-klik untuk ikon populer.</li>
                                        <li class="mb-1"><strong>CRUD Permission Presets &amp; Role Pills:</strong> Tombol preset cepat (⚡ Full CRUD, 👁️ Read Only, ✏️ Manage) dan checklist role berbasis badge pills interaktif.</li>
                                        <li class="mb-1"><strong>Visual Multi-Level Hierarchy Builder:</strong> Mode perancangan hirarki komplit (Level 1 Root, Level 2 Submenu, Level 3 Grandchild) dengan auto-inheritance prefix URL parent.</li>
                                        <li class="mb-1"><strong>Real-time PHP Seeder Blueprint Generator:</strong> Tab preview kode array PHP seeder terformat rapi yang dapat disalin ke clipboard dengan satu klik untuk dijadikan blueprint seeder permanen.</li>
                                        <li class="mb-1"><strong>Otomatis Sinkronisasi Translation &amp; Spatie Permission:</strong> Integrasi backend controller untuk otomatis memperbarui file <code>lang/id/menu.php</code>, <code>lang/en/menu.php</code>, serta sinkronisasi permission role Spatie.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.8.0-->

                        <!--begin::Item v1.7.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.7.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold">v1.7.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>06 Sep 2026, 21:35 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Hardcoded Bahasa Indonesia Documentation &amp; Dynamic Localization Ignore Engine</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Standarisasi seluruh dokumentasi internal Skema Pemrograman dan Operasional menjadi Bahasa Indonesia murni tanpa dependensi kamus terjemahan, penghapusan file kamus help yang tidak terpakai, penambahan fitur pengecualian translasi DOM (<code>data-kt-lang-ignore</code>) pada engine <code>KTLanguage</code>, serta sinkronisasi penuh dokumentasi Markdown dan README.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Help Documentation Hardcoded Bahasa Indonesia:</strong> Seluruh halaman dokumentasi di <code>resources/views/pages/help/pemrograman</code> (Overview, 16 Skema, 8 Operasional, Console Developer, dan Changelog) murni menggunakan Bahasa Indonesia langsung dengan struktur visual dan styling yang tetap utuh.</li>
                                        <li class="mb-1"><strong>Pembersihan Kamus Translasi Redundan:</strong> Menghapus file kamus terjemahan <code>lang/en/help.php</code>, <code>lang/id/help.php</code>, dan script audit <code>scripts/help_i18n_audit.php</code> untuk efisiensi kompilasi dictionary.</li>
                                        <li class="mb-1"><strong>DOM Translation Exemption Engine (KTLanguage):</strong> Memperbarui fungsi <code>shouldSkipElement()</code> di <code>public/assets/js/custom/language.js</code> untuk otomatis melewati elemen dengan <code>data-kt-lang-ignore="true"</code>, <code>.schema-shell</code>, <code>.schema-hero</code>, dan <code>.schema-card</code> agar tidak tertranslasi saat bahasa English aktif.</li>
                                        <li class="mb-1"><strong>Invalidation Cache Client:</strong> Otomatis mereset dan memperbarui versi cache translasi <code>localStorage</code> (<code>kt_translations_cache</code> v3).</li>
                                        <li class="mb-1"><strong>Sinkronisasi Dokumentasi Markdown &amp; README:</strong> Menambahkan dokumen Markdown lengkap untuk Skema Frontpage, Icon, Theme Multi-Version, dan memperbarui seluruh tabel indeks serta URL repositori GitHub.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.7.1-->

                        <!--begin::Item v1.7.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.7.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.7.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>06 Sep 2026, 21:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Realtime Zero-Reload Bilingual Localization (English &harr; Indonesian) & Mobile Toolbar Hub Integration</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh sistem alih bahasa instan tanpa reload halaman (live switching) mengadopsi arsitektur yang sejalan dengan <code>KTThemeMode</code> dan <code>KTIconStyle</code>. Didukung oleh in-memory client payload dictionary, non-destructive DOM TreeWalker engine, persistensi multi-layer (localStorage, cookie, dan Laravel session background sync), serta konsolidasi kontrol pada Mobile Toolbar Hub.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Zero-Latency Language Engine (KTLanguage):</strong> Engine lokalisasi frontend di <code>public/assets/js/custom/language.js</code> dengan TreeWalker DOM traversal yang menerjemahkan teks seluruh tampilan secara dinamis (&lt; 5ms) tanpa merusak elemen anak (ikon, bullet, badge, SVG, atau event listener).</li>
                                        <li class="mb-1"><strong>Dual-Layer Translation Mechanism:</strong> Dukungan penuh penerjemahan via atribut (<code>data-kt-translate</code>, <code>data-kt-translate-placeholder</code>, <code>data-kt-translate-title</code>, <code>data-kt-lang-en/id</code>) serta automatic text phrase matching dua arah (EN &harr; ID) dengan pelestarian format huruf besar/kecil.</li>
                                        <li class="mb-1"><strong>In-Memory Precompiled Dictionary (LanguageManager):</strong> Kompilasi 2.171+ kunci terjemahan per bahasa dan 1.887 pasangan frasa dua arah yang diinjeksi langsung pada inisialisasi Blade (<code>_init.blade.php</code>) untuk performa 100% offline-ready tanpa delay fetch AJAX.</li>
                                        <li class="mb-1"><strong>Multi-Layer State Persistence & Backend Sync:</strong> Penyimpanan pilihan bahasa ke <code>localStorage</code> dan cookie <code>kt_lang</code> dengan async background sync ke endpoint <code>/lang/{locale}</code> untuk sinkronisasi session Laravel secara transparan.</li>
                                        <li class="mb-1"><strong>Standardized Modular Dropdown Component:</strong> Komponen dropdown bahasa modular (<code>partials.lang._main</code>) dengan styling standar Metronic (<code>w-175px</code>), checkmark aktif, dan indikator bendera (US &amp; ID).</li>
                                        <li class="mb-1"><strong>Mobile Toolbar Hub Integration:</strong> Konsolidasi pemilihan bahasa ke dalam Mobile Toolbar Hub (<code>_mobile-toolbar-menu.blade.php</code>) dan penyembunyian tombol bendera redundan di header mobile pada breakpoint <code>d-none d-lg-flex</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.7.0-->

                        <!--begin::Item v1.6.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.6.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.6.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 23:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">App Support Menu Management, Multi-Level Hierarchy Builder & Modular Route Architecture</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh modul manajemen menu aplikasi (<code>appsupport/menu</code>) dengan dukungan pembuatan menu satuan, sub-menu dari induk yang sudah ada, serta Form Builder Menu Komplit bertingkat (Level 1 &rarr; Level 2 &rarr; Level 3) sekaligus dalam satu transaksi. Dilengkapi sinkronisasi multi-bahasa, perizinan CRUD, dan perbaikan toolbar title/breadcrumb tanpa regresi.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Menu Management Module:</strong> Pembuatan CRUD Menu lengkap di <code>MenuController</code>, <code>MenuRequest</code>, dan <code>Menu</code> model untuk modul <code>appsupport/menu</code>.</li>
                                        <li class="mb-1"><strong>Multi-Level Complete Builder:</strong> Penyediaan form interaktif untuk membangun Menu Utama baru (Level 1) beserta seluruh Sub Menu (Level 2) dan Anak Sub Menu (Level 3) sekaligus.</li>
                                        <li class="mb-1"><strong>Quick Sub-Menu Creator:</strong> Tombol aksi <code>+</code> pada baris tabel untuk menambahkan sub-menu baru di bawah menu utama yang sudah ada secara instan.</li>
                                        <li class="mb-1"><strong>Multi-Lingual & Metadata Synchronization:</strong> Sinkronisasi otomatis field <code>title_key</code> dan <code>title_en</code> ke dalam file bahasa <code>lang/id/menu.php</code> dan <code>lang/en/menu.php</code> serta kolom <code>meta</code> JSON.</li>
                                        <li class="mb-1"><strong>Permissions & Roles Integration:</strong> Visualisasi badge CRUD terstandarisasi (Create, Read, Update, Delete, Sort) dan penugasan akses Spatie roles (admin, master, dll.).</li>
                                        <li class="mb-1"><strong>Modular Route Architecture:</strong> Pendaftaran route modul ke dalam <code>routes/masterdata.php</code> dan pengabaian file partials/underscore pada dynamic router <code>routes/menu.php</code>.</li>
                                        <li class="mb-1"><strong>Anti-Regression & Breadcrumb Fixes:</strong> Resolusi title page dan breadcrumb hierarchy tanpa pengulangan judul, serta pembuatan aturan agent <code>code-integrity-and-regression-prevention.md</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.6.0-->

                        <!--begin::Item v1.5.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.5.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.5.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 20:45 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Custom Metronic Error Pages (404/403/500), Unimplemented MVC Safe Fallback & Profil View Modularization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi template penanganan error global bergaya Metronic (404 Not Found, 403 Forbidden, 500 Server Error), penanganan proteksi dynamic routing terhadap modul MVC/View yang belum dibuat atau masih kosong, serta modularisasi halaman profil pengguna ke dalam komponen tab terpisah.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Custom Global Error Pages:</strong> Pembuatan template error terstandarisasi di <code>resources/views/errors/404.blade.php</code>, <code>403.blade.php</code>, dan <code>500.blade.php</code> dengan layout Metronic dan penanganan aman untuk variabel <code>$exception</code>.</li>
                                        <li class="mb-1"><strong>Unimplemented MVC Safe Fallback:</strong> Peningkatan dynamic routing di <code>routes/menu.php</code> agar otomatis melewati file Blade kosong (0-byte) dan langsung menampilkan halaman error 404 ketika menu/route diakses sebelum MVC/View-nya dibuat.</li>
                                        <li class="mb-1"><strong>Profil Pengguna Modularization:</strong> Pemisahan struktur view profil pengguna (<code>profil-pengguna.blade.php</code>) ke dalam sub-komponen modular di folder <code>resources/views/pages/profil/partials/</code> (tabs overview, settings, security, billing, statements, referrals, api-keys, logs).</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.5.1-->

                        <!--begin::Item v1.5.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.5.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.5.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 14:15 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Master Data Views Restructuring, Prefix Route Alignment & Seeder Normalization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penyelarasan struktur view master data ke dalam folder <code>pages/datamaster/</code>, standarisasi prefix route menu seeder <code>datamaster.*</code>, serta pembersihan dan penataan ulang konfigurasi seeder dan translasi menu.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Reorganisasi View Data Master:</strong> Memindahkan seluruh template view data master ke dalam folder <code>resources/views/pages/datamaster/</code> (termasuk modul <code>appsupport</code>, <code>manajemenpengguna</code>, dan <code>profil-pengguna</code>).</li>
                                        <li class="mb-1"><strong>Prefix Route Alignment:</strong> Penyelarasan penamaan route pada file seeder (<code>identitaspengguna_seeder.php</code>, <code>masterdata-appsupport_seeder.php</code>, <code>masterdata-manajemenpengguna_seeder.php</code>) menggunakan format konsisten <code>datamaster.*</code>.</li>
                                        <li class="mb-1"><strong>Automatic Route Mapping:</strong> Integrasi otomatis 13 endpoint submodule data master melalui dynamic route generator di <code>routes/menu.php</code>.</li>
                                        <li class="mb-1"><strong>Localization & Seeder Sync:</strong> Penyesuaian key translasi menu dan sinkronisasi struktur menu seeder.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.5.0-->

                        <!--begin::Item v1.4.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.4.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.4.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 10:35 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Admin MVC Architecture Convention, Dedicated Changelog Route & Menu Seeder Optimization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Standardisasi aturan arsitektur MVC Admin untuk menu seeder, penambahan integrasi route admin modular, pemisahan riwayat rilis ke halaman terdedikasi serta optimasi seeder dan translasi menu bilingual.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Admin MVC Architecture Rule:</strong> Penetapan konvensi penamaan folder, namespace, dan file untuk Model, View, Request, dan Controller bagi menu seeder di <code>.agents/rules/seeder-menu-implementation.md</code>.</li>
                                        <li class="mb-1"><strong>Modular Admin Routing (<code>routes/admin.php</code>):</strong> Integrasi file route khusus <code>admin.php</code> pada <code>routes/web.php</code> untuk memisahkan logika route admin secara terstruktur.</li>
                                        <li class="mb-1"><strong>Dedicated Changelog & Console Pages:</strong> Pemisahan riwayat rilis ke halaman terdedikasi <code>help/pemrograman/changelog</code> dan konsol developer ke <code>help/pemrograman/console-developer</code>.</li>
                                        <li class="mb-1"><strong>Menu Seeder & Localization Refinements:</strong> Penataan ulang seeder kategori master data, website data, sinkronisasi manifest, serta penyempurnaan translasi menu bahasa Indonesia dan Inggris.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.4.0-->

                        <!--begin::Item v1.3.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.3.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.3.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 01:59 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Homepage Menu Separation, Dashboards Active State Isolation & Config Restructure</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pemisahan menu tunggal Home Page dari dropdown menu Dashboards pada sidebar, isolasi deteksi route aktif agar dropdown Dashboards tidak ikut terbuka saat membuka default dashboard, penyesuaian daftar menu dashboard, serta penambahan i18n translasi bilingual untuk homepage.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Homepage Sidebar Menu Separation:</strong> Menu tunggal teratas kini bertindak mandiri sebagai <em>Home Page</em> (<code>menu.homepage</code>) terpisah dari section dropdown Dashboards.</li>
                                        <li class="mb-1"><strong>Dashboards Active State Isolation:</strong> Menghapus pencocokan route <code>dashboard</code> pada accordion menu Dashboards, sehingga dropdown hanya aktif pada pattern <code>dashboards.*</code>.</li>
                                        <li class="mb-1"><strong>Sidebar Config Restructure:</strong> Menata ulang item menu <code>menus_dashboard</code> dan <code>menus_dashboard_collapsed</code> pada <code>config/sidebar/_sidebar_dashboard.php</code>.</li>
                                        <li class="mb-1"><strong>Bilingual Localization & Blade Fix:</strong> Menambahkan translasi <code>menu.homepage</code> pada <code>lang/en/menu.php</code> dan <code>lang/id/menu.php</code>, serta perbaikan sintaks evaluasi title pada <code>dashboard.blade.php</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.3.1-->

                        <!--begin::Item v1.3.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.3.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.3.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 00:58 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Mobile Toolbar Hub Refinement, Responsive Topic Categories & Footer Optimization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penyempurnaan arsitektur dan pengalaman pengguna (UX) pada tampilan mobile/HP, meliputi penataan posisi tengah dropdown quick tools, integrasi panel interaktif penuh (My Apps, Notifikasi, Theme Mode, Gaya Icon, Version), grid responsif topic categories, perbaikan icon duotone initial render, dan optimalisasi layout footer 3 baris di mobile.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Mobile Toolbar Hub Center Alignment:</strong> Posisi dropdown menu quick tools pada layar mobile diposisikan tepat di tengah horizontal layar (<code>left: 50%; transform: translateX(-50%)</code>) dengan batas lebar dan tinggi responsif.</li>
                                        <li class="mb-1"><strong>Interactive Toolbar Sub-Panels:</strong> Dropdown toolbar mobile menyematkan konten fitur desktop lengkap (Full My Apps 16+ icon, Full Tabbed Notifications, Theme Mode Light/Dark/System, Gaya Icon Duotone/Solid/Outline, Theme Version V1/V2, serta Drawer Activities & Chat).</li>
                                        <li class="mb-1"><strong>Toggle & Compact Default State:</strong> Toolbar mobile secara default tampil ringkas hanya berupa baris icon dan baru membuka panel submenu ketika salah satu icon disentuh/diklik (dapat ditutup kembali / <em>toggleable</em>).</li>
                                        <li class="mb-1"><strong>Dark Header Icon Visibility Fix:</strong> Isolasi style warna icon di dalam dropdown mobile agar tidak terpengaruh style putih dark-header pada layout Metronic Version 2.</li>
                                        <li class="mb-1"><strong>Responsive Dynamic Topic Categories:</strong> Grid kategori topik pada widget dashboard kini dinamis dan membungkus ke bawah (<em>auto-wrap</em>) pada layar HP/tablet (12 kolom desktop, 6 kolom laptop, 4 kolom tablet, 3/2 kolom mobile) sehingga kartu tombol tidak pipih.</li>
                                        <li class="mb-1"><strong>Duotone Initial Render Fix:</strong> Melengkapi seluruh 12 icon kategori dengan child element <code>&lt;span class="path..."&gt;</code> agar icon duotone tampil sempurna tanpa jeda atau kedip saat pertama kali dimuat.</li>
                                        <li class="mb-1"><strong>3-Row Responsive Footer:</strong> Tata letak footer pada mobile disusun rapi menjadi 3 baris terpusat (Menu Links, Copyright, Info Versi Laravel/PHP/MySQL) dan tetap 1 baris inline di desktop.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.3.0-->

                        <!--begin::Item v1.2.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.2.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.2.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>02 Sep 2026, 14:34 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Dynamic KeenIcons Style Switcher & Icon Architecture Schema</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penambahan fitur dinamisasi gaya icon KeenIcons (Duotone, Solid, Outline) pada topbar toolbar, engine JavaScript otomatis dengan dukungan MutationObserver, persistensi runtime (localStorage & cookie), serta penambahan modul dokumentasi Skema Pergantian Icon.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Dynamic KeenIcons Switcher:</strong> Tombol toggle dan dropdown menu di topbar/navbar untuk mengganti gaya icon aktif secara dinamis antara <em>Duotone</em> (default), <em>Solid</em>, dan <em>Outline</em> dengan preview representatif <code>ki-chart</code>.</li>
                                        <li class="mb-1"><strong>Live DOM Icon Transformation:</strong> Engine client-side (<code>public/assets/js/custom/icon-style.js</code>) yang secara instan mengonversi seluruh class icon KeenIcons di seluruh halaman aplikasi secara real-time.</li>
                                        <li class="mb-1"><strong>Otomatisasi MutationObserver:</strong> Mendeteksi elemen DOM baru yang dimuat secara asinkron (modal, AJAX content, tab) dan otomatis menyesuaikannya dengan gaya icon aktif.</li>
                                        <li class="mb-1"><strong>Anti-Flicker & Persistensi:</strong> Inisialisasi awal via <code>partials.icon-style._init</code> pada root HTML dan penyimpanan preferensi di <code>localStorage</code> serta Cookie <code>kt_icon_style</code>.</li>
                                        <li class="mb-1"><strong>Integrasi Multi-Layout:</strong> Pemasangan icon style switcher pada Layout Default/v1, Layout v2 (Demo 2), dan Layout Dokumentasi.</li>
                                        <li class="mb-1"><strong>Skema Pergantian Icon:</strong> Modul blueprint arsitektur baru di <code>help/pemrograman/skema/pergantian-icon</code> yang mengulas tuntas standar HTML 3 varian gaya KeenIcons, siklus hidup, API JavaScript <code>KTIconStyle</code>, dan panduan developer.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.2.0-->

                        <!--begin::Item v1.1.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.1.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.1.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>02 Sep 2026, 12:08 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Dynamic Frontpages Switcher, Layout Polish & Core Enhancements</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan arsitektur besar untuk mendukung pemilihan multi-template frontpage dinamis, standardisasi layout autentikasi, penyempurnaan switcher multi-versi, serta konversi dokumentasi ke Bahasa Indonesia murni.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Dynamic Frontpages Switcher:</strong> Menambahkan menu dropdown di topbar/navbar untuk memilih template halaman depan yang aktif secara dinamis (Landing Page Metronic 8 & Education Portal Unify v2.6).</li>
                                        <li class="mb-1"><strong>Persistensi Preferensi:</strong> Dukungan penyimpanan preferensi frontpage melalui Cookie & Session, sehingga pilihan pengguna tersimpan dan persisten saat login/logout.</li>
                                        <li class="mb-1"><strong>Rute Dedicated Preview:</strong> Menambahkan akses langsung rute <code>/landing</code> dan <code>/education</code> untuk kebutuhan preview independen tanpa terpengaruh preferensi aktif default.</li>
                                        <li class="mb-1"><strong>Reorganisasi Folder View:</strong> Merestrukturisasi direktori views menjadi <code>views/frontpages/education/</code> dan <code>views/frontpages/landing/</code> untuk modularitas yang lebih rapi dan bersih.</li>
                                        <li class="mb-1"><strong>Isolasi Layout Autentikasi:</strong> Standardisasi halaman autentikasi (Login, Register, Forgot Password) agar selalu menggunakan layout standalone independen terlepas dari versi tema maupun frontpage aktif.</li>
                                        <li class="mb-1"><strong>Sinkronisasi Dropdown Trigger:</strong> Memperbaiki dan menyinkronkan perilaku interaksi dropdown switch frontpage pada topbar Metronic v2.</li>
                                        <li class="mb-1"><strong>Penambahan Skema & Panduan Operasional:</strong> Menambahkan modul blueprint arsitektur baru untuk <em>Skema Pergantian Versi Tampilan</em>, <em>Skema Pergantian Frontpage</em>, dan <em>Panduan Operasional Pergantian Frontpage</em>.</li>
                                        <li class="mb-1"><strong>Dokumentasi Murni Bahasa Indonesia:</strong> Mengonversi seluruh 24 halaman modul Help Pemrograman ke teks baku Bahasa Indonesia langsung (hardcoded) dengan tetap mempertahankan fleksibilitas bilingual pada menu navigasi sidebar & header.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.1.0-->

                        <!--begin::Item v1.0.0 (Major)-->
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.0.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.0.0</span>
                                    <span class="badge badge-light-danger fw-bold fs-8">Major</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>02 Sep 2026, 10:02 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Base Version</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Initial Release & Laravel 13 Upgrade</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Rilis awal template Veltronic dengan upgrade fondasi framework ke Laravel 13 dan integrasi tema Metronic 8.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Fitur Awal:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Laravel 13 Foundation:</strong> Kompatibilitas penuh dengan Laravel 13, PHP 8.2+, dan manajemen asset modern.</li>
                                        <li class="mb-1"><strong>Dual Version Theme:</strong> Integrasi Metronic v1 & v2 dengan runtime theme version switcher (<code>App\Support\ThemeVersion</code>).</li>
                                        <li class="mb-1"><strong>Multilingual Support (i18n):</strong> Dukungan alih bahasa (English & Bahasa Indonesia) dengan session storage.</li>
                                        <li class="mb-1"><strong>Documentation & Help Center:</strong> Modul panduan arsitektur pemrograman, skema routing, layout, menu, dan checklist QA.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.0.0-->
                    </div>
                    <!--end::Timeline-->
                </div>
            </div>
            <!--end::Version & Tags History Card-->
        </div>
    </div>
@endsection
