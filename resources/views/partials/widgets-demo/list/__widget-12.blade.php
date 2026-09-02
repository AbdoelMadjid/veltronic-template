<!--begin::List widget 12-->
@php
    $vars = $vars ?? [];

    $widgetClass = $vars['widget_class'] ?? ($widgetClass ?? 'card card-flush h-xl-100');
    $linkHref = $vars['link_href'] ?? ($linkHref ?? 'javascript:void(0)');
    $iconStyle = $vars['icon_style'] ?? 'outline';
    $icon_style_prefix = $vars['icon_style_prefix'] ?? ($iconStyle === 'duotone' ? 'ki-duotone' : 'ki-outline');
    $showRisingItem = $vars['show_rising_item'] ?? true;
    $showFooterLink = $vars['show_footer_link'] ?? false;
    $footerHref = $vars['footer_href'] ?? url('apps/ecommerce/sales/details');
    $footerText = $vars['footer_text'] ?? 'View Store Analytics';
@endphp

<div class="{{ $widgetClass }}">
    <!--begin::Header-->
    <div class="card-header pt-7">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-800">Visits by Source</span>
            <span class="text-gray-500 mt-1 fw-semibold fs-6">29.4k visitors</span>
        </h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button
                class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                data-kt-menu-overflow="true">
                <i class="{{ $icon_style_prefix }} ki-dots-square fs-1 text-gray-500 me-n1"></i>
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
                    <a href="{{ $linkHref }}" class="menu-link px-3">New Ticket</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $linkHref }}" class="menu-link px-3">New Customer</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                    data-kt-menu-placement="right-start">
                    <!--begin::Menu item-->
                    <a href="{{ $linkHref }}" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--end::Menu item-->
                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ $linkHref }}" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ $linkHref }}" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ $linkHref }}" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu sub-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $linkHref }}" class="menu-link px-3">New Contact</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator mt-3 opacity-75"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary btn-sm px-4" href="{{ $linkHref }}">Generate
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
    <div class="card-body d-flex align-items-end">
        <!--begin::Wrapper-->
        <div class="w-100">
            <!--begin::Item-->
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                    <span class="symbol-label">
                        <i class="{{ $icon_style_prefix }} ki-rocket fs-3 text-gray-600"></i>
                    </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Container-->
                <div
                    class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Direct
                            Source</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Direct
                            link clicks</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center">
                        <!--begin::Number-->
                        <span class="text-gray-800 fw-bold fs-4 me-3">1,067</span>
                        <!--end::Number-->
                        <!--begin::Info-->
                        <!--begin::label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="{{ $icon_style_prefix }} ki-arrow-up fs-5 text-success ms-n1"></i>2.6%</span>
                        <!--end::label-->
                        <!--end::Info-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Item-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-3"></div>
            <!--end::Separator-->
            <!--begin::Item-->
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                    <span class="symbol-label">
                        <i class="{{ $icon_style_prefix }} ki-tiktok fs-3 text-gray-600"></i>
                    </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Container-->
                <div
                    class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Social
                            Networks</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">All Social
                            Channels</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center">
                        <!--begin::Number-->
                        <span class="text-gray-800 fw-bold fs-4 me-3">24,588</span>
                        <!--end::Number-->
                        <!--begin::Info-->
                        <!--begin::label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="{{ $icon_style_prefix }} ki-arrow-up fs-5 text-success ms-n1"></i>4.1%</span>
                        <!--end::label-->
                        <!--end::Info-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Item-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-3"></div>
            <!--end::Separator-->
            <!--begin::Item-->
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                    <span class="symbol-label">
                        <i class="{{ $icon_style_prefix }} ki-sms fs-3 text-gray-600"></i>
                    </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Container-->
                <div
                    class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Email
                            Newsletter</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Mailchimp
                            Campaigns</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center">
                        <!--begin::Number-->
                        <span class="text-gray-800 fw-bold fs-4 me-3">794</span>
                        <!--end::Number-->
                        <!--begin::Info-->
                        <!--begin::label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="{{ $icon_style_prefix }} ki-arrow-up fs-5 text-success ms-n1"></i>0.2%</span>
                        <!--end::label-->
                        <!--end::Info-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Item-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-3"></div>
            <!--end::Separator-->
            <!--begin::Item-->
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                    <span class="symbol-label">
                        <i class="{{ $icon_style_prefix }} ki-icon fs-3 text-gray-600"></i>
                    </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Container-->
                <div
                    class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Referrals</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Impact
                            Radius visits</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center">
                        <!--begin::Number-->
                        <span class="text-gray-800 fw-bold fs-4 me-3">6,578</span>
                        <!--end::Number-->
                        <!--begin::Info-->
                        <!--begin::label-->
                        <span class="badge badge-light-danger fs-base">
                            <i class="{{ $icon_style_prefix }} ki-arrow-down fs-5 text-danger ms-n1"></i>0.4%</span>
                        <!--end::label-->
                        <!--end::Info-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Item-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-3"></div>
            <!--end::Separator-->
            <!--begin::Item-->
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                    <span class="symbol-label">
                        <i class="{{ $icon_style_prefix }} ki-abstract-25 fs-3 text-gray-600"></i>
                    </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Container-->
                <div
                    class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Other</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Many
                            Sources</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center">
                        <!--begin::Number-->
                        <span class="text-gray-800 fw-bold fs-4 me-3">79,458</span>
                        <!--end::Number-->
                        <!--begin::Info-->
                        <!--begin::label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="{{ $icon_style_prefix }} ki-arrow-up fs-5 text-success ms-n1"></i>8.3%</span>
                        <!--end::label-->
                        <!--end::Info-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Item-->
            @if ($showRisingItem)
                <!--begin::Separator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Separator-->
                <!--begin::Item-->
                <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <div class="symbol symbol-30px me-5">
                    <span class="symbol-label">
                        <i class="{{ $icon_style_prefix }} ki-abstract-39 fs-3 text-gray-600"></i>
                    </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Container-->
                <div
                    class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
                    <!--begin::Content-->
                    <div class="me-5">
                        <!--begin::Title-->
                        <a href="{{ $linkHref }}"
                            class="text-gray-800 fw-bold text-hover-primary fs-6">Rising
                            Networks</a>
                        <!--end::Title-->
                        <!--begin::Desc-->
                        <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Social
                            Network</span>
                        <!--end::Desc-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center">
                        <!--begin::Number-->
                        <span class="text-gray-800 fw-bold fs-4 me-3">18,047</span>
                        <!--end::Number-->
                        <!--begin::Info-->
                        <!--begin::label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="{{ $icon_style_prefix }} ki-arrow-up fs-5 text-success ms-n1"></i>1.9%</span>
                        <!--end::label-->
                        <!--end::Info-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
                </div>
                <!--end::Item-->
            @endif
            @if ($showFooterLink)
                <!--begin::Link-->
                <div class="text-center pt-8 d-1">
                    <a href="{{ $footerHref }}" class="text-primary opacity-75-hover fs-6 fw-bold">
                        {{ $footerText }}
                        <i class="{{ $icon_style_prefix }} ki-arrow-right fs-3 text-primary"></i>
                    </a>
                </div>
                <!--end::Link-->
            @endif
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Body-->
</div>
<!--end::List widget 12-->
