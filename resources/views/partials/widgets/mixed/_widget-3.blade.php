@php
    $mixedWidget3Variant = $mixedWidget3Variant ?? null
@endphp
@if ($mixedWidget3Variant === 'a')
<div class="card h-100 bgi-no-repeat bgi-size-cover card-xl-stretch mb-5 mb-xl-8"
    style="background-image:url('{{ \App\Support\ThemeAsset::url('media/misc/bg-2.jpg', $theme_asset_pack ?? null) }}')">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column justify-content-between">
        <!--begin::Title-->
        <div class="text-white fw-bold fs-2">
            <h2 class="fw-bold text-white mb-2">Create Reports</h2>With App
        </div>
        <!--end::Title-->
        <!--begin::Link-->
        <a href='javascript:void(0)' class="text-warning fw-semibold" data-bs-toggle="modal"
            data-bs-target="#kt_modal_create_campaign">Create Report
            <i class="ki-duotone ki-arrow-right fs-2 text-warning">
                <span class="path1"></span>
                <span class="path2"></span>
            </i></a>
        <!--end::Link-->
    </div>
    <!--end::Body-->
</div>

@else
<!--begin::Mixed Widget 3-->
<div class="card card-xl-stretch mb-xl-8">
    <!--begin::Beader-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Sales Overview</span>
            <span class="text-muted fw-semibold fs-7">Recent sales statistics</span>
        </h3>
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
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
                id="kt_menu_65a12148734da">
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
                            <select class="form-select form-select-solid" multiple="multiple" data-kt-select2="true"
                                data-close-on-select="false" data-placeholder="Select option"
                                data-dropdown-parent="#kt_menu_65a12148734da" data-allow-clear="true">
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
                                <span class="form-check-label">Author</span>
                            </label>
                            <!--end::Options-->
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="2" checked="checked" />
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
                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" name="notifications"
                                checked="checked" />
                            <label class="form-check-label">Enabled</label>
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
    <div class="card-body p-0 d-flex flex-column">
        <!--begin::Stats-->
        <div class="card-p pt-5 bg-body flex-grow-1">
            <!--begin::Row-->
            <div class="row g-0">
                <!--begin::Col-->
                <div class="col mr-8">
                    <!--begin::Label-->
                    <div class="fs-7 text-muted fw-bold">Average Sale</div>
                    <!--end::Label-->
                    <!--begin::Stat-->
                    <div class="d-flex align-items-center">
                        <div class="fs-4 fw-bold">$650</div>
                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Stat-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col">
                    <!--begin::Label-->
                    <div class="fs-7 text-muted fw-bold">Commission</div>
                    <!--end::Label-->
                    <!--begin::Stat-->
                    <div class="fs-4 fw-bold">$233,600</div>
                    <!--end::Stat-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-0 mt-8">
                <!--begin::Col-->
                <div class="col mr-8">
                    <!--begin::Label-->
                    <div class="fs-7 text-muted fw-bold">Annual Taxes 2019</div>
                    <!--end::Label-->
                    <!--begin::Stat-->
                    <div class="fs-4 fw-bold">$29,004</div>
                    <!--end::Stat-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col">
                    <!--begin::Label-->
                    <div class="fs-7 text-muted fw-bold">Annual Income</div>
                    <!--end::Label-->
                    <!--begin::Stat-->
                    <div class="d-flex align-items-center">
                        <div class="fs-4 fw-bold">$1,480,00</div>
                        <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Stat-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Stats-->
        <!--begin::Chart-->
        <div class="mixed-widget-3-chart card-rounded-bottom" data-kt-chart-color="primary" style="height: 150px"></div>
        <!--end::Chart-->
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 3-->

@endif
