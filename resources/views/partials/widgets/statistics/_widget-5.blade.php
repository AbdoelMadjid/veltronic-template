@php
    $statisticsWidget5Variant = $statisticsWidget5Variant ?? null
@endphp
@if ($statisticsWidget5Variant === 'a')
<a href="javascript:void(0)" class="card bg-body-white hoverable card-xl-stretch mb-xl-8">
    <!--begin::Body-->
    <div class="card-body">
        <i class="ki-duotone ki-basket text-primary fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>
        <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">Shopping Cart</div>
        <div class="fw-semibold text-gray-400">Lands, Houses, Ranchos, Farms</div>
    </div>
    <!--end::Body-->
</a>

@elseif ($statisticsWidget5Variant === 'b')
<a href="javascript:void(0)" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
    <!--begin::Body-->
    <div class="card-body">
        <i class="ki-duotone ki-element-11 text-white fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>
        <div class="text-white fw-bold fs-2 mb-2 mt-5">Appartments</div>
        <div class="fw-semibold text-white">Flats, Shared Rooms, Duplex</div>
    </div>
    <!--end::Body-->
</a>

@else
<!--begin::Statistics Widget 5-->
<a href="javascript:void(0)" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
    <!--begin::Body-->
    <div class="card-body">
        <i class="ki-duotone ki-basket text-white fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>
        <div class="text-white fw-bold fs-2 mb-2 mt-5">Shopping Cart</div>
        <div class="fw-semibold text-white">Lands, Houses, Ranchos, Farms</div>
    </div>
    <!--end::Body-->
</a>
<!--end::Statistics Widget 5-->

@endif
