"use strict";

// Class definition
var KTAksesRoleMatrix = function () {
    var saveBtn;

    // Inisialisasi checkbox awal berdasarkan data roles matrix dari backend
    var initMatrixCheckboxes = function () {
        if (!window.AKSES_ROLE_MATRIX) return;

        Object.keys(window.AKSES_ROLE_MATRIX).forEach(function (roleId) {
            var assignedPerms = window.AKSES_ROLE_MATRIX[roleId] || [];
            var tableId = '#akses_role_' + roleId + '_table';
            var table = document.querySelector(tableId);
            if (!table) return;

            table.querySelectorAll('.matrix-perm-cb').forEach(function (cb) {
                cb.checked = assignedPerms.includes(cb.value);
            });

            if (window.KTCRUDMatrixHelper) {
                window.KTCRUDMatrixHelper.syncRowCheckStates(tableId);
            }
        });
    };

    // Inisialisasi Tombol Simpan Peran Ini (Zero-Reload AJAX)
    var initSaveAction = function () {
        saveBtn = document.getElementById('kt_btn_save_role_matrix');
        if (!saveBtn) return;

        saveBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Cari tab yang sedang aktif
            var activePane = document.querySelector('.role-tab-pane.active');
            if (!activePane) return;

            var roleId = activePane.getAttribute('data-role-id');
            var form = document.getElementById('form_role_matrix_' + roleId);
            if (!form) return;

            var checkedPerms = [];
            form.querySelectorAll('.matrix-perm-cb:checked').forEach(function (cb) {
                checkedPerms.push(cb.value);
            });

            // Aktifkan spinner
            saveBtn.setAttribute('data-kt-indicator', 'on');
            saveBtn.disabled = true;

            fetch(window.AKSES_ROLE_ROUTES.sync, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.AKSES_ROLE_ROUTES.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    role_id: roleId,
                    permissions: checkedPerms
                })
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                saveBtn.removeAttribute('data-kt-indicator');
                saveBtn.disabled = false;

                if (data.success) {
                    // Update counter badge di tab
                    var tabBadge = document.getElementById('tab_badge_role_' + roleId);
                    if (tabBadge && data.total_permissions !== undefined) {
                        tabBadge.textContent = data.total_permissions + ' Izin';
                    }

                    // Update memory state
                    if (window.AKSES_ROLE_MATRIX) {
                        window.AKSES_ROLE_MATRIX[roleId] = checkedPerms;
                    }

                    Swal.fire({
                        title: 'Tersimpan!',
                        text: data.message,
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'Selesai',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                } else {
                    toastr.error(data.message || 'Gagal menyimpan hak akses.', 'Terjadi Kesalahan');
                }
            })
            .catch(function (error) {
                saveBtn.removeAttribute('data-kt-indicator');
                saveBtn.disabled = false;
                toastr.error('Terjadi kesalahan koneksi ke server.', 'Error');
            });
        });
    };

    return {
        init: function () {
            initMatrixCheckboxes();
            initSaveAction();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAksesRoleMatrix.init();
});
