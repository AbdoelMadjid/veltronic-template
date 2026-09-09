# Panduan Page Title & Hierarchical Breadcrumb

URL aplikasi: `/help/pemrograman/operasional/panduan-page-title-dan-breadcrumbs`

[⬅ Kembali ke README Docs](../README.md)

---

## 1. Standar Baru Membuat View Halaman

Saat membuat halaman Blade baru di `resources/views/pages/` atau modul database:

1. **Cukup Buat Template Minimal:** Anda **tidak perlu lagi** menyertakan `@section('toolbar')` dan `@slot('li_1')`.
2. Gunakan template standar berikut:
   ```blade
   @extends('layouts.index')

   @section('content')
       <div class="card">
           <div class="card-header">
               <h3 class="card-title">Data Modul</h3>
           </div>
           <div class="card-body">
               <!-- Konten Modul -->
           </div>
       </div>
   @endsection
   ```
3. Sistem akan secara otomatis mendeteksi route aktif dan merender Judul Halaman serta Breadcrumb hierarkis di bagian atas template.

---

## 2. Mendaftarkan Menu di `config/menu_seeder.php`

Agar menu dikenali hierarki dan translasi dua bahasanya, daftarkan pada kategori yang sesuai:

```php
'categories' => [
    [
        'title'     => 'Master Data',
        'title_key' => 'md_masterdata', // Kunci translasi di lang/*/menu.php
        'menus'     => [
            [
                'name'      => 'App Support',
                'title_key' => 'md_app_support',
                'url'       => 'appsupport/menu',
                'children'  => [
                    [
                        'name'      => 'Menu',
                        'title_key' => 'md_menu',
                        'url'       => 'appsupport/menu',
                    ],
                ],
            ],
        ],
    ],
],
```

---

## 3. Kustomisasi Judul & Breadcrumb Manual (Opsional)

- **Override Judul Halaman:**
  ```blade
  @extends('layouts.index')

  @section('title', 'Judul Kustom Halaman')

  @section('content')
      ...
  @endsection
  ```
- **Override Breadcrumb:**
  ```blade
  @section('toolbar')
      @component('layouts.partials._toolbar')
          @slot('li_1')
              Kategori Kustom
          @endslot
          @slot('li_2')
              Sub Kategori Kustom
          @endslot
      @endcomponent
  @endsection
  ```
  *(Catatan: Jangan tulis lagi judul halaman di slot terakhir).*
