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

---

## 4. Checklist Sebelum Menyelesaikan Tugas (Done Criteria)
Sebelum menyatakan suatu perbaikan selesai:
- [ ] Apakah ada komponen global/shared yang diubah?
- [ ] Jika ada, apakah halaman eksisting lainnya sudah dicek dan dipastikan tidak terpengaruh?
- [ ] Apakah modul baru sudah diuji dan berjalan normal?
- [ ] Apakah cache view / route sudah dibersihkan jika diperlukan (`php artisan view:clear`)?
