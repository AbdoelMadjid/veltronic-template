<!--begin::Modal Detail Relasi & Skema Tabel-->
<div class="modal fade" id="kt_modal_table_relation_detail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 position-relative p-4 p-sm-6">
                <div class="d-flex flex-column flex-sm-row align-items-center text-center text-sm-start w-100 pe-0 pe-sm-8">
                    <div class="symbol symbol-50px symbol-sm-40px symbol-circle bg-light-primary mb-2 mb-sm-0 me-0 me-sm-4 d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ki-outline ki-data text-primary fs-2x fs-sm-2"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h3 class="fw-bolder text-gray-900 m-0 fs-4 fs-sm-3" id="modal_table_title">Detail Relasi & Skema Tabel</h3>
                        <span class="text-muted fs-8 mt-1" id="modal_table_subtitle">Memuat rincian relasi foreign keys dan struktur kolom...</span>
                    </div>
                </div>

                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary position-absolute top-0 end-0 m-3 m-sm-4" data-bs-dismiss="modal" aria-label="Close"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="left" title="Tutup Modal">
                    <i class="ki-outline ki-cross fs-1 fs-sm-2"></i>
                </button>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal Tabs Nav-->
            <div class="px-4 px-md-8 pt-2 border-bottom overflow-auto">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold overflow-x-auto overflow-y-hidden flex-nowrap" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary d-flex align-items-center active py-4 me-3 me-md-6"
                            data-bs-toggle="tab" role="tab" href="#kt_modal_tab_structure"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Struktur & Relasi Skema"
                            aria-selected="true">
                            <i class="ki-outline ki-element-11 fs-2 fs-md-4 me-0 me-md-2"></i>
                            <span class="d-none d-md-inline">Struktur & Relasi Skema</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary d-flex align-items-center py-4 me-3 me-md-6"
                            data-bs-toggle="tab" role="tab" href="#kt_modal_tab_data_rows"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pratinjau Baris Data"
                            aria-selected="false">
                            <i class="ki-outline ki-row-horizontal fs-2 fs-md-4 me-0 me-md-2"></i>
                            <span class="d-none d-md-inline">Pratinjau Baris Data</span>
                            <span class="badge badge-light-primary fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1" id="modal_badge_rows_count">0</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!--end::Modal Tabs Nav-->

            <!--begin::Modal body-->
            <div class="modal-body py-4 py-md-6 px-4 px-md-8">
                <!-- Overview Stats Badges -->
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-sm-start gap-2 mb-6 p-3 p-md-4 bg-light rounded" id="modal_table_meta">
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
                        <div class="row g-4 mb-6">
                            <!-- Outgoing FK (Merujuk ke Tabel Lain) -->
                            <div class="col-12 col-md-6">
                                <div class="card card-bordered h-100 p-4 p-md-5 bg-light-primary border-primary border-opacity-25 shadow-none">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="symbol symbol-30px symbol-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0">
                                            <i class="ki-outline ki-arrow-up-right text-primary fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bolder text-gray-900 m-0 fs-7 fs-md-6">Relasi Keluar (Parent Table)</h6>
                                            <span class="text-muted fs-9 d-block">Foreign key merujuk ke tabel lain</span>
                                        </div>
                                    </div>
                                    <div id="modal_outgoing_relations_list" class="d-flex flex-column gap-2">
                                        <span class="text-muted fs-8">Tidak ada foreign key keluar.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Incoming FK (Dirujuk oleh Tabel Lain) -->
                            <div class="col-12 col-md-6">
                                <div class="card card-bordered h-100 p-4 p-md-5 bg-light-success border-success border-opacity-25 shadow-none">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="symbol symbol-30px symbol-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0">
                                            <i class="ki-outline ki-arrow-down-left text-success fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bolder text-gray-900 m-0 fs-7 fs-md-6">Relasi Masuk (Child Table)</h6>
                                            <span class="text-muted fs-9 d-block">Dirujuk oleh tabel lain dalam database</span>
                                        </div>
                                    </div>
                                    <div id="modal_incoming_relations_list" class="d-flex flex-column gap-2">
                                        <span class="text-muted fs-8">Tidak ada tabel yang merujuk ke tabel ini.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Struktur Kolom Tabel -->
                        <div class="mb-4">
                            <h6 class="fw-bolder text-gray-900 mb-3 fs-6">Struktur Kolom Database</h6>
                            <div class="table-responsive mh-300px border rounded">
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-4 gy-3 fs-8 mb-0">
                                    <thead class="bg-light sticky-top">
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
            <div class="modal-footer border-0 pt-0 px-4 px-md-8 pb-6 justify-content-center justify-content-sm-end">
                <button type="button" class="btn btn-light fw-bold px-6" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-5 me-1"></i> Tutup
                </button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
<!--end::Modal Detail Relasi & Skema Tabel-->
