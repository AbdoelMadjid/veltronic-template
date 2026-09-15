@php
    $isAuth = auth()->check();
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName() ?? '';
    $path = trim(request()->path(), '/');
@endphp

@extends($isAuth ? ($layout ?? 'layouts.index') : 'layouts.index', $isAuth ? [] : ['EmailLayout' => true])

@section('title', getPageTitle())

@section('content')
    @if ($isAuth)
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Card-->
                <div class="card card-flush shadow-sm">
                    <!--begin::Card body-->
                    <div class="card-body p-7 p-lg-12">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-center text-center">
                            <!--begin::Icon-->
                            <div class="mb-5">
                                <div class="symbol symbol-70px symbol-circle bg-light-warning p-3">
                                    <i class="ki-duotone ki-code fs-3x text-warning">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </div>
                            </div>
                            <!--end::Icon-->

                            <!--begin::Title-->
                            <h2 class="fw-bolder fs-2hx text-gray-900 mb-3">
                                {{ __('Modul MVC Belum Diimplementasikan') }}
                            </h2>
                            <!--end::Title-->

                            <!--begin::Description-->
                            <div class="fw-semibold fs-5 text-gray-600 mb-8 max-w-600px">
                                {{ (isset($exception) && $exception->getMessage() && !in_array($exception->getMessage(), ['Not Found', 'The route could not be found.'])) ? $exception->getMessage() : __('Halaman atau fungsionalitas MVC untuk menu ini sedang dalam tahap pengembangan.') }}
                            </div>
                            <!--end::Description-->

                            <!--begin::Info box-->
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 text-start mb-8 mw-650px w-100">
                                <i class="ki-duotone ki-information-5 fs-2tx text-warning me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold mb-2">Informasi Rute & Menu</h4>
                                        <div class="fs-6 text-gray-700">
                                            <div class="mb-1"><span class="fw-bold text-gray-800">URL Path:</span> <code class="text-primary fs-7">/{{ $path }}</code></div>
                                            @if($currentRoute)
                                                <div class="mb-1"><span class="fw-bold text-gray-800">Route Name:</span> <code class="text-primary fs-7">{{ $currentRoute }}</code></div>
                                            @endif
                                            <div><span class="fw-bold text-gray-800">Status:</span> <span class="badge badge-light-warning fw-bold">Under Development / MVC Not Found</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Info box-->

                            <!--begin::Action buttons-->
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                    <i class="ki-duotone ki-home fs-2 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('Kembali ke Dashboard') }}
                                </a>
                                <button type="button" onclick="window.history.back()" class="btn btn-light btn-active-light-primary">
                                    <i class="ki-duotone ki-arrow-left fs-2 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('Halaman Sebelumnya') }}
                                </button>
                            </div>
                            <!--end::Action buttons-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    @else
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <!--begin::Page bg image-->
            <style>
                body {
                    background-image: url('{{ \App\Support\ThemeAsset::url('media/auth/bg1.jpg', $theme_asset_pack ?? null) }}');
                }

                [data-bs-theme="dark"] body {
                    background-image: url('{{ \App\Support\ThemeAsset::url('media/auth/bg1-dark.jpg', $theme_asset_pack ?? null) }}');
                }
            </style>
            <!--end::Page bg image-->
            <!--begin::Authentication - Signup Welcome Message -->
            <div class="d-flex flex-column flex-center flex-column-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center text-center p-10">
                    <!--begin::Wrapper-->
                    <div class="card card-flush w-lg-650px py-5">
                        <div class="card-body py-15 py-lg-20">
                            <!--begin::Title-->
                            <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="fw-semibold fs-6 text-gray-500 mb-7">
                                {{ (isset($exception) && $exception->getMessage()) ? $exception->getMessage() : "We can't find that page." }}
                            </div>
                            <!--end::Text-->
                            <!--begin::Illustration-->
                            <div class="mb-3">
                                <img src="{{ \App\Support\ThemeAsset::url('media/auth/404-error.png', $theme_asset_pack ?? null) }}" class="mw-100 mh-300px theme-light-show"
                                    alt="404 Not Found" />
                                <img src="{{ \App\Support\ThemeAsset::url('media/auth/404-error-dark.png', $theme_asset_pack ?? null) }}" class="mw-100 mh-300px theme-dark-show"
                                    alt="404 Not Found" />
                            </div>
                            <!--end::Illustration-->
                            <!--begin::Link-->
                            <div class="mb-0">
                                <a href="/dashboard" class="btn btn-sm btn-primary">Return Home</a>
                            </div>
                            <!--end::Link-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Authentication - Signup Welcome Message-->
        </div>
        <!--end::Root-->
    @endif
@endsection
