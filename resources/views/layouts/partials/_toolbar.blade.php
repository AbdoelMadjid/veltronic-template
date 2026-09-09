<!--begin::Toolbar-->
@isset($kt_app_toolbar)
    {{ $kt_app_toolbar }}
@else
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">

            <!--layout-partial:layout/partials/_page-title.html-->
            @include('layouts.partials._page-title')

            <!--begin::Actions-->
            @isset($action)
                {{ $action }}
            @else
                <!--begin::Actions-->
                {{-- @include('layouts.partials._action-filter') --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="d-flex align-items-center bg-body px-2 px-md-3 py-2 rounded-2 border border-gray-200 fs-7 fw-semibold text-gray-700 shadow-xs cursor-pointer"
                        data-bs-toggle="tooltip"
                        data-bs-placement="bottom"
                        data-bs-trigger="hover"
                        data-kt-lang-title-id="{{ strip_tags(renderDate([], 'id')) }}"
                        data-kt-lang-title-en="{{ strip_tags(renderDate([], 'en')) }}"
                        title="{{ strip_tags(renderDate()) }}">
                        <i class="ki-duotone ki-calendar-8 fs-4 text-primary me-0 me-md-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                        </i>
                        <span class="d-none d-md-inline">
                            {!! renderDate() !!}
                        </span>
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
