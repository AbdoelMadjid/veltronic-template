<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-wrap align-items-center justify-content-between gap-4">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-45px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center">
                <i class="ki-outline ki-shield-search text-primary fs-2"></i>
            </div>
            <div>
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">Matriks Hak Akses Peran (Role Access)</h2>
                <span class="text-muted fs-7">Atur dan sinkronkan perizinan fitur sistem secara terpusat untuk setiap kelompok peran pengguna.</span>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button type="button" id="kt_btn_save_role_matrix" class="btn btn-primary btn-sm fw-bold rounded-pill px-4">
                <span class="indicator-label">
                    <i class="ki-outline ki-check fs-4 me-1"></i> Simpan Peran Ini
                </span>
                <span class="indicator-progress">
                    Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </div>
</div>
<!--end::Header Banner-->

<!--begin::Matrix Card-->
<div class="card card-flush shadow-sm border-0">
    <div class="card-body p-6">
        <!--begin::Role Nav Tabs-->
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold mb-6" id="role_access_tabs" role="tablist">
            @foreach($roles as $index => $role)
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary py-3 me-6 role-tab-btn {{ $index === 0 ? 'active' : '' }}" 
                       data-bs-toggle="tab" 
                       href="#role_tab_pane_{{ $role->id }}" 
                       data-role-id="{{ $role->id }}"
                       data-role-name="{{ $role->name }}"
                       role="tab">
                        {{ $role->display_name ?? ucwords(str_replace(['_', '-'], ' ', $role->name)) }}
                        <span class="badge badge-light-primary ms-2 fs-8 fw-semibold" id="tab_badge_role_{{ $role->id }}">
                            {{ count($matrix[$role->id] ?? []) }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
        <!--end::Role Nav Tabs-->

        <!--begin::Tab Contents-->
        <div class="tab-content" id="role_access_tab_content">
            @foreach($roles as $index => $role)
                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }} role-tab-pane" 
                     id="role_tab_pane_{{ $role->id }}" 
                     data-role-id="{{ $role->id }}" 
                     role="tabpanel">
                    
                    <form id="form_role_matrix_{{ $role->id }}" class="form-role-matrix" data-role-id="{{ $role->id }}">
                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                        
                        @include('pages.usermanagement.partials.shared.crud-matrix-table', [
                            'matrixTree' => $matrixTree,
                            'prefixId' => 'akses_role_' . $role->id,
                            'inputName' => 'permissions[]',
                            'matrixTitle' => 'Hak Akses / Permissions (CRUD Matrix) - Peran: ' . ($role->display_name ?? ucwords(str_replace(['_', '-'], ' ', $role->name))),
                            'matrixSubtitle' => 'Kelola izin fitur yang berlaku untuk peran ini',
                            'scrollable' => false,
                        ])
                    </form>
                </div>
            @endforeach
        </div>
        <!--end::Tab Contents-->
    </div>
</div>
<!--end::Matrix Card-->
