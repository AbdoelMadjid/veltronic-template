@php
    $authUser = $user ?? auth()->user();
    $detailData = $detail ?? ($authUser?->detail ?? null);
    $userRoles = $authUser?->roles ?? collect();
    $avatarSrc = $authUser?->avatar_url ?: \App\Support\ThemeAsset::url('media/svg/avatars/blank.svg', $theme_asset_pack ?? null);
@endphp

<div class="row g-5 g-xl-10">
    <!--begin::Col Data Akun & Kontak-->
    <div class="col-xl-6">
        <div class="card card-flush h-xl-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800 fs-4">Informasi Akun</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-7">Detail data autentikasi dan akun pengguna</span>
                </h3>
            </div>
            <div class="card-body pt-5">
                <!--begin::Avatar Input Auto Save-->
                <div class="d-flex flex-stack py-4 border-bottom border-gray-200">
                    <div class="d-flex flex-column pe-4">
                        <span class="fw-semibold text-gray-600 fs-6">Foto Profil / Avatar</span>
                        <span class="text-muted fs-7">Ubah foto profil (Tersimpan otomatis)</span>
                    </div>
                    <div>
                        <form id="form_auto_avatar" action="{{ route('profil.profil-pengguna.avatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ \App\Support\ThemeAsset::url('media/svg/avatars/blank.svg', $theme_asset_pack ?? null) }}');">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-100px h-100px" id="profil_saya_avatar_wrapper"
                                    style="background-image: url('{{ $avatarSrc }}'); background-position: top center; background-size: cover;">
                                </div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah avatar">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="avatar" id="input_auto_avatar_file" accept=".png, .jpg, .jpeg, .webp" />
                                    <input type="hidden" name="avatar_remove" id="input_auto_avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" id="btn_auto_avatar_remove"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus avatar">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                        </form>
                    </div>
                </div>
                <!--end::Avatar Input Auto Save-->

                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Nama Pengguna</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_user_name">{{ $authUser?->name }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Alamat Email</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_user_email">{{ $authUser?->email }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Hak Akses / Role</span>
                    <div class="d-flex gap-1 flex-wrap">
                        @forelse ($userRoles as $role)
                            <span class="badge badge-light-primary fw-bold fs-8">{{ ucfirst($role->name) }}</span>
                        @empty
                            <span class="badge badge-light-secondary fw-bold fs-8">User</span>
                        @endforelse
                    </div>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Nomor HP / WhatsApp</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_no_hp">{{ $detailData?->no_hp ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Status Email</span>
                    <span class="badge badge-light-success fw-bold fs-8">
                        {{ $authUser?->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}
                    </span>
                </div>
                <div class="d-flex flex-stack py-3">
                    <span class="fw-semibold text-gray-600 fs-6">Tanggal Pendaftaran</span>
                    <span class="fw-bold text-gray-800 fs-6">
                        {{ $authUser?->created_at ? $authUser->created_at->translatedFormat('d F Y, H:i') : '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!--end::Col Data Akun & Kontak-->

    <!--begin::Col Foto KTP-->
    <div class="col-xl-6">
        <div class="card card-flush h-xl-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800 fs-4">Foto Kartu Tanda Penduduk (KTP)</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-7">Dokumen identitas resmi pengguna</span>
                </h3>
            </div>
            <div class="card-body pt-5 text-center d-flex flex-column align-items-center justify-content-center">
                <form id="form_profil_ktp" action="{{ route('profil.profil-pengguna.ktp') }}" method="POST" enctype="multipart/form-data" class="w-100">
                    @csrf
                    <input type="file" name="foto_ktp" id="input_profil_ktp_file" accept=".png, .jpg, .jpeg, .webp" class="d-none" />
                    <input type="hidden" name="ktp_remove" id="input_profil_ktp_remove" value="" />

                    @php
                        $hasKtp = !empty($detailData?->foto_ktp_url);
                    @endphp

                    <!--begin::Container KTP Preview-->
                    <div class="border border-2 border-dashed border-primary rounded-4 p-3 bg-light-primary w-100 max-w-400px mx-auto position-relative {{ $hasKtp ? '' : 'd-none' }}" id="container_ktp_preview">
                        <img src="{{ $detailData?->foto_ktp_url ?? '' }}" alt="Foto KTP" class="img-fluid rounded-3 shadow-sm w-100 max-h-250px object-fit-contain" id="img_profil_ktp_preview" />
                        <div class="mt-3 d-flex justify-content-center gap-2 flex-wrap">
                            <button type="button" class="btn btn-sm btn-light-primary fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_view_ktp" id="btn_profil_ktp_view">
                                <i class="ki-duotone ki-eye fs-5 me-1">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                </i>
                                Lihat Gambar
                            </button>
                            <button type="button" class="btn btn-sm btn-primary fw-bold" id="btn_profil_ktp_change">
                                <i class="ki-duotone ki-pencil fs-5 me-1">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                                Ganti KTP
                            </button>
                            <button type="button" class="btn btn-sm btn-light-danger fw-bold" id="btn_profil_ktp_remove">
                                <i class="ki-duotone ki-trash fs-5 me-1">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                </i>
                                Hapus
                            </button>
                        </div>
                    </div>
                    <!--end::Container KTP Preview-->

                    <!--begin::Container KTP Placeholder-->
                    <div class="border border-2 border-dashed border-gray-300 rounded-4 p-8 bg-light w-100 d-flex flex-column align-items-center justify-content-center {{ $hasKtp ? 'd-none' : '' }}" id="container_ktp_placeholder">
                        <i class="ki-duotone ki-badge fs-4x text-gray-400 mb-3">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                        </i>
                        <span class="fw-bold text-gray-700 fs-6 mb-1">Foto KTP Belum Diunggah</span>
                        <span class="text-gray-500 fs-7 mb-4">Unggah foto KTP resmi Anda (Format JPG, PNG, WEBP maks 2MB)</span>
                        <button type="button" class="btn btn-sm btn-primary fw-bold" id="btn_profil_ktp_upload">
                            <i class="ki-duotone ki-file-up fs-5 me-1">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            Unggah Foto KTP Sekarang
                        </button>
                    </div>
                    <!--end::Container KTP Placeholder-->
                </form>
            </div>
        </div>
    </div>
    <!--end::Col Foto KTP-->

    <!--begin::Col Detail Data KTP-->
    <div class="col-xl-6">
        <div class="card card-flush">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800 fs-4">Data Kependudukan (KTP)</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-7">Rincian data identitas sesuai KTP</span>
                </h3>
            </div>
            <div class="card-body pt-5">
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">NIK</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_nik">{{ $detailData?->nik ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Nama Sesuai KTP</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_nama_lengkap">{{ $detailData?->nama_lengkap ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Tempat & Tanggal Lahir</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_ttl">
                        {{ ($detailData?->tempat_lahir ?? '-') . ', ' . ($detailData?->tanggal_lahir ? $detailData->tanggal_lahir->translatedFormat('d F Y') : '-') }}
                    </span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Jenis Kelamin</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_jenis_kelamin">{{ $detailData?->jenis_kelamin ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Golongan Darah</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_golongan_darah">{{ $detailData?->golongan_darah ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Agama</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_agama">{{ $detailData?->agama ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Status Perkawinan</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_status_perkawinan">{{ $detailData?->status_perkawinan ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Pekerjaan</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_pekerjaan">{{ $detailData?->pekerjaan ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Kewarganegaraan</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_kewarganegaraan">{{ $detailData?->kewarganegaraan ?? 'WNI' }}</span>
                </div>
                <div class="d-flex flex-stack py-3">
                    <span class="fw-semibold text-gray-600 fs-6">Berlaku Hingga</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_berlaku_hingga">{{ $detailData?->berlaku_hingga ?? 'Seumur Hidup' }}</span>
                </div>
            </div>
        </div>
    </div>
    <!--end::Col Detail Data KTP-->

    <!--begin::Col Detail Alamat Terpisah-->
    <div class="col-xl-6">
        <div class="card card-flush">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800 fs-4">Alamat Domisili / KTP</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-7">Rincian field alamat terpisah</span>
                </h3>
            </div>
            <div class="card-body pt-5">
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Alamat Jalan</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_alamat_jalan">{{ $detailData?->alamat_jalan ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Blok / No. Rumah</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_blok_norumah">
                        {{ ($detailData?->blok ? 'Blok ' . $detailData->blok : '-') . ' / ' . ($detailData?->nomor_rumah ? 'No. ' . $detailData->nomor_rumah : '-') }}
                    </span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">RT / RW</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_rt_rw">
                        RT {{ $detailData?->rt ?? '-' }} / RW {{ $detailData?->rw ?? '-' }}
                    </span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Desa / Kelurahan</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_desa">{{ $detailData?->desa ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Kecamatan</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_kecamatan">{{ $detailData?->kecamatan ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Kabupaten / Kota</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_kabupaten">{{ $detailData?->kabupaten ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Provinsi</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_provinsi">{{ $detailData?->provinsi ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                    <span class="fw-semibold text-gray-600 fs-6">Kode Pos</span>
                    <span class="fw-bold text-gray-800 fs-6" id="profil_display_kode_pos">{{ $detailData?->kode_pos ?? '-' }}</span>
                </div>
                <div class="d-flex flex-stack py-3">
                    <span class="fw-semibold text-gray-600 fs-6">Alamat Lengkap</span>
                    <span class="fw-bold text-gray-800 fs-6 text-end max-w-250px" id="profil_display_alamat_lengkap">{{ $detailData?->alamat_lengkap ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>
    <!--end::Col Detail Alamat Terpisah-->
</div>

<!--begin::Modal View KTP-->
<div class="modal fade" id="kt_modal_view_ktp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Dokumen Foto KTP</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7 text-center">
                <div class="mb-5">
                    <img src="{{ $detailData?->foto_ktp_url ?? '' }}" alt="Dokumen KTP {{ $authUser?->name }}" class="img-fluid rounded-3 shadow-sm max-h-400px w-100 object-fit-contain" id="img_modal_ktp_preview" />
                </div>
                <div class="text-muted fs-7">
                    NIK: <span class="fw-bold text-gray-800" id="modal_ktp_nik">{{ $detailData?->nik ?? '-' }}</span> &bull; Nama: <span class="fw-bold text-gray-800" id="modal_ktp_nama">{{ $detailData?->nama_lengkap ?? $authUser?->name }}</span>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ $detailData?->foto_ktp_url ?? '#' }}" download="KTP-{{ \Illuminate\Support\Str::slug($authUser?->name ?? 'user') }}.jpg" class="btn btn-primary" id="link_modal_ktp_download" target="_blank">
                    <i class="ki-duotone ki-file-down fs-4 me-1">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                    Download / Simpan Gambar
                </a>
            </div>
        </div>
    </div>
</div>
<!--end::Modal View KTP-->
