@php
    $tablesWidget5Variant = $tablesWidget5Variant ?? null
@endphp
@if ($tablesWidget5Variant === 'a')
<!--begin::Tables Widget 5-->
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Latest Products</span>
            <span class="text-muted mt-1 fw-semibold fs-7">More than 400 new products</span>
        </h3>
        <div class="card-toolbar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1 active"
                        data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">Month</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1"
                        data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">Week</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4"
                        data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">Day</a>
                </li>
            </ul>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <div class="tab-content">
            <!--begin::Tap pane-->
            <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="border-0">
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-140px"></th>
                                <th class="p-0 min-w-110px"></th>
                                <th class="p-0 min-w-50px"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/plurk.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad
                                        Simmons</a>
                                    <span class="text-muted fw-semibold d-block">Movie Creator</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    React, HTML </td>
                                <td class="text-end">
                                    <span class="badge badge-light-success">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/telegram.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular
                                        Authors</a>
                                    <span class="text-muted fw-semibold d-block">Most Successful</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    Python, MySQL </td>
                                <td class="text-end">
                                    <span class="badge badge-light-warning">In Progress</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/vimeo.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">New
                                        Users</a>
                                    <span class="text-muted fw-semibold d-block">Awesome Users</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    Laravel,Metronic </td>
                                <td class="text-end">
                                    <span class="badge badge-light-primary">Success</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/bebo.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active
                                        Customers</a>
                                    <span class="text-muted fw-semibold d-block">Movie Creator</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    AngularJS, C# </td>
                                <td class="text-end">
                                    <span class="badge badge-light-danger">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/kickstarter.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Bestseller Theme</a>
                                    <span class="text-muted fw-semibold d-block">Best Customers</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    ReactJS, Ruby </td>
                                <td class="text-end">
                                    <span class="badge badge-light-warning">In Progress</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
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
            <div class="tab-pane fade " id="kt_table_widget_5_tab_2">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="border-0">
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-140px"></th>
                                <th class="p-0 min-w-110px"></th>
                                <th class="p-0 min-w-50px"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/plurk.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad
                                        Simmons</a>
                                    <span class="text-muted fw-semibold d-block">Movie Creator</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    React, HTML </td>
                                <td class="text-end">
                                    <span class="badge badge-light-success">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/telegram.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular Authors</a>
                                    <span class="text-muted fw-semibold d-block">Most Successful</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    Python, MySQL </td>
                                <td class="text-end">
                                    <span class="badge badge-light-warning">In Progress</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/bebo.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
                                    <span class="text-muted fw-semibold d-block">Movie Creator</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    AngularJS, C# </td>
                                <td class="text-end">
                                    <span class="badge badge-light-danger">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
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
            <div class="tab-pane fade " id="kt_table_widget_5_tab_3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="border-0">
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-140px"></th>
                                <th class="p-0 min-w-110px"></th>
                                <th class="p-0 min-w-50px"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/kickstarter.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Bestseller Theme</a>
                                    <span class="text-muted fw-semibold d-block">Best Customers</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    ReactJS, Ruby </td>
                                <td class="text-end">
                                    <span class="badge badge-light-warning">In Progress</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/bebo.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
                                    <span class="text-muted fw-semibold d-block">Movie Creator</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    AngularJS, C# </td>
                                <td class="text-end">
                                    <span class="badge badge-light-danger">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/vimeo.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">New
                                        Users</a>
                                    <span class="text-muted fw-semibold d-block">Awesome Users</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    Laravel,Metronic </td>
                                <td class="text-end">
                                    <span class="badge badge-light-primary">Success</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="symbol symbol-45px me-2">
                                        <span class="symbol-label">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/telegram.svg', $theme_asset_pack ?? null) }}"
                                                class="h-50 align-self-center" alt="" />
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular Authors</a>
                                    <span class="text-muted fw-semibold d-block">Most Successful</span>
                                </td>
                                <td class="text-end text-muted fw-bold">
                                    Python, MySQL </td>
                                <td class="text-end">
                                    <span class="badge badge-light-warning">In Progress</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:void(0)"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                        <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
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
<!--end::Tables Widget 5-->

@else
@php
    $tableWidget5Title = $tableWidget5Title ?? 'Stock Report';
    $tableWidget5Subtitle = $tableWidget5Subtitle ?? 'Total 2,356 Items in the Stock';
@endphp
<!--begin::Table Widget 5-->
<div class="card card-flush h-xl-100">
    <!--begin::Card header-->
    <div class="card-header pt-7">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-900">{{ $tableWidget5Title }}</span>
            <span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $tableWidget5Subtitle }}</span>
        </h3>
        <!--end::Title-->
        <!--begin::Actions-->
        <div class="card-toolbar">
            <!--begin::Filters-->
            <div class="d-flex flex-stack flex-wrap gap-4">
                <!--begin::Destination-->
                <div class="d-flex align-items-center fw-bold">
                    <!--begin::Label-->
                    <div class="text-muted fs-7 me-2">Cateogry</div>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto"
                        data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px"
                        data-placeholder="Select an option">
                        <option></option>
                        <option value="Show All" selected="selected">Show All</option>
                        <option value="a">Category A</option>
                        <option value="b">Category B</option>
                    </select>
                    <!--end::Select-->
                </div>
                <!--end::Destination-->
                <!--begin::Status-->
                <div class="d-flex align-items-center fw-bold">
                    <!--begin::Label-->
                    <div class="text-muted fs-7 me-2">Status</div>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto"
                        data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px"
                        data-placeholder="Select an option" data-kt-table-widget-5="filter_status">
                        <option></option>
                        <option value="Show All" selected="selected">Show All</option>
                        <option value="In Stock">In Stock</option>
                        <option value="Out of Stock">Out of Stock</option>
                        <option value="Low Stock">Low Stock</option>
                    </select>
                    <!--end::Select-->
                </div>
                <!--end::Status-->
                <!--begin::Search-->
                <a href="{{ url('apps/ecommerce/catalog/products') }}" class="btn btn-light btn-sm">View Stock</a>
                <!--end::Search-->
            </div>
            <!--begin::Filters-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-150px">Item</th>
                    <th class="text-end pe-3 min-w-100px">Product ID</th>
                    <th class="text-end pe-3 min-w-150px">Date Added</th>
                    <th class="text-end pe-3 min-w-100px">Price</th>
                    <th class="text-end pe-3 min-w-100px">Status</th>
                    <th class="text-end pe-0 min-w-75px">Qty</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-bold text-gray-600">
                <tr>
                    <!--begin::Item-->
                    <td>
                        <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                            class="text-gray-900 text-hover-primary">Macbook Air M1</a>
                    </td>
                    <!--end::Item-->
                    <!--begin::Product ID-->
                    <td class="text-end">#XGY-356</td>
                    <!--end::Product ID-->
                    <!--begin::Date added-->
                    <td class="text-end">02 Apr, 2024</td>
                    <!--end::Date added-->
                    <!--begin::Price-->
                    <td class="text-end">$1,230</td>
                    <!--end::Price-->
                    <!--begin::Status-->
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                    </td>
                    <!--end::Status-->
                    <!--begin::Qty-->
                    <td class="text-end" data-order="58">
                        <span class="text-gray-900 fw-bold">58 PCS</span>
                    </td>
                    <!--end::Qty-->
                </tr>
                <tr>
                    <!--begin::Item-->
                    <td>
                        <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                            class="text-gray-900 text-hover-primary">Surface Laptop 4</a>
                    </td>
                    <!--end::Item-->
                    <!--begin::Product ID-->
                    <td class="text-end">#YHD-047</td>
                    <!--end::Product ID-->
                    <!--begin::Date added-->
                    <td class="text-end">01 Apr, 2024</td>
                    <!--end::Date added-->
                    <!--begin::Price-->
                    <td class="text-end">$1,060</td>
                    <!--end::Price-->
                    <!--begin::Status-->
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-danger">Out of Stock</span>
                    </td>
                    <!--end::Status-->
                    <!--begin::Qty-->
                    <td class="text-end" data-order="0">
                        <span class="text-gray-900 fw-bold">0 PCS</span>
                    </td>
                    <!--end::Qty-->
                </tr>
                <tr>
                    <!--begin::Item-->
                    <td>
                        <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                            class="text-gray-900 text-hover-primary">Logitech MX 250</a>
                    </td>
                    <!--end::Item-->
                    <!--begin::Product ID-->
                    <td class="text-end">#SRR-678</td>
                    <!--end::Product ID-->
                    <!--begin::Date added-->
                    <td class="text-end">24 Mar, 2024</td>
                    <!--end::Date added-->
                    <!--begin::Price-->
                    <td class="text-end">$64</td>
                    <!--end::Price-->
                    <!--begin::Status-->
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                    </td>
                    <!--end::Status-->
                    <!--begin::Qty-->
                    <td class="text-end" data-order="290">
                        <span class="text-gray-900 fw-bold">290 PCS</span>
                    </td>
                    <!--end::Qty-->
                </tr>
                <tr>
                    <!--begin::Item-->
                    <td>
                        <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                            class="text-gray-900 text-hover-primary">AudioEngine HD3</a>
                    </td>
                    <!--end::Item-->
                    <!--begin::Product ID-->
                    <td class="text-end">#PXF-578</td>
                    <!--end::Product ID-->
                    <!--begin::Date added-->
                    <td class="text-end">24 Mar, 2024</td>
                    <!--end::Date added-->
                    <!--begin::Price-->
                    <td class="text-end">$1,060</td>
                    <!--end::Price-->
                    <!--begin::Status-->
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-danger">Out of Stock</span>
                    </td>
                    <!--end::Status-->
                    <!--begin::Qty-->
                    <td class="text-end" data-order="46">
                        <span class="text-gray-900 fw-bold">46 PCS</span>
                    </td>
                    <!--end::Qty-->
                </tr>
                <tr>
                    <!--begin::Item-->
                    <td>
                        <a href="{{ url('apps/ecommerce/catalog/edit-product') }}" class="text-gray-900 text-hover-primary">HP
                            Hyper LTR</a>
                    </td>
                    <!--end::Item-->
                    <!--begin::Product ID-->
                    <td class="text-end">#PXF-778</td>
                    <!--end::Product ID-->
                    <!--begin::Date added-->
                    <td class="text-end">16 Jan, 2024</td>
                    <!--end::Date added-->
                    <!--begin::Price-->
                    <td class="text-end">$4500</td>
                    <!--end::Price-->
                    <!--begin::Status-->
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                    </td>
                    <!--end::Status-->
                    <!--begin::Qty-->
                    <td class="text-end" data-order="78">
                        <span class="text-gray-900 fw-bold">78 PCS</span>
                    </td>
                    <!--end::Qty-->
                </tr>
                <tr>
                    <!--begin::Item-->
                    <td>
                        <a href="{{ url('apps/ecommerce/catalog/edit-product') }}" class="text-gray-900 text-hover-primary">Dell
                            32 UltraSharp</a>
                    </td>
                    <!--end::Item-->
                    <!--begin::Product ID-->
                    <td class="text-end">#XGY-356</td>
                    <!--end::Product ID-->
                    <!--begin::Date added-->
                    <td class="text-end">22 Dec, 2024</td>
                    <!--end::Date added-->
                    <!--begin::Price-->
                    <td class="text-end">$1,060</td>
                    <!--end::Price-->
                    <!--begin::Status-->
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-warning">Low Stock</span>
                    </td>
                    <!--end::Status-->
                    <!--begin::Qty-->
                    <td class="text-end" data-order="8">
                        <span class="text-gray-900 fw-bold">8 PCS</span>
                    </td>
                    <!--end::Qty-->
                </tr>
                <tr>
                    <!--begin::Item-->
                    <td>
                        <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                            class="text-gray-900 text-hover-primary">Google Pixel 6 Pro</a>
                    </td>
                    <!--end::Item-->
                    <!--begin::Product ID-->
                    <td class="text-end">#XVR-425</td>
                    <!--end::Product ID-->
                    <!--begin::Date added-->
                    <td class="text-end">27 Dec, 2024</td>
                    <!--end::Date added-->
                    <!--begin::Price-->
                    <td class="text-end">$1,060</td>
                    <!--end::Price-->
                    <!--begin::Status-->
                    <td class="text-end">
                        <span class="badge py-3 px-4 fs-7 badge-light-primary">In Stock</span>
                    </td>
                    <!--end::Status-->
                    <!--begin::Qty-->
                    <td class="text-end" data-order="124">
                        <span class="text-gray-900 fw-bold">124 PCS</span>
                    </td>
                    <!--end::Qty-->
                </tr>
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Table Widget 5-->

@endif
