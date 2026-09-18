# Skema Audit Log & Perekaman Error Backend

Dokumen cetak biru arsitektur teknis sistem audit trail terpusat (`users_logs`), penangkapan exception backend otomatis, dan visualisasi status log realtime.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Konsep & Arsitektur Utama
- **Tabel Terindeks `users_logs`**: Menyimpan riwayat aktivitas dengan kolom terindeks `module`, `menu`, `action`, `level`, `user_id`, dan `payload` JSON.
- **Helper `UserLog::record()`**: Perekaman log satu baris dari controller manapun dengan level `info`, `warning`, `error`, dan `critical`.
- **Global Error Catcher (`bootstrap/app.php`)**: Menangkap seluruh unhandled exception backend dan mencatat pesan error, file, baris, dan metadata request tanpa crash.
- **Isolasi Log**: Admin dapat memantau seluruh log sistem via `appsupport/app-fiturs`, sedangkan user biasa hanya melihat log aktivitas profil pribadinya.

## 2. Struktur File Terkait
- `app/Models/UserManagement/UserLog.php`: Model Eloquent dan helper `record()`.
- `database/migrations/xxxx_create_users_logs_table.php`: Migration tabel log.
- `app/Http/Controllers/AppSupport/AppFiturController.php`: Endpoint data AJAX dan statistik log.
- `resources/views/pages/appsupport/partials/app-fiturs/tabs/_logs.blade.php`: Antarmuka tab log sistem.

## 3. Contoh Penggunaan
```php
use App\Models\UserManagement\UserLog;

UserLog::record(
    module: 'usermanagement',
    menu: 'users',
    action: 'delete',
    description: 'Menghapus data user: ' . $user->name,
    payload: ['user_id' => $user->id, 'email' => $user->email],
    level: 'warning'
);
```
