@php
    $currentIconStyle = getActiveIconStyle();
@endphp
<!--begin::Icon style toggle-->
<div class="{{ $wrapper_class ?? 'app-navbar-item ms-1 ms-md-4' }}" data-kt-feature-tool="tool_icon_style">
    <!--begin::Menu toggle-->
    <a href="javascript:void(0)"
        class="{{ $button_class ?? 'btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px' }}"
        data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end"
        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
        data-kt-translate-title="menu.icon_style"
        title="{{ __('menu.icon_style') }}"
        data-kt-element="icon-style-toggle">
        <!--begin::Icon previews (dynamically toggled via data-kt-icon-style)-->
        <span class="icon-style-preview {{ $currentIconStyle !== 'duotone' ? 'd-none' : '' }}" data-kt-icon-preview-style="duotone">
            <i class="ki-duotone ki-chart fs-2" data-kt-icon-style-ignore="true">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </span>
        <span class="icon-style-preview {{ $currentIconStyle !== 'solid' ? 'd-none' : '' }}" data-kt-icon-preview-style="solid">
            <i class="ki-solid ki-chart fs-2" data-kt-icon-style-ignore="true"></i>
        </span>
        <span class="icon-style-preview {{ $currentIconStyle !== 'outline' ? 'd-none' : '' }}" data-kt-icon-preview-style="outline">
            <i class="ki-outline ki-chart fs-2" data-kt-icon-style-ignore="true"></i>
        </span>
        <!--end::Icon previews-->
    </a>
    <!--end::Menu toggle-->

    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-175px"
        data-kt-menu="true" data-kt-element="icon-style-menu">
        <!--begin::Menu header-->
        <div class="menu-item px-3 mb-1">
            <div class="menu-content text-muted pb-1 px-3 fs-7 text-uppercase fw-bold" data-kt-translate="menu.icon_style">
                {{ __('menu.icon_style') }}
            </div>
        </div>
        <!--end::Menu header-->

        <!--begin::Menu item Duotone-->
        <div class="menu-item px-3 my-0">
            <a href="javascript:void(0)" class="menu-link px-3 py-2 {{ $currentIconStyle === 'duotone' ? 'active' : '' }}" data-kt-element="icon-style-item"
                data-kt-value="duotone">
                <span class="menu-icon" data-kt-element="icon">
                    <i class="ki-duotone ki-chart fs-2" data-kt-icon-style-ignore="true">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
                <span class="menu-title d-flex justify-content-between align-items-center w-100">
                    <span>Duotone</span>
                    <span class="badge badge-light-primary fs-8 px-2 py-1 ms-1">Default</span>
                </span>
            </a>
        </div>
        <!--end::Menu item-->

        <!--begin::Menu item Solid-->
        <div class="menu-item px-3 my-0">
            <a href="javascript:void(0)" class="menu-link px-3 py-2 {{ $currentIconStyle === 'solid' ? 'active' : '' }}" data-kt-element="icon-style-item"
                data-kt-value="solid">
                <span class="menu-icon" data-kt-element="icon">
                    <i class="ki-solid ki-chart fs-2" data-kt-icon-style-ignore="true"></i>
                </span>
                <span class="menu-title">
                    Solid
                </span>
            </a>
        </div>
        <!--end::Menu item-->

        <!--begin::Menu item Outline-->
        <div class="menu-item px-3 my-0">
            <a href="javascript:void(0)" class="menu-link px-3 py-2 {{ $currentIconStyle === 'outline' ? 'active' : '' }}" data-kt-element="icon-style-item"
                data-kt-value="outline">
                <span class="menu-icon" data-kt-element="icon">
                    <i class="ki-outline ki-chart fs-2" data-kt-icon-style-ignore="true"></i>
                </span>
                <span class="menu-title">
                    Outline
                </span>
            </a>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end::Menu-->
</div>
<!--end::Icon style toggle-->
