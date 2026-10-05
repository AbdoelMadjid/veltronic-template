/**
 * Universal App Notifications & Realtime Feed Module
 * Veltronic Template - Metronic 8
 * 
 * Manages topbar notification bell, live badge counters,
 * and category-based quick actions (Friendship, Security, Chat, System).
 */
"use strict";

const KTAppNotifications = (function () {
    const POLL_INTERVAL_MS = 20 * 1000; // Poll every 20 seconds
    let pollTimer = null;
    let isRequestInProgress = false;

    // Helper: Get CSRF Token
    const getCsrfToken = () => {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    };

    // Helper: Escape HTML
    const escapeHtml = (str) => {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    };

    // Update Topbar Bell Indicators & Tab Badges
    const updateBadges = (stats, unreadTotal) => {
        const pulseDot = document.getElementById('app_notification_pulse_dot');
        const unreadBadge = document.getElementById('app_notification_unread_badge');
        const headerBadge = document.getElementById('notif_header_badge');
        const headerBadgeV2 = document.getElementById('notif_header_badge_v2');

        const friendsBadge = document.getElementById('notif_tab_count_friends');
        const securityBadge = document.getElementById('notif_tab_count_security');
        const chatBadge = document.getElementById('notif_tab_count_chat');

        const friendsBadgeV2 = document.getElementById('notif_tab_count_friends_v2');
        const securityBadgeV2 = document.getElementById('notif_tab_count_security_v2');
        const chatBadgeV2 = document.getElementById('notif_tab_count_chat_v2');

        // 1. Topbar Bell Indicator
        if (unreadTotal > 0) {
            if (pulseDot) pulseDot.classList.remove('d-none');
            if (unreadBadge) {
                unreadBadge.classList.remove('d-none');
                unreadBadge.textContent = unreadTotal > 99 ? '99+' : unreadTotal;
            }
        } else {
            if (pulseDot) pulseDot.classList.add('d-none');
            if (unreadBadge) unreadBadge.classList.add('d-none');
        }

        // 2. Dropdown Header Text
        const headerText = `${unreadTotal} belum dibaca`;
        if (headerBadge) headerBadge.textContent = headerText;
        if (headerBadgeV2) headerBadgeV2.textContent = headerText;

        // 3. Tab Specific Badges
        const updateTabBadge = (el, count) => {
            if (!el) return;
            if (count > 0) {
                el.classList.remove('d-none');
                el.textContent = count > 99 ? '99+' : count;
            } else {
                el.classList.add('d-none');
            }
        };

        if (stats) {
            updateTabBadge(friendsBadge, stats.friendship);
            updateTabBadge(securityBadge, stats.security);
            updateTabBadge(chatBadge, stats.chat);

            updateTabBadge(friendsBadgeV2, stats.friendship);
            updateTabBadge(securityBadgeV2, stats.security);
            updateTabBadge(chatBadgeV2, stats.chat);
        }
    };

    // Render HTML for a Single Notification Item
    const renderNotificationItem = (item) => {
        const isUnread = !item.is_read;
        const unreadClass = isUnread ? 'bg-light-subtle border-start border-3 border-primary ps-3' : '';
        const unreadDot = isUnread ? '<span class="bullet bullet-dot bg-primary h-6px w-6px ms-2"></span>' : '';

        // Symbol / Icon rendering
        let symbolHtml = '';
        if (item.category === 'friendship' && item.data && item.data.sender_avatar) {
            symbolHtml = `
                <div class="symbol symbol-40px me-3 flex-shrink-0">
                    <div class="symbol-label rounded-3 shadow-xs border border-2 border-body" style="background-image: url('${escapeHtml(item.data.sender_avatar)}'); background-size: cover; background-position: center;"></div>
                </div>
            `;
        } else {
            symbolHtml = `
                <div class="symbol symbol-40px me-3 flex-shrink-0">
                    <span class="symbol-label bg-light-${escapeHtml(item.color || 'primary')} text-${escapeHtml(item.color || 'primary')} rounded-3">
                        <i class="ki-duotone ${escapeHtml(item.icon || 'ki-notification-status')} fs-2 text-${escapeHtml(item.color || 'primary')}">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                        </i>
                    </span>
                </div>
            `;
        }

        // Action Buttons Rendering (e.g. Friendship Accept/Decline)
        let actionsHtml = '';
        if (item.category === 'friendship' && item.type === 'friend_request') {
            if (item.action_state === 'accepted') {
                actionsHtml = `
                    <div class="d-flex align-items-center gap-1 mt-2">
                        <span class="badge badge-light-success fw-bold fs-9 py-1 px-2 rounded-pill">
                            <i class="ki-duotone ki-check fs-8 text-success me-1"><span class="path1"></span><span class="path2"></span></i>
                            Sudah Berteman
                        </span>
                    </div>
                `;
            } else if (item.action_state === 'declined') {
                actionsHtml = `
                    <div class="d-flex align-items-center gap-1 mt-2">
                        <span class="badge badge-light-danger fw-bold fs-9 py-1 px-2 rounded-pill">
                            Permintaan Ditolak
                        </span>
                    </div>
                `;
            } else {
                actionsHtml = `
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <button type="button" class="btn btn-xs btn-success fw-bold py-1 px-3 btn-notif-action" data-id="${item.id}" data-action="accept">
                            <span class="indicator-label">Terima</span>
                            <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                        </button>
                        <button type="button" class="btn btn-xs btn-light-danger fw-bold py-1 px-3 btn-notif-action" data-id="${item.id}" data-action="decline">
                            <span class="indicator-label">Tolak</span>
                            <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                        </button>
                    </div>
                `;
            }
        } else if (item.category === 'chat' && item.action_url) {
            actionsHtml = `
                <div class="mt-2">
                    <a href="${escapeHtml(item.action_url)}" class="btn btn-xs btn-light-info fw-bold py-1 px-3">
                        <i class="ki-duotone ki-messages fs-8 text-info me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                        Buka Chat
                    </a>
                </div>
            `;
        } else if (item.action_url) {
            actionsHtml = `
                <div class="mt-2">
                    <a href="${escapeHtml(item.action_url)}" class="btn btn-xs btn-light-primary fw-bold py-1 px-3">
                        Lihat Rincian
                    </a>
                </div>
            `;
        }

        return `
            <div class="d-flex align-items-start justify-content-between py-3 border-bottom border-gray-100 ${unreadClass} notif-row-item cursor-pointer" 
                 id="notif_item_${item.id}" data-id="${item.id}" data-is-unread="${isUnread ? '1' : '0'}" data-category="${escapeHtml(item.category || '')}" data-type="${escapeHtml(item.type || '')}">
                <div class="d-flex align-items-start min-w-0 flex-grow-1 me-2">
                    ${symbolHtml}
                    <div class="d-flex flex-column min-w-0 flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            ${item.action_url 
                                ? `<a href="${escapeHtml(item.action_url)}" class="text-gray-900 text-hover-primary fw-bolder fs-7 text-truncate text-decoration-none">${escapeHtml(item.title)}</a>`
                                : `<span class="text-gray-900 fw-bolder fs-7 text-truncate">${escapeHtml(item.title)}</span>`
                            }
                            ${unreadDot}
                        </div>
                        <p class="text-gray-600 fs-8 mb-1 lh-sm">${escapeHtml(item.message)}</p>
                        <span class="text-muted fs-9">${escapeHtml(item.created_at_human)}</span>
                        ${actionsHtml}
                    </div>
                </div>
            </div>
        `;
    };

    // Render Lists for each Tab
    const renderFeed = (items) => {
        const renderContainer = (containerId, list, emptyMsg, emptyIcon) => {
            const container = document.getElementById(containerId);
            if (!container) return;

            if (!list || list.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-10 px-4">
                        <div class="symbol symbol-45px symbol-circle bg-light-primary mb-3">
                            <i class="ki-duotone ${emptyIcon || 'ki-notification-status'} fs-2 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                        </div>
                        <div class="fw-bold text-gray-800 fs-7 mb-1">${emptyMsg || 'Belum Ada Pemberitahuan'}</div>
                        <p class="text-muted fs-8 mb-0">Pemberitahuan baru akan tampil otomatis di sini.</p>
                    </div>
                `;
            } else {
                container.innerHTML = list.map(renderNotificationItem).join('');
            }
        };

        if (items) {
            renderContainer('notif_list_all', items.all, 'Belum Ada Pemberitahuan', 'ki-notification-status');
            renderContainer('notif_list_friendship', items.friendship, 'Tidak Ada Permintaan Pertemanan', 'ki-people');
            renderContainer('notif_list_security', items.security, 'Tidak Ada Notifikasi Keamanan', 'ki-shield-tick');
            renderContainer('notif_list_chat', items.chat, 'Belum Ada Pesan Masuk', 'ki-messages');

            renderContainer('notif_list_all_v2', items.all, 'Belum Ada Pemberitahuan', 'ki-notification-status');
            renderContainer('notif_list_friendship_v2', items.friendship, 'Tidak Ada Permintaan Pertemanan', 'ki-people');
            renderContainer('notif_list_security_v2', items.security, 'Tidak Ada Notifikasi Keamanan', 'ki-shield-tick');
            renderContainer('notif_list_chat_v2', items.chat, 'Belum Ada Pesan Masuk', 'ki-messages');
        }
    };

    // Fetch Notification Feed via AJAX
    const fetchNotifications = (silent = false) => {
        if (isRequestInProgress && !silent) return;
        isRequestInProgress = true;

        fetch('/notifications/feed', {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        })
        .then(data => {
            if (data.status === 'success') {
                updateBadges(data.stats, data.unread_total);
                renderFeed(data.items);
            }
        })
        .catch(err => {
            // Graceful network catch
        })
        .finally(() => {
            isRequestInProgress = false;
        });
    };

    // Mark Single Notification as Read
    const markSingleAsRead = (notificationId) => {
        const token = getCsrfToken();
        if (!notificationId || !token) return;

        // Instant optimistic UI cleanup
        const notifRow = document.getElementById(`notif_item_${notificationId}`);
        if (notifRow) {
            notifRow.setAttribute('data-is-unread', '0');
            notifRow.classList.remove('bg-light-subtle', 'border-start', 'border-3', 'border-primary', 'ps-3');
            const dot = notifRow.querySelector('.bullet-dot');
            if (dot) dot.remove();
        }

        fetch(`/notifications/${notificationId}/read`, {
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
            if (data.status === 'success' && data.stats) {
                updateBadges(data.stats, data.unread_total);
            }
        })
        .catch(() => {});
    };

    // Mark All as Read Action
    const markAllAsRead = () => {
        const token = getCsrfToken();
        if (!token) return;

        fetch('/notifications/mark-all-read', {
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
                updateBadges({ friendship: 0, security: 0, chat: 0, system: 0 }, 0);
                fetchNotifications(true);
            }
        })
        .catch(() => {});
    };

    // Handle Inline Quick Action (Accept / Decline)
    const handleAction = (notificationId, action, buttonEl) => {
        const token = getCsrfToken();
        if (!notificationId || !action || !token) return;

        if (buttonEl) {
            buttonEl.setAttribute('data-kt-indicator', 'on');
            buttonEl.disabled = true;
        }

        fetch(`/notifications/${notificationId}/action`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ action: action })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                if (data.stats) {
                    updateBadges(data.stats, data.unread_total);
                }
                fetchNotifications(true);
                // Refresh presence widget on dashboard if active
                if (window.KTUserPresence && window.KTUserPresence.refreshDashboard) {
                    window.KTUserPresence.refreshDashboard();
                }

                if (typeof toastr !== 'undefined') {
                    if (action === 'accept') toastr.success(data.message || 'Permintaan pertemanan diterima!');
                    else toastr.info(data.message || 'Permintaan pertemanan ditolak.');
                }
            }
        })
        .catch(() => {
            if (buttonEl) {
                buttonEl.removeAttribute('data-kt-indicator');
                buttonEl.disabled = false;
            }
        });
    };

    // Auto-mark informative unread notifications (e.g. friend_accepted) when panel is opened
    const autoMarkInformativeRead = () => {
        const unreadItems = document.querySelectorAll('.notif-row-item[data-is-unread="1"]');
        unreadItems.forEach(itemEl => {
            const type = itemEl.getAttribute('data-type');
            const category = itemEl.getAttribute('data-category');
            const id = itemEl.getAttribute('data-id');

            // Automatically clear informational notifications when viewed in panel
            if (type === 'friend_accepted' || category === 'system' || category === 'security') {
                if (id) {
                    markSingleAsRead(parseInt(id, 10));
                }
            }
        });
    };

    // Initialize Event Listeners
    const initEvents = () => {
        // Mark All Read Button
        ['btn_mark_all_read', 'btn_mark_all_read_v2'].forEach(id => {
            const btn = document.getElementById(id);
            if (btn) {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    markAllAsRead();
                });
            }
        });

        // Delegate Click on Action Buttons (Accept / Decline) inside notification dropdowns
        document.addEventListener('click', (e) => {
            const actionBtn = e.target.closest('.btn-notif-action');
            if (actionBtn) {
                e.preventDefault();
                e.stopPropagation();
                const notifId = actionBtn.getAttribute('data-id');
                const action = actionBtn.getAttribute('data-action');
                if (notifId && action) {
                    handleAction(notifId, action, actionBtn);
                }
                return;
            }

            // Click on any unread notification row -> Mark as read
            const notifRow = e.target.closest('.notif-row-item');
            if (notifRow && notifRow.getAttribute('data-is-unread') === '1') {
                const notifId = notifRow.getAttribute('data-id');
                if (notifId) {
                    markSingleAsRead(parseInt(notifId, 10));
                }
            }

            // Detect opening notification menu
            const notifToggle = e.target.closest('#kt_header_notifications_toggle, [data-kt-menu-trigger="click"]');
            if (notifToggle) {
                setTimeout(autoMarkInformativeRead, 500);
            }
        });

        // Tab click inside notification dropdown -> Auto mark viewed informative notifications
        document.querySelectorAll('#kt_menu_notifications .nav-link, #kt_menu_notifications_v2 .nav-link').forEach(tab => {
            tab.addEventListener('shown.bs.tab', () => {
                setTimeout(autoMarkInformativeRead, 300);
            });
        });
    };

    // Initialize Module
    const init = () => {
        initEvents();
        fetchNotifications();

        // Start periodic background polling
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = setInterval(() => fetchNotifications(true), POLL_INTERVAL_MS);
    };

    // Auto-init on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    return {
        init: init,
        refresh: () => fetchNotifications(true),
        markAllRead: markAllAsRead,
    };
})();

window.KTAppNotifications = KTAppNotifications;
