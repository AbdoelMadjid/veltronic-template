<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" role="tablist">
    <!--begin::Nav item 1-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_backup_tab_tables" role="tab">
            Struktur & Relasi Tabel Database
        </a>
    </li>
    <!--end::Nav item 1-->

    <!--begin::Nav item 2-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_backup_tab_history" role="tab">
            Riwayat & Berkas Cadangan
            <span class="badge badge-light-primary fw-bolder fs-8 ms-2 px-2 py-1" id="badge_backup_files_count">{{ count($backupFiles) }}</span>
        </a>
    </li>
    <!--end::Nav item 2-->

    <!--begin::Nav item 3-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_backup_tab_settings" role="tab">
            Pengaturan Backup Otomatis
            @if(!empty($autoSettings['enabled']))
                <span class="badge badge-light-success fw-bolder fs-8 ms-2 px-2 py-1">Aktif</span>
            @else
                <span class="badge badge-light-danger fw-bolder fs-8 ms-2 px-2 py-1">Nonaktif</span>
            @endif
        </a>
    </li>
    <!--end::Nav item 3-->

    <!--begin::Nav item 4 (Petunjuk)-->
    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_backup_tab_petunjuk" role="tab">
            Petunjuk Operasional
        </a>
    </li>
    <!--end::Nav item 4-->
</ul>
<!--end::Navs-->
