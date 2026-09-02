@php
    $widget2CardClass = $widget2CardClass ?? 'card h-lg-100';
    $widget2Image = $widget2Image ?? null;
    $widget2ImageClass = $widget2ImageClass ?? 'w-35px';
    $widget2IconClass = $widget2IconClass ?? 'ki-compass';
    $widget2IconPathCount = $widget2IconPathCount ?? 2;
    $widget2Value = $widget2Value ?? '327';
    $widget2Label = $widget2Label ?? 'Projects';
    $widget2BadgeClass = $widget2BadgeClass ?? 'badge badge-light-success fs-base';
    $widget2BadgeIconClass = $widget2BadgeIconClass ?? 'ki-arrow-up fs-5 text-success ms-n1';
    $widget2BadgeValue = $widget2BadgeValue ?? '2.1%';
@endphp
<!--begin::Card widget 2-->
<div class="{{ $widget2CardClass }}">
    <!--begin::Body-->
    <div class="card-body d-flex justify-content-between align-items-start flex-column">
        <!--begin::Icon-->
        <div class="m-0">
            @if ($widget2Image)
                <img src="{{ \App\Support\ThemeAsset::url($widget2Image, $theme_asset_pack ?? null) }}"
                    class="{{ $widget2ImageClass }}" alt="" />
            @else
                <i class="ki-duotone {{ $widget2IconClass }} fs-2hx text-gray-600">
                    @for ($i = 1; $i <= $widget2IconPathCount; $i++)
                        <span class="path{{ $i }}"></span>
                    @endfor
                </i>
            @endif
        </div>
        <!--end::Icon-->
        <!--begin::Section-->
        <div class="d-flex flex-column my-7">
            <!--begin::Number-->
            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $widget2Value }}</span>
            <!--end::Number-->
            <!--begin::Follower-->
            <div class="m-0">
                <span class="fw-semibold fs-6 text-gray-500">{{ $widget2Label }}</span>
            </div>
            <!--end::Follower-->
        </div>
        <!--end::Section-->
        <!--begin::Badge-->
        <span class="{{ $widget2BadgeClass }}">
            <i class="ki-duotone {{ $widget2BadgeIconClass }}">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>{{ $widget2BadgeValue }}</span>
        <!--end::Badge-->
    </div>
    <!--end::Body-->
</div>
<!--end::Card widget 2-->
