/**
 * Veltronic / Metronic - App Profil & Dashboard Settings JS
 * Zero-Reload Realtime CRUD & Live Previews
 */
'use strict';

document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    // Helper Toast Notification
    const showToast = (type, message) => {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                text: message,
                icon: type,
                buttonsStyling: false,
                confirmButtonText: 'OK, Mengerti!',
                customClass: {
                    confirmButton: 'btn btn-primary btn-sm px-6 rounded-pill'
                }
            });
        } else {
            alert(message);
        }
    };

    // Helper Button Loading State
    const setButtonLoading = (btn, isLoading) => {
        if (!btn) return;
        if (isLoading) {
            btn.setAttribute('data-kt-indicator', 'on');
            btn.disabled = true;
        } else {
            btn.removeAttribute('data-kt-indicator');
            btn.disabled = false;
        }
    };

    /* ==========================================================
     * 1. META & SEO LIVE PREVIEWS & AJAX SUBMIT
     * ========================================================== */
    const appNameInput = document.getElementById('input_app_name');
    const appTaglineInput = document.getElementById('input_app_tagline');
    const metaDescInput = document.getElementById('input_meta_description');
    const ogTitleInput = document.getElementById('input_og_title');
    const charCountMetaDesc = document.getElementById('char_count_meta_desc');

    const previewGoogleTitle = document.getElementById('preview_google_title');
    const previewGoogleDesc = document.getElementById('preview_google_desc');
    const previewOgTitle = document.getElementById('preview_og_title');
    const previewOgDesc = document.getElementById('preview_og_desc');
    const previewOgBadgeTitle = document.getElementById('preview_og_badge_title');
    const previewOgBadgeTagline = document.getElementById('preview_og_badge_tagline');

    const updateMetaLivePreviews = () => {
        const appName = appNameInput?.value.trim() || 'Veltronic Template';
        const tagline = appTaglineInput?.value.trim() || 'Admin Dashboard';
        const desc = metaDescInput?.value.trim() || 'Sistem dashboard administrasi modern.';
        const ogTitle = ogTitleInput?.value.trim() || (appName + ' - Dashboard');

        if (previewGoogleTitle) previewGoogleTitle.textContent = appName + ' - Dashboard';
        if (previewGoogleDesc) previewGoogleDesc.textContent = desc;
        if (previewOgTitle) previewOgTitle.textContent = ogTitle;
        if (previewOgDesc) previewOgDesc.textContent = desc;
        if (previewOgBadgeTitle) previewOgBadgeTitle.textContent = appName;
        if (previewOgBadgeTagline) previewOgBadgeTagline.textContent = tagline;

        if (charCountMetaDesc && metaDescInput) {
            const count = metaDescInput.value.length;
            charCountMetaDesc.textContent = count + ' karakter';
            if (count >= 120 && count <= 160) {
                charCountMetaDesc.className = 'fw-semibold text-success';
            } else if (count > 160) {
                charCountMetaDesc.className = 'fw-semibold text-warning';
            } else {
                charCountMetaDesc.className = 'fw-semibold text-primary';
            }
        }
    };

    if (appNameInput) appNameInput.addEventListener('input', updateMetaLivePreviews);
    if (appTaglineInput) appTaglineInput.addEventListener('input', updateMetaLivePreviews);
    if (metaDescInput) metaDescInput.addEventListener('input', updateMetaLivePreviews);
    if (ogTitleInput) ogTitleInput.addEventListener('input', updateMetaLivePreviews);
    updateMetaLivePreviews();

    // Form Meta Submit
    const formMeta = document.getElementById('kt_form_app_meta');
    const btnSaveMeta = document.getElementById('kt_btn_save_meta');

    if (formMeta) {
        formMeta.addEventListener('submit', function (e) {
            e.preventDefault();
            setButtonLoading(btnSaveMeta, true);

            const formData = new FormData(formMeta);

            fetch(formMeta.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(res => res.json())
            .then(data => {
                setButtonLoading(btnSaveMeta, false);
                if (data.success) {
                    showToast('success', data.message);
                    // Update document title realtime
                    const currentTitle = document.title.split('-')[0].trim();
                    if (data.data?.app_name) {
                        document.title = `${currentTitle} - ${data.data.app_name}`;
                    }
                } else {
                    showToast('error', data.message || 'Gagal menyimpan data meta.');
                }
            })
            .catch(err => {
                setButtonLoading(btnSaveMeta, false);
                console.error(err);
                showToast('error', 'Terjadi kesalahan sistem saat menyimpan data.');
            });
        });
    }

    /* ==========================================================
     * 2. LOGO & FAVICON PREVIEWS & AJAX SUBMIT
     * ========================================================== */
    /* ==========================================================
     * 2. LOGO & FAVICON STRICT DIMENSION VALIDATION & PREVIEWS
     * ========================================================== */
    const bindImageFileInput = (inputId, imgPreviewId) => {
        const input = document.getElementById(inputId);
        const img = document.getElementById(imgPreviewId);
        if (!input || !img) return;

        input.addEventListener('change', function () {
            const file = input.files[0];
            if (!file) return;

            const label = input.getAttribute('data-label') || 'Gambar';
            const minW = parseInt(input.getAttribute('data-min-w') || '0', 10);
            const maxW = parseInt(input.getAttribute('data-max-w') || '9999', 10);
            const minH = parseInt(input.getAttribute('data-min-h') || '0', 10);
            const maxH = parseInt(input.getAttribute('data-max-h') || '9999', 10);
            const isSquare = input.getAttribute('data-square') === 'true';
            const maxSizeKb = parseInt(input.getAttribute('data-max-size-kb') || '2048', 10);

            // 1. Cek Ukuran Berkas (File Size)
            const fileSizeKb = Math.round(file.size / 1024);
            if (fileSizeKb > maxSizeKb) {
                input.value = '';
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran Berkas Terlalu Besar',
                    html: `Ukuran berkas <strong>${label}</strong> yang Anda pilih adalah <strong>${fileSizeKb} KB</strong>.<br>Batas maksimal yang diizinkan adalah <strong>${maxSizeKb} KB</strong>.`,
                    confirmButtonText: 'Pilih Berkas Lain',
                    customClass: { confirmButton: 'btn btn-danger btn-sm rounded-pill px-5' }
                });
                return;
            }

            // 2. Baca Gambar untuk Cek Dimensi Resolusi & Rasio
            const isSvg = file.type === 'image/svg+xml' || file.name.toLowerCase().endsWith('.svg');
            const isIco = file.name.toLowerCase().endsWith('.ico');

            const reader = new FileReader();
            reader.onload = function (e) {
                const dataUrl = e.target.result;

                // Untuk berkas selain SVG/ICO, periksa dimensi pixel nyata
                if (!isSvg && !isIco) {
                    const tempImg = new Image();
                    tempImg.onload = function () {
                        const width = tempImg.naturalWidth;
                        const height = tempImg.naturalHeight;

                        // Validasi Batas Minimal & Maksimal
                        if (width < minW || width > maxW || height < minH || height > maxH) {
                            input.value = '';
                            Swal.fire({
                                icon: 'error',
                                title: 'Resolusi Tidak Memenuhi Syarat',
                                html: `Resolusi <strong>${label}</strong> yang dipilih adalah <strong>${width} × ${height} px</strong>.<br><br>` +
                                      `• Lebar yang diizinkan: <strong>${minW} px - ${maxW} px</strong><br>` +
                                      `• Tinggi yang diizinkan: <strong>${minH} px - ${maxH} px</strong>`,
                                confirmButtonText: 'Pahami & Ganti Gambar',
                                customClass: { confirmButton: 'btn btn-danger btn-sm rounded-pill px-5' }
                            });
                            return;
                        }

                        // Validasi Rasio Persegi (1:1) jika diwajibkan
                        if (isSquare && Math.abs(width - height) > 5) {
                            input.value = '';
                            Swal.fire({
                                icon: 'error',
                                title: 'Rasio Gambar Tidak Sesuai',
                                html: `<strong>${label}</strong> wajib memiliki rasio persegi <strong>1:1</strong> (Lebar dan tinggi sama).<br>Gambar Anda berukuran <strong>${width} × ${height} px</strong>.`,
                                confirmButtonText: 'Pahami & Ganti Gambar',
                                customClass: { confirmButton: 'btn btn-danger btn-sm rounded-pill px-5' }
                            });
                            return;
                        }

                        // Berhasil validasi -> perbarui preview
                        img.src = dataUrl;
                    };
                    tempImg.src = dataUrl;
                } else {
                    // SVG / ICO lolos validasi size
                    img.src = dataUrl;
                }
            };
            reader.readAsDataURL(file);
        });
    };

    bindImageFileInput('input_file_logo_default', 'img_preview_logo_default');
    bindImageFileInput('input_file_logo_dark', 'img_preview_logo_dark');
    bindImageFileInput('input_file_logo_minimize', 'img_preview_logo_minimize');
    bindImageFileInput('input_file_favicon', 'img_preview_favicon');

    // Form Logo Submit
    const formLogo = document.getElementById('kt_form_app_logo');
    const btnSaveLogo = document.getElementById('kt_btn_save_logo');

    if (formLogo) {
        formLogo.addEventListener('submit', function (e) {
            e.preventDefault();
            setButtonLoading(btnSaveLogo, true);

            const formData = new FormData(formLogo);

            fetch(formLogo.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(res => res.json().then(data => ({ status: res.status, body: data })))
            .then(({ status, body }) => {
                setButtonLoading(btnSaveLogo, false);
                if (status === 200 && body.success) {
                    showToast('success', body.message);
                    // Update header & sidebar logos in DOM realtime
                    if (body.data?.logo_default_url) {
                        document.querySelectorAll('.app-sidebar-logo-default.theme-light-show, .header-logo img').forEach(el => el.src = body.data.logo_default_url);
                        const imgDef = document.getElementById('img_preview_logo_default');
                        if (imgDef) imgDef.src = body.data.logo_default_url;
                    }
                    if (body.data?.logo_dark_url) {
                        document.querySelectorAll('.app-sidebar-logo-default.theme-dark-show, .app-sidebar-logo-default:not(.theme-light-show)').forEach(el => el.src = body.data.logo_dark_url);
                        const imgDark = document.getElementById('img_preview_logo_dark');
                        if (imgDark) imgDark.src = body.data.logo_dark_url;
                    }
                    if (body.data?.logo_minimize_url) {
                        document.querySelectorAll('.app-sidebar-logo-minimize').forEach(el => el.src = body.data.logo_minimize_url);
                        const imgMin = document.getElementById('img_preview_logo_minimize');
                        if (imgMin) imgMin.src = body.data.logo_minimize_url;
                    }
                    if (body.data?.favicon_url) {
                        let linkFavicon = document.querySelector('link[rel="shortcut icon"]');
                        if (linkFavicon) linkFavicon.href = body.data.favicon_url;
                    }
                } else {
                    let errMsg = body.message || 'Gagal menyimpan logo.';
                    if (body.errors) {
                        const errList = Object.values(body.errors).flat().join('<br>');
                        errMsg = `<strong>Validasi Gagal:</strong><br>${errList}`;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Logo',
                        html: errMsg,
                        confirmButtonText: 'Perbaiki Berkas',
                        customClass: { confirmButton: 'btn btn-danger btn-sm rounded-pill px-5' }
                    });
                }
            })
            .catch(err => {
                setButtonLoading(btnSaveLogo, false);
                console.error(err);
                showToast('error', 'Terjadi kesalahan sistem saat memproses logo.');
            });
        });
    }

    // Reset Logo per Target
    document.querySelectorAll('.btn-reset-logo').forEach(btn => {
        btn.addEventListener('click', function () {
            const target = this.getAttribute('data-target');
            Swal.fire({
                title: 'Kembalikan ke Default?',
                text: `Logo (${target}) akan dikembalikan ke berkas bawaan tema Metronic.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger btn-sm rounded-pill px-4',
                    cancelButton: 'btn btn-light btn-sm rounded-pill px-4'
                }
            }).then(result => {
                if (result.isConfirmed) {
                    fetch('/appsupport/app-profil/logo/reset', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ target: target })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToast('success', data.message);
                            if (target === 'default' && data.data?.logo_default_url) {
                                document.getElementById('img_preview_logo_default').src = data.data.logo_default_url;
                            } else if (target === 'dark' && data.data?.logo_dark_url) {
                                document.getElementById('img_preview_logo_dark').src = data.data.logo_dark_url;
                            } else if (target === 'minimize' && data.data?.logo_minimize_url) {
                                document.getElementById('img_preview_logo_minimize').src = data.data.logo_minimize_url;
                            } else if (target === 'favicon' && data.data?.favicon_url) {
                                document.getElementById('img_preview_favicon').src = data.data.favicon_url;
                            }
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showToast('error', 'Gagal mereset logo.');
                    });
                }
            });
        });
    });

    /* ==========================================================
     * 3. FOOTER SETTINGS & DYNAMIC LINKS REPEATER
     * ========================================================== */
    const inputFooterYear = document.getElementById('input_footer_year');
    const inputFooterText = document.getElementById('input_footer_text');
    const inputFooterUrl = document.getElementById('input_footer_url');
    const inputFooterShowSys = document.getElementById('input_footer_show_system_info');

    const previewFooterYear = document.getElementById('preview_footer_year');
    const previewFooterText = document.getElementById('preview_footer_text');
    const previewFooterSysInfo = document.getElementById('preview_footer_sysinfo');
    const previewFooterLinksList = document.getElementById('preview_footer_links_list');

    const footerLinksContainer = document.getElementById('footer_links_container');
    const btnAddFooterLink = document.getElementById('btn_add_footer_link');
    const btnResetDefaultLinks = document.getElementById('btn_reset_default_footer_links');

    const updateFooterLivePreview = () => {
        if (previewFooterYear && inputFooterYear) previewFooterYear.textContent = (inputFooterYear.value.trim() || '2025') + '©';
        if (previewFooterText && inputFooterText) previewFooterText.textContent = inputFooterText.value.trim() || 'Keenthemes';
        if (previewFooterSysInfo && inputFooterShowSys) {
            if (inputFooterShowSys.checked) {
                previewFooterSysInfo.classList.remove('d-none');
            } else {
                previewFooterSysInfo.classList.add('d-none');
            }
        }

        // Rebuild preview footer links list
        if (previewFooterLinksList && footerLinksContainer) {
            previewFooterLinksList.innerHTML = '';
            const rows = footerLinksContainer.querySelectorAll('.footer-link-row');
            rows.forEach(row => {
                const title = row.querySelector('.link-title')?.value.trim();
                if (title) {
                    const li = document.createElement('li');
                    li.innerHTML = `<span class="text-gray-600 fw-semibold">${title}</span>`;
                    previewFooterLinksList.appendChild(li);
                }
            });
        }
    };

    if (inputFooterYear) inputFooterYear.addEventListener('input', updateFooterLivePreview);
    if (inputFooterText) inputFooterText.addEventListener('input', updateFooterLivePreview);
    if (inputFooterShowSys) inputFooterShowSys.addEventListener('change', updateFooterLivePreview);

    // Dynamic row addition
    if (btnAddFooterLink && footerLinksContainer) {
        btnAddFooterLink.addEventListener('click', function () {
            const rowCount = footerLinksContainer.querySelectorAll('.footer-link-row').length;
            const newIndex = Date.now();
            const tr = document.createElement('tr');
            tr.className = 'footer-link-row';
            tr.setAttribute('data-index', newIndex);
            tr.innerHTML = `
                <td>
                    <input type="text" class="form-control form-control-solid form-control-sm link-title" name="links[${newIndex}][title]" value="" required placeholder="Contoh: Bantuan" />
                </td>
                <td>
                    <input type="text" class="form-control form-control-solid form-control-sm link-url" name="links[${newIndex}][url]" value="https://" required placeholder="https://..." />
                </td>
                <td>
                    <select class="form-select form-select-solid form-select-sm link-target" name="links[${newIndex}][target]">
                        <option value="_blank" selected>Tab Baru (_blank)</option>
                        <option value="_self">Sama (_self)</option>
                    </select>
                </td>
                <td class="text-end">
                    <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-remove-link" title="Hapus baris">
                        <i class="ki-outline ki-trash fs-5"></i>
                    </button>
                </td>
            `;
            footerLinksContainer.appendChild(tr);

            tr.querySelector('.link-title').addEventListener('input', updateFooterLivePreview);
            tr.querySelector('.btn-remove-link').addEventListener('click', function () {
                tr.remove();
                updateFooterLivePreview();
            });

            tr.querySelector('.link-title').focus();
        });
    }

    // Attach remove event to existing rows
    document.querySelectorAll('.footer-link-row').forEach(row => {
        row.querySelector('.link-title')?.addEventListener('input', updateFooterLivePreview);
        row.querySelector('.btn-remove-link')?.addEventListener('click', function () {
            row.remove();
            updateFooterLivePreview();
        });
    });

    // Reset default links
    if (btnResetDefaultLinks && footerLinksContainer) {
        btnResetDefaultLinks.addEventListener('click', function () {
            footerLinksContainer.innerHTML = `
                <tr class="footer-link-row" data-index="0">
                    <td><input type="text" class="form-control form-control-solid form-control-sm link-title" name="links[0][title]" value="About" required /></td>
                    <td><input type="text" class="form-control form-control-solid form-control-sm link-url" name="links[0][url]" value="https://keenthemes.com" required /></td>
                    <td>
                        <select class="form-select form-select-solid form-select-sm link-target" name="links[0][target]">
                            <option value="_blank" selected>Tab Baru (_blank)</option>
                            <option value="_self">Sama (_self)</option>
                        </select>
                    </td>
                    <td class="text-end"><button type="button" class="btn btn-icon btn-light-danger btn-sm btn-remove-link"><i class="ki-outline ki-trash fs-5"></i></button></td>
                </tr>
                <tr class="footer-link-row" data-index="1">
                    <td><input type="text" class="form-control form-control-solid form-control-sm link-title" name="links[1][title]" value="Support" required /></td>
                    <td><input type="text" class="form-control form-control-solid form-control-sm link-url" name="links[1][url]" value="https://devs.keenthemes.com" required /></td>
                    <td>
                        <select class="form-select form-select-solid form-select-sm link-target" name="links[1][target]">
                            <option value="_blank" selected>Tab Baru (_blank)</option>
                            <option value="_self">Sama (_self)</option>
                        </select>
                    </td>
                    <td class="text-end"><button type="button" class="btn btn-icon btn-light-danger btn-sm btn-remove-link"><i class="ki-outline ki-trash fs-5"></i></button></td>
                </tr>
                <tr class="footer-link-row" data-index="2">
                    <td><input type="text" class="form-control form-control-solid form-control-sm link-title" name="links[2][title]" value="Purchase" required /></td>
                    <td><input type="text" class="form-control form-control-solid form-control-sm link-url" name="links[2][url]" value="https://1.envato.market/EA4JP" required /></td>
                    <td>
                        <select class="form-select form-select-solid form-select-sm link-target" name="links[2][target]">
                            <option value="_blank" selected>Tab Baru (_blank)</option>
                            <option value="_self">Sama (_self)</option>
                        </select>
                    </td>
                    <td class="text-end"><button type="button" class="btn btn-icon btn-light-danger btn-sm btn-remove-link"><i class="ki-outline ki-trash fs-5"></i></button></td>
                </tr>
            `;
            document.querySelectorAll('.footer-link-row').forEach(row => {
                row.querySelector('.link-title')?.addEventListener('input', updateFooterLivePreview);
                row.querySelector('.btn-remove-link')?.addEventListener('click', function () {
                    row.remove();
                    updateFooterLivePreview();
                });
            });
            updateFooterLivePreview();
        });
    }

    // Form Footer Submit
    const formFooter = document.getElementById('kt_form_app_footer');
    const btnSaveFooter = document.getElementById('kt_btn_save_footer');

    if (formFooter) {
        formFooter.addEventListener('submit', function (e) {
            e.preventDefault();
            setButtonLoading(btnSaveFooter, true);

            const formData = new FormData(formFooter);

            fetch(formFooter.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(res => res.json())
            .then(data => {
                setButtonLoading(btnSaveFooter, false);
                if (data.success) {
                    showToast('success', data.message);
                    // Update realtime footer at page bottom
                    const footerElement = document.querySelector('#kt_app_footer, #kt_footer');
                    if (footerElement && data.data) {
                        const copySpan = footerElement.querySelector('.text-muted.fw-semibold.me-1');
                        if (copySpan) copySpan.textContent = data.data.year + '©';
                        const copyA = footerElement.querySelector('a.text-gray-800');
                        if (copyA) {
                            copyA.textContent = data.data.text;
                            copyA.href = data.data.url || '#';
                        }
                        const menuUl = footerElement.querySelector('ul.menu');
                        if (menuUl && Array.isArray(data.data.links)) {
                            menuUl.innerHTML = '';
                            data.data.links.forEach(l => {
                                const li = document.createElement('li');
                                li.className = 'menu-item';
                                li.innerHTML = `<a href="${l.url}" target="${l.target || '_blank'}" class="menu-link px-2">${l.title}</a>`;
                                menuUl.appendChild(li);
                            });
                        }
                    }
                } else {
                    showToast('error', data.message || 'Gagal menyimpan pengaturan footer.');
                }
            })
            .catch(err => {
                setButtonLoading(btnSaveFooter, false);
                console.error(err);
                showToast('error', 'Terjadi kesalahan sistem saat menyimpan data footer.');
            });
        });
    }

    /* ==========================================================
     * 4. SEEDER SYNC & RE-SEED ACTIONS
     * ========================================================== */
    const btnSyncSeeder = document.getElementById('kt_btn_sync_seeder');
    if (btnSyncSeeder) {
        btnSyncSeeder.addEventListener('click', function () {
            Swal.fire({
                title: 'Perbarui Berkas Seeder?',
                text: 'File database/seeders/AppProfilSeeder.php akan ditulis ulang menggunakan data konfigurasi profil yang sedang aktif saat ini.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Perbarui Seeder!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-success btn-sm rounded-pill px-5',
                    cancelButton: 'btn btn-light btn-sm rounded-pill px-4'
                }
            }).then(result => {
                if (result.isConfirmed) {
                    setButtonLoading(btnSyncSeeder, true);
                    fetch('/appsupport/app-profil/sync-seeder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        setButtonLoading(btnSyncSeeder, false);
                        if (data.success) {
                            showToast('success', data.message);
                        } else {
                            showToast('error', data.message || 'Gagal memperbarui file seeder.');
                        }
                    })
                    .catch(err => {
                        setButtonLoading(btnSyncSeeder, false);
                        console.error(err);
                        showToast('error', 'Terjadi kesalahan sistem saat memperbarui seeder.');
                    });
                }
            });
        });
    }

    const btnRunSeeder = document.getElementById('kt_btn_run_seeder');
    if (btnRunSeeder) {
        btnRunSeeder.addEventListener('click', function () {
            Swal.fire({
                title: 'Jalankan Ulang Seeder?',
                text: 'Data profil di database akan dimuat ulang dari berkas database/seeders/AppProfilSeeder.php.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Jalankan Seeder!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary btn-sm rounded-pill px-5',
                    cancelButton: 'btn btn-light btn-sm rounded-pill px-4'
                }
            }).then(result => {
                if (result.isConfirmed) {
                    setButtonLoading(btnRunSeeder, true);
                    fetch('/appsupport/app-profil/run-seeder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        setButtonLoading(btnRunSeeder, false);
                        if (data.success) {
                            Swal.fire({
                                text: data.message,
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'OK, Muat Ulang Tampilan!',
                                customClass: {
                                    confirmButton: 'btn btn-primary btn-sm px-6 rounded-pill'
                                }
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            showToast('error', data.message || 'Gagal menjalankan seeder.');
                        }
                    })
                    .catch(err => {
                        setButtonLoading(btnRunSeeder, false);
                        console.error(err);
                        showToast('error', 'Terjadi kesalahan sistem saat menjalankan seeder.');
                    });
                }
            });
        });
    }

    /* ==========================================================
     * 5. CLEAR CACHE ACTION
     * ========================================================== */
    const btnClearCache = document.getElementById('kt_btn_clear_profile_cache');
    if (btnClearCache) {
        btnClearCache.addEventListener('click', function () {
            setButtonLoading(btnClearCache, true);
            fetch('/appsupport/app-profil/clear-cache', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                setButtonLoading(btnClearCache, false);
                if (data.success) {
                    showToast('success', data.message);
                } else {
                    showToast('error', data.message || 'Gagal membersihkan cache.');
                }
            })
            .catch(err => {
                setButtonLoading(btnClearCache, false);
                console.error(err);
                showToast('error', 'Gagal memproses pembersihan cache.');
            });
        });
    }
});
