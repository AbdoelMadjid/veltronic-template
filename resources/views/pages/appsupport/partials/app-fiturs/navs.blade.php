<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" id="app_fiturs_nav_tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary py-4 {{ ($active ?? 'visibility') === 'visibility' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_visibility">
            <i class="ki-outline ki-eye fs-4 me-2"></i> Visibilitas Fitur Dashboard
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary py-4 {{ ($active ?? '') === 'settings' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_settings">
            <i class="ki-outline ki-setting-2 fs-4 me-2"></i> Pengaturan Aplikasi (Settings)
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary py-4 {{ ($active ?? '') === 'shortcuts' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_shortcuts" id="tab_btn_shortcuts">
            <i class="ki-outline ki-keyboard fs-4 me-2"></i> Pintasan Keyboard (Shortcuts)
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary py-4 {{ ($active ?? '') === 'activity_logs' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_activity_logs" id="tab_btn_activity_logs">
            <i class="ki-outline ki-time fs-4 me-2"></i> Log Aktivitas Sistem
        </a>
    </li>
</ul>
<!--end::Navs-->
