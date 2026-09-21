@php
    $authUser = $user ?? auth()->user();
    $detailData = $detail ?? ($authUser?->detail ?? null);
    $userRoles = $authUser?->roles ?? collect();
    $hasKtp = !empty($detailData?->foto_ktp_url);
@endphp

<div class="row g-5 g-xl-10">
    <!--begin::Col 1 - Informasi Akun-->
    <div class="col-xl-6">
        <div class="card shadow-sm border border-gray-200 h-100 d-flex flex-column">
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
                <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                    <h3 class="fw-bolder text-gray-900 m-0 fs-4">Informasi Akun</h3>
                    <span class="text-muted fs-7 mt-1">Detail data autentikasi dan akun pengguna</span>
                </div>
                <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                    <span class="badge badge-light-primary fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                        Akun
                    </span>
                </div>
            </div>
            <div class="card-body py-6 px-4 px-md-6 flex-grow-1">
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
                <!--begin::Moto Hidup Input-->
                <div class="py-4 border-bottom border-gray-200">
                    <form id="form_moto_hidup" action="{{ route('profil.profil-pengguna.moto-hidup') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="fw-semibold text-gray-600 fs-6 mb-0">Moto Hidup</label>
                            <span class="text-muted fs-8">Ditampilkan pada banner dashboard</span>
                        </div>
                        <div class="input-group">
                            <input type="text" name="moto_hidup" id="input_profil_saya_moto_hidup" class="form-control form-control-solid" 
                                placeholder="Tuliskan moto hidup Anda di sini..." 
                                value="{{ $detailData?->moto_hidup ?? '' }}" maxlength="500" />
                            <button type="submit" class="btn btn-primary" id="btn_save_moto_hidup">
                                <span class="indicator-label">
                                    <i class="ki-duotone ki-check fs-4 me-1"></i> Simpan
                                </span>
                                <span class="indicator-progress">
                                    Menyimpan...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <!--end::Moto Hidup Input-->
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
    <!--end::Col 1 - Informasi Akun-->

    <!--begin::Col 2 - Foto KTP (Sebelah Kanan Informasi Akun)-->
    <div class="col-xl-6">
        <div class="card shadow-sm border border-gray-200 h-100 d-flex flex-column">
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
                <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                    <h3 class="fw-bolder text-gray-900 m-0 fs-4">Foto Kartu Tanda Penduduk (KTP)</h3>
                    <span class="text-muted fs-7 mt-1">Dokumen identitas resmi kependudukan</span>
                </div>
                <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                    <span class="badge badge-light-success fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                        Dokumen
                    </span>
                </div>
            </div>
            <div class="card-body py-6 px-4 px-md-6 flex-grow-1 d-flex flex-column align-items-center justify-content-center">
                <form id="form_profil_ktp" action="{{ route('profil.profil-pengguna.ktp') }}" method="POST" enctype="multipart/form-data" class="w-100">
                    @csrf
                    <input type="file" name="foto_ktp" id="input_profil_ktp_file" accept=".png, .jpg, .jpeg, .webp" class="d-none" />
                    <input type="hidden" name="ktp_remove" id="input_profil_ktp_remove" value="" />

                    <!--begin::Container KTP Preview-->
                    <div class="border border-2 border-dashed border-primary rounded-4 p-4 bg-light-primary w-100 max-w-450px mx-auto text-center position-relative {{ $hasKtp ? '' : 'd-none' }}" id="container_ktp_preview">
                        <img src="{{ $detailData?->foto_ktp_url ?? '' }}" alt="Foto KTP" class="img-fluid rounded-3 shadow-sm w-100 max-h-250px object-fit-contain" id="img_profil_ktp_preview" />
                        <div class="mt-4 d-flex justify-content-center gap-2 flex-wrap">
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
                        <i class="ki-duotone ki-badge fs-3x text-gray-400 mb-3">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                        </i>
                        <span class="fw-bold text-gray-700 fs-5 mb-1">Foto KTP Belum Diunggah</span>
                        <span class="text-gray-500 fs-7 mb-4 text-center">Unggah foto KTP resmi Anda (Format JPG, PNG, WEBP maks 2MB) untuk kelengkapan identitas</span>
                        <button type="button" class="btn btn-sm btn-primary fw-bold px-4" id="btn_profil_ktp_upload">
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
    <!--end::Col 2 - Foto KTP-->

    <!--begin::Col 3 - Data Kependudukan (KTP) (Posisi Awal di Bawah)-->
    <div class="col-xl-6">
        <div class="card shadow-sm border border-gray-200 h-100 d-flex flex-column">
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
                <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                    <h3 class="fw-bolder text-gray-900 m-0 fs-4">Data Kependudukan (KTP)</h3>
                    <span class="text-muted fs-7 mt-1">Rincian data identitas sesuai KTP</span>
                </div>
                <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                    <span class="badge badge-light-info fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                        Kependudukan
                    </span>
                </div>
            </div>
            <div class="card-body py-6 px-4 px-md-6 flex-grow-1">
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
    <!--end::Col 3 - Data Kependudukan (KTP)-->

    <!--begin::Col 4 - Alamat Domisili / KTP-->
    <div class="col-xl-6">
        <div class="card shadow-sm border border-gray-200 h-100 d-flex flex-column">
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
                <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                    <h3 class="fw-bolder text-gray-900 m-0 fs-4">Alamat Domisili / KTP</h3>
                    <span class="text-muted fs-7 mt-1">Rincian field alamat terpisah</span>
                </div>
                <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                    <span class="badge badge-light-warning fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                        Domisili
                    </span>
                </div>
            </div>
            <div class="card-body py-6 px-4 px-md-6 flex-grow-1">
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
    <!--end::Col 4 - Alamat Domisili / KTP-->
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
