<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-wrap align-items-center justify-content-between gap-4">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-45px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center">
                <i class="ki-outline ki-key text-primary fs-2"></i>
            </div>
            <div>
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">Manajemen Permission & Hak Akses Fitur</h2>
                <span class="text-muted fs-7">Kelola izin akses fitur sistem, pengelompokan modul, dan generator permission CRUD.</span>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button type="button" class="btn btn-primary btn-sm fw-bold rounded-pill px-4" id="kt_btn_open_generate_modal">
                <i class="ki-outline ki-flash fs-4 me-1"></i> Modul CRUD (Praktis)
            </button>
            <button type="button" class="btn btn-light-primary btn-sm fw-bold rounded-pill px-4" id="kt_btn_add_permission">
                <i class="ki-outline ki-plus fs-4 me-1"></i> Single Permission
            </button>
        </div>
    </div>
</div>
<!--end::Header Banner-->

<!--begin::Stats Summary Cards-->
<div class="row g-6 mb-6">
    <!-- Card 1: Total Permission Terdaftar -->
    <div class="col-md-4">
        <div class="card card-flush h-100 p-6 border border-dashed border-primary border-opacity-50 rounded-3 shadow-none bg-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="fs-2hx fw-bolder text-primary" id="stat_total_perms">{{ $totalPermissions }}</div>
                <div class="symbol symbol-45px rounded-3 bg-light-primary d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-key text-primary fs-2"></i>
                </div>
            </div>
            <div class="fw-bold text-gray-700 fs-7">Total Permission Terdaftar</div>
        </div>
    </div>

    <!-- Card 2: Total Modul / Fitur Aplikasi -->
    <div class="col-md-4">
        <div class="card card-flush h-100 p-6 border border-dashed border-info border-opacity-50 rounded-3 shadow-none bg-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="fs-2hx fw-bolder text-info" id="stat_total_modules">{{ $totalModules }}</div>
                <div class="symbol symbol-45px rounded-3 bg-light-info d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-element-11 text-info fs-2"></i>
                </div>
            </div>
            <div class="fw-bold text-gray-700 fs-7">Total Modul / Fitur Aplikasi</div>
        </div>
    </div>

    <!-- Card 3: Modul Belum Ditugaskan -->
    <div class="col-md-4">
        <div class="card card-flush h-100 p-6 border border-dashed border-success border-opacity-50 rounded-3 shadow-none bg-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="fs-2hx fw-bolder text-success" id="stat_unassigned_modules">{{ $unassignedModulesCount }}</div>
                <div class="symbol symbol-45px rounded-3 bg-light-success d-flex align-items-center justify-content-center">
                    <i class="ki-outline ki-shield-tick text-success fs-2"></i>
                </div>
            </div>
            <div class="fw-bold text-gray-700 fs-7">Modul Belum Ditugaskan</div>
        </div>
    </div>
</div>
<!--end::Stats Summary Cards-->

<!--begin::Module Permissions Table Card-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6 px-6">
        <div class="card-title d-flex align-items-center gap-4 flex-wrap">
            <!-- Search -->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" id="kt_filter_permission_search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Modul / Fitur..." />
            </div>

            <!-- Filter Role -->
            <div class="w-175px my-1">
                <select id="kt_filter_permission_role" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                    <option value="all" selected>All / Semua Role</option>
                    @foreach($roles as $role)
                        <option value="{{ strtolower($role->name) }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4 px-6">
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4" id="kt_permissions_datatable">
                <thead>
                    <tr class="fw-bolder text-muted bg-light text-uppercase fs-8">
                        <th class="ps-4 min-w-250px">MODUL / FITUR APLIKASI</th>
                        <th class="min-w-200px">TIPE AKSI TERDAFTAR (CRUD)</th>
                        <th class="min-w-180px">DITUGASKAN KE ROLE</th>
                        <th class="min-w-100px">JUMLAH IZIN</th>
                        <th class="min-w-80px text-end pe-4">AKSI</th>
                    </tr>
                </thead>
                <tbody id="kt_permissions_tbody" class="fw-semibold text-gray-800">
                    @forelse($modulesTree as $mod)
                        @php
                            $rolesJson = json_encode(array_map('strtolower', $mod['assigned_roles'] ?? []));
                        @endphp
                        <tr class="module-perm-row" 
                            id="mod_row_{{ $mod['id'] }}" 
                            data-module-name="{{ strtolower($mod['name']) }}" 
                            data-module-url="{{ strtolower($mod['url']) }}"
                            data-roles="{{ $rolesJson }}">
                            <td class="ps-4">
                                @if($mod['level'] === 1)
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px symbol-circle bg-light-primary text-primary me-3 d-flex align-items-center justify-content-center">
                                            <i class="ki-outline ki-abstract-26 fs-5"></i>
                                        </div>
                                        <div>
                                            <span class="text-gray-900 fw-bold fs-6 font-monospace">{{ $mod['url'] ?: $mod['name'] }}</span>
                                            <div class="text-muted fs-8">{{ $mod['name'] }}</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center" style="padding-left: {{ ($mod['level'] - 1) * 28 }}px;">
                                        <span class="text-muted me-2 font-monospace fs-6">└─</span>
                                        <div>
                                            <span class="text-gray-900 fw-bold fs-6 font-monospace">{{ $mod['url'] ?: $mod['name'] }}</span>
                                            <div class="text-muted fs-8">{{ $mod['name'] }}</div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center gap-1">
                                    @if(!empty($mod['registered_actions']))
                                        @foreach($mod['registered_actions'] as $act)
                                            @php
                                                $actClass = match($act) {
                                                    'READ' => 'badge-light-info text-info',
                                                    'CREATE' => 'badge-light-success text-success',
                                                    'UPDATE' => 'badge-light-warning text-warning',
                                                    'DELETE' => 'badge-light-danger text-danger',
                                                    default => 'badge-light-primary text-primary'
                                                };
                                            @endphp
                                            <span class="badge {{ $actClass }} fw-bold fs-9 px-2 py-0.5">{{ $act }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted fs-8 fst-italic">Belum ada aksi CRUD</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center gap-1">
                                    @if(!empty($mod['assigned_roles']))
                                        @foreach($mod['assigned_roles'] as $rName)
                                            @php
                                                $rBadgeClass = in_array(strtolower($rName), ['master', 'admin']) ? 'badge-light-primary text-primary' : 'badge-light-info text-info';
                                            @endphp
                                            <span class="badge {{ $rBadgeClass }} fw-bold fs-9 px-2 py-0.5">{{ ucfirst($rName) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted fs-8 fst-italic">Belum ditugaskan</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="fw-bolder text-gray-800 fs-7">{{ $mod['total_permissions'] }} Akses</span>
                            </td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-icon btn-light-primary btn-sm btn-edit-module-permissions"
                                    data-module-id="{{ $mod['id'] }}"
                                    data-module-name="{{ $mod['name'] }}"
                                    data-module-url="{{ $mod['url'] ?: $mod['name'] }}"
                                    data-actions="{{ json_encode(array_map('strtolower', $mod['registered_actions'] ?? [])) }}"
                                    data-roles="{{ json_encode(array_map('strtolower', $mod['assigned_roles'] ?? [])) }}"
                                    data-bs-toggle="tooltip" title="Ubah Izin Modul">
                                    <i class="ki-outline ki-pencil fs-5"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty_perm_row">
                            <td colspan="5" class="text-center py-8 text-muted">
                                Belum ada modul yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Module Permissions Table Card-->
