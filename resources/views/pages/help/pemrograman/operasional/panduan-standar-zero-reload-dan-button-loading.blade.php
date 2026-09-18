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
        <div id="kt_app_content_container" class="app-container container-fluid" data-kt-lang-ignore="true">
            <div class="schema-shell">
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Coding Standard &amp; UX Policy</span>
                    <h2 class="fw-bold">Panduan Standar Zero-Reload CRUD &amp; Button Loading Spinner</h2>
                    <p class="schema-lead">
                        Pedoman baku arsitektur interaksi pengguna (UX) bagi seluruh pengembang: larangan keras refresh halaman saat CRUD, standarisasi indikator loading tombol anti-double-click, struktur banner header, serta pemisahan partials modular.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Zero-Reload CRUD Policy-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Kebijakan Zero-Reload Realtime CRUD (Rule #4)</h4>
                            <p class="text-gray-700 fs-7">
                                <strong>DILARANG</strong> me-reload halaman (<code>window.location.reload()</code> atau form submit bawaan) pada seluruh aksi CRUD, simpan identitas, ganti password, upload berkas/KTP, toggle fitur, dan setting:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>AJAX Execution:</strong> Seluruh form submit dan tombol toggle wajib dikirim via <code>fetch()</code> atau <code>$.ajax()</code> dengan CSRF token.
                                </div>
                                <div class="schema-step">
                                    <strong>SweetAlert2 Toast / Modal:</strong> Tampilkan umpan balik sukses/gagal secara elegan tanpa memutus flow kerja pengguna.
                                </div>
                                <div class="schema-step">
                                    <strong>DOM Mutation In-Place:</strong> Perbarui data di tabel, badge, atau kartu informasi secara realtime langsung pada elemen HTML aktif.
                                </div>
                                <div class="schema-step">
                                    <strong>Preservasi Posisi &amp; Tab:</strong> Tab yang sedang aktif harus <strong>tetap berada di tab yang sama</strong> tanpa mereset scroll layar.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Standar Button Loading Spinner-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Standar Indikator Spinner Tombol (Rule #5)</h4>
                            <p class="text-gray-700 fs-7">
                                Setiap tombol eksekusi formulir / modal <strong>WAJIB</strong> menampilkan animasi spinner dan dinonaktifkan sementara untuk mencegah klik ganda (<em>double-submit</em>):
                            </p>
                            <pre class="schema-code"><code>&lt;!-- Struktur HTML Tombol Standar --&gt;
&lt;button type="submit" class="btn btn-primary" id="btn_submit"&gt;
    &lt;span class="indicator-label"&gt;
        &lt;i class="ki-duotone ki-check fs-4 me-1"&gt;&lt;/i&gt; Simpan Perubahan
    &lt;/span&gt;
    &lt;span class="indicator-progress"&gt;
        Mohon tunggu... &lt;span class="spinner-border spinner-border-sm align-middle ms-2"&gt;&lt;/span&gt;
    &lt;/span&gt;
&lt;/button&gt;</code></pre>
                            <pre class="schema-code mt-2"><code>// JavaScript Handler:
submitBtn.setAttribute('data-kt-indicator', 'on');
submitBtn.disabled = true;

// Setelah AJAX selesai (success/error):
submitBtn.removeAttribute('data-kt-indicator');
submitBtn.disabled = false;</code></pre>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Standar Header Banner-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Standar Banner Header Modul (Rule #7)</h4>
                            <p class="text-gray-700 fs-7">
                                Setiap modul CRUD baru <strong>WAJIB</strong> menggunakan kartu Header Banner terpisah di atas konten:
                            </p>
                            <pre class="schema-code"><code>&lt;div class="card card-flush shadow-sm border-0 mb-6 bg-body"&gt;
    &lt;div class="card-body d-flex flex-stack flex-wrap gap-4 py-6"&gt;
        &lt;div class="d-flex align-items-center gap-3"&gt;
            &lt;div class="symbol symbol-50px symbol-2by3 bg-light-primary"&gt;
                &lt;i class="ki-duotone ki-user fs-2x text-primary"&gt;&lt;/i&gt;
            &lt;/div&gt;
            &lt;div&gt;
                &lt;h1 class="fs-2x fw-bold text-gray-900 mb-1"&gt;Judul Modul&lt;/h1&gt;
                &lt;p class="text-muted fs-7 mb-0"&gt;Deskripsi ringkas fungsi modul...&lt;/p&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;!-- Tombol Aksi Utama di Sisi Paling Kanan --&gt;
        &lt;button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add"&gt;
            &lt;i class="ki-duotone ki-plus fs-2"&gt;&lt;/i&gt; Tambah Data
        &lt;/button&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: Modular Partials & Petunjuk-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. Modular Blade Partials &amp; Petunjuk (Rule #6)</h4>
                            <p class="text-gray-700 fs-7">
                                Menjaga kebersihan dan skalabilitas kode dengan pemecahan komponen terstruktur:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Sub-Folder Partials:</strong> Seluruh modal formulir, modal detail, dan tab panel wajib diletakkan di <code>resources/views/pages/[kategori]/partials/[modul]/</code>.
                                </div>
                                <div class="schema-step">
                                    <strong>Main Blade sebagai Koordinator:</strong> File blade utama hanya bertindak sebagai koordinator layout dengan pemanggilan <code>@include</code>.
                                </div>
                                <div class="schema-step">
                                    <strong>Petunjuk Operasional Bawaan:</strong> Setiap modul baru wajib menyertakan partial petunjuk (<code>[modul]-petunjuk.blade.php</code>) yang dipicu dari toolbar <code>layouts.partials._action-petunjuk-button</code>.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Checklist Quality Gate-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Quality Gate Checklist Sebelum Pull Request / Merge</h4>
                            <div class="schema-grid">
                                <div class="schema-col-3">
                                    <div class="p-3 rounded border bg-light h-100">
                                        <div class="fw-bold fs-7 text-primary mb-1">1. Zero Reload</div>
                                        <p class="fs-8 text-gray-700 mb-0">Apakah seluruh tombol aksi dan form berjalan via AJAX tanpa full page reload?</p>
                                    </div>
                                </div>
                                <div class="schema-col-3">
                                    <div class="p-3 rounded border bg-light h-100">
                                        <div class="fw-bold fs-7 text-primary mb-1">2. Button Spinner</div>
                                        <p class="fs-8 text-gray-700 mb-0">Apakah spinner <code>data-kt-indicator</code> aktif dan disabled saat tombol submit diklik?</p>
                                    </div>
                                </div>
                                <div class="schema-col-3">
                                    <div class="p-3 rounded border bg-light h-100">
                                        <div class="fw-bold fs-7 text-primary mb-1">3. Dark Mode Tokens</div>
                                        <p class="fs-8 text-gray-700 mb-0">Apakah menggunakan class <code>bg-body</code> dan <code>text-gray-900</code> tanpa warna hardcoded?</p>
                                    </div>
                                </div>
                                <div class="schema-col-3">
                                    <div class="p-3 rounded border bg-light h-100">
                                        <div class="fw-bold fs-7 text-primary mb-1">4. Petunjuk Modul</div>
                                        <p class="fs-8 text-gray-700 mb-0">Apakah tombol bantuan petunjuk operasional di toolbar sudah terpasang dan dapat dibuka?</p>
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
