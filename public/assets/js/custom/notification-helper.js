/**
 * Global Notification Helper (Veltronic / Metronic 8.3.2)
 * Standardizes Toastr & SweetAlert2 across all modules.
 * Path: public/assets/js/custom/notification-helper.js
 */

(function (window) {
    'use strict';

    // Default Toastr Config (Top Right, Close Button, Clean Minimal Toast)
    const defaultToastrOptions = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: false,
        positionClass: "toastr-top-right",
        preventDuplicates: true,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "4000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };

    function applyToastrConfig(customOptions = {}) {
        if (typeof toastr !== 'undefined') {
            toastr.options = Object.assign({}, defaultToastrOptions, customOptions);
        }
    }

    // Initialize Toastr configuration
    applyToastrConfig();

    const Notify = {
        /**
         * Toast notifications (Toastr)
         */
        toast: {
            success: function (message, title = '', options = {}) {
                applyToastrConfig(options);
                if (typeof toastr !== 'undefined') {
                    return toastr.success(message, title);
                }
                console.log('[Notify SUCCESS]:', title, message);
            },
            error: function (message, title = '', options = {}) {
                applyToastrConfig(options);
                if (typeof toastr !== 'undefined') {
                    return toastr.error(message, title);
                }
                console.error('[Notify ERROR]:', title, message);
            },
            warning: function (message, title = '', options = {}) {
                applyToastrConfig(options);
                if (typeof toastr !== 'undefined') {
                    return toastr.warning(message, title);
                }
                console.warn('[Notify WARNING]:', title, message);
            },
            info: function (message, title = '', options = {}) {
                applyToastrConfig(options);
                if (typeof toastr !== 'undefined') {
                    return toastr.info(message, title);
                }
                console.info('[Notify INFO]:', title, message);
            },
            clear: function () {
                if (typeof toastr !== 'undefined') {
                    toastr.clear();
                }
            }
        },

        // Direct Toast Shortcuts
        success: function (message, title = '', options = {}) {
            return Notify.toast.success(message, title, options);
        },
        error: function (message, title = '', options = {}) {
            return Notify.toast.error(message, title, options);
        },
        warning: function (message, title = '', options = {}) {
            return Notify.toast.warning(message, title, options);
        },
        info: function (message, title = '', options = {}) {
            return Notify.toast.info(message, title, options);
        },

        /**
         * SweetAlert2 Dialogs (Metronic Styled)
         */
        alert: function (config = {}) {
            if (typeof Swal === 'undefined') {
                alert(config.text || config.title || '');
                return Promise.resolve({ isConfirmed: true });
            }

            const defaults = {
                title: '',
                text: '',
                icon: 'info', // 'success', 'error', 'warning', 'info', 'question'
                buttonsStyling: false,
                confirmButtonText: 'Ok, Mengerti',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            };

            const finalConfig = Object.assign({}, defaults, config);
            return Swal.fire(finalConfig);
        },

        /**
         * Confirmation dialog (Returns Promise & supports callbacks)
         */
        confirm: function (config = {}) {
            if (typeof Swal === 'undefined') {
                const confirmed = confirm(config.text || config.title || 'Apakah Anda yakin?');
                if (confirmed && typeof config.onConfirm === 'function') config.onConfirm();
                if (!confirmed && typeof config.onCancel === 'function') config.onCancel();
                return Promise.resolve({ isConfirmed: confirmed });
            }

            const defaults = {
                title: '',
                text: 'Apakah Anda yakin ingin melanjutkan tindakan ini?',
                icon: 'warning',
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light'
                }
            };

            const finalConfig = Object.assign({}, defaults, config);

            return Swal.fire(finalConfig).then((result) => {
                if (result.isConfirmed) {
                    if (typeof config.onConfirm === 'function') config.onConfirm();
                } else if (result.isDismissed) {
                    if (typeof config.onCancel === 'function') config.onCancel();
                }
                return result;
            });
        },

        /**
         * Pre-configured Delete / Danger confirmation dialog
         */
        deleteConfirm: function (config = {}) {
            const dangerDefaults = {
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                confirmButtonText: 'Ya, Hapus Sekarang!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                }
            };
            return Notify.confirm(Object.assign({}, dangerDefaults, config));
        }
    };

    /**
     * Global Button Loading Manager (Metronic Spinner Indicator)
     */
    const ButtonLoader = {
        show: function (btn, text = null) {
            if (!btn) return;
            ButtonLoader.init(btn);
            if (text) {
                const progressEl = btn.querySelector('.indicator-progress');
                if (progressEl) {
                    progressEl.innerHTML = `${text} <span class="spinner-border spinner-border-sm align-middle ms-2"></span>`;
                }
            }
            btn.setAttribute('data-kt-indicator', 'on');
            btn.disabled = true;
        },
        hide: function (btn) {
            if (!btn) return;
            btn.removeAttribute('data-kt-indicator');
            btn.disabled = false;
        },
        init: function (btn, labelText = null, progressText = 'Mohon tunggu...') {
            if (!btn) return;
            if (!btn.querySelector('.indicator-label')) {
                const currentContent = labelText || btn.innerHTML;
                btn.innerHTML = `
                    <span class="indicator-label">${currentContent}</span>
                    <span class="indicator-progress">${progressText} <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                `;
            }
        }
    };

    // Auto-intercept form submissions to show loading indicators
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (!form || form.tagName !== 'FORM') return;
        if (e.defaultPrevented) return;

        // Skip if form is currently invalid
        if (typeof form.checkValidity === 'function' && !form.checkValidity()) {
            return;
        }

        const submitBtn = form.querySelector('button[type="submit"]:not([data-kt-indicator-disabled]), button[id*="submit"]:not([data-kt-indicator-disabled]), button[id*="save"]:not([data-kt-indicator-disabled]), button[id*="btn_save"]:not([data-kt-indicator-disabled]), button[id*="btn_update"]:not([data-kt-indicator-disabled])');
        if (submitBtn) {
            ButtonLoader.show(submitBtn);
        }
    });

    // Reset button indicators when navigating back
    window.addEventListener('pageshow', function () {
        document.querySelectorAll('[data-kt-indicator="on"]').forEach(btn => {
            ButtonLoader.hide(btn);
        });
    });

    // Expose to window global scope
    window.Notify = Notify;
    window.AppNotify = Notify;
    window.KTButtonLoader = ButtonLoader;
    window.ButtonLoader = ButtonLoader;

})(window);
