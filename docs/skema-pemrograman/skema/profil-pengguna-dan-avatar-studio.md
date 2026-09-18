# Skema Profil Pengguna & Avatar Studio

Dokumen cetak biru teknis arsitektur 5-tab profil pengguna, manipulasi foto profil 2-Axis (Zoom 1x-5x & Pan X/Y), struktur JSON `user_settings`, dan sinkronisasi realtime topbar/lockscreen.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Konsep & Arsitektur Utama
- **5-Tab Profile Architecture**: Membagi antarmuka profil ke dalam tab Overview, Identitas Diri, Kata Sandi, Konfigurasi/Cover Studio, dan Riwayat Aktivitas.
- **Avatar Studio 2-Axis**: Memungkinkan kustomisasi crop, zoom hingga 5x, dan titik fokus foto profil secara visual dengan live pratinjau.
- **JSON Column `user_settings` (1-User-1-Row)**: Menyimpan konfigurasi preferensi, zoom avatar, dan custom background cover header dalam 1 baris record.
- **Realtime Sync**: Memperbarui avatar dan info profil di topbar navbar, header, dan session lock screen secara realtime tanpa reload layar.

## 2. Struktur File Terkait
- `app/Http/Controllers/Profil/ProfilPenggunaController.php`: Controller penanganan identitas, avatar, password, dan konfigurasi.
- `resources/views/pages/profil/profil-pengguna.blade.php`: Tampilan utama profil.
- `resources/views/pages/profil/partials/`: Subfolder modular Blade tab dan modal studio.
