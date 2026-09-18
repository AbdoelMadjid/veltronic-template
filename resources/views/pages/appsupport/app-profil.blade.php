@extends('layouts.index')

@section('toolbar')
    @include('layouts.partials._toolbar', [
        'action' => view()->make('layouts.partials._action-petunjuk-button', [
            'targetModal' => '#kt_modal_app_profil_petunjuk',
            'title' => 'Petunjuk Operasional Pengaturan Profil & Identitas Dashboard',
        ]),
    ])
@endsection

@section('styles')
    <style>
        /* Live Google Search Preview card styling */
        .google-preview-card {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
            border-radius: 0.75rem;
            padding: 1.25rem;
            font-family: Arial, sans-serif;
        }

        .google-preview-url {
            color: #202124;
            font-size: 0.85rem;
            line-height: 1.3;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            word-break: break-all;
        }

        [data-bs-theme="dark"] .google-preview-url {
            color: #bdc1c6;
        }

        .google-preview-title {
            color: #1a0dab;
            font-size: 1.2rem;
            line-height: 1.4;
            text-decoration: none;
            cursor: pointer;
            font-weight: 400;
        }

        [data-bs-theme="dark"] .google-preview-title {
            color: #8ab4f8;
        }

        .google-preview-desc {
            color: #4d5156;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-top: 0.35rem;
        }

        [data-bs-theme="dark"] .google-preview-desc {
            color: #bdc1c6;
        }

        /* Live Social Card Preview */
        .social-preview-card {
            border: 1px solid var(--bs-border-color);
            border-radius: 0.75rem;
            overflow: hidden;
            background-color: var(--bs-body-bg);
        }

        .social-preview-img {
            background: linear-gradient(135deg, #1e1e2d 0%, #2a2a3c 100%);
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        /* Logo Preview Containers */
        .logo-preview-box-light {
            background-color: #f8f9fa;
            border: 2px dashed #e4e6ef;
            border-radius: 0.75rem;
            min-height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .logo-preview-box-dark {
            background-color: #1e1e2d;
            border: 2px dashed #323248;
            border-radius: 0.75rem;
            min-height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .favicon-preview-box {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            border: 1px solid var(--bs-border-color);
            background-color: var(--bs-body-bg);
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!--begin::Overview Header Banner-->
            @include('pages.appsupport.partials.app-profil.header-banner')
            <!--end::Overview Header Banner-->

            <!--begin::Navs Card-->
            <div class="card card-flush shadow-sm border-0 mb-6">
                <div class="card-header border-0 pt-2 px-6">
                    @include('pages.appsupport.partials.app-profil.navs', ['active' => 'meta'])
                </div>
            </div>
            <!--end::Navs Card-->

            <!--begin::Tab Content-->
            <div class="tab-content" id="kt_app_profil_tabs">
                <!--begin:::Tab pane meta-->
                <div class="tab-pane fade show active" id="kt_app_profil_tab_meta" role="tabpanel">
                    @include('pages.appsupport.partials.app-profil.tabs.meta')
                </div>
                <!--end:::Tab pane meta-->

                <!--begin:::Tab pane logo-->
                <div class="tab-pane fade" id="kt_app_profil_tab_logo" role="tabpanel">
                    @include('pages.appsupport.partials.app-profil.tabs.logo')
                </div>
                <!--end:::Tab pane logo-->

                <!--begin:::Tab pane footer-->
                <div class="tab-pane fade" id="kt_app_profil_tab_footer" role="tabpanel">
                    @include('pages.appsupport.partials.app-profil.tabs.footer')
                </div>
                <!--end:::Tab pane footer-->

                <!--begin:::Tab pane overview-->
                <div class="tab-pane fade" id="kt_app_profil_tab_overview" role="tabpanel">
                    @include('pages.appsupport.partials.app-profil.tabs.overview')
                </div>
                <!--end:::Tab pane overview-->
            </div>
            <!--end::Tab Content-->

            <!--begin::Modals-->
            @include('pages.appsupport.partials.app-profil.modals.app-profil-petunjuk')
            <!--end::Modals-->

        </div>
        <!--end::Content container-->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/appsupport/app-profil.js') }}"></script>
@endsection
