<!--begin::Auto Backup Settings Card-->
<div class="card shadow-sm border border-gray-200 mb-6">
    <!--begin::Card header-->
    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
        <!-- Sisi Kiri: Judul & Subketerangan Bersih -->
        <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
            <h3 class="fw-bolder text-gray-900 m-0 fs-4">Konfigurasi Penjadwalan Backup Otomatis</h3>
            <span class="text-muted fs-7 mt-1">Atur frekuensi dan waktu eksekusi otomatis pencadangan basis data berbasis cron server</span>
        </div>

        <!-- Sisi Kanan: Status Eksekusi Terakhir -->
        <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
            @if(!empty($autoSettings['last_run_at']))
                <span class="badge badge-light-primary fs-8 fw-semibold px-3 py-2 d-inline-flex align-items-center h-35px">
                    <i class="ki-outline ki-time fs-6 me-1 text-primary"></i> Terakhir dieksekusi: {{ \Carbon\Carbon::parse($autoSettings['last_run_at'])->translatedFormat('d M Y, H:i') }}
                </span>
            @endif
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-6 px-4 px-md-6">
        <form id="kt_form_auto_backup_settings" action="{{ route('appsupport.backup-db.settings') }}" method="POST">
            @csrf

            <!-- 1. Toggle Status Aktivasi -->
            <div class="row mb-6 align-items-center">
                <label class="col-lg-4 col-form-label fw-bold fs-6 text-gray-800">
                    Status Otomatisasi Backup
                </label>
                <div class="col-lg-8 fv-row">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input h-25px w-45px" type="checkbox" name="enabled" value="1" id="kt_switch_auto_backup"
                            {{ !empty($autoSettings['enabled']) ? 'checked' : '' }} />
                        <label class="form-check-label text-gray-700 fw-semibold fs-7 ms-3" for="kt_switch_auto_backup">
                            Aktifkan backup database otomatis berbasis scheduler cron server
                        </label>
                    </div>
                    <div class="form-text text-muted fs-8">
                        Jika diaktifkan, Laravel Console Scheduler (<code>backup:auto-run</code>) akan membuat cadangan secara terjadwal di latar belakang.
                    </div>
                </div>
            </div>

            <!-- 2. Frekuensi Eksekusi -->
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-bold fs-6 text-gray-800">
                    Frekuensi Eksekusi
                </label>
                <div class="col-lg-8 fv-row">
                    <select name="frequency" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                        <option value="daily" {{ ($autoSettings['frequency'] ?? 'daily') === 'daily' ? 'selected' : '' }}>Setiap Hari (Daily)</option>
                        <option value="weekly" {{ ($autoSettings['frequency'] ?? '') === 'weekly' ? 'selected' : '' }}>Setiap Minggu (Weekly - Senin dini hari)</option>
                        <option value="monthly" {{ ($autoSettings['frequency'] ?? '') === 'monthly' ? 'selected' : '' }}>Setiap Bulan (Monthly - Tanggal 1)</option>
                    </select>
                    <div class="form-text text-muted fs-8">
                        Pilih interval waktu seberapa sering sistem akan mencadangkan database secara otomatis.
                    </div>
                </div>
            </div>

            <!-- 3. Jam Eksekusi -->
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-bold fs-6 text-gray-800">
                    Jam Eksekusi (Server Time)
                </label>
                <div class="col-lg-8 fv-row">
                    <input type="time" name="time" class="form-control form-control-solid w-200px" value="{{ $autoSettings['time'] ?? '01:00' }}" required />
                    <div class="form-text text-muted fs-8">
                        Disarankan memilih jam dini hari (misal 01:00 atau 02:00) saat aktivitas pengguna rendah.
                    </div>
                </div>
            </div>

            <!-- 4. Retensi Penyimpanan (Hari) -->
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-bold fs-6 text-gray-800">
                    Masa Retensi Cadangan
                </label>
                <div class="col-lg-8 fv-row">
                    <div class="input-group input-group-solid w-200px">
                        <input type="number" name="retention_days" class="form-control form-control-solid" min="1" max="365" value="{{ $autoSettings['retention_days'] ?? 7 }}" required />
                        <span class="input-group-text">Hari</span>
                    </div>
                    <div class="form-text text-muted fs-8">
                        Berkas cadangan yang umurnya melebihi batas retensi ini akan dihapus otomatis dari disk server untuk menghemat kapasitas storage.
                    </div>
                </div>
            </div>

            <!-- 5. Format Kompresi -->
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-bold fs-6 text-gray-800">
                    Kompresi Berkas (GZIP)
                </label>
                <div class="col-lg-8 fv-row">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input h-20px w-35px" type="checkbox" name="compression" value="1" id="kt_switch_compression"
                            {{ !empty($autoSettings['compression']) ? 'checked' : '' }} />
                        <label class="form-check-label text-gray-700 fw-semibold fs-7 ms-3" for="kt_switch_compression">
                            Kompresi hasil backup menjadi format <code>.sql.gz</code> (Menghemat hingga 80% ukuran file)
                        </label>
                    </div>
                </div>
            </div>

            <!-- 6. Cakupan Backup Otomatis -->
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-bold fs-6 text-gray-800">
                    Cakupan Tabel Cadangan
                </label>
                <div class="col-lg-8 fv-row">
                    <div class="d-flex align-items-center gap-6 mb-4">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="backup_type" value="full" id="kt_radio_scope_full"
                                {{ ($autoSettings['backup_type'] ?? 'full') === 'full' ? 'checked' : '' }} />
                            <label class="form-check-label text-gray-800 fw-bold fs-7" for="kt_radio_scope_full">
                                Seluruh Database (Semua Tabel)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="backup_type" value="selective" id="kt_radio_scope_selective"
                                {{ ($autoSettings['backup_type'] ?? '') === 'selective' ? 'checked' : '' }} />
                            <label class="form-check-label text-gray-800 fw-bold fs-7" for="kt_radio_scope_selective">
                                Tabel Tertentu (Selektif)
                            </label>
                        </div>
                    </div>

                    <!-- Pilihan Tabel Khusus Jika Selektif -->
                    <div id="kt_selective_tables_wrapper" class="{{ ($autoSettings['backup_type'] ?? 'full') === 'full' ? 'd-none' : '' }}">
                        <label class="form-label text-muted fs-8">Pilih tabel yang diikutsertakan dalam backup otomatis:</label>
                        <select name="selected_tables[]" id="kt_auto_selected_tables" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih beberapa tabel..." multiple="multiple">
                            @foreach($autoSettings['all_tables'] as $tbl)
                                <option value="{{ $tbl }}" {{ in_array($tbl, $autoSettings['selected_tables'] ?? []) ? 'selected' : '' }}>
                                    {{ $tbl }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan Form (Rata Kanan) -->
            <div class="d-flex justify-content-end pt-4 border-top">
                <button type="submit" class="btn btn-primary fw-bold" id="kt_btn_save_backup_settings">
                    <span class="indicator-label">
                        <i class="ki-outline ki-check fs-5 me-1"></i>
                        Simpan Pengaturan
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>
    <!--end::Card body-->
</div>
<!--end::Auto Backup Settings Card-->
