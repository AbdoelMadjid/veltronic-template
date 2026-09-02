@php($vars = $vars ?? [])
<!--begin::List Widget 2-->
<div class="{{ $vars['card_class'] ?? 'card h-md-100' }}">
    <!--begin::Header-->
    <div class="card-header border-0">
        <h3 class="card-title fw-bold text-gray-900">Authors</h3>
        <div class="card-toolbar">
            <!--begin::Menu-->
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
                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator mb-3 opacity-75"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $vars['menu_ticket_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">New Ticket</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $vars['menu_customer_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">New Customer</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                    data-kt-menu-placement="right-start">
                    <!--begin::Menu item-->
                    <a href="{{ $vars['menu_group_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">
                        <span class="menu-title">New Group</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--end::Menu item-->
                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ $vars['menu_admin_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">Admin Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ $vars['menu_staff_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">Staff Group</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ $vars['menu_member_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">Member Group</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu sub-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ $vars['menu_contact_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}" class="menu-link px-3">New Contact</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator mt-3 opacity-75"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content px-3 py-3">
                        <a class="btn btn-primary btn-sm px-4" href="{{ $vars['menu_report_href'] ?? ($vars['menu_href'] ?? 'javascript:void(0)') }}">Generate
                            Reports</a>
                    </div>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu 2-->
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-2">
        <!--begin::Item-->
        <div class="d-flex align-items-center mb-7">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img src="{{ $vars['avatar_1_src'] ?? \App\Support\ThemeAsset::url('media/avatars/300-6.jpg', $theme_asset_pack ?? null) }}"
                    class="" alt="" />
            </div>
            <!--end::Avatar-->
            <!--begin::Text-->
            <div class="flex-grow-1">
                <a href="{{ $vars['author_1_href'] ?? ($vars['item_href'] ?? 'javascript:void(0)') }}"
                    class="text-gray-900 fw-bold text-hover-primary fs-6">Emma Smith</a>
                <span class="text-muted d-block fw-bold">Project Manager</span>
            </div>
            <!--end::Text-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="d-flex align-items-center mb-7">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img src="{{ $vars['avatar_2_src'] ?? \App\Support\ThemeAsset::url('media/avatars/300-5.jpg', $theme_asset_pack ?? null) }}"
                    class="" alt="" />
            </div>
            <!--end::Avatar-->
            <!--begin::Text-->
            <div class="flex-grow-1">
                <a href="{{ $vars['author_2_href'] ?? ($vars['item_href'] ?? 'javascript:void(0)') }}"
                    class="text-gray-900 fw-bold text-hover-primary fs-6">Sean Bean</a>
                <span class="text-muted d-block fw-bold">PHP, SQLite, Artisan CLI</span>
            </div>
            <!--end::Text-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="d-flex align-items-center mb-7">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img src="{{ $vars['avatar_3_src'] ?? \App\Support\ThemeAsset::url('media/avatars/300-11.jpg', $theme_asset_pack ?? null) }}"
                    class="" alt="" />
            </div>
            <!--end::Avatar-->
            <!--begin::Text-->
            <div class="flex-grow-1">
                <a href="{{ $vars['author_3_href'] ?? ($vars['item_href'] ?? 'javascript:void(0)') }}"
                    class="text-gray-900 fw-bold text-hover-primary fs-6">Brian Cox</a>
                <span class="text-muted d-block fw-bold">PHP, SQLite, Artisan CLI</span>
            </div>
            <!--end::Text-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="d-flex align-items-center mb-7">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img src="{{ $vars['avatar_4_src'] ?? \App\Support\ThemeAsset::url('media/avatars/300-9.jpg', $theme_asset_pack ?? null) }}"
                    class="" alt="" />
            </div>
            <!--end::Avatar-->
            <!--begin::Text-->
            <div class="flex-grow-1">
                <a href="{{ $vars['author_4_href'] ?? ($vars['item_href'] ?? 'javascript:void(0)') }}"
                    class="text-gray-900 fw-bold text-hover-primary fs-6">Francis
                    Mitcham</a>
                <span class="text-muted d-block fw-bold">PHP, SQLite, Artisan CLI</span>
            </div>
            <!--end::Text-->
        </div>
        <!--end::Item-->
        <!--begin::Item-->
        <div class="d-flex align-items-center">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img src="{{ $vars['avatar_5_src'] ?? \App\Support\ThemeAsset::url('media/avatars/300-23.jpg', $theme_asset_pack ?? null) }}"
                    class="" alt="" />
            </div>
            <!--end::Avatar-->
            <!--begin::Text-->
            <div class="flex-grow-1">
                <a href="{{ $vars['author_5_href'] ?? ($vars['item_href'] ?? 'javascript:void(0)') }}" class="text-gray-900 fw-bold text-hover-primary fs-6">Dan
                    Wilson</a>
                <span class="text-muted d-block fw-bold">PHP, SQLite, Artisan CLI</span>
            </div>
            <!--end::Text-->
        </div>
        <!--end::Item-->
    </div>
    <!--end::Body-->
</div>
<!--end::List Widget 2-->
