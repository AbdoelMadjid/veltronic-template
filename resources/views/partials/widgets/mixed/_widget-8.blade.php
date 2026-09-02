@php
    $mixedWidget8Variant = $mixedWidget8Variant ?? null
@endphp
@if ($mixedWidget8Variant === 'a')
<div class="card card-xl-stretch mb-xl-8">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Heading-->
        <div class="d-flex flex-stack">
            <!--begin:Info-->
            <div class="d-flex align-items-center">
                <!--begin:Image-->
                <div class="symbol symbol-60px me-5">
                    <span class="symbol-label bg-primary-light">
                        <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/vimeo.svg', $theme_asset_pack ?? null) }}" class="h-50 align-self-center" alt="" />
                    </span>
                </div>
                <!--end:Image-->
                <!--begin:Title-->
                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary fs-5">Monthly
                        Subscription</a>
                    <span class="text-muted fw-bold">Due: 27 Apr 2020</span>
                </div>
                <!--end:Title-->
            </div>
            <!--begin:Info-->
            <!--begin:Menu-->
            <div class="ms-1">
                <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-category fs-6">
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
                        <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                            Actions</div>
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
                            <a class="btn btn-primary btn-sm px-4" href="javascript:void(0)">Generate
                                Reports</a>
                        </div>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu 2-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Heading-->
        <!--begin:Stats-->
        <div class="d-flex flex-column w-100 mt-12">
            <span class="text-gray-900 me-2 fw-bold pb-3">Progress</span>
            <div class="progress h-5px w-100">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <!--end:Stats-->
        <!--begin:Team-->
        <div class="d-flex flex-column mt-10">
            <div class="text-gray-900 me-2 fw-bold pb-4">Team</div>
            <div class="d-flex">
                <a href="javascript:void(0)" class="symbol symbol-35px me-2" data-bs-toggle="tooltip" title="Ana Stone">
                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-6.jpg', $theme_asset_pack ?? null) }}" alt="" />
                </a>
                <a href="javascript:void(0)" class="symbol symbol-35px me-2" data-bs-toggle="tooltip" title="Mark Larson">
                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-5.jpg', $theme_asset_pack ?? null) }}" alt="" />
                </a>
                <a href="javascript:void(0)" class="symbol symbol-35px me-2" data-bs-toggle="tooltip" title="Sam Harris">
                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-9.jpg', $theme_asset_pack ?? null) }}" alt="" />
                </a>
                <a href="javascript:void(0)" class="symbol symbol-35px" data-bs-toggle="tooltip" title="Alice Micto">
                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-10.jpg', $theme_asset_pack ?? null) }}" alt="" />
                </a>
            </div>
        </div>
        <!--end:Team-->
    </div>
    <!--end::Body-->
</div>

@else
<!--begin::Mixed Widget 8-->
<div class="card card-xl-stretch mb-xl-8">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Heading-->
        <div class="d-flex flex-stack">
            <!--begin:Info-->
            <div class="d-flex align-items-center">
                <!--begin:Image-->
                <div class="symbol symbol-60px me-5">
                    <span class="symbol-label bg-danger-light">
                        <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/plurk.svg', $theme_asset_pack ?? null) }}" class="h-50 align-self-center" alt="" />
                    </span>
                </div>
                <!--end:Image-->
                <!--begin:Title-->
                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary fs-5">Monthly Subscription</a>
                    <span class="text-muted fw-bold">Due: 27 Apr 2020</span>
                </div>
                <!--end:Title-->
            </div>
            <!--begin:Info-->
            <!--begin:Menu-->
            <div class="ms-1">
                <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-category fs-6">
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
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Heading-->
        <!--begin:Stats-->
        <div class="d-flex flex-column w-100 mt-12">
            <span class="text-gray-900 me-2 fw-bold pb-3">Progress</span>
            <div class="progress h-5px w-100">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <!--end:Stats-->
        <!--begin:Team-->
        <div class="d-flex flex-column mt-10">
            <div class="text-gray-900 me-2 fw-bold pb-4">Team</div>
            <div class="d-flex">
                <a href="javascript:void(0)" class="symbol symbol-35px me-2" data-bs-toggle="tooltip" title="Ana Stone">
                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-6.jpg', $theme_asset_pack ?? null) }}" alt="" />
                </a>
                <a href="javascript:void(0)" class="symbol symbol-35px me-2" data-bs-toggle="tooltip" title="Mark Larson">
                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-5.jpg', $theme_asset_pack ?? null) }}" alt="" />
                </a>
                <a href="javascript:void(0)" class="symbol symbol-35px me-2" data-bs-toggle="tooltip" title="Sam Harris">
                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-9.jpg', $theme_asset_pack ?? null) }}" alt="" />
                </a>
                <a href="javascript:void(0)" class="symbol symbol-35px" data-bs-toggle="tooltip" title="Alice Micto">
                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-10.jpg', $theme_asset_pack ?? null) }}" alt="" />
                </a>
            </div>
        </div>
        <!--end:Team-->
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 8-->

@endif
