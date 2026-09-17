<!--begin::Modal Detail Relasi & Skema Tabel-->
<div class="modal fade" id="kt_modal_table_relation_detail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0">
                <div>
                    <h3 class="fw-bolder text-gray-900 m-0" id="modal_table_title">Detail Relasi & Skema Tabel</h3>
                    <span class="text-muted fs-8" id="modal_table_subtitle">Memuat rincian relasi foreign keys dan struktur kolom...</span>
                </div>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal Tabs Nav-->
            <div class="px-8 pt-4 border-bottom">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary active py-4" data-bs-toggle="tab" href="#kt_modal_tab_structure" role="tab">
                            Struktur & Relasi Skema
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary py-4" data-bs-toggle="tab" href="#kt_modal_tab_data_rows" role="tab">
                            Pratinjau Baris Data
                            <span class="badge badge-light-primary fw-bolder fs-8 ms-2 px-2 py-1" id="modal_badge_rows_count">0</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!--end::Modal Tabs Nav-->

            <!--begin::Modal body-->
            <div class="modal-body py-6 px-8">
                <!-- Overview Stats Badges -->
                <div class="d-flex flex-wrap align-items-center gap-3 mb-6 p-4 bg-light rounded" id="modal_table_meta">
                    <div class="badge badge-light-primary fs-8 fw-bold px-3 py-2">
                        Engine: <span id="modal_meta_engine" class="text-gray-900 fw-bolder ms-1">InnoDB</span>
                    </div>
                    <div class="badge badge-light-success fs-8 fw-bold px-3 py-2">
                        Total Baris: <span id="modal_meta_rows" class="text-gray-900 fw-bolder ms-1">0</span>
                    </div>
                    <div class="badge badge-light-info fs-8 fw-bold px-3 py-2">
                        Ukuran: <span id="modal_meta_size" class="text-gray-900 fw-bolder ms-1">0 KB</span>
                    </div>
                    <div class="badge badge-light-secondary fs-8 fw-bold px-3 py-2">
                        Collation: <span id="modal_meta_collation" class="text-gray-900 fw-bolder ms-1">utf8mb4</span>
                    </div>
                </div>

                <!-- Tab Content Inside Modal -->
                <div class="tab-content" id="kt_modal_table_tab_content">
                    <!-- Tab 1: Struktur & Relasi Skema -->
                    <div class="tab-pane fade show active" id="kt_modal_tab_structure" role="tabpanel">
                        <!-- Section: Relasi Foreign Keys (Outgoing & Incoming) -->
                        <div class="row g-6 mb-6">
                            <!-- Outgoing FK (Merujuk ke Tabel Lain) -->
                            <div class="col-md-6">
                                <div class="card card-bordered h-100 p-5 bg-light-primary border-primary border-opacity-25">
                                    <h6 class="fw-bolder text-gray-900 mb-3">Relasi Keluar (Merujuk ke Parent Table)</h6>
                                    <div id="modal_outgoing_relations_list" class="d-flex flex-column gap-2">
                                        <span class="text-muted fs-8">Tidak ada foreign key keluar.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Incoming FK (Dirujuk oleh Tabel Lain) -->
                            <div class="col-md-6">
                                <div class="card card-bordered h-100 p-5 bg-light-success border-success border-opacity-25">
                                    <h6 class="fw-bolder text-gray-900 mb-3">Relasi Masuk (Dirujuk oleh Child Table)</h6>
                                    <div id="modal_incoming_relations_list" class="d-flex flex-column gap-2">
                                        <span class="text-muted fs-8">Tidak ada tabel yang merujuk ke tabel ini.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Struktur Kolom Tabel -->
                        <div class="mb-4">
                            <h6 class="fw-bolder text-gray-900 mb-3">Struktur Kolom Database</h6>
                            <div class="table-responsive mh-300px">
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-3 fs-8">
                                    <thead>
                                        <tr class="fw-bolder text-muted bg-light text-uppercase">
                                            <th class="ps-3 min-w-150px">Nama Kolom</th>
                                            <th class="min-w-120px">Tipe Data</th>
                                            <th class="min-w-80px text-center">Null</th>
                                            <th class="min-w-80px text-center">Key</th>
                                            <th class="min-w-100px">Default</th>
                                            <th class="pe-3 min-w-120px">Extra / Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_table_columns_tbody">
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">Memuat data kolom...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Pratinjau Baris Data (Preview Records) -->
                    <div class="tab-pane fade" id="kt_modal_tab_data_rows" role="tabpanel">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <span class="text-muted fs-8" id="modal_data_rows_note">Menampilkan hingga 50 baris data terbaru.</span>
                        </div>

                        <div class="table-responsive mh-400px border rounded">
                            <table class="table table-striped table-row-bordered table-row-gray-300 align-middle gs-4 gy-3 fs-8 mb-0" id="modal_table_data_preview">
                                <thead class="bg-light sticky-top">
                                    <tr class="fw-bolder text-gray-900 text-uppercase" id="modal_data_preview_thead">
                                        <th class="min-w-100px">Memuat...</th>
                                    </tr>
                                </thead>
                                <tbody id="modal_data_preview_tbody">
                                    <tr>
                                        <td class="text-center py-6 text-muted">Memuat baris data tabel...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer-->
            <div class="modal-footer border-0 pt-0 px-8 pb-6">
                <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Tutup</button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal Detail Relasi & Skema Tabel-->
