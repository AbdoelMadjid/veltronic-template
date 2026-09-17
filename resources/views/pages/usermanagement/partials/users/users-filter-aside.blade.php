<!--begin::Aside Filter Sidebar-->
<div class="flex-column flex-lg-row-auto w-100 w-lg-275px w-xxl-325px mb-8 mb-lg-0 me-lg-9 me-5">
    <!--begin::Form Filter-->
    <form id="kt_users_filter_form" method="GET" action="{{ route('usermanagement.users.index') }}">
        <!--begin::Card-->
        <div class="card card-flush shadow-sm border-0">
            <!--begin::Card Header-->
            <div class="card-header pt-6">
                <div class="card-title">
                    <h4 class="fw-bolder text-gray-900 m-0 fs-4">Filter & Pencarian</h4>
                </div>
            </div>
            <!--end::Card Header-->

            <!--begin::Body-->
            <div class="card-body pt-3">
                <!--begin:Search Input-->
                <div class="mb-6">
                    <label class="fs-6 form-label fw-bold text-gray-800 mb-2">Kata Kunci</label>
                    <div class="position-relative">
                        <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle-y ms-4">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                        <input type="text" class="form-control form-control-solid ps-12" id="filter_search"
                            name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Cari nama atau email..." autocomplete="off" />
                    </div>
                </div>
                <!--end:Search Input-->

                <!--begin::Separator-->
                <div class="separator separator-dashed my-5"></div>
                <!--end::Separator-->

                <!--begin::Input group: Role-->
                <div class="mb-6">
                    <label class="fs-6 form-label fw-bold text-gray-800 mb-2">Peran (Role)</label>
                    <select class="form-select form-select-solid" id="filter_role" name="role" data-control="select2"
                        data-placeholder="Semua Peran" data-hide-search="true">
                        <option value="">Semua Peran</option>
                        @foreach ($roles as $r)
                            <option value="{{ $r->name }}" {{ ($filters['role'] ?? '') === $r->name ? 'selected' : '' }}>
                                {{ ucfirst($r->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--end::Input group: Role-->

                <!--begin::Input group: Status Verifikasi-->
                <div class="mb-6">
                    <label class="fs-6 form-label fw-bold text-gray-800 mb-2">Status Akun</label>
                    <div class="d-flex flex-column gap-3">
                        <label class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="status" value=""
                                {{ empty($filters['status']) ? 'checked' : '' }} />
                            <span class="form-check-label fw-semibold text-gray-700 fs-7">Semua Pengguna</span>
                        </label>
                        <label class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="status" value="verified"
                                {{ ($filters['status'] ?? '') === 'verified' ? 'checked' : '' }} />
                            <span class="form-check-label fw-semibold text-gray-700 fs-7">
                                Email Terverifikasi <span class="badge badge-light-success fs-9 ms-1">{{ $verifiedCount }}</span>
                            </span>
                        </label>
                        <label class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="status" value="unverified"
                                {{ ($filters['status'] ?? '') === 'unverified' ? 'checked' : '' }} />
                            <span class="form-check-label fw-semibold text-gray-700 fs-7">
                                Belum Verifikasi <span class="badge badge-light-secondary fs-9 ms-1">{{ $unverifiedCount }}</span>
                            </span>
                        </label>
                    </div>
                </div>
                <!--end::Input group: Status Verifikasi-->

                <!--begin::Separator-->
                <div class="separator separator-dashed my-5"></div>
                <!--end::Separator-->

                <!--begin::Input group: Pengurutan-->
                <div class="mb-6">
                    <label class="fs-6 form-label fw-bold text-gray-800 mb-2">Urutkan Berdasarkan</label>
                    <select class="form-select form-select-solid" id="filter_sort" name="sort" data-control="select2"
                        data-hide-search="true">
                        <option value="recent" {{ ($filters['sort'] ?? '') === 'recent' ? 'selected' : '' }}>Paling Baru Diperbarui</option>
                        <option value="oldest" {{ ($filters['sort'] ?? '') === 'oldest' ? 'selected' : '' }}>Terlama Terdaftar</option>
                        <option value="name_asc" {{ ($filters['sort'] ?? '') === 'name_asc' ? 'selected' : '' }}>Nama (A - Z)</option>
                        <option value="name_desc" {{ ($filters['sort'] ?? '') === 'name_desc' ? 'selected' : '' }}>Nama (Z - A)</option>
                    </select>
                </div>
                <!--end::Input group: Pengurutan-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center justify-content-between pt-2">
                    <button type="button" id="btn_reset_filter" class="btn btn-sm btn-light btn-active-light-primary fw-bold">
                        Reset Filter
                    </button>
                    <button type="submit" id="btn_apply_filter" class="btn btn-sm btn-primary fw-bold">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Terapkan</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-1"></span>
                        </span>
                        <!--end::Indicator progress-->
                    </button>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </form>
    <!--end::Form Filter-->
</div>
<!--end::Aside Filter Sidebar-->
