<!--begin::Card Top Filter & Search (1 Baris Rapi & Bebas Kedipan)-->
<div class="card card-flush shadow-sm border-0 mb-6 bg-body">
    <div class="card-body p-4 px-6">
        <!--begin::Form Filter-->
        <form id="kt_users_filter_form" method="GET" action="{{ route('usermanagement.users.index') }}">
            <div class="d-flex flex-nowrap align-items-center gap-3 overflow-x-auto pb-1 pb-lg-0">

                <!--begin::Search Input (Flex Grow)-->
                <div class="position-relative flex-grow-1 min-w-180px min-w-md-220px">
                    <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle-y ms-4"></i>
                    <input type="text" class="form-control form-control-solid form-control-sm ps-12 rounded-3 text-nowrap" id="filter_search"
                        name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Cari nama atau email pengguna..." autocomplete="off" style="height: 38px;" />
                </div>
                <!--end::Search Input-->

                <!--begin::Filter Role-->
                <div class="w-145px w-xxl-165px flex-shrink-0">
                    <select class="form-select form-select-solid form-select-sm rounded-3 fw-semibold text-gray-700" id="filter_role" name="role" style="height: 38px; cursor: pointer;">
                        <option value="">Semua Peran</option>
                        @foreach ($roles as $r)
                            <option value="{{ $r->name }}" {{ ($filters['role'] ?? '') === $r->name ? 'selected' : '' }}>
                                {{ ucfirst($r->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--end::Filter Role-->

                <!--begin::Filter Status Akun-->
                <div class="w-180px w-xxl-205px flex-shrink-0">
                    <select class="form-select form-select-solid form-select-sm rounded-3 fw-semibold text-gray-700" id="filter_status" name="status" style="height: 38px; cursor: pointer;">
                        <option value="" {{ empty($filters['status']) ? 'selected' : '' }}>Semua Status</option>
                        <option value="verified" {{ ($filters['status'] ?? '') === 'verified' ? 'selected' : '' }}>
                            Terverifikasi ({{ $verifiedCount }})
                        </option>
                        <option value="unverified" {{ ($filters['status'] ?? '') === 'unverified' ? 'selected' : '' }}>
                            Belum Verifikasi ({{ $unverifiedCount }})
                        </option>
                    </select>
                </div>
                <!--end::Filter Status Akun-->

                <!--begin::Filter Pengurutan-->
                <div class="w-150px w-xxl-170px flex-shrink-0">
                    <select class="form-select form-select-solid form-select-sm rounded-3 fw-semibold text-gray-700" id="filter_sort" name="sort" style="height: 38px; cursor: pointer;">
                        <option value="recent" {{ ($filters['sort'] ?? '') === 'recent' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ ($filters['sort'] ?? '') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name_asc" {{ ($filters['sort'] ?? '') === 'name_asc' ? 'selected' : '' }}>Nama (A - Z)</option>
                        <option value="name_desc" {{ ($filters['sort'] ?? '') === 'name_desc' ? 'selected' : '' }}>Nama (Z - A)</option>
                    </select>
                </div>
                <!--end::Filter Pengurutan-->

                <!--begin::Action Buttons-->
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <button type="submit" id="btn_apply_filter" class="btn btn-sm btn-primary fw-bold text-nowrap d-inline-flex align-items-center justify-content-center" style="min-width: 90px; width: 90px; height: 38px;">
                        <span class="indicator-label">
                            <i class="ki-outline ki-filter fs-5 me-1"></i> Saring
                        </span>
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle"></span>
                        </span>
                    </button>
                    <button type="button" id="btn_reset_filter" class="btn btn-sm btn-light btn-active-light-primary fw-bold d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" title="Atur Ulang" style="width: 38px; min-width: 38px; height: 38px;">
                        <i class="ki-outline ki-arrows-circle fs-5"></i>
                    </button>
                </div>
                <!--end::Action Buttons-->

            </div>
        </form>
        <!--end::Form Filter-->
    </div>
</div>

<style>
    #kt_users_filter_form .form-control,
    #kt_users_filter_form .form-select,
    #kt_users_filter_form .btn {
        height: 38px !important;
        white-space: nowrap !important;
    }
    #kt_users_filter_form .form-select {
        cursor: pointer;
        padding-top: 0.45rem !important;
        padding-bottom: 0.45rem !important;
    }
</style>
<!--end::Card Top Filter & Search-->
