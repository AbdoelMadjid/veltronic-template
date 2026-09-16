@extends('layouts.index')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <div class="card mb-5 mb-xl-8" data-kt-lang-ignore="true">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2 class="fw-bold">Overview Skema &amp; Dokumentasi Pemrograman</h2>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <p class="text-gray-700 fs-6 mb-8">
                        Halaman ini merupakan pusat dokumentasi internal untuk seluruh alur arsitektur, coding standard, dan developer guide proyek. Anda dapat explore panduan teknis maupun menambahkan topik baru secara terstruktur.
                    </p>
                    <div class="row g-5">
                        <!--begin::Col Skema-->
                        <div class="col-12 col-xxl-6">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge badge-light-primary">Blueprint</span>
                                <h3 class="mb-0 fs-3">Skema &amp; Architecture</h3>
                            </div>
                            <p class="text-gray-700 fs-7 mb-5">Dokumentasi cetak biru arsitektur teknis dan core foundation flow aplikasi.</p>

                            <div class="row g-5">
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.route') }}"
                                        class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-route fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Route (Routing Flow)</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Alur request dari URL path ke file Blade view melalui dynamic auto-routing dan manual route.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.layout') }}"
                                        class="card card-flush h-100 bg-light-danger">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-abstract-46 fs-2hx text-danger flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Layout (Template Structure)</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Struktur master layout dasar, partial template, section content, dan slot rendering per halaman.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.komponen-blade-partial') }}"
                                        class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-element-11 fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Blade Component &amp; Partial</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Konvensi include, component extend, props passing, serta best practice partial vs component.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.theme-assets') }}"
                                        class="card card-flush h-100 bg-light-secondary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-code fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Theme Assets &amp; Bundling</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Struktur global CSS/JS assets, vendor library per halaman, dan script load sequence.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.auth-dan-middleware') }}"
                                        class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-shield-tick fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Auth &amp; Middleware Guard</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Alur autentikasi user, role &amp; permission hierarchy (Spatie), serta route security protection.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.struktur-config-menu') }}"
                                        class="card card-flush h-100 bg-light-success">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-setting-2 fs-2hx text-success flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Config Menu Structure</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Struktur array konfigurasi menu seeder, sinkronisasi translation keys, dan dynamic Blade renderer.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.sidebar-menu') }}"
                                        class="card card-flush h-100 bg-light-success">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-menu fs-2hx text-success flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Sidebar Menu</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Hierarki tree menu navigasi sidebar, accordion group, active state handling, dan recursive rendering.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.header-menu') }}"
                                        class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-abstract-14 fs-2hx text-warning flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Header Menu (Top Navigation)</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Alur konfigurasi navigasi horizontal header bar, mega-menu, dropdown help, dan quick action bar.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.data-layer') }}"
                                        class="card card-flush h-100 bg-light-danger">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-book-open fs-2hx text-danger flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Data Layer &amp; Eloquent</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Struktur model Eloquent, relasi database, migration, database seeder, dan query patterns.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.error-handling-dan-fallback') }}"
                                        class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-information-5 fs-2hx text-warning flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Error Handling &amp; Fallback</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Fallback rute 404/500 inside dashboard layout, custom exception handling, dan panel diagnostics.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.cache-dan-deployment') }}"
                                        class="card card-flush h-100 bg-light-secondary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-cloud-add fs-2hx text-info flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Cache &amp; Deployment Flow</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Strategi Artisan caching (config, route, view), cache clearing, dan production release checklist.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.pemilihan-bahasa') }}"
                                        class="card card-flush h-100 bg-light-info">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-flag fs-2hx text-info flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Language Switcher (i18n)</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Mekanisme dynamic language switch (ID/EN), translation dictionary source, dan session persistence.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.i18n-lanjutan') }}"
                                        class="card card-flush h-100 bg-light-info">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-abstract-39 fs-2hx text-info flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Advanced i18n &amp; Localization</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Standar translation keys, scalable lang files governance, dan pipeline integrasi bahasa baru.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.pergantian-versi-tampilan') }}"
                                        class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-cube-2 fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Theme Version Switcher</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Multi-version theme blueprint (v1 &amp; v2), dynamic view resolver, dan layout suffix engine.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.pergantian-frontpage') }}"
                                        class="card card-flush h-100 bg-light-success">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-screen fs-2hx text-success flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Frontpage Switcher</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Dynamic landing page loader, registrasi template frontpage registry, dan routing switcher.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.pergantian-icon') }}"
                                        class="card card-flush h-100 bg-light-info">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-chart fs-2hx text-info flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Icon Style Switcher</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Arsitektur switch variasi KeenIcons (Duotone, Solid, Outline) dan helper icon path rendering.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.page-title-dan-breadcrumbs') }}"
                                        class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-text-align-left fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Page Title &amp; Breadcrumbs</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Automated dynamic title &amp; breadcrumb generator dari route path tanpa manual boilerplate slot.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--end::Col Skema-->

                        <!--begin::Col Operasional-->
                        <div class="col-12 col-xxl-6">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge badge-light-warning">Guide</span>
                                <h3 class="mb-0 fs-3">Panduan Operasional</h3>
                            </div>
                            <p class="text-gray-700 fs-7 mb-5">SOP implementasi harian, developer standard, best practices, dan quality gate checks.</p>

                            <div class="row g-5">
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-tambah-halaman') }}"
                                        class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-file-added fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Panduan Add New Page (Tambah Halaman)</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Step-by-step membuat view Blade baru, auto-generated route, hingga registrasi ke menu.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-tambah-menu') }}"
                                        class="card card-flush h-100 bg-light-success">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-menu fs-2hx text-success flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Panduan Add New Menu (Tambah Menu)</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Tata cara menambahkan item navigasi baru pada config sidebar dan header seeder secara clean.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-pergantian-versi-metronic') }}"
                                        class="card card-flush h-100 bg-light-danger">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-arrows-circle fs-2hx text-danger flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Panduan Switch Theme Version</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Panduan menambah versi layout baru tanpa duplikasi kode dan tanpa hardcoded markup.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-pergantian-frontpage') }}"
                                        class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-screen fs-2hx text-warning flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Panduan Switch Frontpage Layout</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Langkah memilih frontpage layout aktif serta cara mendaftarkan template landing page baru.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-page-title-dan-breadcrumbs') }}"
                                        class="card card-flush h-100 bg-light-success">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-route fs-2hx text-success flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Panduan Page Title &amp; Breadcrumbs</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Best practice membuat view tanpa boilerplate slot serta tata cara kustomisasi title override.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.konvensi-penamaan') }}"
                                        class="card card-flush h-100 bg-light-info">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-text fs-2hx text-info flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Standard Naming Conventions</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Standar baku penamaan file view, routing URL, controller, model, dan translation keys.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.workflow-developer-harian') }}"
                                        class="card card-flush h-100 bg-light-secondary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-calendar-8 fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span><span
                                                    class="path5"></span><span class="path6"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Daily Developer Workflow</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Ritme kerja harian engineer dari Git branch, coding standard, code review, hingga Definition of Done.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.checklist-qa-smoke-test') }}"
                                        class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-shield-search fs-2hx text-warning flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Checklist QA Smoke Test</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Daftar test case minimum yang wajib lolos sebelum merge pull request atau release deployment.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.playbook-incident-response') }}"
                                        class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-shield-tick fs-2hx text-warning flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Incident Response Playbook</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Action guide darurat 0–15 menit, escalation flow, dan pembagian role saat terjadi outage/incident.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--end::Col Operasional-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
