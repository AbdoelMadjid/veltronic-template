<!--begin::Unified Permission Modal (Batch CRUD & Single)-->
<div class="modal fade" id="kt_modal_permission_generate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 position-relative pt-7 pt-sm-6 px-6 px-lg-8">
                <!--begin::Close Button-->
                <div class="position-absolute top-0 end-0 m-3 m-sm-4 z-index-2">
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tutup">
                        <i class="ki-outline ki-cross fs-2"></i>
                    </button>
                </div>
                <!--end::Close Button-->

                <!--begin::Header Info (3-Baris Center pada Mobile)-->
                <div class="w-100 text-center text-sm-start pe-0 pe-sm-10">
                    <!-- Row 1 (Mobile only): Icon Logo Lingkaran Sempurna -->
                    <div class="d-flex justify-content-center d-sm-none mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light-primary text-primary rounded-circle" 
                             style="width: 60px; height: 60px; min-width: 60px; min-height: 60px;">
                            <i class="ki-outline ki-element-plus fs-2x text-primary"></i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3" id="unified_modal_main_title">
                        Tambah Permission Modul (Batch CRUD)
                    </h3>

                    <!-- Row 3: Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0" id="unified_modal_sub_title">
                        Buat permission baru secara batch CRUD atau single manual.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-6 px-8">
                <!--begin::Nav Tabs-->
                <div class="overflow-auto mb-6">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold flex-nowrap" role="tablist" id="perm_modal_nav_tabs">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-active-primary active d-flex align-items-center py-3 me-4 me-md-6" 
                               id="tab_btn_batch_crud"
                               data-bs-toggle="tab" 
                               href="#tab_pane_batch_crud" 
                               role="tab"
                               data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Modul CRUD Batch (Praktis)">
                                <i class="ki-outline ki-element-plus fs-4 fs-md-5 me-0 me-md-2 text-warning"></i>
                                <span class="d-none d-md-inline">Modul CRUD Batch (Praktis)</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-active-primary d-flex align-items-center py-3" 
                               id="tab_btn_single_perm"
                               data-bs-toggle="tab" 
                               href="#tab_pane_single_perm" 
                               role="tab"
                               data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Single Permission (Kustom)">
                                <i class="ki-outline ki-key fs-4 fs-md-5 me-0 me-md-2 text-primary"></i>
                                <span class="d-none d-md-inline">Single Permission (Kustom)</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--end::Nav Tabs-->

                <!--begin::Tab Content-->
                <div class="tab-content" id="perm_modal_tab_content">
                    
                    <!-- ========================================================================= -->
                    <!-- TAB 1: MODUL CRUD BATCH (PRAKTIS) -->
                    <!-- ========================================================================= -->
                    <div class="tab-pane fade show active" id="tab_pane_batch_crud" role="tabpanel">
                        <form id="kt_form_generate_permissions" action="{{ route('usermanagement.permissions.generate') }}" method="POST">
                            @csrf

                            <!-- Input Nama Modul -->
                            <div class="fv-row mb-5">
                                <label class="fs-6 fw-bold form-label mb-2 required text-gray-800">
                                    Nama Modul / Fitur Aplikasi
                                </label>
                                <input type="text" class="form-control form-control-solid fs-6 py-3" 
                                       placeholder="Contoh: master-barang, transaksi, laporan" 
                                       name="module_prefix" 
                                       id="gen_input_prefix" required />
                                <div class="form-text text-muted fs-8 mt-2">
                                    Sistem akan membuatkan 4 permission CRUD otomatis ( 
                                    <span class="badge badge-light-danger text-danger fw-bold font-monospace fs-9">create</span> , 
                                    <span class="badge badge-light-danger text-danger fw-bold font-monospace fs-9">read</span> , 
                                    <span class="badge badge-light-danger text-danger fw-bold font-monospace fs-9">update</span> , 
                                    <span class="badge badge-light-danger text-danger fw-bold font-monospace fs-9">delete</span> ).
                                </div>
                            </div>

                            <!-- Pilih Aksi CRUD & Aksi Khusus yang Dibuat -->
                            <div class="fv-row mb-6">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <label class="fs-6 fw-bolder text-gray-900 m-0">
                                        Pilih Aksi CRUD & Izin Khusus
                                    </label>
                                    <button type="button" class="btn btn-link btn-color-primary p-0 fs-8 fw-bold" id="btn_add_custom_action">
                                        <i class="ki-outline ki-plus fs-7 me-1"></i>Aksi Lainnya
                                    </button>
                                </div>

                                <div class="d-flex flex-wrap align-items-center gap-4" id="batch_actions_list">
                                    <!-- Create -->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input batch-action-cb" type="checkbox" name="actions[]" value="create" id="act_cb_create" checked />
                                        <label class="form-check-label text-success fw-bold fs-7 cursor-pointer" for="act_cb_create">
                                            Create
                                        </label>
                                    </div>

                                    <!-- Read -->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input batch-action-cb" type="checkbox" name="actions[]" value="read" id="act_cb_read" checked />
                                        <label class="form-check-label text-primary fw-bold fs-7 cursor-pointer" for="act_cb_read">
                                            Read
                                        </label>
                                    </div>

                                    <!-- Update -->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input batch-action-cb" type="checkbox" name="actions[]" value="update" id="act_cb_update" checked />
                                        <label class="form-check-label text-warning fw-bold fs-7 cursor-pointer" for="act_cb_update">
                                            Update
                                        </label>
                                    </div>

                                    <!-- Delete -->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input batch-action-cb" type="checkbox" name="actions[]" value="delete" id="act_cb_delete" checked />
                                        <label class="form-check-label text-danger fw-bold fs-7 cursor-pointer" for="act_cb_delete">
                                            Delete
                                        </label>
                                    </div>

                                    <!-- Sort (Khusus Menu/Urutan) -->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input batch-action-cb" type="checkbox" name="actions[]" value="sort" id="act_cb_sort" />
                                        <label class="form-check-label text-info fw-bold fs-7 cursor-pointer" for="act_cb_sort">
                                            Sort
                                        </label>
                                    </div>

                                    <!-- Container untuk Aksi Kustom Tambahan Dinamis -->
                                    <div id="dynamic_custom_actions_wrapper" class="d-flex flex-wrap align-items-center gap-4"></div>
                                </div>
                            </div>

                            <!-- Tugaskan Sekaligus ke Role -->
                            <div class="fv-row mb-6">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <label class="fs-6 fw-bolder text-gray-900 m-0">
                                        Tugaskan Sekaligus ke Role (Opsional)
                                    </label>
                                    <div class="fs-8">
                                        <a href="javascript:void(0)" class="text-primary fw-bold me-1" id="btn_batch_role_all">Pilih Semua</a>
                                        <span class="text-muted">|</span>
                                        <a href="javascript:void(0)" class="text-muted fw-bold ms-1" id="btn_batch_role_none">Kosongkan</a>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    @foreach($roles as $role)
                                        @php
                                            $rNameLower = strtolower($role->name);
                                            $cardClass = 'bg-light-info border-info border-opacity-50 text-info';

                                            if ($rNameLower === 'master') {
                                                $cardClass = 'bg-light-danger border-danger border-opacity-50 text-danger';
                                            } elseif ($rNameLower === 'admin') {
                                                $cardClass = 'bg-light-primary border-primary border-opacity-50 text-primary';
                                            }
                                        @endphp
                                        <div class="col-md-4 col-sm-6">
                                            <div class="rounded-3 p-3 d-flex align-items-center justify-content-between border border-dashed {{ $cardClass }}">
                                                <span class="fw-bolder fs-7">{{ ucfirst($role->name) }}</span>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input batch-role-cb" type="checkbox" name="roles[]" value="{{ $role->name }}" id="batch_role_{{ $role->id }}" />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Modal Footer Batch -->
                            <div class="d-flex align-items-center justify-content-center justify-content-sm-end gap-2 pt-4 border-0">
                                <button type="button" class="btn btn-light fw-bold px-4 px-sm-6" data-bs-dismiss="modal"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal">
                                    <i class="ki-outline ki-cross fs-4 me-1"></i>
                                    <span>Batal</span>
                                </button>
                                <button type="submit" class="btn btn-primary fw-bold px-4 px-sm-6" id="kt_btn_submit_generate_perm"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan Akses CRUD">
                                    <span class="indicator-label">
                                        <i class="ki-outline ki-element-plus fs-4 me-1"></i>
                                        <span id="btn_batch_text">Simpan 4 Akses CRUD</span>
                                    </span>
                                    <span class="indicator-progress">
                                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                                        <span>Memproses...</span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- ========================================================================= -->
                    <!-- TAB 2: SINGLE PERMISSION (KUSTOM) -->
                    <!-- ========================================================================= -->
                    <div class="tab-pane fade" id="tab_pane_single_perm" role="tabpanel">
                        <form id="kt_form_permission" action="{{ route('usermanagement.permissions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" id="perm_form_method" value="POST" />
                            <input type="hidden" name="perm_id" id="perm_form_id" value="" />

                            <!-- Input Nama Permission -->
                            <div class="fv-row mb-5">
                                <label class="fs-6 fw-bold form-label mb-2 required text-gray-800">
                                    Nama Permission
                                </label>
                                <input type="text" class="form-control form-control-solid fs-6 py-3" 
                                       placeholder="Contoh: export-excel, impersonate" 
                                       name="name" 
                                       id="perm_input_name" required />
                                <div class="form-text text-muted fs-8 mt-2">
                                    Format: 
                                    <span class="badge badge-light-danger text-danger fw-bold font-monospace fs-9">[aksi]</span> 
                                    <span class="badge badge-light-danger text-danger fw-bold font-monospace fs-9">[modul]</span> 
                                    atau nama custom.
                                </div>
                            </div>

                            <!-- Tugaskan ke Role -->
                            <div class="fv-row mb-6">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <label class="fs-6 fw-bolder text-gray-900 m-0">
                                        Tugaskan ke Role (Opsional)
                                    </label>
                                    <div class="fs-8">
                                        <a href="javascript:void(0)" class="text-primary fw-bold me-1" id="btn_single_role_all">Pilih Semua</a>
                                        <span class="text-muted">|</span>
                                        <a href="javascript:void(0)" class="text-muted fw-bold ms-1" id="btn_single_role_none">Kosongkan</a>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    @foreach($roles as $role)
                                        @php
                                            $rNameLower = strtolower($role->name);
                                            $cardClass = 'bg-light-info border-info border-opacity-50 text-info';

                                            if ($rNameLower === 'master') {
                                                $cardClass = 'bg-light-danger border-danger border-opacity-50 text-danger';
                                            } elseif ($rNameLower === 'admin') {
                                                $cardClass = 'bg-light-primary border-primary border-opacity-50 text-primary';
                                            }
                                        @endphp
                                        <div class="col-md-4 col-sm-6">
                                            <div class="rounded-3 p-3 d-flex align-items-center justify-content-between border border-dashed {{ $cardClass }}">
                                                <span class="fw-bolder fs-7">{{ ucfirst($role->name) }}</span>
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input single-role-cb" type="checkbox" name="roles[]" value="{{ $role->name }}" id="single_role_{{ $role->id }}" />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Modal Footer Single -->
                            <div class="d-flex align-items-center justify-content-center justify-content-sm-end gap-2 pt-4 border-0">
                                <button type="button" class="btn btn-light fw-bold px-4 px-sm-6" data-bs-dismiss="modal"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal">
                                    <i class="ki-outline ki-cross fs-4 me-1"></i>
                                    <span>Batal</span>
                                </button>
                                <button type="submit" class="btn btn-primary fw-bold px-4 px-sm-6" id="kt_btn_save_permission"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan Single Permission">
                                    <span class="indicator-label">
                                        <i class="ki-outline ki-check fs-5 me-1"></i>
                                        <span>Simpan Single Permission</span>
                                    </span>
                                    <span class="indicator-progress">
                                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                                        <span>Menyimpan...</span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
                <!--end::Tab Content-->
            </div>
            <!--end::Modal body-->
        </div>
    </div>
</div>
<!--end::Unified Permission Modal-->
