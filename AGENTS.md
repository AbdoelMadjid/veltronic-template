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

## 6. Modular Blade Partials & Operational Guidelines Policy
- **WAJIB** memisahkan komponen antarmuka yang kompleks (modal formulir, modal detail, tab panel, sidebar filter) ke dalam sub-folder `resources/views/pages/[kategori]/partials/`. File Blade utama hanya bertindak sebagai koordinator layout dengan pemanggilan `@include`.
- **WAJIB** menyertakan file petunjuk operasional (`[modul]-petunjuk.blade.php`) di setiap modul baru agar pengguna memahami fungsi modul, alur operasi, dan batasan hak akses peran.
- Detail lengkap diatur di `.agents/rules/module-partials-and-operational-guidelines.md`.

## 7. Standar Header Banner, Toolbar Petunjuk, & Tema Dinamis Modul
- **WAJIB** membuat kartu Header Banner terpisah (`card card-flush shadow-sm border-0 mb-6`) di atas konten halaman dengan judul modul, deskripsi, dan tombol aksi utama di sisi paling kanan.
- **WAJIB** menempatkan pemicu petunjuk operasional di toolbar atas (`@section('toolbar')`) menggunakan partial `layouts.partials._action-petunjuk-button`.
- **WAJIB** menggunakan token tema dinamis (`bg-body`, `text-gray-900`, `text-muted`, `border-gray-200`, `rounded-3`) tanpa warna hardcoded agar sempurna di Dark Mode & Light Mode.
- Detail lengkap dan contoh implementasi (Role, Permission, Akses Role, Akses User) diatur di `.agents/rules/module-header-banner-and-toolbar-standards.md`.


