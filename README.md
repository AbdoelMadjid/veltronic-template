# Veltronic — Enterprise Laravel 13 & Metronic 8.3.2 Admin Template

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Metronic](https://img.shields.io/badge/Metronic-8.3.2-009EF7?style=for-the-badge&logo=bootstrap&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-Ready-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-50CD89?style=for-the-badge)

<p align="center">
  <strong>Template Admin Dashboard Enterprise Berkinerja Tinggi Berbasis Laravel 13 dan KeenThemes Metronic 8.3.2</strong><br>
  Dilengkapi arsitektur modular, live bilingual tanpa refresh, hotkeys global, smart backup berelasi, audit logging terpusat, dan standar zero-reload AJAX CRUD.
</p>

[Repositori GitHub](https://github.com/AbdoelMadjid/veltronic-template.git) • [Skema Pemrograman](#indeks-skema-pemrograman--dokumentasi-pengembang) • [Panduan Instalasi](#panduan-instalasi-langkah-demi-langkah) • [Pintasan Keyboard](#sistem-pintasan-keyboard-global-hotkeys)

---

</div>

## Daftar Isi

- [Fitur Unggulan & Arsitektur Sistem](#fitur-unggulan--arsitektur-sistem)
- [Persyaratan Sistem (System Requirements)](#persyaratan-sistem-system-requirements)
- [Panduan Instalasi Langkah-demi-Langkah](#panduan-instalasi-langkah-demi-langkah)
  - [1. Clone Repositori](#1-clone-repositori)
  - [2. Install Dependensi](#2-install-dependensi)
  - [3. Konfigurasi Environment](#3-konfigurasi-environment)
  - [4. Konfigurasi Database, Migrasi & Storage](#4-konfigurasi-database-migrasi--storage)
  - [5. Menjalankan Server Development](#5-menjalankan-server-development)
  - [Opsi Otomatisasi (Setup Cepat & All-in-One Dev)](#opsi-otomatisasi-setup-cepat--all-in-one-dev)
- [Kredensial Akun Default (Development)](#kredensial-akun-default-development)
- [Sistem Pintasan Keyboard Global (Hotkeys)](#sistem-pintasan-keyboard-global-hotkeys)
- [Arsitektur Alur Kerja & Routing Dinamis](#arsitektur-alur-kerja--routing-dinamis)
- [Struktur Direktori Proyek](#struktur-direktori-proyek)
- [Indeks Skema Pemrograman & Dokumentasi Pengembang](#indeks-skema-pemrograman--dokumentasi-pengembang)
  - [Kelompok 1: Skema & Arsitektur Sistem (21 Topik)](#kelompok-1-skema--arsitektur-sistem-21-topik)
    - [1. Pondasi Inti & Arsitektur Tata Letak (5 Topik)](#1-pondasi-inti--arsitektur-tata-letak-5-topik)
    - [2. Keamanan, Hak Akses & Profil Pengguna (2 Topik)](#2-keamanan-hak-akses--profil-pengguna-2-topik)
    - [3. Struktur Menu, Navigasi & Pintasan Papan Ketik (4 Topik)](#3-struktur-menu-navigasi--pintasan-papan-ketik-4-topik)
    - [4. Lapisan Data, Cadangan & Diagnostik Sistem (5 Topik)](#4-lapisan-data-cadangan--diagnostik-sistem-5-topik)
    - [5. Penyesuaian Tema, Halaman Depan & Bahasa (5 Topik)](#5-penyesuaian-tema-halaman-depan--bahasa-5-topik)
  - [Kelompok 2: Panduan Operasional & Developer Playbook (13 Topik)](#kelompok-2-panduan-operasional--developer-playbook-13-topik)
    - [1. Standar Rekayasa & Jaminan Mutu (5 Topik)](#1-standar-rekayasa--jaminan-mutu-5-topik)
    - [2. Prosedur Penambahan Halaman, Menu & Pintasan (4 Topik)](#2-prosedur-penambahan-halaman-menu--pintasan-4-topik)
    - [3. Pemeliharaan Sistem, Rekam Jejak & Tata Letak (4 Topik)](#3-pemeliharaan-sistem-rekam-jejak--tata-letak-4-topik)
- [Panduan Deployment Production](#panduan-deployment-production)
- [Pembuat & Pengembang](#pembuat--pengembang)
- [Lisensi](#lisensi)

---

## Fitur Unggulan & Arsitektur Sistem

Veltronic dirancang dengan fokus pada skalabilitas enterprise, isolasi modular, dan pengalaman pengguna (UX) yang sangat mulus:

1. 🌐 **Live Realtime Bilingual Engine (EN / ID)**
   Pergantian bahasa instan tanpa me-reload halaman menggunakan arsitektur DOM TreeWalker traversal (`language.js`), caching payload terdistribusi, dan sinkronisasi sesi Laravel di latar belakang.
2. ⌨️ **Global Keyboard Shortcuts Hub (Action Registry)**
   Sistem pintasan keyboard bebas konflik peramban (`Ctrl+Alt+[Key]`) berbasis basis data (`app_shortcuts`), dilengkapi deteksi tabrakan tombol seketika (*realtime collision warning*) dan otorisasi peran.
3. 🛡️ **Centralized Audit Logging & Error Tracking**
   Perekaman audit mutasi data lintas modul (`users_logs`), pelacakan switcher topbar otomatis, riwayat reward poin login 24-jam & sesi layar kunci (`users_logins`), serta penangkap exception backend otomatis.
4. 💾 **Smart Relational Database Backup & Restore Engine**
   Pencadangan basis data cerdas dengan inspeksi dependensi Foreign Key otomatis, kompresi streaming Gzip, preview skema tabel & baris data live, scheduler otomatis, serta pencatatan audit pelaksana cadangan.
5. ⚙️ **App Profile & Dynamic SEO Engine**
   Manajemen identitas aplikasi dinamis berbasis basis data (`app_profiles`), validasi ketat rasio logo (terang, gelap, mini) dan favicon, link footer dinamis, serta live preview Google Search snippet & Open Graph social card.
6. ⚡ **Zero-Reload Realtime CRUD & Button Feedback Standards**
   Standar CRUD berbasis AJAX mutlak tanpa refresh halaman dengan pembaruan UI instan dan animasi tombol loading spinner (`data-kt-indicator="on"`) anti double-click.
7. 🎨 **Multi-Theme Version Resolver (Layout V1 & V2)**
   Resolusi variasi tata letak layout dinamis dengan sinkronisasi mode tema Gelap/Terang (*Dark/Light Mode*) terpusat.
8. 💎 **Zero-Flicker KeenIcons Style Engine**
   Normalisasi kelas ikon KeenIcons langsung dari server-side middleware (`ApplyIconStyle`) sesuai preferensi pengguna (Duotone, Solid, Outline) tanpa kedipan (FOIT/flicker) saat muat halaman.
9. 🔀 **Dynamic Menu Management & Auto Route Generator**
   Pemetaan otomatis file Blade di `resources/views/pages` menjadi route URL dan route name internal, terintegrasi dengan konfigurasi menu hierarkis dan otorisasi hak akses Spatie Permission.
10. 📖 **Komponen Petunjuk Operasional Terpadu (`<x-petunjuk-modal>`)**
    Standarisasi modal petunjuk operasional modular 4-kotak terstruktur (Gambaran Umum, Hirarki/Komponen, Alur Operasional, Proteksi Sistem) pada setiap modul sistem.

---

## Persyaratan Sistem (System Requirements)

Sebelum memulai, pastikan server atau workstation development Anda telah memenuhi spesifikasi berikut:

### Perangkat Lunak & Runtime Utama

| Perangkat Lunak / Runtime | Versi Minimum | Keterangan |
| :--- | :--- | :--- |
| **PHP** | `>= 8.2` | Direkomendasikan PHP 8.3+ (Ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `curl`, `zip`, `zlib`, `gd`/`imagick`) |
| **Composer** | `>= 2.x` | Pengelola paket dependensi backend PHP |
| **Node.js** | `>= 18.x` | Runtime JavaScript untuk kompilasi asset frontend (disarankan LTS 20+) |
| **NPM** | `>= 9.x` | Pengelola paket frontend |
| **Basis Data** | MySQL `8.0+` / MariaDB `10.4+` | Didukung juga SQLite untuk testing isolation |
| **Web Server** | Nginx / Apache / Laragon / Sail | Virtual host diarahkan ke root folder `/public` |

### Paket & Ekstensi Framework Inti

| Paket / Dependensi | Versi Terpasang | Peran & Deskripsi |
| :--- | :--- | :--- |
| **Laravel Framework** | `^13.0` | Core framework backend PHP modern & modular |
| **Laravel Breeze** | `^2.4` | Scaffolding autentikasi, manajemen sesi login, reset password, dan profil pengguna |
| **Spatie Laravel Permission** | `^8.3` | Manajemen otorisasi peran (*Roles*) & izin (*Permissions*) hierarkis |
| **Yajra Laravel DataTables** | `^13.3` | Pemrosesan server-side data tabel berkecepatan tinggi dengan respons JSON instan |

---

## Panduan Instalasi Langkah-demi-Langkah

### 1. Clone Repositori

```bash
git clone https://github.com/AbdoelMadjid/veltronic-template.git
cd veltronic-template
```

### 2. Install Dependensi

Install dependensi backend (PHP) dan frontend (Node.js):

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

Salin berkas konfigurasi template `.env.example` menjadi `.env`:

```bash
# Linux / macOS / Git Bash
cp .env.example .env

# Windows PowerShell
Copy-Item .env.example .env
```

Generate application encryption key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database, Migrasi & Storage

Buka file `.env` dan sesuaikan kredensial koneksi basis data Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=veltronic_template
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi tabel dan seeding data default:

```bash
php artisan migrate --seed
```

> [!TIP]
> Perintah `--seed` akan secara otomatis mengeksekusi seeder peran (*Roles*), izin (*Permissions*), pengguna demo (*Users*: `master@gmail.com`, `admin@gmail.com`, `user@gmail.com`), profil aplikasi (*App Profile*), serta 13 pintasan keyboard bawaan (*Shortcuts*).

Buat symlink storage agar berkas upload (avatar profil, logo aplikasi, favicon, KTP) dapat diakses publik:

```bash
php artisan storage:link
```

### 5. Menjalankan Server Development

Jalankan backend server Laravel:

```bash
php artisan serve
```

Jalankan Vite asset bundler di jendela terminal terpisah:

```bash
npm run dev
```

Buka peramban dan akses: **`http://127.0.0.1:8000`**

---

### Opsi Otomatisasi (Setup Cepat & All-in-One Dev)

Tersedia skrip Composer bawaan untuk mempermudah workflow development:

- **Setup Otomatis Sekali Jalan:**
  ```bash
  composer run setup
  ```
  *(Otomatis install vendor, generate `.env`, buat app key, migrate DB, install node_modules, dan build asset)*

- **Menjalankan Seluruh Service Development Sekaligus:**
  ```bash
  composer run dev
  ```
  *(Menjalankan `php artisan serve`, queue worker, `laravel pail` live logger, dan `npm run dev` secara paralel)*

---

## Kredensial Akun Default (Development)

Setelah database berhasil di-seed, gunakan akun berikut untuk masuk ke sistem:

| Peran (Role) | Email | Password | Hak Akses Utama |
| :--- | :--- | :--- | :--- |
| **Super Admin / Master** | `master@gmail.com` | `password` | Akses penuh (*Superuser*) seluruh modul sistem, konfigurasi peran, perizinan, menu navigasi, audit log aktivitas, cadangan basis data, dan pendukung aplikasi. |
| **Administrator** | `admin@gmail.com` | `password` | Akses tingkat administratif untuk manajemen pengguna, pemantauan aktivitas sistem, dan pengelolaan konten operasional. |
| **Pengguna Standar (User)** | `user@gmail.com` | `password` | Akses tingkat pengguna umum untuk modul standar, halaman depan, pengubahan profil pribadi, dan avatar studio. |

> [!NOTE]
> Setelah login, Anda dapat mengelola data profil, mengganti avatar, melihat audit log, atau menambahkan pengguna baru pada menu **Manajemen Pengguna**.

---

## Sistem Pintasan Keyboard Global (Hotkeys)

Veltronic dilengkapi sistem pintasan keyboard terstandarisasi dengan kombinasi `Ctrl + Alt + [Key]` yang kebal terhadap konflik tombol fungsi bawaan browser:

| Kombinasi Tombol | Kategori | Aksi yang Dijalankan |
| :--- | :--- | :--- |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>T</kbd> | Visibilitas | Toggle Bilah Tools Navigasi Atas (*Topbar Navbar Tools*) |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>H</kbd> | Visibilitas | Toggle Menu Tajuk Header (*Header Menu Links*) |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>M</kbd> | Visibilitas | Toggle Menu Bilah Samping (*Sidebar Menu Template*) |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>B</kbd> | Tampilan | Beralih Cepat Mode Tema (*Dark Mode / Light Mode*) |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>D</kbd> | Tampilan | Ganti Gaya Ikon ke **Duotone** |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>S</kbd> | Tampilan | Ganti Gaya Ikon ke **Solid** |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>O</kbd> | Tampilan | Ganti Gaya Ikon ke **Outline** |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>I</kbd> | Tampilan | Beralih Bahasa ke **Bahasa Indonesia** |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>E</kbd> | Tampilan | Beralih Bahasa ke **English** |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>1</kbd> | Tampilan | Beralih ke Tata Letak **Layout V1** |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>2</kbd> | Tampilan | Beralih ke Tata Letak **Layout V2** |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>F</kbd> | Sistem | Buka Modal Pencarian Pengguna Global (*Quick Search*) |
| <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>L</kbd> | Sistem | Kunci Layar Instan (*Lock Screen Session*) |

Pintasan baru dapat ditambahkan, diubah kombinasinya, atau dibatasi perannya melalui menu **Pendukung Aplikasi > Pintasan Keyboard** (`/appsupport/app-shortcuts`).

---

## Arsitektur Alur Kerja & Routing Dinamis

Aplikasi menggunakan perpaduan rute standar dan **Auto-Routing Engine** untuk view yang terletak di `resources/views/pages`:

```mermaid
graph TD
    A[Browser Request URL] --> B[routes/web.php]
    B -->|Route Khusus / Action / API| C[App Controllers / Handlers]
    B -->|Route Dinamis Pages| D[routes/menu.php]
    D -->|Scan Folder resources/views/pages| E[Auto Route & Name Generator]
    E -->|Check Auth & Spatie Permission| F{Otorisasi Berhasil?}
    F -->|Ya| G[Render Blade View pages.*]
    F -->|Tidak| H[403 / 404 Error Fallback]
    G --> I[ApplyIconStyle Middleware & DOM Translation]
    I --> J[HTML Response ke Browser]
```

### Konvensi Auto-Mapping URL & Route Name:
```text
File Blade: resources/views/pages/usermanagement/users.blade.php
├── URL Path   : /usermanagement/users
├── Route Name : usermanagement.users
└── View Name  : pages.usermanagement.users
```

---

## Struktur Direktori Proyek

```text
veltronic-template/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Controller aksi CRUD dan backend logic
│   │   └── Middleware/        # ApplyIconStyle, SetLocale, Auth, dll.
│   ├── Models/
│   │   ├── AppSupport/        # AppSetting, AppProfile, AppShortcut
│   │   ├── Profil/            # UserLog (Audit Log), UserLogin
│   │   └── User.php           # User model dengan Spatie Permission & Points
│   └── Support/               # LanguageManager, ThemeAsset, ThemeVersion, Frontpage
├── config/
│   ├── header/                # Konfigurasi menu header topbar
│   ├── sidebar/               # Konfigurasi menu navigasi sidebar per modul
│   └── _modals.php            # Pendaftaran modal global sistem
├── docs/                      # Dokumentasi teknis & skema pemrograman (34 Dokumen Markdown)
├── lang/
│   ├── en/                    # Kamus translasi Bahasa Inggris
│   └── id/                    # Kamus translasi Bahasa Indonesia
├── public/
│   └── assets/                # Asset tema Metronic (CSS, JS, Media, Flags, Logos)
├── resources/
│   ├── js/                    # Sumber file JS Vite
│   └── views/
│       ├── components/        # Blade components reusable (<x-petunjuk-modal>, dll.)
│       ├── frontpages/        # Varian landing page dan frontpage
│       ├── layouts/           # Master layout V1 & V2, partials header, toolbar, sidebar
│       ├── pages/             # Seluruh halaman modul (Dashboard, User Management, App Support, Help)
│       └── partials/          # Modal global, drawer, notifikasi, lock screen
└── routes/
    ├── admin.php              # Rute aksi administratif
    ├── auth.php               # Rute autentikasi Breeze / custom
    ├── menu.php               # Auto-routing generator halaman pages
    └── web.php                # Rute utama, switcher tema, switcher bahasa, profile
```

---

## Indeks Skema Pemrograman & Dokumentasi Pengembang

Sistem Veltronic dilengkapi portal dokumentasi bawaan sebanyak **34 topik komprehensif** yang dapat diakses langsung dari menu **Help > Skema Pemrograman** (`/help/pemrograman/overview`) atau via berkas Markdown di direktori [`docs/skema-pemrograman/`](./docs/skema-pemrograman/README.md).

---

### Kelompok 1: Skema & Arsitektur Sistem (21 Topik)

#### 1. Pondasi Inti & Arsitektur Tata Letak (5 Topik)

| No | Modul Skema | Deskripsi Arsitektur | URL Internal | Dokumentasi File |
| :---: | :--- | :--- | :--- | :--- |
| **01** | **Skema Alur Perutean Sistem** | Alur permintaan jalur URL ke berkas tampilan Blade melalui perutean otomatis dinamis dan rute manual terdaftar. | `/help/pemrograman/skema/route` | [`route.md`](./docs/skema-pemrograman/skema/route.md) |
| **02** | **Skema Struktur Tata Letak Halaman** | Struktur tata letak utama, komponen bagian modular, area konten, dan perenderan slot pada setiap halaman aplikasi. | `/help/pemrograman/skema/layout` | [`layout.md`](./docs/skema-pemrograman/skema/layout.md) |
| **03** | **Skema Komponen & Bagian Tampilan Modular** | Konvensi pemisahan berkas tampilan modular, pewarisan template, pengiriman parameter data, dan standar penataan. | `/help/pemrograman/skema/komponen-blade-partial` | [`komponen-blade-partial.md`](./docs/skema-pemrograman/skema/komponen-blade-partial.md) |
| **04** | **Skema Pengelolaan Aset Tema & Berkas Skrip** | Struktur aset gaya tampilan dan skrip logika global, integrasi pustaka pihak ketiga per modul, serta urutan pemuatan. | `/help/pemrograman/skema/theme-assets` | [`theme-assets.md`](./docs/skema-pemrograman/skema/theme-assets.md) |
| **05** | **Skema Judul Halaman & Jejak Navigasi** | Mekanisme otomatis pembentukan judul dinamis dan jejak rekam navigasi berdasarkan struktur jalur rute aktif. | `/help/pemrograman/skema/page-title-dan-breadcrumbs` | [`page-title-dan-breadcrumbs.md`](./docs/skema-pemrograman/skema/page-title-dan-breadcrumbs.md) |

#### 2. Keamanan, Hak Akses & Profil Pengguna (2 Topik)

| No | Modul Skema | Deskripsi Arsitektur | URL Internal | Dokumentasi File |
| :---: | :--- | :--- | :--- | :--- |
| **06** | **Skema Autentikasi, Lapisan Penengah & Hak Akses Peran** | Autentikasi berlapis, matriks izin peran Spatie, pemisahan hak akses langsung vs terwarisi, penugasan massal, serta poin login. | `/help/pemrograman/skema/auth-dan-middleware` | [`auth-dan-middleware.md`](./docs/skema-pemrograman/skema/auth-dan-middleware.md) |
| **07** | **Skema Profil Pengguna & Pengaturan Foto Diri** | Struktur data profil multi-tab, penyesuaian perbesaran dan posisi foto dua sumbu, penyimpanan preferensi, dan pembaruan seketika. | `/help/pemrograman/skema/profil-pengguna-dan-avatar-studio` | [`profil-pengguna-dan-avatar-studio.md`](./docs/skema-pemrograman/skema/profil-pengguna-dan-avatar-studio.md) |

#### 3. Struktur Menu, Navigasi & Pintasan Papan Ketik (4 Topik)

| No | Modul Skema | Deskripsi Arsitektur | URL Internal | Dokumentasi File |
| :---: | :--- | :--- | :--- | :--- |
| **08** | **Skema Struktur Konfigurasi Menu** | Struktur larik konfigurasi menu data awal, sinkronisasi kunci terjemahan multi-bahasa, dan perenderan navigasi dinamis. | `/help/pemrograman/skema/struktur-config-menu` | [`struktur-config-menu.md`](./docs/skema-pemrograman/skema/struktur-config-menu.md) |
| **09** | **Skema Menu Bilah Samping Navigasi** | Hierarki berjenjang menu navigasi samping, pengelompokan menu lipat, penentuan status aktif, dan perenderan otomatis. | `/help/pemrograman/skema/sidebar-menu` | [`sidebar-menu.md`](./docs/skema-pemrograman/skema/sidebar-menu.md) |
| **10** | **Skema Menu Bilah Tajuk Atas** | Konfigurasi menu navigasi mendatar di bagian atas, menu tarik-turun bantuan, dan tombol pintasan aksi cepat. | `/help/pemrograman/skema/header-menu` | [`header-menu.md`](./docs/skema-pemrograman/skema/header-menu.md) |
| **11** | **Skema Pintasan Papan Ketik Terpadu** | Arsitektur kombinasi tombol pintasan sistem, pendaftaran aksi modular bebas konflik, dan pembatasan izin peran pengguna. | `/help/pemrograman/skema/keyboard-shortcuts` | [`keyboard-shortcuts.md`](./docs/skema-pemrograman/skema/keyboard-shortcuts.md) |

#### 4. Lapisan Data, Cadangan & Diagnostik Sistem (5 Topik)

| No | Modul Skema | Deskripsi Arsitektur | URL Internal | Dokumentasi File |
| :---: | :--- | :--- | :--- | :--- |
| **12** | **Skema Lapisan Data & Pemodelan Basis Data** | Struktur model data, relasi antar tabel basis data, berkas migrasi, data awal terstruktur, dan standar kueri data. | `/help/pemrograman/skema/data-layer` | [`data-layer.md`](./docs/skema-pemrograman/skema/data-layer.md) |
| **13** | **Skema Cadangan Basis Data & Relasi Antar Tabel** | Mekanisme pencadangan ganda mandiri, inspeksi integritas relasi tabel dan kunci asing, serta jadwal pembersihan arsip. | `/help/pemrograman/skema/database-backup-dan-relasi-tabel` | [`database-backup-dan-relasi-tabel.md`](./docs/skema-pemrograman/skema/database-backup-dan-relasi-tabel.md) |
| **14** | **Skema Rekam Jejak Audit & Pelacakan Kesalahan** | Pencatatan riwayat aktivitas pengguna terpusat, penangkapan galat sistem secara otomatis, dan pemisahan catatan profil. | `/help/pemrograman/skema/audit-log-dan-error-tracking` | [`audit-log-dan-error-tracking.md`](./docs/skema-pemrograman/skema/audit-log-dan-error-tracking.md) |
| **15** | **Skema Penanganan Galat & Tampilan Cadangan** | Penyajian halaman alternatif saat terjadi rute tidak ditemukan atau galat server di dalam tata letak aplikasi yang konsisten. | `/help/pemrograman/skema/error-handling-dan-fallback` | [`error-handling-dan-fallback.md`](./docs/skema-pemrograman/skema/error-handling-dan-fallback.md) |
| **16** | **Skema Memori Singgah & Alur Penerapan Sistem** | Strategi penyimpanan memori singgah untuk konfigurasi, rute, dan tampilan, panduan pembersihan, serta alur rilis produksi. | `/help/pemrograman/skema/cache-dan-deployment` | [`cache-dan-deployment.md`](./docs/skema-pemrograman/skema/cache-dan-deployment.md) |

#### 5. Penyesuaian Tema, Halaman Depan & Bahasa (5 Topik)

| No | Modul Skema | Deskripsi Arsitektur | URL Internal | Dokumentasi File |
| :---: | :--- | :--- | :--- | :--- |
| **17** | **Skema Penggantian Bahasa Aplikasi** | Mekanisme perpindahan bahasa antarmuka secara dinamis, pengelolaan kamus terjemahan, dan persistensi sesi pengguna. | `/help/pemrograman/skema/pemilihan-bahasa` | [`pemilihan-bahasa.md`](./docs/skema-pemrograman/skema/pemilihan-bahasa.md) |
| **18** | **Skema Internasionalisasi Lanjutan & Lokalisasi** | Standarisasi penulisan kunci terjemahan, pengelolaan berkas bahasa berskala besar, dan integrasi penambahan bahasa baru. | `/help/pemrograman/skema/i18n-lanjutan` | [`i18n-lanjutan.md`](./docs/skema-pemrograman/skema/i18n-lanjutan.md) |
| **19** | **Skema Penggantian Versi Tampilan Tema** | Cetak biru arsitektur multi-versi tema aplikasi, penentu tampilan otomatis, dan mekanisme sufiks berkas tata letak. | `/help/pemrograman/skema/pergantian-versi-tampilan` | [`pergantian-versi-tampilan.md`](./docs/skema-pemrograman/skema/pergantian-versi-tampilan.md) |
| **20** | **Skema Penggantian Tata Letak Halaman Depan** | Mekanisme pemuatan halaman depan dinamis, pendaftaran template beranda tambahan, dan penanganan rute awal. | `/help/pemrograman/skema/pergantian-frontpage` | [`pergantian-frontpage.md`](./docs/skema-pemrograman/skema/pergantian-frontpage.md) |
| **21** | **Skema Penggantian Ragam Gaya Ikon** | Arsitektur peralihan variasi gaya ikon visual (Duotone, Solid, Outline) dan helper pembuat elemen grafis otomatis. | `/help/pemrograman/skema/pergantian-icon` | [`pergantian-icon.md`](./docs/skema-pemrograman/skema/pergantian-icon.md) |

---

### Kelompok 2: Panduan Operasional & Developer Playbook (13 Topik)

#### 1. Standar Rekayasa & Jaminan Mutu (5 Topik)

| No | Modul Panduan | Ruang Lingkup Petunjuk Praktis | URL Internal | Dokumentasi File |
| :---: | :--- | :--- | :--- | :--- |
| **01** | **Alur Kerja Harian Pengembang & Prosedur Baku** | Ritme kerja harian pengembang: sinkronisasi cabang kode, verifikasi terarah, pencegahan regresi, hingga kriteria selesai tugas. | `/help/pemrograman/operasional/workflow-developer-harian` | [`workflow-developer-harian.md`](./docs/skema-pemrograman/operasional/workflow-developer-harian.md) |
| **02** | **Panduan Olah Data Tanpa Muat Ulang & Animasi Tombol** | Standar interaksi formulir tanpa segarkan halaman, indikator pemrosesan tombol interaktif, banner tajuk, dan bagian tampilan modular. | `/help/pemrograman/operasional/panduan-standar-zero-reload-dan-button-loading` | [`panduan-standar-zero-reload-dan-button-loading.md`](./docs/skema-pemrograman/operasional/panduan-standar-zero-reload-dan-button-loading.md) |
| **03** | **Standar Konvensi Penamaan Berkas & Variabel** | Aturan baku penamaan berkas tampilan, penetapan jalur rute, pengendali logika, model data, dan kunci kamus terjemahan. | `/help/pemrograman/operasional/konvensi-penamaan` | [`konvensi-penamaan.md`](./docs/skema-pemrograman/operasional/konvensi-penamaan.md) |
| **04** | **Daftar Periksa Uji Cepat Jaminan Mutu Sistem** | Daftar skenario pengujian minimum yang wajib dipenuhi sebelum penggabungan kode atau rilis pembaruan ke server produksi. | `/help/pemrograman/operasional/checklist-qa-smoke-test` | [`checklist-qa-smoke-test.md`](./docs/skema-pemrograman/operasional/checklist-qa-smoke-test.md) |
| **05** | **Buku Panduan Penanganan Insiden & Gangguan Sistem** | Prosedur tindakan cepat 15 menit pertama, alur eskalasi penanganan, dan pembagian tanggung jawab saat terjadi gangguan sistem. | `/help/pemrograman/operasional/playbook-incident-response` | [`playbook-incident-response.md`](./docs/skema-pemrograman/operasional/playbook-incident-response.md) |

#### 2. Prosedur Penambahan Halaman, Menu & Pintasan (4 Topik)

| No | Modul Panduan | Ruang Lingkup Petunjuk Praktis | URL Internal | Dokumentasi File |
| :---: | :--- | :--- | :--- | :--- |
| **06** | **Panduan Penambahan Halaman Baru** | Langkah terstruktur membuat berkas tampilan baru, pengaturan perutean otomatis, hingga pendaftaran ke navigasi menu sistem. | `/help/pemrograman/operasional/panduan-tambah-halaman` | [`panduan-tambah-halaman.md`](./docs/skema-pemrograman/operasional/panduan-tambah-halaman.md) |
| **07** | **Panduan Penambahan Item Menu Baru** | Tata cara menambahkan entri navigasi baru pada konfigurasi menu bilah samping dan data awal sistem secara terstruktur. | `/help/pemrograman/operasional/panduan-tambah-menu` | [`panduan-tambah-menu.md`](./docs/skema-pemrograman/operasional/panduan-tambah-menu.md) |
| **08** | **Panduan Judul Halaman & Jejak Navigasi** | Praktik terbaik menyusun tampilan tanpa penulisan kode berulang serta teknik penyesuaian judul manual bila diperlukan. | `/help/pemrograman/operasional/panduan-page-title-dan-breadcrumbs` | [`panduan-page-title-dan-breadcrumbs.md`](./docs/skema-pemrograman/operasional/panduan-page-title-dan-breadcrumbs.md) |
| **09** | **Panduan Pengelolaan Pintasan Papan Ketik** | Prosedur pengelolaan tombol pintasan melalui panel administrasi, pendaftaran aksi skrip kustom, dan pencegahan konflik tombol. | `/help/pemrograman/operasional/panduan-keyboard-shortcuts` | [`panduan-keyboard-shortcuts.md`](./docs/skema-pemrograman/operasional/panduan-keyboard-shortcuts.md) |

#### 3. Pemeliharaan Sistem, Rekam Jejak & Tata Letak (4 Topik)

| No | Modul Panduan | Ruang Lingkup Petunjuk Praktis | URL Internal | Dokumentasi File |
| :---: | :--- | :--- | :--- | :--- |
| **10** | **Panduan Penggantian Versi Tata Letak Tema** | Panduan menambahkan varian versi tata letak baru dan beralih antarmuka secara dinamis tanpa duplikasi berkas rute. | `/help/pemrograman/operasional/panduan-pergantian-versi-metronic` | [`panduan-pergantian-versi-metronic.md`](./docs/skema-pemrograman/operasional/panduan-pergantian-versi-metronic.md) |
| **11** | **Panduan Penggantian Tata Letak Halaman Depan** | Langkah pemilihan desain halaman beranda aktif serta tata cara mendaftarkan rancangan halaman depan baru ke sistem. | `/help/pemrograman/operasional/panduan-pergantian-frontpage` | [`panduan-pergantian-frontpage.md`](./docs/skema-pemrograman/operasional/panduan-pergantian-frontpage.md) |
| **12** | **Panduan Pengelolaan Rekam Jejak Audit & Investigasi Galat** | Prosedur pemantauan aktivitas sistem, penyaringan tingkat urgensi catatan, dan investigasi teknis jejak galat sistem. | `/help/pemrograman/operasional/panduan-audit-log-dan-investigasi-error` | [`panduan-audit-log-dan-investigasi-error.md`](./docs/skema-pemrograman/operasional/panduan-audit-log-dan-investigasi-error.md) |
| **13** | **Panduan Cadangan & Pemulihan Basis Data** | Tata cara pembuatan salinan data mandiri, pemulihan data yang aman, pengunduhan berkas SQL, dan pengujian jadwal otomatis. | `/help/pemrograman/operasional/panduan-backup-dan-restore-database` | [`panduan-backup-dan-restore-database.md`](./docs/skema-pemrograman/operasional/panduan-backup-dan-restore-database.md) |

---

## Panduan Deployment Production

Berikut adalah alur standar deployment aplikasi Veltronic ke lingkungan server production:

```bash
# 1. Tarik pembaruan kode dari repositori
git pull origin main

# 2. Install dependensi backend tanpa dev package dengan autoloader teroptimasi
composer install --no-dev --optimize-autoloader

# 3. Install dan kompilasi asset frontend production
npm ci
npm run build

# 4. Eksekusi migrasi database
php artisan migrate --force

# 5. Optimalkan seluruh cache aplikasi Laravel
php artisan optimize:clear
php artisan optimize

# 6. Pastikan symlink storage terpasang
php artisan storage:link
```

### Checklist Wajib Production:
- [x] Pastikan `APP_ENV=production` dan `APP_DEBUG=false` pada berkas `.env`.
- [x] Berikan hak akses tulis (*write permissions*) pada direktori `storage/` dan `bootstrap/cache/` (contoh: `chmod -R 775 storage bootstrap/cache`).
- [x] Konfigurasikan Web Server (Nginx / Apache) agar Document Root mengarah langsung ke folder `/public`.
- [x] Jalankan background Queue Worker menggunakan Supervisor (`php artisan queue:work --tries=3`).
- [x] Tambahkan Cron Job Laravel Scheduler (`* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1`).

---

## Pembuat & Pengembang

Aplikasi dan arsitektur template ini dikembangkan dan dirancang oleh:

- **Nama**: Abdoel Madjid
- **Peran**: Full-Stack Developer & Software Architect
- **GitHub**: [@AbdoelMadjid](https://github.com/AbdoelMadjid)
- **Repositori Proyek**: [veltronic-template](https://github.com/AbdoelMadjid/veltronic-template)

---

## Lisensi

Proyek ini dilisensikan di bawah lisensi **[MIT License](LICENSE)**. Anda bebas menggunakan, memodifikasi, dan mendistribusikan template ini untuk kebutuhan personal maupun komersial.
