@php($vars = $vars ?? [])
<!--begin::Card widget 6-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-md-50 mb-5 mb-xl-10' }}">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <div class="card-title d-flex flex-column">
            <!--begin::Info-->
            <div class="d-flex align-items-center">
                <!--begin::Currency-->
                <span
                    class="{{ $vars['currency_class'] ?? 'fs-4 fw-semibold text-gray-500 me-1 align-self-start' }}">{{ $vars['currency'] ?? '$' }}</span>
                <!--end::Currency-->
                <!--begin::Amount-->
                <span class="{{ $vars['amount_class'] ?? 'fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2' }}">{{ $vars['amount'] ?? '2,420' }}</span>
                <!--end::Amount-->
                <!--begin::Badge-->
                <span class="{{ $vars['badge_class'] ?? 'badge badge-light-success fs-base' }}">
                    <i class="{{ $vars['badge_icon_class'] ?? 'ki-outline ki-arrow-up fs-5 text-success ms-n1' }}">
                        @if ($vars['badge_icon_duotone'] ?? false)
                            <span class="path1"></span>
                            <span class="path2"></span>
                        @endif
                    </i>{{ $vars['badge_text'] ?? '2.6%' }}</span>
                <!--end::Badge-->
            </div>
            <!--end::Info-->
            <!--begin::Subtitle-->
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 pt-1 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? 'Average Daily Sales' }}</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Card body-->
    <div class="{{ $vars['body_class'] ?? 'card-body d-flex align-items-end px-0 pb-0' }}">
        <!--begin::Chart-->
        <div id="{{ $vars['chart_id'] ?? 'kt_card_widget_6_chart' }}" class="{{ $vars['chart_class'] ?? 'w-100' }}"
            style="{{ $vars['chart_style'] ?? 'height: 80px' }}"></div>
        <!--end::Chart-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 6-->
