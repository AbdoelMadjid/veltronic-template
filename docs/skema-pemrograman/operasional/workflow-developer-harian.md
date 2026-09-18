# Workflow Developer Harian & Standar Operasi

Ritme kerja harian engineer: sinkronisasi branch, targeted verification, kebijakan Zero-Reload CRUD, standarisasi spinner tombol, preservasi logika anti-regresi, hingga Definition of Done.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Siklus Pengembangan Harian
1. **Start of Day**: `git pull origin main`, `composer install`, `php artisan optimize:clear`.
2. **Anti-Regresi**: Modifikasi kode tidak boleh merusak fungsionalitas fitur yang sudah berjalan sebelumnya.
3. **Zero-Reload CRUD**: Seluruh form dan tombol aksi wajib menggunakan AJAX + SweetAlert2/Toastr dengan preservasi tab.
4. **Button Loading Spinner**: Wajib menyematkan `data-kt-indicator="on"` dan `disabled = true` selama submit.
5. **Documentation & Changelog Sync**: Update `help/pemrograman/`, `CHANGELOG.md`, dan `help/log/changelog` sebelum commit rilis.
