<!--begin::Permissions Table Card-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6 px-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!-- Search -->
            <div class="d-flex align-items-center position-relative my-1 me-4">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span class="path2"></span></i>
                <input type="text" id="kt_filter_permission_search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari nama izin..." />
            </div>

            <!-- Filter Modul -->
            <div class="w-175px my-1">
                <select id="kt_filter_permission_module" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                    <option value="all" selected>Semua Modul</option>
                    @foreach($modules as $key => $title)
                        <option value="{{ $key }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--end::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar d-flex align-items-center gap-2 ms-auto flex-shrink-0">
            <!-- Tombol Generate Modul CRUD -->
            <button type="button" class="btn btn-sm btn-light-primary fw-bold" id="kt_btn_open_generate_modal"
                data-bs-toggle="tooltip" title="Buat otomatis izin create, read, update, delete per modul">
                <i class="ki-duotone ki-element-plus fs-5 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                <span class="d-none d-sm-inline">Generate CRUD Modul</span>
            </button>

            <!-- Tombol Tambah Permission Manual -->
            <button type="button" class="btn btn-sm btn-primary fw-bold" id="kt_btn_add_permission"
                data-bs-toggle="tooltip" title="Tambah izin akses individual">
                <i class="ki-duotone ki-plus fs-5 me-0 me-sm-1"></i>
                <span class="d-none d-sm-inline">Tambah Izin</span>
            </button>
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4 px-6">
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="kt_permissions_datatable">
                <thead>
                    <tr class="fw-bolder text-muted bg-light text-uppercase fs-7">
                        <th class="ps-4 min-w-200px">Nama Izin (Permission)</th>
                        <th class="min-w-140px">Modul / Fitur</th>
                        <th class="min-w-80px text-center">Guard</th>
                        <th class="min-w-200px">Ditetapkan ke Peran (Roles)</th>
                        <th class="min-w-100px text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kt_permissions_tbody" class="fw-semibold text-gray-800">
                    @forelse($permissions as $perm)
                        @php
                            $parts = explode('.', $perm->name);
                            $modKey = (count($parts) > 1) ? implode('.', array_slice($parts, 0, -1)) : 'general';
                            $modTitle = ucwords(str_replace(['_', '-'], ' ', $modKey));
                            $actionName = end($parts);
                        @endphp
                        <tr class="perm-row-item" data-perm-name="{{ $perm->name }}" data-mod-key="{{ $modKey }}">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-900 fw-bold fs-6 font-monospace">{{ $perm->name }}</span>
                                        <span class="text-muted fs-8">Aksi: <strong class="text-primary">{{ strtoupper($actionName) }}</strong></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-light-secondary fw-bold fs-8">{{ $modTitle }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light fw-bold fs-8 text-gray-700">{{ $perm->guard_name }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center gap-1">
                                    @if($perm->roles->isNotEmpty())
                                        @foreach($perm->roles as $r)
                                            @php
                                                $rClass = in_array(strtolower($r->name), ['master', 'admin']) ? 'badge-light-danger' : 'badge-light-primary';
                                            @endphp
                                            <span class="badge {{ $rClass }} fw-bolder fs-9 px-2 py-0.5">{{ $r->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted fs-8 fst-italic">Belum diberikan ke peran manapun</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <button type="button" class="btn btn-icon btn-light-primary btn-sm btn-edit-permission"
                                        data-id="{{ $perm->id }}" data-name="{{ $perm->name }}"
                                        data-bs-toggle="tooltip" title="Ubah Nama Izin">
                                        <i class="ki-duotone ki-pencil fs-5"><span class="path1"></span><span class="path2"></span></i>
                                    </button>

                                    <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-delete-permission"
                                        data-id="{{ $perm->id }}" data-name="{{ $perm->name }}"
                                        data-bs-toggle="tooltip" title="Hapus Izin">
                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-muted">
                                Belum ada izin (permissions) yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Permissions Table Card-->
