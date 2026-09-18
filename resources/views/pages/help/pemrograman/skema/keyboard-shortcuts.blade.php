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
                    <span class="schema-pill">Shortcut Engine Architecture</span>
                    <h2 class="fw-bold">Skema Keyboard Shortcuts (Global Hotkeys &amp; Action Registry)</h2>
                    <p class="schema-lead">
                        Blueprint arsitektur sistem hotkey global aplikasi yang menghubungkan penekanan kombinasi tombol keyboard (<code>Ctrl + Alt + [Key]</code>) dengan eksekusi aksi JavaScript secara modular, otorisasi berbasis Role, serta persistensi konfigurasi di database tanpa reload halaman.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: 5-Tier Action Matrix-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Klasifikasi 5 Kategori Shortcut</h4>
                            <p class="text-gray-700 fs-7">
                                Seluruh pintasan keyboard dikelompokkan ke dalam 5 kategori fungsional untuk memudahkan tata kelola dan pemilahan di UI:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>1. Visibility Toggle (Visibilitas UI):</strong>
                                    <p class="fs-8 text-muted mb-0">Menyembunyikan atau menampilkan elemen layout seperti Sidebar Menu (<code>Ctrl+Alt+M</code>), Header Menu (<code>Ctrl+Alt+H</code>), dan Tools Topbar (<code>Ctrl+Alt+T</code>).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>2. Appearance &amp; Theme (Tema &amp; Visual):</strong>
                                    <p class="fs-8 text-muted mb-0">Beralih mode gelap/terang (<code>Ctrl+Alt+D</code>) dan rotasi siklus gaya KeenIcons Duotone, Solid, Outline (<code>Ctrl+Alt+I</code>).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>3. System &amp; Security (Sistem &amp; Keamanan):</strong>
                                    <p class="fs-8 text-muted mb-0">Membuka modal Petunjuk Operasional (<code>Ctrl+Alt+P</code>) dan mengunci layar seketika / Lock Screen (<code>Ctrl+Alt+L</code>).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>4. Navigation (Navigasi Cepat):</strong>
                                    <p class="fs-8 text-muted mb-0">Quick jump langsung ke Dashboard (<code>Ctrl+Alt+1</code>), Fitur Aplikasi (<code>Ctrl+Alt+2</code>), Profil (<code>Ctrl+Alt+3</code>), dan Manajemen Pengguna (<code>Ctrl+Alt+4</code>).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>5. Element &amp; Modals (Elemen &amp; Formulir):</strong>
                                    <p class="fs-8 text-muted mb-0">Membuka pencarian global (<code>Ctrl+Alt+F</code>) dan trigger aksi form / filter dinamis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Database Schema & Role Scoping-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Skema Database &amp; Otorisasi Role</h4>
                            <p class="text-gray-700 fs-7">
                                Tabel <code>app_shortcuts</code> menyimpan seluruh metadata pintasan dengan kolom JSON roles untuk pembatasan hak akses:
                            </p>
                            <pre class="schema-code"><code>// Schema Blueprint Migration:
Schema::create('app_shortcuts', function (Blueprint $table) {
    $table->id();
    $table->string('nama');              // Label pintasan
    $table->string('kode_aksi')->unique(); // ID unik aksi (ActionRegistry)
    $table->string('kategori', 50);      // visibility, appearance, system, nav, element
    $table->string('kombinasi_key', 50); // Format standar: "Ctrl + Alt + [Key]"
    $table->string('deskripsi')->nullable();
    $table->boolean('is_active')->default(true);
    $table->json('roles')->nullable();   // Array role yang diizinkan ['master', 'admin', 'user']
    $table->timestamps();
});</code></pre>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">Table: app_shortcuts</span>
                                <span class="schema-chip">JSON Role Scoping</span>
                                <span class="schema-chip">Zero-Reload CRUD</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Conflict Prevention & Dual-Key Detection-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Proteksi Konflik Browser &amp; Dual-Key Engine</h4>
                            <p class="text-gray-700 fs-7">
                                Mengapa menggunakan standar kombinasi <code>Ctrl + Alt + [Key]</code>?
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Bebas Konflik Native Browser:</strong>
                                    <p class="fs-8 text-muted mb-0">Menghindari benturan hotkey sistem seperti <code>Ctrl+Shift+T</code> (membuka kembali tab yang tertutup) dan <code>Ctrl+Shift+H</code> (riwayat browser).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Dual-Key Matching (<code>e.key</code> &amp; <code>e.code</code>):</strong>
                                    <p class="fs-8 text-muted mb-0">Engine membaca kode fisik keyboard (<code>e.code: KeyT</code>) dan karakter tombol (<code>e.key: t/T</code>) sehingga hotkey tetap berfungsi sempurna meski <em>Caps Lock</em> atau <em>Shift</em> aktif.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Input Field Suppression:</strong>
                                    <p class="fs-8 text-muted mb-0">Hotkey dinonaktifkan otomatis saat kursor berada di dalam elemen <code>&lt;input&gt;</code>, <code>&lt;textarea&gt;</code>, atau <code>contenteditable</code> untuk mencegah interferensi pengetikan teks.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Action Registry & Execution Flow-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Engine Frontend (<code>shortcuts.js</code>) &amp; Action Registry</h4>
                            <p class="text-gray-700 fs-7">
                                Modul client-side menggunakan pola <em>Action Registry</em> terpusat yang memudahkan penambahan aksi baru:
                            </p>
                            <pre class="schema-code"><code>// Struktur Registry Handler:
const ActionRegistry = {
    toggle_sidebar: () => KTApp.toggleSidebar(),
    toggle_header_menu: () => KTApp.toggleHeaderMenu(),
    toggle_topbar_tools: () => KTApp.toggleTopbarTools(),
    toggle_dark_mode: () => KTThemeMode.toggle(),
    cycle_icon_style: () => KTIconStyle.cycle(),
    open_petunjuk_modal: () => $('#kt_modal_petunjuk').modal('show'),
    lock_screen: () => KTLockScreen.lock(),
    // ...
};

// Registrasi handler dinamis dari modul eksternal:
window.VeltronicShortcuts.registerActionHandler('custom_export', function() {
    console.log('Menjalankan custom export...');
});</code></pre>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Developer API & Integration Reference-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. API JavaScript (<code>VeltronicShortcuts</code>) &amp; Siklus Hidup</h4>
                            <div class="schema-grid">
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light">
                                        <h5 class="fs-6 fw-bold mb-2">Alur Siklus Hidup (Lifecycle)</h5>
                                        <ol class="fs-8 text-gray-700 mb-0 ps-3">
                                            <li class="mb-1"><strong>Load Inisialisasi:</strong> Script memuat array shortcut aktif dari endpoint <code>/appsupport/shortcuts-active</code> sesuai role pengguna yang login.</li>
                                            <li class="mb-1"><strong>Global Event Listener:</strong> Event <code>window.addEventListener('keydown', handleGlobalKeydown)</code> aktif di seluruh halaman dashboard.</li>
                                            <li class="mb-1"><strong>Normalisasi Signature:</strong> Saat tombol ditekan, tombol dinormalisasi ke string format kecil (misal: <code>ctrl+alt+t</code>).</li>
                                            <li class="mb-1"><strong>Matching &amp; Dispatch:</strong> Jika signature cocok dengan shortcut aktif, eksekusi <code>ActionRegistry[actionCode]()</code> secara instan.</li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light">
                                        <h5 class="fs-6 fw-bold mb-2">Metode Public API</h5>
                                        <pre class="schema-code mb-0"><code>// Membuka manual / petunjuk pintasan keyboard:
VeltronicShortcuts.showHelpModal();

// Mengambil daftar shortcut aktif saat ini:
var activeList = VeltronicShortcuts.getActiveShortcuts();

// Mendaftarkan aksi kustom runtime:
VeltronicShortcuts.registerActionHandler('kode_aksi', callbackFn);

// Trigger eksekusi aksi secara langsung via kode:
VeltronicShortcuts.executeAction('toggle_sidebar');</code></pre>
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
