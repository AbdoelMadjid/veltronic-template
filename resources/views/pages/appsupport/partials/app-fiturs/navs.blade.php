<!--begin::Navs-->
<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" id="app_fiturs_nav_tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary py-4 {{ ($active ?? 'visibility') === 'visibility' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_visibility">
            Visibilitas Fitur Dashboard
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link text-active-primary py-4 {{ ($active ?? '') === 'settings' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_app_fiturs_tab_settings">
            Pengaturan Aplikasi (Settings)
        </a>
    </li>
</ul>
<!--end::Navs-->
