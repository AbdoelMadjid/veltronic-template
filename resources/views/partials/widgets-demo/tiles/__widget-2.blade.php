@php
    $vars = $vars ?? [];

    $variant = $vars['variant'] ?? ($variant ?? 'default');
    $variantConfig = [
        'default' => [
            'widgetClass' => 'card h-175px bgi-no-repeat bgi-size-contain h-200px mb-5 mb-lg-10',
            'backgroundColor' => '#1B283F',
            'backgroundImage' => 'media/svg/misc/taieri.svg',
            'title' => 'Brilliant Ideas<br />for Your Web Application',
            'linkHref' => 'javascript:void(0)',
        ],
        'a' => [
            'widgetClass' => 'card h-175px bgi-no-repeat bgi-size-contain card-xl-stretch mb-5 mb-xl-8',
            'backgroundColor' => '#663259',
            'backgroundImage' => 'media/svg/misc/taieri.svg',
            'title' => 'Create SaaS<br />Based Reports',
            'linkHref' => '#',
        ],
    ];
    $selectedVariant = $variantConfig[$variant] ?? $variantConfig['default'];

    $widgetClass = $vars['widgetClass'] ?? ($widgetClass ?? $selectedVariant['widgetClass']);
    $backgroundColor = $vars['backgroundColor'] ?? ($backgroundColor ?? $selectedVariant['backgroundColor']);
    $backgroundPosition = $vars['backgroundPosition'] ?? ($backgroundPosition ?? 'right');
    $backgroundImage = $vars['backgroundImage'] ?? ($backgroundImage ?? $selectedVariant['backgroundImage']);
    $title = $vars['title'] ?? ($title ?? $selectedVariant['title']);
    $titleClass = $vars['titleClass'] ?? ($titleClass ?? 'text-white fw-bold mb-5');
    $titleInnerClass = $vars['titleInnerClass'] ?? ($titleInnerClass ?? 'lh-lg');
    $buttonText = $vars['buttonText'] ?? ($buttonText ?? 'Create Campaign');
    $buttonClass = $vars['buttonClass'] ?? ($buttonClass ?? 'btn btn-danger fw-semibold px-6 py-3');
    $linkHref = $vars['linkHref'] ?? ($linkHref ?? $selectedVariant['linkHref']);
    $dataBsToggle = $vars['dataBsToggle'] ?? ($dataBsToggle ?? 'modal');
    $dataBsTarget = $vars['dataBsTarget'] ?? ($dataBsTarget ?? '#kt_modal_create_campaign');
@endphp

<!--begin::Tiles Widget 2-->
<div class="{{ $widgetClass }}"
    style="background-color: {{ $backgroundColor }}; background-position: {{ $backgroundPosition }}; background-image:url('{{ \App\Support\ThemeAsset::url($backgroundImage, $theme_asset_pack ?? null) }}')">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column justify-content-between">
        <!--begin::Title-->
        <h2 class="{{ $titleClass }}">
            <span class="{{ $titleInnerClass }}">{!! $title !!}</span>
        </h2>
        <!--end::Title-->
        <!--begin::Action-->
        <div class="m-0">
            <a href="{{ $linkHref }}" class="{{ $buttonClass }}"
                data-bs-toggle="{{ $dataBsToggle }}" data-bs-target="{{ $dataBsTarget }}">{{ $buttonText }}</a>
        </div>
        <!--begin::Action-->
    </div>
    <!--end::Body-->
</div>
<!--end::Tiles Widget 2-->
