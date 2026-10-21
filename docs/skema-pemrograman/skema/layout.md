# Skema Layout

URL aplikasi: `/help/pemrograman/skema/layout`

[⬅ Kembali ke README Docs](../README.md)

Alur struktur layout dari base template, partial, toolbar, sampai konten halaman di Metronic Laravel.

Tag:
- `base layout`
- `shared partials`
- `page sections`
- `reuse before create`
- `minimal custom CSS`
- `mobile-safe layout`

## Flow Render Halaman

Langkah/aturan:
- 1. Route memanggil view page (contoh: `pages.help.pemrograman.skema.layout`).
- 2. Seluruh halaman mewarisi Universal Master Shell dengan `@extends('layouts.index')`.
- 3. Master Shell (`layouts.index`) memuat seluruh `<head>`, meta SEO, bundle CSS, zero-flicker init, drawers, modals, dan script bundle global.
- 4. Master Shell secara dinamis menyertakan body layout wrapper yang sesuai dengan versi tema aktif via `@include(\App\Support\ThemeVersion::resolveView('layouts._wrapper', $activeThemeVersion))`.
  - Jika V1 (Demo 1): Memuat `layouts/_wrapper.blade.php` (Sidebar vertikal, `kt_app_wrapper`, `kt_app_main`).
  - Jika V2 (Demo 2): Memuat `themes/v2/layouts/_wrapper.blade.php` (Header horizontal topbar, `kt_wrapper`).
- 5. Section halaman (`styles`, `toolbar`, `content`, `scripts`) disuntik ke slot layout yang relevan.
- 6. Komponen Metronic JS mengaktivasi behavior menu, drawer, tooltip, dan widget.

## Struktur Folder Kunci

```text
resources/views/
├─ layouts/
│  ├─ index.blade.php             (Universal Master Shell)
│  ├─ _wrapper.blade.php          (Wrapper V1 - Demo 1 Sidebar)
│  └─ partials/
│     ├─ header/
│     ├─ sidebar/
│     ├─ _toolbar.blade.php       (Toolbar dinamis adaptif V1/V2)
│     └─ _footer.blade.php
├─ themes/
│  └─ v2/
│     ├─ layouts/
│     │  ├─ _wrapper.blade.php    (Wrapper V2 - Demo 2 Header)
│     │  ├─ _toolbar.blade.php    (Toolbar horizontal V2)
│     │  ├─ _page-title.blade.php (Breadcrumbs V2)
│     │  └─ header/
│     │     ├─ _base.blade.php
│     │     ├─ __menu.blade.php
│     │     └─ __topbar.blade.php
│     └─ partials/
│        ├─ menus/
│        └─ search/
├─ pages/
│  └─ ...
└─ partials/
   └─ menus/
```

## Pola Standar Halaman

> Catatan: Pola ini menjaga konsistensi breadcrumb, spacing, dan struktur visual di seluruh halaman.

## Peran Section di Layout

- `@section('styles')`: CSS khusus halaman.
- `@section('toolbar')`: breadcrumb, title konteks, action button.
- `@section('content')`: isi utama halaman.
- `@section('scripts')`: JS vendor/custom khusus halaman.

> Peringatan: Hindari menaruh script berat global di semua halaman jika hanya dipakai satu halaman.

## Checklist Saat Membuat Layout/Page Baru

- Pilih base layout yang tepat (umumnya `layouts.index`).
- Pastikan section `toolbar` dan `content` terdefinisi dengan jelas.
- Gunakan partial yang sudah ada sebelum membuat markup baru.
- Tambahkan styles/scripts hanya bila dibutuhkan halaman tersebut.
- Uji di desktop dan mobile untuk memastikan sidebar/header/drawer tetap sinkron.

## Anti-Pattern Layout

- Menaruh logika bisnis di view/layout.
- Mengcopy-paste blok header/sidebar alih-alih memanggil partial.
- Menggunakan CSS inline berlebihan untuk override cepat tanpa dokumentasi.
- Memuat semua JS plugin di global layout meski dipakai sedikit halaman.

## Standar Tim (Strict) Layout

Langkah/aturan:
- **Rule wajib:** halaman baru harus meng-extend `layouts.index` kecuali ada alasan arsitektural.
- **Rule wajib:** section `toolbar` dan `content` harus eksplisit.
- **Rule wajib:** reusable markup diekstrak ke partial/component setelah dipakai berulang.
- **Rule wajib:** perubahan layout global wajib diuji minimal 3 halaman berbeda.
