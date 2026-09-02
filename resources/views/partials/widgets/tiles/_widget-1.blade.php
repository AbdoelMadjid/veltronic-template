@php
    $tilesWidget1Variant = $tilesWidget1Variant ?? null
@endphp
@if ($tilesWidget1Variant === 'a')
<!--begin::Tiles Widget 1-->
<div class="card h-150px bgi-no-repeat bgi-size-cover bgi-position-y-center card-xl-stretch border-0"
    style="background-image:url('{{ \App\Support\ThemeAsset::url('media/stock/600x600/img-22.jpg', $theme_asset_pack ?? null) }}')">
    <!--begin::Body-->
    <div class="card-body p-6">
        <!--begin::Title-->
        <a href="javascript:void(0)" class="text-black text-hover-primary fw-bold fs-2" data-bs-toggle="modal"
            data-bs-target="#kt_modal_create_app">Company</a>
        <!--end::Title-->
    </div>
    <!--end::Body-->
</div>
<!--end::Tiles Widget 1-->

@else
<!--begin::Tiles Widget 1-->
<div class="card h-150px bgi-no-repeat bgi-size-cover bgi-position-y-center h-150px mb-5 mb-lg-10"
    style="background-image:url('{{ \App\Support\ThemeAsset::url('media/stock/600x600/img-12.jpg', $theme_asset_pack ?? null) }}')">
    <!--begin::Body-->
    <div class="card-body p-6">
        <!--begin::Title-->
        <a href="javascript:void(0)" class="text-black text-hover-primary fw-bold fs-2" data-bs-toggle="modal"
            data-bs-target="#kt_modal_create_app">Roofing</a>
        <!--end::Title-->
    </div>
    <!--end::Body-->
</div>
<!--end::Tiles Widget 1-->

@endif
