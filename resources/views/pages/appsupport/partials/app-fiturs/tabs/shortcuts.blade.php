<!--begin::Shortcuts Full-Width Layout-->
<div class="d-flex flex-column gap-6">

    <!--begin::Master Switch & Title Card (Full Width)-->
    <div class="card card-flush shadow-sm border-0">
        <div class="card-body p-6">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 text-center text-md-start">
                
                <!-- Info Left -->
                <div class="d-flex flex-column flex-md-row align-items-center gap-3 gap-md-4 w-100 w-md-auto">
                    <div class="symbol symbol-45px symbol-circle bg-light-primary text-primary d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ki-outline ki-keyboard fs-2 text-primary"></i>
                    </div>
                    <div class="d-flex flex-column align-items-center align-items-md-start">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 flex-wrap">
                            <h4 class="fw-bolder text-gray-900 m-0 fs-4">Pintasan Global</h4>
                            <span class="badge badge-light-primary fw-bold fs-9">Pemantau Aktif</span>
                        </div>
                        <span class="text-muted fs-8 mt-1">Status Pemantau Tombol di Seluruh Peramban & Navigasi</span>
                    </div>
                </div>

                <!-- Master Toggle Switch Right -->
                <div class="d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto">
                    <div class="form-check form-switch form-check-custom form-check-solid" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Aktifkan / Nonaktifkan Seluruh Pintasan Keyboard">
                        <input class="form-check-input h-25px w-45px cursor-pointer" type="checkbox" id="global_shortcuts_master_switch" checked />
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end::Master Switch & Title Card-->

    <!--begin::Tabel Daftar Pintasan Keyboard Card (Full Width)-->
    <div class="card card-flush shadow-sm border-0">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-between gap-3">
            <div class="card-title d-flex flex-column mb-2 mb-sm-0">
                <h3 class="fw-bolder text-gray-900 m-0">Daftar Pintasan Keyboard Terdaftar</h3>
                <span class="text-muted fs-8 mt-1">
                    Pintasan aktif langsung sinkron dengan event listener browser & basis data
                </span>
            </div>
            <div class="card-toolbar m-0 w-100 w-sm-auto">
                <button type="button" class="btn btn-light-primary btn-sm w-100 w-sm-auto" id="btn_new_shortcut_open_modal" data-bs-toggle="modal" data-bs-target="#kt_modal_shortcut_manage">
                    <i class="ki-outline ki-plus fs-5 me-1"></i> Tambah Pintasan Baru
                </button>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-2">
            <!-- Filter Kategori & Search Toolbar -->
            <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-between gap-3 mb-5">
                <!-- Search Input -->
                <div class="d-flex align-items-center position-relative w-100 w-md-300px">
                    <i class="ki-outline ki-magnifier fs-4 position-absolute ms-3 text-gray-500"></i>
                    <input type="text" id="shortcut_table_search" class="form-control form-control-solid form-control-sm ps-10" placeholder="Cari nama, tombol, atau role..." />
                </div>

                <!-- Category Filter Select Dropdown -->
                <div class="w-100 w-md-225px flex-shrink-0">
                    <select id="shortcut_category_filter" class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                        <option value="all" selected>Semua Kategori ({{ $shortcuts->count() }})</option>
                        <option value="visibility">Visibilitas ({{ $shortcuts->where('category', 'visibility')->count() }})</option>
                        <option value="appearance">Tema & Ikon ({{ $shortcuts->where('category', 'appearance')->count() }})</option>
                        <option value="system">Sistem ({{ $shortcuts->where('category', 'system')->count() }})</option>
                        <option value="navigation">Navigasi ({{ $shortcuts->where('category', 'navigation')->count() }})</option>
                        <option value="element">Elemen ({{ $shortcuts->where('category', 'element')->count() }})</option>
                    </select>
                </div>
            </div>

            <!-- Tabel Data Shortcuts -->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-8 gy-3 gs-4 mb-0" id="table_app_shortcuts">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-8 text-uppercase gs-0 bg-light text-nowrap">
                            <th class="min-w-200px ps-4">Nama Pintasan & Kelompok</th>
                            <th class="text-center min-w-150px">Kombinasi Tombol</th>
                            <th class="min-w-180px">Target Aksi</th>
                            <th class="text-center min-w-140px">Hak Akses Role</th>
                            <th class="text-center min-w-80px">Status</th>
                            <th class="text-end min-w-110px pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 fw-semibold" id="tbody_app_shortcuts">
                        @forelse($shortcuts as $sc)
                            @php
                                $catMeta = $sc->category_meta;
                                $rolesArr = is_array($sc->roles) ? $sc->roles : [];
                                $searchData = strtolower($sc->name . ' ' . $sc->formatted_combination . ' ' . $sc->action_type . ' ' . $sc->action_target . ' ' . implode(' ', $rolesArr) . ' ' . $sc->category);
                            @endphp
                            <tr class="shortcut-row" data-id="{{ $sc->id }}" data-category="{{ $sc->category }}" data-search="{{ $searchData }}">
                                <!-- Nama & Kelompok -->
                                <td class="ps-4">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="badge {{ $catMeta['badge_class'] }} fs-9 px-2 py-0 fw-bold">
                                                {{ $catMeta['name'] }}
                                            </span>
                                        </div>
                                        <span class="fw-bold text-gray-900 fs-7 shortcut-name-text">{{ $sc->name }}</span>
                                        <span class="text-muted fs-8 shortcut-desc-text">{{ $sc->description ?: '-' }}</span>
                                    </div>
                                </td>

                                <!-- Kombinasi Tombol -->
                                <td class="text-center">
                                    <div class="d-flex flex-column align-items-center gap-1">
                                        <kbd class="bg-light-primary text-primary px-2 py-1 rounded fw-bold border fs-7 shortcut-combo-badge shadow-xs">
                                            {{ $sc->formatted_combination }}
                                        </kbd>
                                        <span class="text-muted fs-9 font-monospace shortcut-mac-combo">{{ $sc->mac_combination }}</span>
                                    </div>
                                </td>

                                <!-- Target Aksi -->
                                <td>
                                    <div class="d-flex flex-column">
                                        @if($sc->action_type === 'toggle_topbar_tools')
                                            <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Alihkan Alat Bilah Atas</span>
                                            <span class="text-muted fs-9 font-monospace">topbar_tools</span>
                                        @elseif($sc->action_type === 'toggle_topbar_menus')
                                            <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Alihkan Menu Bilah Atas</span>
                                            <span class="text-muted fs-9 font-monospace">topbar_menus</span>
                                        @elseif($sc->action_type === 'toggle_sidebar_menus')
                                            <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Alihkan Menu Samping</span>
                                            <span class="text-muted fs-9 font-monospace">sidebar_menus</span>
                                        @elseif($sc->action_type === 'visibility_toggle')
                                            <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Alihkan Elemen Kustom</span>
                                            <span class="text-muted fs-9 font-monospace text-truncate mw-180px">{{ $sc->action_target }}</span>
                                        @elseif($sc->action_type === 'open_url' || $sc->action_type === 'nav_link')
                                            <span class="badge badge-light-info fw-bold fs-8 w-fit mb-1">Buka Halaman (Tautan)</span>
                                            <span class="text-muted fs-9 font-monospace text-truncate mw-180px" title="{{ $sc->action_target }}">{{ $sc->action_target ?: '/' }}</span>
                                        @elseif($sc->action_type === 'click_element')
                                            <span class="badge badge-light-warning fw-bold fs-8 w-fit mb-1">Klik Tombol</span>
                                            <span class="text-muted fs-9 font-monospace text-truncate mw-180px">{{ $sc->action_target }}</span>
                                        @elseif($sc->action_type === 'search')
                                            <span class="badge badge-light-danger fw-bold fs-8 w-fit mb-1">Pencarian Global</span>
                                            <span class="text-muted fs-9">global_search</span>
                                        @elseif($sc->action_type === 'theme_mode')
                                            <span class="badge badge-light-success fw-bold fs-8 w-fit mb-1">Mode Gelap / Terang</span>
                                            <span class="text-muted fs-9">theme_mode</span>
                                        @elseif($sc->action_type === 'icon_style')
                                            @php
                                                $styleTarget = strtolower($sc->action_target ?: 'duotone');
                                                $styleLabel = ucfirst($styleTarget);
                                                $styleBadgeColor = match($styleTarget) {
                                                    'duotone' => 'badge-light-primary',
                                                    'solid' => 'badge-light-success',
                                                    'outline' => 'badge-light-info',
                                                    default => 'badge-light-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $styleBadgeColor }} fw-bold fs-8 w-fit mb-1">Gaya Ikon: {{ $styleLabel }}</span>
                                            <span class="text-muted fs-9 font-monospace">icon_style:{{ $styleTarget }}</span>
                                        @elseif($sc->action_type === 'switch_language')
                                            @php
                                                $langLabel = strtolower($sc->action_target) === 'en' ? 'Inggris (English)' : 'Indonesia';
                                            @endphp
                                            <span class="badge badge-light-success fw-bold fs-8 w-fit mb-1">Ganti Bahasa: {{ $langLabel }}</span>
                                            <span class="text-muted fs-9 font-monospace">locale:{{ $sc->action_target }}</span>
                                        @elseif($sc->action_type === 'switch_version')
                                            <span class="badge badge-light-primary fw-bold fs-8 w-fit mb-1">Versi Tata Letak: {{ strtoupper($sc->action_target) }}</span>
                                            <span class="text-muted fs-9 font-monospace">version:{{ $sc->action_target }}</span>
                                        @elseif($sc->action_type === 'lock_screen')
                                            <span class="badge badge-light-danger fw-bold fs-8 w-fit mb-1">Kunci Layar</span>
                                            <span class="text-muted fs-9">lock_screen</span>
                                        @else
                                            <span class="badge badge-light-secondary fw-bold fs-8 w-fit mb-1">{{ ucfirst($sc->action_type) }}</span>
                                            <span class="text-muted fs-9 font-monospace">{{ $sc->action_target }}</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Batasan Hak Akses Role -->
                                <td class="text-center">
                                    <div class="d-flex flex-wrap justify-content-center gap-1">
                                        @if(empty($sc->roles))
                                            <span class="badge badge-light-success fs-9 fw-semibold" data-bs-toggle="tooltip" title="Dapat digunakan oleh semua pengguna">Semua Peran</span>
                                        @else
                                            @foreach($sc->roles as $r)
                                                @php
                                                    $rColor = match(strtolower($r)) {
                                                        'master' => 'badge-light-danger',
                                                        'admin' => 'badge-light-primary',
                                                        'operator' => 'badge-light-warning',
                                                        default => 'badge-light-secondary'
                                                    };
                                                @endphp
                                                <span class="badge {{ $rColor }} fs-9 fw-bold">{{ ucfirst($r) }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>

                                <!-- Status Toggle Switch -->
                                <td class="text-center">
                                    <div class="form-check form-switch form-check-custom form-check-solid d-inline-block">
                                        <input class="form-check-input h-18px w-30px btn-toggle-shortcut-row" type="checkbox" data-id="{{ $sc->id }}" {{ $sc->is_enabled ? 'checked' : '' }} />
                                    </div>
                                </td>

                                <!-- Aksi Tombol -->
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end align-items-center gap-1">
                                        <button type="button" class="btn btn-icon btn-light-success btn-sm btn-test-single-shortcut" data-id="{{ $sc->id }}" data-action-type="{{ $sc->action_type }}" data-action-target="{{ $sc->action_target }}" data-bs-toggle="tooltip" title="Uji Coba Langsung">
                                            <i class="ki-outline ki-eye fs-5"></i>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-light-info btn-sm btn-edit-shortcut-row" data-id="{{ $sc->id }}" data-bs-toggle="tooltip" title="Ubah Pintasan">
                                            <i class="ki-outline ki-pencil fs-5"></i>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-light-danger btn-sm btn-delete-shortcut-row" data-id="{{ $sc->id }}" data-name="{{ $sc->name }}" data-bs-toggle="tooltip" title="Hapus Pintasan">
                                            <i class="ki-outline ki-trash fs-5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="tr_empty_shortcuts">
                                <td colspan="6" class="text-center py-8 text-muted fs-7">
                                    <i class="ki-outline ki-keyboard fs-3x text-gray-400 d-block mb-2"></i>
                                    Belum ada pintasan keyboard yang dibuat. Klik tombol <strong>Tambah Pintasan Baru</strong> untuk membuat pintasan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Tabel Daftar Pintasan Keyboard Card-->

    <!--begin::Panduan Lengkap Cheatsheet Card (Categorized Reference)-->
    <div class="card card-flush shadow-sm border-0">
        <div class="card-header pt-6">
            <div class="card-title">
                <h5 class="fw-bolder text-gray-900 m-0">
                    Panduan Kelompok Pintasan & Tata Cara Penggunaan
                </h5>
            </div>
        </div>
        <div class="card-body pt-2">
            <div class="row g-4 fs-7 text-gray-700">
                <div class="col-md-6 col-xl-3">
                    <div class="p-4 bg-light rounded-3 border h-100">
                        <h6 class="fw-bold text-gray-900 mb-2">
                            Toggle Visibilitas Elemen
                        </h6>
                        <p class="fs-8 text-muted mb-2">Menyembunyikan / menampilkan komponen UI:</p>
                        <ul class="ps-4 mb-0 fs-8 text-muted d-flex flex-column gap-1">
                            <li><kbd class="bg-light-primary text-primary border px-1">Ctrl + Alt + T</kbd> : Fitur di Topbar</li>
                            <li><kbd class="bg-light-primary text-primary border px-1">Ctrl + Alt + H</kbd> : Menu Header Topbar</li>
                            <li><kbd class="bg-light-primary text-primary border px-1">Ctrl + Alt + M</kbd> : Menu Sidebar</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="p-4 bg-light rounded-3 border h-100">
                        <h6 class="fw-bold text-gray-900 mb-2">
                            Tema & Bahasa
                        </h6>
                        <p class="fs-8 text-muted mb-2">Beralih varian visual seketika:</p>
                        <ul class="ps-4 mb-0 fs-8 text-muted d-flex flex-column gap-1">
                            <li><kbd class="bg-light-success text-success border px-1">Ctrl + Alt + B</kbd> : Mode Gelap/Terang</li>
                            <li><kbd class="bg-light-success text-success border px-1">Ctrl + Alt + I</kbd> : Bahasa Indonesia</li>
                            <li><kbd class="bg-light-success text-success border px-1">Ctrl + Alt + E</kbd> : English</li>
                            <li><kbd class="bg-light-info text-info border px-1">Ctrl + Alt + D/S/O</kbd> : Gaya Ikon</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="p-4 bg-light rounded-3 border h-100">
                        <h6 class="fw-bold text-gray-900 mb-2">
                            Aksi Sistem & Keamanan
                        </h6>
                        <p class="fs-8 text-muted mb-2">Akses cepat fungsi utilitas:</p>
                        <ul class="ps-4 mb-0 fs-8 text-muted d-flex flex-column gap-1">
                            <li><kbd class="bg-light-info text-info border px-1">Ctrl + Alt + F</kbd> : Pencarian Global</li>
                            <li><kbd class="bg-light-danger text-danger border px-1">Ctrl + Alt + L</kbd> : Lock Screen</li>
                            <li><kbd class="bg-light-primary text-primary border px-1">Ctrl + Alt + 1/2</kbd> : Versi V1/V2</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="p-4 bg-light rounded-3 border h-100">
                        <h6 class="fw-bold text-gray-900 mb-2">
                            Navigasi & Proteksi Form
                        </h6>
                        <p class="fs-8 text-muted mb-2">Aturan alur navigasi & proteksi input:</p>
                        <ul class="ps-4 mb-0 fs-8 text-muted d-flex flex-column gap-1">
                            <li><strong>Navigasi Menu:</strong> Langsung membuka rute halaman pilihan.</li>
                            <li><strong>Proteksi Input:</strong> Saat kursor aktif di input teks, pintasan huruf dinonaktifkan otomatis agar tidak mengganggu pengetikan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Panduan Lengkap Cheatsheet Card-->

</div>
<!--end::Shortcuts Full-Width Layout-->

<!-- Data Catalog JSON untuk Javascript Frontend -->
<script type="text/javascript">
    window.SHORTCUT_CATEGORIES_CATALOG = @json($shortcutCategories);
</script>
