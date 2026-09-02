@php
    $vars = $vars ?? [];

    $users = $vars['users'] ?? [
        [
            'type' => 'label',
            'tooltip' => 'Alan Warden',
            'label_text' => 'A',
            'label_class' => 'symbol-label bg-warning text-inverse-warning fw-bold',
        ],
        [
            'type' => 'image',
            'tooltip' => 'Michael Eberon',
            'img_src' => 'assets/media/avatars/300-11.jpg',
            'img_alt' => 'Pic',
        ],
        [
            'type' => 'label',
            'tooltip' => 'Susan Redwood',
            'label_text' => 'S',
            'label_class' => 'symbol-label bg-primary text-inverse-primary fw-bold',
        ],
        [
            'type' => 'image',
            'tooltip' => 'Melody Macy',
            'img_src' => 'assets/media/avatars/300-2.jpg',
            'img_alt' => 'Pic',
        ],
        [
            'type' => 'label',
            'tooltip' => 'Perry Matthew',
            'label_text' => 'P',
            'label_class' => 'symbol-label bg-danger text-inverse-danger fw-bold',
        ],
        [
            'type' => 'image',
            'tooltip' => 'Barry Walter',
            'img_src' => 'assets/media/avatars/300-12.jpg',
            'img_alt' => 'Pic',
        ],
    ];
@endphp
<!--begin::Card widget 7-->
<div class="{{ $vars['card_class'] ?? 'card card-flush h-md-50 mb-5 mb-xl-10' }}">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <div class="card-title d-flex flex-column">
            <!--begin::Amount-->
            <span class="{{ $vars['amount_class'] ?? 'fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2' }}">{{ $vars['amount'] ?? '357' }}</span>
            <!--end::Amount-->
            <!--begin::Subtitle-->
            <span class="{{ $vars['subtitle_class'] ?? 'text-gray-500 pt-1 fw-semibold fs-6' }}">{{ $vars['subtitle'] ?? 'Professionals' }}</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Card body-->
    <div class="card-body d-flex flex-column justify-content-end pe-0">
        <!--begin::Title-->
        <span class="{{ $vars['group_title_class'] ?? 'fs-6 fw-bolder text-gray-800 d-block mb-2' }}">{{ $vars['group_title'] ?? 'Today’s Heroes' }}</span>
        <!--end::Title-->
        <!--begin::Users group-->
        <div class="{{ $vars['symbol_group_class'] ?? 'symbol-group symbol-hover flex-nowrap' }}">
            @foreach ($users as $user)
                <div class="{{ $user['symbol_class'] ?? 'symbol symbol-35px symbol-circle' }}" data-bs-toggle="tooltip"
                    title="{{ $user['tooltip'] ?? '' }}">
                    @if (($user['type'] ?? 'label') === 'image')
                        <img alt="{{ $user['img_alt'] ?? 'Pic' }}" src="{{ $user['img_src'] ?? '' }}" />
                    @else
                        <span class="{{ $user['label_class'] ?? 'symbol-label bg-warning text-inverse-warning fw-bold' }}">{{ $user['label_text'] ?? '' }}</span>
                    @endif
                </div>
            @endforeach
            <a href="{{ $vars['more_href'] ?? '#' }}" class="{{ $vars['more_symbol_class'] ?? 'symbol symbol-35px symbol-circle' }}"
                data-bs-toggle="modal" data-bs-target="{{ $vars['more_target'] ?? '#kt_modal_view_users' }}">
                <span class="{{ $vars['more_label_class'] ?? 'symbol-label bg-dark text-gray-300 fs-8 fw-bold' }}">{{ $vars['more_label'] ?? '+42' }}</span>
            </a>
        </div>
        <!--end::Users group-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 7-->
