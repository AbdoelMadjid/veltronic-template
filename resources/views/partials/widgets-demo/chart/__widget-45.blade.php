@php($vars = $vars ?? [])
<!--begin::Chart widget 45-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-xl-100 mb-xl-8' }}">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <h3 class="{{ $vars['title_class'] ?? 'card-title fw-bold text-gray-900' }}">{{ $vars['title'] ?? 'Trends' }}</h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="{{ $vars['menu_button_class'] ?? 'btn btn-sm btn-icon btn-color-primary btn-active-light-primary' }}"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="{{ $vars['menu_icon_class'] ?? 'ki-outline ki-element-plus fs-2' }}"></i>
            </button>
            <!--begin::Menu 3-->
            @include('partials.menus._menu-3', ['vars' => $vars['menu_3_vars'] ?? []])
            <!--end::Menu 3-->
            <!--end::Menu-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body d-flex justify-content-between flex-column pt-0">
        <!--begin::Chart-->
        <div class="m-0" id="{{ $vars['chart_id'] ?? 'kt_charts_widget_45' }}" data-kt-chart-color="{{ $vars['chart_color'] ?? 'dark' }}" style="{{ $vars['chart_style'] ?? 'height: 90px' }}"></div>
        <!--end::Chart-->
        <!--begin::Items-->
        <div class="m-0">
            <!--begin::Item-->
            <div class="d-flex flex-stack mb-9">
                <!--begin::Section-->
                <div class="d-flex align-items-center me-2">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label bg-light">
                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/plurk.svg', $theme_asset_pack ?? null) }}"
                                class="h-50" alt="" />
                        </div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Title-->
                    <div>
                        <a href="javascript:void(0)" class="fs-6 text-gray-800 text-hover-primary fw-bold">Top
                            Authors</a>
                        <div class="fs-7 text-muted fw-semibold mt-1">Successful Fellas</div>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Section-->
                <!--begin::Label-->
                <div class="badge badge-light badge-lg fw-bold p-2 text-gray-600">+82$</div>
                <!--end::Label-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex flex-stack mb-9">
                <!--begin::Section-->
                <div class="d-flex align-items-center me-2">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label bg-light">
                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/telegram-2.svg', $theme_asset_pack ?? null) }}"
                                class="h-50" alt="" />
                        </div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Title-->
                    <div>
                        <a href="javascript:void(0)" class="fs-6 text-gray-800 text-hover-primary fw-bold">Binford
                            Ltd.</a>
                        <div class="fs-7 text-muted fw-semibold mt-1">Most Successful</div>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Section-->
                <!--begin::Label-->
                <div class="badge badge-light badge-lg fw-bold p-2 text-gray-600">+280$</div>
                <!--end::Label-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex flex-stack">
                <!--begin::Section-->
                <div class="d-flex align-items-center me-2">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label bg-light">
                            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/vimeo.svg', $theme_asset_pack ?? null) }}"
                                class="h-50" alt="" />
                        </div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Title-->
                    <div>
                        <a href="javascript:void(0)" class="fs-6 text-gray-800 text-hover-primary fw-bold">Biffco
                            Enterprises</a>
                        <div class="fs-7 text-muted fw-semibold mt-1">Most Successful Fellas
                        </div>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Section-->
                <!--begin::Label-->
                <div class="badge badge-light badge-lg fw-bold p-2 text-gray-600">+4500$</div>
                <!--end::Label-->
            </div>
            <!--end::Item-->
        </div>
        <!--end::Items-->
    </div>
    <!--end::Body-->
</div>
<!--end::Chart widget 45-->
