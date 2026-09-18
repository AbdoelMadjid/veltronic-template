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

## 2. Kewajiban Komponen Petunjuk Operasional Menggunakan `<x-petunjuk-modal>`

1. **WAJIB MENGGUNAKAN KOMPONEN `<x-petunjuk-modal>`**:
   - Seluruh modal petunjuk operasional di setiap modul **WAJIB DIBANGUN MENGGUNAKAN BLADE COMPONENT `<x-petunjuk-modal>`** (`resources/views/components/petunjuk-modal.blade.php`) agar memiliki struktur visual, warna, icon, dan tipografi yang 100% seragam di seluruh aplikasi.
   - **DILARANG** menulis ulang struktur HTML modal mentah secara manual per halaman.

2. **STRUKTUR & PROPS STANDAR `<x-petunjuk-modal>`**:
   - `id`: ID unik modal (contoh: `kt_modal_[nama_modul]_petunjuk`)
   - `title`: Judul modal petunjuk (contoh: `Petunjuk Operasional: [Nama Modul]`)
   - `subtitle`: Penjelasan ringkas panduan modul
   - `box1Title` & `box1Icon`: Kotak 1 (Biru / Gambaran Umum, default icon: `ki-diamonds`)
   - `box2Title` & `box2Icon`: Kotak 2 (Netral / Hirarki & Komponen, default icon: `ki-element-11`)
   - `box3Title` & `box3Icon`: Kotak 3 (Primer / Alur Operasional, default icon: `ki-key`)
   - `box4Title` & `box4Icon`: Kotak 4 (Kuning Warning / Aturan & Proteksi Sistem, default icon: `ki-security-user`)

3. **CONTOH KODE BLADE STANDAR PETUNJUK OPERASIONAL**:
   ```blade
   <x-petunjuk-modal 
       id="kt_modal_[nama_modul]_petunjuk"
       title="Petunjuk Operasional: [Nama Modul]"
       subtitle="Panduan operasional lengkap pengelolaan fitur dan hak akses"
       box1Title="Gambaran Umum &[Nama Modul]"
       box1Icon="ki-diamonds"
       box2Title="Komponen & Struktur Antarmuka"
       box2Icon="ki-element-11"
       box3Title="Alur Operasional Penggunaan"
       box3Icon="ki-key"
       box4Title="Aturan, Proteksi & Keamanan Sistem"
       box4Icon="ki-security-user">

       <x-slot:box1>
           Penjelasan ringkas fungsi dan kegunaan modul ini bagi pengguna.
       </x-slot:box1>

       <x-slot:box2>
           <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
               <li class="d-flex align-items-start">
                   <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                   <div><strong>Komponen A:</strong> Penjelasan bagian A.</div>
               </li>
           </ul>
       </x-slot:box2>

       <x-slot:box3>
           <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
               <li><strong>Langkah 1:</strong> Cara melakukan aksi pertama.</li>
               <li><strong>Langkah 2:</strong> Cara melakukan aksi kedua.</li>
           </ol>
       </x-slot:box3>

       <x-slot:box4>
           <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
               <li class="d-flex align-items-start">
                   <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                   <div><strong>Catatan Keamanan:</strong> Hal penting yang harus diperhatikan.</div>
               </li>
           </ul>
       </x-slot:box4>
   </x-petunjuk-modal>
   ```

4. **PENEMPATAN & PEMICU PETUNJUK DI TOOLBAR**:
   - Pemicu modal petunjuk **WAJIB diletakkan di toolbar** (`@section('toolbar')`) menggunakan partial `layouts.partials._action-petunjuk-button`:
   ```blade
   @section('toolbar')
       @include('layouts.partials._toolbar', [
           'action' => view()->make('layouts.partials._action-petunjuk-button', [
               'targetModal' => '#kt_modal_[nama_modul]_petunjuk',
               'title' => 'Petunjuk Operasional [Nama Modul]',
           ]),
       ])
   @endsection
   ```

---

## 3. Checklist Kepatuhan Modul Baru
- [ ] Apakah sub-folder `partials/` sudah dibuat di dalam direktori view modul?
- [ ] Apakah komponen modal form, modal detail, dan tab panes sudah dipisahkan ke dalam `partials/`?
- [ ] Apakah file `[modul]-petunjuk.blade.php` sudah dibuat menggunakan komponen `<x-petunjuk-modal>` dengan 4 slot kotak terstruktur?
- [ ] Apakah pemicu petunjuk sudah ditempatkan di toolbar atas via `_action-petunjuk-button`?
- [ ] Apakah file Blade utama bersih dan hanya bertindak sebagai koordinator layout?
