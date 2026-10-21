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
            Skema Pemrograman
        @endslot
        @slot('li_3')
            Skema
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <div class="schema-shell">
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Theme Architecture</span>
                    <h2 class="fw-bold">Skema Pergantian Versi Tampilan (Theme Version Switcher)</h2>
                    <p class="schema-lead">
                        Arsitektur dual-theme runtime yang memungkinkan pergantian versi Metronic (v1, v2, hingga vN) secara dinamis tanpa duplikasi folder asset maupun hardcode if-else.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Prinsip Arsitektur-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Prinsip Utama Multi-Version Theme</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Universal Master Shell:</strong> <code>layouts/index.blade.php</code> bertindak sebagai root shell universal untuk seluruh tag HTML, head, script, modal, dan drawers tanpa pembajakan output buffer.
                                </div>
                                <div class="schema-step">
                                    <strong>Pluggable Layout Body Wrapper:</strong> Variasi visual tata letak dipisahkan ke dalam wrapper (V1: <code>layouts/_wrapper.blade.php</code>, V2: <code>themes/v2/layouts/_wrapper.blade.php</code>) dan dimuat via <code>ThemeVersion::resolveView('layouts._wrapper')</code>.
                                </div>
                                <div class="schema-step">
                                    <strong>Unified Asset Root with Suffix:</strong> Semua aset tetap berada di folder tunggal <code>public/assets</code> dengan penamaan suffix file seperti <code>style.bundle-v2.css</code>.
                                </div>
                                <div class="schema-step">
                                    <strong>Runtime State Preservation:</strong> Versi aktif disimpan dalam session <code>theme_version</code> dan disinkronkan ke tabel database <code>AppSetting</code>.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Core Resolver Class-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Core Helper: <code>App\Support\ThemeVersion</code></h4>
                            <pre class="schema-code"><code>namespace App\Support;

class ThemeVersion
{
    // Mengambil versi default dari config ('v1')
    public static function default(): string;

    // Mengambil daftar versi yang diizinkan (['v1', 'v2'])
    public static function available(): array;

    // Membaca session('theme_version') dengan validasi fallback
    public static function current(): string;

    // Resolusi view dengan suffix otomatis (contoh: view-v2 -> view)
    public static function resolveView(string $baseView, ?string $version = null): string;

    // Menentukan root asset path
    public static function assetBase(?string $assetPack = null): string;
}</code></pre>
                            <div class="schema-meta">
                                <span class="schema-chip">Single Source of Truth</span>
                                <span class="schema-chip">No Hardcoded v1/v2</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Flow Resolusi View & Asset-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Alur Resolusi View & Asset di Blade</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Pola Include Wrapper Body di Master Shell:</strong>
                                    <pre class="schema-code mt-2"><code>@@include(\App\Support\ThemeVersion::resolveView('layouts._wrapper', $activeThemeVersion))</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Pola Resolusi URL Asset:</strong>
                                    <pre class="schema-code mt-2"><code>&lt;link href="@{{ \App\Support\ThemeAsset::url('css/style.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" /&gt;</code></pre>
                                </div>
                                <div class="schema-step">
                                    Jika versi aktif adalah <code>v2</code> dan file <code>css/style.bundle-v2.css</code> ada, maka file versi tersebut akan dimuat. Jika tidak ada, helper otomatis fallback ke <code>css/style.bundle.css</code>.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Switcher Routing-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Routing & Controller Switcher</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Route Switcher (<code>routes/web.php</code>):</strong>
                                    <pre class="schema-code mt-2"><code>Route::get('/theme/version/{version}', function ($version) {
    if (in_array($version, ThemeVersion::available(), true)) {
        session(['theme_version' => $version]);
    }
    return redirect()->back();
})->name('theme.version.switch');</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>UI Switcher Menu:</strong> Tersedia di navbar topbar (ikon cube) dan menu dropdown profil user.
                                </div>
                                <div class="schema-step">
                                    <strong>Quality Gate & Test:</strong> Diuji menggunakan <code>ThemeVersionRenderTest.php</code> untuk memastikan v1 dan v2 merender layout yang tepat tanpa regresi.
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
