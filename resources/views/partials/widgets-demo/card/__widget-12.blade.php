@php($vars = $vars ?? [])
<!--begin::Card widget 12-->
<div class="{{ $vars['card_class'] ?? 'card overflow-hidden h-md-50 mb-5 mb-xl-10' }}">
    <!--begin::Card body-->
    <div class="{{ $vars['body_class'] ?? 'card-body d-flex justify-content-between flex-column px-0 pb-0' }}">
        <!--begin::Statistics-->
        <div class="{{ $vars['stats_class'] ?? 'mb-4 px-9' }}">
            <!--begin::Info-->
            <div class="{{ $vars['info_row_class'] ?? 'd-flex align-items-center mb-2' }}">
                <!--begin::Value-->
                <span class="{{ $vars['value_class'] ?? 'fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2' }}">{{ $vars['value'] ?? '47,769,700' }}</span>
                <!--end::Value-->
                <!--begin::Label-->
                <span class="{{ $vars['unit_class'] ?? 'd-flex align-items-end text-gray-500 fs-6 fw-semibold' }}">{{ $vars['unit'] ?? 'Tons' }}</span>
                <!--end::Label-->
            </div>
            <!--end::Info-->
            <!--begin::Description-->
            <span class="{{ $vars['description_class'] ?? 'fs-6 fw-semibold text-gray-500' }}">{{ $vars['description'] ?? 'Total Online Sales' }}</span>
            <!--end::Description-->
        </div>
        <!--end::Statistics-->
        <!--begin::Chart-->
        <div id="{{ $vars['chart_id'] ?? 'kt_card_widget_12_chart' }}" class="{{ $vars['chart_class'] ?? 'min-h-auto' }}"
            style="{{ $vars['chart_style'] ?? 'height: 125px' }}"></div>
        <!--end::Chart-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 12-->
