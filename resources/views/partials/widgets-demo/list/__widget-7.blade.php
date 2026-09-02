<!--begin::List Widget 7-->
@php
    $widgetClass = $widgetClass ?? 'card h-md-100';
    $linkHref = $linkHref ?? 'javascript:void(0)';
    $menuId = $menuId ?? uniqid('kt_menu_list_widget_7_');
@endphp

<div class="{{ $widgetClass }}">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bold text-gray-900">Latest Media</span>
            <span class="text-muted mt-1 fw-semibold fs-7">Articles and publications</span>
        </h3>
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button"
                class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-category fs-6">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            </button>
            <!--begin::Menu 1-->
            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                id="{{ $menuId }}">
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
                            <select class="form-select form-select-solid" multiple="multiple"
                                data-kt-select2="true" data-close-on-select="false"
                                data-placeholder="Select option"
                                data-dropdown-parent="#{{ $menuId }}" data-allow-clear="true">
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
                            <label
                                class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="checkbox" value="1" />
                                <span class="form-check-label">Author</span>
                            </label>
                            <!--end::Options-->
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="2"
                                    checked="checked" />
                                <span class="form-check-label">Customer</span>
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
                        <div
                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value=""
                                name="notifications" checked="checked" />
                            <label class="form-check-label">Enabled</label>
                        </div>
                        <!--end::Switch-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end">
                        <button type="reset"
                            class="btn btn-sm btn-light btn-active-light-primary me-2"
                            data-kt-menu-dismiss="true">Reset</button>
                        <button type="submit" class="btn btn-sm btn-primary"
                            data-kt-menu-dismiss="true">Apply</button>
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
    <div class="card-body pt-3">
        <!--begin::Item-->
        <div class="d-flex align-items-sm-center mb-7">
            <!--begin::Symbol-->
            <div class="symbol symbol-60px symbol-2by3 me-4">
                <div class="symbol-label"
                    style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-20.jpg', $theme_asset_pack ?? null) }}')">
                </div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                <div class="flex-grow-1 me-2">
                    <a href="{{ $linkHref }}"
                        class="text-gray-800 fw-bold text-hover-primary fs-6">Cup &
                        Green</a>
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
                <div class="symbol-label"
                    style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-19.jpg', $theme_asset_pack ?? null) }}')">
                </div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                <div class="flex-grow-1 me-2">
                    <a href="{{ $linkHref }}"
                        class="text-gray-800 fw-bold text-hover-primary fs-6">Yellow
                        Background</a>
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
                <div class="symbol-label"
                    style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-25.jpg', $theme_asset_pack ?? null) }}')">
                </div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                <div class="flex-grow-1 me-2">
                    <a href="{{ $linkHref }}"
                        class="text-gray-800 fw-bold text-hover-primary fs-6">Nike &
                        Blue</a>
                    <span class="text-muted fw-semibold d-block pt-1">Size: 87KB</span>
                </div>
                <span class="badge badge-light-success fs-8 fw-bold my-2">Success</span>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="d-flex align-items-sm-center">
            <!--begin::Symbol-->
            <div class="symbol symbol-60px symbol-2by3 me-4">
                <div class="symbol-label"
                    style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-24.jpg', $theme_asset_pack ?? null) }}')">
                </div>
            </div>
            <!--end::Symbol-->
            <!--begin::Title-->
            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                <div class="flex-grow-1 me-2">
                    <a href="{{ $linkHref }}"
                        class="text-gray-800 fw-bold text-hover-primary fs-6">Red
                        Boots</a>
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
