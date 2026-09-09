<!--begin::Page title-->
<div class="page-title d-flex flex-column me-3">
    @php
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
                $slug = strtolower(str_replace([' ', '&', '/', '-'], ['_', 'and', '_', '_'], $key));
                $resSlug = __('menu.' . $slug);
                if (is_string($resSlug) && $resSlug !== 'menu.' . $slug) {
                    return $resSlug;
                }
            }
            return null;
        };

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

        $breadcrumbs = getPageBreadcrumbs();
    @endphp
    <!--begin::Title-->
    <h1 class="d-flex text-white fw-bold my-1 fs-3">
        {{ $title }}
    </h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-white opacity-75">
            <a href="/dashboard" class="text-white text-hover-primary">
                {{ __('menu.home') }}
            </a>
        </li>
        <!--end::Item-->
        @foreach ($breadcrumbs as $breadcrumbItem)
            <li class="breadcrumb-item">
                <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-white opacity-75">
                {{ translateMenuTitleSafely($breadcrumbItem) ?? $breadcrumbItem }}
            </li>
        @endforeach
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
