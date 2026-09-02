@php
	$widget14Variant = $widget14Variant ?? 'default';
	$widget14Defaults = [
		'default' => [
			'image' => 'media/stock/600x600/img-39.jpg',
			'title' => 'Wavy Curved Art',
			'lastBid' => '1.07 ETH',
			'total' => '$2,630',
		],
		'a' => [
			'image' => 'media/stock/600x600/img-47.jpg',
			'title' => 'Happy Kitty Art',
			'lastBid' => '7.83 ETH',
			'total' => '$17,035',
		],
	];
	$widget14Preset = $widget14Defaults[$widget14Variant] ?? $widget14Defaults['default'];

	$widget14CardClass = $widget14CardClass ?? 'card card-flush h-xl-100';
	$widget14Image = $widget14Image ?? $widget14Preset['image'];
	$widget14Title = $widget14Title ?? $widget14Preset['title'];
	$widget14LastBid = $widget14LastBid ?? $widget14Preset['lastBid'];
	$widget14Total = $widget14Total ?? $widget14Preset['total'];
	$widget14ViewHref = $widget14ViewHref ?? url('apps/ecommerce/sales/listing');
@endphp
<!--begin::Card widget 14-->
<div class="{{ $widget14CardClass }}">
	<!--begin::Body-->
	<div class="card-body text-center pb-5">
		<!--begin::Overlay-->
		<a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="{{ \App\Support\ThemeAsset::url($widget14Image, $theme_asset_pack ?? null) }}">
			<!--begin::Image-->
			<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded mb-7"
				style="height: 266px;background-image:url('{{ \App\Support\ThemeAsset::url($widget14Image, $theme_asset_pack ?? null) }}')"></div>
			<!--end::Image-->
			<!--begin::Action-->
			<div class="overlay-layer card-rounded bg-dark bg-opacity-25">
				<i class="ki-duotone ki-eye fs-3x text-white">
					<span class="path1"></span>
					<span class="path2"></span>
					<span class="path3"></span>
				</i>
			</div>
			<!--end::Action-->
		</a>
		<!--end::Overlay-->
		<!--begin::Info-->
		<div class="d-flex align-items-end flex-stack mb-1">
			<!--begin::Title-->
			<div class="text-start">
				<span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-4 d-block">{{ $widget14Title }}</span>
				<span class="text-gray-500 mt-1 fw-bold fs-6">Last Bid: {{ $widget14LastBid }}</span>
			</div>
			<!--end::Title-->
			<!--begin::Total-->
			<span class="text-gray-600 text-end fw-bold fs-6">{{ $widget14Total }}</span>
			<!--end::Total-->
		</div>
		<!--end::Info-->
	</div>
	<!--end::Body-->
	<!--begin::Footer-->
	<div class="card-footer d-flex flex-stack pt-0">
		<!--begin::Link-->
		<a class="btn btn-sm btn-primary flex-shrink-0 me-2" data-bs-target="#kt_modal_bidding"
			data-bs-toggle="modal">Place a Bid</a>
		<!--end::Link-->
		<!--begin::Link-->
		<a class="btn btn-sm btn-light flex-shrink-0" href="{{ $widget14ViewHref }}">View Item</a>
		<!--end::Link-->
	</div>
	<!--end::Footer-->
</div>
<!--end::Card widget 14-->
