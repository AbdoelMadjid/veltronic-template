@php($vars = $vars ?? [])
<!--begin::Card widget 2-->
<div class="card h-lg-100">
    <!--begin::Body-->
    <div class="card-body d-flex justify-content-between align-items-start flex-column">
        <!--begin::Icon-->
        <div class="m-0">
            <i class="{{ $vars['icon_class'] ?? 'ki-outline ki-compass fs-2hx text-gray-600' }}"></i>
        </div>
        <!--end::Icon-->
        <!--begin::Section-->
        <div class="d-flex flex-column my-7">
            <!--begin::Number-->
            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $vars['p12_1'] ?? '327' }}</span>
            <!--end::Number-->
            <!--begin::Follower-->
            <div class="m-0">
                <span class="fw-semibold fs-6 text-gray-500">{{ $vars['p16_1'] ?? 'Projects' }}</span>
            </div>
            <!--end::Follower-->
        </div>
        <!--end::Section-->
        <!--begin::Badge-->
        <span class="{{ $vars['badge_class'] ?? 'badge badge-light-success fs-base' }}">
            <i
                class="{{ $vars['badge_icon_class'] ?? ($vars['p23_0'] ?? 'ki-outline ki-arrow-up fs-5 text-success ms-n1') }}"></i>{{ $vars['badge_text'] ?? ($vars['p23_1'] ?? '2.1%') }}</span>
        <!--end::Badge-->
    </div>
    <!--end::Body-->
</div>
<!--end::Card widget 2-->
