@php($vars = $vars ?? [])
<!--begin::Chart widget 13-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-md-100' }}">
    <!--begin::Header-->
    <div class="{{ $vars['header_class'] ?? 'card-header pt-7' }}">
        <!--begin::Title-->
        <h3 class="{{ $vars['title_wrapper_class'] ?? 'card-title align-items-start flex-column' }}">
            <span class="{{ $vars['title_class'] ?? 'card-label fw-bold text-gray-900' }}">{{ $vars['title'] ?? 'Sales Statistics' }}</span>
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 pt-2 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? 'Top Selling Products' }}</span>
        </h3>
        <!--end::Title-->
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
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-100px py-4"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="javascript:void(0)" class="menu-link px-3">Remove</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="javascript:void(0)" class="menu-link px-3">Mute</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="javascript:void(0)" class="menu-link px-3">Settings</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
            <!--end::Menu-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="{{ $vars['body_class'] ?? 'card-body pt-5' }}">
        <!--begin::Chart container-->
        <div id="{{ $vars['chart_id'] ?? 'kt_charts_widget_13_chart' }}"
            class="{{ $vars['chart_class'] ?? 'w-100 h-325px' }}"></div>
        <!--end::Chart container-->
    </div>
    <!--end::Body-->
</div>
<!--end::Chart widget 13-->
