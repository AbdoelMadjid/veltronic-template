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
            Operasional
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="schema-shell">
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Operational Guide</span>
                    <h2 class="fw-bold">Panduan Pergantian & Penambahan Frontpage</h2>
                    <p class="schema-lead">
                        Panduan langkah demi langkah untuk memilih frontpage aktif saat runtime, mengatur default frontpage via environment, dan menambahkan template frontpage baru ke proyek.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Cara Memilih via Topbar-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Memilih Frontpage Aktif via Topbar</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    Buka halaman Dashboard atau halaman admin manapun saat sedang login.
                                </div>
                                <div class="schema-step">
                                    Klik ikon <strong>Frontpages</strong> (ikon layar <code>ki-screen</code>) di topbar header kanan.
                                </div>
                                <div class="schema-step">
                                    Pilih template yang diinginkan (misal: <strong>Landing Page</strong> atau <strong>Education Portal</strong>) lalu klik tombol <strong>"Pilih Default"</strong>.
                                </div>
                                <div class="schema-step">
                                    Website akan reload otomatis dan menetapkan halaman tersebut sebagai halaman awal saat membuka URL root <code>/</code>.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Mengubah Default via .env-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Mengubah Default Frontpage di <code>.env</code></h4>
                            <p class="text-gray-700 fs-7 mb-3">
                                Jika ingin mengubah template default bawaan untuk instalasi baru atau pengunjung yang belum memiliki cookie:
                            </p>
                            <pre class="schema-code"><code># Buka file .env, lalu ubah atau tambahkan:
DEFAULT_FRONTPAGE=landing

# Atau jika ingin halaman Education Portal sebagai default:
DEFAULT_FRONTPAGE=education</code></pre>
                            <p class="text-gray-700 fs-7 mt-3 mb-0">
                                Jangan lupa jalankan <code>php artisan config:clear</code> setelah mengubah file <code>.env</code>.
                            </p>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Cara Menambah Template Baru-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Cara Menambahkan Template Frontpage Baru</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Langkah 1: Siapkan Folder & File View:</strong>
                                    <p class="text-gray-600 fs-8 mb-0">
                                        Buat direktori baru di <code>resources/views/frontpages/{nama_template}/</code> dan tempatkan file blade utamanya (misal <code>home.blade.php</code>).
                                    </p>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 2: Daftarkan di <code>config/frontpage.php</code>:</strong>
                                    <pre class="schema-code mt-2"><code>'pages' => [
    // ...
    'ecommerce' => [
        'name'  => 'E-Commerce Storefront',
        'desc'  => 'Modern Online Shop Frontpage',
        'view'  => 'frontpages.ecommerce.home',
        'url'   => '/ecommerce',
        'icon'  => 'ki-basket',
        'badge' => 'Shop v1',
        'color' => 'success',
    ],
],</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Langkah 3: Tambahkan Route Jika Multi-Page:</strong>
                                    <p class="text-gray-600 fs-8 mb-0">
                                        Jika template memiliki sub-halaman, daftarkan route group di <code>routes/website.php</code>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Checklist Validasi & QA-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Checklist Validasi & Smoke Test</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <i class="ki-duotone ki-check-circle text-success me-1"></i>
                                    Akses URL root <code>/</code> dan pastikan frontpage yang aktif ter-render dengan rapi.
                                </div>
                                <div class="schema-step">
                                    <i class="ki-duotone ki-check-circle text-success me-1"></i>
                                    Lakukan <strong>Login</strong> lalu <strong>Logout</strong>, pastikan pilihan frontpage tetap bertahan dan tidak ter-reset.
                                </div>
                                <div class="schema-step">
                                    <i class="ki-duotone ki-check-circle text-success me-1"></i>
                                    Pastikan tidak ada asset CSS/JS yang konflik antar template.
                                </div>
                                <div class="schema-step">
                                    <i class="ki-duotone ki-check-circle text-success me-1"></i>
                                    Jalankan pembersihan cache: <code>php artisan view:clear; php artisan config:clear</code>.
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
