# Skema Pergantian Versi Tampilan (Theme Versioning Architecture)

URL aplikasi: `/help/pemrograman/skema/pergantian-versi-tampilan`

[⬅ Kembali ke Daftar Skema](../README.md)

Arsitektur multi-versi Metronic (V1, V2, hingga VN) yang memungkinkan pergantian varian tata letak antarmuka secara dinamis pada runtime menggunakan pola **Universal Master Shell + Pluggable Body Wrapper** tanpa duplikasi folder asset maupun kode HTML boilerplate.

---

## 1. Arsitektur Diagram

```
[Halaman Modul: users.blade.php, roles.blade.php, dashboard.blade.php, dll.]
                                │
                                ▼ (@extends('layouts.index'))
       ┌─────────────────────────────────────────────────────────────────┐
       │                   layouts/index.blade.php                       │
       │           (Universal Master Shell - Root Dokumen)               │
       │  - <!DOCTYPE html>, <head>, SEO Meta, Favicon                   │
       │  - ThemeAsset CSS bundles & Zero-Flicker scripts                │
       │  - Modals Global, Drawers Global, Core Scripts                  │
       │  - Tag <body> adaptif (id kt_app_body / kt_body + background)   │
       └────────────────────────────────┬────────────────────────────────┘
                                        │
           @include(ThemeVersion::resolveView('layouts._wrapper', $version))
                                        │
                   ┌────────────────────┴────────────────────┐
                   ▼                                         ▼
   [layouts/_wrapper.blade.php]             [themes/v2/layouts/_wrapper.blade.php]
   - Struktur Demo 1 (V1)                   - Struktur Demo 2 (V2)
   - Vertical Accordion Sidebar             - Horizontal Top Header
   - id="kt_app_wrapper"                    - id="kt_wrapper"
   - id="kt_app_main"                       - Background pattern header-bg.jpg
   - Toolbar V1 + @yield('content')         - Toolbar V2 + @yield('content')
```

---

## 2. Prinsip Arsitektur Utama

1. **Config-Driven & Central Registry:**
   Daftar versi yang sah didefinisikan secara deklaratif di [config/theme.php](file:///c:/laragon/finnally/veltronic-template/config/theme.php). Penambahan tema baru cukup mendaftarkan label, path view khusus, dan asset base.
2. **Pluggable Layout Body Wrapper:**
   Hanya kerangka tata letak body yang dipisahkan ke dalam wrapper (`_wrapper.blade.php`). Seluruh tag pembungkus HTML, CSS, JavaScript, modal, dan drawers tetap terpusat di `layouts/index.blade.php`.
3. **Unified Assets Root with Suffix-Based Resolution:**
   Semua file aset statis tetap berada di satu root `public/assets/`. Jika ada modifikasi style khusus untuk versi tertentu, gunakan suffix penamaan (contoh: `style.bundle-v2.css`). Helper `ThemeAsset::url()` secara otomatis mendeteksi file suffix tersebut dan fallback ke file dasar jika tidak ditemukan.
4. **Zero-Reload Runtime State Preservation:**
   Versi aktif disimpan dalam `session('theme_version')` dan disinkronkan ke database `AppSetting::set('default_theme_version', ...)` serta dicatat ke `UserLog`. Route switcher mendukung respons JSON/AJAX sehingga halaman tidak perlu reload penuh saat pergantian via dialog/fetch.
5. **Universal Toolbar Support:**
   Partial [resources/views/layouts/partials/_toolbar.blade.php](file:///c:/laragon/finnally/veltronic-template/resources/views/layouts/partials/_toolbar.blade.php) mendeteksi versi tema aktif secara dinamis. Di V1 menggunakan kontainer `kt_app_toolbar`, sedangkan di V2 mendelegasikan ke toolbar horizontal Demo 2 dengan rendering aksi unescaped `{!! $action !!}`.

---

## 3. Core Class Helper

### `App\Support\ThemeVersion`
```php
namespace App\Support;

class ThemeVersion
{
    // Mengambil versi default (dari DB AppSetting atau fallback config/theme.php)
    public static function default(): string;

    // Mengambil daftar versi yang diizinkan (['v1', 'v2', ...])
    public static function available(): array;

    // Normalisasi input versi, fallback ke default jika tidak sah
    public static function normalize(?string $version): string;

    // Membaca session('theme_version') dengan fallback normalisasi
    public static function current(): string;

    // Resolusi view: cek folder themes/vN/ -> suffix -vN -> base view
    public static function resolveView(string $baseView, ?string $version = null): string;

    // Menentukan root asset base path
    public static function assetBase(?string $assetPack = null): string;
}
```

### `App\Support\ThemeAsset`
```php
namespace App\Support;

class ThemeAsset
{
    // Mengembalikan URL aset dengan deteksi otomatis file suffix versi
    // Contoh: 'css/style.bundle.css' pada v2 -> /assets/css/style.bundle-v2.css
    // Jika file suffix tidak ada di disk -> fallback ke /assets/css/style.bundle.css
    public static function url(string $relativePath, ?string $version = null): string;
}
```

---

## 4. Routing & Controller Switcher

Route terdaftar pada [routes/web.php](file:///c:/laragon/finnally/veltronic-template/routes/web.php):

```php
Route::get('/theme/version/{version}', function (Request $request, $version) {
    if (in_array($version, ThemeVersion::available(), true)) {
        session(['theme_version' => $version]);
        if (class_exists(\App\Models\AppSupport\AppSetting::class)) {
            \App\Models\AppSupport\AppSetting::set('default_theme_version', $version, 'appearance');
        }

        if (class_exists(\App\Models\Profil\UserLog::class)) {
            \App\Models\Profil\UserLog::record(
                module: 'appsupport',
                menu: 'topbar-tools',
                activity: 'Ganti Varian Tema (Theme Version)',
                description: 'Mengubah versi tata letak layout tema menjadi: ' . strtoupper($version),
                user: auth()->user(),
                level: 'info'
            );
        }

        if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'status' => 'success',
                'version' => $version,
                'message' => 'Theme layout version switched to ' . strtoupper($version)
            ]);
        }
    }
    return redirect()->back();
})->middleware(['auth', 'role:master|admin'])->name('theme.version.switch');
```

---

## 5. Quality Gate & Anti-Regresi

Integritas arsitektur pergantian tema dilindungi oleh unit & feature test:
- **`tests/Feature/ThemeVersionRenderTest.php`**: Memverifikasi bahwa `/dashboard` dan `/apps/file-manager/files` me-render kontainer `kt_app_wrapper` pada V1, dan me-render `kt_wrapper`, `style.bundle-v2.css`, serta `header-bg.jpg` pada V2.
- **`tests/Unit/ThemeAssetTest.php`**: Memverifikasi resolusi URL aset suffix dan fallback otomatis jika file suffix tidak tersedia di storage/public.
- **`tests/Feature/ToolbarPermissionAndSettingSyncTest.php`**: Memverifikasi proteksi role admin/master, persistensi AppSetting, dan dukungan respons JSON.
