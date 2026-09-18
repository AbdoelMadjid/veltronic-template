<!--begin::Modal - Manage Shortcut (Tambah & Edit Pintasan Keyboard)-->
<div class="modal fade" id="kt_modal_shortcut_manage" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content border-0 shadow-lg">
            <!--begin::Form-->
            <form id="form_shortcut_manage" method="POST" action="{{ route('appsupport.shortcuts.store') }}">
                @csrf
                <input type="hidden" name="_method" id="shortcut_form_method" value="POST" />
                <input type="hidden" name="id" id="shortcut_form_id" value="" />

                <!--begin::Modal header-->
                <div class="modal-header border-0 pb-0 pt-7 px-8 px-lg-10 justify-content-between align-items-start">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge badge-light-primary fw-bold px-3 py-2 fs-7">
                                <i class="ki-outline ki-keyboard text-primary fs-5 me-1"></i>
                                Pemantau Tombol
                            </span>
                            <h2 class="fw-bolder text-gray-900 m-0" id="shortcut_form_card_title">Tambah Pintasan Baru</h2>
                        </div>
                        <span class="text-muted fs-8 mt-1" id="shortcut_form_card_subtitle">
                            Pilih kelompok aksi, kombinasi tombol, dan filter hak akses
                        </span>
                    </div>
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body py-6 px-8 px-lg-10">
                    
                    <!-- Step 1: Pemilihan Kelompok / Kategori Pintasan -->
                    <div class="fv-row mb-5">
                        <label class="required fs-8 fw-bold text-gray-800 mb-2 d-flex align-items-center justify-content-between">
                            <span><i class="ki-outline ki-category fs-7 text-primary me-1"></i> 1. Kelompok Jenis Pintasan</span>
                            <span class="badge badge-light-primary fs-9" id="badge_selected_category">Visibilitas Antarmuka</span>
                        </label>
                        
                        <div class="row g-2" id="shortcut_category_selector_grid">
                            <div class="col-4">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-sm w-100 p-2 text-start btn-category-select active" data-category="visibility">
                                    <i class="ki-outline ki-eye fs-4 d-block mb-1 text-primary"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Visibilitas</span>
                                    <span class="text-muted fs-10">Bilah Alat / Menu</span>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-info btn-sm w-100 p-2 text-start btn-category-select" data-category="navigation">
                                    <i class="ki-outline ki-route fs-4 d-block mb-1 text-info"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Navigasi</span>
                                    <span class="text-muted fs-10">Buka Menu / Tautan</span>
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-success btn-sm w-100 p-2 text-start btn-category-select" data-category="appearance">
                                    <i class="ki-outline ki-color-filter fs-4 d-block mb-1 text-success"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Tema & Ikon</span>
                                    <span class="text-muted fs-10">Gelap / Terang / Gaya</span>
                                </button>
                            </div>
                            <div class="col-6 mt-2">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-sm w-100 p-2 text-start btn-category-select" data-category="system">
                                    <i class="ki-outline ki-shield-tick fs-4 d-block mb-1 text-danger"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Aksi Sistem</span>
                                    <span class="text-muted fs-10">Pencarian, Kunci Layar</span>
                                </button>
                            </div>
                            <div class="col-6 mt-2">
                                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-warning btn-sm w-100 p-2 text-start btn-category-select" data-category="element">
                                    <i class="ki-outline ki-cursor fs-4 d-block mb-1 text-warning"></i>
                                    <span class="fw-bold fs-9 d-block text-gray-900">Klik Elemen</span>
                                    <span class="text-muted fs-10">Panel / Sembulan</span>
                                </button>
                            </div>
                        </div>
                        <div class="text-muted fs-9 mt-2 p-2 bg-light rounded-2 border" id="category_description_hint">
                            Menampilkan atau menyembunyikan elemen UI seperti toolbar, navbar, header, atau sidebar secara realtime dan tersimpan persisten ke basis data.
                        </div>
                    </div>

                    <!-- Step 2: Target Aksi Spesifik Sesuai Kelompok -->
                    <div class="fv-row mb-5">
                        <label class="required fs-8 fw-bold text-gray-800 mb-1">
                            <i class="ki-outline ki-route fs-7 text-primary me-1"></i> 2. Target Aksi Spesifik
                        </label>
                        <select id="shortcut_target_select" class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_shortcut_manage" data-hide-search="false" data-placeholder="Pilih target aksi...">
                            <!-- Populated dynamically via JS based on selected category -->
                        </select>
                    </div>

                    <!-- Input Target Kustom (URL atau Selector) -->
                    <div id="wrapper_custom_target" class="fv-row mb-5 p-3 bg-light-info rounded-3 border border-info border-opacity-25 d-none">
                        <label class="fs-8 fw-bold text-gray-800 mb-1 d-block" id="custom_target_input_label">
                            Tautan Target Halaman:
                        </label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-body text-primary fw-bold" id="custom_target_addon">/</span>
                            <input type="text" id="custom_target_value_input" class="form-control form-control-solid" placeholder="usermanagement/users atau #id-elemen" />
                        </div>
                        <span class="text-muted fs-9 mt-1 d-block" id="custom_target_help_text">
                            Ketik tautan relatif (misal: <code>usermanagement/users</code>) atau selector elemen antarmuka.
                        </span>
                    </div>

                    <!-- Hidden Fields untuk Aksi & Target -->
                    <input type="hidden" name="action_type" id="hidden_action_type" value="toggle_topbar_tools" />
                    <input type="hidden" name="action_target" id="hidden_action_target" value="topbar_tools" />

                    <!-- Step 3: Nama & Deskripsi Pintasan -->
                    <div class="fv-row mb-5">
                        <label class="required fs-8 fw-bold text-gray-800 mb-1">
                            <i class="ki-outline ki-notepad fs-7 text-primary me-1"></i> 3. Nama Pintasan
                        </label>
                        <input type="text" name="name" id="shortcut_input_name" class="form-control form-control-solid form-control-sm" placeholder="Contoh: Alihkan Alat di Bilah Atas" value="Alihkan Alat di Bilah Atas" required />
                    </div>

                    <!-- Step 4: Kombinasi Tombol Keyboard Interaktif -->
                    <div class="fv-row mb-5 p-3 bg-light rounded-3 border">
                        <label class="required fs-8 fw-bold text-gray-800 mb-2 d-flex align-items-center justify-content-between">
                            <span><i class="ki-outline ki-electricity fs-7 text-primary me-1"></i> 4. Kombinasi Tombol</span>
                            <span class="fs-9 text-muted">Tombol Pengubah + Huruf</span>
                        </label>
                        
                        <!-- Checkboxes Modifiers -->
                        <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input shortcut-modifier-check" type="checkbox" name="ctrl" value="1" id="shortcut_check_ctrl" checked />
                                <label class="form-check-label fs-8 fw-semibold cursor-pointer" for="shortcut_check_ctrl">Ctrl / ⌘</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input shortcut-modifier-check" type="checkbox" name="alt" value="1" id="shortcut_check_alt" />
                                <label class="form-check-label fs-8 fw-semibold cursor-pointer" for="shortcut_check_alt">Alt / ⌥</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input shortcut-modifier-check" type="checkbox" name="shift" value="1" id="shortcut_check_shift" checked />
                                <label class="form-check-label fs-8 fw-semibold cursor-pointer" for="shortcut_check_shift">Shift</label>
                            </div>
                        </div>

                        <!-- Tombol Utama Input -->
                        <div class="d-flex align-items-center gap-2">
                            <span class="fs-8 text-muted fw-semibold">Tombol:</span>
                            <input type="text" name="key" id="shortcut_input_key" class="form-control form-control-solid form-control-sm text-center fw-bold text-uppercase w-85px shadow-sm" maxlength="15" placeholder="T" value="t" required />
                            <span class="fs-9 text-muted">(A-Z, 0-9, /, dll.)</span>
                        </div>

                        <!-- Live Conflict Detector Alert -->
                        <div id="shortcut_conflict_warning" class="alert alert-warning py-2 px-3 mt-3 mb-0 d-none fs-9 d-flex align-items-center">
                            <i class="ki-outline ki-information-5 text-warning fs-5 me-2 flex-shrink-0"></i>
                            <span id="conflict_warning_message">Kombinasi ini sudah digunakan.</span>
                        </div>

                        <!-- Live Preview Badge -->
                        <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top border-gray-300">
                            <span class="fs-9 text-muted">Pratinjau Tombol:</span>
                            <div id="shortcut_live_badge_preview">
                                <kbd class="bg-primary text-white px-2 py-1 rounded fw-bold fs-8 shadow-sm">Ctrl + Shift + T</kbd>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Batasan Hak Akses Role -->
                    <div class="fv-row mb-5">
                        <label class="fs-8 fw-bold text-gray-800 mb-1 d-block">
                            <i class="ki-outline ki-shield-tick fs-7 text-primary me-1"></i> 5. Penyaringan Hak Akses Peran
                        </label>
                        <span class="fs-9 text-muted mb-2 d-block">Hanya peran yang dipilih yang dapat mengeksekusi pintasan ini</span>
                        
                        <div class="d-flex flex-column gap-2 p-3 bg-light rounded-3 border">
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input" type="checkbox" id="shortcut_role_all" />
                                <label class="form-check-label fs-8 fw-bold text-gray-800 cursor-pointer" for="shortcut_role_all">
                                    Semua Peran (Dapat Diakses Seluruh Pengguna)
                                </label>
                            </div>
                            <div class="separator my-1"></div>
                            <div class="d-flex flex-wrap gap-3" id="wrapper_role_checkboxes">
                                @foreach($availableRoles as $roleName)
                                    @php
                                        $roleLower = strtolower($roleName);
                                        $isChecked = in_array($roleLower, ['master', 'admin']);
                                    @endphp
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input role-item-checkbox" type="checkbox" name="roles[]" value="{{ $roleName }}" id="role_chk_{{ $roleName }}" {{ $isChecked ? 'checked' : '' }} />
                                        <label class="form-check-label fs-8 fw-semibold cursor-pointer" for="role_chk_{{ $roleName }}">
                                            {{ ucfirst($roleName) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Tambahan -->
                    <div class="fv-row mb-5">
                        <label class="fs-8 fw-bold text-gray-700 mb-1">Deskripsi Tambahan (Opsional)</label>
                        <textarea name="description" id="shortcut_input_description" class="form-control form-control-solid form-control-sm" rows="2" placeholder="Jelaskan kegunaan pintasan ini..."></textarea>
                    </div>

                    <!-- Status Aktif Switch -->
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border">
                        <div class="d-flex flex-column">
                            <span class="fs-8 fw-bold text-gray-800">Status Pintasan</span>
                            <span class="fs-9 text-muted">Aktifkan agar dapat langsung digunakan</span>
                        </div>
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input h-20px w-35px" type="checkbox" name="is_enabled" value="1" id="shortcut_input_is_enabled" checked />
                        </div>
                    </div>

                </div>
                <!--end::Modal body-->

                <!--begin::Modal footer-->
                <div class="modal-footer border-0 pt-0 pb-7 px-8 px-lg-10 flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="btn_save_shortcut_manage" class="btn btn-primary">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-4 me-1"></i> Simpan Pintasan
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span> Menyimpan...
                        </span>
                    </button>
                </div>
                <!--end::Modal footer-->

            </form>
            <!--end::Form-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Manage Shortcut-->
