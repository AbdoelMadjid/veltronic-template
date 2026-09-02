@php($vars = $vars ?? [])
<!--begin::Statistics Widget 4-->
<div class="card card-xxl-stretch-50 mb-5 mb-xl-8">
    <!--begin::Body-->
    <div class="card-body p-0">
        <div class="d-flex flex-stack card-p flex-grow-1">
            <span class="symbol symbol-circle symbol-50px me-2">
                <span class="symbol-label bg-light-danger">
                    <i class="ki-duotone ki-element-11 fs-2x text-danger">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                </span>
            </span>
            <div class="d-flex flex-column text-end">
                <span class="text-gray-900 fw-bold fs-2">{{ $vars['p16_1'] ?? "750$" }}</span>
                <span class="text-muted fw-semibold mt-1">{{ $vars['p17_1'] ?? 'Weekly Income' }}</span>
            </div>
        </div>
        <div class="statistics-widget-4-chart card-rounded-bottom"
            data-kt-chart-color="{{ $vars['p21_0'] ?? 'danger' }}" style="height: 150px"></div>
    </div>
    <!--end::Body-->
</div>
<!--end::Statistics Widget 4-->
