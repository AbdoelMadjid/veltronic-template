<div class="d-flex align-items-center gap-2 gap-lg-3">
    <!--begin::Date Widget-->
    <div class="d-flex align-items-center bg-body px-2 px-md-3 py-1 py-md-1.5 rounded-2 border border-gray-200 fs-7 fw-semibold text-gray-700 shadow-xs cursor-pointer"
        data-bs-toggle="tooltip"
        data-bs-placement="bottom"
        data-bs-trigger="hover"
        data-kt-lang-title-id="{{ renderDatePlain([], 'id') }}"
        data-kt-lang-title-en="{{ renderDatePlain([], 'en') }}"
        title="{{ renderDatePlain() }}">
        <i class="ki-duotone ki-calendar-8 fs-3 text-primary me-0 me-md-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
            <span class="path6"></span>
        </i>
        <span class="d-none d-md-inline">
            {!! renderDate() !!}
        </span>
    </div>
    <!--end::Date Widget-->

    <!--begin::Petunjuk Modal Button-->
    @if(isset($targetModal))
        <button type="button" 
                class="btn btn-icon btn-light-primary btn-sm rounded-2 shadow-xs" 
                data-bs-toggle="modal" 
                data-bs-target="{{ $targetModal }}"
                data-bs-toggle-second="tooltip" 
                title="{{ $title ?? 'Petunjuk Operasional' }}">
            <i class="ki-outline ki-information-5 fs-4"></i>
        </button>
    @endif
    <!--end::Petunjuk Modal Button-->
</div>
