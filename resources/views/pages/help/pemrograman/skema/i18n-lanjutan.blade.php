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
                    <span class="schema-pill">Localization</span>
                    <h2 class="fw-bold">Skema i18n Lanjutan</h2>
                    <p class="schema-lead">
                        Standar naming key, governance translasi, dan proses tambah bahasa baru end-to-end.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Key Translasi</h4>
                            <ul class="schema-list">
                                <li>Gunakan namespace konsisten, misal <code>menu.*</code>, <code>auth.*</code>, <code>pages.*</code>.</li>
                                <li>Hindari hardcoded text pada Blade untuk teks yang user-facing.</li>
                                <li>Jaga key stabil; ubah value terjemahan tanpa mengubah key bila memungkinkan.</li>
                            </ul>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">stable keys</span>
                                <span class="schema-chip">domain namespace</span>
                                <span class="schema-chip">no hardcoded UI text</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Arsitektur i18n Saat Ini</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Locale disimpan di session melalui route switch bahasa.</div>
                                <div class="schema-step">Label menu diresolve dari key <code>menu.*</code> berdasarkan title config.</div>
                                <div class="schema-step">Jika key tidak ada, sistem fallback ke text asli title menu.</div>
                                <div class="schema-step">Sumber translasi utama saat ini ada di <code>lang/en/menu.php</code> dan <code>lang/id/menu.php</code>.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Skema File dan Domain Translasi</h4>
                            <pre class="schema-code"><code>lang/
├─ en/
│  ├─ menu.php
│  ├─ auth.php
│  └─ ...
├─ id/
│  ├─ menu.php
│  ├─ auth.php
│  └─ ...
└─ {locale-baru}/
   ├─ menu.php
   ├─ auth.php
   └─ ...

Rekomendasi domain:
- menu.*      : label navigasi
- auth.*      : login/register/reset
- validation.*: pesan validasi
- pages.*     : teks spesifik halaman
- common.*    : teks umum reusable</code></pre>
                            <div class="schema-note mt-4">Pisahkan domain translasi agar review perubahan lebih mudah dan konflik merge lebih kecil.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Konvensi Naming Key (Strict)</h4>
                            <ul class="schema-list">
                                <li>Gunakan lowercase + underscore: <code>menu.skema_cache_and_deployment</code>.</li>
                                <li>Nama key harus deskriptif, hindari singkatan ambigu.</li>
                                <li>Satu key untuk satu makna; jangan reuse key untuk konteks berbeda.</li>
                                <li>Jika string butuh variabel, gunakan placeholder konsisten (contoh <code>:name</code>, <code>:count</code>).</li>
                                <li>Hindari key berbasis posisi UI (misal <code>title_1</code>, <code>label_left</code>).</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Workflow Tambah Bahasa Baru (End-to-End)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Buat folder locale baru: <code>lang/{locale}</code>.</div>
                                <div class="schema-step">2. Duplikasi baseline file dari bahasa default.</div>
                                <div class="schema-step">3. Terjemahkan per domain + review glossary istilah.</div>
                                <div class="schema-step">4. Daftarkan locale ke route switch bahasa dan opsi UI.</div>
                                <div class="schema-step">5. Uji semua menu, auth, validasi, dan halaman kritikal.</div>
                                <div class="schema-step">6. Cek fallback key hilang sebelum release.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Contoh Governance Translasi</h4>
                            <pre class="schema-code"><code>Pull Request i18n wajib mencakup:
- daftar key baru/diubah
- domain file yang terdampak
- screenshot EN vs ID
- verifikasi tidak ada missing key
- reviewer bilingual/domain owner

Aturan perubahan:
- Menambah key: boleh
- Ubah value: boleh (dengan konteks)
- Rename/hapus key: butuh impact check lintas view/config</code></pre>
                            <div class="schema-warn mt-4">Rename key translasi tanpa audit pemakaian bisa menyebabkan fallback diam-diam dan inkonsistensi UI.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Fallback Strategy</h4>
                            <ul class="schema-list">
                                <li>Tentukan default locale global (misal <code>en</code> atau <code>id</code>).</li>
                                <li>Jika key tidak ada pada locale aktif, fallback ke locale default.</li>
                                <li>Jika tetap tidak ada, tampilkan fallback aman (title asli/placeholder terkontrol).</li>
                                <li>Catat missing key dalam log QA agar bisa ditutup sebelum release.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>QA Checklist i18n</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Switch locale dari UI dan pastikan persist antar halaman.</div>
                                <div class="schema-step">2. Periksa menu/sidebar/header/breadcrumb sudah tertranslate.</div>
                                <div class="schema-step">3. Periksa pesan validasi, flash message, dan error pages.</div>
                                <div class="schema-step">4. Periksa teks dengan placeholder/pluralization.</div>
                                <div class="schema-step">5. Periksa layout overflow untuk string yang lebih panjang.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Risiko Umum & Mitigasi</h4>
                            <ul class="schema-list">
                                <li><strong>Missing key:</strong> buat script audit key lintas locale sebelum merge.</li>
                                <li><strong>Inkonstisten istilah:</strong> gunakan glossary tim per domain bisnis.</li>
                                <li><strong>UI pecah karena string panjang:</strong> uji responsive EN/ID (dan locale baru) di mobile+desktop.</li>
                                <li><strong>Campur bahasa:</strong> larang hardcoded text pada komponen reusable.</li>
                                <li><strong>Pluralization salah:</strong> gunakan format plural bawaan framework untuk bahasa terkait.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) i18n</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> semua key baru harus ditambahkan minimal di <code>en</code> dan <code>id</code>.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> PR yang mengubah menu/config harus menyertakan update key translasi terkait.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> tidak boleh merge jika audit menunjukkan missing key pada locale wajib.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> perubahan terminology domain utama harus mendapat persetujuan product/domain owner.</div>
                                <div class="schema-step"><strong>Rule opsional:</strong> maintain glossary per domain agar tone konsisten lintas halaman.</div>
                            </div>
                            <div class="schema-meta mt-4">
                                <span class="schema-chip">en+id parity</span>
                                <span class="schema-chip">no missing keys</span>
                                <span class="schema-chip">domain-approved terms</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection