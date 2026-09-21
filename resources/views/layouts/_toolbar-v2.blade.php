<!--begin::Toolbar-->
<div class="toolbar py-5 pb-lg-15" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 gap-md-0 flex-wrap">
        <!--layout-partial:layout/_page-title.html-->
        @include('layouts._page-title-v2')
        <!--begin::Actions-->
        @isset($action)
            {{ $action }}
        @else
            <div class="d-flex align-items-center justify-content-between justify-content-md-end w-100 w-md-auto py-1">
                <div class="d-flex align-items-center bg-white bg-opacity-10 px-3 py-1 py-md-1.5 rounded-2 fs-7 fw-semibold text-white shadow-xs cursor-pointer flex-grow-1 flex-md-grow-0"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-trigger="hover"
                    data-kt-lang-title-id="{{ renderDatePlain([], 'id') }}"
                    data-kt-lang-title-en="{{ renderDatePlain([], 'en') }}"
                    title="{{ renderDatePlain() }}">
                    <i class="ki-duotone ki-calendar-8 fs-3 text-white me-2 flex-shrink-0">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                        <span class="path6"></span>
                    </i>
                    <div class="d-inline-block">
                        {!! renderDate([
                            'gregorian_class' => 'text-white fw-bold fs-7 lh-1',
                            'hijri_class' => 'text-white text-opacity-75 fw-semibold fs-8 lh-1 mt-1',
                            'friday_style' => 'color: #50cd89; font-weight: 700;',
                            'sunday_style' => 'color: #f1416c; font-weight: 700;',
                        ]) !!}
                    </div>
                </div>
            </div>
        @endisset
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
