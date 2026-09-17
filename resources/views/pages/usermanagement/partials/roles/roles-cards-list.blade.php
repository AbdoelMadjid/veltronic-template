<!--begin::Roles Cards Grid-->
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-6 g-xl-9" id="kt_roles_cards_grid">
    @foreach($roles as $role)
        @php
            $isProtected = in_array(strtolower($role->name), ['master', 'admin']);
            $roleDisplayName = ucwords(str_replace(['_', '-'], ' ', $role->name));
        @endphp
        <!--begin::Col-->
        <div class="col-md-4 role-card-item" data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}">
            <!--begin::Card-->
            <div class="card card-flush h-md-100 shadow-sm border-0">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h3 class="fw-bolder text-gray-900 m-0">{{ $roleDisplayName }}</h3>
                    </div>
                    <!--end::Card title-->
                    <div class="card-toolbar">
                        @if($isProtected)
                            <span class="badge badge-light-danger fs-8 fw-bolder px-2 py-1" data-bs-toggle="tooltip" title="Peran sistem bawaan terlindungi">System Role</span>
                        @else
                            <span class="badge badge-light-primary fs-8 fw-bolder px-2 py-1">Custom Role</span>
                        @endif
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-1">
                    <!--begin::Users count-->
                    <div class="fw-bold text-gray-600 mb-5">
                        Total Pengguna: <span class="text-gray-900 fw-bolder fs-6" id="role_users_count_{{ $role->id }}">{{ $role->users_count }}</span> Pengguna
                    </div>
                    <!--end::Users count-->

                    <!--begin::Permissions count & Preview-->
                    <div class="d-flex flex-column text-gray-700 mb-6">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="fw-bold fs-7 text-muted">Izin Akses (Permissions):</span>
                            <span class="badge badge-light-info fw-bolder fs-8" id="role_perms_count_{{ $role->id }}">{{ $role->permissions_count }} Izin</span>
                        </div>

                        @if($role->permissions->isNotEmpty())
                            @foreach($role->permissions->take(4) as $perm)
                                <div class="d-flex align-items-center py-1">
                                    <span class="bullet bg-primary me-3"></span>
                                    <span class="fs-7 text-gray-800 font-monospace">{{ $perm->name }}</span>
                                </div>
                            @endforeach

                            @if($role->permissions_count > 4)
                                <div class="d-flex align-items-center py-1">
                                    <span class="bullet bg-primary me-3"></span>
                                    <span class="fs-7 text-muted"><em>dan {{ $role->permissions_count - 4 }} izin lainnya...</em></span>
                                </div>
                            @endif
                        @else
                            <span class="text-muted fs-8 fst-italic py-2">Belum ada permission yang diberikan.</span>
                        @endif
                    </div>
                    <!--end::Permissions count & Preview-->

                    <!--begin::Users Avatar Stack-->
                    @if($role->users->isNotEmpty())
                        <div class="symbol-group symbol-hover mb-4">
                            @foreach($role->users as $u)
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $u->name }}">
                                    @if($u->avatar_url)
                                        <img src="{{ $u->avatar_url }}" alt="{{ $u->name }}" />
                                    @else
                                        <span class="symbol-label bg-light-primary text-primary fw-bold">{{ strtoupper(substr($u->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                            @endforeach
                            @if($role->users_count > 5)
                                <a href="javascript:void(0)" class="symbol symbol-35px symbol-circle btn-view-role" data-id="{{ $role->id }}">
                                    <span class="symbol-label bg-light-dark text-gray-800 fs-8 fw-bold">+{{ $role->users_count - 5 }}</span>
                                </a>
                            @endif
                        </div>
                    @endif
                    <!--end::Users Avatar Stack-->
                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer d-flex align-items-center justify-content-between pt-0 pb-6 border-0">
                    <button type="button" class="btn btn-light-primary btn-sm fw-bold btn-view-role" data-id="{{ $role->id }}"
                        data-bs-toggle="tooltip" title="Lihat Anggota & Seluruh Izin">
                        Lihat Rincian
                    </button>

                    <div class="d-flex align-items-center gap-2 ms-auto flex-shrink-0">
                        <button type="button" class="btn btn-light btn-active-light-primary btn-sm fw-bold btn-edit-role" data-id="{{ $role->id }}"
                            data-bs-toggle="tooltip" title="Ubah Izin Peran">
                            Ubah
                        </button>

                        @if(!$isProtected)
                            <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-delete-role" data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                data-bs-toggle="tooltip" title="Hapus Peran">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        @endif
                    </div>
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->
    @endforeach

    <!--begin::Add new Role Card-->
    <div class="col-md-4">
        <!--begin::Card-->
        <div class="card h-md-100 border-2 border-dashed border-primary border-opacity-50 bg-light-primary d-flex flex-column justify-content-center align-items-center p-8 text-center cursor-pointer"
            id="kt_btn_add_new_role" data-bs-toggle="tooltip" title="Buat kelompok wewenang peran baru">
            <div class="symbol symbol-60px mb-4">
                <span class="symbol-label bg-primary text-white">
                    <i class="ki-duotone ki-plus fs-1 text-white"></i>
                </span>
            </div>
            <h4 class="fw-bolder text-gray-900 mb-1">Tambah Peran Baru</h4>
            <span class="text-muted fs-7 mb-4">Buat role baru dan atur izin fitur sesuai kebutuhan wewenang organisasi.</span>
            <button type="button" class="btn btn-primary btn-sm fw-bold">
                Buat Peran
            </button>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Add new Role Card-->
</div>
<!--end::Roles Cards Grid-->
