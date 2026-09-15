<!--begin::Icon style setup on page load (Anti-Flicker)-->
<script>
    (function () {
        var serverIconStyle = "{{ getActiveIconStyle() }}";
        var supportedStyles = ["duotone", "solid", "outline"];
        var iconStyle = serverIconStyle && supportedStyles.indexOf(serverIconStyle) !== -1 ? serverIconStyle : "duotone";

        if (document.documentElement) {
            document.documentElement.setAttribute("data-kt-icon-style", iconStyle);
        }

        try {
            localStorage.setItem("data-kt-icon-style", iconStyle);
            document.cookie = "kt_icon_style=" + iconStyle + ";path=/;max-age=31536000;SameSite=Lax";
        } catch (e) {}

        // Anti-Flicker: transform icon classes synchronously during HTML parsing before first paint
        if (iconStyle && iconStyle !== 'duotone' && typeof MutationObserver !== 'undefined') {
            var targetClass = 'ki-' + iconStyle;

            var transformNode = function (el) {
                if (!el || el.nodeType !== 1) return;
                if (el.hasAttribute && (el.hasAttribute('data-kt-icon-style-ignore') || el.getAttribute('data-kt-icon-style-ignore') === 'true')) return;
                if (el.closest && (el.closest('[data-kt-icon-style-ignore]') || el.closest('[data-kt-element="icon-style-menu"]') || el.closest('[data-kt-element="icon-style-toggle"]'))) return;

                var cl = el.classList;
                if (cl && (cl.contains('ki-duotone') || cl.contains('ki-solid') || cl.contains('ki-outline'))) {
                    cl.remove('ki-duotone', 'ki-solid', 'ki-outline');
                    cl.add(targetClass);
                }
            };

            var earlyObserver = new MutationObserver(function (mutations) {
                for (var i = 0; i < mutations.length; i++) {
                    var added = mutations[i].addedNodes;
                    for (var j = 0; j < added.length; j++) {
                        var node = added[j];
                        if (node.nodeType === 1) {
                            transformNode(node);
                            if (node.querySelectorAll) {
                                var icons = node.querySelectorAll('.ki-duotone, .ki-solid, .ki-outline');
                                for (var k = 0; k < icons.length; k++) {
                                    transformNode(icons[k]);
                                }
                            }
                        }
                    }
                }
            });

            earlyObserver.observe(document.documentElement, {
                childList: true,
                subtree: true
            });

            document.addEventListener('DOMContentLoaded', function () {
                earlyObserver.disconnect();
            }, { once: true });
        }
    })();
</script>
<!--end::Icon style setup on page load-->
