<!--begin::Language setup on page load-->
<script>
    (function () {
        var defaultLocale = "{{ app()->getLocale() ?: 'en' }}";
        var supportedLocales = ["en", "id"];
        var locale = null;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-kt-lang")) {
                locale = document.documentElement.getAttribute("data-kt-lang");
            } else {
                try {
                    locale = localStorage.getItem("data-kt-lang");
                } catch (e) {
                    locale = null;
                }
                if (!locale) {
                    var match = document.cookie.match(new RegExp('(^| )kt_lang=([^;]+)'));
                    if (match && match[2]) {
                        locale = decodeURIComponent(match[2]);
                    }
                }
                if (!locale || supportedLocales.indexOf(locale) === -1) {
                    locale = defaultLocale;
                }
            }
            document.documentElement.setAttribute("data-kt-lang", locale);
            document.documentElement.setAttribute("lang", locale);
        }

        window.KTLanguageConfig = {
            currentLocale: locale || defaultLocale,
            defaultLocale: defaultLocale,
            supportedLocales: supportedLocales,
            switchUrl: "{{ url('lang') }}",
            translationsUrl: "{{ route('lang.translations') }}",
            payload: {!! json_encode(\App\Support\LanguageManager::getClientPayload(), JSON_UNESCAPED_UNICODE) !!}
        };
    })();
</script>
<!--end::Language setup on page load-->
