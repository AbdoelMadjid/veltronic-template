"use strict";

// Class definition
var KTAksesUser = function () {
    // Shared variables
    var assignRoleModalEl;
    var assignRoleModal;
    var assignRoleForm;
    var assignRoleSubmitBtn;

    var directPermModalEl;
    var directPermModal;
    var directPermForm;
    var directPermSubmitBtn;
    var searchTimer = null;
    var currentPage = 1;

    // Fetch user table data via Zero-Reload AJAX
    var fetchUsers = function (page = 1) {
        currentPage = page;
        var searchInput = document.getElementById('table_search_input');
        var roleDropdown = $('#filter_role_dropdown');

        var search = searchInput ? searchInput.value.trim() : '';
        var role = roleDropdown.length ? roleDropdown.val() : 'all';

        var params = new URLSearchParams();
        if (page > 1) params.append('page', page);
        if (search) params.append('search', search);
        if (role && role !== 'all') params.append('role', role);

        var url = window.AKSES_USER_ROUTES.base + (params.toString() ? '?' + params.toString() : '');

        var tbody = document.getElementById('user_access_tbody');
        if (tbody) {
            tbody.style.opacity = '0.5';
        }

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function (res) {
            return res.json();
        })
        .then(function (data) {
            if (tbody) {
                tbody.style.opacity = '1';
                if (data.html_rows !== undefined) {
                    tbody.innerHTML = data.html_rows;
                }
            }

            var pagEl = document.getElementById('user_access_pagination');
            if (pagEl && data.html_pagination !== undefined) {
                pagEl.innerHTML = data.html_pagination;
            }

            var countEl = document.getElementById('user_access_total_count');
            if (countEl && data.total !== undefined) {
                countEl.textContent = data.total;
            }

            // Re-inisialisasi tooltip jika ada
            if (window.bootstrap && bootstrap.Tooltip) {
                document.querySelectorAll('#user_access_tbody [data-bs-toggle="tooltip"]').forEach(function (el) {
                    new bootstrap.Tooltip(el);
                });
            }

            // Zero-Reload: Jaga URL browser tetap bersih tanpa parameter query ?page=xx
            if (window.history && window.history.replaceState) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        })
        .catch(function (err) {
            if (tbody) tbody.style.opacity = '1';
            console.error('Gagal mengambil data hak akses pengguna:', err);
        });
    };

    // Inisialisasi Modal Assign Role
    var initAssignRoleModal = function () {
        assignRoleModalEl = document.getElementById('kt_modal_assign_role');
        if (!assignRoleModalEl) return;

        assignRoleModal = new bootstrap.Modal(assignRoleModalEl);
        assignRoleForm = document.getElementById('kt_form_assign_role');
        assignRoleSubmitBtn = document.getElementById('kt_modal_assign_role_submit');

        // Buka modal saat tombol diklik (Event Delegation)
        $(document).on('click', '.btn-action-assign-role', function (e) {
            e.preventDefault();
            var userId = this.getAttribute('data-user-id');
            var userName = this.getAttribute('data-user-name');
            var userRoles = [];
            try {
                userRoles = JSON.parse(this.getAttribute('data-user-roles') || '[]');
            } catch (err) {
                userRoles = [];
            }

            document.getElementById('assign_role_user_id').value = userId;
            document.getElementById('assign_role_user_name_display').textContent = userName;

            // Reset dan centang checkbox role
            document.querySelectorAll('.role-checkbox-item').forEach(function (cb) {
                cb.checked = userRoles.includes(cb.value);
            });

            assignRoleModal.show();
        });

        // Submit form assign role
        if (assignRoleForm) {
            assignRoleForm.addEventListener('submit', function (e) {
                e.preventDefault();

                var userId = document.getElementById('assign_role_user_id').value;
                var checkedRoles = [];
                document.querySelectorAll('.role-checkbox-item:checked').forEach(function (cb) {
                    checkedRoles.push(cb.value);
                });

                if (checkedRoles.length === 0) {
                    toastr.warning('Pilih minimal satu peran untuk pengguna ini.', 'Peringatan');
                    return;
                }

                // Aktifkan spinner loading
                assignRoleSubmitBtn.setAttribute('data-kt-indicator', 'on');
                assignRoleSubmitBtn.disabled = true;

                fetch(window.AKSES_USER_ROUTES.assignRole, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.AKSES_USER_ROUTES.csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        roles: checkedRoles
                    })
                })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    assignRoleSubmitBtn.removeAttribute('data-kt-indicator');
                    assignRoleSubmitBtn.disabled = false;

                    if (data.success) {
                        assignRoleModal.hide();

                        // Realtime update DOM badge peran di tabel
                        var rolesContainer = document.getElementById('user-roles-container-' + userId);
                        if (rolesContainer && data.user && data.user.roles) {
                            var badgesHtml = '';
                            var updatedRoleNames = [];
                            data.user.roles.forEach(function (r) {
                                updatedRoleNames.push(r.name);
                                var badgeClass = 'badge-light-info';
                                if (r.name === 'master') badgeClass = 'badge-light-danger';
                                else if (r.name === 'admin') badgeClass = 'badge-light-primary';

                                badgesHtml += '<span class="badge ' + badgeClass + ' fw-bold">' + r.display_name + '</span> ';
                            });
                            rolesContainer.innerHTML = badgesHtml || '<span class="badge badge-light-secondary text-muted">Tanpa Peran</span>';

                            // Update data atribut tombol aksi
                            var actionBtn = document.querySelector('.btn-action-assign-role[data-user-id="' + userId + '"]');
                            if (actionBtn) {
                                actionBtn.setAttribute('data-user-roles', JSON.stringify(updatedRoleNames));
                            }
                        }

                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Selesai',
                            customClass: {
                                confirmButton: 'btn btn-primary fw-bold'
                            }
                        });
                    } else {
                        toastr.error(data.message || 'Gagal mengubah peran.', 'Terjadi Kesalahan');
                    }
                })
                .catch(function () {
                    assignRoleSubmitBtn.removeAttribute('data-kt-indicator');
                    assignRoleSubmitBtn.disabled = false;
                    toastr.error('Terjadi kesalahan koneksi server.', 'Error');
                });
            });
        }
    };

    // Inisialisasi Modal Direct Permissions Override
    var initDirectPermModal = function () {
        directPermModalEl = document.getElementById('kt_modal_direct_permissions');
        if (!directPermModalEl) return;

        directPermModal = new bootstrap.Modal(directPermModalEl);
        directPermForm = document.getElementById('kt_form_direct_permissions');
        directPermSubmitBtn = document.getElementById('kt_modal_direct_permissions_submit');

        // Buka modal saat tombol direct perm diklik (Event Delegation)
        $(document).on('click', '.btn-action-direct-perm', function (e) {
            e.preventDefault();
            var userId = this.getAttribute('data-user-id');
            var userName = this.getAttribute('data-user-name');

            document.getElementById('direct_perm_user_id').value = userId;
            document.getElementById('direct_perm_user_name_display').textContent = userName;
            document.getElementById('direct_perm_user_roles_display').textContent = 'Memuat...';

            // Reset semua checkbox matrix & hapus badge inherited lama
            document.querySelectorAll('#user_direct_matrix_table .inherited-role-badge').forEach(function (el) {
                el.remove();
            });
            document.querySelectorAll('#user_direct_matrix_table .form-check').forEach(function (fc) {
                fc.classList.remove('d-none');
            });
            document.querySelectorAll('#user_direct_matrix_table .matrix-perm-cb').forEach(function (cb) {
                cb.checked = false;
            });

            // Fetch data permission user
            fetch(window.AKSES_USER_ROUTES.base + '/' + userId + '/permissions', {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(function (res) {
                return res.json();
            })
            .then(function (data) {
                if (data.success) {
                    var rolesText = (data.user.roles || []).join(', ') || 'Tanpa Peran';
                    document.getElementById('direct_perm_user_roles_display').textContent = rolesText;

                    var directPerms = data.direct_permissions || [];
                    var rolePerms = data.role_permissions || [];
                    var inheritedMap = data.inherited_map || {};

                    // Render status checkbox dan badge inherited peran
                    document.querySelectorAll('#user_direct_matrix_table .matrix-perm-cb').forEach(function (cb) {
                        var permVal = cb.value;
                        var isDirect = directPerms.includes(permVal);
                        var isInherited = rolePerms.includes(permVal);

                        var parentWrapper = cb.closest('.form-check');
                        var cellContainer = cb.closest('td');

                        if (isInherited && parentWrapper && cellContainer) {
                            // Sembunyikan checkbox dan tampilkan badge 'Peran' yang rapi dan elegan
                            parentWrapper.classList.add('d-none');
                            cb.checked = false;

                            var roleSources = (inheritedMap[permVal] || []).join(', ') || 'Peran';
                            var badge = document.createElement('span');
                            badge.className = 'badge badge-light-primary fw-bold fs-9 py-1 px-2 d-inline-flex align-items-center inherited-role-badge';
                            badge.setAttribute('data-bs-toggle', 'tooltip');
                            badge.setAttribute('data-bs-placement', 'top');
                            badge.setAttribute('title', 'Sudah aktif otomatis dari peran: ' + roleSources);
                            badge.innerHTML = '<i class="ki-outline ki-shield-tick text-primary fs-8 me-1"></i>Peran';

                            var flexWrapper = cellContainer.querySelector('.d-flex.justify-content-center') || cellContainer;
                            flexWrapper.appendChild(badge);
                        } else {
                            if (parentWrapper) {
                                parentWrapper.classList.remove('d-none');
                            }
                            cb.checked = isDirect;
                        }
                    });

                    if (window.KTCRUDMatrixHelper) {
                        window.KTCRUDMatrixHelper.syncRowCheckStates('#user_direct_matrix_table');
                    }

                    // Re-inisialisasi Bootstrap Tooltip
                    if (window.bootstrap && bootstrap.Tooltip) {
                        var tooltips = [].slice.call(document.querySelectorAll('#user_direct_matrix_table [data-bs-toggle="tooltip"]'));
                        tooltips.map(function (el) {
                            return new bootstrap.Tooltip(el);
                        });
                    }

                    directPermModal.show();
                } else {
                    toastr.error('Gagal memuat rincian izin pengguna.', 'Error');
                }
            })
            .catch(function () {
                toastr.error('Terjadi kesalahan koneksi server.', 'Error');
            });
        });

        // Submit form direct permissions
        if (directPermForm) {
            directPermForm.addEventListener('submit', function (e) {
                e.preventDefault();

                var userId = document.getElementById('direct_perm_user_id').value;
                var checkedPerms = [];
                document.querySelectorAll('#user_direct_matrix_table .matrix-perm-cb:checked').forEach(function (cb) {
                    checkedPerms.push(cb.value);
                });

                // Aktifkan spinner loading
                directPermSubmitBtn.setAttribute('data-kt-indicator', 'on');
                directPermSubmitBtn.disabled = true;

                fetch(window.AKSES_USER_ROUTES.base + '/' + userId + '/direct-permissions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.AKSES_USER_ROUTES.csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        permissions: checkedPerms
                    })
                })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    directPermSubmitBtn.removeAttribute('data-kt-indicator');
                    directPermSubmitBtn.disabled = false;

                    if (data.success) {
                        directPermModal.hide();

                        // Realtime update DOM badge direct permission di tabel
                        var permContainer = document.getElementById('user-direct-perm-container-' + userId);
                        if (permContainer) {
                            if (data.direct_count > 0) {
                                permContainer.innerHTML = '<span class="badge badge-light-warning fw-bold">' + data.direct_count + ' Izin Khusus</span>';
                            } else {
                                permContainer.innerHTML = '<span class="badge badge-light-secondary text-muted">Bawaan Peran</span>';
                            }
                        }

                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Selesai',
                            customClass: {
                                confirmButton: 'btn btn-primary fw-bold'
                            }
                        });
                    } else {
                        toastr.error(data.message || 'Gagal menyimpan izin khusus.', 'Terjadi Kesalahan');
                    }
                })
                .catch(function () {
                    directPermSubmitBtn.removeAttribute('data-kt-indicator');
                    directPermSubmitBtn.disabled = false;
                    toastr.error('Terjadi kesalahan koneksi server.', 'Error');
                });
            });
        }

        // Search filter di dalam modal direct permissions
        var searchInputModal = document.getElementById('modal_direct_perm_search');
        if (searchInputModal) {
            searchInputModal.addEventListener('keyup', function (e) {
                var query = e.target.value.toLowerCase().trim();
                var items = document.querySelectorAll('.direct-perm-item');
                var blocks = document.querySelectorAll('.direct-perm-module-block');

                items.forEach(function (item) {
                    var pName = item.getAttribute('data-perm-name') || '';
                    if (pName.indexOf(query) > -1 || query === '') {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });

                blocks.forEach(function (block) {
                    var visibleItems = block.querySelectorAll('.direct-perm-item:not([style*="display: none"])');
                    if (visibleItems.length > 0) {
                        block.style.display = '';
                    } else {
                        block.style.display = 'none';
                    }
                });
            });
        }
    };

    // Filter, Search, & Pagination Intercept Tabel Utama (Zero-Reload)
    var initTableFiltersAndPagination = function () {
        var searchInput = document.getElementById('table_search_input');
        var roleDropdown = $('#filter_role_dropdown');
        var resetBtn = document.getElementById('btn_reset_filter');

        // Pagination Click Listener (Zero-Reload)
        $(document).on('click', '#user_access_pagination .page-link', function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            if (!href || href === '#' || $(this).parent().hasClass('disabled') || $(this).parent().hasClass('active')) {
                return;
            }

            try {
                var urlObj = new URL(href, window.location.origin);
                var targetPage = urlObj.searchParams.get('page') || 1;
                fetchUsers(targetPage);
            } catch (err) {
                // Fallback jika href bukan full URL
                var match = href.match(/[?&]page=(\d+)/);
                var targetPage = match ? match[1] : 1;
                fetchUsers(targetPage);
            }
        });

        // Live Search with Debouncing
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function () {
                    fetchUsers(1);
                }, 300);
            });

            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimer);
                    fetchUsers(1);
                }
            });
        }

        // Role Dropdown Change
        if (roleDropdown.length) {
            roleDropdown.on('change', function () {
                fetchUsers(1);
            });
        }

        // Reset Filter Button
        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                if (searchInput) searchInput.value = '';
                if (roleDropdown.length) {
                    roleDropdown.val('all').trigger('change.select2');
                }
                fetchUsers(1);
            });
        }
    };

    return {
        init: function () {
            initAssignRoleModal();
            initDirectPermModal();
            initTableFiltersAndPagination();
        },
        reload: function () {
            fetchUsers(currentPage);
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAksesUser.init();
});
