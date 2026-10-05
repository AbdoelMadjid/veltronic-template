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
    const IDLE_TIMEOUT_MS = 5 * 60 * 1000; // 5 minutes without interaction -> Idle
    const HEARTBEAT_INTERVAL_MS = 45 * 1000; // Send heartbeat every 45s
    const DASHBOARD_POLL_INTERVAL_MS = 8 * 1000; // Refresh widget every 8s when on dashboard

    // State variables
    let lastActivityTime = Date.now();
    let currentStatus = 'online'; // 'online' | 'idle' | 'offline'
    let heartbeatTimer = null;
    let idleCheckTimer = null;
    let dashboardPollTimer = null;
    let activeFilter = 'all'; // 'all' | 'online' | 'idle' | 'offline'
    let isRequestInProgress = false;
    let lastSyncedUserHash = '';
    let userSyncChannel = null;

    // Setup Cross-Tab Realtime Broadcast Channel
    try {
        if (typeof BroadcastChannel !== 'undefined') {
            userSyncChannel = new BroadcastChannel('veltronic_user_sync_channel');
            userSyncChannel.onmessage = (event) => {
                if (event.data && event.data.type === 'USER_UPDATED' && event.data.user) {
                    applyGlobalUserUpdate(event.data.user, false);
                }
            };
        }
    } catch (e) {}

    // Fallback Cross-Tab Storage Listener
    window.addEventListener('storage', (e) => {
        if (e.key === 'veltronic_user_sync_event' && e.newValue) {
            try {
                const data = JSON.parse(e.newValue);
                if (data && data.user) {
                    applyGlobalUserUpdate(data.user, false);
                }
            } catch (err) {}
        }
    });

    // Helper: Get CSRF Token
    const getCsrfToken = () => {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    };

    // Apply Global User Profile & Avatar Updates in DOM across All Modules (Zero-Reload Realtime)
    const applyGlobalUserUpdate = (user, broadcast = true) => {
        if (!user || typeof user !== 'object') return;

        const currentHash = JSON.stringify({
            name: user.name,
            email: user.email,
            avatar_url: user.avatar_url,
            avatar_style: user.avatar_style,
            has_avatar: user.has_avatar,
            role: user.role,
            points: user.points
        });

        if (lastSyncedUserHash === currentHash && !broadcast) {
            return;
        }
        lastSyncedUserHash = currentHash;

        // 1. Update Topbar / Navbar Avatar
        const navAvatars = document.querySelectorAll('#header_navbar_user_avatar, .header-navbar-user-avatar');
        navAvatars.forEach(el => {
            if (user.avatar_style) {
                el.style.cssText = user.avatar_style;
            } else if (user.avatar_url) {
                el.style.backgroundImage = `url('${user.avatar_url}')`;
                el.style.backgroundSize = 'cover';
                el.style.backgroundPosition = 'center';
            } else {
                el.style.backgroundImage = '';
            }
        });

        // 2. Update Topbar / Navbar User Name
        const navNames = document.querySelectorAll('#header_navbar_user_name, .header-user-name');
        navNames.forEach(el => {
            if (user.name && el.textContent !== user.name) {
                el.textContent = user.name;
            }
        });

        // 3. Update Topbar / Navbar User Email
        const navEmails = document.querySelectorAll('#header_navbar_user_email, .header-user-email');
        navEmails.forEach(el => {
            if (user.email && el.textContent !== user.email) {
                el.textContent = user.email;
            }
        });

        // 4. Update Lock Screen Avatar & Name (if initialized)
        const lockScreenImg = document.getElementById('lock_screen_avatar_img');
        if (lockScreenImg && user.avatar_url) {
            lockScreenImg.style.backgroundImage = `url('${user.avatar_url}')`;
            if (user.avatar_style) lockScreenImg.style.cssText = user.avatar_style;
        }
        const lockScreenName = document.getElementById('lock_screen_user_name');
        if (lockScreenName && user.name) {
            lockScreenName.textContent = user.name;
        }

        // 5. Update Profile Page Main Header Elements (if on Profile Page)
        const profileHeaderImg = document.getElementById('profile_header_avatar_img');
        if (profileHeaderImg) {
            if (user.avatar_style) {
                profileHeaderImg.style.cssText = user.avatar_style;
            } else if (user.avatar_url) {
                profileHeaderImg.style.backgroundImage = `url('${user.avatar_url}')`;
            }
        }
        const profileHeaderName = document.getElementById('profile_header_user_name');
        if (profileHeaderName && user.name) {
            profileHeaderName.textContent = user.name;
        }

        // 5b. Update Dashboard Hero Header Cover & Avatar (if on Dashboard)
        const heroCoverBg = document.getElementById('hero_dashboard_cover_bg');
        if (heroCoverBg) {
            const coverUrl = (user.settings && user.settings.cover_background_url) ? user.settings.cover_background_url : (user.cover_bg_url || '');
            if (coverUrl) {
                heroCoverBg.style.backgroundImage = `url('${coverUrl}')`;
            }
            if (user.settings && user.settings.cover_position_y !== undefined) {
                heroCoverBg.style.backgroundPosition = `center ${user.settings.cover_position_y}%`;
            }
            if (user.settings && user.settings.cover_blur !== undefined) {
                const blur = parseInt(user.settings.cover_blur) || 0;
                heroCoverBg.style.filter = blur > 0 ? `blur(${blur}px)` : 'none';
            }
        }
        const heroCoverOverlay = document.getElementById('hero_dashboard_cover_overlay');
        if (heroCoverOverlay && user.settings) {
            if (user.settings.cover_overlay_color) heroCoverOverlay.style.backgroundColor = user.settings.cover_overlay_color;
            if (user.settings.cover_opacity !== undefined) heroCoverOverlay.style.opacity = (parseInt(user.settings.cover_opacity) || 60) / 100;
        }
        const heroAvatar = document.getElementById('hero_dashboard_avatar');
        if (heroAvatar) {
            if (user.avatar_style) {
                heroAvatar.style.cssText = user.avatar_style;
            } else if (user.avatar_url) {
                heroAvatar.style.backgroundImage = `url('${user.avatar_url}')`;
            }
        }
        const heroName = document.getElementById('hero_dashboard_user_name');
        if (heroName && user.name) heroName.textContent = user.name;
        const heroMoto = document.getElementById('hero_dashboard_moto_hidup');
        if (heroMoto && (user.moto_hidup || user.bio)) heroMoto.textContent = user.moto_hidup || user.bio;

        // 6. Broadcast to Dashboard Widgets (if on Dashboard)
        updateDashboardWidget(true);

        // 7. Broadcast to Chat (if Chat component active)
        if (window.KTAppCustomChat && typeof window.KTAppCustomChat.refresh === 'function') {
            window.KTAppCustomChat.refresh();
        }

        // 8. Dispatch Local Event for other modular scripts
        window.dispatchEvent(new CustomEvent('kt.user.updated', { detail: user }));

        // 9. Broadcast across Other Browser Tabs / Windows
        if (broadcast) {
            if (userSyncChannel) {
                try {
                    userSyncChannel.postMessage({ type: 'USER_UPDATED', user: user, timestamp: Date.now() });
                } catch (e) {}
            }
            try {
                localStorage.setItem('veltronic_user_sync_event', JSON.stringify({ user: user, timestamp: Date.now() }));
            } catch (e) {}
        }
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
        .then(data => {
            if (data && data.status === 'success' && data.user) {
                const incomingHash = JSON.stringify({
                    name: data.user.name,
                    email: data.user.email,
                    avatar_url: data.user.avatar_url,
                    avatar_style: data.user.avatar_style,
                    has_avatar: data.user.has_avatar,
                    role: data.user.role,
                    points: data.user.points
                });

                if (incomingHash !== lastSyncedUserHash) {
                    applyGlobalUserUpdate(data.user, true);
                }
            }
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
        const isScreenLocked = typeof KTLockScreen !== 'undefined' && KTLockScreen.isLocked ? KTLockScreen.isLocked() : false;

        if (currentStatus === 'online' && (timeSinceLastActivity >= IDLE_TIMEOUT_MS || isScreenLocked)) {
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
                    // Create simple signature to avoid rebuilding DOM if nothing changed
                    const newHash = JSON.stringify(data.users ? data.users.map(u => ({
                        id: u.id,
                        status: u.status,
                        friendStatus: u.friendship_status,
                        lastSeen: u.last_seen_human,
                        avatar: u.avatar_url,
                        style: u.avatar_style,
                        name: u.name
                    })) : data.html);

                    const prevHash = itemsList.getAttribute('data-html-hash');

                    if (manualTrigger || prevHash !== newHash) {
                        // 1. Dispose all active tooltips in itemsList before removing DOM
                        const oldTooltips = itemsList.querySelectorAll('[data-bs-toggle="tooltip"]');
                        oldTooltips.forEach(el => {
                            try {
                                if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                                    const inst = bootstrap.Tooltip.getInstance(el);
                                    if (inst) {
                                        inst.hide();
                                        inst.dispose();
                                    }
                                }
                            } catch (e) {}
                        });

                        // 2. Remove any orphaned tooltip popovers hanging in body
                        document.querySelectorAll('.tooltip[role="tooltip"], body > .tooltip').forEach(t => t.remove());

                        // 3. Update DOM & hash
                        itemsList.innerHTML = data.html;
                        itemsList.setAttribute('data-html-hash', newHash);

                        // 4. Initialize fresh tooltips with strict hover trigger
                        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                            itemsList.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                                new bootstrap.Tooltip(el, {
                                    trigger: 'hover',
                                    boundary: 'clippingParents'
                                });
                            });
                        }
                    }
                }

                // 5. Update Leaderboard Widget (Zero-Reload Realtime)
                if (data.html_leaderboard) {
                    const lbContainer = document.getElementById('dashboard_leaderboard_widget');
                    if (lbContainer) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data.html_leaderboard, 'text/html');
                        const newLb = doc.getElementById('dashboard_leaderboard_widget') || doc.body.firstElementChild;
                        if (newLb) {
                            const newHash = newLb.innerHTML.trim();
                            if (manualTrigger || lbContainer.getAttribute('data-widget-hash') !== newHash) {
                                lbContainer.innerHTML = newLb.innerHTML;
                                lbContainer.setAttribute('data-widget-hash', newHash);
                            }
                        }
                    }
                }

                // 6. Update Live Activity Widget (Zero-Reload Realtime)
                if (data.html_activity) {
                    const actContainer = document.getElementById('dashboard_live_activity_widget');
                    if (actContainer) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data.html_activity, 'text/html');
                        const newAct = doc.getElementById('dashboard_live_activity_widget') || doc.body.firstElementChild;
                        if (newAct) {
                            const newHash = newAct.innerHTML.trim();
                            if (manualTrigger || actContainer.getAttribute('data-widget-hash') !== newHash) {
                                actContainer.innerHTML = newAct.innerHTML;
                                actContainer.setAttribute('data-widget-hash', newHash);
                            }
                        }
                    }
                }

                // 7. Update Community User Cards Grid (Zero-Reload Realtime)
                if (data.html_user_cards && typeof window.KTCommunityUserCardsSync === 'function') {
                    window.KTCommunityUserCardsSync(data.html_user_cards);
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

        // Tab visibility change (kembali aktif saat tab dibuka)
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible') {
                recordUserActivity();
                updateDashboardWidget(false);
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

        // 3. Auto-fetch initial live data & start periodic polling timer (every 8s)
        updateDashboardWidget(false);

        if (dashboardPollTimer) clearInterval(dashboardPollTimer);
        dashboardPollTimer = setInterval(() => {
            if (document.visibilityState === 'visible') {
                updateDashboardWidget(false);
            }
        }, DASHBOARD_POLL_INTERVAL_MS);
    };

    // Public Profile Modal Loader (Global & Accessible by all roles across all pages)
    const openPublicProfile = (targetId) => {
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
                    const textClass = u.presence.badge_text_class || (u.presence.status === 'offline' ? 'text-gray-800' : 'text-white');
                    presenceBadge.className = `badge ${u.presence.badge_class} ${textClass} fw-bold fs-8 px-3 py-1 shadow-xs rounded-pill`;
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

                // Friend Button setup based on friendship status
                if (btnFriend) {
                    btnFriend.setAttribute('data-user-id', u.id);
                    btnFriend.setAttribute('data-user-name', u.name);
                    btnFriend.removeAttribute('data-kt-indicator');

                    if (u.friendship_status === 'accepted') {
                        btnFriend.classList.remove('d-none', 'btn-primary', 'btn-light-warning', 'btn-success', 'btn-social-friend-request');
                        btnFriend.classList.add('btn-light-success', 'disabled');
                        btnFriend.disabled = true;
                        btnFriend.innerHTML = `
                            <i class="ki-duotone ki-verify fs-5 me-1"><span class="path1"></span><span class="path2"></span></i>
                            <span>Berteman</span>
                        `;
                    } else if (u.friendship_status === 'pending_sent') {
                        btnFriend.classList.remove('d-none', 'btn-primary', 'btn-light-success', 'disabled');
                        btnFriend.classList.add('btn-light-warning', 'btn-social-friend-request');
                        btnFriend.disabled = false;
                        btnFriend.innerHTML = `
                            <i class="ki-duotone ki-time fs-5 me-1"><span class="path1"></span><span class="path2"></span></i>
                            <span class="indicator-label">Batalkan Permintaan</span>
                            <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                        `;
                    } else if (u.friendship_status === 'pending_received') {
                        btnFriend.classList.remove('d-none', 'btn-primary', 'btn-light-warning', 'btn-light-success', 'disabled');
                        btnFriend.classList.add('btn-success', 'btn-social-friend-request');
                        btnFriend.disabled = false;
                        btnFriend.innerHTML = `
                            <i class="ki-duotone ki-check-circle fs-5 me-1"><span class="path1"></span><span class="path2"></span></i>
                            <span class="indicator-label">Terima Ajakan</span>
                            <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                        `;
                    } else {
                        btnFriend.classList.remove('d-none', 'btn-light-warning', 'btn-light-success', 'btn-success', 'disabled');
                        btnFriend.classList.add('btn-primary', 'btn-social-friend-request');
                        btnFriend.disabled = false;
                        btnFriend.innerHTML = `
                            <i class="ki-duotone ki-user-tick fs-5 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <span class="indicator-label">Tambah Teman</span>
                            <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                        `;
                    }
                }

                // Chat Button setup
                const btnChat = document.getElementById('pub_user_btn_chat');
                if (btnChat) {
                    btnChat.setAttribute('href', `/profil/profil-pengguna/chat?user=${u.id}`);
                    btnChat.onclick = () => {
                        try {
                            sessionStorage.setItem('veltronic_target_chat_user', u.id);
                        } catch (e) {}
                    };
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
    };

    // Global Friend Request Click Handler (Supports both Widget & Public Profile Modal)
    const initGlobalFriendshipHandler = () => {
        // Handle View Public Profile Click across any page (Dashboard, Chat, Header, etc.)
        document.addEventListener('click', (e) => {
            const profileLink = e.target.closest('.btn-view-public-profile, .btn-open-public-profile, [data-action="view-public-profile"]');
            if (!profileLink) return;

            e.preventDefault();
            const targetId = profileLink.getAttribute('data-user-id');
            if (targetId) {
                openPublicProfile(targetId);
            }
        });
        document.addEventListener('click', (e) => {
            const friendBtn = e.target.closest('.btn-social-friend-request');
            if (!friendBtn) return;

            e.preventDefault();
            const targetId = friendBtn.getAttribute('data-user-id');
            const targetName = friendBtn.getAttribute('data-user-name') || 'Pengguna';
            const token = getCsrfToken();

            if (!targetId || !token) return;

            // Hide tooltip if active
            try {
                if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                    const inst = bootstrap.Tooltip.getInstance(friendBtn);
                    if (inst) inst.hide();
                }
            } catch (e) {}

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
                friendBtn.removeAttribute('data-kt-indicator');
                if (data.status === 'success') {
                    // Update button styling based on new friendship_status
                    if (data.friendship_status === 'pending_sent') {
                        friendBtn.className = 'btn btn-sm btn-light-warning fw-bold px-5 btn-social-friend-request';
                        friendBtn.disabled = false;
                        friendBtn.innerHTML = `
                            <i class="ki-duotone ki-time fs-5 text-warning me-1"><span class="path1"></span><span class="path2"></span></i>
                            <span class="indicator-label">Batalkan Permintaan</span>
                            <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                        `;
                    } else if (data.friendship_status === 'accepted') {
                        friendBtn.className = 'btn btn-sm btn-light-success fw-bold px-5 disabled';
                        friendBtn.disabled = true;
                        friendBtn.innerHTML = `
                            <i class="ki-duotone ki-verify fs-5 text-success me-1"><span class="path1"></span><span class="path2"></span></i>
                            <span>Berteman</span>
                        `;
                    } else {
                        friendBtn.className = 'btn btn-sm btn-primary fw-bold px-5 btn-social-friend-request';
                        friendBtn.disabled = false;
                        friendBtn.innerHTML = `
                            <i class="ki-duotone ki-user-tick fs-5 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <span class="indicator-label">Tambah Teman</span>
                            <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                        `;
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: data.action === 'cancelled' ? 'Dibatalkan' : (data.action === 'accepted' ? 'Berteman!' : 'Permintaan Terkirim!'),
                            text: data.message,
                            icon: 'success',
                            buttonsStyling: false,
                            confirmButtonText: 'Tutup',
                            customClass: {
                                confirmButton: 'btn btn-primary btn-sm'
                            }
                        });
                    } else if (typeof toastr !== 'undefined') {
                        toastr.success(data.message);
                    }

                    // Sync Topbar Notifications live
                    if (window.KTAppNotifications) {
                        window.KTAppNotifications.refresh();
                    }

                    // Refresh Dashboard widget items
                    updateDashboardWidget(true);
                } else {
                    friendBtn.disabled = false;
                    if (typeof toastr !== 'undefined') {
                        toastr.error(data.message || 'Gagal memproses permintaan pertemanan.');
                    }
                }
            })
            .catch(err => {
                console.error('Friend request error:', err);
                friendBtn.removeAttribute('data-kt-indicator');
                friendBtn.disabled = false;
            });
        });
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

        // Setup global friendship interaction
        initGlobalFriendshipHandler();

        // Setup periodic timers
        heartbeatTimer = setInterval(() => sendHeartbeat(currentStatus), HEARTBEAT_INTERVAL_MS);
        idleCheckTimer = setInterval(checkIdleState, 10 * 1000); // Check every 10s

        // Initialize dashboard widget if present
        initDashboardWidget();

        // Realtime update on profile/avatar changes
        window.addEventListener('kt.user.updated', () => {
            updateDashboardWidget(true);
        });
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
        openPublicProfile: openPublicProfile,
        syncUserProfile: (userData, broadcast = true) => applyGlobalUserUpdate(userData, broadcast),
        broadcastUserUpdate: (userData) => applyGlobalUserUpdate(userData, true),
    };
})();

window.KTUserPresence = KTUserPresence;
