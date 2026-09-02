@php
	$widget3Variant = $widget3Variant ?? 'default';
	$widget3Defaults = [
		'default' => [
			'bg' => '#F1416C',
			'wave' => 'media/svg/shapes/wave-bg-red.svg',
			'iconBg' => '#F1416C',
			'amount' => '1.2k',
			'labelTop' => 'Inbound',
			'labelBottom' => 'Calls',
			'footerValue' => '935',
			'footerLabel' => 'Problems Solved',
		],
		'a' => [
			'bg' => '#7239ea',
			'wave' => 'media/svg/shapes/wave-bg-purple.svg',
			'iconBg' => '#7239ea',
			'amount' => '427',
			'labelTop' => 'Outbound',
			'labelBottom' => 'Calls',
			'footerValue' => '386',
			'footerLabel' => 'Generated Leads',
		],
	];
	$widget3Preset = $widget3Defaults[$widget3Variant] ?? $widget3Defaults['default'];

	$widget3CardClass = $widget3CardClass ?? 'card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100';
	$widget3CardBgColor = $widget3CardBgColor ?? $widget3Preset['bg'];
	$widget3WaveBg = $widget3WaveBg ?? $widget3Preset['wave'];
	$widget3IconBgColor = $widget3IconBgColor ?? $widget3Preset['iconBg'];
	$widget3Amount = $widget3Amount ?? $widget3Preset['amount'];
	$widget3LabelTop = $widget3LabelTop ?? $widget3Preset['labelTop'];
	$widget3LabelBottom = $widget3LabelBottom ?? $widget3Preset['labelBottom'];
	$widget3FooterValue = $widget3FooterValue ?? $widget3Preset['footerValue'];
	$widget3FooterLabel = $widget3FooterLabel ?? $widget3Preset['footerLabel'];
@endphp
<!--begin::Card widget 3-->
<div class="{{ $widget3CardClass }}"
	style="background-color: {{ $widget3CardBgColor }};background-image:url('{{ \App\Support\ThemeAsset::url($widget3WaveBg, $theme_asset_pack ?? null) }}')">
	<!--begin::Header-->
	<div class="card-header pt-5 mb-3">
		<!--begin::Icon-->
		<div class="d-flex flex-center rounded-circle h-80px w-80px"
			style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: {{ $widget3IconBgColor }}">
			<i class="ki-duotone ki-call text-white fs-2qx lh-0">
				<span class="path1"></span>
				<span class="path2"></span>
				<span class="path3"></span>
				<span class="path4"></span>
				<span class="path5"></span>
				<span class="path6"></span>
				<span class="path7"></span>
				<span class="path8"></span>
			</i>
		</div>
		<!--end::Icon-->
	</div>
	<!--end::Header-->
	<!--begin::Card body-->
	<div class="card-body d-flex align-items-end mb-3">
		<!--begin::Info-->
		<div class="d-flex align-items-center">
			<span class="fs-4hx text-white fw-bold me-6">{{ $widget3Amount }}</span>
			<div class="fw-bold fs-6 text-white">
				<span class="d-block">{{ $widget3LabelTop }}</span>
				<span class="">{{ $widget3LabelBottom }}</span>
			</div>
		</div>
		<!--end::Info-->
	</div>
	<!--end::Card body-->
	<!--begin::Card footer-->
	<div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
		<!--begin::Progress-->
		<div class="fw-bold text-white py-2">
			<span class="fs-1 d-block">{{ $widget3FooterValue }}</span>
			<span class="opacity-50">{{ $widget3FooterLabel }}</span>
		</div>
		<!--end::Progress-->
	</div>
	<!--end::Card footer-->
</div>
<!--end::Card widget 3-->
