<div class="row g-6">
    <!--begin::Left Column: Footer Settings & Links Repeater-->
    <div class="col-xl-7">
        <div class="card card-flush shadow-sm border-0">
            <div class="card-header card-header-mobile-center border-0 pt-6">
                <div class="card-title d-flex flex-column flex-md-row align-items-center text-center text-md-start">
                    <div class="symbol symbol-45px symbol-md-35px symbol-circle bg-light-success mb-2 mb-md-0 me-0 me-md-3 d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ki-outline ki-document text-success fs-2 fs-md-3"></i>
                    </div>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <h3 class="fw-bold text-gray-900 m-0 fs-4">Pengaturan Footer Dashboard</h3>
                        <span class="text-muted fs-7 mt-1">Atur hak cipta, URL brand, toggle info server, dan tautan navigasi footer.</span>
                    </div>
                </div>
            </div>

            <div class="card-body pt-4">
                <form id="kt_form_app_footer" method="POST" action="{{ route('appsupport.app-profil.footer') }}">
                    @csrf

                    <!--begin::Copyright Info-->
                    <div class="row g-5 mb-5">
                        <div class="col-md-4">
                            <label class="form-label required fw-bold text-gray-800 fs-6">Tahun Copyright</label>
                            <input type="text" class="form-control form-control-solid" id="input_footer_year" name="footer_copyright_year" value="{{ $settings['footer_copyright_year'] ?? '2025' }}" required placeholder="Contoh: 2025 atau 2025-2026" />
                        </div>
                        <div class="col-md-8">
                            <label class="form-label required fw-bold text-gray-800 fs-6">Teks Pemilik Hak Cipta</label>
                            <input type="text" class="form-control form-control-solid" id="input_footer_text" name="footer_copyright_text" value="{{ $settings['footer_copyright_text'] ?? 'Keenthemes' }}" required placeholder="Contoh: Keenthemes atau PT Nama Perusahaan" />
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold text-gray-800 fs-6">Tautan URL Copyright</label>
                        <input type="text" class="form-control form-control-solid" id="input_footer_url" name="footer_copyright_url" value="{{ $settings['footer_copyright_url'] ?? 'https://keenthemes.com' }}" placeholder="https://keenthemes.com atau https://domainanda.com" />
                        <div class="form-text">Tautan tujuan ketika teks pemilik hak cipta di footer diklik oleh pengguna.</div>
                    </div>

                    <div class="mb-8">
                        <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded-3">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-gray-900 fs-6">Tampilkan Informasi Server di Footer</span>
                                <span class="text-muted fs-7">Menampilkan rincian versi Laravel, PHP, dan database MySQL pada footer dashboard.</span>
                            </div>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input h-25px w-45px" type="checkbox" id="input_footer_show_system_info" name="footer_show_system_info" value="1" {{ ($settings['footer_show_system_info'] ?? '1') == '1' ? 'checked' : '' }} />
                            </div>
                        </div>
                    </div>
                    <!--end::Copyright Info-->

                    <!--begin::Footer Menu Links Repeater Section-->
                    <div class="separator separator-dashed my-6"></div>

                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4 gap-3 text-center text-md-start">
                        <div>
                            <h4 class="fw-bold text-gray-900 m-0 fs-5">Tautan Navigasi Footer</h4>
                            <span class="text-muted fs-8">Tambahkan atau sesuaikan link menu cepat di sebelah kanan footer.</span>
                        </div>
                        <button type="button" class="btn btn-light-primary btn-sm fw-bold px-3 w-100 w-md-auto" id="btn_add_footer_link"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah baris menu footer baru">
                            <i class="ki-outline ki-plus fs-4 me-1"></i>
                            <span>Tambah Tautan</span>
                        </button>
                    </div>

                    <div class="table-responsive mb-6">
                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-2 gy-3" id="table_footer_links">
                            <thead>
                                <tr class="fw-bold fs-7 text-gray-600 text-uppercase">
                                    <th class="min-w-150px">Label Tautan</th>
                                    <th class="min-w-200px">URL Target</th>
                                    <th class="min-w-100px">Target</th>
                                    <th class="w-50px text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="footer_links_container">
                                @forelse ($footerLinks as $index => $link)
                                    <tr class="footer-link-row" data-index="{{ $index }}">
                                        <td>
                                            <input type="text" class="form-control form-control-solid form-control-sm link-title" name="links[{{ $index }}][title]" value="{{ $link['title'] ?? '' }}" required placeholder="Contoh: About" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-solid form-control-sm link-url" name="links[{{ $index }}][url]" value="{{ $link['url'] ?? '' }}" required placeholder="https://..." />
                                        </td>
                                        <td>
                                            <select class="form-select form-select-solid form-select-sm link-target" name="links[{{ $index }}][target]">
                                                <option value="_blank" {{ ($link['target'] ?? '_blank') === '_blank' ? 'selected' : '' }}>Tab Baru (_blank)</option>
                                                <option value="_self" {{ ($link['target'] ?? '') === '_self' ? 'selected' : '' }}>Sama (_self)</option>
                                            </select>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-remove-link"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Hapus baris tautan">
                                                <i class="ki-outline ki-trash fs-5"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="footer-link-row" data-index="0">
                                        <td>
                                            <input type="text" class="form-control form-control-solid form-control-sm link-title" name="links[0][title]" value="About" required placeholder="Contoh: About" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-solid form-control-sm link-url" name="links[0][url]" value="https://keenthemes.com" required placeholder="https://..." />
                                        </td>
                                        <td>
                                            <select class="form-select form-select-solid form-select-sm link-target" name="links[0][target]">
                                                <option value="_blank" selected>Tab Baru (_blank)</option>
                                                <option value="_self">Sama (_self)</option>
                                            </select>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-remove-link"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Hapus baris tautan">
                                                <i class="ki-outline ki-trash fs-5"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--end::Footer Menu Links Repeater-->

                    <!--begin::Form Actions-->
                    <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-2 gap-md-3 pt-4 border-top flex-wrap flex-md-nowrap">
                        <button type="button" class="btn btn-light btn-sm fw-bold px-4 px-md-5" id="btn_reset_default_footer_links"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Kembalikan tautan ke pengaturan default">
                            <i class="ki-outline ki-arrows-circle fs-5 me-1"></i>
                            <span>Default Links</span>
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold px-5 px-md-6" id="kt_btn_save_footer"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan pengaturan hak cipta & tautan footer">
                            <span class="indicator-label">
                                <i class="ki-outline ki-check fs-4 me-1"></i>
                                <span>Simpan Pengaturan Footer</span>
                            </span>
                            <span class="indicator-progress">
                                <span>Menyimpan...</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Form Actions-->
                </form>
            </div>
        </div>
    </div>
    <!--end::Left Column-->

    <!--begin::Right Column: Live Footer Preview-->
    <div class="col-xl-5">
        <div class="card card-flush shadow-sm border-0 mb-6">
            <div class="card-header card-header-mobile-center border-0 pt-6">
                <div class="card-title d-flex flex-column flex-md-row align-items-center text-center text-md-start">
                    <div class="symbol symbol-45px symbol-md-35px symbol-circle bg-light-primary mb-2 mb-md-0 me-0 me-md-3 d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ki-outline ki-eye text-primary fs-2 fs-md-3"></i>
                    </div>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <h3 class="fw-bold text-gray-900 m-0 fs-5">Simulasi Tampilan Footer Realtime</h3>
                        <span class="text-muted fs-8 mt-1">Pratinjau tampilan footer di bagian bawah halaman dashboard</span>
                    </div>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="p-4 border rounded-3 bg-body shadow-xs mb-4">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start">
                        <!-- Copyright Preview Left -->
                        <div>
                            <span class="text-muted fw-semibold me-1" id="preview_footer_year">{{ $settings['footer_copyright_year'] ?? '2025' }}&copy;</span>
                            <a href="javascript:void(0)" id="preview_footer_text" class="text-gray-800 text-hover-primary fw-semibold">{{ $settings['footer_copyright_text'] ?? 'Keenthemes' }}</a>
                            <div id="preview_footer_sysinfo" class="text-muted fs-8 mt-1 {{ ($settings['footer_show_system_info'] ?? '1') == '1' ? '' : 'd-none' }}">
                                Laravel {{ $serverInfo['laravel_version'] ?? '12.x' }} | PHP {{ $serverInfo['php_version'] ?? '8.2' }} | MySQL {{ $serverInfo['mysql_version'] ?? '8.0' }}
                            </div>
                        </div>

                        <!-- Links Preview Right -->
                        <ul class="d-flex flex-wrap list-unstyled gap-3 m-0 p-0 fs-7" id="preview_footer_links_list">
                            @foreach ($footerLinks as $link)
                                <li>
                                    <span class="text-gray-600 fw-semibold">{{ $link['title'] ?? '' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="alert alert-dismissible bg-light-info border border-info border-dashed d-flex flex-column flex-sm-row p-4 mb-0">
                    <i class="ki-outline ki-information-4 fs-2 text-info me-3 mb-2 mb-sm-0"></i>
                    <div class="d-flex flex-column pe-0 pe-sm-6">
                        <span class="fw-bold fs-7 text-info">Sinkronisasi Instan</span>
                        <span class="text-gray-700 fs-8">Saat disimpan, bagian footer di bagian paling bawah halaman dashboard akan seketika berubah mengikuti pengaturan di sini tanpa perlu me-reload halaman browser.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Right Column-->
</div>
