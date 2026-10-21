# Panduan Operasional Pergantian Versi Metronic (Theme Versioning)

URL aplikasi: `/help/pemrograman/operasional/panduan-pergantian-versi-metronic`

[⬅ Kembali ke README Docs](../README.md)

Panduan operasional standar untuk mengelola varian tema Metronic (V1, V2, hingga VN) menggunakan arsitektur **Universal Master Shell + Pluggable Layout Wrapper** tanpa duplikasi tag HTML, tanpa folder aset terpisah, dan terbukti aman dari regresi.

Tag:
- `universal-master-shell`
- `pluggable-layout-wrapper`
- `suffix-based-assets`
- `single-assets-root`
- `config-driven`
- `zero-reload-compatible`

---

## 1. Prinsip Utama Arsitektur

1. **Universal Master Shell (Single Source of Truth):**
   - File [resources/views/layouts/index.blade.php](file:///c:/laragon/finnally/veltronic-template/resources/views/layouts/index.blade.php) adalah master layout tunggal untuk seluruh aplikasi.
   - Mengelola tag `<html>`, `<head>`, meta SEO, favicon, asset CSS global, inisialisasi Zero-Flicker (`theme-mode`, `lang`, `icon-style`), modal global, drawers, dan bundle JavaScript.
   - **DILARANG** melakukan output buffering hack (`echo view(...)->render(); return;`) di dalam layout.
2. **Pluggable Layout Body Wrapper:**
   - Variasi visual antar versi (misal: Sidebar vertikal pada V1 vs Horizontal Top Header pada V2) dipisahkan ke dalam file layout wrapper:
     - V1 (Metronic Demo 1): [resources/views/layouts/_wrapper.blade.php](file:///c:/laragon/finnally/veltronic-template/resources/views/layouts/_wrapper.blade.php)
     - V2 (Metronic Demo 2): [resources/views/themes/v2/layouts/_wrapper.blade.php](file:///c:/laragon/finnally/veltronic-template/resources/views/themes/v2/layouts/_wrapper.blade.php)
   - Layout utama memanggil wrapper secara dinamis:
     ```blade
     @include(\App\Support\ThemeVersion::resolveView('layouts._wrapper', $activeThemeVersion))
     ```
3. **Unified Single Assets Root & Suffixing:**
   - Semua aset statis tetap berada di folder tunggal `public/assets/`.
   - File CSS/JS yang memiliki modifikasi spesifik versi menggunakan penamaan suffix: `style.bundle-v2.css`.
   - Resolusi aset menggunakan helper cerdas: `ThemeAsset::url('css/style.bundle.css')`.
4. **Zero Configuration View Fallback:**
   - View atau parsial yang tidak berbeda antar versi otomatis menggunakan file bersama/dasar. Anda hanya perlu membuat file khusus di `resources/views/themes/vN/` jika file tersebut benar-benar berbeda.

---

## 2. Komponen Inti Arsitektur

| Komponen | File Path | Fungsi Utama |
|---|---|---|
| **Theme Registry** | `config/theme.php` | Mendefinisikan versi aktif, label, lokasi view khusus, dan asset base. |
| **Theme Resolver** | `app/Support/ThemeVersion.php` | Normalisasi versi, membaca session/database, dan resolusi path view fallback. |
| **Asset Resolver** | `app/Support/ThemeAsset.php` | Menghasilkan URL asset dengan deteksi suffix `-vN` dan auto-fallback. |
| **Master Shell** | `resources/views/layouts/index.blade.php` | HTML root shell universal untuk seluruh 400+ halaman modul. |
| **V1 Wrapper** | `resources/views/layouts/_wrapper.blade.php` | Struktur tata letak sidebar Demo 1 (`kt_app_wrapper`, `kt_app_main`). |
| **V2 Wrapper** | `resources/views/themes/v2/layouts/_wrapper.blade.php` | Struktur tata letak horizontal Demo 2 (`kt_wrapper`, `header-bg.jpg`). |
| **Route Switcher** | `routes/web.php` (`/theme/version/{v}`) | Endpoint switch runtime, proteksi role master/admin, simpan session + DB, dan kirim JSON AJAX. |
| **Asset Diff CLI** | `app/Console/Commands/ThemeAssetsDiff.php` | Tool CLI untuk menyerap dan memberi suffix aset baru secara otomatis. |
| **Quality Gate** | `tests/Feature/ThemeVersionRenderTest.php` | Pengujian otomatis integritas render V1 & V2. |

---

## 3. Alur Kerja (Workflow) Menambah Tema Baru (Misal: V3)

Untuk menambahkan varian tema baru (misal: Metronic Demo 3), Anda **TIDAK PERLU** lagi menyalin seluruh file HTML, head, modal, dan puluhan script. Cukup ikuti 4 langkah ringkas:

### Langkah 1: Daftarkan di Registri Konfigurasi
Buka [config/theme.php](file:///c:/laragon/finnally/veltronic-template/config/theme.php) dan tambahkan key versi baru:
```php
'themes' => [
    'v1' => ['label' => 'Tema V1', 'view_path' => 'themes/v1', 'asset_base' => 'assets'],
    'v2' => ['label' => 'Tema V2', 'view_path' => 'themes/v2', 'asset_base' => 'assets'],
    'v3' => ['label' => 'Tema V3', 'view_path' => 'themes/v3', 'asset_base' => 'assets'],
],
```

### Langkah 2: Buat 1 File Layout Wrapper Body
Buat file `resources/views/themes/v3/layouts/_wrapper.blade.php`:
```blade
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper_v3">
            @include('themes.v3.layouts.header._base')
            
            @hasSection('toolbar')
                @yield('toolbar')
            @else
                @include('themes.v3.layouts._toolbar')
            @endif

            <div class="content d-flex flex-column flex-column-fluid">
                @yield('content')
            </div>

            @include('themes.v3.layouts._footer')
        </div>
    </div>
</div>
```

### Langkah 3: Ekstraksi & Suffix Aset (Opsional jika ada CSS/JS Khusus)
Jika tema baru membawa bundle CSS/JS yang dimodifikasi, gunakan artisan command:
```bash
# 1) Preview dampak perubahan (Dry Run)
php artisan theme:assets-diff v3 --source=assets-v3 --dry-run

# 2) Eksekusi sinkronisasi aset ke public/assets/ dengan suffix -v3
php artisan theme:assets-diff v3 --source=assets-v3
```

### Langkah 4: Validasi & Uji Targeted Test
Jalankan pengujian targeted untuk memastikan layout v3 me-render kontainer yang tepat:
```bash
php artisan test tests/Feature/ThemeVersionRenderTest.php tests/Unit/ThemeAssetTest.php
```

---

## 4. Pola Resolusi Aset di Blade

Semua stylesheet dan script di Blade wajib menggunakan `ThemeAsset::url()`:

```blade
<!-- Global CSS: otomatis memuat style.bundle-v2.css jika V2 aktif, atau fallback ke style.bundle.css -->
<link href="{{ \App\Support\ThemeAsset::url('css/style.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" />

<!-- Plugin CSS -->
<link href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" />

<!-- Global Javascript -->
<script src="{{ \App\Support\ThemeAsset::url('js/scripts.bundle.js', $theme_asset_pack ?? null) }}"></script>
```

---

## 5. Standar Toolbar Modul Adaptif

Seluruh halaman modul yang mendefinisikan `@section('toolbar')` kini otomatis didukung di semua varian tema:
- Di V1: Otomatis menggunakan kontainer toolbar `kt_app_toolbar` dengan styling background neutral.
- Di V2: Otomatis didelegasikan ke toolbar horizontal Demo 2 dengan breadcrumbs putih elegan dan action button yang di-render unescaped `{!! $action !!}`.
