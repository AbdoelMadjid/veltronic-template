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
                <!--begin::Hero-->
                <div class="schema-hero">
                    <span class="schema-pill">Icon Architecture</span>
                    <h2 class="fw-bold">Skema Pergantian Icon (Dynamic KeenIcons Switcher)</h2>
                    <p class="schema-lead">
                        Blueprint arsitektur dinamisasi gaya icon KeenIcons yang memungkinkan peralihan instan antara gaya <strong>Duotone</strong> (default), <strong>Solid</strong>, dan <strong>Outline</strong> di seluruh aplikasi secara runtime dengan persistensi state dan proteksi flicker.
                    </p>
                </div>
                <!--end::Hero-->

                <!--begin::Grid-->
                <div class="schema-grid">
                    <!--begin::Col 1: Tiga Varian Gaya KeenIcons-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>1. Tiga Varian Gaya KeenIcons</h4>
                            <p class="text-gray-700 fs-7">
                                Mengacu pada katalog icon di route <code>/docs/icons/keenicons</code>, font icon KeenIcons menyediakan 3 style render:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Duotone Style (Default):</strong>
                                    <p class="fs-8 text-muted mb-2">Menggunakan font multi-layer dengan elemen path terpisah untuk memberikan efek visual 2-tone.</p>
                                    <pre class="schema-code"><code>&lt;i class="ki-duotone ki-chart"&gt;
    &lt;span class="path1"&gt;&lt;/span&gt;
    &lt;span class="path2"&gt;&lt;/span&gt;
&lt;/i&gt;</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Solid Style:</strong>
                                    <p class="fs-8 text-muted mb-2">Single glyph font berkarakter padat (bold/filled) untuk penekanan tegas.</p>
                                    <pre class="schema-code"><code>&lt;i class="ki-solid ki-chart"&gt;&lt;/i&gt;</code></pre>
                                </div>
                                <div class="schema-step">
                                    <strong>Outline Style:</strong>
                                    <p class="fs-8 text-muted mb-2">Single glyph font berbasis garis tipis (line/stroke) yang bersih dan minimalis.</p>
                                    <pre class="schema-code"><code>&lt;i class="ki-outline ki-chart"&gt;&lt;/i&gt;</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 1-->

                    <!--begin::Col 2: Struktur Komponen & Partials-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>2. Struktur Komponen & Modul</h4>
                            <p class="text-gray-700 fs-7">
                                Fitur ini tersusun atas komponen Blade modular, stylesheet khusus, dan engine JS berbasis DOM observer:
                            </p>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>Topbar Toggle (<code>partials.icon-style._main</code>):</strong>
                                    Komponen dropdown di navbar topbar dengan indikator visual icon aktif dan daftar pilihan 3 gaya.
                                </div>
                                <div class="schema-step">
                                    <strong>Anti-Flicker Init (<code>partials.icon-style._init</code>):</strong>
                                    Script ringan di bagian awal layout untuk membaca <code>localStorage</code> dan menyematkan atribut <code>data-kt-icon-style</code> pada <code>&lt;html&gt;</code> sebelum render selesai.
                                </div>
                                <div class="schema-step">
                                    <strong>Engine JS (<code>public/assets/js/custom/icon-style.js</code>):</strong>
                                    Modul <code>KTIconStyle</code> untuk manipulasi class icon, update menu, penyimpanan preferensi, dan event triggering.
                                </div>
                                <div class="schema-step">
                                    <strong>Custom CSS (<code>public/assets/css/custom-icon-style.css</code>):</strong>
                                    Aturan penyesuaian preview indicator dan penanganan child path saat mode solid/outline aktif.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 2-->

                    <!--begin::Col 3: Alur Siklus Hidup (Lifecycle Flow)-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>3. Alur Siklus Hidup (Lifecycle Flow)</h4>
                            <div class="schema-flow">
                                <div class="schema-step">
                                    <strong>1. Load Awal:</strong> <code>_init.blade.php</code> membaca <code>localStorage['data-kt-icon-style']</code> (fallback ke <code>'duotone'</code>), lalu menetapkan <code>document.documentElement.setAttribute('data-kt-icon-style', style)</code>.
                                </div>
                                <div class="schema-step">
                                    <strong>2. Inisialisasi DOM:</strong> <code>KTIconStyle.init()</code> menyinkronkan state menu dropdown dan mengubah seluruh icon di halaman sesuai gaya aktif.
                                </div>
                                <div class="schema-step">
                                    <strong>3. User Mengubah Gaya:</strong> Saat user memilih style dari dropdown, <code>KTIconStyle.setStyle(style)</code> dijalankan:
                                    <ul class="fs-8 text-gray-700 mt-1 mb-0 ps-3">
                                        <li>Memperbarui atribut <code>data-kt-icon-style</code> di <code>&lt;html&gt;</code>.</li>
                                        <li>Menyimpan preferensi ke <code>localStorage</code> dan Cookie <code>kt_icon_style</code>.</li>
                                        <li>Memperbarui class aktif pada dropdown menu & toggle indicator.</li>
                                        <li>Mengonversi seluruh class <code>ki-duotone</code>, <code>ki-solid</code>, dan <code>ki-outline</code> di halaman secara instan.</li>
                                        <li>Memicu event <code>kt.iconstyle.change</code>.</li>
                                    </ul>
                                </div>
                                <div class="schema-step">
                                    <strong>4. Observasi Dinamis (MutationObserver):</strong> Elemen baru yang dimasukkan ke DOM (seperti modal, AJAX response, tab) secara otomatis dikonversi ke gaya aktif tanpa reload.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 3-->

                    <!--begin::Col 4: API & JavaScript Reference-->
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>4. API JavaScript (<code>KTIconStyle</code>)</h4>
                            <p class="text-gray-700 fs-7">
                                Modul <code>KTIconStyle</code> dapat diakses secara global untuk kontrol terprogram:
                            </p>
                            <pre class="schema-code"><code>// Mengambil gaya icon yang aktif saat ini ('duotone' | 'solid' | 'outline')
var currentStyle = KTIconStyle.getStyle();

// Mengubah gaya icon secara programatik
KTIconStyle.setStyle('solid'); // 'duotone', 'solid', atau 'outline'

// Menerapkan gaya icon pada container tertentu (misal setelah load ajax)
KTIconStyle.apply(document.querySelector('#my_container'), 'outline');

// Mendengarkan event perubahan icon style
document.documentElement.addEventListener('kt.iconstyle.change', function (e) {
    console.log('Icon style changed to:', e.detail.style);
});</code></pre>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">Global Module</span>
                                <span class="schema-chip">Event Driven</span>
                                <span class="schema-chip">MutationObserver Protected</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Col 4-->

                    <!--begin::Col 5: Developer Guide & Best Practices-->
                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>5. Panduan Developer & Standar Penggunaan</h4>
                            <div class="schema-grid">
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light">
                                        <h5 class="fs-6 fw-bold mb-2">Penulisan Icon Standar di Blade</h5>
                                        <p class="fs-8 text-gray-700 mb-2">
                                            Selalu gunakan format default <strong>Duotone</strong> dengan tag path lengkap saat membuat komponen atau halaman baru:
                                        </p>
                                        <pre class="schema-code"><code>&lt;i class="ki-duotone ki-chart fs-2 text-primary"&gt;
    &lt;span class="path1"&gt;&lt;/span&gt;
    &lt;span class="path2"&gt;&lt;/span&gt;
&lt;/i&gt;</code></pre>
                                        <p class="fs-8 text-muted mb-0">Engine dinamis akan otomatis mengonversinya menjadi Solid/Outline jika user memilih mode tersebut.</p>
                                    </div>
                                </div>
                                <div class="schema-col-6">
                                    <div class="p-4 rounded border bg-light">
                                        <h5 class="fs-6 fw-bold mb-2">Mengecualikan Icon dari Konversi</h5>
                                        <p class="fs-8 text-gray-700 mb-2">
                                            Jika ada icon khusus yang harus tetap pada gaya tertentu (misal ikon preview di halaman dokumentasi), tambahkan atribut <code>data-kt-icon-style-ignore="true"</code>:
                                        </p>
                                        <pre class="schema-code"><code>&lt;i class="ki-solid ki-heart text-danger" 
   data-kt-icon-style-ignore="true"&gt;&lt;/i&gt;</code></pre>
                                        <p class="fs-8 text-muted mb-0">Icon dengan atribut ini tidak akan diubah saat user mengganti gaya icon global.</p>
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
