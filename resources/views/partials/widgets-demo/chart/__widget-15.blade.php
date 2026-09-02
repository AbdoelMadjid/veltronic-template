@php($vars = $vars ?? [])
<!--begin::Chart widget 15-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-xl-100' }}">
    <!--begin::Header-->
    <div class="card-header pt-7">
        <!--begin::Title-->
        <h3 class="{{ $vars['title_wrapper_class'] ?? 'card-title align-items-start flex-column' }}">
            <span class="{{ $vars['title_class'] ?? 'card-label fw-bold text-gray-900' }}">{{ $vars['title'] ?? 'Author Sales' }}</span>
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 pt-2 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? 'Statistics by Countries' }}</span>
        </h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            @if (($vars['toolbar_mode'] ?? 'pdf') === 'menu')
                <!--begin::Menu-->
                <button class="{{ $vars['menu_button_class'] ?? 'btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end' }}"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                    data-kt-menu-overflow="true">
                    <i class="{{ $vars['menu_icon_class'] ?? 'ki-outline ki-dots-square fs-1 text-gray-500 me-n1' }}"></i>
                </button>
            @else
                <div class="card-toolbar">
                    <a href="{{ $vars['pdf_href'] ?? 'javascript:void(0)' }}"
                        class="{{ $vars['pdf_button_class'] ?? 'btn btn-sm btn-light' }}">{{ $vars['pdf_label'] ?? 'PDF Report' }}</a>
                </div>
            @endif
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-100px py-4"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $vars['menu_remove_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}"
                        class="menu-link px-3">Remove</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $vars['menu_mute_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}"
                        class="menu-link px-3">Mute</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $vars['menu_settings_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}"
                        class="menu-link px-3">Settings</a>
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
        <div id="{{ $vars['chart_id'] ?? 'kt_charts_widget_15_chart' }}"
            class="{{ $vars['chart_class'] ?? 'min-h-auto ps-4 pe-6 mb-3 h-300px' }}"></div>
        <!--end::Chart container-->
    </div>
    <!--end::Body-->
</div>
<!--end::Chart widget 15-->
