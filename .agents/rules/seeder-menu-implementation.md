# Aturan Standar Implementasi Menu Seeder (Admin MVC)

## Scope & Trigger
Aturan ini **WAJIB** diikuti setiap kali membuat atau mengimplementasikan menu / sub-modul yang didefinisikan melalui seeder (`MenuSeeder` / `config/menu_seeder/*`).

---

## Konvensi Penamaan & Struktur File

Sebagai acuan standar, gunakan contoh route `appsupport/app-profil` (pola umum `{kategori}/{nama-modul}`):

### 1. View
- **Path**: `resources/views/admin/{kategori}/{nama-modul}.blade.php`
- **Contoh**: `resources/views/admin/appsupport/app-profil.blade.php`
- **View Key**: `admin.appsupport.app-profil`

### 2. Controller
- **Path**: `app/Http/Controllers/Admin/{Kategori}/{NamaModul}Controller.php`
- **Namespace**: `App\Http\Controllers\Admin\{Kategori}`
- **Nama Class**: `{NamaModul}Controller` (PascalCase)
- **Contoh**: `app/Http/Controllers/Admin/Appsupport/AppProfilController.php`

### 3. Form Request (Validasi)
- **Path**: `app/Http/Requests/Admin/{Kategori}/{NamaModul}Request.php`
- **Namespace**: `App\Http\Requests\Admin\{Kategori}`
- **Nama Class**: `{NamaModul}Request` (PascalCase)
- **Contoh**: `app/Http/Requests/Admin/Appsupport/AppProfilRequest.php`

### 4. Model Eloquent
- **Path**: `app/Models/Admin/{Kategori}/{NamaModul}.php`
- **Namespace**: `App\Models\Admin\{Kategori}`
- **Nama Class**: `{NamaModul}` (PascalCase)
- **Contoh**: `app/Models/Admin/Appsupport/AppProfil.php`

### 5. Routing
- **File**: `routes/admin.php`
- Dikelompokkan dengan middleware `['auth']` (atau permission terkait).
- File `routes/admin.php` dimuat di `routes/web.php`:
  ```php
  require __DIR__ . '/admin.php';
  ```
- **Pola Definisi Route**:
  ```php
  use App\Http\Controllers\Admin\Appsupport\AppProfilController;

  Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
      Route::prefix('appsupport')->name('appsupport.')->group(function () {
          Route::resource('app-profil', AppProfilController::class);
      });
  });
  ```

---

## Checklist Eksekusi Implementasi Modul Baru
Setiap kali mengimplementasikan menu seeder:
1. Pastikan menu terdaftar di `config/menu_seeder/*` atau seeder terkait.
2. Buat Model di `app/Models/Admin/{Kategori}/{NamaModul}.php`.
3. Buat Form Request di `app/Http/Requests/Admin/{Kategori}/{NamaModul}Request.php`.
4. Buat Controller di `app/Http/Controllers/Admin/{Kategori}/{NamaModul}Controller.php`.
5. Buat View Blade di `resources/views/admin/{kategori}/{nama-modul}.blade.php`.
6. Daftarkan Route di `routes/admin.php`.
