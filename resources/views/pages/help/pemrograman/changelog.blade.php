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
            Changelog
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <!--begin::Version & Tags History Card-->
            <div class="card mb-5 mb-xl-8 border" data-kt-lang-ignore="true">
                <div class="card-header border-0 pt-6">
                    <div class="card-title d-flex align-items-center gap-3">
                        <div class="symbol symbol-40px">
                            <span class="symbol-label bg-light-primary text-primary">
                                <i class="ki-duotone ki-tag fs-2 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </div>
                        <div>
                            <h3 class="fw-bold text-gray-900 mb-0">Riwayat Versi & Release Tags</h3>
                            <span class="text-muted fs-7">Catatan rilis dan riwayat perubahan versi template Veltronic</span>
                        </div>
                    </div>
                    <div class="card-toolbar d-flex align-items-center gap-2">
                        <span class="badge badge-light-danger fw-semibold fs-8">Major</span>
                        <span class="badge badge-light-primary fw-semibold fs-8">Minor</span>
                        <span class="badge badge-light-warning fw-semibold fs-8">Patch</span>
                        <span class="badge badge-light-success fw-bold fs-7 px-3 py-2 ms-2">
                            <i class="ki-duotone ki-check-circle fs-6 text-success me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Versi Saat Ini: v1.12.0
                        </span>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <!--begin::Timeline-->
                    <div class="timeline-label">
                        <!--begin::Item v1.12.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.12.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.12.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>09 Sep 2026, 10:30 WIB
                                    </span>
                                    <span class="badge badge-light-success fs-8 ms-auto">Latest Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Zero-Boilerplate Hierarchical Page Title &amp; Breadcrumbs Engine, Skema &amp; Operasional Documentation, and Bilingual Menu Parity</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Engine otomatisasi hierarki <i>Page Title</i> dan <i>Breadcrumbs</i> tanpa <i>boilerplate</i> pada view anak, penataan breadcrumb cerdas yang hanya menampilkan jejak leluhur (<i>ancestor trail</i>) tanpa pengulangan judul halaman aktif, dokumentasi lengkap skema dan operasional di menu Help, penambahan grid selebar 100% (<code>.schema-col-4</code>) untuk checklist QA pengembang, serta sinkronisasi bilingual penuh pada menu dan sidebar.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Zero-Boilerplate Automatic Page Title &amp; Breadcrumbs:</strong> Helper <code>app/Helpers/GetPageTitle.php</code> menyelesaikan resolusi 4 lapis (<code>config/menu_seeder.php</code>, database <code>menus</code>, <code>sidebar.*</code>, dan URL segments) dengan fungsi translasi aman <code>translateMenuTitleSafely()</code>.</li>
                                        <li class="mb-1"><strong>Ancestor Breadcrumb Hierarchy:</strong> Breadcrumbs secara eksklusif hanya menampilkan hierarki leluhur induk (misal: <code>Home &gt; Master Data &gt; App Support</code> untuk halaman <code>Menu</code>), menghindari redundansi judul halaman di ujung breadcrumb.</li>
                                        <li class="mb-1"><strong>Smart Layout Toolbar Fallback:</strong> Penataan <code>resources/views/layouts/_default.blade.php</code> dengan pengecekan <code>@hasSection('toolbar')</code> otomatis merender toolbar default bila view anak tidak mendeklarasikan toolbar kustom.</li>
                                        <li class="mb-1"><strong>Dokumentasi Skema &amp; Operasional Help:</strong> Penambahan halaman panduan komprehensif di <code>help/pemrograman/skema/page-title-dan-breadcrumbs</code> dan <code>help/pemrograman/operasional/panduan-page-title-dan-breadcrumbs</code> beserta file Markdown di <code>docs/skema-pemrograman/</code>.</li>
                                        <li class="mb-1"><strong>Schema UI Full-Width Grid:</strong> Penambahan class CSS <code>.schema-col-4</code> pada <code>_schema-ui.blade.php</code> untuk merentangkan 3 kolom kartu QA Checklist Pengembang hingga 100% lebar kontainer.</li>
                                        <li class="mb-1"><strong>Selective Localization Boundary:</strong> Sidebar dan Toolbar tetap mengusung dwibahasa penuh (EN &amp; ID) dengan <code>title_key</code> sinkron, sementara isi konten bantuan Help dilindungi dalam bahasa Indonesia murni via <code>data-kt-lang-ignore="true"</code>.</li>
                                        <li class="mb-1"><strong>Realtime Language Engine Sync:</strong> Pembaruan peta kamus <code>help.*</code> pada <code>public/assets/js/custom/language.js</code> dan pembaruan versi cache ke <code>v: 6</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.12.0-->

                        <!--begin::Item v1.11.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.11.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.11.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>09 Sep 2026, 03:30 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Toolbar Gregorian &amp; Hijri Bilingual Date Widget, Responsive Mobile Tooltip &amp; Dual-Language Sync</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Integrasi widget penanggalan ganda Masehi dan Hijriah dwibahasa pada area aksi toolbar, penambahan helper global <code>renderDate()</code>, <code>toHijriah()</code>, dan <code>renderGreeting()</code>, tampilan responsif mobile dengan tooltip Bootstrap/Metronic interaktif, serta sinkronisasi dinamis pada modul <code>language.js</code>.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Toolbar Date Widget:</strong> Menampilkan tanggal Masehi dan Hijriah lengkap pada <code>resources/views/layouts/partials/_toolbar.blade.php</code>.</li>
                                        <li class="mb-1"><strong>Global Date Helpers:</strong> Fungsi helper penanggalan dan salam di <code>app/Helpers/helpers.php</code> yang dimuat otomatis via <code>composer.json</code>.</li>
                                        <li class="mb-1"><strong>Bilingual Dictionaries:</strong> Penambahan kamus nama bulan, imbuhan (M/AD, H/AH), dan sapaan di <code>lang/id/translation.php</code> dan <code>lang/en/translation.php</code>.</li>
                                        <li class="mb-1"><strong>Responsive Mobile Display:</strong> Mode ringkas ikon pada layar <code>&lt; 768px</code> dengan tooltip interaktif saat di-hover/tap.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.11.0-->

                        <!--begin::Item v1.10.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.10.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.10.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>08 Sep 2026, 17:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">App Feature Visibility &amp; Settings Module, Theme v2 Topbar/Menu Feature Integration, and Dynamic Page Title Database Lookup</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Modul manajemen visibilitas fitur (<code>appsupport/app-fiturs</code>) berbasis database dan cache dengan helper <code>app_fitur()</code>, integrasi kendali fitur pada Theme v2 (Demo 2), proteksi hak akses menu sidebar template untuk role master/admin, serta resolusi judul halaman dinamis dari tabel database.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Database Feature Toggle Management:</strong> Model <code>AppFitur</code> &amp; <code>AppSetting</code> dengan kontrol granular untuk Topbar Tools, Topbar Menus, dan Sidebar Menus.</li>
                                        <li class="mb-1"><strong>Theme v2 Feature Integration:</strong> Sinkronisasi pengecekan fitur pada <code>__topbar-v2.blade.php</code> dan <code>__menu-v2.blade.php</code>.</li>
                                        <li class="mb-1"><strong>Template Sidebar Role Restriction:</strong> Pembatasan menu template khusus role <code>master</code> dan <code>admin</code> tanpa terhalang permission database.</li>
                                        <li class="mb-1"><strong>Dynamic Bilingual Page Title:</strong> Resolusi otomatis kunci terjemahan <code>title_key</code> untuk menu yang bersumber dari tabel database.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.10.0-->

                        <!--begin::Item v1.9.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.9.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.9.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>08 Sep 2026, 08:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Frontpage Landing v1 Bilingual Localization, Realtime Instant Head &amp; Meta Engine &amp; Zero-Delay O(1) Performance</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi fitur bilingual penuh pada Frontpage Landing v1, engine translasi instan untuk <code>&lt;title&gt;</code> dan seluruh tag <code>&lt;meta&gt;</code> di <i>head</i> halaman (Landing &amp; Dashboard), perbaikan layout dropdown Help menu topbar, serta optimasi performa <i>instant $O(1)$ lookup</i> tanpa jeda.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Frontpage Landing v1 Bilingual Localization:</strong> Translasi menyeluruh dwiarah English &harr; Indonesian di <code>resources/views/frontpages/landing/v1/landing.blade.php</code> dengan kamus <code>lang/en/landing.php</code> dan <code>lang/id/landing.php</code> serta dropdown pemilih bahasa di header toolbar.</li>
                                        <li class="mb-1"><strong>Realtime Instant Head &amp; Meta Engine:</strong> Penambahan fungsi <code>applyHeadTranslations()</code> di <code>language.js</code> yang secara langsung memperbarui <code>&lt;title&gt;</code>, <code>document.title</code>, <code>&lt;meta name="description"&gt;</code>, <code>&lt;meta name="keywords"&gt;</code>, <code>&lt;meta property="og:title"&gt;</code>, dan <code>&lt;meta property="og:locale"&gt;</code> tanpa reload halaman.</li>
                                        <li class="mb-1"><strong>Smart Dashboard Compound Titles:</strong> Parsing cerdas untuk judul tab browser majemuk di dashboard (misal: <code>Dashboards - Metronic 832</code> &harr; <code>Dasbor - Metronic 832</code>) pada layout utama, layout v2, dan layout dokumentasi.</li>
                                        <li class="mb-1"><strong>High-Performance O(1) Zero-Delay Optimization:</strong> Penghapusan loop linier pencarian kata pada <code>translateText()</code>, beralih 100% ke hash map instan sehingga translasi seluruh DOM dan metadata selesai dalam <code>&lt; 2ms</code> (tanpa jeda).</li>
                                        <li class="mb-1"><strong>Topbar Help Menu &amp; Theme v2 Seeder Menu:</strong> Perbaikan ukuran full-screen dropdown Help menu di topbar navbar dan penataan urutan menu hasil seeder sebelum dasbor pada layout v2 dengan pola tampilan Apps.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.9.0-->
                        <!--begin::Item v1.8.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.8.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold">v1.8.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>07 Sep 2026, 15:25 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Tree-Aware Drag &amp; Drop Menu Reordering Engine &amp; Live Real-Time Sidebar Synchronization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Peningkatan fungsionalitas manajemen menu (<code>appsupport/menu</code>) dengan sistem pengurutan menu interaktif berbasis <i>Drag &amp; Drop</i> berhirarki cerdas serta pembaruan tampilan navigasi sidebar secara sinkron dan <i>real-time</i> tanpa memerlukan <i>reload</i> halaman.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Tree-Aware Hierarchical Drag &amp; Drop:</strong> Ketika Menu Utama (Level 1) digeser, seluruh sub menu dan anak-cucunya otomatis ikut berpindah sebagai satu blok utuh. Sedangkan untuk Sub Menu (Level 2 &amp; 3) pergeseran dibatasi secara ketat hanya pada lingkup saudara di bawah induk yang sama.</li>
                                        <li class="mb-1"><strong>Real-Time Live Sidebar DOM Sync:</strong> Respon AJAX langsung merender ulang potongan HTML sidebar database menu (<code>_menu-section-additional.blade.php</code>) dan memperbarui sidebar DOM secara instan.</li>
                                        <li class="mb-1"><strong>Re-initialization KTMenu &amp; Language Engine:</strong> Otomatis memperbarui instance <code>KTMenu</code> dan <code>KTComponents</code> serta menerjemahkan kembali label sidebar dengan <code>KTLanguage.translateDOM()</code>.</li>
                                        <li class="mb-1"><strong>Batch Order Update Endpoint:</strong> Penambahan endpoint khusus <code>POST /appsupport/menu/reorder</code> pada controller untuk persistensi urutan ke database secara transaksional.</li>
                                        <li class="mb-1"><strong>Elegance Metronic Feedback:</strong> Tombol drag handle <code>ki-abstract-14</code> dengan cursor grab/grabbing, garis indikator drop biru, highlight animasi flash hijau pada baris dan sidebar, serta notifikasi toast mengambang.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.8.1-->

                        <!--begin::Item v1.8.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.8.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.8.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>07 Sep 2026, 13:15 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Interactive Seeder Blueprint Builder for Menu Management &amp; Realtime Code Generator</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan menyeluruh pada modul manajemen menu (<code>appsupport/menu</code>) dengan menghadirkan antarmuka perancangan menu visual elegan yang menganut 100% pola blueprint seeder (<code>config/menu_seeder/</code>). Dilengkapi real-time auto-translation, auto key &amp; route generator, live Keenicons preview &amp; quick picker, permission presets, role pills, serta generator array PHP seeder instan siap salin.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Real-time Smart Auto-Generator:</strong> Pengetikan nama menu bahasa Indonesia secara otomatis mengonversi title bahasa Inggris, menghasilkan kunci terjemahan standar (<code>title_key</code> seperti <code>md_*</code>, <code>app_*</code>), dan menyusun route name/URL yang presisi.</li>
                                        <li class="mb-1"><strong>Live Keenicons Picker &amp; Quick Palette:</strong> Visualisasi live preview kotak ikon Keenicons dengan deteksi jumlah <code>paths</code> otomatis dan tombol shortcut 1-klik untuk ikon populer.</li>
                                        <li class="mb-1"><strong>CRUD Permission Presets &amp; Role Pills:</strong> Tombol preset cepat (⚡ Full CRUD, 👁️ Read Only, ✏️ Manage) dan checklist role berbasis badge pills interaktif.</li>
                                        <li class="mb-1"><strong>Visual Multi-Level Hierarchy Builder:</strong> Mode perancangan hirarki komplit (Level 1 Root, Level 2 Submenu, Level 3 Grandchild) dengan auto-inheritance prefix URL parent.</li>
                                        <li class="mb-1"><strong>Real-time PHP Seeder Blueprint Generator:</strong> Tab preview kode array PHP seeder terformat rapi yang dapat disalin ke clipboard dengan satu klik untuk dijadikan blueprint seeder permanen.</li>
                                        <li class="mb-1"><strong>Otomatis Sinkronisasi Translation &amp; Spatie Permission:</strong> Integrasi backend controller untuk otomatis memperbarui file <code>lang/id/menu.php</code>, <code>lang/en/menu.php</code>, serta sinkronisasi permission role Spatie.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.8.0-->

                        <!--begin::Item v1.7.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.7.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-warning fw-bold">v1.7.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>06 Sep 2026, 21:35 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Hardcoded Bahasa Indonesia Documentation &amp; Dynamic Localization Ignore Engine</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Standarisasi seluruh dokumentasi internal Skema Pemrograman dan Operasional menjadi Bahasa Indonesia murni tanpa dependensi kamus terjemahan, penghapusan file kamus help yang tidak terpakai, penambahan fitur pengecualian translasi DOM (<code>data-kt-lang-ignore</code>) pada engine <code>KTLanguage</code>, serta sinkronisasi penuh dokumentasi Markdown dan README.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Help Documentation Hardcoded Bahasa Indonesia:</strong> Seluruh halaman dokumentasi di <code>resources/views/pages/help/pemrograman</code> (Overview, 16 Skema, 8 Operasional, Console Developer, dan Changelog) murni menggunakan Bahasa Indonesia langsung dengan struktur visual dan styling yang tetap utuh.</li>
                                        <li class="mb-1"><strong>Pembersihan Kamus Translasi Redundan:</strong> Menghapus file kamus terjemahan <code>lang/en/help.php</code>, <code>lang/id/help.php</code>, dan script audit <code>scripts/help_i18n_audit.php</code> untuk efisiensi kompilasi dictionary.</li>
                                        <li class="mb-1"><strong>DOM Translation Exemption Engine (KTLanguage):</strong> Memperbarui fungsi <code>shouldSkipElement()</code> di <code>public/assets/js/custom/language.js</code> untuk otomatis melewati elemen dengan <code>data-kt-lang-ignore="true"</code>, <code>.schema-shell</code>, <code>.schema-hero</code>, dan <code>.schema-card</code> agar tidak tertranslasi saat bahasa English aktif.</li>
                                        <li class="mb-1"><strong>Invalidation Cache Client:</strong> Otomatis mereset dan memperbarui versi cache translasi <code>localStorage</code> (<code>kt_translations_cache</code> v3).</li>
                                        <li class="mb-1"><strong>Sinkronisasi Dokumentasi Markdown &amp; README:</strong> Menambahkan dokumen Markdown lengkap untuk Skema Frontpage, Icon, Theme Multi-Version, dan memperbarui seluruh tabel indeks serta URL repositori GitHub.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.7.1-->

                        <!--begin::Item v1.7.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.7.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.7.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>06 Sep 2026, 21:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Realtime Zero-Reload Bilingual Localization (English &harr; Indonesian) & Mobile Toolbar Hub Integration</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh sistem alih bahasa instan tanpa reload halaman (live switching) mengadopsi arsitektur yang sejalan dengan <code>KTThemeMode</code> dan <code>KTIconStyle</code>. Didukung oleh in-memory client payload dictionary, non-destructive DOM TreeWalker engine, persistensi multi-layer (localStorage, cookie, dan Laravel session background sync), serta konsolidasi kontrol pada Mobile Toolbar Hub.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Zero-Latency Language Engine (KTLanguage):</strong> Engine lokalisasi frontend di <code>public/assets/js/custom/language.js</code> dengan TreeWalker DOM traversal yang menerjemahkan teks seluruh tampilan secara dinamis (&lt; 5ms) tanpa merusak elemen anak (ikon, bullet, badge, SVG, atau event listener).</li>
                                        <li class="mb-1"><strong>Dual-Layer Translation Mechanism:</strong> Dukungan penuh penerjemahan via atribut (<code>data-kt-translate</code>, <code>data-kt-translate-placeholder</code>, <code>data-kt-translate-title</code>, <code>data-kt-lang-en/id</code>) serta automatic text phrase matching dua arah (EN &harr; ID) dengan pelestarian format huruf besar/kecil.</li>
                                        <li class="mb-1"><strong>In-Memory Precompiled Dictionary (LanguageManager):</strong> Kompilasi 2.171+ kunci terjemahan per bahasa dan 1.887 pasangan frasa dua arah yang diinjeksi langsung pada inisialisasi Blade (<code>_init.blade.php</code>) untuk performa 100% offline-ready tanpa delay fetch AJAX.</li>
                                        <li class="mb-1"><strong>Multi-Layer State Persistence & Backend Sync:</strong> Penyimpanan pilihan bahasa ke <code>localStorage</code> dan cookie <code>kt_lang</code> dengan async background sync ke endpoint <code>/lang/{locale}</code> untuk sinkronisasi session Laravel secara transparan.</li>
                                        <li class="mb-1"><strong>Standardized Modular Dropdown Component:</strong> Komponen dropdown bahasa modular (<code>partials.lang._main</code>) dengan styling standar Metronic (<code>w-175px</code>), checkmark aktif, dan indikator bendera (US &amp; ID).</li>
                                        <li class="mb-1"><strong>Mobile Toolbar Hub Integration:</strong> Konsolidasi pemilihan bahasa ke dalam Mobile Toolbar Hub (<code>_mobile-toolbar-menu.blade.php</code>) dan penyembunyian tombol bendera redundan di header mobile pada breakpoint <code>d-none d-lg-flex</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.7.0-->

                        <!--begin::Item v1.6.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.6.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.6.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 23:00 WIB
                                    </span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">App Support Menu Management, Multi-Level Hierarchy Builder & Modular Route Architecture</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi menyeluruh modul manajemen menu aplikasi (<code>appsupport/menu</code>) dengan dukungan pembuatan menu satuan, sub-menu dari induk yang sudah ada, serta Form Builder Menu Komplit bertingkat (Level 1 &rarr; Level 2 &rarr; Level 3) sekaligus dalam satu transaksi. Dilengkapi sinkronisasi multi-bahasa, perizinan CRUD, dan perbaikan toolbar title/breadcrumb tanpa regresi.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Menu Management Module:</strong> Pembuatan CRUD Menu lengkap di <code>MenuController</code>, <code>MenuRequest</code>, dan <code>Menu</code> model untuk modul <code>appsupport/menu</code>.</li>
                                        <li class="mb-1"><strong>Multi-Level Complete Builder:</strong> Penyediaan form interaktif untuk membangun Menu Utama baru (Level 1) beserta seluruh Sub Menu (Level 2) dan Anak Sub Menu (Level 3) sekaligus.</li>
                                        <li class="mb-1"><strong>Quick Sub-Menu Creator:</strong> Tombol aksi <code>+</code> pada baris tabel untuk menambahkan sub-menu baru di bawah menu utama yang sudah ada secara instan.</li>
                                        <li class="mb-1"><strong>Multi-Lingual & Metadata Synchronization:</strong> Sinkronisasi otomatis field <code>title_key</code> dan <code>title_en</code> ke dalam file bahasa <code>lang/id/menu.php</code> dan <code>lang/en/menu.php</code> serta kolom <code>meta</code> JSON.</li>
                                        <li class="mb-1"><strong>Permissions & Roles Integration:</strong> Visualisasi badge CRUD terstandarisasi (Create, Read, Update, Delete, Sort) dan penugasan akses Spatie roles (admin, master, dll.).</li>
                                        <li class="mb-1"><strong>Modular Route Architecture:</strong> Pendaftaran route modul ke dalam <code>routes/masterdata.php</code> dan pengabaian file partials/underscore pada dynamic router <code>routes/menu.php</code>.</li>
                                        <li class="mb-1"><strong>Anti-Regression & Breadcrumb Fixes:</strong> Resolusi title page dan breadcrumb hierarchy tanpa pengulangan judul, serta pembuatan aturan agent <code>code-integrity-and-regression-prevention.md</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.6.0-->

                        <!--begin::Item v1.5.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.5.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.5.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 20:45 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Custom Metronic Error Pages (404/403/500), Unimplemented MVC Safe Fallback & Profil View Modularization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Implementasi template penanganan error global bergaya Metronic (404 Not Found, 403 Forbidden, 500 Server Error), penanganan proteksi dynamic routing terhadap modul MVC/View yang belum dibuat atau masih kosong, serta modularisasi halaman profil pengguna ke dalam komponen tab terpisah.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Custom Global Error Pages:</strong> Pembuatan template error terstandarisasi di <code>resources/views/errors/404.blade.php</code>, <code>403.blade.php</code>, dan <code>500.blade.php</code> dengan layout Metronic dan penanganan aman untuk variabel <code>$exception</code>.</li>
                                        <li class="mb-1"><strong>Unimplemented MVC Safe Fallback:</strong> Peningkatan dynamic routing di <code>routes/menu.php</code> agar otomatis melewati file Blade kosong (0-byte) dan langsung menampilkan halaman error 404 ketika menu/route diakses sebelum MVC/View-nya dibuat.</li>
                                        <li class="mb-1"><strong>Profil Pengguna Modularization:</strong> Pemisahan struktur view profil pengguna (<code>profil-pengguna.blade.php</code>) ke dalam sub-komponen modular di folder <code>resources/views/pages/profil/partials/</code> (tabs overview, settings, security, billing, statements, referrals, api-keys, logs).</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.5.1-->

                        <!--begin::Item v1.5.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.5.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.5.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 14:15 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Master Data Views Restructuring, Prefix Route Alignment & Seeder Normalization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penyelarasan struktur view master data ke dalam folder <code>pages/datamaster/</code>, standarisasi prefix route menu seeder <code>datamaster.*</code>, serta pembersihan dan penataan ulang konfigurasi seeder dan translasi menu.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Reorganisasi View Data Master:</strong> Memindahkan seluruh template view data master ke dalam folder <code>resources/views/pages/datamaster/</code> (termasuk modul <code>appsupport</code>, <code>manajemenpengguna</code>, dan <code>profil-pengguna</code>).</li>
                                        <li class="mb-1"><strong>Prefix Route Alignment:</strong> Penyelarasan penamaan route pada file seeder (<code>identitaspengguna_seeder.php</code>, <code>masterdata-appsupport_seeder.php</code>, <code>masterdata-manajemenpengguna_seeder.php</code>) menggunakan format konsisten <code>datamaster.*</code>.</li>
                                        <li class="mb-1"><strong>Automatic Route Mapping:</strong> Integrasi otomatis 13 endpoint submodule data master melalui dynamic route generator di <code>routes/menu.php</code>.</li>
                                        <li class="mb-1"><strong>Localization & Seeder Sync:</strong> Penyesuaian key translasi menu dan sinkronisasi struktur menu seeder.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.5.0-->

                        <!--begin::Item v1.4.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.4.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.4.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 10:35 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Admin MVC Architecture Convention, Dedicated Changelog Route & Menu Seeder Optimization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Standardisasi aturan arsitektur MVC Admin untuk menu seeder, penambahan integrasi route admin modular, pemisahan riwayat rilis ke halaman terdedikasi serta optimasi seeder dan translasi menu bilingual.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Admin MVC Architecture Rule:</strong> Penetapan konvensi penamaan folder, namespace, dan file untuk Model, View, Request, dan Controller bagi menu seeder di <code>.agents/rules/seeder-menu-implementation.md</code>.</li>
                                        <li class="mb-1"><strong>Modular Admin Routing (<code>routes/admin.php</code>):</strong> Integrasi file route khusus <code>admin.php</code> pada <code>routes/web.php</code> untuk memisahkan logika route admin secara terstruktur.</li>
                                        <li class="mb-1"><strong>Dedicated Changelog & Console Pages:</strong> Pemisahan riwayat rilis ke halaman terdedikasi <code>help/pemrograman/changelog</code> dan konsol developer ke <code>help/pemrograman/console-developer</code>.</li>
                                        <li class="mb-1"><strong>Menu Seeder & Localization Refinements:</strong> Penataan ulang seeder kategori master data, website data, sinkronisasi manifest, serta penyempurnaan translasi menu bahasa Indonesia dan Inggris.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.4.0-->

                        <!--begin::Item v1.3.1 (Patch)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.3.1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-primary fw-bold">v1.3.1</span>
                                    <span class="badge badge-light-warning fw-bold fs-8">Patch</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 01:59 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Homepage Menu Separation, Dashboards Active State Isolation & Config Restructure</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pemisahan menu tunggal Home Page dari dropdown menu Dashboards pada sidebar, isolasi deteksi route aktif agar dropdown Dashboards tidak ikut terbuka saat membuka default dashboard, penyesuaian daftar menu dashboard, serta penambahan i18n translasi bilingual untuk homepage.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Homepage Sidebar Menu Separation:</strong> Menu tunggal teratas kini bertindak mandiri sebagai <em>Home Page</em> (<code>menu.homepage</code>) terpisah dari section dropdown Dashboards.</li>
                                        <li class="mb-1"><strong>Dashboards Active State Isolation:</strong> Menghapus pencocokan route <code>dashboard</code> pada accordion menu Dashboards, sehingga dropdown hanya aktif pada pattern <code>dashboards.*</code>.</li>
                                        <li class="mb-1"><strong>Sidebar Config Restructure:</strong> Menata ulang item menu <code>menus_dashboard</code> dan <code>menus_dashboard_collapsed</code> pada <code>config/sidebar/_sidebar_dashboard.php</code>.</li>
                                        <li class="mb-1"><strong>Bilingual Localization & Blade Fix:</strong> Menambahkan translasi <code>menu.homepage</code> pada <code>lang/en/menu.php</code> dan <code>lang/id/menu.php</code>, serta perbaikan sintaks evaluasi title pada <code>dashboard.blade.php</code>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.3.1-->

                        <!--begin::Item v1.3.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.3.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.3.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>03 Sep 2026, 00:58 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Mobile Toolbar Hub Refinement, Responsive Topic Categories & Footer Optimization</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penyempurnaan arsitektur dan pengalaman pengguna (UX) pada tampilan mobile/HP, meliputi penataan posisi tengah dropdown quick tools, integrasi panel interaktif penuh (My Apps, Notifikasi, Theme Mode, Gaya Icon, Version), grid responsif topic categories, perbaikan icon duotone initial render, dan optimalisasi layout footer 3 baris di mobile.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Mobile Toolbar Hub Center Alignment:</strong> Posisi dropdown menu quick tools pada layar mobile diposisikan tepat di tengah horizontal layar (<code>left: 50%; transform: translateX(-50%)</code>) dengan batas lebar dan tinggi responsif.</li>
                                        <li class="mb-1"><strong>Interactive Toolbar Sub-Panels:</strong> Dropdown toolbar mobile menyematkan konten fitur desktop lengkap (Full My Apps 16+ icon, Full Tabbed Notifications, Theme Mode Light/Dark/System, Gaya Icon Duotone/Solid/Outline, Theme Version V1/V2, serta Drawer Activities & Chat).</li>
                                        <li class="mb-1"><strong>Toggle & Compact Default State:</strong> Toolbar mobile secara default tampil ringkas hanya berupa baris icon dan baru membuka panel submenu ketika salah satu icon disentuh/diklik (dapat ditutup kembali / <em>toggleable</em>).</li>
                                        <li class="mb-1"><strong>Dark Header Icon Visibility Fix:</strong> Isolasi style warna icon di dalam dropdown mobile agar tidak terpengaruh style putih dark-header pada layout Metronic Version 2.</li>
                                        <li class="mb-1"><strong>Responsive Dynamic Topic Categories:</strong> Grid kategori topik pada widget dashboard kini dinamis dan membungkus ke bawah (<em>auto-wrap</em>) pada layar HP/tablet (12 kolom desktop, 6 kolom laptop, 4 kolom tablet, 3/2 kolom mobile) sehingga kartu tombol tidak pipih.</li>
                                        <li class="mb-1"><strong>Duotone Initial Render Fix:</strong> Melengkapi seluruh 12 icon kategori dengan child element <code>&lt;span class="path..."&gt;</code> agar icon duotone tampil sempurna tanpa jeda atau kedip saat pertama kali dimuat.</li>
                                        <li class="mb-1"><strong>3-Row Responsive Footer:</strong> Tata letak footer pada mobile disusun rapi menjadi 3 baris terpusat (Menu Links, Copyright, Info Versi Laravel/PHP/MySQL) dan tetap 1 baris inline di desktop.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.3.0-->

                        <!--begin::Item v1.2.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.2.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.2.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>02 Sep 2026, 14:34 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Dynamic KeenIcons Style Switcher & Icon Architecture Schema</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Penambahan fitur dinamisasi gaya icon KeenIcons (Duotone, Solid, Outline) pada topbar toolbar, engine JavaScript otomatis dengan dukungan MutationObserver, persistensi runtime (localStorage & cookie), serta penambahan modul dokumentasi Skema Pergantian Icon.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Dynamic KeenIcons Switcher:</strong> Tombol toggle dan dropdown menu di topbar/navbar untuk mengganti gaya icon aktif secara dinamis antara <em>Duotone</em> (default), <em>Solid</em>, dan <em>Outline</em> dengan preview representatif <code>ki-chart</code>.</li>
                                        <li class="mb-1"><strong>Live DOM Icon Transformation:</strong> Engine client-side (<code>public/assets/js/custom/icon-style.js</code>) yang secara instan mengonversi seluruh class icon KeenIcons di seluruh halaman aplikasi secara real-time.</li>
                                        <li class="mb-1"><strong>Otomatisasi MutationObserver:</strong> Mendeteksi elemen DOM baru yang dimuat secara asinkron (modal, AJAX content, tab) dan otomatis menyesuaikannya dengan gaya icon aktif.</li>
                                        <li class="mb-1"><strong>Anti-Flicker & Persistensi:</strong> Inisialisasi awal via <code>partials.icon-style._init</code> pada root HTML dan penyimpanan preferensi di <code>localStorage</code> serta Cookie <code>kt_icon_style</code>.</li>
                                        <li class="mb-1"><strong>Integrasi Multi-Layout:</strong> Pemasangan icon style switcher pada Layout Default/v1, Layout v2 (Demo 2), dan Layout Dokumentasi.</li>
                                        <li class="mb-1"><strong>Skema Pergantian Icon:</strong> Modul blueprint arsitektur baru di <code>help/pemrograman/skema/pergantian-icon</code> yang mengulas tuntas standar HTML 3 varian gaya KeenIcons, siklus hidup, API JavaScript <code>KTIconStyle</code>, dan panduan developer.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.2.0-->

                        <!--begin::Item v1.1.0 (Minor)-->
                        <div class="timeline-item mb-7">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.1.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.1.0</span>
                                    <span class="badge badge-light-primary fw-bold fs-8">Minor</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>02 Sep 2026, 12:08 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Stable Release</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Dynamic Frontpages Switcher, Layout Polish & Core Enhancements</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Pembaruan arsitektur besar untuk mendukung pemilihan multi-template frontpage dinamis, standardisasi layout autentikasi, penyempurnaan switcher multi-versi, serta konversi dokumentasi ke Bahasa Indonesia murni.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Lengkap Perubahan:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Dynamic Frontpages Switcher:</strong> Menambahkan menu dropdown di topbar/navbar untuk memilih template halaman depan yang aktif secara dinamis (Landing Page Metronic 8 & Education Portal Unify v2.6).</li>
                                        <li class="mb-1"><strong>Persistensi Preferensi:</strong> Dukungan penyimpanan preferensi frontpage melalui Cookie & Session, sehingga pilihan pengguna tersimpan dan persisten saat login/logout.</li>
                                        <li class="mb-1"><strong>Rute Dedicated Preview:</strong> Menambahkan akses langsung rute <code>/landing</code> dan <code>/education</code> untuk kebutuhan preview independen tanpa terpengaruh preferensi aktif default.</li>
                                        <li class="mb-1"><strong>Reorganisasi Folder View:</strong> Merestrukturisasi direktori views menjadi <code>views/frontpages/education/</code> dan <code>views/frontpages/landing/</code> untuk modularitas yang lebih rapi dan bersih.</li>
                                        <li class="mb-1"><strong>Isolasi Layout Autentikasi:</strong> Standardisasi halaman autentikasi (Login, Register, Forgot Password) agar selalu menggunakan layout standalone independen terlepas dari versi tema maupun frontpage aktif.</li>
                                        <li class="mb-1"><strong>Sinkronisasi Dropdown Trigger:</strong> Memperbaiki dan menyinkronkan perilaku interaksi dropdown switch frontpage pada topbar Metronic v2.</li>
                                        <li class="mb-1"><strong>Penambahan Skema & Panduan Operasional:</strong> Menambahkan modul blueprint arsitektur baru untuk <em>Skema Pergantian Versi Tampilan</em>, <em>Skema Pergantian Frontpage</em>, dan <em>Panduan Operasional Pergantian Frontpage</em>.</li>
                                        <li class="mb-1"><strong>Dokumentasi Murni Bahasa Indonesia:</strong> Mengonversi seluruh 24 halaman modul Help Pemrograman ke teks baku Bahasa Indonesia langsung (hardcoded) dengan tetap mempertahankan fleksibilitas bilingual pada menu navigasi sidebar & header.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.1.0-->

                        <!--begin::Item v1.0.0 (Major)-->
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-7 w-80px">v1.0.0</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <div class="timeline-content ps-3">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                    <span class="badge badge-success fw-bold">v1.0.0</span>
                                    <span class="badge badge-light-danger fw-bold fs-8">Major</span>
                                    <span class="badge badge-light text-gray-700 fs-8 border">
                                        <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                                        </i>02 Sep 2026, 10:02 WIB
                                    </span>
                                    <span class="badge badge-light-dark fs-8 ms-auto">Base Version</span>
                                </div>
                                <h4 class="text-gray-900 fw-bold fs-6 mb-2">Initial Release & Laravel 13 Upgrade</h4>
                                <p class="text-gray-700 fs-7 mb-3">
                                    Rilis awal template Veltronic dengan upgrade fondasi framework ke Laravel 13 dan integrasi tema Metronic 8.
                                </p>
                                <div class="bg-light rounded p-4 border border-dashed border-gray-300">
                                    <div class="fw-semibold text-gray-800 fs-7 mb-2">Rincian Fitur Awal:</div>
                                    <ul class="text-gray-700 fs-7 mb-0 ps-4">
                                        <li class="mb-1"><strong>Laravel 13 Foundation:</strong> Kompatibilitas penuh dengan Laravel 13, PHP 8.2+, dan manajemen asset modern.</li>
                                        <li class="mb-1"><strong>Dual Version Theme:</strong> Integrasi Metronic v1 & v2 dengan runtime theme version switcher (<code>App\Support\ThemeVersion</code>).</li>
                                        <li class="mb-1"><strong>Multilingual Support (i18n):</strong> Dukungan alih bahasa (English & Bahasa Indonesia) dengan session storage.</li>
                                        <li class="mb-1"><strong>Documentation & Help Center:</strong> Modul panduan arsitektur pemrograman, skema routing, layout, menu, dan checklist QA.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end::Item v1.0.0-->
                    </div>
                    <!--end::Timeline-->
                </div>
            </div>
            <!--end::Version & Tags History Card-->
        </div>
    </div>
@endsection
