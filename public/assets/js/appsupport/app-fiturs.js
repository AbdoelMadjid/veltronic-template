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
    // TAB 2: SYSTEM SETTINGS FORM HANDLING (AJAX)
    // ========================================================
    const settingsForm = document.getElementById('system_settings_form');
    const btnSaveSettings = document.getElementById('btn_save_system_settings');
    const btnExportConfig = document.getElementById('btn_export_features_config');
    const btnImportConfig = document.getElementById('btn_import_features_config');
    const importFileInput = document.getElementById('import_config_file_input');

    if (settingsForm) {
        settingsForm.addEventListener('submit', function (e) {
            e.preventDefault();
            if (btnSaveSettings) {
                btnSaveSettings.disabled = true;
                btnSaveSettings.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Menyimpan...`;
            }

            const formData = new FormData(settingsForm);

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

});
