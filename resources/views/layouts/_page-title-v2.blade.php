<!--begin::Page title-->
<div class="page-title d-flex flex-column me-3">
    @php
        $title = trim($__env->yieldContent('title'));
        if (!$title) {
            $title = getPageTitle();
        }

        $routeName = \Illuminate\Support\Facades\Route::currentRouteName() ?? '';
        $segments = [];

        if ($routeName === 'dashboard') {
            $segments = ['Dashboards', 'Default'];
        } elseif ($routeName !== '') {
            $segments = array_values(array_filter(explode('.', $routeName), fn($segment) => $segment !== ''));
        }

        $normalize = function (string $value): string {
            $translatedKey = 'menu.' . strtolower(str_replace([' ', '&', '/', '-'], ['_', 'and', '_', '_'], $value));
            $translated = __($translatedKey);
            if ($translated !== $translatedKey) {
                return $translated;
            }

            return ucwords(str_replace(['-', '_'], ' ', $value));
        };
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
        @foreach ($segments as $segment)
            <li class="breadcrumb-item">
                <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-white opacity-75">
                {{ $normalize($segment) }}
            </li>
        @endforeach
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
