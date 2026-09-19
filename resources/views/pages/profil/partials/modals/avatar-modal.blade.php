@php
    $authUser = $user ?? auth()->user();
    $hasAvatar = !empty($authUser?->avatar);
    $avatarPosY = (int) ($authUser?->setting('avatar_position_y', $hasAvatar ? '0' : '50') ?? ($hasAvatar ? '0' : '50'));
    $avatarPosX = (int) ($authUser?->setting('avatar_position_x', '50') ?? '50');
    $avatarZoom = (int) ($authUser?->setting('avatar_zoom', '100') ?? '100');
@endphp

<!--begin::Modal - Update Avatar & Fokus Posisi-->
<div class="modal fade" id="kt_modal_update_avatar" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded-4 shadow-lg border-0">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 position-relative pt-7 pt-sm-6 px-6 px-lg-10">
                <!--begin::Close Button (Top-Right on Mobile & Desktop)-->
                <div class="position-absolute top-0 end-0 m-3 m-sm-4 z-index-2">
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tutup">
                        <i class="ki-outline ki-cross fs-2"></i>
                    </button>
                </div>
                <!--end::Close Button-->

                <!--begin::Header Info (Center in mobile: Row 1 Icon, Row 2 Title, Row 3 Description)-->
                <div class="w-100 text-center text-sm-start pe-0 pe-sm-10">
                    <!-- Row 1 (Mobile only): Icon Logo Lingkaran Sempurna -->
                    <div class="d-flex justify-content-center d-sm-none mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light-primary text-primary rounded-circle" 
                             style="width: 60px; height: 60px; min-width: 60px; min-height: 60px;">
                            <i class="ki-duotone ki-user-square fs-2x text-primary">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                            </i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3">
                        <i class="ki-duotone ki-user-square fs-2 text-primary me-2 d-none d-sm-inline-flex">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                        </i>
                        Ubah Foto Profil &amp; Fokus Tampilan
                    </h3>

                    <!-- Row 3: Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0">
                        Unggah foto profil baru Anda atau sesuaikan skala perbesaran (zoom), posisi vertikal, dan horizontal agar fokus wajah atau gambar tampil optimal sesuai bentuk avatar sistem.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-6 px-lg-10 pt-4 pb-8">
                <!--begin::Form-->
                <form id="form_modal_avatar" action="{{ route('profil.profil-pengguna.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="avatar" id="input_modal_avatar_file" accept=".png, .jpg, .jpeg, .webp" class="d-none" />
                    <input type="hidden" name="avatar_remove" id="input_modal_avatar_remove" value="" />

                    <!--begin::Section 1: Live Preview Avatar & Upload Buttons-->
                    <div class="card bg-light-subtle border border-gray-200 rounded-3 p-5 mb-6 text-center">
                        <div class="d-flex flex-column align-items-center">
                            <!--begin::Preview Box (Bentuk Kotak Rounded-3 Sesuai Tampilan Avatar Sistem)-->
                            <div class="mb-3 position-relative">
                                <div class="rounded-3 border border-4 border-primary shadow-sm position-relative overflow-hidden"
                                    id="modal_avatar_preview_wrapper"
                                    style="width: 160px; height: 160px; min-width: 160px; min-height: 160px; background-repeat: no-repeat; {{ user_avatar_style($authUser) }} transition: background-position 0.15s ease, background-size 0.15s ease;">
                                </div>
                            </div>
                            <!--end::Preview Box-->

                            <!--begin::Action Buttons-->
                            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap justify-content-center">
                                <button type="button" class="btn btn-sm btn-primary" id="btn_modal_avatar_choose"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pilih berkas foto">
                                    <i class="ki-duotone ki-file-up fs-5 me-1">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    Pilih / Ganti Foto
                                </button>
                                <button type="button" class="btn btn-sm btn-light-danger {{ $hasAvatar ? '' : 'd-none' }}" id="btn_modal_avatar_remove"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Hapus foto saat ini">
                                    <i class="ki-duotone ki-trash fs-5 me-1">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                    </i>
                                    Hapus Foto
                                </button>
                            </div>
                            <!--end::Action Buttons-->

                            <span class="text-muted fs-8">Format didukung: PNG, JPG, JPEG, WEBP (Maksimal 2MB)</span>
                            <div id="modal_avatar_file_info" class="badge badge-light-success mt-2 py-2 px-3 d-none">
                                <i class="ki-duotone ki-check-circle fs-6 me-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                Foto baru terpilih: <span id="modal_avatar_file_name" class="fw-bolder ms-1"></span>
                            </div>
                        </div>
                    </div>
                    <!--end::Section 1-->

                    <!--begin::Section 2: Slider Controls for Zoom, Y, X-->
                    <div class="bg-body border border-gray-200 rounded-3 p-5 mb-6">
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 mb-5 border-bottom border-gray-200 pb-3 text-center text-sm-start">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px symbol-circle bg-light-primary text-primary me-3 d-flex align-items-center justify-content-center flex-shrink-0">
                                    <i class="ki-duotone ki-setting-4 fs-3 text-primary"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                                <div class="d-flex flex-column text-center text-sm-start">
                                    <span class="fs-6 fw-bolder text-gray-800">
                                        Pengaturan Fokus &amp; Perbesaran Avatar
                                    </span>
                                    <span class="text-muted fs-8 d-none d-sm-inline">Sesuaikan skala zoom dan titik koordinat tampilan</span>
                                </div>
                            </div>
                            <span class="badge badge-light-primary border border-primary border-opacity-25 fw-bold fs-8 px-3 py-2 rounded-pill d-inline-flex align-items-center gap-1">
                                <i class="ki-outline ki-eye fs-7 text-primary"></i>
                                <span>Pratinjau Langsung</span>
                            </span>
                        </div>

                        <!-- Baris 1: Zoom / Perbesaran (Skala Gambar) -->
                        <div class="mb-5 pb-4 border-bottom border-gray-100">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="fs-7 fw-bold text-gray-700 m-0">1. Zoom / Perbesaran Gambar</label>
                                <span class="badge badge-light-success fw-bold fs-8" id="label_modal_avatar_zoom_val">
                                    {{ $avatarZoom }}% {{ $avatarZoom === 100 ? '(Normal / 1x)' : ($avatarZoom === 150 ? '(1.5x)' : ($avatarZoom === 200 ? '(2x)' : ($avatarZoom === 300 ? '(3x)' : ($avatarZoom === 400 ? '(4x)' : ($avatarZoom === 500 ? '(5x / Maksimal)' : '('.number_format($avatarZoom/100, 1).'x)'))))) }}
                                </span>
                            </div>
                            <input type="range" class="form-range w-100 mb-2" min="100" max="500" step="5" 
                                   name="avatar_zoom" id="input_modal_avatar_zoom" 
                                   value="{{ $avatarZoom }}" />
                            <div class="d-flex justify-content-between text-muted fs-9 px-1 mb-2">
                                <span>100% (1x)</span>
                                <span>200% (2x)</span>
                                <span>300% (3x)</span>
                                <span>400% (4x)</span>
                                <span>500% (5x / Maks)</span>
                            </div>
                            <div class="d-flex gap-1 flex-wrap">
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-zoom py-1 px-2 fs-8" data-zoom="100">Normal (1x)</button>
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-zoom py-1 px-2 fs-8" data-zoom="150">1.5x</button>
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-zoom py-1 px-2 fs-8" data-zoom="200">2x</button>
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-zoom py-1 px-2 fs-8" data-zoom="300">3x</button>
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-zoom py-1 px-2 fs-8" data-zoom="400">4x</button>
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-zoom py-1 px-2 fs-8" data-zoom="500">5x (Maks)</button>
                            </div>
                        </div>

                        <!-- Baris 2: Fokus Vertikal (Y) -->
                        <div class="mb-5 pb-4 border-bottom border-gray-100">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="fs-7 fw-bold text-gray-700 m-0">2. Fokus Vertikal (Atas - Bawah)</label>
                                <span class="badge badge-light-primary fw-bold fs-8" id="label_modal_avatar_position_y_val">
                                    {{ $avatarPosY }}% {{ $avatarPosY === 0 ? '(Atas)' : ($avatarPosY === 50 ? '(Tengah)' : ($avatarPosY === 100 ? '(Bawah)' : '')) }}
                                </span>
                            </div>
                            <input type="range" class="form-range w-100 mb-2" min="0" max="100" step="1" 
                                   name="avatar_position_y" id="input_modal_avatar_position_y" 
                                   value="{{ $avatarPosY }}" />
                            <div class="d-flex justify-content-between text-muted fs-9 px-1 mb-2">
                                <span>Atas (0%)</span>
                                <span>Tengah (50%)</span>
                                <span>Bawah (100%)</span>
                            </div>
                            <div class="d-flex gap-1">
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-pos-y py-1 px-3 fs-8" data-pos="0">Atas (0%)</button>
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-pos-y py-1 px-3 fs-8" data-pos="50">Tengah (50%)</button>
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-pos-y py-1 px-3 fs-8" data-pos="100">Bawah (100%)</button>
                            </div>
                        </div>

                        <!-- Baris 3: Fokus Horizontal (X) -->
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="fs-7 fw-bold text-gray-700 m-0">3. Fokus Horizontal (Kiri - Kanan)</label>
                                <span class="badge badge-light-info fw-bold fs-8" id="label_modal_avatar_position_x_val">
                                    {{ $avatarPosX }}% {{ $avatarPosX === 0 ? '(Kiri)' : ($avatarPosX === 50 ? '(Tengah)' : ($avatarPosX === 100 ? '(Kanan)' : '')) }}
                                </span>
                            </div>
                            <input type="range" class="form-range w-100 mb-2" min="0" max="100" step="1" 
                                   name="avatar_position_x" id="input_modal_avatar_position_x" 
                                   value="{{ $avatarPosX }}" />
                            <div class="d-flex justify-content-between text-muted fs-9 px-1 mb-2">
                                <span>Kiri (0%)</span>
                                <span>Tengah (50%)</span>
                                <span>Kanan (100%)</span>
                            </div>
                            <div class="d-flex gap-1">
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-pos-x py-1 px-3 fs-8" data-pos="0">Kiri (0%)</button>
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-pos-x py-1 px-3 fs-8" data-pos="50">Tengah (50%)</button>
                                <button type="button" class="btn btn-xs btn-light btn-modal-avatar-pos-x py-1 px-3 fs-8" data-pos="100">Kanan (100%)</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Section 2-->

                    <!--begin::Actions-->
                    <div class="d-flex justify-content-center justify-content-sm-end gap-2 pt-2 border-top border-gray-200">
                        <button type="reset" class="btn btn-light" data-bs-dismiss="modal"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal">
                            <i class="ki-outline ki-cross fs-4 me-1"></i>
                            <span>Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary" id="btn_modal_avatar_save"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan Avatar & Posisi">
                            <span class="indicator-label">
                                <i class="ki-duotone ki-check fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                                <span>Simpan Avatar &amp; Posisi</span>
                            </span>
                            <span class="indicator-progress">
                                <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                                <span>Menyimpan...</span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Update Avatar & Fokus Posisi-->
