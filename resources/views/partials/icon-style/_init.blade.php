<!--begin::Preload KeenIcons Font (Zero-FOIT / Instant Rendering)-->
<link rel="preload" href="{{ \App\Support\ThemeAsset::url('plugins/global/fonts/keenicons/keenicons-duotone.woff', $theme_asset_pack ?? null) }}?eut7fk" as="font" type="font/woff" crossorigin="anonymous" />
<link rel="preload" href="{{ \App\Support\ThemeAsset::url('plugins/global/fonts/keenicons/keenicons-outline.woff', $theme_asset_pack ?? null) }}?fzo4bm" as="font" type="font/woff" crossorigin="anonymous" />
<link rel="preload" href="{{ \App\Support\ThemeAsset::url('plugins/global/fonts/keenicons/keenicons-solid.woff', $theme_asset_pack ?? null) }}?812fv7" as="font" type="font/woff" crossorigin="anonymous" />
<!--end::Preload KeenIcons Font-->

<!--begin::Icon style setup on page load (Anti-Flicker)-->
<script>
    (function () {
        var supportedStyles = ["duotone", "solid", "outline"];
        var iconStyle = null;

        // 1. Check attribute set by server
        if (document.documentElement && document.documentElement.hasAttribute("data-kt-icon-style")) {
            var attr = document.documentElement.getAttribute("data-kt-icon-style");
            if (supportedStyles.indexOf(attr) !== -1) {
                iconStyle = attr;
            }
        }

        // 2. Check localStorage (prioritas preferensi client jika ada)
        try {
            var stored = localStorage.getItem("data-kt-icon-style");
            if (stored && supportedStyles.indexOf(stored) !== -1) {
                iconStyle = stored;
            }
        } catch (e) {}

        // 3. Check Cookie jika belum ada
        if (!iconStyle) {
            var match = document.cookie.match(new RegExp('(^| )kt_icon_style=([^;]+)'));
            if (match && match[2]) {
                var cookieStyle = decodeURIComponent(match[2]);
                if (supportedStyles.indexOf(cookieStyle) !== -1) {
                    iconStyle = cookieStyle;
                }
            }
        }

        if (!iconStyle) {
            iconStyle = "{{ getActiveIconStyle() }}";
        }
        if (supportedStyles.indexOf(iconStyle) === -1) {
            iconStyle = "duotone";
        }

        // Apply immediately to root before DOM paints
        if (document.documentElement) {
            document.documentElement.setAttribute("data-kt-icon-style", iconStyle);
        }
    })();
</script>
<!--end::Icon style setup on page load-->
