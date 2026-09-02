@php($vars = $vars ?? [])
<!--begin::Chart widget 3-->
<div class="{{ $vars['card_class'] ?? 'card card-flush overflow-hidden h-md-100' }}">
    <!--begin::Header-->
    <div class="{{ $vars['header_class'] ?? 'card-header py-5' }}">
        <!--begin::Title-->
        <h3 class="{{ $vars['title_wrapper_class'] ?? 'card-title align-items-start flex-column' }}">
            <span class="{{ $vars['title_class'] ?? 'card-label fw-bold text-gray-900' }}">{{ $vars['title'] ?? 'Sales This Months' }}</span>
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 mt-1 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? 'Users from all channels' }}</span>
        </h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button class="{{ $vars['menu_button_class'] ?? 'btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end' }}"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                <i class="{{ $vars['menu_icon_class'] ?? 'ki-outline ki-dots-square fs-1' }}">
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
                        <a class="btn btn-primary btn-sm px-4" href="javascript:void(0)">Generate
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
    <!--begin::Card body-->
    <div class="{{ $vars['body_class'] ?? 'card-body d-flex justify-content-between flex-column pb-1 px-0' }}">
        <!--begin::Statistics-->
        <div class="{{ $vars['stats_wrapper_class'] ?? 'px-9 mb-5' }}">
            <!--begin::Statistics-->
            <div class="{{ $vars['stats_row_class'] ?? 'd-flex mb-2' }}">
                <span class="{{ $vars['currency_class'] ?? 'fs-4 fw-semibold text-gray-500 me-1' }}">{{ $vars['currency'] ?? '$' }}</span>
                <span class="{{ $vars['amount_class'] ?? 'fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2' }}">{{ $vars['amount'] ?? '14,094' }}</span>
            </div>
            <!--end::Statistics-->
            <!--begin::Description-->
            <span class="{{ $vars['description_class'] ?? 'fs-6 fw-semibold text-gray-500' }}">{{ $vars['description'] ?? 'Another $48,346 to Goal' }}</span>
            <!--end::Description-->
        </div>
        <!--end::Statistics-->
        <!--begin::Chart-->
        <div id="{{ $vars['chart_id'] ?? 'kt_charts_widget_3' }}" class="{{ $vars['chart_class'] ?? 'min-h-auto ps-4 pe-6' }}"
            style="{{ $vars['chart_style'] ?? 'height: 300px' }}"></div>
        <!--end::Chart-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Chart widget 3-->
