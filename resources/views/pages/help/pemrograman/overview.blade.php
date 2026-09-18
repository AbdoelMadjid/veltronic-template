@extends('layouts.index')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <!--begin::Header Card-->
            <div class="card card-flush shadow-sm border-0 mb-6 bg-body" data-kt-lang-ignore="true">
                <div class="card-body py-6">
                    <div class="d-flex flex-stack flex-wrap gap-4 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="symbol symbol-50px symbol-2by3 bg-light-primary">
                                <i class="ki-duotone ki-book-open fs-2hx text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            </div>
                            <div>
                                <h1 class="fs-2x fw-bold text-gray-900 mb-1">Ikhtisar Skema &amp; Dokumentasi Pemrograman</h1>
                                <p class="text-muted fs-7 mb-0">Pusat dokumentasi internal: cetak biru arsitektur teknis, standar penulisan kode, dan panduan pengembang terstruktur.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge badge-light-primary fw-bold fs-7 px-3 py-2">
                                <i class="ki-duotone ki-code fs-6 text-primary me-1"><span class="path1"></span><span class="path2"></span></i>
                                21 Topik Skema
                            </span>
                            <span class="badge badge-light-warning fw-bold fs-7 px-3 py-2">
                                <i class="ki-duotone ki-setting-3 fs-6 text-warning me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                13 Panduan Operasional
                            </span>
                        </div>
                    </div>

                    <!--begin::Search & Filter Controls-->
                    <div class="d-flex flex-stack flex-wrap gap-3 pt-3 border-top border-gray-200">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="fs-8 fw-semibold text-gray-600 me-1">Saring Kategori:</span>
                            <button type="button" class="btn btn-sm btn-light-primary active py-1 px-3 fs-8 filter-btn" data-category="all">Semua (34)</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="core">Pondasi &amp; Tata Letak</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="security">Keamanan &amp; Hak Akses</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="nav">Navigasi &amp; Pintasan</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="data">Basis Data &amp; Diagnostik</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="theme">Tema &amp; Bahasa</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="workflow">Standar &amp; SOP Antarmuka</button>
                        </div>
                        <div class="w-100 w-md-300px position-relative">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute top-50 translate-middle-y ms-4 text-gray-500"><span class="path1"></span><span class="path2"></span></i>
                            <input type="text" id="overview_search" class="form-control form-control-sm form-control-solid ps-11 fs-7" placeholder="Cari topik atau kata kunci teknis...">
                        </div>
                    </div>
                    <!--end::Search & Filter Controls-->
                </div>
            </div>
            <!--end::Header Card-->

            <div class="row g-6" id="documentation_container" data-kt-lang-ignore="true">
                <!-- ========================================== -->
                <!-- BEGIN::KOLOM SKEMA & ARSITEKTUR -->
                <!-- ========================================== -->
                <div class="col-12 col-xxl-6 doc-main-col" id="col_skema">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-gray-300">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge badge-light-primary fw-bold fs-7">Cetak Biru Arsitektur</span>
                            <h2 class="mb-0 fs-3 fw-bold text-gray-900">Skema &amp; Arsitektur Sistem</h2>
                        </div>
                        <span class="badge badge-light text-muted fs-8">21 Topik</span>
                    </div>

                    <!-- ========================================== -->
                    <!-- Skema Kategori 1: Pondasi Inti & Tata Letak -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="core">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-element-11 fs-4 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">1. Pondasi Inti &amp; Arsitektur Tata Letak</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="rute alur perutean dinamis jalur otomatis berkas tampilan blade manual routing url">
                                <a href="{{ route('help.pemrograman.skema.route') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-route fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Alur Perutean Sistem</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Alur permintaan jalur URL ke berkas tampilan Blade melalui perutean otomatis dinamis dan rute manual terdaftar.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="tata letak layout struktur master parsial bagian konten slot render kerangka tampilan">
                                <a href="{{ route('help.pemrograman.skema.layout') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-abstract-46 fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Struktur Tata Letak Halaman</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur tata letak utama, komponen bagian modular, area konten, dan perenderan slot pada setiap halaman aplikasi.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="komponen parsial blade include extend props pengiriman data standar bagian tampilan modular">
                                <a href="{{ route('help.pemrograman.skema.komponen-blade-partial') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-element-11 fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Komponen &amp; Bagian Tampilan Modular</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Konvensi pemisahan berkas tampilan modular, pewarisan template, pengiriman parameter data, dan standar penataan.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="aset tema penggabungan berkas gaya css skrip js pustaka vendor urutan pemuatan script">
                                <a href="{{ route('help.pemrograman.skema.theme-assets') }}" class="card card-flush h-100 bg-light-secondary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-code fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Pengelolaan Aset Tema &amp; Berkas Skrip</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur aset gaya tampilan dan skrip logika global, integrasi pustaka pihak ketiga per modul, serta urutan pemuatan.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="judul halaman jejak navigasi breadcrumb generator otomatis jalur rute penunjuk alur">
                                <a href="{{ route('help.pemrograman.skema.page-title-dan-breadcrumbs') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-text-align-left fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Judul Halaman &amp; Jejak Navigasi</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Mekanisme otomatis pembentukan judul dinamis dan jejak rekam navigasi berdasarkan struktur jalur rute aktif.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- Skema Kategori 2: Keamanan & Pengguna -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="security">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-shield-tick fs-4 text-success"><span class="path1"></span><span class="path2"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">2. Keamanan, Hak Akses &amp; Profil Pengguna</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="security" data-keywords="autentikasi lapisan penengah middleware spatie peran izin matriks akses pengguna langsung terwarisi kunci layar reward poin login">
                                <a href="{{ route('help.pemrograman.skema.auth-dan-middleware') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Autentikasi, Lapisan Penengah &amp; Hak Akses Peran</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Autentikasi berlapis, matriks izin peran Spatie, pemisahan hak akses langsung vs terwarisi, penugasan massal, serta poin login.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="security" data-keywords="profil pengguna foto profil studio perbesaran pergeseran 2 sumbu preferensi baris cover sampul tajuk">
                                <a href="{{ route('help.pemrograman.skema.profil-pengguna-dan-avatar-studio') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-user-square fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Profil Pengguna &amp; Pengaturan Foto Diri</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur data profil multi-tab, penyesuaian perbesaran dan posisi foto dua sumbu, penyimpanan preferensi, dan pembaruan seketika.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- Skema Kategori 3: Navigasi & Pintasan -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="nav">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-menu fs-4 text-warning"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">3. Struktur Menu, Navigasi &amp; Pintasan Papan Ketik</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="konfigurasi menu struktur penabur data larik array kunci terjemahan perenderan dinamis">
                                <a href="{{ route('help.pemrograman.skema.struktur-config-menu') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-setting-2 fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Struktur Konfigurasi Menu</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur larik konfigurasi menu data awal, sinkronisasi kunci terjemahan multi-bahasa, dan perenderan navigasi dinamis.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="menu bilah samping navigasi kiri hierarki pohon grup lipat status aktif rekursif">
                                <a href="{{ route('help.pemrograman.skema.sidebar-menu') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-menu fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Menu Bilah Samping Navigasi</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Hierarki berjenjang menu navigasi samping, pengelompokan menu lipat, penentuan status aktif, dan perenderan otomatis.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="menu tajuk navigasi atas bilah atas horizontal menu bantuan aksi cepat tautan">
                                <a href="{{ route('help.pemrograman.skema.header-menu') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-abstract-14 fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Menu Bilah Tajuk Atas</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Konfigurasi menu navigasi mendatar di bagian atas, menu tarik-turun bantuan, dan tombol pintasan aksi cepat.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="pintasan papan ketik kombinasi tombol aksi global registrasi modular otorisasi izin peran">
                                <a href="{{ route('help.pemrograman.skema.keyboard-shortcuts') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-keyboard fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Pintasan Papan Ketik Terpadu</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Arsitektur kombinasi tombol pintasan sistem, pendaftaran aksi modular bebas konflik, dan pembatasan izin peran pengguna.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- Skema Kategori 4: Basis Data & Diagnostik -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="data">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-data-download fs-4 text-info"><span class="path1"></span><span class="path2"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">4. Lapisan Data, Cadangan &amp; Diagnostik Sistem</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="lapisan data pemodelan data relasi basis data migrasi penabur data pola kueri terstruktur">
                                <a href="{{ route('help.pemrograman.skema.data-layer') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-book-open fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Lapisan Data &amp; Pemodelan Basis Data</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur model data, relasi antar tabel basis data, berkas migrasi, data awal terstruktur, dan standar kueri data.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="cadangan pemulihan basis data relasi tabel kunci asing inspeksi integritas jadwal otomatis">
                                <a href="{{ route('help.pemrograman.skema.database-backup-dan-relasi-tabel') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-data-download fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Cadangan Basis Data &amp; Relasi Antar Tabel</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Mekanisme pencadangan ganda mandiri, inspeksi integritas relasi tabel dan kunci asing, serta jadwal pembersihan arsip.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="rekam jejak audit aktivitas pelacakan kesalahan pencatatan riwayat sistem isolasi log">
                                <a href="{{ route('help.pemrograman.skema.audit-log-dan-error-tracking') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-search fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Rekam Jejak Audit &amp; Pelacakan Kesalahan</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Pencatatan riwayat aktivitas pengguna terpusat, penangkapan galat sistem secara otomatis, dan pemisahan catatan profil.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="penanganan kesalahan tampilan alternatif galat rute pengecualian diagnostik">
                                <a href="{{ route('help.pemrograman.skema.error-handling-dan-fallback') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-information-5 fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Penanganan Galat &amp; Tampilan Cadangan</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Penyajian halaman alternatif saat terjadi rute tidak ditemukan atau galat server di dalam tata letak aplikasi yang konsisten.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="memori singgah cache alur penerapan sistem pembersihan optimasi kecepatan rilis">
                                <a href="{{ route('help.pemrograman.skema.cache-dan-deployment') }}" class="card card-flush h-100 bg-light-secondary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-cloud-add fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Memori Singgah &amp; Alur Penerapan Sistem</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Strategi penyimpanan memori singgah untuk konfigurasi, rute, dan tampilan, panduan pembersihan, serta alur rilis produksi.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- Skema Kategori 5: Tema & Bahasa -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="theme">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-flag fs-4 text-primary"><span class="path1"></span><span class="path2"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">5. Penyesuaian Tema, Halaman Depan &amp; Bahasa</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="penggantian bahasa alih bahasa internasionalisasi kamus terjemahan penyimpanan sesi">
                                <a href="{{ route('help.pemrograman.skema.pemilihan-bahasa') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-flag fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Penggantian Bahasa Aplikasi</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Mekanisme perpindahan bahasa antarmuka secara dinamis, pengelolaan kamus terjemahan, dan persistensi sesi pengguna.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="internasionalisasi lanjutan lokalisasi struktur kamus berkas bahasa terstruktur">
                                <a href="{{ route('help.pemrograman.skema.i18n-lanjutan') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-abstract-39 fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Internasionalisasi Lanjutan &amp; Lokalisasi</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Standarisasi penulisan kunci terjemahan, pengelolaan berkas bahasa berskala besar, dan integrasi penambahan bahasa baru.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="penggantian versi tampilan tema versi 1 versi 2 penyesuai rute otomatis tata letak">
                                <a href="{{ route('help.pemrograman.skema.pergantian-versi-tampilan') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-cube-2 fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Penggantian Versi Tampilan Tema</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Cetak biru arsitektur multi-versi tema aplikasi, penentu tampilan otomatis, dan mekanisme sufiks berkas tata letak.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="penggantian halaman depan beranda pendaftaran kerangka landing page pengalihan rute">
                                <a href="{{ route('help.pemrograman.skema.pergantian-frontpage') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-screen fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Penggantian Tata Letak Halaman Depan</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Mekanisme pemuatan halaman depan dinamis, pendaftaran template beranda tambahan, dan penanganan rute awal.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="penggantian gaya ikon ragam ikon duotone solid outline perenderan grafis jalur">
                                <a href="{{ route('help.pemrograman.skema.pergantian-icon') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-chart fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Penggantian Ragam Gaya Ikon</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Arsitektur peralihan variasi gaya ikon visual (Duotone, Solid, Outline) dan helper pembuat elemen grafis otomatis.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ========================================== -->
                <!-- END::KOLOM SKEMA & ARSITEKTUR -->
                <!-- ========================================== -->


                <!-- ========================================== -->
                <!-- BEGIN::KOLOM PANDUAN OPERASIONAL -->
                <!-- ========================================== -->
                <div class="col-12 col-xxl-6 doc-main-col" id="col_operasional">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-gray-300">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge badge-light-warning fw-bold fs-7">SOP &amp; Panduan Pengembang</span>
                            <h2 class="mb-0 fs-3 fw-bold text-gray-900">Panduan Operasional</h2>
                        </div>
                        <span class="badge badge-light text-muted fs-8">13 Topik</span>
                    </div>

                    <!-- ========================================== -->
                    <!-- Operasional Kategori 1: Standar Rekayasa -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="workflow">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-calendar-8 fs-4 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">1. Standar Rekayasa &amp; Jaminan Mutu</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="alur kerja harian pengembang standar operasional prosedur sop kriteria selesai verifikasi terarah anti regresi percabangan kode">
                                <a href="{{ route('help.pemrograman.operasional.workflow-developer-harian') }}" class="card card-flush h-100 bg-light-secondary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-calendar-8 fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Alur Kerja Harian Pengembang &amp; Prosedur Baku</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Ritme kerja harian pengembang: sinkronisasi cabang kode, verifikasi terarah, pencegahan regresi, hingga kriteria selesai tugas.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="standar olah data crud tanpa muat ulang animasi tombol indikator pemrosesan kartu banner tajuk bagian modular">
                                <a href="{{ route('help.pemrograman.operasional.panduan-standar-zero-reload-dan-button-loading') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-loading fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Olah Data Tanpa Muat Ulang &amp; Animasi Tombol</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Standar interaksi formulir tanpa segarkan halaman, indikator pemrosesan tombol interaktif, banner tajuk, dan bagian tampilan modular.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="konvensi penamaan berkas variabel rute pengendali model kunci terjemahan standar baku penulisan">
                                <a href="{{ route('help.pemrograman.operasional.konvensi-penamaan') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-text fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Standar Konvensi Penamaan Berkas &amp; Variabel</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Aturan baku penamaan berkas tampilan, penetapan jalur rute, pengendali logika, model data, dan kunci kamus terjemahan.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="daftar periksa uji coba cepat jaminan mutu pengujian minimum pra rilis verifikasi fitur">
                                <a href="{{ route('help.pemrograman.operasional.checklist-qa-smoke-test') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-search fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Daftar Periksa Uji Cepat Jaminan Mutu Sistem</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Daftar skenario pengujian minimum yang wajib dipenuhi sebelum penggabungan kode atau rilis pembaruan ke server produksi.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="buku panduan tanggap darurat penanganan insiden gangguan sistem eskalasi peran tindakan cepat">
                                <a href="{{ route('help.pemrograman.operasional.playbook-incident-response') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Buku Panduan Penanganan Insiden &amp; Gangguan Sistem</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Prosedur tindakan cepat 15 menit pertama, alur eskalasi penanganan, dan pembagian tanggung jawab saat terjadi gangguan sistem.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- Operasional Kategori 2: Penambahan Fitur & Menu -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="nav">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-file-added fs-4 text-success"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">2. Prosedur Penambahan Halaman, Menu &amp; Pintasan</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="penambahan halaman baru berkas tampilan blade rute otomatis pendaftaran navigasi menu langkah pembuatan">
                                <a href="{{ route('help.pemrograman.operasional.panduan-tambah-halaman') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-file-added fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Penambahan Halaman Baru</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Langkah terstruktur membuat berkas tampilan baru, pengaturan perutean otomatis, hingga pendaftaran ke navigasi menu sistem.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="penambahan item navigasi menu baru bilah samping navigasi seeder data awal struktur rapi">
                                <a href="{{ route('help.pemrograman.operasional.panduan-tambah-menu') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-menu fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Penambahan Item Menu Baru</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Tata cara menambahkan entri navigasi baru pada konfigurasi menu bilah samping dan data awal sistem secara terstruktur.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="judul halaman jejak navigasi penyesuaian manual penimpaan pembantu tata letak alur">
                                <a href="{{ route('help.pemrograman.operasional.panduan-page-title-dan-breadcrumbs') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-route fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Judul Halaman &amp; Jejak Navigasi</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Praktik terbaik menyusun tampilan tanpa penulisan kode berulang serta teknik penyesuaian judul manual bila diperlukan.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="pengelolaan pintasan papan ketik tombol cepat panel admin fungsi kustom deteksi tabrakan tombol">
                                <a href="{{ route('help.pemrograman.operasional.panduan-keyboard-shortcuts') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-keyboard fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Pengelolaan Pintasan Papan Ketik</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Prosedur pengelolaan tombol pintasan melalui panel administrasi, pendaftaran aksi skrip kustom, dan pencegahan konflik tombol.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- Operasional Kategori 3: Pemeliharaan & Layout -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="data">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-setting-3 fs-4 text-danger"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">3. Pemeliharaan Sistem, Rekam Jejak &amp; Tata Letak</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="penggantian versi tata letak tema versi baru perutean dinamis tanpa duplikasi">
                                <a href="{{ route('help.pemrograman.operasional.panduan-pergantian-versi-metronic') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-arrows-circle fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Penggantian Versi Tata Letak Tema</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Panduan menambahkan varian versi tata letak baru dan beralih antarmuka secara dinamis tanpa duplikasi berkas rute.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="penggantian tata letak halaman depan beranda aktivasi template pendaftaran beranda baru">
                                <a href="{{ route('help.pemrograman.operasional.panduan-pergantian-frontpage') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-screen fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Penggantian Tata Letak Halaman Depan</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Langkah pemilihan desain halaman beranda aktif serta tata cara mendaftarkan rancangan halaman depan baru ke sistem.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="pengelolaan rekam jejak audit investigasi galat kesalahan pemantauan sistem tingkat keparahan inspeksi jejak tumpukan">
                                <a href="{{ route('help.pemrograman.operasional.panduan-audit-log-dan-investigasi-error') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-search fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Pengelolaan Rekam Jejak Audit &amp; Investigasi Galat</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Prosedur pemantauan aktivitas sistem, penyaringan tingkat urgensi catatan, dan investigasi teknis jejak galat sistem.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="cadangan pemulihan basis data mandiri aman unduh arsip berkas sql uji coba jadwal otomatis">
                                <a href="{{ route('help.pemrograman.operasional.panduan-backup-dan-restore-database') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-data-download fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Cadangan &amp; Pemulihan Basis Data</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Tata cara pembuatan salinan data mandiri, pemulihan data yang aman, pengunduhan berkas SQL, dan pengujian jadwal otomatis.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ========================================== -->
                <!-- END::KOLOM PANDUAN OPERASIONAL -->
                <!-- ========================================== -->
            </div>

            <!--begin::Empty Search State-->
            <div id="no_results" class="card card-flush bg-body border-0 shadow-sm py-12 text-center d-none">
                <i class="ki-duotone ki-search-list fs-3x text-muted mb-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <h4 class="fw-bold text-gray-800 mb-1">Topik Tidak Ditemukan</h4>
                <p class="text-muted fs-7 mb-0">Tidak ada skema atau panduan operasional yang cocok dengan kata kunci pencarian Anda.</p>
            </div>
            <!--end::Empty Search State-->
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('overview_search');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const cardItems = document.querySelectorAll('.doc-card-item');
    const categoryGroups = document.querySelectorAll('.doc-category-group');
    const noResults = document.getElementById('no_results');
    const mainCols = document.querySelectorAll('.doc-main-col');

    let activeCategory = 'all';
    let searchQuery = '';

    function applyFilters() {
        let totalVisible = 0;

        cardItems.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            const keywords = (card.getAttribute('data-keywords') || '') + ' ' + card.innerText.toLowerCase();
            
            const matchCategory = (activeCategory === 'all' || cardCategory === activeCategory);
            const matchSearch = (searchQuery === '' || keywords.includes(searchQuery));

            if (matchCategory && matchSearch) {
                card.classList.remove('d-none');
                totalVisible++;
            } else {
                card.classList.add('d-none');
            }
        });

        // Toggle visibility of category headers based on child item visibility
        categoryGroups.forEach(group => {
            const visibleChildren = group.querySelectorAll('.doc-card-item:not(.d-none)');
            if (visibleChildren.length > 0) {
                group.classList.remove('d-none');
            } else {
                group.classList.add('d-none');
            }
        });

        // Toggle empty state
        if (totalVisible === 0) {
            noResults.classList.remove('d-none');
            mainCols.forEach(col => col.classList.add('d-none'));
        } else {
            noResults.classList.add('d-none');
            mainCols.forEach(col => col.classList.remove('d-none'));
        }
    }

    // Filter Button Click Listener
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            filterButtons.forEach(b => {
                b.classList.remove('active', 'btn-light-primary');
                b.classList.add('btn-light');
            });
            this.classList.add('active', 'btn-light-primary');
            this.classList.remove('btn-light');

            activeCategory = this.getAttribute('data-category');
            applyFilters();
        });
    });

    // Search Input Listener
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            searchQuery = this.value.trim().toLowerCase();
            applyFilters();
        });
    }
});
</script>
@endsection
