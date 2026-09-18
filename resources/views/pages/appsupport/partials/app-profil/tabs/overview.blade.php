<div class="row g-6">
    <!--begin::Stats Summary Cards-->
    <div class="col-md-6 col-xl-3">
        <div class="card card-flush shadow-sm border-0 h-100">
            <div class="card-body p-6 d-flex align-items-center">
                <div class="symbol symbol-50px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-shield-tick text-primary fs-2"></i>
                </div>
                <div>
                    <div class="fs-2hx fw-bold text-gray-900">{{ $stats['completeness_score'] }}%</div>
                    <div class="text-muted fs-7 fw-semibold">Kelengkapan Profil</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-flush shadow-sm border-0 h-100">
            <div class="card-body p-6 d-flex align-items-center">
                <div class="symbol symbol-50px symbol-circle bg-light-info me-4 d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-code text-info fs-2"></i>
                </div>
                <div>
                    <div class="fs-2hx fw-bold text-gray-900">{{ $stats['filled_fields'] }} / {{ $stats['total_fields'] }}</div>
                    <div class="text-muted fs-7 fw-semibold">Parameter Terisi</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-flush shadow-sm border-0 h-100">
            <div class="card-body p-6 d-flex align-items-center">
                <div class="symbol symbol-50px symbol-circle bg-light-warning me-4 d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-picture text-warning fs-2"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-gray-900">{{ $stats['has_custom_logo'] ? 'Aset Kustom' : 'Default Tema' }}</div>
                    <div class="text-muted fs-7 fw-semibold">Status Aset Logo</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-flush shadow-sm border-0 h-100">
            <div class="card-body p-6 d-flex align-items-center">
                <div class="symbol symbol-50px symbol-circle bg-light-success me-4 d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-abstract-26 text-success fs-2"></i>
                </div>
                <div>
                    <div class="fs-2hx fw-bold text-gray-900">{{ $stats['footer_links_count'] }}</div>
                    <div class="text-muted fs-7 fw-semibold">Tautan Menu Footer</div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stats Summary Cards-->

    <!--begin::Detail Tables & System Info-->
    <div class="col-xl-6">
        <div class="card card-flush shadow-sm border-0 h-100">
            <div class="card-header border-0 pt-6">
                <div class="card-title d-flex align-items-center">
                    <i class="ki-outline ki-information-5 text-primary fs-3 me-2"></i>
                    <h3 class="fw-bold text-gray-900 m-0 fs-5">Audit Konfigurasi Aktif</h3>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-3 fs-7">
                        <tbody>
                            <tr>
                                <td class="text-muted min-w-150px">Nama Aplikasi</td>
                                <td class="fw-bold text-gray-800 text-end">{{ $settings['app_name'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tagline</td>
                                <td class="fw-bold text-gray-800 text-end">{{ $settings['app_tagline'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Versi Dashboard</td>
                                <td class="fw-bold text-primary text-end">{{ $settings['app_version'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Meta Author</td>
                                <td class="fw-bold text-gray-800 text-end">{{ $settings['meta_author'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Copyright Pemilik</td>
                                <td class="fw-bold text-gray-800 text-end">{{ $settings['footer_copyright_text'] ?? '-' }} ({{ $settings['footer_copyright_year'] ?? '-' }})</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Info Server Footer</td>
                                <td class="fw-bold text-end">
                                    @if (($settings['footer_show_system_info'] ?? '1') == '1')
                                        <span class="badge badge-light-success">Aktif</span>
                                    @else
                                        <span class="badge badge-light-danger">Disembunyikan</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card-flush shadow-sm border-0 h-100">
            <div class="card-header border-0 pt-6">
                <div class="card-title d-flex align-items-center">
                    <i class="ki-outline ki-data text-info fs-3 me-2"></i>
                    <h3 class="fw-bold text-gray-900 m-0 fs-5">Lingkungan Server & Aset</h3>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="table-responsive mb-4">
                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-3 fs-7">
                        <tbody>
                            <tr>
                                <td class="text-muted min-w-150px">Versi Laravel</td>
                                <td class="fw-bold text-gray-800 text-end">{{ $serverInfo['laravel_version'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Versi PHP</td>
                                <td class="fw-bold text-gray-800 text-end">{{ $serverInfo['php_version'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Server Web / Engine</td>
                                <td class="fw-bold text-gray-800 text-end">{{ $serverInfo['server_software'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Versi Database MySQL</td>
                                <td class="fw-bold text-gray-800 text-end">{{ $serverInfo['mysql_version'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Lokasi Upload Aset</td>
                                <td class="fw-bold text-gray-800 text-end"><code>public/assets/logo/</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded-3">
                    <div class="d-flex flex-column">
                        <span class="fw-bold text-gray-900 fs-7">Sinkronisasi & Keamanan</span>
                        <span class="text-muted fs-8">Cache otomatis diperbarui setiap kali konfigurasi disimpan.</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary rounded-pill" onclick="document.getElementById('kt_btn_clear_profile_cache').click()">
                        Refresh Cache
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Detail Tables-->
</div>
