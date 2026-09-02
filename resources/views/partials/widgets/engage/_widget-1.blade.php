@php
    $engageWidget1Variant = $engageWidget1Variant ?? null
@endphp
@if ($engageWidget1Variant === 'a')
<!--begin::Engage widget 1-->
<div class="card h-md-100" dir="ltr">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column flex-center">
        <!--begin::Heading-->
        <div class="mb-2">
            <!--begin::Title-->
            <h1 class="fw-semibold text-gray-800 text-center lh-lg">
                Have you tried <br /> new
                <span class="fw-bolder"> Invoice Manager ?</span>
            </h1>
            <!--end::Title-->
            <!--begin::Illustration-->
            <div class="py-10 text-center">
                <img src="{{ \App\Support\ThemeAsset::url('media/svg/illustrations/easy/2.svg', $theme_asset_pack ?? null) }}" class="theme-light-show w-200px" alt="" />
                <img src="{{ \App\Support\ThemeAsset::url('media/svg/illustrations/easy/2-dark.svg', $theme_asset_pack ?? null) }}" class="theme-dark-show w-200px"
                    alt="" />
            </div>
            <!--end::Illustration-->
        </div>
        <!--end::Heading-->
        <!--begin::Links-->
        <div class="text-center mb-1">
            <!--begin::Link-->
            <a class="btn btn-sm btn-primary me-2" href="{{ route('apps.ecommerce.customers.listing') }}">
                Try now </a>
            <!--end::Link-->
            <!--begin::Link-->
            <a class="btn btn-sm btn-light" href="{{ route('apps.invoices.view.invoice-1') }}">
                Learn more </a>
            <!--end::Link-->
        </div>
        <!--end::Links-->
    </div>
    <!--end::Body-->
</div>
<!--end::Engage widget 1-->

@elseif ($engageWidget1Variant === 'b')
<div class="card h-md-100" dir="ltr">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column flex-center">
        <!--begin::Heading-->
        <div class="mb-2">
            <!--begin::Title-->
            <h1 class="fw-semibold text-gray-800 text-center lh-lg">
                Try out our <br />new
                <span class="fw-bolder">Invoice Manager</span>
            </h1>
            <!--end::Title-->
            <!--begin::Illustration-->
            <div class="py-10 text-center">
                <img src="{{ \App\Support\ThemeAsset::url('media/svg/illustrations/easy/2.svg', $theme_asset_pack ?? null) }}" class="theme-light-show w-200px" alt="" />
                <img src="{{ \App\Support\ThemeAsset::url('media/svg/illustrations/easy/2-dark.svg', $theme_asset_pack ?? null) }}" class="theme-dark-show w-200px"
                    alt="" />
            </div>
            <!--end::Illustration-->
        </div>
        <!--end::Heading-->
        <!--begin::Links-->
        <div class="text-center mb-1">
            <!--begin::Link-->
            <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_create_account" data-bs-toggle="modal">Try
                Now</a>
            <!--end::Link-->
            <!--begin::Link-->
            <a class="btn btn-sm btn-light" href="{{ route('apps.ecommerce.sales.listing') }}">Learn More</a>
            <!--end::Link-->
        </div>
        <!--end::Links-->
    </div>
    <!--end::Body-->
</div>

@else
@php
    $engageCardClass = $engageCardClass ?? 'card h-md-100';
    $engageTitlePrefix = $engageTitlePrefix ?? 'Have you tried';
    $engageTitleMiddle = $engageTitleMiddle ?? 'new';
    $engageTitleHighlight = $engageTitleHighlight ?? 'Mobile Application ?';
    $engagePrimaryTarget = $engagePrimaryTarget ?? '#kt_modal_create_app';
    $engagePrimaryHref = $engagePrimaryHref ?? null;
    $engagePrimaryText = $engagePrimaryText ?? 'Try now';
    $engageSecondaryHref = $engageSecondaryHref ?? url('apps/invoices/view/invoice-1');
    $engageSecondaryText = $engageSecondaryText ?? 'Learn more';
    $engageIllustrationLight = $engageIllustrationLight ?? 'media/svg/illustrations/easy/1.svg';
    $engageIllustrationDark = $engageIllustrationDark ?? 'media/svg/illustrations/easy/1-dark.svg';
    $engageIllustrationClass = $engageIllustrationClass ?? 'w-200px';
@endphp
<!--begin::Engage widget 1-->
<div class="{{ $engageCardClass }}" dir="ltr">
	<!--begin::Body-->
	<div class="card-body d-flex flex-column flex-center">
		<!--begin::Heading-->
		<div class="mb-2">
			<!--begin::Title-->
			<h1 class="fw-semibold text-gray-800 text-center lh-lg">{{ $engageTitlePrefix }}
				<br />{{ $engageTitleMiddle }}
				<span class="fw-bolder">{{ $engageTitleHighlight }}</span>
			</h1>
			<!--end::Title-->
			<!--begin::Illustration-->
			<div class="py-10 text-center">
				<img src="{{ \App\Support\ThemeAsset::url($engageIllustrationLight, $theme_asset_pack ?? null) }}" class="theme-light-show {{ $engageIllustrationClass }}" alt="" />
				<img src="{{ \App\Support\ThemeAsset::url($engageIllustrationDark, $theme_asset_pack ?? null) }}" class="theme-dark-show {{ $engageIllustrationClass }}" alt="" />
			</div>
			<!--end::Illustration-->
		</div>
		<!--end::Heading-->
		<!--begin::Links-->
		<div class="text-center mb-1">
			<!--begin::Link-->
			<a class="btn btn-sm btn-primary me-2"
				@if ($engagePrimaryHref)
					href="{{ $engagePrimaryHref }}"
				@else
					data-bs-target="{{ $engagePrimaryTarget }}" data-bs-toggle="modal"
				@endif
			>{{ $engagePrimaryText }}</a>
			<!--end::Link-->
			<!--begin::Link-->
			<a class="btn btn-sm btn-light" href="{{ $engageSecondaryHref }}">{{ $engageSecondaryText }}</a>
			<!--end::Link-->
		</div>
		<!--end::Links-->
	</div>
	<!--end::Body-->
</div>
<!--end::Engage widget 1-->

@endif
