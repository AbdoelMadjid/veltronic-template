@php
    $vars = $vars ?? [];

    $variant = $vars['variant'] ?? ($variant ?? 'default');
    $variantConfig = [
        'default' => ['widgetClass' => 'card h-md-100', 'chartColor' => 'danger'],
        'a' => ['widgetClass' => 'card card-xl-stretch mb-xl-8', 'chartColor' => 'primary'],
        'b' => ['widgetClass' => 'card card-xl-stretch mb-xl-8', 'chartColor' => 'info'],
        'c' => ['widgetClass' => 'card card-xl-stretch mb-xl-8', 'chartColor' => 'info'],
        'd' => ['widgetClass' => 'card card-xl-stretch mb-xl-3', 'chartColor' => 'success'],
        'e' => ['widgetClass' => 'card card-xxl-stretch mb-xl-3', 'chartColor' => 'success'],
        'f' => ['widgetClass' => 'card card-xl-stretch mb-xl-8', 'chartColor' => 'primary'],
        'g' => ['widgetClass' => 'card h-xl-100', 'chartColor' => 'dark'],
    ];
    $selectedVariant = $variantConfig[$variant] ?? $variantConfig['default'];

    $widgetClass = $vars['widgetClass'] ?? ($widgetClass ?? $selectedVariant['widgetClass']);
    $title = $vars['title'] ?? ($title ?? 'Trends');
    $subtitle = $vars['subtitle'] ?? ($subtitle ?? 'Latest trends');
    $chartColor = $vars['chartColor'] ?? ($chartColor ?? $selectedVariant['chartColor']);
    $chartClass = $vars['chartClass'] ?? ($chartClass ?? 'mixed-widget-5-chart card-rounded-top');
    $chartHeight = $vars['chartHeight'] ?? ($chartHeight ?? '150px');
    $linkHref = $vars['linkHref'] ?? ($linkHref ?? 'javascript:void(0)');

    $items = $vars['items'] ?? ($items ?? [
        [
            'logo' => 'media/svg/brand-logos/plurk.svg',
            'title' => 'Top Authors',
            'subtitle' => 'Ricky Hunt, Sandra Trepp',
            'badge' => '+82$',
            'itemClass' => 'd-flex flex-stack mb-5',
            'titleWrapClass' => '',
        ],
        [
            'logo' => 'media/svg/brand-logos/figma-1.svg',
            'title' => 'Top Sales',
            'subtitle' => 'PitStop Emails',
            'badge' => '+82$',
            'itemClass' => 'd-flex flex-stack mb-5',
            'titleWrapClass' => '',
        ],
        [
            'logo' => 'media/svg/brand-logos/vimeo.svg',
            'title' => 'Top Engagement',
            'subtitle' => 'KT.com',
            'badge' => '+82$',
            'itemClass' => 'd-flex flex-stack',
            'titleWrapClass' => 'py-1',
        ],
    ]);
@endphp

<!--begin::Mixed Widget 5-->
<div class="{{ $widgetClass }}">
    <!--begin::Beader-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">{{ $title }}</span>
            <span class="text-muted fw-semibold fs-7">{{ $subtitle }}</span>
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
            <!--begin::Menu 3-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                data-kt-menu="true">
                <!--begin::Heading-->
                <div class="menu-item px-3">
                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
                </div>
                <!--end::Heading-->
                <div class="menu-item px-3">
                    <a href="{{ $linkHref }}" class="menu-link px-3">Create Invoice</a>
                </div>
                <div class="menu-item px-3">
                    <a href="{{ $linkHref }}" class="menu-link flex-stack px-3">Create Payment
                        <span class="ms-2" data-bs-toggle="tooltip"
                            title="Specify a target name for future usage and reference">
                            <i class="ki-duotone ki-information fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span></a>
                </div>
                <div class="menu-item px-3">
                    <a href="{{ $linkHref }}" class="menu-link px-3">Generate Bill</a>
                </div>
                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                    data-kt-menu-placement="right-end">
                    <a href="{{ $linkHref }}" class="menu-link px-3">
                        <span class="menu-title">Subscription</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <div class="menu-item px-3">
                            <a href="{{ $linkHref }}" class="menu-link px-3">Plans</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ $linkHref }}" class="menu-link px-3">Billing</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ $linkHref }}" class="menu-link px-3">Statements</a>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-3">
                            <div class="menu-content px-3">
                                <label
                                    class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input w-30px h-20px" type="checkbox"
                                        value="1" checked="checked" name="notifications" />
                                    <span class="form-check-label text-muted fs-6">Recuring</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-item px-3 my-1">
                    <a href="{{ $linkHref }}" class="menu-link px-3">Settings</a>
                </div>
            </div>
            <!--end::Menu 3-->
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body d-flex flex-column">
        <!--begin::Chart-->
        <div class="{{ $chartClass }}" data-kt-chart-color="{{ $chartColor }}"
            style="height: {{ $chartHeight }}"></div>
        <!--end::Chart-->
        <!--begin::Items-->
        <div class="mt-5">
            @foreach ($items as $item)
                <div class="{{ $item['itemClass'] ?? 'd-flex flex-stack mb-5' }}">
                    <div class="d-flex align-items-center me-2">
                        <div class="symbol symbol-50px me-3">
                            <div class="symbol-label bg-light">
                                <img src="{{ \App\Support\ThemeAsset::url($item['logo'], $theme_asset_pack ?? null) }}"
                                    class="h-50" alt="" />
                            </div>
                        </div>
                        <div class="{{ $item['titleWrapClass'] ?? '' }}">
                            <a href="{{ $item['href'] ?? $linkHref }}"
                                class="fs-6 text-gray-800 text-hover-primary fw-bold">{{ $item['title'] ?? '' }}</a>
                            <div class="fs-7 text-muted fw-semibold mt-1">{{ $item['subtitle'] ?? '' }}</div>
                        </div>
                    </div>
                    <div class="badge badge-light fw-semibold py-4 px-3">{{ $item['badge'] ?? '' }}</div>
                </div>
            @endforeach
        </div>
        <!--end::Items-->
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 5-->
