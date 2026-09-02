@php($vars = $vars ?? [])
<!--begin::Card widget 8-->
<div class="{{ $vars['card_class'] ?? 'card overflow-hidden h-md-50 mb-5 mb-xl-10' }}">
    <!--begin::Card body-->
    <div class="{{ $vars['body_class'] ?? 'card-body d-flex justify-content-between flex-column px-0 pb-0' }}">
        <!--begin::Statistics-->
        <div class="{{ $vars['stats_class'] ?? 'mb-4 px-9' }}">
            <!--begin::Info-->
            <div class="{{ $vars['info_row_class'] ?? 'd-flex align-items-center mb-2' }}">
                <!--begin::Currency-->
                <span
                    class="{{ $vars['currency_class'] ?? 'fs-4 fw-semibold text-gray-500 align-self-start me-1&gt;' }}">{{ $vars['currency'] ?? '$' }}</span>
                <!--end::Currency-->
                <!--begin::Value-->
                <span class="{{ $vars['value_class'] ?? 'fs-2hx fw-bold text-gray-800 me-2 lh-1' }}">{{ $vars['value'] ?? '69,700' }}</span>
                <!--end::Value-->
                <!--begin::Label-->
                <span class="{{ $vars['badge_class'] ?? 'badge badge-light-success fs-base' }}">
                    <i class="{{ $vars['badge_icon_class'] ?? 'ki-outline ki-arrow-up fs-5 text-success ms-n1' }}">
                        @if ($vars['badge_icon_duotone'] ?? false)
                            <span class="path1"></span>
                            <span class="path2"></span>
                        @endif
                    </i>{{ $vars['badge_text'] ?? '2.2%' }}</span>
                <!--end::Label-->
            </div>
            <!--end::Info-->
            <!--begin::Description-->
            <span class="{{ $vars['description_class'] ?? 'fs-6 fw-semibold text-gray-500' }}">{{ $vars['description'] ?? 'Total Online Sales' }}</span>
            <!--end::Description-->
        </div>
        <!--end::Statistics-->
        <!--begin::Chart-->
        <div id="{{ $vars['chart_id'] ?? 'kt_card_widget_8_chart' }}" class="{{ $vars['chart_class'] ?? 'min-h-auto' }}"
            style="{{ $vars['chart_style'] ?? 'height: 125px' }}"></div>
        <!--end::Chart-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 8-->
