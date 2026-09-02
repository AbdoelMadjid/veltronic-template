<!--begin::List widget 7-->
@php
    $widgetClass = $widgetClass ?? 'card card-flush mb-xl-8';
    $linkHref = $linkHref ?? 'javascript:void(0)';
@endphp

<div class="{{ $widgetClass }}">
    <!--begin::Header-->
    <div class="card-header py-7">
        <!--begin::Statistics-->
        <div class="m-0">
            <!--begin::Heading-->
            <div class="d-flex align-items-center mb-2">
                <!--begin::Title-->
                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">0.37%</span>
                <!--end::Title-->
                <!--begin::Badge-->
                <span class="badge badge-light-danger fs-base">
                    <i class="ki-outline ki-arrow-up fs-5 text-danger ms-n1"></i>8.02%</span>
                <!--end::Badge-->
            </div>
            <!--end::Heading-->
            <!--begin::Description-->
            <span class="fs-6 fw-semibold text-gray-500">Online store convertion rate</span>
            <!--end::Description-->
        </div>
        <!--end::Statistics-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button
                class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                data-kt-menu-overflow="true">
                <i class="ki-outline ki-dots-square fs-1 text-gray-500 me-n1"></i>
            </button>
            <!--begin::Menu 2-->
            @include('partials.menus._menu-2')
            <!--end::Menu 2-->
            <!--end::Menu-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-0">
        <!--begin::Items-->
        <div class="mb-0">
            <!--begin::Item-->
            <div class="d-flex flex-stack">
                <!--begin::Section-->
                <div class="d-flex align-items-center me-5">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-30px me-5">
                        <span class="symbol-label">
                            <i class="ki-outline ki-magnifier fs-3 text-gray-600"></i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Search
                            Retargeting</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct
                            link clicks</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Section-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-6 me-3">0.24%</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="d-flex flex-center">
                        <!--begin::label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.4%</span>
                        <!--end::label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Item-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-3"></div>
            <!--end::Separator-->
            <!--begin::Item-->
            <div class="d-flex flex-stack">
                <!--begin::Section-->
                <div class="d-flex align-items-center me-5">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-30px me-5">
                        <span class="symbol-label">
                            <i class="ki-outline ki-tiktok fs-3 text-gray-600"></i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Social
                            Retargeting</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct
                            link clicks</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Section-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-6 me-3">0.94%</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="d-flex flex-center">
                        <!--begin::label-->
                        <span class="badge badge-light-danger fs-base">
                            <i class="ki-outline ki-arrow-down fs-5 text-danger ms-n1"></i>9.4%</span>
                        <!--end::label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Item-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-3"></div>
            <!--end::Separator-->
            <!--begin::Item-->
            <div class="d-flex flex-stack">
                <!--begin::Section-->
                <div class="d-flex align-items-center me-5">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-30px me-5">
                        <span class="symbol-label">
                            <i class="ki-outline ki-sms fs-3 text-gray-600"></i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Email
                            Retargeting</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct
                            link clicks</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Section-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-6 me-3">1.23%</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="d-flex flex-center">
                        <!--begin::label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>0.2%</span>
                        <!--end::label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Item-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-3"></div>
            <!--end::Separator-->
            <!--begin::Item-->
            <div class="d-flex flex-stack">
                <!--begin::Section-->
                <div class="d-flex align-items-center me-5">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-30px me-5">
                        <span class="symbol-label">
                            <i class="ki-outline ki-icon fs-3 text-gray-600"></i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Referrals
                            Customers</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct
                            link clicks</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Section-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-6 me-3">0.08%</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="d-flex flex-center">
                        <!--begin::label-->
                        <span class="badge badge-light-danger fs-base">
                            <i class="ki-outline ki-arrow-down fs-5 text-danger ms-n1"></i>0.4%</span>
                        <!--end::label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Item-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-3"></div>
            <!--end::Separator-->
            <!--begin::Item-->
            <div class="d-flex flex-stack">
                <!--begin::Section-->
                <div class="d-flex align-items-center me-5">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-30px me-5">
                        <span class="symbol-label">
                            <i class="ki-outline ki-abstract-25 fs-3 text-gray-600"></i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Other</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct
                            link clicks</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Section-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-6 me-3">0.46%</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="d-flex flex-center">
                        <!--begin::label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>8.3%</span>
                        <!--end::label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Item-->
        </div>
        <!--end::Items-->
    </div>
    <!--end::Body-->
</div>
<!--end::List widget 7-->
