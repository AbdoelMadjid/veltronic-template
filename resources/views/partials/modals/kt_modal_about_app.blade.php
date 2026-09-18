@once
<div class="modal fade" id="kt_modal_about_app" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
        <!--begin::Modal content-->
        <div class="modal-content rounded-3 shadow">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-between align-items-center pt-6 px-6 px-lg-8">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge badge-light-primary fw-bold fs-7 py-2 px-3">
                        <i class="ki-duotone ki-information-5 fs-6 text-primary me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        <span data-kt-translate="about.app_name">{{ __('about.app_name') }}</span>
                    </span>
                    <span class="badge badge-light-success fw-bold fs-7 py-2 px-3" data-kt-translate="about.release_version">
                        {{ __('about.release_version') }}
                    </span>
                    <span class="badge badge-light-info fw-semibold fs-8 py-2 px-3 d-none d-sm-inline-flex">
                        <i class="ki-duotone ki-verify fs-7 text-info me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Enterprise Ready
                    </span>
                </div>
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-6 px-lg-10 pt-4 pb-8">
                <!--begin::Heading-->
                <div class="text-center mb-6">
                    <div class="d-inline-flex align-items-center justify-content-center p-4 rounded-circle bg-light-primary mb-3">
                        <i class="ki-duotone ki-cube-2 fs-3x text-primary">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <h2 class="fw-bolder fs-1 text-gray-900 mb-1" data-kt-translate="about.modal_title">
                        {{ __('about.modal_title') }}
                    </h2>
                    <div class="text-muted fw-semibold fs-6 mb-4" data-kt-translate="about.modal_subtitle">
                        {{ __('about.modal_subtitle') }}
                    </div>

                    <!--begin::Tech Stack Badges-->
                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                        <span class="badge badge-light-danger fw-semibold fs-8 px-3 py-2 border border-dashed border-danger border-opacity-25">
                            <i class="ki-duotone ki-code fs-7 text-danger me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Laravel 13
                        </span>
                        <span class="badge badge-light-primary fw-semibold fs-8 px-3 py-2 border border-dashed border-primary border-opacity-25">
                            <i class="ki-duotone ki-technology-4 fs-7 text-primary me-1"><span class="path1"></span><span class="path2"></span></i>
                            PHP 8.3+
                        </span>
                        <span class="badge badge-light-success fw-semibold fs-8 px-3 py-2 border border-dashed border-success border-opacity-25">
                            <i class="ki-duotone ki-element-11 fs-7 text-success me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Metronic 8.3.2
                        </span>
                        <span class="badge badge-light-info fw-semibold fs-8 px-3 py-2 border border-dashed border-info border-opacity-25">
                            <i class="ki-duotone ki-screen fs-7 text-info me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Bootstrap 5.3
                        </span>
                        <span class="badge badge-light-warning fw-semibold fs-8 px-3 py-2 border border-dashed border-warning border-opacity-25">
                            <i class="ki-duotone ki-arrows-circle fs-7 text-warning me-1"><span class="path1"></span><span class="path2"></span></i>
                            Vite & Realtime AJAX
                        </span>
                        <span class="badge badge-light-dark fw-semibold fs-8 px-3 py-2 border border-dashed border-dark border-opacity-25">
                            <i class="ki-duotone ki-shield-tick fs-7 text-dark me-1"><span class="path1"></span><span class="path2"></span></i>
                            Spatie Security
                        </span>
                    </div>
                    <!--end::Tech Stack Badges-->
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
                <div class="card card-flush border border-gray-300 border-dashed rounded-3 p-5 mb-6 bg-body">
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
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="fw-bold text-gray-900 mb-0 fs-6" data-kt-translate="about.features_heading">
                            {{ __('about.features_heading') }}
                        </h5>
                        <span class="badge badge-light-primary fw-bold fs-8">10 Core Modules</span>
                    </div>

                    <div class="row g-3">
                        <!-- Feature 1: Bilingual -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-primary me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-flag fs-3 text-primary">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_bilingual">
                                        {{ __('about.feature_bilingual') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_bilingual_desc">
                                        {{ __('about.feature_bilingual_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 2: Shortcuts Hub -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-warning me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-keyboard fs-3 text-warning">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_shortcuts">
                                        {{ __('about.feature_shortcuts') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_shortcuts_desc">
                                        {{ __('about.feature_shortcuts_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 3: Audit Log & Error Tracking -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-danger me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-shield-search fs-3 text-danger">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_audit">
                                        {{ __('about.feature_audit') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_audit_desc">
                                        {{ __('about.feature_audit_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 4: Smart Relational DB Backup -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-info me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-data fs-3 text-info">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_backup">
                                        {{ __('about.feature_backup') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_backup_desc">
                                        {{ __('about.feature_backup_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 5: App Profile & SEO Engine -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-success me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-setting-2 fs-3 text-success">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_seo">
                                        {{ __('about.feature_seo') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_seo_desc">
                                        {{ __('about.feature_seo_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 6: Zero-Reload AJAX Realtime CRUD -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-primary me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-arrows-circle fs-3 text-primary">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_realtime">
                                        {{ __('about.feature_realtime') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_realtime_desc">
                                        {{ __('about.feature_realtime_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 7: Multi-Theme Version Resolver -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-success me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-color-filter fs-3 text-success">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_themes">
                                        {{ __('about.feature_themes') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_themes_desc">
                                        {{ __('about.feature_themes_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 8: KeenIcons Style Switcher -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-warning me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-abstract-26 fs-3 text-warning">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_icons">
                                        {{ __('about.feature_icons') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_icons_desc">
                                        {{ __('about.feature_icons_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 9: Dynamic Menu & Auto Routing -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-danger me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-route fs-3 text-danger">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_routing">
                                        {{ __('about.feature_routing') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_routing_desc">
                                        {{ __('about.feature_routing_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 10: Unified Operational Guidelines -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-4 rounded-3 border border-gray-200 border-dashed bg-body h-100">
                                <div class="symbol symbol-35px symbol-circle bg-light-info me-3 flex-shrink-0 mt-1">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-information-5 fs-3 text-info">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                        </i>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-gray-900 fw-bold fs-7 mb-1" data-kt-translate="about.feature_guidelines">
                                        {{ __('about.feature_guidelines') }}
                                    </div>
                                    <div class="text-muted fs-8 leading-normal" data-kt-translate="about.feature_guidelines_desc">
                                        {{ __('about.feature_guidelines_desc') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Features Grid-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center justify-content-between pt-4 border-top flex-wrap gap-2">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <a href="https://github.com/AbdoelMadjid/veltronic-template" target="_blank"
                            class="btn btn-sm btn-light-primary d-inline-flex align-items-center gap-2">
                            <i class="ki-duotone ki-abstract-26 fs-4">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            <span data-kt-translate="about.visit_github">{{ __('about.visit_github') }}</span>
                        </a>
                        <a href="{{ url('help/pemrograman/overview') }}"
                            class="btn btn-sm btn-light-info d-inline-flex align-items-center gap-2">
                            <i class="ki-duotone ki-book-open fs-4">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                            </i>
                            <span data-kt-translate="about.documentation">{{ __('about.documentation') }}</span>
                        </a>
                        <a href="{{ url('help/log/changelog') }}"
                            class="btn btn-sm btn-light-success d-inline-flex align-items-center gap-2">
                            <i class="ki-duotone ki-document fs-4">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
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
