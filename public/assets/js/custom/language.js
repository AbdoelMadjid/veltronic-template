"use strict";

/**
 * KTLanguage - Dynamic Bilingual Localization Engine (English / Indonesian)
 * Metronic / Veltronic Template - Realtime language switching without page reload.
 */
var KTLanguage = (function () {
    var defaultLocale = "en";
    var supportedLocales = ["en", "id"];
    var currentLocale = "en";
    var translations = {
        en: {},
        id: {}
    };
    var textMap = {
        en_to_id: {},
        id_to_en: {},
        lower_en_to_id: {},
        lower_id_to_en: {}
    };
    var isTranslating = false;
    var isLoaded = false;
    var observer = null;

    // Flag assets path helper
    var getFlagUrl = function (locale) {
        var base = (typeof hostUrl !== "undefined" && hostUrl) ? hostUrl : "/assets/";
        if (!base.endsWith("/")) base += "/";
        if (locale === "id") {
            return base + "media/flags/indonesia.svg";
        }
        return base + "media/flags/united-states.svg";
    };

    // Get current active language
    var getLanguage = function () {
        if (document.documentElement && document.documentElement.hasAttribute("data-kt-lang")) {
            var attrLang = document.documentElement.getAttribute("data-kt-lang");
            if (supportedLocales.indexOf(attrLang) !== -1) {
                return attrLang;
            }
        }

        if (window.KTLanguageConfig && window.KTLanguageConfig.currentLocale) {
            var cfgLang = window.KTLanguageConfig.currentLocale;
            if (supportedLocales.indexOf(cfgLang) !== -1) {
                return cfgLang;
            }
        }

        try {
            var stored = localStorage.getItem("data-kt-lang");
            if (stored && supportedLocales.indexOf(stored) !== -1) {
                return stored;
            }
        } catch (e) {
            // LocalStorage might be restricted
        }

        // Cookie fallback
        var match = document.cookie.match(new RegExp("(^| )kt_lang=([^;]+)"));
        if (match && match[2]) {
            var cookieLocale = decodeURIComponent(match[2]);
            if (supportedLocales.indexOf(cookieLocale) !== -1) {
                return cookieLocale;
            }
        }

        return defaultLocale;
    };

    // Built-in core translations for instant fallback
    var coreTranslations = {
        en: {
            "menu.dashboards": "Dashboards",
            "menu.pages": "Pages",
            "menu.apps": "Apps",
            "menu.layouts": "Layouts",
            "menu.help": "Help",
            "menu.demo": "Demo",
            "menu.widgets_demos": "Widgets Demos",
            "menu.homepage": "Homepage",
            "menu.my_profile": "My Profile",
            "menu.my_projects": "My Projects",
            "menu.my_subscription": "My Subscription",
            "menu.referrals": "Referrals",
            "menu.billing": "Billing",
            "menu.payments": "Payments",
            "menu.statements": "Statements",
            "menu.my_statements": "My Statements",
            "menu.account_settings": "Account Settings",
            "menu.notifications": "Notifications",
            "menu.sign_out": "Sign Out",
            "menu.english": "English",
            "menu.indonesian": "Indonesian",
            "menu.overview": "Overview",
            "menu.settings": "Settings",
            "menu.security": "Security",
            "menu.activity": "Activity",
            "menu.api_keys": "API Keys",
            "menu.logs": "Logs",
            "menu.documents": "Documents",
            "menu.followers": "Followers",
            "menu.projects": "Projects",
            "menu.campaigns": "Campaigns",
            "menu.search_menu_placeholder": "Search menu...",
            "menu.search_menu_not_found": "No menu items found.",
            "menu.show": "Show",
            "menu.more": "more",
            "menu.show_less": "Show less",
            "menu.language_selection": "Language",
            "menu.home": "Home",
            "auth.english": "English",
            "auth.indonesian": "Bahasa Indonesia",
            "auth.terms": "Terms",
            "auth.plans": "Plans",
            "auth.contact_us": "Contact Us"
        },
        id: {
            "menu.dashboards": "Dasbor",
            "menu.pages": "Halaman",
            "menu.apps": "Aplikasi",
            "menu.layouts": "Tata Letak",
            "menu.help": "Bantuan",
            "menu.demo": "Demo",
            "menu.widgets_demos": "Demo Widget",
            "menu.homepage": "Beranda",
            "menu.my_profile": "Profil Saya",
            "menu.my_projects": "Proyek Saya",
            "menu.my_subscription": "Langganan Saya",
            "menu.referrals": "Referral",
            "menu.billing": "Tagihan",
            "menu.payments": "Pembayaran",
            "menu.statements": "Laporan",
            "menu.my_statements": "Laporan Saya",
            "menu.account_settings": "Pengaturan Akun",
            "menu.notifications": "Notifikasi",
            "menu.sign_out": "Keluar",
            "menu.english": "Bahasa Inggris",
            "menu.indonesian": "Bahasa Indonesia",
            "menu.overview": "Ringkasan",
            "menu.settings": "Pengaturan",
            "menu.security": "Keamanan",
            "menu.activity": "Aktivitas",
            "menu.api_keys": "Kunci API",
            "menu.logs": "Log Aktivitas",
            "menu.documents": "Dokumen",
            "menu.followers": "Pengikut",
            "menu.projects": "Proyek",
            "menu.campaigns": "Kampanye",
            "menu.search_menu_placeholder": "Cari menu...",
            "menu.search_menu_not_found": "Menu tidak ditemukan.",
            "menu.show": "Tampilkan",
            "menu.more": "lainnya",
            "menu.show_less": "Tampilkan lebih sedikit",
            "menu.language_selection": "Pilihan Bahasa",
            "menu.home": "Beranda",
            "auth.english": "Bahasa Inggris",
            "auth.indonesian": "Bahasa Indonesia",
            "auth.terms": "Ketentuan",
            "auth.plans": "Paket",
            "auth.contact_us": "Hubungi Kami"
        }
    };

    // Load payload from memory or config
    var ingestPayload = function (data) {
        if (!data) return;
        if (data.translations) {
            translations.en = Object.assign({}, translations.en, data.translations.en || {});
            translations.id = Object.assign({}, translations.id, data.translations.id || {});
        }
        if (data.textMap) {
            textMap.en_to_id = Object.assign({}, textMap.en_to_id, data.textMap.en_to_id || {});
            textMap.id_to_en = Object.assign({}, textMap.id_to_en, data.textMap.id_to_en || {});
            textMap.lower_en_to_id = Object.assign({}, textMap.lower_en_to_id, data.textMap.lower_en_to_id || {});
            textMap.lower_id_to_en = Object.assign({}, textMap.lower_id_to_en, data.textMap.lower_id_to_en || {});
        }
        isLoaded = true;
    };

    // Build initial text mappings from core translations
    var populateInitialDictionaries = function () {
        translations.en = Object.assign({}, coreTranslations.en);
        translations.id = Object.assign({}, coreTranslations.id);

        for (var k in coreTranslations.en) {
            if (coreTranslations.en.hasOwnProperty(k) && coreTranslations.id[k]) {
                var enText = coreTranslations.en[k];
                var idText = coreTranslations.id[k];
                if (enText !== idText) {
                    textMap.en_to_id[enText] = idText;
                    textMap.id_to_en[idText] = enText;
                    textMap.lower_en_to_id[enText.toLowerCase()] = idText;
                    textMap.lower_id_to_en[idText.toLowerCase()] = enText;
                }
            }
        }

        // 1. Check window.KTLanguageConfig.payload injected directly by Blade
        if (window.KTLanguageConfig && window.KTLanguageConfig.payload) {
            ingestPayload(window.KTLanguageConfig.payload);
        }

        // 2. Try localStorage cache (v3 with help-exempt)
        if (!isLoaded) {
            try {
                var cached = localStorage.getItem("kt_translations_cache");
                if (cached) {
                    var parsed = JSON.parse(cached);
                    if (parsed && parsed.v === 3) {
                        ingestPayload(parsed);
                    } else {
                        localStorage.removeItem("kt_translations_cache");
                    }
                }
            } catch (e) { }
        }
    };

    // Load full translation dictionary from backend if needed
    var loadTranslations = function () {
        var endpoint = (window.KTLanguageConfig && window.KTLanguageConfig.translationsUrl)
            ? window.KTLanguageConfig.translationsUrl
            : "/lang/translations.json";

        fetch(endpoint, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "application/json"
            }
        })
            .then(function (response) {
                if (!response.ok) throw new Error("Network error fetching translations");
                return response.json();
            })
            .then(function (data) {
                if (data) {
                    ingestPayload(data);

                    // Update localStorage cache
                    try {
                        localStorage.setItem("kt_translations_cache", JSON.stringify({
                            v: 3,
                            translations: translations,
                            textMap: textMap,
                            timestamp: Date.now()
                        }));
                    } catch (e) { }

                    // Re-apply translation across the entire page
                    applyTranslations(document.body, currentLocale);
                }
            })
            .catch(function (err) {
                // If offline or endpoint error, payload or coreTranslations is already active
            });
    };

    // Translate string key with smart prefix lookup & dictionary fallback
    var translate = function (key, locale) {
        if (!locale) locale = currentLocale;
        if (!key) return null;

        var dict = translations[locale] || {};

        // 1. Direct key match (e.g. 'menu.dashboards')
        if (typeof dict[key] !== "undefined") {
            return dict[key];
        }

        // 2. Prefixed search (e.g. 'dashboards' -> 'menu.dashboards')
        var prefixes = ["menu.", "help.", "auth.", "education.", "passwords."];
        for (var i = 0; i < prefixes.length; i++) {
            var fullKey = prefixes[i] + key;
            if (typeof dict[fullKey] !== "undefined") {
                return dict[fullKey];
            }
        }

        // 3. Normalized slug check (e.g. 'menu.skema_pergantian_icon')
        var cleanKey = key.replace(/^(menu|help|auth|education|passwords)\./, "");
        var slug = cleanKey.toLowerCase().replace(/[\s\&\/\-]+/g, "_");
        for (var j = 0; j < prefixes.length; j++) {
            var slugKey = prefixes[j] + slug;
            if (typeof dict[slugKey] !== "undefined") {
                return dict[slugKey];
            }
        }

        // 4. Fallback: check textMap directly using key as phrase
        var map = locale === "id" ? textMap.en_to_id : textMap.id_to_en;
        var lowerMap = locale === "id" ? textMap.lower_en_to_id : textMap.lower_id_to_en;
        if (map && map[key]) {
            return map[key];
        }
        if (lowerMap && lowerMap[key.toLowerCase()]) {
            return lowerMap[key.toLowerCase()];
        }

        return null;
    };

    // Translate single phrase/text bidirectionally
    var translateText = function (text, locale) {
        if (!text || typeof text !== "string") return null;
        var trimmed = text.trim();
        if (!trimmed || trimmed.length < 2) return null;

        var map = locale === "id" ? textMap.en_to_id : textMap.id_to_en;
        var lowerMap = locale === "id" ? textMap.lower_en_to_id : textMap.lower_id_to_en;

        // 1. Exact match
        if (map && map[trimmed]) {
            return map[trimmed];
        }

        // 2. Lowercase match with case preservation
        var lower = trimmed.toLowerCase();
        if (lowerMap && lowerMap[lower]) {
            var translated = lowerMap[lower];
            if (trimmed === trimmed.toUpperCase() && trimmed.length > 2) {
                return translated.toUpperCase();
            } else if (trimmed.charAt(0) === trimmed.charAt(0).toUpperCase() && trimmed.length > 1 && trimmed.charAt(1) === trimmed.charAt(1).toLowerCase()) {
                return translated.charAt(0).toUpperCase() + translated.slice(1);
            }
            return translated;
        }

        return null;
    };

    // Update UI controls (flags, active states, labels)
    var updateUIControls = function (locale) {
        var flagUrl = getFlagUrl(locale);
        var flagAlt = locale === "id" ? "Indonesia" : "English";
        var labelText = locale === "id" ? "Bahasa Indonesia" : "English";

        // 1. Update current flag image elements
        var flagImgs = document.querySelectorAll('[data-kt-element="lang-flag-current"]');
        flagImgs.forEach(function (img) {
            img.setAttribute("src", flagUrl);
            img.setAttribute("alt", flagAlt);
        });

        // Also check header dropdown triggers without data-kt-element
        var navbarLangToggles = document.querySelectorAll('.app-navbar-item [data-kt-element="lang-toggle"] img');
        navbarLangToggles.forEach(function (img) {
            img.setAttribute("src", flagUrl);
            img.setAttribute("alt", flagAlt);
        });

        // 2. Update active status on all language menu items
        var langItems = document.querySelectorAll('[data-kt-element="lang-item"], [data-kt-lang-value]');
        langItems.forEach(function (item) {
            var val = item.getAttribute("data-kt-value") || item.getAttribute("data-kt-lang-value");
            if (val === locale) {
                item.classList.add("active");
            } else {
                item.classList.remove("active");
            }
        });

        // 3. Update active checkmark icons
        var checkIcons = document.querySelectorAll('[data-kt-lang-check]');
        checkIcons.forEach(function (icon) {
            var iconLocale = icon.getAttribute("data-kt-lang-check");
            if (iconLocale === locale) {
                icon.classList.remove("d-none");
            } else {
                icon.classList.add("d-none");
            }
        });

        // 4. Update mobile active language label if exists
        var mobileLabel = document.getElementById("mobile_active_lang_label");
        if (mobileLabel) {
            mobileLabel.textContent = labelText;
        }

        // 5. Update generic labels
        var labels = document.querySelectorAll('[data-kt-element="lang-current-label"]');
        labels.forEach(function (el) {
            el.textContent = labelText;
        });
    };

    // Check if element should be skipped from text translation
    var shouldSkipElement = function (el) {
        if (!el || el.nodeType !== 1) return true;
        if (el.hasAttribute("data-kt-lang-ignore") || el.getAttribute("data-kt-lang-ignore") === "true") return true;
        if (el.closest('[data-kt-lang-ignore="true"], [data-kt-lang-ignore], .schema-shell, .schema-hero, .schema-card, [data-help-page], [data-kt-ignore-lang]')) return true;
        if (el.matches("script, style, code, pre, textarea, [contenteditable]")) return true;
        return false;
    };

    // Traverse and translate all visible text nodes in the DOM
    var translateAllTextNodes = function (root, locale) {
        var walker = document.createTreeWalker(
            root || document.body,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode: function (node) {
                    if (!node || !node.nodeValue) return NodeFilter.FILTER_REJECT;
                    var text = node.nodeValue.trim();
                    if (!text || text.length < 2) return NodeFilter.FILTER_REJECT;
                    var parent = node.parentElement;
                    if (!parent || shouldSkipElement(parent)) {
                        return NodeFilter.FILTER_REJECT;
                    }
                    return NodeFilter.FILTER_ACCEPT;
                }
            },
            false
        );

        var nodesToReplace = [];
        var node;
        while ((node = walker.nextNode())) {
            nodesToReplace.push(node);
        }

        nodesToReplace.forEach(function (textNode) {
            var raw = textNode.nodeValue;
            var trimmed = raw.trim();
            if (!trimmed) return;

            var translated = translateText(trimmed, locale);
            if (translated !== null && translated !== trimmed) {
                textNode.nodeValue = raw.replace(trimmed, translated);
            }
        });
    };

    // Apply translations to elements in container
    var applyTranslations = function (container, locale) {
        if (!container) container = document.body;
        if (!container) return;

        isTranslating = true;

        // A. Process explicit data-kt-translate attributes
        var explicitElements = container.querySelectorAll("[data-kt-translate]");
        explicitElements.forEach(function (el) {
            if (shouldSkipElement(el)) return;
            var key = el.getAttribute("data-kt-translate");
            var translated = translate(key, locale);
            if (translated !== null) {
                el.textContent = translated;
            } else {
                // Fallback: translate by existing text content
                var currentTxt = el.textContent.trim();
                var textTranslated = translateText(currentTxt, locale);
                if (textTranslated !== null) {
                    el.textContent = textTranslated;
                }
            }
        });

        // B. Process explicit placeholders
        var placeholderElements = container.querySelectorAll("[data-kt-translate-placeholder], input[placeholder], textarea[placeholder]");
        placeholderElements.forEach(function (el) {
            if (shouldSkipElement(el)) return;
            var key = el.getAttribute("data-kt-translate-placeholder");
            if (key) {
                var translated = translate(key, locale);
                if (translated !== null) {
                    el.setAttribute("placeholder", translated);
                    return;
                }
            }
            var currentPh = el.getAttribute("placeholder");
            if (currentPh) {
                var phTranslated = translateText(currentPh.trim(), locale);
                if (phTranslated !== null) {
                    el.setAttribute("placeholder", phTranslated);
                }
            }
        });

        // C. Process explicit titles/tooltips
        var titleElements = container.querySelectorAll("[data-kt-translate-title]");
        titleElements.forEach(function (el) {
            if (shouldSkipElement(el)) return;
            var key = el.getAttribute("data-kt-translate-title");
            if (key) {
                var translated = translate(key, locale);
                if (translated !== null) {
                    el.setAttribute("title", translated);
                    if (el.hasAttribute("data-bs-original-title")) {
                        el.setAttribute("data-bs-original-title", translated);
                    }
                }
            }
        });

        // D. Process bilingual paired attributes: data-kt-lang-en & data-kt-lang-id
        var dualLangElements = container.querySelectorAll("[data-kt-lang-en], [data-kt-lang-id]");
        dualLangElements.forEach(function (el) {
            if (shouldSkipElement(el)) return;
            var targetText = locale === "id" ? el.getAttribute("data-kt-lang-id") : el.getAttribute("data-kt-lang-en");
            if (targetText) {
                el.textContent = targetText;
            }
        });

        // E. Universal Live TreeWalker DOM Translation across all visible nodes
        translateAllTextNodes(container, locale);

        isTranslating = false;
    };

    // Setup MutationObserver for dynamically added nodes (modals, ajax, tabs)
    var observerTimeout = null;
    var initObserver = function () {
        if (observer || typeof MutationObserver === "undefined") return;

        observer = new MutationObserver(function (mutations) {
            if (isTranslating) return;

            var pendingElements = [];
            mutations.forEach(function (mutation) {
                mutation.addedNodes.forEach(function (node) {
                    if (node.nodeType === 1 && !shouldSkipElement(node)) {
                        pendingElements.push(node);
                    }
                });
            });

            if (pendingElements.length > 0) {
                clearTimeout(observerTimeout);
                observerTimeout = setTimeout(function () {
                    pendingElements.forEach(function (el) {
                        applyTranslations(el, currentLocale);
                    });
                }, 50);
            }
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    };

    // Set Language globally
    var setLanguage = function (locale, persist, syncServer) {
        if (supportedLocales.indexOf(locale) === -1) {
            locale = defaultLocale;
        }

        currentLocale = locale;

        // 1. Update root attributes
        document.documentElement.setAttribute("data-kt-lang", locale);
        document.documentElement.setAttribute("lang", locale);

        // 2. Persist state in localStorage and Cookie
        if (persist !== false) {
            try {
                localStorage.setItem("data-kt-lang", locale);
                document.cookie = "kt_lang=" + locale + ";path=/;max-age=31536000;SameSite=Lax";
            } catch (e) {
                // Ignore storage error
            }
        }

        // 3. Sync with Laravel Backend Session asynchronously without page reload
        if (syncServer !== false) {
            var switchBase = (window.KTLanguageConfig && window.KTLanguageConfig.switchUrl)
                ? window.KTLanguageConfig.switchUrl
                : "/lang";
            var syncUrl = switchBase.replace(/\/+$/, "") + "/" + locale;

            fetch(syncUrl, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Accept": "application/json"
                }
            }).catch(function (err) {
                // Background sync error ignored
            });
        }

        // 4. Update UI controls (flags, active links)
        updateUIControls(locale);

        // 5. Apply live translations across entire DOM
        applyTranslations(document.body, locale);

        // 6. Dispatch custom event for external subscribers
        var eventDetail = { locale: locale };
        if (typeof KTEventHandler !== "undefined") {
            KTEventHandler.trigger(document.documentElement, "kt.lang.change", eventDetail);
        } else {
            var event = new CustomEvent("kt.lang.change", { detail: eventDetail });
            document.documentElement.dispatchEvent(event);
        }
    };

    // Initialize module
    var init = function () {
        populateInitialDictionaries();
        currentLocale = getLanguage();
        updateUIControls(currentLocale);

        // Only translate DOM on startup if active locale differs from default or explicit elements exist
        if (currentLocale !== defaultLocale) {
            applyTranslations(document.body, currentLocale);
        }

        loadTranslations();

        // Bind global click listener for language switchers
        document.addEventListener("click", function (e) {
            var item = e.target.closest('[data-kt-element="lang-item"], [data-kt-lang-value], .mobile-lang-item');
            if (item) {
                e.preventDefault();
                var targetLocale = item.getAttribute("data-kt-value") || item.getAttribute("data-kt-lang-value");
                if (targetLocale) {
                    setLanguage(targetLocale, true, true);
                }
            }
        });

        // Initialize observer for dynamic content
        initObserver();
    };

    return {
        init: init,
        getLanguage: getLanguage,
        setLanguage: setLanguage,
        translate: translate,
        translateText: translateText,
        apply: applyTranslations
    };
})();

// Initialize on DOM ready
if (typeof KTUtil !== "undefined" && KTUtil.onDOMContentLoaded) {
    KTUtil.onDOMContentLoaded(function () {
        KTLanguage.init();
    });
} else {
    document.addEventListener("DOMContentLoaded", function () {
        KTLanguage.init();
    });
}

if (typeof module !== "undefined" && typeof module.exports !== "undefined") {
    module.exports = KTLanguage;
}
