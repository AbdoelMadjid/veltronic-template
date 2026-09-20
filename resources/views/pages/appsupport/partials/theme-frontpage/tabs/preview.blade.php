<!--begin::Tab Pane Pratinjau-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-header pt-6 px-4 px-md-6 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
        <div class="card-title">
            <i class="ki-outline ki-tablet text-primary fs-2 me-2"></i>
            <div>
                <h3 class="fw-bolder text-gray-900 m-0 fs-4">Pratinjau Langsung (Live Interactive Preview)</h3>
                <span class="text-muted fs-7">Uji tampilan landing page langsung dalam berbagai mode layar.</span>
            </div>
        </div>
        <div class="card-toolbar d-flex flex-wrap gap-2 w-100 w-sm-auto justify-content-start justify-content-sm-end">
            <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-light-primary fw-bold active btn-preview-size" data-size="100%">
                    <i class="ki-outline ki-screen fs-6 me-1"></i> Desktop
                </button>
                <button type="button" class="btn btn-light-primary fw-bold btn-preview-size" data-size="768px">
                    <i class="ki-outline ki-tablet fs-6 me-1"></i> Tablet
                </button>
                <button type="button" class="btn btn-light-primary fw-bold btn-preview-size" data-size="390px">
                    <i class="ki-outline ki-phone fs-6 me-1"></i> Mobile
                </button>
            </div>
            <button type="button" class="btn btn-light-secondary btn-sm fw-bold" id="kt_btn_refresh_preview" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Segarkan Frame Pratinjau">
                <i class="ki-outline ki-arrows-circle fs-5"></i>
            </button>
            <a href="{{ url('/') }}" target="_blank" class="btn btn-light-primary btn-sm fw-bold">
                <i class="ki-outline ki-exit-right-corner fs-5 me-1"></i> Buka Tab Baru
            </a>
        </div>
    </div>

    <div class="card-body p-2 p-md-4 bg-light-subtle d-flex justify-content-center overflow-hidden">
        <div id="kt_preview_container" style="width: 100%; transition: width 0.3s ease; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); background: #fff;">
            <iframe id="kt_preview_iframe" src="{{ url('/landing') }}" style="width: 100%; height: 750px; border: none;"></iframe>
        </div>
    </div>
</div>
<!--end::Tab Pane Pratinjau-->
