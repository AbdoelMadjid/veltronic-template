<!--begin::Footer Section-->
<div class="mb-0">
    <!--begin::Wrapper-->
    <div class="landing-dark-bg pt-20">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="row py-10 py-lg-20">
                <!--begin::Col-->
                <div class="col-lg-6 pe-lg-16 mb-10 mb-lg-0">
                    <!--begin::Block-->
                    <div class="rounded landing-dark-border p-9 mb-10">
                        <!--begin::Title-->
                        <h2 class="text-white mb-4">Profil & Informasi Aplikasi</h2>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <p class="fw-normal fs-5 text-gray-600 mb-6">
                            {{ $landingConfig['landing_footer_about'] ?? 'Metronic 8 - Solusi template admin modern dan lengkap untuk akselerasi proyek web & aplikasi Anda.' }}
                        </p>
                        @if(!empty($landingConfig['landing_footer_email']))
                            <div class="d-flex align-items-center mb-2">
                                <i class="ki-outline ki-sms fs-4 text-primary me-2"></i>
                                <a href="mailto:{{ $landingConfig['landing_footer_email'] }}" class="text-white opacity-75 text-hover-primary fs-6">
                                    {{ $landingConfig['landing_footer_email'] }}
                                </a>
                            </div>
                        @endif
                        @if(!empty($landingConfig['landing_footer_phone']))
                            <div class="d-flex align-items-center mb-2">
                                <i class="ki-outline ki-phone fs-4 text-success me-2"></i>
                                <span class="text-white opacity-75 fs-6">{{ $landingConfig['landing_footer_phone'] }}</span>
                            </div>
                        @endif
                        @if(!empty($landingConfig['landing_footer_address']))
                            <div class="d-flex align-items-center">
                                <i class="ki-outline ki-geolocation fs-4 text-warning me-2"></i>
                                <span class="text-white opacity-75 fs-6">{{ $landingConfig['landing_footer_address'] }}</span>
                            </div>
                        @endif
                        <!--end::Text-->
                    </div>
                    <!--end::Block-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-6 ps-lg-16">
                    <!--begin::Navs-->
                    <div class="d-flex justify-content-between flex-wrap gap-6">
                        <!--begin::Links-->
                        <div class="d-flex fw-semibold flex-column">
                            <!--begin::Subtitle-->
                            <h4 class="fw-bold text-gray-500 mb-6" data-kt-translate="landing.more_for_metronic">
                                {{ __('landing.more_for_metronic') }}
                            </h4>
                            <!--end::Subtitle-->
                            <!--begin::Link-->
                            <a href="https://keenthemes.com/faqs"
                                class="text-white opacity-50 text-hover-primary fs-5 mb-6" data-kt-translate="landing.faq">{{ __('landing.faq') }}</a>
                            <a href="https://preview.keenthemes.com/html/metronic/docs"
                                class="text-white opacity-50 text-hover-primary fs-5 mb-6" data-kt-translate="landing.documentations">{{ __('landing.documentations') }}</a>
                            <a href="https://www.youtube.com/c/KeenThemesTuts/videos"
                                class="text-white opacity-50 text-hover-primary fs-5 mb-6" data-kt-translate="landing.video_tuts">{{ __('landing.video_tuts') }}</a>
                            <a href="https://devs.keenthemes.com/"
                                class="text-white opacity-50 text-hover-primary fs-5 mb-6" data-kt-translate="landing.support_forum">{{ __('landing.support_forum') }}</a>
                        </div>
                        <!--end::Links-->
                        <!--begin::Links Social-->
                        <div class="d-flex fw-semibold flex-column">
                            <!--begin::Subtitle-->
                            <h4 class="fw-bold text-gray-500 mb-6" data-kt-translate="landing.stay_connected">{{ __('landing.stay_connected') }}</h4>
                            <!--end::Subtitle-->
                            @foreach($landingSocials as $soc)
                                @if(!empty($soc['is_active']) && !empty($soc['url']))
                                    <!--begin::Link-->
                                    <a href="{{ $soc['url'] }}" target="_blank" class="d-flex align-items-center mb-6 text-white opacity-50 text-hover-primary fs-5">
                                        <span class="bullet bullet-dot bg-primary me-2"></span>
                                        <span>{{ $soc['name'] ?? 'Sosial' }}</span>
                                    </a>
                                    <!--end::Link-->
                                @endif
                            @endforeach
                        </div>
                        <!--end::Links Social-->
                    </div>
                    <!--end::Navs-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
        <!--begin::Separator-->
        <div class="landing-dark-separator"></div>
        <!--end::Separator-->
        <!--begin::Container-->
        <div class="container">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                <!--begin::Copyright-->
                <div class="d-flex align-items-center order-2 order-md-1">
                    <!--begin::Logo-->
                    <a href="{{ url('landing') }}">
                        <img alt="Logo" src="{{ $logoLightUrl }}"
                            class="h-15px h-md-20px" />
                    </a>
                    <!--end::Logo image-->
                    <!--begin::Copyright text-->
                    <span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1">
                        &copy; {{ $landingConfig['landing_footer_copyright'] ?? '2025 Keenthemes Inc. Veltronic Template.' }}
                    </span>
                    <!--end::Copyright text-->
                </div>
                <!--end::Copyright-->
                <!--begin::Menu-->
                <ul class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
                    <li class="menu-item">
                        <a href="/" class="menu-link px-2" data-kt-translate="landing.home">{{ __('landing.home') }}</a>
                    </li>
                    <li class="menu-item mx-5">
                        <a href="/#pricing" class="menu-link px-2" data-kt-translate="landing.pricing">{{ __('landing.pricing') }}</a>
                    </li>
                    <li class="menu-item">
                        <a href="/login" class="menu-link px-2" data-kt-translate="landing.login">{{ __('landing.login') }}</a>
                    </li>
                </ul>
                <!--end::Menu-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Footer Section-->
