# Panduan Tambah Menu

URL aplikasi: `/help/pemrograman/operasional/panduan-tambah-menu`

[⬅ Kembali ke README Docs](../README.md)

Standar menambah item menu agar konsisten di sidebar/header: struktur data, active state, translasi, dan edge case yang perlu diuji.

## Pilih Domain Menu

- `config/sidebar/_sidebar_*.php` untuk navigasi utama kiri.
- `config/header/_header_*.php` untuk menu atas.
- `config/header/_header_help.php` untuk quick help menu.

## Skema Data Leaf vs Parent

```php
// leaf
[
  'title' => 'Panduan Tambah Menu',
  'route' => 'help.pemrograman.operasional.panduan-tambah-menu',
]

// parent
[
  'title' => 'Skema Pemrograman',
  'children' => [ ... ],
]
```

## Kapan Pakai route vs href

Langkah/aturan:
- `route`: untuk halaman internal Laravel.
- `href`: untuk URL eksternal atau non-route.
- `target`: tetapkan eksplisit untuk UX yang konsisten.

## Fitur Opsional

- `badge` untuk status/beta/info.
- `dropdown => true` untuk flyout menu.
- `icon` + `paths` untuk top-level visual consistency.

## Checklist Uji Setelah Tambah Menu

- Parent otomatis open saat child route aktif.
- Item baru aktif di desktop dan mobile.
- Title menu tertranslate di EN dan ID.
- Tidak ada route missing saat klik menu.

> Catatan: Untuk menu nested, validasi minimal pada child terdalam agar recursive active state benar.
