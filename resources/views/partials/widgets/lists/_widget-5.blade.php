@php
    $listsWidget5Variant = $listsWidget5Variant ?? null
@endphp
@if ($listsWidget5Variant === 'a')
<div class="card card-xl-stretch mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bold mb-2 text-gray-900">Activities</span>
            <span class="text-muted fw-semibold fs-7">890,344 Sales</span>
        </h3>
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-category fs-6">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            </button>
            <!--begin::Menu 1-->
            @include('partials.menus._menu-1')
            <!--end::Menu 1-->
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-5">
        <!--begin::Timeline-->
        <div class="timeline-label">
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">08:42</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-warning fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Text-->
                <div class="fw-mormal timeline-content text-muted ps-3">Outlines keep you honest. And
                    keep structure</div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">10:00</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-success fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Content-->
                <div class="timeline-content d-flex">
                    <span class="fw-bold text-gray-800 ps-3">AEOL meeting</span>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">14:37</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-danger fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Desc-->
                <div class="timeline-content fw-bold text-gray-800 ps-3">Make deposit
                    <a href="javascript:void(0)" class="text-primary">USD 700</a>. to ESL
                </div>
                <!--end::Desc-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-primary fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Text-->
                <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and
                    keep structure keep great</div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-danger fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Desc-->
                <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                    <a href="javascript:void(0)" class="text-primary">#XF-2356</a>.
                </div>
                <!--end::Desc-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-primary fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Text-->
                <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and
                    keep structure keep great</div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-danger fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Desc-->
                <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                    <a href="javascript:void(0)" class="text-primary">#XF-2356</a>.
                </div>
                <!--end::Desc-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">10:30</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-success fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Text-->
                <div class="timeline-content fw-mormal text-muted ps-3">Finance KPI Mobile app launch
                    preparion meeting</div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
        </div>
        <!--end::Timeline-->
    </div>
    <!--end: Card Body-->
</div>

@elseif ($listsWidget5Variant === 'b')
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bold mb-2 text-gray-900">Activities</span>
            <span class="text-muted fw-semibold fs-7">890,344 Sales</span>
        </h3>
        <div class="card-toolbar">
            <!--begin::Menu-->
            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-category fs-6">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            </button>
            <!--begin::Menu 1-->
            @include('partials.menus._menu-1')
            <!--end::Menu 1-->
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-5">
        <!--begin::Timeline-->
        <div class="timeline-label">
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">08:42</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-warning fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Text-->
                <div class="fw-mormal timeline-content text-muted ps-3">Outlines keep you honest. And
                    keep structure</div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">10:00</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-success fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Content-->
                <div class="timeline-content d-flex">
                    <span class="fw-bold text-gray-800 ps-3">AEOL meeting</span>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">14:37</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-danger fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Desc-->
                <div class="timeline-content fw-bold text-gray-800 ps-3">Make deposit
                    <a href="javascript:void(0)" class="text-primary">USD 700</a>. to ESL
                </div>
                <!--end::Desc-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-primary fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Text-->
                <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and
                    keep structure keep great</div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-danger fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Desc-->
                <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                    <a href="javascript:void(0)" class="text-primary">#XF-2356</a>.
                </div>
                <!--end::Desc-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-primary fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Text-->
                <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and
                    keep structure keep great</div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-danger fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Desc-->
                <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                    <a href="javascript:void(0)" class="text-primary">#XF-2356</a>.
                </div>
                <!--end::Desc-->
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="timeline-item">
                <!--begin::Label-->
                <div class="timeline-label fw-bold text-gray-800 fs-6">10:30</div>
                <!--end::Label-->
                <!--begin::Badge-->
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-success fs-1"></i>
                </div>
                <!--end::Badge-->
                <!--begin::Text-->
                <div class="timeline-content fw-mormal text-muted ps-3">Finance KPI Mobile app launch
                    preparion meeting</div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
        </div>
        <!--end::Timeline-->
    </div>
    <!--end: Card Body-->
</div>

@else
<!--begin::List widget 5-->
<div class="card card-flush h-xl-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-900">Product Delivery</span>
			<span class="text-gray-500 mt-1 fw-semibold fs-6">1M Products Shipped so far</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="{{ url('apps/ecommerce/sales/details') }}" class="btn btn-sm btn-light">Order Details</a>
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body">
		<!--begin::Scroll-->
		<div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
			<!--begin::Item-->
			<div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
				<!--begin::Info-->
				<div class="d-flex flex-stack mb-3">
					<!--begin::Wrapper-->
					<div class="me-3">
						<!--begin::Icon-->
						<img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/210.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1 me-1" alt="" />
						<!--end::Icon-->
						<!--begin::Title-->
						<a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
							class="text-gray-800 text-hover-primary fw-bold">Elephant 1802</a>
						<!--end::Title-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Action-->
					<div class="m-0">
						<!--begin::Menu-->
						<button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
							data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
							data-kt-menu-overflow="true">
							<i class="ki-duotone ki-dots-square fs-1">
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
						</div>
						<!--end::Menu 2-->
						<!--end::Menu-->
					</div>
					<!--end::Action-->
				</div>
				<!--end::Info-->
				<!--begin::Customer-->
				<div class="d-flex flex-stack">
					<!--begin::Name-->
					<span class="text-gray-500 fw-bold">To:
						<a href="{{ url('apps/ecommerce/sales/details') }}"
							class="text-gray-800 text-hover-primary fw-bold">Jason Bourne</a></span>
					<!--end::Name-->
					<!--begin::Label-->
					<span class="badge badge-light-success">Delivered</span>
					<!--end::Label-->
				</div>
				<!--end::Customer-->
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
				<!--begin::Info-->
				<div class="d-flex flex-stack mb-3">
					<!--begin::Wrapper-->
					<div class="me-3">
						<!--begin::Icon-->
						<img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/209.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1 me-1" alt="" />
						<!--end::Icon-->
						<!--begin::Title-->
						<a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
							class="text-gray-800 text-hover-primary fw-bold">RiseUP</a>
						<!--end::Title-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Action-->
					<div class="m-0">
						<!--begin::Menu-->
						<button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
							data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
							data-kt-menu-overflow="true">
							<i class="ki-duotone ki-dots-square fs-1">
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
						</div>
						<!--end::Menu 2-->
						<!--end::Menu-->
					</div>
					<!--end::Action-->
				</div>
				<!--end::Info-->
				<!--begin::Customer-->
				<div class="d-flex flex-stack">
					<!--begin::Name-->
					<span class="text-gray-500 fw-bold">To:
						<a href="{{ url('apps/ecommerce/sales/details') }}"
							class="text-gray-800 text-hover-primary fw-bold">Marie Durant</a></span>
					<!--end::Name-->
					<!--begin::Label-->
					<span class="badge badge-light-primary">Shipping</span>
					<!--end::Label-->
				</div>
				<!--end::Customer-->
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
				<!--begin::Info-->
				<div class="d-flex flex-stack mb-3">
					<!--begin::Wrapper-->
					<div class="me-3">
						<!--begin::Icon-->
						<img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/214.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1 me-1" alt="" />
						<!--end::Icon-->
						<!--begin::Title-->
						<a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
							class="text-gray-800 text-hover-primary fw-bold">Yellow Stone</a>
						<!--end::Title-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Action-->
					<div class="m-0">
						<!--begin::Menu-->
						<button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
							data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
							data-kt-menu-overflow="true">
							<i class="ki-duotone ki-dots-square fs-1">
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
						</div>
						<!--end::Menu 2-->
						<!--end::Menu-->
					</div>
					<!--end::Action-->
				</div>
				<!--end::Info-->
				<!--begin::Customer-->
				<div class="d-flex flex-stack">
					<!--begin::Name-->
					<span class="text-gray-500 fw-bold">To:
						<a href="{{ url('apps/ecommerce/sales/details') }}" class="text-gray-800 text-hover-primary fw-bold">Dan
							Wilson</a></span>
					<!--end::Name-->
					<!--begin::Label-->
					<span class="badge badge-light-danger">Confirmed</span>
					<!--end::Label-->
				</div>
				<!--end::Customer-->
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
				<!--begin::Info-->
				<div class="d-flex flex-stack mb-3">
					<!--begin::Wrapper-->
					<div class="me-3">
						<!--begin::Icon-->
						<img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/211.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1 me-1" alt="" />
						<!--end::Icon-->
						<!--begin::Title-->
						<a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
							class="text-gray-800 text-hover-primary fw-bold">Elephant 1802</a>
						<!--end::Title-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Action-->
					<div class="m-0">
						<!--begin::Menu-->
						<button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
							data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
							data-kt-menu-overflow="true">
							<i class="ki-duotone ki-dots-square fs-1">
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
						</div>
						<!--end::Menu 2-->
						<!--end::Menu-->
					</div>
					<!--end::Action-->
				</div>
				<!--end::Info-->
				<!--begin::Customer-->
				<div class="d-flex flex-stack">
					<!--begin::Name-->
					<span class="text-gray-500 fw-bold">To:
						<a href="{{ url('apps/ecommerce/sales/details') }}"
							class="text-gray-800 text-hover-primary fw-bold">Lebron Wayde</a></span>
					<!--end::Name-->
					<!--begin::Label-->
					<span class="badge badge-light-success">Delivered</span>
					<!--end::Label-->
				</div>
				<!--end::Customer-->
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
				<!--begin::Info-->
				<div class="d-flex flex-stack mb-3">
					<!--begin::Wrapper-->
					<div class="me-3">
						<!--begin::Icon-->
						<img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/215.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1 me-1" alt="" />
						<!--end::Icon-->
						<!--begin::Title-->
						<a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
							class="text-gray-800 text-hover-primary fw-bold">RiseUP</a>
						<!--end::Title-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Action-->
					<div class="m-0">
						<!--begin::Menu-->
						<button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
							data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
							data-kt-menu-overflow="true">
							<i class="ki-duotone ki-dots-square fs-1">
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
						</div>
						<!--end::Menu 2-->
						<!--end::Menu-->
					</div>
					<!--end::Action-->
				</div>
				<!--end::Info-->
				<!--begin::Customer-->
				<div class="d-flex flex-stack">
					<!--begin::Name-->
					<span class="text-gray-500 fw-bold">To:
						<a href="{{ url('apps/ecommerce/sales/details') }}" class="text-gray-800 text-hover-primary fw-bold">Ana
							Simmons</a></span>
					<!--end::Name-->
					<!--begin::Label-->
					<span class="badge badge-light-primary">Shipping</span>
					<!--end::Label-->
				</div>
				<!--end::Customer-->
			</div>
			<!--end::Item-->
			<!--begin::Item-->
			<div class="border border-dashed border-gray-300 rounded px-7 py-3">
				<!--begin::Info-->
				<div class="d-flex flex-stack mb-3">
					<!--begin::Wrapper-->
					<div class="me-3">
						<!--begin::Icon-->
						<img src="{{ \App\Support\ThemeAsset::url('media/stock/ecommerce/192.png', $theme_asset_pack ?? null) }}" class="w-50px ms-n1 me-1" alt="" />
						<!--end::Icon-->
						<!--begin::Title-->
						<a href="{{ url('apps/ecommerce/catalog/edit-product') }}"
							class="text-gray-800 text-hover-primary fw-bold">Yellow Stone</a>
						<!--end::Title-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Action-->
					<div class="m-0">
						<!--begin::Menu-->
						<button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
							data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
							data-kt-menu-overflow="true">
							<i class="ki-duotone ki-dots-square fs-1">
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
						</div>
						<!--end::Menu 2-->
						<!--end::Menu-->
					</div>
					<!--end::Action-->
				</div>
				<!--end::Info-->
				<!--begin::Customer-->
				<div class="d-flex flex-stack">
					<!--begin::Name-->
					<span class="text-gray-500 fw-bold">To:
						<a href="{{ url('apps/ecommerce/sales/details') }}"
							class="text-gray-800 text-hover-primary fw-bold">Kevin Leonard</a></span>
					<!--end::Name-->
					<!--begin::Label-->
					<span class="badge badge-light-danger">Confirmed</span>
					<!--end::Label-->
				</div>
				<!--end::Customer-->
			</div>
			<!--end::Item-->
		</div>
		<!--end::Scroll-->
	</div>
	<!--end::Body-->
</div>
<!--end::List widget 5-->

@endif
