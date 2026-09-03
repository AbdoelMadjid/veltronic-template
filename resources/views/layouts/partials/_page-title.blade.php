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

        // Title didapat dari yield('title') atau getPageTitle()
        $title = trim($__env->yieldContent('title'));
        if (!$title) {
            $title = getPageTitle();
        } else {
            $titleKey = 'menu.' . strtolower(str_replace([' ', '&', '/'], ['_', 'and', '_'], $title));
            $title = __($titleKey) !== $titleKey ? __($titleKey) : $title;
        }

        // Ambil slot breadcrumbs (li_1, li_2, li_3, ...) jika dipassing via @component
        $customBreadcrumbs = [];
        $slotIdx = 1;
        while (isset(${'li_' . $slotIdx}) && trim((string)${'li_' . $slotIdx}) !== '') {
            $customBreadcrumbs[] = trim((string)${'li_' . $slotIdx});
            $slotIdx++;
        }

        // Jika tidak ada slot li_*, gunakan segment URL
        if (empty($customBreadcrumbs)) {
            $breadcrumbSegments = count($segments) > 1 ? array_slice($segments, 0, -1) : [];
            foreach ($breadcrumbSegments as $segment) {
                $breadcrumbTitle = $formatSegmentTitle($segment);
                if ($breadcrumbTitle !== '') {
                    $customBreadcrumbs[] = $breadcrumbTitle;
                }
            }
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
                @php
                    $itemKey = 'menu.' . strtolower(str_replace([' ', '&', '/'], ['_', 'and', '_'], $breadcrumbItem));
                    $itemLabel = __($itemKey) !== $itemKey ? __($itemKey) : $breadcrumbItem;
                @endphp
                {{ $itemLabel }}
            </li>
        @endforeach
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
