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
                    <span class="schema-pill">Error Flow</span>
                    <h2 class="fw-bold">Skema Error Handling & Fallback</h2>
                    <p class="schema-lead">
                        404 fallback sekarang, handling exception, dan halaman error custom.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Tujuan Error Handling</h4>
                            <ul class="schema-list">
                                <li>Menjaga aplikasi tetap memberikan response yang aman, jelas, dan bisa ditindaklanjuti.</li>
                                <li>Memisahkan error yang diketahui (expected) vs error sistem (unexpected).</li>
                                <li>Memastikan user experience tetap baik meskipun terjadi kegagalan.</li>
                                <li>Menyediakan jejak observability untuk investigasi cepat (log, context, request id).</li>
                            </ul>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">stability</span>
                                <span class="schema-chip">security</span>
                                <span class="schema-chip">traceability</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Fallback Saat Ini di Proyek</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Route fallback mengarah ke halaman <code>pages.pages.authentication.general.error-404</code>.</div>
                                <div class="schema-step">Fallback berada di luar middleware auth, sehingga tetap bisa tampil untuk user belum login.</div>
                                <div class="schema-step">Semua URL yang tidak match route akan jatuh ke fallback ini.</div>
                                <div class="schema-step">Gunakan fallback untuk kasus route tidak ditemukan, bukan untuk menyembunyikan exception aplikasi.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Peta Error yang Harus Ditangani</h4>
                            <pre class="schema-code"><code>Layer Request:
- 404 Not Found          -> route/file tidak ditemukan
- 405 Method Not Allowed -> method HTTP tidak sesuai
- 419 Page Expired       -> CSRF/session timeout
- 429 Too Many Requests  -> throttling/rate limit

Layer Auth/Permission:
- 401 Unauthorized       -> belum autentikasi
- 403 Forbidden          -> tidak punya hak akses

Layer Validation & Domain:
- 422 Validation Error   -> input tidak valid
- 409 Conflict           -> konflik state data

Layer System:
- 500 Internal Error     -> bug/error tak terduga
- 503 Service Unavailable -> maintenance/dependency down</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Strategi Mapping Exception -> Response</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Exception validasi -> response 422 + pesan field-level.</div>
                                <div class="schema-step">Exception authorization -> 403 dengan pesan aman (tanpa detail sensitif).</div>
                                <div class="schema-step">Exception domain (misal stok tidak cukup) -> 409/422 sesuai konteks.</div>
                                <div class="schema-step">Exception sistem tak dikenal -> 500 generic + log lengkap.</div>
                            </div>
                            <div class="schema-note mt-4">Prinsip utama: user dapat pesan yang bisa ditindaklanjuti, tim mendapatkan log teknis yang cukup untuk investigasi.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Response Web vs API</h4>
                            <ul class="schema-list">
                                <li>Standar Response Web vs API</li>
                                <li><strong>API:</strong> kembalikan JSON terstruktur konsisten (<code>code</code>, <code>message</code>, <code>details</code>, <code>request_id</code>).</li>
                                <li><strong>Web:</strong> tampilkan halaman error custom (403/404/419/500) dengan CTA kembali ke halaman aman.</li>
                                <li><strong>API:</strong> kembalikan JSON terstruktur konsisten (<code>code</code>, <code>message</code>, <code>details</code>, <code>request_id</code>).</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Contoh Kontrak Error API (Rekomendasi)</h4>
                            <pre class="schema-code"><code>{
  "success": false,
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Input tidak valid",
    "details": {
      "email": ["Format email tidak valid"]
    }
  },
  "meta": {
    "request_id": "req_01HX...."
  }
}</code></pre>
                            <div class="schema-warn mt-4">Hindari mengubah format error response antar endpoint secara acak. Konsistensi kontrak penting untuk frontend/mobile client.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Logging & Context Minimum</h4>
                            <ul class="schema-list">
                                <li>Logging & Context Minimum</li>
                                <li><code>user_id</code> (jika ada), tenant/account id (jika multi-tenant).</li>
                                <li><code>request_id</code>, URL, method, status code.</li>
                                <li><code>user_id</code> (jika ada), tenant/account id (jika multi-tenant).</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Redaksi Pesan ke User</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Redaksi Pesan ke User</div>
                                <div class="schema-step">Berikan langkah lanjut: retry, refresh, login ulang, atau hubungi support.</div>
                                <div class="schema-step">Gunakan nada konsisten antar halaman error.</div>
                                <div class="schema-step">Jika perlu, tampilkan <code>request_id</code> agar support mudah menelusuri log.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Template Halaman Error Custom</h4>
                            <pre class="schema-code"><code>resources/views/pages/errors/
├─ 403.blade.php
├─ 404.blade.php
├─ 419.blade.php
├─ 429.blade.php
├─ 500.blade.php
└─ 503.blade.php

Isi minimum:
- Kode dan judul error
- Penjelasan singkat yang aman
- Tombol aksi: kembali / dashboard / login
- (opsional) request id</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Security Guardrails</h4>
                            <ul class="schema-list">
                                <li>Security Guardrails</li>
                                <li>Masking data sensitif di log (token, secret, password, nomor kartu).</li>
                                <li>Pastikan <code>APP_DEBUG=false</code> di production.</li>
                                <li>Masking data sensitif di log (token, secret, password, nomor kartu).</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Retry & Idempotency</h4>
                            <ul class="schema-list">
                                <li>Retry & Idempotency</li>
                                <li>Operasi kritis (pembayaran/order) butuh idempotency key untuk hindari duplikasi.</li>
                                <li>Operasi non-kritis bisa diarahkan retry dengan backoff.</li>
                                <li>Operasi kritis (pembayaran/order) butuh idempotency key untuk hindari duplikasi.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>SOP Incident Error (Ringkas)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">SOP Incident Error (Ringkas)</div>
                                <div class="schema-step">2. Triage: identifikasi route/service paling terdampak dan severity bisnis.</div>
                                <div class="schema-step">3. Mitigasi cepat: rollback, feature flag off, atau degrade mode.</div>
                                <div class="schema-step">4. Perbaikan permanen: root-cause fix + test regression.</div>
                                <div class="schema-step">5. Postmortem: dokumentasi timeline, dampak, action item, owner, dan due date.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Checklist Review Error Handling (Pra-Release)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Checklist Review Error Handling (Pra-Release)</div>
                                <div class="schema-step">2. Fallback route berfungsi dan tidak menelan exception aplikasi yang harus diperbaiki.</div>
                                <div class="schema-step">3. Semua endpoint API mengembalikan format error JSON konsisten.</div>
                                <div class="schema-step">4. Log error memuat context minimum tanpa membocorkan data sensitif.</div>
                                <div class="schema-step">5. APP_DEBUG production dipastikan nonaktif.</div>
                                <div class="schema-step">6. Skenario timeout/dependency down diuji minimal sekali sebelum release.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) Error Handling</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Standar Tim (Strict) Error Handling</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> response 5xx ke client harus generic; detail teknis hanya di log internal.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> setiap error log harus memiliki <code>request_id</code>, route, method, status code, dan user context (jika ada).</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> tidak boleh ada data sensitif di log (password, token, secret, PII kritikal).</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> mapping exception bisnis harus eksplisit (misal conflict -> 409, validation -> 422).</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> fallback tidak boleh dipakai untuk menutupi bug 500.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> setiap incident Sev-1/Sev-2 wajib postmortem maksimal 2x24 jam.</div>
                                <div class="schema-step"><strong>Rule opsional:</strong> endpoint kritikal menambahkan idempotency key dan retry policy terukur.</div>
                            </div>
                            <div class="schema-meta mt-4">
                                <span class="schema-chip">single error contract</span>
                                <span class="schema-chip">no sensitive logs</span>
                                <span class="schema-chip">mandatory postmortem</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Severity Matrix Operasional</h4>
                            <pre class="schema-code"><code>Sev-1 (Critical)
- Dampak: sistem inti down / transaksi gagal masif / risiko finansial tinggi
- SLA respon awal: <= 15 menit
- Target mitigasi: <= 1 jam
- Wajib: war room + incident commander + postmortem

Sev-2 (High)
- Dampak: fitur utama terganggu signifikan, ada workaround terbatas
- SLA respon awal: <= 30 menit
- Target mitigasi: <= 4 jam
- Wajib: koordinasi lintas tim + postmortem

Sev-3 (Medium)
- Dampak: sebagian fitur non-kritis terganggu, workaround tersedia
- SLA respon awal: <= 4 jam
- Target mitigasi: <= 2 hari kerja
- Wajib: RCA ringkas + action item

Sev-4 (Low)
- Dampak: minor bug/cosmetic/noise logging
- SLA respon awal: <= 1 hari kerja
- Target mitigasi: sesuai sprint backlog
- Wajib: triage dan prioritisasi</code></pre>
                            <div class="schema-note mt-4">Severity ditentukan oleh dampak bisnis dan luas pengguna terdampak, bukan hanya jenis exception.</div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Format Postmortem Baku (Template)</h4>
                            <pre class="schema-code"><code># Postmortem Incident

1) Ringkasan
- Incident ID:
- Severity:
- Waktu mulai / selesai:
- Durasi:
- Status:

2) Dampak
- Layanan/fitur terdampak:
- Persentase user terdampak:
- Dampak bisnis (transaksi, SLA, reputasi):

3) Timeline
- HH:MM Deteksi awal
- HH:MM Triage
- HH:MM Mitigasi sementara
- HH:MM Perbaikan permanen
- HH:MM Monitoring pasca-fix

4) Root Cause Analysis
- Technical root cause:
- Contributing factors:
- Kenapa lolos dari test/review:

5) Tindakan
- Immediate fix:
- Permanent fix:
- Preventive actions:

6) Action Items
- [Owner] [Task] [Due date] [Status]

7) Lampiran
- Link log/APM/dashboard
- PR/commit terkait
- Screenshot/error payload sample (aman)</code></pre>
                            <div class="schema-warn mt-4">Postmortem fokus pada perbaikan sistem, bukan menyalahkan individu.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection