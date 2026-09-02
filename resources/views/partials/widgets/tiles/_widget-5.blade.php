@php
    $tilesWidget5Variant = $tilesWidget5Variant ?? null
@endphp
@if ($tilesWidget5Variant === 'a')
<a href="javascript:void(0)" class="card card-xxl-stretch bg-primary">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column justify-content-between">
        <i class="ki-duotone ki-element-11 text-white fs-2hx ms-n1 flex-grow-1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>
        <div class="d-flex flex-column">
            <div class="text-white fw-bold fs-1 mb-0 mt-5">790</div>
            <div class="text-white fw-semibold fs-6">New Products</div>
        </div>
    </div>
    <!--end::Body-->
</a>

@else
<!--begin::Tiles Widget 5-->
<a href="javascript:void(0)" class="card bg-body h-150px">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column justify-content-between">
        <i class="ki-duotone ki-element-11 text-gray-900 fs-2hx ms-n1 flex-grow-1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>
        <div class="d-flex flex-column">
            <div class="text-gray-900 fw-bold fs-1 mb-0 mt-5">8,600</div>
            <div class="text-muted fw-semibold fs-6">New Customers</div>
        </div>
    </div>
    <!--end::Body-->
</a>
<!--end::Tiles Widget 5-->

@endif
