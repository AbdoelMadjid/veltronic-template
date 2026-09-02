@php
    $tablesWidget4Variant = $tablesWidget4Variant ?? null
@endphp
@if ($tablesWidget4Variant === 'a')
<!--begin::Tables Widget 4-->
<div class="card ">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">New Members</span>
            <span class="text-muted mt-1 fw-semibold fs-7">More than 400 new members</span>
        </h3>
        <div class="card-toolbar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary active fw-bold px-4 me-1"
                        data-bs-toggle="tab" href="#kt_table_widget_4_tab_1">Month</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4 me-1"
                        data-bs-toggle="tab" href="#kt_table_widget_4_tab_2">Week</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4"
                        data-bs-toggle="tab" href="#kt_table_widget_4_tab_3">Day</a>
                </li>
            </ul>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <div class="tab-content">
            <!--begin::Tap pane-->
            <div class="tab-pane fade show active" id="kt_table_widget_4_tab_1">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-3">
                        <!--begin::Table head-->
                        <thead>
                            <tr>
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-140px"></th>
                                <th class="p-0 min-w-120px"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-14.jpg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad
                                        Simmons</a>
                                    <span class="text-muted fw-semibold d-block fs-7">Movie Creator</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-5.jpg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie
                                        Clarcson</a>
                                    <span class="text-muted fw-semibold d-block fs-7">HTML, CSS Coding</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-20.jpg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Lebron
                                        Wayde</a>
                                    <span class="text-muted fw-semibold d-block fs-7">ReactJS Developer</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label ">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-23.jpg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
                                    <span class="text-muted fw-semibold d-block fs-7">UI/UX Designer</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-10.jpg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Kevin
                                        Leonard</a>
                                    <span class="text-muted fw-semibold d-block fs-7">Art Director</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label ">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label ">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Tap pane-->
            <!--begin::Tap pane-->
            <div class="tab-pane fade " id="kt_table_widget_4_tab_2">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-3">
                        <!--begin::Table head-->
                        <thead>
                            <tr>
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-140px"></th>
                                <th class="p-0 min-w-120px"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/svg/avatars/043-boy-18.svg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Kevin
                                        Leonard</a>
                                    <span class="text-muted fw-semibold d-block fs-7">Art Director</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label ">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label ">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/svg/avatars/014-girl-7.svg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
                                    <span class="text-muted fw-semibold d-block fs-7">UI/UX Designer</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/svg/avatars/018-girl-9.svg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
                                    <span class="text-muted fw-semibold d-block fs-7">HTML, CSS Coding</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/svg/avatars/001-boy.svg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad
                                        Simmons</a>
                                    <span class="text-muted fw-semibold d-block fs-7">Movie Creator</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Tap pane-->
            <!--begin::Tap pane-->
            <div class="tab-pane fade " id="kt_table_widget_4_tab_3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-3">
                        <!--begin::Table head-->
                        <thead>
                            <tr>
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-140px"></th>
                                <th class="p-0 min-w-120px"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/svg/avatars/018-girl-9.svg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
                                    <span class="text-muted fw-semibold d-block fs-7">HTML, CSS Coding</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/svg/avatars/047-girl-25.svg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Lebron Wayde</a>
                                    <span class="text-muted fw-semibold d-block fs-7">ReactJS Developer</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label ">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <img src="{{ \App\Support\ThemeAsset::url('media/svg/avatars/014-girl-7.svg', $theme_asset_pack ?? null) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
                                    <span class="text-muted fw-semibold d-block fs-7">UI/UX Designer</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-semibold d-block fs-7">
                                        Rating
                                    </span>
                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-twitter btn-sm me-3">
                                        <i class="ki-duotone ki-twitter fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-light-facebook btn-sm">
                                        <i class="ki-duotone ki-facebook fs-4"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Tap pane-->
        </div>
    </div>
    <!--end::Body-->
</div>
<!--end::Tables Widget 4-->

@elseif ($tablesWidget4Variant === 'b')
<div class="card card-flush h-xl-100">
    <!--begin::Card header-->
    <div class="card-header pt-7">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-800">My Sales in Details</span>
            <span class="text-gray-500 mt-1 fw-semibold fs-6">Avg. 57 orders per day</span>
        </h3>
        <!--end::Title-->
        <!--begin::Actions-->
        <div class="card-toolbar">
            <!--begin::Filters-->
            <div class="d-flex flex-stack flex-wrap gap-4">
                <!--begin::Destination-->
                <div class="d-flex align-items-center fw-bold">
                    <!--begin::Label-->
                    <div class="text-gray-500 fs-7 me-2">
                        Cateogry
                    </div>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <select
                        class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bold py-0 ps-3 w-auto"
                        data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px"
                        data-placeholder="Select an option">
                        <option></option>
                        <option value="Show All" selected="selected">
                            Show All
                        </option>
                        <option value="a">Category A</option>
                        <option value="b">Category A</option>
                    </select>
                    <!--end::Select-->
                </div>
                <!--end::Destination-->
                <!--begin::Status-->
                <div class="d-flex align-items-center fw-bold">
                    <!--begin::Label-->
                    <div class="text-gray-500 fs-7 me-2">
                        Status
                    </div>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto"
                        data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px"
                        data-placeholder="Select an option" data-kt-table-widget-4="filter_status">
                        <option></option>
                        <option value="Show All" selected="selected">
                            Show All
                        </option>
                        <option value="Shipped">Shipped</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Pending">Pending</option>
                    </select>
                    <!--end::Select-->
                </div>
                <!--end::Status-->
                <!--begin::Search-->
                <div class="position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-table-widget-4="search" class="form-control w-150px fs-7 ps-12"
                        placeholder="Search" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Filters-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-2">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-100px">Order ID</th>
                    <th class="text-end min-w-100px">Created</th>
                    <th class="text-end min-w-125px">Customer</th>
                    <th class="text-end min-w-100px">Total</th>
                    <th class="text-end min-w-100px">Profit</th>
                    <th class="text-end min-w-50px">Status</th>
                    <th class="text-end"></th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-bold text-gray-600">
                <tr data-kt-table-widget-4="subtable_template" class="d-none">
                    <td colspan="2">
                        <div class="d-flex align-items-center gap-3">
                            <a href="javascript:void(0)" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                <img src="" data-kt-src-path="{{ asset(\App\Support\ThemeVersion::assetBase($theme_asset_pack ?? null).'/media/stock/ecommerce/') }}" alt=""
                                    data-kt-table-widget-4="template_image" />
                            </a>
                            <div class="d-flex flex-column text-muted">
                                <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold"
                                    data-kt-table-widget-4="template_name">Product name</a>
                                <div class="fs-7" data-kt-table-widget-4="template_description">
                                    Product description
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="text-gray-800 fs-7">Cost</div>
                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_cost">
                            1
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="text-gray-800 fs-7">Qty</div>
                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_qty">
                            1
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="text-gray-800 fs-7">Total</div>
                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_total">
                            name
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="text-gray-800 fs-7 me-3">
                            On hand
                        </div>
                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_stock">
                            32
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('apps.ecommerce.catalog.edit-product') }}"
                            class="text-gray-800 text-hover-primary">#XGY-346</a>
                    </td>
                    <td class="text-end">7 min ago</td>
                    <td class="text-end">
                        <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Albert Flores</a>
                    </td>
                    <td class="text-end">$630.00</td>
                    <td class="text-end">
                        <span class="text-gray-800 fw-bolder">$86.70</span>
                    </td>
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                    </td>
                    <td class="text-end">
                        <button type="button"
                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                            data-kt-table-widget-4="expand_row">
                            <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                            <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('apps.ecommerce.catalog.edit-product') }}"
                            class="text-gray-800 text-hover-primary">#YHD-047</a>
                    </td>
                    <td class="text-end">52 min ago</td>
                    <td class="text-end">
                        <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Jenny Wilson</a>
                    </td>
                    <td class="text-end">$25.00</td>
                    <td class="text-end">
                        <span class="text-gray-800 fw-bolder">$4.20</span>
                    </td>
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-primary">Confirmed</span>
                    </td>
                    <td class="text-end">
                        <button type="button"
                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                            data-kt-table-widget-4="expand_row">
                            <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                            <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('apps.ecommerce.catalog.edit-product') }}"
                            class="text-gray-800 text-hover-primary">#SRR-678</a>
                    </td>
                    <td class="text-end">1 hour ago</td>
                    <td class="text-end">
                        <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Robert Fox</a>
                    </td>
                    <td class="text-end">$1,630.00</td>
                    <td class="text-end">
                        <span class="text-gray-800 fw-bolder">$203.90</span>
                    </td>
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                    </td>
                    <td class="text-end">
                        <button type="button"
                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                            data-kt-table-widget-4="expand_row">
                            <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                            <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('apps.ecommerce.catalog.edit-product') }}"
                            class="text-gray-800 text-hover-primary">#PXF-534</a>
                    </td>
                    <td class="text-end">3 hour ago</td>
                    <td class="text-end">
                        <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Cody Fisher</a>
                    </td>
                    <td class="text-end">$119.00</td>
                    <td class="text-end">
                        <span class="text-gray-800 fw-bolder">$12.00</span>
                    </td>
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                    </td>
                    <td class="text-end">
                        <button type="button"
                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                            data-kt-table-widget-4="expand_row">
                            <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                            <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('apps.ecommerce.catalog.edit-product') }}"
                            class="text-gray-800 text-hover-primary">#XGD-249</a>
                    </td>
                    <td class="text-end">2 day ago</td>
                    <td class="text-end">
                        <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Arlene McCoy</a>
                    </td>
                    <td class="text-end">$660.00</td>
                    <td class="text-end">
                        <span class="text-gray-800 fw-bolder">$52.26</span>
                    </td>
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                    </td>
                    <td class="text-end">
                        <button type="button"
                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                            data-kt-table-widget-4="expand_row">
                            <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                            <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('apps.ecommerce.catalog.edit-product') }}"
                            class="text-gray-800 text-hover-primary">#SKP-035</a>
                    </td>
                    <td class="text-end">2 day ago</td>
                    <td class="text-end">
                        <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Eleanor Pena</a>
                    </td>
                    <td class="text-end">$290.00</td>
                    <td class="text-end">
                        <span class="text-gray-800 fw-bolder">$29.00</span>
                    </td>
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-danger">Rejected</span>
                    </td>
                    <td class="text-end">
                        <button type="button"
                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                            data-kt-table-widget-4="expand_row">
                            <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                            <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('apps.ecommerce.catalog.edit-product') }}"
                            class="text-gray-800 text-hover-primary">#SKP-567</a>
                    </td>
                    <td class="text-end">7 min ago</td>
                    <td class="text-end">
                        <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Dan Wilson</a>
                    </td>
                    <td class="text-end">$590.00</td>
                    <td class="text-end">
                        <span class="text-gray-800 fw-bolder">$50.00</span>
                    </td>
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                    </td>
                    <td class="text-end">
                        <button type="button"
                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                            data-kt-table-widget-4="expand_row">
                            <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                            <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>

@else
@php
    $tableWidget4Title = $tableWidget4Title ?? 'My Sales in Details';
    $tableWidget4Subtitle = $tableWidget4Subtitle ?? 'Avg. 57 orders per day';
@endphp
<!--begin::Table Widget 4-->
											<div class="card card-flush h-xl-100">
												<!--begin::Card header-->
												<div class="card-header pt-7">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label fw-bold text-gray-800">{{ $tableWidget4Title }}</span>
														<span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $tableWidget4Subtitle }}</span>
													</h3>
													<!--end::Title-->
													<!--begin::Actions-->
													<div class="card-toolbar">
														<!--begin::Filters-->
														<div class="d-flex flex-stack flex-wrap gap-4">
															<!--begin::Destination-->
															<div class="d-flex align-items-center fw-bold">
																<!--begin::Label-->
																<div class="text-gray-500 fs-7 me-2">Cateogry</div>
																<!--end::Label-->
																<!--begin::Select-->
																<select class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option">
																	<option></option>
																	<option value="Show All" selected="selected">Show All</option>
																	<option value="a">Category A</option>
																	<option value="b">Category A</option>
																</select>
																<!--end::Select-->
															</div>
															<!--end::Destination-->
															<!--begin::Status-->
															<div class="d-flex align-items-center fw-bold">
																<!--begin::Label-->
																<div class="text-gray-500 fs-7 me-2">Status</div>
																<!--end::Label-->
																<!--begin::Select-->
																<select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-4="filter_status">
																	<option></option>
																	<option value="Show All" selected="selected">Show All</option>
																	<option value="Shipped">Shipped</option>
																	<option value="Confirmed">Confirmed</option>
																	<option value="Rejected">Rejected</option>
																	<option value="Pending">Pending</option>
																</select>
																<!--end::Select-->
															</div>
															<!--end::Status-->
															<!--begin::Search-->
															<div class="position-relative my-1">
																<i class="ki-duotone ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-4">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
																<input type="text" data-kt-table-widget-4="search" class="form-control w-150px fs-7 ps-12" placeholder="Search" />
															</div>
															<!--end::Search-->
														</div>
														<!--begin::Filters-->
													</div>
													<!--end::Actions-->
												</div>
												<!--end::Card header-->
												<!--begin::Card body-->
												<div class="card-body pt-2">
													<!--begin::Table-->
													<table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
														<!--begin::Table head-->
														<thead>
															<!--begin::Table row-->
															<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
																<th class="min-w-100px">Order ID</th>
																<th class="text-end min-w-100px">Created</th>
																<th class="text-end min-w-125px">Customer</th>
																<th class="text-end min-w-100px">Total</th>
																<th class="text-end min-w-100px">Profit</th>
																<th class="text-end min-w-50px">Status</th>
																<th class="text-end"></th>
															</tr>
															<!--end::Table row-->
														</thead>
														<!--end::Table head-->
														<!--begin::Table body-->
														<tbody class="fw-bold text-gray-600">
															<tr data-kt-table-widget-4="subtable_template" class="d-none">
																<td colspan="2">
																	<div class="d-flex align-items-center gap-3">
																		<a href="javascript:void(0)" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
																			<img src="" data-kt-src-path="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/', $theme_asset_pack ?? null) }}" alt="" data-kt-table-widget-4="template_image" />
																		</a>
																		<div class="d-flex flex-column text-muted">
																			<a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold" data-kt-table-widget-4="template_name">Product name</a>
																			<div class="fs-7" data-kt-table-widget-4="template_description">Product description</div>
																		</div>
																	</div>
																</td>
																<td class="text-end">
																	<div class="text-gray-800 fs-7">Cost</div>
																	<div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_cost">1</div>
																</td>
																<td class="text-end">
																	<div class="text-gray-800 fs-7">Qty</div>
																	<div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_qty">1</div>
																</td>
																<td class="text-end">
																	<div class="text-gray-800 fs-7">Total</div>
																	<div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_total">name</div>
																</td>
																<td class="text-end">
																	<div class="text-gray-800 fs-7 me-3">On hand</div>
																	<div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_stock">32</div>
																</td>
																<td></td>
															</tr>
															<tr>
																<td>
																	<a href="{{ url('apps/ecommerce/catalog/edit-product') }}" class="text-gray-800 text-hover-primary">#XGY-346</a>
																</td>
																<td class="text-end">7 min ago</td>
																<td class="text-end">
																	<a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Albert Flores</a>
																</td>
																<td class="text-end">$630.00</td>
																<td class="text-end">
																	<span class="text-gray-800 fw-bolder">$86.70</span>
																</td>
																<td class="text-end">
																	<span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
																</td>
																<td class="text-end">
																	<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
																		<i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
																		<i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
																	</button>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="{{ url('apps/ecommerce/catalog/edit-product') }}" class="text-gray-800 text-hover-primary">#YHD-047</a>
																</td>
																<td class="text-end">52 min ago</td>
																<td class="text-end">
																	<a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Jenny Wilson</a>
																</td>
																<td class="text-end">$25.00</td>
																<td class="text-end">
																	<span class="text-gray-800 fw-bolder">$4.20</span>
																</td>
																<td class="text-end">
																	<span class="badge py-3 px-4 fs-7 badge-light-primary">Confirmed</span>
																</td>
																<td class="text-end">
																	<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
																		<i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
																		<i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
																	</button>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="{{ url('apps/ecommerce/catalog/edit-product') }}" class="text-gray-800 text-hover-primary">#SRR-678</a>
																</td>
																<td class="text-end">1 hour ago</td>
																<td class="text-end">
																	<a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Robert Fox</a>
																</td>
																<td class="text-end">$1,630.00</td>
																<td class="text-end">
																	<span class="text-gray-800 fw-bolder">$203.90</span>
																</td>
																<td class="text-end">
																	<span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
																</td>
																<td class="text-end">
																	<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
																		<i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
																		<i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
																	</button>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="{{ url('apps/ecommerce/catalog/edit-product') }}" class="text-gray-800 text-hover-primary">#PXF-534</a>
																</td>
																<td class="text-end">3 hour ago</td>
																<td class="text-end">
																	<a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Cody Fisher</a>
																</td>
																<td class="text-end">$119.00</td>
																<td class="text-end">
																	<span class="text-gray-800 fw-bolder">$12.00</span>
																</td>
																<td class="text-end">
																	<span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
																</td>
																<td class="text-end">
																	<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
																		<i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
																		<i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
																	</button>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="{{ url('apps/ecommerce/catalog/edit-product') }}" class="text-gray-800 text-hover-primary">#XGD-249</a>
																</td>
																<td class="text-end">2 day ago</td>
																<td class="text-end">
																	<a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Arlene McCoy</a>
																</td>
																<td class="text-end">$660.00</td>
																<td class="text-end">
																	<span class="text-gray-800 fw-bolder">$52.26</span>
																</td>
																<td class="text-end">
																	<span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
																</td>
																<td class="text-end">
																	<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
																		<i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
																		<i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
																	</button>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="{{ url('apps/ecommerce/catalog/edit-product') }}" class="text-gray-800 text-hover-primary">#SKP-035</a>
																</td>
																<td class="text-end">2 day ago</td>
																<td class="text-end">
																	<a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Eleanor Pena</a>
																</td>
																<td class="text-end">$290.00</td>
																<td class="text-end">
																	<span class="text-gray-800 fw-bolder">$29.00</span>
																</td>
																<td class="text-end">
																	<span class="badge py-3 px-4 fs-7 badge-light-danger">Rejected</span>
																</td>
																<td class="text-end">
																	<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
																		<i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
																		<i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
																	</button>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="{{ url('apps/ecommerce/catalog/edit-product') }}" class="text-gray-800 text-hover-primary">#SKP-567</a>
																</td>
																<td class="text-end">7 min ago</td>
																<td class="text-end">
																	<a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Dan Wilson</a>
																</td>
																<td class="text-end">$590.00</td>
																<td class="text-end">
																	<span class="text-gray-800 fw-bolder">$50.00</span>
																</td>
																<td class="text-end">
																	<span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
																</td>
																<td class="text-end">
																	<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
																		<i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
																		<i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
																	</button>
																</td>
															</tr>
														</tbody>
														<!--end::Table body-->
													</table>
													<!--end::Table-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Table Widget 4-->

@endif
