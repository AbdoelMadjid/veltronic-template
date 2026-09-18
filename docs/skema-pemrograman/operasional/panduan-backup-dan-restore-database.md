# Panduan Operasional Backup & Restore Database

Panduan langkah demi langkah bagi administrator dalam membuat cadangan database secara instan, mengelola jadwal otomatis, dan melakukan pemulihan (*restore*) data.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Membuat Backup Instan
1. Masuk ke menu **App Support &rarr; Backup DB**.
2. Klik tombol **"Buat Backup Baru"** di header banner.
3. Tunggu hingga file terunduh/tersimpan di direktori `storage/app/backups/`.

## 2. Prosedur Restore Database
1. Pilih file arsip dari daftar tabel riwayat backup.
2. Klik tombol **"Restore"** dan lakukan konfirmasi persetujuan.
3. Seluruh data aktif akan diperbarui sesuai snapshot waktu pencadangan.

## 3. Konfigurasi Jadwal Otomatis
1. Klik tombol **"Pengaturan Auto-Backup"**.
2. Pilih frekuensi backup (harian/mingguan) dan batas retensi file lama.
3. Simpan pengaturan.
