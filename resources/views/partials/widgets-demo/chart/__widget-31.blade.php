@php($vars = $vars ?? [])
<!--begin::Chart widget 31-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-xl-100' }}">
    <!--begin::Header-->
    <div class="{{ $vars['header_class'] ?? 'card-header pt-7 mb-7' }}">
        <!--begin::Title-->
        <h3 class="{{ $vars['title_wrapper_class'] ?? 'card-title align-items-start flex-column' }}">
            <span class="{{ $vars['title_class'] ?? 'card-label fw-bold text-gray-800' }}">{{ $vars['title'] ?? 'Warephase stats' }}</span>
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 mt-1 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? '8k social visitors' }}</span>
        </h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <a href="{{ $vars['pdf_href'] ?? url('apps/ecommerce/catalog/add-product') }}" class="{{ $vars['pdf_class'] ?? 'btn btn-sm btn-light' }}">{{ $vars['pdf_label'] ?? 'PDF' }}
                Report</a>
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="{{ $vars['body_class'] ?? 'card-body d-flex align-items-end pt-0' }}">
        <!--begin::Chart-->
        <div id="{{ $vars['chart_id'] ?? 'kt_charts_widget_31_chart' }}" class="{{ $vars['chart_class'] ?? 'w-100 h-300px' }}"></div>
        <!--end::Chart-->
    </div>
    <!--end::Body-->
</div>
<!--end::Chart widget 31-->
