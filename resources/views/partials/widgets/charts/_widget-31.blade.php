@php
	$chart31CardClass = $chart31CardClass ?? 'card card-flush h-xl-100';
	$chart31Title = $chart31Title ?? 'Warephase stats';
	$chart31Subtitle = $chart31Subtitle ?? '8k social visitors';
	$chart31ActionHref = $chart31ActionHref ?? url('apps/ecommerce/catalog/add-product');
	$chart31ActionText = $chart31ActionText ?? 'PDF Report';
@endphp
<!--begin::Chart widget 31-->
<div class="{{ $chart31CardClass }}">
	<!--begin::Header-->
	<div class="card-header pt-7 mb-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">{{ $chart31Title }}</span>
			<span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $chart31Subtitle }}</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="{{ $chart31ActionHref }}" class="btn btn-sm btn-light">{{ $chart31ActionText }}</a>
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body d-flex align-items-end pt-0">
		<!--begin::Chart-->
		<div id="kt_charts_widget_31_chart" class="w-100 h-300px"></div>
		<!--end::Chart-->
	</div>
	<!--end::Body-->
</div>
<!--end::Chart widget 31-->
