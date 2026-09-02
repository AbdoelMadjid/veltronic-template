@php($vars = $vars ?? [])
<!--begin::Card widget 5-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-md-50 mb-xl-10' }}">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <div class="card-title d-flex flex-column">
            <!--begin::Info-->
            <div class="d-flex align-items-center">
                <!--begin::Amount-->
                <span class="{{ $vars['amount_class'] ?? 'fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2' }}">{{ $vars['amount'] ?? '1,836' }}</span>
                <!--end::Amount-->
                <!--begin::Badge-->
                <span class="{{ $vars['badge_class'] ?? 'badge badge-light-danger fs-base' }}">
                    <i class="{{ $vars['badge_icon_class'] ?? 'ki-outline ki-arrow-down fs-5 text-danger ms-n1' }}">
                        @if ($vars['badge_icon_duotone'] ?? false)
                            <span class="path1"></span>
                            <span class="path2"></span>
                        @endif
                    </i>{{ $vars['badge_text'] ?? '2.2%' }}</span>
                <!--end::Badge-->
            </div>
            <!--end::Info-->
            <!--begin::Subtitle-->
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 pt-1 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? 'Total Sales' }}</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Card body-->
    <div class="card-body d-flex align-items-end pt-0">
        <!--begin::Progress-->
        <div class="d-flex align-items-center flex-column mt-3 w-100">
            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                <span class="{{ $vars['goal_label_class'] ?? 'fw-bolder fs-6 text-gray-900' }}">{{ $vars['goal_label'] ?? '1,048 to Goal' }}</span>
                <span class="{{ $vars['percentage_label_class'] ?? 'fw-bold fs-6 text-gray-500' }}">{{ $vars['percentage_label'] ?? '62%' }}</span>
            </div>
            <div class="{{ $vars['progress_track_class'] ?? 'h-8px mx-3 w-100 bg-light-success rounded' }}">
                <div class="{{ $vars['progress_bar_class'] ?? 'bg-success rounded h-8px' }}" role="progressbar"
                    style="{{ $vars['progress_style'] ?? 'width: 62%;' }}"
                    aria-valuenow="{{ $vars['progress_value_now'] ?? '50' }}"
                    aria-valuemin="{{ $vars['progress_value_min'] ?? '0' }}"
                    aria-valuemax="{{ $vars['progress_value_max'] ?? '100' }}"></div>
            </div>
        </div>
        <!--end::Progress-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 5-->
