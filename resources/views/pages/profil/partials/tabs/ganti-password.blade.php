<form action="{{ route('profil.profil-pengguna.password') }}" method="POST" id="form_ganti_password">
    @csrf

    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-gray-800">Ganti Password Akun</h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <div class="alert alert-light-primary d-flex align-items-center p-5 mb-7 rounded-3">
                <i class="ki-duotone ki-shield-tick fs-2hx text-primary me-4">
                    <span class="path1"></span><span class="path2"></span>
                </i>
                <div class="d-flex flex-column">
                    <span class="fw-bold fs-6 text-gray-900 mb-1">Amankan Akun Anda</span>
                    <span class="text-gray-600 fs-7">Gunakan kombinasi minimal 8 karakter yang terdiri dari huruf besar, huruf kecil, angka, dan simbol untuk keamanan maksimal.</span>
                </div>
            </div>

            <!--begin::Current Password-->
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Password Saat Ini</label>
                <div class="col-lg-8">
                    <div class="position-relative">
                        <input type="password" name="current_password" class="form-control form-control-lg form-control-solid pe-12" 
                               placeholder="Masukkan password saat ini" id="input_current_password" required />
                        <button type="button" class="btn btn-icon btn-sm btn-active-color-primary position-absolute top-50 end-0 translate-middle-y me-2" 
                                onclick="const inp=document.getElementById('input_current_password'); inp.type = inp.type==='password'?'text':'password';">
                            <i class="ki-duotone ki-eye fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::Current Password-->

            <!--begin::New Password-->
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Password Baru</label>
                <div class="col-lg-8">
                    <div class="position-relative">
                        <input type="password" name="password" class="form-control form-control-lg form-control-solid pe-12" 
                               placeholder="Masukkan password baru" id="input_new_password" required />
                        <button type="button" class="btn btn-icon btn-sm btn-active-color-primary position-absolute top-50 end-0 translate-middle-y me-2" 
                                onclick="const inp=document.getElementById('input_new_password'); inp.type = inp.type==='password'?'text':'password';">
                            <i class="ki-duotone ki-eye fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </button>
                    </div>
                    <div class="form-text">Minimal 8 karakter.</div>
                </div>
            </div>
            <!--end::New Password-->

            <!--begin::Confirm Password-->
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Konfirmasi Password Baru</label>
                <div class="col-lg-8">
                    <div class="position-relative">
                        <input type="password" name="password_confirmation" class="form-control form-control-lg form-control-solid pe-12" 
                               placeholder="Ulangi password baru" id="input_confirm_password" required />
                        <button type="button" class="btn btn-icon btn-sm btn-active-color-primary position-absolute top-50 end-0 translate-middle-y me-2" 
                                onclick="const inp=document.getElementById('input_confirm_password'); inp.type = inp.type==='password'?'text':'password';">
                            <i class="ki-duotone ki-eye fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::Confirm Password-->
        </div>

        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="reset" class="btn btn-light btn-active-light-primary me-3">Batal</button>
            <button type="submit" class="btn btn-primary" id="btn_save_password">
                <span class="indicator-label">
                    <i class="ki-duotone ki-lock fs-3 me-1">
                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                    </i>
                    Perbarui Password
                </span>
                <span class="indicator-progress">
                    Memperbarui...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </div>
</form>
