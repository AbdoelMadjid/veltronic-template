/**
 * Modul Manajemen Peran (Roles)
 * Zero-Reload Realtime AJAX & Metronic Components
 */
"use strict";

document.addEventListener('DOMContentLoaded', function () {
    const routes = window.ROLE_ROUTES || {};

    // Inisialisasi Tooltips
    const initTooltips = () => {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, { trigger: 'hover' });
        });
    };
    initTooltips();

    const roleFormModalEl = document.getElementById('kt_modal_role_form');
    const roleFormModal = roleFormModalEl ? new bootstrap.Modal(roleFormModalEl) : null;

    const roleViewModalEl = document.getElementById('kt_modal_role_view');
    const roleViewModal = roleViewModalEl ? new bootstrap.Modal(roleViewModalEl) : null;

    const roleForm = document.getElementById('kt_form_role');
    const roleBtnSubmit = document.getElementById('kt_btn_save_role');
    const roleInputName = document.getElementById('role_input_name');
    const roleFormMethod = document.getElementById('role_form_method');
    const roleFormId = document.getElementById('role_form_id');
    const roleModalTitle = document.getElementById('role_modal_title');
    const permCheckboxes = () => document.querySelectorAll('#role_form_matrix_table .matrix-perm-cb');

    const resetForm = () => {
        if (roleForm) roleForm.reset();
        if (roleFormMethod) roleFormMethod.value = 'POST';
        if (roleFormId) roleFormId.value = '';
        if (roleForm) roleForm.action = routes.store;
        if (roleModalTitle) roleModalTitle.textContent = 'Tambah Peran Baru';
        if (roleInputName) {
            roleInputName.readOnly = false;
            roleInputName.classList.remove('bg-secondary');
        }
        permCheckboxes().forEach(cb => { cb.checked = false; });
        if (window.KTCRUDMatrixHelper) {
            window.KTCRUDMatrixHelper.syncRowCheckStates('#role_form_matrix_table');
        }
    };

    // =========================================================================
    // 2. TAMBAH PERAN BARU
    // =========================================================================
    const btnAddNewRole = document.getElementById('kt_btn_add_new_role');
    if (btnAddNewRole && roleFormModal) {
        btnAddNewRole.addEventListener('click', function () {
            resetForm();
            roleFormModal.show();
        });
    }

    // =========================================================================
    // 3. EDIT PERAN
    // =========================================================================
    document.addEventListener('click', function (e) {
        const btnEdit = e.target.closest('.btn-edit-role');
        if (btnEdit && roleFormModal) {
            const roleId = btnEdit.getAttribute('data-id');
            if (!roleId) return;

            resetForm();
            roleModalTitle.textContent = 'Ubah Izin Peran';
            roleFormMethod.value = 'PUT';
            roleFormId.value = roleId;
            roleForm.action = `${routes.base}/${roleId}`;

            // Fetch permissions data
            fetch(`${routes.base}/${roleId}/permissions`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success) {
                    const role = data.role;
                    const assignedPerms = data.permissions || [];

                    if (roleInputName) {
                        roleInputName.value = role.name;
                        if (data.is_protected) {
                            roleInputName.readOnly = true;
                            roleInputName.classList.add('bg-secondary');
                        }
                    }

                    permCheckboxes().forEach(cb => {
                        cb.checked = assignedPerms.includes(cb.value);
                    });

                    if (window.KTCRUDMatrixHelper) {
                        window.KTCRUDMatrixHelper.syncRowCheckStates('#role_form_matrix_table');
                    }

                    roleFormModal.show();
                } else {
                    Swal.fire({
                        text: data.message || 'Gagal memuat data peran.',
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'Tutup',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });
                }
            })
            .catch(err => {
                Swal.fire({
                    text: 'Gagal terhubung ke server: ' + err.message,
                    icon: 'error',
                    buttonsStyling: false,
                    confirmButtonText: 'Tutup',
                    customClass: { confirmButton: 'btn btn-primary' }
                });
            });
        }
    });

    // =========================================================================
    // 4. SUBMIT FORM PERAN (TAMBAH / UBAH)
    // =========================================================================
    if (roleForm) {
        roleForm.addEventListener('submit', function (e) {
            e.preventDefault();

            if (roleBtnSubmit) {
                roleBtnSubmit.setAttribute('data-kt-indicator', 'on');
                roleBtnSubmit.disabled = true;
            }

            const formData = new FormData(roleForm);

            fetch(roleForm.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (roleBtnSubmit) {
                    roleBtnSubmit.removeAttribute('data-kt-indicator');
                    roleBtnSubmit.disabled = false;
                }

                if (response.ok && data.success) {
                    if (roleFormModal) roleFormModal.hide();

                    Swal.fire({
                        text: data.message || 'Peran berhasil disimpan.',
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        customClass: { confirmButton: 'btn btn-primary' }
                    }).then(() => {
                        // Reload halaman tanpa FOUC atau update realtime
                        window.location.reload();
                    });
                } else {
                    let errMsg = data.message || 'Terjadi kesalahan saat menyimpan peran.';
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
                if (roleBtnSubmit) {
                    roleBtnSubmit.removeAttribute('data-kt-indicator');
                    roleBtnSubmit.disabled = false;
                }
                Swal.fire({
                    text: 'Gagal menghubungi server: ' + err.message,
                    icon: 'error',
                    buttonsStyling: false,
                    confirmButtonText: 'Tutup',
                    customClass: { confirmButton: 'btn btn-primary' }
                });
            });
        });
    }

    // =========================================================================
    // 5. VIEW DETAIL PERAN (MEMBUKA RINCIAN ANGGOTA & PERMISSIONS)
    // =========================================================================
    document.addEventListener('click', function (e) {
        const btnView = e.target.closest('.btn-view-role');
        if (btnView && roleViewModal) {
            const roleId = btnView.getAttribute('data-id');
            if (!roleId) return;

            document.getElementById('role_view_title').textContent = 'Memuat Rincian Peran...';
            document.getElementById('role_view_users_list').innerHTML = '<span class="text-muted fs-8">Memuat data pengguna...</span>';
            document.getElementById('role_view_perms_list').innerHTML = '<span class="text-muted fs-8">Memuat data izin...</span>';

            roleViewModal.show();

            fetch(`${routes.base}/${roleId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success && data.role) {
                    const role = data.role;
                    document.getElementById('role_view_title').textContent = `Peran: ${role.name}`;
                    document.getElementById('role_view_subtitle').textContent = data.is_protected ? 'Peran Sistem Bawaan Terlindungi' : 'Peran Kustom Organisasi';

                    document.getElementById('role_view_total_users').textContent = role.users_count || 0;
                    document.getElementById('role_view_total_perms').textContent = role.permissions_count || 0;

                    // Render Users
                    const usersList = document.getElementById('role_view_users_list');
                    if (role.users && role.users.length > 0) {
                        usersList.innerHTML = `
                            <div class="d-flex flex-column gap-2">
                                ${role.users.map(u => `
                                    <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded fs-8">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-bold text-gray-900">${u.name}</span>
                                            <span class="text-muted fs-9">(${u.email})</span>
                                        </div>
                                        <span class="badge badge-light-success fs-9">Aktif</span>
                                    </div>
                                `).join('')}
                            </div>
                        `;
                    } else {
                        usersList.innerHTML = '<span class="text-muted fs-8 fst-italic">Belum ada pengguna yang memiliki peran ini.</span>';
                    }

                    // Render Matrix Permissions Read-only
                    const activePermNames = (role.permissions || []).map(p => p.name);
                    document.querySelectorAll('#role_view_matrix_table .matrix-perm-cb').forEach(cb => {
                        cb.checked = activePermNames.includes(cb.value);
                    });
                    if (window.KTCRUDMatrixHelper) {
                        window.KTCRUDMatrixHelper.syncRowCheckStates('#role_view_matrix_table');
                    }
                }
            })
            .catch(err => {
                document.getElementById('role_view_users_list').innerHTML = `<span class="text-danger fs-8">Gagal memuat: ${err.message}</span>`;
            });
        }
    });

    // =========================================================================
    // 6. HAPUS PERAN
    // =========================================================================
    document.addEventListener('click', function (e) {
        const btnDelete = e.target.closest('.btn-delete-role');
        if (btnDelete) {
            const roleId = btnDelete.getAttribute('data-id');
            const roleName = btnDelete.getAttribute('data-name');
            if (!roleId) return;

            Swal.fire({
                title: `Hapus Peran \`${roleName}\`?`,
                text: 'Peran yang dihapus tidak dapat dipulihkan. Pastikan tidak ada pengguna aktif pada peran ini.',
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

                    fetch(`${routes.base}/${roleId}`, {
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
                                const cardCol = btnDelete.closest('.role-card-item');
                                if (cardCol) {
                                    cardCol.remove();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal Menghapus',
                                text: data.message || 'Peran gagal dihapus.',
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
