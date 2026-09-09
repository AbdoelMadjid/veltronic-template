<!--begin::Modal - Tambah / Edit Pengguna-->
<div class="modal fade" id="kt_modal_user_form" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_user_form_header">
                <!--begin::Modal title (Tanpa Ikon sesuai aturan UI)-->
                <h2 class="fw-bold" id="user_modal_title">Tambah Pengguna Baru</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Form-->
            <form id="kt_modal_user_form_element" class="form" action="{{ route('manajemenpengguna.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="user_form_method" value="POST">
                <input type="hidden" name="user_id" id="user_form_id" value="">

                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_user_form_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_user_form_header" data-kt-scroll-wrappers="#kt_modal_user_form_scroll" data-kt-scroll-offset="300px">
                        
                        <!--begin::Input group: Avatar-->
                        <div class="fv-row mb-7 text-center">
                            <label class="d-block fw-semibold fs-6 mb-3">Foto Profil</label>
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline image-input-placeholder" id="kt_user_avatar_input" data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px" id="user_avatar_wrapper" style="background-image: url('{{ \App\Support\ThemeAsset::url('media/svg/avatars/blank.svg') }}');"></div>
                                <!--end::Preview existing avatar-->

                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Ubah Foto Profil">
                                    <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="avatar" id="user_form_avatar" accept=".png, .jpg, .jpeg, .webp, .svg" />
                                    <input type="hidden" name="remove_avatar" id="user_form_remove_avatar" value="0" />
                                    <!--end::Inputs-->
                                 </label>
                                <!--end::Label-->

                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Batalkan Foto Profil">
                                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                                <!--end::Cancel-->

                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Hapus Foto Profil">
                                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <div class="form-text">Format yang didukung: PNG, JPG, JPEG, WEBP. Maksimal 2MB.</div>
                            <div class="invalid-feedback d-block mt-2" id="error_avatar"></div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group: Nama Lengkap-->
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Masukkan nama lengkap pengguna" name="name" id="user_form_name" required />
                            <div class="invalid-feedback" id="error_name"></div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group: Alamat Email-->
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Alamat Email</label>
                            <input type="email" class="form-control form-control-solid" placeholder="contoh: pengguna@domain.com" name="email" id="user_form_email" required />
                            <div class="invalid-feedback" id="error_email"></div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group: Peran-->
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Peran</label>
                            <select class="form-select form-select-solid" name="role" id="user_form_role" required>
                                <option value="">Pilih Peran Pengguna...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="error_role"></div>
                            <div class="text-muted fs-7 mt-1">Menentukan hak akses dan menu yang dapat dijangkau oleh pengguna.</div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group: Kata Sandi-->
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2" id="user_password_label">
                                <span class="required" id="user_password_required">Kata Sandi</span>
                            </label>
                            <div class="position-relative mb-3">
                                <input type="password" class="form-control form-control-solid" placeholder="Minimal 8 karakter" name="password" id="user_form_password" />
                            </div>
                            <div class="invalid-feedback" id="error_password"></div>
                            <div class="text-muted fs-7 mt-1" id="user_password_help">Gunakan kombinasi huruf dan angka minimal 8 karakter.</div>
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->

                <!--begin::Modal footer (Tombol aksi rata kanan)-->
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="kt_modal_user_form_submit" class="btn btn-primary">
                        <span class="indicator-label">
                            <i class="ki-duotone ki-check fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                            Simpan Pengguna
                        </span>
                        <span class="indicator-progress">Menyimpan... 
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Tambah / Edit Pengguna-->
