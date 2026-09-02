@extends('layouts.index')

@section('styles')
    @include('pages.help.pemrograman._schema-ui')
@endsection

@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Help
        @endslot
        @slot('li_2')
            {{ __('help.skema_pemrograman') }}
        @endslot
        @slot('li_3')
            {{ __('help.skema') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="schema-shell">
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Frontpage Architecture</span>
                    <h2 class="fw-bold">Skema Pergantian Frontpage (Dynamic Frontpage Switcher)</h2>
                    <p class="schema-lead">
                        Arsitektur modular untuk memilih dan merender template halaman depan publik (Landing Page Metronic 8 & Education Portal Unify v2.6) secara dinamis dengan persistensi Cookie dan Session.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Konsep Hirarki Resolusi-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Hirarki Resolusi Frontpage</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Tingkat 1 - Session:</strong> Jika pengguna telah memilih frontpage pada sesi saat ini, session <code>frontpage</code> akan digunakan terlebih dahulu.
                                </div>
                                <div class="schema-step">
                                    <strong>Tingkat 2 - Persistent Cookie:</strong> Jika session habis atau setelah logout, sistem membaca cookie browser <code>frontpage</code> agar preferensi pengguna tetap bertahan.
                                </div>
                                <div class="schema-step">
                                    <strong>Tingkat 3 - Config / Environment:</strong> Jika pengguna baru pertama kali berkunjung, sistem membaca <code>config('frontpage.default')</code> yang bersumber dari <code>.env</code> (<code>DEFAULT_FRONTPAGE</code>).
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Core Class Helper-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Core Helper: <code>App\Support\Frontpage</code></h4>
                            <pre class="schema-code"><code>namespace App\Support;

class Frontpage
{
    // Mengambil default dari config('frontpage.default', 'landing')
    public static function default(): string;

    // Mengambil seluruh metadata frontpage yang terdaftar
    public static function all(): array;

    // Membaca frontpage aktif (Session -> Cookie -> Default)
    public static function current(): string;

    // Mengambil target blade view dari frontpage yang aktif
    public static function currentView(): string;
}</code></pre>
                            <div class="schema-meta">
                                <span class="schema-chip">Session + Cookie Layer</span>
                                <span class="schema-chip">Dynamic View Dispatcher</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Struktur Direktori & Konfigurasi-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Struktur Direktori & Config</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Struktur Folder Views:</strong>
                                    <pre class="schema-code mt-2"><code>resources/views/
├── frontpages/
│   ├── landing/
│   │   └── v1/landing.blade.php
│   └── education/
│       ├── home-page.blade.php
│       ├── programs.blade.php
│       ├── events.blade.php
│       └── partials/web-master.blade.php</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Deklarasi di <code>config/frontpage.php</code>:</strong>
                                    <pre class="schema-code mt-2"><code>return [
    'default' => env('DEFAULT_FRONTPAGE', 'landing'),
    'pages' => [
        'landing' => [
            'name' => 'Landing Page',
            'view' => 'frontpages.landing.v1.landing',
            'url'  => '/',
        ],
        'education' => [
            'name' => 'Education Portal',
            'view' => 'frontpages.education.home-page',
            'url'  => '/education',
        ],
    ],
];</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Integrasi Root & Switcher-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Integrasi Root View & Topbar Menu</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Root Dispatcher (<code>resources/views/welcome.blade.php</code>):</strong>
                                    <pre class="schema-code mt-2"><code>@@php
    $frontpageView = \App\Support\Frontpage::currentView();
@@endphp
@@include($frontpageView)</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Switcher Route (<code>routes/web.php</code>):</strong>
                                    <pre class="schema-code mt-2"><code>Route::get('/frontpage/switch/{frontpage}', function ($frontpage) {
    if (in_array($frontpage, Frontpage::available(), true)) {
        session(['frontpage' => $frontpage]);
        Cookie::queue('frontpage', $frontpage, 525600); // 1 tahun
    }
    return redirect()->back();
})->name('frontpage.switch');</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Topbar Toolbar Widget:</strong> Disediakan via partial <code>partials/menus/_frontpages-menu.blade.php</code> dengan status <em>"Terpilih (Aktif)"</em> dan tombol <em>"Pilih Default"</em>.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->
                </div>
                <!--end::Grid-->
            </div>
        </div>
    </div>
@endsection
