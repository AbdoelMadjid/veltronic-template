<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 text-center text-md-start">
        <!-- Baris 1-3 di Mobile (Logo, Judul, Deskripsi) / Sisi Kiri di Desktop -->
        <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-4 w-100 w-md-auto">
            <!-- Baris 1: Logo / Ikon Utama -->
            <div class="symbol symbol-55px symbol-md-45px symbol-circle bg-light-primary mb-1 mb-md-0 me-0 me-md-4 d-flex align-items-center justify-content-center flex-shrink-0">
                <i class="ki-outline ki-security-user text-primary fs-2x fs-md-2"></i>
            </div>
            <!-- Baris 2 & 3: Judul & Deskripsi -->
            <div class="d-flex flex-column align-items-center align-items-md-start">
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">Manajemen Hak Akses Pengguna (User Access)</h2>
                <span class="text-muted fs-7 mt-1">Kelola penetapan peran dan konfigurasi izin perorangan (direct permissions) untuk setiap pengguna sistem.</span>
            </div>
        </div>

        <!-- Baris 4: Info Badge di Mobile (Center) / Sisi Kanan di Desktop -->
        <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-2 gap-md-3 w-100 w-md-auto mt-2 mt-md-0">
                    <span class="badge badge-light-primary fs-7 fw-bold px-3 py-2">
                <i class="ki-outline ki-profile-user text-primary fs-6 me-1"></i> Total: <span id="user_access_total_count">{{ $totalUsers ?? (isset($users) ? $users->total() : 0) }}</span> Pengguna
            </span>
        </div>
    </div>
</div>
<!--end::Header Banner-->

<!--begin::Table Card-->
<div class="card card-flush shadow-sm border-0">
    <div class="card-header border-0 pt-6 px-6 d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-between gap-3">
        <!-- Search Input -->
        <div class="d-flex align-items-center position-relative my-0 flex-grow-1 flex-sm-grow-0">
            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4 text-gray-500"></i>
            <input type="text" id="table_search_input" class="form-control form-control-solid w-100 w-sm-250px w-md-300px ps-12 rounded-3" 
                   placeholder="Cari Nama / Email Pengguna..." value="{{ request('search') }}" />
        </div>

        <!-- Filter Role + Reset Button -->
        <div class="d-flex align-items-center gap-2 flex-nowrap w-100 w-sm-auto justify-content-end">
            <div class="flex-grow-1 flex-sm-grow-0 w-100 w-sm-180px">
                <select class="form-select form-select-solid rounded-3" data-control="select2" data-hide-search="true" id="filter_role_dropdown">
                    <option value="all" {{ request('role') == 'all' || !request('role') ? 'selected' : '' }}>Semua Peran</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->id }}" {{ request('role') == $r->id ? 'selected' : '' }}>{{ $r->display_name ?? ucwords(str_replace(['_', '-'], ' ', $r->name)) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn btn-light-primary fw-bold px-3 px-sm-4 flex-shrink-0 d-inline-flex align-items-center justify-content-center" id="btn_reset_filter"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Reset Filter">
                <i class="ki-outline ki-arrows-circle fs-4 me-0 me-sm-1"></i>
                <span class="d-none d-sm-inline">Reset Filter</span>
            </button>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_user_access">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-200px">Pengguna</th>
                        <th class="min-w-150px">Peran Aktif</th>
                        <th class="min-w-150px">Izin Langsung (Direct)</th>
                        <th class="min-w-125px">Status Akun</th>
                        <th class="text-end min-w-100px pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold" id="user_access_tbody">
                    @include('pages.usermanagement.partials.akses-user.user-access-rows')
                </tbody>
            </table>
        </div>

        <!--begin::Pagination-->
        <div class="pt-5" id="user_access_pagination">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
        <!--end::Pagination-->
    </div>
</div>
