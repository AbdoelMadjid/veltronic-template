/**
 * Veltronic Messenger & Private Chat System
 * Interactive Features: Reply, Edit, Forward, Pin, Delete, Emoji Reactions & Emoticon Picker
 * Zero-Reload Realtime CRUD & Metronic Standards Compliant
 */
const KTAppCustomChat = (() => {
    let activeUserId = null;
    let pollConversationTimer = null;
    let pollContactsTimer = null;
    let isSending = false;
    let currentReplyingTo = null; // { id, sender_name, message }
    let currentEditingMessage = null; // { id, message }
    let cachedContacts = [];

    const COLOR_CLASSES = [
        { bg: 'bg-light-danger', text: 'text-danger' },
        { bg: 'bg-light-primary', text: 'text-primary' },
        { bg: 'bg-light-success', text: 'text-success' },
        { bg: 'bg-light-warning', text: 'text-warning' },
        { bg: 'bg-light-info', text: 'text-info' }
    ];

    const POPULAR_EMOJIS = [
        '😀','😃','😄','😁','😆','😅','😂','🤣','🙂','🙃','😉','😊','😇','🥰','😍','🤩','😘','😋','😜','🤪',
        '🤑','🤗','🤔','🤐','🤨','😐','😏','😒','🙄','😬','😌','😔','😴','😷','🥵','🥶','🥴','😵','🥳','😎',
        '🤓','🧐','🥺','😢','😭','😱','😡','🤬','💀','💩','🤡','👻','👽','🤖','👏','👍','👎','👊','✊','🤛',
        '🤜','🤞','✌','🤟','🤘','👌','🤏','👈','👉','👆','👇','✋','👋','🤙','💪','🙏','🤝','❤️','🧡','💛',
        '💚','💙','💜','🖤','🤍','💔','❣️','💕','💖','🔥','⭐','✨','💥','💯','🎉','🚀','☕','🍕','🍔','🏆'
    ];

    const QUICK_REACTIONS = ['👍', '❤️', '😂', '😮', '😢', '🙏', '🔥', '🎉'];

    const getColorForId = (id) => {
        const index = Math.abs(parseInt(id, 10) || 0) % COLOR_CLASSES.length;
        return COLOR_CLASSES[index];
    };

    // Helper: CSRF Token & Cookie
    const getCsrfToken = () => {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
               document.querySelector('input[name="_token"]')?.value || '';
    };

    const getXsrfCookie = () => {
        const value = `; ${document.cookie}`;
        const parts = value.split('; XSRF-TOKEN=');
        if (parts.length === 2) return decodeURIComponent(parts.pop().split(';').shift());
        return '';
    };

    const getHeaders = (isJson = false) => {
        const token = getCsrfToken();
        const headers = {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        };
        const xsrf = getXsrfCookie();
        if (xsrf) headers['X-XSRF-TOKEN'] = xsrf;
        if (isJson) headers['Content-Type'] = 'application/json';
        return headers;
    };

    // Helper: Escape HTML
    const escapeHtml = (text) => {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    };

    // Helper: Build avatar HTML according to project standards
    const buildAvatarHtml = (user, sizeClass = 'symbol-45px', isCircle = true) => {
        const color = getColorForId(user.id || user.sender_id || 1);
        const circleClass = isCircle ? 'symbol-circle' : 'rounded-3';
        const hasAvatar = user.has_avatar || user.sender_has_avatar;
        const avatarStyle = user.avatar_style || user.sender_avatar_style;
        const avatarUrl = user.avatar_url || user.sender_avatar;
        const initial = user.initial || user.sender_initial || 'U';

        let innerHtml = '';
        if (hasAvatar && avatarStyle) {
            innerHtml = `<div class="symbol-label shadow-xs border border-2 border-body ${circleClass}" style="${avatarStyle}"></div>`;
        } else if (hasAvatar && avatarUrl && !avatarUrl.includes('blank.svg')) {
            innerHtml = `<div class="symbol-label shadow-xs border border-2 border-body ${circleClass}" style="background-image: url('${avatarUrl}'); background-size: cover; background-position: center;"></div>`;
        } else {
            innerHtml = `<span class="symbol-label ${color.bg} ${color.text} fs-6 fw-bolder shadow-xs border border-2 border-body ${circleClass}">${escapeHtml(initial)}</span>`;
        }

        return innerHtml;
    };

    // Get pre-selected user ID from sessionStorage or fallback URL parameter (and clean URL)
    const getTargetInitialUserId = () => {
        let targetId = null;
        try {
            targetId = sessionStorage.getItem('veltronic_target_chat_user');
            if (targetId) {
                sessionStorage.removeItem('veltronic_target_chat_user');
                return parseInt(targetId, 10);
            }
        } catch (e) {}

        const params = new URLSearchParams(window.location.search);
        const u = params.get('user');
        if (u) {
            try {
                window.history.replaceState(null, '', window.location.pathname);
            } catch (e) {}
            return parseInt(u, 10);
        }

        return null;
    };

    // Auto-scroll chat thread to bottom
    const scrollToBottom = (smooth = true) => {
        const scrollContainer = document.getElementById('chat_messages_scroll');
        if (scrollContainer) {
            setTimeout(() => {
                scrollContainer.scrollTo({
                    top: scrollContainer.scrollHeight,
                    behavior: smooth ? 'smooth' : 'auto'
                });
            }, 50);
        }
    };

    // Scroll to a specific message bubble with highlight animation
    const scrollToMessage = (msgId) => {
        const targetBubble = document.querySelector(`.chat-bubble-container[data-message-id="${msgId}"]`);
        if (targetBubble) {
            targetBubble.scrollIntoView({ behavior: 'smooth', block: 'center' });
            targetBubble.classList.add('bg-light-warning', 'p-2', 'rounded-3');
            setTimeout(() => {
                targetBubble.classList.remove('bg-light-warning', 'p-2', 'rounded-3');
            }, 2000);
        }
    };

    // Render Reaction Badges
    const renderReactionsBadges = (reactions, messageId) => {
        if (!reactions || !Array.isArray(reactions) || reactions.length === 0) {
            return '';
        }

        const badgesHtml = reactions.map(r => `
            <span class="badge ${r.user_reacted ? 'badge-primary active' : 'badge-light'} border border-gray-300 fs-8 py-1 px-2 rounded-pill reaction-badge btn-toggle-reaction me-1 mb-1"
                  data-message-id="${messageId}" data-emoji="${escapeHtml(r.emoji)}" title="Reaksi: ${escapeHtml(r.emoji)} (${r.count})">
                ${escapeHtml(r.emoji)} <span class="fs-9 ms-1">${r.count}</span>
            </span>
        `).join('');

        return `<div class="d-flex flex-wrap align-items-center mt-1">${badgesHtml}</div>`;
    };

    // Render a single message bubble
    const renderMessageBubble = (msg) => {
        const isSender = msg.is_sender;
        const avatarHtml = buildAvatarHtml(msg, 'symbol-35px', true);

        // Attachment HTML
        let attachmentHtml = '';
        if (msg.attachment_url) {
            const fileName = msg.attachment_name || (msg.attachment_type === 'image' ? 'Foto Lampiran.jpg' : 'Berkas Lampiran');

            if (msg.attachment_type === 'image') {
                attachmentHtml = `
                    <div class="${msg.message && msg.message !== '[Foto Lampiran]' && msg.message !== '[Berkas Lampiran]' ? 'mb-2' : ''}">
                        <div class="cursor-pointer d-inline-block overflow-hidden rounded-3 border border-gray-300 shadow-xs hover-elevate-up transition-all chat-image-preview-trigger"
                             data-img-url="${msg.attachment_url}"
                             data-img-name="${escapeHtml(fileName)}"
                             data-img-time="${escapeHtml(msg.time || '')}"
                             data-img-sender="${escapeHtml(isSender ? 'Anda' : msg.sender_name)}"
                             title="Klik untuk melihat pratinjau & mengunduh foto">
                            <img src="${msg.attachment_url}" alt="${escapeHtml(fileName)}" class="mw-100 mh-200px object-fit-cover d-block" />
                        </div>
                    </div>
                `;
            } else {
                attachmentHtml = `
                    <div class="${msg.message && msg.message !== '[Foto Lampiran]' && msg.message !== '[Berkas Lampiran]' ? 'mb-2' : ''}">
                        <a href="${msg.attachment_url}" target="_blank" download class="d-flex align-items-center gap-2 p-2 bg-white bg-opacity-75 rounded-3 border border-gray-300 text-gray-800 text-hover-primary text-decoration-none">
                            <i class="ki-duotone ki-file fs-2 text-primary"><span class="path1"></span><span class="path2"></span></i>
                            <span class="fs-8 fw-bold text-truncate mw-200px">${escapeHtml(fileName)}</span>
                            <i class="ki-duotone ki-down-square fs-4 text-muted ms-auto"><span class="path1"></span><span class="path2"></span></i>
                        </a>
                    </div>
                `;
            }
        }

        // Quoted Reply Box (with image thumbnail if replying to a photo)
        let replyQuoteHtml = '';
        if (msg.reply_to) {
            let replyMediaHtml = '';
            if (msg.reply_to.attachment_url && msg.reply_to.attachment_type === 'image') {
                replyMediaHtml = `
                    <div class="rounded-2 overflow-hidden flex-shrink-0 ms-2 border border-gray-300 shadow-xs" style="width: 38px; height: 38px; min-width: 38px;">
                        <img src="${msg.reply_to.attachment_url}" alt="Foto" class="object-fit-cover w-100 h-100 d-block" />
                    </div>
                `;
            }

            const replyTextDisplay = (msg.reply_to.message && msg.reply_to.message !== '[Foto Lampiran]' && msg.reply_to.message !== '[Berkas Lampiran]')
                ? msg.reply_to.message
                : (msg.reply_to.attachment_type === 'image' ? 'Foto' : (msg.reply_to.attachment_name || 'Berkas Lampiran'));

            replyQuoteHtml = `
                <div class="p-2 mb-2 rounded bg-white bg-opacity-75 border-start border-3 border-primary text-start cursor-pointer hover-bg-opacity-100 btn-jump-to-reply shadow-xs d-flex align-items-center justify-content-between gap-2"
                     data-reply-id="${msg.reply_to.id}" title="Klik untuk melompat ke pesan asli">
                    <div class="overflow-hidden flex-grow-1">
                        <div class="fs-9 fw-bold text-primary mb-0">${escapeHtml(msg.reply_to.sender_name)}</div>
                        <div class="fs-8 text-gray-700 text-truncate mw-200px mw-sm-300px">${escapeHtml(replyTextDisplay)}</div>
                    </div>
                    ${replyMediaHtml}
                </div>
            `;
        }

        // Forwarded badge
        const forwardedHtml = msg.is_forwarded ? `
            <div class="fs-9 text-muted fst-italic mb-1 d-flex align-items-center gap-1">
                <i class="ki-duotone ki-share fs-8 text-muted"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                Diteruskan
            </div>
        ` : '';

        // Edited indicator
        const editedHtml = msg.is_edited ? `<span class="text-muted fs-8 fst-italic ms-1" title="Pesan telah diedit">(diedit)</span>` : '';

        // Pinned badge indicator
        const pinnedBadgeHtml = msg.is_pinned ? `<i class="ki-duotone ki-pin fs-6 text-warning ms-1" title="Pesan Disematkan"><span class="path1"></span><span class="path2"></span></i>` : '';

        // Reactions
        const reactionsHtml = renderReactionsBadges(msg.reactions, msg.id);

        // Check whether there is actual message text (not empty and not redundant placeholder)
        const hasMessageText = Boolean(msg.message && msg.message.trim() !== '' && msg.message !== '[Foto Lampiran]' && msg.message !== '[Berkas Lampiran]');
        const messageTextHtml = hasMessageText ? `<div class="text-break message-body-text ${msg.attachment_url ? 'mt-2' : ''}" style="white-space: pre-wrap;">${escapeHtml(msg.message)}</div>` : '';
        const safeActionText = hasMessageText ? msg.message : (msg.attachment_type === 'image' ? 'Foto' : (msg.attachment_name || 'Berkas'));

        // Bootstrap 5 Native Dropdown Menu (Matches user image exactly with fixed popper strategy)
        const contextMenuHtml = `
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-sm btn-icon btn-white bg-body text-gray-600 btn-active-color-primary shadow-xs rounded-circle w-28px h-28px border border-gray-200"
                        data-bs-toggle="dropdown" data-bs-popper-config='{"strategy":"fixed"}' aria-expanded="false" data-bs-offset="0,4" title="Pilihan Pesan">
                    <i class="ki-duotone ki-dots-vertical fs-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border border-gray-200 py-2 rounded-3 z-index-3 bg-body" style="min-width: 160px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 px-4 fs-7 fw-semibold text-gray-800 btn-msg-action-reply" href="javascript:void(0)"
                           data-message-id="${msg.id}" data-sender-name="${escapeHtml(isSender ? 'Anda' : msg.sender_name)}" data-message-text="${escapeHtml(safeActionText)}"
                           data-attachment-url="${escapeHtml(msg.attachment_url || '')}" data-attachment-type="${escapeHtml(msg.attachment_type || '')}">
                            <i class="ki-duotone ki-arrow-left fs-5 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                            Balas
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 px-4 fs-7 fw-semibold text-gray-800 btn-msg-action-edit" href="javascript:void(0)"
                           data-message-id="${msg.id}" data-message-text="${escapeHtml(hasMessageText ? msg.message : '')}">
                            <i class="ki-duotone ki-pencil fs-5 text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                            Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 px-4 fs-7 fw-semibold text-gray-800 btn-msg-action-forward" href="javascript:void(0)"
                           data-message-id="${msg.id}" data-message-text="${escapeHtml(safeActionText)}">
                            <i class="ki-duotone ki-share fs-5 text-info me-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                            Teruskan
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 px-4 fs-7 fw-semibold text-gray-800 btn-msg-action-pin" href="javascript:void(0)"
                           data-message-id="${msg.id}">
                            <i class="ki-duotone ki-pin fs-5 text-warning me-3"><span class="path1"></span><span class="path2"></span></i>
                            ${msg.is_pinned ? 'Lepas Pin' : 'Pin'}
                        </a>
                    </li>
                    <li><hr class="dropdown-divider my-1 border-gray-200"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 px-4 fs-7 fw-semibold text-danger btn-msg-action-delete" href="javascript:void(0)"
                           data-message-id="${msg.id}">
                            <i class="ki-duotone ki-trash fs-5 text-danger me-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            Hapus
                        </a>
                    </li>
                </ul>
            </div>
        `;

        const reactionBtnHtml = `
            <button type="button" class="btn btn-sm btn-icon btn-white bg-body text-gray-500 hover-color-primary shadow-xs rounded-circle w-28px h-28px border border-gray-200 btn-open-reaction-picker"
                    data-message-id="${msg.id}" title="Beri Reaksi Emoticon">
                <i class="ki-duotone ki-emoji-happy fs-4 text-gray-600"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
            </button>
        `;

        if (isSender) {
            return `
                <div class="d-flex justify-content-end mb-10 chat-bubble-container" data-message-id="${msg.id}">
                    <div class="d-flex flex-column align-items-end position-relative mw-lg-500px">
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-3">
                                <span class="text-muted fs-7 mb-1">${escapeHtml(msg.time)}</span>
                                ${pinnedBadgeHtml}
                                <a href="javascript:void(0)" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">Anda</a>
                            </div>
                            <div class="symbol symbol-35px symbol-circle">
                                ${avatarHtml}
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-row-reverse w-100">
                            <div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-450px text-end position-relative shadow-xs text-break" data-kt-element="message-text" style="word-break: break-word; overflow-wrap: anywhere;">
                                ${forwardedHtml}
                                ${replyQuoteHtml}
                                ${attachmentHtml}
                                ${messageTextHtml}
                                ${editedHtml}
                            </div>
                            <div class="d-flex flex-column align-items-center gap-1 position-relative">
                                ${contextMenuHtml}
                                ${reactionBtnHtml}
                            </div>
                        </div>
                        ${reactionsHtml}
                    </div>
                </div>
            `;
        } else {
            return `
                <div class="d-flex justify-content-start mb-10 chat-bubble-container" data-message-id="${msg.id}">
                    <div class="d-flex flex-column align-items-start position-relative mw-lg-500px">
                        <div class="d-flex align-items-center mb-2">
                            <div class="symbol symbol-35px symbol-circle">
                                ${avatarHtml}
                            </div>
                            <div class="ms-3">
                                <a href="javascript:void(0)" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">${escapeHtml(msg.sender_name)}</a>
                                <span class="text-muted fs-7 mb-1">${escapeHtml(msg.time)}</span>
                                ${pinnedBadgeHtml}
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 w-100">
                            <div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-450px text-start position-relative shadow-xs text-break" data-kt-element="message-text" style="word-break: break-word; overflow-wrap: anywhere;">
                                ${forwardedHtml}
                                ${replyQuoteHtml}
                                ${attachmentHtml}
                                ${messageTextHtml}
                                ${editedHtml}
                            </div>
                            <div class="d-flex flex-column align-items-center gap-1 position-relative">
                                ${contextMenuHtml}
                                ${reactionBtnHtml}
                            </div>
                        </div>
                        ${reactionsHtml}
                    </div>
                </div>
            `;
        }
    };

    // Render Contact Item for Sidebar (Matches Metronic + Veltronic Standards)
    const renderContactItem = (contact, isOther = false) => {
        const isActive = activeUserId === contact.id;
        const presence = contact.presence || {};
        const isOnline = presence.status === 'online';
        const avatarInnerHtml = buildAvatarHtml(contact, 'symbol-45px', true);

        const lastMsgText = contact.last_message 
            ? ((contact.last_message.is_sender ? 'Anda: ' : '') + contact.last_message.text) 
            : contact.email;
        const lastMsgTime = contact.last_message 
            ? contact.last_message.time 
            : (isOnline ? '<span class="badge badge-light-success fs-9 py-0 px-2 rounded-pill">Online</span>' : '');
        const unreadBadge = contact.unread_count > 0 ? `
            <span class="badge badge-sm badge-circle badge-light-success">${contact.unread_count}</span>
        ` : '';

        return `
            <div class="d-flex flex-stack py-3 px-3 rounded cursor-pointer chat-contact-item transition-all ${isActive ? 'bg-light-primary' : 'bg-hover-light'}"
                data-user-id="${contact.id}" data-user-name="${escapeHtml(contact.name)}" style="cursor: pointer;">
                <div class="d-flex align-items-center overflow-hidden pointer-events-none">
                    <div class="symbol symbol-45px symbol-circle position-relative flex-shrink-0">
                        ${avatarInnerHtml}
                        ${isOnline ? '<div class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>' : ''}
                    </div>
                    <div class="ms-4 overflow-hidden text-start">
                        <span class="fs-6 fw-bold text-gray-900 text-hover-primary mb-1 d-block text-truncate ${isActive ? 'text-primary' : ''}">${escapeHtml(contact.name)}</span>
                        <div class="fs-8 fw-semibold text-muted text-truncate ${contact.unread_count > 0 ? 'fw-bold text-gray-800' : ''}">${escapeHtml(lastMsgText)}</div>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-end ms-2 flex-shrink-0 pointer-events-none">
                    <span class="text-muted fs-8 mb-1">${lastMsgTime}</span>
                    ${unreadBadge}
                </div>
            </div>
            <div class="separator separator-dashed my-1"></div>
        `;
    };

    // Load and render contacts list
    const loadContacts = (searchQuery = '', autoSelectUserId = null, silent = false) => {
        const contactsContainer = document.getElementById('chat_contacts_list');
        if (!contactsContainer) return;

        if (!silent && !contactsContainer.querySelector('.chat-contact-item')) {
            contactsContainer.innerHTML = `
                <div class="d-flex align-items-center justify-content-center py-10" id="chat_contacts_loading">
                    <div class="spinner-border spinner-border-sm text-primary me-2"></div>
                    <span class="text-muted fs-7">Memuat daftar kontak...</span>
                </div>
            `;
        }

        const url = `/profil/profil-pengguna/chat/contacts?q=${encodeURIComponent(searchQuery)}`;

        fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const contacts = data.contacts || [];
                cachedContacts = contacts;

                // Build signature of contact list to avoid unnecessary DOM rebuilding
                const contactsSignature = JSON.stringify(contacts.map(c => ({
                    id: c.id,
                    unread: c.unread_count,
                    status: c.presence?.status,
                    lastText: c.last_message?.text,
                    lastTime: c.last_message?.time
                })));

                const prevContactsHash = contactsContainer.getAttribute('data-contacts-hash');

                if (contacts.length === 0) {
                    if (prevContactsHash !== 'empty_' + searchQuery) {
                        contactsContainer.setAttribute('data-contacts-hash', 'empty_' + searchQuery);
                        contactsContainer.innerHTML = `
                            <div class="text-center py-8 px-4 text-muted">
                                <i class="ki-duotone ki-user fs-2tx text-gray-400 mb-2"><span class="path1"></span><span class="path2"></span></i>
                                <div class="fs-8 fw-semibold">${searchQuery ? 'Pengguna tidak ditemukan' : 'Belum ada kontak'}</div>
                            </div>
                        `;
                    }
                } else {
                    if (prevContactsHash !== contactsSignature) {
                        contactsContainer.setAttribute('data-contacts-hash', contactsSignature);

                        const activeChats = contacts.filter(c => Boolean(c.last_message));
                        const otherContacts = contacts.filter(c => !c.last_message);

                        let sectionsHtml = '';

                        // Section 1: Obrolan Aktif (Sudah / sedang chat)
                        if (activeChats.length > 0) {
                            sectionsHtml += `
                                <div class="d-flex align-items-center justify-content-between px-2 pt-1 pb-2">
                                    <span class="text-uppercase fs-9 fw-bolder text-gray-600 tracking-wider d-flex align-items-center gap-1">
                                        <i class="ki-duotone ki-messages fs-7 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        Obrolan
                                    </span>
                                    <span class="badge badge-sm badge-light-primary fs-9 fw-bold">${activeChats.length}</span>
                                </div>
                                ${activeChats.map(c => renderContactItem(c, false)).join('')}
                            `;
                        }

                        // Section 2: Kontak Lainnya (Belum pernah chat)
                        if (otherContacts.length > 0) {
                            sectionsHtml += `
                                <div class="d-flex align-items-center justify-content-between px-2 ${activeChats.length > 0 ? 'pt-4' : 'pt-1'} pb-2">
                                    <span class="text-uppercase fs-9 fw-bolder text-gray-600 tracking-wider d-flex align-items-center gap-1">
                                        <i class="ki-duotone ki-profile-user fs-7 text-gray-500"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        Kontak Lainnya
                                    </span>
                                    <span class="badge badge-sm badge-light fs-9 fw-bold text-gray-600">${otherContacts.length}</span>
                                </div>
                                ${otherContacts.map(c => renderContactItem(c, true)).join('')}
                            `;
                        }

                        contactsContainer.innerHTML = sectionsHtml;
                    }
                }

                // If silent polling, DO NOT trigger loadConversation!
                if (!silent) {
                    // Determine target to select
                    let targetToSelect = activeUserId;
                    if (!targetToSelect) {
                        targetToSelect = autoSelectUserId || getTargetInitialUserId();
                    }

                    if (targetToSelect) {
                        loadConversation(targetToSelect, false);
                    } else if (!activeUserId) {
                        renderEmptyChatState();
                    }
                }
            }
        })
        .catch(err => {
            console.error('Failed to load chat contacts:', err);
        });
    };

    // Render Empty State when no conversation is selected
    const renderEmptyChatState = () => {
        activeUserId = null;
        const threadContainer = document.getElementById('chat_messages_thread');
        const formTargetId = document.getElementById('chat_form_target_user_id');
        const textInput = document.getElementById('chat_message_input');
        const sendBtn = document.getElementById('chat_btn_send');
        const triggerEmojiBtn = document.getElementById('chat_btn_trigger_emoji');
        const triggerFileBtn = document.getElementById('chat_btn_trigger_file');
        const btnViewProfile = document.getElementById('chat_btn_view_profile');
        const banner = document.getElementById('chat_pinned_banner');

        if (formTargetId) formTargetId.value = '';
        if (banner) {
            banner.classList.add('d-none');
            banner.classList.remove('d-flex');
        }

        // Header reset
        const elHeaderName = document.getElementById('chat_header_user_name');
        const elHeaderStatus = document.getElementById('chat_header_user_status');
        const elHeaderDot = document.getElementById('chat_header_presence_dot');
        const elHeaderAvatar = document.getElementById('chat_header_avatar_container');

        if (elHeaderName) {
            elHeaderName.textContent = 'Ruang Obrolan';
            elHeaderName.removeAttribute('data-user-id');
        }
        if (elHeaderStatus) elHeaderStatus.textContent = 'Pilih pengguna untuk mulai obrolan';
        if (elHeaderDot) elHeaderDot.className = 'badge badge-success badge-circle w-10px h-10px me-1 d-none';
        if (elHeaderAvatar) {
            elHeaderAvatar.innerHTML = `
                <span class="symbol-label bg-light-primary text-primary fs-4 fw-bolder shadow-xs border border-2 border-body symbol-circle">
                    <i class="ki-duotone ki-messages fs-3 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                </span>
            `;
            elHeaderAvatar.removeAttribute('data-user-id');
        }
        if (btnViewProfile) {
            btnViewProfile.classList.add('d-none');
            btnViewProfile.removeAttribute('data-user-id');
        }

        // Disable input
        if (textInput) {
            textInput.value = '';
            textInput.disabled = true;
            textInput.placeholder = 'Silakan pilih pengguna di panel sebelah kiri untuk mulai mengobrol...';
        }
        if (sendBtn) sendBtn.disabled = true;
        if (triggerEmojiBtn) triggerEmojiBtn.disabled = true;
        if (triggerFileBtn) triggerFileBtn.disabled = true;

        // Empty state thread UI
        if (threadContainer) {
            threadContainer.removeAttribute('data-chat-hash');
            threadContainer.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center text-center p-8 my-auto" style="min-height: 380px;">
                    <div class="symbol symbol-75px symbol-circle bg-light-primary mb-5 d-flex align-items-center justify-content-center shadow-xs">
                        <i class="ki-duotone ki-messages fs-2tx text-primary">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                        </i>
                    </div>
                    <h3 class="fs-4 fw-bolder text-gray-900 mb-2">Pilih Pengguna untuk Memulai Percakapan</h3>
                    <p class="fs-7 text-muted mw-375px mb-5">
                        Pilih salah satu kontak dari daftar obrolan di sebelah kiri untuk membuka riwayat pesan dan saling bertukar kabar.
                    </p>
                    <div class="d-inline-flex align-items-center gap-2 text-muted fs-8 bg-light bg-opacity-75 py-2 px-4 rounded-pill border border-gray-200">
                        <i class="ki-duotone ki-shield-tick fs-5 text-success"><span class="path1"></span><span class="path2"></span></i>
                        <span>Percakapan privat & aman real-time</span>
                    </div>
                </div>
            `;
        }
    };

    // Update Pinned Banner UI (with photo thumbnail and attachment icon support)
    const updatePinnedBanner = (pinnedMessages) => {
        const banner = document.getElementById('chat_pinned_banner');
        const textEl = document.getElementById('chat_pinned_text');
        const jumpBtn = document.getElementById('chat_pinned_jump_btn');
        const thumbWrapper = document.getElementById('chat_pinned_thumb_wrapper');
        const thumbImg = document.getElementById('chat_pinned_thumb');
        const fileIcon = document.getElementById('chat_pinned_file_icon');
        const badgeEl = document.getElementById('chat_pinned_badge');

        if (!banner || !textEl) return;

        if (pinnedMessages && pinnedMessages.length > 0) {
            const latestPin = pinnedMessages[pinnedMessages.length - 1];
            const hasAttachment = Boolean(latestPin.attachment_url);
            const isImg = hasAttachment && latestPin.attachment_type === 'image';
            const fileName = latestPin.attachment_name || (isImg ? 'Foto Lampiran' : 'Berkas Lampiran');

            // Text display: if message is empty or generic placeholder, show filename or message text
            if (latestPin.message && latestPin.message !== '[Foto Lampiran]' && latestPin.message !== '[Berkas Lampiran]') {
                textEl.textContent = latestPin.message;
            } else if (hasAttachment) {
                textEl.textContent = fileName;
            } else {
                textEl.textContent = latestPin.message || '...';
            }

            // Thumbnail vs File icon handling
            if (isImg && thumbWrapper && thumbImg) {
                thumbImg.src = latestPin.attachment_url;
                thumbWrapper.classList.remove('d-none');
                if (fileIcon) fileIcon.classList.add('d-none');
                if (badgeEl) {
                    badgeEl.textContent = 'Foto';
                    badgeEl.classList.remove('d-none');
                }
            } else if (hasAttachment && fileIcon) {
                if (thumbWrapper) thumbWrapper.classList.add('d-none');
                fileIcon.classList.remove('d-none');
                if (badgeEl) {
                    badgeEl.textContent = 'Berkas';
                    badgeEl.classList.remove('d-none');
                }
            } else {
                if (thumbWrapper) thumbWrapper.classList.add('d-none');
                if (fileIcon) fileIcon.classList.add('d-none');
                if (badgeEl) badgeEl.classList.add('d-none');
            }

            banner.classList.remove('d-none');
            banner.classList.add('d-flex');
            banner.setAttribute('data-pinned-id', latestPin.id);

            if (jumpBtn) {
                jumpBtn.onclick = () => scrollToMessage(latestPin.id);
            }
        } else {
            banner.classList.add('d-none');
            banner.classList.remove('d-flex');
            banner.removeAttribute('data-pinned-id');
        }
    };

    // Load conversation with a specific user
    const loadConversation = (targetUserId, silent = false) => {
        if (!targetUserId) return;
        
        const isSwitchingUser = (activeUserId !== targetUserId);
        activeUserId = targetUserId;

        // Reset Reply & Edit states only when explicitly switching conversations
        if (!silent || isSwitchingUser) {
            cancelReplyMode();
            cancelEditMode();
        }

        // Keep URL completely clean without query parameters
        try {
            if (window.location.search) {
                window.history.replaceState(null, '', window.location.pathname);
            }
        } catch (e) {}

        const threadContainer = document.getElementById('chat_messages_thread');
        const scrollContainer = document.getElementById('chat_messages_scroll');
        const formTargetId = document.getElementById('chat_form_target_user_id');

        if (formTargetId) formTargetId.value = targetUserId;

        // Highlight active contact in sidebar
        const allContactItems = document.querySelectorAll('.chat-contact-item');
        allContactItems.forEach(el => {
            const id = parseInt(el.getAttribute('data-user-id'), 10);
            if (id === targetUserId) {
                el.classList.add('bg-light-primary');
                el.classList.remove('bg-hover-light');
                const nameEl = el.querySelector('span.fs-6');
                if (nameEl) nameEl.classList.add('text-primary');
                const badge = el.querySelector('.badge');
                if (badge) badge.remove();
            } else {
                el.classList.remove('bg-light-primary');
                el.classList.add('bg-hover-light');
                const nameEl = el.querySelector('span.fs-6');
                if (nameEl) nameEl.classList.remove('text-primary');
            }
        });

        // Don't interrupt user interaction if any dropdown or reaction popover is currently active in thread
        const hasOpenInteraction = !!document.querySelector('#chat_messages_thread .dropdown-menu.show') || 
                                   !!document.querySelector('.chat-reaction-popover');
        if (silent && hasOpenInteraction) {
            return;
        }

        // Show spinner ONLY when explicitly switching users
        if (!silent && isSwitchingUser && threadContainer) {
            threadContainer.removeAttribute('data-chat-hash');
            threadContainer.innerHTML = `
                <div class="d-flex align-items-center justify-content-center py-10">
                    <div class="spinner-border spinner-border-sm text-primary me-2"></div>
                    <span class="text-muted fs-7">Memuat percakapan...</span>
                </div>
            `;
        }

        fetch(`/profil/profil-pengguna/chat/conversation/${targetUserId}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                if (activeUserId !== targetUserId) return; // User switched away

                const targetUser = data.target_user;
                const messages = data.messages || [];
                const pinnedMessages = data.pinned_messages || [];

                // 1. Enable Input Controls & Update Chat Header
                const textInput = document.getElementById('chat_message_input');
                const sendBtn = document.getElementById('chat_btn_send');
                const triggerEmojiBtn = document.getElementById('chat_btn_trigger_emoji');
                const triggerFileBtn = document.getElementById('chat_btn_trigger_file');

                if (textInput && textInput.disabled) {
                    textInput.disabled = false;
                    textInput.placeholder = 'Ketik pesan Anda...';
                }
                if (sendBtn && sendBtn.disabled && !isSending) sendBtn.disabled = false;
                if (triggerEmojiBtn && triggerEmojiBtn.disabled) triggerEmojiBtn.disabled = false;
                if (triggerFileBtn && triggerFileBtn.disabled) triggerFileBtn.disabled = false;

                const elHeaderName = document.getElementById('chat_header_user_name');
                const elHeaderStatus = document.getElementById('chat_header_user_status');
                const elHeaderDot = document.getElementById('chat_header_presence_dot');
                const elHeaderAvatar = document.getElementById('chat_header_avatar_container');
                const btnViewProfile = document.getElementById('chat_btn_view_profile');

                if (elHeaderName && elHeaderName.textContent !== targetUser.name) {
                    elHeaderName.textContent = targetUser.name;
                    elHeaderName.setAttribute('data-user-id', targetUser.id);
                }
                const newStatusLabel = targetUser.presence?.label || 'Active';
                if (elHeaderStatus && elHeaderStatus.textContent !== newStatusLabel) {
                    elHeaderStatus.textContent = newStatusLabel;
                }
                if (elHeaderDot) {
                    const newDotClass = `badge ${targetUser.presence?.badge_class || 'badge-success'} badge-circle w-10px h-10px me-1`;
                    if (elHeaderDot.className !== newDotClass) {
                        elHeaderDot.className = newDotClass;
                    }
                    elHeaderDot.classList.remove('d-none');
                }

                if (elHeaderAvatar && elHeaderAvatar.getAttribute('data-user-id') !== String(targetUser.id)) {
                    elHeaderAvatar.innerHTML = buildAvatarHtml(targetUser, 'symbol-40px', true);
                    elHeaderAvatar.setAttribute('data-user-id', targetUser.id);
                }

                if (btnViewProfile) {
                    btnViewProfile.classList.remove('d-none');
                    btnViewProfile.setAttribute('data-user-id', targetUser.id);
                }

                // 2. Update Pinned Messages Banner
                updatePinnedBanner(pinnedMessages);

                // 3. Render Messages Thread Smartly & Reconcile Smoothly (Zero-Flicker)
                if (threadContainer) {
                    const newContentHash = JSON.stringify({
                        userId: targetUserId,
                        messages: messages.map(m => ({
                            id: m.id,
                            msg: m.message,
                            edited: m.is_edited ? 1 : 0,
                            pinned: m.is_pinned ? 1 : 0,
                            reactions: m.reactions || []
                        })),
                        pins: pinnedMessages.map(p => p.id)
                    });

                    const prevContentHash = threadContainer.getAttribute('data-chat-hash');

                    // If silent polling and data hasn't changed, zero DOM mutation!
                    if (silent && prevContentHash === newContentHash) {
                        return;
                    }

                    if (messages.length === 0) {
                        threadContainer.setAttribute('data-chat-hash', newContentHash);
                        threadContainer.innerHTML = `
                            <div class="text-center py-10 my-auto text-muted">
                                <i class="ki-duotone ki-message-text-2 fs-3tx text-gray-300 mb-2"><span class="path1"></span><span class="path2"></span></i>
                                <div class="fs-6 fw-bold text-gray-800">Percakapan Baru dengan ${escapeHtml(targetUser.name)}</div>
                                <div class="fs-7 text-muted">Ketik pesan di bawah dan tekan Send untuk memulai obrolan.</div>
                            </div>
                        `;
                        return;
                    }

                    const isInitialOrEmpty = !prevContentHash || threadContainer.querySelector('.ki-message-text-2') || threadContainer.children.length === 0 || isSwitchingUser;

                    if (isInitialOrEmpty) {
                        // Clean full render on initial load or user switch
                        threadContainer.setAttribute('data-chat-hash', newContentHash);
                        threadContainer.innerHTML = messages.map(renderMessageBubble).join('');
                        scrollToBottom(false);
                    } else {
                        // INCREMENTAL RECONCILIATION - ZERO FLICKER!
                        threadContainer.setAttribute('data-chat-hash', newContentHash);

                        const existingBubbles = Array.from(threadContainer.querySelectorAll('.chat-bubble-container'));
                        const existingBubbleMap = new Map();
                        existingBubbles.forEach(b => {
                            const id = parseInt(b.getAttribute('data-message-id'), 10);
                            if (id) existingBubbleMap.set(id, b);
                        });

                        const incomingIds = new Set(messages.map(m => m.id));

                        // 1. Remove bubbles that were deleted
                        existingBubbleMap.forEach((bubbleEl, id) => {
                            if (!incomingIds.has(id)) {
                                bubbleEl.remove();
                            }
                        });

                        const isNearBottom = scrollContainer 
                            ? ((scrollContainer.scrollHeight - scrollContainer.scrollTop - scrollContainer.clientHeight) <= 100) 
                            : true;
                        let hasNewMessages = false;

                        // 2. Append new bubbles or update modified existing bubbles
                        messages.forEach(msg => {
                            const existingBubble = existingBubbleMap.get(msg.id);

                            if (!existingBubble) {
                                // New message -> Append to bottom without touching other bubbles
                                threadContainer.insertAdjacentHTML('beforeend', renderMessageBubble(msg));
                                hasNewMessages = true;
                            } else {
                                // Update body text if edited
                                const bodyText = existingBubble.querySelector('.message-body-text');
                                if (bodyText && bodyText.textContent !== msg.message && msg.message && msg.message !== '[Foto Lampiran]' && msg.message !== '[Berkas Lampiran]') {
                                    bodyText.textContent = msg.message;
                                }

                                // Update (diedit) badge
                                const editedBadge = existingBubble.querySelector('span[title="Pesan telah diedit"]');
                                if (msg.is_edited && !editedBadge) {
                                    const pEl = existingBubble.querySelector('[data-kt-element="message-text"]');
                                    if (pEl) pEl.insertAdjacentHTML('beforeend', '<span class="text-muted fs-8 fst-italic ms-1" title="Pesan telah diedit">(diedit)</span>');
                                } else if (!msg.is_edited && editedBadge) {
                                    editedBadge.remove();
                                }

                                // Update Pin icon
                                const pinIcon = existingBubble.querySelector('i.ki-pin');
                                if (msg.is_pinned && !pinIcon) {
                                    const timeParent = existingBubble.querySelector('.text-muted.fs-7');
                                    if (timeParent) {
                                        timeParent.insertAdjacentHTML('afterend', '<i class="ki-duotone ki-pin fs-6 text-warning ms-1" title="Pesan Disematkan"><span class="path1"></span><span class="path2"></span></i>');
                                    }
                                } else if (!msg.is_pinned && pinIcon) {
                                    pinIcon.remove();
                                }

                                // Update reactions without flashing
                                const col = existingBubble.querySelector('.d-flex.flex-column');
                                if (col) {
                                    let existingReactionsEl = col.querySelector('.d-flex.flex-wrap.align-items-center.mt-1');
                                    const newBadgesHtml = renderReactionsBadges(msg.reactions, msg.id);
                                    if (existingReactionsEl) {
                                        if (newBadgesHtml) {
                                            const tempDiv = document.createElement('div');
                                            tempDiv.innerHTML = newBadgesHtml;
                                            if (existingReactionsEl.innerHTML.trim() !== tempDiv.firstElementChild.innerHTML.trim()) {
                                                existingReactionsEl.replaceWith(tempDiv.firstElementChild);
                                            }
                                        } else {
                                            existingReactionsEl.remove();
                                        }
                                    } else if (newBadgesHtml) {
                                        col.insertAdjacentHTML('beforeend', newBadgesHtml);
                                    }
                                }
                            }
                        });

                        if (hasNewMessages && isNearBottom) {
                            scrollToBottom(true);
                        }
                    }
                }

                // 4. Sync Topbar Notification Badges Live
                if (window.KTAppNotifications) {
                    window.KTAppNotifications.refresh();
                }
            }
        })
        .catch(err => {
            console.error('Failed to load conversation:', err);
        });
    };

    // Set Reply Mode (with photo thumbnail support)
    const setReplyMode = (msgId, senderName, messageText, attachmentUrl = null, attachmentType = null) => {
        cancelEditMode();
        currentReplyingTo = { id: msgId, sender_name: senderName, message: messageText, attachment_url: attachmentUrl, attachment_type: attachmentType };

        const replyPreview = document.getElementById('chat_reply_preview');
        const replySender = document.getElementById('chat_reply_sender');
        const replyText = document.getElementById('chat_reply_text');
        const replyThumbWrapper = document.getElementById('chat_reply_thumb_wrapper');
        const replyThumb = document.getElementById('chat_reply_thumb');
        const formReplyId = document.getElementById('chat_form_reply_to_id');
        const textInput = document.getElementById('chat_message_input');

        if (formReplyId) formReplyId.value = msgId;
        if (replySender) replySender.textContent = `Membalas ${senderName}`;
        if (replyText) {
            if (messageText && messageText !== '[Foto Lampiran]' && messageText !== '[Berkas Lampiran]') {
                replyText.textContent = messageText;
            } else if (attachmentType === 'image') {
                replyText.textContent = 'Foto Lampiran';
            } else {
                replyText.textContent = 'Berkas Lampiran';
            }
        }

        if (attachmentUrl && attachmentType === 'image' && replyThumbWrapper && replyThumb) {
            replyThumb.src = attachmentUrl;
            replyThumbWrapper.classList.remove('d-none');
        } else if (replyThumbWrapper) {
            replyThumbWrapper.classList.add('d-none');
        }

        if (replyPreview) {
            replyPreview.classList.remove('d-none');
            replyPreview.classList.add('d-flex');
        }

        if (textInput) {
            textInput.focus();
        }
    };

    // Cancel Reply Mode
    const cancelReplyMode = () => {
        currentReplyingTo = null;
        const replyPreview = document.getElementById('chat_reply_preview');
        const replyThumbWrapper = document.getElementById('chat_reply_thumb_wrapper');
        const replyThumb = document.getElementById('chat_reply_thumb');
        const formReplyId = document.getElementById('chat_form_reply_to_id');

        if (formReplyId) formReplyId.value = '';
        if (replyThumbWrapper) replyThumbWrapper.classList.add('d-none');
        if (replyThumb) replyThumb.src = '';
        if (replyPreview) {
            replyPreview.classList.add('d-none');
            replyPreview.classList.remove('d-flex');
        }
    };

    // Set Edit Mode
    const setEditMode = (msgId, messageText) => {
        cancelReplyMode();
        currentEditingMessage = { id: msgId, message: messageText };

        const editPreview = document.getElementById('chat_edit_preview');
        const editOrigText = document.getElementById('chat_edit_original_text');
        const formEditId = document.getElementById('chat_form_edit_message_id');
        const textInput = document.getElementById('chat_message_input');
        const sendBtnLabel = document.getElementById('chat_btn_send_label');

        if (formEditId) formEditId.value = msgId;
        if (editOrigText) editOrigText.textContent = messageText;
        if (editPreview) editPreview.classList.remove('d-none');
        if (sendBtnLabel) sendBtnLabel.textContent = 'Simpan';

        if (textInput) {
            textInput.value = messageText;
            textInput.focus();
            textInput.style.height = 'auto';
            textInput.style.height = (textInput.scrollHeight) + 'px';
        }
    };

    // Cancel Edit Mode
    const cancelEditMode = () => {
        if (!currentEditingMessage) return;
        currentEditingMessage = null;
        const editPreview = document.getElementById('chat_edit_preview');
        const formEditId = document.getElementById('chat_form_edit_message_id');
        const textInput = document.getElementById('chat_message_input');
        const sendBtnLabel = document.getElementById('chat_btn_send_label');

        if (formEditId) formEditId.value = '';
        if (editPreview) editPreview.classList.add('d-none');
        if (sendBtnLabel) sendBtnLabel.textContent = 'Send';
        if (textInput) {
            textInput.value = '';
            textInput.style.height = 'auto';
        }
    };

    // Send or Edit Message Handler
    const sendMessage = (e) => {
        if (e) e.preventDefault();
        if (isSending || !activeUserId) return;

        const textInput = document.getElementById('chat_message_input');
        const fileInput = document.getElementById('chat_file_input');
        const sendBtn = document.getElementById('chat_btn_send');
        const previewContainer = document.getElementById('chat_attachment_preview');
        const formReplyId = document.getElementById('chat_form_reply_to_id');
        const formEditId = document.getElementById('chat_form_edit_message_id');

        const messageText = textInput ? textInput.value.trim() : '';
        const hasFile = fileInput && fileInput.files && fileInput.files.length > 0;
        const isEditing = Boolean(formEditId && formEditId.value);

        if (messageText === '' && !hasFile) return;

        isSending = true;
        if (sendBtn) {
            sendBtn.setAttribute('data-kt-indicator', 'on');
            sendBtn.disabled = true;
        }

        // 1. IF EDITING: Call Edit Endpoint
        if (isEditing) {
            const editId = formEditId.value;
            fetch(`/profil/profil-pengguna/chat/edit/${editId}`, {
                method: 'POST',
                headers: getHeaders(true),
                body: JSON.stringify({ message: messageText, _token: getCsrfToken() })
            })
            .then(async (res) => {
                if (res.status === 419) {
                    await fetch('/profil/profil-pengguna/chat/contacts', { headers: { 'Accept': 'application/json' } });
                    const retry = await fetch(`/profil/profil-pengguna/chat/edit/${editId}`, {
                        method: 'POST',
                        headers: getHeaders(true),
                        body: JSON.stringify({ message: messageText, _token: getCsrfToken() })
                    });
                    return await retry.json();
                }
                return res.json();
            })
            .then(data => {
                if (data.status === 'success' && data.chat) {
                    cancelEditMode();

                    // Update existing bubble text & badge
                    const bubble = document.querySelector(`.chat-bubble-container[data-message-id="${editId}"]`);
                    if (bubble) {
                        const bodyText = bubble.querySelector('.message-body-text');
                        if (bodyText) bodyText.textContent = data.chat.message;

                        if (!bubble.querySelector('span[title="Pesan telah diedit"]')) {
                            const pEl = bubble.querySelector('[data-kt-element="message-text"]');
                            if (pEl) pEl.insertAdjacentHTML('beforeend', '<span class="text-muted fs-8 fst-italic ms-1" title="Pesan telah diedit">(diedit)</span>');
                        }
                    }

                    if (typeof toastr !== 'undefined') toastr.success('Pesan berhasil diperbarui.');
                } else {
                    if (typeof toastr !== 'undefined') toastr.error(data.message || 'Gagal mengedit pesan.');
                }
            })
            .catch(err => {
                console.error('Failed to edit message:', err);
                if (typeof toastr !== 'undefined') toastr.error('Terjadi kesalahan koneksi.');
            })
            .finally(() => {
                isSending = false;
                if (sendBtn) {
                    sendBtn.removeAttribute('data-kt-indicator');
                    sendBtn.disabled = false;
                }
            });
            return;
        }

        // 2. NORMAL SEND (New Message / Reply)
        const formData = new FormData();
        formData.append('_token', getCsrfToken());
        formData.append('message', messageText);
        if (formReplyId && formReplyId.value) {
            formData.append('reply_to_id', formReplyId.value);
        }
        if (hasFile) {
            formData.append('attachment', fileInput.files[0]);
        }

        fetch(`/profil/profil-pengguna/chat/send/${activeUserId}`, {
            method: 'POST',
            headers: getHeaders(false),
            body: formData
        })
        .then(async (res) => {
            if (res.status === 419) {
                await fetch('/profil/profil-pengguna/chat/contacts', { headers: { 'Accept': 'application/json' } });
                formData.set('_token', getCsrfToken());
                const retry = await fetch(`/profil/profil-pengguna/chat/send/${activeUserId}`, {
                    method: 'POST',
                    headers: getHeaders(false),
                    body: formData
                });
                return await retry.json();
            }
            return res.json();
        })
        .then(data => {
            if (data.status === 'success' && data.chat) {
                // Clear inputs
                if (textInput) {
                    textInput.value = '';
                    textInput.style.height = 'auto';
                }
                if (fileInput) fileInput.value = '';
                const thumbImg = document.getElementById('chat_attachment_thumb');
                if (thumbImg && thumbImg.src && thumbImg.src.startsWith('blob:')) {
                    URL.revokeObjectURL(thumbImg.src);
                    thumbImg.src = '';
                }
                if (previewContainer) {
                    previewContainer.classList.add('d-none');
                    previewContainer.classList.remove('d-flex');
                }
                cancelReplyMode();

                // Append new message bubble
                const threadContainer = document.getElementById('chat_messages_thread');
                if (threadContainer) {
                    if (threadContainer.querySelector('.ki-message-text-2')) {
                        threadContainer.innerHTML = '';
                    }
                    threadContainer.insertAdjacentHTML('beforeend', renderMessageBubble(data.chat));
                    scrollToBottom(true);
                }

                // Refresh contacts sidebar
                loadContacts('', activeUserId, true);

                if (textInput) textInput.focus();
            } else {
                if (typeof toastr !== 'undefined') {
                    toastr.error(data.message || 'Gagal mengirim pesan.');
                }
            }
        })
        .catch(err => {
            console.error('Failed to send message:', err);
            if (typeof toastr !== 'undefined') {
                toastr.error('Terjadi kesalahan jaringan saat mengirim pesan.');
            }
        })
        .finally(() => {
            isSending = false;
            if (sendBtn) {
                sendBtn.removeAttribute('data-kt-indicator');
                sendBtn.disabled = false;
            }
        });
    };

    // Toggle Pin Message
    const togglePinMessage = (msgId) => {
        fetch(`/profil/profil-pengguna/chat/pin/${msgId}`, {
            method: 'POST',
            headers: getHeaders(true),
            body: JSON.stringify({ _token: getCsrfToken() })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                if (typeof toastr !== 'undefined') toastr.success(data.message);
                loadConversation(activeUserId, true);
            } else {
                if (typeof toastr !== 'undefined') toastr.error(data.message || 'Gagal menyematkan pesan.');
            }
        })
        .catch(err => {
            console.error('Failed to pin message:', err);
        });
    };

    // Toggle Reaction on Message
    const toggleReaction = (msgId, emoji) => {
        fetch(`/profil/profil-pengguna/chat/react/${msgId}`, {
            method: 'POST',
            headers: getHeaders(true),
            body: JSON.stringify({ emoji: emoji, _token: getCsrfToken() })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const bubble = document.querySelector(`.chat-bubble-container[data-message-id="${msgId}"]`);
                if (bubble) {
                    const col = bubble.querySelector('.d-flex.flex-column');
                    let existingReactions = col.querySelector('.d-flex.flex-wrap.align-items-center.mt-1');
                    if (existingReactions) existingReactions.remove();

                    const newBadgesHtml = renderReactionsBadges(data.reactions, msgId);
                    if (newBadgesHtml) {
                        col.insertAdjacentHTML('beforeend', newBadgesHtml);
                    }
                }
            }
        })
        .catch(err => {
            console.error('Failed to react to message:', err);
        });
    };

    // Delete Message with SweetAlert2
    const deleteMessage = (msgId) => {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Pesan?',
                text: 'Pesan ini akan dihapus secara permanen dari percakapan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger fw-bold',
                    cancelButton: 'btn btn-light fw-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    executeDelete(msgId);
                }
            });
        } else {
            if (confirm('Hapus pesan ini?')) {
                executeDelete(msgId);
            }
        }
    };

    const executeDelete = (msgId) => {
        fetch(`/profil/profil-pengguna/chat/message/${msgId}`, {
            method: 'DELETE',
            headers: getHeaders(true),
            body: JSON.stringify({ _token: getCsrfToken() })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const bubble = document.querySelector(`.chat-bubble-container[data-message-id="${msgId}"]`);
                if (bubble) {
                    bubble.style.transition = 'all 0.3s ease';
                    bubble.style.opacity = '0';
                    bubble.style.transform = 'scale(0.9)';
                    setTimeout(() => bubble.remove(), 300);
                }
                if (typeof toastr !== 'undefined') toastr.success('Pesan berhasil dihapus.');
                loadContacts('', activeUserId, true);
            } else {
                if (typeof toastr !== 'undefined') toastr.error(data.message || 'Gagal menghapus pesan.');
            }
        })
        .catch(err => {
            console.error('Failed to delete message:', err);
        });
    };

    // Open Forward Modal
    const openForwardModal = (msgId, messageText) => {
        const modalEl = document.getElementById('kt_modal_chat_forward');
        const inputSourceId = document.getElementById('chat_forward_source_message_id');
        const previewText = document.getElementById('chat_forward_preview_text');
        const contactsContainer = document.getElementById('chat_forward_contacts_list');
        const countSpan = document.getElementById('chat_forward_selected_count');
        const searchInput = document.getElementById('chat_forward_search_input');

        if (inputSourceId) inputSourceId.value = msgId;
        if (previewText) {
            if (messageText && messageText !== '[Foto Lampiran]' && messageText !== '[Berkas Lampiran]') {
                previewText.textContent = messageText;
            } else {
                previewText.textContent = 'Lampiran Berkas / Foto';
            }
        }
        if (countSpan) countSpan.textContent = '0';
        if (searchInput) searchInput.value = '';

        const renderForwardContacts = (filterText = '') => {
            if (!contactsContainer) return;
            const filtered = cachedContacts.filter(c => {
                if (!filterText) return true;
                return c.name.toLowerCase().includes(filterText.toLowerCase()) || c.email.toLowerCase().includes(filterText.toLowerCase());
            });

            if (filtered.length === 0) {
                contactsContainer.innerHTML = `<div class="text-center py-4 text-muted fs-8">Tidak ada kontak ditemukan.</div>`;
                return;
            }

            contactsContainer.innerHTML = filtered.map(c => `
                <label class="d-flex align-items-center justify-content-between p-3 rounded bg-hover-light cursor-pointer border-bottom border-gray-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="symbol symbol-35px symbol-circle">
                            ${buildAvatarHtml(c, 'symbol-35px', true)}
                        </div>
                        <div class="text-start">
                            <div class="fs-7 fw-bold text-gray-900">${escapeHtml(c.name)}</div>
                            <div class="fs-8 text-muted">${escapeHtml(c.email)}</div>
                        </div>
                    </div>
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input chat-forward-checkbox" type="checkbox" value="${c.id}" />
                    </div>
                </label>
            `).join('');
        };

        renderForwardContacts();

        if (searchInput) {
            searchInput.oninput = () => renderForwardContacts(searchInput.value.trim());
        }

        if (modalEl && typeof bootstrap !== 'undefined') {
            bootstrap.Modal.getOrCreateInstance(modalEl).show();
        }
    };

    // Execute Forward
    const executeForward = () => {
        const inputSourceId = document.getElementById('chat_forward_source_message_id');
        const checkboxes = document.querySelectorAll('.chat-forward-checkbox:checked');
        const btnExecute = document.getElementById('chat_btn_execute_forward');
        const modalEl = document.getElementById('kt_modal_chat_forward');

        const sourceId = inputSourceId ? inputSourceId.value : null;
        const selectedUserIds = Array.from(checkboxes).map(cb => parseInt(cb.value, 10));

        if (!sourceId || selectedUserIds.length === 0) {
            if (typeof toastr !== 'undefined') toastr.warning('Pilih minimal 1 kontak tujuan.');
            return;
        }

        if (btnExecute) {
            btnExecute.setAttribute('data-kt-indicator', 'on');
            btnExecute.disabled = true;
        }

        fetch(`/profil/profil-pengguna/chat/forward/${sourceId}`, {
            method: 'POST',
            headers: getHeaders(true),
            body: JSON.stringify({ target_user_ids: selectedUserIds, _token: getCsrfToken() })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                if (typeof toastr !== 'undefined') toastr.success(data.message);
                if (modalEl && typeof bootstrap !== 'undefined') {
                    bootstrap.Modal.getOrCreateInstance(modalEl).hide();
                }
                loadContacts('', activeUserId, true);
                if (activeUserId && selectedUserIds.includes(activeUserId)) {
                    loadConversation(activeUserId, true);
                }
            } else {
                if (typeof toastr !== 'undefined') toastr.error(data.message || 'Gagal meneruskan pesan.');
            }
        })
        .catch(err => {
            console.error('Failed to forward message:', err);
        })
        .finally(() => {
            if (btnExecute) {
                btnExecute.removeAttribute('data-kt-indicator');
                btnExecute.disabled = false;
            }
        });
    };

    // Setup Emoticon Picker in Composer
    const initEmojiPicker = () => {
        const triggerBtn = document.getElementById('chat_btn_trigger_emoji');
        const popover = document.getElementById('chat_emoji_picker_popover');
        const closeBtn = document.getElementById('chat_btn_close_emoji_picker');
        const container = document.getElementById('chat_emoji_items_container');
        const textInput = document.getElementById('chat_message_input');

        if (!triggerBtn || !popover || !container) return;

        // Render Emojis into container
        container.innerHTML = POPULAR_EMOJIS.map(em => `
            <span class="emoji-btn-item btn-composer-emoji" data-emoji="${em}">${em}</span>
        `).join('');

        triggerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            popover.classList.toggle('d-none');
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', () => popover.classList.add('d-none'));
        }

        container.addEventListener('click', (e) => {
            const emojiEl = e.target.closest('.btn-composer-emoji');
            if (!emojiEl) return;

            const emoji = emojiEl.getAttribute('data-emoji');
            if (emoji && textInput) {
                const startPos = textInput.selectionStart || textInput.value.length;
                const endPos = textInput.selectionEnd || textInput.value.length;
                textInput.value = textInput.value.substring(0, startPos) + emoji + textInput.value.substring(endPos);
                textInput.selectionStart = textInput.selectionEnd = startPos + emoji.length;
                textInput.focus();
                textInput.style.height = 'auto';
                textInput.style.height = (textInput.scrollHeight) + 'px';
            }
        });

        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!popover.contains(e.target) && e.target !== triggerBtn && !triggerBtn.contains(e.target)) {
                popover.classList.add('d-none');
            }
        });
    };

    // Setup Event Listeners
    const initListeners = () => {
        // 1. Search Contact Input (Debounced)
        const searchInput = document.getElementById('chat_contact_search_input');
        if (searchInput) {
            let searchTimer = null;
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => {
                    loadContacts(searchInput.value.trim(), null, true);
                }, 300);
            });
        }

        // 2. Select Contact from Sidebar
        const contactsContainer = document.getElementById('chat_contacts_list');
        if (contactsContainer) {
            contactsContainer.addEventListener('click', (e) => {
                const item = e.target.closest('.chat-contact-item');
                if (!item) return;

                const userId = parseInt(item.getAttribute('data-user-id'), 10);
                if (userId) {
                    e.preventDefault();
                    loadConversation(userId);
                }
            });
        }

        // 3. Form Submit & Send Button Click
        const form = document.getElementById('chat_message_form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                sendMessage();
            });
        }

        const sendBtn = document.getElementById('chat_btn_send');
        if (sendBtn) {
            sendBtn.addEventListener('click', (e) => {
                e.preventDefault();
                sendMessage();
            });
        }

        // 4. Textarea Enter to Send (Shift+Enter for new line) & Auto-height
        const textInput = document.getElementById('chat_message_input');
        if (textInput) {
            textInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            textInput.addEventListener('input', () => {
                textInput.style.height = 'auto';
                textInput.style.height = (textInput.scrollHeight) + 'px';
            });
        }

        // 5. File Attachment Trigger & Preview (with live image thumbnail preview)
        const formatFileSize = (bytes) => {
            if (!bytes || bytes <= 0) return '0 B';
            if (bytes < 1024) return bytes + ' B';
            else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            else return (bytes / 1048576).toFixed(1) + ' MB';
        };

        const triggerBtn = document.getElementById('chat_btn_trigger_file');
        const fileInput = document.getElementById('chat_file_input');
        const previewContainer = document.getElementById('chat_attachment_preview');
        const previewFilename = document.getElementById('chat_attachment_filename');
        const removeFileBtn = document.getElementById('chat_btn_remove_attachment');
        const thumbWrapper = document.getElementById('chat_attachment_thumb_wrapper');
        const thumbImg = document.getElementById('chat_attachment_thumb');
        const fileIcon = document.getElementById('chat_attachment_file_icon');
        const badgeEl = document.getElementById('chat_attachment_badge');
        const sizeEl = document.getElementById('chat_attachment_size');

        if (triggerBtn && fileInput) {
            triggerBtn.addEventListener('click', () => fileInput.click());
        }

        if (fileInput) {
            fileInput.addEventListener('change', () => {
                if (fileInput.files && fileInput.files[0]) {
                    const file = fileInput.files[0];
                    const isImg = file.type.startsWith('image/');

                    if (previewFilename) previewFilename.textContent = file.name;
                    if (sizeEl) sizeEl.textContent = formatFileSize(file.size);
                    if (badgeEl) badgeEl.textContent = isImg ? 'Foto / Gambar' : 'Dokumen / Berkas';

                    if (isImg && thumbWrapper && thumbImg) {
                        if (thumbImg.src && thumbImg.src.startsWith('blob:')) {
                            URL.revokeObjectURL(thumbImg.src);
                        }
                        const objectUrl = URL.createObjectURL(file);
                        thumbImg.src = objectUrl;
                        thumbWrapper.classList.remove('d-none');
                        if (fileIcon) fileIcon.classList.add('d-none');
                    } else {
                        if (thumbWrapper) thumbWrapper.classList.add('d-none');
                        if (fileIcon) fileIcon.classList.remove('d-none');
                    }

                    if (previewContainer) {
                        previewContainer.classList.remove('d-none');
                        previewContainer.classList.add('d-flex');
                    }

                    if (textInput) textInput.focus();
                }
            });
        }

        if (removeFileBtn && fileInput && previewContainer) {
            removeFileBtn.addEventListener('click', () => {
                fileInput.value = '';
                if (thumbImg && thumbImg.src && thumbImg.src.startsWith('blob:')) {
                    URL.revokeObjectURL(thumbImg.src);
                    thumbImg.src = '';
                }
                previewContainer.classList.add('d-none');
                previewContainer.classList.remove('d-flex');
            });
        }

        // 6. Cancel Buttons for Reply & Edit
        const cancelReplyBtn = document.getElementById('chat_btn_cancel_reply');
        if (cancelReplyBtn) cancelReplyBtn.addEventListener('click', cancelReplyMode);

        const cancelEditBtn = document.getElementById('chat_btn_cancel_edit');
        if (cancelEditBtn) cancelEditBtn.addEventListener('click', cancelEditMode);

        // 7. Unpin Current from Banner
        const unpinBannerBtn = document.getElementById('chat_btn_unpin_current');
        if (unpinBannerBtn) {
            unpinBannerBtn.addEventListener('click', () => {
                const banner = document.getElementById('chat_pinned_banner');
                const pinId = banner ? banner.getAttribute('data-pinned-id') : null;
                if (pinId) togglePinMessage(parseInt(pinId, 10));
            });
        }

        // 8. Forward Checkbox Counter & Execute Forward
        const forwardContactsContainer = document.getElementById('chat_forward_contacts_list');
        if (forwardContactsContainer) {
            forwardContactsContainer.addEventListener('change', (e) => {
                if (e.target.classList.contains('chat-forward-checkbox')) {
                    const count = document.querySelectorAll('.chat-forward-checkbox:checked').length;
                    const countSpan = document.getElementById('chat_forward_selected_count');
                    if (countSpan) countSpan.textContent = count;
                }
            });
        }

        const btnExecForward = document.getElementById('chat_btn_execute_forward');
        if (btnExecForward) {
            btnExecForward.addEventListener('click', executeForward);
        }

        // 9. Delegated Handlers on Messages Scroll Thread (Actions, Replies, Reactions, Photo Modal)
        const scrollContainer = document.getElementById('chat_messages_scroll');
        if (scrollContainer) {
            scrollContainer.addEventListener('click', (e) => {
                // A. Image Modal Preview Trigger
                const imgTrigger = e.target.closest('.chat-image-preview-trigger');
                if (imgTrigger) {
                    const imgUrl = imgTrigger.getAttribute('data-img-url');
                    const imgName = imgTrigger.getAttribute('data-img-name') || 'Foto Lampiran.jpg';
                    const imgTime = imgTrigger.getAttribute('data-img-time') || '';
                    const imgSender = imgTrigger.getAttribute('data-img-sender') || '';

                    const modalEl = document.getElementById('kt_modal_chat_image_preview');
                    const modalImg = document.getElementById('chat_modal_preview_image');
                    const modalFilename = document.getElementById('chat_modal_preview_filename');
                    const modalMeta = document.getElementById('chat_modal_preview_meta');
                    const modalTime = document.getElementById('chat_modal_preview_time');
                    const modalBtnDownload = document.getElementById('chat_modal_btn_download');

                    if (modalImg) modalImg.src = imgUrl;
                    if (modalFilename) modalFilename.textContent = imgName;
                    if (modalMeta) modalMeta.textContent = imgSender ? `Dikirim oleh ${imgSender}` : 'Foto Lampiran Chat';
                    if (modalTime) modalTime.textContent = imgTime || 'Baru saja';
                    if (modalBtnDownload) {
                        modalBtnDownload.href = imgUrl;
                        modalBtnDownload.setAttribute('download', imgName);
                    }

                    if (modalEl && typeof bootstrap !== 'undefined') {
                        bootstrap.Modal.getOrCreateInstance(modalEl).show();
                    }
                    return;
                }

                // B. Jump to Quoted Reply Message
                const jumpReplyBtn = e.target.closest('.btn-jump-to-reply');
                if (jumpReplyBtn) {
                    const rId = jumpReplyBtn.getAttribute('data-reply-id');
                    if (rId) scrollToMessage(parseInt(rId, 10));
                    return;
                }

                // C. Action Menu: Reply
                const replyAction = e.target.closest('.btn-msg-action-reply');
                if (replyAction) {
                    const msgId = parseInt(replyAction.getAttribute('data-message-id'), 10);
                    const senderName = replyAction.getAttribute('data-sender-name');
                    const messageText = replyAction.getAttribute('data-message-text');
                    const attachmentUrl = replyAction.getAttribute('data-attachment-url');
                    const attachmentType = replyAction.getAttribute('data-attachment-type');
                    setReplyMode(msgId, senderName, messageText, attachmentUrl, attachmentType);
                    return;
                }

                // D. Action Menu: Edit
                const editAction = e.target.closest('.btn-msg-action-edit');
                if (editAction) {
                    const msgId = parseInt(editAction.getAttribute('data-message-id'), 10);
                    const messageText = editAction.getAttribute('data-message-text');
                    setEditMode(msgId, messageText);
                    return;
                }

                // E. Action Menu: Forward
                const forwardAction = e.target.closest('.btn-msg-action-forward');
                if (forwardAction) {
                    const msgId = parseInt(forwardAction.getAttribute('data-message-id'), 10);
                    const messageText = forwardAction.getAttribute('data-message-text');
                    openForwardModal(msgId, messageText);
                    return;
                }

                // F. Action Menu: Pin
                const pinAction = e.target.closest('.btn-msg-action-pin');
                if (pinAction) {
                    const msgId = parseInt(pinAction.getAttribute('data-message-id'), 10);
                    togglePinMessage(msgId);
                    return;
                }

                // G. Action Menu: Delete
                const deleteAction = e.target.closest('.btn-msg-action-delete');
                if (deleteAction) {
                    const msgId = parseInt(deleteAction.getAttribute('data-message-id'), 10);
                    deleteMessage(msgId);
                    return;
                }

                // H. Toggle Reaction from Badge
                const reactionBadge = e.target.closest('.btn-toggle-reaction');
                if (reactionBadge) {
                    const msgId = parseInt(reactionBadge.getAttribute('data-message-id'), 10);
                    const emoji = reactionBadge.getAttribute('data-emoji');
                    toggleReaction(msgId, emoji);
                    return;
                }

                // I. Open Quick Reaction Popover Picker
                const openReactBtn = e.target.closest('.btn-open-reaction-picker');
                if (openReactBtn) {
                    const msgId = parseInt(openReactBtn.getAttribute('data-message-id'), 10);
                    document.querySelectorAll('.chat-reaction-popover').forEach(el => el.remove());

                    const popover = document.createElement('div');
                    popover.className = 'chat-reaction-popover position-absolute d-flex align-items-center gap-1 shadow-lg bg-body border border-gray-300';
                    popover.style.bottom = '100%';
                    popover.style.marginBottom = '6px';
                    popover.style.zIndex = '1050';

                    popover.innerHTML = QUICK_REACTIONS.map(em => `
                        <span class="emoji-btn-item btn-quick-react-pop" data-message-id="${msgId}" data-emoji="${em}">${em}</span>
                    `).join('');

                    openReactBtn.parentElement.appendChild(popover);

                    const closeHandler = (ev) => {
                        if (!popover.contains(ev.target) && ev.target !== openReactBtn && !openReactBtn.contains(ev.target)) {
                            popover.remove();
                            document.removeEventListener('click', closeHandler);
                        }
                    };
                    setTimeout(() => document.addEventListener('click', closeHandler), 10);
                    return;
                }

                // J. Quick Reaction Popover Emoji Click
                const popEmoji = e.target.closest('.btn-quick-react-pop');
                if (popEmoji) {
                    const msgId = parseInt(popEmoji.getAttribute('data-message-id'), 10);
                    const emoji = popEmoji.getAttribute('data-emoji');
                    toggleReaction(msgId, emoji);
                    const parentPop = popEmoji.closest('.chat-reaction-popover');
                    if (parentPop) parentPop.remove();
                    return;
                }
            });
        }

        // Initialize Emoji Picker
        initEmojiPicker();
    };

    // Setup Auto-Polling Timers
    const initPolling = () => {
        if (pollConversationTimer) clearInterval(pollConversationTimer);
        if (pollContactsTimer) clearInterval(pollContactsTimer);

        // Poll current conversation every 1.5 seconds for instant realtime sync
        pollConversationTimer = setInterval(() => {
            if (activeUserId && document.visibilityState === 'visible' && !currentEditingMessage) {
                const hasOpenInteraction = !!document.querySelector('#chat_messages_thread .dropdown-menu.show') || 
                                           !!document.querySelector('.chat-reaction-popover');
                if (!hasOpenInteraction) {
                    loadConversation(activeUserId, true);
                }
            }
        }, 1500);

        // Poll contacts list every 6 seconds for unread badges and snippet updates
        pollContactsTimer = setInterval(() => {
            if (document.visibilityState === 'visible') {
                const searchInput = document.getElementById('chat_contact_search_input');
                const query = searchInput ? searchInput.value.trim() : '';
                loadContacts(query, null, true);
            }
        }, 6000);

        // Instant refresh when user switches back to this browser tab
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible' && activeUserId) {
                loadConversation(activeUserId, true);
                loadContacts('', null, true);
            }
        });
    };

    // Initialize
    const init = () => {
        const messenger = document.getElementById('kt_chat_messenger');
        if (!messenger) return;

        initListeners();
        loadContacts('', getTargetInitialUserId());
        initPolling();
    };

    // Auto-init on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    return {
        init: init,
        openChat: (userId) => loadConversation(userId),
        refresh: () => loadContacts('', activeUserId, true)
    };
})();

window.KTAppCustomChat = KTAppCustomChat;
window.KTAppChat = KTAppCustomChat;
