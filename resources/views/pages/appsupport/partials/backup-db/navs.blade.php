<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold overflow-x-auto overflow-y-hidden flex-nowrap" id="backup_db_nav_tabs" role="tablist">
    <!--begin::Nav item 1-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 active"
            data-bs-toggle="tab" role="tab" href="#kt_backup_tab_tables"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Struktur & Relasi Tabel Database"
            aria-selected="true">
            <i class="ki-outline ki-element-11 fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Struktur & Relasi Tabel</span>
        </a>
    </li>
    <!--end::Nav item 1-->

    <!--begin::Nav item 2-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4"
            data-bs-toggle="tab" role="tab" href="#kt_backup_tab_history"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Riwayat & Berkas Cadangan"
            aria-selected="false">
            <i class="ki-outline ki-folder-down fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Riwayat & Berkas Cadangan</span>
            <span class="badge badge-light-primary fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1" id="badge_backup_files_count">{{ count($backupFiles) }}</span>
        </a>
    </li>
    <!--end::Nav item 2-->

    <!--begin::Nav item 3-->
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4"
            data-bs-toggle="tab" role="tab" href="#kt_backup_tab_settings"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pengaturan Backup Otomatis"
            aria-selected="false">
            <i class="ki-outline ki-setting-3 fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Pengaturan Backup Otomatis</span>
            @if(!empty($autoSettings['enabled']))
                <span class="badge badge-light-success fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1">Aktif</span>
            @else
                <span class="badge badge-light-danger fw-bolder fs-8 ms-1 ms-md-2 px-2 py-1">Nonaktif</span>
            @endif
        </a>
    </li>
    <!--end::Nav item 3-->
</ul>
<!--end::Navs-->
