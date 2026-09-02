@php
    $vars = $vars ?? [];

    $variant = $vars['variant'] ?? ($variant ?? 'default');
    $variantConfig = [
        'default' => [
            'widgetClass' => 'card h-md-100',
            'menuIconVariant' => 'outline',
        ],
        'a' => [
            'widgetClass' => 'card draggable-handle h-md-100',
            'menuIconVariant' => 'outline',
        ],
        'c' => [
            'widgetClass' => 'card h-md-100',
            'menuIconVariant' => 'duotone',
        ],
        'd' => [
            'widgetClass' => 'card h-md-100',
            'menuIconVariant' => 'duotone',
        ],
        'e' => [
            'widgetClass' => 'card h-md-100',
            'menuIconVariant' => 'duotone',
        ],
    ];
    $selectedVariant = $variantConfig[$variant] ?? $variantConfig['default'];

    $widgetClass = $vars['widgetClass'] ?? ($widgetClass ?? $selectedVariant['widgetClass']);
    $title = $vars['title'] ?? ($title ?? 'Recent Orders');
    $menuIconVariant = $vars['menuIconVariant'] ?? ($menuIconVariant ?? $selectedVariant['menuIconVariant']);
    $menuHref = $vars['menuHref'] ?? ($menuHref ?? 'javascript:void(0)');
    $productHref = $vars['productHref'] ?? ($productHref ?? url('apps/ecommerce/catalog/edit-product'));
    $tabIdPrefix = $vars['tabIdPrefix'] ?? ($tabIdPrefix ?? 'kt_stats_widget_2_tab');

    $tabs = $vars['tabs'] ?? ($tabs ?? [
        [
            'id' => '1',
            'label' => 'T-shirt',
            'icon' => 'media/svg/products-categories/t-shirt.svg',
            'textClass' => 'text-gray-700',
            'active' => true,
            'rows' => [
                ['image' => 'media/stock/ecommerce/210.png', 'name' => 'Elephant 1802', 'item' => '#XDG-2347', 'qty' => 'x1', 'price' => '$72.00', 'total' => '$126.00'],
                ['image' => 'media/stock/ecommerce/215.png', 'name' => 'Red Laga', 'item' => '#XDG-1321', 'qty' => 'x2', 'price' => '$45.00', 'total' => '$76.00'],
                ['image' => 'media/stock/ecommerce/209.png', 'name' => 'RiseUP', 'item' => '#XDG-4312', 'qty' => 'x3', 'price' => '$84.00', 'total' => '$168.00'],
            ],
        ],
        [
            'id' => '2',
            'label' => 'Gaming',
            'icon' => 'media/svg/products-categories/gaming.svg',
            'textClass' => 'text-gray-700',
            'rows' => [
                ['image' => 'media/stock/ecommerce/197.png', 'name' => 'Elephant 1802', 'item' => '#XDG-4312', 'qty' => 'x1', 'price' => '$32.00', 'total' => '$312.00'],
                ['image' => 'media/stock/ecommerce/178.png', 'name' => 'Red Laga', 'item' => '#XDG-3122', 'qty' => 'x2', 'price' => '$53.00', 'total' => '$62.00'],
                ['image' => 'media/stock/ecommerce/22.png', 'name' => 'RiseUP', 'item' => '#XDG-1142', 'qty' => 'x3', 'price' => '$74.00', 'total' => '$139.00'],
            ],
        ],
        [
            'id' => '3',
            'label' => 'Watch',
            'icon' => 'media/svg/products-categories/watch.svg',
            'textClass' => 'text-gray-600',
            'rows' => [
                ['image' => 'media/stock/ecommerce/1.png', 'name' => 'Elephant 1324', 'item' => '#XDG-1523', 'qty' => 'x1', 'price' => '$43.00', 'total' => '$231.00'],
                ['image' => 'media/stock/ecommerce/24.png', 'name' => 'Red Laga', 'item' => '#XDG-5314', 'qty' => 'x2', 'price' => '$71.00', 'total' => '$53.00'],
                ['image' => 'media/stock/ecommerce/71.png', 'name' => 'RiseUP', 'item' => '#XDG-4222', 'qty' => 'x3', 'price' => '$23.00', 'total' => '$213.00'],
            ],
        ],
        [
            'id' => '4',
            'label' => 'Gloves',
            'icon' => 'media/svg/products-categories/gloves.svg',
            'iconClass' => 'nav-icon',
            'textClass' => 'text-gray-600',
            'rows' => [
                ['image' => 'media/stock/ecommerce/41.png', 'name' => 'Elephant 2635', 'item' => '#XDG-1523', 'qty' => 'x1', 'price' => '$65.00', 'total' => '$163.00'],
                ['image' => 'media/stock/ecommerce/63.png', 'name' => 'Red Laga', 'item' => '#XDG-2745', 'qty' => 'x2', 'price' => '$64.00', 'total' => '$73.00'],
                ['image' => 'media/stock/ecommerce/59.png', 'name' => 'RiseUP', 'item' => '#XDG-5173', 'qty' => 'x3', 'price' => '$54.00', 'total' => '$173.00'],
            ],
        ],
        [
            'id' => '5',
            'label' => 'Shoes',
            'icon' => 'media/svg/products-categories/shoes.svg',
            'iconClass' => 'nav-icon',
            'textClass' => 'text-gray-600',
            'rows' => [
                ['image' => 'media/stock/ecommerce/10.png', 'name' => 'Nike', 'item' => '#XDG-2163', 'qty' => 'x1', 'price' => '$64.00', 'total' => '$287.00'],
                ['image' => 'media/stock/ecommerce/96.png', 'name' => 'Adidas', 'item' => '#XDG-2162', 'qty' => 'x2', 'price' => '$76.00', 'total' => '$51.00'],
                ['image' => 'media/stock/ecommerce/13.png', 'name' => 'Puma', 'item' => '#XDG-1537', 'qty' => 'x3', 'price' => '$27.00', 'total' => '$167.00'],
            ],
        ],
    ]);
@endphp

<!--begin::Table widget 2-->
<div class="{{ $widgetClass }}">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0">
        <h3 class="fw-bold text-gray-900 m-0">{{ $title }}</h3>
        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
            data-kt-menu-overflow="true">
            @if ($menuIconVariant === 'duotone')
                <i class="ki-duotone ki-dots-square fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            @else
                <i class="ki-outline ki-dots-square fs-1"></i>
            @endif
        </button>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
            data-kt-menu="true">
            <div class="menu-item px-3">
                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
            </div>
            <div class="separator mb-3 opacity-75"></div>
            <div class="menu-item px-3">
                <a href="{{ $menuHref }}" class="menu-link px-3">New Ticket</a>
            </div>
            <div class="menu-item px-3">
                <a href="{{ $menuHref }}" class="menu-link px-3">New Customer</a>
            </div>
            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                <a href="{{ $menuHref }}" class="menu-link px-3">
                    <span class="menu-title">New Group</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                    <div class="menu-item px-3"><a href="{{ $menuHref }}" class="menu-link px-3">Admin Group</a></div>
                    <div class="menu-item px-3"><a href="{{ $menuHref }}" class="menu-link px-3">Staff Group</a></div>
                    <div class="menu-item px-3"><a href="{{ $menuHref }}" class="menu-link px-3">Member Group</a></div>
                </div>
            </div>
            <div class="menu-item px-3">
                <a href="{{ $menuHref }}" class="menu-link px-3">New Contact</a>
            </div>
            <div class="separator mt-3 opacity-75"></div>
            <div class="menu-item px-3">
                <div class="menu-content px-3 py-3">
                    <a class="btn btn-primary btn-sm px-4" href="{{ $menuHref }}">Generate Reports</a>
                </div>
            </div>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-2">
        <ul class="nav nav-pills nav-pills-custom mb-3">
            @foreach ($tabs as $tab)
                @php
                    $isActive = (bool) ($tab['active'] ?? $loop->first);
                    $tabPaneId = ($tab['paneId'] ?? ($tabIdPrefix . '_' . ($tab['id'] ?? ($loop->index + 1))));
                @endphp
                <li class="nav-item mb-3{{ !$loop->last ? ' me-3 me-lg-6' : '' }}">
                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden{{ $isActive ? ' active' : '' }} w-80px h-85px py-4"
                        data-bs-toggle="pill" href="#{{ $tabPaneId }}">
                        <div class="nav-icon">
                            <img alt="" src="{{ \App\Support\ThemeAsset::url($tab['icon'], $theme_asset_pack ?? null) }}"
                                class="{{ $tab['iconClass'] ?? '' }}" />
                        </div>
                        <span class="nav-text {{ $tab['textClass'] ?? 'text-gray-700' }} fw-bold fs-6 lh-1">{{ $tab['label'] ?? '' }}</span>
                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach ($tabs as $tab)
                @php
                    $isActive = (bool) ($tab['active'] ?? $loop->first);
                    $tabPaneId = ($tab['paneId'] ?? ($tabIdPrefix . '_' . ($tab['id'] ?? ($loop->index + 1))));
                @endphp
                <div class="tab-pane fade{{ $isActive ? ' show active' : '' }}" id="{{ $tabPaneId }}">
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                    <th class="ps-0 w-50px">ITEM</th>
                                    <th class="min-w-125px"></th>
                                    <th class="text-end min-w-100px">QTY</th>
                                    <th class="pe-0 text-end min-w-100px">PRICE</th>
                                    <th class="pe-0 text-end min-w-100px">TOTAL PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (($tab['rows'] ?? []) as $row)
                                    <tr>
                                        <td>
                                            <img src="{{ \App\Support\ThemeAsset::url($row['image'], $theme_asset_pack ?? null) }}"
                                                class="w-50px ms-n1" alt="" />
                                        </td>
                                        <td class="ps-0">
                                            <a href="{{ $row['href'] ?? $productHref }}"
                                                class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">{{ $row['name'] ?? '' }}</a>
                                            <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                {{ $row['item'] ?? '' }}</span>
                                        </td>
                                        <td><span class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">{{ $row['qty'] ?? '' }}</span></td>
                                        <td class="text-end pe-0"><span class="text-gray-800 fw-bold d-block fs-6">{{ $row['price'] ?? '' }}</span></td>
                                        <td class="text-end pe-0"><span class="text-gray-800 fw-bold d-block fs-6">{{ $row['total'] ?? '' }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--end: Card Body-->
</div>
<!--end::Table widget 2-->
