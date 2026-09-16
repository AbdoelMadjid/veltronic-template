# Aturan Standar Pemisahan Partials Blade & Petunjuk Operasional Modul

Aturan ini **WAJIB DIPATUHI SECARA KONSISTEN** pada seluruh pembuatan modul baru, perombakan antarmuka, dan penambahan fitur di seluruh sistem.

---

## 1. Prinsip Utama: Modular Blade Partials (`partials/`)

Untuk menjaga kerapian arsitektur kode, memudahkan pemeliharaan (*maintainability*), dan mencegah penumpukan baris kode ribuan baris dalam satu file Blade:

1. **WAJIB MEMISAHKAN KOMPONEN BESAR KE FOLDER `partials/`**:
   - Setiap halaman modul (misal `resources/views/pages/[kategori]/[modul].blade.php`) **DILARANG** menumpuk seluruh kode modal, tab pane, sidebar filter, dan komponen instruksi dalam 1 file monolitik.
   - Buat sub-folder `partials/` di dalam direktori modul bersangkutan:
     `resources/views/pages/[kategori]/partials/`
2. **STRUKTUR PEMISAHAN KOMPONEN UMUM**:
   - `[modul]-petunjuk.blade.php`: Komponen petunjuk operasional / panduan modul.
   - `[modul]-filter-aside.blade.php`: Komponen filter samping / vertical search (jika ada).
   - `[modul]-cards-pane.blade.php`: Tab panel tampilan grid / kartu (jika ada).
   - `[modul]-table-pane.blade.php`: Tab panel tampilan tabel data.
   - `[modul]-form-modal.blade.php`: Modal formulir Tambah / Ubah data.
   - `[modul]-detail-modal.blade.php`: Modal tampilan rincian / detail data.
3. **FILE UTAMA HANYA SEBAGAI KOORDINATOR**:
   - File utama `[modul].blade.php` hanya bertugas mengatur tata letak grid dan memanggil komponen parsial menggunakan `@include('pages.[kategori].partials.[nama-partial]')`.

---

## 2. Kewajiban Komponen Petunjuk Operasional di Setiap Modul

1. **WAJIB ADA DI SETIAP MODUL**:
   - Setiap modul baru **WAJIB MEMILIKI KOMPONEN PETUNJUK OPERASIONAL** (`[modul]-petunjuk.blade.php`).
2. **KONTEN PETUNJUK OPERASIONAL**:
   - **Tujuan Modul**: Penjelasan singkat fungsi modul dalam sistem.
   - **Alur & Fitur Utama**: Cara menggunakan fitur pencarian, filter, tambah, ubah, dan hapus.
   - **Hak Akses & Batasan**: Penjelasan hak akses peran (*Role & Permission*) terkait modul.
   - **Keamanan Data**: Catatan penting mengenai privasi atau dampak aksi permanen (misal: Reset Password atau Hapus Data).
3. **STANDAR DESAIN PETUNJUK**:
   - Gunakan komponen bawaan Metronic/Bootstrap seperti Card `card-flush border-0 bg-light-primary` atau `bg-light-info` atau Accordion bersih.
   - **DILARANG** menggunakan ikon pada judul maupun sub-judul petunjuk (sesuai aturan [ui-icon-and-title-standards.md](file:///.agents/rules/ui-icon-and-title-standards.md)).

---

## 3. Checklist Kepatuhan Modul Baru
- [ ] Apakah sub-folder `partials/` sudah dibuat di dalam direktori view modul?
- [ ] Apakah komponen modal form, modal detail, dan tab panes sudah dipisahkan ke dalam `partials/`?
- [ ] Apakah komponen `[modul]-petunjuk.blade.php` sudah dibuat dan di-include di view utama?
- [ ] Apakah file Blade utama bersih dan mudah dibaca tanpa penumpukan ribuan baris?
