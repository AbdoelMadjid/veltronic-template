# Panduan Pengelolaan Audit Log & Investigasi Error Backend

Panduan langkah demi langkah bagi administrator dan pengembang dalam memantau jejak aktivitas sistem, menganalisis exception backend, dan memanfaatkan payload diagnostik.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Memantau Log Sistem
1. Masuk ke menu **App Support &rarr; Fitur & Setting &rarr; Tab Log Aktivitas Sistem**.
2. Pantau metrik ringkasan pada 6 kartu statistik atas.
3. Gunakan filter **Modul** atau **Level** untuk mempersempit daftar aktivitas.

## 2. Investigasi Error Teknis
1. Filter log dengan memilih `Level = Error`.
2. Klik tombol **"Lihat Detail"** (ikon `ki-eye`) pada baris log yang ingin diperiksa.
3. Analisis nama file, baris kode (`line`), dan stack trace error untuk perbaikan bug.

## 3. Menambahkan Logging di Modul Kustom
```php
use App\Models\UserManagement\UserLog;

UserLog::record('modul_anda', 'menu_anda', 'action_name', 'Deskripsi ringkas aktivitas', [
    'key' => 'value'
], 'info');
```
