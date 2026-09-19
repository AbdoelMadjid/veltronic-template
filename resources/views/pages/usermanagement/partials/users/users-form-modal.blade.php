<!--begin::Modal - Tambah / Ubah Pengguna-->
<div class="modal fade" id="kt_modal_user_form" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 position-relative justify-content-center justify-content-sm-between px-6 px-lg-10 pt-6">
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
                            <i class="ki-outline ki-user fs-2x text-primary"></i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3" id="user_modal_title">
                        <span class="d-none d-sm-inline">
                            <i class="ki-outline ki-user fs-2 text-primary me-2"></i>
                        </span>
                        Tambah Pengguna Baru
                    </h3>

                    <!-- Row 3: Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0">
                        Lengkapi data akun dan hak akses pengguna sistem.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--begin::Modal header-->

                    <!--begin::Input group: Avatar-->
                    <div class="d-flex flex-column align-items-center mb-8">
                        <label class="fs-6 form-label fw-bold text-gray-800 mb-3">Foto Profil</label>
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px rounded-3 shadow-sm" id="user_avatar_wrapper"
                                style="background-image: url('{{ \App\Support\ThemeAsset::url('media/svg/avatars/blank.svg') }}'); background-position: 50% 0%; background-size: cover;">
                            </div>
                            <!--end::Preview existing avatar-->

                            <!--begin::Label / Change-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Unggah Foto">
                                <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                <input type="file" name="avatar" id="user_form_avatar" accept=".png, .jpg, .jpeg, .webp" />
                            </label>
                            <!--end::Label-->

                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batalkan">
                                <i class="ki-duotone ki-cross fs-7"><span class="path1"></span><span class="path2"></span></i>
                            </span>
                            <!--end::Cancel-->

                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                id="btn_remove_avatar_trigger" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Foto">
                                <i class="ki-duotone ki-cross fs-7"><span class="path1"></span><span class="path2"></span></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <div class="text-muted fs-8 mt-2">Format yang diizinkan: PNG, JPG, JPEG, WEBP. Maks 2MB.</div>
                        <div class="text-danger fs-7 mt-1 invalid-feedback d-block" id="error_avatar"></div>
                    </div>
                    <!--end::Input group: Avatar-->

                    <!--begin::Input group: Nama Lengkap-->
                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Nama Lengkap</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" id="user_form_name" name="name"
                            placeholder="Masukkan nama lengkap pengguna..." required />
                        <div class="text-danger fs-7 mt-1 invalid-feedback" id="error_name"></div>
                    </div>
                    <!--end::Input group: Nama Lengkap-->

                    <!--begin::Input group: Email-->
                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">Alamat Email</span>
                        </label>
                        <input type="email" class="form-control form-control-solid" id="user_form_email" name="email"
                            placeholder="contoh@domain.com" required />
                        <div class="text-danger fs-7 mt-1 invalid-feedback" id="error_email"></div>
                    </div>
                    <!--end::Input group: Email-->

                    <!--begin::Input group: Role-->
                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="fs-6 fw-bold form-label mb-2">
                            <span class="required">Peran</span>
                            <span class="text-muted fs-8 ms-1">(Dapat memilih lebih dari satu)</span>
                        </label>
                        <select class="form-select form-select-solid" id="user_form_roles" name="roles[]" multiple="multiple"
                            data-control="select2" data-close-on-select="false" data-placeholder="Pilih satu atau lebih peran..."
                            data-allow-clear="true">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger fs-7 mt-1 invalid-feedback" id="error_roles"></div>
                        <div class="text-danger fs-7 mt-1 invalid-feedback" id="error_role"></div>
                    </div>
                    <!--end::Input group: Role-->

                    <!--begin::Input group: Password-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="fs-6 fw-bold form-label mb-2">
                            <span id="user_password_required" class="required">Kata Sandi</span>
                        </label>
                        <input type="password" class="form-control form-control-solid" id="user_form_password"
                            name="password" placeholder="Minimal 8 karakter..." />
                        <div class="text-muted fs-8 mt-1" id="user_password_help">
                            Gunakan kombinasi huruf, angka, dan simbol untuk keamanan maksimal.
                        </div>
                        <div class="text-danger fs-7 mt-1 invalid-feedback" id="error_password"></div>
                    </div>
                    <!--end::Input group: Password-->

                    <!--begin::Actions-->
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-end gap-2 pt-5 border-top border-gray-200">
                        <button type="button" class="btn btn-light fw-bold px-4 px-sm-6" data-bs-dismiss="modal"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal">
                            <i class="ki-outline ki-cross fs-4 me-1"></i>
                            <span>Batal</span>
                        </button>
                        <button type="submit" id="kt_modal_user_form_submit" class="btn btn-primary fw-bold px-4 px-sm-6"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan Data">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">
                                <i class="ki-outline ki-check fs-4 me-1"></i>
                                <span>Simpan Data</span>
                            </span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                                <span>Mohon tunggu...</span>
                            </span>
                            <!--end::Indicator progress-->
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
<!--end::Modal - Tambah / Ubah Pengguna-->
