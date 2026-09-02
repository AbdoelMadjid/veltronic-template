@php($vars = $vars ?? [])
<!--begin::Chart widget 27-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-xl-100' }}">
    <!--begin::Header-->
    <div class="card-header py-7">
        <!--begin::Statistics-->
        <div class="m-0">
            <!--begin::Heading-->
            <div class="d-flex align-items-center mb-2">
                <!--begin::Title-->
                <span class="{{ $vars['value_class'] ?? 'fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2' }}">{{ $vars['value'] ?? '35,568' }}</span>
                <!--end::Title-->
                <!--begin::Label-->
                <span class="{{ $vars['badge_class'] ?? 'badge badge-light-danger fs-base' }}">
                    <i class="{{ $vars['trend_icon_class'] ?? 'ki-outline ki-arrow-up fs-5 text-danger ms-n1' }}">
                        @if ($vars['trend_icon_duotone'] ?? false)
                            <span class="path1"></span>
                            <span class="path2"></span>
                        @endif
                    </i>{{ $vars['trend_text'] ?? '8.02%' }}</span>
                <!--end::Label-->
            </div>
            <!--end::Heading-->
            <!--begin::Description-->
            <span class="{{ $vars['description_class'] ?? 'fs-6 fw-semibold text-gray-500' }}">{{ $vars['description'] ?? 'Organic Sessions' }}</span>
            <!--end::Description-->
        </div>
        <!--end::Statistics-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button
                class="{{ $vars['menu_button_class'] ?? 'btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end' }}"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                data-kt-menu-overflow="true">
                <i class="{{ $vars['menu_icon_class'] ?? 'ki-outline ki-dots-square fs-1 text-gray-500 me-n1' }}">
                    @if ($vars['menu_icon_duotone'] ?? false)
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    @endif
                </i>
            </button>
            <!--begin::Menu 2-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator mb-3 opacity-75"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $vars['menu_ticket_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">New Ticket</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $vars['menu_customer_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">New Customer</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                    data-kt-menu-placement="right-start">
                    <!--begin::Menu item-->
                    <a href="{{ $vars['menu_group_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--end::Menu item-->
                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ $vars['menu_admin_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ $vars['menu_staff_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ $vars['menu_member_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu sub-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $vars['menu_contact_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">New Contact</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator mt-3 opacity-75"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content px-3 py-3">
                        <a class="{{ $vars['menu_report_btn_class'] ?? 'btn btn-primary btn-sm px-4' }}"
                            href="{{ $vars['menu_report_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}">Generate
                            Reports</a>
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
    <div class="{{ $vars['body_class'] ?? 'card-body pt-0 pb-1' }}">
        <div id="{{ $vars['chart_id'] ?? 'kt_charts_widget_27' }}" class="{{ $vars['chart_class'] ?? 'min-h-auto' }}"></div>
    </div>
    <!--end::Body-->
</div>
<!--end::Chart widget 27-->
