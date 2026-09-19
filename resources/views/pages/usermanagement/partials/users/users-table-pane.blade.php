<!--begin::Tab pane: Table View-->
<div id="kt_project_users_table_pane" class="tab-pane fade">
    <!--begin::Card-->
    <div class="card card-flush shadow-sm border-0">
        <!--begin::Card body-->
        <div class="card-body pt-4">
            <!--begin::Table-->
            <table id="kt_table_users" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                <thead class="fs-7 text-gray-500 text-uppercase gs-0">
                    <tr>
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" id="check_all_users" data-kt-check="true" data-kt-check-target="#kt_table_users .user-bulk-checkbox" value="1" />
                            </div>
                        </th>
                        <th class="w-10px pe-2">No</th>
                        <th class="min-w-200px">Pengguna</th>
                        <th class="min-w-100px">Peran</th>
                        <th class="min-w-120px">Status Email</th>
                        <th class="min-w-120px">Terdaftar</th>
                        <th class="min-w-120px text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="fs-6 text-gray-700">
                    <!-- Yajra / AJAX DataTables loads dynamically -->
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Tab pane: Table View-->
