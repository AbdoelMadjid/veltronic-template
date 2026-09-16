@php
    $authUser = auth()->user();
    $coverBgUrl = $authUser?->cover_bg_url ?: \App\Support\ThemeAsset::url('media/stock/1600x800/img-1.jpg', $theme_asset_pack ?? null);
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
                    <div class="w-100 h-100 position-absolute top-0 start-0" style="
                        background-image: url('{{ $coverBgUrl }}');
                        background-size: cover;
                        background-position: center {{ $coverPositionY }}%;
                        background-repeat: no-repeat;
                        {{ $coverBlur > 0 ? 'filter: blur('.$coverBlur.'px); -webkit-filter: blur('.$coverBlur.'px); transform: scale(1.05);' : '' }}
                        transition: background-image 0.3s ease, background-position 0.1s ease, filter 0.2s ease, transform 0.2s ease;
                    "></div>

                    <!-- Adjustable Overlay Layer (Penutup Kontras) -->
                    <div class="w-100 h-100 position-absolute top-0 start-0" style="
                        background-color: {{ $coverOverlayColor }};
                        opacity: {{ $coverOverlayOpacity }};
                        transition: opacity 0.2s ease, background-color 0.2s ease;
                    "></div>

                    <!--begin::Heading-->
                    <div class="position-relative text-white d-flex align-items-center flex-wrap flex-sm-nowrap" style="z-index: 2;">
                        <!--begin::Avatar-->
                        <div class="me-5 me-lg-7 mb-3 mb-sm-0">
                            <div class="symbol symbol-70px symbol-lg-90px symbol-fixed position-relative">
                                <div class="symbol-label border border-3 border-body shadow-sm"
                                    style="{{ user_avatar_style($authUser) }}">
                                </div>
                            </div>
                        </div>
                        <!--end::Avatar-->

                        <!--begin::User Details-->
                        <div class="d-flex flex-column justify-content-center">
                            <!--begin::Title-->
                            <h3 class="text-white fs-2qx fw-bold mb-1" style="text-shadow: 0 2px 4px rgba(0,0,0,0.65), 0 0 10px rgba(0,0,0,0.5);">
                                {{ $userName }}
                            </h3>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="fs-5 fw-semibold text-white text-opacity-90" style="text-shadow: 0 1px 3px rgba(0,0,0,0.55);">
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
                            <!--begin::Job-->
                            <div class="mb-17">
                                <!--begin::Description-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <h4 class="fs-1 text-gray-800 w-bolder mb-6">
                                        Junior React Developer
                                    </h4>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                        First, a disclaimer – the entire process of
                                        writing a blog post often takes more than a
                                        couple of hours, even if you can type eighty
                                        words as per minute and your writing skills are
                                        sharp.
                                    </p>
                                    <!--end::Text-->
                                </div>
                                <!--end::Description-->
                                <!--begin::Accordion-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_1_1">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                            Requirements
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_1_1" class="collapse show fs-6 ms-1">
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with REST API
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Git knowledge is a plus
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_1_2">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                            What is your job role?
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_1_2" class="collapse fs-6 ms-1">
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with REST API
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Git knowledge is a plus
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_1_3">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                            Job Candidate Benefits
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_1_3" class="collapse fs-6 ms-1">
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with REST API
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Git knowledge is a plus
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_1_4">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                            Application Terms
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_1_4" class="collapse fs-6 ms-1">
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with REST API
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Git knowledge is a plus
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                <!--end::Accordion-->
                                <!--begin::Apply-->
                                <a href="/pages/general/careers/apply" class="btn btn-sm btn-primary mt-5">Apply
                                    Now</a>
                                <!--end::Apply-->
                            </div>
                            <!--end::Job-->
                            <!--begin::Job-->
                            <div class="mb-10 mb-lg-0">
                                <!--begin::Description-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <h4 class="fs-1 text-gray-800 w-bolder mb-6">
                                        UI/UX Designer
                                    </h4>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                        First, a disclaimer – the entire process of
                                        writing a blog post often takes more than a
                                        couple of hours, even if you can type eighty
                                        words as per minute and your writing skills are
                                        sharp.
                                    </p>
                                    <!--end::Text-->
                                </div>
                                <!--end::Description-->
                                <!--begin::Accordion-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_2_1">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                            Requirements
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_2_1" class="collapse show fs-6 ms-1">
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with REST API
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Git knowledge is a plus
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_2_2">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                            What is your job role?
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_2_2" class="collapse fs-6 ms-1">
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with REST API
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Git knowledge is a plus
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_2_3">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                            Job Candidate Benefits
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_2_3" class="collapse fs-6 ms-1">
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with REST API
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Git knowledge is a plus
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_2_4">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                            Application Terms
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_2_4" class="collapse fs-6 ms-1">
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10 mb-n1">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with REST API
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="mb-4">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center ps-10">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Git knowledge is a plus
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                <!--end::Accordion-->
                                <!--begin::Apply-->
                                <a href="/pages/general/careers/apply" class="btn btn-sm btn-primary mt-5">Apply
                                    Now</a>
                                <!--end::Apply-->
                            </div>
                            <!--end::Job-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Sidebar-->
                        <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
                            <!--begin::Careers about-->
                            <div class="card bg-light">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Top-->
                                    <div class="mb-7">
                                        <!--begin::Title-->
                                        <h2 class="fs-1 text-gray-800 w-bolder mb-6">
                                            About Us
                                        </h2>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <p class="fw-semibold fs-6 text-gray-600">
                                            First, a disclaimer – the entire process of
                                            writing a blog post often takes more than a
                                            couple of hours, even if you can type eighty
                                            words as per minute and your writing skills
                                            are sharp.
                                        </p>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Top-->
                                    <!--begin::Item-->
                                    <div class="mb-8">
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 w-bolder mb-0">
                                            Requirements
                                        </h4>
                                        <!--end::Title-->
                                        <!--begin::Section-->
                                        <div class="my-2">
                                            <!--begin::Row-->
                                            <div class="d-flex align-items-center mb-3">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="d-flex align-items-center mb-3">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="d-flex align-items-center mb-3">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-8">
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 w-bolder mb-0">
                                            Our Achievements
                                        </h4>
                                        <!--end::Title-->
                                        <!--begin::Section-->
                                        <div class="my-2">
                                            <!--begin::Row-->
                                            <div class="d-flex align-items-center mb-3">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with JavaScript
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="d-flex align-items-center mb-3">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Good time-management skills
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="d-flex align-items-center mb-3">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with React
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Bullet-->
                                                <span class="bullet me-3"></span>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-600 fw-semibold fs-6">
                                                    Experience with HTML / CSS
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Link-->
                                    <a href="/pages/general/blog/post" class="link-primary fs-6 fw-semibold">Explore
                                        More</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Careers about-->
                        </div>
                        <!--end::Sidebar-->
                    </div>
                    <!--end::Layout-->
                    <!--begin::Section-->
                    <div class="mb-19">
                        <!--begin::Top-->
                        <div class="text-center mb-12">
                            <!--begin::Title-->
                            <h3 class="fs-2hx text-gray-900 mb-5">
                                Publications
                            </h3>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="fs-5 text-muted fw-semibold">
                                Our goal is to provide a complete and robust theme
                                solution <br />to boost all of our customer’s
                                project deployments
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Top-->
                        <!--begin::Row-->
                        <div class="row g-10">
                            <!--begin::Col-->
                            <div class="col-md-4">
                                <!--begin::Publications post-->
                                <div class="card-xl-stretch me-md-6">
                                    <!--begin::Overlay-->
                                    <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales"
                                        href="{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-73.jpg', $theme_asset_pack ?? null) }}">
                                        <!--begin::Image-->
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                            style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-73.jpg', $theme_asset_pack ?? null) }}');">
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Action-->
                                        <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                            <i class="ki-duotone ki-eye fs-2x text-white"></i>
                                        </div>
                                        <!--end::Action-->
                                    </a>
                                    <!--end::Overlay-->
                                    <!--begin::Body-->
                                    <div class="m-0">
                                        <!--begin::Title-->
                                        <a href="/pages/general/user-profile/overview"
                                            class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">Admin
                                            Panel
                                            - How To Started the Dashboard
                                            Tutorial</a>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <div class="fw-semibold fs-5 text-gray-600 text-gray-900 mt-3 mb-5">
                                            We’ve been focused on making a the from also
                                            not been afraid to and step away been focused
                                            create eye
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::Content-->
                                        <div class="fs-6 fw-bold">
                                            <!--begin::Author-->
                                            <a href="/apps/projects/users"
                                                class="text-gray-700 text-hover-primary">Jane
                                                Miller</a>
                                            <!--end::Author-->
                                            <!--begin::Date-->
                                            <span class="text-muted">on Mar 21 2021</span>
                                            <!--end::Date-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Publications post-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4">
                                <!--begin::Publications post-->
                                <div class="card-xl-stretch mx-md-3">
                                    <!--begin::Overlay-->
                                    <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales"
                                        href="{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-74.jpg', $theme_asset_pack ?? null) }}">
                                        <!--begin::Image-->
                                        <div
                                            class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-74.jpg', $theme_asset_pack ?? null) }}');">
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Action-->
                                        <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                            <i class="ki-duotone ki-eye fs-2x text-white"></i>
                                        </div>
                                        <!--end::Action-->
                                    </a>
                                    <!--end::Overlay-->
                                    <!--begin::Body-->
                                    <div class="m-0">
                                        <!--begin::Title-->
                                        <a href="/pages/general/user-profile/overview"
                                            class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">Admin
                                            Panel
                                            - How To Started the Dashboard
                                            Tutorial</a>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <div class="fw-semibold fs-5 text-gray-600 text-gray-900 mt-3 mb-5">
                                            We’ve been focused on making the from v4 to v5
                                            but we have also not been afraid to step away
                                            been focused
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::Content-->
                                        <div class="fs-6 fw-bold">
                                            <!--begin::Author-->
                                            <a href="/apps/projects/users"
                                                class="text-gray-700 text-hover-primary">Cris
                                                Morgan</a>
                                            <!--end::Author-->
                                            <!--begin::Date-->
                                            <span class="text-muted">on Apr 14 2021</span>
                                            <!--end::Date-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Publications post-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4">
                                <!--begin::Publications post-->
                                <div class="card-xl-stretch ms-md-6">
                                    <!--begin::Overlay-->
                                    <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales"
                                        href="{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-47.jpg', $theme_asset_pack ?? null) }}">
                                        <!--begin::Image-->
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                            style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-47.jpg', $theme_asset_pack ?? null) }}');">
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Action-->
                                        <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                            <i class="ki-duotone ki-eye fs-2x text-white"></i>
                                        </div>
                                        <!--end::Action-->
                                    </a>
                                    <!--end::Overlay-->
                                    <!--begin::Body-->
                                    <div class="m-0">
                                        <!--begin::Title-->
                                        <a href="/pages/general/user-profile/overview"
                                            class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">Admin
                                            Panel
                                            - How To Started the Dashboard
                                            Tutorial</a>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <div class="fw-semibold fs-5 text-gray-600 text-gray-900 mt-3 mb-5">
                                            We’ve been focused on making the from v4 to v5
                                            but we’ve also not been afraid to step away
                                            been focused
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::Content-->
                                        <div class="fs-6 fw-bold">
                                            <!--begin::Author-->
                                            <a href="/apps/projects/users"
                                                class="text-gray-700 text-hover-primary">Carles
                                                Nilson</a>
                                            <!--end::Author-->
                                            <!--begin::Date-->
                                            <span class="text-muted">on May 14 2021</span>
                                            <!--end::Date-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Publications post-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Card-->
                    <div class="card mb-4 bg-light text-center">
                        <!--begin::Body-->
                        <div class="card-body py-12">
                            <!--begin::Icon-->
                            <a href="javascript:void(0)" class="mx-4">
                                <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/facebook-4.svg', $theme_asset_pack ?? null) }}"
                                    class="h-30px my-2" alt="" />
                            </a>
                            <!--end::Icon-->
                            <!--begin::Icon-->
                            <a href="javascript:void(0)" class="mx-4">
                                <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/instagram-2-1.svg', $theme_asset_pack ?? null) }}"
                                    class="h-30px my-2" alt="" />
                            </a>
                            <!--end::Icon-->
                            <!--begin::Icon-->
                            <a href="javascript:void(0)" class="mx-4">
                                <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/github.svg', $theme_asset_pack ?? null) }}"
                                    class="h-30px my-2" alt="" />
                            </a>
                            <!--end::Icon-->
                            <!--begin::Icon-->
                            <a href="javascript:void(0)" class="mx-4">
                                <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/behance.svg', $theme_asset_pack ?? null) }}"
                                    class="h-30px my-2" alt="" />
                            </a>
                            <!--end::Icon-->
                            <!--begin::Icon-->
                            <a href="javascript:void(0)" class="mx-4">
                                <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/pinterest-p.svg', $theme_asset_pack ?? null) }}"
                                    class="h-30px my-2" alt="" />
                            </a>
                            <!--end::Icon-->
                            <!--begin::Icon-->
                            <a href="javascript:void(0)" class="mx-4">
                                <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/twitter.svg', $theme_asset_pack ?? null) }}"
                                    class="h-30px my-2" alt="" />
                            </a>
                            <!--end::Icon-->
                            <!--begin::Icon-->
                            <a href="javascript:void(0)" class="mx-4">
                                <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/dribbble-icon-1.svg', $theme_asset_pack ?? null) }}"
                                    class="h-30px my-2" alt="" />
                            </a>
                            <!--end::Icon-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Careers - Apply-->
        </div>
        <!--end::Content container-->
    </div>
