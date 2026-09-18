# Panduan Operasional & Kustomisasi Keyboard Shortcuts

Panduan langkah demi langkah untuk mengelola pintasan keyboard via antarmuka admin, mendaftarkan shortcut kustom baru, menghubungkan fungsi JavaScript, serta mengatur hak akses peran.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Manajemen Pintasan via Admin
1. Buka menu **App Support &rarr; Fitur & Setting &rarr; Tab Keyboard Shortcuts**.
2. Gunakan panel navigasi 2-kolom untuk memfilter kategori shortcut.
3. Klik switch toggle status untuk mengaktifkan / menonaktifkan hotkey secara realtime (Zero-Reload).
4. Gunakan tombol **"Tambah Shortcut"** atau ikon edit untuk mengubah konfigurasi kombinasi key.

## 2. Menambahkan Handler Aksi Baru di JavaScript
1. **Langkah 1**: Buat entri shortcut baru di database (via UI atau seeder) dengan menentukan `kode_aksi` unik (misal: `cetak_laporan_pdf`).
2. **Langkah 2**: Di file JavaScript modul Anda, daftarkan fungsi penangan:
   ```javascript
   document.addEventListener('DOMContentLoaded', function() {
       if (window.VeltronicShortcuts) {
           window.VeltronicShortcuts.registerActionHandler('cetak_laporan_pdf', function() {
               $('#btn_cetak_pdf').trigger('click');
           });
       }
   });
   ```

## 3. Menjalankan Seeder Pintasan Bawaan
Untuk menginisialisasi atau mereset daftar pintasan default:
```bash
php artisan db:seed --class=AppShortcutSeeder
```

## 4. Tips & Best Practice
- Selalu gunakan kombinasi berawalan `Ctrl + Alt + [Karakter]`.
- Pastikan kursor pengguna tidak sedang aktif di dalam `<input>` atau `<textarea>` saat menguji shortcut.
- Periksa konsol browser (`F12`) untuk memastikan event dan kode aksi terpanggil dengan benar.
