<!--begin::Tab Pane Sections Konten-->
<div class="card shadow-sm mb-6">
    <!--begin::Card header-->
    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
        <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
            <h3 class="fw-bolder text-gray-900 m-0 fs-4">Manajemen Section / Bagian Konten Landing</h3>
            <span class="text-muted fs-7 mt-1">Kelola bagian konten landing page, urutkan susunannya, aktif/nonaktifkan, atau tambahkan section kustom.</span>
        </div>
        <div class="card-toolbar d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-center justify-content-md-end gap-2 w-100 w-md-auto mt-2 mt-md-0">
            <button type="button" class="btn btn-light-warning btn-sm fw-bold px-3 px-md-4 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto" id="kt_btn_reset_sections_default"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Reset Section ke Bawaan">
                <span class="indicator-label d-inline-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-arrows-loop fs-4 me-1"></i> <span>Reset Section</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-1"></span> <span>Memproses...</span>
                </span>
            </button>
            <button type="button" class="btn btn-primary btn-sm fw-bold px-3 px-md-4 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto" id="kt_btn_add_custom_section"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Section Kustom">
                <i class="ki-outline ki-plus fs-4 me-1"></i> <span>Tambah Section Kustom</span>
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-6 px-4 px-md-6">
        <!--begin::Table wrapper-->
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-4 gy-4" id="kt_table_landing_sections">
                <thead>
                    <tr class="fw-bolder text-muted fs-7 text-uppercase bg-light">
                        <th class="w-60px text-center">Urutan</th>
                        <th class="min-w-200px">Bagian Konten & ID Anchor</th>
                        <th class="min-w-250px">Judul & Keterangan</th>
                        <th class="min-w-100px text-center">Kategori</th>
                        <th class="min-w-100px text-center">Status</th>
                        <th class="w-130px text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600 fs-7" id="kt_landing_sections_tbody">
                    @forelse($sections as $index => $sec)
                        <tr data-id="{{ $sec['id'] ?? '' }}" data-order="{{ $sec['order'] ?? ($index + 1) }}" class="landing-section-row">
                            <!-- Urutan -->
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button type="button" class="btn btn-icon btn-light btn-sm w-25px h-25px btn-section-up" data-bs-toggle="tooltip" title="Naikkan">
                                        <i class="ki-outline ki-up fs-7"></i>
                                    </button>
                                    <span class="badge badge-light-primary fw-bold fs-7 section-order-badge">{{ $sec['order'] ?? ($index + 1) }}</span>
                                    <button type="button" class="btn btn-icon btn-light btn-sm w-25px h-25px btn-section-down" data-bs-toggle="tooltip" title="Turunkan">
                                        <i class="ki-outline ki-down fs-7"></i>
                                    </button>
                                </div>
                            </td>

                            <!-- Bagian & ID Anchor -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px symbol-circle bg-light-primary me-3 d-flex align-items-center justify-content-center">
                                        <i class="ki-outline {{ $sec['icon'] ?? 'ki-element-11' }} text-primary fs-3"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-900 fw-bold fs-6">{{ $sec['name'] ?? 'Section' }}</span>
                                        <span class="badge badge-light-secondary font-monospace fs-8 w-fit mt-1">
                                            #{{ $sec['anchor'] ?? '' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- Judul & Keterangan -->
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-gray-800 fw-semibold fs-7">{{ $sec['title'] ?? '-' }}</span>
                                    <span class="text-muted fs-8 text-truncate" style="max-width: 320px;">{{ $sec['subtitle'] ?? '-' }}</span>
                                </div>
                            </td>

                            <!-- Kategori -->
                            <td class="text-center">
                                @if(!empty($sec['is_custom']))
                                    <span class="badge badge-light-success fw-bold fs-8">Kustom HTML</span>
                                @else
                                    <span class="badge badge-light-info fw-bold fs-8">{{ $sec['badge'] ?? 'Bawaan' }}</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="text-center">
                                <div class="form-check form-switch form-check-custom form-check-solid d-inline-flex justify-content-center">
                                    <input class="form-check-input h-20px w-35px section-toggle-status" type="checkbox"
                                           data-id="{{ $sec['id'] ?? '' }}"
                                           {{ !empty($sec['is_active']) ? 'checked' : '' }} />
                                </div>
                            </td>

                            <!-- Aksi -->
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-icon btn-light-info btn-sm btn-edit-section-code"
                                            data-id="{{ $sec['id'] ?? '' }}"
                                            data-name="{{ $sec['name'] ?? '' }}"
                                            data-custom="{{ !empty($sec['is_custom']) ? '1' : '0' }}"
                                            data-bs-toggle="tooltip" title="Edit Script Blade / HTML">
                                        <i class="ki-outline ki-code fs-5"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-light-primary btn-sm btn-edit-section"
                                            data-id="{{ $sec['id'] ?? '' }}"
                                            data-anchor="{{ $sec['anchor'] ?? '' }}"
                                            data-name="{{ $sec['name'] ?? '' }}"
                                            data-title="{{ $sec['title'] ?? '' }}"
                                            data-subtitle="{{ $sec['subtitle'] ?? '' }}"
                                            data-icon="{{ $sec['icon'] ?? '' }}"
                                            data-badge="{{ $sec['badge'] ?? '' }}"
                                            data-order="{{ $sec['order'] ?? ($index + 1) }}"
                                            data-active="{{ !empty($sec['is_active']) ? '1' : '0' }}"
                                            data-custom="{{ !empty($sec['is_custom']) ? '1' : '0' }}"
                                            data-content="{{ base64_encode($sec['content_html'] ?? '') }}"
                                            data-bs-toggle="tooltip" title="Ubah Konfigurasi Section">
                                        <i class="ki-outline ki-pencil fs-5"></i>
                                    </button>
                                    @if(!empty($sec['is_custom']))
                                        <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-delete-section"
                                                data-id="{{ $sec['id'] ?? '' }}"
                                                data-name="{{ $sec['name'] ?? '' }}"
                                                data-bs-toggle="tooltip" title="Hapus Section Kustom">
                                            <i class="ki-outline ki-trash fs-5"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-8">
                                <i class="ki-outline ki-information-2 fs-2x text-muted d-block mb-2"></i>
                                Belum ada section konten yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!--end::Table wrapper-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Tab Pane Sections Konten-->
