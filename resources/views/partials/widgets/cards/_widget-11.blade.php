@php
    $widget11Variant = $widget11Variant ?? 'default';
    $widget11Defaults = [
        'default' => [
            'cardStyle' => 'background-color: #F6E5CA',
            'title' => 'Bitcoin',
            'subtitle' => '36,668 USD for 1 BTC',
            'image' => 'media/svg/shapes/bitcoin.svg',
            'amount' => '0.44554576 BTC',
            'amountUsd' => '19,335,45 USD',
            'buttonClass' => 'btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end',
            'buttonStyle' => null,
            'buttonIconClass' => 'ki-outline ki-dots-square fs-1 text-gray-500 me-n1',
        ],
        'a' => [
            'cardStyle' => 'background-color: #f3d6ef',
            'title' => 'Etherium',
            'subtitle' => '325,035 USD for 1 ETH',
            'image' => 'media/svg/shapes/ethereum.svg',
            'amount' => '29.33460000 ETH',
            'amountUsd' => '7,336,00 USD',
            'buttonClass' => 'btn btn-icon justify-content-end',
            'buttonStyle' => null,
            'buttonIconClass' => 'ki-duotone ki-dots-square fs-1',
        ],
        'b' => [
            'cardStyle' => 'background-color: #bfdde3',
            'title' => 'Dogecoin',
            'subtitle' => '0.12,045 USD for 1 DOGE',
            'image' => 'media/svg/shapes/dogecoin.svg',
            'amount' => '4703.7589 DOGE',
            'amountUsd' => '503,005,56 USD',
            'buttonClass' => 'btn btn-icon justify-content-end',
            'buttonStyle' => null,
            'buttonIconClass' => 'ki-duotone ki-dots-square fs-1',
        ],
    ];
    $widget11Preset = $widget11Defaults[$widget11Variant] ?? $widget11Defaults['default'];

    $widget11CardClass = $widget11CardClass ?? 'card card-flush h-xl-100';
    $widget11CardStyle = $widget11CardStyle ?? $widget11Preset['cardStyle'];
    $widget11Title = $widget11Title ?? $widget11Preset['title'];
    $widget11Subtitle = $widget11Subtitle ?? $widget11Preset['subtitle'];
    $widget11Image = $widget11Image ?? $widget11Preset['image'];
    $widget11Amount = $widget11Amount ?? $widget11Preset['amount'];
    $widget11AmountUsd = $widget11AmountUsd ?? $widget11Preset['amountUsd'];
    $widget11ButtonClass = $widget11ButtonClass ?? $widget11Preset['buttonClass'];
    $widget11ButtonStyle = $widget11ButtonStyle ?? $widget11Preset['buttonStyle'];
    $widget11ButtonIconClass = $widget11ButtonIconClass ?? $widget11Preset['buttonIconClass'];
@endphp
<!--begin::Card widget 11-->
<div class="{{ $widget11CardClass }}" style="{{ $widget11CardStyle }}">
    <!--begin::Header-->
    <div class="card-header flex-nowrap pt-5">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-4 text-gray-800">{{ $widget11Title }}</span>
            <span class="mt-1 fw-semibold fs-7">{{ $widget11Subtitle }}</span>
        </h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button class="{{ $widget11ButtonClass }}" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true"
                @if ($widget11ButtonStyle) style="{{ $widget11ButtonStyle }}" @endif>
                @if (str_contains($widget11ButtonIconClass, 'ki-duotone'))
                    <i class="{{ $widget11ButtonIconClass }}">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                @else
                    <i class="{{ $widget11ButtonIconClass }}"></i>
                @endif
            </button>
            <!--begin::Menu 2-->
            @include('partials.menus._menu-2')
            {{-- 
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
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
                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
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
                            <a href="javascript:void(0)" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3">Member Group</a>
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
                        <a class="btn btn-primary btn-sm px-4" href="javascript:void(0)">Generate Reports</a>
                    </div>
                </div>
                <!--end::Menu item-->
            </div> --}}
            <!--end::Menu 2-->
            <!--end::Menu-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body text-center pt-5">
        <!--begin::Image-->
        <img src="{{ \App\Support\ThemeAsset::url($widget11Image, $theme_asset_pack ?? null) }}"
            class="h-125px mb-5" alt="" />
        <!--end::Image-->
        <!--begin::Section-->
        <div class="text-start">
            <span class="d-block fw-bold fs-1 text-gray-800">{{ $widget11Amount }}</span>
            <span class="mt-1 fw-semibold fs-3">{{ $widget11AmountUsd }}</span>
        </div>
        <!--end::Section-->
    </div>
    <!--end::Body-->
</div>
<!--end::Card widget 11-->
