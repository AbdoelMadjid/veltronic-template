@auth
@php
    $authUser = auth()->user();
    $hasAvatar = !empty($authUser?->avatar_url);
    $profileName = $authUser?->name ?? 'Pengguna';
    $profileEmail = $authUser?->email ?? '';
    $initial = strtoupper(substr($profileName, 0, 1));
    $userRoles = $authUser?->roles ?? collect();
@endphp
@once
<div class="modal fade" id="kt_modal_lock_screen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-450px">
        <!--begin::Modal content-->
        <div class="modal-content rounded-4 shadow-lg border-0 overflow-hidden">
            <!--begin::Modal top decorative header-->
            <div class="bg-light-primary text-center py-8 px-6 position-relative border-bottom border-gray-200">
                <!-- Lock Icon Badge -->
                <div class="d-inline-flex align-items-center justify-content-center w-60px h-60px rounded-circle bg-primary text-white shadow-sm mb-4">
                    <i class="ki-duotone ki-lock fs-2x text-white">
                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                    </i>
                </div>
                
                <h3 class="fw-bolder text-gray-900 mb-1 fs-3">Layar Terkunci</h3>
                <span class="text-muted fw-semibold fs-7">Sesi Anda terkunci otomatis karena tidak ada aktivitas.</span>
            </div>
            <!--end::Modal top decorative header-->

            <!--begin::Modal body-->
            <div class="modal-body p-8">
                <!--begin::User Profile Info-->
                <div class="text-center mb-6">
                    <div class="symbol symbol-75px symbol-circle mb-3 position-relative d-inline-block">
                        <div class="image-input-wrapper w-75px h-75px rounded-circle border border-3 border-light shadow-sm" id="lock_screen_avatar_img"
                            style="{{ user_avatar_style($authUser) }}">
                        </div>
                    </div>

                    <h4 class="fw-bold text-gray-800 mb-1 fs-5" id="lock_screen_user_name">{{ $profileName }}</h4>
                    <div class="text-muted fs-7 mb-2" id="lock_screen_user_email">{{ $profileEmail }}</div>
                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-1" id="lock_screen_user_roles">
                        @forelse ($userRoles as $role)
                            <span class="badge badge-light-primary fw-semibold fs-8 px-2 py-1">{{ ucfirst($role->name) }}</span>
                        @empty
                            <span class="badge badge-light-secondary fw-semibold fs-8 px-2 py-1">User</span>
                        @endforelse
                    </div>
                </div>
                <!--end::User Profile Info-->

                <!--begin::Alert Error Message-->
                <div class="alert alert-danger d-none d-flex align-items-center p-4 mb-5 rounded-3" id="lock_screen_error_alert">
                    <i class="ki-duotone ki-cross-circle fs-2x text-danger me-3">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                    <div class="d-flex flex-column">
                        <span class="fw-bold fs-7 text-danger" id="lock_screen_error_text">Password yang Anda masukkan salah.</span>
                    </div>
                </div>
                <!--end::Alert Error Message-->

                <!--begin::Unlock Form-->
                <form id="kt_lock_screen_form" class="form mb-4" onsubmit="return false;">
                    @csrf
                    <div class="fv-row mb-5">
                        <label class="form-label fw-semibold fs-7 text-gray-700 mb-2">
                            Masukkan Password Anda
                        </label>
                        <div class="position-relative">
                            <input class="form-control form-control-solid pe-12 ps-4" type="password" placeholder="Password akun Anda" name="password" id="lock_screen_password" autocomplete="current-password" required />
                            <button type="button" class="btn btn-icon btn-sm btn-active-color-primary position-absolute top-50 end-0 translate-middle-y me-2" id="btn_toggle_lock_password" tabindex="-1">
                                <i class="ki-duotone ki-eye fs-2" id="icon_lock_password_eye">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                </i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold fs-6 shadow-sm" id="btn_unlock_screen">
                        <span class="indicator-label">
                            <i class="ki-duotone ki-key fs-4 me-2 text-white">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            Buka Kunci Layar
                        </span>
                        <span class="indicator-progress">
                            Memverifikasi...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </form>
                <!--end::Unlock Form-->

                <div class="separator separator-dashed my-5"></div>

                <!--begin::Logout Option-->
                <div class="text-center">
                    <form method="POST" action="{{ route('logout') }}" id="kt_lock_screen_logout_form">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-light-danger fw-semibold px-6 py-2 w-100 d-flex align-items-center justify-content-center">
                            <i class="ki-duotone ki-exit-right fs-4 me-2">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            Keluar / Masuk dengan Akun Lain
                        </button>
                    </form>
                </div>
                <!--end::Logout Option-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@endonce
@endauth
