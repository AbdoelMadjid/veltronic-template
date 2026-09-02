@php
    $vars = $vars ?? [];

    $items = $vars['items'] ?? [
        [
            'label' => 'Shoes',
            'value' => '$7,660',
            'bullet_class' => 'bullet w-8px h-6px rounded-2 bg-danger me-3',
            'bullet_style' => null,
            'row_class' => 'd-flex fs-6 fw-semibold align-items-center',
        ],
        [
            'label' => 'Gaming',
            'value' => '$2,820',
            'bullet_class' => 'bullet w-8px h-6px rounded-2 bg-primary me-3',
            'bullet_style' => null,
            'row_class' => 'd-flex fs-6 fw-semibold align-items-center my-3',
        ],
        [
            'label' => 'Others',
            'value' => '$45,257',
            'bullet_class' => 'bullet w-8px h-6px rounded-2 me-3',
            'bullet_style' => 'background-color: #E4E6EF',
            'row_class' => 'd-flex fs-6 fw-semibold align-items-center',
        ],
    ];
@endphp
<!--begin::Card widget 4-->
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
                <span class="{{ $vars['amount_class'] ?? 'fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2' }}">{{ $vars['amount'] ?? '69,700' }}</span>
                <!--end::Amount-->
                <!--begin::Badge-->
                <span class="{{ $vars['badge_class'] ?? 'badge badge-light-success fs-base' }}">
                    <i class="{{ $vars['badge_icon_class'] ?? 'ki-outline ki-arrow-up fs-5 text-success ms-n1' }}">
                        @if ($vars['badge_icon_duotone'] ?? false)
                            <span class="path1"></span>
                            <span class="path2"></span>
                        @endif
                    </i>{{ $vars['badge_text'] ?? '2.2%' }}</span>
                <!--end::Badge-->
            </div>
            <!--end::Info-->
            <!--begin::Subtitle-->
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 pt-1 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? 'Expected Earnings' }}</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Card body-->
    <div class="card-body pt-2 pb-4 d-flex align-items-center">
        <!--begin::Chart-->
        <div class="d-flex flex-center me-5 pt-2">
            <div id="{{ $vars['chart_id'] ?? 'kt_card_widget_4_chart' }}"
                style="{{ $vars['chart_style'] ?? 'min-width: 70px; min-height: 70px' }}"
                data-kt-size="{{ $vars['chart_size'] ?? '70' }}" data-kt-line="{{ $vars['chart_line'] ?? '11' }}"></div>
        </div>
        <!--end::Chart-->
        <!--begin::Labels-->
        <div class="d-flex flex-column content-justify-center w-100">
            @foreach ($items as $item)
                <!--begin::Label-->
                <div class="{{ $item['row_class'] ?? 'd-flex fs-6 fw-semibold align-items-center' }}">
                    <!--begin::Bullet-->
                    <div class="{{ $item['bullet_class'] ?? 'bullet w-8px h-6px rounded-2 bg-danger me-3' }}"
                        @if (!empty($item['bullet_style'])) style="{{ $item['bullet_style'] }}" @endif></div>
                    <!--end::Bullet-->
                    <!--begin::Label-->
                    <div class="{{ $item['label_class'] ?? 'text-gray-500 flex-grow-1 me-4' }}">{{ $item['label'] ?? '' }}</div>
                    <!--end::Label-->
                    <!--begin::Stats-->
                    <div class="{{ $item['value_class'] ?? 'fw-bolder text-gray-700 text-xxl-end' }}">{{ $item['value'] ?? '' }}</div>
                    <!--end::Stats-->
                </div>
                <!--end::Label-->
            @endforeach
        </div>
        <!--end::Labels-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 4-->
