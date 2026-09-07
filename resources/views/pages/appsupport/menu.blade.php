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
        .btn-quick-icon {
            transition: all 0.2s ease;
        }
        .btn-quick-icon:hover {
            transform: translateY(-2px);
            background-color: var(--bs-primary-light);
        }
        .role-cb-label.active {
            background-color: var(--bs-primary-light) !important;
            border-color: var(--bs-primary) !important;
            color: var(--bs-primary) !important;
        }

        /* Drag & Drop Reordering Styles */
        .drag-handle {
            cursor: grab !important;
            user-select: none;
            transition: all 0.2s ease;
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .drag-handle:hover {
            background-color: var(--bs-primary-light) !important;
            color: var(--bs-primary) !important;
            transform: scale(1.1);
        }
        .drag-handle:active {
            cursor: grabbing !important;
        }
        .menu-row {
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }
        .menu-row.dragging {
            opacity: 0.45 !important;
            background-color: rgba(var(--bs-primary-rgb), 0.08) !important;
            outline: 2px dashed var(--bs-primary) !important;
        }
        .menu-row.drag-child-highlight {
            background-color: rgba(var(--bs-primary-rgb), 0.04) !important;
            opacity: 0.65 !important;
        }
        .menu-row.drag-over-top {
            border-top: 3px solid var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), 0.04) !important;
        }
        .menu-row.drag-over-bottom {
            border-bottom: 3px solid var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), 0.04) !important;
        }
        .menu-row.reorder-updated {
            animation: rowUpdatedFlash 1.2s ease-out;
        }
        @keyframes rowUpdatedFlash {
            0% { background-color: rgba(var(--bs-success-rgb), 0.28); }
            100% { background-color: transparent; }
        }
        #reorder-toast-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1090;
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
                <div class="alert alert-success d-flex align-items-center p-5 mb-5 shadow-sm border-0">
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-success fw-bold">Berhasil</h4>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center p-5 mb-5 shadow-sm border-0">
                    <i class="ki-duotone ki-cross-circle fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-danger fw-bold">Terjadi Kesalahan</h4>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif

            <!--begin::Card-->
            <div class="card card-flush shadow-sm">
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

                        <!--begin::Add Button (Seeder Pattern)-->
                        <button type="button" class="btn btn-primary btn-add-menu-modal" data-bs-toggle="modal" data-bs-target="#kt_modal_add_menu">
                            <i class="ki-duotone ki-element-plus fs-2 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            Tambah Menu
                        </button>
                        <!--end::Add Button-->
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
                                    <th class="min-w-260px">Nama Menu & Terjemahan</th>
                                    <th class="min-w-160px">URL / Route Name</th>
                                    <th class="min-w-100px">Kategori</th>
                                    <th class="min-w-160px">Permissions & Roles</th>
                                    <th class="min-w-70px text-center">Urutan</th>
                                    <th class="min-w-70px text-center">Status</th>
                                    <th class="text-end min-w-120px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600" id="menu_table_tbody">
                                @php
                                    $currentRootId = null;
                                @endphp
                                @forelse($menus as $menu)
                                    @php
                                        $currentDepth = $menu->depth ?? 0;
                                        $currentLevel = $currentDepth + 1;
                                        if ($currentDepth === 0) {
                                            $currentRootId = $menu->id;
                                        }
                                    @endphp
                                    <tr data-id="{{ $menu->id }}"
                                        data-parent-id="{{ $menu->main_menu_id ?? '' }}"
                                        data-root-id="{{ $currentRootId }}"
                                        data-depth="{{ $currentDepth }}"
                                        data-category="{{ strtolower($menu->category ?? '') }}"
                                        data-name="{{ $menu->name }}"
                                        data-orders="{{ $menu->orders ?? 0 }}"
                                        class="menu-row">
                                        <!--begin::Name & Tree-->
                                        <td class="menu-depth-{{ min($currentDepth, 3) }}">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Drag Handle-->
                                                <span class="drag-handle btn btn-icon btn-sm btn-light btn-active-light-primary me-2 cursor-move"
                                                      draggable="true"
                                                      title="Tahan & geser untuk mengubah urutan"
                                                      data-bs-toggle="tooltip"
                                                      data-bs-placement="top">
                                                    <i class="ki-duotone ki-abstract-14 fs-4 text-gray-500">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                                <!--end::Drag Handle-->

                                                @if($currentDepth > 0)
                                                    <span class="tree-line"></span>
                                                @endif

                                                @if(!empty($menu->icon))
                                                    <div class="symbol symbol-35px me-3">
                                                        <span class="symbol-label bg-light-primary">
                                                            <i class="{{ $menu->icon }} text-primary">
                                                                @for($p = 1; $p <= ($menu->paths ?? 0); $p++)
                                                                    <span class="path{{ $p }}"></span>
                                                                @endfor
                                                            </i>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-35px me-3">
                                                        <span class="symbol-label bg-light">
                                                            <i class="ki-duotone ki-abstract-26 fs-4 text-gray-600">
                                                                <span class="path1"></span><span class="path2"></span>
                                                            </i>
                                                        </span>
                                                    </div>
                                                @endif

                                                <div class="d-flex flex-column">
                                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                                        <span class="badge badge-light fw-bold fs-8">Lvl {{ $currentLevel }}</span>
                                                        <span class="text-gray-900 fw-bold fs-6">{{ $menu->name }}</span>
                                                        @if(!empty($menu->title_en))
                                                            <span class="text-muted fs-7 fst-italic">({{ $menu->title_en }})</span>
                                                        @endif
                                                        @if(!empty($menu->meta['badge']['label']))
                                                            <span class="{{ $menu->meta['badge']['class'] ?? 'badge badge-light-primary' }} fs-9">
                                                                {{ $menu->meta['badge']['label'] }}
                                                            </span>
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
                                            <code class="text-primary bg-light-primary px-2 py-1 rounded fs-7 fw-bold">{{ $menu->url }}</code>
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
                                            <span class="badge badge-light fw-bold fs-7 row-order-badge">{{ $menu->orders ?? 0 }}</span>
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
                                                    data-parent-category="{{ $menu->category ?? '' }}"
                                                    data-parent-url="{{ $menu->url }}">
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
                                                data-badge-label="{{ $menu->meta['badge']['label'] ?? '' }}"
                                                data-badge-class="{{ $menu->meta['badge']['class'] ?? 'badge badge-light-primary' }}"
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

            <!-- Floating Toast Container for Reorder Feedback -->
            <div id="reorder-toast-container"></div>

        </div>
    </div>

    <!--begin::Modals-->
    @include('pages.appsupport.partials.menu-form-modal')
    <!--end::Modals-->
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // ========================================================
            // KAMUS AUTO TRANSLASI & SLUG HELPER (SEF-TRANSLATE)
            // ========================================================
            const idToEnDict = {
                'aplikasi': 'Application',
                'dukungan': 'Support',
                'pengguna': 'User',
                'manajemen': 'Management',
                'laporan': 'Report',
                'pengaturan': 'Settings',
                'referensi': 'Reference',
                'profil': 'Profile',
                'data': 'Data',
                'fitur': 'Features',
                'tema': 'Theme',
                'halaman': 'Page',
                'depan': 'Front',
                'hak': 'Right',
                'akses': 'Access',
                'peran': 'Role',
                'izin': 'Permission',
                'masuk': 'Login',
                'keluar': 'Logout',
                'dasbor': 'Dashboard',
                'bantuan': 'Help',
                'panduan': 'Guide',
                'riwayat': 'History',
                'cadangan': 'Backup',
                'basis': 'Database',
                'sekolah': 'School',
                'guru': 'Teacher',
                'siswa': 'Student',
                'kelas': 'Class',
                'nilai': 'Grade',
                'jadwal': 'Schedule',
                'keuangan': 'Finance',
                'tagihan': 'Bill',
                'pembayaran': 'Payment',
                'identitas': 'Identity',
                'master': 'Master',
                'menu': 'Menu'
            };

            function autoTranslateIdToEn(text) {
                if (!text) return '';
                let words = text.trim().toLowerCase().split(/\s+/);
                let translated = words.map(w => {
                    let cleaned = w.replace(/[^a-z0-9]/g, '');
                    if (idToEnDict[cleaned]) {
                        return idToEnDict[cleaned];
                    }
                    return w.charAt(0).toUpperCase() + w.slice(1);
                });
                return translated.join(' ');
            }

            function slugify(text, separator = '_') {
                return (text || '')
                    .toString()
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/[\s-]+/g, separator);
            }

            function formatTitleKey(category, name) {
                let catLower = (category || '').toLowerCase();
                let prefix = 'custom_';
                if (catLower.includes('master') || catLower === 'masterdata') {
                    prefix = 'md_';
                } else if (catLower.includes('app') || catLower === 'apps') {
                    prefix = 'app_';
                } else if (catLower.includes('page')) {
                    prefix = 'page_';
                } else if (catLower.includes('help')) {
                    prefix = 'help_';
                } else if (catLower.includes('web')) {
                    prefix = 'web_';
                }
                return prefix + slugify(name, '_');
            }

            function formatUrlRoute(category, name, parentUrl = null) {
                let nameSlug = slugify(name, '-');
                if (parentUrl) {
                    let cleanParent = parentUrl.replace(/[\/\\]/g, '.').replace(/^\.+|\.+$/g, '');
                    return `${cleanParent}.${nameSlug}`;
                }
                let catSlug = slugify(category, '');
                if (catSlug) {
                    return `${catSlug}.${nameSlug}`;
                }
                return nameSlug;
            }

            function renderIconPreview(iconClass, paths, targetContainer) {
                if (!targetContainer) return;
                let numPaths = parseInt(paths) || 0;
                let pathSpans = '';
                for (let i = 1; i <= numPaths; i++) {
                    pathSpans += `<span class="path${i}"></span>`;
                }
                targetContainer.innerHTML = `<i class="${iconClass} fs-2 text-primary">${pathSpans}</i>`;
            }

            // ========================================================
            // FILTER & SEARCH TABEL
            // ========================================================
            const searchInput = document.getElementById('menu-search-input');
            const categorySelect = document.getElementById('category-filter-select');
            const tableRows = document.querySelectorAll('#kt_table_menus tbody tr.menu-row');

            function filterRows() {
                const searchVal = (searchInput?.value || '').toLowerCase();
                const categoryVal = (categorySelect?.value || '').toLowerCase();

                tableRows.forEach(row => {
                    const rowText = row.innerText.toLowerCase();
                    const rowCategory = (row.getAttribute('data-category') || '').toLowerCase();

                    const matchesSearch = !searchVal || rowText.includes(searchVal);
                    const matchesCategory = !categoryVal || rowCategory === categoryVal;

                    row.style.display = (matchesSearch && matchesCategory) ? '' : 'none';
                });
            }

            if (searchInput) searchInput.addEventListener('input', filterRows);
            if (categorySelect) categorySelect.addEventListener('change', filterRows);

            // Inisialisasi Tooltip Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(el => new bootstrap.Tooltip(el));

            // ========================================================
            // ROLE PILLS STYLING
            // ========================================================
            function syncRolePillLabels(container = document) {
                container.querySelectorAll('.role-cb, .edit-role-cb').forEach(cb => {
                    let label = cb.closest('label');
                    if (label) {
                        if (cb.checked) {
                            label.classList.add('active', 'bg-light-primary', 'border-primary', 'text-primary');
                        } else {
                            label.classList.remove('active', 'bg-light-primary', 'border-primary', 'text-primary');
                        }
                    }
                });
            }

            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('role-cb') || e.target.classList.contains('edit-role-cb')) {
                    syncRolePillLabels();
                    updatePhpPreview();
                }
            });
            syncRolePillLabels();

            // ========================================================
            // PERMISSION PRESETS (CRUD, READ ONLY, MANAGE)
            // ========================================================
            document.addEventListener('click', function(e) {
                let btn = e.target.closest('.btn-perm-preset, .btn-edit-perm-preset');
                if (!btn) return;
                
                let preset = btn.getAttribute('data-preset');
                let scope = btn.closest('.rounded');
                if (!scope) return;

                let cbs = {
                    create: scope.querySelector('input[value="create"]'),
                    read: scope.querySelector('input[value="read"]'),
                    update: scope.querySelector('input[value="update"]'),
                    delete: scope.querySelector('input[value="delete"]'),
                    sort: scope.querySelector('input[value="sort"]')
                };

                if (preset === 'crud') {
                    if (cbs.create) cbs.create.checked = true;
                    if (cbs.read) cbs.read.checked = true;
                    if (cbs.update) cbs.update.checked = true;
                    if (cbs.delete) cbs.delete.checked = true;
                    if (cbs.sort) cbs.sort.checked = true;
                } else if (preset === 'read') {
                    if (cbs.create) cbs.create.checked = false;
                    if (cbs.read) cbs.read.checked = true;
                    if (cbs.update) cbs.update.checked = false;
                    if (cbs.delete) cbs.delete.checked = false;
                    if (cbs.sort) cbs.sort.checked = false;
                } else if (preset === 'manage') {
                    if (cbs.create) cbs.create.checked = true;
                    if (cbs.read) cbs.read.checked = true;
                    if (cbs.update) cbs.update.checked = true;
                    if (cbs.delete) cbs.delete.checked = false;
                    if (cbs.sort) cbs.sort.checked = true;
                }

                updatePhpPreview();
            });

            // ========================================================
            // QUICK ICON PICKER SHORTCUTS
            // ========================================================
            document.addEventListener('click', function(e) {
                let btn = e.target.closest('.btn-quick-icon');
                if (!btn) return;

                let iconClass = btn.getAttribute('data-icon');
                let paths = btn.getAttribute('data-paths');

                let card = btn.closest('.card, .card-body, .modal-body') || document;
                let iconInput = card.querySelector('#main_icon') || card.querySelector('.sub-icon-input');
                let pathsInput = card.querySelector('#main_paths') || card.querySelector('.sub-paths-input');
                let previewBox = card.querySelector('#main_icon_preview_box') || card.querySelector('.sub-icon-preview');

                if (iconInput) iconInput.value = iconClass;
                if (pathsInput) pathsInput.value = paths;
                if (previewBox) renderIconPreview(iconClass, paths, previewBox);

                updatePhpPreview();
            });

            // ========================================================
            // MODAL ADD MENU: MODE SELECTOR (SINGLE VS HIERARCHY)
            // ========================================================
            const modeSingleRadio = document.getElementById('mode_single');
            const modeHierarchyRadio = document.getElementById('mode_hierarchy');
            const parentSelectContainer = document.getElementById('parent_select_container');
            const hierarchyCategoryContainer = document.getElementById('hierarchy_category_container');
            const hierarchySubmenusSection = document.getElementById('hierarchy_submenus_section');
            const levelBadgeText = document.getElementById('level_badge_text');
            const levelTitleText = document.getElementById('level_title_text');

            function applyBuilderMode() {
                const isHierarchy = modeHierarchyRadio?.checked;

                if (isHierarchy) {
                    if (parentSelectContainer) parentSelectContainer.classList.add('d-none');
                    if (hierarchyCategoryContainer) hierarchyCategoryContainer.classList.remove('d-none');
                    if (hierarchySubmenusSection) hierarchySubmenusSection.classList.remove('d-none');
                    if (levelBadgeText) levelBadgeText.innerText = 'Level 1';
                    if (levelTitleText) levelTitleText.innerText = 'Menu Utama Baru (Parent Root)';
                } else {
                    if (parentSelectContainer) parentSelectContainer.classList.remove('d-none');
                    if (hierarchyCategoryContainer) hierarchyCategoryContainer.classList.add('d-none');
                    if (hierarchySubmenusSection) hierarchySubmenusSection.classList.add('d-none');
                    if (levelBadgeText) levelBadgeText.innerText = 'Single';
                    if (levelTitleText) levelTitleText.innerText = 'Informasi Menu';
                }

                updatePhpPreview();
            }

            if (modeSingleRadio) modeSingleRadio.addEventListener('change', applyBuilderMode);
            if (modeHierarchyRadio) modeHierarchyRadio.addEventListener('change', applyBuilderMode);

            // ========================================================
            // REAL-TIME AUTO GENERATOR (NAMA ID -> EN, KEY, URL)
            // ========================================================
            const mainNameInput = document.getElementById('main_name');
            const mainTitleEnInput = document.getElementById('main_title_en');
            const mainTitleKeyInput = document.getElementById('main_title_key');
            const mainUrlInput = document.getElementById('main_url');
            const mainCategoryInput = document.getElementById('main_category');
            const mainParentSelect = document.getElementById('main_parent_id');
            const mainIconInput = document.getElementById('main_icon');
            const mainPathsInput = document.getElementById('main_paths');
            const mainIconPreviewBox = document.getElementById('main_icon_preview_box');

            let userEditedTitleEn = false;
            let userEditedTitleKey = false;
            let userEditedUrl = false;

            if (mainTitleEnInput) mainTitleEnInput.addEventListener('input', () => userEditedTitleEn = true);
            if (mainTitleKeyInput) mainTitleKeyInput.addEventListener('input', () => userEditedTitleKey = true);
            if (mainUrlInput) mainUrlInput.addEventListener('input', () => userEditedUrl = true);

            function handleMainNameChange() {
                let nameVal = mainNameInput.value;
                let categoryVal = mainCategoryInput.value || 'Master Data';
                
                let selectedParentOpt = mainParentSelect ? mainParentSelect.options[mainParentSelect.selectedIndex] : null;
                let parentUrl = (selectedParentOpt && selectedParentOpt.value) ? selectedParentOpt.getAttribute('data-url') : null;

                if (!userEditedTitleEn && mainTitleEnInput) {
                    mainTitleEnInput.value = autoTranslateIdToEn(nameVal);
                }

                if (!userEditedTitleKey && mainTitleKeyInput) {
                    mainTitleKeyInput.value = formatTitleKey(categoryVal, nameVal);
                }

                if (!userEditedUrl && mainUrlInput) {
                    mainUrlInput.value = formatUrlRoute(categoryVal, nameVal, parentUrl);
                }

                updatePhpPreview();
            }

            if (mainNameInput) mainNameInput.addEventListener('input', handleMainNameChange);

            if (mainCategoryInput) {
                mainCategoryInput.addEventListener('input', function() {
                    if (!userEditedTitleKey && mainTitleKeyInput) {
                        mainTitleKeyInput.value = formatTitleKey(this.value, mainNameInput.value);
                    }
                    if (!userEditedUrl && mainUrlInput) {
                        let selectedParentOpt = mainParentSelect ? mainParentSelect.options[mainParentSelect.selectedIndex] : null;
                        let parentUrl = (selectedParentOpt && selectedParentOpt.value) ? selectedParentOpt.getAttribute('data-url') : null;
                        mainUrlInput.value = formatUrlRoute(this.value, mainNameInput.value, parentUrl);
                    }
                    updatePhpPreview();
                });
            }

            if (mainParentSelect) {
                $(mainParentSelect).on('change', function() {
                    let selectedParentOpt = this.options[this.selectedIndex];
                    let parentCategory = selectedParentOpt?.getAttribute('data-category');
                    let parentUrl = selectedParentOpt?.getAttribute('data-url');

                    if (parentCategory && mainCategoryInput) {
                        mainCategoryInput.value = parentCategory;
                    }

                    if (!userEditedUrl && mainUrlInput) {
                        mainUrlInput.value = formatUrlRoute(mainCategoryInput.value, mainNameInput.value, parentUrl);
                    }

                    updatePhpPreview();
                });
            }

            // Tombol Generate Ulang Key & URL
            const btnRegenKey = document.getElementById('btn_regen_key');
            if (btnRegenKey) {
                btnRegenKey.addEventListener('click', function() {
                    userEditedTitleKey = false;
                    mainTitleKeyInput.value = formatTitleKey(mainCategoryInput.value, mainNameInput.value);
                    updatePhpPreview();
                });
            }

            const btnRegenUrl = document.getElementById('btn_regen_url');
            if (btnRegenUrl) {
                btnRegenUrl.addEventListener('click', function() {
                    userEditedUrl = false;
                    let selectedParentOpt = mainParentSelect ? mainParentSelect.options[mainParentSelect.selectedIndex] : null;
                    let parentUrl = (selectedParentOpt && selectedParentOpt.value) ? selectedParentOpt.getAttribute('data-url') : null;
                    mainUrlInput.value = formatUrlRoute(mainCategoryInput.value, mainNameInput.value, parentUrl);
                    updatePhpPreview();
                });
            }

            // Real-time Icon Preview
            if (mainIconInput) {
                mainIconInput.addEventListener('input', function() {
                    renderIconPreview(this.value, mainPathsInput?.value || 0, mainIconPreviewBox);
                    updatePhpPreview();
                });
            }
            if (mainPathsInput) {
                mainPathsInput.addEventListener('input', function() {
                    renderIconPreview(mainIconInput?.value || '', this.value, mainIconPreviewBox);
                    updatePhpPreview();
                });
            }

            // ========================================================
            // DYNAMIC SUB MENU BUILDER (LEVEL 2 & LEVEL 3)
            // ========================================================
            let subMenuIndex = 0;
            const dynamicSubmenusContainer = document.getElementById('dynamic_submenus_container');
            const btnAddDynamicSubmenu = document.getElementById('btn_add_dynamic_submenu');

            function createSubMenuCard(idx) {
                let parentUrl = mainUrlInput?.value || 'app';
                let defaultUrl = `${parentUrl}.sub-menu-${idx + 1}`;

                return `
                    <div class="card card-bordered border-primary border-dashed shadow-none p-5 bg-light-primary rounded-3 sub-menu-card" id="submenu_card_${idx}" data-sub-idx="${idx}">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-success fw-bold px-2 py-1">Level 2</span>
                                <h6 class="fw-bold text-gray-900 m-0">Sub Menu #${idx + 1}</h6>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-xs btn-light-primary btn-add-subchild" data-sub-idx="${idx}">
                                    <i class="ki-duotone ki-plus fs-5"></i> Tambah Level 3
                                </button>
                                <button type="button" class="btn btn-xs btn-icon btn-light-danger btn-remove-submenu" data-target="#submenu_card_${idx}">
                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                            </div>
                        </div>

                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <label class="fs-8 fw-bold text-gray-700 mb-1">Nama Sub Menu (ID)</label>
                                <input type="text" class="form-control form-control-solid form-control-sm sub-name-input" name="sub_menus[${idx}][name]" placeholder="Contoh: Menu" required />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-8 fw-bold text-gray-700 mb-1">Title (EN)</label>
                                <input type="text" class="form-control form-control-solid form-control-sm sub-title-en-input" name="sub_menus[${idx}][title_en]" placeholder="Contoh: Menu" />
                            </div>
                        </div>

                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <label class="fs-8 fw-bold text-gray-700 mb-1">Translation Key</label>
                                <input type="text" class="form-control form-control-solid form-control-sm sub-title-key-input" name="sub_menus[${idx}][title_key]" placeholder="md_menu" />
                            </div>
                            <div class="col-md-6">
                                <label class="fs-8 fw-bold text-gray-700 mb-1">URL / Route Name</label>
                                <input type="text" class="form-control form-control-solid form-control-sm sub-url-input" name="sub_menus[${idx}][url]" value="${defaultUrl}" required />
                            </div>
                        </div>

                        <!-- Hak Akses Sub Menu -->
                        <div class="rounded border p-3 bg-white mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fs-8 fw-bold text-gray-700">Akses CRUD Level 2</span>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-xs btn-light-success py-0 px-2 btn-perm-preset" data-preset="crud">⚡ Full</button>
                                    <button type="button" class="btn btn-xs btn-light-primary py-0 px-2 btn-perm-preset" data-preset="read">👁️ Read</button>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${idx}][permissions][]" value="create" />
                                    <label class="form-check-label fs-9 fw-semibold text-success">Create</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${idx}][permissions][]" value="read" checked />
                                    <label class="form-check-label fs-9 fw-semibold text-primary">Read</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${idx}][permissions][]" value="update" />
                                    <label class="form-check-label fs-9 fw-semibold text-warning">Update</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${idx}][permissions][]" value="delete" />
                                    <label class="form-check-label fs-9 fw-semibold text-danger">Delete</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" name="sub_menus[${idx}][permissions][]" value="sort" />
                                    <label class="form-check-label fs-9 fw-semibold text-dark">Sort</label>
                                </div>
                            </div>
                        </div>

                        <!-- Sub-Sub Menus (Level 3 Container) -->
                        <div class="sub-sub-menus-container d-flex flex-column gap-2 mt-3" id="sub_sub_container_${idx}">
                            <!-- Level 3 cards here -->
                        </div>
                    </div>
                `;
            }

            function createSubSubMenuCard(subIdx, ssIdx) {
                let subUrlInput = document.querySelector(`#submenu_card_${subIdx} .sub-url-input`);
                let parentUrl = subUrlInput?.value || 'app.sub';
                let defaultUrl = `${parentUrl}.child-${ssIdx + 1}`;

                return `
                    <div class="card card-bordered border-success border-dashed p-3 bg-light-success rounded-2 sub-sub-menu-card" id="ss_card_${subIdx}_${ssIdx}">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-info fw-bold fs-9">Level 3</span>
                                <span class="fw-bold fs-8 text-gray-800">Child Menu #${ssIdx + 1}</span>
                            </div>
                            <button type="button" class="btn btn-xs btn-icon btn-light-danger btn-remove-sub-sub" data-target="#ss_card_${subIdx}_${ssIdx}">
                                <i class="ki-duotone ki-trash fs-6"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-solid form-control-sm fs-8 ss-name-input" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][name]" placeholder="Nama Level 3" required />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-solid form-control-sm fs-8 ss-url-input" name="sub_menus[${subIdx}][sub_sub_menus][${ssIdx}][url]" value="${defaultUrl}" required />
                            </div>
                        </div>
                    </div>
                `;
            }

            if (btnAddDynamicSubmenu) {
                btnAddDynamicSubmenu.addEventListener('click', function() {
                    let html = createSubMenuCard(subMenuIndex);
                    dynamicSubmenusContainer.insertAdjacentHTML('beforeend', html);
                    subMenuIndex++;
                    updatePhpPreview();
                });
            }

            document.addEventListener('click', function(e) {
                // Hapus Sub Menu
                let btnRemoveSub = e.target.closest('.btn-remove-submenu');
                if (btnRemoveSub) {
                    let target = document.querySelector(btnRemoveSub.getAttribute('data-target'));
                    if (target) {
                        target.remove();
                        updatePhpPreview();
                    }
                }

                // Tambah Level 3
                let btnAddSubchild = e.target.closest('.btn-add-subchild');
                if (btnAddSubchild) {
                    let subIdx = btnAddSubchild.getAttribute('data-sub-idx');
                    let container = document.getElementById(`sub_sub_container_${subIdx}`);
                    if (container) {
                        let ssIdx = container.querySelectorAll('.sub-sub-menu-card').length;
                        let html = createSubSubMenuCard(subIdx, ssIdx);
                        container.insertAdjacentHTML('beforeend', html);
                        updatePhpPreview();
                    }
                }

                // Hapus Level 3
                let btnRemoveSS = e.target.closest('.btn-remove-sub-sub');
                if (btnRemoveSS) {
                    let target = document.querySelector(btnRemoveSS.getAttribute('data-target'));
                    if (target) {
                        target.remove();
                        updatePhpPreview();
                    }
                }
            });

            // Auto sync Sub Menu inputs
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('sub-name-input')) {
                    let card = e.target.closest('.sub-menu-card');
                    let val = e.target.value;
                    let titleEnInput = card?.querySelector('.sub-title-en-input');
                    let titleKeyInput = card?.querySelector('.sub-title-key-input');
                    let urlInput = card?.querySelector('.sub-url-input');

                    let categoryVal = mainCategoryInput?.value || 'Master Data';
                    let parentUrl = mainUrlInput?.value || 'app';

                    if (titleEnInput && !titleEnInput.dataset.manual) titleEnInput.value = autoTranslateIdToEn(val);
                    if (titleKeyInput && !titleKeyInput.dataset.manual) titleKeyInput.value = formatTitleKey(categoryVal, val);
                    if (urlInput && !urlInput.dataset.manual) urlInput.value = formatUrlRoute(categoryVal, val, parentUrl);

                    updatePhpPreview();
                }

                if (e.target.classList.contains('ss-name-input')) {
                    let card = e.target.closest('.sub-sub-menu-card');
                    let val = e.target.value;
                    let urlInput = card?.querySelector('.ss-url-input');
                    let subCard = card?.closest('.sub-menu-card');
                    let subUrl = subCard?.querySelector('.sub-url-input')?.value || 'sub';

                    if (urlInput && !urlInput.dataset.manual) {
                        urlInput.value = `${subUrl}.${slugify(val, '-')}`;
                    }

                    updatePhpPreview();
                }
            });

            // ========================================================
            // BLUEPRINT SEEDER PHP PREVIEW GENERATOR
            // ========================================================
            const phpBlueprintCodeView = document.getElementById('php_blueprint_code_view');
            const tabBtnPhpPreview = document.getElementById('tab_btn_php_preview');
            const btnCopyPhpBlueprint = document.getElementById('btn_copy_php_blueprint');

            function updatePhpPreview() {
                if (!phpBlueprintCodeView) return;

                let isHierarchy = modeHierarchyRadio?.checked;
                let category = isHierarchy ? (document.getElementById('hierarchy_category')?.value || 'Master Data') : (mainCategoryInput?.value || 'Master Data');
                let name = mainNameInput?.value || 'Menu Title';
                let titleEn = mainTitleEnInput?.value || autoTranslateIdToEn(name);
                let titleKey = mainTitleKeyInput?.value || formatTitleKey(category, name);
                let url = mainUrlInput?.value || 'route.name';
                let icon = mainIconInput?.value || 'ki-duotone ki-element-11 fs-2';
                let paths = parseInt(mainPathsInput?.value) || 2;

                let perms = Array.from(document.querySelectorAll('#tab_modal_visual_builder .perm-cb:checked')).map(cb => `'${cb.value}'`);
                let roles = Array.from(document.querySelectorAll('#tab_modal_visual_builder .role-cb:checked')).map(cb => `'${cb.value}'`);

                let php = `<?php\n\nreturn [\n`;
                php += `    'title' => '${name}',\n`;
                php += `    'title_en' => '${titleEn}',\n`;
                php += `    'title_key' => '${titleKey}',\n`;
                php += `    'route' => '${url}',\n`;
                php += `    'icon' => '${icon}',\n`;
                php += `    'paths' => ${paths},\n`;
                php += `    'permissions' => [${perms.join(', ')}],\n`;
                php += `    'roles' => [${roles.join(', ')}],\n`;

                if (isHierarchy) {
                    let subCards = document.querySelectorAll('.sub-menu-card');
                    if (subCards.length > 0) {
                        php += `    'children' => [\n`;
                        subCards.forEach(subCard => {
                            let sName = subCard.querySelector('.sub-name-input')?.value || 'Sub Menu';
                            let sTitleEn = subCard.querySelector('.sub-title-en-input')?.value || autoTranslateIdToEn(sName);
                            let sTitleKey = subCard.querySelector('.sub-title-key-input')?.value || formatTitleKey(category, sName);
                            let sUrl = subCard.querySelector('.sub-url-input')?.value || 'sub.route';
                            let sPerms = Array.from(subCard.querySelectorAll('input[name*="[permissions]"]:checked')).map(cb => `'${cb.value}'`);

                            php += `        [\n`;
                            php += `            'title' => '${sName}',\n`;
                            php += `            'title_en' => '${sTitleEn}',\n`;
                            php += `            'title_key' => '${sTitleKey}',\n`;
                            php += `            'route' => '${sUrl}',\n`;
                            php += `            'permissions' => [${sPerms.length ? sPerms.join(', ') : "'read'"}],\n`;
                            php += `            'roles' => [${roles.join(', ')}],\n`;

                            let ssCards = subCard.querySelectorAll('.sub-sub-menu-card');
                            if (ssCards.length > 0) {
                                php += `            'children' => [\n`;
                                ssCards.forEach(ssCard => {
                                    let ssName = ssCard.querySelector('.ss-name-input')?.value || 'Child Menu';
                                    let ssUrl = ssCard.querySelector('.ss-url-input')?.value || 'child.route';
                                    php += `                [\n`;
                                    php += `                    'title' => '${ssName}',\n`;
                                    php += `                    'route' => '${ssUrl}',\n`;
                                    php += `                    'permissions' => ['read'],\n`;
                                    php += `                    'roles' => [${roles.join(', ')}],\n`;
                                    php += `                ],\n`;
                                });
                                php += `            ],\n`;
                            }

                            php += `        ],\n`;
                        });
                        php += `    ],\n`;
                    }
                }

                php += `];\n`;

                phpBlueprintCodeView.textContent = php;
            }

            if (tabBtnPhpPreview) tabBtnPhpPreview.addEventListener('shown.bs.tab', updatePhpPreview);

            if (btnCopyPhpBlueprint) {
                btnCopyPhpBlueprint.addEventListener('click', function() {
                    let code = phpBlueprintCodeView?.textContent || '';
                    navigator.clipboard.writeText(code).then(() => {
                        this.innerHTML = `<i class="ki-duotone ki-check fs-5 me-1 text-success"></i> Berhasil Disalin!`;
                        setTimeout(() => {
                            this.innerHTML = `<i class="ki-duotone ki-copy fs-5 me-1"><span class="path1"></span><span class="path2"></span></i> Salin Kode PHP`;
                        }, 2500);
                    });
                });
            }

            // ========================================================
            // TOMBOL TAMBAH SUB MENU (+) DI BARIS TABEL
            // ========================================================
            const addChildButtons = document.querySelectorAll('.btn-add-child-menu');
            addChildButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const parentId = this.getAttribute('data-parent-id');
                    const parentName = this.getAttribute('data-parent-name');
                    const parentCategory = this.getAttribute('data-parent-category') || 'Master Data';
                    const parentUrl = this.getAttribute('data-parent-url') || '';

                    const addModal = new bootstrap.Modal(document.getElementById('kt_modal_add_menu'));
                    
                    // Switch ke single mode
                    if (modeSingleRadio) {
                        modeSingleRadio.checked = true;
                        applyBuilderMode();
                    }

                    document.getElementById('add_modal_header_title').innerText = `Tambah Sub Menu untuk: ${parentName}`;
                    
                    if (mainCategoryInput) mainCategoryInput.value = parentCategory;
                    
                    if (mainParentSelect) {
                        $(mainParentSelect).val(parentId).trigger('change');
                    }

                    if (mainNameInput) {
                        mainNameInput.value = '';
                        userEditedTitleEn = false;
                        userEditedTitleKey = false;
                        userEditedUrl = false;
                    }

                    addModal.show();
                });
            });

            // ========================================================
            // TOMBOL EDIT MENU DI BARIS TABEL
            // ========================================================
            const editButtons = document.querySelectorAll('.btn-edit-menu');
            const editForm = document.getElementById('kt_modal_edit_menu_form');
            const editModalEl = document.getElementById('kt_modal_edit_menu');

            editButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const titleEn = this.getAttribute('data-title-en');
                    const titleKey = this.getAttribute('data-title-key');
                    const url = this.getAttribute('data-url');
                    const category = this.getAttribute('data-category');
                    const icon = this.getAttribute('data-icon');
                    const paths = this.getAttribute('data-paths');
                    const orders = this.getAttribute('data-orders');
                    const active = this.getAttribute('data-active') === '1';
                    const badgeLabel = this.getAttribute('data-badge-label') || '';
                    const badgeClass = this.getAttribute('data-badge-class') || 'badge badge-light-primary';
                    const parentId = this.getAttribute('data-parent');
                    
                    let permissions = [];
                    let roles = [];
                    try { permissions = JSON.parse(this.getAttribute('data-permissions') || '[]'); } catch(e){}
                    try { roles = JSON.parse(this.getAttribute('data-roles') || '[]'); } catch(e){}

                    editForm.action = `/appsupport/menu/${id}`;

                    document.getElementById('edit_name').value = name || '';
                    document.getElementById('edit_title_en').value = titleEn || '';
                    document.getElementById('edit_title_key').value = titleKey || '';
                    document.getElementById('edit_url').value = url || '';
                    document.getElementById('edit_category').value = category || '';
                    document.getElementById('edit_icon').value = icon || '';
                    document.getElementById('edit_paths').value = paths || '0';
                    document.getElementById('edit_orders').value = orders || '0';
                    document.getElementById('edit_active').checked = active;
                    document.getElementById('edit_badge_label').value = badgeLabel;
                    document.getElementById('edit_badge_class').value = badgeClass;

                    renderIconPreview(icon || '', paths || 0, document.getElementById('edit_icon_preview_box'));

                    if ($('#edit_main_menu_id').data('select2')) {
                        $('#edit_main_menu_id').val(parentId || '').trigger('change');
                    } else {
                        document.getElementById('edit_main_menu_id').value = parentId || '';
                    }

                    // Checkbox Permissions
                    document.querySelectorAll('.edit-perm-cb').forEach(cb => {
                        cb.checked = permissions.includes(cb.value);
                    });

                    // Checkbox Roles
                    document.querySelectorAll('.edit-role-cb').forEach(cb => {
                        cb.checked = roles.includes(cb.value);
                    });
                    syncRolePillLabels(editModalEl);

                    const modal = new bootstrap.Modal(editModalEl);
                    modal.show();
                });
            });

            // Live preview icon di modal edit
            const editIconInput = document.getElementById('edit_icon');
            const editPathsInput = document.getElementById('edit_paths');
            const editIconPreviewBox = document.getElementById('edit_icon_preview_box');
            if (editIconInput) {
                editIconInput.addEventListener('input', () => {
                    renderIconPreview(editIconInput.value, editPathsInput?.value || 0, editIconPreviewBox);
                });
            }
            if (editPathsInput) {
                editPathsInput.addEventListener('input', () => {
                    renderIconPreview(editIconInput?.value || '', editPathsInput.value, editIconPreviewBox);
                });
            }

            // ========================================================
            // SWEETALERT DELETE CONFIRMATION
            // ========================================================
            document.querySelectorAll('.btn-delete-trigger').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    let form = this.closest('form');
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Hapus Menu?',
                            text: 'Menu beserta relasi hak aksesnya akan dihapus permanen!',
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
                        if (confirm('Apakah Anda yakin ingin menghapus menu ini?')) {
                            form.submit();
                        }
                    }
                });
            });

            // ========================================================
            // DRAG & DROP TREE-TABLE REORDERING ENGINE
            // Syarat:
            // 1) Menu Utama (Level 1) dipindahkan -> seluruh anak sub menu ikut berpindah.
            // 2) Sub menu dipindahkan -> hanya berlaku di bawah parent utamanya saja.
            // ========================================================
            const tableBody = document.getElementById('menu_table_tbody');
            const toastContainer = document.getElementById('reorder-toast-container');
            let dragState = null;

            function showReorderToast(message, type = 'success') {
                if (!toastContainer) return;
                const toastId = 'toast_' + Date.now();
                const iconClass = type === 'success' ? 'ki-check-circle text-success' : 'ki-cross-circle text-danger';
                const toastHtml = `
                    <div id="${toastId}" class="toast show align-items-center text-white bg-dark border-0 shadow-lg mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex align-items-center p-3">
                            <i class="ki-duotone ${iconClass} fs-2hx me-3">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            <div class="toast-body fs-7 fw-semibold p-0 flex-grow-1 text-white">
                                ${message}
                            </div>
                            <button type="button" class="btn btn-icon btn-sm btn-active-light-dark ms-2" data-bs-dismiss="toast" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2 text-white"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                        </div>
                    </div>
                `;
                toastContainer.insertAdjacentHTML('beforeend', toastHtml);
                const toastEl = document.getElementById(toastId);
                setTimeout(() => {
                    if (toastEl) {
                        toastEl.classList.remove('show');
                        setTimeout(() => toastEl.remove(), 400);
                    }
                }, 3000);
            }

            // Fungsi untuk mengumpulkan seluruh descendant rows (anak-cucu) dari suatu row
            function collectDescendantRows(row) {
                const depth = parseInt(row.dataset.depth) || 0;
                const rowId = row.dataset.id;
                const descendants = [];
                let next = row.nextElementSibling;

                while (next && next.classList.contains('menu-row')) {
                    const nextDepth = parseInt(next.dataset.depth) || 0;
                    if (nextDepth <= depth) {
                        break; // Sudah bukan anak lagi
                    }

                    // Jika Level 1 (depth 0), semua row ber-rootId sama adalah anak/cucunya
                    if (depth === 0) {
                        if (next.dataset.rootId === rowId) {
                            descendants.push(next);
                        } else {
                            break;
                        }
                    } 
                    // Jika Level 2 (depth 1), anak langsungnya adalah yang ber-parentId sama dengan rowId
                    else if (depth === 1) {
                        if (next.dataset.parentId === rowId) {
                            descendants.push(next);
                        } else {
                            break;
                        }
                    } else {
                        break;
                    }

                    next = next.nextElementSibling;
                }

                return descendants;
            }

            // Inisialisasi event listeners pada drag handle
            document.addEventListener('dragstart', function (e) {
                const handle = e.target.closest('.drag-handle');
                if (!handle) return;

                const sourceRow = handle.closest('.menu-row');
                if (!sourceRow) return;

                // Cek apakah filter/search sedang aktif
                const isFiltered = (searchInput?.value?.trim() !== '') || (categorySelect?.value?.trim() !== '');
                if (isFiltered) {
                    e.preventDefault();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Pencarian / Filter Aktif',
                            text: 'Harap reset pencarian atau filter kategori terlebih dahulu untuk mengubah urutan menu.',
                            icon: 'info',
                            confirmButtonText: 'OK',
                            customClass: { confirmButton: 'btn btn-primary' }
                        });
                    } else {
                        alert('Harap reset pencarian/filter terlebih dahulu untuk mengatur urutan menu.');
                    }
                    return;
                }

                const sourceId = sourceRow.dataset.id;
                const sourceDepth = parseInt(sourceRow.dataset.depth) || 0;
                const sourceParentId = sourceRow.dataset.parentId || '';
                const sourceRootId = sourceRow.dataset.rootId || sourceId;
                const sourceCategory = sourceRow.dataset.category || '';
                const sourceDescendants = collectDescendantRows(sourceRow);
                const sourceBlock = [sourceRow, ...sourceDescendants];

                dragState = {
                    sourceRow,
                    sourceId,
                    sourceDepth,
                    sourceParentId,
                    sourceRootId,
                    sourceCategory,
                    sourceDescendants,
                    sourceBlock
                };

                sourceRow.classList.add('dragging');
                sourceDescendants.forEach(r => r.classList.add('drag-child-highlight'));

                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', sourceId);
            });

            document.addEventListener('dragover', function (e) {
                if (!dragState) return;

                const targetRow = e.target.closest('.menu-row');
                if (!targetRow || dragState.sourceBlock.includes(targetRow)) {
                    return;
                }

                const targetDepth = parseInt(targetRow.dataset.depth) || 0;
                const targetParentId = targetRow.dataset.parentId || '';
                const targetCategory = targetRow.dataset.category || '';

                // VALIDASI ATURAN DROP:
                // 1) Menu Utama (depth 0): hanya bisa di-drop pada sesama Menu Utama di kategori yang sama
                if (dragState.sourceDepth === 0) {
                    if (targetDepth !== 0 || targetCategory !== dragState.sourceCategory) {
                        return; // Bukan sesama root menu di kategori yang sama
                    }
                }
                // 2) Sub Menu (depth > 0): hanya bisa di-drop pada sesama sub menu yang ber-parent SAMA PERSIS
                else {
                    if (targetDepth !== dragState.sourceDepth || targetParentId !== dragState.sourceParentId) {
                        return; // Bukan sesama sub menu di bawah parent yang sama
                    }
                }

                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';

                // Tentukan letak garis drop (atas / bawah)
                const rect = targetRow.getBoundingClientRect();
                const isTopHalf = e.clientY < (rect.top + rect.height / 2);

                document.querySelectorAll('.menu-row.drag-over-top, .menu-row.drag-over-bottom').forEach(r => {
                    r.classList.remove('drag-over-top', 'drag-over-bottom');
                });

                if (isTopHalf) {
                    targetRow.classList.add('drag-over-top');
                } else {
                    targetRow.classList.add('drag-over-bottom');
                }
            });

            document.addEventListener('dragleave', function (e) {
                const targetRow = e.target.closest('.menu-row');
                if (targetRow && !targetRow.contains(e.relatedTarget)) {
                    targetRow.classList.remove('drag-over-top', 'drag-over-bottom');
                }
            });

            document.addEventListener('drop', function (e) {
                if (!dragState) return;

                const targetRow = e.target.closest('.menu-row');
                if (!targetRow || dragState.sourceBlock.includes(targetRow)) {
                    return;
                }

                const targetDepth = parseInt(targetRow.dataset.depth) || 0;
                const targetParentId = targetRow.dataset.parentId || '';
                const targetCategory = targetRow.dataset.category || '';
                const isTopHalf = targetRow.classList.contains('drag-over-top');

                // Validasi ulang aturan
                let isValid = false;
                if (dragState.sourceDepth === 0) {
                    isValid = (targetDepth === 0 && targetCategory === dragState.sourceCategory);
                } else {
                    isValid = (targetDepth === dragState.sourceDepth && targetParentId === dragState.sourceParentId);
                }

                if (!isValid) {
                    return;
                }

                e.preventDefault();

                // Bersihkan styling drag over
                document.querySelectorAll('.menu-row.drag-over-top, .menu-row.drag-over-bottom').forEach(r => {
                    r.classList.remove('drag-over-top', 'drag-over-bottom');
                });

                // Tentukan insertion point:
                // Jika Level 1 (depth 0): target punya anak-cucu juga, jadi saat drop bottom, harus setelah anak terakhir target!
                let insertionAnchor = targetRow;
                if (!isTopHalf) {
                    const targetDescendants = collectDescendantRows(targetRow);
                    if (targetDescendants.length > 0) {
                        insertionAnchor = targetDescendants[targetDescendants.length - 1];
                    }
                }

                // Pindahkan SELURUH blok source (parent + anak-cucunya) ke posisi baru di DOM
                if (isTopHalf) {
                    dragState.sourceBlock.forEach(row => {
                        targetRow.parentNode.insertBefore(row, targetRow);
                    });
                } else {
                    let refNode = insertionAnchor.nextSibling;
                    dragState.sourceBlock.forEach(row => {
                        targetRow.parentNode.insertBefore(row, refNode);
                    });
                }

                // Berikan efek highlight berhasil
                dragState.sourceBlock.forEach(row => {
                    row.classList.add('reorder-updated');
                    setTimeout(() => row.classList.remove('reorder-updated'), 1400);
                });

                // Hitung ulang nomor urutan (orders) & kirim via AJAX
                saveReorderedMenus(dragState);
            });

            document.addEventListener('dragend', function () {
                if (dragState) {
                    dragState.sourceRow.classList.remove('dragging');
                    dragState.sourceDescendants.forEach(r => r.classList.remove('drag-child-highlight'));
                }
                document.querySelectorAll('.menu-row.drag-over-top, .menu-row.drag-over-bottom').forEach(r => {
                    r.classList.remove('drag-over-top', 'drag-over-bottom');
                });
                dragState = null;
            });

            // Simpan urutan ke Database via AJAX
            function saveReorderedMenus(state) {
                const payloadItems = [];

                if (state.sourceDepth === 0) {
                    // Kumpulkan semua Root Menu di kategori yang sama
                    const rootRows = Array.from(document.querySelectorAll(`#menu_table_tbody tr.menu-row[data-depth="0"][data-category="${state.sourceCategory}"]`));
                    rootRows.forEach((row, index) => {
                        const newOrder = index + 1;
                        row.dataset.orders = newOrder;
                        const badge = row.querySelector('.row-order-badge');
                        if (badge) badge.innerText = newOrder;

                        payloadItems.push({
                            id: row.dataset.id,
                            orders: newOrder
                        });
                    });
                } else {
                    // Kumpulkan semua sub menu sibling yang ber-parentId sama
                    const siblingRows = Array.from(document.querySelectorAll(`#menu_table_tbody tr.menu-row[data-depth="${state.sourceDepth}"][data-parent-id="${state.sourceParentId}"]`));
                    siblingRows.forEach((row, index) => {
                        const newOrder = index + 1;
                        row.dataset.orders = newOrder;
                        const badge = row.querySelector('.row-order-badge');
                        if (badge) badge.innerText = newOrder;

                        payloadItems.push({
                            id: row.dataset.id,
                            orders: newOrder
                        });
                    });
                }

                if (payloadItems.length === 0) return;

                // Kirim AJAX ke route menu.reorder
                fetch('{{ route("appsupport.menu.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ items: payloadItems })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showReorderToast(`Urutan menu <b>${state.sourceRow.dataset.name}</b> berhasil diperbarui!`, 'success');

                        // Update Sidebar secara Real-Time tanpa reload
                        if (data.sidebar_html) {
                            const sidebarWrapper = document.getElementById('kt_app_sidebar_additional_sections_wrapper');
                            if (sidebarWrapper) {
                                sidebarWrapper.innerHTML = data.sidebar_html;

                                // Re-initialize Metronic KTMenu & KTComponents
                                if (typeof KTMenu !== 'undefined') {
                                    const sidebarMenuEl = document.getElementById('kt_app_sidebar_menu');
                                    if (sidebarMenuEl) {
                                        const instance = KTMenu.getInstance(sidebarMenuEl);
                                        if (instance) {
                                            instance.update();
                                        } else {
                                            KTMenu.createInstances();
                                        }
                                    }
                                }
                                if (typeof KTComponents !== 'undefined') {
                                    KTComponents.init();
                                }
                                if (typeof KTLanguage !== 'undefined' && typeof KTLanguage.translateDOM === 'function') {
                                    KTLanguage.translateDOM(sidebarWrapper);
                                }

                                // Efek visual highlight halus pada sidebar
                                sidebarWrapper.classList.add('reorder-updated');
                                setTimeout(() => sidebarWrapper.classList.remove('reorder-updated'), 1200);
                            }
                        }
                    } else {
                        showReorderToast(data.message || 'Gagal menyimpan urutan menu.', 'danger');
                    }
                })
                .catch(err => {
                    console.error('Error saving menu order:', err);
                    showReorderToast('Terjadi kesalahan saat menyimpan urutan.', 'danger');
                });
            }

        });
    </script>
@endsection
