<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" role="tablist">
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($active ?? 'overview') === 'overview' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_overview">{{ __('menu.overview') }}</a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($active ?? '') === 'settings' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_settings">{{ __('menu.settings') }}</a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($active ?? '') === 'security' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_security">{{ __('menu.security') }}</a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($active ?? '') === 'activity' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_activity">{{ __('menu.activity') }}</a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($active ?? '') === 'billing' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_billing">{{ __('menu.billing') }}</a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($active ?? '') === 'statements' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_statements">{{ __('menu.statements') }}</a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($active ?? '') === 'referrals' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_referrals">{{ __('menu.referrals') }}</a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($active ?? '') === 'api-keys' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_api_keys">{{ __('menu.api_keys') }}</a>
    </li>
    <li class="nav-item mt-2" role="presentation">
        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ ($active ?? '') === 'logs' ? 'active' : '' }}"
            data-bs-toggle="tab" role="tab" href="#kt_user_profile_tab_logs">{{ __('menu.logs') }}</a>
    </li>
</ul>
