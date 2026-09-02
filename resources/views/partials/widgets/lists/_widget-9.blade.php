@php
    $listsWidget9Variant = $listsWidget9Variant ?? null
@endphp
@if ($listsWidget9Variant === 'a')
<div class="card card-xl-stretch mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header py-7">
        <!--begin::Statistics-->
        <div class="m-0">
            <!--begin::Heading-->
            <div class="d-flex align-items-center mb-2">
                <!--begin::Title-->
                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">5,037</span>
                <!--end::Title-->
                <!--begin::Label-->
                <span class="badge badge-light-success fs-base">
                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                        <span class="path1"></span>
                        <span class="path2"></span> </i>2.2%</span>
                <!--end::Label-->
            </div>
            <!--end::Heading-->
            <!--begin::Description-->
            <span class="fs-6 fw-semibold text-gray-500">Visits by Social Networks</span>
            <!--end::Description-->
        </div>
        <!--end::Statistics-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <!--begin::Menu-->
            @include('partials.general._button-2')
            <!--begin::Menu 2-->
            @include('partials.menus._menu-5')
            <!--end::Menu 2-->
            <!--end::Menu-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body card-body d-flex justify-content-between flex-column pt-3">
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/dribbble-icon-1.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Dribbble</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Community</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">579</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span> </i>2.6%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/linkedin-1.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Linked
                        In</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Social
                        Media</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">1,088</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-danger fs-base">
                            <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span> </i>0.4%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/slack-icon.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Slack</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Messanger</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">794</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span> </i>0.2%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/youtube-3.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">YouTube</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Video
                        Channel</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">978</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span> </i>4.1%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/instagram-2-1.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Instagram</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Social
                        Network</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">1,458</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span> </i>8.3%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
    </div>
    <!--end::Body-->
</div>

@else
@php
    $listWidget9Variant = $listWidget9Variant ?? 'default';
@endphp
@if ($listWidget9Variant === 'analytics')
    @include('partials.widgets.lists._widget-9', ['listsWidget9Variant' => 'a'])
@else
<!--begin::List widget 9-->
<div class="card card-flush h-xl-100">
    <!--begin::Header-->
    <div class="card-header py-7">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-800">Social Network Visits</span>
            <span class="text-gray-500 mt-1 fw-semibold fs-6">8k social visitors</span>
        </h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <a href="javascript:void(0)" class="btn btn-sm btn-light">View All</a>
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body card-body d-flex justify-content-between flex-column pt-3">
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/dribbble-icon-1.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Dribbble</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Community</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">579</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>2.6%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/linkedin-1.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Linked In</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Social Media</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">2,588</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-danger fs-base">
                            <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>0.4%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/slack-icon.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Slack</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Messanger</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">794</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>0.2%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/youtube-3.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">YouTube</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Video Channel</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">1,578</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>4.1%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/instagram-2-1.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Instagram</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Social Network</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">3,458</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>8.3%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-3"></div>
        <!--end::Separator-->
        <!--begin::Item-->
        <div class="d-flex flex-stack">
            <!--begin::Flag-->
            <img src="{{ \App\Support\ThemeAsset::url('media/svg/brand-logos/facebook-3.svg', $theme_asset_pack ?? null) }}" class="me-4 w-30px" style="border-radius: 4px"
                alt="" />
            <!--end::Flag-->
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">
                <!--begin::Content-->
                <div class="me-5">
                    <!--begin::Title-->
                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary fs-6">Facebook</a>
                    <!--end::Title-->
                    <!--begin::Desc-->
                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Social Network</span>
                    <!--end::Desc-->
                </div>
                <!--end::Content-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Number-->
                    <span class="text-gray-800 fw-bold fs-4 me-3">2,047</span>
                    <!--end::Number-->
                    <!--begin::Info-->
                    <div class="m-0">
                        <!--begin::Label-->
                        <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>1.9%</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Item-->
    </div>
    <!--end::Body-->
</div>
<!--end::List widget 9-->
@endif

@endif
