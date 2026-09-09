/**
 * Manajemen Pengguna (Users) JavaScript Module with Avatar & Yajra DataTables
 * Path: public/assets/js/manajemenpengguna/users.js
 */

document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const routes = window.USER_MANAGEMENT_ROUTES || {
        datatable: '/manajemenpengguna/users',
        store: '/manajemenpengguna/users',
        base: '/manajemenpengguna/users'
    };

    // DOM Elements
    const tableEl = document.getElementById('kt_table_users');
    const modalFormEl = document.getElementById('kt_modal_user_form');
    const modalDetailEl = document.getElementById('kt_modal_user_detail');
    const formEl = document.getElementById('kt_modal_user_form_element');
    const submitBtn = document.getElementById('kt_modal_user_form_submit');
    const modalTitleEl = document.getElementById('user_modal_title');
    const formMethodEl = document.getElementById('user_form_method');
    const formIdEl = document.getElementById('user_form_id');
    const inputName = document.getElementById('user_form_name');
    const inputEmail = document.getElementById('user_form_email');
    const inputRole = document.getElementById('user_form_role');
    const inputPassword = document.getElementById('user_form_password');
    const passwordRequiredEl = document.getElementById('user_password_required');
    const passwordHelpEl = document.getElementById('user_password_help');

    // Avatar DOM Elements
    const avatarWrapper = document.getElementById('user_avatar_wrapper');
    const avatarInput = document.getElementById('user_form_avatar');
    const removeAvatarInput = document.getElementById('user_form_remove_avatar');
    const defaultAvatarUrl = avatarWrapper ? avatarWrapper.style.backgroundImage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '') : '';

    // Filter Elements
    const searchInput = document.getElementById('kt_filter_search');
    const roleFilter = document.getElementById('kt_filter_role');
    const resetFilterBtn = document.getElementById('kt_filter_reset');
    const refreshBtn = document.getElementById('btn_refresh_datatable');

    let modalForm = null;
    let modalDetail = null;
    let dataTable = null;

    if (modalFormEl && typeof bootstrap !== 'undefined') {
        modalForm = new bootstrap.Modal(modalFormEl);
    }
    if (modalDetailEl && typeof bootstrap !== 'undefined') {
        modalDetail = new bootstrap.Modal(modalDetailEl);
    }

    // Set Avatar Preview in Form Modal
    function setAvatarPreview(url) {
        if (!avatarWrapper) return;
        if (url) {
            avatarWrapper.style.backgroundImage = `url('${url}')`;
        } else {
            avatarWrapper.style.backgroundImage = defaultAvatarUrl ? `url('${defaultAvatarUrl}')` : '';
        }
    }

    // Update Top Right Header Avatar & Dropdown in Real-time
    function updateLiveHeaderUser(user) {
        if (!user) return;
        const avatarUrl = user.avatar_url || (user.avatar ? `/storage/${user.avatar}` : null);
        const name = user.name || '';
        const initial = (name || 'U').charAt(0).toUpperCase();
        const email = user.email || '';
        const timestampedUrl = avatarUrl ? (avatarUrl.includes('?') ? `${avatarUrl}&_t=${Date.now()}` : `${avatarUrl}?_t=${Date.now()}`) : null;

        // 1. Update Navbar Icon Kanan Atas
        document.querySelectorAll('.header-user-avatar-img').forEach(img => {
            if (timestampedUrl) {
                img.src = timestampedUrl;
                img.classList.remove('d-none');
            } else {
                img.src = '';
                img.classList.add('d-none');
            }
        });

        document.querySelectorAll('.header-user-avatar-initial').forEach(el => {
            el.textContent = initial;
            if (timestampedUrl) {
                el.classList.add('d-none');
            } else {
                el.classList.remove('d-none');
            }
        });

        // 2. Update Dropdown Menu Profil
        const dropdownAvatarImg = document.getElementById('header_dropdown_avatar_img');
        const dropdownAvatarInitial = document.getElementById('header_dropdown_avatar_initial');
        const dropdownUserName = document.getElementById('header_dropdown_user_name');
        const dropdownUserEmail = document.getElementById('header_dropdown_user_email');

        if (dropdownAvatarImg) {
            if (timestampedUrl) {
                dropdownAvatarImg.src = timestampedUrl;
                dropdownAvatarImg.classList.remove('d-none');
            } else {
                dropdownAvatarImg.src = '';
                dropdownAvatarImg.classList.add('d-none');
            }
        }

        if (dropdownAvatarInitial) {
            dropdownAvatarInitial.textContent = initial;
            if (timestampedUrl) {
                dropdownAvatarInitial.classList.add('d-none');
            } else {
                dropdownAvatarInitial.classList.remove('d-none');
            }
        }

        if (dropdownUserName && name) {
            dropdownUserName.textContent = name;
        }
        if (dropdownUserEmail && email) {
            dropdownUserEmail.textContent = email;
        }
    }

    // Initialize Tooltips safely
    function initTooltips() {
        document.querySelectorAll('.tooltip').forEach(el => el.remove());

        const tooltipElements = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipElements.forEach(function (el) {
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                const existing = bootstrap.Tooltip.getInstance(el);
                if (existing) {
                    existing.dispose();
                }
                new bootstrap.Tooltip(el, {
                    trigger: 'hover'
                });
            }
        });
    }

    // Hilangkan tooltip seketika saat tombol diklik
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-bs-toggle="tooltip"]');
        if (btn) {
            btn.blur();
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                const instance = bootstrap.Tooltip.getInstance(btn);
                if (instance) {
                    instance.hide();
                }
            }
            document.querySelectorAll('.tooltip').forEach(el => el.remove());
        }
    });

    // Clear Validation Errors
    function clearErrors() {
        if (!formEl) return;
        formEl.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        formEl.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
    }

    // Render Validation Errors
    function showErrors(errors) {
        clearErrors();
        for (const [key, messages] of Object.entries(errors)) {
            const field = document.getElementById('user_form_' + key);
            const feedback = document.getElementById('error_' + key);
            if (field) {
                field.classList.add('is-invalid');
            }
            if (feedback) {
                feedback.textContent = Array.isArray(messages) ? messages[0] : messages;
            }
        }
    }

    // 1. Initialize Yajra DataTable
    if (tableEl && typeof $ !== 'undefined' && $.fn.DataTable) {
        dataTable = $(tableEl).DataTable({
            processing: true,
            serverSide: true,
            order: [[4, 'desc']],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: routes.datatable,
                type: 'GET',
                data: function (d) {
                    d.role = roleFilter ? roleFilter.value : '';
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'w-10px pe-2'
                },
                {
                    data: 'user_info',
                    name: 'user_info',
                    render: function (data, type, row) {
                        if (!data) return row.name || '-';
                        
                        let avatarHtml = '';
                        if (data.avatar) {
                            avatarHtml = `
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3 flex-shrink-0">
                                    <div class="symbol-label">
                                        <img src="${data.avatar}" alt="${data.name}" class="w-100 h-100 object-fit-cover" />
                                    </div>
                                </div>
                            `;
                        } else {
                            avatarHtml = `
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3 flex-shrink-0">
                                    <div class="symbol-label fs-5 fw-bold bg-light-primary text-primary">
                                        ${data.initial || 'U'}
                                    </div>
                                </div>
                            `;
                        }

                        return `
                            <div class="d-flex align-items-center">
                                ${avatarHtml}
                                <div class="d-flex flex-column">
                                    <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">${data.name}</span>
                                    <span class="text-muted fs-7">${data.email}</span>
                                </div>
                            </div>
                        `;
                    }
                },
                {
                    data: 'role_badge',
                    name: 'role_badge',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'email_status',
                    name: 'email_status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'joined_at',
                    name: 'created_at'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    className: 'text-end'
                }
            ],
            language: {
                zeroRecords: '<div class="text-center py-6 text-gray-500 fw-semibold fs-6">Tidak ada data ditemukan.</div>',
                info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                infoEmpty: 'Menampilkan 0 data',
                infoFiltered: '(disaring dari _MAX_ total data)',
                lengthMenu: 'Tampilkan _MENU_ data',
                loadingRecords: 'Memuat data...',
                processing: '<span class="spinner-border spinner-border-sm align-middle me-2"></span> Memuat data...',
                paginate: {
                    first: 'Awal',
                    last: 'Akhir',
                    next: '<i class="next"></i>',
                    previous: '<i class="previous"></i>'
                }
            },
            drawCallback: function () {
                initTooltips();
            }
        });

        // Search Input (with debounce)
        let searchTimeout;
        if (searchInput) {
            searchInput.addEventListener('keyup', function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    dataTable.search(this.value).draw();
                }, 400);
            });
        }

        // Role Filter Dropdown
        if (roleFilter) {
            $(roleFilter).on('change', function () {
                dataTable.draw();
            });
        }

        // Reset Filter Button
        if (resetFilterBtn) {
            resetFilterBtn.addEventListener('click', function () {
                if (searchInput) searchInput.value = '';
                if (roleFilter) {
                    roleFilter.value = '';
                    if ($(roleFilter).data('select2')) {
                        $(roleFilter).val('').trigger('change.select2');
                    }
                }
                dataTable.search('').draw();
            });
        }

        // Refresh Button
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function () {
                dataTable.ajax.reload(null, false);
                Notify.info('Data tabel telah disegarkan.');
            });
        }
    }

    // 2. Tombol Tambah Pengguna
    const btnAddUser = document.getElementById('btn_open_add_user');
    if (btnAddUser) {
        btnAddUser.addEventListener('click', function () {
            clearErrors();
            formEl.reset();
            modalTitleEl.textContent = 'Tambah Pengguna Baru';
            formMethodEl.value = 'POST';
            formIdEl.value = '';
            formEl.action = routes.store;

            setAvatarPreview(null);
            if (removeAvatarInput) removeAvatarInput.value = '0';
            if (avatarInput) avatarInput.value = '';

            inputPassword.setAttribute('required', 'required');
            if (passwordRequiredEl) passwordRequiredEl.classList.add('required');
            if (passwordHelpEl) passwordHelpEl.textContent = 'Gunakan kombinasi huruf dan angka minimal 8 karakter.';

            if (modalForm) modalForm.show();
        });
    }

    // 3. Tombol Edit Pengguna (Event Delegation)
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.btn-edit-user');
        if (!btn) return;

        const userId = btn.getAttribute('data-id');
        clearErrors();
        formEl.reset();

        modalTitleEl.textContent = 'Ubah Data Pengguna';
        formMethodEl.value = 'PUT';
        formIdEl.value = userId;
        formEl.action = `${routes.base}/${userId}`;

        if (removeAvatarInput) removeAvatarInput.value = '0';
        if (avatarInput) avatarInput.value = '';

        inputPassword.removeAttribute('required');
        if (passwordRequiredEl) passwordRequiredEl.classList.remove('required');
        if (passwordHelpEl) passwordHelpEl.textContent = 'Biarkan kosong jika tidak ingin mengganti kata sandi.';

        try {
            const response = await fetch(`${routes.base}/${userId}/edit`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const result = await response.json();

            if (result.status === 'success') {
                const data = result.data;
                inputName.value = data.name || '';
                inputEmail.value = data.email || '';
                inputRole.value = data.role || '';
                setAvatarPreview(data.avatar || null);

                if (modalForm) modalForm.show();
            } else {
                Notify.error('Gagal mengambil data pengguna.');
            }
        } catch (err) {
            Notify.error('Terjadi kesalahan saat memuat data pengguna.');
        }
    });

    // 4. Form Submission (AJAX dengan FormData Multipart untuk Upload Berkas)
    if (formEl) {
        formEl.addEventListener('submit', async function (e) {
            e.preventDefault();
            clearErrors();

            submitBtn.setAttribute('data-kt-indicator', 'on');
            submitBtn.disabled = true;

            const isEdit = formMethodEl.value === 'PUT';
            const formData = new FormData(formEl);
            if (isEdit) {
                formData.append('_method', 'PUT');
            }

            try {
                const response = await fetch(formEl.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    if (modalForm) modalForm.hide();
                    Notify.success(data.message || 'Data berhasil disimpan!', 'Sukses');

                    // Jika user yang diupdate adalah user yang sedang login, update avatar kanan atas secara realtime
                    const isAuthUser = Boolean(
                        data.data?.is_auth_user ||
                        (routes.auth_id && data.data?.id && String(data.data.id) === String(routes.auth_id))
                    );

                    if (isAuthUser && data.data) {
                        updateLiveHeaderUser(data.data);
                    }

                    if (dataTable) {
                        dataTable.ajax.reload(null, false);
                    }
                } else if (response.status === 422 && data.errors) {
                    showErrors(data.errors);
                    Notify.warning('Silakan periksa kembali input formulir Anda.', 'Validasi Gagal');
                } else {
                    Notify.error(data.message || 'Terjadi kesalahan sistem.');
                }
            } catch (error) {
                Notify.error('Gagal terhubung ke server.');
            } finally {
                submitBtn.removeAttribute('data-kt-indicator');
                submitBtn.disabled = false;
            }
        });
    }

    // 5. Tombol Lihat Detail Pengguna (Event Delegation)
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.btn-view-user');
        if (!btn) return;

        const userId = btn.getAttribute('data-id');

        try {
            const response = await fetch(`${routes.base}/${userId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const result = await response.json();

            if (result.status === 'success') {
                const data = result.data;
                const avatarImg = document.getElementById('detail_user_avatar_img');
                const symbolSpan = document.getElementById('detail_user_symbol');

                if (data.avatar) {
                    avatarImg.src = data.avatar;
                    avatarImg.classList.remove('d-none');
                    symbolSpan.classList.add('d-none');
                } else {
                    avatarImg.src = '';
                    avatarImg.classList.add('d-none');
                    symbolSpan.classList.remove('d-none');
                    symbolSpan.textContent = (data.name || 'U').charAt(0).toUpperCase();
                }

                document.getElementById('detail_user_name').textContent = data.name || '-';
                document.getElementById('detail_user_email').textContent = data.email || '-';
                document.getElementById('detail_user_id').textContent = '#' + data.id;
                document.getElementById('detail_user_role').textContent = (data.role || 'user').toUpperCase();

                const verifiedEl = document.getElementById('detail_user_verified');
                if (data.email_verified_at) {
                    verifiedEl.className = 'badge badge-light-success fw-bold fs-7';
                    verifiedEl.textContent = 'Terverifikasi (' + data.email_verified_at + ')';
                } else {
                    verifiedEl.className = 'badge badge-light-secondary fw-bold fs-7';
                    verifiedEl.textContent = 'Belum Diverifikasi';
                }

                document.getElementById('detail_user_created_at').textContent = data.created_at || '-';
                document.getElementById('detail_user_updated_at').textContent = data.updated_at || '-';

                if (modalDetail) modalDetail.show();
            } else {
                Notify.error('Gagal memuat detail pengguna.');
            }
        } catch (err) {
            Notify.error('Terjadi kesalahan saat memuat detail pengguna.');
        }
    });

    // 6. Tombol Reset Password (Event Delegation)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-reset-password');
        if (!btn) return;

        const userId = btn.getAttribute('data-id');
        const userName = btn.getAttribute('data-name');

        Notify.confirm({
            title: 'Atur Ulang Kata Sandi?',
            text: `Kata sandi akun "${userName}" akan diatur ulang ke kata sandi standar: "password123".`,
            icon: 'question',
            confirmButtonText: 'Ya, Atur Ulang Sandi!',
            cancelButtonText: 'Batal',
            onConfirm: async function () {
                try {
                    const response = await fetch(`${routes.base}/${userId}/reset-password`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ password: 'password123' })
                    });

                    const result = await response.json();
                    if (result.status === 'success') {
                        Notify.success(result.message, 'Berhasil Diatur Ulang');
                    } else {
                        Notify.error(result.message || 'Gagal mengatur ulang kata sandi.');
                    }
                } catch (err) {
                    Notify.error('Gagal memproses permintaan atur ulang kata sandi.');
                }
            }
        });
    });

    // 7. Tombol Hapus Pengguna (Event Delegation)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-delete-user');
        if (!btn) return;

        const userId = btn.getAttribute('data-id');
        const userName = btn.getAttribute('data-name');

        Notify.deleteConfirm({
            title: 'Hapus Pengguna?',
            text: `Pengguna "${userName}" akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan!`,
            confirmButtonText: 'Ya, Hapus Sekarang!',
            cancelButtonText: 'Batal',
            onConfirm: async function () {
                try {
                    const response = await fetch(`${routes.base}/${userId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ _method: 'DELETE' })
                    });

                    const result = await response.json();
                    if (response.ok && result.status === 'success') {
                        Notify.success(result.message, 'Berhasil Dihapus');
                        if (dataTable) {
                            dataTable.ajax.reload(null, false);
                        } else {
                            setTimeout(() => window.location.reload(), 600);
                        }
                    } else {
                        Notify.error(result.message || 'Gagal menghapus pengguna.');
                    }
                } catch (err) {
                    Notify.error('Gagal memproses penghapusan pengguna.');
                }
            }
        });
    });

});
