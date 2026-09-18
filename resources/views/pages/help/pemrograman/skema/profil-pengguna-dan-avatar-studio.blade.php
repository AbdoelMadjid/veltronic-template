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
                    <span class="schema-pill">User Experience &amp; Studio Architecture</span>
                    <h2 class="fw-bold">Skema Profil Pengguna &amp; Avatar Studio</h2>
                    <p class="schema-lead">
                        Blueprint arsitektur manajemen identitas pengguna terpadu 5-tab, studio manipulasi avatar interaktif 2-axis (X/Y) dengan zoom dinamis hingga 5x, skema JSON preferensi 1-User-1-Row (<code>user_settings</code>), serta sinkronisasi visual realtime di topbar &amp; lockscreen.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Arsitektur 5-Tab Profil-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Struktur 5-Tab Profil Pengguna (<code>profil/profil-pengguna</code>)</h4>
                            <p class="text-gray-700 fs-7">
                                Modul profil dipecah menjadi partials modular berbasis tab navigasi:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>1. Overview (Ringkasan):</strong>
                                    <p class="fs-8 text-muted mb-1">Menampilkan kartu identitas, badge peran, moto hidup, dan ringkasan metrik poin aktivitas.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>2. Identitas Diri:</strong>
                                    <p class="fs-8 text-muted mb-1">Form data personal (Nama, Username, NIK, No. HP, Jenis Kelamin, Tempat/Tanggal Lahir, Alamat).</p>
                                </div>
                                <div class="schema-step">
                                    <strong>3. Keamanan &amp; Kata Sandi:</strong>
                                    <p class="fs-8 text-muted mb-1">Form verifikasi password lama, validasi password baru, dan histori reset sandi.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>4. Konfigurasi &amp; Cover Studio:</strong>
                                    <p class="fs-8 text-muted mb-1">Pengaturan preferensi tampilan, tema dark/light, dan pilihan custom background cover header.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>5. Riwayat Aktivitas (Terisolasi):</strong>
                                    <p class="fs-8 text-muted mb-0">Timeline aktivitas personal pengguna yang tersinkronisasi realtime tanpa reload.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Avatar Studio Engine 2-Axis-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Engine Avatar Studio 2-Axis (Zoom &amp; Pan)</h4>
                            <p class="text-gray-700 fs-7">
                                Fitur pengeditan avatar interaktif tanpa library pihak ketiga yang berat:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Kontrol Zoom Dinamis (1.0x – 5.0x):</strong>
                                    <p class="fs-8 text-muted mb-1">Pengguna dapat memperbesar/memperkecil area fokus foto profil melalui slider kontrol presisi.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Pergeseran Fokus 2-Axis (X/Y Offset):</strong>
                                    <p class="fs-8 text-muted mb-1">Menentukan titik pusat wajah secara horizontal (0% - 100%) dan vertikal (0% - 100%) untuk memastikan wajah pas di tengah frame.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Live Dual-Preview (Squircle &amp; Circle):</strong>
                                    <p class="fs-8 text-muted mb-0">Pratinjau langsung tampilan avatar pada bentuk rounded-3 squircle (standar Metronic) dan rounded circle.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Skema JSON user_settings-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Skema JSON Preferensi 1-User-1-Row (<code>user_settings</code>)</h4>
                            <p class="text-gray-700 fs-7">
                                Menyimpan seluruh preferensi pengguna tanpa membuat tabel relasi baru yang membebani query:
                            </p>
                            <pre class="schema-code"><code>// Struktur JSON di kolom users.user_settings:
{
    "avatar_zoom": 1.4,
    "avatar_pos_x": 50,
    "avatar_pos_y": 25,
    "cover_type": "gradient",      // image, gradient, solid
    "cover_style": "linear-gradient(135deg, #1e1e2d 0%, #2b2b40 100%)",
    "theme_mode": "dark",
    "email_notifications": true,
    "session_timeout_minutes": 30
}</code></pre>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">1-User-1-Row</span>
                                <span class="schema-chip">JSON Casted Model</span>
                                <span class="schema-chip">Fast O(1) Fetch</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Realtime DOM Sync Engine-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Sinkronisasi Realtime Tanpa Reload (Topbar &amp; Lockscreen)</h4>
                            <p class="text-gray-700 fs-7">
                                Saat pengguna menyimpan avatar atau mengubah nama di profil:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>AJAX Response Payload:</strong>
                                    <p class="fs-8 text-muted mb-1">Backend mengembalikan URL avatar terbaru beserta parameter transformasi CSS <code>transform: scale(...) translate(...)</code>.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>Live DOM Selector Broadcast:</strong>
                                    <p class="fs-8 text-muted mb-1">Script memperbarui seluruh gambar avatar di Topbar User Menu, Header Avatar, Card Profil, dan Session Lockscreen seketika.</p>
                                </div>
                                <div class="schema-step">
                                    <strong>SweetAlert2 &amp; Tab State Lock:</strong>
                                    <p class="fs-8 text-muted mb-0">Notifikasi sukses muncul, dan tab yang sedang aktif tetap terkunci di posisinya tanpa reset navigasi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Komponen & Helper Blade-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Helper Global &amp; Komponen Partials Profil</h4>
                            <div class="schema-grid">
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Helper Render Avatar Global</h5>
                                        <pre class="schema-code mb-0"><code>// Penggunaan di Blade View:
&lt;x-user-avatar :user="$user" size="50px" shape="squircle" /&gt;

// Output HTML yang Dihasilkan:
&lt;div class="symbol symbol-50px symbol-2by3"&gt;
    &lt;img src="@{{ $user->avatar_url }}" 
         style="object-position: @{{ $user->avatar_pos_x }}% @{{ $user->avatar_pos_y }}%;" /&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                </div>
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light h-100">
                                        <h5 class="fs-6 fw-bold mb-2">Struktur Partials Blade</h5>
                                        <ul class="fs-8 text-gray-700 mb-0 ps-3">
                                            <li class="mb-1"><code>tabs/_overview.blade.php</code>: Panel kartu identitas &amp; moto hidup.</li>
                                            <li class="mb-1"><code>tabs/_identitas.blade.php</code>: Form data personal &amp; NIK.</li>
                                            <li class="mb-1"><code>tabs/_password.blade.php</code>: Form kata sandi.</li>
                                            <li class="mb-1"><code>tabs/_konfigurasi.blade.php</code>: Cover background studio.</li>
                                            <li class="mb-1"><code>modals/_avatar-studio.blade.php</code>: Modal zoom/pan avatar.</li>
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
