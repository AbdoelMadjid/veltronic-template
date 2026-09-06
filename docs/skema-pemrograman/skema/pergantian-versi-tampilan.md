# Skema Pergantian Versi Tampilan (Metronic Multi-Version Architecture)

Blueprint multi-versi Metronic (v1 & v2), suffix view resolver, asset packaging, dan session switcher runtime.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Prinsip Multi-Versi
- **Tanpa Hardcode**: Tidak ada string versi seperti `'v2'` yang di-hardcode pada Blade.
- **Suffix View Resolver**: Jika file view dengan suffix versi (misal `index-v2.blade.php`) tersedia, maka file tersebut yang akan di-render. Jika tidak ada, otomatis fallback ke base view (`index.blade.php`).
- **Asset Packaging Suffix**: Asset CSS/JS menggunakan resolver `ThemeAsset::url("css/style.bundle.css")` yang mengecek keberadaan file suffix versi (contoh `css/style.bundle-v2.css`).

## 2. Komponen Inti
- `App\Support\ThemeVersion`: Resolusi versi default, validasi versi legal, pembacaan session aktif, dan mapping view template.
- `App\Support\ThemeAsset`: Resolusi URL aset dengan fallback suffix otomatis.
- `app/Console/Commands/ThemeAssetsDiff.php`: Tool CLI artisan untuk memvalidasi perbedaan aset antar versi Metronic.
- `config/theme.php`: Definisi daftar versi legal (`available`) dan versi default (`default`).

## 3. Alur Pergantian Versi Runtime
1. User memilih versi melalui dropdown Theme Version Switcher di header/navbar.
2. Request dikirim ke route `/theme/version/{version}`.
3. Controller menyimpan versi yang dinormalisasi ke `session('theme_version')`.
4. Halaman di-refresh dan me-render view serta load aset sesuai versi yang dipilih.
