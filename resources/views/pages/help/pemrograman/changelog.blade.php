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
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Version & Tags History Card-->
            <div class="card mb-5 mb-xl-8 border">
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
                            Versi Saat Ini: v1.5.1
                        </span>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <!--begin::Timeline-->
                    <div class="timeline-label">
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
                                    <span class="badge badge-light-success fs-8 ms-auto">Latest Release</span>
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
