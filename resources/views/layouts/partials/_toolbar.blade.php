<!--begin::Toolbar-->
@isset($kt_app_toolbar)
    {{ $kt_app_toolbar }}
@else
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 gap-md-0">

            <!--layout-partial:layout/partials/_page-title.html-->
            @include('layouts.partials._page-title')

            <!--begin::Actions-->
            @isset($action)
                {!! $action !!}
            @else
                <!--begin::Actions-->
                {{-- @include('layouts.partials._action-filter') --}}
                <div class="d-flex align-items-center justify-content-between justify-content-md-end w-100 w-md-auto gap-2 gap-lg-3">
                    <div class="d-flex align-items-center bg-body px-2 px-md-3 py-1 py-md-1.5 rounded-2 border border-gray-200 fs-7 fw-semibold text-gray-700 shadow-xs cursor-pointer flex-grow-1 flex-md-grow-0"
                        data-bs-toggle="tooltip"
                        data-bs-placement="bottom"
                        data-bs-trigger="hover"
                        data-kt-lang-title-id="{{ renderDatePlain([], 'id') }}"
                        data-kt-lang-title-en="{{ renderDatePlain([], 'en') }}"
                        title="{{ renderDatePlain() }}">
                        <i class="ki-duotone ki-calendar-8 fs-3 text-primary me-2 flex-shrink-0">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                        </i>
                        <div class="d-inline-block">
                            {!! renderDate() !!}
                        </div>
                    </div>
                </div>
                <!--end::Actions-->
            @endisset
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
@endisset
<!--end::Toolbar-->
