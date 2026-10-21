<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--layout-partial:layout/header/_base.html-->
            @include('themes.v2.layouts.header._base')
            <!--layout-partial:layout/_toolbar.html-->
            @hasSection('toolbar')
                @yield('toolbar')
            @else
                @include('themes.v2.layouts._toolbar')
            @endif
            <!--begin::Container-->
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                <!--begin::Post-->
                <div class="content flex-row-fluid" id="kt_content">
                    @yield('content')
                </div>
                <!--end::Post-->
            </div>
            <!--end::Container-->
            <!--layout-partial:layout/_footer.html-->
            @include('themes.v2.layouts._footer')
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
