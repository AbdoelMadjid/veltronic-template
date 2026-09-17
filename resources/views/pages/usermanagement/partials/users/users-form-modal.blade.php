<!--begin::Modal - Tambah / Ubah Pengguna-->
<div class="modal fade" id="kt_modal_user_form" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="kt_modal_user_form_element" class="form" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="user_form_method" value="POST" />
                    <input type="hidden" name="user_id" id="user_form_id" value="" />
                    <input type="hidden" name="remove_avatar" id="user_form_remove_avatar" value="0" />

                    <!--begin::Heading-->
                    <div class="mb-9 text-center">
                        <!--begin::Title-->
                        <h2 class="fw-bolder text-gray-900 mb-2" id="user_modal_title">Tambah Pengguna Baru</h2>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-6">
                            Lengkapi data akun dan hak akses pengguna sistem.
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Input group: Avatar-->
                    <div class="d-flex flex-column align-items-center mb-8">
                        <label class="fs-6 form-label fw-bold text-gray-800 mb-3">Foto Profil (Avatar)</label>
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
                            <span class="required">Peran (Role)</span>
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
                    <div class="text-center pt-5">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" id="kt_modal_user_form_submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">
                                <i class="ki-duotone ki-check fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                                Simpan Data
                            </span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">
                                Mohon tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
