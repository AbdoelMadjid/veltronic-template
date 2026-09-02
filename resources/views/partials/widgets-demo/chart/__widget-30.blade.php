@php($vars = $vars ?? [])
<!--begin::Chart widget 30-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-xl-100' }}">
    <!--begin::Header-->
    <div class="{{ $vars['header_class'] ?? 'card-header pt-7 mb-7' }}">
        <!--begin::Title-->
        <h3 class="{{ $vars['title_wrapper_class'] ?? 'card-title align-items-start flex-column' }}">
            <span class="{{ $vars['title_class'] ?? 'card-label fw-bold text-gray-800' }}">{{ $vars['title'] ?? 'Stats by Department' }}</span>
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 mt-1 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? '8k social visitors' }}</span>
        </h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <a href="{{ $vars['pdf_href'] ?? url('apps/ecommerce/catalog/add-product') }}"
                class="{{ $vars['pdf_class'] ?? 'btn btn-sm btn-light' }}">{{ $vars['pdf_label'] ?? 'PDF' }}
                Report</a>
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="{{ $vars['body_class'] ?? 'card-body d-flex justify-content-between flex-column' }}">
        <!--begin::Items-->
        <div class="{{ $vars['items_class'] ?? 'd-flex flex-wrap d-grid gap-5 mb-10' }}">
            <!--begin::Item-->
            <div class="{{ $vars['actual_wrapper_class'] ?? 'border-end-dashed border-end border-gray-300 pe-xxl-7 me-xxl-5' }}">
                <!--begin::Statistics-->
                <div class="d-flex mb-2">
                    <span class="{{ $vars['actual_currency_class'] ?? 'fs-4 fw-semibold text-gray-500 me-1' }}">{{ $vars['actual_currency'] ?? '$' }}</span>
                    <span class="{{ $vars['actual_value_class'] ?? 'fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2' }}">{{ $vars['actual_value'] ?? '8,035' }}</span>
                </div>
                <!--end::Statistics-->
                <!--begin::Description-->
                <span class="{{ $vars['actual_description_class'] ?? 'fs-6 fw-semibold text-gray-500' }}">{{ $vars['actual_description'] ?? 'Actual for April' }}</span>
                <!--end::Description-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="{{ $vars['gap_wrapper_class'] ?? 'm-0' }}">
                <!--begin::Statistics-->
                <div class="d-flex align-items-center mb-2">
                    <!--begin::Currency-->
                    <span class="{{ $vars['gap_currency_class'] ?? 'fs-4 fw-semibold text-gray-500 align-self-start me-1' }}">{{ $vars['gap_currency'] ?? '$' }}</span>
                    <!--end::Currency-->
                    <!--begin::Value-->
                    <span class="{{ $vars['gap_value_class'] ?? 'fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2' }}">{{ $vars['gap_value'] ?? '4,684' }}</span>
                    <!--end::Value-->
                    <!--begin::Label-->
                    <span class="{{ $vars['gap_badge_class'] ?? 'badge badge-light-success fs-base' }}">
                        <i class="{{ $vars['gap_trend_icon_class'] ?? 'ki-outline ki-arrow-up fs-5 text-success ms-n1' }}">
                            @if ($vars['gap_trend_icon_duotone'] ?? false)
                                <span class="path1"></span>
                                <span class="path2"></span>
                            @endif
                        </i>{{ $vars['gap_trend_text'] ?? '4.5%' }}</span>
                    <!--end::Label-->
                </div>
                <!--end::Statistics-->
                <!--begin::Description-->
                <span class="{{ $vars['gap_description_class'] ?? 'fs-6 fw-semibold text-gray-500' }}">{{ $vars['gap_description'] ?? 'GAP' }}</span>
                <!--end::Description-->
            </div>
            <!--end::Item-->
        </div>
        <!--end::Items-->
        <!--begin::Chart container-->
        <div id="{{ $vars['chart_id'] ?? 'kt_charts_widget_30_chart' }}" class="{{ $vars['chart_class'] ?? 'w-100 h-200px' }}"></div>
        <!--end::Chart container-->
    </div>
    <!--end::Body-->
</div>
<!--end::Chart widget 30-->
