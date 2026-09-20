@extends('layouts.index')

@section('title', 'Pengaturan Tema Halaman Depan')

@section('toolbar')
    @include('layouts.partials._toolbar', [
        'action' => view()->make('layouts.partials._action-petunjuk-button', [
            'targetModal' => '#kt_modal_theme_frontpage_petunjuk',
            'title' => 'Petunjuk Operasional Pengaturan Tema Halaman Depan',
        ]),
    ])
@endsection

@section('styles')
    <style>
        .landing-menu-row.dragging, .landing-section-row.dragging {
            opacity: 0.5;
            background-color: var(--bs-light-primary);
        }
        .w-fit {
            width: fit-content;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!--begin::Overview Header Banner-->
            @include('pages.appsupport.partials.theme-frontpage.header-banner')
            <!--end::Overview Header Banner-->

            <!--begin::Navs Card-->
            <div class="card card-flush shadow-sm border-0 mb-6">
                <div class="card-header border-0 pt-2 px-4 px-md-6">
                    @include('pages.appsupport.partials.theme-frontpage.navs', ['active' => 'theme'])
                </div>
            </div>
            <!--end::Navs Card-->

            <!--begin::Tab Content-->
            <div class="tab-content" id="kt_theme_frontpage_tabs">
                <!--begin:::Tab pane Theme Switcher-->
                <div class="tab-pane fade show active" id="kt_theme_tab_switcher" role="tabpanel">
                    @include('pages.appsupport.partials.theme-frontpage.tabs.theme-switcher')
                </div>
                <!--end:::Tab pane Theme Switcher-->

                <!--begin:::Tab pane Hero & Branding-->
                <div class="tab-pane fade" id="kt_theme_tab_hero" role="tabpanel">
                    @include('pages.appsupport.partials.theme-frontpage.tabs.hero')
                </div>
                <!--end:::Tab pane Hero & Branding-->

                <!--begin:::Tab pane Menu Navigasi-->
                <div class="tab-pane fade" id="kt_theme_tab_menu" role="tabpanel">
                    @include('pages.appsupport.partials.theme-frontpage.tabs.menu')
                </div>
                <!--end:::Tab pane Menu Navigasi-->

                <!--begin:::Tab pane Sections Konten-->
                <div class="tab-pane fade" id="kt_theme_tab_sections" role="tabpanel">
                    @include('pages.appsupport.partials.theme-frontpage.tabs.sections')
                </div>
                <!--end:::Tab pane Sections Konten-->

                <!--begin:::Tab pane Footer & Kontak-->
                <div class="tab-pane fade" id="kt_theme_tab_footer" role="tabpanel">
                    @include('pages.appsupport.partials.theme-frontpage.tabs.footer')
                </div>
                <!--end:::Tab pane Footer & Kontak-->

                <!--begin:::Tab pane Pratinjau-->
                <div class="tab-pane fade" id="kt_theme_tab_preview" role="tabpanel">
                    @include('pages.appsupport.partials.theme-frontpage.tabs.preview')
                </div>
                <!--end:::Tab pane Pratinjau-->
            </div>
            <!--end::Tab Content-->

            <!--begin::Modals-->
            @include('pages.appsupport.partials.theme-frontpage.modals.menu-form-modal')
            @include('pages.appsupport.partials.theme-frontpage.modals.section-form-modal')
            @include('pages.appsupport.partials.theme-frontpage.modals.section-code-modal')
            @include('pages.appsupport.partials.theme-frontpage.modals.theme-frontpage-petunjuk')
            <!--end::Modals-->

        </div>
        <!--end::Content container-->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/appsupport/theme-frontpage.js') }}"></script>
@endsection
