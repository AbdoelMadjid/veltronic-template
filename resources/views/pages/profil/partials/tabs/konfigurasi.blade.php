@php
    $userSettings = $settings ?? [];
    $authUser = auth()->user();
    $coverBgUrl = $authUser?->cover_bg_url ?: asset('assets/img-temp/1200x800/img1.jpg');
    $coverOpacity = (int) ($userSettings['cover_opacity'] ?? '60');
    $coverOverlayColor = $userSettings['cover_overlay_color'] ?? '#000000';
    $coverPositionY = (int) ($userSettings['cover_position_y'] ?? '30');
    $coverHeight = (int) ($userSettings['cover_height'] ?? '250');
    $coverBlur = (int) ($userSettings['cover_blur'] ?? '0');
    $hasCustomCover = !empty($userSettings['cover_background']);
@endphp

<!--begin::Form 1: Kustomisasi Background & Kontras Header Profil-->
<form action="{{ route('profil.profil-pengguna.konfigurasi') }}" method="POST" id="form_cover_konfigurasi" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="section" value="cover" />

    <div class="card shadow-sm border border-gray-200 mb-6">
        <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
            <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                <h3 class="fw-bolder text-gray-900 m-0 fs-4">Kustomisasi Background &amp; Kontras Header Profil</h3>
                <span class="text-muted fs-7 mt-1">Pengaturan foto sampul latar belakang, posisi vertikal, transparansi overlay, dan efek blur</span>
            </div>
            <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                <span class="badge badge-light-primary fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                    Cover Profil
                </span>
            </div>
        </div>

        <div class="card-body py-6 px-4 px-md-6">
            <div class="row g-7">
                <!--begin::Kolom 1: Foto Background (Cover) & Blur-->
                <div class="col-lg-4 d-flex flex-column justify-content-between border-end-lg pe-lg-6">
                    <div>
                        <div class="d-flex align-items-center mb-3">
                            <span class="fs-6 fw-bold text-gray-800 me-2">1. Foto Background &amp; Blur</span>
                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6" data-bs-toggle="tooltip" title="Gambar latar belakang yang ditampilkan pada banner header detail profil Anda beserta efek blur pada foto.">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                            </i>
                        </div>

                        <!--begin::Action Buttons & Inputs-->
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                            <input type="file" name="cover_background" id="input_cover_background_file" class="d-none" accept="image/jpeg,image/png,image/jpg,image/webp" />
                            <input type="hidden" name="cover_background_remove" id="input_cover_background_remove" value="0" />

                            <button type="button" class="btn btn-sm btn-primary flex-grow-1" id="btn_cover_change">
                                <i class="ki-duotone ki-cloud-upload fs-4 me-1">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                                Pilih Gambar
                            </button>

                            <button type="button" class="btn btn-sm btn-light-danger {{ !$hasCustomCover ? 'd-none' : '' }}" id="btn_cover_remove" data-bs-toggle="tooltip" title="Kembalikan ke pola default sistem">
                                <i class="ki-duotone ki-trash fs-4 me-1">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                </i>
                                Reset Default
                            </button>
                        </div>

                        <div class="form-text text-muted fs-8 mb-4">
                            Format: <strong>JPG, PNG, WEBP</strong> (Maks. 3MB, min. 1200px).
                        </div>

                        <!-- Blur Slider -->
                        <div class="pt-2 border-top border-gray-200">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="fs-7 fw-bold text-gray-800 me-2">Efek Blur Foto Background</span>
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-7" data-bs-toggle="tooltip" title="Memberikan efek blur halus langsung pada gambar cover profil.">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                    </i>
                                </div>
                                <span class="badge badge-light-info fw-bold fs-8" id="label_cover_blur_val">{{ $coverBlur }}px</span>
                            </div>
                            <input type="range" class="form-range w-100" min="0" max="10" step="1" 
                                   name="cover_blur" id="input_cover_blur" 
                                   value="{{ $coverBlur }}" />
                            <div class="d-flex justify-content-between text-muted fs-9 px-1">
                                <span>0px (Jernih)</span>
                                <span>5px (Sedang)</span>
                                <span>10px (Kuat)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Kolom 1: Foto Background (Cover) & Blur-->

                <!--begin::Kolom 2: Fokus Vertikal, Ketebalan & Warna Penutup-->
                <div class="col-lg-4 d-flex flex-column justify-content-between border-end-lg px-lg-6">
                    <div>
                        <!-- Fokus Vertikal -->
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center">
                                <span class="fs-6 fw-bold text-gray-800 me-2">2. Fokus Vertikal</span>
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6" data-bs-toggle="tooltip" title="Geser ke atas atau ke bawah untuk menentukan bagian gambar yang diambil.">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                </i>
                            </div>
                            <span class="badge badge-light-primary fw-bold fs-7" id="label_cover_position_y_val">
                                {{ $coverPositionY }}% {{ $coverPositionY === 0 ? '(Atas)' : ($coverPositionY === 50 ? '(Tengah)' : ($coverPositionY === 100 ? '(Bawah)' : '')) }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <input type="range" class="form-range w-100" min="0" max="100" step="1" 
                                   name="cover_position_y" id="input_cover_position_y" 
                                   value="{{ $coverPositionY }}" />
                            <div class="d-flex justify-content-between text-muted fs-9 px-1">
                                <span>Atas (0%)</span>
                                <span>Tengah (50%)</span>
                                <span>Bawah (100%)</span>
                            </div>
                        </div>

                        <!-- 3. Ketebalan Penutup (Opacity) -->
                        <div class="d-flex align-items-center justify-content-between mb-2 mt-4">
                            <div class="d-flex align-items-center">
                                <span class="fs-6 fw-bold text-gray-800 me-2">3. Ketebalan Penutup</span>
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6" data-bs-toggle="tooltip" title="Transparansi lapisan penutup agar teks tetap terbaca kontras.">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                </i>
                            </div>
                            <span class="badge badge-light-success fw-bold fs-7" id="label_cover_opacity_val">
                                {{ $coverOpacity }}%
                            </span>
                        </div>

                        <div class="mb-3">
                            <input type="range" class="form-range w-100" min="0" max="100" step="5" 
                                   name="cover_opacity" id="input_cover_opacity" 
                                   value="{{ $coverOpacity }}" />
                            <div class="d-flex justify-content-between text-muted fs-9 px-1">
                                <span>0% (Terang)</span>
                                <span>50% (Seimbang)</span>
                                <span>100% (Pekat)</span>
                            </div>
                        </div>

                        <!-- Warna Penutup (Overlay) di bawah nomor 3 -->
                        <div class="mt-3 pt-2 border-top border-gray-200">
                            <span class="fs-8 fw-bold text-gray-700 d-block mb-2">Warna Penutup (Overlay):</span>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input radio-cover-color" type="radio" name="cover_overlay_color" value="#000000" id="color_dark" {{ $coverOverlayColor === '#000000' ? 'checked' : '' }} />
                                    <label class="form-check-label fs-8 fw-semibold text-gray-800" for="color_dark">Gelap</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input radio-cover-color" type="radio" name="cover_overlay_color" value="#0f172a" id="color_navy" {{ $coverOverlayColor === '#0f172a' ? 'checked' : '' }} />
                                    <label class="form-check-label fs-8 fw-semibold text-gray-800" for="color_navy">Navy</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input radio-cover-color" type="radio" name="cover_overlay_color" value="#064e3b" id="color_emerald" {{ $coverOverlayColor === '#064e3b' ? 'checked' : '' }} />
                                    <label class="form-check-label fs-8 fw-semibold text-gray-800" for="color_emerald">Emerald</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input radio-cover-color" type="radio" name="cover_overlay_color" value="#ffffff" id="color_light" {{ $coverOverlayColor === '#ffffff' ? 'checked' : '' }} />
                                    <label class="form-check-label fs-8 fw-semibold text-gray-800" for="color_light">Terang</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Kolom 2: Fokus Vertikal, Ketebalan & Warna Penutup-->

                <!--begin::Kolom 3: Ketinggian Cover-->
                <div class="col-lg-4 d-flex flex-column justify-content-between ps-lg-6">
                    <div>
                        <!-- 4. Ketinggian Cover -->
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center">
                                <span class="fs-6 fw-bold text-gray-800 me-2">4. Ketinggian Cover</span>
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6" data-bs-toggle="tooltip" title="Sesuaikan tinggi banner cover header profil. Konten di dalamnya otomatis tetap berada di tengah secara vertikal.">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                </i>
                            </div>
                            <span class="badge badge-light-info fw-bold fs-7" id="label_cover_height_val">
                                {{ $coverHeight }}px
                            </span>
                        </div>

                        <div class="mb-3">
                            <input type="range" class="form-range w-100" min="200" max="500" step="10" 
                                   name="cover_height" id="input_cover_height" 
                                   value="{{ $coverHeight }}" />
                            <div class="d-flex justify-content-between text-muted fs-9 px-1">
                                <span>200px (Kompak)</span>
                                <span>250px (Standar)</span>
                                <span>500px (Lega)</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <span class="fs-8 fw-semibold text-gray-600 d-block mb-1">Preset Cepat Tinggi:</span>
                            <div class="btn-group w-100" role="group">
                                <button type="button" class="btn btn-xs btn-light btn-active-light-primary btn-cover-height" data-height="200">200px</button>
                                <button type="button" class="btn btn-xs btn-light btn-active-light-primary btn-cover-height" data-height="250">250px</button>
                                <button type="button" class="btn btn-xs btn-light btn-active-light-primary btn-cover-height" data-height="300">300px</button>
                            </div>
                        </div>

                        <div class="form-text text-muted fs-8 mt-3">
                            Tinggi cover header profil dapat disesuaikan secara fleksibel. Seluruh komponen (avatar, nama, dan kartu info) tetap otomatis berada di tengah secara vertikal (*vertical center*).
                        </div>
                    </div>
                </div>
                <!--end::Kolom 3: Ketinggian Cover-->
            </div>
        </div>

        <div class="card-footer py-4 px-4 px-md-6 border-top border-gray-200 bg-light bg-opacity-50">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-end text-center text-sm-start gap-2">
                <button type="submit" class="btn btn-primary w-100 w-sm-auto" id="btn_save_cover_konfigurasi">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-check fs-4 me-1">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                        Simpan Cover
                    </span>
                    <span class="indicator-progress">
                        Menyimpan...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>
<!--end::Form 1: Kustomisasi Background & Kontras Header Profil-->

<!--begin::Form 2: Preferensi & Notifikasi Pengguna-->
<form action="{{ route('profil.profil-pengguna.konfigurasi') }}" method="POST" id="form_preferensi_konfigurasi">
    @csrf
    <input type="hidden" name="section" value="preferensi" />

    <div class="card shadow-sm border border-gray-200 mb-6">
        <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
            <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
                <h3 class="fw-bolder text-gray-900 m-0 fs-4">Preferensi &amp; Notifikasi Pengguna</h3>
                <span class="text-muted fs-7 mt-1">Konfigurasi notifikasi, penguncian layar otomatis, keamanan 2FA, dan preferensi antarmuka</span>
            </div>
            <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
                <span class="badge badge-light-success fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                    Preferensi
                </span>
            </div>
        </div>

        <div class="card-body py-6 px-4 px-md-6">
            <div class="row g-7 g-xl-10">
                <!--begin::Kolom 1: Preferensi, Keamanan & Notifikasi-->
                <div class="col-lg-6 border-end-lg pe-lg-8">
                    <h4 class="fw-bold text-gray-800 fs-5 mb-5">
                        Notifikasi &amp; Keamanan Akun
                    </h4>

                    <!--begin::Option Notifikasi Email-->
                    <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                        <div class="d-flex flex-column pe-4">
                            <div class="fs-6 fw-bold text-gray-900 mb-1">Notifikasi Email</div>
                            <div class="fs-7 fw-semibold text-gray-500">Pemberitahuan sistem &amp; aktivitas via email terdaftar.</div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input h-25px w-45px" type="checkbox" name="notifikasi_email" value="1" 
                                       {{ ($userSettings['notifikasi_email'] ?? '1') === '1' ? 'checked' : '' }} />
                            </label>
                        </div>
                    </div>
                    <!--end::Option Notifikasi Email-->

                    <!--begin::Option Notifikasi WA-->
                    <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                        <div class="d-flex flex-column pe-4">
                            <div class="fs-6 fw-bold text-gray-900 mb-1">Notifikasi WhatsApp / SMS</div>
                            <div class="fs-7 fw-semibold text-gray-500">Verifikasi kode OTP &amp; pesan darurat lewat WhatsApp.</div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input h-25px w-45px" type="checkbox" name="notifikasi_wa" value="1" 
                                       {{ ($userSettings['notifikasi_wa'] ?? '0') === '1' ? 'checked' : '' }} />
                            </label>
                        </div>
                    </div>
                    <!--end::Option Notifikasi WA-->

                    <!--begin::Option Autolock Screen-->
                    <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                        <div class="d-flex flex-column pe-4">
                            <div class="fs-6 fw-bold text-gray-900 mb-1">Kunci Layar Otomatis (Auto Lock)</div>
                            <div class="fs-7 fw-semibold text-gray-500">Kunci antarmuka otomatis saat idle / tidak ada aktivitas.</div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input h-25px w-45px" type="checkbox" name="autolock_screen" value="1" 
                                       {{ ($userSettings['autolock_screen'] ?? '1') === '1' ? 'checked' : '' }} />
                            </label>
                        </div>
                    </div>
                    <!--end::Option Autolock Screen-->

                    <!--begin::Option Autentikasi 2 Langkah-->
                    <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                        <div class="d-flex flex-column pe-4">
                            <div class="fs-6 fw-bold text-gray-900 mb-1">Autentikasi Dua Faktor (2FA)</div>
                            <div class="fs-7 fw-semibold text-gray-500">Tingkatkan keamanan akun dengan lapisan verifikasi tambahan.</div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input h-25px w-45px" type="checkbox" name="dua_faktor" value="1" 
                                       {{ ($userSettings['dua_faktor'] ?? '0') === '1' ? 'checked' : '' }} />
                            </label>
                        </div>
                    </div>
                    <!--end::Option Autentikasi 2 Langkah-->

                    <!--begin::Row Preferensi Tampilan & Bahasa-->
                    <div class="row pt-4 g-4">
                        <div class="col-sm-6">
                            <label class="form-label fw-bold text-gray-800 fs-7 mb-1">Bahasa Default Antarmuka</label>
                            <select name="bahasa_default" class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="id" {{ ($userSettings['bahasa_default'] ?? 'id') === 'id' ? 'selected' : '' }}>Bahasa Indonesia (ID)</option>
                                <option value="en" {{ ($userSettings['bahasa_default'] ?? 'id') === 'en' ? 'selected' : '' }}>English (EN)</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold text-gray-800 fs-7 mb-1">Tema Tampilan Default</label>
                            <select name="tema_default" class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="light" {{ ($userSettings['tema_default'] ?? 'light') === 'light' ? 'selected' : '' }}>Terang (Light Mode)</option>
                                <option value="dark" {{ ($userSettings['tema_default'] ?? 'light') === 'dark' ? 'selected' : '' }}>Gelap (Dark Mode)</option>
                                <option value="system" {{ ($userSettings['tema_default'] ?? 'light') === 'system' ? 'selected' : '' }}>Mengikuti Sistem (Auto)</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Row Preferensi Tampilan & Bahasa-->
                </div>
                <!--end::Kolom 1: Preferensi, Keamanan & Notifikasi-->

                <!--begin::Kolom 2: Pengaturan Lanjutan / Slot Kustomisasi Lainnya-->
                <div class="col-lg-6 ps-lg-8 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold text-gray-800 fs-5 mb-5">
                            Pengaturan Lanjutan &amp; Preferensi Tambahan
                        </h4>

                        <!-- Placeholder Info Card -->
                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-5 mb-5">
                            <i class="ki-duotone ki-information-5 fs-2tx text-primary me-4">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                            </i>
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-semibold">
                                    <h5 class="text-gray-900 fw-bold fs-6 mb-1">Area Kustomisasi Khusus</h5>
                                    <div class="fs-7 text-gray-600">
                                        Kolom ini disiapkan untuk opsi pengaturan tambahan (seperti Privasi Akun, Integrasi Sistem, Ringkasan Laporan, dsb.).
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Opsi Tambahan 1: Mode Hemat Data -->
                        <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                            <div class="d-flex flex-column pe-4">
                                <div class="fs-6 fw-bold text-gray-900 mb-1">Mode Hemat Data / Bandwidth</div>
                                <div class="fs-7 fw-semibold text-gray-500">Kompresi aset gambar dan grafik untuk jaringan lambat.</div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input h-25px w-45px" type="checkbox" name="hemat_data" value="1" 
                                           {{ ($userSettings['hemat_data'] ?? '0') === '1' ? 'checked' : '' }} />
                                </label>
                            </div>
                        </div>

                        <!-- Opsi Tambahan 2: Rekap Mingguan -->
                        <div class="d-flex flex-stack py-3 border-bottom border-gray-200">
                            <div class="d-flex flex-column pe-4">
                                <div class="fs-6 fw-bold text-gray-900 mb-1">Ringkasan Aktivitas Mingguan</div>
                                <div class="fs-7 fw-semibold text-gray-500">Kirimkan rekap log audit dan aktivitas akun setiap awal pekan.</div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input h-25px w-45px" type="checkbox" name="rekap_mingguan" value="1" 
                                           {{ ($userSettings['rekap_mingguan'] ?? '0') === '1' ? 'checked' : '' }} />
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="text-muted fs-8 mt-5 pt-3 border-top border-gray-200">
                        <i class="ki-duotone ki-shield-tick fs-6 text-success me-1">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                        Perubahan disimpan realtime ke profil akun pengguna Anda tanpa reload.
                    </div>
                </div>
                <!--end::Kolom 2: Pengaturan Lanjutan / Slot Kustomisasi Lainnya-->
            </div>
        </div>

        <div class="card-footer py-4 px-4 px-md-6 border-top border-gray-200 bg-light bg-opacity-50">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-end text-center text-sm-start gap-2">
                <button type="submit" class="btn btn-primary w-100 w-sm-auto" id="btn_save_preferensi_konfigurasi">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-check fs-4 me-1">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                        Simpan Preferensi
                    </span>
                    <span class="indicator-progress">
                        Menyimpan...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>
<!--end::Form 2: Preferensi & Notifikasi Pengguna-->

