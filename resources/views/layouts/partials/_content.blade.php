@php
$authUser = auth()->user();
$coverBgUrl = $authUser?->cover_bg_url ?: \App\Support\ThemeAsset::url('media/stock/1600x800/img-1.jpg',
$theme_asset_pack ?? null);
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
                <div class="position-relative text-white d-flex align-items-center flex-wrap flex-sm-nowrap"
                    style="z-index: 2;">
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
                        <h3 class="text-white fs-2qx fw-bold mb-1"
                            style="text-shadow: 0 2px 4px rgba(0,0,0,0.65), 0 0 10px rgba(0,0,0,0.5);">
                            {{ $userName }}
                        </h3>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="fs-5 fw-semibold text-white text-opacity-90"
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
                                <!--begin::Feeds Widget 3-->
                                <div class="card mb-5 mb-xxl-8">
                                    <!--begin::Body-->
                                    <div class="card-body pb-0">
                                        <!--begin::Header-->
                                        <div class="d-flex align-items-center mb-3">
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center flex-grow-1">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px me-5">
                                                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-21.jpg', $theme_asset_pack ?? null) }}"
                                                        alt="" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="text-gray-900 text-hover-primary fs-6 fw-bold">Carles
                                                        Nilson</a>
                                                    <span class="text-gray-500 fw-bold">Yestarday at 5:06 PM</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Menu-->
                                            <div class="my-0">
                                                <button type="button"
                                                    class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="ki-duotone ki-category fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                    </i>
                                                </button>
                                                <!--begin::Menu 2-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                                    data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">
                                                            Quick Actions</div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mb-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" class="menu-link px-3">New
                                                            Ticket</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" class="menu-link px-3">New
                                                            Customer</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                        data-kt-menu-placement="right-start">
                                                        <!--begin::Menu item-->
                                                        <a href="javascript:void(0)" class="menu-link px-3">
                                                            <span class="menu-title">New Group</span>
                                                            <span class="menu-arrow"></span>
                                                        </a>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu sub-->
                                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0)"
                                                                    class="menu-link px-3">Admin Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0)"
                                                                    class="menu-link px-3">Staff Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0)"
                                                                    class="menu-link px-3">Member Group</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu sub-->
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" class="menu-link px-3">New
                                                            Contact</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator mt-3 opacity-75"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3 py-3">
                                                            <a class="btn btn-primary btn-sm px-4"
                                                                href="javascript:void(0)">Generate Reports</a>
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu 2-->
                                            </div>
                                            <!--end::Menu-->
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Post-->
                                        <div class="mb-7">
                                            <!--begin::Text-->
                                            <div class="text-gray-800 mb-5">Outlines keep you honest. They stop you from
                                                indulging in poorly thought-out
                                                metaphors about driving and keep you focused on the overall structure of
                                                your post</div>
                                            <!--end::Text-->
                                            <!--begin::Toolbar-->
                                            <div class="d-flex align-items-center mb-5">
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4">
                                                    <i class="ki-duotone ki-message-text-2 fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>12</a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                                    <i class="ki-duotone ki-heart fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>150</a>
                                            </div>
                                            <!--end::Toolbar-->
                                        </div>
                                        <!--end::Post-->
                                        <!--begin::Replies-->
                                        <div class="mb-7">
                                            <!--begin::Reply-->
                                            <div class="d-flex mb-5">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px me-5">
                                                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-14.jpg', $theme_asset_pack ?? null) }}"
                                                        alt="" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column flex-row-fluid">
                                                    <!--begin::Info-->
                                                    <div class="d-flex align-items-center flex-wrap mb-1">
                                                        <a href="javascript:void(0)"
                                                            class="text-gray-800 text-hover-primary fw-bold me-2">Alice
                                                            Danchik</a>
                                                        <span class="text-gray-500 fw-semibold fs-7">1 day</span>
                                                        <a href="javascript:void(0)"
                                                            class="ms-auto text-gray-500 text-hover-primary fw-semibold fs-7">Reply</a>
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Post-->
                                                    <span class="text-gray-800 fs-7 fw-normal pt-1">Long before you sit
                                                        dow to put digital pen to paper
                                                        you need to make sure you have to sit down and write.</span>
                                                    <!--end::Post-->
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Reply-->
                                            <!--begin::Reply-->
                                            <div class="d-flex">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px me-5">
                                                    <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-9.jpg', $theme_asset_pack ?? null) }}"
                                                        alt="" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column flex-row-fluid">
                                                    <!--begin::Info-->
                                                    <div class="d-flex align-items-center flex-wrap mb-1">
                                                        <a href="javascript:void(0)"
                                                            class="text-gray-800 text-hover-primary fw-bold me-2">Harris
                                                            Bold</a>
                                                        <span class="text-gray-500 fw-semibold fs-7">2 days</span>
                                                        <a href="javascript:void(0)"
                                                            class="ms-auto text-gray-500 text-hover-primary fw-semibold fs-7">Reply</a>
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Post-->
                                                    <span class="text-gray-800 fs-7 fw-normal pt-1">Outlines keep you
                                                        honest. They stop you from
                                                        indulging in poorly</span>
                                                    <!--end::Post-->
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Reply-->
                                        </div>
                                        <!--end::Replies-->
                                        <!--begin::Separator-->
                                        <div class="separator mb-4"></div>
                                        <!--end::Separator-->
                                        <!--begin::Reply input-->
                                        <form class="position-relative mb-6">
                                            <textarea class="form-control border-0 p-0 pe-10 resize-none min-h-25px"
                                                data-kt-autosize="true" rows="1" placeholder="Reply.."></textarea>
                                            <div class="position-absolute top-0 end-0 me-n5">
                                                <span class="btn btn-icon btn-sm btn-active-color-primary pe-0 me-2">
                                                    <i class="ki-duotone ki-paper-clip fs-2 mb-3"></i>
                                                </span>
                                                <span class="btn btn-icon btn-sm btn-active-color-primary ps-0">
                                                    <i class="ki-duotone ki-geolocation fs-2 mb-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                            </div>
                                        </form>
                                        <!--edit::Reply input-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Feeds Widget 3-->

                            </div>
                            <!--end::Description-->
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

                        </div>
                        <!--end::Job-->
                        <!--begin::Feeds Widget 3-->
                        <div class="card mb-5 mb-xxl-8">
                            <!--begin::Body-->
                            <div class="card-body pb-0">
                                <!--begin::Header-->
                                <div class="d-flex align-items-center mb-3">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-21.jpg', $theme_asset_pack ?? null) }}"
                                                alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <a href="javascript:void(0)"
                                                class="text-gray-900 text-hover-primary fs-6 fw-bold">Carles Nilson</a>
                                            <span class="text-gray-500 fw-bold">Yestarday at 5:06 PM</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Menu-->
                                    <div class="my-0">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-duotone ki-category fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                    Actions</div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0)" class="menu-link px-3">New Ticket</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0)" class="menu-link px-3">New Customer</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-start">
                                                <!--begin::Menu item-->
                                                <a href="javascript:void(0)" class="menu-link px-3">
                                                    <span class="menu-title">New Group</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" class="menu-link px-3">Admin
                                                            Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" class="menu-link px-3">Staff
                                                            Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" class="menu-link px-3">Member
                                                            Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0)" class="menu-link px-3">New Contact</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4"
                                                        href="javascript:void(0)">Generate Reports</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Post-->
                                <div class="mb-7">
                                    <!--begin::Text-->
                                    <div class="text-gray-800 mb-5">Outlines keep you honest. They stop you from
                                        indulging in poorly thought-out
                                        metaphors about driving and keep you focused on the overall structure of your
                                        post</div>
                                    <!--end::Text-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center mb-5">
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4">
                                            <i class="ki-duotone ki-message-text-2 fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>12</a>
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                            <i class="ki-duotone ki-heart fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>150</a>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Post-->
                                <!--begin::Replies-->
                                <div class="mb-7">
                                    <!--begin::Reply-->
                                    <div class="d-flex mb-5">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-14.jpg', $theme_asset_pack ?? null) }}"
                                                alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column flex-row-fluid">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center flex-wrap mb-1">
                                                <a href="javascript:void(0)"
                                                    class="text-gray-800 text-hover-primary fw-bold me-2">Alice
                                                    Danchik</a>
                                                <span class="text-gray-500 fw-semibold fs-7">1 day</span>
                                                <a href="javascript:void(0)"
                                                    class="ms-auto text-gray-500 text-hover-primary fw-semibold fs-7">Reply</a>
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Post-->
                                            <span class="text-gray-800 fs-7 fw-normal pt-1">Long before you sit dow to
                                                put digital pen to paper
                                                you need to make sure you have to sit down and write.</span>
                                            <!--end::Post-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Reply-->
                                    <!--begin::Reply-->
                                    <div class="d-flex">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="{{ \App\Support\ThemeAsset::url('media/avatars/300-9.jpg', $theme_asset_pack ?? null) }}"
                                                alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column flex-row-fluid">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center flex-wrap mb-1">
                                                <a href="javascript:void(0)"
                                                    class="text-gray-800 text-hover-primary fw-bold me-2">Harris
                                                    Bold</a>
                                                <span class="text-gray-500 fw-semibold fs-7">2 days</span>
                                                <a href="javascript:void(0)"
                                                    class="ms-auto text-gray-500 text-hover-primary fw-semibold fs-7">Reply</a>
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Post-->
                                            <span class="text-gray-800 fs-7 fw-normal pt-1">Outlines keep you honest.
                                                They stop you from
                                                indulging in poorly</span>
                                            <!--end::Post-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Reply-->
                                </div>
                                <!--end::Replies-->
                                <!--begin::Separator-->
                                <div class="separator mb-4"></div>
                                <!--end::Separator-->
                                <!--begin::Reply input-->
                                <form class="position-relative mb-6">
                                    <textarea class="form-control border-0 p-0 pe-10 resize-none min-h-25px"
                                        data-kt-autosize="true" rows="1" placeholder="Reply.."></textarea>
                                    <div class="position-absolute top-0 end-0 me-n5">
                                        <span class="btn btn-icon btn-sm btn-active-color-primary pe-0 me-2">
                                            <i class="ki-duotone ki-paper-clip fs-2 mb-3"></i>
                                        </span>
                                        <span class="btn btn-icon btn-sm btn-active-color-primary ps-0">
                                            <i class="ki-duotone ki-geolocation fs-2 mb-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                </form>
                                <!--edit::Reply input-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feeds Widget 3-->
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
                                        <a href="/apps/projects/users" class="text-gray-700 text-hover-primary">Jane
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
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image: url('{{ \App\Support\ThemeAsset::url('media/stock/600x400/img-74.jpg', $theme_asset_pack ?? null) }}');">
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
                                        <a href="/apps/projects/users" class="text-gray-700 text-hover-primary">Cris
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
                                        <a href="/apps/projects/users" class="text-gray-700 text-hover-primary">Carles
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
            </div>
            <!--end::Body-->
        </div>
        <!--end::Careers - Apply-->
    </div>
    <!--end::Content container-->
</div>
