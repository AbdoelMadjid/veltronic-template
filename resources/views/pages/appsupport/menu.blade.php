@extends('layouts.index')

@section('styles')
    <link href="{{ asset('assets/css/appsupport/menu.css') }}?v={{ filemtime(public_path('assets/css/appsupport/menu.css')) }}" rel="stylesheet" type="text/css" />
@endsection

@section('toolbar')
    @include('layouts.partials._toolbar', [
        'action' => view()->make('layouts.partials._action-petunjuk-button', [
            'targetModal' => '#kt_modal_menu_petunjuk',
            'title' => 'Petunjuk Operasional Menu'
        ])
    ])
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

            <!--begin::Header Banner & Filter Card-->
            <div class="card card-flush shadow-sm border-0 mb-6">
                <div class="card-body p-6 d-flex flex-column flex-xl-row align-items-center justify-content-between gap-4 text-center text-xl-start">
                    <!-- Sisi Kiri: Logo, Judul & Deskripsi -->
                    <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-4 w-100 w-xl-auto">
                        <!-- Logo / Icon -->
                        <div class="symbol symbol-55px symbol-md-45px symbol-circle bg-light-primary mb-1 mb-md-0 me-0 me-md-4 d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ki-outline ki-category text-primary fs-2x fs-md-2"></i>
                        </div>
                        <!-- Judul & Deskripsi -->
                        <div class="d-flex flex-column align-items-center align-items-md-start">
                            <h2 class="fw-bolder text-gray-900 m-0 fs-3">Manajemen Menu & Navigasi</h2>
                            <span class="text-muted fs-7 mt-1">Kelola hierarki menu aplikasi, konfigurasi rute URL, izin akses modul, dan pengurutan navigasi.</span>
                        </div>
                    </div>

                    <!-- Sisi Kanan (Rapat Kanan): Search, Filter & Tombol Tambah Menu -->
                    <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-center justify-content-xl-end gap-2 gap-md-3 w-100 w-xl-auto mt-2 mt-xl-0">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative w-100 w-sm-200px w-md-225px">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4 text-gray-500"></i>
                            <input type="text" id="menu-search-input" class="form-control form-control-solid form-control-sm ps-12" placeholder="Cari nama, URL, key..." value="{{ $search ?? '' }}" />
                        </div>
                        <!--end::Search-->

                        <!--begin::Category Filter-->
                        <div class="w-100 w-sm-175px">
                            <select id="category-filter-select" class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" data-placeholder="Filter Kategori">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ ($categoryFilter ?? '') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--end::Category Filter-->

                        <!--begin::Add Button-->
                        <button type="button" class="btn btn-primary btn-sm fw-bold px-3 px-md-4 w-100 w-sm-auto flex-shrink-0 btn-add-menu-modal" data-bs-toggle="modal" data-bs-target="#kt_modal_add_menu">
                            <i class="ki-outline ki-plus fs-3 fs-md-4 me-1"></i>
                            <span>Tambah Menu</span>
                        </button>
                        <!--end::Add Button-->
                    </div>
                </div>
            </div>
            <!--end::Header Banner & Filter Card-->

            <!--begin::Table Card-->
            <div class="card card-flush shadow-sm border-0">
                <!--begin::Card body-->
                <div class="card-body py-4 px-6">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed table-row-gray-200 fs-6 gy-4" id="kt_table_menus">
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
                            <tbody class="fw-semibold text-gray-600" id="menu_table_tbody" data-reorder-url="{{ route('appsupport.menu.reorder') }}">
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
                                                    data-bs-trigger="hover"
                                                    data-bs-placement="top"
                                                    title="{{ $addTooltip }}"
                                                    data-parent-id="{{ $menu->id }}"
                                                    data-parent-name="{{ $menu->name }}"
                                                    data-parent-category="{{ $menu->category ?? '' }}"
                                                    data-parent-url="{{ $menu->url }}">
                                                    <i class="ki-outline ki-plus fs-3"></i>
                                                </button>
                                            @endif

                                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit-menu"
                                                data-bs-toggle="tooltip"
                                                data-bs-trigger="hover"
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
                                                <i class="ki-outline ki-pencil fs-4"></i>
                                            </button>

                                            <form action="{{ route('appsupport.menu.destroy', $menu->id) }}" method="POST" class="d-inline form-delete-menu">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btn-delete-trigger"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover"
                                                    data-bs-placement="top"
                                                    title="Hapus Menu">
                                                    <i class="ki-outline ki-trash fs-4"></i>
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
    @include('pages.appsupport.partials.menu.menu-petunjuk')
    @include('pages.appsupport.partials.menu.menu-form-modal')
    <!--end::Modals-->
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/appsupport/menu.js') }}?v={{ filemtime(public_path('assets/js/appsupport/menu.js')) }}"></script>
@endsection
