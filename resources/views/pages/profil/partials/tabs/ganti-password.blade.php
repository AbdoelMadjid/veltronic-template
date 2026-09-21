<form action="{{ route('profil.profil-pengguna.password') }}" method="POST" id="form_ganti_password">
    @csrf

    <div class="card shadow-sm border border-gray-200 mb-6">
        <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
            <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                <h3 class="fw-bolder text-gray-900 m-0 fs-4">Ganti Password Akun</h3>
                <span class="text-muted fs-7 mt-1">Perbarui kata sandi akun secara berkala untuk menjaga keamanan akses</span>
            </div>
            <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                <span class="badge badge-light-danger fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                    Keamanan
                </span>
            </div>
        </div>

        <div class="card-body py-6 px-4 px-md-6">
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

        <div class="card-footer py-4 px-4 px-md-6 border-top border-gray-200 bg-light bg-opacity-50">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-end text-center text-sm-start gap-2">
                <button type="reset" class="btn btn-light btn-active-light-primary w-100 w-sm-auto">Batal</button>
                <button type="submit" class="btn btn-primary w-100 w-sm-auto" id="btn_save_password">
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
    </div>
</form>
