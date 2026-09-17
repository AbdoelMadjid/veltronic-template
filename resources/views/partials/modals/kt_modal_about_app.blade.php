@once
<div class="modal fade" id="kt_modal_about_app" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-between align-items-center pt-6 px-8">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge badge-light-primary fw-bold fs-7 py-2 px-3">
                        <i class="ki-outline ki-information-5 fs-6 text-primary me-1"></i>
                        <span data-kt-translate="about.app_name">{{ __('about.app_name') }}</span>
                    </span>
                    <span class="badge badge-light-success fw-bold fs-7 py-2 px-3" data-kt-translate="about.release_version">
                        {{ __('about.release_version') }}
                    </span>
                </div>
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-6 px-lg-10 pt-4 pb-8">
                <!--begin::Heading-->
                <div class="text-center mb-6">
                    <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle bg-light-primary mb-3">
                        <i class="ki-outline ki-cube-2 fs-2x text-primary"></i>
                    </div>
                    <h2 class="fw-bolder fs-2 text-gray-900 mb-1" data-kt-translate="about.modal_title">
                        {{ __('about.modal_title') }}
                    </h2>
                    <div class="text-muted fw-semibold fs-6" data-kt-translate="about.modal_subtitle">
                        {{ __('about.modal_subtitle') }}
                    </div>
                </div>
                <!--end::Heading-->

                <!--begin::Description Card-->
                <div class="card card-flush bg-light-secondary border-0 mb-6">
                    <div class="card-body p-5">
                        <p class="text-gray-700 fs-6 mb-0 leading-relaxed" data-kt-translate="about.description">
                            {{ __('about.description') }}
                        </p>
                    </div>
                </div>
                <!--end::Description Card-->

                <!--begin::Creator Section-->
                <div class="card card-flush border border-gray-300 border-dashed rounded-3 p-5 mb-6">
                    <div class="d-flex align-items-center gap-4">
                        <div class="symbol symbol-50px symbol-circle bg-light-primary flex-shrink-0">
                            <span class="symbol-label bg-primary text-white fw-bold fs-3">AM</span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
                                <h4 class="text-gray-900 fw-bold mb-0 fs-5" data-kt-translate="about.creator_name">
                                    {{ __('about.creator_name') }}
                                </h4>
                                <span class="badge badge-light-info fw-semibold fs-8" data-kt-translate="about.creator_heading">
                                    {{ __('about.creator_heading') }}
                                </span>
                            </div>
                            <div class="text-primary fw-semibold fs-7 mb-2" data-kt-translate="about.creator_role">
                                {{ __('about.creator_role') }}
                            </div>
                            <p class="text-gray-600 fs-7 mb-0" data-kt-translate="about.creator_bio">
                                {{ __('about.creator_bio') }}
                            </p>
                        </div>
                    </div>
                </div>
                <!--end::Creator Section-->

                <!--begin::Features Grid-->
                <div class="mb-6">
                    <h5 class="fw-bold text-gray-800 mb-3 fs-6" data-kt-translate="about.features_heading">
                        {{ __('about.features_heading') }}
                    </h5>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-3 rounded bg-light-primary">
                                <i class="ki-outline ki-flag fs-3 text-primary me-2"></i>
                                <span class="text-gray-800 fw-semibold fs-7" data-kt-translate="about.feature_bilingual">
                                    {{ __('about.feature_bilingual') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-3 rounded bg-light-success">
                                <i class="ki-outline ki-cube-2 fs-3 text-success me-2"></i>
                                <span class="text-gray-800 fw-semibold fs-7" data-kt-translate="about.feature_themes">
                                    {{ __('about.feature_themes') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-3 rounded bg-light-info">
                                <i class="ki-outline ki-screen fs-3 text-info me-2"></i>
                                <span class="text-gray-800 fw-semibold fs-7" data-kt-translate="about.feature_frontpages">
                                    {{ __('about.feature_frontpages') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-3 rounded bg-light-warning">
                                <i class="ki-outline ki-chart fs-3 text-warning me-2"></i>
                                <span class="text-gray-800 fw-semibold fs-7" data-kt-translate="about.feature_icons">
                                    {{ __('about.feature_icons') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-3 rounded bg-light-danger">
                                <i class="ki-outline ki-route fs-3 text-danger me-2"></i>
                                <span class="text-gray-800 fw-semibold fs-7" data-kt-translate="about.feature_routing">
                                    {{ __('about.feature_routing') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center p-3 rounded bg-light-dark">
                                <i class="ki-outline ki-shield-tick fs-3 text-dark me-2"></i>
                                <span class="text-gray-800 fw-semibold fs-7" data-kt-translate="about.feature_auth">
                                    {{ __('about.feature_auth') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Features Grid-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center justify-content-between pt-3 border-top flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <a href="https://github.com/AbdoelMadjid/veltronic-template" target="_blank"
                            class="btn btn-sm btn-light-primary d-inline-flex align-items-center gap-2">
                            <i class="ki-outline ki-abstract-26 fs-4"></i>
                            <span data-kt-translate="about.visit_github">{{ __('about.visit_github') }}</span>
                        </a>
                        <a href="{{ url('help/log/changelog') }}"
                            class="btn btn-sm btn-light-info d-inline-flex align-items-center gap-2">
                            <i class="ki-outline ki-document fs-4"></i>
                            <span data-kt-translate="about.changelog">{{ __('about.changelog') }}</span>
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" data-kt-translate="about.close">
                        {{ __('about.close') }}
                    </button>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@endonce
