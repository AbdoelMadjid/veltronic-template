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
                    <span class="schema-pill">Blade Architecture</span>
                    <h2 class="fw-bold">Skema Komponen Blade & Partial</h2>
                    <p class="schema-lead">
                        Konvensi include/extend/component, serta panduan kapan menggunakan partial vs component.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Pola Utama Blade</h4>
                            <ul class="schema-list">
                                <li><code>@@extends</code> untuk pewarisan layout utama.</li>
                                <li><code>@@include</code> untuk potongan markup statis/sederhana.</li>
                                <li><code>@@component</code> untuk unit UI yang punya slot/parameter.</li>
                                <li><code>&lt;x-...&gt;</code> untuk reusable component berbasis class/anonymous.</li>
                            </ul>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">inheritance</span>
                                <span class="schema-chip">reuse</span>
                                <span class="schema-chip">maintainable views</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Decision Matrix: Partial vs Component</h4>
                            <div class="schema-flow">
                                <div class="schema-step">Pakai <code>partial</code> jika tampilannya sederhana, context sudah tersedia dari parent, dan tidak perlu kontrak API.</div>
                                <div class="schema-step">Pakai <code>component</code> jika butuh <code>props</code>, <code>slot</code>, validasi input, dan dipakai lintas domain halaman.</div>
                                <div class="schema-step">Jika mulai banyak parameter optional di partial, refactor jadi component.</div>
                                <div class="schema-step">Jika component hanya dipakai sekali dan tanpa variasi, pertimbangkan turunkan jadi partial.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Skema Folder yang Direkomendasikan</h4>
                            <pre class="schema-code"><code>resources/views/
├─ layouts/
│  ├─ index.blade.php
│  └─ partials/
│     ├─ _toolbar.blade.php
│     ├─ header/
│     └─ sidebar/
├─ partials/
│  ├─ menus/
│  ├─ modals/
│  └─ widgets/
├─ components/
│  ├─ ui/
│  └─ forms/
└─ pages/
   └─ ...</code></pre>
                            <div class="schema-note mt-4">Bedakan <code>layouts/partials</code> (fragmen layout global) dengan <code>components</code> (unit reusable berkontrak API/props).</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Contoh: Partial Sederhana</h4>
                            <pre class="schema-code"><code>// parent view
@@include('layouts.partials._toolbar', [
  'li_1' => 'Help',
  'li_2' => 'Skema Komponen Blade & Partial'
])</code></pre>
                            <ul class="schema-list mt-4">
                                <li>Cocok untuk blok statis berulang (toolbar, breadcrumb kecil, hint text).</li>
                                <li>Jangan menaruh business logic berat di partial.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Contoh: Component Reusable</h4>
                            <pre class="schema-code"><code>// resources/views/components/ui/info-card.blade.php
@@props(['title', 'icon' => 'ki-abstract-26'])

&lt;div class="card card-flush"&gt;
  &lt;div class="card-body"&gt;
    &lt;i class="ki-duotone @{{ $icon }} fs-2hx"&gt;&lt;/i&gt;
    &lt;h3&gt;@{{ $title }}&lt;/h3&gt;
    @{{ $slot }}
  &lt;/div&gt;
&lt;/div&gt;

// usage
&lt;x-ui.info-card title="Skema Route" icon="ki-route"&gt;
  Alur dari URL ke Blade view.
&lt;/x-ui.info-card&gt;</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Konvensi Naming</h4>
                            <ul class="schema-list">
                                <li>Partial: awali underscore untuk internal-only, misal <code>_toolbar.blade.php</code>.</li>
                                <li>Component: nama domain + fungsi, misal <code>ui/info-card.blade.php</code>.</li>
                                <li>Nama props gunakan bahasa domain (<code>title</code>, <code>badge</code>, <code>isActive</code>), hindari nama generik ambigu.</li>
                                <li>Jika ada translasi, kirim text final dari caller atau kirim key secara konsisten.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Anti-Pattern yang Perlu Dihindari</h4>
                            <ul class="schema-list">
                                <li>Component “god object” dengan terlalu banyak props optional.</li>
                                <li>Partial yang mengakses data query langsung.</li>
                                <li>Markup duplikat lintas halaman karena enggan ekstraksi.</li>
                                <li>Pencampuran concern: style/script spesifik halaman dimasukkan ke partial global.</li>
                            </ul>
                            <div class="schema-warn mt-4">Jika satu partial dipakai >3 lokasi dengan variasi berbeda, itu sinyal kuat untuk migrasi ke component.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Checklist Saat Menambah UI Baru</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Cek dulu apakah sudah ada partial/component serupa yang bisa dipakai ulang.</div>
                                <div class="schema-step">2. Tentukan tipe: partial atau component berdasarkan decision matrix.</div>
                                <div class="schema-step">3. Definisikan kontrak input jelas (props/slot/default value).</div>
                                <div class="schema-step">4. Pastikan kompatibel mobile dan sesuai utility class Metronic.</div>
                                <div class="schema-step">5. Review duplikasi markup dan konsistensi translasi sebelum merge.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict)</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> component reusable harus punya kontrak <code>@@props</code> yang jelas, default value aman, dan nama props berbasis domain.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> maksimal <code>7 props</code> per component. Jika lebih, pecah jadi sub-component atau gunakan data object terstruktur.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> maksimal <code>2 named slots</code> + default slot. Lebih dari itu biasanya menandakan component terlalu kompleks.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> partial tidak boleh melakukan query data atau logic bisnis.</div>
                                <div class="schema-step"><strong>Rule opsional:</strong> gunakan class-based component jika butuh normalisasi data/formatting sebelum render.</div>
                                <div class="schema-step"><strong>Rule opsional:</strong> tambahkan docblock singkat di atas component untuk menjelaskan props penting dan contoh penggunaan.</div>
                            </div>
                            <div class="schema-meta mt-4">
                                <span class="schema-chip">max 7 props</span>
                                <span class="schema-chip">max 2 named slots</span>
                                <span class="schema-chip">no query in partial</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Boilerplate Component Standar</h4>
                            <pre class="schema-code"><code>// resources/views/components/ui/stat-card.blade.php
@@props([
  'title',
  'value',
  'icon' => 'ki-chart-simple',
  'color' => 'primary',
  'subtitle' => null,
  'badge' => null,
  'href' => null,
])

@@php
  $allowedColors = ['primary', 'success', 'warning', 'danger', 'info', 'dark', 'secondary'];
  $color = in_array($color, $allowedColors, true) ? $color : 'primary';
@@endphp

&lt;div class="card card-flush h-100"&gt;
  &lt;div class="card-body"&gt;
    &lt;div class="d-flex align-items-center mb-3"&gt;
      &lt;i class="ki-duotone @{{ $icon }} fs-2hx text-@{{ $color }} me-3"&gt;&lt;/i&gt;
      &lt;div&gt;
        &lt;h3 class="mb-0"&gt;@{{ $title }}&lt;/h3&gt;
        @@if($subtitle)&lt;div class="text-gray-600 fs-7"&gt;@{{ $subtitle }}&lt;/div&gt;@@endif
      &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="fs-2 fw-bold"&gt;@{{ $value }}&lt;/div&gt;
    @@if($badge)&lt;span class="badge badge-light-@{{ $color }} mt-2"&gt;@{{ $badge }}&lt;/span&gt;@@endif
    @{{ $slot }}
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Boilerplate Usage</h4>
                            <pre class="schema-code"><code>&lt;x-ui.stat-card
  title="Total Orders"
  value="1,248"
  icon="ki-delivery-3"
  color="success"
  subtitle="30 hari terakhir"
  badge="+12%"
&gt;
  &lt;a href="@{{ route('apps.ecommerce.sales.listing') }}" class="btn btn-sm btn-light-success mt-4"&gt;
    Lihat Detail
  &lt;/a&gt;
&lt;/x-ui.stat-card&gt;</code></pre>
                            <div class="schema-note mt-4">Jika kebutuhan tampilan berbeda jauh, buat varian component baru. Hindari menambah props berlebihan hanya untuk menjaga satu component tetap dipakai semua kasus.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection