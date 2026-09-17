@extends('layouts.index')

@section('title', 'Database Backup & Relasi')

@section('toolbar')
    @include('layouts.partials._toolbar')
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <!--begin::Overview Header Banner & Statistics-->
        @include('pages.appsupport.partials.backup-db.header-banner')
        <!--end::Overview Header Banner & Statistics-->

        <!--begin::Navs Card-->
        <div class="card card-flush shadow-sm border-0 mb-6">
            <div class="card-header border-0 pt-2 px-6">
                @include('pages.appsupport.partials.backup-db.navs')
            </div>
        </div>
        <!--end::Navs Card-->

        <!--begin::Tab Content-->
        <div class="tab-content" id="kt_backup_db_tabs">
            <!--begin:::Tab pane 1: Tables & Relations-->
            <div class="tab-pane fade show active" id="kt_backup_tab_tables" role="tabpanel">
                @include('pages.appsupport.partials.backup-db.tabs.tables-relation')
            </div>
            <!--end:::Tab pane 1-->

            <!--begin:::Tab pane 2: Backup History-->
            <div class="tab-pane fade" id="kt_backup_tab_history" role="tabpanel">
                @include('pages.appsupport.partials.backup-db.tabs.backup-history')
            </div>
            <!--end:::Tab pane 2-->

            <!--begin:::Tab pane 3: Auto Backup Settings-->
            <div class="tab-pane fade" id="kt_backup_tab_settings" role="tabpanel">
                @include('pages.appsupport.partials.backup-db.tabs.auto-backup-settings')
            </div>
            <!--end:::Tab pane 3-->

            <!--begin:::Tab pane 4: Petunjuk Operasional-->
            <div class="tab-pane fade" id="kt_backup_tab_petunjuk" role="tabpanel">
                @include('pages.appsupport.partials.backup-db.backup-db-petunjuk')
            </div>
            <!--end:::Tab pane 4-->
        </div>
        <!--end::Tab Content-->

    </div>
    <!--end::Content container-->
</div>

<!--begin::Modal Detail Relasi-->
@include('pages.appsupport.partials.backup-db.modal-relation-detail')
<!--end::Modal Detail Relasi-->
@endsection

@section('scripts')
<script>
    window.BACKUP_ROUTES = {
        tables: "{{ route('appsupport.backup-db.tables') }}",
        tableDetail: "{{ url('appsupport/backup-db/tables') }}",
        createBackup: "{{ route('appsupport.backup-db.create') }}",
        downloadBackup: "{{ url('appsupport/backup-db/download') }}",
        deleteBackup: "{{ route('appsupport.backup-db.delete') }}",
        restoreBackup: "{{ route('appsupport.backup-db.restore') }}",
        saveSettings: "{{ route('appsupport.backup-db.settings') }}",
        testAuto: "{{ route('appsupport.backup-db.test-auto') }}",
        csrfToken: "{{ csrf_token() }}"
    };
</script>
<script src="{{ asset('assets/js/appsupport/backup-db.js') }}"></script>
@endsection
