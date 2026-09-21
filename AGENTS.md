# Antigravity Agent Guidelines & Rules

## 1. Efisiensi & Larangan Full Test Suite (Zero Full-Suite Blocking)
- **DILARANG** menjalankan pengujian menyeluruh/full test suite (`phpunit`, `phpunit tests/Feature`, dll.) yang memakan waktu lama saat menangani permintaan pengguna.
- Proses verifikasi dilakukan secara cepat, fokus, dan hanya pada titik perubahan spesifik (targeted test) jika benar-benar diperlukan.
- Jangan membuat pengguna menunggu lama hanya untuk menjalankan pengujian yang tidak esensial.

## 2. Preservasi Logika Eksisting (Anti-Regresi & Non-Destructive)
- Setiap kali menambahkan atau memodifikasi **Logika C**, pastikan **Logika A & B** yang sebelumnya sudah berfungsi dengan baik **TIDAK BOLEH RUSAK** atau berubah perilakunya.
- Modifikasi kode harus terisolasi, modular, dan menjaga kompatibilitas ke belakang (backward compatibility).
- Jangan merombak arsitektur atau pola yang sudah berjalan tanpa instruksi eksplisit dari pengguna.

## 3. Eksekusi Cepat, Ramping, & Tepat Sasaran
- Fokus langsung pada file dan baris kode yang diminta pengguna tanpa refactoring liar di luar ruang lingkup.
- Gunakan komponen bawaan Metronic/Veltronic tanpa membuat custom CSS berlebih per halaman.
- Pastikan seluruh aturan di `.agents/rules/` dipatuhi secara konsisten.

## 4. Zero-Reload Realtime CRUD Policy
- **DILARANG** me-reload halaman (`window.location.reload()` atau form submit refresh) pada setiap aksi CRUD, simpan identitas, ganti password, upload berkas/foto/KTP, toggle fitur, dan pengaturan konfigurasi.
- Saat proses berhasil, tampilkan notifikasi (SweetAlert2/Toastr), dan setelah notifikasi ditutup/dikonfirmasi maka seluruh data di UI **wajib berubah secara realtime**.
- Tab yang sedang aktif harus **tetap berada di tab yang sama** tanpa mereset posisi scroll atau navigasi pengguna.
- Detail lengkap diatur di `.agents/rules/crud-zero-reload-realtime-standards.md`.

## 5. Standar Indikator Loading Spinner Tombol (Button Loading Policy)
- Setiap tombol submit / eksekusi aksi (CRUD, autentikasi login/register, simpan data, modal, upload, lock screen, dll.) **WAJIB** menampilkan animasi spinner proses via `data-kt-indicator="on"` dan dinonaktifkan (`disabled = true`) selama proses berjalan untuk mencegah double-click.
- Tombol harus memiliki struktur standar `.indicator-label` dan `.indicator-progress`.
- Setelah proses selesai (berhasil / gagal), status tombol **wajib dipulihkan** ke kondisi normal.
- Detail lengkap diatur di `.agents/rules/button-loading-spinner-standards.md`.

## 6. Modular Blade Partials & Operational Guidelines Policy (x-petunjuk-modal)
- **WAJIB** memisahkan komponen antarmuka yang kompleks (modal formulir, modal detail, tab panel, sidebar filter) ke dalam sub-folder `resources/views/pages/[kategori]/partials/`. File Blade utama hanya bertindak sebagai koordinator layout dengan pemanggilan `@include`.
- **WAJIB** menyertakan file petunjuk operasional (`[modul]-petunjuk.blade.php`) di setiap modul baru yang **WAJIB DIBANGUN MENGGUNAKAN KOMPONEN `<x-petunjuk-modal>`** dengan 4 slot terstruktur (`box1`: Gambaran Umum, `box2`: Hirarki/Komponen, `box3`: Alur Operasional, `box4`: Aturan/Proteksi Sistem).
- Detail lengkap diatur di `.agents/rules/module-partials-and-operational-guidelines.md`.

## 7. Standar Header Banner, Toolbar Petunjuk, & Tema Dinamis Modul
- **WAJIB** membuat kartu Header Banner terpisah (`card card-flush shadow-sm border-0 mb-6`) di atas konten halaman dengan judul modul, deskripsi, dan tombol aksi utama di sisi paling kanan.
- **WAJIB** menempatkan pemicu petunjuk operasional di toolbar atas (`@section('toolbar')`) menggunakan partial `layouts.partials._action-petunjuk-button`.
- **WAJIB** menggunakan token tema dinamis (`bg-body`, `text-gray-900`, `text-muted`, `border-gray-200`, `rounded-3`) tanpa warna hardcoded agar sempurna di Dark Mode & Light Mode.
- Detail lengkap dan contoh implementasi (Role, Permission, Akses Role, Akses User) diatur di `.agents/rules/module-header-banner-and-toolbar-standards.md`.

## 8. Standar Wajib Sinkronisasi Ganda Changelog (Dual Changelog Sync Policy)
- **WAJIB** memperbarui **KEDUA** berkas changelog secara bersamaan setiap kali melakukan push / membuat tag baru:
  1. `CHANGELOG.md` (Catatan repositori & rilis Markdown).
  2. `resources/views/pages/help/log/changelog.blade.php` (Tampilan UI web `/help/log/changelog` lengkap dengan badge *Versi Saat Ini*, badge *Latest Release*, deskripsi, dan rincian perubahan).
- **DILARANG** melakukan push atau release tag hanya dengan memperbarui salah satu berkas saja.
- Detail lengkap diatur di `.agents/rules/git-versioning-and-release.md`.

## 9. Standar Responsif Tab Modul Mobile (Icon-Only & Hover Tooltips)
- Pada seluruh navigasi tab modul (`nav-tabs`, `nav-line-tabs`, `nav-pills`), saat dibuka pada perangkat **mobile / HP (`< md`)**, teks nama tab **WAJIB DISEMBUNYIKAN** (`d-none d-md-inline`) sehingga **hanya ikon saja yang tampil** dengan ukuran proporsional (`fs-2 fs-md-4` atau `fs-3 fs-md-4`) dan margin adaptif (`me-0 me-md-2`).
- Setiap tab **WAJIB MEMILIKI TOOLTIP HOVER** (`data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nama Tab"`) agar nama tab tetap terbaca saat disentuh/hover.
- Container tab wajib menggunakan `overflow-auto flex-nowrap` agar rapi dan tidak merusak layout layar sempit.
- Detail lengkap diatur di `.agents/rules/responsive-module-tabs-standards.md`.

## 10. Standar Responsif Modal Dialog (Header, Section Content, Footer Buttons, & Browser-Level Scroll)
- **Header Modal Mobile (`< sm`)**: Menggunakan susunan 3-baris rata tengah (Baris 1: Ikon lingkaran sempurna 60px `rounded-circle`, Baris 2: Judul Modal, Baris 3: Deskripsi Modal). Tombol tutup (`x`) ditempatkan secara absolut di pojok kanan atas (`position-absolute top-0 end-0 m-3 m-sm-4`).
- **Judul Konten / Section Modal**: Menggunakan header elegan responsif (`d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 mb-4 pb-3 border-bottom`) dengan simbol ikon 35px, judul + sub-keterangan, dan badge status/indikator kapsul.
- **Tombol Footer Modal**:
  - Jika $\le 2$ tombol (standar Batal & Simpan / Tutup): **Teks tombol TETAP UTUH (Lengkap teks + ikon)** agar informatif bagi pengguna.
  - Jika $\ge 3$ tombol: Teks label tombol pada mobile disembunyikan (`d-none d-sm-inline`) sehingga hanya ikon yang tampil untuk menghemat ruang.
  - Setiap tombol **WAJIB MEMILIKI TOOLTIP HOVER** (`data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="..."`).
  - Posisi tombol footer **WAJIB CENTER-ALIGNED DI MOBILE** dan rata kanan di desktop (`justify-content-center justify-content-sm-end gap-2`).
- **Bebas Scroll Internal Modal (Browser-Level Scroll Policy)**: **DILARANG** menggunakan `modal-dialog-scrollable`, `scroll-y`, atau scrollbar bertumpuk di dalam modal. Modal harus memanjang secara alami mengikuti konten dan di-scroll langsung oleh browser/layar utama dari header hingga footer.
- Detail lengkap diatur di `.agents/rules/responsive-modal-buttons-standards.md`.

## 11. Standar Navigasi Halaman & Footer Tabel / Kartu Mobile (Responsive Pagination Standards)
- **Bebas Scroll Horizontal pada Footer**: Area scroll horizontal (`table-responsive`) **HANYA BOLEH MEMBUNGKUS BARIS DATA TABEL**. Footer, *length menu*, dan *pagination* wajib berada di luar area scroll tabel agar tidak ikut terpotong saat digeser.
- **Struktur 3-Baris Rata Tengah di Mobile (`< 768px`)**:
  - **Baris 1**: `Tampilkan [10 v] data` (`.dataTables_length`) — mandiri di baris atas, rata tengah.
  - **Baris 2**: `Menampilkan X sampai Y dari Z data` (`.dataTables_info`) — utuh 1 baris horizontal (`white-space: nowrap !important;`), rata tengah tanpa pemecahan kata vertikal.
  - **Baris 3**: Navigasi Tombol Halaman (`.dataTables_paginate`) — rata tengah.
- **Pola Angka Halaman Ringkas (Compact Numbers Pattern)**:
  - Jumlah tombol dibatasi **maksimal 5 angka**: Halaman 1 (`1, 2, Last`), Halaman 2 (`1, 2, 3, Last`), Halaman 3 (`1, 2, 3, 4, Last`), Halaman Tengah (`1, n-1, n, n+1, Last`), Halaman Terakhir (`1, Last-1, Last`).
  - Pola pada Yajra DataTables (`veltronic_compact` pager) **WAJIB SAMA PERSIS** dengan pola Laravel Blade (`pagination::bootstrap-5`).
- Detail lengkap diatur di `.agents/rules/responsive-pagination-standards.md`.

## 12. Standar Struktur Kartu (Card Structure) & Responsif Mobile
- **Struktur Lengkap Kartu Modul**: Setiap kartu pengaturan/konten wajib memiliki batas visual yang tegas (`card shadow-sm border border-gray-200 h-100 d-flex flex-column`), pembatas header (`border-bottom border-gray-200 py-5 py-md-0`), body (`py-6 px-4 px-md-6 flex-grow-1`), dan footer (*jika diperlukan*) berlatar kontras lembut (`card-footer py-4 px-4 px-md-6 mt-auto border-top border-gray-200 bg-light bg-opacity-50`).
- **Judul Header Bersih (No Icon Box)**: Judul pada header kartu **DILARANG** menggunakan kotak simbol ikon di samping teks judul. Gunakan tipografi murni (`h3.fw-bolder.text-gray-900.fs-4` dan `span.text-muted.fs-7`) dengan badge/toolbar di sisi kanan.
- **Rata Tengah di Mode Mobile**: Pada layar HP (`< md` atau `< sm`), teks judul header, toolbar badge/tombol, dan footer **WAJIB RATA TENGAH** (`text-center` / `justify-content-center`) dan mengalir vertikal rapi.
- **Standar Tombol Solid Penuh (Full Button)**: Tombol aksi pada kartu di mode mobile **WAJIB MENAMPILKAN TEKS LENGKAP** (Full Button, bukan icon-only yang samar) dengan warna solid kontras tinggi (`btn-primary`, `btn-success`, `btn-danger`) dan ikon putih (`text-white`).
- Detail lengkap diatur di `.agents/rules/card-structure-and-responsive-standards.md`.




