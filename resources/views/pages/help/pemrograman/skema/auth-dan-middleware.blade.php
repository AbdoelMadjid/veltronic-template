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
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="schema-shell">
                <div class="schema-hero">
                    <span class="schema-pill">Auth Blueprint</span>
                    <h2 class="fw-bold">Skema Auth dan Middleware</h2>
                    <p class="schema-lead">
                        Pondasi keamanan proyek: route auth bawaan Laravel + proteksi middleware + middleware custom locale.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Flow Login dan Akses Halaman</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Guest akses <code>/login</code> (dari <code>routes/auth.php</code>).</div>
                                <div class="schema-step">2. Submit login ke <code>POST /login</code>.</div>
                                <div class="schema-step">3. Jika sukses, session auth aktif dan user diarahkan ke halaman aplikasi.</div>
                                <div class="schema-step">4. Route protected (dashboard/menu pages) hanya bisa dibuka jika lolos middleware <code>auth</code>.</div>
                                <div class="schema-step">5. Route tertentu juga pakai <code>verified</code> untuk email verification.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Peta Route Auth Penting</h4>
                            <pre class="schema-code"><code>guest middleware:
- GET  /login
- POST /login
- GET  /register
- POST /register
- forgot/reset password routes

auth middleware:
- GET  /verify-email
- POST /email/verification-notification
- PUT  /password
- POST /logout</code></pre>
                            <div class="schema-meta">
                                <span class="schema-chip">source: routes/auth.php</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Proteksi Route di Proyek</h4>
                            <ul class="schema-list">
                                <li><code>/dashboard</code> memakai middleware <code>auth</code> + <code>verified</code>.</li>
                                <li>Semua route generator di <code>routes/menu.php</code> dibungkus middleware <code>auth</code>.</li>
                                <li>Profile management di <code>routes/web.php</code> juga ada dalam group <code>auth</code>.</li>
                                <li>Fallback 404 ditempatkan di luar auth agar respons error tetap konsisten.</li>
                            </ul>
                            <div class="schema-note mt-4">Dampak: user belum login tidak bisa akses halaman konten internal di bawah <code>resources/views/pages</code>.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Middleware Custom: SetLocale</h4>
                            <pre class="schema-code"><code>// bootstrap/app.php
$middleware->web(append: [
  \App\Http\Middleware\SetLocale::class,
]);

// SetLocale
if (Session::has('locale')) {
  App::setLocale(Session::get('locale'));
}</code></pre>
                            <div class="schema-warn mt-4">Middleware ini berjalan di group <code>web</code>, jadi seluruh request web otomatis mengikuti locale session.</div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Checklist Security Minimum</h4>
                            <ol class="schema-list">
                                <li>Pastikan route sensitif selalu berada di middleware <code>auth</code>.</li>
                                <li>Untuk area kritikal, tambahkan <code>verified</code> atau middleware tambahan lain sesuai kebutuhan.</li>
                                <li>Gunakan <code>signed</code> dan <code>throttle</code> seperti pada route verifikasi email.</li>
                                <li>Validasi redirect dan guard flow saat login/logout agar tidak ada open redirect.</li>
                                <li>Uji skenario guest vs authenticated untuk setiap halaman blueprint baru.</li>
                            </ol>
                            <div class="schema-meta">
                                <span class="schema-chip">auth</span>
                                <span class="schema-chip">verified</span>
                                <span class="schema-chip">signed</span>
                                <span class="schema-chip">throttle</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Matrix Middleware (Praktis)</h4>
                            <pre class="schema-code"><code>Public:
- landing, login, register, forgot password

Authenticated:
- dashboard, pages/*, profile/*

Authenticated + Verified:
- fitur yang butuh email terverifikasi

Signed/Throttle:
- verification link, resend verification</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) Auth</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> route baru harus diklasifikasikan jelas: public vs auth vs auth+verified.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> endpoint sensitif harus punya throttle jika rawan abuse.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> tidak boleh expose detail autentikasi internal pada pesan error user.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> setiap perubahan auth flow harus diuji guest, user valid, dan user tanpa verifikasi.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection