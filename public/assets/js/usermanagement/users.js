/**
 * User Management (Users) JavaScript Module
 * Path: public/assets/js/usermanagement/users.js
 */

document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const routes = window.USER_MANAGEMENT_ROUTES || {
        datatable: '/usermanagement/users',
        store: '/usermanagement/users',
        base: '/usermanagement/users',
        auth_id: ''
    };

    // DOM Elements - Table & Layout
    const tableEl = document.getElementById('kt_table_users');
    const cardsContainer = document.getElementById('users_card_container');
    const cardsPagination = document.getElementById('users_card_pagination');
    const totalCountEl = document.getElementById('users_total_count');
    const sortLabelEl = document.getElementById('users_sort_label');

    // DOM Elements - Filters
    const filterForm = document.getElementById('kt_users_filter_form');
    const filterSearch = document.getElementById('filter_search');
    const filterRole = document.getElementById('filter_role');
    const filterSort = document.getElementById('filter_sort');
    const btnResetFilter = document.getElementById('btn_reset_filter');
    const btnApplyFilter = document.getElementById('btn_apply_filter');

    // DOM Elements - Form Modal
    const modalFormEl = document.getElementById('kt_modal_user_form');
    const formEl = document.getElementById('kt_modal_user_form_element');
    const submitBtn = document.getElementById('kt_modal_user_form_submit');
    const modalTitleEl = document.getElementById('user_modal_title');
    const formMethodEl = document.getElementById('user_form_method');
    const formIdEl = document.getElementById('user_form_id');
    const inputName = document.getElementById('user_form_name');
    const inputEmail = document.getElementById('user_form_email');
    const inputRoles = document.getElementById('user_form_roles') || document.getElementById('user_form_role');
    const inputPassword = document.getElementById('user_form_password');
    const passwordRequiredEl = document.getElementById('user_password_required');
    const passwordHelpEl = document.getElementById('user_password_help');

    // Avatar Elements
    const avatarWrapper = document.getElementById('user_avatar_wrapper');
    const avatarInput = document.getElementById('user_form_avatar');
    const removeAvatarInput = document.getElementById('user_form_remove_avatar');
    const btnRemoveAvatar = document.getElementById('btn_remove_avatar_trigger');
    const defaultBlankAvatar = avatarWrapper ? avatarWrapper.style.backgroundImage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '') : '';

    // DOM Elements - Detail Modal
    const modalDetailEl = document.getElementById('kt_modal_user_detail');

    let modalForm = null;
    let modalDetail = null;
    let dataTable = null;

    if (modalFormEl && typeof bootstrap !== 'undefined') {
        modalForm = new bootstrap.Modal(modalFormEl);
    }
    if (modalDetailEl && typeof bootstrap !== 'undefined') {
        modalDetail = new bootstrap.Modal(modalDetailEl);
    }

    // Helper: Initialize Tooltips safely
    function initTooltips() {
        document.querySelectorAll('.tooltip').forEach(el => el.remove());
        const tooltipElements = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipElements.forEach(function (el) {
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                const existing = bootstrap.Tooltip.getInstance(el);
                if (existing) {
                    existing.dispose();
                }
                new bootstrap.Tooltip(el, { trigger: 'hover' });
            }
        });
    }

    // Helper: Set Avatar Preview
    function setAvatarPreview(url) {
        if (!avatarWrapper) return;
        if (url) {
            avatarWrapper.style.backgroundImage = `url('${url}')`;
            avatarWrapper.style.backgroundPosition = 'top center';
            avatarWrapper.style.backgroundSize = 'cover';
        } else {
            avatarWrapper.style.backgroundImage = defaultBlankAvatar ? `url('${defaultBlankAvatar}')` : '';
            avatarWrapper.style.backgroundPosition = 'center center';
            avatarWrapper.style.backgroundSize = 'cover';
        }
    }

    // Event: Handle Avatar Remove Click
    if (btnRemoveAvatar && removeAvatarInput) {
        btnRemoveAvatar.addEventListener('click', function () {
            removeAvatarInput.value = '1';
            if (avatarInput) avatarInput.value = '';
            setAvatarPreview(null);
        });
    }

    // Helper: Clear Form Validation Errors
    function clearErrors() {
        if (!formEl) return;
        formEl.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        formEl.querySelectorAll('.invalid-feedback').forEach(el => {
            el.textContent = '';
        });
    }

    // Helper: Render Form Validation Errors
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

    // Helper: Get Active Filter Params
    function getFilterParams() {
        const formData = new FormData(filterForm);
        const params = new URLSearchParams();
        for (const [key, value] of formData.entries()) {
            if (value !== '') {
                params.append(key, value);
            }
        }
        return params;
    }

    // Helper: Fetch Cards via AJAX (Zero-Reload)
    async function fetchCards(pageUrl = null) {
        const params = getFilterParams();
        let url = pageUrl || routes.datatable;
        if (!pageUrl) {
            url += '?' + params.toString();
        }

        if (cardsContainer) {
            cardsContainer.innerHTML = `
                <div class="col-12 text-center py-10">
                    <span class="spinner-border spinner-border-lg text-primary"></span>
                    <div class="text-muted fs-7 mt-2">Memuat daftar pengguna...</div>
                </div>
            `;
        }

        try {
            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-Fetch-Cards': 'true'
                }
            });
            const result = await res.json();

            if (result.status === 'success') {
                if (cardsContainer) {
                    cardsContainer.innerHTML = result.html;
                    // Re-initialize dropdown menus and tooltips in new cards
                    if (typeof KTMenu !== 'undefined') {
                        KTMenu.createInstances();
                    }
                    initTooltips();
                }
                if (cardsPagination) {
                    const paginationLinksContainer = cardsPagination.querySelector('.users-pagination-links');
                    if (paginationLinksContainer) {
                        paginationLinksContainer.innerHTML = result.pagination || '';
                    }
                    const totalText = document.getElementById('users_card_info') || cardsPagination.querySelector('.fs-6');
                    if (totalText && typeof result.total !== 'undefined') {
                        const firstItem = result.first_item || 0;
                        const lastItem = result.last_item || 0;
                        totalText.textContent = `${firstItem} - ${lastItem} / ${result.total} Pengguna`;
                    }
                }
                if (totalCountEl && typeof result.total !== 'undefined') {
                    totalCountEl.textContent = result.total;
                }
            }
        } catch (e) {
            if (cardsContainer) {
                cardsContainer.innerHTML = `
                    <div class="col-12 text-center py-8 text-danger">
                        Gagal memuat data kartu pengguna. Silakan coba lagi.
                    </div>
                `;
            }
        }
    }

    // 1. Initialize Yajra DataTables (Table View)
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
                    const params = getFilterParams();
                    d.search = params.get('search') || '';
                    d.role = params.get('role') || '';
                    d.status = params.get('status') || '';
                    d.sort = params.get('sort') || 'recent';
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
                            const posX = (data.avatar_position_x !== undefined && data.avatar_position_x !== null) ? data.avatar_position_x : 50;
                            const posY = (data.avatar_position_y !== undefined && data.avatar_position_y !== null) ? data.avatar_position_y : 0;
                            const zoom = (data.avatar_zoom !== undefined && data.avatar_zoom !== null) ? parseInt(data.avatar_zoom) : 100;
                            const bgSize = zoom !== 100 ? `${zoom}%` : 'cover';

                            avatarHtml = `
                                <div class="symbol symbol-45px me-3 flex-shrink-0">
                                    <div class="symbol-label shadow-sm" style="background-image: url('${data.avatar}'); background-position: ${posX}% ${posY}%; background-size: ${bgSize};"></div>
                                </div>
                            `;
                        } else {
                            avatarHtml = `
                                <div class="symbol symbol-45px me-3 flex-shrink-0">
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
                                    <a href="javascript:void(0)" class="text-gray-800 fw-bold text-hover-primary mb-0 fs-6 btn-view-user" data-id="${row.id}">
                                        ${data.name}
                                    </a>
                                    <span class="text-muted fs-7">${data.email}</span>
                                </div>
                            </div>
                        `;
                    }
                },
                {
                    data: 'role_badge',
                    name: 'role',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'email_status',
                    name: 'email_verified_at',
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
                    className: 'text-end pe-4'
                }
            ],
            language: {
                zeroRecords: '<div class="text-center py-6 text-gray-500 fw-semibold fs-6">Tidak ada data pengguna ditemukan.</div>',
                info: '_START_ - _END_ / _TOTAL_ Pengguna',
                infoEmpty: '0 Pengguna',
                infoFiltered: '(disaring dari _MAX_ total)',
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
    }

    // 2. Filter Form Submission (AJAX Zero-Reload)
    if (filterForm) {
        filterForm.addEventListener('submit', function (e) {
            e.preventDefault();

            if (btnApplyFilter) {
                btnApplyFilter.setAttribute('data-kt-indicator', 'on');
                btnApplyFilter.disabled = true;
            }

            // Update Sort Label
            if (sortLabelEl && filterSort) {
                const sortMap = {
                    'recent': '• Terbaru',
                    'oldest': '• Terlama',
                    'name_asc': '• Nama A-Z',
                    'name_desc': '• Nama Z-A'
                };
                sortLabelEl.textContent = sortMap[filterSort.value] || '• Terbaru';
            }

            // Reload DataTables
            if (dataTable) {
                dataTable.ajax.reload(null, false);
            }

            // Fetch Cards
            fetchCards().finally(() => {
                if (btnApplyFilter) {
                    btnApplyFilter.removeAttribute('data-kt-indicator');
                    btnApplyFilter.disabled = false;
                }
            });
        });
    }

    // 3. Reset Filter Button
    if (btnResetFilter) {
        btnResetFilter.addEventListener('click', function () {
            if (filterForm) {
                filterForm.reset();
                if (filterRole && $(filterRole).data('select2')) {
                    $(filterRole).val('').trigger('change.select2');
                }
                if (filterSort && $(filterSort).data('select2')) {
                    $(filterSort).val('recent').trigger('change.select2');
                }
            }
            if (filterForm) {
                filterForm.dispatchEvent(new Event('submit'));
            }
        });
    }

    // Realtime Search Debounce on Filter Input
    let searchDebounce;
    if (filterSearch) {
        filterSearch.addEventListener('input', function () {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                if (filterForm) {
                    filterForm.dispatchEvent(new Event('submit'));
                }
            }, 450);
        });
    }

    // 4. Card Pagination Click Event (Zero-Reload)
    document.addEventListener('click', function (e) {
        const link = e.target.closest('#users_card_pagination .page-link');
        if (!link) return;
        const href = link.getAttribute('href');
        if (href && href !== '#' && !href.startsWith('javascript')) {
            e.preventDefault();
            fetchCards(href);
        }
    });

    // 5. Open Add User Modal
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

            if (inputRoles && typeof $ !== 'undefined' && $(inputRoles).data('select2')) {
                $(inputRoles).val([]).trigger('change.select2');
            } else if (inputRoles) {
                inputRoles.value = '';
            }

            inputPassword.setAttribute('required', 'required');
            if (passwordRequiredEl) passwordRequiredEl.classList.add('required');
            if (passwordHelpEl) passwordHelpEl.textContent = 'Gunakan kombinasi huruf dan angka minimal 8 karakter.';

            if (modalForm) modalForm.show();
        });
    }

    // 6. Open Edit User Modal (Event Delegation)
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

                const rolesList = data.roles || (data.role ? [data.role] : []);
                if (inputRoles && typeof $ !== 'undefined' && $(inputRoles).data('select2')) {
                    $(inputRoles).val(rolesList).trigger('change.select2');
                } else if (inputRoles) {
                    inputRoles.value = rolesList.length > 0 ? rolesList[0] : '';
                }

                setAvatarPreview(data.avatar || null);

                if (modalForm) modalForm.show();
            } else {
                if (typeof Notify !== 'undefined') {
                    Notify.error('Gagal mengambil data pengguna.');
                }
            }
        } catch (err) {
            if (typeof Notify !== 'undefined') {
                Notify.error('Terjadi kesalahan saat memuat data pengguna.');
            }
        }
    });

    // 7. Form Submit (Add / Edit User) via AJAX
    if (formEl) {
        formEl.addEventListener('submit', async function (e) {
            e.preventDefault();
            clearErrors();

            if (submitBtn) {
                submitBtn.setAttribute('data-kt-indicator', 'on');
                submitBtn.disabled = true;
            }

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

                if (response.ok && (data.status === 'success' || data.success)) {
                    if (modalForm) modalForm.hide();

                    if (typeof Notify !== 'undefined') {
                        Notify.success(data.message || 'Data berhasil disimpan!', 'Sukses');
                    } else if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            text: data.message || 'Data berhasil disimpan!',
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'OK',
                            customClass: { confirmButton: 'btn btn-primary' }
                        });
                    }

                    // Refresh both Card View and Table View
                    if (dataTable) {
                        dataTable.ajax.reload(null, false);
                    }
                    fetchCards();
                } else if (response.status === 422 && data.errors) {
                    showErrors(data.errors);
                    if (typeof Notify !== 'undefined') {
                        Notify.warning('Silakan periksa kembali input formulir Anda.', 'Validasi Gagal');
                    }
                } else {
                    const msg = data.message || 'Terjadi kesalahan sistem.';
                    if (typeof Notify !== 'undefined') {
                        Notify.error(msg);
                    }
                }
            } catch (error) {
                if (typeof Notify !== 'undefined') {
                    Notify.error('Gagal terhubung ke server.');
                }
            } finally {
                if (submitBtn) {
                    submitBtn.removeAttribute('data-kt-indicator');
                    submitBtn.disabled = false;
                }
            }
        });
    }

    // 8. View Detail Modal (Event Delegation)
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

                // Handle Cover Background & Overlay
                const coverBgEl = document.getElementById('detail_user_cover_bg');
                const coverOverlayEl = document.getElementById('detail_user_cover_overlay');

                if (coverBgEl) {
                    const coverUrl = data.cover_bg_url || '/assets/img-temp/1200x800/img1.jpg';
                    const posY = (data.cover_position_y !== undefined && data.cover_position_y !== null) ? data.cover_position_y : 30;
                    const blur = (data.cover_blur !== undefined && data.cover_blur !== null) ? data.cover_blur : 0;
                    coverBgEl.style.backgroundImage = `url('${coverUrl}')`;
                    coverBgEl.style.backgroundPosition = `center ${posY}%`;
                    coverBgEl.style.filter = `blur(${blur}px)`;
                    coverBgEl.style.webkitFilter = `blur(${blur}px)`;
                    coverBgEl.style.transform = blur > 0 ? 'scale(1.05)' : 'none';
                }

                if (coverOverlayEl) {
                    const overlayColor = data.cover_overlay_color || '#000000';
                    const opacity = (data.cover_opacity !== undefined && data.cover_opacity !== null) ? (data.cover_opacity / 100) : 0.6;
                    coverOverlayEl.style.backgroundColor = overlayColor;
                    coverOverlayEl.style.opacity = opacity;
                }

                const avatarImg = document.getElementById('detail_user_avatar_img');
                const symbolSpan = document.getElementById('detail_user_symbol');

                if (data.avatar) {
                    const posX = (data.avatar_position_x !== undefined && data.avatar_position_x !== null) ? data.avatar_position_x : 50;
                    const posY = (data.avatar_position_y !== undefined && data.avatar_position_y !== null) ? data.avatar_position_y : 0;
                    const zoom = (data.avatar_zoom !== undefined && data.avatar_zoom !== null) ? parseInt(data.avatar_zoom) : 100;
                    const bgSize = zoom !== 100 ? `${zoom}%` : 'cover';

                    avatarImg.style.backgroundImage = `url('${data.avatar}')`;
                    avatarImg.style.backgroundPosition = `${posX}% ${posY}%`;
                    avatarImg.style.backgroundSize = bgSize;
                    avatarImg.classList.remove('d-none');
                    symbolSpan.classList.add('d-none');
                } else {
                    avatarImg.style.backgroundImage = '';
                    avatarImg.classList.add('d-none');
                    symbolSpan.classList.remove('d-none');
                    symbolSpan.textContent = (data.name || 'U').charAt(0).toUpperCase();
                }

                document.getElementById('detail_user_name').textContent = data.name || '-';
                document.getElementById('detail_user_email').textContent = data.email || '-';
                document.getElementById('detail_user_id').textContent = '#' + data.id;

                const rolesContainer = document.getElementById('detail_user_roles');
                if (rolesContainer) {
                    rolesContainer.innerHTML = '';
                    const rolesList = (data.roles && data.roles.length > 0) ? data.roles : (data.role ? [data.role] : ['user']);
                    rolesList.forEach(r => {
                        const badge = document.createElement('span');
                        const roleLower = String(r).toLowerCase();
                        let badgeClass = 'bg-white bg-opacity-90 text-gray-800';
                        if (roleLower === 'master') badgeClass = 'bg-danger text-white';
                        else if (roleLower === 'admin') badgeClass = 'bg-primary text-white';
                        badge.className = `badge ${badgeClass} fw-bold fs-7 px-3 py-1 text-uppercase shadow-xs`;
                        badge.textContent = r;
                        rolesContainer.appendChild(badge);
                    });
                }

                const verifiedEl = document.getElementById('detail_user_verified');
                if (data.email_verified_at) {
                    verifiedEl.className = 'badge bg-success text-white fw-bold fs-7 px-3 py-1 shadow-xs';
                    verifiedEl.textContent = 'Terverifikasi (' + data.email_verified_at + ')';
                } else {
                    verifiedEl.className = 'badge bg-warning text-dark fw-bold fs-7 px-3 py-1 shadow-xs';
                    verifiedEl.textContent = 'Belum Verifikasi';
                }

                document.getElementById('detail_user_phone').textContent = data.phone || '-';
                document.getElementById('detail_user_nik').textContent = data.nik || '-';
                document.getElementById('detail_user_address').textContent = data.address || '-';
                document.getElementById('detail_user_created_at').textContent = data.created_at || '-';
                document.getElementById('detail_user_updated_at').textContent = data.updated_at || '-';

                if (modalDetail) modalDetail.show();
            } else {
                if (typeof Notify !== 'undefined') {
                    Notify.error('Gagal memuat rincian pengguna.');
                }
            }
        } catch (err) {
            if (typeof Notify !== 'undefined') {
                Notify.error('Terjadi kesalahan saat memuat detail pengguna.');
            }
        }
    });

    // 9. Reset Password Action (Event Delegation)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-reset-password');
        if (!btn) return;

        const userId = btn.getAttribute('data-id');
        const userName = btn.getAttribute('data-name');

        const confirmAction = async function () {
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
                if (result.status === 'success' || result.success) {
                    if (typeof Notify !== 'undefined') {
                        Notify.success(result.message, 'Kata Sandi Diatur Ulang');
                    } else if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            text: result.message,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'OK',
                            customClass: { confirmButton: 'btn btn-primary' }
                        });
                    }
                } else {
                    if (typeof Notify !== 'undefined') {
                        Notify.error(result.message || 'Gagal mereset kata sandi.');
                    }
                }
            } catch (err) {
                if (typeof Notify !== 'undefined') {
                    Notify.error('Gagal memproses permintaan reset kata sandi.');
                }
            }
        };

        if (typeof Notify !== 'undefined') {
            Notify.confirm({
                title: 'Atur Ulang Kata Sandi?',
                text: `Kata sandi akun "${userName}" akan diatur ulang ke default: "password123".`,
                icon: 'question',
                confirmButtonText: 'Ya, Reset Sandi!',
                cancelButtonText: 'Batal',
                onConfirm: confirmAction
            });
        } else if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Atur Ulang Kata Sandi?',
                text: `Kata sandi akun "${userName}" akan diatur ulang ke default: "password123".`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Reset Sandi!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light'
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    confirmAction();
                }
            });
        }
    });

    // 10. Delete User Action (Event Delegation)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-delete-user');
        if (!btn) return;

        const userId = btn.getAttribute('data-id');
        const userName = btn.getAttribute('data-name');

        const deleteAction = async function () {
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
                if (response.ok && (result.status === 'success' || result.success)) {
                    if (typeof Notify !== 'undefined') {
                        Notify.success(result.message, 'Berhasil Dihapus');
                    } else if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            text: result.message,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'OK',
                            customClass: { confirmButton: 'btn btn-primary' }
                        });
                    }

                    // Remove card from DOM directly if exists
                    const cardEl = document.getElementById(`user_card_${userId}`);
                    if (cardEl) {
                        cardEl.remove();
                    }

                    // Reload DataTable
                    if (dataTable) {
                        dataTable.ajax.reload(null, false);
                    }
                    fetchCards();
                } else {
                    const msg = result.message || 'Gagal menghapus pengguna.';
                    if (typeof Notify !== 'undefined') {
                        Notify.error(msg);
                    }
                }
            } catch (err) {
                if (typeof Notify !== 'undefined') {
                    Notify.error('Gagal memproses penghapusan pengguna.');
                }
            }
        };

        if (typeof Notify !== 'undefined') {
            Notify.deleteConfirm({
                title: 'Hapus Pengguna?',
                text: `Pengguna "${userName}" akan dihapus permanen dari sistem. Tindakan ini tidak dapat dibatalkan!`,
                confirmButtonText: 'Ya, Hapus Sekarang!',
                cancelButtonText: 'Batal',
                onConfirm: deleteAction
            });
        } else if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Pengguna?',
                text: `Pengguna "${userName}" akan dihapus permanen dari sistem. Tindakan ini tidak dapat dibatalkan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Sekarang!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    deleteAction();
                }
            });
        }
    });

    // Initialize tooltips on load
    initTooltips();
});
