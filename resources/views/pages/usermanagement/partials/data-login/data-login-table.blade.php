<!--begin::Card Table-->
<div class="card card-flush shadow-sm border-0 bg-body">
    <!--begin::Filter Header-->
    @include('pages.usermanagement.partials.data-login.data-login-filter')
    <!--end::Filter Header-->

    <!--begin::Card body-->
    <div class="card-body pt-0 px-6 pb-6">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-4" id="kt_table_data_login">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                    data-kt-check-target="#kt_table_data_login .form-check-input" value="1" id="kt_check_all_logins" />
                            </div>
                        </th>
                        <th class="min-w-225px">Pengguna & Peran</th>
                        <th class="min-w-140px">Tipe Sesi</th>
                        <th class="min-w-160px">Reward Poin (24 Jam)</th>
                        <th class="min-w-160px">Perangkat & Browser</th>
                        <th class="min-w-130px">Alamat IP</th>
                        <th class="min-w-160px">Waktu Sesi</th>
                        <th class="text-end min-w-100px pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 fw-semibold">
                    {{-- Diisi secara realtime via AJAX DataTables --}}
                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card Table-->
