<!--begin::Card Filters-->
<div class="card-header border-0 pt-6 px-6">
    <!--begin::Card title (Search Bar)-->
    <div class="card-title">
        <div class="d-flex align-items-center position-relative my-1">
            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5 text-gray-500"></i>
            <input type="text" id="kt_filter_search" class="form-control form-control-solid w-250px w-md-300px ps-13 rounded-3"
                placeholder="Cari pengguna, IP, browser..." />
        </div>
    </div>
    <!--end::Card title-->

    <!--begin::Card toolbar (Filters & Bulk Actions)-->
    <div class="card-toolbar gap-3">
        <!--begin::Filter Tipe Sesi-->
        <div class="w-150px">
            <select class="form-select form-select-solid rounded-3" id="kt_filter_type" data-control="select2" data-hide-search="true" data-placeholder="Tipe Sesi">
                <option value="all">Semua Sesi</option>
                <option value="login">Login Web</option>
                <option value="lockscreen">Layar Kunci</option>
            </select>
        </div>
        <!--end::Filter Tipe Sesi-->

        <!--begin::Filter Poin-->
        <div class="w-160px">
            <select class="form-select form-select-solid rounded-3" id="kt_filter_point" data-control="select2" data-hide-search="true" data-placeholder="Reward Poin">
                <option value="all">Semua Poin</option>
                <option value="yes">+1 Poin (Reward)</option>
                <option value="no">0 Poin (Klaim)</option>
            </select>
        </div>
        <!--end::Filter Poin-->

        <!--begin::Filter Peran-->
        <div class="w-150px">
            <select class="form-select form-select-solid rounded-3" id="kt_filter_role" data-control="select2" data-hide-search="true" data-placeholder="Peran">
                <option value="all">Semua Peran</option>
                @foreach($roles ?? [] as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>
        <!--end::Filter Peran-->

        <!--begin::Filter Rentang Tanggal-->
        <div class="w-160px">
            <select class="form-select form-select-solid rounded-3" id="kt_filter_date_range" data-control="select2" data-hide-search="true" data-placeholder="Rentang Waktu">
                <option value="">Semua Waktu</option>
                <option value="today">Hari Ini</option>
                <option value="yesterday">Kemarin</option>
                <option value="this_week">Minggu Ini</option>
                <option value="this_month">Bulan Ini</option>
            </select>
        </div>
        <!--end::Filter Rentang Tanggal-->

        <!--begin::Bulk Delete Button (Dynamic)-->
        <button type="button" class="btn btn-light-danger btn-sm fw-bold rounded-pill px-4 d-none" id="kt_btn_bulk_delete">
            <span class="indicator-label">
                <i class="ki-outline ki-trash fs-4 me-1"></i> Hapus Terpilih (<span id="kt_selected_count">0</span>)
            </span>
            <span class="indicator-progress">
                Menghapus... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
        <!--end::Bulk Delete Button-->
    </div>
    <!--end::Card toolbar-->
</div>
<!--end::Card Filters-->
