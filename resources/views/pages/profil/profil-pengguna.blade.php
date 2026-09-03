@extends('layouts.index')
@section('title', 'Profil Pengguna')
@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endsection
@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Profil
        @endslot
    @endcomponent
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    @include('pages.profil.partials.details')
                    <!--end::Details-->
                    <!--begin::Navs-->
                    @include('pages.profil.partials.navs', ['active' => 'overview'])
                    <!--end::Navs-->
                </div>
            </div>
            <!--end::Navbar-->

            <!--begin::Tab Content-->
            <div class="tab-content" id="kt_user_profile_tabs">
                <!--begin:::Tab pane overview-->
                <div class="tab-pane fade show active" id="kt_user_profile_tab_overview" role="tabpanel">
                    @include('pages.profil.partials.tabs.overview')
                </div>
                <!--end:::Tab pane overview-->

                <!--begin:::Tab pane settings-->
                <div class="tab-pane fade" id="kt_user_profile_tab_settings" role="tabpanel">
                    @include('pages.profil.partials.tabs.settings')
                </div>
                <!--end:::Tab pane settings-->

                <!--begin:::Tab pane security-->
                <div class="tab-pane fade" id="kt_user_profile_tab_security" role="tabpanel">
                    @include('pages.profil.partials.tabs.security')
                </div>
                <!--end:::Tab pane security-->

                <!--begin:::Tab pane activity-->
                <div class="tab-pane fade" id="kt_user_profile_tab_activity" role="tabpanel">
                    @include('pages.profil.partials.tabs.activity')
                </div>
                <!--end:::Tab pane activity-->

                <!--begin:::Tab pane billing-->
                <div class="tab-pane fade" id="kt_user_profile_tab_billing" role="tabpanel">
                    @include('pages.profil.partials.tabs.billing')
                </div>
                <!--end:::Tab pane billing-->

                <!--begin:::Tab pane statements-->
                <div class="tab-pane fade" id="kt_user_profile_tab_statements" role="tabpanel">
                    @include('pages.profil.partials.tabs.statements')
                </div>
                <!--end:::Tab pane statements-->

                <!--begin:::Tab pane referrals-->
                <div class="tab-pane fade" id="kt_user_profile_tab_referrals" role="tabpanel">
                    @include('pages.profil.partials.tabs.referrals')
                </div>
                <!--end:::Tab pane referrals-->

                <!--begin:::Tab pane api-keys-->
                <div class="tab-pane fade" id="kt_user_profile_tab_api_keys" role="tabpanel">
                    @include('pages.profil.partials.tabs.api-keys')
                </div>
                <!--end:::Tab pane api-keys-->

                <!--begin:::Tab pane logs-->
                <div class="tab-pane fade" id="kt_user_profile_tab_logs" role="tabpanel">
                    @include('pages.profil.partials.tabs.logs')
                </div>
                <!--end:::Tab pane logs-->
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Content container-->
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/pages/user-profile/general.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/account/settings/signin-methods.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/account/settings/profile-details.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/account/settings/deactivate-account.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/account/security/security-summary.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/account/security/license-usage.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/account/billing/general.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/account/api-keys/api-keys.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/account/referrals/referral-program.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-app.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/new-card.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/new-address.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/two-factor-authentication.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/offer-a-deal/type.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/offer-a-deal/details.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/offer-a-deal/finance.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/offer-a-deal/complete.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/offer-a-deal/main.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Custom Javascript-->
@endsection
