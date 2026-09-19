<!--begin::Card Top Filter & Search (Responsif Tanpa Scroll Horizontal)-->
<div class="card card-flush shadow-sm border-0 mb-6 bg-body">
    <div class="card-body p-3 p-md-5">
        <!--begin::Form Filter-->
        <form id="kt_users_filter_form" method="GET" action="{{ route('usermanagement.users.index') }}">
            <div class="row g-2 g-md-3 align-items-center">

                <!-- 1. Search Input (Lebar Penuh di Mobile, Fleksibel di Desktop) -->
                <div class="col-12 col-lg">
                    <div class="position-relative w-100">
                        <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle-y ms-4"></i>
                        <input type="text" class="form-control form-control-solid ps-12 rounded-3" id="filter_search"
                            name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Cari nama atau email pengguna..." autocomplete="off" style="height: 40px;" />
                    </div>
                </div>

                <!-- 2. Filter Role -->
                <div class="col-6 col-md-4 col-lg-auto">
                    <select class="form-select form-select-solid rounded-3 fw-semibold text-gray-700 w-100 w-lg-150px" id="filter_role" name="role" style="height: 40px; cursor: pointer;">
                        <option value="">Semua Peran</option>
                        @foreach ($roles as $r)
                            <option value="{{ $r->name }}" {{ ($filters['role'] ?? '') === $r->name ? 'selected' : '' }}>
                                {{ ucfirst($r->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 3. Filter Status Akun -->
                <div class="col-6 col-md-4 col-lg-auto">
                    <select class="form-select form-select-solid rounded-3 fw-semibold text-gray-700 w-100 w-lg-180px" id="filter_status" name="status" style="height: 40px; cursor: pointer;">
                        <option value="" {{ empty($filters['status']) ? 'selected' : '' }}>Semua Status</option>
                        <option value="verified" {{ ($filters['status'] ?? '') === 'verified' ? 'selected' : '' }}>
                            Terverifikasi ({{ $verifiedCount }})
                        </option>
                        <option value="unverified" {{ ($filters['status'] ?? '') === 'unverified' ? 'selected' : '' }}>
                            Belum Verifikasi ({{ $unverifiedCount }})
                        </option>
                    </select>
                </div>

                <!-- 4. Filter Pengurutan + Tombol Reset (Berdampingan Rapi) -->
                <div class="col-12 col-md-4 col-lg-auto">
                    <div class="d-flex align-items-center gap-2 flex-nowrap w-100">
                        <select class="form-select form-select-solid rounded-3 fw-semibold text-gray-700 flex-grow-1 w-lg-150px" id="filter_sort" name="sort" style="height: 40px; cursor: pointer;">
                            <option value="recent" {{ ($filters['sort'] ?? '') === 'recent' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ ($filters['sort'] ?? '') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="name_asc" {{ ($filters['sort'] ?? '') === 'name_asc' ? 'selected' : '' }}>Nama (A - Z)</option>
                            <option value="name_desc" {{ ($filters['sort'] ?? '') === 'name_desc' ? 'selected' : '' }}>Nama (Z - A)</option>
                        </select>
                        <button type="button" id="btn_reset_filter" class="btn btn-light btn-active-light-primary fw-bold d-inline-flex align-items-center justify-content-center flex-shrink-0" 
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Atur Ulang Filter" style="width: 40px; min-width: 40px; height: 40px;">
                            <i class="ki-outline ki-arrows-circle fs-4"></i>
                        </button>
                    </div>
                </div>

            </div>
        </form>
        <!--end::Form Filter-->
    </div>
</div>
<!--end::Card Top Filter & Search-->
