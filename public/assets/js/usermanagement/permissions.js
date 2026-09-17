/**
 * Modul Manajemen Izin Akses (Permissions)
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

    const permFormModalEl = document.getElementById('kt_modal_permission_form');
    const permFormModal = permFormModalEl ? new bootstrap.Modal(permFormModalEl) : null;

    const permGenModalEl = document.getElementById('kt_modal_permission_generate');
    const permGenModal = permGenModalEl ? new bootstrap.Modal(permGenModalEl) : null;

    const permForm = document.getElementById('kt_form_permission');
    const btnSavePerm = document.getElementById('kt_btn_save_permission');
    const inputPermName = document.getElementById('perm_input_name');
    const formPermMethod = document.getElementById('perm_form_method');
    const formPermId = document.getElementById('perm_form_id');
    const permModalTitle = document.getElementById('perm_modal_title');

    // =========================================================================
    // 1. FILTER & PENCARIAN
    // =========================================================================
    const searchInput = document.getElementById('kt_filter_permission_search');
    const moduleSelect = document.getElementById('kt_filter_permission_module');

    const filterPermissions = () => {
        const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
        const selectedMod = moduleSelect ? moduleSelect.value : 'all';
        const rows = document.querySelectorAll('#kt_permissions_tbody tr.perm-row-item');

        rows.forEach(row => {
            const permName = (row.getAttribute('data-perm-name') || '').toLowerCase();
            const modKey = row.getAttribute('data-mod-key') || 'general';

            let matchesSearch = permName.includes(query);
            let matchesMod = (selectedMod === 'all' || modKey === selectedMod);

            if (matchesSearch && matchesMod) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    };

    if (searchInput) {
        searchInput.addEventListener('input', filterPermissions);
    }
    if (moduleSelect) {
        $(moduleSelect).on('change', filterPermissions);
    }

    // =========================================================================
    // 2. MODAL TAMBAH PERMISSION MANUAL
    // =========================================================================
    const btnAddPerm = document.getElementById('kt_btn_add_permission');
    if (btnAddPerm && permFormModal) {
        btnAddPerm.addEventListener('click', function () {
            if (permForm) permForm.reset();
            if (formPermMethod) formPermMethod.value = 'POST';
            if (formPermId) formPermId.value = '';
            if (permForm) permForm.action = routes.store;
            if (permModalTitle) permModalTitle.textContent = 'Tambah Izin Akses';
            permFormModal.show();
        });
    }

    // =========================================================================
    // 3. MODAL GENERATE CRUD MODUL
    // =========================================================================
    const btnOpenGen = document.getElementById('kt_btn_open_generate_modal');
    const formGen = document.getElementById('kt_form_generate_permissions');
    const btnSubmitGen = document.getElementById('kt_btn_submit_generate_perm');

    if (btnOpenGen && permGenModal) {
        btnOpenGen.addEventListener('click', function () {
            if (formGen) formGen.reset();
            permGenModal.show();
        });
    }

    if (formGen) {
        formGen.addEventListener('submit', function (e) {
            e.preventDefault();

            if (btnSubmitGen) {
                btnSubmitGen.setAttribute('data-kt-indicator', 'on');
                btnSubmitGen.disabled = true;
            }

            const formData = new FormData(formGen);

            fetch(formGen.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (btnSubmitGen) {
                    btnSubmitGen.removeAttribute('data-kt-indicator');
                    btnSubmitGen.disabled = false;
                }

                if (response.ok && data.success) {
                    if (permGenModal) permGenModal.hide();

                    Swal.fire({
                        title: 'Generate Berhasil!',
                        text: data.message,
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        customClass: { confirmButton: 'btn btn-primary' }
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    let errMsg = data.message || 'Terjadi kesalahan saat generate izin.';
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
                if (btnSubmitGen) {
                    btnSubmitGen.removeAttribute('data-kt-indicator');
                    btnSubmitGen.disabled = false;
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
    // 4. EDIT PERMISSION MANUAL
    // =========================================================================
    document.addEventListener('click', function (e) {
        const btnEdit = e.target.closest('.btn-edit-permission');
        if (btnEdit && permFormModal) {
            const permId = btnEdit.getAttribute('data-id');
            const permName = btnEdit.getAttribute('data-name');
            if (!permId) return;

            if (permForm) permForm.reset();
            if (permModalTitle) permModalTitle.textContent = 'Ubah Nama Izin Akses';
            if (formPermMethod) formPermMethod.value = 'PUT';
            if (formPermId) formPermId.value = permId;
            if (inputPermName) inputPermName.value = permName;
            if (permForm) permForm.action = `${routes.base}/${permId}`;

            permFormModal.show();
        }
    });

    // =========================================================================
    // 5. SUBMIT FORM PERMISSION (TAMBAH / UBAH)
    // =========================================================================
    if (permForm) {
        permForm.addEventListener('submit', function (e) {
            e.preventDefault();

            if (btnSavePerm) {
                btnSavePerm.setAttribute('data-kt-indicator', 'on');
                btnSavePerm.disabled = true;
            }

            const formData = new FormData(permForm);

            fetch(permForm.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (btnSavePerm) {
                    btnSavePerm.removeAttribute('data-kt-indicator');
                    btnSavePerm.disabled = false;
                }

                if (response.ok && data.success) {
                    if (permFormModal) permFormModal.hide();

                    Swal.fire({
                        text: data.message,
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
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
                if (btnSavePerm) {
                    btnSavePerm.removeAttribute('data-kt-indicator');
                    btnSavePerm.disabled = false;
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
    // 6. HAPUS PERMISSION
    // =========================================================================
    document.addEventListener('click', function (e) {
        const btnDelete = e.target.closest('.btn-delete-permission');
        if (btnDelete) {
            const permId = btnDelete.getAttribute('data-id');
            const permName = btnDelete.getAttribute('data-name');
            if (!permId) return;

            Swal.fire({
                title: `Hapus Izin \`${permName}\`?`,
                text: 'Izin ini akan dicabut dari seluruh peran yang memilikinya.',
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                }
            }).then(result => {
                if (result.isConfirmed) {
                    btnDelete.disabled = true;

                    fetch(`${routes.base}/${permId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': routes.csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ _method: 'DELETE' })
                    })
                    .then(async response => {
                        const data = await response.json();
                        btnDelete.disabled = false;

                        if (response.ok && data.success) {
                            Swal.fire({
                                text: data.message,
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'OK',
                                customClass: { confirmButton: 'btn btn-primary' }
                            }).then(() => {
                                const tr = btnDelete.closest('tr');
                                if (tr) tr.remove();
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal Menghapus',
                                text: data.message || 'Izin gagal dihapus.',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Tutup',
                                customClass: { confirmButton: 'btn btn-primary' }
                            });
                        }
                    })
                    .catch(err => {
                        btnDelete.disabled = false;
                        Swal.fire({
                            text: 'Gagal menghubungi server: ' + err.message,
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Tutup',
                            customClass: { confirmButton: 'btn btn-primary' }
                        });
                    });
                }
            });
        }
    });
});
