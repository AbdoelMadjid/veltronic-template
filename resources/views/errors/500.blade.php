@php
    $isAuth = auth()->check();
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName() ?? '';
    $path = trim(request()->path(), '/');
@endphp

@extends($isAuth ? ($layout ?? 'layouts.index') : 'layouts.index', $isAuth ? [] : ['EmailLayout' => true])

@section('title', getPageTitle() ?: '500 Server Error')

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
                                <div class="symbol symbol-70px symbol-circle bg-light-danger p-3">
                                    <i class="ki-duotone ki-cross-circle fs-3x text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <!--end::Icon-->

                            <!--begin::Title-->
                            <h2 class="fw-bolder fs-2hx text-gray-900 mb-3">
                                {{ __('Terjadi Kesalahan Server (500 Error)') }}
                            </h2>
                            <!--end::Title-->

                            <!--begin::Description-->
                            <div class="fw-semibold fs-5 text-gray-600 mb-8 max-w-600px">
                                {{ (isset($exception) && $exception->getMessage()) ? $exception->getMessage() : __('Terjadi kesalahan internal pada sistem. Silakan coba beberapa saat lagi.') }}
                            </div>
                            <!--end::Description-->

                            <!--begin::Info box-->
                            <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6 text-start mb-8 mw-650px w-100">
                                <i class="ki-duotone ki-information-5 fs-2tx text-danger me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold mb-2">Informasi Rute</h4>
                                        <div class="fs-6 text-gray-700">
                                            <div class="mb-1"><span class="fw-bold text-gray-800">URL Path:</span> <code class="text-danger fs-7">/{{ $path }}</code></div>
                                            @if($currentRoute)
                                                <div class="mb-1"><span class="fw-bold text-gray-800">Route Name:</span> <code class="text-danger fs-7">{{ $currentRoute }}</code></div>
                                            @endif
                                            <div><span class="fw-bold text-gray-800">Status:</span> <span class="badge badge-light-danger fw-bold">500 Internal Server Error</span></div>
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
                    background-image: url('{{ \App\Support\ThemeAsset::url('media/auth/bg7.jpg', $theme_asset_pack ?? null) }}');
                }

                [data-bs-theme="dark"] body {
                    background-image: url('{{ \App\Support\ThemeAsset::url('media/auth/bg7-dark.jpg', $theme_asset_pack ?? null) }}');
                }
            </style>
            <!--end::Page bg image-->
            <!--begin::Authentication - Server Error -->
            <div class="d-flex flex-column flex-center flex-column-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center text-center p-10">
                    <!--begin::Wrapper-->
                    <div class="card card-flush w-lg-650px py-5">
                        <div class="card-body py-15 py-lg-20">
                            <!--begin::Title-->
                            <h1 class="fw-bolder fs-2qx text-gray-900 mb-4">System Error</h1>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="fw-semibold fs-6 text-gray-500 mb-7">
                                Something went wrong! Please try again later.
                            </div>
                            <!--end::Text-->
                            <!--begin::Illustration-->
                            <div class="mb-11">
                                <img src="{{ \App\Support\ThemeAsset::url('media/auth/500-error.png', $theme_asset_pack ?? null) }}" class="mw-100 mh-300px theme-light-show"
                                    alt="500 Error" />
                                <img src="{{ \App\Support\ThemeAsset::url('media/auth/500-error-dark.png', $theme_asset_pack ?? null) }}" class="mw-100 mh-300px theme-dark-show"
                                    alt="500 Error" />
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
            <!--end::Authentication - Server Error-->
        </div>
        <!--end::Root-->
    @endif
@endsection
