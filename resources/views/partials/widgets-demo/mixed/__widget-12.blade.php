@php
    $vars = $vars ?? [];

    $variant = $vars['variant'] ?? ($variant ?? 'default');
    $variantConfig = [
        'default' => [
            'widgetClass' => 'card card-xl-stretch mb-xl-8',
            'headerBgClass' => 'bg-primary',
            'chartBgClass' => 'bg-primary',
            'chartColor' => 'primary',
            'chartHeight' => '175px',
            'linkHref' => 'javascript:void(0)',
        ],
        'a' => [
            'widgetClass' => 'card mb-5 mb-lg-10',
            'headerBgClass' => 'bg-success',
            'chartBgClass' => 'bg-success',
            'chartColor' => 'success',
            'chartHeight' => '250px',
            'linkHref' => 'javascript:void(0)',
        ],
        'b' => [
            'widgetClass' => 'card card-xl-stretch mb-xl-8',
            'headerBgClass' => 'bg-danger',
            'chartBgClass' => 'bg-danger',
            'chartColor' => 'danger',
            'chartHeight' => '200px',
            'linkHref' => 'javascript:void(0)',
        ],
        'c' => [
            'widgetClass' => 'card card-xl-stretch mb-xl-8',
            'headerBgClass' => 'bg-danger',
            'chartBgClass' => 'bg-danger',
            'chartColor' => 'danger',
            'chartHeight' => '200px',
            'linkHref' => 'javascript:void(0)',
        ],
        'd' => [
            'widgetClass' => 'card card-xl-stretch mb-0 mb-xxl-8',
            'headerBgClass' => 'bg-primary',
            'chartBgClass' => 'bg-primary',
            'chartColor' => 'primary',
            'chartHeight' => '250px',
            'linkHref' => '#',
        ],
    ];
    $selectedVariant = $variantConfig[$variant] ?? $variantConfig['default'];

    $widgetClass = $vars['widgetClass'] ?? ($widgetClass ?? $selectedVariant['widgetClass']);
    $title = $vars['title'] ?? ($title ?? 'Sales Progress');
    $headerBgClass = $vars['headerBgClass'] ?? ($headerBgClass ?? $selectedVariant['headerBgClass']);
    $chartBgClass = $vars['chartBgClass'] ?? ($chartBgClass ?? $selectedVariant['chartBgClass']);
    $chartColor = $vars['chartColor'] ?? ($chartColor ?? $selectedVariant['chartColor']);
    $chartHeight = $vars['chartHeight'] ?? ($chartHeight ?? $selectedVariant['chartHeight']);
    $linkHref = $vars['linkHref'] ?? ($linkHref ?? $selectedVariant['linkHref']);

    $stats = $vars['stats'] ?? ($stats ?? [
        ['label' => 'Avarage Sale', 'value' => '$650'],
        ['label' => 'Comissions', 'value' => '$29,500'],
        ['label' => 'Revenue', 'value' => '$55,000'],
        ['label' => 'Expenses', 'value' => '$1,130,600'],
    ]);
@endphp

<!--begin::Mixed Widget 12-->
<div class="{{ $widgetClass }}">
    <!--begin::Header-->
    <div class="card-header border-0 {{ $headerBgClass }} py-5">
        <h3 class="card-title fw-bold text-white">{{ $title }}</h3>
        <div class="card-toolbar">
            <button type="button"
                class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color- border-0 me-n3"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-category fs-6">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            </button>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                data-kt-menu="true">
                <div class="menu-item px-3">
                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
                </div>
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
                        <div class="menu-item px-3"><a href="{{ $linkHref }}" class="menu-link px-3">Plans</a></div>
                        <div class="menu-item px-3"><a href="{{ $linkHref }}" class="menu-link px-3">Billing</a></div>
                        <div class="menu-item px-3"><a href="{{ $linkHref }}" class="menu-link px-3">Statements</a></div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-3">
                            <div class="menu-content px-3">
                                <label class="form-check form-switch form-check-custom form-check-solid">
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
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body p-0">
        <div class="mixed-widget-12-chart card-rounded-bottom {{ $chartBgClass }}"
            data-kt-color="{{ $chartColor }}" style="height: {{ $chartHeight }}"></div>
        <div class="card-rounded bg-body mt-n10 position-relative card-px py-15">
            <div class="row g-0 mb-7">
                @foreach (array_slice($stats, 0, 2) as $stat)
                    <div class="col mx-5">
                        <div class="fs-6 text-gray-500">{{ $stat['label'] ?? '' }}</div>
                        <div class="fs-2 fw-bold text-gray-800">{{ $stat['value'] ?? '' }}</div>
                    </div>
                @endforeach
            </div>
            <div class="row g-0">
                @foreach (array_slice($stats, 2, 2) as $stat)
                    <div class="col mx-5">
                        <div class="fs-6 text-gray-500">{{ $stat['label'] ?? '' }}</div>
                        <div class="fs-2 fw-bold text-gray-800">{{ $stat['value'] ?? '' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 12-->
