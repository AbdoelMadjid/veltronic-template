<!--begin::Pricing Section-->
<div class="mt-sm-n20">
    <!--begin::Curve top-->
    <div class="landing-curve landing-dark-color">
        <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z"
                fill="currentColor"></path>
        </svg>
    </div>
    <!--end::Curve top-->
    <!--begin::Wrapper-->
    <div class="py-20 landing-dark-bg">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Plans-->
            <div class="d-flex flex-column container pt-lg-20">
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <h1 class="fs-2hx fw-bold text-white mb-5" id="pricing"
                        data-kt-scroll-offset="{default: 100, lg: 150}" data-kt-translate="landing.pricing_title">
                        {{ __('landing.pricing_title') }}
                    </h1>
                    <div class="text-gray-600 fw-semibold fs-5" data-kt-translate="landing.pricing_subtitle">
                        {{ __('landing.pricing_subtitle') }}
                    </div>
                </div>
                <!--end::Heading-->
                <!--begin::Pricing-->
                <div class="text-center" id="kt_pricing">
                    <!--begin::Nav group-->
                    <div class="nav-group landing-dark-bg d-inline-flex mb-15" data-kt-buttons="true"
                        style="border: 1px dashed #2b4666">
                        <a href="javascript:void(0)"
                            class="btn btn-color-gray-600 btn-active btn-active-success px-6 py-3 me-2 active"
                            data-kt-plan="month" data-kt-translate="landing.monthly">{{ __('landing.monthly') }}</a>
                        <a href="javascript:void(0)"
                            class="btn btn-color-gray-600 btn-active btn-active-success px-6 py-3"
                            data-kt-plan="annual" data-kt-translate="landing.annual">{{ __('landing.annual') }}</a>
                    </div>
                    <!--end::Nav group-->
                    <!--begin::Row-->
                    <div class="row g-10">
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <div
                                    class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
                                    <!--begin::Heading-->
                                    <div class="mb-7 text-center">
                                        <!--begin::Title-->
                                        <h1 class="text-gray-900 mb-5 fw-boldest" data-kt-translate="landing.plan_startup">{{ __('landing.plan_startup') }}</h1>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="text-gray-500 fw-semibold mb-5" data-kt-translate="landing.plan_startup_desc">
                                            {{ __('landing.plan_startup_desc') }}
                                        </div>
                                        <!--end::Description-->
                                        <!--begin::Price-->
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">$</span>
                                            <span class="fs-3x fw-bold text-primary"
                                                data-kt-plan-price-month="99"
                                                data-kt-plan-price-annual="999">99</span>
                                            <span class="fs-7 fw-semibold opacity-50"
                                                data-kt-plan-price-month="{{ __('landing.per_month') }}"
                                                data-kt-plan-price-annual="{{ __('landing.per_annual') }}">{{ __('landing.per_month') }}</span>
                                        </div>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Features-->
                                    <div class="w-100 mb-10">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 text-start pe-3" data-kt-translate="landing.feature_active_users">{{ __('landing.feature_active_users') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 text-start pe-3" data-kt-translate="landing.feature_project_integrations">{{ __('landing.feature_project_integrations') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800" data-kt-translate="landing.feature_analytics_platform">{{ __('landing.feature_analytics_platform') }}</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800" data-kt-translate="landing.feature_targets_files">{{ __('landing.feature_targets_files') }}</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <span class="fw-semibold fs-6 text-gray-800" data-kt-translate="landing.feature_unlimited_projects">{{ __('landing.feature_unlimited_projects') }}</span>
                                            <i class="ki-duotone ki-cross-circle fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Features-->
                                    <!--begin::Select-->
                                    <a href="javascript:void(0)" class="btn btn-primary" data-kt-translate="landing.select">{{ __('landing.select') }}</a>
                                    <!--end::Select-->
                                </div>
                                <!--end::Option-->
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <div
                                    class="w-100 d-flex flex-column flex-center rounded-3 bg-primary py-20 px-10">
                                    <!--begin::Heading-->
                                    <div class="mb-7 text-center">
                                        <!--begin::Title-->
                                        <h1 class="text-white mb-5 fw-boldest" data-kt-translate="landing.plan_business">{{ __('landing.plan_business') }}</h1>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="text-white opacity-75 fw-semibold mb-5" data-kt-translate="landing.plan_business_desc">
                                            {{ __('landing.plan_business_desc') }}
                                        </div>
                                        <!--end::Description-->
                                        <!--begin::Price-->
                                        <div class="text-center">
                                            <span class="mb-2 text-white">$</span>
                                            <span class="fs-3x fw-bold text-white"
                                                data-kt-plan-price-month="199"
                                                data-kt-plan-price-annual="1999">199</span>
                                            <span class="fs-7 fw-semibold text-white opacity-75"
                                                data-kt-plan-price-month="{{ __('landing.per_month') }}"
                                                data-kt-plan-price-annual="{{ __('landing.per_annual') }}">{{ __('landing.per_month') }}</span>
                                        </div>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Features-->
                                    <div class="w-100 mb-10">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span
                                                class="fw-semibold fs-6 text-white opacity-75 text-start pe-3" data-kt-translate="landing.feature_active_users">{{ __('landing.feature_active_users') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span
                                                class="fw-semibold fs-6 text-white opacity-75 text-start pe-3" data-kt-translate="landing.feature_project_integrations">{{ __('landing.feature_project_integrations') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span
                                                class="fw-semibold fs-6 text-white opacity-75 text-start pe-3" data-kt-translate="landing.feature_analytics_platform">{{ __('landing.feature_analytics_platform') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span
                                                class="fw-semibold fs-6 text-white opacity-75 text-start pe-3" data-kt-translate="landing.feature_targets_files">{{ __('landing.feature_targets_files') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <span class="fw-semibold fs-6 text-white opacity-75" data-kt-translate="landing.feature_unlimited_projects">{{ __('landing.feature_unlimited_projects') }}</span>
                                            <i class="ki-duotone ki-cross-circle fs-1 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Features-->
                                    <!--begin::Select-->
                                    <a href="javascript:void(0)"
                                        class="btn btn-color-primary btn-active-light-primary btn-light" data-kt-translate="landing.select">{{ __('landing.select') }}</a>
                                    <!--end::Select-->
                                </div>
                                <!--end::Option-->
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <div
                                    class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
                                    <!--begin::Heading-->
                                    <div class="mb-7 text-center">
                                        <!--begin::Title-->
                                        <h1 class="text-gray-900 mb-5 fw-boldest" data-kt-translate="landing.plan_enterprise">
                                            {{ __('landing.plan_enterprise') }}
                                        </h1>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="text-gray-500 fw-semibold mb-5" data-kt-translate="landing.plan_enterprise_desc">
                                            {{ __('landing.plan_enterprise_desc') }}
                                        </div>
                                        <!--end::Description-->
                                        <!--begin::Price-->
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">$</span>
                                            <span class="fs-3x fw-bold text-primary"
                                                data-kt-plan-price-month="999"
                                                data-kt-plan-price-annual="9999">999</span>
                                            <span class="fs-7 fw-semibold opacity-50"
                                                data-kt-plan-price-month="{{ __('landing.per_month') }}"
                                                data-kt-plan-price-annual="{{ __('landing.per_annual') }}">{{ __('landing.per_month') }}</span>
                                        </div>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Features-->
                                    <div class="w-100 mb-10">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 text-start pe-3" data-kt-translate="landing.feature_active_users">{{ __('landing.feature_active_users') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span class="fw-semibold fs-6 text-gray-800 text-start pe-3" data-kt-translate="landing.feature_project_integrations">{{ __('landing.feature_project_integrations') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span
                                                class="fw-semibold fs-6 text-gray-800 text-start pe-3" data-kt-translate="landing.feature_analytics_platform">{{ __('landing.feature_analytics_platform') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-5">
                                            <span
                                                class="fw-semibold fs-6 text-gray-800 text-start pe-3" data-kt-translate="landing.feature_targets_files">{{ __('landing.feature_targets_files') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <span
                                                class="fw-semibold fs-6 text-gray-800 text-start pe-3" data-kt-translate="landing.feature_unlimited_projects">{{ __('landing.feature_unlimited_projects') }}</span>
                                            <i class="ki-duotone ki-check-circle fs-1 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Features-->
                                    <!--begin::Select-->
                                    <a href="javascript:void(0)" class="btn btn-primary" data-kt-translate="landing.select">{{ __('landing.select') }}</a>
                                    <!--end::Select-->
                                </div>
                                <!--end::Option-->
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Pricing-->
            </div>
            <!--end::Plans-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Curve bottom-->
    <div class="landing-curve landing-dark-color">
        <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                fill="currentColor"></path>
        </svg>
    </div>
    <!--end::Curve bottom-->
</div>
<!--end::Pricing Section-->
