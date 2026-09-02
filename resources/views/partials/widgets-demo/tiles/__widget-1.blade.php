@php
    $vars = $vars ?? [];

    $variant = $vars['variant'] ?? ($variant ?? 'default');
    $variantConfig = [
        'default' => [
            'widgetClass' => 'card h-150px bgi-no-repeat bgi-size-cover bgi-position-y-center h-150px mb-5 mb-lg-10',
            'backgroundImage' => 'media/stock/600x600/img-12.jpg',
            'title' => 'Roofing',
            'linkHref' => 'javascript:void(0)',
            'dataBsToggle' => 'modal',
            'dataBsTarget' => '#kt_modal_create_app',
        ],
        'a' => [
            'widgetClass' => 'card h-150px bgi-no-repeat bgi-size-cover bgi-position-y-center h-150px',
            'backgroundImage' => 'media/stock/600x600/img-1.jpg',
            'title' => 'Company',
            'linkHref' => 'javascript:void(0)',
            'dataBsToggle' => 'modal',
            'dataBsTarget' => '#kt_modal_create_app',
        ],
        'b' => [
            'widgetClass' => 'card h-150px bgi-no-repeat bgi-size-cover bgi-position-y-center card-xl-stretch border-0',
            'backgroundImage' => 'media/stock/600x600/img-22.jpg',
            'title' => 'Company',
            'linkHref' => '#',
            'dataBsToggle' => 'modal',
            'dataBsTarget' => '#kt_modal_create_app',
        ],
    ];
    $selectedVariant = $variantConfig[$variant] ?? $variantConfig['default'];

    $widgetClass = $vars['widgetClass'] ?? ($widgetClass ?? $selectedVariant['widgetClass']);
    $backgroundImage = $vars['backgroundImage'] ?? ($backgroundImage ?? $selectedVariant['backgroundImage']);
    $title = $vars['title'] ?? ($title ?? $selectedVariant['title']);
    $linkHref = $vars['linkHref'] ?? ($linkHref ?? $selectedVariant['linkHref']);
    $dataBsToggle = $vars['dataBsToggle'] ?? ($dataBsToggle ?? $selectedVariant['dataBsToggle']);
    $dataBsTarget = $vars['dataBsTarget'] ?? ($dataBsTarget ?? $selectedVariant['dataBsTarget']);
@endphp

<!--begin::Tiles Widget 1-->
<div class="{{ $widgetClass }}"
    style="background-image:url('{{ \App\Support\ThemeAsset::url($backgroundImage, $theme_asset_pack ?? null) }}')">
    <!--begin::Body-->
    <div class="card-body p-6">
        <!--begin::Title-->
        <a href="{{ $linkHref }}" class="text-black text-hover-primary fw-bold fs-2"
            data-bs-toggle="{{ $dataBsToggle }}" data-bs-target="{{ $dataBsTarget }}">{{ $title }}</a>
        <!--end::Title-->
    </div>
    <!--end::Body-->
</div>
<!--end::Tiles Widget 1-->
