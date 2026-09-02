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
                    <span class="schema-pill">Release Ops</span>
                    <h2 class="fw-bold">Skema Cache & Deployment</h2>
                    <p class="schema-lead">
                        <code>config:cache</code>, <code>route:cache</code>, <code>view:cache</code>, kapan clear cache, dan checklist release.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Tujuan Cache & Deployment</h4>
                            <ul class="schema-list">
                                <li>Meningkatkan performa startup framework dan response time.</li>
                                <li>Mengurangi risiko human error saat release.</li>
                                <li>Menjaga deployment konsisten, repeatable, dan mudah rollback.</li>
                                <li>Membedakan kapan perlu regenerate cache dan kapan perlu clear cache total.</li>
                            </ul>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">performance</span>
                                <span class="schema-chip">stability</span>
                                <span class="schema-chip">repeatable release</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Jenis Cache yang Relevan</h4>
                            <pre class="schema-code"><code>1) Config cache
- Command: php artisan config:cache
- Efek: gabungkan config jadi 1 cache file
- Wajib regen saat .env/config berubah

2) Route cache
- Command: php artisan route:cache
- Efek: percepat registrasi route
- Syarat: tidak ada route closure

3) View cache
- Command: php artisan view:cache
- Efek: precompile semua Blade
- Cocok untuk production

4) Event cache (opsional)
- Command: php artisan event:cache
- Efek: cache discovery listener event</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Strategi Command Cache (Kapan Dipakai)</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><code>php artisan config:cache</code>: jalankan setiap release setelah update konfigurasi/aplikasi.</div>
                                <div class="schema-step"><code>php artisan route:cache</code>: jalankan jika seluruh route kompatibel cache (tanpa closure).</div>
                                <div class="schema-step"><code>php artisan view:cache</code>: jalankan untuk mempercepat first-hit Blade.</div>
                                <div class="schema-step"><code>php artisan optimize:clear</code>: gunakan hanya saat troubleshooting cache stale atau sebelum regenerate penuh.</div>
                                <div class="schema-step">Urutan aman: clear seperlunya -> regenerate cache -> smoke test.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Runbook Deployment (Minim Risiko)</h4>
                            <pre class="schema-code"><code># 1) Persiapan release
git pull
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# 2) Migration (jika ada perubahan schema)
php artisan migrate --force

# 3) Regenerate cache produksi
php artisan config:cache
php artisan route:cache
php artisan view:cache
# opsional: php artisan event:cache

# 4) Restart worker/service yang relevan
php artisan queue:restart

# 5) Smoke test
php artisan route:list --name=help.pemrograman
# cek endpoint kritikal via browser/monitoring</code></pre>
                            <div class="schema-note mt-4">Jika memakai supervisor/horizon/queue worker, pastikan worker membaca code terbaru setelah deploy.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Kapan Harus Clear Cache</h4>
                            <ul class="schema-list">
                                <li>Perubahan config tidak terbaca meski file sudah update.</li>
                                <li>Route baru tidak muncul atau route lama masih dipakai.</li>
                                <li>Tampilan Blade lama masih tampil setelah deploy.</li>
                                <li>Issue anomali setelah rollback/forward deployment.</li>
                            </ul>
                            <pre class="schema-code mt-4"><code>php artisan optimize:clear
# lalu regenerate cache yang dibutuhkan</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Kapan Jangan Clear Semua</h4>
                            <ul class="schema-list">
                                <li>Saat sistem stabil dan tidak ada indikasi stale cache.</li>
                                <li>Saat incident aktif tanpa hipotesis jelas terkait cache.</li>
                                <li>Saat traffic puncak, kecuali mitigasi benar-benar memerlukan.</li>
                                <li>Gunakan pendekatan targeted dulu sebelum clear total.</li>
                            </ul>
                            <div class="schema-warn mt-4">Clear total secara impulsif bisa menambah load startup dan memperpanjang waktu recovery.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Checklist Pra-Release</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Pastikan branch release sudah freeze dan tervalidasi QA.</div>
                                <div class="schema-step">2. Verifikasi migration aman dan punya rollback plan.</div>
                                <div class="schema-step">3. Verifikasi route kompatibel untuk <code>route:cache</code>.</div>
                                <div class="schema-step">4. Siapkan maintenance message/feature flag jika perlu.</div>
                                <div class="schema-step">5. Tentukan PIC deploy, PIC verifikasi, dan PIC komunikasi.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Checklist Pasca-Release</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Smoke test login, dashboard, transaksi utama, dan halaman error.</div>
                                <div class="schema-step">2. Pantau metrik: error rate 4xx/5xx, latency, queue backlog.</div>
                                <div class="schema-step">3. Pantau log aplikasi 10-30 menit pertama.</div>
                                <div class="schema-step">4. Validasi worker/cron berjalan dengan code terbaru.</div>
                                <div class="schema-step">5. Kirim status release selesai ke stakeholder.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Rollback Plan (Wajib Ada)</h4>
                            <pre class="schema-code"><code>Trigger rollback jika:
- error rate naik signifikan dan tidak stabil dalam window observasi
- fitur kritikal gagal dan tidak ada mitigasi cepat
- data integrity berisiko

Langkah rollback:
1) Rollback code ke release terakhir yang stabil
2) Clear/regenerate cache sesuai versi rollback
3) Restart queue worker/service
4) Jalankan smoke test minimal
5) Komunikasikan status rollback + next action</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Troubleshooting Cepat Cache</h4>
                            <ul class="schema-list">
                                <li><strong>Config tidak berubah:</strong> cek <code>.env</code> dan jalankan <code>config:cache</code> ulang.</li>
                                <li><strong>Route error setelah cache:</strong> cari route closure, ubah ke controller action, lalu cache ulang.</li>
                                <li><strong>View lama masih tampil:</strong> jalankan <code>view:clear</code> lalu <code>view:cache</code>.</li>
                                <li><strong>Queue pakai code lama:</strong> jalankan <code>queue:restart</code> dan cek supervisor status.</li>
                            </ul>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">diagnose first</span>
                                <span class="schema-chip">targeted clear</span>
                                <span class="schema-chip">verify after change</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) Cache & Deployment</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> deployment production hanya melalui pipeline/skrip baku, bukan command manual acak.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> urutan command harus mengikuti runbook resmi tanpa skip step.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> migration membutuhkan approval gate minimal 2 pihak (PIC release + PIC data/tech lead).</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> setiap release harus punya rollback plan terdokumentasi sebelum eksekusi.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> release di luar time-window hanya boleh untuk emergency dengan approval incident commander.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> post-release smoke test dan observability check harus selesai sebelum status “done”.</div>
                                <div class="schema-step"><strong>Rule opsional:</strong> gunakan canary/blue-green untuk fitur berisiko tinggi.</div>
                            </div>
                            <div class="schema-meta mt-4">
                                <span class="schema-chip">pipeline only</span>
                                <span class="schema-chip">2-party approval</span>
                                <span class="schema-chip">time-window enforced</span>
                                <span class="schema-chip">rollback mandatory</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Urutan Command Baku (Production)</h4>
                            <pre class="schema-code"><code># A. Pre-check
git rev-parse --short HEAD
php artisan about

# B. Build & dependency
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# C. Schema change (jika ada)
php artisan migrate --force

# D. Cache regenerate
php artisan config:cache
php artisan route:cache
php artisan view:cache
# opsional: php artisan event:cache

# E. Runtime refresh
php artisan queue:restart

# F. Verification
php artisan route:list --name=help.pemrograman</code></pre>
                            <div class="schema-note mt-4">Jika salah satu step gagal, proses berhenti dan status release berubah menjadi failed untuk mencegah partial deploy.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Approval Gate Sebelum Migrate</h4>
                            <ul class="schema-list">
                                <li>Checklist migration impact (tabel besar, lock risk, durasi estimasi).</li>
                                <li>Konfirmasi backup/restore readiness.</li>
                                <li>Konfirmasi kompatibilitas aplikasi saat transisi skema.</li>
                                <li>PIC release dan PIC data menandatangani approval.</li>
                            </ul>
                            <div class="schema-warn mt-4">Tanpa approval gate, migration production tidak boleh dieksekusi.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Aturan Time-Window Deploy</h4>
                            <ul class="schema-list">
                                <li>Deploy reguler hanya pada jam operasi yang disepakati tim.</li>
                                <li>Hindari deploy saat puncak trafik bisnis.</li>
                                <li>Freeze window diberlakukan saat event bisnis kritikal.</li>
                                <li>Emergency deploy di luar window wajib status incident + approval IC.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Gate Release (Pass/Fail)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Gate 1 - Preflight: semua dependency/build lulus.</div>
                                <div class="schema-step">Gate 2 - Migration: approval lengkap dan migration sukses tanpa error.</div>
                                <div class="schema-step">Gate 3 - Cache: config/route/view cache regenerate sukses.</div>
                                <div class="schema-step">Gate 4 - Runtime: worker restart sukses dan health check hijau.</div>
                                <div class="schema-step">Gate 5 - Post-check: smoke test endpoint kritikal lolos.</div>
                                <div class="schema-step">Jika salah satu gate fail, lakukan rollback sesuai runbook.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection