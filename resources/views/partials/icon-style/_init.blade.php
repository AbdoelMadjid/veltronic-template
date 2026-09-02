<!--begin::Icon style setup on page load-->
<script>
    (function () {
        var defaultIconStyle = "duotone";
        var iconStyle;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-kt-icon-style")) {
                iconStyle = document.documentElement.getAttribute("data-kt-icon-style");
            } else {
                try {
                    iconStyle = localStorage.getItem("data-kt-icon-style");
                } catch (e) {
                    iconStyle = null;
                }
                if (!iconStyle) {
                    iconStyle = defaultIconStyle;
                }
            }
            document.documentElement.setAttribute("data-kt-icon-style", iconStyle);
        }
    })();
</script>
<!--end::Icon style setup on page load-->
