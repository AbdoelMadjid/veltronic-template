@php
    $vars = $vars ?? [];

    $variant = $vars['variant'] ?? ($variant ?? 'default');
    $variantConfig = [
        'default' => [
            'widgetClass' => 'card h-md-100',
            'menuVariant' => 'simple',
            'menuId' => 'kt_menu_mixed_widget_19',
            'linkHref' => 'javascript:void(0)',
        ],
        'a' => [
            'widgetClass' => 'card card-xl-stretch mb-xl-8',
            'menuVariant' => 'filter',
            'menuId' => 'kt_menu_mixed_widget_19a',
            'linkHref' => 'javascript:void(0)',
        ],
    ];
    $selectedVariant = $variantConfig[$variant] ?? $variantConfig['default'];

    $widgetClass = $vars['widgetClass'] ?? ($widgetClass ?? $selectedVariant['widgetClass']);
    $title = $vars['title'] ?? ($title ?? 'Weekly Sales Stats');
    $subtitle = $vars['subtitle'] ?? ($subtitle ?? '890,344 Sales');
    $menuVariant = $vars['menuVariant'] ?? ($menuVariant ?? $selectedVariant['menuVariant']);
    $menuId = $vars['menuId'] ?? ($menuId ?? $selectedVariant['menuId']);
    $linkHref = $vars['linkHref'] ?? ($linkHref ?? $selectedVariant['linkHref']);
    $chartId = $vars['chartId'] ?? ($chartId ?? 'kt_charts_mixed_widget_19_chart');
    $chartClass = $vars['chartClass'] ?? ($chartClass ?? 'card-rounded-bottom');
    $chartHeight = $vars['chartHeight'] ?? ($chartHeight ?? '150px');

    $items = $vars['items'] ?? ($items ?? [
        [
            'logo' => 'media/svg/brand-logos/plurk.svg',
            'title' => 'Top Authors',
            'subtitle' => 'Mark, Rowling, Esther',
            'badge' => '+82$',
            'itemClass' => 'd-flex align-items-sm-center mb-7',
        ],
        [
            'logo' => 'media/svg/brand-logos/telegram.svg',
            'title' => 'Popular Authors',
            'subtitle' => 'Randy, Steve, Mike',
            'badge' => '+280$',
            'itemClass' => 'd-flex align-items-sm-center mb-7',
        ],
        [
            'logo' => 'media/svg/brand-logos/vimeo.svg',
            'title' => 'New Users',
            'subtitle' => 'John, Pat, Jimmy',
            'badge' => '+4500$',
            'itemClass' => 'd-flex align-items-sm-center',
        ],
    ]);
@endphp

<!--begin::Mixed Widget 19-->
<div class="{{ $widgetClass }}">
    <!--begin::Beader-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">{{ $title }}</span>
            <span class="text-muted fw-semibold fs-7">{{ $subtitle }}</span>
        </h3>
        <div class="card-toolbar">
            @if ($menuVariant === 'filter')
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
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                    data-kt-menu="true" id="{{ $menuId }}">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5">
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Status:</label>
                            <div>
                                <select class="form-select form-select-solid" multiple="multiple"
                                    data-kt-select2="true" data-close-on-select="false"
                                    data-placeholder="Select option"
                                    data-dropdown-parent="#{{ $menuId }}"
                                    data-allow-clear="true">
                                    <option></option>
                                    <option value="1">Approved</option>
                                    <option value="2">Pending</option>
                                    <option value="3">In Process</option>
                                    <option value="4">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Member Type:</label>
                            <div class="d-flex">
                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                    <span class="form-check-label">Author</span>
                                </label>
                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                    <span class="form-check-label">Customer</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Notifications:</label>
                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value=""
                                    name="notifications" checked="checked" />
                                <label class="form-check-label">Enabled</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset"
                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                data-kt-menu-dismiss="true">Reset</button>
                            <button type="submit" class="btn btn-sm btn-primary"
                                data-kt-menu-dismiss="true">Apply</button>
                        </div>
                    </div>
                </div>
            @else
                @include('partials.general._button-1')
                @include('partials.menus._menu-1')
            @endif
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body p-0 d-flex flex-column">
        <div class="card-px pt-5 pb-10 flex-grow-1">
            @foreach ($items as $item)
                <div class="{{ $item['itemClass'] ?? 'd-flex align-items-sm-center mb-7' }}">
                    <div class="symbol symbol-50px me-5">
                        <span class="symbol-label">
                            <img src="{{ \App\Support\ThemeAsset::url($item['logo'], $theme_asset_pack ?? null) }}"
                                class="h-50 align-self-center" alt="" />
                        </span>
                    </div>
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="{{ $item['href'] ?? $linkHref }}"
                                class="text-gray-800 text-hover-primary fs-6 fw-bold">{{ $item['title'] ?? '' }}</a>
                            <span class="text-muted fw-semibold d-block fs-7">{{ $item['subtitle'] ?? '' }}</span>
                        </div>
                        <span class="badge badge-light fw-bold my-2">{{ $item['badge'] ?? '' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="{{ $chartId }}" class="{{ $chartClass }}" style="height: {{ $chartHeight }}"></div>
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 19-->
