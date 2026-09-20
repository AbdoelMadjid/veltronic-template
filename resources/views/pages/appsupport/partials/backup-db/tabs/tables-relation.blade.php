<!--begin::Tables & Relations Card-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6 px-4 px-md-6 d-flex flex-column flex-xl-row align-items-stretch align-items-xl-center justify-content-between gap-4">
        <!--begin::Card title (Search & Filter)-->
        <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3 w-100 w-xl-auto">
            <!-- 1. Search Box (Full width di Mobile) -->
            <div class="d-flex align-items-center position-relative w-100 w-sm-250px w-xxl-300px">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                <input type="text" id="kt_filter_table_search" class="form-control form-control-solid w-100 ps-12" placeholder="Cari nama tabel..." />
            </div>

            <!-- Filter Select (Full width di Mobile) -->
            <div class="w-100 w-sm-175px">
                <select id="kt_filter_relation_type" class="form-select form-select-solid w-100" data-control="select2" data-hide-search="true">
                    <option value="all" selected>Semua Tabel</option>
                    <option value="with_relations">Memiliki Relasi</option>
                    <option value="no_relations">Tabel Standalone</option>
                </select>
            </div>
        </div>
        <!--end::Card title-->

        <!--begin::Card toolbar (Action buttons)-->
        <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-3 w-100 w-xl-auto">
            <!-- 2. Auto Relasi & Pilih Semua dalam Satu Baris di Mobile -->
            <div class="d-flex align-items-center justify-content-between justify-content-md-start gap-4 py-1">
                <!-- Switch Auto-Centang Relasi -->
                <div class="form-check form-switch form-check-custom form-check-solid" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Otomatis mencentang tabel yang memiliki relasi Foreign Key saat tabel dipilih">
                    <input class="form-check-input h-20px w-35px cursor-pointer" type="checkbox" id="kt_switch_auto_relational_select" checked />
                    <label class="form-check-label text-gray-700 fw-bold fs-7 cursor-pointer text-nowrap" for="kt_switch_auto_relational_select">
                        Auto Relasi
                    </label>
                </div>

                <!-- Checkbox Pilih Semua -->
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input cursor-pointer" type="checkbox" id="kt_check_all_tables" />
                    <label class="form-check-label text-gray-700 fw-bold fs-7 cursor-pointer text-nowrap" for="kt_check_all_tables">
                        Pilih Semua
                    </label>
                </div>
            </div>

            <!-- 3. Tombol Backup Terpilih & Backup Seluruh DB di Baris Berikutnya (Full Width di Mobile dengan Teks Utuh) -->
            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2 w-100 w-md-auto">
                <!-- Tombol Backup Terpilih -->
                <button type="button" class="btn btn-sm btn-light-primary fw-bold d-flex align-items-center justify-content-center flex-grow-1 flex-md-grow-0" id="kt_btn_backup_selected" disabled
                    data-bs-toggle="tooltip" data-bs-trigger="hover" title="Backup hanya tabel yang dicentang">
                    <span class="indicator-label d-flex align-items-center">
                        <i class="ki-outline ki-check-circle fs-5 me-1"></i>
                        <span>Backup Terpilih</span>
                        <span class="badge badge-primary ms-1" id="kt_selected_tables_badge">0</span>
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle me-1"></span>
                        <span>Membuat Dump...</span>
                    </span>
                </button>

                <!-- Tombol Backup Seluruh DB -->
                <button type="button" class="btn btn-sm btn-primary fw-bold d-flex align-items-center justify-content-center flex-grow-1 flex-md-grow-0" id="kt_btn_backup_full"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" title="Backup seluruh tabel dan relasi database">
                    <span class="indicator-label d-flex align-items-center">
                        <i class="ki-outline ki-cloud-download fs-5 me-1"></i>
                        <span>Backup Seluruh DB</span>
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle me-1"></span>
                        <span>Membuat Dump...</span>
                    </span>
                </button>
            </div>
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4 px-6">
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="kt_tables_relation_datatable">
                <thead>
                    <tr class="fw-bolder text-muted bg-light text-uppercase fs-7">
                        <th class="w-25px ps-4">
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" id="kt_check_master" />
                            </div>
                        </th>
                        <th class="min-w-150px">Nama Tabel</th>
                        <th class="min-w-100px text-center">Engine & Baris</th>
                        <th class="min-w-90px text-end">Ukuran</th>
                        <th class="min-w-250px">Relasi Foreign Keys (Parents & Childs)</th>
                        <th class="min-w-120px text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-800">
                    @forelse($tables as $table)
                        @php
                            $hasRelations = (!empty($table['outgoing_relations']) || !empty($table['incoming_relations']));
                            $relationClass = $hasRelations ? 'has-relation' : 'no-relation';
                            $outgoingTables = array_values(array_unique(array_column($table['outgoing_relations'] ?? [], 'target_table')));
                            $incomingTables = array_values(array_unique(array_column($table['incoming_relations'] ?? [], 'source_table')));
                            $allRelated = array_values(array_unique(array_merge($outgoingTables, $incomingTables)));
                        @endphp
                        <tr class="table-row-item {{ $relationClass }}" data-table-name="{{ $table['name'] }}">
                            <td class="ps-4">
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input table-checkbox" type="checkbox" 
                                        value="{{ $table['name'] }}"
                                        data-outgoing='@json($outgoingTables)'
                                        data-incoming='@json($incomingTables)'
                                        data-related='@json($allRelated)' />
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <a href="javascript:void(0)" class="text-gray-900 fw-bold text-hover-primary fs-6 btn-table-detail" data-table="{{ $table['name'] }}">
                                            {{ $table['name'] }}
                                        </a>
                                        <span class="text-muted fs-8">{{ $table['collation'] ?? 'utf8mb4' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light-secondary fw-bold fs-8 mb-1">{{ $table['engine'] }}</span>
                                <div class="text-gray-900 fw-bolder fs-7">{{ number_format($table['rows']) }} <span class="text-muted fw-normal fs-8">rows</span></div>
                            </td>
                            <td class="text-end">
                                <span class="badge badge-light-info fw-bold fs-8">{{ $table['size_formatted'] }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    {{-- Relasi Outgoing (Merujuk ke Tabel Parent) --}}
                                    @if(!empty($table['outgoing_relations']))
                                        <div class="d-flex align-items-center gap-1 flex-wrap">
                                            <span class="badge badge-light-primary fs-9 fw-bold px-2 py-1" data-bs-toggle="tooltip" title="Merujuk ke Parent Table via Foreign Key">
                                                Merujuk ke:
                                            </span>
                                            @foreach($table['outgoing_relations'] as $out)
                                                <span class="badge badge-light fw-semibold text-gray-800 fs-8 border border-gray-300"
                                                    data-bs-toggle="tooltip" 
                                                    title="Kolom: {{ $out['column'] }} &rarr; {{ $out['target_table'] }}.{{ $out['target_column'] }} ({{ $out['constraint'] }})">
                                                    {{ $out['target_table'] }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- Relasi Incoming (Dirujuk oleh Tabel Child) --}}
                                    @if(!empty($table['incoming_relations']))
                                        <div class="d-flex align-items-center gap-1 flex-wrap">
                                            <span class="badge badge-light-success fs-9 fw-bold px-2 py-1" data-bs-toggle="tooltip" title="Dirujuk oleh Child Table">
                                                Dirujuk oleh:
                                            </span>
                                            @foreach($table['incoming_relations'] as $inc)
                                                <span class="badge badge-light fw-semibold text-gray-800 fs-8 border border-gray-300"
                                                    data-bs-toggle="tooltip" 
                                                    title="Tabel: {{ $inc['source_table'] }} (Kolom: {{ $inc['source_column'] }} &rarr; {{ $inc['target_column'] }})">
                                                    {{ $inc['source_table'] }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if(empty($table['outgoing_relations']) && empty($table['incoming_relations']))
                                        <span class="text-muted fs-8 fst-italic">Standalone (Tanpa FK)</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <button type="button" class="btn btn-icon btn-light-info btn-sm btn-table-detail"
                                         data-table="{{ $table['name'] }}"
                                         data-bs-toggle="tooltip" data-bs-trigger="hover" title="Lihat Relasi & Skema Kolom">
                                         <i class="ki-outline ki-eye fs-5"></i>
                                     </button>

                                     <button type="button" class="btn btn-icon btn-light-primary btn-sm btn-single-backup"
                                         data-table="{{ $table['name'] }}"
                                         data-bs-toggle="tooltip" data-bs-trigger="hover" title="Backup Hanya Tabel Ini">
                                         <i class="ki-outline ki-cloud-download fs-5"></i>
                                     </button>
                                 </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-muted">
                                Tidak ada tabel database yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Tables & Relations Card-->
