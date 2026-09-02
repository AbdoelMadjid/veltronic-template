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
                    <span class="schema-pill">Menu Config</span>
                    <h2 class="fw-bold">Skema Struktur Config Menu</h2>
                    <p class="schema-lead">
                        Relasi <code>config/sidebar/*</code>, <code>config/header/*</code>, translasi <code>lang/*</code>, dan renderer Blade.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Alur Sumber Data Menu</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><code>config/sidebar/*</code> dan <code>config/header/*</code> menyimpan struktur menu deklaratif.</div>
                                <div class="schema-step">View renderer membaca config tersebut untuk membangun UI menu di sidebar/header.</div>
                                <div class="schema-step">Title menu dikonversi ke key translasi <code>menu.*</code>, fallback ke text asli jika key belum ada.</div>
                                <div class="schema-step">Route aktif dipakai untuk menentukan <code>active/here/show</code> pada parent-child secara recursive.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Peta File Inti</h4>
                            <ul class="schema-list">
                                <li><code>config/sidebar/_sidebar_*.php</code> untuk menu sidebar per domain.</li>
                                <li><code>config/header/_header_*.php</code> untuk menu/header mega menu.</li>
                                <li><code>resources/views/layouts/partials/sidebar/_menu.blade.php</code> sebagai entry renderer sidebar.</li>
                                <li><code>resources/views/layouts/partials/sidebar/_menu-item.blade.php</code> untuk recursive render parent/child.</li>
                                <li><code>lang/en/menu.php</code> dan <code>lang/id/menu.php</code> untuk label translasi.</li>
                                <li><code>app/Helpers/GetPageTitle.php</code> untuk mapping judul halaman dari config menu berdasarkan route aktif.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Kontrak Struktur Data Menu</h4>
                            <pre class="schema-code"><code>[
  'title' => 'Skema Route',        // wajib (sumber translasi key menu.*)
  'route' => 'help.pemrograman.skema.route', // opsional jika pakai href
  'href' => 'https://...',         // opsional external link
  'icon' => 'ki-duotone ki-route fs-2',      // umumnya level-1
  'paths' => 4,                    // jumlah span path icon duotone
  'children' => [...],             // opsional nested menu
  'dropdown' => true,              // opsional mode flyout
  'badge' => ['label' => 'Soon', 'class' => 'badge badge-info'],
  'target' => '_blank'             // opsional
]</code></pre>
                            <div class="schema-note mt-4">Minimal item leaf: <code>title + route</code> atau <code>title + href</code>. Parent node umumnya memakai <code>children</code>.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Alur Render Sidebar</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><code>_menu.blade.php</code> memanggil tiap grup config (dashboard, pages, apps, layouts, help).</div>
                                <div class="schema-step">Setiap item dikirim ke <code>_menu-item.blade.php</code>.</div>
                                <div class="schema-step">Jika ada <code>children</code>: render recursive, parent otomatis open saat ada child aktif.</div>
                                <div class="schema-step">Jika leaf: render link + badge + state aktif berdasarkan <code>request()->routeIs(...)</code>.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Alur Translasi Judul Menu</h4>
                            <pre class="schema-code"><code>$titleKey = 'menu.' . strtolower(
  str_replace([' ', '&amp;', '/'], ['_', 'and', '_'], $menu['title'])
);

// jika key ada -> pakai translasi
// jika key tidak ada -> fallback ke title asli</code></pre>
                            <ul class="schema-list mt-4">
                                <li>Contoh: <code>Skema Cache &amp; Deployment</code> -> <code>menu.skema_cache_and_deployment</code>.</li>
                                <li>Pastikan key yang sama tersedia di <code>lang/en/menu.php</code> dan <code>lang/id/menu.php</code>.</li>
                                <li>Jika title berubah, key translasi ikut berubah karena key diturunkan dari text title.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Aturan Active State</h4>
                            <ul class="schema-list">
                                <li>Leaf menu aktif jika <code>request()->routeIs($route . '*')</code> true.</li>
                                <li>Parent menu aktif/open jika minimal satu child aktif (recursive).</li>
                                <li>Mode dropdown tetap memakai evaluasi child route untuk active class.</li>
                                <li>Dashboard punya perlakuan khusus show more/show less dari config collapsed menu.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Checklist Validasi Perubahan</h4>
                            <div class="schema-flow">
                                <div class="schema-step">1. Tambahkan item di config sidebar/header dengan struktur konsisten.</div>
                                <div class="schema-step">2. Pastikan route name valid (<code>php artisan route:list</code>).</div>
                                <div class="schema-step">3. Tambahkan key translasi EN dan ID sesuai normalisasi title.</div>
                                <div class="schema-step">4. Cek active state parent-child di desktop dan mobile.</div>
                                <div class="schema-step">5. Verifikasi icon class dan <code>paths</code> agar icon muncul sempurna.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Troubleshooting Cepat</h4>
                            <ul class="schema-list">
                                <li><strong>Title tidak tertranslate:</strong> cek key <code>menu.*</code> hasil normalisasi title dan isi file lang.</li>
                                <li><strong>Menu tidak aktif:</strong> cek kecocokan route name dan wildcard <code>routeIs</code>.</li>
                                <li><strong>Icon kosong:</strong> cek class icon valid dan jumlah <code>paths</code> sesuai duotone icon.</li>
                                <li><strong>Perubahan config tidak terlihat:</strong> clear cache konfigurasi/view jika environment memakai cache.</li>
                            </ul>
                            <div class="schema-meta mt-3">
                                <span class="schema-chip">config consistency</span>
                                <span class="schema-chip">translation integrity</span>
                                <span class="schema-chip">active-state accuracy</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-12">
                        <div class="schema-card">
                            <h4>Contoh Real Before/After (_sidebar_helps.php)</h4>
                            <pre class="schema-code"><code>// BEFORE
[
  'title' => 'Skema Pemrograman',
  'icon'  => 'ki-duotone ki-book-open fs-2',
  'paths' => 2,
  'children' => [
    [
      'title' => 'Overview',
      'route' => 'help.pemrograman.skema.overview',
    ],
  ],
]</code></pre>

                            <pre class="schema-code mt-4"><code>// AFTER
[
  'title' => 'Skema Pemrograman',
  'icon'  => 'ki-duotone ki-book-open fs-2',
  'paths' => 2,
  'children' => [
    [
      'title' => 'Overview',
      'route' => 'help.pemrograman.skema.overview',
    ],
    [
      'title' => 'Skema Struktur Config Menu',
      'route' => 'help.pemrograman.skema.struktur-config-menu',
    ],
    [
      'title' => 'Skema Cache & Deployment',
      'route' => 'help.pemrograman.skema.cache-dan-deployment',
    ],
  ],
]</code></pre>

                            <div class="schema-flow mt-4">
                                <div class="schema-step">Tambahkan child baru di <code>children[]</code> dengan pasangan <code>title</code> dan <code>route</code>.</div>
                                <div class="schema-step">Pastikan route tersebut ada (di proyek ini route help dibentuk otomatis dari nama file blade di <code>resources/views/pages</code>).</div>
                                <div class="schema-step">Tambahkan key translasi title ke <code>lang/en/menu.php</code> dan <code>lang/id/menu.php</code> jika ingin label multi-bahasa.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection