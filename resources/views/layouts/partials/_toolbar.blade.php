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
                @include('layouts.partials._action-filter')
                <!--end::Actions-->
            @endisset
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
@endisset
<!--end::Toolbar-->
