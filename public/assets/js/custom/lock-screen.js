/**
 * Auto Lock Screen & Activity Timeout Manager
 * Veltronic / Metronic 8 Template
 */
"use strict";

const KTLockScreen = (function () {
    // Private variables
    let modalEl = null;
    let modalInstance = null;
    let formEl = null;
    let passwordInput = null;
    let btnSubmit = null;
    let btnToggleEye = null;
    let iconEye = null;
    let errorAlert = null;
    let errorText = null;

    let isLocked = false;
    let sessionLifetimeMinutes = 120;
    let timeoutMs = sessionLifetimeMinutes * 60 * 1000;
    let lastActivityTime = Date.now();
    let checkIntervalId = null;
    let lastThrottledActivity = 0;

    const STORAGE_KEY_LOCKED = 'veltronic_screen_locked';
    const STORAGE_KEY_LAST_ACTIVITY = 'veltronic_last_activity';

    // Helper to get CSRF token
    const getCsrfToken = () => {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    };

    // Update session lifetime dynamically (in minutes)
    const updateLifetime = (minutes) => {
        const parsed = parseInt(minutes, 10);
        if (!isNaN(parsed) && parsed > 0) {
            sessionLifetimeMinutes = parsed;
            timeoutMs = sessionLifetimeMinutes * 60 * 1000;
        }
    };

    // Record user activity (throttled every 2 seconds)
    const recordActivity = () => {
        if (isLocked) return;

        const now = Date.now();
        lastActivityTime = now;

        if (now - lastThrottledActivity > 2000) {
            lastThrottledActivity = now;
            try {
                localStorage.setItem(STORAGE_KEY_LAST_ACTIVITY, now.toString());
            } catch (e) {
                // Ignore localStorage errors in private browsing
            }
        }
    };

    // Toggle password field visibility
    const togglePasswordVisibility = () => {
        if (!passwordInput || !iconEye) return;
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            iconEye.classList.remove('ki-eye');
            iconEye.classList.add('ki-eye-slash');
        } else {
            passwordInput.type = 'password';
            iconEye.classList.remove('ki-eye-slash');
            iconEye.classList.add('ki-eye');
        }
    };

    // Lock screen display
    const lock = (syncToStorage = true) => {
        if (isLocked) return;
        isLocked = true;

        if (syncToStorage) {
            try {
                localStorage.setItem(STORAGE_KEY_LOCKED, '1');
            } catch (e) {}
        }

        if (!modalEl) {
            modalEl = document.getElementById('kt_modal_lock_screen');
        }

        if (modalEl && typeof bootstrap !== 'undefined') {
            if (!modalInstance) {
                modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl, {
                    backdrop: 'static',
                    keyboard: false
                });
            }

            // Hide error alert, reset input & button indicator
            if (errorAlert) errorAlert.classList.add('d-none');
            if (passwordInput) passwordInput.value = '';
            if (btnSubmit) {
                btnSubmit.removeAttribute('data-kt-indicator');
                btnSubmit.disabled = false;
            }

            modalInstance.show();

            setTimeout(() => {
                if (passwordInput) passwordInput.focus();
            }, 300);
        }
    };

    // Hide lock screen modal
    const hideLockModal = () => {
        if (modalInstance) {
            modalInstance.hide();
        } else if (modalEl && typeof bootstrap !== 'undefined') {
            const inst = bootstrap.Modal.getInstance(modalEl);
            if (inst) inst.hide();
        }

        // Clean backdrop if lingering
        document.querySelectorAll('.modal-backdrop').forEach(bd => {
            if (bd.parentNode && !document.querySelector('.modal.show')) {
                bd.parentNode.removeChild(bd);
            }
        });
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('padding-right');
        document.body.style.removeProperty('overflow');
    };

    // Unlock screen
    const unlock = (syncToStorage = true) => {
        isLocked = false;
        lastActivityTime = Date.now();
        lastThrottledActivity = Date.now();

        if (syncToStorage) {
            try {
                localStorage.removeItem(STORAGE_KEY_LOCKED);
                localStorage.setItem(STORAGE_KEY_LAST_ACTIVITY, lastActivityTime.toString());
            } catch (e) {}
        }

        hideLockModal();

        if (passwordInput) {
            passwordInput.value = '';
            passwordInput.type = 'password';
        }
        if (iconEye) {
            iconEye.classList.remove('ki-eye-slash');
            iconEye.classList.add('ki-eye');
        }
        if (errorAlert) {
            errorAlert.classList.add('d-none');
        }
        if (btnSubmit) {
            btnSubmit.removeAttribute('data-kt-indicator');
            btnSubmit.disabled = false;
        }
    };

    // Submit unlock request to server
    const submitUnlock = () => {
        if (!passwordInput || !passwordInput.value.trim()) {
            if (errorAlert && errorText) {
                errorText.textContent = 'Silakan masukkan password akun Anda.';
                errorAlert.classList.remove('d-none');
            }
            if (passwordInput) passwordInput.focus();
            return;
        }

        const password = passwordInput.value;

        // Metronic button loading indicator
        if (btnSubmit) {
            btnSubmit.setAttribute('data-kt-indicator', 'on');
            btnSubmit.disabled = true;
        }

        if (errorAlert) {
            errorAlert.classList.add('d-none');
        }

        fetch('/lock-screen/unlock', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ password: password })
        })
        .then(async (response) => {
            const data = await response.json();
            if (btnSubmit) {
                btnSubmit.removeAttribute('data-kt-indicator');
                btnSubmit.disabled = false;
            }

            if (response.ok && data.success) {
                unlock(true);
                if (typeof Notify !== 'undefined' && Notify.success) {
                    Notify.success(data.message || 'Layar berhasil dibuka.', 'Sukses');
                }
            } else {
                if (errorAlert && errorText) {
                    if (response.status === 401) {
                        errorText.innerHTML = (data.message || 'Sesi login telah kedaluwarsa.') + ' <a href="/login" class="fw-bold text-danger text-decoration-underline ms-1">Login ulang</a>';
                    } else {
                        errorText.textContent = data.message || 'Password yang Anda masukkan salah.';
                    }
                    errorAlert.classList.remove('d-none');
                }
                if (passwordInput) {
                    passwordInput.select();
                    passwordInput.focus();
                }
            }
        })
        .catch((err) => {
            console.error('LockScreen unlock error:', err);
            if (btnSubmit) {
                btnSubmit.removeAttribute('data-kt-indicator');
                btnSubmit.disabled = false;
            }
            if (errorAlert && errorText) {
                errorText.textContent = 'Gagal terhubung ke server. Silakan coba lagi.';
                errorAlert.classList.remove('d-none');
            }
        });
    };

    // Check inactivity periodically
    const checkInactivity = () => {
        if (isLocked) return;

        // Check storage for cross-tab lock state
        try {
            if (localStorage.getItem(STORAGE_KEY_LOCKED) === '1') {
                lock(false);
                return;
            }

            const storedLastActivity = parseInt(localStorage.getItem(STORAGE_KEY_LAST_ACTIVITY) || '0', 10);
            if (storedLastActivity > lastActivityTime) {
                lastActivityTime = storedLastActivity;
            }
        } catch (e) {}

        const now = Date.now();
        const elapsed = now - lastActivityTime;

        if (elapsed >= timeoutMs) {
            lock(true);
        }
    };

    // Bind event listeners
    const initEvents = () => {
        // Activity listener events
        const activityEvents = ['mousemove', 'mousedown', 'keydown', 'scroll', 'touchstart', 'click'];
        activityEvents.forEach((ev) => {
            window.addEventListener(ev, recordActivity, { passive: true });
        });

        // Toggle password eye icon
        if (btnToggleEye) {
            btnToggleEye.addEventListener('click', function (e) {
                e.preventDefault();
                togglePasswordVisibility();
            });
        }

        // Form unlock submit
        if (formEl) {
            formEl.addEventListener('submit', function (e) {
                e.preventDefault();
                submitUnlock();
            });
        }

        // Enter key in password input
        if (passwordInput) {
            passwordInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    submitUnlock();
                }
            });
        }

        // Cross-tab sync via Storage Event
        window.addEventListener('storage', function (e) {
            if (e.key === STORAGE_KEY_LOCKED) {
                if (e.newValue === '1') {
                    lock(false);
                } else if (e.newValue === null && isLocked) {
                    unlock(false);
                }
            } else if (e.key === STORAGE_KEY_LAST_ACTIVITY && e.newValue) {
                const storedTime = parseInt(e.newValue, 10);
                if (storedTime > lastActivityTime) {
                    lastActivityTime = storedTime;
                }
            }
        });

        // Auto focus password input when modal is shown
        if (modalEl) {
            modalEl.addEventListener('shown.bs.modal', function () {
                if (passwordInput) passwordInput.focus();
            });
        }
    };

    // Initialize module
    const init = () => {
        // Verify authentication state
        const isAuth = document.body.getAttribute('data-user-auth') === '1';
        if (!isAuth) {
            return;
        }

        // Check if autolock is disabled by user preference
        const autolockEnabled = document.body.getAttribute('data-autolock-enabled') !== '0';
        if (!autolockEnabled) {
            return;
        }

        // Read session lifetime from body dataset
        const rawLifetime = document.body.getAttribute('data-session-lifetime');
        if (rawLifetime) {
            updateLifetime(rawLifetime);
        }

        // Cache DOM elements
        modalEl = document.getElementById('kt_modal_lock_screen');
        formEl = document.getElementById('kt_lock_screen_form');
        passwordInput = document.getElementById('lock_screen_password');
        btnSubmit = document.getElementById('btn_unlock_screen');
        btnToggleEye = document.getElementById('btn_toggle_lock_password');
        iconEye = document.getElementById('icon_lock_password_eye');
        errorAlert = document.getElementById('lock_screen_error_alert');
        errorText = document.getElementById('lock_screen_error_text');

        initEvents();

        // Check if previously locked across refreshes or tabs
        try {
            const previouslyLocked = localStorage.getItem(STORAGE_KEY_LOCKED) === '1';
            if (previouslyLocked) {
                lock(false);
            } else {
                // Initialize last activity time
                const storedTime = parseInt(localStorage.getItem(STORAGE_KEY_LAST_ACTIVITY) || '0', 10);
                if (storedTime && Date.now() - storedTime < timeoutMs) {
                    lastActivityTime = storedTime;
                } else {
                    lastActivityTime = Date.now();
                    localStorage.setItem(STORAGE_KEY_LAST_ACTIVITY, lastActivityTime.toString());
                }
            }
        } catch (e) {
            lastActivityTime = Date.now();
        }

        // Run checker every 1 second
        if (checkIntervalId) clearInterval(checkIntervalId);
        checkIntervalId = setInterval(checkInactivity, 1000);
    };

    // DOM ready auto-initialization
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Public API
    return {
        init: init,
        lock: lock,
        unlock: unlock,
        updateLifetime: updateLifetime,
        isLocked: () => isLocked,
        getRemainingSeconds: () => {
            const elapsed = Date.now() - lastActivityTime;
            const rem = Math.max(0, Math.floor((timeoutMs - elapsed) / 1000));
            return rem;
        }
    };
})();

// Export global variable
if (typeof window !== 'undefined') {
    window.KTLockScreen = KTLockScreen;
}
