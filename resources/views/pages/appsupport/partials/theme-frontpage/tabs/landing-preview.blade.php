<!--begin::Subtab Pratinjau Landing Page-->
<div class="card shadow-sm mb-6">
    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
        <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
            <h3 class="fw-bolder text-gray-900 m-0 fs-4">Pratinjau Langsung Landing Page (Metronic 8)</h3>
            <span class="text-muted fs-7 mt-1">Uji tampilan interaktif Landing Page dalam berbagai mode layar (Desktop, Tablet, Mobile)</span>
        </div>
        <div class="card-toolbar d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-center justify-content-md-end gap-2 w-100 w-md-auto mt-2 mt-md-0">
            <div class="btn-group btn-group-sm w-100 w-md-auto" role="group">
                <button type="button" class="btn btn-light-primary fw-bold active btn-preview-size-landing d-inline-flex align-items-center justify-content-center h-35px px-3 flex-grow-1 flex-md-grow-0" data-size="100%" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Layar Desktop (100%)">
                    <i class="ki-outline ki-screen fs-6 me-1"></i> Desktop
                </button>
                <button type="button" class="btn btn-light-primary fw-bold btn-preview-size-landing d-inline-flex align-items-center justify-content-center h-35px px-3 flex-grow-1 flex-md-grow-0" data-size="768px" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Layar Tablet (768px)">
                    <i class="ki-outline ki-tablet fs-6 me-1"></i> Tablet
                </button>
                <button type="button" class="btn btn-light-primary fw-bold btn-preview-size-landing d-inline-flex align-items-center justify-content-center h-35px px-3 flex-grow-1 flex-md-grow-0" data-size="390px" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Layar HP / Ponsel (390px)">
                    <i class="ki-outline ki-phone fs-6 me-1"></i> Mobile
                </button>
            </div>
            <div class="d-flex align-items-center justify-content-center gap-2 w-100 w-md-auto">
                <button type="button" class="btn btn-light-secondary btn-sm fw-bold h-35px w-35px d-inline-flex align-items-center justify-content-center p-0 flex-shrink-0" id="kt_btn_refresh_preview_landing" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Segarkan Frame Pratinjau">
                    <i class="ki-outline ki-arrows-circle fs-5"></i>
                </button>
                <a href="{{ url('/landing') }}" target="_blank" class="btn btn-light-primary btn-sm fw-bold h-35px d-inline-flex align-items-center justify-content-center px-3 flex-grow-1 flex-md-grow-0 w-100 w-md-auto" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Buka landing page di tab baru">
                    <i class="ki-outline ki-exit-right-corner fs-5 me-1"></i> <span>Buka Tab Baru</span>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body p-2 p-md-4 bg-light-subtle d-flex justify-content-center overflow-hidden">
        <div id="kt_preview_container_landing" style="width: 100%; transition: width 0.3s ease; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); background: #fff;">
            <iframe id="kt_preview_iframe_landing" src="{{ url('/landing') }}" style="width: 100%; height: clamp(450px, 70vh, 750px); min-height: 450px; border: none;"></iframe>
        </div>
    </div>
</div>
<!--end::Subtab Pratinjau Landing Page-->
