<!--begin::Toolbar-->
<div class="toolbar py-5 pb-lg-15" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class=" container-xxl  d-flex flex-stack flex-wrap">
        <!--layout-partial:layout/_page-title.html-->
        @include('layouts._page-title-v2')
        <!--begin::Actions-->
        @isset($action)
            {{ $action }}
        @else
            <div class="d-flex align-items-center py-3 py-md-1">
                <div class="d-flex align-items-center bg-white bg-opacity-10 px-3 py-1 py-md-1.5 rounded-2 fs-7 fw-semibold text-white shadow-xs cursor-pointer"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-trigger="hover"
                    data-kt-lang-title-id="{{ renderDatePlain([], 'id') }}"
                    data-kt-lang-title-en="{{ renderDatePlain([], 'en') }}"
                    title="{{ renderDatePlain() }}">
                    <i class="ki-duotone ki-calendar-8 fs-3 text-white me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                        <span class="path6"></span>
                    </i>
                    <span class="d-none d-md-inline">
                        {!! renderDate(['gregorian_class' => 'text-white fw-bold fs-7 lh-1', 'hijri_class' => 'text-white text-opacity-75 fw-semibold fs-8 lh-1 mt-1']) !!}
                    </span>
                </div>
            </div>
        @endisset
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
