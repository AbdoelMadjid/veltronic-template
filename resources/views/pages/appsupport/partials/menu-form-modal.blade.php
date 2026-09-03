<!--begin::Modal - Add Single Menu (Tambah Menu Baru / Tambah Sub Menu dari Menu yang Ada)-->
<div class="modal fade" id="kt_modal_add_menu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">
            <form class="form" action="{{ route('appsupport.menu.store') }}" method="POST" id="kt_modal_add_menu_form">
                @csrf
                <div class="modal-header" id="kt_modal_add_menu_header">
                    <div>
                        <h2 class="fw-bold mb-1" id="add_single_modal_title">Tambah Menu Baru</h2>
                        <span class="text-muted fs-7">Tambah menu utama baru atau sub-menu dari menu yang sudah ada.</span>
                    </div>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body py-8 px-lg-12">
                    <!--begin::Title Inputs (ID & EN)-->
                    <div class="row g-6 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Nama Menu (Bahasa Indonesia)</label>
                            <input type="text" class="form-control form-control-solid" id="add_single_name" placeholder="Contoh: Profil Aplikasi" name="name" required />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Title (English / Bahasa Inggris)</label>
                            <input type="text" class="form-control form-control-solid" id="add_single_title_en" placeholder="Contoh: App Profile" name="title_en" />
                        </div>
                    </div>
                    <!--end::Title Inputs-->

                    <!--begin::Translation Key & URL-->
                    <div class="row g-6 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Translation Key (title_key)</label>
                            <input type="text" class="form-control form-control-solid" id="add_single_title_key" placeholder="Contoh: md_app_profil" name="title_key" />
                            <div class="text-muted fs-8 mt-1">Kunci untuk multi bahasa (<code>lang/id/menu.php</code> & <code>lang/en/menu.php</code>).</div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">URL / Route Key</label>
                            <input type="text" class="form-control form-control-solid" id="add_single_url" placeholder="Contoh: appsupport/app-profil" name="url" required />
                            <div class="text-muted fs-8 mt-1">Format slash (<code>kategori/nama</code>) atau dot (<code>kategori.nama</code>).</div>
                        </div>
                    </div>
                    <!--end::Translation Key & URL-->

                    <!--begin::Category & Parent-->
                    <div class="row g-6 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Kategori</label>
                            <input type="text" class="form-control form-control-solid" id="add_single_category" placeholder="Contoh: masterdata, apps" name="category" list="category-suggestions" />
                            <datalist id="category-suggestions">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                            </datalist>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Parent Menu (Induk Menu)</label>
                            <select name="main_menu_id" id="add_single_main_menu_id" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_menu" data-placeholder="Pilih Parent (Root / Sub Menu)">
                                <option value="">-- Menu Utama / Root (Level 1) --</option>
                                @foreach($parentOptions as $pm)
                                    @php
                                        $depth = $pm->depth ?? 0;
                                        $indent = str_repeat('— ', $depth);
                                        $levelTag = '[Lvl ' . ($depth + 1) . '] ';
                                    @endphp
                                    <option value="{{ $pm->id }}">{{ $indent }}{{ $levelTag }}{{ $pm->name }} ({{ ucfirst($pm->category ?? 'General') }})</option>
                                @endforeach
                            </select>
                            <div class="text-muted fs-8 mt-1">Pilih menu induk jika ini adalah <b>Sub Menu</b>. Kosongkan jika <b>Menu Utama</b>.</div>
                        </div>
                    </div>
                    <!--end::Category & Parent-->

                    <!--begin::Icon & Paths-->
                    <div class="row g-6 mb-5">
                        <div class="col-md-8 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Icon Class (Keenicons)</label>
                            <input type="text" class="form-control form-control-solid" id="add_single_icon" placeholder="Contoh: ki-duotone ki-element-11 fs-2" name="icon" />
                        </div>

                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Paths Icon</label>
                            <input type="number" class="form-control form-control-solid" id="add_single_paths" placeholder="1-5" name="paths" min="0" max="10" value="0" />
                        </div>
                    </div>
                    <!--end::Icon & Paths-->

                    <!--begin::Order & Status-->
                    <div class="row g-6 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Urutan (Order)</label>
                            <input type="number" class="form-control form-control-solid" id="add_single_orders" name="orders" value="0" />
                        </div>

                        <div class="col-md-6 fv-row d-flex align-items-center mt-8">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="active" value="1" id="add_single_active" checked />
                                <label class="form-check-label fw-semibold text-gray-700 ms-3" for="add_single_active">Status Menu Aktif</label>
                            </div>
                        </div>
                    </div>
                    <!--end::Order & Status-->

                    <!--begin::CRUD Permissions-->
                    <div class="d-flex flex-column mb-5">
                        <label class="fs-6 fw-semibold mb-2">Permissions Akses (CRUD)</label>
                        <div class="d-flex flex-wrap gap-4 p-3 bg-light rounded border">
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="create" id="perm_add_create" />
                                <label class="form-check-label fs-7 fw-semibold text-success" for="perm_add_create">Create</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="read" id="perm_add_read" checked />
                                <label class="form-check-label fs-7 fw-semibold text-primary" for="perm_add_read">Read</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="update" id="perm_add_update" />
                                <label class="form-check-label fs-7 fw-semibold text-warning" for="perm_add_update">Update</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="delete" id="perm_add_delete" />
                                <label class="form-check-label fs-7 fw-semibold text-danger" for="perm_add_delete">Delete</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="sort" id="perm_add_sort" />
                                <label class="form-check-label fs-7 fw-semibold text-dark" for="perm_add_sort">Sort</label>
                            </div>
                        </div>
                    </div>
                    <!--end::CRUD Permissions-->

                    <!--begin::Roles Assignment-->
                    <div class="d-flex flex-column">
                        <label class="fs-6 fw-semibold mb-2">Roles Akses</label>
                        <div class="d-flex flex-wrap gap-4 p-3 bg-light rounded border">
                            @foreach($roles as $role)
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role }}" id="role_add_{{ $role }}" {{ in_array($role, ['admin', 'master']) ? 'checked' : '' }} />
                                    <label class="form-check-label fs-7 fw-semibold text-gray-700" for="role_add_{{ $role }}">{{ ucfirst($role) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--end::Roles Assignment-->
                </div>

                <div class="modal-footer flex-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan Menu</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Add Single Menu-->

<!--begin::Modal - Add Complete Menu (Builder Level 1 -> 2 -> 3)-->
<div class="modal fade" id="kt_modal_add_menu_complete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content">
            <form class="form" action="{{ route('appsupport.menu.store') }}" method="POST" id="kt_modal_add_menu_complete_form">
                @csrf
                <div class="modal-header" id="kt_modal_add_menu_complete_header">
                    <div>
                        <h2 class="fw-bold mb-1">Tambah Menu Komplit (Hirarki Baru)</h2>
                        <span class="text-muted fs-7">Buat Menu Utama baru beserta seluruh Sub Menu (Level 2) & Anak Sub Menu (Level 3) sekaligus.</span>
                    </div>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body py-8 px-lg-12">
                    <!--begin::Section Level 1 (Menu Utama)-->
                    <div class="card card-bordered mb-8 shadow-none border-gray-300">
                        <div class="card-header bg-light-primary min-h-50px py-2 px-6">
                            <div class="card-title m-0">
                                <span class="badge badge-primary fw-bold me-2">Level 1</span>
                                <h4 class="fw-bold text-gray-900 m-0">Data Menu Utama Baru</h4>
                            </div>
                        </div>
                        <div class="card-body p-6">
                            <div class="row g-6 mb-5">
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">Nama Menu Utama (Bahasa Indonesia)</label>
                                    <input type="text" class="form-control form-control-solid" id="builder_name" placeholder="Contoh: Dukungan Aplikasi" name="name" required />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Title (English / Bahasa Inggris)</label>
                                    <input type="text" class="form-control form-control-solid" id="builder_title_en" placeholder="Contoh: App Support" name="title_en" />
                                </div>
                            </div>

                            <div class="row g-6 mb-5">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Translation Key (title_key)</label>
                                    <input type="text" class="form-control form-control-solid" id="builder_title_key" placeholder="Contoh: md_app_support" name="title_key" />
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="required fs-6 fw-semibold mb-2">URL / Route Key</label>
                                    <input type="text" class="form-control form-control-solid" id="builder_url" placeholder="Contoh: appsupport" name="url" required />
                                </div>
                            </div>

                            <div class="row g-6 mb-5">
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Kategori</label>
                                    <input type="text" class="form-control form-control-solid" id="builder_category" placeholder="Contoh: masterdata, apps" name="category" list="category-suggestions" />
                                </div>
                                <div class="col-md-5 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Icon Class (Keenicons)</label>
                                    <input type="text" class="form-control form-control-solid" id="builder_icon" placeholder="Contoh: ki-duotone ki-abstract-28 fs-2" name="icon" />
                                </div>
                                <div class="col-md-3 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Paths Icon</label>
                                    <input type="number" class="form-control form-control-solid" id="builder_paths" placeholder="1-5" name="paths" min="0" max="10" value="0" />
                                </div>
                            </div>

                            <div class="row g-6 mb-5">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Urutan (Order)</label>
                                    <input type="number" class="form-control form-control-solid" id="builder_orders" name="orders" value="0" />
                                </div>
                                <div class="col-md-6 fv-row d-flex align-items-center mt-8">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="active" value="1" id="builder_active" checked />
                                        <label class="form-check-label fw-semibold text-gray-700 ms-3" for="builder_active">Status Menu Aktif</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column mb-5">
                                <label class="fs-6 fw-semibold mb-2">Permissions Akses (Level 1)</label>
                                <div class="d-flex flex-wrap gap-4 p-3 bg-light rounded border">
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="create" />
                                        <label class="form-check-label fs-7 fw-semibold text-success">Create</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="read" checked />
                                        <label class="form-check-label fs-7 fw-semibold text-primary">Read</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="update" />
                                        <label class="form-check-label fs-7 fw-semibold text-warning">Update</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="delete" />
                                        <label class="form-check-label fs-7 fw-semibold text-danger">Delete</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="sort" />
                                        <label class="form-check-label fs-7 fw-semibold text-dark">Sort</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column">
                                <label class="fs-6 fw-semibold mb-2">Roles Akses</label>
                                <div class="d-flex flex-wrap gap-4 p-3 bg-light rounded border">
                                    @foreach($roles as $role)
                                        <div class="form-check form-check-custom form-check-solid form-check-sm">
                                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role }}" {{ in_array($role, ['admin', 'master']) ? 'checked' : '' }} />
                                            <label class="form-check-label fs-7 fw-semibold text-gray-700">{{ ucfirst($role) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Section Level 1-->

                    <!--begin::Section Level 2 (Sub Menus Builder)-->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge badge-light-success fw-bold">Level 2 & Level 3</span>
                            <h4 class="fw-bold text-gray-900 m-0">Daftar Sub Menu (Opsional)</h4>
                        </div>
                        <button type="button" class="btn btn-sm btn-light-success" id="btn_add_sub_menu_item">
                            <i class="ki-duotone ki-plus fs-3"></i> Tambah Sub Menu (Level 2)
                        </button>
                    </div>

                    <div id="sub_menus_builder_container" class="d-flex flex-column gap-4">
                        <!-- Sub menu items will be appended dynamically here -->
                    </div>
                    <!--end::Section Level 2-->
                </div>

                <div class="modal-footer flex-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label"><i class="ki-duotone ki-check fs-2 me-1"></i> Simpan Menu Komplit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Add Complete Menu-->

<!--begin::Modal - Edit Single Menu-->
<div class="modal fade" id="kt_modal_edit_menu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">
            <form class="form" method="POST" id="kt_modal_edit_menu_form">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h2 class="fw-bold">Edit Menu</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body py-8 px-lg-12">
                    <div class="row g-6 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Nama Menu (Bahasa Indonesia)</label>
                            <input type="text" class="form-control form-control-solid" id="edit_name" name="name" required />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Title (English / Bahasa Inggris)</label>
                            <input type="text" class="form-control form-control-solid" id="edit_title_en" name="title_en" />
                        </div>
                    </div>

                    <div class="row g-6 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Translation Key (title_key)</label>
                            <input type="text" class="form-control form-control-solid" id="edit_title_key" name="title_key" />
                            <div class="text-muted fs-8 mt-1">Kunci untuk multi bahasa (<code>lang/id/menu.php</code> & <code>lang/en/menu.php</code>).</div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">URL / Route Key</label>
                            <input type="text" class="form-control form-control-solid" id="edit_url" name="url" required />
                        </div>
                    </div>

                    <div class="row g-6 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Kategori</label>
                            <input type="text" class="form-control form-control-solid" id="edit_category" name="category" list="category-suggestions" />
                        </div>

                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Parent Menu (Induk Menu)</label>
                            <select name="main_menu_id" id="edit_main_menu_id" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_edit_menu">
                                <option value="">-- Menu Utama / Root (Level 1) --</option>
                                @foreach($parentOptions as $pm)
                                    @php
                                        $depth = $pm->depth ?? 0;
                                        $indent = str_repeat('— ', $depth);
                                        $levelTag = '[Lvl ' . ($depth + 1) . '] ';
                                    @endphp
                                    <option value="{{ $pm->id }}">{{ $indent }}{{ $levelTag }}{{ $pm->name }} ({{ ucfirst($pm->category ?? 'General') }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-6 mb-5">
                        <div class="col-md-8 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Icon Class (Keenicons)</label>
                            <input type="text" class="form-control form-control-solid" id="edit_icon" name="icon" />
                        </div>

                        <div class="col-md-4 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Paths Icon</label>
                            <input type="number" class="form-control form-control-solid" id="edit_paths" name="paths" min="0" max="10" />
                        </div>
                    </div>

                    <div class="row g-6 mb-5">
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Urutan (Order)</label>
                            <input type="number" class="form-control form-control-solid" id="edit_orders" name="orders" />
                        </div>

                        <div class="col-md-6 fv-row d-flex align-items-center mt-8">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="active" value="1" id="edit_active" />
                                <label class="form-check-label fw-semibold text-gray-700 ms-3" for="edit_active">Status Menu Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-5">
                        <label class="fs-6 fw-semibold mb-2">Permissions Akses (CRUD)</label>
                        <div class="d-flex flex-wrap gap-4 p-3 bg-light rounded border">
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input perm-edit-checkbox" type="checkbox" name="permissions[]" value="create" id="perm_edit_create" />
                                <label class="form-check-label fs-7 fw-semibold text-success" for="perm_edit_create">Create</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input perm-edit-checkbox" type="checkbox" name="permissions[]" value="read" id="perm_edit_read" />
                                <label class="form-check-label fs-7 fw-semibold text-primary" for="perm_edit_read">Read</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input perm-edit-checkbox" type="checkbox" name="permissions[]" value="update" id="perm_edit_update" />
                                <label class="form-check-label fs-7 fw-semibold text-warning" for="perm_edit_update">Update</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input perm-edit-checkbox" type="checkbox" name="permissions[]" value="delete" id="perm_edit_delete" />
                                <label class="form-check-label fs-7 fw-semibold text-danger" for="perm_edit_delete">Delete</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input perm-edit-checkbox" type="checkbox" name="permissions[]" value="sort" id="perm_edit_sort" />
                                <label class="form-check-label fs-7 fw-semibold text-dark" for="perm_edit_sort">Sort</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column">
                        <label class="fs-6 fw-semibold mb-2">Roles Akses</label>
                        <div class="d-flex flex-wrap gap-4 p-3 bg-light rounded border">
                            @foreach($roles as $role)
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input role-edit-checkbox" type="checkbox" name="roles[]" value="{{ $role }}" id="role_edit_{{ $role }}" />
                                    <label class="form-check-label fs-7 fw-semibold text-gray-700" for="role_edit_{{ $role }}">{{ ucfirst($role) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Perbarui Menu</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Edit Single Menu-->
