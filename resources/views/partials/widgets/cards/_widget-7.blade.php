@php
    $widget7Variant = $widget7Variant ?? 'default';
    $widget7Defaults = [
        'default' => [
            'cardClass' => 'card card-flush h-md-50 mb-5 mb-xl-10',
            'amount' => '357',
            'subtitle' => 'Professionals',
            'heroesTitle' => 'Today’s Heroes',
            'moreLabel' => '+42',
            'moreBadgeClass' => 'bg-dark text-gray-300',
        ],
        'a' => [
            'cardClass' => 'card card-flush h-md-50 mb-xl-10',
            'amount' => '6.3k',
            'subtitle' => 'Total New Customers',
            'heroesTitle' => 'Today’s Heroes',
            'moreLabel' => '+42',
            'moreBadgeClass' => 'bg-light text-gray-400',
        ],
    ];
    $widget7Preset = $widget7Defaults[$widget7Variant] ?? $widget7Defaults['default'];

    $widget7CardClass = $widget7CardClass ?? $widget7Preset['cardClass'];
    $widget7Amount = $widget7Amount ?? $widget7Preset['amount'];
    $widget7Subtitle = $widget7Subtitle ?? $widget7Preset['subtitle'];
    $widget7HeroesTitle = $widget7HeroesTitle ?? $widget7Preset['heroesTitle'];
    $widget7MoreLabel = $widget7MoreLabel ?? $widget7Preset['moreLabel'];
    $widget7MoreBadgeClass = $widget7MoreBadgeClass ?? $widget7Preset['moreBadgeClass'];
@endphp
<!--begin::Card widget 7-->
<div class="{{ $widget7CardClass }}">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <div class="card-title d-flex flex-column">
            <!--begin::Amount-->
            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $widget7Amount }}</span>
            <!--end::Amount-->
            <!--begin::Subtitle-->
            <span class="text-gray-500 pt-1 fw-semibold fs-6">{{ $widget7Subtitle }}</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Card body-->
    <div class="card-body d-flex flex-column justify-content-end pe-0">
        <!--begin::Title-->
        <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">{{ $widget7HeroesTitle }}</span>
        <!--end::Title-->
        <!--begin::Users group-->
        <div class="symbol-group symbol-hover flex-nowrap">
            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
            </div>
            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                <img alt="Pic"
                    src="{{ \App\Support\ThemeAsset::url('media/avatars/300-11.jpg', $theme_asset_pack ?? null) }}" />
            </div>
            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
            </div>
            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                <img alt="Pic"
                    src="{{ \App\Support\ThemeAsset::url('media/avatars/300-2.jpg', $theme_asset_pack ?? null) }}" />
            </div>
            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                <span class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
            </div>
            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
                <img alt="Pic"
                    src="{{ \App\Support\ThemeAsset::url('media/avatars/300-12.jpg', $theme_asset_pack ?? null) }}" />
            </div>
            <a href="javascript:void(0)" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                data-bs-target="#kt_modal_view_users">
                <span class="symbol-label {{ $widget7MoreBadgeClass }} fs-8 fw-bold">{{ $widget7MoreLabel }}</span>
            </a>
        </div>
        <!--end::Users group-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card widget 7-->
