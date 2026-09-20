<!--begin::Tab Pane Footer & Kontak-->
<form id="kt_form_landing_footer" class="form">
    @csrf
    <div class="row g-6 g-xl-9">
        <!--begin::Col Footer Profil & Kontak-->
        <div class="col-xl-6">
            <div class="card card-flush shadow-sm mb-6 border-0">
                <div class="card-header pt-6 px-4 px-md-6 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                    <div class="card-title">
                        <i class="ki-outline ki-sms text-primary fs-2 me-2"></i>
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Profil Footer & Informasi Kontak</h3>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-light-info btn-sm fw-bold btn-edit-section-code"
                                data-id="footer" data-name="Footer & Kontak" data-custom="0">
                            <i class="ki-outline ki-code fs-4 me-1"></i> Edit Script Blade
                        </button>
                    </div>
                </div>

                <div class="card-body pt-2 pb-6 px-4 px-md-6">
                    <div class="mb-5">
                        <label class="form-label fs-7 fw-bold text-gray-800">Deskripsi Singkat Footer</label>
                        <textarea name="landing_footer_about" rows="3" class="form-control form-control-solid form-control-sm"
                                  placeholder="Deskripsi singkat profil/aplikasi pada bilah footer...">{{ $config['landing_footer_about'] ?? '' }}</textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fs-7 fw-bold text-gray-800">Teks Hak Cipta (Copyright)</label>
                        <input type="text" name="landing_footer_copyright" class="form-control form-control-solid form-control-sm"
                               placeholder="2025 Keenthemes Inc. Veltronic Template." value="{{ $config['landing_footer_copyright'] ?? '' }}" />
                    </div>

                    <div class="separator separator-dashed my-6"></div>

                    <h5 class="fw-bolder text-gray-800 mb-4 fs-6">
                        <i class="ki-outline ki-phone text-primary fs-5 me-1"></i> Kontak Bantuan & Operasional
                    </h5>

                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label class="form-label fs-7 fw-bold text-gray-800">Email Kontak</label>
                            <input type="email" name="landing_footer_email" class="form-control form-control-solid form-control-sm"
                                   placeholder="support@keenthemes.com" value="{{ $config['landing_footer_email'] ?? '' }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-7 fw-bold text-gray-800">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="landing_footer_phone" class="form-control form-control-solid form-control-sm"
                                   placeholder="+62 812-3456-7890" value="{{ $config['landing_footer_phone'] ?? '' }}" />
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fs-7 fw-bold text-gray-800">Alamat Kantor / Lokasi</label>
                        <input type="text" name="landing_footer_address" class="form-control form-control-solid form-control-sm"
                               placeholder="Jakarta, Indonesia" value="{{ $config['landing_footer_address'] ?? '' }}" />
                    </div>
                </div>
            </div>
        </div>
        <!--end::Col Footer Profil & Kontak-->

        <!--begin::Col Tautan Media Sosial-->
        <div class="col-xl-6">
            <div class="card card-flush shadow-sm mb-6 border-0">
                <div class="card-header pt-6 px-4 px-md-6 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                    <div class="card-title">
                        <i class="ki-outline ki-share text-primary fs-2 me-2"></i>
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4">Tautan Media Sosial & Komunitas</h3>
                    </div>
                </div>

                <div class="card-body pt-2 pb-6 px-4 px-md-6">
                    <p class="text-muted fs-7 mb-4">
                        Masukkan tautan profil media sosial resmi untuk ditampilkan pada ikon sosial di footer landing page.
                    </p>

                    <div class="d-flex flex-column gap-3" id="kt_landing_social_inputs">
                        @foreach($socialLinks as $index => $soc)
                            <div class="d-flex align-items-center gap-2 gap-sm-3 social-input-row" data-index="{{ $index }}">
                                <div class="w-85px w-sm-100px flex-shrink-0">
                                    <span class="badge badge-light-primary fw-bold fs-8 fs-sm-7 w-100 py-2">
                                        {{ $soc['name'] ?? 'Sosial' }}
                                    </span>
                                    <input type="hidden" class="soc-name" value="{{ $soc['name'] ?? '' }}" />
                                    <input type="hidden" class="soc-icon" value="{{ $soc['icon'] ?? '' }}" />
                                </div>
                                <div class="flex-grow-1">
                                    <input type="url" class="form-control form-control-solid form-control-sm soc-url"
                                           placeholder="https://..." value="{{ $soc['url'] ?? '' }}" />
                                </div>
                                <div class="form-check form-switch form-check-custom form-check-solid flex-shrink-0">
                                    <input class="form-check-input h-20px w-35px soc-active" type="checkbox"
                                           {{ !empty($soc['is_active']) ? 'checked' : '' }} />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-center justify-content-sm-end py-4 px-4 px-md-6 border-0">
                    <button type="submit" class="btn btn-primary btn-sm fw-bold px-6" id="kt_btn_save_footer">
                        <span class="indicator-label">
                            <i class="ki-outline ki-check fs-4 me-1"></i> Simpan Footer & Kontak
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span> Menyimpan...
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <!--end::Col Tautan Media Sosial-->
    </div>
</form>
<!--end::Tab Pane Footer & Kontak-->
