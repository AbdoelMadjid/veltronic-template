/**
 * Modul Database Backup & Relasi Skema (AppSupport)
 * Zero-Reload Realtime CRUD & Metronic Interactive Components
 */
"use strict";

document.addEventListener('DOMContentLoaded', function () {
    const routes = window.BACKUP_ROUTES || {};

    // Inisialisasi Tooltips
    const initTooltips = () => {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, { trigger: 'hover' });
        });
    };
    initTooltips();

    // =========================================================================
    // 1. MANAJEMEN SELEKSI TABEL (CHECKBOX & COUNTER)
    // =========================================================================
    const checkMaster = document.getElementById('kt_check_master');
    const checkAllBtn = document.getElementById('kt_check_all_tables');
    const tableCheckboxes = () => document.querySelectorAll('.table-checkbox');
    const btnBackupSelected = document.getElementById('kt_btn_backup_selected');
    const badgeSelectedCount = document.getElementById('kt_selected_tables_badge');

    const updateSelectedCounter = () => {
        const checked = document.querySelectorAll('.table-checkbox:checked');
        const count = checked.length;

        if (badgeSelectedCount) {
            badgeSelectedCount.textContent = count;
        }

        if (btnBackupSelected) {
            btnBackupSelected.disabled = (count === 0);
        }

        const allBoxes = tableCheckboxes();
        if (checkMaster && allBoxes.length > 0) {
            checkMaster.checked = (count === allBoxes.length);
            checkMaster.indeterminate = (count > 0 && count < allBoxes.length);
        }
        if (checkAllBtn && allBoxes.length > 0) {
            checkAllBtn.checked = (count === allBoxes.length);
        }
    };

    if (checkMaster) {
        checkMaster.addEventListener('change', function () {
            const isChecked = this.checked;
            tableCheckboxes().forEach(cb => {
                // Hanya centang baris yang terlihat (tidak disembunyikan oleh filter/search)
                const tr = cb.closest('tr');
                if (tr && tr.style.display !== 'none') {
                    cb.checked = isChecked;
                }
            });
            updateSelectedCounter();
        });
    }

    if (checkAllBtn) {
        checkAllBtn.addEventListener('change', function () {
            const isChecked = this.checked;
            tableCheckboxes().forEach(cb => {
                const tr = cb.closest('tr');
                if (tr && tr.style.display !== 'none') {
                    cb.checked = isChecked;
                }
            });
            updateSelectedCounter();
        });
    }

    const switchAutoRelational = document.getElementById('kt_switch_auto_relational_select');

    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('table-checkbox')) {
            const currentBox = e.target;
            const isChecked = currentBox.checked;
            const currentTable = currentBox.value;

            // Jika switch auto-centang relasi aktif dan checkbox sedang dicentang
            if (isChecked && switchAutoRelational && switchAutoRelational.checked) {
                let relatedData = [];
                try {
                    const rawRelated = currentBox.getAttribute('data-related');
                    relatedData = rawRelated ? JSON.parse(rawRelated) : [];
                } catch (err) {
                    relatedData = [];
                }

                if (relatedData && relatedData.length > 0) {
                    const newlyAutoChecked = [];

                    relatedData.forEach(relTable => {
                        const targetCb = document.querySelector(`.table-checkbox[value="${relTable}"]`);
                        if (targetCb && !targetCb.checked) {
                            targetCb.checked = true;
                            newlyAutoChecked.push(relTable);

                            // Highlight visual baris tabel yang baru ikut tercentang
                            const tr = targetCb.closest('tr');
                            if (tr) {
                                tr.classList.add('bg-light-primary');
                                setTimeout(() => {
                                    tr.classList.remove('bg-light-primary');
                                }, 1800);
                            }
                        }
                    });

                    if (newlyAutoChecked.length > 0 && typeof toastr !== 'undefined') {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "timeOut": "3500",
                            "positionClass": "toastr-bottom-right"
                        };
                        toastr.info(
                            `Tabel terkait (<strong>${newlyAutoChecked.join(', ')}</strong>) otomatis ikut dicentang untuk menjaga integritas relasi Foreign Key.`,
                            `Relasi Tabel \`${currentTable}\``
                        );
                    }
                }
            }

            updateSelectedCounter();
        }
    });

    // =========================================================================
    // 2. FILTER & PENCARIAN TABEL SKEMA
    // =========================================================================
    const searchInput = document.getElementById('kt_filter_table_search');
    const relationFilter = document.getElementById('kt_filter_relation_type');

    const filterTables = () => {
        const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
        const relType = relationFilter ? relationFilter.value : 'all';
        const rows = document.querySelectorAll('#kt_tables_relation_datatable tbody tr.table-row-item');

        rows.forEach(row => {
            const tableName = (row.getAttribute('data-table-name') || '').toLowerCase();
            const hasRelation = row.classList.contains('has-relation');

            let matchesSearch = tableName.includes(query);
            let matchesRelation = true;

            if (relType === 'with_relations') {
                matchesRelation = hasRelation;
            } else if (relType === 'no_relations') {
                matchesRelation = !hasRelation;
            }

            if (matchesSearch && matchesRelation) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    };

    if (searchInput) {
        searchInput.addEventListener('input', filterTables);
    }
    if (relationFilter) {
        $(relationFilter).on('change', filterTables);
    }

    // =========================================================================
    // 3. PENCARIAN RIWAYAT BERKAS CADANGAN
    // =========================================================================
    const searchHistoryInput = document.getElementById('kt_filter_history_search');
    if (searchHistoryInput) {
        searchHistoryInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#kt_backup_history_tbody tr.backup-file-row');

            rows.forEach(row => {
                const fileName = (row.getAttribute('data-file-name') || '').toLowerCase();
                row.style.display = fileName.includes(query) ? '' : 'none';
            });
        });
    }

    // =========================================================================
    // 4. EKSEKUSI PROSES BACKUP (FULL, SELECTIVE, SINGLE TABLE)
    // =========================================================================
    const executeBackup = (type, tables = [], buttonEl = null) => {
        if (buttonEl) {
            buttonEl.setAttribute('data-kt-indicator', 'on');
            buttonEl.disabled = true;
        }

        fetch(routes.createBackup, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': routes.csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                type: type,
                tables: tables,
                compression: true
            })
        })
        .then(async response => {
            const data = await response.json();
            if (buttonEl) {
                buttonEl.removeAttribute('data-kt-indicator');
                buttonEl.disabled = false;
            }

            if (response.ok && data.success) {
                Swal.fire({
                    title: 'Backup Berhasil Dibuat!',
                    html: `<div class="text-start py-2">
                                <p class="mb-2 text-gray-800 fs-6">${data.message}</p>
                                <div class="bg-light p-3 rounded fs-8 text-muted font-monospace">
                                    Berkas: <strong>${data.backup?.file_name}</strong><br>
                                    Ukuran: <strong>${data.backup?.file_size}</strong><br>
                                    Jumlah Tabel: <strong>${data.backup?.tables_count}</strong>
                                </div>
                           </div>`,
                    icon: 'success',
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: '<i class="ki-duotone ki-file-down fs-5 me-1"><span class="path1"></span><span class="path2"></span></i> Unduh Berkas',
                    cancelButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-light'
                    }
                }).then((result) => {
                    if (result.isConfirmed && data.backup?.file_name) {
                        window.location.href = `${routes.downloadBackup}/${data.backup.file_name}`;
                    }
                });

                // Perbarui tabel riwayat dan overview secara realtime
                if (data.files) {
                    renderBackupHistoryRows(data.files);
                }
                if (data.overview) {
                    updateOverviewStats(data.overview);
                }
            } else {
                Swal.fire({
                    title: 'Gagal Membuat Backup',
                    text: data.message || 'Terjadi kesalahan saat memproses cadangan database.',
                    icon: 'error',
                    buttonsStyling: false,
                    confirmButtonText: 'Tutup',
                    customClass: { confirmButton: 'btn btn-primary' }
                });
            }
        })
        .catch(err => {
            if (buttonEl) {
                buttonEl.removeAttribute('data-kt-indicator');
                buttonEl.disabled = false;
            }
            Swal.fire({
                title: 'Kesalahan Jaringan',
                text: 'Gagal menghubungi server: ' + err.message,
                icon: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Tutup',
                customClass: { confirmButton: 'btn btn-primary' }
            });
        });
    };

    // Tombol Backup Seluruh DB
    const btnBackupFull = document.getElementById('kt_btn_backup_full');
    if (btnBackupFull) {
        btnBackupFull.addEventListener('click', function () {
            Swal.fire({
                title: 'Cadangkan Seluruh Database?',
                text: 'Sistem akan mengekspor seluruh skema dan baris data dari semua tabel.',
                icon: 'question',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: 'Ya, Jalankan Full Backup',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light'
                }
            }).then(result => {
                if (result.isConfirmed) {
                    executeBackup('full', [], btnBackupFull);
                }
            });
        });
    }

    // Tombol Backup Terpilih (Selective)
    if (btnBackupSelected) {
        btnBackupSelected.addEventListener('click', function () {
            const checked = document.querySelectorAll('.table-checkbox:checked');
            const selectedTables = Array.from(checked).map(cb => cb.value);

            if (selectedTables.length === 0) {
                Swal.fire({
                    text: 'Silakan pilih minimal satu tabel untuk dicadangkan.',
                    icon: 'warning',
                    buttonsStyling: false,
                    confirmButtonText: 'OK',
                    customClass: { confirmButton: 'btn btn-primary' }
                });
                return;
            }

            Swal.fire({
                title: 'Cadangkan Tabel Terpilih?',
                html: `Anda akan mencadangkan <strong>${selectedTables.length} tabel</strong> terpilih ke dalam berkas cadangan terkompresi.`,
                icon: 'question',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: 'Ya, Cadangkan Terpilih',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light'
                }
            }).then(result => {
                if (result.isConfirmed) {
                    executeBackup('selective', selectedTables, btnBackupSelected);
                }
            });
        });
    }

    // Tombol Cepat Backup 1 Tabel
    document.addEventListener('click', function (e) {
        const btnSingle = e.target.closest('.btn-single-backup');
        if (btnSingle) {
            const tableName = btnSingle.getAttribute('data-table');
            if (tableName) {
                Swal.fire({
                    title: `Backup Tabel \`${tableName}\`?`,
                    text: `Buat cadangan cepat khusus untuk struktur dan data tabel \`${tableName}\`.`,
                    icon: 'question',
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: 'Ya, Buat Cadangan',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-light'
                    }
                }).then(result => {
                    if (result.isConfirmed) {
                        executeBackup('selective', [tableName], btnSingle);
                    }
                });
            }
        }
    });

    // =========================================================================
    // 5. RESTORE & HAPUS BERKAS CADANGAN
    // =========================================================================
    // Hapus Berkas
    document.addEventListener('click', function (e) {
        const btnDelete = e.target.closest('.btn-delete-backup');
        if (btnDelete) {
            const fileName = btnDelete.getAttribute('data-file');
            if (!fileName) return;

            Swal.fire({
                title: 'Hapus Berkas Cadangan?',
                html: `Berkas <strong class="text-danger">${fileName}</strong> akan dihapus permanen dari penyimpanan server.`,
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
                    btnDelete.setAttribute('data-kt-indicator', 'on');
                    btnDelete.disabled = true;

                    fetch(routes.deleteBackup, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': routes.csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ file_name: fileName })
                    })
                    .then(async response => {
                        const data = await response.json();
                        btnDelete.removeAttribute('data-kt-indicator');
                        btnDelete.disabled = false;

                        if (response.ok && data.success) {
                            Swal.fire({
                                text: data.message,
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'OK',
                                customClass: { confirmButton: 'btn btn-primary' }
                            });

                            if (data.files) {
                                renderBackupHistoryRows(data.files);
                            }
                            if (data.overview) {
                                updateOverviewStats(data.overview);
                            }
                        } else {
                            Swal.fire({
                                title: 'Gagal Menghapus',
                                text: data.message || 'Terjadi kesalahan saat menghapus berkas.',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Tutup',
                                customClass: { confirmButton: 'btn btn-primary' }
                            });
                        }
                    })
                    .catch(err => {
                        btnDelete.removeAttribute('data-kt-indicator');
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

    // Restore Database
    document.addEventListener('click', function (e) {
        const btnRestore = e.target.closest('.btn-restore-backup');
        if (btnRestore) {
            const fileName = btnRestore.getAttribute('data-file');
            if (!fileName) return;

            Swal.fire({
                title: 'PERINGATAN PEMULIHAN (RESTORE)!',
                html: `<div class="text-start py-2">
                            <p class="text-danger fw-bold mb-2">Perhatian: Proses restore akan menimpa data yang ada di database saat ini dengan data dari berkas cadangan!</p>
                            <div class="bg-light-warning p-3 rounded fs-7 text-gray-800 border border-warning border-dashed">
                                Berkas: <strong>${fileName}</strong><br>
                                Pastikan Anda telah membuat cadangan terbaru sebelum melanjutkan.
                            </div>
                       </div>`,
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: 'Ya, Pulihkan Database Sekarang',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                }
            }).then(result => {
                if (result.isConfirmed) {
                    btnRestore.setAttribute('data-kt-indicator', 'on');
                    btnRestore.disabled = true;

                    // Tampilkan modal loading proses
                    Swal.fire({
                        title: 'Memulihkan Database...',
                        text: 'Mohon tunggu, sistem sedang mengeksekusi dump SQL ke dalam database.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch(routes.restoreBackup, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': routes.csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ file_name: fileName })
                    })
                    .then(async response => {
                        const data = await response.json();
                        btnRestore.removeAttribute('data-kt-indicator');
                        btnRestore.disabled = false;

                        if (response.ok && data.success) {
                            Swal.fire({
                                title: 'Pemulihan Selesai!',
                                text: data.message,
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'OK',
                                customClass: { confirmButton: 'btn btn-primary' }
                            });

                            if (data.overview) {
                                updateOverviewStats(data.overview);
                            }
                        } else {
                            Swal.fire({
                                title: 'Gagal Memulihkan Database',
                                text: data.message || 'Terjadi kesalahan saat memulihkan database.',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Tutup',
                                customClass: { confirmButton: 'btn btn-primary' }
                            });
                        }
                    })
                    .catch(err => {
                        btnRestore.removeAttribute('data-kt-indicator');
                        btnRestore.disabled = false;
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

    // =========================================================================
    // 6. FORM PENGATURAN BACKUP OTOMATIS
    // =========================================================================
    const scopeRadios = document.querySelectorAll('input[name="backup_type"]');
    const selectiveWrapper = document.getElementById('kt_selective_tables_wrapper');

    scopeRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (selectiveWrapper) {
                if (this.value === 'selective') {
                    selectiveWrapper.classList.remove('d-none');
                } else {
                    selectiveWrapper.classList.add('d-none');
                }
            }
        });
    });

    const formSettings = document.getElementById('kt_form_auto_backup_settings');
    const btnSaveSettings = document.getElementById('kt_btn_save_backup_settings');

    if (formSettings) {
        formSettings.addEventListener('submit', function (e) {
            e.preventDefault();

            if (btnSaveSettings) {
                btnSaveSettings.setAttribute('data-kt-indicator', 'on');
                btnSaveSettings.disabled = true;
            }

            const formData = new FormData(formSettings);

            fetch(formSettings.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (btnSaveSettings) {
                    btnSaveSettings.removeAttribute('data-kt-indicator');
                    btnSaveSettings.disabled = false;
                }

                if (response.ok && data.success) {
                    Swal.fire({
                        text: data.message || 'Pengaturan backup otomatis berhasil disimpan.',
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });
                } else {
                    let errMsg = data.message || 'Terjadi kesalahan saat menyimpan pengaturan.';
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
                if (btnSaveSettings) {
                    btnSaveSettings.removeAttribute('data-kt-indicator');
                    btnSaveSettings.disabled = false;
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

    // Tombol Uji Coba Backup Otomatis
    const btnTestAuto = document.getElementById('kt_btn_test_auto_backup');
    if (btnTestAuto) {
        btnTestAuto.addEventListener('click', function () {
            btnTestAuto.setAttribute('data-kt-indicator', 'on');
            btnTestAuto.disabled = true;

            fetch(routes.testAuto, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': routes.csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(async response => {
                const data = await response.json();
                btnTestAuto.removeAttribute('data-kt-indicator');
                btnTestAuto.disabled = false;

                if (response.ok && data.success) {
                    Swal.fire({
                        title: 'Uji Coba Berhasil!',
                        text: data.message,
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });

                    if (data.files) {
                        renderBackupHistoryRows(data.files);
                    }
                    if (data.overview) {
                        updateOverviewStats(data.overview);
                    }
                } else {
                    Swal.fire({
                        title: 'Uji Coba Gagal',
                        text: data.message || 'Gagal menjalankan otomatisasi backup.',
                        icon: 'warning',
                        buttonsStyling: false,
                        confirmButtonText: 'Tutup',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });
                }
            })
            .catch(err => {
                btnTestAuto.removeAttribute('data-kt-indicator');
                btnTestAuto.disabled = false;
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

    // Tombol Segarkan Data
    const btnRefresh = document.getElementById('kt_btn_refresh_tables');
    if (btnRefresh) {
        btnRefresh.addEventListener('click', function () {
            btnRefresh.setAttribute('data-kt-indicator', 'on');
            btnRefresh.disabled = true;

            fetch(routes.tables, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(async response => {
                const data = await response.json();
                btnRefresh.removeAttribute('data-kt-indicator');
                btnRefresh.disabled = false;

                if (response.ok && data.success) {
                    if (data.overview) {
                        updateOverviewStats(data.overview);
                    }
                    toastr.success('Data skema dan relasi berhasil dimuat ulang.');
                }
            })
            .catch(() => {
                btnRefresh.removeAttribute('data-kt-indicator');
                btnRefresh.disabled = false;
            });
        });
    }

    // =========================================================================
    // 7. MODAL DETAIL RELASI & SKEMA TABEL
    // =========================================================================
    const modalRelationEl = document.getElementById('kt_modal_table_relation_detail');
    const modalRelation = modalRelationEl ? new bootstrap.Modal(modalRelationEl) : null;

    document.addEventListener('click', function (e) {
        const btnDetail = e.target.closest('.btn-table-detail');
        if (btnDetail) {
            const tableName = btnDetail.getAttribute('data-table');
            if (tableName && modalRelation) {
                openTableDetailModal(tableName);
            }
        }
    });

    const openTableDetailModal = (tableName) => {
        document.getElementById('modal_table_title').textContent = `Tabel: \`${tableName}\``;
        document.getElementById('modal_table_subtitle').textContent = 'Memuat relasi foreign keys dan struktur kolom...';

        // Reset tab aktif ke tab pertama (Struktur & Relasi)
        const firstTabLink = document.querySelector('#kt_modal_table_relation_detail .nav-line-tabs .nav-link:first-child');
        if (firstTabLink) {
            const tabInstance = bootstrap.Tab.getOrCreateInstance(firstTabLink);
            tabInstance.show();
        }

        document.getElementById('modal_table_columns_tbody').innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-6 text-muted">
                    <span class="spinner-border spinner-border-sm align-middle me-2"></span> Memuat struktur kolom...
                </td>
            </tr>
        `;

        modalRelation.show();

        fetch(`${routes.tableDetail}/${tableName}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(async response => {
            const res = await response.json();
            if (response.ok && res.success && res.data) {
                const data = res.data;
                document.getElementById('modal_table_subtitle').textContent = `Engine ${data.engine} | ${data.size_formatted} | ${data.rows} Baris Rekaman`;

                document.getElementById('modal_meta_engine').textContent = data.engine;
                document.getElementById('modal_meta_rows').textContent = Number(data.rows).toLocaleString();
                document.getElementById('modal_meta_size').textContent = data.size_formatted;
                document.getElementById('modal_meta_collation').textContent = data.collation || '-';

                // Render Outgoing Relations (Parent)
                const outgoingList = document.getElementById('modal_outgoing_relations_list');
                if (data.outgoing_relations && data.outgoing_relations.length > 0) {
                    outgoingList.innerHTML = data.outgoing_relations.map(out => `
                        <div class="d-flex align-items-center justify-content-between p-2 bg-white rounded border border-gray-200 fs-8">
                            <div>
                                <span class="fw-bold text-gray-900">${out.column}</span>
                                <span class="text-muted mx-1">&rarr;</span>
                                <span class="badge badge-light-primary fw-bolder">${out.target_table}.${out.target_column}</span>
                            </div>
                            <span class="text-muted fs-9">${out.constraint}</span>
                        </div>
                    `).join('');
                } else {
                    outgoingList.innerHTML = '<span class="text-muted fs-8 fst-italic">Tabel ini tidak memiliki foreign key yang merujuk ke tabel lain.</span>';
                }

                // Render Incoming Relations (Child)
                const incomingList = document.getElementById('modal_incoming_relations_list');
                if (data.incoming_relations && data.incoming_relations.length > 0) {
                    incomingList.innerHTML = data.incoming_relations.map(inc => `
                        <div class="d-flex align-items-center justify-content-between p-2 bg-white rounded border border-gray-200 fs-8">
                            <div>
                                <span class="badge badge-light-success fw-bolder">${inc.source_table}.${inc.source_column}</span>
                                <span class="text-muted mx-1">&rarr;</span>
                                <span class="fw-bold text-gray-900">${inc.target_column}</span>
                            </div>
                            <span class="text-muted fs-9">${inc.constraint}</span>
                        </div>
                    `).join('');
                } else {
                    incomingList.innerHTML = '<span class="text-muted fs-8 fst-italic">Tidak ada tabel lain yang merujuk ke tabel ini.</span>';
                }

                // Render Columns
                const tbody = document.getElementById('modal_table_columns_tbody');
                if (data.columns && data.columns.length > 0) {
                    tbody.innerHTML = data.columns.map(col => {
                        const isPrimary = (col.key === 'PRI');
                        const isForeign = (col.key === 'MUL');
                        const keyBadge = isPrimary 
                            ? '<span class="badge badge-light-danger fw-bolder fs-9">PK</span>' 
                            : (isForeign ? '<span class="badge badge-light-primary fw-bolder fs-9">FK / MUL</span>' : '<span class="text-muted">-</span>');

                        return `
                            <tr>
                                <td class="ps-3 fw-bold text-gray-900">
                                    ${col.field}
                                    ${isPrimary ? '<i class="ki-duotone ki-key text-warning fs-7 ms-1"><span class="path1"></span><span class="path2"></span></i>' : ''}
                                </td>
                                <td><span class="font-monospace text-gray-700">${col.type}</span></td>
                                <td class="text-center">${col.null === 'YES' ? '<span class="badge badge-light-warning fs-9">YES</span>' : '<span class="badge badge-light fs-9 text-muted">NO</span>'}</td>
                                <td class="text-center">${keyBadge}</td>
                                <td><span class="text-muted">${col.default !== null ? col.default : '<em>NULL</em>'}</span></td>
                                <td class="pe-3 text-muted">${col.extra || col.comment || '-'}</td>
                            </tr>
                        `;
                    }).join('');
                } else {
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">Struktur kolom tidak tersedia.</td></tr>';
                }

                // Render Data Rows Preview
                const badgeRows = document.getElementById('modal_badge_rows_count');
                const theadPreview = document.getElementById('modal_data_preview_thead');
                const tbodyPreview = document.getElementById('modal_data_preview_tbody');
                const dataPreview = data.data_preview || [];
                const totalRecords = data.total_records !== undefined ? data.total_records : data.rows;

                if (badgeRows) {
                    badgeRows.textContent = Number(totalRecords).toLocaleString();
                }

                const rowsNote = document.getElementById('modal_data_rows_note');
                if (rowsNote) {
                    rowsNote.textContent = `Menampilkan ${dataPreview.length} baris sampel (dari total ${Number(totalRecords).toLocaleString()} rekaman).`;
                }

                if (dataPreview.length > 0) {
                    const sampleCols = Object.keys(dataPreview[0]);

                    if (theadPreview) {
                        theadPreview.innerHTML = `
                            <th class="w-40px text-center ps-3">#</th>
                            ${sampleCols.map(c => `<th class="min-w-120px">${c}</th>`).join('')}
                        `;
                    }

                    if (tbodyPreview) {
                        tbodyPreview.innerHTML = dataPreview.map((row, idx) => `
                            <tr>
                                <td class="text-center text-muted ps-3 fw-bold">${idx + 1}</td>
                                ${sampleCols.map(c => {
                                    let val = row[c];
                                    if (val === null) {
                                        return '<td><span class="badge badge-light-secondary fs-9 text-muted">NULL</span></td>';
                                    }
                                    if (typeof val === 'object') {
                                        val = JSON.stringify(val);
                                    }
                                    const strVal = String(val);
                                    const isLong = strVal.length > 45;
                                    const displayVal = isLong ? strVal.substring(0, 42) + '...' : strVal;
                                    return `<td><span class="font-monospace text-gray-800" title="${isLong ? strVal.replace(/"/g, '&quot;') : ''}">${displayVal}</span></td>`;
                                }).join('')}
                            </tr>
                        `).join('');
                    }
                } else {
                    if (theadPreview) {
                        theadPreview.innerHTML = '<th>Informasi</th>';
                    }
                    if (tbodyPreview) {
                        tbodyPreview.innerHTML = `
                            <tr>
                                <td class="text-center py-8 text-muted">
                                    <div class="fs-7 fw-semibold text-gray-600 mb-1">Tabel ini belum memiliki rekaman data baris.</div>
                                    <span class="fs-9 text-muted">Jumlah data baris saat ini adalah 0.</span>
                                </td>
                            </tr>
                        `;
                    }
                }
            }
        })
        .catch(err => {
            document.getElementById('modal_table_columns_tbody').innerHTML = `
                <tr><td colspan="6" class="text-center py-4 text-danger">Gagal memuat skema kolom: ${err.message}</td></tr>
            `;
            const tbodyPreview = document.getElementById('modal_data_preview_tbody');
            if (tbodyPreview) {
                tbodyPreview.innerHTML = `<tr><td class="text-center py-4 text-danger">Gagal memuat baris data: ${err.message}</td></tr>`;
            }
        });
    };

    // =========================================================================
    // 8. HELPER REALTIME DOM UPDATERS
    // =========================================================================
    const updateOverviewStats = (overview) => {
        if (!overview) return;
        const totalTablesEl = document.getElementById('stat_total_tables');
        const totalRowsEl = document.getElementById('stat_total_rows');
        const totalRelationsEl = document.getElementById('stat_total_relations');
        const totalSizeEl = document.getElementById('stat_total_size');

        if (totalTablesEl && overview.total_tables !== undefined) {
            totalTablesEl.textContent = overview.total_tables;
        }
        if (totalRowsEl && overview.total_rows !== undefined) {
            totalRowsEl.textContent = Number(overview.total_rows).toLocaleString();
        }
        if (totalRelationsEl && overview.total_relations !== undefined) {
            totalRelationsEl.textContent = overview.total_relations;
        }
        if (totalSizeEl && overview.total_size_mb !== undefined) {
            totalSizeEl.textContent = overview.total_size_mb;
        }
    };

    const renderBackupHistoryRows = (files) => {
        const tbody = document.getElementById('kt_backup_history_tbody');
        const badgeFilesCount = document.getElementById('badge_backup_files_count');

        if (badgeFilesCount) {
            badgeFilesCount.textContent = files ? files.length : 0;
        }

        if (!tbody) return;

        if (!files || files.length === 0) {
            tbody.innerHTML = `
                <tr id="empty_backup_history_row">
                    <td colspan="5" class="text-center py-10 text-muted">
                        <div class="fs-6 fw-semibold text-gray-600 mb-1">Belum ada berkas cadangan di penyimpanan.</div>
                        <span class="fs-8 text-muted">Gunakan tombol "Backup Seluruh DB" atau "Backup Terpilih" untuk membuat cadangan pertama.</span>
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = files.map(file => `
            <tr class="backup-file-row" data-file-name="${file.name}">
                <td class="ps-4">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <span class="text-gray-900 fw-bold fs-6 font-monospace">${file.name}</span>
                            <span class="text-muted fs-8">
                                Format: ${file.is_compressed ? 'GZIP Compressed SQL (.sql.gz)' : 'Plain SQL (.sql)'}
                            </span>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <span class="badge ${file.type_badge} fw-bolder fs-8 px-3 py-1">
                        ${file.type} Backup
                    </span>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-gray-900 fw-bold fs-7">${file.executor_name || 'Super Admin'}</span>
                                <span class="badge ${file.role_badge_class || 'badge-light-primary'} fs-9 fw-bolder px-2 py-0.5">
                                    ${file.executor_role || 'Master'}
                                </span>
                            </div>
                            ${file.executor_email ? `<span class="text-muted fs-8">${file.executor_email}</span>` : ''}
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <span class="badge badge-light fw-bold fs-7 text-gray-900">${file.size_formatted}</span>
                </td>
                <td>
                    <div class="text-gray-900 fw-bold fs-7">${file.created_at_formatted}</div>
                    <span class="text-muted fs-8">${file.created_at_diff}</span>
                </td>
                <td class="text-end pe-4">
                    <div class="d-flex align-items-center justify-content-end gap-2">
                        <a href="${routes.downloadBackup}/${file.name}" class="btn btn-icon btn-light-success btn-sm"
                            data-bs-toggle="tooltip" title="Unduh Berkas SQL">
                            <i class="ki-duotone ki-file-down fs-5"><span class="path1"></span><span class="path2"></span></i>
                        </a>

                        <button type="button" class="btn btn-icon btn-light-warning btn-sm btn-restore-backup"
                            data-file="${file.name}"
                            data-bs-toggle="tooltip" title="Pulihkan / Restore Database">
                            <i class="ki-duotone ki-arrows-circle fs-5"><span class="path1"></span><span class="path2"></span></i>
                        </button>

                        <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-delete-backup"
                            data-file="${file.name}"
                            data-bs-toggle="tooltip" title="Hapus Berkas Cadangan">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        initTooltips();
    };
});
