/**
 * User Management - Data Login & Points Module JS
 * Veltronic / Metronic 8 Theme
 */
"use strict";

const KTDataLogin = (function () {
    let table = null;
    let datatable = null;
    let detailModal = null;
    let clearModal = null;

    // Elements
    const searchInput = document.getElementById('kt_filter_search');
    const typeSelect = document.getElementById('kt_filter_type');
    const pointSelect = document.getElementById('kt_filter_point');
    const roleSelect = document.getElementById('kt_filter_role');
    const dateRangeSelect = document.getElementById('kt_filter_date_range');
    const checkAll = document.getElementById('kt_check_all_logins');
    const bulkDeleteBtn = document.getElementById('kt_btn_bulk_delete');
    const selectedCountSpan = document.getElementById('kt_selected_count');
    const refreshBtn = document.getElementById('kt_btn_refresh_data_login');
    const confirmClearBtn = document.getElementById('kt_btn_confirm_clear_logs');
    const clearPeriodSelect = document.getElementById('kt_clear_period_select');

    // Update Live Statistics
    const updateStats = (stats) => {
        if (!stats) return;

        const formatNum = (num) => new Intl.NumberFormat('id-ID').format(num || 0);

        const elTotal = document.getElementById('stat_total_logins');
        if (elTotal) elTotal.textContent = formatNum(stats.total_logins);

        const elWeb = document.getElementById('stat_web_logins');
        if (elWeb) elWeb.textContent = formatNum(stats.web_logins) + ' Web';

        const elLock = document.getElementById('stat_lockscreen_logins');
        if (elLock) elLock.textContent = formatNum(stats.lockscreen_logins) + ' Kunci';

        const elPoints = document.getElementById('stat_total_points_earned');
        if (elPoints) elPoints.innerHTML = `${formatNum(stats.total_points_earned)} <span class="fs-6 fw-semibold text-muted">Poin</span>`;

        const elTodayPoints = document.getElementById('stat_today_points_earned');
        if (elTodayPoints) elTodayPoints.textContent = `+${formatNum(stats.today_points_earned)} poin hari ini`;

        const elActive = document.getElementById('stat_active_users_today');
        if (elActive) elActive.textContent = formatNum(stats.active_users_today);
    };

    // Update Bulk Delete Action State
    const updateSelectedState = () => {
        if (!table || !bulkDeleteBtn || !selectedCountSpan) return;

        const checkedBoxes = table.querySelectorAll('tbody input[type="checkbox"]:checked');
        const count = checkedBoxes.length;

        if (count > 0) {
            selectedCountSpan.textContent = count;
            bulkDeleteBtn.classList.remove('d-none');
        } else {
            selectedCountSpan.textContent = '0';
            bulkDeleteBtn.classList.add('d-none');
        }

        if (checkAll) {
            const allBoxes = table.querySelectorAll('tbody input[type="checkbox"]');
            checkAll.checked = allBoxes.length > 0 && checkedBoxes.length === allBoxes.length;
        }
    };

    // Initialize DataTable
    const initDataTable = () => {
        table = document.getElementById('kt_table_data_login');
        if (!table) return;

        datatable = $(table).DataTable({
            responsive: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[6, 'desc']], // Default Sort by Waktu Sesi (created_at)
            stateSave: false,
            ajax: {
                url: window.DATA_LOGIN_CONFIG?.urlIndex || window.location.href,
                type: 'GET',
                data: function (d) {
                    d.search = searchInput ? searchInput.value : '';
                    d.type = typeSelect ? $(typeSelect).val() : 'all';
                    d.point_earned = pointSelect ? $(pointSelect).val() : 'all';
                    d.role = roleSelect ? $(roleSelect).val() : 'all';
                    d.date_range = dateRangeSelect ? $(dateRangeSelect).val() : '';
                },
                dataSrc: function (json) {
                    if (json.stats) {
                        updateStats(json.stats);
                    }
                    return json.data;
                },
                error: function (xhr, error, code) {
                    console.error('DataTables load error:', error);
                }
            },
            columns: [
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input row-select-checkbox" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    data: 'user',
                    name: 'user_id',
                    render: function (user, type, row) {
                        if (!user) return '<span class="text-muted fst-italic">Pengguna Dihapus</span>';
                        return `
                            <div class="d-flex align-items-center">
                                ${user.avatar_html || ''}
                                <div class="d-flex flex-column">
                                    <span class="text-gray-900 fw-bold fs-6 mb-1">${user.name || '-'}</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-muted fs-7">${user.email || '-'}</span>
                                        ${user.role_badge || ''}
                                    </div>
                                </div>
                            </div>`;
                    }
                },
                {
                    data: 'type_badge',
                    name: 'type',
                    render: function (data) {
                        return data;
                    }
                },
                {
                    data: 'point_badge',
                    name: 'point_earned',
                    render: function (data) {
                        return data;
                    }
                },
                {
                    data: 'device',
                    name: 'device',
                    render: function (data, type, row) {
                        return `
                            <div class="d-flex align-items-center">
                                <i class="ki-outline ${row.device_icon || 'ki-laptop'} fs-3 text-gray-500 me-2"></i>
                                <div class="d-flex flex-column">
                                    <span class="text-gray-800 fw-semibold fs-7">${row.browser || '-'}</span>
                                    <span class="text-muted fs-8">${row.platform || '-'} (${data || 'Desktop'})</span>
                                </div>
                            </div>`;
                    }
                },
                {
                    data: 'ip_address',
                    name: 'ip_address',
                    render: function (data) {
                        return `<span class="badge badge-light-secondary font-monospace fs-7 px-2 py-1">${data || '-'}</span>`;
                    }
                },
                {
                    data: 'created_at_formatted',
                    name: 'created_at',
                    render: function (data, type, row) {
                        return `
                            <div class="d-flex flex-column">
                                <span class="text-gray-900 fw-bold fs-7">${data}</span>
                                <span class="text-muted fs-8">${row.created_at_relative || '-'}</span>
                            </div>`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: 'text-end pe-4',
                    render: function (data, type, row) {
                        const rowJson = encodeURIComponent(JSON.stringify(row));
                        return `
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-icon btn-light-primary btn-sm rounded-circle btn-view-detail" data-row="${rowJson}" data-bs-toggle="tooltip" title="Lihat Detail Sesi">
                                    <i class="ki-outline ki-eye fs-5"></i>
                                </button>
                                <button type="button" class="btn btn-icon btn-light-danger btn-sm rounded-circle btn-delete-row" data-id="${row.id}" data-bs-toggle="tooltip" title="Hapus Riwayat">
                                    <i class="ki-outline ki-trash fs-5"></i>
                                </button>
                            </div>`;
                    }
                }
            ],
            language: {
                emptyTable: "Belum ada riwayat data login pengguna yang tercatat.",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ total riwayat",
                infoEmpty: "Menampilkan 0 riwayat",
                infoFiltered: "(disaring dari _MAX_ total data)",
                lengthMenu: "Tampilkan _MENU_",
                loadingRecords: "Memuat data...",
                processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Memuat riwayat login...',
                search: "Cari:",
                zeroRecords: "Tidak ada riwayat login yang cocok dengan kriteria pencarian.",
                paginate: {
                    first: '<i class="ki-outline ki-double-left fs-4"></i>',
                    last: '<i class="ki-outline ki-double-right fs-4"></i>',
                    next: '<i class="ki-outline ki-right fs-4"></i>',
                    previous: '<i class="ki-outline ki-left fs-4"></i>'
                }
            }
        });

        // Event: Draw / redraw complete
        datatable.on('draw', function () {
            updateSelectedState();
            if (typeof KTComponents !== 'undefined' && KTComponents.init) {
                KTComponents.init();
            }
        });
    };

    // Filter Change Listeners
    const initFilterListeners = () => {
        // Search Input Debounce
        let searchTimeout;
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    datatable.draw();
                }, 400);
            });
        }

        // Select Filters
        [typeSelect, pointSelect, roleSelect, dateRangeSelect].forEach(select => {
            if (select) {
                $(select).on('change', function () {
                    datatable.draw();
                });
            }
        });

        // Check All Checkbox
        if (checkAll) {
            checkAll.addEventListener('change', function () {
                const checked = this.checked;
                const checkboxes = table.querySelectorAll('tbody .row-select-checkbox');
                checkboxes.forEach(cb => {
                    cb.checked = checked;
                });
                updateSelectedState();
            });
        }

        // Row Checkboxes
        if (table) {
            table.addEventListener('change', function (e) {
                if (e.target && e.target.classList.contains('row-select-checkbox')) {
                    updateSelectedState();
                }
            });
        }

        // Refresh Button
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function () {
                refreshBtn.setAttribute('data-kt-indicator', 'on');
                refreshBtn.disabled = true;

                datatable.ajax.reload(function () {
                    refreshBtn.removeAttribute('data-kt-indicator');
                    refreshBtn.disabled = false;
                    if (typeof Swal !== 'undefined') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Data login berhasil disegarkan.'
                        });
                    }
                }, false);
            });
        }
    };

    // Row Actions: View Detail Modal & Delete
    const initRowActions = () => {
        const modalDetailEl = document.getElementById('kt_modal_detail_login');
        if (modalDetailEl && typeof bootstrap !== 'undefined') {
            detailModal = bootstrap.Modal.getOrCreateInstance(modalDetailEl);
        }

        const modalClearEl = document.getElementById('kt_modal_clear_logs');
        if (modalClearEl && typeof bootstrap !== 'undefined') {
            clearModal = bootstrap.Modal.getOrCreateInstance(modalClearEl);
        }

        // Click on View Detail
        $(document).on('click', '.btn-view-detail', function () {
            const raw = $(this).attr('data-row');
            if (!raw) return;

            try {
                const data = JSON.parse(decodeURIComponent(raw));
                const user = data.user || {};

                // Set User Details
                const avatarContainer = document.getElementById('modal_detail_avatar');
                if (avatarContainer) avatarContainer.innerHTML = user.avatar_html || '';

                const nameEl = document.getElementById('modal_detail_name');
                if (nameEl) nameEl.textContent = user.name || 'Pengguna Dihapus';

                const emailEl = document.getElementById('modal_detail_email');
                if (emailEl) emailEl.textContent = user.email || '-';

                const roleEl = document.getElementById('modal_detail_role');
                if (roleEl) roleEl.innerHTML = user.role_badge || '';

                const userPointsEl = document.getElementById('modal_detail_user_points');
                if (userPointsEl) userPointsEl.textContent = (user.points || 0) + ' Total Poin';

                const userLoginsEl = document.getElementById('modal_detail_login_count');
                if (userLoginsEl) userLoginsEl.textContent = (user.login_count || 0) + 'x Total Login';

                // Set Session Details
                const typeEl = document.getElementById('modal_detail_type');
                if (typeEl) typeEl.innerHTML = data.type_badge || '-';

                const pointEl = document.getElementById('modal_detail_point');
                if (pointEl) pointEl.innerHTML = data.point_badge || '-';

                const ipEl = document.getElementById('modal_detail_ip');
                if (ipEl) ipEl.textContent = data.ip_address || '-';

                const deviceEl = document.getElementById('modal_detail_device');
                if (deviceEl) deviceEl.textContent = data.device || 'Desktop';

                const browserOsEl = document.getElementById('modal_detail_browser_os');
                if (browserOsEl) browserOsEl.textContent = `${data.browser || '-'} di ${data.platform || '-'}`;

                const timeEl = document.getElementById('modal_detail_time');
                if (timeEl) timeEl.textContent = `${data.created_at_formatted} (${data.created_at_relative})`;

                const uaEl = document.getElementById('modal_detail_user_agent');
                if (uaEl) uaEl.textContent = data.user_agent || '-';

                if (detailModal) {
                    detailModal.show();
                }
            } catch (err) {
                console.error('Error parsing row detail:', err);
            }
        });

        // Click on Delete Single Row
        $(document).on('click', '.btn-delete-row', function () {
            const id = $(this).attr('data-id');
            const btn = this;
            if (!id) return;

            Swal.fire({
                title: 'Hapus Riwayat Sesi?',
                text: 'Data riwayat login ini akan dihapus secara permanen dari basis data.',
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger rounded-pill px-5',
                    cancelButton: 'btn btn-light rounded-pill px-5'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.disabled = true;

                    fetch(`/usermanagement/data-login/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': window.DATA_LOGIN_CONFIG?.csrfToken || '',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(async res => {
                        btn.disabled = false;
                        const data = await res.json();
                        if (res.ok && data.success) {
                            if (data.stats) updateStats(data.stats);
                            datatable.ajax.reload(null, false);
                            Swal.fire({
                                text: data.message || 'Riwayat berhasil dihapus.',
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'OK',
                                customClass: { confirmButton: 'btn btn-primary rounded-pill px-5' }
                            });
                        } else {
                            Swal.fire({
                                text: data.message || 'Gagal menghapus riwayat.',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Tutup',
                                customClass: { confirmButton: 'btn btn-primary rounded-pill px-5' }
                            });
                        }
                    })
                    .catch(err => {
                        btn.disabled = false;
                        console.error('Delete error:', err);
                        Swal.fire({
                            text: 'Gagal terhubung ke server.',
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Tutup',
                            customClass: { confirmButton: 'btn btn-primary rounded-pill px-5' }
                        });
                    });
                }
            });
        });

        // Click on Bulk Delete Button
        if (bulkDeleteBtn) {
            bulkDeleteBtn.addEventListener('click', function () {
                const checkedBoxes = table.querySelectorAll('tbody input[type="checkbox"]:checked');
                const ids = Array.from(checkedBoxes).map(cb => parseInt(cb.value, 10)).filter(id => !isNaN(id));

                if (ids.length === 0) return;

                Swal.fire({
                    title: `Hapus ${ids.length} Riwayat Terpilih?`,
                    text: 'Seluruh riwayat sesi terpilih akan dihapus secara permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: `Ya, Hapus (${ids.length}) Data`,
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger rounded-pill px-5',
                        cancelButton: 'btn btn-light rounded-pill px-5'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        bulkDeleteBtn.setAttribute('data-kt-indicator', 'on');
                        bulkDeleteBtn.disabled = true;

                        fetch(window.DATA_LOGIN_CONFIG?.urlBulkDelete || '/usermanagement/data-login/bulk-delete', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': window.DATA_LOGIN_CONFIG?.csrfToken || '',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ ids: ids })
                        })
                        .then(async res => {
                            bulkDeleteBtn.removeAttribute('data-kt-indicator');
                            bulkDeleteBtn.disabled = false;

                            const data = await res.json();
                            if (res.ok && data.success) {
                                if (data.stats) updateStats(data.stats);
                                datatable.ajax.reload(null, false);
                                updateSelectedState();
                                Swal.fire({
                                    text: data.message || 'Data riwayat berhasil dihapus.',
                                    icon: 'success',
                                    buttonsStyling: false,
                                    confirmButtonText: 'OK',
                                    customClass: { confirmButton: 'btn btn-primary rounded-pill px-5' }
                                });
                            } else {
                                Swal.fire({
                                    text: data.message || 'Gagal menghapus data.',
                                    icon: 'error',
                                    buttonsStyling: false,
                                    confirmButtonText: 'Tutup',
                                    customClass: { confirmButton: 'btn btn-primary rounded-pill px-5' }
                                });
                            }
                        })
                        .catch(err => {
                            bulkDeleteBtn.removeAttribute('data-kt-indicator');
                            bulkDeleteBtn.disabled = false;
                            console.error('Bulk delete error:', err);
                            Swal.fire({
                                text: 'Gagal terhubung ke server.',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Tutup',
                                customClass: { confirmButton: 'btn btn-primary rounded-pill px-5' }
                            });
                        });
                    }
                });
            });
        }

        // Click on Confirm Clear Logs Modal
        if (confirmClearBtn && clearPeriodSelect) {
            confirmClearBtn.addEventListener('click', function () {
                const period = clearPeriodSelect.value;

                confirmClearBtn.setAttribute('data-kt-indicator', 'on');
                confirmClearBtn.disabled = true;

                fetch(window.DATA_LOGIN_CONFIG?.urlClear || '/usermanagement/data-login/clear', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.DATA_LOGIN_CONFIG?.csrfToken || '',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ period: period })
                })
                .then(async res => {
                    confirmClearBtn.removeAttribute('data-kt-indicator');
                    confirmClearBtn.disabled = false;

                    const data = await res.json();
                    if (clearModal) clearModal.hide();

                    if (res.ok && data.success) {
                        if (data.stats) updateStats(data.stats);
                        datatable.ajax.reload(null, false);
                        Swal.fire({
                            text: data.message || 'Pembersihan log berhasil.',
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'OK',
                            customClass: { confirmButton: 'btn btn-primary rounded-pill px-5' }
                        });
                    } else {
                        Swal.fire({
                            text: data.message || 'Gagal membersihkan log.',
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Tutup',
                            customClass: { confirmButton: 'btn btn-primary rounded-pill px-5' }
                        });
                    }
                })
                .catch(err => {
                    confirmClearBtn.removeAttribute('data-kt-indicator');
                    confirmClearBtn.disabled = false;
                    if (clearModal) clearModal.hide();
                    console.error('Clear log error:', err);
                    Swal.fire({
                        text: 'Gagal terhubung ke server.',
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'Tutup',
                        customClass: { confirmButton: 'btn btn-primary rounded-pill px-5' }
                    });
                });
            });
        }
    };

    // Public API
    return {
        init: function () {
            initDataTable();
            initFilterListeners();
            initRowActions();
        }
    };
})();

// Document Ready Initialization
KTUtil.onDOMContentLoaded(function () {
    KTDataLogin.init();
});
