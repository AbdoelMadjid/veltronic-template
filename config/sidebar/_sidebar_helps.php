<?php

return [

    'help_menus' => [
        [
            'title'     => 'Skema Pemrograman',
            'title_key' => 'skema_pemrograman',
            'icon'      => 'ki-duotone ki-book-open fs-2',
            'paths'     => 2,
            'children'  => [
                [
                    'title'     => 'Overview',
                    'title_key' => 'overview',
                    'route'     => 'help.pemrograman.overview',
                ],
                [
                    'title'     => 'Skema',
                    'title_key' => 'skema',
                    'children'  => [
                        [
                            'title'     => 'Skema Route',
                            'title_key' => 'skema_route',
                            'route'     => 'help.pemrograman.skema.route',
                        ],
                        [
                            'title'     => 'Skema Layout',
                            'title_key' => 'skema_layout',
                            'route'     => 'help.pemrograman.skema.layout',
                        ],
                        [
                            'title'     => 'Skema Komponen Blade & Partial',
                            'title_key' => 'skema_komponen_blade_and_partial',
                            'route'     => 'help.pemrograman.skema.komponen-blade-partial',
                        ],
                        [
                            'title'     => 'Skema Theme Assets',
                            'title_key' => 'skema_theme_assets',
                            'route'     => 'help.pemrograman.skema.theme-assets',
                        ],
                        [
                            'title'     => 'Skema Auth dan Middleware',
                            'title_key' => 'skema_auth_dan_middleware',
                            'route'     => 'help.pemrograman.skema.auth-dan-middleware',
                        ],
                        [
                            'title'     => 'Skema Struktur Config Menu',
                            'title_key' => 'skema_struktur_config_menu',
                            'route'     => 'help.pemrograman.skema.struktur-config-menu',
                        ],
                        [
                            'title'     => 'Skema Sidebar Menu',
                            'title_key' => 'skema_sidebar_menu',
                            'route'     => 'help.pemrograman.skema.sidebar-menu',
                        ],
                        [
                            'title'     => 'Skema Header Menu',
                            'title_key' => 'skema_header_menu',
                            'route'     => 'help.pemrograman.skema.header-menu',
                        ],
                        [
                            'title'     => 'Skema Data Layer',
                            'title_key' => 'skema_data_layer',
                            'route'     => 'help.pemrograman.skema.data-layer',
                        ],
                        [
                            'title'     => 'Skema Error Handling & Fallback',
                            'title_key' => 'skema_error_handling_and_fallback',
                            'route'     => 'help.pemrograman.skema.error-handling-dan-fallback',
                        ],
                        [
                            'title'     => 'Skema Cache & Deployment',
                            'title_key' => 'skema_cache_and_deployment',
                            'route'     => 'help.pemrograman.skema.cache-dan-deployment',
                        ],
                        [
                            'title'     => 'Skema Pemilihan Bahasa',
                            'title_key' => 'skema_pemilihan_bahasa',
                            'route'     => 'help.pemrograman.skema.pemilihan-bahasa',
                        ],
                        [
                            'title'     => 'Skema i18n Lanjutan',
                            'title_key' => 'skema_i18n_lanjutan',
                            'route'     => 'help.pemrograman.skema.i18n-lanjutan',
                        ],
                        [
                            'title'     => 'Skema Pergantian Versi Tampilan',
                            'title_key' => 'skema_pergantian_versi_tampilan',
                            'route'     => 'help.pemrograman.skema.pergantian-versi-tampilan',
                        ],
                        [
                            'title'     => 'Skema Pergantian Frontpage',
                            'title_key' => 'skema_pergantian_frontpage',
                            'route'     => 'help.pemrograman.skema.pergantian-frontpage',
                        ],
                        [
                            'title'     => 'Skema Pergantian Icon',
                            'title_key' => 'skema_pergantian_icon',
                            'route'     => 'help.pemrograman.skema.pergantian-icon',
                        ],
                        [
                            'title'     => 'Skema Page Title & Breadcrumb',
                            'title_key' => 'skema_page_title_and_breadcrumb',
                            'route'     => 'help.pemrograman.skema.page-title-dan-breadcrumbs',
                        ],
                        [
                            'title'     => 'Skema Keyboard Shortcuts',
                            'title_key' => 'skema_keyboard_shortcuts',
                            'route'     => 'help.pemrograman.skema.keyboard-shortcuts',
                        ],
                        [
                            'title'     => 'Skema Audit Log & Error Tracking',
                            'title_key' => 'skema_audit_log_dan_error_tracking',
                            'route'     => 'help.pemrograman.skema.audit-log-dan-error-tracking',
                        ],
                        [
                            'title'     => 'Skema Database Backup & Relasi',
                            'title_key' => 'skema_database_backup_dan_relasi',
                            'route'     => 'help.pemrograman.skema.database-backup-dan-relasi-tabel',
                        ],
                        [
                            'title'     => 'Skema Profil Pengguna & Avatar Studio',
                            'title_key' => 'skema_profil_pengguna_dan_avatar_studio',
                            'route'     => 'help.pemrograman.skema.profil-pengguna-dan-avatar-studio',
                        ],
                    ],
                ],
                [
                    'title'     => 'Operasional',
                    'title_key' => 'operasional',
                    'children'  => [
                        [
                            'title'     => 'Panduan Tambah Halaman',
                            'title_key' => 'panduan_tambah_halaman',
                            'route'     => 'help.pemrograman.operasional.panduan-tambah-halaman',
                        ],
                        [
                            'title'     => 'Panduan Tambah Menu',
                            'title_key' => 'panduan_tambah_menu',
                            'route'     => 'help.pemrograman.operasional.panduan-tambah-menu',
                        ],
                        [
                            'title'     => 'Panduan Pergantian Versi Metronic',
                            'title_key' => 'panduan_pergantian_versi_metronic',
                            'route'     => 'help.pemrograman.operasional.panduan-pergantian-versi-metronic',
                        ],
                        [
                            'title'     => 'Panduan Pergantian Frontpage',
                            'title_key' => 'panduan_pergantian_frontpage',
                            'route'     => 'help.pemrograman.operasional.panduan-pergantian-frontpage',
                        ],
                        [
                            'title'     => 'Panduan Page Title & Breadcrumb',
                            'title_key' => 'panduan_page_title_and_breadcrumb',
                            'route'     => 'help.pemrograman.operasional.panduan-page-title-dan-breadcrumbs',
                        ],
                        [
                            'title'     => 'Panduan Keyboard Shortcuts',
                            'title_key' => 'panduan_keyboard_shortcuts',
                            'route'     => 'help.pemrograman.operasional.panduan-keyboard-shortcuts',
                        ],
                        [
                            'title'     => 'Panduan Audit Log & Error',
                            'title_key' => 'panduan_audit_log_dan_error',
                            'route'     => 'help.pemrograman.operasional.panduan-audit-log-dan-investigasi-error',
                        ],
                        [
                            'title'     => 'Panduan Backup & Restore DB',
                            'title_key' => 'panduan_backup_dan_restore_db',
                            'route'     => 'help.pemrograman.operasional.panduan-backup-dan-restore-database',
                        ],
                        [
                            'title'     => 'Panduan Zero-Reload & Loading',
                            'title_key' => 'panduan_zero_reload_dan_loading',
                            'route'     => 'help.pemrograman.operasional.panduan-standar-zero-reload-dan-button-loading',
                        ],
                        [
                            'title'     => 'Konvensi Penamaan',
                            'title_key' => 'konvensi_penamaan',
                            'route'     => 'help.pemrograman.operasional.konvensi-penamaan',
                        ],
                        [
                            'title'     => 'Workflow Developer Harian',
                            'title_key' => 'workflow_developer_harian',
                            'route'     => 'help.pemrograman.operasional.workflow-developer-harian',
                        ],
                        [
                            'title'     => 'Checklist QA Smoke Test',
                            'title_key' => 'checklist_qa_smoke_test',
                            'route'     => 'help.pemrograman.operasional.checklist-qa-smoke-test',
                        ],
                        [
                            'title'     => 'Playbook Incident Response',
                            'title_key' => 'playbook_incident_response',
                            'route'     => 'help.pemrograman.operasional.playbook-incident-response',
                        ],
                    ],
                ],
                [
                    'title'     => 'Log',
                    'title_key' => 'log',
                    'children'  => [
                        [
                            'title'     => 'Changelog',
                            'title_key' => 'changelog',
                            'route'     => 'help.log.changelog',
                        ],
                        [
                            'title'     => 'Console Developer',
                            'title_key' => 'console_developer',
                            'route'     => 'help.log.console-developer',
                        ],
                    ],
                ],
            ],
        ],
        [
            'title'     => 'Components',
            'title_key' => 'components',
            'icon'      => 'ki-duotone ki-rocket fs-2',
            'paths'     => 2,
            'route'     => 'docs.base.utilities',
            'target'    => '_blank',
        ],
        [
            'title'     => 'Documentation',
            'title_key' => 'documentation',
            'icon'      => 'ki-duotone ki-abstract-26 fs-2',
            'paths'     => 2,
            'route'     => 'docs.index',
            'target'    => '_blank',
        ],
        [
            'title'     => 'Changelog',
            'title_key' => 'changelog',
            'icon'      => 'ki-duotone ki-code fs-2',
            'paths'     => 4,
            'route'     => 'docs.getting-started.changelog',
            'badge'     => ['label' => 'v 8.3.2', 'class' => 'badge badge-danger'],
            'target'    => '_blank',
        ],
    ],
];
