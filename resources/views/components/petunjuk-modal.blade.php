@props([
    'id' => 'kt_modal_petunjuk',
    'title' => 'Petunjuk Operasional',
    'subtitle' => 'Panduan operasional modul aplikasi',
    'box1Title' => 'Gambaran Umum',
    'box1Icon' => 'ki-diamonds',
    'box2Title' => 'Hirarki & Komponen',
    'box2Icon' => 'ki-element-11',
    'box3Title' => 'Alur Operasional',
    'box3Icon' => 'ki-key',
    'box4Title' => 'Aturan & Proteksi Sistem',
    'box4Icon' => 'ki-security-user',
])

<!--begin::Modal Petunjuk Operasional-->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content rounded-4 border-0 shadow-lg position-relative">
            <!--begin::Close Button-->
            <div class="position-absolute top-0 end-0 m-4 z-index-2">
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-outline ki-cross fs-2"></i>
                </button>
            </div>
            <!--end::Close Button-->

            <div class="modal-body p-8 p-lg-10">
                <!--begin::Top Icon & Title-->
                <div class="text-center mb-7">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light-danger text-danger rounded-circle mx-auto mb-4" style="width: 60px; height: 60px; min-width: 60px; min-height: 60px;">
                        <i class="ki-outline ki-shield-tick text-danger fs-2x"></i>
                    </div>
                    <h2 class="fw-bolder text-gray-900 mb-1 fs-2">{{ $title }}</h2>
                    <div class="text-muted fs-6">{{ $subtitle }}</div>
                </div>
                <!--end::Top Icon & Title-->

                <!--begin::Box 1: Gambaran Umum (Blue)-->
                <div class="rounded-3 p-5 mb-4 border border-primary border-opacity-50 bg-light-primary bg-opacity-10">
                    <div class="d-flex align-items-center mb-2">
                        <i class="ki-outline {{ $box1Icon }} text-primary fs-3 me-2"></i>
                        <span class="fw-bold text-primary fs-6">{{ $box1Title }}</span>
                    </div>
                    <div class="text-gray-700 fs-7 m-0 lh-base">
                        {{ $box1 ?? '' }}
                    </div>
                </div>
                <!--end::Box 1-->

                <!--begin::Box 2: Hirarki & Komponen (Gray / Neutral)-->
                <div class="rounded-3 p-5 mb-4 border border-gray-300 bg-light bg-opacity-50">
                    <div class="d-flex align-items-center mb-3">
                        <i class="ki-outline {{ $box2Icon }} text-gray-800 fs-3 me-2"></i>
                        <span class="fw-bold text-gray-800 fs-6">{{ $box2Title }}</span>
                    </div>
                    <div class="text-gray-700 fs-7 mb-0">
                        {{ $box2 ?? '' }}
                    </div>
                </div>
                <!--end::Box 2-->

                <!--begin::Box 3: Alur Operasional (Purple / Primary)-->
                <div class="rounded-3 p-5 mb-4 border border-primary border-opacity-75 bg-light-primary bg-opacity-10">
                    <div class="d-flex align-items-center mb-3">
                        <i class="ki-outline {{ $box3Icon }} text-primary fs-3 me-2"></i>
                        <span class="fw-bold text-primary fs-6">{{ $box3Title }}</span>
                    </div>
                    <div class="text-gray-700 fs-7 mb-0">
                        {{ $box3 ?? '' }}
                    </div>
                </div>
                <!--end::Box 3-->

                <!--begin::Box 4: Aturan & Proteksi (Yellow / Warning)-->
                <div class="rounded-3 p-5 mb-7 border border-warning border-opacity-75 bg-light-warning bg-opacity-10">
                    <div class="d-flex align-items-center mb-3">
                        <i class="ki-outline {{ $box4Icon }} text-warning fs-3 me-2"></i>
                        <span class="fw-bold text-warning fs-6">{{ $box4Title }}</span>
                    </div>
                    <div class="text-gray-700 fs-7 mb-0">
                        {{ $box4 ?? '' }}
                    </div>
                </div>
                <!--end::Box 4-->

                <!--begin::Footer Action-->
                <div class="text-center">
                    <button type="button" class="btn btn-primary px-6 px-sm-8 fw-bold" data-bs-dismiss="modal"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Saya Mengerti">
                        <i class="ki-outline ki-check fs-4 me-1"></i>
                        <span>Saya Mengerti</span>
                    </button>
                </div>
                <!--end::Footer Action-->
            </div>
        </div>
    </div>
</div>
<!--end::Modal Petunjuk Operasional-->
