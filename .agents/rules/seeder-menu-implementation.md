# Aturan Standar Implementasi Menu Seeder (MVC)

## Scope & Trigger
Aturan ini **WAJIB** diikuti setiap kali membuat atau mengimplementasikan modul MVC untuk menu / sub-modul yang didefinisikan melalui seeder (`MenuSeeder` / `config/menu_seeder/*`).

---

## Konvensi Penamaan & Struktur File

Sebagai acuan standar, gunakan contoh modul `AppSupport` dengan menu `appsupport.app-profil` (pola umum `{kategori}.{nama-modul}` atau URL `/{kategori}/{nama-modul}`):

### 1. View Blade
- **Path**: `resources/views/pages/{kategori}/{nama-modul}.blade.php`
- **Contoh**: `resources/views/pages/appsupport/app-profil.blade.php`
- **View Key**: `pages.appsupport.app-profil`

### 2. Controller
- **Path**: `app/Http/Controllers/{Kategori}/{NamaModul}Controller.php`
- **Namespace**: `App\Http\Controllers\{Kategori}`
- **Nama Class**: `{NamaModul}Controller` (PascalCase)
- **Contoh**: `app/Http/Controllers/AppSupport/AppProfilController.php`

### 3. Form Request (Validasi)
- **Path**: `app/Http/Requests/{Kategori}/{NamaModul}Request.php`
- **Namespace**: `App\Http\Requests\{Kategori}`
- **Nama Class**: `{NamaModul}Request` (PascalCase)
- **Contoh**: `app/Http/Requests/AppSupport/AppProfilRequest.php`

### 4. Model Eloquent
- **Path**: `app/Models/{Kategori}/{NamaModul}.php`
- **Namespace**: `App\Models\{Kategori}`
- **Nama Class**: `{NamaModul}` (PascalCase)
- **Contoh**: `app/Models/AppSupport/AppProfil.php`

### 5. Routing
- Route **langsung sesuai dengan route name dan URL path yang didefinisikan di seeder**.
- Route didaftarkan di `routes/web.php` di dalam middleware `['auth']` (dan middleware permission terkait jika ada).
- **Contoh Definisi Route**:
  ```php
  use App\Http\Controllers\AppSupport\AppProfilController;

  Route::middleware(['auth'])->group(function () {
      Route::prefix('appsupport')->name('appsupport.')->group(function () {
          Route::resource('app-profil', AppProfilController::class);
      });
  });
  ```

---

## Checklist Eksekusi Implementasi Modul Baru
Setiap kali mengimplementasikan menu seeder:
1. Pastikan menu terdaftar di `config/menu_seeder/*` atau seeder terkait.
2. Buat Model di `app/Models/{Kategori}/{NamaModul}.php` (contoh: `app/Models/AppSupport/AppProfil.php`).
3. Buat Form Request di `app/Http/Requests/{Kategori}/{NamaModul}Request.php` (contoh: `app/Http/Requests/AppSupport/AppProfilRequest.php`).
4. Buat Controller di `app/Http/Controllers/{Kategori}/{NamaModul}Controller.php` (contoh: `app/Http/Controllers/AppSupport/AppProfilController.php`).
5. Buat View Blade di `resources/views/pages/{kategori}/{nama-modul}.blade.php` (contoh: `resources/views/pages/appsupport/app-profil.blade.php`).
6. Daftarkan Route langsung di `routes/web.php` sesuai route name seeder (`{kategori}.{nama-modul}`).
