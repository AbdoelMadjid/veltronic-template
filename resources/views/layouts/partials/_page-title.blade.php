<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
    @php
        $segments = request()->segments();

        $formatSegmentTitle = static function (string $segment): string {
            $segment = urldecode($segment);
            $segment = str_replace(['-', '_'], ' ', $segment);
            $segment = preg_replace('/([a-zA-Z])([0-9])/', '$1 $2', $segment);
            $segment = trim((string) $segment);

            $segmentKey = 'menu.' . strtolower(str_replace([' ', '&', '/'], ['_', 'and', '_'], $segment));
            return __($segmentKey) !== $segmentKey ? __($segmentKey) : ucwords($segment);
        };

        $translateSafely = static function (string $key): ?string {
            $key = trim($key);
            if ($key === '' || strtolower($key) === 'menu' || strtolower($key) === 'auth' || strtolower($key) === 'pagination') {
                return null;
            }
            $res = __($key);
            if (is_string($res) && $res !== $key) {
                return $res;
            }
            if (!str_starts_with($key, 'menu.')) {
                $resMenu = __('menu.' . $key);
                if (is_string($resMenu) && $resMenu !== 'menu.' . $key) {
                    return $resMenu;
                }
                $slug = strtolower(str_replace([' ', '&', '/'], ['_', 'and', '_'], $key));
                $resSlug = __('menu.' . $slug);
                if (is_string($resSlug) && $resSlug !== 'menu.' . $slug) {
                    return $resSlug;
                }
            }
            return null;
        };

        // Title didapat dari yield('title') atau getPageTitle()
        $yieldTitle = trim($__env->yieldContent('title'));
        if ($yieldTitle === '' || $yieldTitle === 'Index') {
            $title = getPageTitle();
        } else {
            $translatedTitle = $translateSafely($yieldTitle);
            if ($translatedTitle !== null) {
                $title = $translatedTitle;
            } else {
                $pageTitle = getPageTitle();
                $title = ($pageTitle !== config('app.name', 'Veltronic') && $pageTitle !== 'Metronic v.8.3.2 - Laravel 12') ? $pageTitle : $yieldTitle;
            }
        }

        // Ambil slot breadcrumbs (li_1, li_2, li_3, ...) jika dipassing via @component
        $customBreadcrumbs = [];
        $slotIdx = 1;
        while (isset(${'li_' . $slotIdx}) && trim((string)${'li_' . $slotIdx}) !== '') {
            $rawSlot = trim((string)${'li_' . $slotIdx});
            $customBreadcrumbs[] = $translateSafely($rawSlot) ?? $rawSlot;
            $slotIdx++;
        }

        // Jika tidak ada slot manual li_*, otomatis ambil breadcrumbs hierarkis
        if (empty($customBreadcrumbs)) {
            $customBreadcrumbs = getPageBreadcrumbs();
        }
    @endphp
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
        {{ $title }}
    </h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                {{ __('menu.home') }}
            </a>
        </li>
        <!--end::Item-->
        @foreach ($customBreadcrumbs as $breadcrumbItem)
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">
                {{ translateMenuTitleSafely($breadcrumbItem) ?? $breadcrumbItem }}
            </li>
        @endforeach
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
