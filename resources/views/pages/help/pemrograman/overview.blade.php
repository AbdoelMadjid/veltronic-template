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
                                <h1 class="fs-2x fw-bold text-gray-900 mb-1">Overview Skema &amp; Dokumentasi Pemrograman</h1>
                                <p class="text-muted fs-7 mb-0">Pusat dokumentasi internal: cetak biru arsitektur teknis, coding standard, dan developer guide terstandarisasi.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge badge-light-primary fw-bold fs-7 px-3 py-2">
                                <i class="ki-duotone ki-code fs-6 text-primary me-1"><span class="path1"></span><span class="path2"></span></i>
                                21 Skema
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
                            <span class="fs-8 fw-semibold text-gray-600 me-1">Filter Kategori:</span>
                            <button type="button" class="btn btn-sm btn-light-primary active py-1 px-3 fs-8 filter-btn" data-category="all">Semua (34)</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="core">Core &amp; Layout</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="security">Keamanan &amp; RBAC</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="nav">Navigasi &amp; Hotkeys</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="data">Database &amp; Diagnostik</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="theme">Tema &amp; i18n</button>
                            <button type="button" class="btn btn-sm btn-light py-1 px-3 fs-8 filter-btn" data-category="workflow">SOP &amp; Standar UX</button>
                        </div>
                        <div class="w-100 w-md-300px position-relative">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute top-50 translate-middle-y ms-4 text-gray-500"><span class="path1"></span><span class="path2"></span></i>
                            <input type="text" id="overview_search" class="form-control form-control-sm form-control-solid ps-11 fs-7" placeholder="Cari topik atau kata kunci...">
                        </div>
                    </div>
                    <!--end::Search & Filter Controls-->
                </div>
            </div>
            <!--end::Header Card-->

            <div class="row g-6" id="documentation_container" data-kt-lang-ignore="true">
                <!-- ========================================== -->
                <!-- BEGIN::COL SKEMA & ARSITEKTUR -->
                <!-- ========================================== -->
                <div class="col-12 col-xxl-6 doc-main-col" id="col_skema">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-gray-300">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge badge-light-primary fw-bold fs-7">Blueprint Engine</span>
                            <h2 class="mb-0 fs-3 fw-bold text-gray-900">Skema &amp; Architecture</h2>
                        </div>
                        <span class="badge badge-light text-muted fs-8">21 Topik</span>
                    </div>

                    <!-- ========================================== -->
                    <!-- Skema Kategori 1: Core Foundation & Layout -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="core">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-element-11 fs-4 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">1. Core Foundation &amp; Layout Architecture</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="route routing flow dynamic autoroute path">
                                <a href="{{ route('help.pemrograman.skema.route') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-route fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Route (Routing Flow)</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Alur request URL path ke file Blade view melalui dynamic auto-routing dan manual route.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="layout template master partial section slot rendering">
                                <a href="{{ route('help.pemrograman.skema.layout') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-abstract-46 fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Layout (Template Structure)</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur master layout dasar, partial template, section content, dan slot rendering per halaman.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="blade component partial include extend props passing">
                                <a href="{{ route('help.pemrograman.skema.komponen-blade-partial') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-element-11 fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Blade Component &amp; Partial</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Konvensi include, component extend, props passing, serta best practice partial vs component.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="theme assets bundling css js vendor library script sequence">
                                <a href="{{ route('help.pemrograman.skema.theme-assets') }}" class="card card-flush h-100 bg-light-secondary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-code fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Theme Assets &amp; Bundling</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur global CSS/JS assets, vendor library per halaman, dan script load sequence.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="core" data-keywords="page title breadcrumbs dynamic generator auto">
                                <a href="{{ route('help.pemrograman.skema.page-title-dan-breadcrumbs') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-text-align-left fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Page Title &amp; Breadcrumbs</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Automated dynamic title &amp; breadcrumb generator dari route path tanpa manual boilerplate slot.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- Skema Kategori 2: Keamanan & User Management -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="security">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-shield-tick fs-4 text-success"><span class="path1"></span><span class="path2"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">2. Keamanan, RBAC &amp; Profil Pengguna</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="security" data-keywords="auth middleware spatie role permission matrix rbac akses user direct inherited lockscreen reward point">
                                <a href="{{ route('help.pemrograman.skema.auth-dan-middleware') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Auth, Middleware &amp; Spatie RBAC</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Autentikasi, Spatie Role &amp; Permission matrix 2D, izin terwarisi vs langsung, bulk role, serta reward login.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="security" data-keywords="profil pengguna avatar studio zoom pan 2-axis user_settings json 1-user-1-row cover header">
                                <a href="{{ route('help.pemrograman.skema.profil-pengguna-dan-avatar-studio') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-user-square fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Profil Pengguna &amp; Avatar Studio</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur 5-tab profil, kontrol zoom/pan avatar 2-axis, JSON preferensi 1-User-1-Row, dan live topbar sync.</p>
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
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">3. Menu, Navigasi &amp; Pintasan Keyboard</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="config menu struktur seeder array renderer translation">
                                <a href="{{ route('help.pemrograman.skema.struktur-config-menu') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-setting-2 fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Config Menu Structure</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur array konfigurasi menu seeder, sinkronisasi translation keys, dan dynamic Blade renderer.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="sidebar menu hierarchy accordion group active state recursive">
                                <a href="{{ route('help.pemrograman.skema.sidebar-menu') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-menu fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Sidebar Menu</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Hierarki tree menu navigasi sidebar, accordion group, active state handling, dan recursive rendering.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="header menu top navigation mega-menu quick action">
                                <a href="{{ route('help.pemrograman.skema.header-menu') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-abstract-14 fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Header Menu (Top Navigation)</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Alur konfigurasi navigasi horizontal header bar, mega-menu, dropdown help, dan quick action bar.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="keyboard shortcuts hotkeys global action registry ctrl alt key dual-key collision">
                                <a href="{{ route('help.pemrograman.skema.keyboard-shortcuts') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-keyboard fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Keyboard Shortcuts</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Arsitektur global hotkeys (Ctrl+Alt+[Key]), Action Registry frontend modular, dan role-based authorization.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- Skema Kategori 4: Data Layer & Diagnostik -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="data">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-data-download fs-4 text-info"><span class="path1"></span><span class="path2"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">4. Lapisan Data, Backup &amp; Diagnostik</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="data layer eloquent model relation migration seeder query">
                                <a href="{{ route('help.pemrograman.skema.data-layer') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-book-open fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Data Layer &amp; Eloquent</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Struktur model Eloquent, relasi database, migration, database seeder, dan query patterns.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="database backup restore foreign key relation inspector mysqldump chunking acid">
                                <a href="{{ route('help.pemrograman.skema.database-backup-dan-relasi-tabel') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-data-download fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Database Backup &amp; Relasi Tabel</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Dual-engine backup (mysqldump &amp; pure PHP), inspeksi foreign key dinamis, dan jadwal retensi.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="audit log activity users_logs exception catcher backend error tracking level">
                                <a href="{{ route('help.pemrograman.skema.audit-log-dan-error-tracking') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-search fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Audit Log &amp; Error Tracking</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Arsitektur audit trail terpusat (users_logs), penangkapan error backend otomatis, dan isolasi log profil.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="error handling fallback 404 500 exception panel diagnostics">
                                <a href="{{ route('help.pemrograman.skema.error-handling-dan-fallback') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-information-5 fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Error Handling &amp; Fallback</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Fallback rute 404/500 inside dashboard layout, custom exception handling, dan panel diagnostics.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="cache deployment artisan config route view clear release">
                                <a href="{{ route('help.pemrograman.skema.cache-dan-deployment') }}" class="card card-flush h-100 bg-light-secondary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-cloud-add fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Cache &amp; Deployment Flow</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Strategi Artisan caching (config, route, view), cache clearing, dan production release checklist.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- Skema Kategori 5: Tema & Internasionalisasi -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="theme">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-flag fs-4 text-primary"><span class="path1"></span><span class="path2"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">5. Kustomisasi Tema, Frontpages &amp; i18n</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="language switcher i18n dynamic session cookie id en">
                                <a href="{{ route('help.pemrograman.skema.pemilihan-bahasa') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-flag fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Language Switcher (i18n)</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Mekanisme dynamic language switch (ID/EN), translation dictionary source, dan session persistence.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="advanced i18n localization translation keys governance pipeline">
                                <a href="{{ route('help.pemrograman.skema.i18n-lanjutan') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-abstract-39 fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Advanced i18n &amp; Localization</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Standar translation keys, scalable lang files governance, dan pipeline integrasi bahasa baru.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="theme version switcher v1 v2 layout resolver suffix">
                                <a href="{{ route('help.pemrograman.skema.pergantian-versi-tampilan') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-cube-2 fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Theme Version Switcher</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Multi-version theme blueprint (v1 &amp; v2), dynamic view resolver, dan layout suffix engine.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="frontpage switcher landing education template registry">
                                <a href="{{ route('help.pemrograman.skema.pergantian-frontpage') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-screen fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Frontpage Switcher</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Dynamic landing page loader, registrasi template frontpage registry, dan routing switcher.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="icon style keenicons switcher duotone solid outline helper">
                                <a href="{{ route('help.pemrograman.skema.pergantian-icon') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-chart fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Skema Icon Style Switcher</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Arsitektur switch variasi KeenIcons (Duotone, Solid, Outline) dan helper icon path rendering.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ========================================== -->
                <!-- END::COL SKEMA & ARSITEKTUR -->
                <!-- ========================================== -->


                <!-- ========================================== -->
                <!-- BEGIN::COL PANDUAN OPERASIONAL -->
                <!-- ========================================== -->
                <div class="col-12 col-xxl-6 doc-main-col" id="col_operasional">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-gray-300">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge badge-light-warning fw-bold fs-7">SOP &amp; Developer Guides</span>
                            <h2 class="mb-0 fs-3 fw-bold text-gray-900">Panduan Operasional</h2>
                        </div>
                        <span class="badge badge-light text-muted fs-8">13 Topik</span>
                    </div>

                    <!-- ========================================== -->
                    <!-- Operasional Kategori 1: Standar Rekayasa & Quality -->
                    <!-- ========================================== -->
                    <div class="doc-category-group mb-6" data-group="workflow">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ki-duotone ki-calendar-8 fs-4 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">1. Standar Rekayasa &amp; Quality Gates</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="workflow developer harian daily engineering definition of done targeted verification anti regresi">
                                <a href="{{ route('help.pemrograman.operasional.workflow-developer-harian') }}" class="card card-flush h-100 bg-light-secondary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-calendar-8 fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Daily Developer Workflow &amp; SOP</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Ritme kerja harian engineer: sinkronisasi branch, targeted verification, anti-regresi, hingga DoD.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="zero reload realtime crud button loading spinner indicator header banner modular partials">
                                <a href="{{ route('help.pemrograman.operasional.panduan-standar-zero-reload-dan-button-loading') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-loading fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Zero-Reload &amp; Button Loading</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Standar anti-refresh CRUD, spinner data-kt-indicator, banner header modul, dan modular partials.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="naming convention standard penamaan file view route controller model">
                                <a href="{{ route('help.pemrograman.operasional.konvensi-penamaan') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-text fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Standard Naming Conventions</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Standar baku penamaan file view, routing URL, controller, model, dan translation keys.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="qa smoke test checklist test case minimum release pull request">
                                <a href="{{ route('help.pemrograman.operasional.checklist-qa-smoke-test') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-search fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Checklist QA Smoke Test</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Daftar test case minimum yang wajib lolos sebelum merge pull request atau release deployment.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="workflow" data-keywords="incident response playbook action guide outage darurat escalation">
                                <a href="{{ route('help.pemrograman.operasional.playbook-incident-response') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Incident Response Playbook</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Action guide darurat 0–15 menit, escalation flow, dan pembagian role saat terjadi outage/incident.</p>
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
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">2. SOP Penambahan Halaman, Menu &amp; Pintasan</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="tambah halaman add new page blade view auto route registration">
                                <a href="{{ route('help.pemrograman.operasional.panduan-tambah-halaman') }}" class="card card-flush h-100 bg-light-primary hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-file-added fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Add New Page (Tambah Halaman)</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Step-by-step membuat view Blade baru, auto-generated route, hingga registrasi ke menu.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="tambah menu add new menu sidebar header seeder clean">
                                <a href="{{ route('help.pemrograman.operasional.panduan-tambah-menu') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-menu fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Add New Menu (Tambah Menu)</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Tata cara menambahkan item navigasi baru pada config sidebar dan header seeder secara clean.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="page title breadcrumbs override custom helper">
                                <a href="{{ route('help.pemrograman.operasional.panduan-page-title-dan-breadcrumbs') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-route fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Page Title &amp; Breadcrumbs</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Best practice membuat view tanpa boilerplate slot serta tata cara kustomisasi title override.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="nav" data-keywords="keyboard shortcuts admin kelola handler js kustom tabrakan seeder">
                                <a href="{{ route('help.pemrograman.operasional.panduan-keyboard-shortcuts') }}" class="card card-flush h-100 bg-light-info hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-keyboard fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Keyboard Shortcuts</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Tata cara kelola pintasan di admin, registrasi handler JS kustom, dan tips deteksi tabrakan tombol.</p>
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
                            <h4 class="fs-6 fw-bold text-gray-800 mb-0">3. Pemeliharaan Sistem, Log &amp; Tata Letak</h4>
                        </div>
                        <div class="row g-4">
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="switch theme version metronic layout versi baru tanpa duplikasi">
                                <a href="{{ route('help.pemrograman.operasional.panduan-pergantian-versi-metronic') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-arrows-circle fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Switch Theme Version</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Panduan menambah versi layout baru tanpa duplikasi kode dan tanpa hardcoded markup.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="theme" data-keywords="switch frontpage layout template landing page baru">
                                <a href="{{ route('help.pemrograman.operasional.panduan-pergantian-frontpage') }}" class="card card-flush h-100 bg-light-warning hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-screen fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Switch Frontpage Layout</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Langkah memilih frontpage layout aktif serta cara mendaftarkan template landing page baru.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="audit log investigasi error monitoring level payload stack trace">
                                <a href="{{ route('help.pemrograman.operasional.panduan-audit-log-dan-investigasi-error') }}" class="card card-flush h-100 bg-light-danger hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-shield-search fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Audit Log &amp; Investigasi Error</h3>
                                            <p class="text-gray-700 fs-7 mb-0">SOP monitoring log sistem, filtering level (info/warn/error), dan inspeksi payload error teknis.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 doc-card-item" data-category="data" data-keywords="backup restore database sql download pemulihan aman cron auto">
                                <a href="{{ route('help.pemrograman.operasional.panduan-backup-dan-restore-database') }}" class="card card-flush h-100 bg-light-success hover-elevate-up transition-all">
                                    <div class="card-body d-flex align-items-start gap-3 py-4">
                                        <i class="ki-duotone ki-data-download fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                        <div>
                                            <h3 class="mb-1 fs-5 fw-bold text-gray-900">Panduan Backup &amp; Restore Database</h3>
                                            <p class="text-gray-700 fs-7 mb-0">Langkah backup on-demand, restore database aman, download arsip SQL, dan pengujian cron.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ========================================== -->
                <!-- END::COL PANDUAN OPERASIONAL -->
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
