<!--begin::Language setup on page load-->
<script>
    (function () {
        var serverLocale = "{{ app()->getLocale() ?: 'en' }}";
        var supportedLocales = ["en", "id"];
        var locale = null;

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
            locale = serverLocale;
        }

        if (document.documentElement) {
            document.documentElement.setAttribute("data-kt-lang", locale);
            document.documentElement.setAttribute("lang", locale);
        }

        try {
            localStorage.setItem("data-kt-lang", locale);
            document.cookie = "kt_lang=" + locale + ";path=/;max-age=31536000;SameSite=Lax";
        } catch (e) {}

        window.KTLanguageConfig = {
            currentLocale: locale,
            serverLocale: serverLocale,
            defaultLocale: serverLocale,
            supportedLocales: supportedLocales,
            switchUrl: "{{ url('lang') }}",
            translationsUrl: "{{ route('lang.translations') }}",
            payload: {!! json_encode(\App\Support\LanguageManager::getClientPayload(), JSON_UNESCAPED_UNICODE) !!}
        };
    })();
</script>
<!--end::Language setup on page load-->

