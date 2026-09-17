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

<!--begin::Matrix 2-Column Layout-->
<div class="d-flex flex-column flex-lg-row gap-5 gap-lg-7">
    <!--begin::Sidebar Pilih Role-->
    <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-280px">
        <div class="card card-flush shadow-sm border-0">
            <!--begin::Card Header-->
            <div class="card-header pt-6 pb-2">
                <div class="card-title">
                    <h4 class="fw-bolder text-gray-900 m-0 fs-5">Pilih Role</h4>
                </div>
            </div>
            <!--end::Card Header-->

            <!--begin::Card Body-->
            <div class="card-body pt-2 pb-6 px-4">
                <!--begin::Role Nav Tabs (Vertical Pills)-->
                <ul class="nav nav-pills flex-column gap-2" id="role_access_tabs" role="tablist">
                    @foreach($roles as $index => $role)
                        <li class="nav-item w-100" role="presentation">
                            <a class="nav-link d-flex align-items-center justify-content-between py-3 px-4 rounded-3 role-tab-btn {{ $index === 0 ? 'active' : '' }}" 
                               data-bs-toggle="tab" 
                               href="#role_tab_pane_{{ $role->id }}" 
                               data-role-id="{{ $role->id }}"
                               data-role-name="{{ $role->name }}"
                               role="tab">
                                <span class="fw-bold fs-6">{{ $role->display_name ?? ucwords(str_replace(['_', '-'], ' ', $role->name)) }}</span>
                                <span class="badge badge-light-primary fs-8 fw-semibold" id="tab_badge_role_{{ $role->id }}">
                                    {{ count($matrix[$role->id] ?? []) }} Izin
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <!--end::Role Nav Tabs (Vertical Pills)-->
            </div>
            <!--end::Card Body-->
        </div>
    </div>
    <!--end::Sidebar Pilih Role-->

    <!--begin::Matrix Content-->
    <div class="flex-lg-row-fluid">
        <div class="card card-flush shadow-sm border-0">
            <div class="card-body p-6">
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
                                    'matrixTitle' => 'Hak Akses Role: ' . ($role->display_name ?? ucwords(str_replace(['_', '-'], ' ', $role->name))),
                                    'matrixSubtitle' => 'Matriks Izin Akses CRUD per Modul Aplikasi',
                                    'scrollable' => false,
                                ])
                            </form>
                        </div>
                    @endforeach
                </div>
                <!--end::Tab Contents-->
            </div>
        </div>
    </div>
    <!--end::Matrix Content-->
</div>
<!--end::Matrix 2-Column Layout-->
