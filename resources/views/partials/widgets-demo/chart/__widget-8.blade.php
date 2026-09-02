@php($vars = $vars ?? [])
<!--begin::Chart widget 8-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-xl-100' }}">
    <!--begin::Header-->
    <div class="{{ $vars['header_class'] ?? 'card-header pt-5' }}">
        <!--begin::Title-->
        <h3 class="{{ $vars['title_wrapper_class'] ?? 'card-title align-items-start flex-column' }}">
            <span class="{{ $vars['title_class'] ?? 'card-label fw-bold text-gray-900' }}">{{ $vars['title'] ?? 'Performance Overview' }}</span>
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 mt-1 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? 'Users from all channels' }}</span>
        </h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <ul class="{{ $vars['tabs_class'] ?? 'nav' }}" id="{{ $vars['tabs_id'] ?? 'kt_chart_widget_8_tabs' }}">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1"
                        data-bs-toggle="tab" id="{{ $vars['week_toggle_id'] ?? 'kt_chart_widget_8_week_toggle' }}"
                        href="#{{ $vars['week_tab_id'] ?? 'kt_chart_widget_8_week_tab' }}">{{ $vars['week_label'] ?? 'Month' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 active"
                        data-bs-toggle="tab" id="{{ $vars['month_toggle_id'] ?? 'kt_chart_widget_8_month_toggle' }}"
                        href="#{{ $vars['month_tab_id'] ?? 'kt_chart_widget_8_month_tab' }}">{{ $vars['month_label'] ?? 'Week' }}</a>
                </li>
            </ul>
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="{{ $vars['body_class'] ?? 'card-body pt-6' }}">
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade" id="{{ $vars['week_tab_id'] ?? 'kt_chart_widget_8_week_tab' }}" role="tabpanel">
                <!--begin::Statistics-->
                <div class="mb-5">
                    <!--begin::Statistics-->
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-1 fw-semibold text-gray-500 me-1 mt-n1">$</span>
                        <span class="fs-3x fw-bold text-gray-800 me-2 lh-1 ls-n2">18,89</span>
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span> </i>4,8%</span>
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Description-->
                    <span class="fs-6 fw-semibold text-gray-500">Avarage cost per interaction</span>
                    <!--end::Description-->
                </div>
                <!--end::Statistics-->
                <!--begin::Chart-->
                <div id="{{ $vars['week_chart_id'] ?? 'kt_chart_widget_8_week_chart' }}" class="{{ $vars['week_chart_class'] ?? 'ms-n5 min-h-auto' }}"
                    style="{{ $vars['week_chart_style'] ?? 'height: 275px' }}"></div>
                <!--end::Chart-->
                <!--begin::Items-->
                <div class="d-flex flex-wrap pt-5">
                    <!--begin::Item-->
                    <div class="d-flex flex-column me-7 me-lg-16 pt-sm-3 pt-6">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-primary me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">Social Campaigns</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-danger me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-&lt;gray-600 fs-6">Google Ads</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                    </div>
                    <!--ed::Item-->
                    <!--begin::Item-->
                    <div class="d-flex flex-column me-7 me-lg-16 pt-sm-3 pt-6">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-success me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">Email Newsletter</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-warning me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">Courses</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                    </div>
                    <!--ed::Item-->
                    <!--begin::Item-->
                    <div class="d-flex flex-column pt-sm-3 pt-6">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-info me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">TV Campaign</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-success me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">Radio</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                    </div>
                    <!--ed::Item-->
                </div>
                <!--ed::Items-->
            </div>
            <!--end::Tab pane-->
            <!--begin::Tab pane-->
            <div class="tab-pane fade active show" id="{{ $vars['month_tab_id'] ?? 'kt_chart_widget_8_month_tab' }}" role="tabpanel">
                <!--begin::Statistics-->
                <div class="mb-5">
                    <!--begin::Statistics-->
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-1 fw-semibold text-gray-500 me-1 mt-n1">$</span>
                        <span class="fs-3x fw-bold text-gray-800 me-2 lh-1 ls-n2">8,55</span>
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span> </i>2.2%</span>
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Description-->
                    <span class="fs-6 fw-semibold text-gray-500">Avarage cost per interaction</span>
                    <!--end::Description-->
                </div>
                <!--end::Statistics-->
                <!--begin::Chart-->
                <div id="{{ $vars['month_chart_id'] ?? 'kt_chart_widget_8_month_chart' }}" class="{{ $vars['month_chart_class'] ?? 'ms-n5 min-h-auto' }}"
                    style="{{ $vars['month_chart_style'] ?? 'height: 275px' }}">
                </div>
                <!--end::Chart-->
                <!--begin::Items-->
                <div class="d-flex flex-wrap pt-5">
                    <!--begin::Item-->
                    <div class="d-flex flex-column me-7 me-lg-16 pt-sm-3 pt-6">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-primary me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">Social Campaigns</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-danger me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">Google Ads</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                    </div>
                    <!--ed::Item-->
                    <!--begin::Item-->
                    <div class="d-flex flex-column me-7 me-lg-16 pt-sm-3 pt-6">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-success me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">Email Newsletter</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-warning me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">Courses</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                    </div>
                    <!--ed::Item-->
                    <!--begin::Item-->
                    <div class="d-flex flex-column pt-sm-3 pt-6">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-info me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">TV Campaign</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-dot bg-success me-2 h-10px w-10px"></span>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <span class="fw-bold text-gray-600 fs-6">Radio</span>
                            <!--end::Label-->
                        </div>
                        <!--ed::Item-->
                    </div>
                    <!--ed::Item-->
                </div>
                <!--ed::Items-->
            </div>
            <!--end::Tab pane-->
        </div>
        <!--end::Tab content-->
    </div>
    <!--end::Body-->
</div>
<!--end::Chart widget 8-->
