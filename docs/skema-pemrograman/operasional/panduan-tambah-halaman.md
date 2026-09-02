# Panduan Tambah Halaman

URL aplikasi: `/help/pemrograman/operasional/panduan-tambah-halaman`

[⬅ Kembali ke README Docs](../README.md)

Alur standar menambahkan halaman baru pada proyek ini: dari file Blade, auto route, menu config, translasi, sampai validasi akhir.

Tag:
- `konsisten layout`
- `mudah maintain`

## Flow End-to-End

Langkah/aturan:
- 1. Buat file baru di `resources/views/pages/... .blade.php`.
- 2. Route otomatis terbentuk via `routes/menu.php`.
- 3. Tambahkan item menu di `config/sidebar` atau `config/header`.
- 4. Tambah key translasi di `lang/en/menu.php` dan `lang/id/menu.php`.
- 5. Uji akses URL, active state menu, dan page title.

## Contoh Struktur File

> Catatan: Pada proyek ini, route halaman `pages` tidak ditulis satu per satu, tetapi di-scan otomatis.

## Template Minimal Halaman

- `@extends('layouts.index')`
- `@section('title', ...)`
- `@section('toolbar')`
- `@section('content')`

## Checklist Validasi

- Halaman dapat diakses saat login (middleware `auth` aktif).
- Menu mengarah ke route yang benar.
- Judul halaman tampil sesuai translasi.
- Tampilan desktop dan mobile tetap stabil.

## Perintah Verifikasi Cepat

> Peringatan: Jika route baru tidak terlihat, pastikan nama file Blade valid dan tidak ada typo folder/path.
