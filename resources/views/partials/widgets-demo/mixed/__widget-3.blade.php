<!--begin::Mixed Widget 3-->
@php
    $vars = $vars ?? [];

    $card_class = $vars['card_class'] ?? 'card h-100 bgi-no-repeat bgi-size-cover h-lg-100';
    $background_image_url =
        $vars['background_image_url'] ??
        \App\Support\ThemeAsset::url('media/misc/bg-2.jpg', $theme_asset_pack ?? null);
    $link_href = $vars['link_href'] ?? 'javascript:void(0)';
@endphp
<div class="{{ $card_class }}" style="background-image:url('{{ $background_image_url }}')">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column justify-content-between">
        <!--begin::Title-->
        <div class="text-white fw-bold fs-2">
            <h2 class="fw-bold text-white mb-2">Create Reports</h2>With App
        </div>
        <!--end::Title-->
        <!--begin::Link-->
        <a href="{{ $link_href }}" class="text-warning fw-semibold" data-bs-toggle="modal"
            data-bs-target="#kt_modal_create_campaign">Create Report
            <i class="ki-duotone ki-arrow-right fs-2 text-warning">
                <span class="path1"></span>
                <span class="path2"></span>
            </i></a>
        <!--end::Link-->
    </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 3-->
