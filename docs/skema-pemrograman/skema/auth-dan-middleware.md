# Skema Autentikasi, Middleware & Spatie Role-Permission

Dokumen cetak biru arsitektur keamanan: autentikasi pengguna, hierarki Spatie Role & Permission, matriks akses 2D, pembedaan izin langsung vs terwarisi, serta sistem reward login & lock screen session.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Konsep & Arsitektur Utama
- **Spatie Role & Permission**: Kontrol akses granular berbasis peran (Multi-Role) dan izin spesifik per modul.
- **Akses Role (2D Matrix)**: Visualisasi kisi interaktif antara Role dan Permission dengan toggle sinkronisasi realtime.
- **Akses User (Direct vs Inherited)**: Membedakan izin bawaan peran (*Inherited*) dengan izin khusus (*Direct Permission*).
- **Reward Poin Login & Lock Screen**: Pemberian 1 poin login setiap 24 jam dan pengelolaan sesi kunci layar instan.

## 2. Struktur File Terkait
- `app/Http/Controllers/UserManagement/`: Controller User, Role, Permission, RoleAccess, UserAccess, dan DataLogin.
- `routes/admin.php`: Rute grup `usermanagement.*` dengan middleware proteksi peran.
- `database/seeders/RoleSeeder.php` & `UserSeeder.php`: Seeder peran dan akun default.
