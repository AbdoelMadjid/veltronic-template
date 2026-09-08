# Aturan Standar Aset & Styling Modul (Wajib Style Template Bawaan)

## Scope & Trigger
Aturan ini **WAJIB** dipatuhi dalam pembuatan halaman baru, perombakan antarmuka (UI), maupun penambahan fitur di seluruh modul proyek (`appsupport/*`, `masterdata/*`, `apps/*`, `system/*`, dan semua modul lainnya).

---

## 1. Prinsip Utama: Wajib Pakai Style Template Bawaan (NO Custom CSS Per Halaman)

Proyek ini dibangun di atas template **Metronic 8.3.2 (Laravel 12)** yang sudah memiliki ribuan utility class, variasi card, form layout, tabel, dan komponen siap pakai yang sangat lengkap.

1. **DILARANG MEMBUAT FILE CSS KUSTOM PER HALAMAN / PER MODUL**:
   - Pengembang **TIDAK BOLEH** membuat file CSS baru (misal: `public/assets/css/[modul]/[halaman].css`) hanya untuk mengatur margin, border, kartu, badge, animasi, atau tombol.
   - Membuat CSS khusus tiap halaman sangat merepotkan perawatan (*maintenance overhead*) dan merusak konsistensi desain antar modul.

2. **GUNAKAN 100% UTILITY CLASS & KOMPONEN BAWAAN TEMPLATE**:
   - Selalu susun tampilan dengan class bawaan Metronic/Bootstrap:
     - **Kartu/Kontainer**: `card mb-5 mb-xl-10`, `card-flush`, `card-bordered`, `card-header`, `card-body p-9`, `card-title`, `card-toolbar`.
     - **Formulir**: `row mb-6`, `col-lg-4 col-form-label fw-semibold fs-6`, `col-lg-8 fv-row`, `form-control form-control-solid`, `form-select form-select-solid`, `form-check form-switch form-check-custom form-check-solid`.
     - **Tombol**: `btn btn-primary`, `btn btn-light`, `btn btn-sm btn-light-success`, `btn btn-sm btn-light-danger`.
     - **Tipografi & Spasi**: `fw-bolder`, `fw-bold`, `text-gray-900`, `text-muted`, `fs-2`, `fs-4`, `fs-7`, `p-5`, `gap-3`, `border-bottom`.
   - **Referensi Utama**: Cek halaman **`profil-pengguna`** (`resources/views/pages/profil/profil-pengguna.blade.php` dan partials-nya) sebagai acuan standar tata letak bersih dan konsisten tanpa variasi berlebihan.

3. **FILE JAVASCRIPT MODULAR HANYA UNTUK LOGIKA**:
   - Pemisahan modular hanya berlaku untuk **file JS** (`public/assets/js/[modul]/[halaman].js`) untuk menangani event listener, AJAX backend, modal, DataTables, atau interaksi DOM murni.

---

## 2. Struktur Blade View Standar (Bersih Tanpa Custom CSS)

```blade
@extends('layouts.index')

@section('title', 'Nama Modul')

@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1') Kategori Modul @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!-- Gunakan komponen card & grid standar template bawaan -->
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Script logika modul jika ada -->
    <script src="{{ asset('assets/js/[modul]/[halaman].js') }}"></script>
@endsection
```

---

## 3. Katalog Widget & Referensi Desain (Route Demo)

Ketika membuat modul baru yang membutuhkan berbagai jenis widget (grafik statistik, tabel ringkasan, list feed, engage cards, callout, dll.):
1. **CEK ROUTE DEMO & PARTIALS BAWAAN**:
   - Proyek ini menyediakan ratusan contoh widget siap pakai di:
     - View Demo: `resources/views/pages/demo/**` (misal: `distribusi-widget.blade.php`, demo 51-60, dsb.)
     - Widget Partials: `resources/views/partials/widgets/**` (`charts`, `lists`, `mixed`, `statistics`, `tables`, `engage`, dll.)
2. **POLA PENGGUNAAN**:
   - Cari contoh widget yang sesuai dari route demo/partials.
   - Salin atau *include* komponen widget tersebut langsung ke dalam modul tanpa perlu mendesain atau membuat CSS baru dari awal.
   - Pastikan variabel data dihubungkan ke backend controller secara rapi.

---

## 4. Checklist Kepatuhan Modul
- [ ] Apakah halaman dibangun murni dengan class bawaan Metronic/Bootstrap tanpa membuat file CSS kustom?
- [ ] Apakah untuk kebutuhan widget statistik/grafik/tabel sudah merujuk pada katalog widget bawaan di `resources/views/pages/demo/**` dan `resources/views/partials/widgets/**`?
- [ ] Apakah tidak ada tag `<style>` inline yang dibuat-buat di dalam file Blade?
- [ ] Apakah file JS modular hanya berisi logika dan interaksi fungsional?
