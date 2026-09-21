<!--begin::Tab Pane Education Footer & Kontak-->
<form id="kt_form_edu_footer" class="form">
    @csrf
    <div class="row g-6 g-xl-9">
        <!--begin::Col Kontak & Deskripsi-->
        <div class="col-xl-7">
            <div class="card shadow-sm mb-6">
                <!--begin::Card header-->
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
                    <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Informasi Kontak & Footer Kampus</h3>
                        <span class="text-muted fs-7 mt-1">Rincian alamat sekretariat, email admisi, dan hak cipta footer portal</span>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-6 px-4 px-md-6">
                    <!--begin::Row About-->
                    <div class="mb-5">
                        <label class="form-label fs-7 fw-bold text-gray-800">Teks Profil Singkat Footer (About)</label>
                        <textarea name="education_footer_about" class="form-control form-control-solid form-control-sm" rows="3"
                                  placeholder="Deskripsi singkat kampus di bagian footer...">{{ $educationConfig['education_footer_about'] ?? '' }}</textarea>
                    </div>
                    <!--end::Row About-->

                    <!--begin::Row Copyright-->
                    <div class="mb-5">
                        <label class="form-label fs-7 fw-bold text-gray-800 required">Teks Hak Cipta (Copyright)</label>
                        <input type="text" name="education_footer_copyright" class="form-control form-control-solid form-control-sm"
                               placeholder="2026 Unify University. All rights reserved." value="{{ $educationConfig['education_footer_copyright'] ?? '' }}" required />
                    </div>
                    <!--end::Row Copyright-->

                    <div class="separator separator-dashed my-5"></div>

                    <!--begin::Row Contact Details-->
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label class="form-label fs-7 fw-bold text-gray-800">Email Admisi / Informasi</label>
                            <input type="email" name="education_footer_email" class="form-control form-control-solid form-control-sm"
                                   placeholder="admissions@unify-edu.ac.id" value="{{ $educationConfig['education_footer_email'] ?? '' }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-7 fw-bold text-gray-800">Nomor Telepon Sekretariat</label>
                            <input type="text" name="education_footer_phone" class="form-control form-control-solid form-control-sm"
                                   placeholder="+62 (021) 789-0123" value="{{ $educationConfig['education_footer_phone'] ?? '' }}" />
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fs-7 fw-bold text-gray-800">Alamat Kampus Utama</label>
                        <input type="text" name="education_footer_address" class="form-control form-control-solid form-control-sm"
                               placeholder="Jl. Pendidikan Tinggi No. 45, Jakarta" value="{{ $educationConfig['education_footer_address'] ?? '' }}" />
                    </div>
                    <!--end::Row Contact Details-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Col Kontak & Deskripsi-->

        <!--begin::Col Social Media-->
        <div class="col-xl-5">
            <div class="card shadow-sm mb-6">
                <!--begin::Card header-->
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
                    <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Tautan Media Sosial Resmi</h3>
                        <span class="text-muted fs-7 mt-1">Akun jejaring sosial resmi kampus</span>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-6 px-4 px-md-6">
                    <!--begin::Facebook-->
                    <div class="mb-4">
                        <label class="form-label fs-7 fw-bold text-gray-800 d-flex align-items-center">
                            <i class="fab fa-facebook text-primary fs-5 me-2"></i> Facebook
                        </label>
                        <input type="url" name="education_social_facebook" class="form-control form-control-solid form-control-sm"
                               placeholder="https://facebook.com/unify" value="{{ $educationConfig['education_social_facebook'] ?? '' }}" />
                    </div>
                    <!--end::Facebook-->

                    <!--begin::Twitter / X-->
                    <div class="mb-4">
                        <label class="form-label fs-7 fw-bold text-gray-800 d-flex align-items-center">
                            <i class="fab fa-twitter text-info fs-5 me-2"></i> Twitter / X
                        </label>
                        <input type="url" name="education_social_twitter" class="form-control form-control-solid form-control-sm"
                               placeholder="https://twitter.com/unify" value="{{ $educationConfig['education_social_twitter'] ?? '' }}" />
                    </div>
                    <!--end::Twitter / X-->

                    <!--begin::Instagram-->
                    <div class="mb-4">
                        <label class="form-label fs-7 fw-bold text-gray-800 d-flex align-items-center">
                            <i class="fab fa-instagram text-danger fs-5 me-2"></i> Instagram
                        </label>
                        <input type="url" name="education_social_instagram" class="form-control form-control-solid form-control-sm"
                               placeholder="https://instagram.com/unify" value="{{ $educationConfig['education_social_instagram'] ?? '' }}" />
                    </div>
                    <!--end::Instagram-->

                    <!--begin::YouTube-->
                    <div class="mb-4">
                        <label class="form-label fs-7 fw-bold text-gray-800 d-flex align-items-center">
                            <i class="fab fa-youtube text-danger fs-5 me-2"></i> YouTube
                        </label>
                        <input type="url" name="education_social_youtube" class="form-control form-control-solid form-control-sm"
                               placeholder="https://youtube.com/@unify" value="{{ $educationConfig['education_social_youtube'] ?? '' }}" />
                    </div>
                    <!--end::YouTube-->

                    <!--begin::LinkedIn-->
                    <div class="mb-2">
                        <label class="form-label fs-7 fw-bold text-gray-800 d-flex align-items-center">
                            <i class="fab fa-linkedin text-primary fs-5 me-2"></i> LinkedIn
                        </label>
                        <input type="url" name="education_social_linkedin" class="form-control form-control-solid form-control-sm"
                               placeholder="https://linkedin.com/school/unify" value="{{ $educationConfig['education_social_linkedin'] ?? '' }}" />
                    </div>
                    <!--end::LinkedIn-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Col Social Media-->

        <!--begin::Actions Bar-->
        <div class="col-12">
            <div class="card shadow-sm mb-6">
                <div class="card-body p-4 d-flex justify-content-center justify-content-sm-end">
                    <button type="submit" class="btn btn-warning text-white btn-sm fw-bold px-6" id="kt_btn_save_edu_footer">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-4 me-1 text-white"></i> Simpan Pengaturan Footer & Kontak
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span> Menyimpan...
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <!--end::Actions Bar-->
    </div>
</form>
<!--end::Tab Pane Education Footer & Kontak-->
