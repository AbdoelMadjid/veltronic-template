<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
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
