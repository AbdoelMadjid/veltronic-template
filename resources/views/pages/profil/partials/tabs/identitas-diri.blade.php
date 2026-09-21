@php
    $authUser = $user ?? auth()->user();
    $detailData = $detail ?? ($authUser?->detail ?? null);
@endphp

<form action="{{ route('profil.profil-pengguna.identitas') }}" method="POST" enctype="multipart/form-data" id="form_identitas_diri">
    @csrf

    <div class="card shadow-sm border border-gray-200 mb-6">
        <!--begin::Card header-->
        <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
            <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                <h3 class="fw-bolder text-gray-900 m-0 fs-4">Pembaruan Identitas Diri &amp; Domisili</h3>
                <span class="text-muted fs-7 mt-1">Lengkapi data identitas kependudukan (KTP) serta rincian alamat domisili resmi Anda</span>
            </div>
            <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                <span class="badge badge-light-primary fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                    Identitas &amp; Domisili
                </span>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-6 px-4 px-md-6">
            <div class="row g-7 g-xl-10">
                <!--begin::Kolom Kiri: 1. Data KTP-->
                <div class="col-lg-6 border-end-lg pe-lg-8">
                    <h4 class="fw-bold text-gray-800 fs-5 mb-5">
                        1. Data Kartu Tanda Penduduk (KTP)
                    </h4>

                    <!--begin::Row NIK & Nama Lengkap-->
                    <div class="row mb-5">
                        <div class="col-sm-6 mb-4 mb-sm-0">
                            <label class="col-form-label required fw-semibold fs-7 py-1">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik" class="form-control form-control-solid" 
                                   placeholder="Contoh: 3201234567890001" value="{{ old('nik', $detailData?->nik) }}" maxlength="20" required />
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label required fw-semibold fs-7 py-1">Nama Lengkap Sesuai KTP</label>
                            <input type="text" name="nama_lengkap" class="form-control form-control-solid" 
                                   placeholder="Nama lengkap sesuai KTP" value="{{ old('nama_lengkap', $detailData?->nama_lengkap ?? $authUser?->name) }}" required />
                        </div>
                    </div>
                    <!--end::Row-->

                    <!--begin::Row Tempat & Tanggal Lahir-->
                    <div class="row mb-5">
                        <div class="col-sm-6 mb-4 mb-sm-0">
                            <label class="col-form-label fw-semibold fs-7 py-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control form-control-solid" 
                                   placeholder="Kota kelahiran" value="{{ old('tempat_lahir', $detailData?->tempat_lahir) }}" />
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label fw-semibold fs-7 py-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control form-control-solid" 
                                   value="{{ old('tanggal_lahir', $detailData?->tanggal_lahir ? $detailData->tanggal_lahir->format('Y-m-d') : '') }}" />
                        </div>
                    </div>
                    <!--end::Row-->

                    <!--begin::Row Jenis Kelamin & Golongan Darah-->
                    <div class="row mb-5">
                        <div class="col-sm-6 mb-4 mb-sm-0">
                            <label class="col-form-label fw-semibold fs-7 py-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $detailData?->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $detailData?->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label fw-semibold fs-7 py-1">Golongan Darah</label>
                            <select name="golongan_darah" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="">Pilih Golongan Darah</option>
                                @foreach(['A', 'B', 'AB', 'O', '-'] as $goldar)
                                    <option value="{{ $goldar }}" {{ old('golongan_darah', $detailData?->golongan_darah) === $goldar ? 'selected' : '' }}>{{ $goldar }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Row-->

                    <!--begin::Row Agama & Status Perkawinan-->
                    <div class="row mb-5">
                        <div class="col-sm-6 mb-4 mb-sm-0">
                            <label class="col-form-label fw-semibold fs-7 py-1">Agama</label>
                            <select name="agama" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="">Pilih Agama</option>
                                @foreach(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu', 'Lainnya'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama', $detailData?->agama) === $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label fw-semibold fs-7 py-1">Status Perkawinan</label>
                            <select name="status_perkawinan" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="">Pilih Status Perkawinan</option>
                                @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                    <option value="{{ $status }}" {{ old('status_perkawinan', $detailData?->status_perkawinan) === $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Row-->

                    <!--begin::Row Pekerjaan & Kewarganegaraan-->
                    <div class="row mb-5">
                        <div class="col-sm-6 mb-4 mb-sm-0">
                            <label class="col-form-label fw-semibold fs-7 py-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control form-control-solid" 
                                   placeholder="Contoh: Karyawan Swasta, PNS" value="{{ old('pekerjaan', $detailData?->pekerjaan) }}" />
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label fw-semibold fs-7 py-1">Kewarganegaraan</label>
                            <select name="kewarganegaraan" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="WNI" {{ old('kewarganegaraan', $detailData?->kewarganegaraan ?? 'WNI') === 'WNI' ? 'selected' : '' }}>WNI</option>
                                <option value="WNA" {{ old('kewarganegaraan', $detailData?->kewarganegaraan) === 'WNA' ? 'selected' : '' }}>WNA</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Row-->

                    <!--begin::Row No HP-->
                    <div class="mb-5">
                        <label class="col-form-label fw-semibold fs-7 py-1">Nomor HP / WhatsApp</label>
                        <input type="text" name="no_hp" class="form-control form-control-solid" 
                               placeholder="Contoh: 081234567890" value="{{ old('no_hp', $detailData?->no_hp) }}" />
                    </div>
                    <!--end::Row No HP-->

                    <!--begin::Row Moto Hidup-->
                    <div class="mb-0">
                        <label class="col-form-label fw-semibold fs-7 py-1">Moto Hidup</label>
                        <input type="text" name="moto_hidup" class="form-control form-control-solid" 
                               placeholder="Contoh: Terus berinovasi dan bermanfaat untuk sesama" value="{{ old('moto_hidup', $detailData?->moto_hidup) }}" maxlength="500" />
                        <div class="form-text text-muted fs-8">Ditampilkan pada banner dashboard dan profil Anda.</div>
                    </div>
                    <!--end::Row Moto Hidup-->
                </div>
                <!--end::Kolom Kiri: 1. Data KTP-->

                <!--begin::Kolom Kanan: 2. Rincian Alamat Domisili-->
                <div class="col-lg-6 ps-lg-8 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold text-gray-800 fs-5 mb-5">
                            2. Rincian Alamat Domisili Sesuai KTP
                        </h4>

                        <!--begin::Row Jalan-->
                        <div class="mb-5">
                            <label class="col-form-label fw-semibold fs-7 py-1">Jalan / Nama Tempat</label>
                            <input type="text" name="alamat_jalan" class="form-control form-control-solid" 
                                   placeholder="Contoh: Jl. Merdeka No. 10" value="{{ old('alamat_jalan', $detailData?->alamat_jalan) }}" />
                        </div>
                        <!--end::Row Jalan-->

                        <!--begin::Row Blok & Nomor Rumah-->
                        <div class="row mb-5">
                            <div class="col-6">
                                <label class="col-form-label fw-semibold fs-7 py-1">Blok</label>
                                <input type="text" name="blok" class="form-control form-control-solid" 
                                       placeholder="Contoh: A3" value="{{ old('blok', $detailData?->blok) }}" />
                            </div>
                            <div class="col-6">
                                <label class="col-form-label fw-semibold fs-7 py-1">Nomor Rumah</label>
                                <input type="text" name="nomor_rumah" class="form-control form-control-solid" 
                                       placeholder="Contoh: 12" value="{{ old('nomor_rumah', $detailData?->nomor_rumah) }}" />
                            </div>
                        </div>
                        <!--end::Row Blok & Nomor Rumah-->

                        <!--begin::Row RT & RW-->
                        <div class="row mb-5">
                            <div class="col-6">
                                <label class="col-form-label fw-semibold fs-7 py-1">RT</label>
                                <input type="text" name="rt" class="form-control form-control-solid" 
                                       placeholder="001" value="{{ old('rt', $detailData?->rt) }}" />
                            </div>
                            <div class="col-6">
                                <label class="col-form-label fw-semibold fs-7 py-1">RW</label>
                                <input type="text" name="rw" class="form-control form-control-solid" 
                                       placeholder="005" value="{{ old('rw', $detailData?->rw) }}" />
                            </div>
                        </div>
                        <!--end::Row RT & RW-->

                        <!--begin::Row Desa & Kecamatan-->
                        <div class="row mb-5">
                            <div class="col-sm-6 mb-4 mb-sm-0">
                                <label class="col-form-label fw-semibold fs-7 py-1">Desa / Kelurahan</label>
                                <input type="text" name="desa" class="form-control form-control-solid" 
                                       placeholder="Nama Desa / Kelurahan" value="{{ old('desa', $detailData?->desa) }}" />
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label fw-semibold fs-7 py-1">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control form-control-solid" 
                                       placeholder="Nama Kecamatan" value="{{ old('kecamatan', $detailData?->kecamatan) }}" />
                            </div>
                        </div>
                        <!--end::Row Desa & Kecamatan-->

                        <!--begin::Row Kabupaten & Provinsi-->
                        <div class="row mb-5">
                            <div class="col-sm-6 mb-4 mb-sm-0">
                                <label class="col-form-label fw-semibold fs-7 py-1">Kabupaten / Kota</label>
                                <input type="text" name="kabupaten" class="form-control form-control-solid" 
                                       placeholder="Nama Kabupaten / Kota" value="{{ old('kabupaten', $detailData?->kabupaten) }}" />
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label fw-semibold fs-7 py-1">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control form-control-solid" 
                                       placeholder="Nama Provinsi" value="{{ old('provinsi', $detailData?->provinsi) }}" />
                            </div>
                        </div>
                        <!--end::Row Kabupaten & Provinsi-->

                        <!--begin::Row Kode Pos-->
                        <div class="mb-5">
                            <label class="col-form-label fw-semibold fs-7 py-1">Kode Pos</label>
                            <input type="text" name="kode_pos" class="form-control form-control-solid" 
                                   placeholder="Contoh: 40123" value="{{ old('kode_pos', $detailData?->kode_pos) }}" />
                        </div>
                        <!--end::Row Kode Pos-->
                    </div>

                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-4 mt-4">
                        <i class="ki-duotone ki-information-5 fs-2x text-primary me-3 align-self-center">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                        </i>
                        <div class="fs-8 text-gray-700">
                            Pastikan rincian data KTP dan alamat domisili terisi dengan benar sesuai dokumen identitas resmi kependudukan Anda.
                        </div>
                    </div>
                </div>
                <!--end::Kolom Kanan: 2. Rincian Alamat Domisili-->
            </div>
        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer py-4 px-4 px-md-6 border-top border-gray-200 bg-light bg-opacity-50">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-end text-center text-sm-start gap-2">
                <button type="reset" class="btn btn-light btn-active-light-primary w-100 w-sm-auto">Batal</button>
                <button type="submit" class="btn btn-primary w-100 w-sm-auto" id="btn_save_identitas">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-check fs-3 me-1">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                        Simpan Perubahan Identitas
                    </span>
                    <span class="indicator-progress">
                        Menyimpan...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
        <!--end::Card footer-->
    </div>
</form>
