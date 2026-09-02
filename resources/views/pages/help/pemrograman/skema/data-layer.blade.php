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
                    <span class="schema-pill">Data Layer</span>
                    <h2 class="fw-bold">Skema Data Layer</h2>
                    <p class="schema-lead">
                        Struktur model, relasi, migration, seeder, dan pattern query yang dipakai proyek.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Komponen Inti</h4>
                            <ul class="schema-list">
                                <li><code>app/Models/*</code> untuk entity dan relasi Eloquent.</li>
                                <li><code>database/migrations/*</code> untuk versi skema tabel.</li>
                                <li><code>database/seeders/*</code> dan <code>database/factories/*</code> untuk data awal/testing.</li>
                                <li><code>app/Providers/AppServiceProvider.php</code> untuk guard global (misal strict mode, lazy loading policy).</li>
                            </ul>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">domain model</span>
                                <span class="schema-chip">schema evolution</span>
                                <span class="schema-chip">query discipline</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Flow Data End-to-End</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Request masuk -> controller/use-case validasi input.</div>
                                <div class="schema-step">2. Query dieksekusi lewat model/scope/query object.</div>
                                <div class="schema-step">3. Loading relasi harus dikendalikan (selective eager loading).</div>
                                <div class="schema-step">4. Data dibentuk ke response/view resource.</div>
                                <div class="schema-step">5. Operasi tulis kritikal dibungkus transaction.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Struktur Model & Relasi yang Direkomendasikan</h4>
                            <pre class="schema-code"><code>app/Models/
├─ User.php
├─ Order.php
├─ OrderItem.php
├─ Product.php
└─ ...

Contoh relasi inti:
- User hasMany Order
- Order belongsTo User
- Order hasMany OrderItem
- OrderItem belongsTo Order
- OrderItem belongsTo Product</code></pre>
                            <ul class="schema-list mt-4">
                                <li>Gunakan nama relasi eksplisit dan konsisten dengan domain bisnis.</li>
                                <li>Simpan logic query reusable di local scope (misal <code>scopeActive()</code>, <code>scopeForTenant()</code>) agar tetap testable.</li>
                                <li>Hindari menaruh logic presentasi di model.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Migration</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Migration harus idempotent dan mudah ditelusuri (satu perubahan skema per migration).</div>
                                <div class="schema-step">Tambahkan index saat menambah kolom yang dipakai filter/sort/join.</div>
                                <div class="schema-step">Gunakan foreign key untuk menjaga integritas data, termasuk aturan on update/delete yang tepat.</div>
                                <div class="schema-step">Pisahkan perubahan berisiko tinggi (rename/drop kolom besar) ke migration terpisah dan window rilis khusus.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Contoh Migration Ringkas</h4>
                            <pre class="schema-code"><code>Schema::create('orders', function (Blueprint $table) {
  $table->id();
  $table->foreignId('user_id')->constrained()->cascadeOnDelete();
  $table->string('code')->unique();
  $table->decimal('total', 14, 2)->default(0);
  $table->timestamp('paid_at')->nullable();
  $table->timestamps();

  $table->index(['user_id', 'paid_at']);
});</code></pre>
                            <div class="schema-note mt-4">Kombinasi index harus mengikuti query real, bukan sekadar menambah index sebanyak mungkin.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Seeder & Factory Strategy</h4>
                            <ul class="schema-list">
                                <li>Gunakan factory untuk membangun graph data relasi secara konsisten.</li>
                                <li>Seeder & Factory Strategy</li>
                                <li>Pisahkan seeder demo/testing agar tidak tercampur dengan seed production.</li>
                                <li>Gunakan factory untuk membangun graph data relasi secara konsisten.</li>
                            </ul>
                            <pre class="schema-code mt-4"><code>// contoh pola
User::factory()
  ->count(20)
  ->has(Order::factory()->count(3))
  ->create();</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Pattern Query yang Disarankan</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Pakai <code>select()</code> kolom minimal untuk endpoint list.</div>
                                <div class="schema-step">Pakai <code>with()</code> atau <code>withCount()</code> untuk mencegah N+1 pada endpoint list/detail.</div>
                                <div class="schema-step">Pakai pagination untuk dataset besar; hindari memuat semua data ke memori.</div>
                                <div class="schema-step">Ekstrak filter dinamis ke scope/query object agar controller tetap ringkas dan mudah diuji.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Contoh Query Aman (List + Filter + Relasi)</h4>
                            <pre class="schema-code"><code>$orders = Order::query()
  ->select(['id', 'user_id', 'code', 'total', 'paid_at', 'created_at'])
  ->with(['user:id,name,email'])
  ->when($request->filled('status'), function ($q) use ($request) {
      $q->where('status', $request->string('status'));
  })
  ->when($request->filled('q'), function ($q) use ($request) {
      $search = '%' . $request->string('q') . '%';
      $q->where('code', 'like', $search);
  })
  ->latest('id')
  ->paginate(20);</code></pre>
                            <div class="schema-warn mt-4">Hindari pola query dalam loop (<code>N+1</code>). Jika menemukan query tambahan per item, evaluasi eager loading.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Transaksi & Konsistensi Data</h4>
                            <ul class="schema-list">
                                <li>Bungkus proses tulis multi-tabel dengan <code>DB::transaction()</code>.</li>
                                <li>Jika ada side effect eksternal (email, webhook), trigger setelah transaction sukses.</li>
                                <li>Gunakan locking seperlunya pada proses race-condition (stok, saldo, nomor dokumen).</li>
                                <li>Transaksi & Konsistensi Data</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Observability & Debugging</h4>
                            <ul class="schema-list">
                                <li>Catat query lambat dan endpoint yang memicu.</li>
                                <li>Tambahkan logging kontekstual (user id, tenant id, request id) saat exception data layer.</li>
                                <li>Audit migration/seeder pada release checklist.</li>
                                <li>Observability & Debugging</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Checklist Review Data Layer (Pra-Merge)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Model dan relasi sudah mencerminkan domain, bukan sekadar tabel.</div>
                                <div class="schema-step">2. Migration punya index dan foreign key yang relevan.</div>
                                <div class="schema-step">3. Query list wajib select kolom minimal + pagination + eager loading yang relevan.</div>
                                <div class="schema-step">4. Operasi tulis multi-entity menggunakan transaction.</div>
                                <div class="schema-step">5. Seeder/factory cukup untuk local dev dan test case utama.</div>
                                <div class="schema-step">6. Tidak ada N+1 dan tidak ada query berat tanpa batasan.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>6. Tidak ada N+1 dan tidak ada query berat tanpa batasan.</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> kolom yang dipakai untuk filter, sort, join, dan foreign key harus memiliki index yang sesuai.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> endpoint list harus pakai pagination; unbounded fetch dilarang.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> maksimal <code>3 eager relations</code> per query default (kecuali ada justifikasi di PR).</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> maksimal <code>2 level nested eager loading</code> agar kompleksitas query terkendali.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> operasi tulis multi-tabel atau kritikal konsistensi harus di dalam <code>DB::transaction()</code>.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> side effect eksternal (email, webhook, dispatch queue) dieksekusi setelah commit transaction.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> query di dalam loop dilarang kecuali ada batasan terukur dan terdokumentasi.</div>
                                <div class="schema-step"><strong>Rule opsional:</strong> gunakan query cache hanya untuk data read-heavy yang stabil dengan strategi invalidasi jelas.</div>
                            </div>
                            <div class="schema-meta mt-4">
                                <span class="schema-chip">max 3 eager relations</span>
                                <span class="schema-chip">max nested depth 2</span>
                                <span class="schema-chip">mandatory transaction</span>
                                <span class="schema-chip">no query in loop</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Use-Case Wajib Transaction</h4>
                            <ul class="schema-list">
                                <li>Create order + order items + update stock.</li>
                                <li>Pembayaran: update invoice, ledger, dan status order sekaligus.</li>
                                <li>Proses approval berjenjang yang mengubah beberapa tabel status.</li>
                                <li>Import batch yang menulis parent-child records.</li>
                            </ul>
                            <div class="schema-warn mt-4">Jika satu use-case menghasilkan lebih dari satu perubahan tabel penting, default-nya harus memakai transaction.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Template Transaksi Standar</h4>
                            <pre class="schema-code"><code>DB::transaction(function () use ($payload) {
  $order = Order::create([...]);

  foreach ($payload['items'] as $item) {
    $order->items()->create([...]);
    Product::whereKey($item['product_id'])
      ->decrement('stock', $item['qty']);
  }

  $order->refresh();
});

// trigger event/job setelah commit bila perlu</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Gate Review PR (Strict)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Jelaskan impact query dan index baru pada deskripsi PR.</div>
                                <div class="schema-step">2. Sertakan bukti tidak ada N+1 pada endpoint yang diubah.</div>
                                <div class="schema-step">3. Jika melewati batas eager relations/depth, wajib ada justifikasi teknis yang jelas di PR.</div>
                                <div class="schema-step">4. Untuk proses finansial/stok, jelaskan batas transaction dan strategi concurrency secara eksplisit.</div>
                                <div class="schema-step">5. Pastikan migration rollback aman sebelum merge.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
