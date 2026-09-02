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
                    <span class="schema-pill">Sidebar Architecture</span>
                    <h2 class="fw-bold">Skema Sidebar Menu</h2>
                    <p class="schema-lead">
                        Sidebar memakai konfigurasi deklaratif dan renderer recursive: fleksibel untuk nested menu, badge, target, dan dropdown.
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Peta Sumber Utama</h4>
                            <ul class="schema-list">
                                <li><code>config/sidebar/_sidebar_dashboard.php</code> (dashboard + show more).</li>
                                <li><code>config/sidebar/_sidebar_apps.php</code> (nested menu + badge + dropdown).</li>
                                <li><code>config/sidebar/_sidebar_helps.php</code> (dokumen internal help).</li>
                                <li><code>resources/views/layouts/partials/sidebar/_menu.blade.php</code> (section wrapper).</li>
                                <li><code>resources/views/layouts/partials/sidebar/_menu-item.blade.php</code> (recursive renderer).</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Struktur Data Dasar</h4>
                            <pre class="schema-code"><code>[
  'title' => 'Skema Pemrograman',
  'icon' => '...',
  'paths' => 2,
  'children' => [
    ['title' => 'Skema Route', 'route' => 'help.pemrograman.skema.route'],
    ...
  ]
]</code></pre>
                            <div class="schema-meta">
                                <span class="schema-chip">children = parent node</span>
                                <span class="schema-chip">tanpa children = leaf link</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Mode Render Menu</h4>
                            <div class="schema-flow mb-4">
                                <div class="schema-step"><code>children</code> + tanpa <code>dropdown</code> -> accordion.</div>
                                <div class="schema-step"><code>children</code> + <code>'dropdown' => true</code> dirender sebagai item dropdown bertingkat.</div>
                            </div>
                            <pre class="schema-code"><code>[
  'route' => 'apps.chat',
  'title' => 'Chat',
  'dropdown' => true,
  'children' => [
    ['route' => 'apps.chat.private', 'title' => 'Private Chat'],
    ['route' => 'apps.chat.group', 'title' => 'Group Chat'],
  ]
]</code></pre>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Badge dan Target</h4>
                            <pre class="schema-code"><code>[
  'route' => 'apps.inbox.listing',
  'title' => 'Messages',
  'badge' => ['label' => 'Soon', 'class' => 'badge badge-info']
]</code></pre>
                            <pre class="schema-code mt-4"><code>[
  'route' => 'dashboards.landing',
  'title' => 'Landing',
  'target' => '_blank'
]</code></pre>
                            <div class="schema-note mt-4">Pada mode <code>dropdown => true</code>, implementasi saat ini menerapkan <code>target</code> parent ke item child pada dropdown tersebut.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Fitur Unik Dashboard: Show More / Show Less</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><code>menus_dashboard</code> = item inti yang selalu tampil.</div>
                                <div class="schema-step"><code>menus_dashboard_collapsed</code> menyimpan item tambahan pada mode collapsed.</div>
                                <div class="schema-step">Tombol "Show X More" dihitung dinamis berdasarkan jumlah item collapsed.</div>
                                <div class="schema-step">Jika route aktif ada di item collapsed, panel akan terbuka otomatis.</div>
                            </div>
                            <div class="schema-meta">
                                <span class="schema-chip">toggle text dinamis</span>
                                <span class="schema-chip">auto open on active route</span>
                                <span class="schema-chip">desktop + mobile compatible</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Checklist Engineering</h4>
                            <ul class="schema-list">
                                <li>Active state parent dihitung recursive, leaf menggunakan <code>request()->routeIs($route . '*')</code>.</li>
                                <li>Key title otomatis ditransformasikan ke <code>menu.*</code>; jika key tidak ada akan fallback ke text asli.</li>
                                <li>Sebelum publish: validasi route, badge, target, dropdown behavior, dan tampilan mobile.</li>
                            </ul>
                            <div class="schema-warn mt-4">Perubahan di struktur nested menu sebaiknya diuji di route aktif terdalam agar memastikan parent otomatis terbuka sesuai ekspektasi.</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Standar Tim (Strict) Sidebar</h4>
                            <div class="schema-flow">
                                <div class="schema-step"><strong>Rule wajib:</strong> konfigurasi route, permission, dan status active wajib sinkron.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> icon level-1 wajib valid + jumlah <code>paths</code> sesuai icon duotone.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> key translasi menu wajib ada di EN+ID untuk item user-facing utama.</div>
                                <div class="schema-step"><strong>Rule wajib:</strong> perubahan nested menu harus diuji active state sampai level terdalam.</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>Troubleshooting Sidebar</h4>
                            <ul class="schema-list">
                                <li><strong>Menu tidak muncul:</strong> cek file config yang benar dan struktur array-nya.</li>
                                <li><strong>Parent tidak auto-open:</strong> cek pola routeIs pada child route aktif.</li>
                                <li><strong>Judul tidak tertranslate:</strong> cek normalisasi key <code>menu.*</code> di file lang.</li>
                                <li><strong>Icon kosong:</strong> cek class icon dan nilai <code>paths</code>.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection