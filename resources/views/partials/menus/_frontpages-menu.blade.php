@php
    $currentFrontpage = \App\Support\Frontpage::current();
    $frontpages = \App\Support\Frontpage::all();
@endphp

<!--begin::Frontpages Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column w-325px w-lg-400px p-4" data-kt-menu="true">
    <!--begin::Heading-->
    <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
        <div>
            <h3 class="text-gray-900 fw-bold fs-6 mb-0">Pilihan Frontpage (Default: /)</h3>
            <span class="text-muted fs-8">Pilih halaman awal yang tampil saat website diakses</span>
        </div>
        <span class="badge badge-light-primary fw-bold fs-8">{{ count($frontpages) }} Pilihan</span>
    </div>
    <!--end::Heading-->

    <!--begin::Notice-->
    <div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex align-items-center p-3 mb-3">
        <i class="ki-duotone ki-information fs-2 text-primary me-3">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <div class="d-flex flex-column">
            <span class="fs-8 text-gray-700">
                Frontpage aktif saat ini:
                <strong class="text-primary">{{ $frontpages[$currentFrontpage]['name'] ?? ucfirst($currentFrontpage) }}</strong>
            </span>
        </div>
    </div>
    <!--end::Notice-->

    <!--begin::Templates List-->
    <div class="mb-1">
        <!--begin::Item: Metronic Landing-->
        @php($isLandingActive = $currentFrontpage === 'landing')
        <div class="p-3 rounded-3 mb-3 border transition {{ $isLandingActive ? 'border-primary bg-light-primary bg-opacity-25' : 'border-gray-200 bg-hover-light' }}">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-35px me-3">
                        <span class="symbol-label bg-light-primary text-primary">
                            <i class="ki-duotone ki-rocket fs-2 text-primary">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="fw-bold fs-6 text-gray-900">Landing Page</span>
                        <span class="text-muted fs-8">Metronic 8 Corporate Landing</span>
                    </div>
                </div>
                @if ($isLandingActive)
                    <span class="badge badge-primary fs-8 fw-bold">
                        <i class="ki-duotone ki-check fs-8 text-white me-1"></i> Terpilih (Aktif)
                    </span>
                @else
                    <a href="{{ route('frontpage.switch', 'landing') }}" class="btn btn-sm btn-light-primary py-1 px-3 fs-8">
                        Pilih Default
                    </a>
                @endif
            </div>
            <div class="d-flex align-items-center justify-content-between pt-1">
                <span class="badge badge-light-secondary fs-9">Bootstrap 5 Marketing</span>
                <a href="{{ url('/landing') }}" target="_blank" class="text-primary fs-8 text-hover-underline fw-semibold">
                    <i class="ki-duotone ki-arrow-up-right fs-8 me-1"></i> Buka Landing
                </a>
            </div>
        </div>
        <!--end::Item: Metronic Landing-->

        <!--begin::Item: Education Portal-->
        @php($isEducationActive = $currentFrontpage === 'education')
        <div class="p-3 rounded-3 mb-2 border transition {{ $isEducationActive ? 'border-warning bg-light-warning bg-opacity-25' : 'border-gray-200 bg-hover-light' }}">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-35px me-3">
                        <span class="symbol-label bg-light-warning text-warning">
                            <i class="ki-duotone ki-teacher fs-2 text-warning">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="fw-bold fs-6 text-gray-900">Education Portal</span>
                        <span class="text-muted fs-8">Unify v2.6 Multipage Education</span>
                    </div>
                </div>
                @if ($isEducationActive)
                    <span class="badge badge-warning fs-8 fw-bold text-dark">
                        <i class="ki-duotone ki-check fs-8 me-1"></i> Terpilih (Aktif)
                    </span>
                @else
                    <a href="{{ route('frontpage.switch', 'education') }}" class="btn btn-sm btn-light-warning py-1 px-3 fs-8 text-dark">
                        Pilih Default
                    </a>
                @endif
            </div>

            <!--begin::Education Quick Links-->
            <div class="separator separator-dashed my-2"></div>
            <div class="row g-1 pt-1">
                <div class="col-6">
                    <a href="{{ route('education.home') }}" target="_blank"
                        class="btn btn-sm btn-light text-start w-100 py-1 px-2 fs-8 text-gray-700 text-hover-primary">
                        <i class="ki-duotone ki-home fs-7 text-muted me-1"></i> Home
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('education.programs') }}" target="_blank"
                        class="btn btn-sm btn-light text-start w-100 py-1 px-2 fs-8 text-gray-700 text-hover-primary">
                        <i class="ki-duotone ki-book-open fs-7 text-muted me-1"></i> Programs
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('education.events') }}" target="_blank"
                        class="btn btn-sm btn-light text-start w-100 py-1 px-2 fs-8 text-gray-700 text-hover-primary">
                        <i class="ki-duotone ki-calendar fs-7 text-muted me-1"></i> Events
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('education.apply-all-intake') }}" target="_blank"
                        class="btn btn-sm btn-light text-start w-100 py-1 px-2 fs-8 text-gray-700 text-hover-primary">
                        <i class="ki-duotone ki-send fs-7 text-muted me-1"></i> Apply Intake
                    </a>
                </div>
            </div>
            <!--end::Education Quick Links-->
        </div>
        <!--end::Item: Education Portal-->
    </div>
    <!--end::Templates List-->
</div>
<!--end::Frontpages Menu-->
