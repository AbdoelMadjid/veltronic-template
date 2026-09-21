/**
 * Realtime User Presence & Activity Tracker
 * Veltronic Template - Metronic 8
 * 
 * Tracks user activity, idle state, sends heartbeats,
 * and updates the Dashboard presence widget in realtime without reloading.
 */
"use strict";

const KTUserPresence = (function () {
    // Configuration
    const IDLE_TIMEOUT_MS = 3 * 60 * 1000; // 3 minutes without interaction -> Idle
    const HEARTBEAT_INTERVAL_MS = 45 * 1000; // Send heartbeat every 45s
    const DASHBOARD_POLL_INTERVAL_MS = 15 * 1000; // Refresh widget every 15s when on dashboard

    // State variables
    let lastActivityTime = Date.now();
    let currentStatus = 'online'; // 'online' | 'idle' | 'offline'
    let heartbeatTimer = null;
    let idleCheckTimer = null;
    let dashboardPollTimer = null;
    let activeFilter = 'all'; // 'all' | 'online' | 'idle' | 'offline'
    let isRequestInProgress = false;

    // Helper: Get CSRF Token
    const getCsrfToken = () => {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    };

    // Send heartbeat to backend
    const sendHeartbeat = (status = currentStatus) => {
        const token = getCsrfToken();
        if (!token) return;

        fetch('/user-presence/heartbeat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => {
            if (!response.ok && response.status === 401) {
                // Sesi habis / unauthenticated -> hentikan timer
                stopTimers();
            }
            return response.json();
        })
        .catch(() => {
            // Ignore network glitch gracefully
        });
    };

    // Mark active interaction
    const recordUserActivity = () => {
        lastActivityTime = Date.now();

        if (currentStatus === 'idle') {
            currentStatus = 'online';
            sendHeartbeat('online');
            updateSelfIndicator('online');
        }
    };

    // Check idle status periodically
    const checkIdleState = () => {
        const now = Date.now();
        const timeSinceLastActivity = now - lastActivityTime;
        const isTabHidden = document.visibilityState === 'hidden';
        const isScreenLocked = typeof KTLockScreen !== 'undefined' && KTLockScreen.isLocked ? KTLockScreen.isLocked() : false;

        if (currentStatus === 'online' && (timeSinceLastActivity >= IDLE_TIMEOUT_MS || isTabHidden || isScreenLocked)) {
            currentStatus = 'idle';
            sendHeartbeat('idle');
            updateSelfIndicator('idle');
        }
    };

    // Update Topbar Self Avatar Indicator (if exists)
    const updateSelfIndicator = (status) => {
        const badge = document.getElementById('user_self_presence_badge');
        if (!badge) return;

        badge.classList.remove('bg-success', 'bg-warning', 'bg-secondary');
        if (status === 'online') {
            badge.classList.add('bg-success');
            badge.setAttribute('title', 'Status: Online (Aktif)');
        } else if (status === 'idle') {
            badge.classList.add('bg-warning');
            badge.setAttribute('title', 'Status: Idle (Menjauh)');
        } else {
            badge.classList.add('bg-secondary');
            badge.setAttribute('title', 'Status: Offline');
        }
    };

    // Dashboard Presence Widget: Fetch & Render Realtime Data
    const updateDashboardWidget = (manualTrigger = false) => {
        const widgetContainer = document.getElementById('dashboard_presence_widget');
        if (!widgetContainer) return;

        if (isRequestInProgress && !manualTrigger) return;
        isRequestInProgress = true;

        const itemsList = document.getElementById('presence_users_list');
        const countOnlineEl = document.getElementById('presence_stat_online');
        const countIdleEl = document.getElementById('presence_stat_idle');
        const countTotalEl = document.getElementById('presence_stat_total');
        const refreshBtn = document.getElementById('btn_refresh_presence');

        if (refreshBtn && manualTrigger) {
            refreshBtn.classList.add('rotating');
        }

        fetch(`/user-presence/dashboard-widget?status=${encodeURIComponent(activeFilter)}&limit=10`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                if (itemsList && data.html !== undefined) {
                    itemsList.innerHTML = data.html;
                    // Re-initialize any Metronic tooltips inside widget
                    if (typeof KTComponents !== 'undefined' && KTComponents.init) {
                        KTComponents.init();
                    }
                }

                // Update counter badges
                if (data.stats) {
                    if (countOnlineEl) countOnlineEl.innerHTML = `<span class="w-6px h-6px rounded-circle bg-success"></span> ${data.stats.online} Online`;
                    if (countIdleEl) countIdleEl.textContent = `${data.stats.idle} Idle`;
                    if (countTotalEl) countTotalEl.textContent = data.stats.total;

                    // Update filter tab counters
                    const fAll = document.getElementById('filter_count_all');
                    const fOnline = document.getElementById('filter_count_online');
                    const fIdle = document.getElementById('filter_count_idle');
                    const fOffline = document.getElementById('filter_count_offline');

                    if (fAll) fAll.textContent = data.stats.total;
                    if (fOnline) fOnline.textContent = data.stats.online;
                    if (fIdle) fIdle.textContent = data.stats.idle;
                    if (fOffline) fOffline.textContent = data.stats.offline;
                }
            }
        })
        .catch(err => {
            console.error('Presence widget error:', err);
        })
        .finally(() => {
            isRequestInProgress = false;
            if (refreshBtn) {
                setTimeout(() => refreshBtn.classList.remove('rotating'), 500);
            }
        });
    };

    // Setup Event Listeners for User Activity
    let hiddenGraceTimer = null;
    const initActivityListeners = () => {
        const events = ['mousemove', 'keydown', 'click', 'scroll', 'touchstart'];
        let throttleTimer = null;

        events.forEach(eventName => {
            window.addEventListener(eventName, () => {
                if (!throttleTimer) {
                    recordUserActivity();
                    throttleTimer = setTimeout(() => {
                        throttleTimer = null;
                    }, 2000);
                }
            }, { passive: true });
        });

        // Tab visibility change with 60-second grace period
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible') {
                if (hiddenGraceTimer) {
                    clearTimeout(hiddenGraceTimer);
                    hiddenGraceTimer = null;
                }
                recordUserActivity();
            } else {
                // Berikan toleransi 60 detik sebelum beralih ke mode idle saat tab ditinggal
                if (hiddenGraceTimer) clearTimeout(hiddenGraceTimer);
                hiddenGraceTimer = setTimeout(() => {
                    if (document.visibilityState === 'hidden' && currentStatus === 'online') {
                        currentStatus = 'idle';
                        sendHeartbeat('idle');
                        updateSelfIndicator('idle');
                    }
                }, 60 * 1000);
            }
        });

        // Unload / Close tab -> Notify offline via sendBeacon
        window.addEventListener('beforeunload', () => {
            const token = getCsrfToken();
            if (navigator.sendBeacon && token) {
                const formData = new FormData();
                formData.append('_token', token);
                navigator.sendBeacon('/user-presence/offline', formData);
            }
        });
    };

    // Setup Dashboard Widget Interactivity (Filter tabs & Social buttons)
    const initDashboardWidget = () => {
        const widgetContainer = document.getElementById('dashboard_presence_widget');
        if (!widgetContainer) return;

        // 1. Filter Tabs (Semua / Online / Idle / Offline)
        const filterBtns = widgetContainer.querySelectorAll('.presence-filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                filterBtns.forEach(b => b.classList.remove('active', 'btn-primary', 'text-white'));
                filterBtns.forEach(b => b.classList.add('btn-light-primary', 'text-muted'));

                btn.classList.remove('btn-light-primary', 'text-muted');
                btn.classList.add('active', 'btn-primary', 'text-white');

                activeFilter = btn.getAttribute('data-status') || 'all';
                updateDashboardWidget(true);
            });
        });

        // 2. Manual Refresh Button
        const refreshBtn = document.getElementById('btn_refresh_presence');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', (e) => {
                e.preventDefault();
                updateDashboardWidget(true);
            });
        }

        // 3. Social Interaction: Friend Request Button
        widgetContainer.addEventListener('click', (e) => {
            const friendBtn = e.target.closest('.btn-social-friend-request');
            if (!friendBtn) return;

            e.preventDefault();
            const targetId = friendBtn.getAttribute('data-user-id');
            const targetName = friendBtn.getAttribute('data-user-name') || 'Pengguna';
            const token = getCsrfToken();

            if (!targetId || !token) return;

            // Loading state
            friendBtn.setAttribute('data-kt-indicator', 'on');
            friendBtn.disabled = true;

            fetch(`/user-presence/friend-request/${targetId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    friendBtn.removeAttribute('data-kt-indicator');
                    friendBtn.classList.remove('btn-light-primary', 'btn-active-primary');
                    friendBtn.classList.add('btn-light-success', 'disabled');
                    friendBtn.innerHTML = `
                        <i class="ki-duotone ki-check fs-6 text-success me-1"><span class="path1"></span><span class="path2"></span></i>
                        <span class="indicator-label">Terkirim</span>
                    `;

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Permintaan Terkirim!',
                            text: `Permintaan pertemanan berhasil dikirim ke ${targetName}.`,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Tutup',
                            customClass: {
                                confirmButton: 'btn btn-primary btn-sm'
                            }
                        });
                    } else if (typeof toastr !== 'undefined') {
                        toastr.success(`Permintaan pertemanan terkirim ke ${targetName}`);
                    }
                } else {
                    friendBtn.removeAttribute('data-kt-indicator');
                    friendBtn.disabled = false;
                }
            })
            .catch(() => {
                friendBtn.removeAttribute('data-kt-indicator');
                friendBtn.disabled = false;
            });
        });

        // 4. View Public User Profile Modal (Accessible by all roles)
        widgetContainer.addEventListener('click', (e) => {
            const profileLink = e.target.closest('.btn-view-public-profile');
            if (!profileLink) return;

            e.preventDefault();
            const targetId = profileLink.getAttribute('data-user-id');
            if (!targetId) return;

            const modalEl = document.getElementById('kt_modal_public_user_profile');
            if (!modalEl) return;

            // Fetch public profile data
            fetch(`/user-presence/public-profile/${targetId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.user) {
                    const u = data.user;

                    // Cover styling
                    const coverBg = document.getElementById('pub_user_cover_bg');
                    const coverOverlay = document.getElementById('pub_user_cover_overlay');
                    if (coverBg) {
                        coverBg.style.backgroundImage = `url('${u.cover_bg_url}')`;
                        coverBg.style.backgroundPosition = `center ${u.cover_position_y}%`;
                    }
                    if (coverOverlay) {
                        coverOverlay.style.backgroundColor = u.cover_overlay_color;
                        coverOverlay.style.opacity = u.cover_opacity;
                    }

                    // Avatar
                    const avatarImg = document.getElementById('pub_user_avatar_img');
                    const avatarSymbol = document.getElementById('pub_user_symbol');
                    if (u.has_avatar && avatarImg) {
                        avatarImg.classList.remove('d-none');
                        avatarImg.style.backgroundImage = `url('${u.avatar_url}')`;
                        if (u.avatar_style) {
                            avatarImg.setAttribute('style', u.avatar_style);
                        }
                        if (avatarSymbol) avatarSymbol.classList.add('d-none');
                    } else {
                        if (avatarImg) avatarImg.classList.add('d-none');
                        if (avatarSymbol) {
                            avatarSymbol.classList.remove('d-none');
                            avatarSymbol.textContent = u.initial;
                        }
                    }

                    // Presence dot on modal
                    const dot = document.getElementById('pub_user_presence_dot');
                    const presenceBadge = document.getElementById('pub_user_presence_badge');
                    if (dot && u.presence) {
                        dot.className = `position-absolute bottom-0 end-0 w-16px h-16px rounded-circle ${u.presence.badge_class} border border-3 border-white shadow-xs`;
                    }
                    if (presenceBadge && u.presence) {
                        presenceBadge.className = `badge ${u.presence.badge_class} text-white fw-bold fs-8 px-3 py-1 shadow-xs rounded-pill`;
                        presenceBadge.textContent = u.presence.label;
                    }

                    // Name, Email, Moto
                    const elName = document.getElementById('pub_user_name');
                    const elEmail = document.getElementById('pub_user_email');
                    const elMoto = document.getElementById('pub_user_moto');
                    const elPoints = document.getElementById('pub_user_points');
                    const elJoined = document.getElementById('pub_user_joined');
                    const elRoles = document.getElementById('pub_user_roles');
                    const btnFriend = document.getElementById('pub_user_btn_friend');

                    if (elName) elName.textContent = u.name;
                    if (elEmail) elEmail.textContent = u.email;
                    if (elMoto) elMoto.textContent = `"${u.moto_hidup}"`;
                    if (elPoints) elPoints.textContent = `${u.points} Poin`;
                    if (elJoined) elJoined.textContent = u.joined_at;

                    // Roles badges
                    if (elRoles && Array.isArray(u.roles)) {
                        elRoles.innerHTML = u.roles.map(r => `
                            <span class="badge bg-white bg-opacity-90 text-gray-800 fw-bold fs-8 px-3 py-1 text-uppercase shadow-xs rounded-pill">
                                ${r}
                            </span>
                        `).join('');
                    }

                    // Friend Button setup
                    if (btnFriend) {
                        btnFriend.setAttribute('data-user-id', u.id);
                        btnFriend.setAttribute('data-user-name', u.name);
                        btnFriend.removeAttribute('data-kt-indicator');
                        btnFriend.disabled = false;
                        btnFriend.className = 'btn btn-sm btn-primary fw-bold px-5 btn-social-friend-request';
                        btnFriend.innerHTML = `
                            <i class="ki-duotone ki-user-tick fs-5 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <span class="indicator-label">Tambah Teman</span>
                            <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                        `;
                    }

                    // Show Modal
                    if (typeof bootstrap !== 'undefined') {
                        bootstrap.Modal.getOrCreateInstance(modalEl).show();
                    }
                }
            })
            .catch(err => {
                console.error('Failed to load public profile:', err);
            });
        });

        // Start Dashboard periodic updater
        if (dashboardPollTimer) clearInterval(dashboardPollTimer);
        dashboardPollTimer = setInterval(updateDashboardWidget, DASHBOARD_POLL_INTERVAL_MS);
    };


    // Stop all timers
    const stopTimers = () => {
        if (heartbeatTimer) clearInterval(heartbeatTimer);
        if (idleCheckTimer) clearInterval(idleCheckTimer);
        if (dashboardPollTimer) clearInterval(dashboardPollTimer);
    };

    // Public Initialization
    const init = () => {
        // Initial heartbeat
        sendHeartbeat('online');
        updateSelfIndicator('online');

        // Setup activity listeners
        initActivityListeners();

        // Setup periodic timers
        heartbeatTimer = setInterval(() => sendHeartbeat(currentStatus), HEARTBEAT_INTERVAL_MS);
        idleCheckTimer = setInterval(checkIdleState, 10 * 1000); // Check every 10s

        // Initialize dashboard widget if present
        initDashboardWidget();
    };

    // Auto-init on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    return {
        init: init,
        getStatus: () => currentStatus,
        refreshDashboard: () => updateDashboardWidget(true),
        recordActivity: recordUserActivity,
    };
})();

window.KTUserPresence = KTUserPresence;
