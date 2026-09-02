<!--begin::Mixed Widget 14-->
@php
    $vars = $vars ?? [];

    $card_class = $vars['card_class'] ?? 'card card-xxl-stretch mb-xl-10 theme-dark-bg-body';
    $background_color = $vars['background_color'] ?? '#CBF0F4';
    $title = $vars['title'] ?? 'Contributors';
    $title_href = $vars['title_href'] ?? '#';
    $chart_class = $vars['chart_class'] ?? 'mixed-widget-14-chart';
    $chart_height = $vars['chart_height'] ?? '100px';
    $stat_prefix = $vars['stat_prefix'] ?? '';
    $stat_value = $vars['stat_value'] ?? '47';
    $stat_text = $vars['stat_text'] ?? '- 12% this week';
@endphp
<div class="{{ $card_class }}" style="background-color: {{ $background_color }}">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-grow-1">
            <!--begin::Title-->
            <a href="{{ $title_href }}" class="text-gray-900 text-hover-primary fw-bold fs-3">{{ $title }}</a>
            <!--end::Title-->
            <!--begin::Chart-->
            <div class="{{ $chart_class }}" style="height: {{ $chart_height }}"></div>
            <!--end::Chart-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Stats-->
        <div class="pt-5">
            @if ($stat_prefix !== '')
                <!--begin::Symbol-->
                <span class="text-gray-900 fw-bold fs-2x lh-0">{{ $stat_prefix }}</span>
                <!--end::Symbol-->
            @endif
            <!--begin::Number-->
            <span class="text-gray-900 fw-bold fs-3x me-2 lh-0">{{ $stat_value }}</span>
            <!--end::Number-->
            <!--begin::Text-->
            <span class="text-gray-900 fw-bold fs-6 lh-0">{{ $stat_text }}</span>
            <!--end::Text-->
        </div>
        <!--end::Stats-->
    </div>
</div>
<!--end::Mixed Widget 14-->
