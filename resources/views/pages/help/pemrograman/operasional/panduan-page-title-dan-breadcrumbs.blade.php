@extends('layouts.index')

@section('styles')
    @include('pages.help.pemrograman._schema-ui')
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <div class="schema-shell">
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Developer Workflow</span>
                    <h2 class="fw-bold">Panduan Page Title &amp; Hierarchical Breadcrumb</h2>
                    <p class="schema-lead">
                        Panduan praktis pengembang (developer guide) untuk memanfaatkan sistem Page Title &amp; Breadcrumbs otomatis tanpa boilerplate, cara mendaftarkan menu database/seeder, serta tata cara melakukan override jika diperlukan.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Standar Membuat Halaman Baru-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Standar Baru Membuat View Halaman</h4>
                            <p class="text-gray-700 fs-7">
                                Saat membuat halaman blade baru di <code>resources/views/pages/</code> atau modul database:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Cukup Buat Template Minimal:</strong> Anda <strong>tidak perlu lagi</strong> menyertakan <code>@@section('toolbar')</code> dan <code>@@slot('li_1')</code>.
                                </div>
                                <div class="schema-step">
                                    <pre class="schema-code"><code>@@extends('layouts.index')

@@section('content')
    &lt;div class="card"&gt;
        &lt;div class="card-header"&gt;
            &lt;h3 class="card-title"&gt;Data Modul&lt;/h3&gt;
        &lt;/div&gt;
        &lt;div class="card-body"&gt;
            &lt;!-- Isi konten halaman Anda --&gt;
        &lt;/div&gt;
    &lt;/div&gt;
@@endsection</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Otomatisasi:</strong> Sistem akan mendeteksi route aktif dan otomatis merender Judul Halaman serta Breadcrumb hirarkis di bagian atas template.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Mendaftarkan Menu di Seeder / Database-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Konfigurasi Menu di <code>config/menu_seeder.php</code></h4>
                            <p class="text-gray-700 fs-7">
                                Agar menu dikenali hierarki dan translasi dua bahasanya, daftarkan pada kategori yang sesuai:
                            </p>
                            <pre class="schema-code"><code>'categories' => [
    [
        'title'     => 'Master Data',
        'title_key' => 'md_masterdata', // Kunci translasi di lang/*/menu.php
        'menus'     => [
            [
                'name'      => 'App Support',
                'title_key' => 'md_app_support',
                'url'       => 'appsupport/menu', // URL atau route
                'children'  => [
                    [
                        'name'      => 'Menu',
                        'title_key' => 'md_menu',
                        'url'       => 'appsupport/menu',
                    ],
                ],
            ],
        ],
    ],
],</code></pre>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">Hierarchical Parent</span>
                                <span class="schema-chip">title_key Support</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Kustomisasi & Override Judul-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Cara Kustomisasi / Override Judul Spesifik</h4>
                            <p class="text-gray-700 fs-7">
                                Jika sebuah halaman memerlukan judul kustom yang berbeda dari nama menu:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Gunakan <code>@@section('title')</code>:</strong>
                                    <pre class="schema-code"><code>@@extends('layouts.index')

@@section('title', 'Laporan Analisis Penjualan Q3')

@@section('content')
    ...
@@endsection</code></pre>
                                </div>
                                <div class="schema-step">
                                    Judul <code>&lt;h1&gt;</code> dan tab browser akan menggunakan teks override, sedangkan Breadcrumb tetap menelusuri hierarki navigasi yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Override Breadcrumbs Manual (Opsional)-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Override Breadcrumbs Manual (Jika Benar-Benar Diperlukan)</h4>
                            <p class="text-gray-700 fs-7">
                                Untuk skenario khusus di mana breadcrumb ingin ditentukan secara manual:
                            </p>
                            <pre class="schema-code"><code>@@section('toolbar')
    @@component('layouts.partials._toolbar')
        @@slot('li_1')
            Kategori Kustom
        @@endslot
        @@slot('li_2')
            Sub Kategori Kustom
        @@endslot
    @@endcomponent
@@endsection</code></pre>
                            <div class="schema-note mt-3">
                                <em>Catatan:</em> Cukup tulis level parent/kategori. Jangan tulis lagi judul halaman aktif di slot terakhir agar tetap mematuhi standar desain template.
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Checklist Pengujian Developer-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4 class="mb-4">5. Checklist Validasi &amp; QA Pengembang</h4>
                            <div class="schema-grid">
                                <div class="schema-col-4">
                                    <div class="p-4 rounded-3 border border-gray-300 bg-light h-100 d-flex flex-column">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="ki-duotone ki-route fs-2 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                            <h5 class="fs-6 fw-bold text-gray-900 mb-0">1. Uji Breadcrumb Trail</h5>
                                        </div>
                                        <p class="fs-7 text-gray-700 mb-0 flex-grow-1">
                                            Pastikan breadcrumb hanya menunjukkan <code>Home &rarr; Category &rarr; Parent</code> tanpa ada duplikasi judul halaman di ujungnya.
                                        </p>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded-3 border border-gray-300 bg-light h-100 d-flex flex-column">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="ki-duotone ki-flag fs-2 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <h5 class="fs-6 fw-bold text-gray-900 mb-0">2. Uji Alih Bahasa (EN &harr; ID)</h5>
                                        </div>
                                        <p class="fs-7 text-gray-700 mb-0 flex-grow-1">
                                            Ganti bahasa via dropdown navbar. Pastikan judul halaman dan breadcrumb berubah seketika tanpa reload dan tetap konsisten setelah refresh.
                                        </p>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded-3 border border-gray-300 bg-light h-100 d-flex flex-column">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="ki-duotone ki-screen fs-2 text-info">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                            <h5 class="fs-6 fw-bold text-gray-900 mb-0">3. Uji Responsif Layar</h5>
                                        </div>
                                        <p class="fs-7 text-gray-700 mb-0 flex-grow-1">
                                            Periksa tampilan pada layar desktop maupun mobile (&lt; 768px), pastikan judul serta separator breadcrumb tertata rapi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 5-->
                </div>
                <!--end::Grid-->
            </div>
        </div>
    </div>
@endsection
