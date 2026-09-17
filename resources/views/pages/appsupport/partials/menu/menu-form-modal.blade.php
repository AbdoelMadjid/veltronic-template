<!--begin::Modal - Add Menu (Pola Seeder Elegan)-->
<div class="modal fade" id="kt_modal_add_menu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content border-0 shadow-lg">
            <form class="form" action="{{ route('appsupport.menu.store') }}" method="POST" id="kt_modal_add_menu_form">
                @csrf
                
                <!--begin::Modal Header-->
                <div class="modal-header pb-0 border-0 justify-content-between align-items-start pt-7 px-8 px-lg-10">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge badge-light-primary fw-bold px-3 py-2 fs-7">
                                <i class="ki-duotone ki-element-plus text-primary fs-5 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                Blueprint Seeder
                            </span>
                            <h2 class="fw-bolder text-gray-900 m-0" id="add_modal_header_title">Tambah Menu Baru</h2>
                        </div>
                        <span class="text-muted fs-7">Rancang menu aplikasi dengan struktur hirarki, translasi otomatis, dan hak akses permissions & roles.</span>
                    </div>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <!--end::Modal Header-->

                <!--begin::Nav Tabs-->
                <div class="px-8 px-lg-10 pt-4">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary active py-3" data-bs-toggle="tab" href="#tab_modal_visual_builder">
                                <i class="ki-duotone ki-row-horizontal fs-4 me-2"><span class="path1"></span><span class="path2"></span></i>
                                Visual Builder
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-3" data-bs-toggle="tab" href="#tab_modal_php_preview" id="tab_btn_php_preview">
                                <i class="ki-duotone ki-code fs-4 me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                Preview Seeder PHP
                            </a>
                        </li>
                    </ul>
                </div>
                <!--end::Nav Tabs-->

                <div class="modal-body py-6 px-8 px-lg-10">
                    <div class="tab-content" id="addMenuTabContent">
                        
                        <!-- ========================================== -->
                        <!-- TAB 1: VISUAL BUILDER                      -->
                        <!-- ========================================== -->
                        <div class="tab-pane fade show active" id="tab_modal_visual_builder" role="tabpanel">
                            
                            <!--begin::Mode Selector (Root / Sub / Hirarki Lengkap)-->
                            <div class="bg-light-primary rounded border border-primary border-dashed p-4 mb-6">
                                <div class="d-flex flex-stack flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="symbol symbol-40px symbol-circle bg-primary">
                                            <i class="ki-duotone ki-category fs-2 text-white"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        </div>
                                        <div>
                                            <span class="fs-6 fw-bold text-gray-800 d-block">Pilih Mode Pembuatan</span>
                                            <span class="fs-8 text-muted">Tentukan struktur menu yang ingin Anda buat</span>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2" data-kt-buttons="true">
                                        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary btn-sm active d-flex align-items-center cursor-pointer" id="mode_label_single">
                                            <input class="btn-check" type="radio" name="builder_mode" value="single" id="mode_single" checked />
                                            <span class="fs-7 fw-bold">Menu Tunggal / Sub Menu</span>
                                        </label>
                                        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary btn-sm d-flex align-items-center cursor-pointer" id="mode_label_hierarchy">
                                            <input class="btn-check" type="radio" name="builder_mode" value="hierarchy" id="mode_hierarchy" />
                                            <span class="fs-7 fw-bold">Struktur Komplit (Level 1 ➔ 2 ➔ 3)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Mode Selector-->

                            <!--begin::Card Info Utama (Level 1 / Menu Pokok)-->
                            <div class="card card-bordered shadow-none mb-6 border-gray-300">
                                <div class="card-header min-h-45px py-2 px-6 bg-light d-flex align-items-center justify-content-between">
                                    <div class="card-title m-0">
                                        <span class="badge badge-primary fw-bold me-2 px-2 py-1" id="level_badge_text">Level 1</span>
                                        <span class="fw-bold fs-6 text-gray-800" id="level_title_text">Informasi Menu Utama</span>
                                    </div>
                                    <span class="badge badge-light-info fs-8">Auto-Sync Translation</span>
                                </div>
                                
                                <div class="card-body p-6">
                                    
                                    <!-- Parent Menu Selector (Hanya muncul jika mode Single) -->
                                    <div class="row g-5 mb-5" id="parent_select_container">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-7 fw-bold text-gray-700 mb-1">Kategori Menu (Section Heading)</label>
                                            <input type="text" class="form-control form-control-solid form-control-sm" id="main_category" name="category" placeholder="Contoh: Master Data, Apps, Pages" list="category-suggestions" value="Master Data" />
                                            <datalist id="category-suggestions">
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat }}">
                                                @endforeach
                                            </datalist>
                                            <div class="text-muted fs-8 mt-1">Nama grup/kategori di sidebar atas.</div>
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-7 fw-bold text-gray-700 mb-1">Menu Induk (Parent Menu)</label>
                                            <select name="main_menu_id" id="main_parent_id" class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_add_menu" data-placeholder="Pilih Menu Induk (Opsional)">
                                                <option value="">-- Menu Utama / Root (Level 1) --</option>
                                                @foreach($parentOptions as $pm)
                                                    @php
                                                        $depth = $pm->depth ?? 0;
                                                        $indent = str_repeat('— ', $depth);
                                                        $levelTag = '[Lvl ' . ($depth + 1) . '] ';
                                                    @endphp
                                                    <option value="{{ $pm->id }}" data-category="{{ $pm->category }}" data-url="{{ $pm->url }}">
                                                        {{ $indent }}{{ $levelTag }}{{ $pm->name }} ({{ ucfirst($pm->category ?? 'General') }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-muted fs-8 mt-1">Biarkan kosong untuk membuat menu root Level 1.</div>
                                        </div>
                                    </div>

                                    <!-- Hierarchy Category (Jika mode Hierarchy) -->
                                    <div class="row g-5 mb-5 d-none" id="hierarchy_category_container">
                                        <div class="col-12 fv-row">
                                            <label class="required fs-7 fw-bold text-gray-700 mb-1">Kategori Menu (Section Heading)</label>
                                            <input type="text" class="form-control form-control-solid form-control-sm" id="hierarchy_category" placeholder="Contoh: Master Data, Apps, Pages" list="category-suggestions" value="Master Data" />
                                            <div class="text-muted fs-8 mt-1">Grup menu seeder utama.</div>
                                        </div>
                                    </div>

                                    <!-- Nama Menu ID & EN -->
                                    <div class="row g-5 mb-5">
                                        <div class="col-md-6 fv-row">
                                            <label class="required fs-7 fw-bold text-gray-700 mb-1">Nama Menu (Bahasa Indonesia)</label>
                                            <div class="input-group input-group-sm input-group-solid">
                                                <span class="input-group-text"><i class="ki-duotone ki-text-bold fs-5"><span class="path1"></span><span class="path2"></span></i></span>
                                                <input type="text" class="form-control" id="main_name" name="name" placeholder="Contoh: Dukungan Aplikasi" required autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-7 fw-bold text-gray-700 mb-1">Title (English / EN)</label>
                                            <div class="input-group input-group-sm input-group-solid">
                                                <span class="input-group-text"><i class="ki-duotone ki-flag fs-5"><span class="path1"></span><span class="path2"></span></i></span>
                                                <input type="text" class="form-control" id="main_title_en" name="title_en" placeholder="Contoh: App Support" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Translation Key & URL / Route -->
                                    <div class="row g-5 mb-5">
                                        <div class="col-md-6 fv-row">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <label class="fs-7 fw-bold text-gray-700 m-0">Translation Key (title_key)</label>
                                                <span class="badge badge-light-success fs-9 cursor-pointer" id="btn_regen_key" title="Generate ulang key"><i class="ki-duotone ki-arrows-circle fs-8 text-success me-1"><span class="path1"></span><span class="path2"></span></i>Auto</span>
                                            </div>
                                            <input type="text" class="form-control form-control-solid form-control-sm" id="main_title_key" name="title_key" placeholder="Contoh: md_app_support" />
                                            <div class="text-muted fs-8 mt-1">Disimpan di <code>lang/id/menu.php</code> & <code>lang/en/menu.php</code></div>
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <label class="required fs-7 fw-bold text-gray-700 m-0">URL / Route Name</label>
                                                <span class="badge badge-light-primary fs-9 cursor-pointer" id="btn_regen_url" title="Generate ulang URL"><i class="ki-duotone ki-arrows-circle fs-8 text-primary me-1"><span class="path1"></span><span class="path2"></span></i>Auto</span>
                                            </div>
                                            <input type="text" class="form-control form-control-solid form-control-sm" id="main_url" name="url" placeholder="Contoh: appsupport atau appsupport.menu" required />
                                            <div class="text-muted fs-8 mt-1">Sesuai nama route di <code>route:list</code> (contoh: <code>appsupport.menu</code>)</div>
                                        </div>
                                    </div>

                                    <!-- Icon & Live Preview -->
                                    <div class="row g-5 mb-5">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-7 fw-bold text-gray-700 mb-1">Icon Class (Keenicons)</label>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="symbol symbol-40px symbol-light-primary border border-primary border-dashed d-flex align-items-center justify-content-center" id="main_icon_preview_box">
                                                    <i class="ki-duotone ki-element-11 fs-2 text-primary" id="main_icon_preview_i"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="text" class="form-control form-control-solid form-control-sm" id="main_icon" name="icon" placeholder="ki-duotone ki-element-11 fs-2" value="ki-duotone ki-element-11 fs-2" />
                                                </div>
                                            </div>
                                            
                                            <!-- Quick Icon Shortcuts -->
                                            <div class="d-flex flex-wrap gap-1 mt-2 align-items-center">
                                                <span class="fs-9 text-muted me-1">Pilihan Cepat:</span>
                                                <button type="button" class="btn btn-xs btn-light py-1 px-2 btn-quick-icon" data-icon="ki-duotone ki-abstract-28 fs-2" data-paths="2"><i class="ki-duotone ki-abstract-28 fs-6"><span class="path1"></span><span class="path2"></span></i></button>
                                                <button type="button" class="btn btn-xs btn-light py-1 px-2 btn-quick-icon" data-icon="ki-duotone ki-element-11 fs-2" data-paths="4"><i class="ki-duotone ki-element-11 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i></button>
                                                <button type="button" class="btn btn-xs btn-light py-1 px-2 btn-quick-icon" data-icon="ki-duotone ki-lock-3 fs-2" data-paths="3"><i class="ki-duotone ki-lock-3 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></button>
                                                <button type="button" class="btn btn-xs btn-light py-1 px-2 btn-quick-icon" data-icon="ki-duotone ki-user fs-2" data-paths="2"><i class="ki-duotone ki-user fs-6"><span class="path1"></span><span class="path2"></span></i></button>
                                                <button type="button" class="btn btn-xs btn-light py-1 px-2 btn-quick-icon" data-icon="ki-duotone ki-setting-2 fs-2" data-paths="2"><i class="ki-duotone ki-setting-2 fs-6"><span class="path1"></span><span class="path2"></span></i></button>
                                                <button type="button" class="btn btn-xs btn-light py-1 px-2 btn-quick-icon" data-icon="ki-duotone ki-shield-tick fs-2" data-paths="2"><i class="ki-duotone ki-shield-tick fs-6"><span class="path1"></span><span class="path2"></span></i></button>
                                                <button type="button" class="btn btn-xs btn-light py-1 px-2 btn-quick-icon" data-icon="ki-duotone ki-chart-pie-simple fs-2" data-paths="2"><i class="ki-duotone ki-chart-pie-simple fs-6"><span class="path1"></span><span class="path2"></span></i></button>
                                                <button type="button" class="btn btn-xs btn-light py-1 px-2 btn-quick-icon" data-icon="ki-duotone ki-file fs-2" data-paths="2"><i class="ki-duotone ki-file fs-6"><span class="path1"></span><span class="path2"></span></i></button>
                                                <button type="button" class="btn btn-xs btn-light py-1 px-2 btn-quick-icon" data-icon="ki-duotone ki-category fs-2" data-paths="4"><i class="ki-duotone ki-category fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-7 fw-bold text-gray-700 mb-1">Paths Icon</label>
                                            <input type="number" class="form-control form-control-solid form-control-sm" id="main_paths" name="paths" min="0" max="10" value="4" />
                                            <div class="text-muted fs-8 mt-1">Jumlah span path keenicon</div>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-7 fw-bold text-gray-700 mb-1">Urutan (Orders)</label>
                                            <input type="number" class="form-control form-control-solid form-control-sm" id="main_orders" name="orders" value="0" />
                                            <div class="text-muted fs-8 mt-1">Posisi sorting menu</div>
                                        </div>
                                    </div>

                                    <!-- Optional Meta & Status -->
                                    <div class="row g-5 mb-5 align-items-center">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-7 fw-bold text-gray-700 mb-1">Badge Text (Opsional)</label>
                                            <input type="text" class="form-control form-control-solid form-control-sm" id="main_badge_label" name="badge_label" placeholder="Contoh: New, Pro, Hot" />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-7 fw-bold text-gray-700 mb-1">Badge Class</label>
                                            <select class="form-select form-select-solid form-select-sm" id="main_badge_class" name="badge_class">
                                                <option value="badge badge-light-primary">Light Primary (Biru)</option>
                                                <option value="badge badge-light-success">Light Success (Hijau)</option>
                                                <option value="badge badge-light-warning">Light Warning (Kuning)</option>
                                                <option value="badge badge-light-danger">Light Danger (Merah)</option>
                                                <option value="badge badge-light-info">Light Info (Cyan)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row pt-4">
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input h-20px w-35px" type="checkbox" name="active" value="1" id="main_active" checked />
                                                <label class="form-check-label fs-7 fw-bold text-gray-800 ms-2" for="main_active">Menu Aktif</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--begin::Hak Akses (Permissions & Roles ala Seeder)-->
                                    <div class="rounded border p-4 bg-light-secondary mt-5">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="ki-duotone ki-shield-search fs-4 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                <span class="fs-7 fw-bold text-gray-800">Akses & Permissions (CRUD Pattern)</span>
                                            </div>
                                            <!-- Quick Presets -->
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-xs btn-light-success py-1 px-2 btn-perm-preset" data-preset="crud">⚡ Full CRUD</button>
                                                <button type="button" class="btn btn-xs btn-light-primary py-1 px-2 btn-perm-preset" data-preset="read">👁️ Read Only</button>
                                                <button type="button" class="btn btn-xs btn-light-warning py-1 px-2 btn-perm-preset" data-preset="manage">✏️ Manage</button>
                                            </div>
                                        </div>

                                        <!-- Permissions Checkboxes -->
                                        <div class="d-flex flex-wrap gap-3 mb-3 p-2 bg-white rounded border border-dashed">
                                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                <input class="form-check-input perm-cb" type="checkbox" name="permissions[]" value="create" id="perm_create" />
                                                <label class="form-check-label fs-8 fw-bold text-success cursor-pointer" for="perm_create">Create</label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                <input class="form-check-input perm-cb" type="checkbox" name="permissions[]" value="read" id="perm_read" checked />
                                                <label class="form-check-label fs-8 fw-bold text-primary cursor-pointer" for="perm_read">Read</label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                <input class="form-check-input perm-cb" type="checkbox" name="permissions[]" value="update" id="perm_update" />
                                                <label class="form-check-label fs-8 fw-bold text-warning cursor-pointer" for="perm_update">Update</label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                <input class="form-check-input perm-cb" type="checkbox" name="permissions[]" value="delete" id="perm_delete" />
                                                <label class="form-check-label fs-8 fw-bold text-danger cursor-pointer" for="perm_delete">Delete</label>
                                            </div>
                                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                <input class="form-check-input perm-cb" type="checkbox" name="permissions[]" value="sort" id="perm_sort" />
                                                <label class="form-check-label fs-8 fw-bold text-dark cursor-pointer" for="perm_sort">Sort</label>
                                            </div>
                                        </div>

                                        <!-- Roles Checkboxes -->
                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            <span class="fs-8 fw-bold text-muted me-1">Roles:</span>
                                            @foreach($roles as $role)
                                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary btn-xs py-1 px-2 d-flex align-items-center cursor-pointer m-0">
                                                    <input class="form-check-input d-none role-cb" type="checkbox" name="roles[]" value="{{ $role }}" {{ in_array($role, ['admin', 'master']) ? 'checked' : '' }} />
                                                    <span class="fs-8 fw-bold">{{ ucfirst($role) }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Hak Akses-->

                                </div>
                            </div>
                            <!--end::Card Info Utama-->

                            <!--begin::Section Sub Menu Builder (Hanya di mode Hierarchy)-->
                            <div id="hierarchy_submenus_section" class="d-none">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge badge-success fw-bold px-2 py-1">Children</span>
                                        <h5 class="fw-bold text-gray-900 m-0">Daftar Sub Menu (Level 2 & Level 3)</h5>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-light-success" id="btn_add_dynamic_submenu">
                                        <i class="ki-duotone ki-plus fs-4 me-1"></i> Tambah Sub Menu (Level 2)
                                    </button>
                                </div>

                                <div id="dynamic_submenus_container" class="d-flex flex-column gap-4">
                                    <!-- Dynamic Submenu Cards Appended Here -->
                                </div>
                            </div>
                            <!--end::Section Sub Menu Builder-->

                        </div>
                        <!-- ========================================== -->
                        <!-- END TAB 1                                  -->
                        <!-- ========================================== -->

                        <!-- ========================================== -->
                        <!-- TAB 2: PREVIEW SEEDER PHP                  -->
                        <!-- ========================================== -->
                        <div class="tab-pane fade" id="tab_modal_php_preview" role="tabpanel">
                            <div class="bg-gray-900 rounded p-5 text-white position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom border-gray-700 pb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge badge-light-warning fw-bold">PHP Array Blueprint</span>
                                        <span class="text-gray-400 fs-8">Struktur seeder siap pakai untuk <code>config/menu_seeder/</code></span>
                                    </div>
                                    <button type="button" class="btn btn-xs btn-primary" id="btn_copy_php_blueprint">
                                        <i class="ki-duotone ki-copy fs-5 me-1"><span class="path1"></span><span class="path2"></span></i>
                                        Salin Kode PHP
                                    </button>
                                </div>
                                <pre class="m-0 text-success fs-7 font-monospace overflow-auto mh-400px" id="php_blueprint_code_view">// Kode PHP Blueprint akan muncul otomatis di sini...</pre>
                            </div>
                        </div>
                        <!-- ========================================== -->
                        <!-- END TAB 2                                  -->
                        <!-- ========================================== -->

                    </div>
                </div>

                <div class="modal-footer border-0 pt-0 pb-7 px-8 px-lg-10 flex-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_add_menu">
                        <span class="indicator-label"><i class="ki-duotone ki-check fs-2 me-1"></i> Simpan Menu</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Add Menu-->

<!--begin::Modal - Edit Single Menu-->
<div class="modal fade" id="kt_modal_edit_menu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content border-0 shadow-lg">
            <form class="form" method="POST" id="kt_modal_edit_menu_form">
                @csrf
                @method('PUT')
                
                <div class="modal-header border-0 pb-0 pt-7 px-8 px-lg-10 justify-content-between">
                    <div>
                        <h2 class="fw-bolder text-gray-900 m-0">Edit Menu</h2>
                        <span class="text-muted fs-7">Perbarui konfigurasi menu, translasi, dan hak akses.</span>
                    </div>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body py-6 px-8 px-lg-10">
                    <div class="row g-5 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-7 fw-bold text-gray-700 mb-1">Nama Menu (Bahasa Indonesia)</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="edit_name" name="name" required />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="fs-7 fw-bold text-gray-700 mb-1">Title (English / EN)</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="edit_title_en" name="title_en" />
                        </div>
                    </div>

                    <div class="row g-5 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="fs-7 fw-bold text-gray-700 mb-1">Translation Key (title_key)</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="edit_title_key" name="title_key" />
                            <div class="text-muted fs-8 mt-1">Key di <code>lang/id/menu.php</code> & <code>lang/en/menu.php</code></div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-7 fw-bold text-gray-700 mb-1">URL / Route Key</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="edit_url" name="url" required />
                        </div>
                    </div>

                    <div class="row g-5 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="fs-7 fw-bold text-gray-700 mb-1">Kategori</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="edit_category" name="category" list="category-suggestions" />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="fs-7 fw-bold text-gray-700 mb-1">Parent Menu (Induk)</label>
                            <select name="main_menu_id" id="edit_main_menu_id" class="form-select form-select-solid form-select-sm" data-control="select2" data-dropdown-parent="#kt_modal_edit_menu">
                                <option value="">-- Menu Utama / Root (Level 1) --</option>
                                @foreach($parentOptions as $pm)
                                    @php
                                        $depth = $pm->depth ?? 0;
                                        $indent = str_repeat('— ', $depth);
                                    @endphp
                                    <option value="{{ $pm->id }}">{{ $indent }}[Lvl {{ $depth + 1 }}] {{ $pm->name }} ({{ ucfirst($pm->category ?? 'General') }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-5 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="fs-7 fw-bold text-gray-700 mb-1">Icon Class (Keenicons)</label>
                            <div class="d-flex align-items-center gap-2">
                                <div class="symbol symbol-35px symbol-light-primary border border-primary border-dashed d-flex align-items-center justify-content-center" id="edit_icon_preview_box">
                                    <i class="ki-duotone ki-element-11 fs-3 text-primary" id="edit_icon_preview_i"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                </div>
                                <input type="text" class="form-control form-control-solid form-control-sm flex-grow-1" id="edit_icon" name="icon" />
                            </div>
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-7 fw-bold text-gray-700 mb-1">Paths</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" id="edit_paths" name="paths" min="0" max="10" />
                        </div>
                        <div class="col-md-3 fv-row">
                            <label class="fs-7 fw-bold text-gray-700 mb-1">Urutan (Order)</label>
                            <input type="number" class="form-control form-control-solid form-control-sm" id="edit_orders" name="orders" />
                        </div>
                    </div>

                    <div class="row g-5 mb-5 align-items-center">
                        <div class="col-md-4 fv-row">
                            <label class="fs-7 fw-bold text-gray-700 mb-1">Badge Text</label>
                            <input type="text" class="form-control form-control-solid form-control-sm" id="edit_badge_label" name="badge_label" placeholder="Contoh: New" />
                        </div>
                        <div class="col-md-4 fv-row">
                            <label class="fs-7 fw-bold text-gray-700 mb-1">Badge Class</label>
                            <select class="form-select form-select-solid form-select-sm" id="edit_badge_class" name="badge_class">
                                <option value="badge badge-light-primary">Light Primary</option>
                                <option value="badge badge-light-success">Light Success</option>
                                <option value="badge badge-light-warning">Light Warning</option>
                                <option value="badge badge-light-danger">Light Danger</option>
                                <option value="badge badge-light-info">Light Info</option>
                            </select>
                        </div>
                        <div class="col-md-4 fv-row pt-4">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-35px" type="checkbox" name="active" value="1" id="edit_active" checked />
                                <label class="form-check-label fs-7 fw-bold text-gray-800 ms-2" for="edit_active">Menu Aktif</label>
                            </div>
                        </div>
                    </div>

                    <!-- Hak Akses Edit -->
                    <div class="rounded border p-4 bg-light-secondary mt-5">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                            <span class="fs-7 fw-bold text-gray-800">Akses & Permissions (CRUD)</span>
                            <div class="d-flex gap-1">
                                <button type="button" class="btn btn-xs btn-light-success py-1 px-2 btn-edit-perm-preset" data-preset="crud">⚡ Full CRUD</button>
                                <button type="button" class="btn btn-xs btn-light-primary py-1 px-2 btn-edit-perm-preset" data-preset="read">👁️ Read Only</button>
                                <button type="button" class="btn btn-xs btn-light-warning py-1 px-2 btn-edit-perm-preset" data-preset="manage">✏️ Manage</button>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3 mb-3 p-2 bg-white rounded border border-dashed">
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input edit-perm-cb" type="checkbox" name="permissions[]" value="create" id="edit_perm_create" />
                                <label class="form-check-label fs-8 fw-bold text-success cursor-pointer" for="edit_perm_create">Create</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input edit-perm-cb" type="checkbox" name="permissions[]" value="read" id="edit_perm_read" />
                                <label class="form-check-label fs-8 fw-bold text-primary cursor-pointer" for="edit_perm_read">Read</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input edit-perm-cb" type="checkbox" name="permissions[]" value="update" id="edit_perm_update" />
                                <label class="form-check-label fs-8 fw-bold text-warning cursor-pointer" for="edit_perm_update">Update</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input edit-perm-cb" type="checkbox" name="permissions[]" value="delete" id="edit_perm_delete" />
                                <label class="form-check-label fs-8 fw-bold text-danger cursor-pointer" for="edit_perm_delete">Delete</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input edit-perm-cb" type="checkbox" name="permissions[]" value="sort" id="edit_perm_sort" />
                                <label class="form-check-label fs-8 fw-bold text-dark cursor-pointer" for="edit_perm_sort">Sort</label>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <span class="fs-8 fw-bold text-muted me-1">Roles:</span>
                            @foreach($roles as $role)
                                <label class="btn btn-outline btn-outline-dashed btn-active-light-primary btn-xs py-1 px-2 d-flex align-items-center cursor-pointer m-0">
                                    <input class="form-check-input d-none edit-role-cb" type="checkbox" name="roles[]" value="{{ $role }}" id="edit_role_{{ $role }}" />
                                    <span class="fs-8 fw-bold">{{ ucfirst($role) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0 pb-7 px-8 px-lg-10 flex-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label"><i class="ki-duotone ki-check fs-2 me-1"></i> Perbarui Menu</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Edit Menu-->
