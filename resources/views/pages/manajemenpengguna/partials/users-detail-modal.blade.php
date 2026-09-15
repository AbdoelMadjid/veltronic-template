<!--begin::Modal - Detail Pengguna-->
<div class="modal fade" id="kt_modal_user_detail" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title (Tanpa Ikon sesuai aturan UI)-->
                <h2 class="fw-bold">Detail Profil Pengguna</h2>
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

            <!--begin::Modal body-->
            <div class="modal-body py-8 px-lg-12">
                <!--begin::User Summary Card-->
                <div class="d-flex align-items-center mb-7">
                    <!--begin::Avatar/Symbol-->
                    <div class="symbol symbol-65px symbol-circle me-5 overflow-hidden">
                        <div class="symbol-label">
                            <img id="detail_user_avatar_img" src="" alt="Avatar" class="d-none w-100 h-100 object-fit-cover" />
                            <span class="bg-light-primary text-primary fw-bolder fs-1 w-100 h-100 d-flex align-items-center justify-content-center" id="detail_user_symbol">
                                U
                            </span>
                        </div>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Info-->
                    <div class="d-flex flex-column">
                        <h4 class="fw-bold text-gray-900 mb-1" id="detail_user_name">-</h4>
                        <span class="text-muted fs-7" id="detail_user_email">-</span>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User Summary Card-->

                <!--begin::Details Table-->
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <tbody>
                            <tr>
                                <td class="text-muted fw-semibold min-w-150px">ID Pengguna</td>
                                <td class="fw-bold text-gray-800" id="detail_user_id">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Peran Pengguna</td>
                                <td>
                                    <span class="badge badge-light-primary fw-bold fs-7" id="detail_user_role">-</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Status Email</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold fs-7" id="detail_user_verified">-</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Tanggal Terdaftar</td>
                                <td class="fw-bold text-gray-800" id="detail_user_created_at">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Terakhir Diperbarui</td>
                                <td class="fw-bold text-gray-800" id="detail_user_updated_at">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--end::Details Table-->
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
            <!--end::Modal footer-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Detail Pengguna-->
