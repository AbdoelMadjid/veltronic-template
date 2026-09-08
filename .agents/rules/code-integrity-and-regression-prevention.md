# Aturan Integritas Kode & Pencegahan Regresi (Anti Side-Effects)

## Scope & Trigger
Aturan ini **WAJIB** dipatuhi dalam setiap perubahan kode, refactoring, perbaikan bug, atau penambahan fitur baru di seluruh codebase proyek.

---

## 1. Prinsip Utama: Bebas Efek Samping (Zero Side-Effects)
Setiap perbaikan pada satu bagian masalah (**Masalah A**) **TIDAK BOLEH** merusak, mengubah perilaku yang sudah benar, atau mengacaukan bagian lain (**Bagian B**) dari sistem.

---

## 2. Aturan Perubahan Komponen Global / Shared
Komponen global meliputi:
- Template Layout (`resources/views/layouts/**`, `resources/views/partials/**`)
- File Helper Global (`app/Helpers/**`, `app/utils/**`)
- Routing Utama (`routes/web.php`, `routes/menu.php`)
- Middleware & Base Controller / Model

### Protokol Wajib Saat Menyentuh Komponen Global:
1. **Audit Caller & Dependensi**:
   - Lakukan pencarian (grep/search) untuk melihat bagaimana modul-modul lain (seperti `pages/*`, `apps/*`, `help/*`, dll.) menggunakan komponen/fungsi tersebut.
2. **Patuhi Standar Bawaan Tema / Sistem**:
   - Jangan mengubah ekspektasi data global hanya untuk memenuhi kebutuhan satu modul baru.
   - Jika modul baru membutuhkan perlakuan khusus, sediakan mekanisme modular (misal: parameter opsional, custom slot, atau override lokal) tanpa mengubah perilaku default halaman lain.
3. **Verifikasi Silang (Cross-Verification)**:
   - Selalu uji sampel halaman bawaan eksisting (misal: halaman `apps/*` atau `pages/*`) DAN halaman modul baru untuk memastikan keduanya tetap tampil dan berfungsi sesuai desain tanpa regresi.

---

## 3. Contoh Kasus & Pencegahannya

### A. Judul Halaman & Breadcrumb Toolbar (`_page-title.blade.php`)
- **Aturan**:
  - `<h1>` mengambil judul halaman aktif melalui `getPageTitle()` atau `@yield('title')`.
  - `@slot('li_1')`, `@slot('li_2')`, dst. HANYA berisi hirarki kategori induk (ancestor), **bukan** mengulang judul halaman aktif.
  - Jangan menambahkan judul halaman aktif ke akhir breadcrumb jika tema sudah merancangnya sebagai hirarki navigasi parent.

### B. Route Resolver & Status Menu Aktif (`_menu-item.blade.php`, `helper.php`)
- **Aturan**:
  - Penambahan dukungan route baru (misal: route resource `.index` atau dinamis seeder) harus berupa **ekstensi backward-compatible**.
  - Rute statis dari `config/sidebar/*` harus tetap terbaca dan aktif secara normal.

### C. Pemisahan Komponen Baru (Partials)
- **Aturan**:
  - File partial modular (modal, tab, petunjuk) disimpan di `resources/views/pages/{kategori}/partials/` dan wajib diabaikan dari auto-routing generator di `routes/menu.php`.

### D. Standar UI Bebas Ikon pada Judul & Sub Judul (`ui-icon-and-title-standards.md`)
- **Aturan**:
  - Judul utama (*page/banner header*), sub judul bagian (*section headers*), dan header grup form **DILARANG MENGGUNAKAN IKON** (baik langsung maupun dengan wadah kotak/bulat). Ikuti standar hierarki tipografi murni bawaan template.

### E. Standar Posisi & Tampilan Tombol Aksi Seksi (`ui-section-action-buttons-layout.md`)
- **Aturan**:
  - Tombol aksi pada setiap seksi/header wajib **selalu rata kanan** di semua resolusi layar (`ms-auto flex-shrink-0`).
  - Pada layar mobile / HP, tombol **hanya menampilkan ikon** (`<span class="d-none d-sm-inline">Label</span>`) dan tetap berada di posisi rata kanan.

### F. Standar Styling Modul Murni Template Bawaan (`modular-assets-separation.md`)
- **Aturan**:
  - Seluruh modul **WAJIB** dibangun menggunakan 100% utility class dan komponen bawaan Metronic (mengikuti acuan bersih seperti `profil-pengguna`).
  - **DILARANG** membuat file custom CSS baru per halaman/modul.

### G. Standar Notifikasi & Alert Template (`notification-standards.md`)
- **Aturan**:
  - Seluruh modul **WAJIB** menggunakan helper global `window.Notify` (`public/assets/js/custom/notification-helper.js`).
  - Notifikasi toast otomatis berada di pojok kanan atas (`toastr-top-right`).
  - Dialog SweetAlert2 wajib menggunakan `buttonsStyling: false` dan class Metronic (`btn btn-primary`, `btn btn-light`, `btn btn-danger`).
  - Dilarang membuat HTML container toast kustom sendiri per halaman.

---

## 4. Checklist Sebelum Menyelesaikan Tugas (Done Criteria)
Sebelum menyatakan suatu perbaikan selesai:
- [ ] Apakah ada komponen global/shared yang diubah?
- [ ] Jika ada, apakah halaman eksisting lainnya sudah dicek dan dipastikan tidak terpengaruh?
- [ ] Apakah modul baru sudah diuji dan berjalan normal?
- [ ] Apakah cache view / route sudah dibersihkan jika diperlukan (`php artisan view:clear`)?
