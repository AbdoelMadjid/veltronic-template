@php
    $tablesWidget2Variant = $tablesWidget2Variant ?? null
@endphp
@if ($tablesWidget2Variant === 'a')
<!--begin::Tables Widget 2-->
<div class="card ">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Latest Arrivals</span>
            <span class="text-muted mt-1 fw-semibold fs-7">More than 100 new products</span>
        </h3>
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-category fs-6"><span class="path1"></span><span class="path2"></span><span
                        class="path3"></span><span class="path4"></span></i> </button>
            <!--begin::Menu 1-->
            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                id="kt_menu_68e64e5eee4f5">
                <!--begin::Header-->
                <div class="px-7 py-5">
                    <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                </div>
                <!--end::Header-->
                <!--begin::Menu separator-->
                <div class="separator border-gray-200"></div>
                <!--end::Menu separator-->
                <!--begin::Form-->
                <div class="px-7 py-5">
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-semibold">Status:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div>
                            <select class="form-select form-select-solid" multiple data-kt-select2="true"
                                data-close-on-select="false" data-placeholder="Select option"
                                data-dropdown-parent="#kt_menu_68e64e5eee4f5" data-allow-clear="true">
                                <option></option>
                                <option value="1">Approved</option>
                                <option value="2">Pending</option>
                                <option value="2">In Process</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-semibold">Member Type:</label>
                        <!--end::Label-->
                        <!--begin::Options-->
                        <div class="d-flex">
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="checkbox" value="1" />
                                <span class="form-check-label">
                                    Author
                                </span>
                            </label>
                            <!--end::Options-->
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                <span class="form-check-label">
                                    Customer
                                </span>
                            </label>
                            <!--end::Options-->
                        </div>
                        <!--end::Options-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-semibold">Notifications:</label>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" name="notifications"
                                checked />
                            <label class="form-check-label">
                                Enabled
                            </label>
                        </div>
                        <!--end::Switch-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                            data-kt-menu-dismiss="true">Reset</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Menu 1-->
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-5">
                <!--begin::Table head-->
                <thead>
                    <tr>
                        <th class="p-0 w-50px"></th>
                        <th class="p-0 min-w-150px"></th>
                        <th class="p-0 min-w-150px"></th>
                        <th class="p-0 min-w-125px"></th>
                        <th class="p-0 min-w-40px"></th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    <tr>
                        <td>
                            <div class="symbol symbol-50px me-2">
                                <span class="symbol-label">
                                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/plurk.svg', $theme_asset_pack ?? null) }}" class="h-50 align-self-center"
                                        alt="" />
                                </span>
                            </div>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Top Authors</a>
                            <span class="text-muted fw-semibold d-block fs-7">Successful Fellas</span>
                        </td>
                        <td class="text-end">
                            <span class="badge badge-light-danger fw-semibold me-1">Angular</span>
                            <span class="badge badge-light-info fw-semibold me-1">PHP</span>
                        </td>
                        <td class="text-end">
                            <span class="text-muted fw-bold">
                                4600 Users </span>
                        </td>
                        <td class="text-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                        class="path2"></span></i> </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="symbol symbol-50px me-2">
                                <span class="symbol-label">
                                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/telegram.svg', $theme_asset_pack ?? null) }}" class="h-50 align-self-center"
                                        alt="" />
                                </span>
                            </div>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular
                                Authors</a>
                            <span class="text-muted fw-semibold d-block fs-7">Most Successful</span>
                        </td>
                        <td class="text-end">
                            <span class="badge badge-light-danger fw-semibold me-1">HTML</span>
                            <span class="badge badge-light-info fw-semibold me-1">CSS</span>
                        </td>
                        <td class="text-end">
                            <span class="text-muted fw-bold">
                                7200 Users </span>
                        </td>
                        <td class="text-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                        class="path2"></span></i> </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="symbol symbol-50px me-2">
                                <span class="symbol-label">
                                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/vimeo.svg', $theme_asset_pack ?? null) }}" class="h-50 align-self-center"
                                        alt="" />
                                </span>
                            </div>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">New Users</a>
                            <span class="text-muted fw-semibold d-block fs-7">Awesome Users</span>
                        </td>
                        <td class="text-end">
                            <span class="badge badge-light-danger fw-semibold me-1">React</span>
                            <span class="badge badge-light-info fw-semibold me-1">SASS</span>
                        </td>
                        <td class="text-end">
                            <span class="text-muted fw-bold">
                                890 Users </span>
                        </td>
                        <td class="text-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                        class="path2"></span></i> </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="symbol symbol-50px me-2">
                                <span class="symbol-label">
                                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/bebo.svg', $theme_asset_pack ?? null) }}" class="h-50 align-self-center"
                                        alt="" />
                                </span>
                            </div>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active
                                Customers</a>
                            <span class="text-muted fw-semibold d-block fs-7">Best Customers</span>
                        </td>
                        <td class="text-end">
                            <span class="badge badge-light-danger fw-semibold me-1">Java</span>
                            <span class="badge badge-light-info fw-semibold me-1">PHP</span>
                        </td>
                        <td class="text-end">
                            <span class="text-muted fw-bold">
                                6370 Users </span>
                        </td>
                        <td class="text-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                        class="path2"></span></i> </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="symbol symbol-50px me-2">
                                <span class="symbol-label">
                                    <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/kickstarter.svg', $theme_asset_pack ?? null) }}"
                                        class="h-50 align-self-center" alt="" />
                                </span>
                            </div>
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Bestseller
                                Theme</a>
                            <span class="text-muted fw-semibold d-block fs-7">Amazing Templates</span>
                        </td>
                        <td class="text-end">
                            <span class="badge badge-light-danger fw-semibold me-1">Python</span>
                            <span class="badge badge-light-info fw-semibold me-1">MySQL</span>
                        </td>
                        <td class="text-end">
                            <span class="text-muted fw-bold">
                                354 Users </span>
                        </td>
                        <td class="text-end">
                            <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span
                                        class="path2"></span></i> </a>
                        </td>
                    </tr>
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--end::Body-->
</div>
<!--end::Tables Widget 2-->

@else
<!--begin::Table widget 2-->
<div class="card h-md-100">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0">
        <!--begin::Title-->
        <h3 class="fw-bold text-gray-900 m-0">Recent Orders</h3>
        <!--end::Title-->
        <!--begin::Menu-->
        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
            <i class="ki-duotone ki-dots-square fs-1">
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
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-2">
        <!--begin::Nav-->
        <ul class="nav nav-pills nav-pills-custom mb-3">
            <!--begin::Item-->
            <li class="nav-item mb-3 me-3 me-lg-6">
                <!--begin::Link-->
                <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden active w-80px h-85px py-4"
                    data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                    <!--begin::Icon-->
                    <div class="nav-icon">
                        <img alt="" src="{{ \App\Support\ThemeAsset::url('media/svg/products-categories/t-shirt.svg', $theme_asset_pack ?? null) }}" class="" />
                    </div>
                    <!--end::Icon-->
                    <!--begin::Subtitle-->
                    <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">T-shirt</span>
                    <!--end::Subtitle-->
                    <!--begin::Bullet-->
                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                    <!--end::Bullet-->
                </a>
                <!--end::Link-->
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-3 me-3 me-lg-6">
                <!--begin::Link-->
                <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"
                    data-bs-toggle="pill" href="#kt_stats_widget_2_tab_2">
                    <!--begin::Icon-->
                    <div class="nav-icon">
                        <img alt="" src="{{ \App\Support\ThemeAsset::url('media/svg/products-categories/gaming.svg', $theme_asset_pack ?? null) }}" class="" />
                    </div>
                    <!--end::Icon-->
                    <!--begin::Subtitle-->
                    <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">Gaming</span>
                    <!--end::Subtitle-->
                    <!--begin::Bullet-->
                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                    <!--end::Bullet-->
                </a>
                <!--end::Link-->
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-3 me-3 me-lg-6">
                <!--begin::Link-->
                <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"
                    data-bs-toggle="pill" href="#kt_stats_widget_2_tab_3">
                    <!--begin::Icon-->
                    <div class="nav-icon">
                        <img alt="" src="{{ \App\Support\ThemeAsset::url('media/svg/products-categories/watch.svg', $theme_asset_pack ?? null) }}" class="" />
                    </div>
                    <!--end::Icon-->
                    <!--begin::Subtitle-->
                    <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Watch</span>
                    <!--end::Subtitle-->
                    <!--begin::Bullet-->
                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                    <!--end::Bullet-->
                </a>
                <!--end::Link-->
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-3 me-3 me-lg-6">
                <!--begin::Link-->
                <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"
                    data-bs-toggle="pill" href="#kt_stats_widget_2_tab_4">
                    <!--begin::Icon-->
                    <div class="nav-icon">
                        <img alt="" src="{{ \App\Support\ThemeAsset::url('media/svg/products-categories/gloves.svg', $theme_asset_pack ?? null) }}" class="nav-icon" />
                    </div>
                    <!--end::Icon-->
                    <!--begin::Subtitle-->
                    <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Gloves</span>
                    <!--end::Subtitle-->
                    <!--begin::Bullet-->
                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                    <!--end::Bullet-->
                </a>
                <!--end::Link-->
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-3">
                <!--begin::Link-->
                <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"
                    data-bs-toggle="pill" href="#kt_stats_widget_2_tab_5">
                    <!--begin::Icon-->
                    <div class="nav-icon">
                        <img alt="" src="{{ \App\Support\ThemeAsset::url('media/svg/products-categories/shoes.svg', $theme_asset_pack ?? null) }}" class="nav-icon" />
                    </div>
                    <!--end::Icon-->
                    <!--begin::Subtitle-->
                    <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Shoes</span>
                    <!--end::Subtitle-->
                    <!--begin::Bullet-->
                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                    <!--end::Bullet-->
                </a>
                <!--end::Link-->
            </li>
            <!--end::Item-->
        </ul>
        <!--end::Nav-->
        <!--begin::Tab Content-->
        <div class="tab-content">
            <!--begin::Tap pane-->
            <div class="tab-pane fade show active" id="kt_stats_widget_2_tab_1">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                <th class="ps-0 w-50px">ITEM</th>
                                <th class="min-w-125px"></th>
                                <th class="text-end min-w-100px">QTY</th>
                                <th class="pe-0 text-end min-w-100px">PRICE</th>
                                <th class="pe-0 text-end min-w-100px">TOTAL PRICE</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/210.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Elephant
                                        1802</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-2347</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$72.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$126.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/215.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Red
                                        Laga</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-1321</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$45.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$76.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/209.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-4312</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$84.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$168.00</span>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Tap pane-->
            <!--begin::Tap pane-->
            <div class="tab-pane fade" id="kt_stats_widget_2_tab_2">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                <th class="ps-0 w-50px">ITEM</th>
                                <th class="min-w-125px"></th>
                                <th class="text-end min-w-100px">QTY</th>
                                <th class="pe-0 text-end min-w-100px">PRICE</th>
                                <th class="pe-0 text-end min-w-100px">TOTAL PRICE</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/197.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Elephant
                                        1802</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-4312</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$32.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$312.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/178.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Red
                                        Laga</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-3122</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$53.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$62.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/22.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-1142</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$74.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$139.00</span>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Tap pane-->
            <!--begin::Tap pane-->
            <div class="tab-pane fade" id="kt_stats_widget_2_tab_3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                <th class="ps-0 w-50px">ITEM</th>
                                <th class="min-w-125px"></th>
                                <th class="text-end min-w-100px">QTY</th>
                                <th class="pe-0 text-end min-w-100px">PRICE</th>
                                <th class="pe-0 text-end min-w-100px">TOTAL PRICE</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/1.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Elephant
                                        1324</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-1523</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$43.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$231.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/24.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Red
                                        Laga</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-5314</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$71.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$53.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/71.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-4222</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$23.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$213.00</span>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Tap pane-->
            <!--begin::Tap pane-->
            <div class="tab-pane fade" id="kt_stats_widget_2_tab_4">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                <th class="ps-0 w-50px">ITEM</th>
                                <th class="min-w-125px"></th>
                                <th class="text-end min-w-100px">QTY</th>
                                <th class="pe-0 text-end min-w-100px">PRICE</th>
                                <th class="pe-0 text-end min-w-100px">TOTAL PRICE</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/41.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Elephant
                                        2635</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-1523</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$65.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$163.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/63.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Red
                                        Laga</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-2745</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$64.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$73.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/59.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-5173</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$54.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$173.00</span>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Tap pane-->
            <!--begin::Tap pane-->
            <div class="tab-pane fade" id="kt_stats_widget_2_tab_5">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                <th class="ps-0 w-50px">ITEM</th>
                                <th class="min-w-125px"></th>
                                <th class="text-end min-w-100px">QTY</th>
                                <th class="pe-0 text-end min-w-100px">PRICE</th>
                                <th class="pe-0 text-end min-w-100px">TOTAL PRICE</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/10.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Nike</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-2163</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$64.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$287.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/96.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Adidas</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-2162</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$76.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$51.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/13.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1"
                                        alt="" />
                                </td>
                                <td class="ps-0">
                                    <a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Puma</a>
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                        #XDG-1537</span>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$27.00</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-800 fw-bold d-block fs-6">$167.00</span>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Tap pane-->
        </div>
        <!--end::Tab Content-->
    </div>
    <!--end: Card Body-->
</div>
<!--end::Table widget 2-->

@endif
