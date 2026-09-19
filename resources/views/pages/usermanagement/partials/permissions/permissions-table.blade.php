<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 text-center text-md-start">
        <!-- Baris 1-3 di Mobile (Logo, Judul, Deskripsi) / Sisi Kiri di Desktop -->
        <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-4 w-100 w-md-auto">
            <!-- Baris 1: Logo / Ikon Utama -->
            <div class="symbol symbol-55px symbol-md-45px symbol-circle bg-light-primary mb-1 mb-md-0 me-0 me-md-4 d-flex align-items-center justify-content-center flex-shrink-0">
                <i class="ki-outline ki-key text-primary fs-2x fs-md-2"></i>
            </div>
            <!-- Baris 2 & 3: Judul & Deskripsi -->
            <div class="d-flex flex-column align-items-center align-items-md-start">
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">Manajemen Permission & Hak Akses Fitur</h2>
                <span class="text-muted fs-7 mt-1">Kelola izin akses fitur sistem, pengelompokan modul, dan generator permission CRUD.</span>
            </div>
        </div>

        <!-- Baris 4: Kumpulan Tombol Aksi (Icon-only di mobile dengan Tooltip Hover) / Sisi Kanan di Desktop -->
        <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-2 gap-md-3 w-100 w-md-auto mt-2 mt-md-0">
            <button type="button" class="btn btn-primary btn-sm fw-bold px-3 px-md-4" id="kt_btn_open_generate_modal"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Modul CRUD (Praktis)">
                <i class="ki-outline ki-element-plus fs-4 me-0 me-md-1"></i>
                <span class="d-none d-md-inline">Modul CRUD (Praktis)</span>
            </button>
            <button type="button" class="btn btn-light-primary btn-sm fw-bold px-3 px-md-4" id="kt_btn_add_permission"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Single Permission">
                <i class="ki-outline ki-plus fs-4 me-0 me-md-1"></i>
                <span class="d-none d-md-inline">Single Permission</span>
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
