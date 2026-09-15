"use strict";

/**
 * KTIconStyle - KeenIcons Dynamic Style Switcher (Duotone / Solid / Outline)
 * Veltronic / Metronic Theme
 */
var KTIconStyle = (function () {
    var defaultStyle = "duotone";
    var supportedStyles = ["duotone", "solid", "outline"];
    var observer = null;
    var isTransforming = false;

    // Get current active style from localStorage, cookie, attribute, or default
    var getStyle = function () {
        if (document.documentElement && document.documentElement.hasAttribute("data-kt-icon-style")) {
            var attrStyle = document.documentElement.getAttribute("data-kt-icon-style");
            if (supportedStyles.indexOf(attrStyle) !== -1) {
                return attrStyle;
            }
        }

        try {
            var stored = localStorage.getItem("data-kt-icon-style");
            if (stored && supportedStyles.indexOf(stored) !== -1) {
                return stored;
            }
        } catch (e) {}

        var match = document.cookie.match(new RegExp('(^| )kt_icon_style=([^;]+)'));
        if (match && match[2]) {
            var cookieStyle = decodeURIComponent(match[2]);
            if (supportedStyles.indexOf(cookieStyle) !== -1) {
                return cookieStyle;
            }
        }

        return defaultStyle;
    };

    // Update menu links active state
    var updateMenuState = function (style) {
        var menus = document.querySelectorAll('[data-kt-element="icon-style-menu"]');
        menus.forEach(function (menu) {
            var items = menu.querySelectorAll('[data-kt-element="icon-style-item"]');
            items.forEach(function (item) {
                var itemVal = item.getAttribute("data-kt-value");
                if (itemVal === style) {
                    item.classList.add("active");
                } else {
                    item.classList.remove("active");
                }
            });
        });
    };

    // Check if element should be skipped from global icon style transformation
    var shouldSkipElement = function (el) {
        if (!el || el.nodeType !== 1) return true;
        if (el.hasAttribute("data-kt-icon-style-ignore") || el.getAttribute("data-kt-icon-style-ignore") === "true") return true;
        if (el.closest('[data-kt-icon-style-ignore]')) return true;
        if (el.closest('[data-kt-element="icon-style-menu"]')) return true;
        if (el.closest('[data-kt-element="icon-style-toggle"]')) return true;
        if (el.closest('#hub_panel_icons')) return true;
        if (el.closest('#kt_mobile_toolbar_hub_menu')) return true;
        if (el.closest('.mobile-toolbar-hub-menu')) return true;
        if (el.closest('#kt_docs_keenicons_listing')) return true;
        if (el.closest('[data-kt-icon-preview="true"]')) return true;
        if (el.closest('[data-kt-icon-preview]')) return true;
        return false;
    };

    // Apply icon style to a single icon element
    var transformIconElement = function (el, targetStyle) {
        if (shouldSkipElement(el)) return;

        var classList = el.classList;
        var hasDuotone = classList.contains("ki-duotone");
        var hasSolid = classList.contains("ki-solid");
        var hasOutline = classList.contains("ki-outline");

        if (!hasDuotone && !hasSolid && !hasOutline) {
            return;
        }

        var currentClass = hasDuotone ? "ki-duotone" : (hasSolid ? "ki-solid" : "ki-outline");
        var targetClass = "ki-" + targetStyle;

        if (currentClass !== targetClass) {
            classList.remove("ki-duotone", "ki-solid", "ki-outline");
            classList.add(targetClass);
        }

        // When switching to duotone, guarantee path spans exist inside the icon
        if (targetStyle === "duotone") {
            var existingPaths = el.querySelectorAll('[class^="path"]');
            if (existingPaths.length === 0) {
                var fragment = document.createDocumentFragment();
                for (var i = 1; i <= 10; i++) {
                    var span = document.createElement("span");
                    span.className = "path" + i;
                    fragment.appendChild(span);
                }
                el.appendChild(fragment);
            }
        }
    };

    // Transform all KeenIcons in a container
    var applyStyleToElements = function (container, targetStyle) {
        if (!container) container = document.body;
        if (!container) return;

        isTransforming = true;

        var icons = container.querySelectorAll(".ki-duotone, .ki-solid, .ki-outline");
        icons.forEach(function (icon) {
            transformIconElement(icon, targetStyle);
        });

        isTransforming = false;
    };

    // Setup MutationObserver to automatically convert icons in newly added DOM nodes (e.g. modals, ajax)
    var initObserver = function () {
        if (observer || typeof MutationObserver === "undefined") return;

        observer = new MutationObserver(function (mutations) {
            if (isTransforming) return;

            var currentStyle = getStyle();
            mutations.forEach(function (mutation) {
                mutation.addedNodes.forEach(function (node) {
                    if (node.nodeType === 1) { // Element node
                        if (node.matches && (node.matches(".ki-duotone") || node.matches(".ki-solid") || node.matches(".ki-outline"))) {
                            transformIconElement(node, currentStyle);
                        }
                        if (node.querySelectorAll) {
                            var childIcons = node.querySelectorAll(".ki-duotone, .ki-solid, .ki-outline");
                            childIcons.forEach(function (icon) {
                                transformIconElement(icon, currentStyle);
                            });
                        }
                    }
                });
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    };

    // Set icon style globally
    var setStyle = function (style, persist) {
        if (supportedStyles.indexOf(style) === -1) {
            style = defaultStyle;
        }

        // 1. Set root attribute
        document.documentElement.setAttribute("data-kt-icon-style", style);

        // 2. Persist in localStorage and cookie & sync to backend settings
        if (persist !== false) {
            try {
                localStorage.setItem("data-kt-icon-style", style);
                document.cookie = "kt_icon_style=" + style + ";path=/;max-age=31536000;SameSite=Lax";
                if (window.fetch) {
                    fetch('/icon-style/switch/' + encodeURIComponent(style), {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    }).catch(function () {});
                }
            } catch (e) {
                // Ignore storage errors
            }
        }

        // 3. Update active menu state
        updateMenuState(style);

        // 4. Transform all page icons
        applyStyleToElements(document.body, style);

        // 5. Trigger custom event
        if (typeof KTEventHandler !== "undefined") {
            KTEventHandler.trigger(document.documentElement, "kt.iconstyle.change", { style: style });
        } else {
            var event = new CustomEvent("kt.iconstyle.change", { detail: { style: style } });
            document.documentElement.dispatchEvent(event);
        }
    };

    // Initialize module
    var init = function () {
        var activeStyle = getStyle();
        setStyle(activeStyle, true);

        // Bind menu click events
        document.addEventListener("click", function (e) {
            var item = e.target.closest('[data-kt-element="icon-style-item"]');
            if (item) {
                e.preventDefault();
                var styleVal = item.getAttribute("data-kt-value");
                if (styleVal) {
                    setStyle(styleVal, true);
                }
            }
        });

        // Initialize observer for dynamically inserted elements
        initObserver();
    };

    return {
        init: init,
        getStyle: getStyle,
        setStyle: setStyle,
        apply: applyStyleToElements
    };
})();

// Initialize on DOM ready
if (typeof KTUtil !== "undefined" && KTUtil.onDOMContentLoaded) {
    KTUtil.onDOMContentLoaded(function () {
        KTIconStyle.init();
    });
} else {
    document.addEventListener("DOMContentLoaded", function () {
        KTIconStyle.init();
    });
}

if (typeof module !== "undefined" && typeof module.exports !== "undefined") {
    module.exports = KTIconStyle;
}
