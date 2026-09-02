@php
    $variant = $variant ?? 1;

    $presets = [
        1 => [
            'cardClass' => 'card bgi-no-repeat bgi-position-y-top bgi-position-x-end statistics-widget-1 h-xl-100',
            'title' => 'Meeting Schedule',
            'meta' => '3:30PM - 4:20PM',
            'descriptionHtml' => 'Create a headline that is informative<br />and will capture readers',
        ],
        2 => [
            'cardClass' => 'card bgi-no-repeat bgi-position-y-top bgi-position-x-end statistics-widget-2 h-xl-100',
            'title' => 'Meeting Schedule',
            'meta' => '03 May 2020',
            'description' => 'Great blog posts don\'t just happen Even the best bloggers need it',
        ],
        3 => [
            'cardClass' => 'card bgi-no-repeat bgi-position-y-top bgi-position-x-end statistics-widget-3 h-xl-100',
            'title' => 'UI Conference',
            'meta' => '10AM Jan, 2021',
            'description' => 'AirWays - A Front-end solution for airlines build with ReactJS',
        ],
    ];

    $preset = $presets[$variant] ?? $presets[1];

    $cardClass = $cardClass ?? $preset['cardClass'];
    $title = $title ?? $preset['title'];
    $meta = $meta ?? $preset['meta'];
    $description = $description ?? ($preset['description'] ?? null);
    $descriptionHtml = $descriptionHtml ?? ($preset['descriptionHtml'] ?? null);
    $linkHref = $linkHref ?? 'javascript:void(0)';
@endphp

<!--begin::Statistics Widget 1-->
<div class="{{ $cardClass }}">
    <!--begin::Body-->
    <div class="card-body">
        <a href="{{ $linkHref }}"
            class="card-title fw-bold text-muted text-hover-primary fs-4">{{ $title }}</a>
        <div class="fw-bold text-primary my-6">{{ $meta }}</div>
        <p class="text-gray-900-75 fw-semibold fs-5 m-0">
            @if ($descriptionHtml)
                {!! $descriptionHtml !!}
            @else
                {{ $description }}
            @endif
        </p>
    </div>
    <!--end::Body-->
</div>
<!--end::Statistics Widget 1-->
