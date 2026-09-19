<!--begin::Card Filters (Responsif Tanpa Scroll Horizontal)-->
<div class="card-header border-0 pt-5 pt-md-6 px-4 px-md-6 pb-2">
    <div class="w-100">
        <div class="row g-2 g-md-3 align-items-center">

            <!-- 1. Search Input (Lebar Penuh di Mobile, Fleksibel di Desktop) -->
            <div class="col-12 col-xl">
                <div class="position-relative w-100">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute top-50 translate-middle-y ms-4 text-gray-500"></i>
                    <input type="text" id="kt_filter_search" class="form-control form-control-solid ps-12 rounded-3"
                        placeholder="Cari pengguna, IP, browser..." autocomplete="off" style="height: 40px;" />
                </div>
            </div>

            <!-- 2. Filter Tipe Sesi -->
            <div class="col-6 col-sm-6 col-md-3 col-xl-auto">
                <select class="form-select form-select-solid rounded-3 fw-semibold text-gray-700 w-100 w-xl-140px" id="kt_filter_type" style="height: 40px; cursor: pointer;">
                    <option value="all">Semua Sesi</option>
                    <option value="login">Login Web</option>
                    <option value="lockscreen">Layar Kunci</option>
                </select>
            </div>

            <!-- 3. Filter Reward Poin -->
            <div class="col-6 col-sm-6 col-md-3 col-xl-auto">
                <select class="form-select form-select-solid rounded-3 fw-semibold text-gray-700 w-100 w-xl-150px" id="kt_filter_point" style="height: 40px; cursor: pointer;">
                    <option value="all">Semua Poin</option>
                    <option value="yes">+1 Poin (Reward)</option>
                    <option value="no">0 Poin (Klaim)</option>
                </select>
            </div>

            <!-- 4. Filter Peran -->
            <div class="col-6 col-sm-6 col-md-3 col-xl-auto">
                <select class="form-select form-select-solid rounded-3 fw-semibold text-gray-700 w-100 w-xl-140px" id="kt_filter_role" style="height: 40px; cursor: pointer;">
                    <option value="all">Semua Peran</option>
                    @foreach($roles ?? [] as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 5. Filter Rentang Tanggal + Tombol Reset -->
            <div class="col-6 col-sm-6 col-md-3 col-xl-auto">
                <div class="d-flex align-items-center gap-2 flex-nowrap w-100">
                    <select class="form-select form-select-solid rounded-3 fw-semibold text-gray-700 flex-grow-1 w-xl-140px" id="kt_filter_date_range" style="height: 40px; cursor: pointer;">
                        <option value="">Semua Waktu</option>
                        <option value="today">Hari Ini</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="this_month">Bulan Ini</option>
                    </select>
                    <button type="button" id="kt_btn_reset_filter" class="btn btn-light btn-active-light-primary fw-bold d-inline-flex align-items-center justify-content-center flex-shrink-0"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Atur Ulang Filter" style="width: 40px; min-width: 40px; height: 40px;">
                        <i class="ki-outline ki-arrows-circle fs-4"></i>
                    </button>
                </div>
            </div>

            <!-- 6. Bulk Delete Button (Muncul Dinamis Saat Ada Checkbox Terpilih) -->
            <div class="col-12 col-xl-auto d-none" id="kt_bulk_delete_container">
                <button type="button" class="btn btn-light-danger btn-sm fw-bold px-3 px-md-4 w-100 w-xl-auto" id="kt_btn_bulk_delete"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Hapus Data Terpilih" style="height: 40px;">
                    <span class="indicator-label">
                        <i class="ki-outline ki-trash fs-4 me-1"></i>
                        <span>Hapus Terpilih (<span id="kt_selected_count">0</span>)</span>
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                        <span>Menghapus...</span>
                    </span>
                </button>
            </div>

        </div>
    </div>
</div>
<!--end::Card Filters-->
