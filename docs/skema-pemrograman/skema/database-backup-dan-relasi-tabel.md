# Skema Backup Database & Relasi Tabel Dinamis

Dokumen arsitektur teknis sistem pencadangan basis data ganda (`mysqldump` & pure PHP), analisis ketergantungan relasi tabel, dan prosedur pemulihan aman.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Konsep & Arsitektur Utama
- **Dual-Engine Backup**: Eksekusi otomatis via `mysqldump` CLI jika tersedia, dengan fallback aman ke pure PHP generator jika berada di lingkungan restricted shared hosting.
- **Relational Inspector**: Menginspeksi skema `information_schema` untuk memetakan ketergantungan tabel (*Foreign Keys*) dan mengurutkan ekspor/impor secara topologis.
- **ACID Transactional Restore**: Menjaga integritas data saat pemulihan database dengan nonaktif sementara pemeriksaan foreign key (`SET FOREIGN_KEY_CHECKS=0`).
- **Retensi Otomatis**: Pengaturan jadwal backup harian/mingguan dan pembersihan otomatis file lama tersimpan di `app_settings`.

## 2. Struktur File Terkait
- `app/Http/Controllers/AppSupport/BackupDbController.php`: Controller utama backup, restore, download, dan relasi tabel.
- `resources/views/pages/appsupport/backup-db.blade.php`: Halaman antarmuka manajemen database backup.
- `storage/app/backups/`: Direktori penyimpanan file arsip `.sql` dan `.sql.gz`.
