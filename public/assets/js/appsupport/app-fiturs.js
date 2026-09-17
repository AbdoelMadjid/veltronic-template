/**
 * App Fiturs & Settings Module JavaScript
 * Path: public/assets/js/appsupport/app-fiturs.js
 */

document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    // Clean up any legacy localStorage key to ensure pure database-driven behavior
    try {
        localStorage.removeItem('veltronic_features_visibility_config');
    } catch(e) {}



    // ========================================================
    // STAT COUNTERS UPDATE
    // ========================================================
    function updateStatsFromData(stats) {
        if (!stats) return;
        const elTotalActive = document.getElementById('stat_total_active');
        const elTotalDisabled = document.getElementById('stat_total_disabled');
        const elTopbarActive = document.getElementById('stat_topbar_active');
        const elTopMenuActive = document.getElementById('stat_topmenu_active');
        const elSidebarActive = document.getElementById('stat_sidebar_active');

        if (elTotalActive && stats.active !== undefined) elTotalActive.innerText = stats.active;
        if (elTotalDisabled && stats.disabled !== undefined) elTotalDisabled.innerText = stats.disabled;
        if (elTopbarActive && stats.topbar_tools_total !== undefined) {
            elTopbarActive.innerText = `${stats.topbar_tools_active}/${stats.topbar_tools_total}`;
        }
        if (elTopMenuActive && stats.topbar_menus_total !== undefined) {
            elTopMenuActive.innerText = `${stats.topbar_menus_active}/${stats.topbar_menus_total}`;
        }
        if (elSidebarActive && stats.sidebar_menus_total !== undefined) {
            elSidebarActive.innerText = `${stats.sidebar_menus_active}/${stats.sidebar_menus_total}`;
        }
    }

    // ========================================================
    // DYNAMIC REALTIME ELEMENT VISIBILITY IN DOM
    // ========================================================
    function updateElementInDOM(key, isEnabled) {
        const targets = document.querySelectorAll(
            `[data-kt-feature-tool="${key}"], [data-kt-feature-menu="${key}"], [data-kt-feature-sidebar="${key}"]`
        );
        targets.forEach(el => {
            if (!isEnabled) {
                el.classList.add('feature-hidden');
                el.style.setProperty('display', 'none', 'important');
            } else {
                el.classList.remove('feature-hidden');
                el.classList.remove('d-none');
                el.style.removeProperty('display');
            }
        });
    }

    // ========================================================
    // SELECTION CHECKBOXES & DYNAMIC BULK ACTION TOOLBAR
    // ========================================================
    function updateSectionSelectionToolbar(category) {
        const sectionCheckboxes = document.querySelectorAll(`.feature-item-checkbox[data-category="${category}"]`);
        const checkedBoxes = document.querySelectorAll(`.feature-item-checkbox[data-category="${category}"]:checked`);
        const selectAllCheckbox = document.querySelector(`.select-all-section-checkbox[data-category="${category}"]`);
        const bulkToolbar = document.querySelector(`.bulk-selected-toolbar[data-category="${category}"]`);

        const count = checkedBoxes.length;
        const total = sectionCheckboxes.length;

        // Update select-all checkbox state
        if (selectAllCheckbox) {
            selectAllCheckbox.checked = (count > 0 && count === total);
            selectAllCheckbox.indeterminate = (count > 0 && count < total);
        }

        // Show/hide toolbar
        if (bulkToolbar) {
            const countEl = bulkToolbar.querySelector('.selected-count');
            if (countEl) countEl.innerText = count;

            if (count > 0) {
                bulkToolbar.classList.remove('d-none');
                bulkToolbar.classList.add('d-flex');
            } else {
                bulkToolbar.classList.remove('d-flex');
                bulkToolbar.classList.add('d-none');
            }
        }
    }

    // Initialize selection toolbar state for all categories on page load
    ['topbar_tools', 'topbar_menus', 'sidebar_menus'].forEach(cat => {
        updateSectionSelectionToolbar(cat);
    });

    // Select All Checkbox Handler
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('select-all-section-checkbox')) {
            const category = e.target.dataset.category;
            const isChecked = e.target.checked;
            const itemCheckboxes = document.querySelectorAll(`.feature-item-checkbox[data-category="${category}"]`);
            
            itemCheckboxes.forEach(cb => {
                cb.checked = isChecked;
            });

            updateSectionSelectionToolbar(category);
        }

        if (e.target.classList.contains('feature-item-checkbox')) {
            const category = e.target.dataset.category;
            updateSectionSelectionToolbar(category);
        }
    });

    // Bulk Apply (Aktifkan / Sembunyikan Item Terpilih)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-bulk-apply');
        if (btn) {
            const action = btn.dataset.action; // 'enable_selected', 'disable_selected'
            const category = btn.dataset.category;
            const isEnabled = (action === 'enable_selected');

            const checkedBoxes = document.querySelectorAll(`.feature-item-checkbox[data-category="${category}"]:checked`);
            const keys = Array.from(checkedBoxes).map(cb => cb.dataset.featureKey);

            if (keys.length === 0) {
                Notify.warning('Pilih setidaknya satu fitur terlebih dahulu.');
                return;
            }

            // Optimistic UI updates for selected items
            keys.forEach(key => {
                const card = document.querySelector(`.feature-card[data-feature-key="${key}"]`);
                if (card) {
                    card.setAttribute('data-is-enabled', isEnabled ? '1' : '0');
                    card.dataset.isEnabled = isEnabled ? '1' : '0';
                    const statusBadge = card.querySelector('.feature-status-badge');

                    if (isEnabled) {
                        card.classList.remove('bg-light', 'opacity-75');
                        if (statusBadge) {
                            statusBadge.className = 'badge badge-light-success fs-8 fw-semibold feature-status-badge mt-1';
                            statusBadge.innerText = 'Aktif';
                        }
                    } else {
                        card.classList.add('bg-light', 'opacity-75');
                        if (statusBadge) {
                            statusBadge.className = 'badge badge-light-danger fs-8 fw-semibold feature-status-badge mt-1';
                            statusBadge.innerText = 'Tersembunyi';
                        }
                    }
                }
                updateElementInDOM(key, isEnabled);
            });

            // Send AJAX to backend
            fetch('/appsupport/app-fiturs/bulk-toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    action: action,
                    category: category,
                    keys: keys
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Notify.success(data.message);
                    if (data.stats) {
                        updateStatsFromData(data.stats);
                    }
                    // Reset selection checkboxes after applying bulk action
                    checkedBoxes.forEach(cb => cb.checked = false);
                    updateSectionSelectionToolbar(category);

                    // Realtime sync to Activity Logs tab
                    if (activityLogsDt) {
                        activityLogsDt.ajax.reload(null, false);
                    }
                } else {
                    Notify.error(data.message || 'Gagal menjalankan aksi massal.');
                }
            })
            .catch(err => {
                console.error(err);
                Notify.error('Terjadi kesalahan saat memproses permintaan.');
            });
        }
    });

    // Single Feature Toggle via clicking status badge
    document.addEventListener('click', function (e) {
        const badge = e.target.closest('.feature-status-badge');
        if (badge) {
            const card = badge.closest('.feature-card');
            if (!card) return;

            const key = card.dataset.featureKey;
            const currentEnabled = card.getAttribute('data-is-enabled') === '1' || card.dataset.isEnabled === '1';
            const nextEnabled = !currentEnabled;

            // Optimistic UI update
            card.setAttribute('data-is-enabled', nextEnabled ? '1' : '0');
            card.dataset.isEnabled = nextEnabled ? '1' : '0';
            if (nextEnabled) {
                card.classList.remove('bg-light', 'opacity-75');
                badge.className = 'badge badge-light-success fs-8 fw-semibold feature-status-badge mt-1';
                badge.innerText = 'Aktif';
            } else {
                card.classList.add('bg-light', 'opacity-75');
                badge.className = 'badge badge-light-danger fs-8 fw-semibold feature-status-badge mt-1';
                badge.innerText = 'Tersembunyi';
            }
            updateElementInDOM(key, nextEnabled);

            fetch('/appsupport/app-fiturs/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    key: key,
                    is_enabled: nextEnabled ? 1 : 0
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Notify.success(data.message);
                    if (data.stats) {
                        updateStatsFromData(data.stats);
                    }
                    if (activityLogsDt) {
                        activityLogsDt.ajax.reload(null, false);
                    }
                } else {
                    Notify.error(data.message || 'Gagal mengubah status fitur.');
                }
            })
            .catch(err => {
                console.error(err);
                Notify.error('Terjadi kesalahan saat memproses permintaan.');
            });
        }
    });

    // ========================================================
    // BULK ACTIONS (RESET SEEDER)
    // ========================================================
    document.querySelectorAll('.btn-bulk-action').forEach(btn => {
        btn.addEventListener('click', function () {
            const action = this.dataset.action; // 'reset_all'
            const category = this.dataset.category || 'all';

            // For reset_all / reset_category
            const executeReset = () => {
                fetch('/appsupport/app-fiturs/bulk-toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        action: action,
                        category: category
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Notify.success(data.message);
                        if (data.stats) {
                            updateStatsFromData(data.stats);
                        }
                        // For seeder reset, update all cards back to enabled in DOM
                        document.querySelectorAll('.feature-card').forEach(card => {
                            card.setAttribute('data-is-enabled', '1');
                            card.dataset.isEnabled = '1';
                            card.classList.remove('bg-light', 'opacity-75');
                            const statusBadge = card.querySelector('.feature-status-badge');
                            if (statusBadge) {
                                statusBadge.className = 'badge badge-light-success fs-8 fw-semibold feature-status-badge mt-1';
                                statusBadge.innerText = 'Aktif';
                            }
                            const key = card.dataset.featureKey;
                            if (key) updateElementInDOM(key, true);
                        });

                        // Uncheck all selection checkboxes and hide toolbars
                        document.querySelectorAll('.feature-item-checkbox, .select-all-section-checkbox').forEach(cb => {
                            cb.checked = false;
                            cb.indeterminate = false;
                        });
                        ['topbar_tools', 'topbar_menus', 'sidebar_menus'].forEach(cat => {
                            updateSectionSelectionToolbar(cat);
                        });

                        if (activityLogsDt) {
                            activityLogsDt.ajax.reload(null, false);
                        }
                    } else {
                        Notify.error(data.message || 'Gagal menjalankan reset.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Notify.error('Terjadi kesalahan saat memproses permintaan.');
                });
            };

            Notify.confirm({
                text: 'Semua konfigurasi visibilitas fitur di database akan di-reset ke pengaturan awal.',
                icon: 'warning',
                confirmButtonText: 'Ya, Reset Sekarang!',
                cancelButtonText: 'Batal',
                onConfirm: executeReset
            });
        });
    });

    // ========================================================
    // SEARCH & FILTER FITUR
    // ========================================================
    const searchInput = document.getElementById('search_features_input');
    const filterStatusSelect = document.getElementById('filter_feature_status');

    function applyFeatureFilters() {
        const query = (searchInput?.value || '').toLowerCase().trim();
        const statusFilter = filterStatusSelect?.value || 'all'; // 'all', 'active', 'disabled'

        document.querySelectorAll('.feature-card-wrapper').forEach(wrapper => {
            const card = wrapper.querySelector('.feature-card');
            const title = (card?.querySelector('.feature-title')?.innerText || '').toLowerCase();
            const desc = (card?.querySelector('.feature-desc')?.innerText || '').toLowerCase();
            const isEnabled = card ? (card.getAttribute('data-is-enabled') === '1' || card.dataset.isEnabled === '1') : true;

            const matchesSearch = !query || title.includes(query) || desc.includes(query);
            let matchesStatus = true;
            if (statusFilter === 'active') matchesStatus = isEnabled;
            if (statusFilter === 'disabled') matchesStatus = !isEnabled;

            if (matchesSearch && matchesStatus) {
                wrapper.style.display = '';
            } else {
                wrapper.style.display = 'none';
            }
        });
    }

    if (searchInput) searchInput.addEventListener('input', applyFeatureFilters);
    if (filterStatusSelect) filterStatusSelect.addEventListener('change', applyFeatureFilters);

    // ========================================================
    // TAB 2: SYSTEM SETTINGS FORM & REALTIME SYNC
    // ========================================================
    const settingsForm = document.getElementById('system_settings_form');
    const btnSaveSettings = document.getElementById('btn_save_system_settings');
    const btnExportConfig = document.getElementById('btn_export_features_config');
    const btnImportConfig = document.getElementById('btn_import_features_config');
    const importFileInput = document.getElementById('import_config_file_input');

    // Sync radio card visual active state helper
    function syncRadioGroupVisual(groupName, selectedValue) {
        if (!settingsForm) return;
        const radios = settingsForm.querySelectorAll(`input[name="${groupName}"]`);
        radios.forEach(radio => {
            const isMatch = (radio.value === selectedValue);
            radio.checked = isMatch;
            const label = radio.closest('[data-kt-button]');
            if (label) {
                if (isMatch) {
                    label.classList.add('active');
                } else {
                    label.classList.remove('active');
                }
            }
        });
    }

    // Realtime sync when Icon Style is changed from toolbar / mobile hub
    function handleIconStyleChange(e) {
        const style = e.detail?.style || (typeof KTIconStyle !== 'undefined' ? KTIconStyle.getStyle() : null);
        if (style) {
            syncRadioGroupVisual('default_icon_style', style);
        }
    }

    document.documentElement.addEventListener('kt.iconstyle.change', handleIconStyleChange);

    // Bind change event to all radio buttons in settings form to ensure .active class consistency
    if (settingsForm) {
        settingsForm.addEventListener('change', function (e) {
            if (e.target && e.target.type === 'radio') {
                syncRadioGroupVisual(e.target.name, e.target.value);
            }
        });

        settingsForm.addEventListener('submit', function (e) {
            e.preventDefault();
            if (btnSaveSettings) {
                btnSaveSettings.disabled = true;
                btnSaveSettings.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Menyimpan...`;
            }

            const formData = new FormData(settingsForm);
            const chosenIconStyle = settingsForm.querySelector('input[name="default_icon_style"]:checked')?.value;

            fetch('/appsupport/app-fiturs/settings', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (btnSaveSettings) {
                    btnSaveSettings.disabled = false;
                    btnSaveSettings.innerHTML = `<i class="ki-duotone ki-check fs-4 me-2"><span class="path1"></span><span class="path2"></span></i> Simpan Pengaturan`;
                }

                if (data.success) {
                    // Instantly apply icon style to page if modified
                    if (chosenIconStyle && typeof KTIconStyle !== 'undefined' && KTIconStyle.setStyle) {
                        KTIconStyle.setStyle(chosenIconStyle, false);
                    }

                    // Instantly update lock screen lifetime
                    if (data.settings && data.settings.session_lifetime && typeof KTLockScreen !== 'undefined' && KTLockScreen.updateLifetime) {
                        KTLockScreen.updateLifetime(data.settings.session_lifetime);
                    }

                    if (activityLogsDt) {
                        activityLogsDt.ajax.reload(null, false);
                    }

                    Notify.alert({
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok, Mengerti'
                    });
                } else {
                    Notify.error(data.message || 'Gagal menyimpan pengaturan.');
                }
            })
            .catch(err => {
                console.error(err);
                if (btnSaveSettings) {
                    btnSaveSettings.disabled = false;
                    btnSaveSettings.innerHTML = `<i class="ki-duotone ki-check fs-4 me-2"><span class="path1"></span><span class="path2"></span></i> Simpan Pengaturan`;
                }
                Notify.error('Gagal terhubung ke server.');
            });
        });
    }

    // ========================================================
    // CACHE CLEANER ACTION BUTTONS
    // ========================================================
    document.querySelectorAll('.btn-clear-cache-action').forEach(btn => {
        btn.addEventListener('click', function () {
            const cacheType = this.dataset.cacheType || 'all';
            const originalHtml = this.innerHTML;

            this.disabled = true;
            this.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Membersihkan...`;

            fetch('/appsupport/app-fiturs/clear-cache', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ type: cacheType })
            })
            .then(res => res.json())
            .then(data => {
                this.disabled = false;
                this.innerHTML = originalHtml;
                if (data.success) {
                    Notify.success(data.message);
                    if (activityLogsDt) {
                        activityLogsDt.ajax.reload(null, false);
                    }
                } else {
                    Notify.error(data.message);
                }
            })
            .catch(err => {
                console.error(err);
                this.disabled = false;
                this.innerHTML = originalHtml;
                Notify.error('Gagal membersihkan cache.');
            });
        });
    });

    // ========================================================
    // TAB 3: SYSTEM ACTIVITY LOGS (DATATABLES & ZERO-RELOAD)
    // ========================================================
    let activityLogsDt = null;
    const tableEl = document.getElementById('kt_activity_logs_table');

    function initActivityLogsDataTable() {
        if (!tableEl || activityLogsDt || typeof $ === 'undefined' || !$.fn.DataTable) return;

        activityLogsDt = $(tableEl).DataTable({
            processing: true,
            serverSide: true,
            order: [[6, 'desc']], // Waktu kejadian
            ajax: {
                url: '/appsupport/app-fiturs/activity-logs',
                type: 'GET',
                data: function (d) {
                    d.module = $('#filter_log_module').val() || 'all';
                    d.level = $('#filter_log_level').val() || 'all';
                    d.date_range = $('#filter_log_date_range').val() || '';
                    d.search = $('#log_search_input').val() || '';
                },
                dataSrc: function (json) {
                    if (json.stats) {
                        updateActivityLogStats(json.stats);
                    }
                    return json.data;
                },
                error: function (xhr, error, thrown) {
                    console.error('Error loading activity logs:', thrown);
                }
            },
            columns: [
                {
                    data: null,
                    className: 'text-center text-muted fs-7',
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'user',
                    orderable: false,
                    render: function (data) {
                        if (!data) return '-';
                        return `
                            <div class="d-flex align-items-center">
                                ${data.avatar_html}
                                <div class="d-flex flex-column">
                                    <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-7">${data.name}</span>
                                    <span class="text-muted fs-8">${data.email}</span>
                                </div>
                            </div>
                        `;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function (data) {
                        return `
                            <div class="d-flex flex-column gap-1">
                                <div>${data.module_badge}</div>
                                <span class="text-muted fs-8 font-monospace">${data.menu}</span>
                            </div>
                        `;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function (data) {
                        const shortDesc = data.description && data.description.length > 70 
                            ? data.description.substring(0, 70) + '...' 
                            : (data.description || '-');
                        return `
                            <div class="d-flex flex-column">
                                <span class="text-gray-900 fw-bold fs-7 mb-1">${data.activity}</span>
                                <span class="text-muted fs-8" title="${data.description || ''}">${shortDesc}</span>
                            </div>
                        `;
                    }
                },
                {
                    data: 'level_badge',
                    className: 'text-center',
                    orderable: true
                },
                {
                    data: null,
                    orderable: false,
                    render: function (data) {
                        return `
                            <div class="d-flex flex-column">
                                <span class="text-gray-800 font-monospace fs-8 fw-semibold">${data.ip_address}</span>
                                <span class="text-muted fs-8" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${data.user_agent}">
                                    ${data.user_agent}
                                </span>
                            </div>
                        `;
                    }
                },
                {
                    data: null,
                    orderable: true,
                    render: function (data) {
                        return `
                            <div class="d-flex flex-column">
                                <span class="text-gray-800 fw-semibold fs-7">${data.created_at_formatted}</span>
                                <span class="text-muted fs-8">${data.created_at_relative}</span>
                            </div>
                        `;
                    }
                },
                {
                    data: null,
                    className: 'text-end',
                    orderable: false,
                    render: function (data) {
                        const jsonStr = encodeURIComponent(JSON.stringify(data));
                        return `
                            <button type="button" class="btn btn-icon btn-light-primary btn-sm btn-view-log-detail"
                                data-log-data="${jsonStr}" data-bs-toggle="tooltip" title="Lihat Rincian Lengkap">
                                <i class="ki-outline ki-eye fs-4"></i>
                            </button>
                        `;
                    }
                }
            ],
            language: {
                search: "",
                searchPlaceholder: "Cari data...",
                lengthMenu: "Tampilkan _MENU_",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data log",
                infoEmpty: "Menampilkan 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                zeroRecords: "Tidak ada riwayat aktivitas yang sesuai filter",
                loadingRecords: "Memuat rekaman log...",
                processing: '<span class="spinner-border spinner-border-sm text-primary me-2"></span> Memproses...',
                paginate: {
                    first: '<i class="ki-outline ki-double-left fs-4"></i>',
                    last: '<i class="ki-outline ki-double-right fs-4"></i>',
                    next: '<i class="ki-outline ki-right fs-4"></i>',
                    previous: '<i class="ki-outline ki-left fs-4"></i>'
                }
            },
            dom: "<'row'<'col-sm-12'tr>><'row align-items-center mt-4'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'li><'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>",
            drawCallback: function () {
                if (typeof KTComponents !== 'undefined' && KTComponents.initTooltips) {
                    KTComponents.initTooltips();
                }
            }
        });
    }

    function updateActivityLogStats(stats) {
        if (!stats) return;
        const setVal = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.innerText = Number(val || 0).toLocaleString('id-ID');
        };

        setVal('stat_total_logs', stats.total_logs);
        setVal('stat_today_logs', stats.today_logs);
        setVal('stat_error_logs', stats.error_logs);
        setVal('stat_um_logs', stats.user_management_logs);
        setVal('stat_app_logs', stats.app_support_logs);
        setVal('stat_profil_logs', stats.profil_logs);
    }

    // Auto-init or tab switch listener (both native Bootstrap and jQuery)
    const logTabPane = document.getElementById('kt_app_fiturs_tab_activity_logs');
    if (logTabPane && logTabPane.classList.contains('active')) {
        initActivityLogsDataTable();
    }

    // Tab change event via document delegation
    document.addEventListener('shown.bs.tab', function (e) {
        const target = e.target.getAttribute('href') || e.target.getAttribute('data-bs-target');
        if (target === '#kt_app_fiturs_tab_activity_logs') {
            if (!activityLogsDt) {
                initActivityLogsDataTable();
            } else {
                activityLogsDt.ajax.reload(null, false);
            }
        }
    });

    if (typeof $ !== 'undefined') {
        $(document).on('shown.bs.tab', 'a[data-bs-toggle="tab"]', function (e) {
            const target = $(this).attr('href') || $(this).data('bs-target');
            if (target === '#kt_app_fiturs_tab_activity_logs') {
                if (!activityLogsDt) {
                    initActivityLogsDataTable();
                } else {
                    activityLogsDt.ajax.reload(null, false);
                }
            }
        });
    }

    // Filter listeners
    $('#filter_log_module, #filter_log_level, #filter_log_date_range').on('change', function () {
        if (activityLogsDt) {
            activityLogsDt.ajax.reload();
        }
    });

    // Debounced search input
    let searchDebounceTimeout = null;
    const logSearchInput = document.getElementById('log_search_input');
    if (logSearchInput) {
        logSearchInput.addEventListener('input', function () {
            clearTimeout(searchDebounceTimeout);
            searchDebounceTimeout = setTimeout(function () {
                if (activityLogsDt) {
                    activityLogsDt.ajax.reload();
                }
            }, 300);
        });
    }

    // Reset filters
    const btnResetLogFilter = document.getElementById('btn_reset_log_filter');
    if (btnResetLogFilter) {
        btnResetLogFilter.addEventListener('click', function () {
            if (logSearchInput) logSearchInput.value = '';
            $('#filter_log_module').val('all').trigger('change.select2');
            $('#filter_log_level').val('all').trigger('change.select2');
            $('#filter_log_date_range').val('').trigger('change.select2');
            if (activityLogsDt) {
                activityLogsDt.ajax.reload();
            }
        });
    }

    // Refresh button
    const btnRefreshLogs = document.getElementById('btn_refresh_logs');
    if (btnRefreshLogs) {
        btnRefreshLogs.addEventListener('click', function () {
            if (activityLogsDt) {
                activityLogsDt.ajax.reload(null, false);
                Notify.success('Data riwayat log berhasil diperbarui.');
            }
        });
    }

    // Detail Modal Handler
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-view-log-detail');
        if (btn) {
            try {
                const rawJson = decodeURIComponent(btn.dataset.logData);
                const log = JSON.parse(rawJson);

                document.getElementById('modal_log_title').innerText = log.activity || 'Rincian Log Aktivitas';
                document.getElementById('modal_log_subtitle').innerText = `ID Rekaman #${log.id} • ${log.created_at_formatted}`;
                document.getElementById('modal_log_level_badge').innerHTML = log.level_badge || '';
                document.getElementById('modal_log_module_badge').innerHTML = log.module_badge || '';
                document.getElementById('modal_log_menu_badge').innerText = `Menu: ${log.menu || '-'}`;
                document.getElementById('modal_log_time').innerText = `${log.created_at_formatted} (${log.created_at_relative})`;

                const userContainer = document.getElementById('modal_log_user_info');
                if (userContainer) {
                    userContainer.innerHTML = `
                        ${log.user?.avatar_html || ''}
                        <div class="d-flex flex-column">
                            <span class="fs-7 fw-bold text-gray-900">${log.user?.name || 'Sistem'}</span>
                            <span class="fs-8 text-muted">${log.user?.email || '-'} • <span class="badge badge-light-primary fs-9">${log.user?.role || 'System'}</span></span>
                        </div>
                    `;
                }

                document.getElementById('modal_log_ip').innerText = log.ip_address || '-';
                document.getElementById('modal_log_description').innerText = log.description || 'Tidak ada keterangan tambahan.';
                document.getElementById('modal_log_user_agent').innerText = log.user_agent || '-';

                const modalEl = document.getElementById('modal_activity_log_detail');
                if (modalEl && typeof bootstrap !== 'undefined') {
                    const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modal.show();
                }
            } catch (err) {
                console.error('Failed to parse log detail:', err);
            }
        }
    });

});


