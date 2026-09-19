<!--begin::Modal - Berikan Peran Massal-->
<div class="modal fade" id="kt_modal_bulk_assign_role" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <!--begin::Modal content-->
        <div class="modal-content rounded-3 shadow-lg border-0">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 position-relative justify-content-center justify-content-sm-between">
                <!--begin::Close (Absolute Top Right on Mobile & Desktop)-->
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary position-absolute top-0 end-0 m-3 m-sm-4 z-index-2" data-bs-dismiss="modal" aria-label="Close"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tutup">
                    <i class="ki-outline ki-cross fs-1"></i>
                </button>
                <!--end::Close-->

                <!--begin::Header Info (3-Baris Center pada Mobile)-->
                <div class="w-100 text-center text-sm-start pe-0 pe-sm-10">
                    <!-- Row 1 (Mobile only): Icon Logo Lingkaran Sempurna -->
                    <div class="d-flex justify-content-center d-sm-none mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light-primary text-primary rounded-circle" 
                             style="width: 60px; height: 60px; min-width: 60px; min-height: 60px;">
                            <i class="ki-outline ki-shield-tick fs-2x text-primary"></i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3">
                        <span class="d-none d-sm-inline">
                            <i class="ki-outline ki-shield-tick fs-2 text-primary me-2"></i>
                        </span>
                        Berikan Peran Massal
                    </h3>

                    <!-- Row 3: Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0">
                        Tetapkan peran secara bersamaan untuk beberapa pengguna terpilih.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-8 px-lg-10 pt-4 pb-8">
                <!--begin:Form-->
                <form id="kt_modal_bulk_role_form" class="form" action="#" method="POST">
                    @csrf

                    <!--begin::Alert Selected Users Info-->
                    <div class="notice d-flex bg-light-primary rounded-3 border-primary border border-dashed p-4 mb-6">
                        <i class="ki-duotone ki-information-5 fs-2tx text-primary me-3 align-self-center">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                        </i>
                        <div class="d-flex flex-stack flex-grow-1">
                            <div class="fw-semibold">
                                <div class="fs-6 text-gray-900 fw-bold">
                                    <span id="bulk_role_modal_count" class="badge badge-primary fs-7 me-1">0</span> Pengguna Terpilih
                                </div>
                                <div class="fs-8 text-muted">
                                    Peran yang Anda pilih di bawah ini akan diterapkan sekaligus kepada pengguna yang telah dicentang.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Alert Selected Users Info-->

                    <!--begin::Input group: Pilih Roles-->
                    <div class="mb-6">
                        <label class="fs-6 form-label fw-bold text-gray-800 required mb-3">Pilih Peran</label>
                        <div class="d-flex flex-column gap-2" id="bulk_roles_list_container">
                            @foreach ($roles as $role)
                                @php
                                    $roleName = $role->name;
                                    $badgeClass = match (strtolower($roleName)) {
                                        'master' => 'badge-light-danger',
                                        'admin' => 'badge-light-primary',
                                        default => 'badge-light-info',
                                    };
                                @endphp
                                <label class="d-flex flex-stack cursor-pointer bg-light-subtle p-3 rounded-3 border border-dashed border-gray-300 border-hover-primary transition-all">
                                    <div class="d-flex align-items-center me-2">
                                        <span class="badge {{ $badgeClass }} fw-bold text-uppercase fs-8 px-3 py-1 me-3">
                                            {{ strtoupper($roleName) }}
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-800 fs-7 text-capitalize">{{ $roleName }}</span>
                                            <span class="text-muted fs-9">{{ $role->permissions()->count() }} izin wewenang terkait</span>
                                        </div>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input bulk-role-checkbox" type="checkbox" name="roles[]" value="{{ $roleName }}" id="bulk_role_{{ $role->id }}" />
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <div class="invalid-feedback d-block mt-2 fs-7" id="error_bulk_roles"></div>
                    </div>
                    <!--end::Input group: Pilih Roles-->

                    <!--begin::Input group: Mode Penerapan-->
                    <div class="mb-8">
                        <label class="fs-6 form-label fw-bold text-gray-800 required mb-3">Metode Penerapan Peran</label>
                        <div class="row g-4">
                            <!-- Option 1: Tambahkan (Gabungkan) -->
                            <div class="col-sm-6">
                                <label class="d-flex flex-column justify-content-between h-100 p-4 rounded-3 border border-dashed border-gray-300 cursor-pointer bg-light-subtle border-hover-primary" for="bulk_mode_append">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="fw-bold text-gray-800 fs-7">Tambahkan (Gabungkan)</span>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="bulk_mode" id="bulk_mode_append" value="append" checked />
                                        </div>
                                    </div>
                                    <span class="text-muted fs-8">
                                        Tambahkan peran baru tanpa menghapus peran yang sudah dimiliki masing-masing pengguna.
                                    </span>
                                </label>
                            </div>

                            <!-- Option 2: Ganti Semua (Timpa) -->
                            <div class="col-sm-6">
                                <label class="d-flex flex-column justify-content-between h-100 p-4 rounded-3 border border-dashed border-gray-300 cursor-pointer bg-light-subtle border-hover-primary" for="bulk_mode_replace">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="fw-bold text-gray-800 fs-7">Ganti Semua (Timpa)</span>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="bulk_mode" id="bulk_mode_replace" value="replace" />
                                        </div>
                                    </div>
                                    <span class="text-muted fs-8">
                                        Gantikan seluruh peran pengguna sebelumnya secara penuh dengan peran yang baru dipilih.
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group: Mode Penerapan-->

                    <!--begin::Actions-->
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-end gap-2 pt-4 border-top border-gray-200">
                        <button type="button" class="btn btn-light fw-bold px-4 px-sm-6" data-bs-dismiss="modal"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal">
                            <i class="ki-outline ki-cross fs-4 me-1"></i>
                            <span>Batal</span>
                        </button>
                        <button type="submit" id="kt_modal_bulk_role_submit" class="btn btn-primary fw-bold px-4 px-sm-6"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Terapkan Peran Massal">
                            <span class="indicator-label">
                                <i class="ki-outline ki-check fs-4 me-1"></i>
                                <span>Terapkan Peran Massal</span>
                            </span>
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                                <span>Menerapkan...</span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Berikan Role Massal-->
