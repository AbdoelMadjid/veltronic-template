@extends('layouts.index')

@section('styles')
    <style>
        .menu-depth-0 { font-weight: 600; color: var(--bs-gray-900); }
        .menu-depth-1 { padding-left: 1.75rem !important; }
        .menu-depth-2 { padding-left: 3.5rem !important; }
        .menu-depth-3 { padding-left: 5.25rem !important; }
        .tree-line {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-left: 2px solid var(--bs-gray-300);
            border-bottom: 2px solid var(--bs-gray-300);
            margin-right: 6px;
            vertical-align: middle;
        }
    </style>
@endsection

@section('title', 'Menu')

@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            {{ __('menu.md_app_support') !== 'menu.md_app_support' ? __('menu.md_app_support') : 'App Support' }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center p-5 mb-5">
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-success">Berhasil</h4>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center p-5 mb-5">
                    <i class="ki-duotone ki-cross-circle fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-danger">Terjadi Kesalahan</h4>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif

            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" id="menu-search-input" class="form-control form-control-solid w-250px ps-12" placeholder="Cari nama, URL, key..." value="{{ $search ?? '' }}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-3">
                        <!--begin::Category Filter-->
                        <div class="w-100 mw-175px">
                            <select id="category-filter-select" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Filter Kategori">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ ($categoryFilter ?? '') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Category Filter-->

                        <!--begin::Add Single Button-->
                        <button type="button" class="btn btn-light-primary btn-add-single-menu" data-bs-toggle="modal" data-bs-target="#kt_modal_add_menu">
                            <i class="ki-duotone ki-plus fs-2"></i>Tambah Menu
                        </button>
                        <!--end::Add Single Button-->

                        <!--begin::Add Complete Button-->
                        <button type="button" class="btn btn-primary btn-add-complete-menu" data-bs-toggle="modal" data-bs-target="#kt_modal_add_menu_complete">
                            <i class="ki-duotone ki-element-plus fs-2"></i>Tambah Menu Komplit
                        </button>
                        <!--end::Add Complete Button-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-4" id="kt_table_menus">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-220px">Nama Menu & Terjemahan</th>
                                    <th class="min-w-160px">URL / Route</th>
                                    <th class="min-w-100px">Kategori</th>
                                    <th class="min-w-160px">Permissions & Roles</th>
                                    <th class="min-w-70px text-center">Urutan</th>
                                    <th class="min-w-70px text-center">Status</th>
                                    <th class="text-end min-w-120px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @forelse($menus as $menu)
                                    @php
                                        $currentDepth = $menu->depth ?? 0;
                                        $currentLevel = $currentDepth + 1;
                                    @endphp
                                    <tr data-category="{{ strtolower($menu->category ?? '') }}" class="menu-row">
                                        <!--begin::Name & Tree-->
                                        <td class="menu-depth-{{ min($currentDepth, 3) }}">
                                            <div class="d-flex align-items-center">
                                                @if($currentDepth > 0)
                                                    <span class="tree-line"></span>
                                                @endif

                                                @if(!empty($menu->icon))
                                                    <div class="symbol symbol-30px me-3">
                                                        <span class="symbol-label bg-light-primary">
                                                            <i class="{{ $menu->icon }} text-primary">
                                                                @for($p = 1; $p <= ($menu->paths ?? 0); $p++)
                                                                    <span class="path{{ $p }}"></span>
                                                                @endfor
                                                            </i>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-30px me-3">
                                                        <span class="symbol-label bg-light">
                                                            <i class="ki-duotone ki-abstract-26 fs-4 text-gray-600">
                                                                <span class="path1"></span><span class="path2"></span>
                                                            </i>
                                                        </span>
                                                    </div>
                                                @endif

                                                <div class="d-flex flex-column">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge badge-light fw-bold fs-8">Lvl {{ $currentLevel }}</span>
                                                        <span class="text-gray-900 fw-bold text-hover-primary fs-6">{{ $menu->name }}</span>
                                                        @if(!empty($menu->title_en))
                                                            <span class="text-muted fs-7 fst-italic">({{ $menu->title_en }})</span>
                                                        @endif
                                                    </div>
                                                    @if(!empty($menu->title_key))
                                                        <div class="mt-1">
                                                            <span class="badge badge-light-primary fs-8">key: {{ $menu->title_key }}</span>
                                                        </div>
                                                    @endif
                                                    @if($menu->main_menu_id)
                                                        <div class="mt-1">
                                                            <span class="text-muted fs-8">Parent: {{ $menu->parentMenu?->name ?? '#' . $menu->main_menu_id }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <!--end::Name & Tree-->

                                        <!--begin::URL-->
                                        <td>
                                            <code class="text-primary bg-light-primary px-2 py-1 rounded fs-7">{{ $menu->url }}</code>
                                        </td>
                                        <!--end::URL-->

                                        <!--begin::Category-->
                                        <td>
                                            @if($menu->category)
                                                <span class="badge badge-light-info fw-semibold fs-7">{{ ucfirst($menu->category) }}</span>
                                            @else
                                                <span class="text-muted fs-7">-</span>
                                            @endif
                                        </td>
                                        <!--end::Category-->

                                        <!--begin::Permissions & Roles-->
                                        <td>
                                            @if($menu->permissions->isNotEmpty())
                                                <div class="d-flex flex-wrap gap-1 mb-1">
                                                    @foreach($menu->permissions as $perm)
                                                        @php
                                                            $action = strtolower(trim(explode(' ', $perm->name)[0] ?? $perm->name));
                                                            $badgeClass = match($action) {
                                                                'create' => 'badge-light-success',
                                                                'read'   => 'badge-light-primary',
                                                                'update' => 'badge-light-warning',
                                                                'delete' => 'badge-light-danger',
                                                                'sort'   => 'badge-light-dark',
                                                                default  => 'badge-light-secondary',
                                                            };
                                                            $label = match($action) {
                                                                'create' => 'Create',
                                                                'read'   => 'Read',
                                                                'update' => 'Update',
                                                                'delete' => 'Delete',
                                                                'sort'   => 'Sort',
                                                                default  => ucfirst($action),
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $badgeClass }} fs-8 fw-semibold">{{ $label }}</span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted fs-8 d-block mb-1">Publik / Auth</span>
                                            @endif

                                            @if(!empty($menu->assigned_roles) && $menu->assigned_roles->isNotEmpty())
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach($menu->assigned_roles as $r)
                                                        <span class="badge badge-light-dark fs-8">{{ $r }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <!--end::Permissions & Roles-->

                                        <!--begin::Orders-->
                                        <td class="text-center">
                                            <span class="badge badge-light fw-bold fs-7">{{ $menu->orders ?? 0 }}</span>
                                        </td>
                                        <!--end::Orders-->

                                        <!--begin::Status-->
                                        <td class="text-center">
                                            @if($menu->active)
                                                <span class="badge badge-light-success fs-7">Aktif</span>
                                            @else
                                                <span class="badge badge-light-danger fs-7">Nonaktif</span>
                                            @endif
                                        </td>
                                        <!--end::Status-->

                                        <!--begin::Actions-->
                                        <td class="text-end text-nowrap">
                                            {{-- Tombol Tambah Sub Menu dari menu ini --}}
                                            @if($currentDepth < 2)
                                                @php
                                                    $nextLevel = $currentLevel + 1;
                                                    $addTooltip = "Tambah Sub Menu (Level {$nextLevel})";
                                                @endphp
                                                <button type="button" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1 btn-add-child-menu"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{ $addTooltip }}"
                                                    data-parent-id="{{ $menu->id }}"
                                                    data-parent-name="{{ $menu->name }}"
                                                    data-parent-category="{{ $menu->category ?? '' }}">
                                                    <i class="ki-duotone ki-plus fs-3"><span class="path1"></span><span class="path2"></span></i>
                                                </button>
                                            @endif

                                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit-menu"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Menu"
                                                data-id="{{ $menu->id }}"
                                                data-name="{{ $menu->name }}"
                                                data-title-en="{{ $menu->title_en ?? '' }}"
                                                data-title-key="{{ $menu->title_key ?? '' }}"
                                                data-url="{{ $menu->url }}"
                                                data-category="{{ $menu->category }}"
                                                data-icon="{{ $menu->icon }}"
                                                data-paths="{{ $menu->paths }}"
                                                data-orders="{{ $menu->orders }}"
                                                data-active="{{ $menu->active ? '1' : '0' }}"
                                                data-parent="{{ $menu->main_menu_id ?? '' }}"
                                                data-permissions="{{ json_encode($menu->permissions->pluck('name')->map(fn($p) => strtolower(explode(' ', $p)[0]))->toArray()) }}"
                                                data-roles="{{ json_encode($menu->assigned_roles->toArray()) }}">
                                                <i class="ki-duotone ki-pencil fs-4"><span class="path1"></span><span class="path2"></span></i>
                                            </button>

                                            <form action="{{ route('appsupport.menu.destroy', $menu->id) }}" method="POST" class="d-inline form-delete-menu">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btn-delete-trigger"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Hapus Menu">
                                                    <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span></i>
                                                </button>
                                            </form>
                                        </td>
                                        <!--end::Actions-->
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-10 text-muted">
                                            <i class="ki-duotone ki-information-5 fs-3x text-muted mb-3 d-block"><span class="path1"></span><span class="path2"></span></i>
                                            Belum ada data menu. Silakan klik tombol "Tambah Menu" untuk membuat menu baru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

        </div>
    </div>

    <!--begin::Modals-->
    @include('pages.appsupport.partials.menu-form-modal')
    <!--end::Modals-->
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Live Search & Filter
            const searchInput = document.getElementById('menu-search-input');
            const categorySelect = document.getElementById('category-filter-select');
            const tableRows = document.querySelectorAll('#kt_table_menus tbody tr.menu-row');

            function filterRows() {
                const searchVal = (searchInput.value || '').toLowerCase();
                const categoryVal = (categorySelect.value || '').toLowerCase();

                tableRows.forEach(row => {
                    const rowText = row.innerText.toLowerCase();
                    const rowCategory = (row.getAttribute('data-category') || '').toLowerCase();

                    const matchesSearch = !searchVal || rowText.includes(searchVal);
                    const matchesCategory = !categoryVal || rowCategory === categoryVal;

                    if (matchesSearch && matchesCategory) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterRows);
            }
            if (categorySelect) {
                categorySelect.addEventListener('change', filterRows);
            }

            // Inisialisasi Tooltip Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // ========================================================
            // 1. TAMBAH SINGLE MENU / TAMBAH SUB MENU DARI MENU YANG ADA
            // ========================================================
            const addSingleModalEl = document.getElementById('kt_modal_add_menu');
            const addSingleForm = document.getElementById('kt_modal_add_menu_form');
            const addSingleBtn = document.querySelector('.btn-add-single-menu');
            const addSingleParentSelect = document.getElementById('add_single_main_menu_id');
            const addSingleCategoryInput = document.getElementById('add_single_category');

            if (addSingleBtn) {
                addSingleBtn.addEventListener('click', function () {
                    addSingleForm.reset();
                    document.getElementById('add_single_modal_title').innerText = 'Tambah Menu Baru';
                    if (addSingleParentSelect) {
                        if (typeof $ !== 'undefined' && $(addSingleParentSelect).data('select2')) {
                            $(addSingleParentSelect).val('').trigger('change');
                        } else {
                            addSingleParentSelect.value = '';
                        }
                    }
                });
            }

            // Tombol Tambah Sub Menu (+) di Baris Tabel
            const addChildButtons = document.querySelectorAll('.btn-add-child-menu');
            addChildButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const parentId = this.getAttribute('data-parent-id');
                    const parentName = this.getAttribute('data-parent-name');
                    const parentCategory = this.getAttribute('data-parent-category') || '';

                    addSingleForm.reset();
                    document.getElementById('add_single_modal_title').innerText = `Tambah Sub Menu untuk: ${parentName}`;

                    if (addSingleCategoryInput && parentCategory) {
                        addSingleCategoryInput.value = parentCategory;
                    }

                    if (addSingleParentSelect) {
                        if (typeof $ !== 'undefined' && $(addSingleParentSelect).data('select2')) {
                            $(addSingleParentSelect).val(parentId).trigger('change');
                        } else {
                            addSingleParentSelect.value = parentId;
                        }
                    }

                    const modal = new bootstrap.Modal(addSingleModalEl);
                    modal.show();
                });
            });

            // ========================================================
            // 2. TAMBAH MENU KOMPLIT BUILDER (LEVEL 1 -> LEVEL 2 -> LEVEL 3)
            // ========================================================
            let subMenuCounter = 0;
            let subSubCounters = {};
            const subMenusContainer = document.getElementById('sub_menus_builder_container');
            const btnAddSubMenu = document.getElementById('btn_add_sub_menu_item');

            function createSubMenuItem(subIdx) {
                const subId = `submenu_card_${subIdx}`;
                return `
                    <div class="card card-bordered border-primary border-dashed p-5 bg-light-primary" id="${subId}">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-success fw-bold">Level 2</span>
                                <h5 class="fw-bold text-gray-900 m-0">Sub Menu #${subIdx + 1}</h5>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm btn-light-primary btn-add-sub-sub-menu" data-sub-idx="${subIdx}">
                                    <i class="ki-duotone ki-plus fs-4"></i> Tambah Anak Menu (Level 3)
                                </button>
                                <button type="button" class="btn btn-sm btn-icon btn-light-danger btn-remove-sub-menu" data-target="#${subId}">
                                    <i class="ki-duotone ki-trash fs-4"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="required fs-7 fw-semibold mb-1">Nama Sub Menu (Bahasa Indonesia)</label>
                                <input type="text" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][name]" placeholder="Contoh: Menu" required />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-7 fw-semibold mb-1">Title (English / Bahasa Inggris)</label>
                                <input type="text" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][title_en]" placeholder="Contoh: Menu" />
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="fs-7 fw-semibold mb-1">Translation Key (title_key)</label>
                                <input type="text" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][title_key]" placeholder="Contoh: md_menu" />
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-7 fw-semibold mb-1">URL / Route Key</label>
                                <input type="text" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][url]" placeholder="Contoh: appsupport/menu" required />
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="fs-7 fw-semibold mb-1">Icon Class (Keenicons)</label>
                                <input type="text" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][icon]" placeholder="Contoh: ki-duotone ki-element-11 fs-2" />
                            </div>
                            <div class="col-md-3">
                                <label class="fs-7 fw-semibold mb-1">Paths Icon</label>
                                <input type="number" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][paths]" value="0" min="0" max="10" />
                            </div>
                            <div class="col-md-3">
                                <label class="fs-7 fw-semibold mb-1">Urutan (Order)</label>
                                <input type="number" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][orders]" value="${subIdx + 1}" />
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-3">
                            <label class="fs-7 fw-semibold mb-1">Permissions Akses (Level 2)</label>
                            <div class="d-flex flex-wrap gap-3 p-2 bg-white rounded border">
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${subIdx}][permissions][]" value="create" id="sub_perm_create_${subIdx}" />
                                    <label class="form-check-label fs-8 text-success" for="sub_perm_create_${subIdx}">Create</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${subIdx}][permissions][]" value="read" id="sub_perm_read_${subIdx}" checked />
                                    <label class="form-check-label fs-8 text-primary" for="sub_perm_read_${subIdx}">Read</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${subIdx}][permissions][]" value="update" id="sub_perm_update_${subIdx}" />
                                    <label class="form-check-label fs-8 text-warning" for="sub_perm_update_${subIdx}">Update</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${subIdx}][permissions][]" value="delete" id="sub_perm_delete_${subIdx}" />
                                    <label class="form-check-label fs-8 text-danger" for="sub_perm_delete_${subIdx}">Delete</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${subIdx}][permissions][]" value="sort" id="sub_perm_sort_${subIdx}" />
                                    <label class="form-check-label fs-8 text-dark" for="sub_perm_sort_${subIdx}">Sort</label>
                                </div>
                            </div>
                        </div>

                        <!-- Container Level 3 (Anak Sub Menu) -->
                        <div id="sub_submenus_container_${subIdx}" class="d-flex flex-column gap-3 mt-3 ps-4 border-start border-3 border-primary">
                        </div>
                    </div>
                `;
            }

            function createSubSubMenuItem(subIdx, ssIdx) {
                const ssId = `sub_sub_menu_card_${subIdx}_${ssIdx}`;
                return `
                    <div class="card card-bordered p-4 bg-white border-dashed border-gray-400" id="${ssId}">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-light-warning fw-bold">Level 3</span>
                                <h6 class="fw-bold text-gray-800 m-0">Anak Sub Menu #${ssIdx + 1}</h6>
                            </div>
                            <button type="button" class="btn btn-sm btn-icon btn-light-danger btn-remove-sub-sub-menu" data-target="#${ssId}">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="required fs-8 fw-semibold mb-1">Nama Anak Menu (ID)</label>
                                <input type="text" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][name]" placeholder="Contoh: Detail Menu" required />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-8 fw-semibold mb-1">Title (EN)</label>
                                <input type="text" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][title_en]" placeholder="Contoh: Menu Detail" />
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="fs-8 fw-semibold mb-1">Translation Key</label>
                                <input type="text" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][title_key]" placeholder="Contoh: md_menu_detail" />
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-8 fw-semibold mb-1">URL / Route Key</label>
                                <input type="text" class="form-control form-control-sm form-control-solid" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][url]" placeholder="Contoh: appsupport/menu/detail" required />
                            </div>
                        </div>

                        <div class="d-flex flex-column">
                            <label class="fs-8 fw-semibold mb-1">Permissions CRUD (Level 3)</label>
                            <div class="d-flex flex-wrap gap-2 p-2 bg-light rounded border">
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][permissions][]" value="create" />
                                    <label class="form-check-label fs-8 text-success">Create</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][permissions][]" value="read" checked />
                                    <label class="form-check-label fs-8 text-primary">Read</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][permissions][]" value="update" />
                                    <label class="form-check-label fs-8 text-warning">Update</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][permissions][]" value="delete" />
                                    <label class="form-check-label fs-8 text-danger">Delete</label>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }

            if (btnAddSubMenu) {
                btnAddSubMenu.addEventListener('click', function () {
                    const html = createSubMenuItem(subMenuCounter);
                    subMenusContainer.insertAdjacentHTML('beforeend', html);
                    subMenuCounter++;
                });
            }

            if (subMenusContainer) {
                subMenusContainer.addEventListener('click', function (e) {
                    const btnAddLvl3 = e.target.closest('.btn-add-sub-sub-menu');
                    if (btnAddLvl3) {
                        const subIdx = parseInt(btnAddLvl3.getAttribute('data-sub-idx'), 10);
                        if (!subSubCounters[subIdx]) {
                            subSubCounters[subIdx] = 0;
                        }
                        const ssIdx = subSubCounters[subIdx];
                        const container = document.getElementById(`sub_submenus_container_${subIdx}`);
                        if (container) {
                            container.insertAdjacentHTML('beforeend', createSubSubMenuItem(subIdx, ssIdx));
                            subSubCounters[subIdx]++;
                        }
                    }

                    const btnRemoveLvl2 = e.target.closest('.btn-remove-sub-menu');
                    if (btnRemoveLvl2) {
                        const target = document.querySelector(btnRemoveLvl2.getAttribute('data-target'));
                        if (target) {
                            target.remove();
                        }
                    }

                    const btnRemoveLvl3 = e.target.closest('.btn-remove-sub-sub-menu');
                    if (btnRemoveLvl3) {
                        const target = document.querySelector(btnRemoveLvl3.getAttribute('data-target'));
                        if (target) {
                            target.remove();
                        }
                    }
                });
            }

            const completeAddBtn = document.querySelector('.btn-add-complete-menu');
            if (completeAddBtn) {
                completeAddBtn.addEventListener('click', function () {
                    const addForm = document.getElementById('kt_modal_add_menu_complete_form');
                    addForm.reset();
                    subMenusContainer.innerHTML = '';
                    subMenuCounter = 0;
                    subSubCounters = {};
                });
            }

            // ========================================================
            // 3. EDIT MODAL POPULATION
            // ========================================================
            const editModalEl = document.getElementById('kt_modal_edit_menu');
            const editForm = document.getElementById('kt_modal_edit_menu_form');
            const editButtons = document.querySelectorAll('.btn-edit-menu');

            editButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const titleEn = this.getAttribute('data-title-en') || '';
                    const titleKey = this.getAttribute('data-title-key') || '';
                    const url = this.getAttribute('data-url');
                    const category = this.getAttribute('data-category') || '';
                    const icon = this.getAttribute('data-icon') || '';
                    const paths = this.getAttribute('data-paths') || '0';
                    const orders = this.getAttribute('data-orders') || '0';
                    const active = this.getAttribute('data-active') === '1';
                    const parent = this.getAttribute('data-parent') || '';
                    const permissions = JSON.parse(this.getAttribute('data-permissions') || '[]');
                    const roles = JSON.parse(this.getAttribute('data-roles') || '[]');

                    editForm.action = `/appsupport/menu/${id}`;
                    document.getElementById('edit_name').value = name;
                    document.getElementById('edit_title_en').value = titleEn;
                    document.getElementById('edit_title_key').value = titleKey;
                    document.getElementById('edit_url').value = url;
                    document.getElementById('edit_category').value = category;
                    document.getElementById('edit_icon').value = icon;
                    document.getElementById('edit_paths').value = paths;
                    document.getElementById('edit_orders').value = orders;
                    document.getElementById('edit_active').checked = active;

                    const editParentSelect = document.getElementById('edit_main_menu_id');
                    if (editParentSelect) {
                        if (typeof $ !== 'undefined' && $(editParentSelect).data('select2')) {
                            $(editParentSelect).val(parent).trigger('change');
                        } else {
                            editParentSelect.value = parent;
                        }
                    }

                    document.querySelectorAll('.perm-edit-checkbox').forEach(cb => {
                        cb.checked = permissions.includes(cb.value.toLowerCase());
                    });

                    document.querySelectorAll('.role-edit-checkbox').forEach(cb => {
                        cb.checked = roles.includes(cb.value.toLowerCase());
                    });

                    const modal = new bootstrap.Modal(editModalEl);
                    modal.show();
                });
            });

            // Delete Confirmation
            document.querySelectorAll('.btn-delete-trigger').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = this.closest('form');

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Hapus Menu?',
                            text: "Menu dan relasi permission terkait akan dihapus.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                                cancelButton: 'btn btn-light'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    } else {
                        if (confirm('Yakin ingin menghapus menu ini?')) {
                            form.submit();
                        }
                    }
                });
            });
        });
    </script>
@endsection
