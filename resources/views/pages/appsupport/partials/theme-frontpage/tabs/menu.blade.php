<!--begin::Tab Pane Menu Navigasi-->
<div class="card shadow-sm mb-6">
    <!--begin::Card header-->
    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
        <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
            <h3 class="fw-bolder text-gray-900 m-0 fs-4">Menu Navigasi Header & Target Anchor</h3>
            <span class="text-muted fs-7 mt-1">Atur menu navigasi pada bilah header landing page yang langsung melompat ke section terkait.</span>
        </div>
        <div class="card-toolbar d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-center justify-content-md-end gap-2 w-100 w-md-auto mt-2 mt-md-0">
            <button type="button" class="btn btn-light-warning btn-sm fw-bold px-3 px-md-4 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto" id="kt_btn_reset_menu_default"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Reset Menu ke Bawaan">
                <span class="indicator-label d-inline-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-arrows-loop fs-4 me-1"></i> <span>Reset Menu</span>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle me-1"></span> <span>Memproses...</span>
                </span>
            </button>
            <button type="button" class="btn btn-primary btn-sm fw-bold px-3 px-md-4 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto" id="kt_btn_add_menu_item"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Menu Navigasi Header">
                <i class="ki-outline ki-plus fs-4 me-1"></i> <span>Tambah Menu Item</span>
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-6 px-4 px-md-6">
        <!--begin::Info Alert-->
        <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-4 mb-5 border border-primary border-opacity-25 rounded-3">
            <i class="ki-outline ki-information-5 fs-2 text-primary me-3 mb-2 mb-sm-0"></i>
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <span class="fw-bold text-gray-800 fs-7">Mekanisme Anchor Navigasi</span>
                <span class="text-gray-600 fs-8">Gunakan simbol hashtag (<code>#</code>) diikuti ID anchor section (contoh: <code>#how-it-works</code>, <code>#pricing</code>, <code>#team</code>, atau <code>#kt_body</code> untuk paling atas) agar menu melakukan smooth-scroll ke konten yang bersangkutan secara otomatis.</span>
            </div>
        </div>
        <!--end::Info Alert-->

        <!--begin::Table wrapper-->
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-4 gy-4" id="kt_table_landing_menus">
                <thead>
                    <tr class="fw-bolder text-muted fs-7 text-uppercase bg-light">
                        <th class="w-50px text-center">Urutan</th>
                        <th class="min-w-150px">Label Menu (ID / EN)</th>
                        <th class="min-w-150px">Target Anchor / URL</th>
                        <th class="min-w-100px text-center">Tipe Tautan</th>
                        <th class="min-w-100px text-center">Status</th>
                        <th class="w-130px text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600 fs-7" id="kt_landing_menu_tbody">
                    @forelse($menuItems as $index => $item)
                        <tr data-id="{{ $item['id'] ?? '' }}" data-order="{{ $item['order'] ?? ($index + 1) }}" class="landing-menu-row">
                            <!-- Urutan & Drag Handle -->
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button type="button" class="btn btn-icon btn-light btn-sm w-25px h-25px btn-menu-up" data-bs-toggle="tooltip" title="Naikkan">
                                        <i class="ki-outline ki-up fs-7"></i>
                                    </button>
                                    <span class="badge badge-light-primary fw-bold fs-7 menu-order-badge">{{ $item['order'] ?? ($index + 1) }}</span>
                                    <button type="button" class="btn btn-icon btn-light btn-sm w-25px h-25px btn-menu-down" data-bs-toggle="tooltip" title="Turunkan">
                                        <i class="ki-outline ki-down fs-7"></i>
                                    </button>
                                </div>
                            </td>

                            <!-- Label Menu -->
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-gray-900 fw-bold fs-6">{{ $item['title'] ?? '-' }}</span>
                                    <span class="text-muted fs-8">EN: {{ $item['title_en'] ?? ($item['title'] ?? '-') }}</span>
                                </div>
                            </td>

                            <!-- Target Anchor -->
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge badge-light-info fw-bold font-monospace fs-8">
                                        {{ $item['target'] ?? '#' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Tipe Tautan -->
                            <td class="text-center">
                                @if(!empty($item['is_external']))
                                    <span class="badge badge-light-warning fs-8">Eksternal URL</span>
                                @else
                                    <span class="badge badge-light-primary fs-8">Anchor Section</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="text-center">
                                <div class="form-check form-switch form-check-custom form-check-solid d-inline-flex justify-content-center">
                                    <input class="form-check-input h-20px w-35px menu-toggle-status" type="checkbox"
                                           data-id="{{ $item['id'] ?? '' }}"
                                           {{ !empty($item['is_active']) ? 'checked' : '' }} />
                                </div>
                            </td>

                            <!-- Aksi -->
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-icon btn-light-primary btn-sm btn-edit-menu"
                                            data-id="{{ $item['id'] ?? '' }}"
                                            data-title="{{ $item['title'] ?? '' }}"
                                            data-title-en="{{ $item['title_en'] ?? '' }}"
                                            data-target="{{ $item['target'] ?? '' }}"
                                            data-order="{{ $item['order'] ?? ($index + 1) }}"
                                            data-active="{{ !empty($item['is_active']) ? '1' : '0' }}"
                                            data-external="{{ !empty($item['is_external']) ? '1' : '0' }}"
                                            data-bs-toggle="tooltip" title="Ubah Menu">
                                        <i class="ki-outline ki-pencil fs-5"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-delete-menu"
                                            data-id="{{ $item['id'] ?? '' }}"
                                            data-title="{{ $item['title'] ?? '' }}"
                                            data-bs-toggle="tooltip" title="Hapus Menu">
                                        <i class="ki-outline ki-trash fs-5"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-8">
                                <i class="ki-outline ki-information-2 fs-2x text-muted d-block mb-2"></i>
                                Belum ada item menu navigasi yang terdaftar.
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
<!--end::Tab Pane Menu Navigasi-->
