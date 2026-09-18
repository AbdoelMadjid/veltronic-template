<!--begin::Modal - Section Code Editor-->
<div class="modal fade" id="modal_section_code" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content shadow-lg border-0">
            <!--begin::Modal header-->
            <div class="modal-header bg-dark py-4 px-6">
                <!--begin::Modal title-->
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40px bg-white bg-opacity-10 text-white rounded-3 me-3 d-flex align-items-center justify-content-center">
                        <i class="ki-outline ki-code fs-2 text-warning"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold text-white mb-0" id="section_code_modal_title">
                            Editor Script / Blade Seksi
                        </h3>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <span class="badge badge-light-warning fw-bold fs-8" id="section_code_badge_type">Seksi Bawaan</span>
                            <span class="text-white-50 fs-7 font-monospace" id="section_code_file_path">resources/views/frontpages/landing/v1/sections/...</span>
                        </div>
                    </div>
                </div>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-outline ki-cross fs-2 text-white"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body p-6 bg-body">
                <form id="form_section_code" method="POST" action="{{ route('appsupport.theme-frontpage.sections.save-code') }}">
                    @csrf
                    <input type="hidden" name="section_id" id="code_editor_section_id" value="" />
                    <input type="hidden" name="version" id="code_editor_version" value="{{ $landingVersion ?? 'v1' }}" />

                    <!--begin::Alert Info-->
                    <div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row p-4 mb-4">
                        <i class="ki-outline ki-information-5 fs-2hx text-primary me-4 mb-3 mb-sm-0"></i>
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <h5 class="fw-semibold text-gray-900 mb-1">Panduan Pengeditan Script Seksi</h5>
                            <span class="text-muted fs-7">
                                Anda dapat mengedit kode HTML/Blade seksi ini secara langsung. Variabel global seperti <code>$landingConfig</code>, <code>$landingMenus</code>, <code>$landingSections</code>, dan <code>$landingSocials</code> dapat digunakan di dalam template.
                            </span>
                        </div>
                    </div>
                    <!--end::Alert Info-->

                    <!--begin::Code Editor Container-->
                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="fs-6 fw-bold text-gray-800">Source Code (Blade / HTML)</label>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-xs btn-light-info" id="btn_format_code" title="Format indentation">
                                    <i class="ki-outline ki-text-align-left fs-7"></i> Auto-Wrap
                                </button>
                                <button type="button" class="btn btn-xs btn-light-warning" id="btn_reset_section_code">
                                    <i class="ki-outline ki-arrows-circle fs-7"></i> Reset ke Script Bawaan
                                </button>
                            </div>
                        </div>
                        <div class="position-relative">
                            <textarea name="code" id="section_code_content" rows="18" 
                                class="form-control form-control-solid font-monospace fs-7 bg-dark text-light p-4 rounded-3 border-0" 
                                style="font-family: 'Consolas', 'Fira Code', monospace; line-height: 1.5; tab-size: 4; resize: vertical;"
                                placeholder="<!-- Masukkan kode HTML / Blade untuk section ini... -->"></textarea>
                        </div>
                    </div>
                    <!--end::Code Editor Container-->

                    <!--begin::Modal footer buttons-->
                    <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                        <div class="text-muted fs-7">
                            <i class="ki-outline ki-shield-tick text-success me-1"></i> Perubahan tersimpan secara realtime & cache di-bust otomatis.
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn_submit_section_code">
                                <span class="indicator-label">
                                    <i class="ki-outline ki-check-circle fs-4 me-1"></i> Simpan Script
                                </span>
                                <span class="indicator-progress">
                                    Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!--end::Modal footer buttons-->
                </form>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Section Code Editor-->
