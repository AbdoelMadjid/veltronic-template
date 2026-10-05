@php
    $authUser = auth()->user();
    $coverBgUrl =
        $authUser?->cover_bg_url ?:
        \App\Support\ThemeAsset::url('media/stock/1600x800/img-1.jpg', $theme_asset_pack ?? null);
    $coverPositionY = (int) ($authUser?->setting('cover_position_y', '30') ?? '30');
    $coverHeight = (int) ($authUser?->setting('cover_height', '250') ?? '250');
    $coverOverlayColor = $authUser?->setting('cover_overlay_color', '#000000') ?? '#000000';
    $coverOverlayOpacity = ((int) ($authUser?->setting('cover_opacity', '60') ?? '60')) / 100;
    $coverBlur = (int) ($authUser?->setting('cover_blur', '0') ?? '0');
    $userName = $authUser?->name ?? 'Pengguna';
    $motoHidup = $authUser?->detail?->moto_hidup ?: 'You sit down. You stare at your screen. The cursor blinks.';
@endphp
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Careers - Apply-->
        <div class="card position-relative overflow-hidden">
            <!--begin::Hero Header Cover (Full Width)-->
            <div class="position-relative overflow-hidden rounded-top p-6 p-lg-10 d-flex flex-column justify-content-end"
                style="min-height: {{ $coverHeight }}px; transition: min-height 0.2s ease;">
                <!-- Cover Background Image -->
                <div class="w-100 h-100 position-absolute top-0 start-0" id="hero_dashboard_cover_bg"
                    style="
                        background-image: url('{{ $coverBgUrl }}');
                        background-size: cover;
                        background-position: center {{ $coverPositionY }}%;
                        background-repeat: no-repeat;
                        {{ $coverBlur > 0 ? 'filter: blur(' . $coverBlur . 'px); -webkit-filter: blur(' . $coverBlur . 'px); transform: scale(1.05);' : '' }}
                        transition: background-image 0.3s ease, background-position 0.1s ease, filter 0.2s ease, transform 0.2s ease;
                    ">
                </div>

                <!-- Adjustable Overlay Layer (Penutup Kontras) -->
                <div class="w-100 h-100 position-absolute top-0 start-0" id="hero_dashboard_cover_overlay"
                    style="
                        background-color: {{ $coverOverlayColor }};
                        opacity: {{ $coverOverlayOpacity }};
                        transition: opacity 0.2s ease, background-color 0.2s ease;
                    ">
                </div>

                <!--begin::Heading-->
                <div class="position-relative text-white d-flex align-items-center flex-wrap flex-sm-nowrap"
                    style="z-index: 2;">
                    <!--begin::Avatar-->
                    <div class="me-5 me-lg-7 mb-3 mb-sm-0">
                        <div class="symbol symbol-70px symbol-lg-90px symbol-fixed position-relative">
                            <div class="symbol-label border border-3 border-body shadow-sm" id="hero_dashboard_avatar"
                                style="{{ user_avatar_style($authUser) }}">
                            </div>
                        </div>
                    </div>
                    <!--end::Avatar-->

                    <!--begin::User Details-->
                    <div class="d-flex flex-column justify-content-center">
                        <!--begin::Title-->
                        <h3 class="text-white fs-2qx fw-bold mb-1" id="hero_dashboard_user_name"
                            style="text-shadow: 0 2px 4px rgba(0,0,0,0.65), 0 0 10px rgba(0,0,0,0.5);">
                            {{ $userName }}
                        </h3>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="fs-5 fw-semibold text-white text-opacity-90" id="hero_dashboard_moto_hidup"
                            style="text-shadow: 0 1px 3px rgba(0,0,0,0.55);">
                            {{ $motoHidup }}
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::User Details-->
                </div>
                <!--end::Heading-->
            </div>
            <!--end::Hero Header Cover (Full Width)-->

            <!--begin::Body-->
            <div class="card-body p-lg-17 pt-lg-12">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row mb-17">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid me-0 me-lg-20">
                        <!--begin::Community & Leaderboard Widgets-->
                        <div class="row g-5 g-xl-8 mb-10">
                            <!--begin::Leaderboard Col-->
                            <div class="col-xl-6">
                                @include('pages.dashboard.partials.widget-user-leaderboard')
                            </div>
                            <!--end::Leaderboard Col-->

                            <!--begin::Live Activity Col-->
                            <div class="col-xl-6">
                                @include('pages.dashboard.partials.widget-live-activity')
                            </div>
                            <!--end::Live Activity Col-->
                        </div>
                        <!--end::Community & Leaderboard Widgets-->

                        <!--begin::Community User Cards (Replaces Junior React Developer & UI/UX Designer)-->
                        @include('pages.dashboard.partials.widget-user-cards')
                        <!--end::Community User Cards-->
                    </div>
                    <!--end::Content-->

                    <!--begin::Sidebar-->
                    <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
                        <!--begin::User Presence & Social Widget-->
                        @include('pages.dashboard.partials.widget-user-presence')
                        <!--end::User Presence & Social Widget-->
                    </div>
                    <!--end::Sidebar-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Careers - Apply-->
    </div>
    <!--end::Content container-->
</div>
