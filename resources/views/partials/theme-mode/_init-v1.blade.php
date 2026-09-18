<!--begin::Theme mode setup on page load (Zero-Flicker)-->
<script>
    (function () {
        var defaultThemeMode = "light";
        var supportedModes = ["light", "dark", "system"];
        var themeMode = null;

        // 1. Check localStorage first (client preference)
        try {
            var stored = localStorage.getItem("data-bs-theme") || localStorage.getItem("data-bs-theme-mode");
            if (stored && supportedModes.indexOf(stored) !== -1) {
                themeMode = stored;
            }
        } catch (e) {}

        // 2. Check Cookie
        if (!themeMode) {
            var match = document.cookie.match(new RegExp('(^| )(?:kt_theme_mode|data-bs-theme)=([^;]+)'));
            if (match && match[2]) {
                var cookieMode = decodeURIComponent(match[2]);
                if (supportedModes.indexOf(cookieMode) !== -1) {
                    themeMode = cookieMode;
                }
            }
        }

        // 3. Check document attribute rendered by server
        if (!themeMode && document.documentElement && document.documentElement.hasAttribute("data-bs-theme-mode")) {
            var attrMode = document.documentElement.getAttribute("data-bs-theme-mode");
            if (supportedModes.indexOf(attrMode) !== -1) {
                themeMode = attrMode;
            }
        }

        if (!themeMode) {
            themeMode = defaultThemeMode;
        }

        var resolvedTheme = themeMode;
        if (themeMode === "system") {
            resolvedTheme = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        if (document.documentElement) {
            document.documentElement.setAttribute("data-bs-theme", resolvedTheme);
            document.documentElement.setAttribute("data-bs-theme-mode", themeMode);
        }

        try {
            localStorage.setItem("data-bs-theme", themeMode);
            localStorage.setItem("data-bs-theme-mode", themeMode);
            document.cookie = "kt_theme_mode=" + themeMode + ";path=/;max-age=31536000;SameSite=Lax";
            document.cookie = "data-bs-theme=" + resolvedTheme + ";path=/;max-age=31536000;SameSite=Lax";
        } catch (e) {}
    })();

    document.addEventListener("DOMContentLoaded", function() {
        if (typeof KTThemeMode !== "undefined") {
            KTThemeMode.on("kt.thememode.change", function() {
                var mode = KTThemeMode.getMenuMode() || KTThemeMode.getMode();
                var csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (mode) {
                    fetch('/theme-mode/switch/' + mode, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf || '',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    }).catch(function() {});
                }
            });
        }
    });
</script>
<!--end::Theme mode setup on page load-->
