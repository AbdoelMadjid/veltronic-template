<div class="card card-flush shadow-sm">
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" id="table_search_input" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Nama / Email Pengguna..." value="{{ request('search') }}" />
            </div>
        </div>
        <div class="card-toolbar flex-row-fluid justify-content-end gap-3">
            <div class="w-100 mw-200px">
                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" id="filter_role_dropdown">
                    <option value="all" {{ request('role') == 'all' || !request('role') ? 'selected' : '' }}>Semua Peran</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->id }}" {{ request('role') == $r->id ? 'selected' : '' }}>{{ $r->display_name ?? ucwords(str_replace(['_', '-'], ' ', $r->name)) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn btn-light-primary" id="btn_reset_filter">
                <i class="ki-outline ki-arrows-circle fs-4"></i>
                <span class="d-none d-sm-inline ms-1">Reset Filter</span>
            </button>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_user_access">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-200px">Pengguna</th>
                        <th class="min-w-150px">Peran Aktif</th>
                        <th class="min-w-150px">Izin Langsung (Direct)</th>
                        <th class="min-w-125px">Status Akun</th>
                        <th class="text-end min-w-100px pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold" id="user_access_tbody">
                    @forelse($users as $user)
                        <tr id="user-access-row-{{ $user->id }}">
                            <td class="d-flex align-items-center">
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    @if(!empty($user->avatar))
                                        <div class="symbol-label">
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-100" />
                                        </div>
                                    @else
                                        @php
                                            $stateColors = ['success', 'info', 'primary', 'warning', 'danger'];
                                            $color = $stateColors[$user->id % count($stateColors)];
                                            $initial = strtoupper(substr($user->name, 0, 1));
                                        @endphp
                                        <div class="symbol-label fs-3 bg-light-{{ $color }} text-{{ $color }}">
                                            {{ $initial }}
                                        </div>
                                    @endif
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-gray-800 fw-bold fs-6 mb-1">{{ $user->name }}</span>
                                    <span class="text-muted fs-7">{{ $user->email ?? $user->username }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1" id="user-roles-container-{{ $user->id }}">
                                    @forelse($user->roles as $role)
                                        @php
                                            $badgeClass = match($role->name) {
                                                'master' => 'badge-light-danger',
                                                'admin' => 'badge-light-primary',
                                                default => 'badge-light-info'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} fw-bold">{{ $role->display_name ?? ucwords(str_replace(['_', '-'], ' ', $role->name)) }}</span>
                                    @empty
                                        <span class="badge badge-light-secondary text-muted">Tanpa Peran</span>
                                    @endforelse
                                </div>
                            </td>
                            <td>
                                @php
                                    $directCount = $user->permissions->count();
                                @endphp
                                <div id="user-direct-perm-container-{{ $user->id }}">
                                    @if($directCount > 0)
                                        <span class="badge badge-light-warning fw-bold">
                                            {{ $directCount }} Izin Khusus
                                        </span>
                                    @else
                                        <span class="badge badge-light-secondary text-muted">Bawaan Peran</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($user->is_active ?? true)
                                    <span class="badge badge-light-success fw-bold">Aktif</span>
                                @else
                                    <span class="badge badge-light-danger fw-bold">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end flex-shrink-0 gap-2">
                                    <button type="button" class="btn btn-icon btn-light-primary btn-sm btn-action-assign-role" 
                                            data-user-id="{{ $user->id }}" 
                                            data-user-name="{{ $user->name }}" 
                                            data-user-roles="{{ json_encode($user->roles->pluck('name')->toArray()) }}"
                                            title="Ubah Peran Pengguna">
                                        <i class="ki-outline ki-profile-user fs-4"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-light-warning btn-sm btn-action-direct-perm" 
                                            data-user-id="{{ $user->id }}" 
                                            data-user-name="{{ $user->name }}"
                                            title="Atur Izin Khusus (Direct Permissions)">
                                        <i class="ki-outline ki-shield-search fs-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-10">
                                Tidak ada data pengguna yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!--begin::Pagination-->
        <div class="d-flex flex-stack flex-wrap pt-5">
            <div class="fs-6 fw-semibold text-gray-700">
                Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} pengguna
            </div>
            <div>
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
        <!--end::Pagination-->
    </div>
</div>
