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
    function syncMobileHubVisibility() {
        const hubMenus = document.querySelectorAll('#kt_mobile_toolbar_hub_menu');
        hubMenus.forEach(hub => {
            const tabsContainer = hub.querySelector('.mobile-hub-tabs');
            if (!tabsContainer) return;

            const toolButtons = tabsContainer.querySelectorAll('[data-kt-feature-tool]');
            let hasVisibleButtons = false;
            toolButtons.forEach(btn => {
                const isHidden = btn.classList.contains('feature-hidden') || btn.style.display === 'none';
                if (!isHidden) {
                    hasVisibleButtons = true;
                }
            });

            const hubTriggers = document.querySelectorAll('[data-kt-feature-mobile-hub="true"]');
            hubTriggers.forEach(trigger => {
                if (!hasVisibleButtons) {
                    trigger.classList.add('feature-hidden');
                    trigger.style.setProperty('display', 'none', 'important');
                } else {
                    trigger.classList.remove('feature-hidden');
                    trigger.style.removeProperty('display');
                }
            });

            // If active panel is now hidden, collapse panel
            const activeBtn = tabsContainer.querySelector('.mobile-hub-tab-btn.active');
            if (activeBtn && (activeBtn.classList.contains('feature-hidden') || activeBtn.style.display === 'none')) {
                activeBtn.classList.remove('active');
                const panelsContainer = hub.querySelector('.mobile-hub-panels');
                if (panelsContainer) panelsContainer.classList.add('d-none');
                const panels = hub.querySelectorAll('.mobile-hub-panel');
                panels.forEach(p => p.classList.add('d-none'));
            }
        });
    }

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
                el.style.removeProperty('display');
            }
        });

        syncMobileHubVisibility();
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
                    btnSaveSettings.innerHTML = `<i class="ki-outline ki-check fs-4 me-1 text-white"></i> Simpan Pengaturan`;
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
                    btnSaveSettings.innerHTML = `<i class="ki-outline ki-check fs-4 me-1 text-white"></i> Simpan Pengaturan`;
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
    // TAB 3: KEYBOARD SHORTCUTS MANAGER INTERACTIONS (2-COLUMN CRUD)
    // ========================================================
    const masterShortcutsSwitch = document.getElementById('global_shortcuts_master_switch');
    if (masterShortcutsSwitch) {
        masterShortcutsSwitch.addEventListener('change', function () {
            const isEnabled = this.checked;
            if (typeof KTAppShortcuts !== 'undefined') {
                KTAppShortcuts.setEnabled(isEnabled);
            }
            if (isEnabled) {
                Notify.success('Pintasan keyboard global diaktifkan.');
            } else {
                Notify.info('Pintasan keyboard global dinonaktifkan sementara.');
            }
        });
    }

    const formShortcut = document.getElementById('form_shortcut_manage');
    const btnSaveShortcut = document.getElementById('btn_save_shortcut_manage');
    const btnResetShortcutForm = document.getElementById('btn_reset_shortcut_form');
    const btnNewShortcutFocus = document.getElementById('btn_new_shortcut_focus');
    const targetSelect = document.getElementById('shortcut_target_select');
    const customTargetWrapper = document.getElementById('wrapper_custom_target');
    const customTargetValInput = document.getElementById('custom_target_value_input');
    const hiddenActionType = document.getElementById('hidden_action_type');
    const hiddenActionTarget = document.getElementById('hidden_action_target');
    const inputKey = document.getElementById('shortcut_input_key');
    const inputName = document.getElementById('shortcut_input_name');
    const checkCtrl = document.getElementById('shortcut_check_ctrl');
    const checkAlt = document.getElementById('shortcut_check_alt');
    const checkShift = document.getElementById('shortcut_check_shift');
    const liveBadgePreview = document.getElementById('shortcut_live_badge_preview');
    const roleCheckAll = document.getElementById('shortcut_role_all');
    const searchShortcutsInput = document.getElementById('shortcut_table_search');
    const conflictWarningEl = document.getElementById('shortcut_conflict_warning');
    const conflictMsgEl = document.getElementById('conflict_warning_message');

    let currentSelectedCategory = 'visibility';
    let currentTableCategoryFilter = 'all';

    // 1. Live Badge Preview & Conflict Detector Helper
    function updateLiveBadgePreview() {
        if (!liveBadgePreview) return;
        const key = (inputKey?.value || 'T').toUpperCase();
        const parts = [];
        if (checkCtrl?.checked) parts.push('Ctrl');
        if (checkAlt?.checked) parts.push('Alt');
        if (checkShift?.checked) parts.push('Shift');
        parts.push(key || '?');

        const comboString = parts.join(' + ');
        liveBadgePreview.innerHTML = `<kbd class="bg-primary text-white px-2 py-1 rounded fw-bold fs-8 shadow-sm">${comboString}</kbd>`;

        // Conflict check against other shortcuts
        checkShortcutConflict(parts.join(' + ').toLowerCase());
    }

    function checkShortcutConflict(currentComboLower) {
        if (!conflictWarningEl) return;
        const currentId = document.getElementById('shortcut_form_id')?.value;
        const rows = document.querySelectorAll('.shortcut-row');
        let conflictingName = null;

        rows.forEach(row => {
            const rowId = row.dataset.id;
            if (currentId && rowId === currentId) return;

            const comboBadge = row.querySelector('.shortcut-combo-badge');
            const rowCombo = comboBadge ? comboBadge.innerText.toLowerCase().trim() : '';
            if (rowCombo && rowCombo === currentComboLower) {
                const nameEl = row.querySelector('.shortcut-name-text');
                conflictingName = nameEl ? nameEl.innerText.trim() : 'Pintasan lain';
            }
        });

        if (conflictingName) {
            conflictWarningEl.classList.remove('d-none');
            if (conflictMsgEl) {
                conflictMsgEl.innerHTML = `Peringatan: Tombol ini sudah dipakai oleh <strong>"${conflictingName}"</strong>.`;
            }
        } else {
            conflictWarningEl.classList.add('d-none');
        }
    }

    if (inputKey) inputKey.addEventListener('input', updateLiveBadgePreview);
    [checkCtrl, checkAlt, checkShift].forEach(chk => {
        if (chk) chk.addEventListener('change', updateLiveBadgePreview);
    });

    // 2. Populate Target Select based on Selected Category
    function populateTargetOptionsForCategory(catKey, preserveTarget = null) {
        if (!targetSelect || !window.SHORTCUT_CATEGORIES_CATALOG) return;

        const catalog = window.SHORTCUT_CATEGORIES_CATALOG[catKey];
        if (!catalog) return;

        // Clear existing options
        $(targetSelect).empty();

        const targets = catalog.targets || [];
        targets.forEach(tgt => {
            const opt = new Option(tgt.label, tgt.id, false, false);
            opt.setAttribute('data-type', tgt.type || 'open_url');
            opt.setAttribute('data-target', tgt.target || '');
            opt.setAttribute('data-name', tgt.default_name || tgt.label || '');
            opt.setAttribute('data-key', tgt.default_key || '');
            opt.setAttribute('data-ctrl', tgt.default_ctrl ? '1' : '0');
            opt.setAttribute('data-alt', tgt.default_alt ? '1' : '0');
            opt.setAttribute('data-shift', tgt.default_shift ? '1' : '0');
            targetSelect.appendChild(opt);
        });

        if (preserveTarget) {
            $(targetSelect).val(preserveTarget).trigger('change');
        } else if (targets.length > 0) {
            $(targetSelect).val(targets[0].id).trigger('change');
        }
    }

    // 3. Category Selector Grid Click Handlers
    document.querySelectorAll('.btn-category-select').forEach(btn => {
        btn.addEventListener('click', function () {
            const cat = this.dataset.category;
            if (!cat) return;

            document.querySelectorAll('.btn-category-select').forEach(b => {
                b.classList.remove('active', 'btn-primary', 'btn-info', 'btn-success', 'btn-danger', 'btn-warning');
                b.classList.add('btn-outline');
            });

            this.classList.add('active');
            currentSelectedCategory = cat;

            // Update badge & hint
            const catalog = window.SHORTCUT_CATEGORIES_CATALOG ? window.SHORTCUT_CATEGORIES_CATALOG[cat] : null;
            if (catalog) {
                const badgeSelected = document.getElementById('badge_selected_category');
                if (badgeSelected) {
                    badgeSelected.innerText = catalog.name;
                    badgeSelected.className = `badge ${catalog.badge_class} fs-9`;
                }
                const hintEl = document.getElementById('category_description_hint');
                if (hintEl) {
                    hintEl.innerText = catalog.description;
                }
            }

            populateTargetOptionsForCategory(cat);
        });
    });

    // 4. Target Selection Dropdown Change Handler
    if (targetSelect) {
        $(targetSelect).on('change', function () {
            const selectedOpt = this.options[this.selectedIndex];
            if (!selectedOpt) return;

            const val = this.value;
            const type = selectedOpt.getAttribute('data-type') || 'open_url';
            const target = selectedOpt.getAttribute('data-target') || '';
            const defaultName = selectedOpt.getAttribute('data-name') || '';
            const defaultKey = selectedOpt.getAttribute('data-key') || '';
            const defaultCtrl = selectedOpt.getAttribute('data-ctrl') === '1';
            const defaultAlt = selectedOpt.getAttribute('data-alt') === '1';
            const defaultShift = selectedOpt.getAttribute('data-shift') === '1';

            if (target === 'custom' || val.startsWith('custom_')) {
                if (customTargetWrapper) customTargetWrapper.classList.remove('d-none');
                if (hiddenActionType) hiddenActionType.value = (currentSelectedCategory === 'element') ? 'click_element' : (currentSelectedCategory === 'visibility' ? 'visibility_toggle' : 'open_url');
                if (hiddenActionTarget) hiddenActionTarget.value = customTargetValInput?.value || '';

                const label = document.getElementById('custom_target_input_label');
                const addon = document.getElementById('custom_target_addon');
                const helpText = document.getElementById('custom_target_help_text');
                if (currentSelectedCategory === 'element') {
                    if (label) label.innerText = 'Selector Elemen Tombol/Drawer (#ID atau .Class):';
                    if (addon) addon.innerText = '#';
                    if (helpText) helpText.innerHTML = 'Contoh: <code>#kt_drawer_chat_toggle</code> atau <code>.btn-submit-order</code>';
                } else if (currentSelectedCategory === 'visibility') {
                    if (label) label.innerText = 'Selector Elemen yang Di-Toggle (#ID atau [data-attr]):';
                    if (addon) addon.innerText = '#';
                    if (helpText) helpText.innerHTML = 'Contoh: <code>#kt_header</code> atau <code>[data-kt-feature-tool="tool_search"]</code>';
                } else {
                    if (label) label.innerText = 'URL Target Halaman:';
                    if (addon) addon.innerText = '/';
                    if (helpText) helpText.innerHTML = 'Contoh: <code>apps/ecommerce/sales/add-order</code>';
                }
            } else {
                if (customTargetWrapper) customTargetWrapper.classList.add('d-none');
                if (hiddenActionType) hiddenActionType.value = type;
                if (hiddenActionTarget) hiddenActionTarget.value = target;

                // Auto fill name and keys if adding new shortcut
                const formMethod = document.getElementById('shortcut_form_method')?.value;
                if (formMethod === 'POST') {
                    if (inputName && defaultName) inputName.value = defaultName;
                    if (inputKey && defaultKey) inputKey.value = defaultKey;
                    if (checkCtrl) checkCtrl.checked = defaultCtrl;
                    if (checkAlt) checkAlt.checked = defaultAlt;
                    if (checkShift) checkShift.checked = defaultShift;
                    updateLiveBadgePreview();
                }
            }
        });
    }

    if (customTargetValInput) {
        customTargetValInput.addEventListener('input', function () {
            if (hiddenActionTarget) hiddenActionTarget.value = this.value.trim();
        });
    }

    // 5. Role Filter Logic
    if (roleCheckAll) {
        roleCheckAll.addEventListener('change', function () {
            const isAll = this.checked;
            document.querySelectorAll('.role-item-checkbox').forEach(cb => {
                cb.disabled = isAll;
                if (isAll) cb.checked = false;
            });
        });
    }

    document.querySelectorAll('.role-item-checkbox').forEach(cb => {
        cb.addEventListener('change', function () {
            if (this.checked && roleCheckAll) {
                roleCheckAll.checked = false;
            }
        });
    });

    // 6. Reset Form to Create Mode
    function resetShortcutForm() {
        if (!formShortcut) return;
        formShortcut.reset();
        formShortcut.action = '/appsupport/shortcuts';
        document.getElementById('shortcut_form_method').value = 'POST';
        document.getElementById('shortcut_form_id').value = '';
        if (inputName) inputName.value = 'Toggle Fitur & Tools di Topbar Navbar';
        if (inputKey) inputKey.value = 't';
        if (checkCtrl) checkCtrl.checked = true;
        if (checkAlt) checkAlt.checked = false;
        if (checkShift) checkShift.checked = true;
        document.getElementById('shortcut_input_description').value = '';
        document.getElementById('shortcut_input_is_enabled').checked = true;

        if (roleCheckAll) roleCheckAll.checked = false;
        document.querySelectorAll('.role-item-checkbox').forEach(cb => {
            cb.disabled = false;
            cb.checked = ['master', 'admin'].includes(cb.value.toLowerCase());
        });

        // Trigger category 1 (visibility)
        const firstCatBtn = document.querySelector('.btn-category-select[data-category="visibility"]');
        if (firstCatBtn) firstCatBtn.click();

        const titleEl = document.getElementById('shortcut_form_card_title');
        if (titleEl) titleEl.innerHTML = `Tambah Pintasan Baru`;
        const subTitleEl = document.getElementById('shortcut_form_card_subtitle');
        if (subTitleEl) subTitleEl.innerText = 'Pilih kelompok aksi, kombinasi tombol, dan filter hak akses';
        updateLiveBadgePreview();
    }

    if (btnResetShortcutForm) {
        btnResetShortcutForm.addEventListener('click', resetShortcutForm);
    }

    const getShortcutModal = () => {
        const modalEl = document.getElementById('kt_modal_shortcut_manage');
        if (!modalEl) return null;
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            return bootstrap.Modal.getOrCreateInstance(modalEl);
        }
        return null;
    };

    const showShortcutModal = () => {
        const modalEl = document.getElementById('kt_modal_shortcut_manage');
        if (!modalEl) return;
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            if (modal) {
                modal.show();
                return;
            }
        }
        if (typeof $ !== 'undefined' && $.fn && $.fn.modal) {
            $(modalEl).modal('show');
        }
    };

    const hideShortcutModal = () => {
        const modalEl = document.getElementById('kt_modal_shortcut_manage');
        if (!modalEl) return;
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
                modal.hide();
                return;
            }
        }
        if (typeof $ !== 'undefined' && $.fn && $.fn.modal) {
            $(modalEl).modal('hide');
        }
    };

    document.querySelectorAll('#btn_new_shortcut_focus, #btn_new_shortcut_open_modal').forEach(btn => {
        btn.addEventListener('click', function () {
            resetShortcutForm();
            showShortcutModal();
        });
    });

    // 7. Form Submit Handler (Zero-Reload Realtime CRUD)
    if (formShortcut) {
        formShortcut.addEventListener('submit', function (e) {
            e.preventDefault();

            if (btnSaveShortcut) {
                btnSaveShortcut.setAttribute('data-kt-indicator', 'on');
                btnSaveShortcut.disabled = true;
            }

            const formData = new FormData(formShortcut);
            const actionUrl = formShortcut.action;
            const method = document.getElementById('shortcut_form_method').value || 'POST';

            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (btnSaveShortcut) {
                    btnSaveShortcut.removeAttribute('data-kt-indicator');
                    btnSaveShortcut.disabled = false;
                }

                if (data.success && data.data) {
                    const item = data.data;
                    const isNew = (method === 'POST');

                    // Update or Insert Row into Table
                    updateOrInsertShortcutRow(item, data.formatted_combination, data.mac_combination, isNew);

                    // Reload dynamic global shortcuts in memory
                    if (typeof KTAppShortcuts !== 'undefined' && KTAppShortcuts.reloadShortcuts) {
                        KTAppShortcuts.reloadShortcuts();
                    }

                    // Hide Modal
                    hideShortcutModal();

                    // Reset form back to create mode
                    resetShortcutForm();

                    Notify.alert({
                        text: data.message || 'Pintasan keyboard berhasil disimpan.',
                        icon: 'success',
                        confirmButtonText: 'Ok, Mengerti'
                    });
                } else {
                    let errMsg = data.message || 'Gagal menyimpan pintasan.';
                    if (data.errors) {
                        errMsg = Object.values(data.errors).flat().join('<br>');
                    }
                    Notify.error(errMsg);
                }
            })
            .catch(err => {
                console.error(err);
                if (btnSaveShortcut) {
                    btnSaveShortcut.removeAttribute('data-kt-indicator');
                    btnSaveShortcut.disabled = false;
                }
                Notify.error('Terjadi kesalahan jaringan.');
            });
        });
    }

    // 8. Edit Shortcut Button Click Handler (Populate Form & Show Modal)
    document.addEventListener('click', function (e) {
        const editBtn = e.target.closest('.btn-edit-shortcut-row');
        if (!editBtn) return;

        e.preventDefault();
        const id = editBtn.getAttribute('data-id') || editBtn.dataset.id;
        if (!id) return;

        // Reset form first and update title
        resetShortcutForm();

        const titleEl = document.getElementById('shortcut_form_card_title');
        if (titleEl) titleEl.innerHTML = `Edit Pintasan Keyboard`;
        const subTitleEl = document.getElementById('shortcut_form_card_subtitle');
        if (subTitleEl) subTitleEl.innerText = `Memuat data pintasan ID #${id}...`;

        // Show modal immediately for responsive feedback
        showShortcutModal();

        fetch(`/appsupport/shortcuts/${id}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error(`HTTP error ${res.status}`);
            return res.json();
        })
        .then(resData => {
            if (resData.success && resData.data) {
                const data = resData.data;

                document.getElementById('shortcut_form_method').value = 'PUT';
                document.getElementById('shortcut_form_id').value = data.id;
                formShortcut.action = `/appsupport/shortcuts/${data.id}`;

                if (inputName) inputName.value = data.name || '';
                if (inputKey) inputKey.value = data.key || 'm';
                if (checkCtrl) checkCtrl.checked = Boolean(data.ctrl || data.meta);
                if (checkAlt) checkAlt.checked = Boolean(data.alt);
                if (checkShift) checkShift.checked = Boolean(data.shift);
                
                const descInput = document.getElementById('shortcut_input_description');
                if (descInput) descInput.value = data.description || '';
                
                const enabledInput = document.getElementById('shortcut_input_is_enabled');
                if (enabledInput) enabledInput.checked = Boolean(data.is_enabled);

                // Roles
                const roles = Array.isArray(data.roles) ? data.roles : [];
                if (roles.length === 0) {
                    if (roleCheckAll) {
                        roleCheckAll.checked = true;
                        document.querySelectorAll('.role-item-checkbox').forEach(cb => {
                            cb.checked = false;
                            cb.disabled = true;
                        });
                    }
                } else {
                    if (roleCheckAll) roleCheckAll.checked = false;
                    document.querySelectorAll('.role-item-checkbox').forEach(cb => {
                        cb.disabled = false;
                        cb.checked = roles.map(r => r.toLowerCase()).includes(cb.value.toLowerCase());
                    });
                }

                // Determine Category
                let categoryKey = data.category || 'navigation';
                if (!categoryKey || categoryKey === 'navigation') {
                    if (['toggle_sidebar_menus', 'toggle_topbar_tools', 'toggle_topbar_menus', 'visibility_toggle'].includes(data.action_type)) {
                        categoryKey = 'visibility';
                    } else if (['icon_style', 'theme_mode', 'appearance', 'switch_language', 'switch_version'].includes(data.action_type)) {
                        categoryKey = 'appearance';
                    } else if (['search', 'lock_screen', 'system_action'].includes(data.action_type)) {
                        categoryKey = 'system';
                    } else if (data.action_type === 'click_element') {
                        categoryKey = 'element';
                    }
                }

                // Activate category button without auto-overwriting values
                document.querySelectorAll('.btn-category-select').forEach(b => {
                    b.classList.remove('active', 'btn-primary', 'btn-info', 'btn-success', 'btn-danger', 'btn-warning');
                    b.classList.add('btn-outline');
                });
                const catBtn = document.querySelector(`.btn-category-select[data-category="${categoryKey}"]`);
                if (catBtn) catBtn.classList.add('active');
                currentSelectedCategory = categoryKey;

                // Update category badge & hint
                const catalog = window.SHORTCUT_CATEGORIES_CATALOG ? window.SHORTCUT_CATEGORIES_CATALOG[categoryKey] : null;
                if (catalog) {
                    const badgeSelected = document.getElementById('badge_selected_category');
                    if (badgeSelected) {
                        badgeSelected.innerText = catalog.name;
                        badgeSelected.className = `badge ${catalog.badge_class} fs-9`;
                    }
                    const hintEl = document.getElementById('category_description_hint');
                    if (hintEl) {
                        hintEl.innerText = catalog.description;
                    }
                }

                // Populate target options for category and select the current target
                populateTargetOptionsForCategory(categoryKey);

                setTimeout(() => {
                    let matched = false;
                    if (targetSelect) {
                        for (let i = 0; i < targetSelect.options.length; i++) {
                            const opt = targetSelect.options[i];
                            if (opt.getAttribute('data-type') === data.action_type && opt.getAttribute('data-target') === (data.action_target || '')) {
                                $(targetSelect).val(opt.value).trigger('change');
                                matched = true;
                                break;
                            }
                        }

                        if (!matched) {
                            $(targetSelect).val(`custom_${categoryKey === 'element' ? 'element' : (categoryKey === 'visibility' ? 'visibility' : 'url')}`).trigger('change');
                            if (customTargetWrapper) customTargetWrapper.classList.remove('d-none');
                            if (customTargetValInput) customTargetValInput.value = data.action_target || '';
                            if (hiddenActionType) hiddenActionType.value = data.action_type;
                            if (hiddenActionTarget) hiddenActionTarget.value = data.action_target;
                        }
                    }

                    // Restore name & keys in case change event altered them
                    if (inputName) inputName.value = data.name || '';
                    if (inputKey) inputKey.value = data.key || 'm';
                    if (checkCtrl) checkCtrl.checked = Boolean(data.ctrl || data.meta);
                    if (checkAlt) checkAlt.checked = Boolean(data.alt);
                    if (checkShift) checkShift.checked = Boolean(data.shift);
                    updateLiveBadgePreview();
                }, 50);

                if (titleEl) titleEl.innerHTML = `Edit Pintasan Keyboard`;
                if (subTitleEl) subTitleEl.innerText = `ID #${data.id} • ${data.name}`;

                updateLiveBadgePreview();
            } else {
                Notify.error(resData.message || 'Gagal memuat data pintasan.');
                hideShortcutModal();
            }
        })
        .catch(err => {
            console.error(err);
            Notify.error('Gagal terhubung ke server untuk memuat data pintasan.');
            hideShortcutModal();
        });
    });

    // 9. Toggle Shortcut Row Switch
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('btn-toggle-shortcut-row')) {
            const id = e.target.dataset.id;
            if (!id) return;

            fetch(`/appsupport/shortcuts/${id}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Notify.success(data.message);
                    if (typeof KTAppShortcuts !== 'undefined' && KTAppShortcuts.reloadShortcuts) {
                        KTAppShortcuts.reloadShortcuts();
                    }
                    updateShortcutStatsTable();
                } else {
                    e.target.checked = !e.target.checked;
                    Notify.error(data.message || 'Gagal mengubah status pintasan.');
                }
            })
            .catch(err => {
                console.error(err);
                e.target.checked = !e.target.checked;
                Notify.error('Gagal terhubung ke server.');
            });
        }
    });

    // 10. Delete Shortcut Row Handler
    document.addEventListener('click', function (e) {
        const delBtn = e.target.closest('.btn-delete-shortcut-row');
        if (delBtn) {
            const id = delBtn.dataset.id;
            const name = delBtn.dataset.name || 'pintasan ini';
            if (!id) return;

            const executeDelete = () => {
                fetch(`/appsupport/shortcuts/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const tr = document.querySelector(`.shortcut-row[data-id="${id}"]`);
                        if (tr) {
                            tr.style.transition = 'all 0.3s ease';
                            tr.style.opacity = '0';
                            setTimeout(() => {
                                tr.remove();
                                updateShortcutStatsTable();
                            }, 300);
                        }

                        if (typeof KTAppShortcuts !== 'undefined' && KTAppShortcuts.reloadShortcuts) {
                            KTAppShortcuts.reloadShortcuts();
                        }

                        Notify.success(data.message);
                    } else {
                        Notify.error(data.message || 'Gagal menghapus pintasan.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Notify.error('Terjadi kesalahan jaringan.');
                });
            };

            Notify.confirm({
                title: 'Hapus Pintasan Keyboard?',
                text: `Apakah Anda yakin ingin menghapus pintasan "${name}"?`,
                icon: 'warning',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                onConfirm: executeDelete
            });
        }
    });

    // 11. Test Shortcut Single Row Handler
    document.addEventListener('click', function (e) {
        const testBtn = e.target.closest('.btn-test-single-shortcut');
        if (testBtn) {
            const type = testBtn.dataset.actionType;
            const target = testBtn.dataset.actionTarget;

            if (typeof KTAppShortcuts === 'undefined') {
                Notify.error('Modul pintasan belum siap.');
                return;
            }

            KTAppShortcuts.executeAction({
                action_type: type,
                action_target: target
            });
        }
    });

    // 12. Helper to dynamically update/insert table row
    function updateOrInsertShortcutRow(item, formattedCombo, macCombo, isNew) {
        const tbody = document.getElementById('tbody_app_shortcuts');
        const emptyTr = document.getElementById('tr_empty_shortcuts');
        if (emptyTr) emptyTr.remove();

        const rolesArr = Array.isArray(item.roles) ? item.roles : [];
        let rolesHtml = '';
        if (rolesArr.length === 0) {
            rolesHtml = '<span class="badge badge-light-success fs-9 fw-semibold">Semua Role</span>';
        } else {
            rolesHtml = rolesArr.map(r => {
                const color = r.toLowerCase() === 'master' ? 'badge-light-danger' : (r.toLowerCase() === 'admin' ? 'badge-light-primary' : 'badge-light-secondary');
                return `<span class="badge ${color} fs-9 fw-bold me-1">${r}</span>`;
            }).join('');
        }

        let catKey = 'navigation';
        let catName = 'Navigasi';
        let catIcon = 'ki-route';
        let catBadge = 'badge-light-info';

        if (['toggle_sidebar_menus', 'toggle_topbar_tools', 'toggle_topbar_menus', 'visibility_toggle'].includes(item.action_type)) {
            catKey = 'visibility';
            catName = 'Visibilitas';
            catIcon = 'ki-eye';
            catBadge = 'badge-light-primary';
        } else if (['icon_style', 'theme_mode', 'appearance'].includes(item.action_type)) {
            catKey = 'appearance';
            catName = 'Tema & Ikon';
            catIcon = 'ki-color-filter';
            catBadge = 'badge-light-success';
        } else if (['search', 'lock_screen', 'system_action'].includes(item.action_type)) {
            catKey = 'system';
            catName = 'Aksi Sistem';
            catIcon = 'ki-shield-tick';
            catBadge = 'badge-light-danger';
        } else if (item.action_type === 'click_element') {
            catKey = 'element';
            catName = 'Klik Elemen';
            catIcon = 'ki-cursor';
            catBadge = 'badge-light-warning';
        }

        let targetHtml = '';
        if (item.action_type === 'toggle_topbar_tools') {
            targetHtml = '<span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Toggle Topbar Navbar Tools</span><span class="text-muted fs-9 font-monospace">topbar_tools</span>';
        } else if (item.action_type === 'toggle_topbar_menus') {
            targetHtml = '<span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Toggle Topbar Header Menus</span><span class="text-muted fs-9 font-monospace">topbar_menus</span>';
        } else if (item.action_type === 'toggle_sidebar_menus') {
            targetHtml = '<span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Toggle Menu Template Sidebar</span><span class="text-muted fs-9 font-monospace">sidebar_menus</span>';
        } else if (item.action_type === 'open_url' || item.action_type === 'nav_link') {
            targetHtml = `<span class="badge badge-light-info fw-bold fs-8 w-fit mb-1">Buka Halaman (URL)</span><span class="text-muted fs-9 font-monospace text-truncate mw-150px">${item.action_target || '/'}</span>`;
        } else if (item.action_type === 'click_element') {
            targetHtml = `<span class="badge badge-light-warning fw-bold fs-8 w-fit mb-1">Klik Elemen Tombol</span><span class="text-muted fs-9 font-monospace text-truncate mw-150px">${item.action_target}</span>`;
        } else if (item.action_type === 'search') {
            targetHtml = '<span class="badge badge-light-danger fw-bold fs-8 w-fit mb-1">Pencarian Global</span><span class="text-muted fs-9">global_search</span>';
        } else if (item.action_type === 'theme_mode') {
            targetHtml = '<span class="badge badge-light-success fw-bold fs-8 w-fit mb-1">Mode Gelap / Terang</span><span class="text-muted fs-9">theme_mode</span>';
        } else if (item.action_type === 'icon_style') {
            const styleTgt = (item.action_target || 'duotone').toLowerCase();
            const color = (styleTgt === 'solid' ? 'badge-light-success' : (styleTgt === 'outline' ? 'badge-light-info' : 'badge-light-primary'));
            const lbl = styleTgt.charAt(0).toUpperCase() + styleTgt.slice(1);
            targetHtml = `<span class="badge ${color} fw-bold fs-8 w-fit mb-1">Gaya Ikon: ${lbl}</span><span class="text-muted fs-9 font-monospace">icon_style:${styleTgt}</span>`;
        } else if (item.action_type === 'lock_screen') {
            targetHtml = '<span class="badge badge-light-danger fw-bold fs-8 w-fit mb-1">Kunci Layar (Lock Screen)</span><span class="text-muted fs-9">lock_screen</span>';
        } else {
            targetHtml = `<span class="badge badge-light-secondary fw-bold fs-8 w-fit mb-1">${item.action_type}</span><span class="text-muted fs-9 font-monospace">${item.action_target || '-'}</span>`;
        }

        const isEnabled = Boolean(item.is_enabled);
        const searchKeywords = `${item.name} ${formattedCombo} ${item.action_type} ${item.action_target || ''} ${rolesArr.join(' ')} ${catKey}`.toLowerCase();

        const rowHtml = `
            <tr class="shortcut-row" data-id="${item.id}" data-category="${catKey}" data-search="${searchKeywords}">
                <td class="ps-4">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge ${catBadge} fs-9 px-2 py-0 fw-bold">
                                <i class="ki-outline ${catIcon} fs-8 me-1"></i> ${catName}
                            </span>
                        </div>
                        <span class="fw-bold text-gray-900 shortcut-name-text">${item.name}</span>
                        <span class="text-muted fs-9 shortcut-desc-text">${item.description || '-'}</span>
                    </div>
                </td>
                <td class="text-center">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <kbd class="bg-light-primary text-primary px-2 py-1 rounded fw-bold border fs-8 shortcut-combo-badge shadow-xs">
                            ${formattedCombo || 'Ctrl + ' + item.key.toUpperCase()}
                        </kbd>
                        <span class="text-muted fs-9 font-monospace shortcut-mac-combo">${macCombo || '⌘ + ' + item.key.toUpperCase()}</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column">
                        ${targetHtml}
                    </div>
                </td>
                <td class="text-center">
                    <div class="d-flex flex-wrap justify-content-center gap-1">
                        ${rolesHtml}
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-check form-switch form-check-custom form-check-solid d-inline-block">
                        <input class="form-check-input h-18px w-30px btn-toggle-shortcut-row" type="checkbox" data-id="${item.id}" ${isEnabled ? 'checked' : ''} />
                    </div>
                </td>
                <td class="text-end pe-4">
                    <div class="d-flex justify-content-end align-items-center gap-1">
                        <button type="button" class="btn btn-icon btn-light-success btn-sm btn-test-single-shortcut" data-id="${item.id}" data-action-type="${item.action_type}" data-action-target="${item.action_target || ''}" data-bs-toggle="tooltip" title="Uji Coba Langsung">
                            <i class="ki-outline ki-eye fs-5"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-light-info btn-sm btn-edit-shortcut-row" data-id="${item.id}" data-bs-toggle="tooltip" title="Edit Pintasan">
                            <i class="ki-outline ki-pencil fs-5"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-delete-shortcut-row" data-id="${item.id}" data-name="${item.name}" data-bs-toggle="tooltip" title="Hapus Pintasan">
                            <i class="ki-outline ki-trash fs-5"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;

        const existingRow = document.querySelector(`.shortcut-row[data-id="${item.id}"]`);
        if (existingRow && !isNew) {
            existingRow.outerHTML = rowHtml;
        } else if (tbody) {
            tbody.insertAdjacentHTML('beforeend', rowHtml);
        }

        if (typeof KTComponents !== 'undefined' && KTComponents.initTooltips) {
            KTComponents.initTooltips();
        }

        updateShortcutStatsTable();
    }

    // 13. Update table stats summary
    function updateShortcutStatsTable() {
        const rows = document.querySelectorAll('.shortcut-row');
        const checkedSwitches = document.querySelectorAll('.btn-toggle-shortcut-row:checked');
        const statTotal = document.getElementById('stat_shortcut_total');
        const statActive = document.getElementById('stat_shortcut_active');

        if (statTotal) statTotal.innerText = rows.length;
        if (statActive) statActive.innerText = checkedSwitches.length;
    }

    // 14. Table Category Filter Tabs & Table Search
    function applyShortcutTableFilters() {
        const searchQuery = (searchShortcutsInput?.value || '').toLowerCase().trim();
        const rows = document.querySelectorAll('.shortcut-row');

        rows.forEach(row => {
            const rowCat = row.dataset.category || 'navigation';
            const rowSearchData = (row.dataset.search || '').toLowerCase();

            const matchesCategory = (currentTableCategoryFilter === 'all' || rowCat === currentTableCategoryFilter);
            const matchesSearch = (!searchQuery || rowSearchData.includes(searchQuery));

            if (matchesCategory && matchesSearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    if (searchShortcutsInput) {
        searchShortcutsInput.addEventListener('input', applyShortcutTableFilters);
    }

    document.querySelectorAll('.btn-filter-table-category').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.btn-filter-table-category').forEach(b => {
                b.classList.remove('active', 'btn-light-primary');
                b.classList.add('btn-light');
            });
            this.classList.add('active', 'btn-light-primary');
            this.classList.remove('btn-light');

            currentTableCategoryFilter = this.dataset.filter || 'all';
            applyShortcutTableFilters();
        });
    });

    // Initialize initial category population on tab load
    if (window.SHORTCUT_CATEGORIES_CATALOG) {
        populateTargetOptionsForCategory('visibility');
    }

    // ========================================================
    // TAB 4: SYSTEM ACTIVITY LOGS (DATATABLES & ZERO-RELOAD)
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


