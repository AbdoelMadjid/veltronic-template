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
    const btnAddRoleBanner = document.getElementById('kt_btn_add_role_banner');

    const handleOpenAddRole = function () {
        resetForm();
        if (roleFormModal) roleFormModal.show();
    };

    if (btnAddNewRole) {
        btnAddNewRole.addEventListener('click', handleOpenAddRole);
    }
    if (btnAddRoleBanner) {
        btnAddRoleBanner.addEventListener('click', handleOpenAddRole);
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
            const roleName = btnView.getAttribute('data-name') || '';
            const isProtected = btnView.getAttribute('data-is-protected') === '1';
            const usersCount = btnView.getAttribute('data-users-count') || '0';
            const permsCount = btnView.getAttribute('data-perms-count') || '0';

            // 1. Instant Zero-Flicker Header & Stats Setup
            const titleEl = document.getElementById('role_view_title');
            if (titleEl) titleEl.textContent = roleName ? `Peran: ${roleName}` : 'Rincian Peran';
            
            const subtitleEl = document.getElementById('role_view_subtitle');
            if (subtitleEl) subtitleEl.textContent = isProtected ? 'Peran Sistem Bawaan Terlindungi' : 'Peran Kustom Organisasi';

            const totalUsersEl = document.getElementById('role_view_total_users');
            if (totalUsersEl) totalUsersEl.textContent = usersCount;

            const totalPermsEl = document.getElementById('role_view_total_perms');
            if (totalPermsEl) totalPermsEl.textContent = permsCount;

            const statusBadgeEl = document.getElementById('role_view_status_badge');
            if (statusBadgeEl) {
                if (isProtected) {
                    statusBadgeEl.className = 'badge badge-light-danger fw-bold fs-8';
                    statusBadgeEl.textContent = 'System Protected';
                } else {
                    statusBadgeEl.className = 'badge badge-light-primary fw-bold fs-8';
                    statusBadgeEl.textContent = 'Custom Role';
                }
            }
            
            const usersListEl = document.getElementById('role_view_users_list');
            if (usersListEl) usersListEl.innerHTML = '<span class="text-muted fs-8">Memuat daftar pengguna...</span>';

            // Reset checklist matriks view
            document.querySelectorAll('#role_view_matrix_table .matrix-perm-cb').forEach(cb => {
                cb.checked = false;
            });
            if (window.KTCRUDMatrixHelper) {
                window.KTCRUDMatrixHelper.syncRowCheckStates('#role_view_matrix_table');
            }

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

                    // Update stats jika ada pembaruan akurat dari backend
                    if (role.users_count !== undefined && totalUsersEl) {
                        totalUsersEl.textContent = role.users_count;
                    }
                    if (role.permissions_count !== undefined && totalPermsEl) {
                        totalPermsEl.textContent = role.permissions_count;
                    }

                    // Render Users
                    if (usersListEl) {
                        if (role.users && role.users.length > 0) {
                            usersListEl.innerHTML = `
                                <div class="d-flex flex-column gap-2">
                                    ${role.users.map(u => {
                                        const avStyle = u.avatar_style || (u.avatar_url ? `background-image: url('${u.avatar_url}'); background-position: 50% 0%; background-size: cover;` : '');
                                        const avInitial = u.initial || (u.name ? u.name.charAt(0).toUpperCase() : 'U');
                                        const avHtml = avStyle 
                                            ? `<div class="image-input-wrapper w-30px h-30px rounded-3" style="${avStyle}"></div>`
                                            : `<span class="symbol-label bg-light-primary text-primary fw-bold fs-7 rounded-3">${avInitial}</span>`;

                                        return `
                                            <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded fs-8">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="symbol symbol-30px flex-shrink-0">
                                                        ${avHtml}
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="fw-bold text-gray-900">${u.name}</span>
                                                        <span class="text-muted fs-9">${u.email || u.username}</span>
                                                    </div>
                                                </div>
                                                <span class="badge badge-light-success fs-9">Aktif</span>
                                            </div>
                                        `;
                                    }).join('')}
                                </div>
                            `;
                        } else {
                            usersListEl.innerHTML = '<span class="text-muted fs-8 fst-italic">Belum ada pengguna yang memiliki peran ini.</span>';
                        }
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
                const usersListErr = document.getElementById('role_view_users_list');
                if (usersListErr) {
                    usersListErr.innerHTML = `<span class="text-danger fs-8">Gagal memuat: ${err.message}</span>`;
                }
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
