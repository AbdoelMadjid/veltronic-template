@extends('layouts.index')

@section('styles')
    <!--begin::Vendor Stylesheets-->
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endsection

@section('toolbar')
    @include('layouts.partials._toolbar')
@endsection

@section('content')
    @php
        $tab = $activeTab ?? 'profil-saya';
    @endphp

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Navbar / Header Card-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    @include('pages.profil.partials.details')
                    <!--end::Details-->
                    
                    <!--begin::Navs-->
                    @include('pages.profil.partials.navs', ['activeTab' => $tab])
                    <!--end::Navs-->
                </div>
            </div>
            <!--end::Navbar / Header Card-->

            <!--begin::Tab Content-->
            <div class="tab-content" id="kt_user_profile_tabs">
                <!--begin:::Tab pane Profil Saya-->
                <div class="tab-pane fade {{ $tab === 'profil-saya' ? 'show active' : '' }}" id="kt_user_profile_tab_profil_saya" role="tabpanel">
                    @include('pages.profil.partials.tabs.profil-saya')
                </div>
                <!--end:::Tab pane Profil Saya-->

                <!--begin:::Tab pane Identitas Diri-->
                <div class="tab-pane fade {{ $tab === 'identitas-diri' ? 'show active' : '' }}" id="kt_user_profile_tab_identitas_diri" role="tabpanel">
                    @include('pages.profil.partials.tabs.identitas-diri')
                </div>
                <!--end:::Tab pane Identitas Diri-->

                <!--begin:::Tab pane Ganti Password-->
                <div class="tab-pane fade {{ $tab === 'ganti-password' ? 'show active' : '' }}" id="kt_user_profile_tab_ganti_password" role="tabpanel">
                    @include('pages.profil.partials.tabs.ganti-password')
                </div>
                <!--end:::Tab pane Ganti Password-->

                <!--begin:::Tab pane Konfigurasi-->
                <div class="tab-pane fade {{ $tab === 'konfigurasi' ? 'show active' : '' }}" id="kt_user_profile_tab_konfigurasi" role="tabpanel">
                    @include('pages.profil.partials.tabs.konfigurasi')
                </div>
                <!--end:::Tab pane Konfigurasi-->

                <!--begin:::Tab pane Riwayat Pengguna-->
                <div class="tab-pane fade {{ $tab === 'riwayat-pengguna' ? 'show active' : '' }}" id="kt_user_profile_tab_riwayat_pengguna" role="tabpanel">
                    @include('pages.profil.partials.tabs.riwayat-pengguna')
                </div>
                <!--end:::Tab pane Riwayat Pengguna-->
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Content container-->
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Profil Pengguna Actions-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Helper for SweetAlert / Toastr notifications
            function showNotification(type, message, title, onCloseCallback) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        text: message,
                        icon: type,
                        buttonsStyling: false,
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(() => {
                        if (typeof onCloseCallback === 'function') {
                            onCloseCallback();
                        }
                    });
                } else if (typeof toastr !== 'undefined') {
                    toastr[type](message, title || '');
                    if (typeof onCloseCallback === 'function') {
                        onCloseCallback();
                    }
                } else {
                    alert(message);
                    if (typeof onCloseCallback === 'function') {
                        onCloseCallback();
                    }
                }
            }

            // Realtime updater: Profile completion progress bar & badge
            function updateCompletionProgress(percent) {
                if (typeof percent === 'undefined' || percent === null) return;
                const badge = document.getElementById('profile_completion_badge');
                if (badge) {
                    badge.innerText = `${percent}%`;
                    badge.setAttribute('data-kt-countup-value', percent);
                }
                const bar = document.getElementById('profile_completion_bar');
                if (bar) {
                    bar.style.width = `${percent}%`;
                    bar.setAttribute('aria-valuenow', percent);
                }
            }

            // Realtime updater: Avatar images across navbar, header, and profile
            function updateAvatarImages(avatarUrl) {
                const defaultUrl = "{{ \App\Support\ThemeAsset::url('media/svg/avatars/blank.svg', $theme_asset_pack ?? null) }}";
                const targetUrl = avatarUrl || defaultUrl;

                const headerImg = document.getElementById('profile_header_avatar_img');
                if (headerImg) headerImg.style.backgroundImage = `url('${targetUrl}')`;

                const navImg = document.getElementById('header_navbar_user_avatar');
                if (navImg) navImg.style.backgroundImage = `url('${targetUrl}')`;

                const wrapper = document.getElementById('profil_saya_avatar_wrapper');
                if (wrapper) {
                    wrapper.style.backgroundImage = `url('${targetUrl}')`;
                    const imageInputEl = wrapper.closest('.image-input');
                    if (imageInputEl) {
                        if (avatarUrl) {
                            imageInputEl.classList.remove('image-input-empty');
                        } else {
                            imageInputEl.classList.add('image-input-empty');
                        }
                    }
                }
            }

            // Realtime updater: KTP card preview, modal, and placeholder
            function updateKtpDisplay(fotoKtpUrl) {
                const previewContainer = document.getElementById('container_ktp_preview');
                const placeholderContainer = document.getElementById('container_ktp_placeholder');
                const previewImg = document.getElementById('img_profil_ktp_preview');
                const modalImg = document.getElementById('img_modal_ktp_preview');
                const downloadLink = document.getElementById('link_modal_ktp_download');

                if (fotoKtpUrl) {
                    if (previewContainer) previewContainer.classList.remove('d-none');
                    if (placeholderContainer) placeholderContainer.classList.add('d-none');
                    if (previewImg) previewImg.src = fotoKtpUrl;
                    if (modalImg) modalImg.src = fotoKtpUrl;
                    if (downloadLink) downloadLink.href = fotoKtpUrl;
                } else {
                    if (previewContainer) previewContainer.classList.add('d-none');
                    if (placeholderContainer) placeholderContainer.classList.remove('d-none');
                    if (previewImg) previewImg.src = '';
                    if (modalImg) modalImg.src = '';
                    if (downloadLink) downloadLink.href = '#';
                }
            }

            // Realtime updater: Identitas diri text displays in Profil Saya tab
            function updateIdentitasDisplay(data) {
                if (!data) return;

                if (data.user) {
                    const headerName = document.getElementById('profile_header_user_name');
                    if (headerName) headerName.innerText = data.user.name || '-';

                    const profilUserName = document.getElementById('profil_display_user_name');
                    if (profilUserName) profilUserName.innerText = data.user.name || '-';

                    const profilUserEmail = document.getElementById('profil_display_user_email');
                    if (profilUserEmail) profilUserEmail.innerText = data.user.email || '-';

                    if (data.user.avatar_url) {
                        updateAvatarImages(data.user.avatar_url);
                    }
                }

                if (data.detail) {
                    const mappings = {
                        'profil_display_nik': data.detail.nik,
                        'profil_display_nama_lengkap': data.detail.nama_lengkap,
                        'profil_display_ttl': data.detail.ttl,
                        'profil_display_jenis_kelamin': data.detail.jenis_kelamin,
                        'profil_display_golongan_darah': data.detail.golongan_darah,
                        'profil_display_agama': data.detail.agama,
                        'profil_display_status_perkawinan': data.detail.status_perkawinan,
                        'profil_display_pekerjaan': data.detail.pekerjaan,
                        'profil_display_kewarganegaraan': data.detail.kewarganegaraan,
                        'profil_display_berlaku_hingga': data.detail.berlaku_hingga,
                        'profil_display_no_hp': data.detail.no_hp,
                        'profil_display_alamat_jalan': data.detail.alamat_jalan,
                        'profil_display_blok_norumah': data.detail.blok_norumah,
                        'profil_display_rt_rw': data.detail.rt_rw,
                        'profil_display_desa': data.detail.desa,
                        'profil_display_kecamatan': data.detail.kecamatan,
                        'profil_display_kabupaten': data.detail.kabupaten,
                        'profil_display_provinsi': data.detail.provinsi,
                        'profil_display_kode_pos': data.detail.kode_pos,
                        'profil_display_alamat_lengkap': data.detail.alamat_lengkap,
                        'modal_ktp_nik': data.detail.nik,
                        'modal_ktp_nama': data.detail.nama_lengkap,
                    };

                    for (const [id, value] of Object.entries(mappings)) {
                        const el = document.getElementById(id);
                        if (el) el.innerText = (value !== null && typeof value !== 'undefined' && value !== '') ? value : '-';
                    }
                }

                if (typeof data.completion_percent !== 'undefined') {
                    updateCompletionProgress(data.completion_percent);
                }
            }

            // Generic AJAX Form Handler with Button Indicator
            function handleAjaxForm(formId, btnId, successCallback) {
                const form = document.getElementById(formId);
                const btn = document.getElementById(btnId);
                if (!form) return;

                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    if (btn) {
                        btn.setAttribute('data-kt-indicator', 'on');
                        btn.disabled = true;
                    }

                    const formData = new FormData(form);

                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(async response => {
                        const data = await response.json();
                        if (btn) {
                            btn.removeAttribute('data-kt-indicator');
                            btn.disabled = false;
                        }

                        if (response.ok && data.success) {
                            showNotification('success', data.message || 'Perubahan berhasil disimpan.', 'Berhasil');
                            if (typeof successCallback === 'function') {
                                successCallback(data);
                            }
                        } else {
                            let errorMsg = data.message || 'Terjadi kesalahan validasi data.';
                            if (data.errors) {
                                const errorList = Object.values(data.errors).flat();
                                if (errorList.length > 0) errorMsg = errorList.join('<br>');
                            }
                            showNotification('error', errorMsg, 'Peringatan');
                        }
                    })
                    .catch(err => {
                        console.error('Form submit error:', err);
                        if (btn) {
                            btn.removeAttribute('data-kt-indicator');
                            btn.disabled = false;
                        }
                        showNotification('error', 'Gagal memproses permintaan ke server.', 'Kesalahan');
                    });
                });
            }

            // Auto-save avatar handler on change / remove
            const avatarFileInput = document.getElementById('input_auto_avatar_file');
            const avatarForm = document.getElementById('form_auto_avatar');
            const avatarRemoveBtn = document.getElementById('btn_auto_avatar_remove');
            const avatarRemoveInput = document.getElementById('input_auto_avatar_remove');

            function submitAvatarForm() {
                if (!avatarForm) return;
                const formData = new FormData(avatarForm);

                fetch(avatarForm.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async res => {
                    const data = await res.json();
                    if (res.ok && data.success) {
                        showNotification('success', data.message || 'Foto profil berhasil disimpan.', 'Berhasil');
                        updateAvatarImages(data.avatar_url);
                        if (typeof data.completion_percent !== 'undefined') {
                            updateCompletionProgress(data.completion_percent);
                        }
                    } else {
                        showNotification('error', data.message || 'Gagal menyimpan foto profil.', 'Peringatan');
                    }
                })
                .catch(err => {
                    console.error('Avatar upload error:', err);
                    showNotification('error', 'Terjadi kesalahan saat mengunggah foto profil.', 'Kesalahan');
                });
            }

            if (avatarFileInput) {
                avatarFileInput.addEventListener('change', function () {
                    if (this.files && this.files.length > 0) {
                        if (avatarRemoveInput) avatarRemoveInput.value = '';
                        submitAvatarForm();
                    }
                });
            }

            if (avatarRemoveBtn) {
                avatarRemoveBtn.addEventListener('click', function () {
                    // Sembunyikan dan bersihkan tooltip yang sedang aktif
                    const tooltipInstance = bootstrap.Tooltip.getInstance(this);
                    if (tooltipInstance) {
                        tooltipInstance.hide();
                    }
                    document.querySelectorAll('.tooltip').forEach(el => el.remove());

                    if (avatarRemoveInput) avatarRemoveInput.value = '1';
                    setTimeout(submitAvatarForm, 100);
                });
            }

            // Direct KTP photo upload handler
            const ktpFileInput = document.getElementById('input_profil_ktp_file');
            const ktpForm = document.getElementById('form_profil_ktp');
            const ktpRemoveInput = document.getElementById('input_profil_ktp_remove');
            const ktpUploadBtn = document.getElementById('btn_profil_ktp_upload');
            const ktpChangeBtn = document.getElementById('btn_profil_ktp_change');
            const ktpRemoveBtn = document.getElementById('btn_profil_ktp_remove');

            if (ktpUploadBtn) {
                ktpUploadBtn.addEventListener('click', function () {
                    if (ktpFileInput) ktpFileInput.click();
                });
            }

            if (ktpChangeBtn) {
                ktpChangeBtn.addEventListener('click', function () {
                    if (ktpFileInput) ktpFileInput.click();
                });
            }

            function submitKtpForm() {
                if (!ktpForm) return;
                const formData = new FormData(ktpForm);

                fetch(ktpForm.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async res => {
                    const data = await res.json();
                    if (res.ok && data.success) {
                        showNotification('success', data.message || 'Foto KTP berhasil diperbarui.', 'Berhasil');
                        updateKtpDisplay(data.foto_ktp_url);
                        if (typeof data.completion_percent !== 'undefined') {
                            updateCompletionProgress(data.completion_percent);
                        }
                    } else {
                        let errorMsg = data.message || 'Gagal menyimpan foto KTP.';
                        if (data.errors && data.errors.foto_ktp) {
                            errorMsg = data.errors.foto_ktp.join('<br>');
                        }
                        showNotification('error', errorMsg, 'Peringatan');
                    }
                })
                .catch(err => {
                    console.error('KTP upload error:', err);
                    showNotification('error', 'Terjadi kesalahan saat mengunggah foto KTP.', 'Kesalahan');
                });
            }

            if (ktpFileInput) {
                ktpFileInput.addEventListener('change', function () {
                    if (this.files && this.files.length > 0) {
                        if (ktpRemoveInput) ktpRemoveInput.value = '';
                        submitKtpForm();
                    }
                });
            }

            if (ktpRemoveBtn) {
                ktpRemoveBtn.addEventListener('click', function () {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Hapus Foto KTP?',
                            text: "Apakah Anda yakin ingin menghapus berkas foto KTP ini?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Hapus',
                            cancelButtonText: 'Batal',
                            customClass: {
                                confirmButton: 'btn btn-danger',
                                cancelButton: 'btn btn-light'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (ktpRemoveInput) ktpRemoveInput.value = '1';
                                submitKtpForm();
                            }
                        });
                    } else {
                        if (confirm('Apakah Anda yakin ingin menghapus berkas foto KTP ini?')) {
                            if (ktpRemoveInput) ktpRemoveInput.value = '1';
                            submitKtpForm();
                        }
                    }
                });
            }

            // Bind forms without reload
            handleAjaxForm('form_identitas_diri', 'btn_save_identitas', function (data) {
                updateIdentitasDisplay(data);
            });

            handleAjaxForm('form_ganti_password', 'btn_save_password', function (data) {
                const form = document.getElementById('form_ganti_password');
                if (form) form.reset();
            });

            handleAjaxForm('form_konfigurasi', 'btn_save_konfigurasi');
        });
    </script>
    <!--end::Profil Pengguna Actions-->
@endsection
