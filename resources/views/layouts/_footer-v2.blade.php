<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-gray-900 order-2 order-md-1 d-flex flex-column flex-md-row align-items-center text-center text-md-start">
            <div>
                <span class="text-muted fw-semibold me-1">{{ app_profile('footer_copyright_year', '2025') }}&copy;</span>
                <a href="{{ app_profile('footer_copyright_url', 'https://keenthemes.com') }}" target="_blank" class="text-gray-800 text-hover-primary fw-semibold">{{ app_profile('footer_copyright_text', 'Keenthemes') }}</a>
            </div>
            @if (app_profile('footer_show_system_info', '1') == '1')
                @php
                    $phpVersion = phpversion();
                    $laravelVersion = app()->version();
                    $mysqlVersion = 'N/A';
                    try {
                        $mysqlVersion = \Illuminate\Support\Facades\DB::connection()
                            ->getPdo()
                            ->getAttribute(\PDO::ATTR_SERVER_VERSION);
                    } catch (\Throwable $e) {
                        $mysqlVersion = 'N/A';
                    }
                @endphp
                <span class="text-muted fw-semibold ms-md-3 mt-1 mt-md-0">Laravel {{ $laravelVersion }} | PHP {{ $phpVersion }} | MySQL {{ $mysqlVersion }}</span>
            @endif
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1 mb-2 mb-md-0">
            @foreach (app_footer_links() as $link)
                <li class="menu-item">
                    <a href="{{ $link['url'] ?? '#' }}" target="{{ $link['target'] ?? '_blank' }}" class="menu-link px-2">{{ $link['title'] ?? 'Link' }}</a>
                </li>
            @endforeach
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
