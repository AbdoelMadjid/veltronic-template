@php
    $userSettings = $settings ?? [];
@endphp

<form action="{{ route('profil.profil-pengguna.konfigurasi') }}" method="POST" id="form_konfigurasi">
    @csrf

    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-gray-800">Konfigurasi & Preferensi Pengguna</h3>
            </div>
        </div>

        <div class="card-body border-top p-9">
            <!--begin::Option Notifikasi Email-->
            <div class="d-flex flex-stack py-4 border-bottom border-gray-200">
                <div class="d-flex flex-column pe-4">
                    <div class="fs-5 fw-bold text-gray-900 mb-1">Notifikasi Email</div>
                    <div class="fs-7 fw-semibold text-gray-500">Terima pemberitahuan sistem dan aktivitas penting melalui email terdaftar.</div>
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
            <div class="d-flex flex-stack py-4 border-bottom border-gray-200">
                <div class="d-flex flex-column pe-4">
                    <div class="fs-5 fw-bold text-gray-900 mb-1">Notifikasi WhatsApp / SMS</div>
                    <div class="fs-7 fw-semibold text-gray-500">Terima verifikasi kode OTP dan pesan darurat lewat WhatsApp.</div>
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
            <div class="d-flex flex-stack py-4 border-bottom border-gray-200">
                <div class="d-flex flex-column pe-4">
                    <div class="fs-5 fw-bold text-gray-900 mb-1">Kunci Layar Otomatis (Auto Lock Screen)</div>
                    <div class="fs-7 fw-semibold text-gray-500">Kunci antarmuka aplikasi secara otomatis saat tidak ada aktivitas.</div>
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
            <div class="d-flex flex-stack py-4 border-bottom border-gray-200">
                <div class="d-flex flex-column pe-4">
                    <div class="fs-5 fw-bold text-gray-900 mb-1">Autentikasi Dua Faktor (2FA)</div>
                    <div class="fs-7 fw-semibold text-gray-500">Tingkatkan proteksi akun dengan lapisan verifikasi tambahan saat login.</div>
                </div>
                <div class="d-flex justify-content-end">
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input h-25px w-45px" type="checkbox" name="dua_faktor" value="1" 
                               {{ ($userSettings['dua_faktor'] ?? '0') === '1' ? 'checked' : '' }} />
                    </label>
                </div>
            </div>
            <!--end::Option Autentikasi 2 Langkah-->

            <!--begin::Row Preferensi Tampilan-->
            <div class="row pt-6">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <label class="form-label fw-bold text-gray-800 fs-6">Bahasa Default Antarmuka</label>
                    <select name="bahasa_default" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                        <option value="id" {{ ($userSettings['bahasa_default'] ?? 'id') === 'id' ? 'selected' : '' }}>Bahasa Indonesia (ID)</option>
                        <option value="en" {{ ($userSettings['bahasa_default'] ?? 'id') === 'en' ? 'selected' : '' }}>English (EN)</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label class="form-label fw-bold text-gray-800 fs-6">Tema Tampilan Default</label>
                    <select name="tema_default" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                        <option value="light" {{ ($userSettings['tema_default'] ?? 'light') === 'light' ? 'selected' : '' }}>Terang (Light Mode)</option>
                        <option value="dark" {{ ($userSettings['tema_default'] ?? 'light') === 'dark' ? 'selected' : '' }}>Gelap (Dark Mode)</option>
                        <option value="system" {{ ($userSettings['tema_default'] ?? 'light') === 'system' ? 'selected' : '' }}>Mengikuti Sistem (System)</option>
                    </select>
                </div>
            </div>
            <!--end::Row Preferensi Tampilan-->
        </div>

        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="reset" class="btn btn-light btn-active-light-primary me-3">Batal</button>
            <button type="submit" class="btn btn-primary" id="btn_save_konfigurasi">
                <span class="indicator-label">
                    <i class="ki-duotone ki-check fs-3 me-1"></i>
                    Simpan Konfigurasi
                </span>
                <span class="indicator-progress">
                    Menyimpan...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </div>
</form>
