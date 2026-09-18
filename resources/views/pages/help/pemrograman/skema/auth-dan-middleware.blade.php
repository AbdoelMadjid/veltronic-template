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
                    <span class="schema-pill">Auth &amp; RBAC Architecture</span>
                    <h2 class="fw-bold">Skema Autentikasi, Middleware &amp; Spatie Role-Permission</h2>
                    <p class="schema-lead">
                        Pondasi keamanan menyeluruh: autentikasi Laravel, proteksi middleware, otorisasi Role &amp; Permission berbasis Spatie, matriks akses 2D, pembedaan izin langsung vs terwarisi, pemberian peran massal, serta sistem reward login &amp; lockscreen session.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Flow Login & Reward Poin-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Flow Login, Reward 1 Poin 24 Jam &amp; Lockscreen</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>1. Autentikasi Kredensial:</strong>
                                    <p class="fs-8 text-muted mb-1">Pengguna login via <code>POST /login</code> dengan proteksi rate limit <code>throttle:5,1</code>.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>2. Reward 1 Poin Login (Cooldown 24 Jam):</strong>
                                    <p class="fs-8 text-muted mb-1">Jika login pertama dalam 24 jam terakhir, sistem menambahkan 1 poin reward dan mencatat riwayat ke <code>data-login</code>.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>3. Sesi Kunci Layar (Lock Screen):</strong>
                                    <p class="fs-8 text-muted mb-0">Fitur <code>/lock-screen</code> mengunci sesi aktif tanpa menghapus token auth; pengguna cukup memasukkan password untuk membuka kembali.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Spatie Role & Permission Hierarchy-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Hierarki Spatie Role &amp; Permission</h4>
                            <p class="text-gray-700 fs-7">
                                Menggunakan pustaka resmi <code>spatie/laravel-permission</code> dengan konvensi penamaan seragam:
                            </p>
                            <pre class="schema-code"><code>// Konvensi Penamaan Permission Modul:
[nama_modul]_[aksi] (contoh: user_create, role_update, backup_delete)

// Penggunaan di Controller / Route:
Route::middleware(['role:master|admin'])->group(...);
Route::middleware(['permission:user_create'])->group(...);

// Pengecekan di Blade View:
@can('user_delete')
    &lt;button class="btn btn-danger"&gt;Hapus&lt;/button&gt;
@endcan</code></pre>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">spatie/laravel-permission</span>
                                <span class="schema-chip">Multi-Role Support</span>
                                <span class="schema-chip">Blade Directives</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Matriks Akses Role 2D-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Matriks 2D Akses Role (Role-Permission Matrix)</h4>
                            <p class="text-gray-700 fs-7">
                                Modul <code>usermanagement/akses-role</code> menyediakan visualisasi kisi matriks peran vs izin:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Kolom Peran Dinamis:</strong>
                                    <p class="fs-8 text-muted mb-1">Menampilkan seluruh role terdaftar (Master, Admin, Operator, User, dll).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Grup Permission per Modul:</strong>
                                    <p class="fs-8 text-muted mb-1">Izin dikelompokkan berdasarkan modul (User Management, App Support, Master Data, Transaksi).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Toggle &amp; Bulk Checkbox Realtime:</strong>
                                    <p class="fs-8 text-muted mb-0">Admin dapat mencentang/membatalkan izin per role atau massal satu modul secara realtime tanpa reload halaman.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Akses User - Izin Terwarisi vs Langsung-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Akses User: Izin Terwarisi vs Izin Langsung</h4>
                            <p class="text-gray-700 fs-7">
                                Modul <code>usermanagement/akses-user</code> membedakan sumber hak akses pengguna:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Izin Terwarisi (Inherited Permission):</strong>
                                    <p class="fs-8 text-muted mb-1">Izin yang diperoleh secara otomatis karena pengguna memiliki Role tertentu (ditandai dengan badge badge-light-primary dan terkunci secara aman).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Izin Langsung (Direct Permission):</strong>
                                    <p class="fs-8 text-muted mb-1">Izin spesifik yang diberikan khusus kepada user tertentu di luar peran standarnya.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Pemberian Role Massal (Bulk Assign Role):</strong>
                                    <p class="fs-8 text-muted mb-0">Fitur untuk mengubah/menambahkan role ke puluhan user terpilih sekaligus via modal centang.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Matrix Middleware-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Matriks Middleware &amp; Guard Aplikasi</h4>
                            <div class="schema-grid">
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Public Guard</h5>
                                        <p class="fs-8 text-gray-700 mb-1"><code>guest</code> / Bebas Akses</p>
                                        <ul class="fs-8 text-muted ps-3 mb-0">
                                            <li>Landing Page (<code>/</code>, <code>/landing</code>)</li>
                                            <li>Halaman Login (<code>/login</code>)</li>
                                            <li>Lupa Sandi &amp; Registrasi</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Authenticated Guard</h5>
                                        <p class="fs-8 text-gray-700 mb-1"><code>auth</code> + <code>SetLocale</code></p>
                                        <ul class="fs-8 text-muted ps-3 mb-0">
                                            <li>Dashboard (<code>/dashboard</code>)</li>
                                            <li>Profil Pengguna (<code>/profil/*</code>)</li>
                                            <li>Halaman Panduan Help (<code>/help/*</code>)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="schema-col-4">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Role &amp; Permission Guard</h5>
                                        <p class="fs-8 text-gray-700 mb-1"><code>role:master|admin</code> / <code>permission:*</code></p>
                                        <ul class="fs-8 text-muted ps-3 mb-0">
                                            <li>User Management (<code>/usermanagement/*</code>)</li>
                                            <li>Fitur &amp; Setting (<code>/appsupport/*</code>)</li>
                                            <li>Backup Database (<code>/appsupport/backup-db</code>)</li>
                                        </ul>
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