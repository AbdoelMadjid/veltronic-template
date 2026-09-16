@php
    $authUser = $user ?? auth()->user();
    $detailData = $detail ?? ($authUser?->detail ?? null);
@endphp

<form action="{{ route('profil.profil-pengguna.identitas') }}" method="POST" enctype="multipart/form-data" id="form_identitas_diri">
    @csrf

    <!--begin::Card Data KTP-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-gray-800">1. Data Kartu Tanda Penduduk (KTP)</h3>
            </div>
        </div>

        <div class="card-body border-top p-9">

            <!--begin::Row NIK & Nama Lengkap-->
            <div class="row mb-6">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <label class="col-form-label required fw-semibold fs-6">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="nik" class="form-control form-control-lg form-control-solid" 
                           placeholder="Contoh: 3201234567890001" value="{{ old('nik', $detailData?->nik) }}" maxlength="20" required />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label required fw-semibold fs-6">Nama Lengkap Sesuai KTP</label>
                    <input type="text" name="nama_lengkap" class="form-control form-control-lg form-control-solid" 
                           placeholder="Nama lengkap sesuai KTP" value="{{ old('nama_lengkap', $detailData?->nama_lengkap ?? $authUser?->name) }}" required />
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row Tempat & Tanggal Lahir-->
            <div class="row mb-6">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control form-control-lg form-control-solid" 
                           placeholder="Kota kelahiran" value="{{ old('tempat_lahir', $detailData?->tempat_lahir) }}" />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label fw-semibold fs-6">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control form-control-lg form-control-solid" 
                           value="{{ old('tanggal_lahir', $detailData?->tanggal_lahir ? $detailData->tanggal_lahir->format('Y-m-d') : '') }}" />
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row Jenis Kelamin & Golongan Darah-->
            <div class="row mb-6">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select form-select-lg form-select-solid" data-control="select2" data-hide-search="true">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $detailData?->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $detailData?->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label fw-semibold fs-6">Golongan Darah</label>
                    <select name="golongan_darah" class="form-select form-select-lg form-select-solid" data-control="select2" data-hide-search="true">
                        <option value="">Pilih Golongan Darah</option>
                        @foreach(['A', 'B', 'AB', 'O', '-'] as $goldar)
                            <option value="{{ $goldar }}" {{ old('golongan_darah', $detailData?->golongan_darah) === $goldar ? 'selected' : '' }}>{{ $goldar }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row Agama & Status Perkawinan-->
            <div class="row mb-6">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Agama</label>
                    <select name="agama" class="form-select form-select-lg form-select-solid" data-control="select2" data-hide-search="true">
                        <option value="">Pilih Agama</option>
                        @foreach(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu', 'Lainnya'] as $agama)
                            <option value="{{ $agama }}" {{ old('agama', $detailData?->agama) === $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label fw-semibold fs-6">Status Perkawinan</label>
                    <select name="status_perkawinan" class="form-select form-select-lg form-select-solid" data-control="select2" data-hide-search="true">
                        <option value="">Pilih Status Perkawinan</option>
                        @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                            <option value="{{ $status }}" {{ old('status_perkawinan', $detailData?->status_perkawinan) === $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row Pekerjaan, Kewarganegaraan, No HP-->
            <div class="row mb-6">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control form-control-lg form-control-solid" 
                           placeholder="Contoh: Karyawan Swasta, PNS" value="{{ old('pekerjaan', $detailData?->pekerjaan) }}" />
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Kewarganegaraan</label>
                    <select name="kewarganegaraan" class="form-select form-select-lg form-select-solid" data-control="select2" data-hide-search="true">
                        <option value="WNI" {{ old('kewarganegaraan', $detailData?->kewarganegaraan ?? 'WNI') === 'WNI' ? 'selected' : '' }}>WNI</option>
                        <option value="WNA" {{ old('kewarganegaraan', $detailData?->kewarganegaraan) === 'WNA' ? 'selected' : '' }}>WNA</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label class="col-form-label fw-semibold fs-6">Nomor HP / WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control form-control-lg form-control-solid" 
                           placeholder="Contoh: 081234567890" value="{{ old('no_hp', $detailData?->no_hp) }}" />
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row Moto Hidup-->
            <div class="row mb-6">
                <div class="col-12">
                    <label class="col-form-label fw-semibold fs-6">Moto Hidup</label>
                    <input type="text" name="moto_hidup" class="form-control form-control-lg form-control-solid" 
                           placeholder="Contoh: Terus berinovasi dan bermanfaat untuk sesama" value="{{ old('moto_hidup', $detailData?->moto_hidup) }}" maxlength="500" />
                    <div class="form-text text-muted">Moto hidup ini akan ditampilkan di banner dashboard dan profil Anda.</div>
                </div>
            </div>
            <!--end::Row-->
        </div>
    </div>
    <!--end::Card Data Profil & KTP-->

    <!--begin::Card Alamat Terpisah-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-gray-800">2. Rincian Alamat Domisili Sesuai KTP</h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <!--begin::Row Jalan & Blok / No Rumah-->
            <div class="row mb-6">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Jalan / Nama Tempat</label>
                    <input type="text" name="alamat_jalan" class="form-control form-control-lg form-control-solid" 
                           placeholder="Contoh: Jl. Merdeka No. 10" value="{{ old('alamat_jalan', $detailData?->alamat_jalan) }}" />
                </div>
                <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Blok</label>
                    <input type="text" name="blok" class="form-control form-control-lg form-control-solid" 
                           placeholder="Contoh: A3" value="{{ old('blok', $detailData?->blok) }}" />
                </div>
                <div class="col-lg-3 col-6">
                    <label class="col-form-label fw-semibold fs-6">Nomor Rumah</label>
                    <input type="text" name="nomor_rumah" class="form-control form-control-lg form-control-solid" 
                           placeholder="Contoh: 12" value="{{ old('nomor_rumah', $detailData?->nomor_rumah) }}" />
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row RT, RW, Desa / Kelurahan-->
            <div class="row mb-6">
                <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">RT</label>
                    <input type="text" name="rt" class="form-control form-control-lg form-control-solid" 
                           placeholder="001" value="{{ old('rt', $detailData?->rt) }}" />
                </div>
                <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">RW</label>
                    <input type="text" name="rw" class="form-control form-control-lg form-control-solid" 
                           placeholder="005" value="{{ old('rw', $detailData?->rw) }}" />
                </div>
                <div class="col-lg-6">
                    <label class="col-form-label fw-semibold fs-6">Desa / Kelurahan</label>
                    <input type="text" name="desa" class="form-control form-control-lg form-control-solid" 
                           placeholder="Nama Desa / Kelurahan" value="{{ old('desa', $detailData?->desa) }}" />
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row Kecamatan, Kabupaten / Kota, Provinsi, Kode Pos-->
            <div class="row mb-6">
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control form-control-lg form-control-solid" 
                           placeholder="Nama Kecamatan" value="{{ old('kecamatan', $detailData?->kecamatan) }}" />
                </div>
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Kabupaten / Kota</label>
                    <input type="text" name="kabupaten" class="form-control form-control-lg form-control-solid" 
                           placeholder="Nama Kabupaten / Kota" value="{{ old('kabupaten', $detailData?->kabupaten) }}" />
                </div>
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <label class="col-form-label fw-semibold fs-6">Provinsi</label>
                    <input type="text" name="provinsi" class="form-control form-control-lg form-control-solid" 
                           placeholder="Nama Provinsi" value="{{ old('provinsi', $detailData?->provinsi) }}" />
                </div>
                <div class="col-lg-3">
                    <label class="col-form-label fw-semibold fs-6">Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control form-control-lg form-control-solid" 
                           placeholder="Contoh: 40123" value="{{ old('kode_pos', $detailData?->kode_pos) }}" />
                </div>
            </div>
            <!--end::Row-->
        </div>

        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="reset" class="btn btn-light btn-active-light-primary me-3">Batal</button>
            <button type="submit" class="btn btn-primary" id="btn_save_identitas">
                <span class="indicator-label">
                    <i class="ki-duotone ki-check fs-3 me-1"></i>
                    Simpan Perubahan Identitas
                </span>
                <span class="indicator-progress">
                    Menyimpan...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </div>
    <!--end::Card Alamat Terpisah-->
</form>
