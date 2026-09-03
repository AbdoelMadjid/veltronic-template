@extends('layouts.index', ['EmailLayout' => true])

@section('title', '403 Forbidden')

@section('content')
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
        <!--begin::Authentication - Access Denied -->
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center text-center p-10">
                <!--begin::Wrapper-->
                <div class="card card-flush w-lg-650px py-5">
                    <div class="card-body py-15 py-lg-20">
                        <!--begin::Title-->
                        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Akses Ditolak!</h1>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="fw-semibold fs-6 text-gray-500 mb-7">
                            {{ (isset($exception) && $exception->getMessage()) ? $exception->getMessage() : 'Anda tidak memiliki hak akses untuk halaman ini atau role/izin belum dikonfigurasi.' }}
                        </div>
                        <!--end::Text-->
                        <!--begin::Illustration-->
                        <div class="mb-3">
                            <img src="{{ \App\Support\ThemeAsset::url('media/auth/404-error.png', $theme_asset_pack ?? null) }}" class="mw-100 mh-300px theme-light-show"
                                alt="403 Forbidden" />
                            <img src="{{ \App\Support\ThemeAsset::url('media/auth/404-error-dark.png', $theme_asset_pack ?? null) }}" class="mw-100 mh-300px theme-dark-show"
                                alt="403 Forbidden" />
                        </div>
                        <!--end::Illustration-->
                        <!--begin::Link-->
                        <div class="mb-0">
                            <a href="/dashboard" class="btn btn-sm btn-primary">Kembali ke Dashboard</a>
                        </div>
                        <!--end::Link-->
                    </div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Access Denied-->
    </div>
    <!--end::Root-->
@endsection
