<!--begin::Backup History Card-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6 px-4 px-md-6 d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-between gap-3">
        <!--begin::Card title-->
        <div class="d-flex align-items-center position-relative my-1 w-100 w-sm-250px w-xxl-300px">
            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
            <input type="text" id="kt_filter_history_search" class="form-control form-control-solid w-100 ps-12" placeholder="Cari nama berkas cadangan..." />
        </div>
        <!--end::Card title-->

        <!--begin::Card toolbar-->
        <div class="d-flex align-items-center gap-2 ms-0 ms-sm-auto flex-shrink-0">
            <span class="text-muted fs-8 fs-md-7">
                Lokasi: <code class="text-primary">storage/app/backups/</code>
            </span>
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4 px-4 px-md-6">
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="kt_backup_history_datatable">
                <thead>
                    <tr class="fw-bolder text-muted bg-light text-uppercase fs-7">
                        <th class="min-w-220px ps-4">Nama Berkas Cadangan</th>
                        <th class="min-w-100px text-center">Tipe Backup</th>
                        <th class="min-w-160px">Dibuat Oleh</th>
                        <th class="min-w-90px text-center">Ukuran</th>
                        <th class="min-w-140px">Waktu Dibuat</th>
                        <th class="min-w-130px text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kt_backup_history_tbody" class="fw-semibold text-gray-800">
                    @forelse($backupFiles as $file)
                        <tr class="backup-file-row" data-file-name="{{ $file['name'] }}">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-900 fw-bold fs-6 font-monospace">{{ $file['name'] }}</span>
                                        <span class="text-muted fs-8">
                                            Format: {{ $file['is_compressed'] ? 'GZIP Compressed SQL (.sql.gz)' : 'Plain SQL (.sql)' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $file['type_badge'] }} fw-bolder fs-8 px-3 py-1">
                                    {{ $file['type'] }} Backup
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="text-gray-900 fw-bold fs-7">{{ $file['executor_name'] ?? 'Super Admin' }}</span>
                                            <span class="badge {{ $file['role_badge_class'] ?? 'badge-light-primary' }} fs-9 fw-bolder px-2 py-0.5">
                                                {{ $file['executor_role'] ?? 'Master' }}
                                            </span>
                                        </div>
                                        @if(!empty($file['executor_email']))
                                            <span class="text-muted fs-8">{{ $file['executor_email'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light fw-bold fs-7 text-gray-900">{{ $file['size_formatted'] }}</span>
                            </td>
                            <td>
                                <div class="text-gray-900 fw-bold fs-7">{{ $file['created_at_formatted'] }}</div>
                                <span class="text-muted fs-8">{{ $file['created_at_diff'] }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                    <!-- Download Button -->
                                    <a href="{{ route('appsupport.backup-db.download', $file['name']) }}" class="btn btn-icon btn-light-success btn-sm"
                                        data-bs-toggle="tooltip" data-bs-trigger="hover" title="Unduh Berkas SQL">
                                        <i class="ki-outline ki-file-down fs-5"></i>
                                    </a>

                                    <!-- Restore Button -->
                                    <button type="button" class="btn btn-icon btn-light-warning btn-sm btn-restore-backup"
                                        data-file="{{ $file['name'] }}"
                                        data-bs-toggle="tooltip" data-bs-trigger="hover" title="Pulihkan / Restore Database">
                                        <i class="ki-outline ki-arrows-circle fs-5"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-delete-backup"
                                        data-file="{{ $file['name'] }}"
                                        data-bs-toggle="tooltip" data-bs-trigger="hover" title="Hapus Berkas Cadangan">
                                        <i class="ki-outline ki-trash fs-5"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty_backup_history_row">
                            <td colspan="6" class="text-center py-10 text-muted">
                                <div class="fs-6 fw-semibold text-gray-600 mb-1">Belum ada berkas cadangan di penyimpanan.</div>
                                <span class="fs-8 text-muted">Gunakan tombol "Backup Seluruh DB" atau "Backup Terpilih" untuk membuat cadangan pertama.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Backup History Card-->
