@extends('layouts.index')


@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Help
        @endslot
        @slot('li_2')
            {{ __('help.skema_pemrograman') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2 class="fw-bold">{{ __('help.skema_pemrograman') }}</h2>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <p class="text-gray-700 fs-6 mb-8">
                        {{ __('help.skema_pemrograman_tooltip') }}
                    </p>
                    <div class="row g-5">
                        <div class="col-12 col-xxl-6">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge badge-light-primary">{{ __('help.kategori') }}</span>
                                <h3 class="mb-0 fs-3">{{ __('help.skema') }}</h3>
                            </div>
                            <p class="text-gray-700 fs-7 mb-5">{!! __('help.pages.overview.paragraph_1') !!}</p>

                            <div class="row g-5">
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.route') }}" class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-route fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_route') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_3') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.layout') }}" class="card card-flush h-100 bg-light-danger">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-abstract-46 fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_layout') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_4') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.komponen-blade-partial') }}" class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-element-11 fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_komponen_blade_and_partial') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_5') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.theme-assets') }}" class="card card-flush h-100 bg-light-secondary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-code fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_theme_assets') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_6') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.auth-dan-middleware') }}" class="card card-flush h-100 bg-light-dark">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-shield-tick fs-2hx text-dark flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_auth_dan_middleware') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_7') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.struktur-config-menu') }}" class="card card-flush h-100 bg-light-success">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-setting-2 fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_struktur_config_menu') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_8') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.sidebar-menu') }}" class="card card-flush h-100 bg-light-success">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-menu fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_sidebar_menu') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_9') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.header-menu') }}" class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-abstract-14 fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_header_menu') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_10') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.data-layer') }}" class="card card-flush h-100 bg-light-danger">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-book-open fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_data_layer') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_11') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.error-handling-dan-fallback') }}" class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-information-5 fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_error_handling_and_fallback') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_12') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.cache-dan-deployment') }}" class="card card-flush h-100 bg-light-secondary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-cloud-add fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_cache_and_deployment') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_13') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.pemilihan-bahasa') }}" class="card card-flush h-100 bg-light-info">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-flag fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_pemilihan_bahasa') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_14') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.skema.i18n-lanjutan') }}" class="card card-flush h-100 bg-light-dark">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-abstract-39 fs-2hx text-dark flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.skema_i18n_lanjutan') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_15') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xxl-6">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge badge-light-warning">{{ __('help.kategori') }}</span>
                                <h3 class="mb-0 fs-3">{{ __('help.operasional') }}</h3>
                            </div>
                            <p class="text-gray-700 fs-7 mb-5">{!! __('help.pages.overview.paragraph_2') !!}</p>

                            <div class="row g-5">
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-tambah-halaman') }}" class="card card-flush h-100 bg-light-primary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-file-added fs-2hx text-primary flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.panduan_tambah_halaman') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_16') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-tambah-menu') }}" class="card card-flush h-100 bg-light-success">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-menu fs-2hx text-success flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.panduan_tambah_menu') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_17') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.panduan-pergantian-versi-metronic') }}" class="card card-flush h-100 bg-light-danger">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-arrows-circle fs-2hx text-danger flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.panduan_pergantian_versi_metronic') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_18') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.konvensi-penamaan') }}" class="card card-flush h-100 bg-light-info">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-text fs-2hx text-info flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.konvensi_penamaan') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_19') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.workflow-developer-harian') }}" class="card card-flush h-100 bg-light-secondary">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-calendar-8 fs-2hx text-dark flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.workflow_developer_harian') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_20') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.checklist-qa-smoke-test') }}" class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-shield-search fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.checklist_qa_smoke_test') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_21') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('help.pemrograman.operasional.playbook-incident-response') }}" class="card card-flush h-100 bg-light-warning">
                                        <div class="card-body d-flex align-items-start gap-3 py-4">
                                            <i class="ki-duotone ki-shield-tick fs-2hx text-warning flex-shrink-0 mt-1"><span class="path1"></span><span class="path2"></span></i>
                                            <div>
                                                <h3 class="mb-1 fs-4">{{ __('help.playbook_incident_response') }}</h3>
                                                <p class="text-gray-700 fs-7 mb-0">{!! __('help.pages.overview.paragraph_22') !!}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::Version & Tags History Card-->
            <div class="card mb-5 mb-xl-8 border">
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
                    <div class="card-toolbar">
                        <span class="badge badge-light-success fw-bold fs-7 px-3 py-2">
                            <i class="ki-duotone ki-check-circle fs-6 text-success me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Versi Saat Ini: v1.1.0
                        </span>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <!--begin::Timeline-->
                    <div class="timeline-label">
                        <!--begin::Item v1.1.0-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.1.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge badge-primary fw-bold">v1.1.0</span>
                                    <span class="text-gray-900 fw-bold fs-6">Dynamic Frontpages Switcher & Education Multi-Page Restructure</span>
                                    <span class="badge badge-light-success fs-8">Latest Release</span>
                                </div>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan arsitektur frontpage untuk mendukung berbagai template halaman depan (Landing Page & Education Portal) secara dinamis.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Dynamic Frontpages Switcher:</strong> Menambahkan menu dropdown di topbar/navbar untuk memilih template halaman depan yang aktif (Landing Page Metronic 8 & Education Portal Unify v2.6).</li>
                                        <li class="mb-1"><strong>Persistensi Preferensi:</strong> Dukungan penyimpanan preferensi frontpage melalui Cookie & Session, sehingga pilihan pengguna tidak hilang saat login/logout.</li>
                                        <li class="mb-1"><strong>Reorganisasi Folder Blade:</strong> Merestrukturisasi direktori views menjadi <code>views/frontpages/education/</code> dan <code>views/frontpages/landing/</code> untuk modularitas yang lebih rapi.</li>
                                        <li class="mb-1"><strong>Konfigurasi Fleksibel:</strong> Menambahkan <code>config/frontpage.php</code> dan variabel environment <code>DEFAULT_FRONTPAGE</code> di <code>.env</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.1.0-->

                        <!--begin::Item v1.0.0-->
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.0.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-success fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge badge-success fw-bold">v1.0.0</span>
                                    <span class="text-gray-900 fw-bold fs-6">Initial Release & Laravel 13 Upgrade</span>
                                    <span class="badge badge-light-dark fs-8">Base Version</span>
                                </div>
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
