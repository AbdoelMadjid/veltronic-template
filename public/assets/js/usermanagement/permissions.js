/**
 * Modul Manajemen Izin Akses (Permissions) - Hierarchical Module Layout & Unified Modal
 * Zero-Reload Realtime AJAX & Metronic Interactive Components
 */
"use strict";

document.addEventListener('DOMContentLoaded', function () {
    const routes = window.PERMISSION_ROUTES || {};

    // Inisialisasi Tooltips
    const initTooltips = () => {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, { trigger: 'hover' });
        });
    };
    initTooltips();

    const permUnifiedModalEl = document.getElementById('kt_modal_permission_generate');
    const permUnifiedModal = permUnifiedModalEl ? new bootstrap.Modal(permUnifiedModalEl) : null;

    const modalMainTitle = document.getElementById('unified_modal_main_title');
    const modalSubTitle = document.getElementById('unified_modal_sub_title');
    const modalNavTabs = document.getElementById('perm_modal_nav_tabs');

    const tabBtnBatch = document.getElementById('tab_btn_batch_crud');
    const tabBtnSingle = document.getElementById('tab_btn_single_perm');

    const formBatch = document.getElementById('kt_form_generate_permissions');
    const formSingle = document.getElementById('kt_form_permission');
    const btnSubmitBatch = document.getElementById('kt_btn_submit_generate_perm');
    const btnSubmitSingle = document.getElementById('kt_btn_save_permission');
    const genInputPrefix = document.getElementById('gen_input_prefix');
    const btnBatchText = document.getElementById('btn_batch_text');

    // =========================================================================
    // 1. FILTER & PENCARIAN (Cari Modul / Fitur & Filter Role)
    // =========================================================================
    const searchInput = document.getElementById('kt_filter_permission_search');
    const roleSelect = document.getElementById('kt_filter_permission_role');

    const filterModuleRows = () => {
        const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
        const selectedRole = (roleSelect ? roleSelect.value : 'all').toLowerCase();
        const rows = document.querySelectorAll('#kt_permissions_tbody tr.module-perm-row');

        rows.forEach(row => {
            const modName = (row.getAttribute('data-module-name') || '').toLowerCase();
            const modUrl = (row.getAttribute('data-module-url') || '').toLowerCase();
            let rowRoles = [];
            try {
                rowRoles = JSON.parse(row.getAttribute('data-roles') || '[]');
            } catch (e) {
                rowRoles = [];
            }

            const matchesSearch = modName.includes(query) || modUrl.includes(query) || query === '';
            const matchesRole = (selectedRole === 'all') || rowRoles.includes(selectedRole);

            if (matchesSearch && matchesRole) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    };

    if (searchInput) {
        searchInput.addEventListener('input', filterModuleRows);
    }
    if (roleSelect) {
        $(roleSelect).on('change', filterModuleRows);
    }

    // =========================================================================
    // 2. DINAMIKA JUMLAH AKSI CRUD & ROLE SELECTION
    // =========================================================================
    let isCurrentEditMode = false;

    const updateBatchBtnText = (isEdit = false) => {
        isCurrentEditMode = isEdit;
        const checkedCount = document.querySelectorAll('.batch-action-cb:checked').length;
        if (btnBatchText) {
            btnBatchText.textContent = isEdit 
                ? `Simpan Perubahan (${checkedCount} Akses CRUD)` 
                : `Simpan ${checkedCount} Akses CRUD`;
        }
    };

    document.querySelectorAll('.batch-action-cb').forEach(cb => {
        cb.addEventListener('change', () => updateBatchBtnText(isCurrentEditMode));
    });

    // Pilih Semua / Kosongkan Role di Batch CRUD
    const btnBatchRoleAll = document.getElementById('btn_batch_role_all');
    const btnBatchRoleNone = document.getElementById('btn_batch_role_none');

    if (btnBatchRoleAll) {
        btnBatchRoleAll.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.batch-role-cb').forEach(cb => cb.checked = true);
        });
    }
    if (btnBatchRoleNone) {
        btnBatchRoleNone.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.batch-role-cb').forEach(cb => cb.checked = false);
        });
    }

    // Pilih Semua / Kosongkan Role di Single Permission
    const btnSingleRoleAll = document.getElementById('btn_single_role_all');
    const btnSingleRoleNone = document.getElementById('btn_single_role_none');

    if (btnSingleRoleAll) {
        btnSingleRoleAll.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.single-role-cb').forEach(cb => cb.checked = true);
        });
    }
    if (btnSingleRoleNone) {
        btnSingleRoleNone.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.single-role-cb').forEach(cb => cb.checked = false);
        });
    }

    const dynamicCustomActionsWrapper = document.getElementById('dynamic_custom_actions_wrapper');
    const btnAddCustomAction = document.getElementById('btn_add_custom_action');

    // Tambah Checkbox Aksi Kustom Dinamis
    const addDynamicActionCheckbox = (actionName, isChecked = true) => {
        const cleanName = actionName.toLowerCase().trim();
        if (!cleanName) return;

        // Cek jika sudah ada
        const existingCb = document.querySelector(`.batch-action-cb[value="${cleanName}"]`);
        if (existingCb) {
            existingCb.checked = isChecked;
            updateBatchBtnText(isCurrentEditMode);
            return;
        }

        const actionId = 'act_cb_' + cleanName.replace(/[^a-z0-9]/g, '_');
        const div = document.createElement('div');
        div.className = 'form-check form-check-custom form-check-solid dynamic-custom-action-item';
        div.innerHTML = `
            <input class="form-check-input batch-action-cb" type="checkbox" name="actions[]" value="${cleanName}" id="${actionId}" ${isChecked ? 'checked' : ''} />
            <label class="form-check-label text-gray-800 fw-bold fs-7 cursor-pointer" for="${actionId}">
                ${actionName.charAt(0).toUpperCase() + actionName.slice(1)}
            </label>
        `;

        const inputCb = div.querySelector('input');
        inputCb.addEventListener('change', () => updateBatchBtnText(isCurrentEditMode));

        if (dynamicCustomActionsWrapper) {
            dynamicCustomActionsWrapper.appendChild(div);
        }
        updateBatchBtnText(isCurrentEditMode);
    };

    if (btnAddCustomAction) {
        btnAddCustomAction.addEventListener('click', function () {
            Swal.fire({
                title: 'Tambah Aksi Khusus / Kustom',
                text: 'Masukkan nama aksi tambahan (contoh: export, import, approve, generate)',
                input: 'text',
                inputPlaceholder: 'Nama aksi (contoh: export)',
                showCancelButton: true,
                confirmButtonText: 'Tambahkan',
                cancelButtonText: 'Batal',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light'
                },
                inputValidator: (value) => {
                    if (!value || !value.trim()) {
                        return 'Nama aksi tidak boleh kosong!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    addDynamicActionCheckbox(result.value, true);
                }
            });
        });
    }

    // =========================================================================
    // 3. TRIGGER BUKA MODAL DARI BANNER & TABEL
    // =========================================================================
    // Tombol Tambah Modul CRUD (Praktis)
    const btnOpenBatch = document.getElementById('kt_btn_open_generate_modal');
    if (btnOpenBatch && permUnifiedModal) {
        btnOpenBatch.addEventListener('click', function () {
            if (modalNavTabs) modalNavTabs.classList.remove('d-none');
            if (modalMainTitle) modalMainTitle.innerHTML = '<i class="ki-outline ki-flash text-warning fs-3 me-2"></i>Tambah Permission Modul (Batch CRUD)';
            if (modalSubTitle) modalSubTitle.textContent = 'Buat permission baru secara batch CRUD atau single manual';

            if (formBatch) formBatch.reset();
            if (genInputPrefix) genInputPrefix.value = '';
            if (dynamicCustomActionsWrapper) dynamicCustomActionsWrapper.innerHTML = '';

            // Default: create, read, update, delete tercentang; sort tidak tercentang saat tambah baru
            document.querySelectorAll('.batch-action-cb').forEach(cb => {
                if (['create', 'read', 'update', 'delete'].includes(cb.value)) {
                    cb.checked = true;
                } else {
                    cb.checked = false;
                }
            });
            document.querySelectorAll('.batch-role-cb').forEach(cb => cb.checked = false);
            updateBatchBtnText(false);

            if (tabBtnBatch) {
                bootstrap.Tab.getOrCreateInstance(tabBtnBatch).show();
            }
            permUnifiedModal.show();
        });
    }

    // Tombol Tambah Single Permission
    const btnOpenSingle = document.getElementById('kt_btn_add_permission');
    if (btnOpenSingle && permUnifiedModal) {
        btnOpenSingle.addEventListener('click', function () {
            if (modalNavTabs) modalNavTabs.classList.remove('d-none');
            if (modalMainTitle) modalMainTitle.innerHTML = '<i class="ki-outline ki-key text-primary fs-3 me-2"></i>Tambah Single Permission (Kustom)';
            if (modalSubTitle) modalSubTitle.textContent = 'Daftarkan 1 permission khusus secara mandiri ke dalam sistem';

            if (formSingle) formSingle.reset();
            document.querySelectorAll('.single-role-cb').forEach(cb => cb.checked = false);

            if (tabBtnSingle) {
                bootstrap.Tab.getOrCreateInstance(tabBtnSingle).show();
            }
            permUnifiedModal.show();
        });
    }

    // Tombol Edit Pensil di Baris Modul (Populate Data Sesuai Modul)
    document.addEventListener('click', function (e) {
        const btnEditMod = e.target.closest('.btn-edit-module-permissions');
        if (btnEditMod && permUnifiedModal) {
            const modName = btnEditMod.getAttribute('data-module-name') || '';
            const modUrl = btnEditMod.getAttribute('data-module-url') || '';
            let registeredActions = [];
            let assignedRoles = [];

            try {
                registeredActions = JSON.parse(btnEditMod.getAttribute('data-actions') || '[]');
            } catch (err) {
                registeredActions = [];
            }

            try {
                assignedRoles = JSON.parse(btnEditMod.getAttribute('data-roles') || '[]');
            } catch (err) {
                assignedRoles = [];
            }

            // Sembunyikan Nav Tabs saat mode Edit agar langsung fokus ke form konfigurasi modul
            if (modalNavTabs) {
                modalNavTabs.classList.add('d-none');
            }

            if (modalMainTitle) {
                modalMainTitle.innerHTML = '<i class="ki-outline ki-pencil text-primary fs-3 me-2"></i>Ubah Izin Modul: <span class="text-primary font-monospace">' + (modUrl || modName) + '</span>';
            }
            if (modalSubTitle) {
                modalSubTitle.textContent = 'Perbarui konfigurasi aksi CRUD dan penugasan peran untuk modul ini';
            }

            if (formBatch) formBatch.reset();
            if (genInputPrefix) {
                genInputPrefix.value = modUrl || modName;
            }
            if (dynamicCustomActionsWrapper) {
                dynamicCustomActionsWrapper.innerHTML = '';
            }

            const standardActions = ['create', 'read', 'update', 'delete', 'sort'];

            // Checklist aksi bawaan
            document.querySelectorAll('.batch-action-cb').forEach(cb => {
                if (registeredActions.length > 0) {
                    cb.checked = registeredActions.includes(cb.value.toLowerCase());
                } else {
                    cb.checked = ['create', 'read', 'update', 'delete'].includes(cb.value.toLowerCase());
                }
            });

            // Buat checkbox untuk aksi kustom non-standar yang terdaftar pada modul ini
            registeredActions.forEach(act => {
                const actLower = act.toLowerCase();
                if (!standardActions.includes(actLower)) {
                    addDynamicActionCheckbox(actLower, true);
                }
            });

            // Checklist role yang saat ini ditugaskan
            document.querySelectorAll('.batch-role-cb').forEach(cb => {
                cb.checked = assignedRoles.includes(cb.value.toLowerCase());
            });

            updateBatchBtnText(true);

            if (tabBtnBatch) {
                bootstrap.Tab.getOrCreateInstance(tabBtnBatch).show();
            }
            permUnifiedModal.show();
        }
    });

    // =========================================================================
    // 4. SUBMIT FORM BATCH CRUD
    // =========================================================================
    if (formBatch) {
        formBatch.addEventListener('submit', function (e) {
            e.preventDefault();

            if (btnSubmitBatch) {
                btnSubmitBatch.setAttribute('data-kt-indicator', 'on');
                btnSubmitBatch.disabled = true;
            }

            const formData = new FormData(formBatch);

            fetch(formBatch.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (btnSubmitBatch) {
                    btnSubmitBatch.removeAttribute('data-kt-indicator');
                    btnSubmitBatch.disabled = false;
                }

                if (response.ok && data.success) {
                    if (permUnifiedModal) permUnifiedModal.hide();

                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message,
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'Selesai',
                        customClass: { confirmButton: 'btn btn-primary' }
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    let errMsg = data.message || 'Terjadi kesalahan saat menyimpan izin.';
                    if (data.errors) {
                        errMsg = Object.values(data.errors).flat().join('<br>');
                    }
                    Swal.fire({
                        html: errMsg,
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'Tutup',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });
                }
            })
            .catch(err => {
                if (btnSubmitBatch) {
                    btnSubmitBatch.removeAttribute('data-kt-indicator');
                    btnSubmitBatch.disabled = false;
                }
                Swal.fire({
                    text: 'Gagal terhubung ke server: ' + err.message,
                    icon: 'error',
                    buttonsStyling: false,
                    confirmButtonText: 'Tutup',
                    customClass: { confirmButton: 'btn btn-primary' }
                });
            });
        });
    }

    // =========================================================================
    // 5. SUBMIT FORM SINGLE PERMISSION
    // =========================================================================
    if (formSingle) {
        formSingle.addEventListener('submit', function (e) {
            e.preventDefault();

            if (btnSubmitSingle) {
                btnSubmitSingle.setAttribute('data-kt-indicator', 'on');
                btnSubmitSingle.disabled = true;
            }

            const formData = new FormData(formSingle);

            fetch(formSingle.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (btnSubmitSingle) {
                    btnSubmitSingle.removeAttribute('data-kt-indicator');
                    btnSubmitSingle.disabled = false;
                }

                if (response.ok && data.success) {
                    if (permUnifiedModal) permUnifiedModal.hide();

                    Swal.fire({
                        title: 'Tersimpan!',
                        text: data.message,
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'Selesai',
                        customClass: { confirmButton: 'btn btn-primary' }
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    let errMsg = data.message || 'Terjadi kesalahan saat menyimpan izin.';
                    if (data.errors) {
                        errMsg = Object.values(data.errors).flat().join('<br>');
                    }
                    Swal.fire({
                        html: errMsg,
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'Tutup',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });
                }
            })
            .catch(err => {
                if (btnSubmitSingle) {
                    btnSubmitSingle.removeAttribute('data-kt-indicator');
                    btnSubmitSingle.disabled = false;
                }
                Swal.fire({
                    text: 'Gagal terhubung ke server: ' + err.message,
                    icon: 'error',
                    buttonsStyling: false,
                    confirmButtonText: 'Tutup',
                    customClass: { confirmButton: 'btn btn-primary' }
                });
            });
        });
    }
});
