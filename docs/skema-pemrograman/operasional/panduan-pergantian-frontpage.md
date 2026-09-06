# Panduan Pergantian & Penambahan Frontpage

Panduan langkah demi langkah untuk memilih frontpage aktif saat runtime, mengatur default frontpage via environment, dan menambahkan template frontpage baru.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Memilih Frontpage Aktif via Topbar
1. Buka halaman Dashboard atau halaman admin manapun saat sedang login.
2. Klik ikon **Frontpages** (ikon layar `ki-screen`) di topbar header kanan.
3. Pilih template yang diinginkan (misal: **Landing Page** atau **Education Portal**) lalu klik tombol **"Pilih Default"**.
4. Website akan menetapkan halaman tersebut sebagai halaman awal saat membuka URL root `/`.

## 2. Mengubah Default Frontpage di `.env`
Buka file `.env`, lalu ubah atau tambahkan:
```env
DEFAULT_FRONTPAGE=landing

# Atau jika ingin halaman Education Portal sebagai default:
DEFAULT_FRONTPAGE=education
```
Setelah mengubah `.env`, jalankan:
```bash
php artisan config:clear
```

## 3. Cara Menambahkan Template Frontpage Baru
1. **Langkah 1: Siapkan Folder & File View**:
   - Buat direktori baru di `resources/views/frontpages/{nama_template}/` dan letakkan file blade utamanya (misal `home.blade.php`).
2. **Langkah 2: Daftarkan di `config/frontpage.php`**:
   ```php
   'pages' => [
       // ...
       'ecommerce' => [
           'name'  => 'E-Commerce Storefront',
           'desc'  => 'Modern Online Shop Frontpage',
           'view'  => 'frontpages.ecommerce.home',
           'url'   => '/ecommerce',
           'icon'  => 'ki-basket',
           'badge' => 'Shop v1',
           'color' => 'success',
       ],
   ]
   ```
3. **Langkah 3: Validasi**:
   - Buka `/frontpage/switch/ecommerce` atau pilih dari dropdown topbar.
