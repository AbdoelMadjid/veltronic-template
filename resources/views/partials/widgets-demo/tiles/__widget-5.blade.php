@php
    $vars = $vars ?? [];

    $variant = $vars['variant'] ?? ($variant ?? 'default');
    $variantConfig = [
        'default' => [
            'href' => 'javascript:void(0)',
            'cardClass' => 'card bg-body h-150px',
            'iconName' => 'ki-element-11',
            'iconClass' => 'text-gray-900 fs-2hx ms-n1 flex-grow-1',
            'iconPathCount' => 4,
            'valueClass' => 'text-gray-900 fw-bold fs-1 mb-0 mt-5',
            'labelClass' => 'text-muted fw-semibold fs-6',
            'value' => '8,600',
            'label' => 'New Customers',
        ],
        'a' => [
            'href' => 'javascript:void(0)',
            'cardClass' => 'card bg-danger h-150px',
            'iconName' => 'ki-element-11',
            'iconClass' => 'text-white fs-2hx ms-n1 flex-grow-1',
            'iconPathCount' => 4,
            'valueClass' => 'text-white fw-bold fs-1 mb-0 mt-5',
            'labelClass' => 'text-white fw-semibold fs-6',
            'value' => '3,900',
            'label' => 'Author Sales',
        ],
        'b' => [
            'href' => 'javascript:void(0)',
            'cardClass' => 'card bg-primary h-150px',
            'iconName' => 'ki-chart-pie-simple',
            'iconClass' => 'text-white fs-2hx ms-n1 flex-grow-1',
            'iconPathCount' => 2,
            'valueClass' => 'text-white fw-bold fs-1 mb-0 mt-5',
            'labelClass' => 'text-white fw-semibold fs-6',
            'value' => '75%',
            'label' => 'Success Rate',
        ],
        'c' => [
            'href' => '#',
            'cardClass' => 'card card-xxl-stretch bg-primary',
            'iconName' => 'ki-element-11',
            'iconClass' => 'text-white fs-2hx ms-n1 flex-grow-1',
            'iconPathCount' => 4,
            'valueClass' => 'text-white fw-bold fs-1 mb-0 mt-5',
            'labelClass' => 'text-white fw-semibold fs-6',
            'value' => '790',
            'label' => 'New Products',
        ],
        'd' => [
            'href' => '#',
            'cardClass' => 'card card-xxl-stretch bg-body',
            'iconName' => 'ki-rocket',
            'iconClass' => 'text-success fs-2hx ms-n1 flex-grow-1',
            'iconPathCount' => 2,
            'valueClass' => 'text-gray-900 fw-bold fs-1 mb-0 mt-5',
            'labelClass' => 'text-muted fw-semibold fs-6',
            'value' => '8,600',
            'label' => 'New Customers',
        ],
    ];
    $selectedVariant = $variantConfig[$variant] ?? $variantConfig['default'];

    $href = $vars['href'] ?? ($href ?? $selectedVariant['href']);
    $cardClass = $vars['cardClass'] ?? ($cardClass ?? $selectedVariant['cardClass']);
    $iconName = $vars['iconName'] ?? ($iconName ?? $selectedVariant['iconName']);
    $iconClass = $vars['iconClass'] ?? ($iconClass ?? $selectedVariant['iconClass']);
    $iconPathCount = (int) ($vars['iconPathCount'] ?? ($iconPathCount ?? $selectedVariant['iconPathCount']));
    $valueClass = $vars['valueClass'] ?? ($valueClass ?? $selectedVariant['valueClass']);
    $labelClass = $vars['labelClass'] ?? ($labelClass ?? $selectedVariant['labelClass']);
    $value = $vars['value'] ?? ($value ?? $selectedVariant['value']);
    $label = $vars['label'] ?? ($label ?? $selectedVariant['label']);
@endphp

<!--begin::Tiles Widget 5-->
<a href="{{ $href }}" class="{{ $cardClass }}">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column justify-content-between">
        <i class="ki-duotone {{ $iconName }} {{ $iconClass }}">
            @for ($i = 1; $i <= $iconPathCount; $i++)
                <span class="path{{ $i }}"></span>
            @endfor
        </i>
        <div class="d-flex flex-column">
            <div class="{{ $valueClass }}">{{ $value }}</div>
            <div class="{{ $labelClass }}">{{ $label }}</div>
        </div>
    </div>
    <!--end::Body-->
</a>
<!--end::Tiles Widget 5-->
