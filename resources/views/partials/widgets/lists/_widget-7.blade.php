@php
    $listsWidget7Variant = $listsWidget7Variant ?? null
@endphp
@if ($listsWidget7Variant === 'a')
<!--begin::List Widget 7-->
<div class="card card-xl-stretch mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bold text-gray-900">Latest Media</span>
            <span class="text-muted mt-1 fw-semibold fs-7">Articles and publications</span>
        </h3>
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-category fs-6"><span class="path1"></span><span class="path2"></span><span
                        class="path3"></span><span class="path4"></span></i> </button>
            <!--layout-partial:partials/menus/_menu-1.html-->
            @include('partials.menus._menu-1')
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-3">
        <!--begin::Item-->
        <div class="d-flex align-items-sm-center mb-7">
            <!--begin::Symbol-->
            <div class="symbol symbol-60px symbol-2by3 me-4">
                <div class="symbol-label" style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-20.jpg', $theme_asset_pack ?? null) }}')"></div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                <div class="flex-grow-1 me-2">
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Cup & Green</a>
                    <span class="text-muted fw-semibold d-block pt-1">Size: 87KB</span>
                </div>
                <span class="badge badge-light-success fs-8 fw-bold my-2">Approved</span>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="d-flex align-items-sm-center mb-7">
            <!--begin::Symbol-->
            <div class="symbol symbol-60px symbol-2by3 me-4">
                <div class="symbol-label" style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-19.jpg', $theme_asset_pack ?? null) }}')"></div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                <div class="flex-grow-1 me-2">
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Yellow Background</a>
                    <span class="text-muted fw-semibold d-block pt-1">Size: 1.2MB</span>
                </div>
                <span class="badge badge-light-warning fs-8 fw-bold my-2">In Progress</span>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="d-flex align-items-sm-center mb-7">
            <!--begin::Symbol-->
            <div class="symbol symbol-60px symbol-2by3 me-4">
                <div class="symbol-label" style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-25.jpg', $theme_asset_pack ?? null) }}')"></div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                <div class="flex-grow-1 me-2">
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Nike & Blue</a>
                    <span class="text-muted fw-semibold d-block pt-1">Size: 87KB</span>
                </div>
                <span class="badge badge-light-success fs-8 fw-bold my-2">Success</span>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="d-flex align-items-sm-center ">
            <!--begin::Symbol-->
            <div class="symbol symbol-60px symbol-2by3 me-4">
                <div class="symbol-label" style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-24.jpg', $theme_asset_pack ?? null) }}')"></div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                <div class="flex-grow-1 me-2">
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Red Boots</a>
                    <span class="text-muted fw-semibold d-block pt-1">Size: 345KB</span>
                </div>
                <span class="badge badge-light-danger fs-8 fw-bold my-2">Rejected</span>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Item-->
    </div>
    <!--end::Body-->
</div>
<!--end::List Widget 7-->

@else
<!--begin::List widget 7-->
<div class="card card-flush h-md-100">
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
                    <i class="ki-duotone ki-arrow-up fs-5 text-danger ms-n1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>8.02%</span>
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
            <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                <i class="ki-duotone ki-dots-square fs-1 text-gray-500 me-n1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            </button>
            <!--begin::Menu 2-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator mb-3 opacity-75"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="javascript:void(0)" class="menu-link px-3">New Ticket</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="javascript:void(0)" class="menu-link px-3">New Customer</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                    <!--begin::Menu item-->
                    <a href="javascript:void(0)" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--end::Menu item-->
                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu sub-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="javascript:void(0)" class="menu-link px-3">New Contact</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator mt-3 opacity-75"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary btn-sm px-4" href="javascript:void(0)">Generate Reports</a>
                    </div>
                </div>
                <!--end::Menu item-->
            </div>
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
                            <i class="ki-duotone ki-magnifier fs-3 text-gray-600">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Search Retargeting</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link clicks</span>
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
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>2.4%</span>
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
                            <i class="ki-duotone ki-tiktok fs-3 text-gray-600">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Social Retargeting</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link clicks</span>
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
                            <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>9.4%</span>
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
                            <i class="ki-duotone ki-sms fs-3 text-gray-600">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Email Retargeting</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link clicks</span>
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
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>0.2%</span>
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
                            <i class="ki-duotone ki-icon fs-3 text-gray-600">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Referrals
                            Customers</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link clicks</span>
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
                            <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>0.4%</span>
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
                            <i class="ki-duotone ki-abstract-25 fs-3 text-gray-600">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Other</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct link clicks</span>
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
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>8.3%</span>
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

@endif
