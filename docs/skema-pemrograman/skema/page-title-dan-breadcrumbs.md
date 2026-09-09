# Skema Page Title & Hierarchical Breadcrumb

URL aplikasi: `/help/pemrograman/skema/page-title-dan-breadcrumbs`

[⬅ Kembali ke README Docs](../README.md)

---

## 1. Filosofi & Kaidah Hierarki Breadcrumb

Breadcrumb berfungsi sebagai **penunjuk lokasi hierarkis** tempat menu berada di dalam aplikasi, bukan pengulang judul halaman yang sedang aktif.

- **Kaidah Utama:** Breadcrumb hanya menampilkan *jalur leluhur (Ancestor Trail)*: `Home → Category → Parent Menu`.
- **Tanpa Duplikasi Ujung:** Judul halaman yang sedang aktif **tidak** disertakan lagi di ujung breadcrumb karena sudah ditampilkan secara tegas dan berukuran besar pada heading utama (`<h1>`).

### Contoh:
- Route `/appsupport/menu`:
  - **Judul Halaman:** `Menu`
  - **Breadcrumb (EN):** `Home → Master Data → App Support`
  - **Breadcrumb (ID):** `Beranda → Master Data → Dukungan Aplikasi`
- Route `/profil/profil-pengguna`:
  - **Judul Halaman:** `Profil Pengguna` (ID) / `User Profile` (EN)
  - **Breadcrumb:** `Beranda → Master Data` / `Home → Master Data`

---

## 2. Alur Resolusi 4 Layer (Fallback Waterfall)

Engine di `app/Helpers/GetPageTitle.php` (`getPageBreadcrumbs()` & `getPageTitle()`) menelusuri rantai hierarki melalui 4 lapis pencarian:

1. **Layer 1 — Dynamic Menu Seeder:** Menelusuri konfigurasi `config('menu_seeder.categories')` secara rekursif hingga menemukan item yang cocok dengan nama route atau URL aktif beserta nama kategorinya.
2. **Layer 2 — Database Table (`menus`):** Jika belum ditemukan di Layer 1, mencari record di database dan menelusuri relasi `parent_id` ke atas sampai ke kategori root.
3. **Layer 3 — Static Sidebar & Header Config:** Menelusuri seluruh file `config/sidebar/_sidebar_*.php` dan `config/docs/_*.php` untuk menu bertingkat.
4. **Layer 4 — Fallback Segmen URL:** Memecah segmen URL saat ini, mengabaikan segmen terakhir (karena milik judul), lalu memformat nama segmen menjadi teks yang dapat dibaca.

---

## 3. Struktur File Terkait

- `app/Helpers/GetPageTitle.php`: Engine inti kalkulasi title, breadcrumbs trail, dan safe translation.
- `resources/views/layouts/partials/_page-title.blade.php`: Renderer judul dan breadcrumb untuk Metronic v1.
- `resources/views/layouts/_page-title-v2.blade.php`: Renderer judul dan breadcrumb untuk Metronic v2.
- `config/menu_seeder.php`: Konfigurasi hierarki kategori dan menu database.
- `lang/en/menu.php` & `lang/id/menu.php`: Kamus translasi bilingual.
