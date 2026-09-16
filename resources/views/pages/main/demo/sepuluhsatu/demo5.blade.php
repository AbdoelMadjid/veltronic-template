@extends('layouts.index')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/fullcalendar/fullcalendar.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endsection
@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('li_2')
            Demo
        @endslot
        @slot('action')
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                <a href="javascript:void(0)" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_project">Manage Bids</a>
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="javascript:void(0)" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_campaign">Start Auction</a>
                <!--end::Primary button-->
            </div>
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                <!--begin::Aside-->
                <div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '225px'}" data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_aside_toggle" data-kt-sticky="true" data-kt-sticky-name="aside-sticky"
                    data-kt-sticky-offset="{default: false, lg: '1px'}" data-kt-sticky-width="{lg: '225px'}"
                    data-kt-sticky-left="auto" data-kt-sticky-top="94px" data-kt-sticky-animation="false"
                    data-kt-sticky-zindex="95">
                    <!--begin::Aside nav-->
                    <div class="hover-scroll-overlay-y my-5 my-lg-5 w-100 ps-4 ps-lg-0 pe-4 me-1" id="kt_aside_menu_wrapper"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_header"
                        data-kt-scroll-wrappers="#kt_aside" data-kt-scroll-offset="5px">
                        <!--begin::Menu-->
                        <div class="menu menu-column menu-active-bg menu-hover-bg menu-title-gray-700 fs-6 menu-rounded w-100"
                            id="#kt_aside_menu" data-kt-menu="true">
                            <!--begin::Heading-->
                            <div class="menu-item">
                                <div class="menu-content pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-7 fw-bold">Public</span>
                                </div>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('docs/laravel/index') }}" class="menu-link active">
                                    <span class="menu-title">All Questions</span>
                                    <span class="menu-badge">6,234</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}" class="menu-link">
                                    <span class="menu-title">Search</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}" class="menu-link">
                                    <span class="menu-title">Tags</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}" class="menu-link">
                                    <span class="menu-title">Ask Question</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Heading-->
                            <div class="menu-item pt-5">
                                <div class="menu-content pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-7 fw-bold">My Activity</span>
                                </div>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}" class="menu-link">
                                    <span class="menu-title">My Questions</span>
                                    <span class="menu-badge">24</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                    <span class="menu-title">Resolved</span>
                                    <span class="menu-badge">120</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                    <span class="menu-title">Enrolled</span>
                                    <span class="menu-badge">10</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                    <span class="menu-title">Saved</span>
                                    <span class="menu-badge">6</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Heading-->
                            <div class="menu-item pt-5">
                                <div class="menu-content pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-7 fw-bold">Categories</span>
                                </div>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                    <span class="menu-title">Metronic Admin</span>
                                    <span class="menu-badge">1,400</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                    <span class="menu-title">Backend Integration</span>
                                    <span class="menu-badge">235</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                    <span class="menu-title">Suggestions</span>
                                    <span class="menu-badge">25</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                    <span class="menu-title">Pre-sale Questions</span>
                                    <span class="menu-badge">145</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item">
                                <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                    <span class="menu-title">Laravel Starter Kit</span>
                                    <span class="menu-badge">750</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Collapse-->
                            <div class="collapse" id="kt_aside_categories_more">
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                        <span class="menu-title">Blazor Integration</span>
                                        <span class="menu-badge">100</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                        <span class="menu-title">Django Dashboard</span>
                                        <span class="menu-badge">90</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                        <span class="menu-title">Rails CRUD</span>
                                        <span class="menu-badge">14</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <a href="{{ url('docs/laravel/index') }}" class="menu-link">
                                        <span class="menu-title">.NET Starter Kit</span>
                                        <span class="menu-badge">30</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Collapse-->
                            <!--begin::Heading-->
                            <div class="menu-item">
                                <div class="menu-link">
                                    <a hred="#" class="menu-title text-muted fs-7" id="kt_aside_categories_toggle"
                                        data-bs-toggle="collapse" data-bs-target="#kt_aside_categories_more">More
                                        Categories</a>
                                </div>
                            </div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Aside nav-->
                </div>
                <!--end::Aside-->
                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
                    <!--begin::Content-->
                    <div class="content flex-column-fluid" id="kt_content">
                        <!--begin::Toolbar-->
                        <div class="toolbar d-flex flex-stack flex-wrap mb-5 mb-lg-7" id="kt_toolbar">
                            <!--begin::Page title-->
                            <div class="page-title d-flex flex-column py-1">
                                <!--begin::Title-->
                                <h1 class="d-flex align-items-center my-1">
                                    <span class="text-gray-900 fw-bold fs-1">All Questions</span>
                                    <!--begin::Description-->
                                    <small class="text-muted fs-6 fw-semibold ms-1">(6,299)</small>
                                    <!--end::Description-->
                                </h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            <div class="d-flex align-items-center py-1">
                                <!--begin::Button-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="btn btn-flex btn-sm btn-primary fw-bold border-0 fs-6 h-40px"
                                    id="kt_toolbar_primary_button">Ask Question</a>
                                <!--end::Button-->
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Post-->
                        <div class="post" id="kt_post">
                            <!--begin::Questions-->
                            <div class="mb-10">
                                <!--begin::Question-->
                                <div class="mb-0">
                                    <!--begin::Head-->
                                    <div class="d-flex align-items-center mb-4">
                                        <!--begin::Title-->
                                        <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                            class="fs-2 fw-bold text-gray-900 text-hover-primary me-1">How to use Metronic
                                            with
                                            Django Framework ?</a>
                                        <!--end::Title-->
                                        <!--begin::Icons-->
                                        <div class="d-flex align-items-center">
                                            <span class="ms-1" data-bs-toggle="tooltip" title="New question">
                                                <i class="ki-duotone ki-information-5 text-primary fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                            <span class="ms-1" data-bs-toggle="tooltip" title="User replied">
                                                <i class="ki-duotone ki-sms text-danger fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Icons-->
                                    </div>
                                    <!--end::Head-->
                                    <!--begin::Summary-->
                                    <div class="fs-base fw-normal text-gray-700 mb-4">I’ve been doing some ajax request, to
                                        populate a inside drawer, the content of that drawer has a sub menu, that you are
                                        using in
                                        list and all card toolbar.</div>
                                    <!--end::Summary-->
                                    <!--begin::Foot-->
                                    <div class="d-flex flex-stack flex-wrap">
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-2">
                                                <div
                                                    class="symbol-label bg-light-success fs-3 fw-semibold text-success text-uppercase">
                                                    J</div>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Name-->
                                            <div class="d-flex flex-column align-items-start justify-content-center">
                                                <span class="text-gray-900 fs-7 fw-semibold lh-1 mb-2">James Hunt</span>
                                                <span class="text-muted fs-8 fw-semibold lh-1">24 minutes ago</span>
                                            </div>
                                            <!--end::Name-->
                                        </div>
                                        <!--end::Author-->
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Answers-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5#answers') }}"
                                                class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2">16
                                                Answers</a>
                                            <!--end::Answers-->
                                            <!--begin::Tags-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                                class="btn btn-sm btn-light px-4 me-2">Metronic</a>
                                            <!--end::Tags-->
                                            <!--begin::Upvote-->
                                            <a href="javascript:void(0)" class="btn btn-sm btn-flex btn-light px-3"
                                                data-bs-toggle="tooltip" title="Upvote this question"
                                                data-bs-dismiss="click">23
                                                <i class="ki-duotone ki-black-right fs-3ms-2 me-0 fs-3"></i></a>
                                            <!--end::Upvote-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Foot-->
                                </div>
                                <!--end::Question-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed border-gray-300 my-8"></div>
                                <!--end::Separator-->
                                <!--begin::Question-->
                                <div class="mb-0">
                                    <!--begin::Head-->
                                    <div class="d-flex align-items-center mb-4">
                                        <!--begin::Title-->
                                        <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                            class="fs-2 fw-bold text-gray-900 text-hover-primary me-1">When to expect new
                                            version
                                            of Laravel ?</a>
                                        <!--end::Title-->
                                        <!--begin::Icons-->
                                        <div class="d-flex align-items-center">
                                            <span class="ms-1" data-bs-toggle="tooltip" title="In-process">
                                                <i class="ki-duotone ki-information-5 text-warning fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Icons-->
                                    </div>
                                    <!--end::Head-->
                                    <!--begin::Summary-->
                                    <div class="fs-base fw-normal text-gray-700 mb-4">When approx. is the next update for
                                        the
                                        Laravel version planned? Waiting for the CRUD, 2nd factor etc. features before
                                        starting my
                                        project. Also can we expect the Laravel + Vue version in the next update ?</div>
                                    <!--end::Summary-->
                                    <!--begin::Foot-->
                                    <div class="d-flex flex-stack flex-wrap">
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-2">
                                                <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-2.jpg', $theme_asset_pack ?? null) }}"
                                                    alt="user" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Name-->
                                            <div class="d-flex flex-column align-items-start justify-content-center">
                                                <span class="text-gray-900 fs-7 fw-semibold lh-1 mb-2">Sandra Piquet</span>
                                                <span class="text-muted fs-8 fw-semibold lh-1">1 day ago</span>
                                            </div>
                                            <!--end::Name-->
                                        </div>
                                        <!--end::Author-->
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Answers-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5#answers') }}"
                                                class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2">2
                                                Answers</a>
                                            <!--end::Answers-->
                                            <!--begin::Tags-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                                class="btn btn-sm btn-light px-4 me-2">Pre-sale</a>
                                            <!--end::Tags-->
                                            <!--begin::Upvote-->
                                            <a href="javascript:void(0)" class="btn btn-sm btn-flex btn-light px-3"
                                                data-bs-toggle="tooltip" title="Upvote this question"
                                                data-bs-dismiss="click">4
                                                <i class="ki-duotone ki-black-right fs-3ms-2 me-0 fs-3"></i></a>
                                            <!--end::Upvote-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Foot-->
                                </div>
                                <!--end::Question-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed border-gray-300 my-8"></div>
                                <!--end::Separator-->
                                <!--begin::Question-->
                                <div class="mb-0">
                                    <!--begin::Head-->
                                    <div class="d-flex align-items-center mb-4">
                                        <!--begin::Title-->
                                        <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                            class="fs-2 fw-bold text-gray-900 text-hover-primary me-1">Could not get Demo 7
                                            working</a>
                                        <!--end::Title-->
                                        <!--begin::Icons-->
                                        <div class="d-flex align-items-center">
                                            <span class="ms-1" data-bs-toggle="tooltip" title="In-process">
                                                <i class="ki-duotone ki-information-5 text-warning fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Icons-->
                                    </div>
                                    <!--end::Head-->
                                    <!--begin::Summary-->
                                    <div class="fs-base fw-normal text-gray-700 mb-4">could not get demo7 working from
                                        latest
                                        metronic version. Had a lot of issues installing, I had to downgrade my npm to
                                        6.14.4 as
                                        someone else recommended here in the comments, this goot it to compile but when I
                                        ran it,
                                        the browser showed errors TypeErr..</div>
                                    <!--end::Summary-->
                                    <!--begin::Foot-->
                                    <div class="d-flex flex-stack flex-wrap">
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-2">
                                                <div
                                                    class="symbol-label bg-light-success fs-3 fw-semibold text-success text-uppercase">
                                                    N</div>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Name-->
                                            <div class="d-flex flex-column align-items-start justify-content-center">
                                                <span class="text-gray-900 fs-7 fw-semibold lh-1 mb-2">Niko Roseberg</span>
                                                <span class="text-muted fs-8 fw-semibold lh-1">2 days ago</span>
                                            </div>
                                            <!--end::Name-->
                                        </div>
                                        <!--end::Author-->
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Answers-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5#answers') }}"
                                                class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2">4
                                                Answers</a>
                                            <!--end::Answers-->
                                            <!--begin::Tags-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                                class="btn btn-sm btn-light px-4 me-2">Angular</a>
                                            <!--end::Tags-->
                                            <!--begin::Upvote-->
                                            <a href="javascript:void(0)" class="btn btn-sm btn-flex btn-light btn-icon"
                                                data-bs-toggle="tooltip" title="Upvote this question"
                                                data-bs-dismiss="click">
                                                <i class="ki-duotone ki-black-right fs-3"></i>
                                            </a>
                                            <!--end::Upvote-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Foot-->
                                </div>
                                <!--end::Question-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed border-gray-300 my-8"></div>
                                <!--end::Separator-->
                                <!--begin::Question-->
                                <div class="mb-0">
                                    <!--begin::Head-->
                                    <div class="d-flex align-items-center mb-4">
                                        <!--begin::Title-->
                                        <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                            class="fs-2 fw-bold text-gray-900 text-hover-primary me-1">I want to get
                                            refund</a>
                                        <!--end::Title-->
                                        <!--begin::Icons-->
                                        <div class="d-flex align-items-center">
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Resolved">
                                                <i class="ki-duotone ki-check-circle text-success fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Icons-->
                                    </div>
                                    <!--end::Head-->
                                    <!--begin::Summary-->
                                    <div class="fs-base fw-normal text-gray-700 mb-4">Your Metronic theme is so good but
                                        the
                                        reactjs version is typescript only. The description did not write any warn about it.
                                        Since I
                                        only know javascript, I can not do anything with your theme. I want to refund.</div>
                                    <!--end::Summary-->
                                    <!--begin::Foot-->
                                    <div class="d-flex flex-stack flex-wrap">
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-2">
                                                <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-23.jpg', $theme_asset_pack ?? null) }}"
                                                    alt="user" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Name-->
                                            <div class="d-flex flex-column align-items-start justify-content-center">
                                                <span class="text-gray-900 fs-7 fw-semibold lh-1 mb-2">Alex Bold</span>
                                                <span class="text-muted fs-8 fw-semibold lh-1">1 day ago</span>
                                            </div>
                                            <!--end::Name-->
                                        </div>
                                        <!--end::Author-->
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Answers-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5#answers') }}"
                                                class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2">22
                                                Answers</a>
                                            <!--end::Answers-->
                                            <!--begin::Tags-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                                class="btn btn-sm btn-light px-4 me-2">React</a>
                                            <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                                class="btn btn-sm btn-light px-4 me-2">Demo 1</a>
                                            <!--end::Tags-->
                                            <!--begin::Upvote-->
                                            <a href="javascript:void(0)" class="btn btn-sm btn-flex btn-light px-3"
                                                data-bs-toggle="tooltip" title="Upvote this question"
                                                data-bs-dismiss="click">11
                                                <i class="ki-duotone ki-black-right fs-3ms-2 me-0 fs-3"></i></a>
                                            <!--end::Upvote-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Foot-->
                                </div>
                                <!--end::Question-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed border-gray-300 my-8"></div>
                                <!--end::Separator-->
                                <!--begin::Question-->
                                <div class="mb-0">
                                    <!--begin::Head-->
                                    <div class="d-flex align-items-center mb-4">
                                        <!--begin::Title-->
                                        <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                            class="fs-2 fw-bold text-gray-900 text-hover-primary me-1">How to integrate
                                            Metronic
                                            with Blazor Server Side ?</a>
                                        <!--end::Title-->
                                        <!--begin::Icons-->
                                        <div class="d-flex align-items-center">
                                            <span class="ms-1" data-bs-toggle="tooltip" title="In-process">
                                                <i class="ki-duotone ki-check-circle text-success fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Icons-->
                                    </div>
                                    <!--end::Head-->
                                    <!--begin::Summary-->
                                    <div class="fs-base fw-normal text-gray-700 mb-4">could not get demo7 working from
                                        latest
                                        metronic version. Had a lot of issues installing, I had to downgrade my npm to
                                        6.14.4 as
                                        someone else recommended here in the comments, this goot it to compile but when I
                                        ran it,
                                        the browser showed errors TypeErr..</div>
                                    <!--end::Summary-->
                                    <!--begin::Foot-->
                                    <div class="d-flex flex-stack flex-wrap">
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-2">
                                                <div
                                                    class="symbol-label bg-light-success fs-3 fw-semibold text-success text-uppercase">
                                                    T</div>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Name-->
                                            <div class="d-flex flex-column align-items-start justify-content-center">
                                                <span class="text-gray-900 fs-7 fw-semibold lh-1 mb-2">Tim Nilson</span>
                                                <span class="text-muted fs-8 fw-semibold lh-1">3 days ago</span>
                                            </div>
                                            <!--end::Name-->
                                        </div>
                                        <!--end::Author-->
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Answers-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5#answers') }}"
                                                class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2">44
                                                Answers</a>
                                            <!--end::Answers-->
                                            <!--begin::Tags-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                                class="btn btn-sm btn-light px-4 me-2">Blazor</a>
                                            <!--end::Tags-->
                                            <!--begin::Upvote-->
                                            <a href="javascript:void(0)" class="btn btn-sm btn-flex btn-light px-3"
                                                data-bs-toggle="tooltip" title="Upvote this question"
                                                data-bs-dismiss="click">3
                                                <i class="ki-duotone ki-black-right fs-3ms-2 me-0 fs-3"></i></a>
                                            <!--end::Upvote-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Foot-->
                                </div>
                                <!--end::Question-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed border-gray-300 my-8"></div>
                                <!--end::Separator-->
                                <!--begin::Question-->
                                <div class="mb-0">
                                    <!--begin::Head-->
                                    <div class="d-flex align-items-center mb-4">
                                        <!--begin::Title-->
                                        <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                            class="fs-2 fw-bold text-gray-900 text-hover-primary me-1">Using Metronic with
                                            .NET
                                            multi tenant application</a>
                                        <!--end::Title-->
                                        <!--begin::Icons-->
                                        <div class="d-flex align-items-center">
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Resolved">
                                                <i class="ki-duotone ki-check-circle text-success fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Icons-->
                                    </div>
                                    <!--end::Head-->
                                    <!--begin::Summary-->
                                    <div class="fs-base fw-normal text-gray-700 mb-4">When approx. is the next update for
                                        the
                                        Laravel version planned? Waiting for the CRUD, 2nd factor etc. features before
                                        starting my
                                        project. Also can we expect the Laravel + Vue version in the next update ?</div>
                                    <!--end::Summary-->
                                    <!--begin::Foot-->
                                    <div class="d-flex flex-stack flex-wrap">
                                        <!--begin::Author-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-2">
                                                <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-10.jpg', $theme_asset_pack ?? null) }}"
                                                    alt="user" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Name-->
                                            <div class="d-flex flex-column align-items-start justify-content-center">
                                                <span class="text-gray-900 fs-7 fw-semibold lh-1 mb-2">Ana Quil</span>
                                                <span class="text-muted fs-8 fw-semibold lh-1">5 days ago</span>
                                            </div>
                                            <!--end::Name-->
                                        </div>
                                        <!--end::Author-->
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center py-1">
                                            <!--begin::Answers-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5#answers') }}"
                                                class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2">2
                                                Answers</a>
                                            <!--end::Answers-->
                                            <!--begin::Tags-->
                                            <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                                class="btn btn-sm btn-light px-4 me-2">Aspdotnet</a>
                                            <!--end::Tags-->
                                            <!--begin::Upvote-->
                                            <a href="javascript:void(0)" class="btn btn-sm btn-flex btn-light px-3"
                                                data-bs-toggle="tooltip" title="Upvote this question"
                                                data-bs-dismiss="click">4
                                                <i class="ki-duotone ki-black-right fs-3ms-2 me-0 fs-3"></i></a>
                                            <!--end::Upvote-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Foot-->
                                </div>
                                <!--end::Question-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed border-gray-300 my-8"></div>
                                <!--end::Separator-->
                            </div>
                            <!--end::Questions-->
                            <!--begin::Pagination-->
                            <div class="d-flex flex-center mb-0">
                                <a href="javascript:void(0)"
                                    class="btn btn-icon btn-light btn-active-light-primary h-30px w-30px fw-semibold fs-6 mx-2">1</a>
                                <a href="javascript:void(0)"
                                    class="btn btn-icon btn-light btn-active-light-primary h-30px w-30px fw-semibold fs-6 mx-2 active">2</a>
                                <a href="javascript:void(0)"
                                    class="btn btn-icon btn-light btn-active-light-primary h-30px w-30px fw-semibold fs-6 mx-2">3</a>
                                <a href="javascript:void(0)"
                                    class="btn btn-icon btn-light btn-active-light-primary h-30px w-30px fw-semibold fs-6 mx-2">4</a>
                                <a href="javascript:void(0)"
                                    class="btn btn-icon btn-light btn-active-light-primary h-30px w-30px fw-semibold fs-6 mx-2">5</a>
                                <span class="text-muted fw-semibold fs-6 mx-2">..</span>
                                <a href="javascript:void(0)"
                                    class="btn btn-icon btn-light btn-active-light-primary h-30px w-30px fw-semibold fs-6 mx-2">19</a>
                            </div>
                            <!--end::Questions-->
                        </div>
                        <!--end::Post-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Sidebar-->
                <div class="sidebar flex-column flex-lg-row-auto w-100 w-lg-275px ms-lg-10 pt-5 pt-lg-11">
                    <!--begin::Quick Search-->
                    <form id="kt_sidebar_search_form" action="{{ url('demo/sepuluhsatu/demo5') }}"
                        class="w-100 position-relative mb-5 mb-lg-10" autocomplete="off">
                        <!--begin::Hidden input(Added to disable form autocomplete)-->
                        <input type="hidden" />
                        <!--end::Hidden input-->
                        <!--begin::Icon-->
                        <i
                            class="ki-duotone ki-magnifier fs-2 text-gray-700 position-absolute top-50 translate-middle-y ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <!--end::Icon-->
                        <!--begin::Input-->
                        <input type="text" class="form-control bg-transparent ps-13 fs-7 h-40px" name="search"
                            value="" placeholder="Search" />
                        <!--end::Input-->
                    </form>
                    <!--end::Quick Search-->
                    <!--begin::Popular Questions-->
                    <div class="card bg-light mb-5 mb-lg-10 shadow-none border-0">
                        <!--begin::Header-->
                        <div class="card-header align-items-center border-0">
                            <!--begin::Title-->
                            <h3 class="card-title fw-bold text-gray-900 fs-3">Popular Questions</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Item-->
                            <div class="d-flex mb-5">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">How to use
                                    Metrponic with Django Framework ?</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex mb-5">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">When to
                                    expect new version of Metronic Laravel ?</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex mb-5">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">Could not
                                    get Metronic Demo 7 working</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex mb-5">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">I
                                    want to
                                    get a refund</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">How to use
                                    Metrponic with Rails Framework ?</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Popular Questions-->
                    <!--begin::Popular Questions-->
                    <div class="card bg-light mb-5 mb-lg-10 shadow-none border-0">
                        <!--begin::Header-->
                        <div class="card-header align-items-center border-0">
                            <!--begin::Title-->
                            <h3 class="card-title fw-bold text-gray-900 fs-3">Latest Tutorials</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Item-->
                            <div class="d-flex mb-5">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">How to use
                                    customize Metronoc's SASS</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex mb-5">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">How to
                                    change web font globally</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex mb-5">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">How to
                                    setup dark mode</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex mb-5">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">Metronic
                                    file structure and build tools</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex">
                                <!--begin::Arrow-->
                                <i class="ki-duotone ki-right-square fs-2 mt-0 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Arrow-->
                                <!--begin::Title-->
                                <a href="{{ url('demo/sepuluhsatu/demo5') }}"
                                    class="text-gray-700 text-hover-primary fs-6 fw-bold">Metronic
                                    integration with Blazor server side</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Popular Questions-->
                </div>
                <!--end::Sidebar-->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/fullcalendar/fullcalendar.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Custom Javascript-->
@endsection
