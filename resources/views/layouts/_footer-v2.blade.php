<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-gray-900 order-2 order-md-1 d-flex flex-column flex-md-row align-items-center text-center text-md-start">
            <div>
                <span class="text-muted fw-semibold me-1">2025&copy;</span>
                <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
            </div>
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
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1 mb-2 mb-md-0">
            <li class="menu-item"><a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a></li>
            <li class="menu-item"><a href="https://devs.keenthemes.com" target="_blank"
                    class="menu-link px-2">Support</a></li>
            <li class="menu-item"><a href="https://1.envato.market/EA4JP" target="_blank"
                    class="menu-link px-2">Purchase</a></li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
