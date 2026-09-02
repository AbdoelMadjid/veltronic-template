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
                <div class="schema-hero">
                    <span class="schema-pill">Incident Playbook</span>
                    <h2 class="fw-bold">Playbook Incident Response</h2>
                    <p class="schema-lead">
                        Panduan operasional siapa melakukan apa pada 15 menit pertama incident, agar respons konsisten dan cepat.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Peran Inti Saat Incident</h4>
                            <pre class="schema-code"><code>IC (Incident Commander):
- Memimpin keputusan, prioritas, dan status akhir severity.

Ops Lead (Backend/Infra):
- Eksekusi mitigasi teknis (rollback, feature flag, isolate traffic).

Comms Lead:
- Menyampaikan update ke stakeholder internal/eksternal.

Scribe:
- Mencatat timeline, keputusan, dan evidence insiden.

Support/QA:
- Validasi dampak user, verifikasi fix, dan update kanal support.</code></pre>
                            <div class="schema-note mt-4">Satu orang boleh memegang lebih dari satu peran pada tim kecil, tetapi IC sebaiknya tidak merangkap eksekutor utama.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Aturan Umum 0-15 Menit</h4>
                            <div class="schema-flow">
                                <div class="schema-step">0-3 menit: triage awal, tentukan severity sementara, bentuk channel war-room.</div>
                                <div class="schema-step">3-7 menit: kumpulkan evidence minimum (error rate, endpoint terdampak, rentang user).</div>
                                <div class="schema-step">7-12 menit: jalankan mitigasi tercepat yang aman (rollback/disable feature/degrade mode).</div>
                                <div class="schema-step">12-15 menit: kirim status update resmi pertama ke stakeholder.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Definition of Done (Menit 15)</h4>
                            <ul class="schema-list">
                                <li>Severity disepakati dan owner jelas.</li>
                                <li>Ada mitigasi awal atau rencana mitigasi terikat waktu.</li>
                                <li>Status update pertama sudah terkirim.</li>
                                <li>Timeline/log evidence mulai terdokumentasi.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Sev-1 (Critical) - Aksi 0-15 Menit</h4>
                            <pre class="schema-code"><code>0-5 menit
IC:
- Deklarasi Sev-1, lock prioritas, tunjuk IC/Ops/Comms/Scribe.
Ops Lead:
- Identifikasi blast radius dan komponen inti yang gagal.
Comms:
- Broadcast internal: "Sev-1 active, war-room link, next update 10 menit."
Scribe:
- Mulai timeline, catat timestamp deteksi dan owner.

5-10 menit
IC:
- Pilih strategi mitigasi tercepat (rollback vs disable feature).
Ops Lead:
- Eksekusi mitigasi cepat dengan risiko terkontrol.
Support/QA:
- Konfirmasi dampak nyata user (login/checkout/pembayaran).
Comms:
- Update stakeholder: dampak + aksi mitigasi berjalan.

10-15 menit
IC:
- Re-evaluasi severity setelah mitigasi awal.
Ops Lead:
- Verifikasi metrik utama membaik (5xx, latency, throughput).
Comms:
- Kirim update resmi #1 (status, impact, ETA update berikutnya).
Scribe:
- Catat keputusan dan outcome mitigasi pertama.</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Sev-2 (High) - Aksi 0-15 Menit</h4>
                            <pre class="schema-code"><code>0-5 menit
IC:
- Deklarasi Sev-2 dan tetapkan owner teknis.
Ops Lead:
- Isolasi fitur/endpoint bermasalah.
Comms:
- Info internal tim terkait, update cadence 15-30 menit.

5-10 menit
Ops Lead:
- Coba mitigasi ringan (restart worker, clear queue backlog, feature flag partial off).
Support/QA:
- Validasi apakah fitur utama masih bisa dipakai via workaround.
Scribe:
- Dokumentasi evidence + tindakan.

10-15 menit
IC:
- Putuskan lanjut mitigasi bertahap atau eskalasi jadi Sev-1.
Comms:
- Update stakeholder ringkas (impact, workaround, next ETA).</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Sev-3/Sev-4 - Aksi 0-15 Menit</h4>
                            <pre class="schema-code"><code>Sev-3 (Medium)
0-15 menit:
- Triage terstruktur, assign owner, buat ticket prioritas.
- Verifikasi ada workaround aman.
- Komunikasi internal secukupnya (tidak selalu war-room penuh).

Sev-4 (Low)
0-15 menit:
- Catat bug + bukti reproduksi.
- Tentukan prioritas sprint/backlog.
- Tidak perlu eskalasi luas kecuali ada indikasi memburuk.</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Trigger Eskalasi Otomatis</h4>
                            <ul class="schema-list">
                                <li>Persentase error 5xx melewati threshold kritis.</li>
                                <li>Fitur transaksi inti tidak bisa dipakai user.</li>
                                <li>Tidak ada mitigasi efektif dalam 15 menit pertama.</li>
                                <li>Ada dampak finansial/regulatori atau risiko data integrity.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Kanal Komunikasi Standar</h4>
                            <ul class="schema-list">
                                <li><strong>War-room:</strong> koordinasi teknis real-time.</li>
                                <li><strong>Incident channel:</strong> update periodik lintas tim.</li>
                                <li><strong>Status page/internal broadcast:</strong> info resmi ke user/stakeholder.</li>
                                <li><strong>Ticket incident:</strong> sumber kebenaran tunggal (owner, severity, timeline).</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Checklist Operasional Menit 0-15</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Tentukan severity sementara dalam 3 menit pertama.</div>
                                <div class="schema-step">2. Tetapkan 4 peran minimum: IC, Ops, Comms, Scribe.</div>
                                <div class="schema-step">3. Jalankan mitigasi tercepat yang reversible.</div>
                                <div class="schema-step">4. Kirim update #1 maksimal menit ke-15.</div>
                                <div class="schema-step">5. Simpan evidence untuk RCA/postmortem sejak awal.</div>
                            </div>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">first 15 minutes</span>
                                <span class="schema-chip">clear ownership</span>
                                <span class="schema-chip">fast mitigation</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection