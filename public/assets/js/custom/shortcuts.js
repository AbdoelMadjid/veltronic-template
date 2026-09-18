/**
 * Modular Dynamic Global Keyboard Shortcuts Manager (Role-Filtered & Database-Backed)
 * Veltronic Template - public/assets/js/custom/shortcuts.js
 */

window.KTAppShortcuts = (function () {
    'use strict';

    let isShortcutsEnabled = true;
    let registeredShortcuts = [];
    const customActionHandlers = {};

    // Helper: Get CSRF Token
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    }

    const defaultFallbackShortcuts = [
        { name: 'Toggle Fitur & Tools di Topbar Navbar', key: 't', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'toggle_topbar_tools', action_target: 'topbar_tools' },
        { name: 'Toggle Menu Utama di Topbar Header', key: 'h', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'toggle_topbar_menus', action_target: 'topbar_menus' },
        { name: 'Toggle Menu Template di Sidebar', key: 'm', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'toggle_sidebar_menus', action_target: 'sidebar_menus' },
        { name: 'Beralih Mode Gelap & Terang', key: 'b', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'theme_mode', action_target: 'theme_mode' },
        { name: 'Pilihan Bahasa: Indonesia', key: 'i', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'switch_language', action_target: 'id' },
        { name: 'Pilihan Bahasa: English', key: 'e', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'switch_language', action_target: 'en' },
        { name: 'Pilihan Versi: Layout Versi 1', key: '1', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'switch_version', action_target: 'v1' },
        { name: 'Pilihan Versi: Layout Versi 2', key: '2', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'switch_version', action_target: 'v2' },
        { name: 'Pencarian Cepat Global (Global Search)', key: 'f', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'search', action_target: 'global_search' },
        { name: 'Kunci Layar Pengguna (Lock Screen)', key: 'l', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'lock_screen', action_target: 'lock_screen' },
        { name: 'Gaya Ikon: Duotone', key: 'd', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'icon_style', action_target: 'duotone' },
        { name: 'Gaya Ikon: Solid', key: 's', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'icon_style', action_target: 'solid' },
        { name: 'Gaya Ikon: Outline', key: 'o', ctrl: true, alt: true, shift: false, meta: false, is_enabled: true, action_type: 'icon_style', action_target: 'outline' }
    ];

    // Initialize registeredShortcuts with defaults immediately
    registeredShortcuts = [...defaultFallbackShortcuts];

    /**
     * Fetch active shortcuts allowed for current authenticated user
     */
    function loadUserShortcuts() {
        fetch('/appsupport/shortcuts-active', {
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
            if (data && data.success && Array.isArray(data.shortcuts) && data.shortcuts.length > 0) {
                registeredShortcuts = data.shortcuts;
            } else {
                registeredShortcuts = [...defaultFallbackShortcuts];
            }
        })
        .catch(err => {
            registeredShortcuts = [...defaultFallbackShortcuts];
        });
    }

    // =========================================================================
    // MODULAR HANDLER 1: VISIBILITY TOGGLES
    // =========================================================================

    function toggleElementsBySelector(selector, category, successMsg, hideMsg, showNotify = true) {
        const elements = document.querySelectorAll(selector);
        if (elements.length === 0) {
            if (showNotify && typeof Notify !== 'undefined') {
                Notify.info(`Tidak ada elemen target "${selector}" pada halaman ini.`);
            }
            return;
        }

        let anyVisible = false;
        elements.forEach(el => {
            const isHidden = el.classList.contains('d-none') || 
                             el.classList.contains('feature-hidden') || 
                             el.style.display === 'none';
            if (!isHidden) anyVisible = true;
        });

        const nextShow = !anyVisible;

        // 1. Instant DOM update
        elements.forEach(el => {
            if (nextShow) {
                el.classList.remove('d-none', 'feature-hidden');
                el.style.removeProperty('display');
            } else {
                el.classList.add('d-none', 'feature-hidden');
                el.style.setProperty('display', 'none', 'important');
            }
        });

        // 2. Sync cards in app-fiturs page if currently open
        if (category) {
            const cardWrapper = document.querySelector(`.feature-card-wrapper[data-category="${category}"]`);
            if (cardWrapper) {
                const cards = cardWrapper.querySelectorAll('.feature-card');
                cards.forEach(card => {
                    card.setAttribute('data-is-enabled', nextShow ? '1' : '0');
                    card.dataset.isEnabled = nextShow ? '1' : '0';
                    const badge = card.querySelector('.feature-status-badge');
                    if (nextShow) {
                        card.classList.remove('bg-light', 'opacity-75');
                        if (badge) {
                            badge.className = 'badge badge-light-success fs-8 fw-semibold feature-status-badge mt-1';
                            badge.innerText = 'Aktif';
                        }
                    } else {
                        card.classList.add('bg-light', 'opacity-75');
                        if (badge) {
                            badge.className = 'badge badge-light-danger fs-8 fw-semibold feature-status-badge mt-1';
                            badge.innerText = 'Tersembunyi';
                        }
                    }
                });

                const statEl = document.getElementById(`stat_${category.replace('_menus', '').replace('topbar_', '')}_active`);
                if (statEl) {
                    const total = cards.length;
                    statEl.innerText = nextShow ? `${total}/${total}` : `0/${total}`;
                }
            }

            // 3. Persist state to server database via bulk-toggle endpoint
            fetch('/appsupport/app-fiturs/bulk-toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    action: nextShow ? 'enable_all' : 'disable_all',
                    category: category
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.stats && typeof updateStatsFromData === 'function') {
                    updateStatsFromData(data.stats);
                }
            })
            .catch(err => {
                console.error(`Failed to persist ${category} state:`, err);
            });
        }

        if (showNotify && typeof Notify !== 'undefined') {
            if (nextShow) {
                Notify.success(successMsg || 'Komponen berhasil ditampilkan.');
            } else {
                Notify.info(hideMsg || 'Komponen berhasil disembunyikan.');
            }
        }
    }

    function toggleTopbarTools(showNotify = true) {
        toggleElementsBySelector(
            '[data-kt-feature-tool]',
            'topbar_tools',
            'Fitur & Tools di Topbar Navbar berhasil ditampilkan.',
            'Fitur & Tools di Topbar Navbar berhasil disembunyikan.',
            showNotify
        );
    }

    function toggleTopbarMenus(showNotify = true) {
        toggleElementsBySelector(
            '[data-kt-feature-menu]',
            'topbar_menus',
            'Menu Utama di Topbar Header berhasil ditampilkan.',
            'Menu Utama di Topbar Header berhasil disembunyikan.',
            showNotify
        );
    }

    function toggleSidebarTemplateMenus(showNotify = true) {
        toggleElementsBySelector(
            '[data-kt-feature-sidebar]',
            'sidebar_menus',
            'Menu Template di Sidebar berhasil ditampilkan.',
            'Menu Template di Sidebar berhasil disembunyikan.',
            showNotify
        );
    }

    function toggleCustomVisibility(selector, showNotify = true) {
        if (!selector) return;
        toggleElementsBySelector(selector, null, `Elemen "${selector}" ditampilkan.`, `Elemen "${selector}" disembunyikan.`, showNotify);
    }

    // =========================================================================
    // MODULAR HANDLER 2: NAVIGATION & URL
    // =========================================================================

    function triggerOpenUrl(url) {
        if (url) {
            if (typeof Notify !== 'undefined') {
                Notify.info(`Membuka halaman: ${url}`);
            }
            window.location.href = url;
        }
    }

    // =========================================================================
    // MODULAR HANDLER 3: APPEARANCE & THEME & ICON STYLE
    // =========================================================================

    function toggleThemeMode() {
        if (typeof KTThemeMode !== 'undefined' && KTThemeMode.getMode) {
            const currentMode = KTThemeMode.getMode();
            const nextMode = (currentMode === 'dark') ? 'light' : 'dark';
            KTThemeMode.setMode(nextMode);
            if (typeof Notify !== 'undefined') {
                Notify.success(`Beralih ke mode ${nextMode === 'dark' ? 'Gelap (Dark)' : 'Terang (Light)'}.`);
            }
        }
    }

    function switchIconStyle(style) {
        const targetStyle = (style || 'duotone').toLowerCase();
        if (typeof KTIconStyle !== 'undefined' && KTIconStyle.setStyle) {
            KTIconStyle.setStyle(targetStyle, true);
            const styleLabels = {
                'duotone': 'Duotone',
                'solid': 'Solid',
                'outline': 'Outline'
            };
            const label = styleLabels[targetStyle] || (targetStyle.charAt(0).toUpperCase() + targetStyle.slice(1));
            if (typeof Notify !== 'undefined') {
                Notify.success(`Gaya Ikon berhasil diubah ke: ${label}`);
            }
        }
    }

    function switchLanguage(locale) {
        const targetLocale = (locale || 'id').toLowerCase();
        if (typeof KTLanguage !== 'undefined' && KTLanguage.setLanguage) {
            KTLanguage.setLanguage(targetLocale, true, true);
            const label = targetLocale === 'id' ? 'Bahasa Indonesia' : 'English';
            if (typeof Notify !== 'undefined') {
                Notify.success(`Bahasa berhasil diubah ke: ${label}`);
            }
        } else {
            fetch(`/lang/${targetLocale}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(() => {
                window.location.reload();
            });
        }
    }

    function switchThemeVersion(version) {
        const targetVersion = (version || 'v1').toLowerCase();
        fetch(`/theme/version/${targetVersion}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json().catch(() => ({ status: 'success' })))
        .then(() => {
            if (typeof Notify !== 'undefined') {
                Notify.success(`Layout berhasil beralih ke Versi: ${targetVersion.toUpperCase()}`);
            }
            setTimeout(() => {
                window.location.reload();
            }, 300);
        })
        .catch(() => {
            window.location.href = `/theme/version/${targetVersion}`;
        });
    }

    // =========================================================================
    // MODULAR HANDLER 4: SYSTEM & UTILITIES
    // =========================================================================

    function triggerGlobalSearch() {
        const searchInput = document.getElementById('kt_app_sidebar_menu_search_input');
        const searchBtn = document.querySelector('[data-kt-feature-tool="tool_search"]') || 
                          document.querySelector('[data-kt-search-element="toggle"]');
        
        if (searchBtn) {
            searchBtn.click();
        } else if (searchInput) {
            searchInput.focus();
            if (typeof Notify !== 'undefined') {
                Notify.info('Fokus ke pencarian menu sidebar.');
            }
        }
    }

    function triggerLockScreen() {
        if (typeof KTLockScreen !== 'undefined' && KTLockScreen.lock) {
            KTLockScreen.lock();
        }
    }

    // =========================================================================
    // MODULAR HANDLER 5: ELEMENT CLICKS
    // =========================================================================

    function triggerClickElement(selector) {
        if (selector) {
            const el = document.querySelector(selector);
            if (el) {
                el.click();
                if (typeof Notify !== 'undefined') {
                    Notify.success(`Memicu aksi pada elemen: ${selector}`);
                }
            } else if (typeof Notify !== 'undefined') {
                Notify.warning(`Elemen target "${selector}" tidak ditemukan pada halaman ini.`);
            }
        }
    }

    // =========================================================================
    // MODULAR ACTION REGISTRY (Extensible & Decoupled)
    // =========================================================================

    const ActionRegistry = {
        // Visibility
        'toggle_topbar_tools': () => toggleTopbarTools(true),
        'toggle_topbar_menus': () => toggleTopbarMenus(true),
        'toggle_sidebar_menus': () => toggleSidebarTemplateMenus(true),
        'visibility_toggle': (sc) => toggleCustomVisibility(sc.action_target, true),

        // Navigation
        'open_url': (sc) => triggerOpenUrl(sc.action_target),
        'nav_link': (sc) => triggerOpenUrl(sc.action_target),

        // Appearance & Localization & Version
        'theme_mode': () => toggleThemeMode(),
        'switch_language': (sc) => switchLanguage(sc.action_target || 'id'),
        'switch_version': (sc) => switchThemeVersion(sc.action_target || 'v1'),
        'lang_id': () => switchLanguage('id'),
        'lang_en': () => switchLanguage('en'),
        'version_v1': () => switchThemeVersion('v1'),
        'version_v2': () => switchThemeVersion('v2'),
        'icon_style': (sc) => switchIconStyle(sc.action_target || 'duotone'),
        'icon_duotone': () => switchIconStyle('duotone'),
        'icon_solid': () => switchIconStyle('solid'),
        'icon_outline': () => switchIconStyle('outline'),

        // System
        'search': () => triggerGlobalSearch(),
        'lock_screen': () => triggerLockScreen(),

        // Click Element
        'click_element': (sc) => triggerClickElement(sc.action_target)
    };

    /**
     * Register a new modular action handler
     */
    function registerActionHandler(actionType, handlerFn) {
        if (typeof handlerFn === 'function') {
            customActionHandlers[actionType] = handlerFn;
        }
    }

    /**
     * Execute arbitrary shortcut action by definition
     */
    function executeShortcutAction(shortcut) {
        if (!shortcut) return;

        const actionType = shortcut.action_type;

        // 1. Check custom registered handlers
        if (typeof customActionHandlers[actionType] === 'function') {
            customActionHandlers[actionType](shortcut);
            return;
        }

        // 2. Check standard built-in Action Registry
        if (typeof ActionRegistry[actionType] === 'function') {
            ActionRegistry[actionType](shortcut);
            return;
        }

        // 3. Fallback heuristic execution based on target
        if (shortcut.action_target && (shortcut.action_target.startsWith('/') || shortcut.action_target.startsWith('http'))) {
            triggerOpenUrl(shortcut.action_target);
        } else if (shortcut.action_target && (shortcut.action_target.startsWith('#') || shortcut.action_target.startsWith('.'))) {
            triggerClickElement(shortcut.action_target);
        } else if (typeof Notify !== 'undefined') {
            Notify.warning(`Tipe aksi "${actionType}" belum memiliki penangan khusus.`);
        }
    }

    /**
     * Keydown Event Dispatcher
     */
    function handleKeyDown(e) {
        if (!isShortcutsEnabled) return;

        const activeEl = document.activeElement;
        const tagName = activeEl ? activeEl.tagName.toLowerCase() : '';
        const isEditable = activeEl && (activeEl.isContentEditable || tagName === 'input' || tagName === 'textarea' || tagName === 'select');

        const isCtrl = Boolean(e.ctrlKey || e.metaKey);
        const isAlt = Boolean(e.altKey);
        const isShift = Boolean(e.shiftKey);
        const pressedKey = (e.key || '').toLowerCase();
        const pressedCode = (e.code || '').toLowerCase();

        for (let i = 0; i < registeredShortcuts.length; i++) {
            const sc = registeredShortcuts[i];
            if (sc.is_enabled === false || sc.is_enabled === 0 || sc.is_enabled === '0') continue;

            const targetKey = String(sc.key || '').toLowerCase().trim();
            const needCtrl = Boolean(sc.ctrl || sc.meta);
            const needAlt = Boolean(sc.alt);
            const needShift = Boolean(sc.shift);

            // Strict modifier check
            if ((isCtrl !== needCtrl) || (isAlt !== needAlt) || (isShift !== needShift)) {
                continue;
            }

            // Dual match: by key value OR physical key code (prevents issues with international layouts & AltGr)
            const keyMatches = (pressedKey === targetKey) ||
                               (pressedCode === 'key' + targetKey) ||
                               (pressedCode === 'digit' + targetKey) ||
                               (pressedCode === 'numpad' + targetKey) ||
                               (targetKey === '/' && (pressedCode === 'slash' || pressedKey === '/'));

            if (keyMatches) {
                // If user is typing in form field, allow visibility toggles, skip others
                const isVisibilityToggle = ['toggle_sidebar_menus', 'toggle_topbar_tools', 'toggle_topbar_menus', 'visibility_toggle'].includes(sc.action_type);
                if (isEditable && !isVisibilityToggle) {
                    continue;
                }

                e.preventDefault();
                executeShortcutAction(sc);
                return;
            }
        }
    }

    // Initialize immediately or on DOM Ready
    function init() {
        loadUserShortcuts();
        document.removeEventListener('keydown', handleKeyDown);
        document.addEventListener('keydown', handleKeyDown);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    return {
        reloadShortcuts: loadUserShortcuts,
        setShortcutsList: function (list) {
            if (Array.isArray(list)) registeredShortcuts = list;
        },
        getShortcutsList: function () {
            return registeredShortcuts;
        },
        registerActionHandler: registerActionHandler,
        executeAction: executeShortcutAction,

        // Direct modular triggers
        toggleTopbarTools: toggleTopbarTools,
        toggleTopbarMenus: toggleTopbarMenus,
        toggleSidebarTemplateMenus: toggleSidebarTemplateMenus,
        toggleCustomVisibility: toggleCustomVisibility,
        triggerGlobalSearch: triggerGlobalSearch,
        toggleThemeMode: toggleThemeMode,
        switchIconStyle: switchIconStyle,
        triggerLockScreen: triggerLockScreen,
        triggerOpenUrl: triggerOpenUrl,
        triggerClickElement: triggerClickElement,

        setEnabled: function (enabled) {
            isShortcutsEnabled = Boolean(enabled);
        },
        isEnabled: function () {
            return isShortcutsEnabled;
        }
    };
})();
