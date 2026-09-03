@extends('layouts.index')


@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Help
        @endslot
        @slot('li_2')
            Skema Pemrograman
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2 class="fw-bold">Skema Pemrograman</h2>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <p class="text-gray-700 fs-6 mb-8">
                        Halaman ini adalah pusat dokumentasi internal untuk alur scripting proyek. Anda bisa menambahkan
                        topik baru kapan saja tanpa mengubah struktur utama menu.
                    </p>
                    <div class="row g-5">
                        <div class="col-12 col-xxl-6">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge badge-light-primary">Kategori</span>
                                <h3 class="mb-0 fs-3">Skema</h3>
                            </div>
                            <p class="text-gray-700 fs-7 mb-5">Dokumen arsitektur dan alur teknis inti aplikasi.</p>

                            <div class="row g-5">
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.route') }}"
                                        class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-route fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Route</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Alur dari URL ke file Blade melalui route
                                                    otomatis.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Layout</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Struktur base layout, partial, dan area
                                                    konten per halaman.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Komponen Blade & Partial</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Konvensi include/extend/component dan
                                                    kapan pakai partial vs component.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Theme Assets</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Struktur CSS/JS global, vendor
                                                    page-specific, dan urutan load.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.auth-dan-middleware') }}"
                                        class="card card-flush h-100 bg-light-dark">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-shield-tick fs-2hx text-dark flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema Auth dan Middleware</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Alur login, proteksi route, dan
                                                    middleware custom aplikasi.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Struktur Config Menu</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Relasi config sidebar/header, translasi
                                                    lang, dan renderer Blade.</p>
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
                                                <p class="text-gray-700 fs-7 mb-0">Struktur konfigurasi menu dan cara render
                                                    recursive.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Header Menu</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Alur konfigurasi menu help pada bagian
                                                    header.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Data Layer</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Struktur model, relasi, migration,
                                                    seeder, dan pattern query proyek.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Error Handling & Fallback</h3>
                                                <p class="text-gray-700 fs-7 mb-0">404 fallback, exception handling, dan
                                                    halaman error custom.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Cache & Deployment</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Strategi cache artisan, clear cache, dan
                                                    checklist release.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Pemilihan Bahasa</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Mekanisme switch bahasa dan sumber
                                                    terjemahan menu.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.i18n-lanjutan') }}"
                                        class="card card-flush h-100 bg-light-dark">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-abstract-39 fs-2hx text-dark flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Skema i18n Lanjutan</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Standar key translasi, governance, dan
                                                    proses tambah bahasa baru.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Pergantian Versi Tampilan</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Blueprint multi-versi Metronic (v1 &amp;
                                                    v2), suffix view resolver, asset packaging, dan session switcher
                                                    runtime.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Pergantian Frontpage</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Arsitektur dynamic frontpage loader,
                                                    hirarki session-cookie-config, deklarasi template, dan integrasi root
                                                    view.</p>
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
                                                <h3 class="mb-1 fs-4">Skema Pergantian Icon</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Arsitektur dinamisasi gaya icon
                                                    KeenIcons (Duotone, Solid, Outline), anti-flicker init, DOM
                                                    transformation, dan mutation observer.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xxl-6">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge badge-light-warning">Kategori</span>
                                <h3 class="mb-0 fs-3">Operasional</h3>
                            </div>
                            <p class="text-gray-700 fs-7 mb-5">Panduan implementasi harian, standar tim, dan quality gate.
                            </p>

                            <div class="row g-5">
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-tambah-halaman') }}"
                                        class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-file-added fs-2hx text-primary flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Panduan Tambah Halaman</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Langkah praktis tambah halaman dari file
                                                    Blade sampai publish menu.</p>
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
                                                <h3 class="mb-1 fs-4">Panduan Tambah Menu</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Panduan operasional tambah item
                                                    sidebar/header yang aman.</p>
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
                                                <h3 class="mb-1 fs-4">Panduan Pergantian Versi Metronic</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Playbook tambah versi tema baru tanpa
                                                    hardcode dan tanpa duplikasi berlebih.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-pergantian-frontpage') }}"
                                        class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-screen fs-2hx text-warning flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Panduan Pergantian Frontpage</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Langkah memilih frontpage via topbar,
                                                    konfigurasi <code>DEFAULT_FRONTPAGE</code> di <code>.env</code>, dan
                                                    cara menambah template baru.</p>
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
                                                <h3 class="mb-1 fs-4">Konvensi Penamaan</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Standar nama file, route, dan key
                                                    translasi agar konsisten.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.workflow-developer-harian') }}"
                                        class="card card-flush h-100 bg-light-secondary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-calendar-8 fs-2hx text-dark flex-shrink-0 mt-1"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span><span
                                                    class="path5"></span><span class="path6"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">Workflow Developer Harian</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Panduan ritme kerja developer dari start
                                                    day sampai DoD.</p>
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
                                                <p class="text-gray-700 fs-7 mb-0">Checklist smoke test minimum sebelum
                                                    merge/release.</p>
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
                                                <h3 class="mb-1 fs-4">Playbook Incident Response</h3>
                                                <p class="text-gray-700 fs-7 mb-0">Panduan aksi 0-15 menit per severity dan
                                                    peran saat incident.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
