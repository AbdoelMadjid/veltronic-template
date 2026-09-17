<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-wrap align-items-center justify-content-between gap-4">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-45px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center">
                <i class="ki-outline ki-shield-tick text-primary fs-2"></i>
            </div>
            <div>
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">Manajemen Peran & Wewenang (Roles)</h2>
                <span class="text-muted fs-7">Kelola kelompok peran pengguna sistem dan konfigurasi matriks hak akses CRUD.</span>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button type="button" class="btn btn-primary btn-sm fw-bold rounded-pill px-4" id="kt_btn_add_role_banner">
                <i class="ki-outline ki-plus fs-4 me-1"></i> Tambah Peran Baru
            </button>
        </div>
    </div>
</div>
<!--end::Header Banner-->

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
                                <div class="symbol symbol-35px" data-bs-toggle="tooltip" title="{{ $u->name }}">
                                    @if($u->avatar)
                                        <div class="image-input-wrapper w-35px h-35px rounded-3" style="{{ user_avatar_style($u) }}"></div>
                                    @else
                                        <span class="symbol-label bg-light-primary text-primary fw-bold rounded-3">{{ $u->initial }}</span>
                                    @endif
                                </div>
                            @endforeach
                            @if($role->users_count > 5)
                                <a href="javascript:void(0)" class="symbol symbol-35px btn-view-role" data-id="{{ $role->id }}">
                                    <span class="symbol-label bg-light-dark text-gray-800 fs-8 fw-bold rounded-3">+{{ $role->users_count - 5 }}</span>
                                </a>
                            @endif
                        </div>
                    @endif
                    <!--end::Users Avatar Stack-->
                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer d-flex align-items-center justify-content-between pt-0 pb-6 border-0">
                    <button type="button" class="btn btn-light-primary btn-sm fw-bold btn-view-role" 
                        data-id="{{ $role->id }}"
                        data-name="{{ $roleDisplayName }}"
                        data-is-protected="{{ $isProtected ? '1' : '0' }}"
                        data-users-count="{{ $role->users_count }}"
                        data-perms-count="{{ $role->permissions_count }}"
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

    <!--begin::Add new Role Card (Clickable Clean Widget)-->
    <div class="col-md-4">
        <!--begin::Card-->
        <div class="card h-md-100 min-h-250px border-2 border-dashed border-primary border-opacity-40 bg-light-primary bg-opacity-20 bg-hover-light-primary border-hover-primary d-flex flex-column justify-content-center align-items-center p-8 text-center cursor-pointer shadow-none shadow-hover transition-all"
            id="kt_btn_add_new_role" data-bs-toggle="tooltip" title="Klik untuk membuat peran baru">
            <h4 class="fw-bolder text-gray-900 fs-4 mb-2">Tambah Peran Baru</h4>
            <span class="text-muted fs-7 max-w-250px">Klik area ini untuk membuat peran wewenang baru dan menentukan hak akses modul sistem.</span>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Add new Role Card-->
</div>
<!--end::Roles Cards Grid-->
