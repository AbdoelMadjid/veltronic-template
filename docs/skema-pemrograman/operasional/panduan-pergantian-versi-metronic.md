# Panduan Pergantian Versi Metronic

URL aplikasi: `/help/pemrograman/operasional/panduan-pergantian-versi-metronic`

[⬅ Kembali ke README Docs](../README.md)

Panduan standar untuk menambah versi tema baru (misalnya v3, v55) tanpa hardcode versi, tanpa folder aset terpisah, dan tetap aman terhadap regresi.

Tag:
- `suffix-based versioning`
- `single assets root`
- `config-driven`
- `regression-safe`

## Prinsip Utama

- Jangan hardcode string versi seperti `'v2'` di Blade.
- Pakai resolver versi: `App\Support\ThemeVersion`.
- Pakai resolver aset: `App\Support\ThemeAsset::url(...)`.
- Jangan buat folder `assets-v3`, gunakan suffix file `-v3`.
- Buat file `-vN.blade.php` hanya jika memang ada perbedaan layout/style.

## Komponen Inti

> Catatan: Seluruh komponen di atas sudah disiapkan untuk flow multi-versi agar penambahan versi baru tinggal konfigurasi + file yang berbeda saja.

## Rincian Komponen Inti (Core Resolver)

Core resolver utama pada proyek:
- `app/Support/ThemeVersion.php`
- `app/Support/ThemeAsset.php`
- `app/Console/Commands/ThemeAssetsDiff.php`
- `config/theme.php`
- `tests/Feature/ThemeVersionRenderTest.php`
- `tests/Unit/ThemeAssetTest.php`

### Contoh Pattern yang Benar

```blade
<link rel="stylesheet" href="{{ ThemeAsset::url('css/style.bundle.css') }}" />
<script src="{{ ThemeAsset::url('js/scripts.bundle.js') }}"></script>
```

### Signature

```bash
php artisan theme:assets-diff {theme_version} \
  [--source=...] \
  [--base=assets] \
  [--dry-run] \
  [--keep-source] \
  [--force]
```

### Arti Parameter & Opsi

- `{theme_version}`: versi target, contoh `v3`.
- `--source`: folder sumber relatif ke `public/`, contoh `assets-v3`.
- `--base`: folder assets utama (default `assets`).
- `--dry-run`: simulasi tanpa perubahan file.
- `--keep-source`: file source tidak dibersihkan.
- `--force`: timpa file suffix yang sudah ada.

### Logika Proses per File

```text
ThemeAsset::url("css/style.bundle.css", "v3")
-> cek assets/css/style.bundle-v3.css
-> jika ada pakai -v3, jika tidak pakai assets/css/style.bundle.css
```

```html
<!-- CSS page/plugin -->
<link rel="stylesheet" href="{{ ThemeAsset::url('css/datatables.bundle.css') }}" />

<!-- CSS global (layout) -->
<link rel="stylesheet" href="{{ ThemeAsset::url('css/style.bundle.css') }}" />

<!-- JS global -->
<script src="{{ ThemeAsset::url('js/scripts.bundle.js') }}"></script>
```

- `default()`: mengambil versi default dari `config/theme.php`.
- `available()`: daftar versi legal untuk switch runtime.
- `normalize($version)`: validasi versi input; fallback ke default jika tidak valid.
- `current()`: membaca `session('theme_version')` lalu dinormalisasi.
- `resolveView($baseView, $version)`: pilih view `-vN` jika ada; jika tidak, pakai base view.
- `assetBase($assetPack)`: menentukan root folder assets berdasarkan mapping config.
- Menerima path relatif, contoh: `css/style.bundle.css`.
- Jika versi aktif bukan default, command mencoba file suffix terlebih dahulu: `css/style.bundle-vN.css`.
- Jika file suffix ada, dipakai; jika tidak, fallback ke file base.
- Method internal `versionedPath()` yang membentuk nama file suffix otomatis.
- `{theme_version}`: versi target, contoh `v3`.
- `--source`: path source relatif ke `public/` (contoh `assets-v3`).
- `--base`: base assets relatif ke `public/` (default `assets`).
- `--dry-run`: simulasi, tidak ada perubahan file.
- `--keep-source`: source tidak dibersihkan setelah proses.
- `--force`: timpa file suffix versi yang sudah ada.

Langkah/aturan:
- Jika file source belum ada di base: dipindah ke base dengan path yang sama (`moved_unique`).
- Jika file source sama persis dengan base (hash sama): ditandai `deleted_same` lalu file source dibersihkan.
- Jika file beda dan extension `css/js`: file di-rename ke format suffix `-vN` pada path base.
- Jika file beda tapi bukan `css/js`: ikuti kebijakan media/non-code (dipindah/ditahan) dan tandai untuk review jika perlu.

> Catatan: Efek praktis: view dispatcher cukup memanggil satu helper, tanpa if-else hardcode v1/v2/v3.

## Rincian Komponen Inti (Config & Quality Gate)

File kontrol konfigurasi:
- `config/theme.php` untuk daftar versi legal + default.
- Test gate:
- `tests/Feature/ThemeVersionRenderTest.php`
- `tests/Unit/ThemeAssetTest.php`

### Contoh Skema Pemakaian

```bash
# 1) Preview dampak
php artisan theme:assets-diff v3 --source=assets-v3 --dry-run

# 2) Eksekusi aktual
php artisan theme:assets-diff v3 --source=assets-v3
```

### Interpretasi Ringkasan Output

```bash
# 1) Lihat dampak dulu
php artisan theme:assets-diff v3 --source=assets-v3 --dry-run

# 2) Eksekusi aktual
php artisan theme:assets-diff v3 --source=assets-v3

# 3) Jika ingin simpan source (audit/manual compare)
php artisan theme:assets-diff v3 --source=assets-v3 --keep-source

# 4) Jika suffix -v3 sudah ada dan harus di-replace
php artisan theme:assets-diff v3 --source=assets-v3 --force
```

> Catatan: Standar aman: jalankan `--dry-run` dulu, review angka ringkasan, baru jalankan mode apply.

## Pola Wajib di Blade: `ThemeAsset::url()`

> Peringatan: Jika route help baru belum muncul, cek nama file dan path: `resources/views/pages/help/pemrograman/...`.

## Flow Tambah Versi (Bagian 1: Setup)

- Case 2: fallback ke base file jika suffix tidak ada.
- Mencegah hardcode path `public/assets` di Blade.
- Mencegah hardcode path `public/assets` di Blade.
- Jika file suffix tidak ada, helper fallback otomatis ke file base tanpa error.
- Jika file suffix tidak ada, helper fallback otomatis ke file base tanpa error.

## Flow Tambah Versi (Bagian 2: Validasi)

- `{theme_version}`: versi target, contoh `v3`.
- `--source`: path source relatif ke `public/` (contoh `assets-v3`).
- `--base`: base assets relatif ke `public/` (default `assets`).
- `--dry-run`: simulasi, tidak ada perubahan file.

## Rincian Command `ThemeAssetsDiff`

- `--keep-source`: source tidak dibersihkan setelah proses.
- `--force`: timpa file suffix versi yang sudah ada.
- Tidak ada hardcode `'v2'` untuk behavior inti.
- Tidak ada path `assets-vN` di Blade/layout shared.
- Semua file versi pakai suffix `-vN`.

> Catatan: Tujuan akhirnya: scalable untuk v3, v10, atau v55 tanpa perlu mengubah pola arsitektur.
