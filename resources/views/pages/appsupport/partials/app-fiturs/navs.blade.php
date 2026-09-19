<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold overflow-x-auto overflow-y-hidden flex-nowrap" id="app_fiturs_nav_tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? 'visibility') === 'visibility' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_visibility"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Visibilitas Fitur Dashboard"
            aria-selected="{{ ($active ?? 'visibility') === 'visibility' ? 'true' : 'false' }}">
            <i class="ki-outline ki-eye fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Visibilitas Fitur Dashboard</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'settings' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_settings"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pengaturan Aplikasi"
            aria-selected="{{ ($active ?? '') === 'settings' ? 'true' : 'false' }}">
            <i class="ki-outline ki-setting-2 fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Pengaturan Aplikasi</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'shortcuts' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_shortcuts" id="tab_btn_shortcuts"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pintasan Keyboard"
            aria-selected="{{ ($active ?? '') === 'shortcuts' ? 'true' : 'false' }}">
            <i class="ki-outline ki-keyboard fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Pintasan Keyboard</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary d-flex align-items-center me-3 me-md-6 py-4 {{ ($active ?? '') === 'activity_logs' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_activity_logs" id="tab_btn_activity_logs"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Log Aktivitas Sistem"
            aria-selected="{{ ($active ?? '') === 'activity_logs' ? 'true' : 'false' }}">
            <i class="ki-outline ki-time fs-2 fs-md-4 me-0 me-md-2"></i>
            <span class="d-none d-md-inline">Log Aktivitas Sistem</span>
        </a>
    </li>
</ul>
<!--end::Navs-->
