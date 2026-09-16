@php
    $authUser = $user ?? auth()->user();
    $userRoles = $authUser?->roles ?? collect();
    $detailData = $detail ?? ($authUser?->detail ?? null);
    $roleName = $userRoles->first()?->name ? ucfirst($userRoles->first()->name) : 'User';

    // Hitung kelengkapan data KTP & Profil
    $trackedFields = [
        'name' => !empty($authUser?->name),
        'email' => !empty($authUser?->email),
        'avatar' => !empty($authUser?->avatar),
        'nik' => !empty($detailData?->nik),
        'nama_lengkap' => !empty($detailData?->nama_lengkap),
        'tempat_lahir' => !empty($detailData?->tempat_lahir),
        'tanggal_lahir' => !empty($detailData?->tanggal_lahir),
        'jenis_kelamin' => !empty($detailData?->jenis_kelamin),
        'agama' => !empty($detailData?->agama),
        'status_perkawinan' => !empty($detailData?->status_perkawinan),
        'pekerjaan' => !empty($detailData?->pekerjaan),
        'no_hp' => !empty($detailData?->no_hp),
        'foto_ktp' => !empty($detailData?->foto_ktp),
        'alamat_jalan' => !empty($detailData?->alamat_jalan),
        'desa' => !empty($detailData?->desa),
        'kecamatan' => !empty($detailData?->kecamatan),
        'kabupaten' => !empty($detailData?->kabupaten),
        'provinsi' => !empty($detailData?->provinsi),
    ];
    $filledCount = count(array_filter($trackedFields));
    $completionPercent = (int) round(($filledCount / count($trackedFields)) * 100);
@endphp

<div class="d-flex flex-wrap flex-sm-nowrap align-items-center w-100">
    <!--begin: Pic-->
    <div class="me-7 mb-4 mb-sm-0">
        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
            <div class="symbol-label border border-4 border-body shadow-sm" id="profile_header_avatar_img"
                style="{{ user_avatar_style($authUser) }} transition: background-position 0.15s ease, background-size 0.15s ease;">
            </div>
        </div>
    </div>
    <!--end::Pic-->

    <!--begin::Info-->
    <div class="flex-grow-1">
        <!--begin::Title-->
        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
            <!--begin::User-->
            <div class="d-flex flex-column">
                <!--begin::Name-->
                <div class="d-flex align-items-center mb-2">
                    <a href="javascript:void(0)" class="text-white text-hover-primary fs-2 fw-bold me-1" id="profile_header_user_name" style="text-shadow: 0 1px 4px rgba(0,0,0,0.65), 0 0 10px rgba(0,0,0,0.5);">{{ $authUser?->name }}</a>
                    <a href="javascript:void(0)">
                        <i class="ki-duotone ki-verify fs-1 text-primary">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                </div>
                <!--end::Name-->

                <!--begin::Info-->
                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                    <a href="javascript:void(0)"
                        class="d-flex align-items-center text-white text-opacity-90 text-hover-primary me-5 mb-2" style="text-shadow: 0 1px 3px rgba(0,0,0,0.55);">
                        <i class="ki-duotone ki-profile-circle fs-4 me-1 text-white text-opacity-90">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i><span id="profile_header_role_name">{{ $roleName }}</span></a>
                    <a href="javascript:void(0)"
                        class="d-flex align-items-center text-white text-opacity-90 text-hover-primary mb-2" style="text-shadow: 0 1px 3px rgba(0,0,0,0.55);">
                        <i class="ki-duotone ki-sms fs-4 me-1 text-white text-opacity-90">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i><span id="profile_header_user_email">{{ $authUser?->email }}</span></a>
                </div>
                <!--end::Info-->
            </div>
            <!--end::User-->

            <!--begin::Actions-->
            <div class="d-flex my-4">
                <a href="javascript:void(0)" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                    <i class="ki-duotone ki-check fs-3 d-none"></i>
                    <!--begin::Indicator label-->
                    <span class="indicator-label">Follow</span>
                    <!--end::Indicator label-->
                    <!--begin::Indicator progress-->
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    <!--end::Indicator progress-->
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_offer_a_deal">Hire Me</a>
                <!--begin::Menu-->
                <div class="me-0">
                    <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-solid ki-dots-horizontal fs-2x"></i>
                    </button>
                    <!--begin::Menu 3-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                        data-kt-menu="true">
                        <!--begin::Heading-->
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                Payments
                            </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3">Create Invoice</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link flex-stack px-3">Create Payment
                                <span class="ms-2" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference">
                                    <i class="ki-duotone ki-information fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i> </span></a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3">Generate Bill</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                            data-kt-menu-placement="right-end">
                            <a href="javascript:void(0)" class="menu-link px-3">
                                <span class="menu-title">Subscription</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3">Plans</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3">Billing</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3">Statements</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content px-3">
                                        <!--begin::Switch-->
                                        <label
                                            class="form-check form-switch form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input w-30px h-20px"
                                                type="checkbox" value="1" checked="checked"
                                                name="notifications" />
                                            <!--end::Input-->
                                            <!--end::Label-->
                                            <span
                                                class="form-check-label text-muted fs-6">Recuring</span>
                                            <!--end::Label-->
                                        </label>
                                        <!--end::Switch-->
                                    </div>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-1">
                            <a href="javascript:void(0)" class="menu-link px-3">Settings</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu 3-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Title-->

        <!--begin::Stats-->
        <div class="d-flex flex-wrap flex-stack">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-grow-1 pe-8">
                <!--begin::Stats-->
                <div class="d-flex flex-wrap">
                    <!--begin::Stat-->
                    <div
                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3 bg-body bg-opacity-75 backdrop-blur-sm shadow-xs">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                data-kt-countup-value="4500" data-kt-countup-prefix="$">
                                0
                            </div>
                        </div>
                        <!--end::Number-->
                        <!--begin::Label-->
                        <div class="fw-semibold fs-6 text-gray-600">
                            Earnings
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Stat-->

                    <!--begin::Stat-->
                    <div
                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3 bg-body bg-opacity-75 backdrop-blur-sm shadow-xs">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                data-kt-countup-value="80">
                                0
                            </div>
                        </div>
                        <!--end::Number-->
                        <!--begin::Label-->
                        <div class="fw-semibold fs-6 text-gray-600">
                            Projects
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Stat-->

                    <!--begin::Stat-->
                    <div
                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3 bg-body bg-opacity-75 backdrop-blur-sm shadow-xs">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                data-kt-countup-value="60" data-kt-countup-prefix="%">
                                0
                            </div>
                        </div>
                        <!--end::Number-->
                        <!--begin::Label-->
                        <div class="fw-semibold fs-6 text-gray-600">
                            Success Rate
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Stat-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Progress-->
            <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3 bg-body bg-opacity-75 backdrop-blur-sm rounded p-3 border border-gray-300 border-dashed shadow-xs">
                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                    <span class="fw-semibold fs-6 text-gray-600">Profile Compleation</span>
                    <span class="fw-bold fs-6" id="profile_completion_badge" data-kt-countup="true" data-kt-countup-value="{{ $completionPercent }}" data-kt-countup-suffix="%">{{ $completionPercent }}%</span>
                </div>
                <div class="h-5px mx-3 w-100 bg-light mb-1">
                    <div class="bg-success rounded h-5px" id="profile_completion_bar" role="progressbar" style="width: {{ $completionPercent }}%; transition: width 0.6s ease-in-out;"
                        aria-valuenow="{{ $completionPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end::Progress-->
        </div>
        <!--end::Stats-->
    </div>
    <!--end::Info-->
</div>
