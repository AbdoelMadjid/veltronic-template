@php
    $vars = $vars ?? [];

    $items = $vars['items'] ?? [
        [
            'label' => 'Used Truck freight',
            'value' => '45%',
            'row_class' => 'd-flex fs-6 fw-semibold align-items-center',
            'bullet_class' => 'bullet w-8px h-6px rounded-2 bg-success me-3',
            'bullet_style' => null,
        ],
        [
            'label' => 'Used Ship freight',
            'value' => '21%',
            'row_class' => 'd-flex fs-6 fw-semibold align-items-center my-1',
            'bullet_class' => 'bullet w-8px h-6px rounded-2 bg-primary me-3',
            'bullet_style' => null,
        ],
        [
            'label' => 'Used Plane freight',
            'value' => '34%',
            'row_class' => 'd-flex fs-6 fw-semibold align-items-center',
            'bullet_class' => 'bullet w-8px h-6px rounded-2 me-3',
            'bullet_style' => 'background-color: #E4E6EF',
        ],
    ];
@endphp
<!--begin::Card widget 10-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-md-50 mb-lg-10' }}">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <div class="card-title d-flex flex-column">
            <!--begin::Amount-->
            <span class="{{ $vars['amount_class'] ?? 'fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2' }}">{{ $vars['amount'] ?? '69,700' }}</span>
            <!--end::Amount-->
            <!--begin::Subtitle-->
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 pt-1 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? 'Expected Earnings This Month' }}</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Card body-->
    <div class="card-body d-flex align-items-end pt-0">
        <!--begin::Wrapper-->
        <div class="d-flex align-items-center flex-wrap">
            <!--begin::Chart-->
            <div class="{{ $vars['chart_wrapper_class'] ?? 'd-flex me-7 me-xxl-10' }}">
                <div id="{{ $vars['chart_id'] ?? 'kt_card_widget_10_chart' }}"
                    class="{{ $vars['chart_class'] ?? 'min-h-auto' }}"
                    style="{{ $vars['chart_style'] ?? 'height: 78px; width: 78px' }}"
                    data-kt-size="{{ $vars['chart_size'] ?? '78' }}"
                    data-kt-line="{{ $vars['chart_line'] ?? '11' }}"></div>
            </div>
            <!--end::Chart-->
            <!--begin::Labels-->
            <div class="d-flex flex-column content-justify-center flex-grow-1">
                @foreach ($items as $item)
                    <!--begin::Label-->
                    <div class="{{ $item['row_class'] ?? 'd-flex fs-6 fw-semibold align-items-center' }}">
                        <!--begin::Bullet-->
                        <div class="{{ $item['bullet_class'] ?? 'bullet w-8px h-6px rounded-2 bg-success me-3' }}"
                            @if (!empty($item['bullet_style'])) style="{{ $item['bullet_style'] }}" @endif></div>
                        <!--end::Bullet-->
                        <!--begin::Label-->
                        <div class="{{ $item['label_class'] ?? 'fs-6 fw-semibold text-gray-500 flex-shrink-0' }}">{{ $item['label'] ?? '' }}</div>
                        <!--end::Label-->
                        <!--begin::Separator-->
                        <div class="{{ $item['separator_class'] ?? 'separator separator-dashed min-w-10px flex-grow-1 mx-2' }}"></div>
                        <!--end::Separator-->
                        <!--begin::Stats-->
                        <div class="{{ $item['value_class'] ?? 'ms-auto fw-bolder text-gray-700 text-end' }}">{{ $item['value'] ?? '' }}</div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Label-->
                @endforeach
            </div>
            <!--end::Labels-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 10-->
