# Changelog

All notable changes to the Veltronic Metronic 8 Template project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v1.29.0] - 2026-09-18

### Added & Enhanced
- **Dashboard App Profile Management Module (`appsupport/app-profil`)**:
  - **Identitas & Meta SEO Dashboard**: Pengaturan dinamis nama aplikasi (`app_name`), tagline (`app_tagline`), versi rilis (`app_version`), deskripsi pencarian (`meta_description`), kata kunci (`meta_keywords`), author (`meta_author`), dan Open Graph tags (`og_title`, `og_site_name`) dengan fitur **Live Google Search Snippet Preview** & **Open Graph Social Card Preview**.
  - **Logo & Favicon Dashboard dengan Validasi Resolusi Ketat**:
    - Dukungan upload berkas gambar dan kustom path/URL untuk logo mode terang (`app_logo_default`), logo mode gelap (`app_logo_dark`), icon logo mini (`app_logo_minimize`), dan favicon browser (`app_favicon`).
    - **Validasi Ketat Dimensi & Rasio Resolusi (Client & Server-side)**:
      - *Logo Mode Terang & Gelap*: Resolusi `100×20 px` s/d `600×150 px` (Rekomendasi `200×50 px` Lanskap), maks 1 MB.
      - *Logo Mini (Minimize)*: Rasio 1:1 Persegi Simetris, `30×30 px` s/d `200×200 px` (Rekomendasi `40×40 px`), maks 512 KB.
      - *Favicon Browser*: Rasio 1:1 Persegi Simetris, `16×16 px` s/d `128×128 px` (Rekomendasi `32×32 px` / `64×64 px`), maks 256 KB.
    - Penyimpanan aset gambar dialokasikan langsung ke **`public/assets/logo/`** dengan tracking Git aktif (`.gitkeep`) agar aman saat `git push`, `clone`, atau `git pull`.
    - Dilengkapi tombol reset per item ke aset standar bawaan tema.
  - **Pengaturan Footer Dashboard**:
    - Konfigurasi tahun copyright (`footer_copyright_year`), nama pemilik (`footer_copyright_text`), URL tautan (`footer_copyright_url`), serta toggle visibilitas status info server (`footer_show_system_info`: Laravel, PHP, MySQL version).
    - **Dynamic Footer Link Repeater**: Tabel interaktif untuk menambah, mengubah, mengurutkan, dan menghapus tautan menu navigasi footer secara realtime.
  - **Dinamisasi Seluruh Layout Dashboard**:
    - Menghubungkan seluruh layout (`layouts/index.blade.php`, `index-v2.blade.php`, `document832.blade.php`, `_logo.blade.php`, `_header.blade.php`, `_base-v2.blade.php`, `_footer.blade.php`, `_footer-v2.blade.php`) via helper teroptimasi cache: `app_profile()`, `app_logo_url()`, `app_favicon_url()`, dan `app_footer_links()`.
  - **Database Seeder & Sinkronisasi File Seeder Otomatis**:
    - Membuat seeder mandiri `database/seeders/AppProfilSeeder.php` yang terdaftar di `DatabaseSeeder.php`.
    - Fitur **"Perbarui File Seeder" (`sync-seeder`)**: Mengambil konfigurasi aktif di database dan menulis ulang file `AppProfilSeeder.php` secara otomatis.
    - Fitur **"Jalankan Seeder" (`run-seeder`)**: Memuat ulang data dari seeder ke database secara instan.
  - **Integrasi Audit Activity Logs ke App Features (`/appsupport/app-fiturs`)**:
    - Seluruh mutasi konfigurasi profil dashboard secara otomatis dicatat ke `users_logs` via `UserLog::record('appsupport', 'app-profil', ...)`.
    - **Pencatatan Log Otomatis 5 Fitur Topbar**:
      1. **Icon Style Switch**: `Ganti Icon Style` (`duotone`, `solid`, `outline`).
      2. **Theme Mode Switch**: `Ganti Mode Tema (Dark/Light)` (`light`, `dark`, `system`) dengan listener AJAX realtime.
      3. **Language Switch**: `Ganti Bahasa Antarmuka` (`id`, `en`).
      4. **Theme Version Switch**: `Ganti Varian Tema (Theme Version)` (`v1`, `v2`).
      5. **Frontpage Selection**: `Ganti Halaman Depan (Frontpage)` (`landing`, `auth`, `education`, dll.).
      Setiap entri log secara akurat merekam akun pengguna pengeksekusi aktif (`user_id = auth()->id()`).
  - **Standarisasi Komponen Petunjuk Operasional (`<x-petunjuk-modal>`)**:
    - Mengonversi modal petunjuk operasional `app-profil-petunjuk.blade.php` ke komponen standar `<x-petunjuk-modal>` dengan 4 slot terstruktur (`box1`: Gambaran Umum, `box2`: Komponen, `box3`: Alur Operasional, `box4`: Aturan/Proteksi Sistem).
    - Memperbarui aturan dokumentasi di `.agents/rules/module-partials-and-operational-guidelines.md` dan `AGENTS.md` yang mewajibkan seluruh modal petunjuk di masa mendatang menggunakan komponen `<x-petunjuk-modal>`.

## [v1.28.0] - 2026-09-18

### Added & Enhanced
- **Dynamic & Categorized Keyboard Shortcuts Management System (`appsupport/app-fiturs`)**:
  - **Database & Model Architecture**: Created `app_shortcuts` migration and `AppShortcut` model with JSON role filtering (`isAllowedForUser`), formatted badge accessors (`formatted_combination`, `mac_combination`), structured categories (`CATEGORIES`), and query scopes (`getActiveForCurrentUser`).
  - **Categorized 5-Tier Shortcut Structure**:
    - 👁️ **Visibilitas Fitur (`visibility`)**: Global toggle for Topbar Navbar Tools (`Ctrl + Alt + T`), Topbar Header Menus (`Ctrl + Alt + H`), and Sidebar Template Menus (`Ctrl + Alt + M`) with persistent backend state synchronization via `/appsupport/app-fiturs/bulk-toggle`.
    - 🎨 **Tema, Gaya Ikon, Bahasa & Versi Layout (`appearance`)**: Instant theme mode toggle (`Ctrl + Alt + B`), KeenIcons variant switcher (`Ctrl + Alt + D/S/O`), bilingual language switcher (`Ctrl + Alt + I/E`), and layout version switcher (`Ctrl + Alt + 1/2`).
    - ⚡ **Aksi Sistem & Keamanan (`system`)**: Global search trigger (`Ctrl + Alt + F`), instant lock screen session lock (`Ctrl + Alt + L`), and operational guidelines modal trigger.
    - 🔗 **Navigasi Menu (`navigation`)**: Instant route opening to core application modules.
    - 🎯 **Aksi Elemen (`element`)**: Automated trigger clicks on Metronic side drawers and modals.
  - **Modular Frontend Action Registry (`public/assets/js/custom/shortcuts.js`)**:
    - Decoupled `ActionRegistry` architecture separating global keydown listeners from domain-specific action handlers.
    - Public extensibility API via `window.VeltronicShortcuts.registerActionHandler()`.
    - Dual key/code matching (`e.key` and `e.code`) ensuring 100% compatibility across operating systems, international keyboard layouts, and AltGr keystrokes.
    - Conflict-free keystroke standard (`Ctrl + Alt + [Letter]`) preventing collisions with native browser hotkeys.
  - **2-Column Guided Form & Live Collision Warning**:
    - Interactive Category Grid selector with dynamic target dropdown population from `window.SHORTCUT_CATEGORIES_CATALOG`.
    - Realtime key collision detector displaying visual warnings when a key combination is already registered.
    - Realtime zero-reload AJAX CRUD with SweetAlert2 confirmations and Metronic button indicator spinners.
  - **Interactive Table & Category Filtering**:
    - Category filter navigation tabs (`Semua`, `Visibilitas`, `Tema, Ikon & Bahasa`, `Aksi Sistem`, `Navigasi`, `Elemen`).
    - Categorized reference cheatsheet cards with Windows/Linux vs macOS keyboard shortcuts.
  - **Toastr & Notification Container Optimization**:
    - Disabled raw `progressBar` and standardized `#toast-container` CSS in `custom.css` to eliminate full-width horizontal black lines across the viewport.
  - **Database Seeder & Operational Guidelines Integration**:
    - Created `AppShortcutSeeder` with 13 comprehensive default shortcuts registered in `DatabaseSeeder.php` and reset default actions in `AppFiturController.php`.
    - Updated operational guidelines modal (`app-fiturs-petunjuk.blade.php`) and bilingual language dictionaries (`lang/id/menu.php`, `lang/en/menu.php`).
  - **Developer Help Portal (`help/pemrograman`) & Documentation Integration**:
    - Added **Skema Keyboard Shortcuts** (`help/pemrograman/skema/keyboard-shortcuts.blade.php` & `docs/skema-pemrograman/skema/keyboard-shortcuts.md`).
    - Added **Panduan Operasional Keyboard Shortcuts** (`help/pemrograman/operasional/panduan-keyboard-shortcuts.blade.php` & `docs/skema-pemrograman/operasional/panduan-keyboard-shortcuts.md`).
    - Added **Skema Audit Log & Error Tracking** (`help/pemrograman/skema/audit-log-dan-error-tracking.blade.php` & `docs/skema-pemrograman/skema/audit-log-dan-error-tracking.md`).
    - Added **Skema Database Backup & Relasi Tabel** (`help/pemrograman/skema/database-backup-dan-relasi-tabel.blade.php` & `docs/skema-pemrograman/skema/database-backup-dan-relasi-tabel.md`).
    - Added **Skema Profil Pengguna & Avatar Studio** (`help/pemrograman/skema/profil-pengguna-dan-avatar-studio.blade.php` & `docs/skema-pemrograman/skema/profil-pengguna-dan-avatar-studio.md`).
    - Added **Panduan Audit Log & Investigasi Error** (`help/pemrograman/operasional/panduan-audit-log-dan-investigasi-error.blade.php` & `docs/skema-pemrograman/operasional/panduan-audit-log-dan-investigasi-error.md`).
    - Added **Panduan Backup & Restore Database** (`help/pemrograman/operasional/panduan-backup-dan-restore-database.blade.php` & `docs/skema-pemrograman/operasional/panduan-backup-dan-restore-database.md`).
    - Added **Panduan Standar Zero-Reload & Button Loading** (`help/pemrograman/operasional/panduan-standar-zero-reload-dan-button-loading.blade.php` & `docs/skema-pemrograman/operasional/panduan-standar-zero-reload-dan-button-loading.md`).
    - Modernized **Skema Auth & Middleware** (`help/pemrograman/skema/auth-dan-middleware.blade.php`) with Spatie Role-Permission Matrix, Direct vs Inherited Permissions, and Login Points/Lockscreen.
    - Updated **Workflow Developer Harian** (`help/pemrograman/operasional/workflow-developer-harian.blade.php`) with Active Agent Guidelines (Rules 4, 5, 6, 7) and anti-regression policies.
    - Updated Overview table of contents (`help/pemrograman/overview.blade.php`), docs index (`docs/skema-pemrograman/README.md`), and registered sidebar navigation items (`config/sidebar/_sidebar_helps.php`) with bilingual dictionary keys.
    - Localized `help/pemrograman/overview.blade.php` entirely into 100% pure Bahasa Indonesia across all 34 topic cards and filter controls.
    - Fixed Blade compilation variable evaluation error in `profil-pengguna-dan-avatar-studio.blade.php`.

---

## [v1.27.0] - 2026-09-17

### Added & Enhanced
- **Centralized System Activity & Audit Logging Engine (`users_logs`)**:
  - **Database & Model Extension**: Added indexed columns `module`, `menu`, and `level` to `users_logs`, with nullable `user_id` for automated/system processes.
  - **Unified Log Recorder (`UserLog::record`)**: Centralized static logging helper supporting module categorization (`usermanagement`, `appsupport`, `profil`, `sistem`), log levels (`info`, `warning`, `error`, `success`), request IP/User-Agent capture, and custom user binding with full backward compatibility.
  - **Automatic Backend Exception Logger (`bootstrap/app.php`)**: Captured non-fatal and unexpected backend exceptions in Laravel's exception handler with `level = 'error'`, recording error message, file, and line traces without interrupting application execution.
- **Comprehensive Activity Logging across User Management & App Support**:
  - **User Management**: Recorded audit events for `UserController` (create, edit, delete, password reset, bulk role assignment), `RoleController` (create, update, delete), `PermissionController` (create, update, delete, module permission generator), `RoleAccessController` (matrix sync, toggle, bulk toggle), `UserAccessController` (role assignment, direct permission assignment), and `DataLoginController` (delete, bulk delete, clear).
  - **App Support**: Recorded audit events for `AppFiturController` (toggle feature, bulk toggle, save settings, clear cache), `BackupDbController` (create backup, restore database, delete backup, save auto backup settings, test run), and `MenuController` (create menu, update menu, delete menu, drag-and-drop reorder).
  - **Profil Pengguna**: Recorded all user profile actions (KTP upload/delete, avatar update/crop/zoom, life motto update, password changes, cover background adjustments, user preferences).
- **Interactive Activity Logs Dashboard Tab (`appsupport/app-fiturs`)**:
  - **Dedicated Nav Tab**: Added **Log Aktivitas Sistem** tab in `appsupport/app-fiturs`.
  - **Summary Statistics Cards**: Live counters for *Total Rekaman*, *Aktivitas Hari Ini*, *Backend Errors*, *User Management*, *App Support*, and *Profil Pengguna*.
  - **Zero-Reload DataTables**: Fast server-side pagination, searching, sorting, and filtering by Module, Log Level, and Date Range (Today, Yesterday, This Week, This Month).
  - **Audit Detail Modal (`log-detail-modal.blade.php`)**: Interactive modal displaying user info, IP address, user-agent string, exact timestamp, and formatted error trace / event payload.
- **Zero-Reload Realtime Sync & Profile Audit Isolation**:
  - **User Profile Audit Isolation**: Strictly filtered `profil/profil-pengguna` (Tab *Riwayat Pengguna*) to only display personal profile logs (`module = 'profil'`), keeping administrative and system-wide logs separate.
  - **Realtime DOM Prepending**: Dynamically injected newly generated audit entries into the user's *Riwayat Pengguna* timeline instantly on form save without page reload.
  - **Realtime DataTables Refresh**: Automatically refreshed the DataTables instance in *Log Aktivitas Sistem* on all toggle, batch action, and settings updates in `appsupport/app-fiturs`.
  - **Instant Badge Status Toggle**: Enabled direct click-to-toggle on feature status badges in the App Fiturs table.
- **Operational Guidelines Modal & Header Toolbar Integration (`appsupport/app-fiturs`)**:
  - **Modal Petunjuk (`app-fiturs-petunjuk.blade.php`)**: Created comprehensive operational guidelines modal utilizing `<x-petunjuk-modal>` with feature explanations, logging policies, and best practices.
  - **Toolbar Action Button**: Integrated `@section('toolbar')` action button with `layouts.partials._action-petunjuk-button` for consistent UX across modules.
- **UI Consistency & Navigation Alignments**:
  - **Lock Screen Avatar Standardization**: Aligned lock screen avatar from `rounded-circle` to standard project squircle `rounded-3` with `image-input-wrapper` and shadow styling.
  - **About App Changelog Link**: Integrated direct Changelog button in `kt_modal_about_app.blade.php` alongside Visit Repository with complete bilingual support (EN/ID).
  - **Widget Distribution Demo Routes**: Aligned all demo link references in `distribusi-widget.blade.php` and `distribusi-demo.blade.php` to the canonical `main/demo/*` routing path.

---

## [v1.26.0] - 2026-09-17

### Added & Enhanced
- **Login Rewards & Daily Point System (1 Point per 24 Hours)**:
  - **Automated Point Allocation**: Implemented 24-hour reward throttle on web logins and lock screen unlock events, ensuring users receive at most 1 point per 24 hours while accurately tracking total login frequency.
  - **Dedicated Audit Modul (`usermanagement/data-login`)**: Built comprehensive DataTables dashboard with live statistic counters, multi-level filtering (Action Type, Point Earned, Role, Date Range), bulk deletion, and automated history cleanup.
  - **Zero-Reload Realtime CRUD & Operational Guides**: Designed modular partials and operational guide modal following Metronic/Veltronic design standards.

---

## [v1.25.2] - 2026-09-17

### Restructured & Optimized
- **Help Log Section Reorganization (`pages/help/log/`)**:
  - **Dedicated Log Directory**: Moved `changelog.blade.php` and `console-developer.blade.php` from `pages/help/pemrograman/` into `pages/help/log/`.
  - **Sidebar & Routes Sync**: Registered new routes (`help.log.changelog` & `help.log.console-developer`) and created a dedicated `Log` sub-group in `_sidebar_helps.php`.
  - **Bilingual & Test Alignment**: Added bilingual dictionary keys in `lang/id/menu.php` and `lang/en/menu.php`, updated breadcrumbs, and aligned feature test endpoints.

---

## [v1.25.1] - 2026-09-17

### Restructured & Optimized
- **Modular Partials Organization (`usermanagement` & `appsupport`)**:
  - **User Management Partials Subdirectory (`usermanagement/partials/users/`)**: Moved all 8 user partials (`users-cards-list`, `users-cards-pane`, `users-table-pane`, `users-filter-aside`, `users-form-modal`, `users-detail-modal`, `users-bulk-role-modal`, `users-petunjuk`) into a dedicated `users/` subdirectory.
  - **App Support Menu Partials Subdirectory (`appsupport/partials/menu/`)**: Moved menu partials (`menu-form-modal`, `menu-petunjuk`) into a dedicated `menu/` subdirectory.
  - **Synchronized View References**: Updated all `@include` statements and controller render paths (`UserController@index` AJAX cards) to match the new nested folder architecture.

---

## [v1.25.0] - 2026-09-17

### Added & Enhanced
- **Bulk Assign Role & Multi-Selection Engine (`usermanagement/users`)**:
  - **Selection Checkboxes**: Added interactive checkboxes across both Card View (top-left card header) and Table View (row checkboxes with *Select All* header checkbox).
  - **Dynamic Bulk Action Toolbar**: Implemented an automated toolbar action button (`Beri Role Massal`) with live badge counter reflecting selected users.
  - **Bulk Role Modal (`users-bulk-role-modal.blade.php`)**: Designed modal for assigning multiple roles with flexible application methods (*Append* to existing roles vs *Replace/Sync* all roles).
  - **Backend Controller & Route**: Added `UserController@bulkAssignRole` and `POST /usermanagement/users/bulk-assign-role` wrapped in database transaction with validation.
  - **Zero-Reload Realtime Sync**: Instantly updates both Card View and DataTables without page reload upon role assignment.
- **DataTables Multi-Role & Filter Robustness**:
  - **Type-Safe Search & Filter Handling**: Fixed PHP 8+ `TypeError` in `UserController@index` by safely handling DataTables array-formatted search and order parameters.
  - **Multi-Role Relational Querying**: Optimized `whereHas('roles')` to accurately filter users holding multiple simultaneous roles.
- **Top-Aligned Avatar Preview Optimization**:
  - Enhanced `users.js` and `users-form-modal.blade.php` with FileReader and KTImageInput hooks so newly selected avatar images immediately focus on the top (`background-position: 50% 0%`, `background-size: cover`), matching `profil-pengguna` standards.
- **Universal Reusable Petunjuk Modal Component (`<x-petunjuk-modal>`)**:
  - Built `<x-petunjuk-modal>` Blade component with standardized 4-box layout and valid KeenIcons (`ki-diamonds`, `ki-element-11`, `ki-key`, `ki-security-user`).
  - Standardized toolbar action petunjuk buttons (`_action-petunjuk-button`) across `users`, `roles`, `permissions`, `akses-role`, `akses-user`, `backup-db`, and `menu`.
- **Akses Role 2-Column Vertical Sidebar Layout**:
  - Redesigned `usermanagement/akses-role` into an intuitive 2-column layout with vertical role selector tabs on the left and full-width matrix table on the right.

---

## [v1.24.0] - 2026-09-17

### Added & Enhanced
- **Spatie Laravel Permission & Sidebar Access Engine**:
  - **Sidebar Permission Resolution (`helper.php` & `_menu-item.blade.php`)**: Enhanced `menuCanReadUrl()` and `$canReadRoute()` to intelligently match slash (`read appsupport/menu`), dot (`read appsupport.menu`), and resource route variants (`.index`), ensuring direct permissions on child routes render their parent menus correctly.
  - **Menu Controller Permission Synchronization**: Unified permission generation in `MenuController@syncPermissions` to standard slash format matching `MenuSeeder`.
  - **Automatic Permission Cache Invalidation**: Integrated `PermissionRegistrar::forgetCachedPermissions()` across `MenuController`, `RoleAccessController`, and `UserAccessController` for zero-stale instant updates.
- **Inherited vs Direct Permissions Visual Differentiation (`usermanagement/akses-user`)**:
  - **Visual Indicator**: Replaced floating overlay indicators with symmetrical, centered role badges (`[ 🛡️ Peran ]` with tooltips indicating granting roles) for permissions inherited via roles.
  - **Direct Override Matrix**: Left non-role checkboxes cleanly accessible for direct user permission overrides.
  - **Refined Modal Header**: Upgraded direct permissions modal header to an elegant, dark-mode adaptive `bg-light-subtle rounded-3` card with clear status legends.
- **Standar Header Banner, Toolbar Petunjuk, & Tema Dinamis (Rule #7)**:
  - Formally established Rule #7 in `AGENTS.md` and `.agents/rules/module-header-banner-and-toolbar-standards.md`.
  - Standardized standalone Header Banners with right-aligned action buttons and toolbar-based operational guidance buttons across `roles`, `permissions`, `akses-role`, and `akses-user`.
- **Akses Role Page Full-Scroll Optimization**:
  - Added `scrollable` parameter to `crud-matrix-table.blade.php` and disabled internal scroll box on `usermanagement/akses-role` for seamless browser page scrolling.

---

## [v1.23.0] - 2026-09-17

### Added & Enhanced
- **Database Backup Engine & Automation (`appsupport/backup-db`)**:
  - **Intelligent Relational Backup Service (`DatabaseBackupService.php`)**: Implemented schema inspection, exact row counting (`SELECT COUNT(*)`), smart Foreign Key dependency auto-selection, and gzip streaming compression.
  - **Executor Audit Trail**: Recorded and displayed the actual user name (`$user->name`) executing backups across manual and automated operations in the manifest history.
  - **Interactive Table Structure & Data Row Preview**: Added multi-tab modal in `backup-db` allowing administrators to inspect column schemas, foreign key mappings, and actual live data row records.
  - **Automated Scheduled Backup Command**: Created `AutoBackupDatabase` artisan command and registered in `routes/console.php` with configurable retention policies and cron scheduler.
- **Hierarchical Visual CRUD Permissions Matrix (`usermanagement/*`)**:
  - **Permission Matrix Engine (`PermissionMatrixService.php`)**: Built dynamic hierarchical mapping connecting Main Menus and Sub-Menus with standard CRUD actions (`create`, `read`, `update`, `delete`), non-standard actions (`sort`, `export`), and row-level toggle switches.
  - **Reusable Matrix Blade Component (`crud-matrix-table.blade.php` & `crud-matrix-helper.js`)**: Designed a unified visual matrix featuring search filtering, *Pilih Semua*, *Kosongkan*, indent tree branches (`└─`), parent/sub-module badges, and row-level toggle master checkboxes.
- **Complete User Management Suite**:
  - **Roles Management (`usermanagement/roles`)**: Interactive Metronic cards grid, avatar stack, CRUD Matrix add/edit/view modals, and system role protection (`master` & `admin`).
  - **Permissions Management (`usermanagement/permissions`)**: Full CRUD DataTables, module grouping, and automated CRUD permission generator (`create,read,update,delete,sort,export`).
  - **Role Access Matrix (`usermanagement/akses-role`)**: Multi-role tabbed matrix management with realtime zero-reload permission syncing and button loading spinners.
  - **User Access & Direct Permission Override (`usermanagement/akses-user`)**: User role assignment dialog and direct permission override modal integrated with the visual CRUD Matrix.
- **UI/UX & System Standards Compliance**:
  - Full adherence to Zero-Reload Realtime Policy (AJAX/Fetch + SweetAlert2 + live DOM sync).
  - Standardized button loading spinners (`data-kt-indicator="on"`).
  - Pure Metronic 8.3.2 utility styling with zero custom per-page CSS, clean heading typography (No-Icon Policy), and full Dark/Light Mode harmony.

---

## [v1.22.0] - 2026-09-16

### Added & Enhanced
- **Avatar Studio Modal Khusus**:
  - Dynamic zoom control up to 5x with 2-axis (X/Y) focal adjustment.
  - Grid alignment for "Profil Saya" tab and global avatar rendering helper.

---

## [v1.21.0] - 2026-09-16

### Added & Enhanced
- **User Management Module (`usermanagement/users`)**:
  - **Full MVC & Form Request Architecture**: Implemented `UserController` with complete CRUD, searching, role filtering, verification status filtering, sorting, and dedicated Form Requests (`UserStoreRequest` & `UserUpdateRequest`).
  - **Zero-Reload Realtime CRUD & DataTables AJAX**: Integrated server-side Yajra DataTables and instant Card View synchronization with SweetAlert2 notifications and button loading indicators (`data-kt-indicator="on"`).
  - **Multi-Role Assignment & Presentation**: Supported multiple roles per user with Select2 multi-select (`name="roles[]"`), automated role synchronization (`syncRoles`), and multi-badge color-coded rendering.
  - **Profile Cover Header Integration for Cards & Detail Modal**:
    - Connected cards header and detail modal header with the user's database cover settings (`cover_background`, `cover_opacity`, `cover_overlay_color`, `cover_position_y`, `cover_blur`).
    - Standardized square avatars (`rounded-3`) focusing on the top part of the image with a clean presentation.
- **Modular Blade Partials & Operational Guidelines Policy**:
  - Structured module views into 6 modular partials under `resources/views/pages/usermanagement/partials/` (`users-filter-aside.blade.php`, `users-cards-pane.blade.php`, `users-cards-list.blade.php`, `users-table-pane.blade.php`, `users-form-modal.blade.php`, `users-detail-modal.blade.php`).
  - Added operational guideline partial (`users-petunjuk.blade.php`).
  - Established system rule #6 in `AGENTS.md` and created standard rule documentation `.agents/rules/module-partials-and-operational-guidelines.md`.

---

## [v1.20.0] - 2026-09-16

### Added & Enhanced
- **Dashboard Dynamic Hero Banner Integration (v1 & v2)**:
  - **Dynamic Cover & User Identity (`_content.blade.php`)**: Connected dashboard hero banner with authenticated user's dynamic cover (`cover_bg_url`), vertical focus position (`cover_position_y`), overlay contrast, and backdrop filters.
  - **Side-by-Side User Avatar & Motto Presentation**: Embedded user avatar (`symbol-70px symbol-lg-90px`) aligned horizontally to the left of the user's full name and life motto with high-contrast text shadowing.
  - **Dashboard v2 Synchronization**: Updated `dashboard-content-v2.blade.php` and `_dashboard-v2.blade.php` to render the unified dashboard layout and hero identity banner.
- **User Life Motto ("Moto Hidup") Field & Multi-Tab Management**:
  - **Database Migration (`2026_09_16_061820_add_moto_hidup_to_users_details_table.php`)**: Added `moto_hidup` (`TEXT`, nullable) column to `users_details` table.
  - **Model & Controller (`UserDetail.php` & `ProfilPenggunaController.php`)**: Added fillable attribute and dedicated endpoint `POST /profil/profil-pengguna/moto-hidup` (`updateMotoHidup`).
  - **Tab Profil Saya & Identitas Diri Inputs**: Added realtime AJAX form with Metronic button spinner (`data-kt-indicator="on"`) and zero-reload DOM synchronization.
- **Topbar User Avatar Alignment for Version v2**:
  - Replaced legacy image tag in `__topbar-v2.blade.php` with the standardized `image-input-wrapper` pattern and element IDs (`header_navbar_user_avatar`, `header_user_avatar_toggle`) matching v1 (`_navbar.blade.php`).

---

## [v1.19.0] - 2026-09-16

### Added & Refactored
- **User Settings 1-Row-Per-User JSON Schema Architecture**:
  - **Database Migration (`2026_09_16_000001_rebuild_users_settings_table_to_json_structure.php`)**: Rebuilt `users_settings` table from an Entity-Attribute-Value (EAV) multi-row design into an optimized 1-row-per-user schema with categorized `JSON` columns (`profile_cover`, `preferences`, `custom`) and seamless automated data aggregation migration (*Zero Data Loss*).
  - **Model & Helper Harmonization (`UserSetting.php` & `User.php`)**: Implemented attribute casting, column mapping (`getColumnForKey`), and helper methods (`getSetting`, `setSetting`, `toFlatArray`) maintaining 100% backward compatibility for `$user->setting()` and `$user->setSetting()`.
- **Realtime Lock Screen Modal Avatar Synchronization**:
  - **Dynamic Modal Updater (`profil-pengguna.blade.php`)**: Enhanced `updateAvatarImages()` to instantly update `#lock_screen_avatar_img` and dispatch global `kt.user.updated` events whenever user uploads or removes their avatar.
  - **Lock Screen Module API (`lock-screen.js`)**: Added `updateUser(userData)` API and event listener to ensure lock screen modal avatar and user info stay in sync without requiring page reloads (*Zero-Reload Policy*).
- **Profile Cover Default Settings & Live Adjustment**:
  - Refined default cover settings to 30% vertical focus position, 250px header height, 60% overlay contrast thickness, and dark tint overlay (`#000000`) across controller, blade views, and quick preset controls.
- **Two-Column Responsive Layout for User Preferences Card**:
  - Reorganized `form_preferensi_konfigurasi` in `konfigurasi.blade.php` into a sleek 2-column responsive layout:
    - **Column 1**: Notification channels (Email, WhatsApp/SMS), Account Security (Auto Lock Screen, 2FA), and Interface Appearance (Language & Theme).
    - **Column 2**: Advanced Preferences & Extension Slots (Data Saver mode, Weekly Activity Digest callouts).

---

## [v1.18.0] - 2026-09-16

### Added & Enhanced
- **Profile Cover Background & Live Contrast Customization Studio**:
  - **Live Cover Customization Controls (`konfigurasi.blade.php`)**: Added interactive controls for profile header cover including custom image upload with instant client-side `FileReader` preview, reset/remove action, vertical position slider & quick presets (Top 0%, Middle 50%, Bottom 100%), header minimum height slider & presets (Compact 220px, Normal 280px, Tall 360px, Extra 450px), opacity overlay slider (0–100%), color tint picker (Dark Slate, Dark Navy, Pitch Black, Emerald, Royal Violet), and backdrop blur filter (0–15px).
  - **Zero-Reload Realtime Sync (`details.blade.php` & `profil-pengguna.blade.php`)**: Realtime dynamic DOM style synchronization between the configuration studio sliders/inputs and the active profile header details banner without requiring page reload.
  - **Dual-Section Configuration Form**: Structured into two dedicated card forms: "Kustomisasi Background & Kontras Header Profil" (`form_cover_konfigurasi`) and "Preferensi & Notifikasi Pengguna" (`form_preferensi_konfigurasi`) with full backward-compatibility for standard form submissions.
  - **Model & Controller Support (`User.php` & `ProfilPenggunaController.php`)**: Added `cover_bg_url` computed attribute on `User` model, file storage handling under `public/covers`, removal logic, and setting persistence (`cover_opacity`, `cover_overlay_color`, `cover_position_y`, `cover_height`, `cover_blur`).
  - **Automated Feature Tests (`ProfilPenggunaTest.php`)**: Added test cases for cover background upload, custom settings persistence, and cover removal.

### Refactored
- **Master Data Menu Seeder Realignment**:
  - Relocated `Data Login` menu definition from `masterdata-appsupport_seeder.php` to `masterdata-usermanagement_seeder.php` targeting route `usermanagement.data-login`.

---

## [v1.17.1] - 2026-09-16

### Enhanced & Fixed
- **Dark Mode Support & Visual Alignment for Help Documentation Routes**:
  - **Adaptive Design Tokens (`_schema-ui.blade.php`)**: Implemented complete dark mode CSS variables (`[data-bs-theme="dark"]`, `[data-theme="dark"]`, `.dark-mode`) for backgrounds, surface cards, text colors, and borders across all 26 schema and operational help pages.
  - **High-Contrast Code & Shell Styling**: Styled `pre.schema-code`, inline `<code>`, `.schema-shell`, `.schema-hero`, `.schema-card`, `.schema-note`, `.schema-warn`, `.schema-step`, and `.schema-chip` with high contrast, legible typography, and sleek Metronic-aligned dark aesthetics.
  - **Overview Page Optimization**: Refined card and icon classes in `overview.blade.php` to ensure sharp contrast in dark mode without text/background collision.

---

## [v1.17.0] - 2026-09-16

### Refactored & Reorganized
- **Main Menu Domain Architecture & Restructuring (Dashboards & Demos)**:
  - **View Relocation**: Moved view templates from `pages/dashboards/` and `pages/demo/` to `resources/views/pages/main/` (`main/dashboards/` and `main/demo/`).
  - **Unified Sidebar Config**: Consolidated all dashboard and demo sidebar menus into `config/sidebar/_sidebar_main.php` and cleaned up deprecated files (`_sidebar_dashboard.php` & `_sidebar_demo.php`).
  - **Routing & URL Prefix Alignment**: Dynamic route generator in `routes/menu.php` now serves `/main/dashboards/*` and `/main/demo/*` with route names `main.dashboards.*` and `main.demo.*`.
  - **Header Menu Synchronization**: Updated `config/header/_header_dashboard.php` and `config/header/_header_demo.php` along with active state matching.
  - **Hierarchical Breadcrumbs**: Enhanced `app/Helpers/GetPageTitle.php` to resolve 3-level breadcrumb ancestors: `Home` → `Main Menu` → `Dashboard` / `Demo` → `[Active Page]`.
  - **Bilingual Translations**: Added dictionary keys (`mainmenu`, `main_menu`, `main`, `dashboard`, `dashboards`) in `lang/id/menu.php`, `lang/en/menu.php`, and `public/assets/js/custom/language.js`.
  - **Widget Automation**: Updated scan paths in `distribusi-widget.blade.php`, `distribusi-demo.blade.php`, and scripts (`sync-widgets-demo.ps1`, `merge-flexible-widgets.ps1`).

---

## [v1.16.2] - 2026-09-16

### Enhanced
- **Button Loading Spinners & Validation Visual Consistency**:
  - Added button loading spinner standards and indicators across auth and UI forms.
  - Standardized toolbar actions and login/register visual feedback.

---

## [v1.16.1] - 2026-09-15

### Fixed & Enhanced
- **Lock Screen Idle & User Preference Synchronization**:
  - Enhanced `public/assets/js/custom/lock-screen.js` to respect user's profile autolock preference via `data-autolock-enabled` in `resources/views/layouts/index.blade.php` and `index-v2.blade.php`.
  - Added graceful 401 unauthenticated session expiry handling with interactive re-login action link.
- **Profile Avatar Sizing & Image-Input State Alignment**:
  - Restored details avatar sizing in `resources/views/pages/profil/partials/details.blade.php` to native Metronic dimensions (160px desktop / 100px mobile) via `.symbol-label` without altering background rendering or zero-reload behavior.
  - Added conditional `.image-input-empty` state to `resources/views/pages/profil/partials/tabs/profil-saya.blade.php` to ensure avatar remove button visibility matches empty/filled status consistently across reloads.
  - Fixed dangling Bootstrap tooltip persistence upon clicking avatar remove button in `resources/views/pages/profil/profil-pengguna.blade.php`.
- **Environment Template (.env.example) Synchronization**:
  - Updated `.env.example` with `CACHE_STORE=database` and verified complete parity with `.env`.

---

## [v1.16.0] - 2026-09-15

### Refactored & Reorganized
- **Domain Namespaces Reorganization for Models, Controllers, & Factories**:
  - **Models Sub-Namespacing (`app/Models/`)**:
    - `App\Models\AppSupport`: `AppFitur.php`, `AppSetting.php`, and `Menu.php`.
    - `App\Models\UserManagement`: `User.php`, `Role.php`, and `Permission.php`.
    - `App\Models\Profil`: `UserDetail.php`, `UserLog.php`, and `UserSetting.php`.
    - Removed duplicate root models from `app/Models/`.
  - **Controllers & Assets Realignment**:
    - Moved `UserController.php` to `App\Http\Controllers\UserManagement\UserController.php` with updated routes (`usermanagement.users.*`).
    - Moved user management assets to `public/assets/js/usermanagement/users.js`.
    - Cleaned up obsolete `ManajemenPengguna` folders and references.
  - **Database & Factories**:
    - Reorganized `UserFactory` into `Database\Factories\UserManagement\UserFactory.php` with explicit model resolution.
    - Updated `config/auth.php` and `config/permission.php` with new model namespaces.
    - Re-aligned all seeders (`DatabaseSeeder`, `UserSeeder`, `RoleSeeder`, `MenuSeeder`, `AppFiturSeeder`, `AppSettingSeeder`) and test suites.

---

## [v1.15.1] - 2026-09-15

### Fixed & Enhanced
- **Zero-Flicker Bilingual Multi-Environment & Fresh-Seed Hardening**:
  - `app/Support/LanguageManager.php`: Added `clearCache()` and updated `getClientPayload()` to dynamically refresh the active request locale without locking stale locale dictionaries in the application cache.
  - `app/Http/Middleware/SetLocale.php`: Enhanced multi-variant cookie parsing (`kt_lang`, `data-kt-lang`, `$request->cookie()`, `$_COOKIE`) and added cookie queuing (`Cookie::queue()`) on each valid request for instant SSR localization alignment across page navigations.
  - `resources/views/partials/lang/_init.blade.php` & `public/assets/js/custom/language.js`: Synchronously persisted both `kt_lang` and `data-kt-lang` cookies during client-side language switching before subsequent page navigation requests.
  - `database/seeders/DatabaseSeeder.php`, `MenuSeeder.php`, `AppSettingSeeder.php`: Automated cache clearing for `LanguageManager`, `AppSetting`, and `kt_language_client_payload` during `php artisan migrate:fresh --seed` across different environments.

---

## [v1.15.0] - 2026-09-15

### Added
- **Modul Profil Pengguna 5-Tab & Zero-Reload CRUD Engine**:
  - Implemented 5 interactive tabs: Profil Saya, Identitas Diri, Ganti Password, Konfigurasi, and Riwayat Pengguna.
  - Direct KTP photo upload with preview modal and automatic download functionality.
  - Animated profile completion percentage calculation based on mandatory and optional fields.
  - Standardized Zero-Reload Realtime CRUD Policy in `AGENTS.md` and `.agents/rules/crud-zero-reload-realtime-standards.md`.

---

## [v1.14.0] - 2026-09-15

### Added
- **Islamic Hijri Day Names & Two-Line Toolbar Date Display**:
  - Added Islamic day names (`Al-Ahad`, `Al-Ithnayn`, `Al-Thulatha`, `Al-Arbi'a`, `Al-Khamis`, `Al-Jum'ah`, `Al-Sabt`) to `toHijriah()` in `app/Helpers/helpers.php`.
  - Implemented a 2-line Gregorian & Islamic Hijri date layout in the toolbar without increasing header, page title, or breadcrumb height.
  - Retained responsive mobile tooltip displaying complete bilingual date information.
- **Agent Guidelines & Anti-Regression Rules**:
  - Added `AGENTS.md` and `.agents/rules/efficiency-and-targeted-execution.md` enforcing targeted testing and strict backward-compatibility preservation.

### Enhanced & Fixed
- **Zero-Flicker Instant Bilingual Localization (SSR & DOM Sync)**:
  - Enhanced `translateMenuTitleSafely()` in `app/Helpers/GetPageTitle.php` with bidirectional `textMap` lookup (`id_to_en` & `en_to_id`) from `LanguageManager`, completely eliminating language flicker/flash on page refresh or navigation for both English and Indonesian.
  - Partitioned `sidebarAdditionalMenuSections()` static cache by `app()->getLocale()`.
  - Added `data-kt-translate` and safe translation resolvers across sidebar menu items, header mega menus, and page title components.
- **Realtime Icon Style Switcher & Database Sync Authority**:
  - Fixed toolbar/topbar icon switcher (`duotone`, `solid`, `outline`) to preview and switch in realtime without breaking dropdown checkmarks or losing duotone sidebar paths.
  - Added path protection (`data-kt-icon-style-ignore="true"`) to icon previews.
  - Synchronized icon style updates with database settings and App Support settings tab.
- **Public Route & Welcome Page Authentication Independence**:
  - Fixed routing so guests and all user roles can access the frontpage/welcome page after logout without authentication redirect loops.

---

## [v1.13.0] - 2026-09-09

### Added
- **Manajemen Pengguna (User Management) Full CRUD Module**:
  - `app/Http/Controllers/ManajemenPengguna/UserController.php`: Full CRUD operations (list, create, store, edit, update, delete, reset-password) with database transaction safety and validation.
  - `app/DataTable/ManajemenPengguna/UserDataTable.php`: Dedicated Yajra DataTables service class using `use Illuminate\Database\Eloquent\Builder as QueryBuilder;` and `DataTables::eloquent()`.
  - `app/Http/Requests/ManajemenPengguna/UserRequest.php`: Robust validation for avatar image uploads, unique email per user, passwords, and Spatie roles.
  - `resources/views/pages/usermanagement/users.blade.php`: Modern Metronic card UI with responsive search, role filters, real-time reload, and action tooltips.
  - `resources/views/pages/usermanagement/partials/users-form-modal.blade.php` & `users-detail-modal.blade.php`: Form modal with avatar preview, edit support, and detail view.
  - `public/assets/js/manajemenpengguna/users.js`: Client-side AJAX submission with FormData multipart, real-time header avatar live update, SweetAlert2 confirm dialogs, and toast notifications.
  - `database/migrations/2026_09_09_000001_add_avatar_to_users_table.php`: Added nullable `avatar` column to `users` table.
  - `public/assets/js/manajemenpengguna/users.js`: Client-side AJAX submission with FormData multipart, real-time header avatar live update, SweetAlert2 confirm dialogs, and toast notifications.
  - `database/migrations/2026_09_09_000001_add_avatar_to_users_table.php`: Added nullable `avatar` column to `users` table.

### Enhanced
- **Pure Indonesian UI & Zero Bilingual Leftovers**:
  - Refined all text labels, table headers, modal fields, validation messages, and action tooltips across the User Management module to pure, natural Indonesian (removed all bilingual dual notations such as `(Role)`, `(Avatar)`, `Master Data` $\rightarrow$ `Data Master`, `Refresh` $\rightarrow$ `Segarkan`, `Reset` $\rightarrow$ `Atur Ulang`).
  - Updated DataTables language dictionary and SweetAlert prompt messages to pure Indonesian.
  - Updated user account dropdown (`resources/views/partials/menus/_user-account-menu.blade.php`) to use Indonesian translations directly.

---

## [v1.12.1] - 2026-09-09

### Fixed & Optimized
- **High-Performance In-Memory Static Memoization & Query Overhead Elimination**:
  - `app/Models/AppSetting.php` & `app/Models/AppFitur.php`: Added static `$memoryMap` request lifecycle memoization, eliminating 2,850+ repeated database cache queries per single request down to ~5 queries (99.8% database overhead reduction).
  - `app/Support/ThemeVersion.php` & `app/Support/Frontpage.php`: Added request-level memoization for default/available variants to reduce repetitive string and config operations.
  - `app/utils/helper.php`: Added static memoization to `sidebarAdditionalMenuSections()` and unified `isFeatureActive()` with `app_fitur()` cached map.
  - `resources/views/layouts/index.blade.php` & `index-v2.blade.php`: Added `<link rel="preconnect">` for Google Fonts to prevent render-blocking DNS/TLS latency.
  - Configured `CACHE_STORE=file` in `.env` and `.env.example`.

---

## [v1.12.0] - 2026-09-09

### Added
- **Zero-Boilerplate Automatic Hierarchical Page Title & Breadcrumbs Engine**:
  - `app/Helpers/GetPageTitle.php`: Multi-layer fallback resolver (`config/menu_seeder.php`, database `menus` table, `sidebar.*` config, and dynamic URL segments).
  - Ancestral Breadcrumbs Trail: Breadcrumb strictly displays ancestor navigation hierarchy without redundantly repeating the active page title at the end.
  - Safe Bilingual Translation: Helper `translateMenuTitleSafely()` seamlessly resolves translation keys and plain strings for EN & ID.
  - Smart Layout Toolbar Fallback: Updated `resources/views/layouts/_default.blade.php` with `@hasSection('toolbar') @yield('toolbar') @else @include('layouts.partials._toolbar') @endif` so child views require zero boilerplate `@section('toolbar')`.
  - Unified Theme v1 & Theme v2 Page Title Partials: `_page-title.blade.php` and `_page-title-v2.blade.php` render localized titles and hierarchical ancestor trails.
- **Help Documentation (Skema & Operasional)**:
  - Added Skema: `resources/views/pages/help/pemrograman/skema/page-title-dan-breadcrumbs.blade.php` and `docs/skema-pemrograman/skema/page-title-dan-breadcrumbs.md`.
  - Added Operasional: `resources/views/pages/help/pemrograman/operasional/panduan-page-title-dan-breadcrumbs.blade.php` and `docs/skema-pemrograman/operasional/panduan-page-title-dan-breadcrumbs.md`.
  - Added `.schema-col-4` (spans 4 columns / full width 3-column grid) in `_schema-ui.blade.php` for developer QA checklist cards.
  - Updated Help Overview catalog and markdown index (`docs/skema-pemrograman/README.md`).

### Enhanced
- **Selective Localization Boundary & Bilingual Menu Parity**:
  - Sidebar and Toolbar maintain 100% bilingual synchronization (EN & ID) with explicit `title_key` entries across `config/sidebar/_sidebar_helps.php`, `lang/en/menu.php`, and `lang/id/menu.php`.
  - Help documentation content body isolated cleanly in standard Indonesian with `data-kt-lang-ignore="true"` to protect technical documentation from dynamic translation interference.
  - Updated realtime language engine in `public/assets/js/custom/language.js` with `help.*` translation maps and bumped cache version to `v: 6`.

---

## [v1.11.0] - 2026-09-09

### Added
- **Toolbar Gregorian & Hijri Bilingual Date Widget**:
  - Integrated full Gregorian and Hijri calendar dates into toolbar action area (`resources/views/layouts/partials/_toolbar.blade.php`).
  - Added global helper functions in `app/Helpers/helpers.php` (`renderDate()`, `toHijriah()`, and `renderGreeting()`).
  - Added dedicated bilingual translation dictionaries (`lang/id/translation.php` & `lang/en/translation.php`) for Gregorian/Hijri month names, suffixes (`M` / `AD`, `H` / `AH`), and greetings.
  - Autoloaded `app/Helpers/helpers.php` in `composer.json`.

### Enhanced
- **Responsive Mobile Toolbar Display**:
  - Automatically collapses date text to icon-only on mobile screens (`< 768px`) with `d-none d-md-inline`.
  - Added interactive Bootstrap/Metronic Tooltip (`data-bs-toggle="tooltip"`) on hover / touch displaying the complete bilingual date.
- **Realtime Client-Side Dual-Language Synchronization**:
  - Enhanced `KTLanguage` engine in `public/assets/js/custom/language.js` with `data-kt-lang-title-en` and `data-kt-lang-title-id` support for dynamic tooltip/title translations and HTML content in `[data-kt-lang-*]` attributes.

---

## [v1.10.0] - 2026-09-08

### Added
- **App Feature Visibility & Settings Module (`appsupport/app-fiturs`)**:
  - Full database-driven feature toggle management (`AppFitur` & `AppSetting` models) with cached lookup via `app_fitur()` helper.
  - Granular control over Topbar Tools, Topbar Menus, and Sidebar Menus.
  - Realtime client-side DOM toggling via `app-fiturs.js`, bulk category actions, live search & filter, and stats counters.
- **Theme v2 (Demo 2) Feature Visibility Integration**:
  - Integrated `app_fitur()` server-side checks and `data-kt-feature-tool` / `data-kt-feature-menu` DOM attributes into `__topbar-v2.blade.php` and `__menu-v2.blade.php`.
  - Unified feature visibility behavior seamlessly between Metronic Theme v1 and v2.
- **Dynamic Bilingual Page Title & Database Menu Lookup**:
  - Enhanced `getPageTitle()` helper in `GetPageTitle.php` to resolve `title_key` and query dynamic database `menus` table entries.
  - Removed static hardcoded `@section('title')` in App Support views for automatic bilingual translation (`lang/id/menu.php` and `lang/en/menu.php`).

### Changed
- **Sidebar Template Access Control**:
  - Restricted sidebar template sections exclusively to `master` and `admin` roles.
  - Added read permission bypass in `_menu-item.blade.php` for `master` and `admin` roles, preventing template menus from disappearing due to missing database permission rows.
- **System Settings Refinement**:
  - Cleaned up App Fiturs Settings tab to focus on Security & Access (public registration, session lifetime) and System Maintenance (instant cache cleaners).
  - Synchronized `AppSettingSeeder.php` to reflect the refined settings schema.

---

## [v1.9.0] - 2026-09-08

### Added
- **Frontpage Landing v1 Bilingual Localization**:
  - Full bidirectional English $\leftrightarrow$ Indonesian translation for Frontpage Landing v1 (`resources/views/frontpages/landing/v1/landing.blade.php`).
  - Created complete dictionaries `lang/en/landing.php` and `lang/id/landing.php`.
  - Added modular bilingual dropdown selector (`partials.lang._main`) to landing toolbar with language flag badges and active states.
  - Linked all text nodes with `data-kt-translate="landing.*"` and Laravel `__('landing.*')` helpers.
- **Realtime Instant Head & Meta Translation Engine**:
  - Added `applyHeadTranslations()` in `public/assets/js/custom/language.js` supporting zero-reload live translation for `<title>`, `document.title`, `<meta name="description">`, `<meta name="keywords">`, `<meta property="og:title">`, and `<meta property="og:locale">`.
  - Added smart parsing for compound dashboard titles (e.g. `Dashboards - Metronic 832` $\leftrightarrow$ `Dasbor - Metronic 832`).
  - Integrated head metadata translation across Dashboard layouts (`layouts/index.blade.php`, `layouts/index-v2.blade.php`, and `layouts/document832.blade.php`).

### Optimized
- **High-Performance $O(1)$ Zero-Delay Translation Engine**:
  - Eliminated linear search loops and regex iterations in `translateText()`, replacing them with pure $O(1)$ constant-time hash map lookups.
  - Reduced full DOM + meta translation time to $< 2\text{ms}$, eliminating all split-second delays during rapid language switching.
  - Added whitespace and multi-line normalization to `LanguageManager.php` and `language.js`.

### Fixed
- **Topbar Help Menu Dropdown Layout**:
  - Fixed full-screen stretching on topbar Help menu dropdown by standardizing PopperJS container configuration and CSS dimensions.
- **Dashboard v2 Seeder Menu Display**:
  - Displayed dynamic seeder database menus before dashboard in theme v2 with Apps-style pattern and icons.

---

## [v1.8.1] - 2026-09-07

### Added
- **Tree-Aware Drag & Drop Menu Reordering Engine**:
  - Hierarchical drag-and-drop menu reordering in `appsupport/menu` with live real-time sidebar synchronization.
  - Batch transactional order persistence endpoint `POST /appsupport/menu/reorder`.

---

## [v1.8.0] - 2026-09-07

### Added
- **Interactive Seeder Blueprint Builder for Menu Management**:
  - Visual seeder blueprint generator with live realtime PHP code exporter in `appsupport/menu`.

---

## [v1.7.1] - 2026-09-06

### Changed
- **Help Documentation Hardcoded Bahasa Indonesia**:
  - Standardized all internal documentation pages under `pages/help/pemrograman` (Overview, 16 Skema blueprints, 8 Operasional guides, Console Developer, and Changelog) to pure hardcoded Bahasa Indonesia without bilingual translation dependencies.
  - Cleaned up redundant help dictionary files (`lang/en/help.php`, `lang/id/help.php`) and audit script (`scripts/help_i18n_audit.php`).

### Added
- **DOM Translation Exemption Engine (`KTLanguage`)**:
  - Enhanced `shouldSkipElement()` in `public/assets/js/custom/language.js` to strictly skip containers marked with `data-kt-lang-ignore="true"`, `.schema-shell`, `.schema-hero`, and `.schema-card`.
  - Bumped and auto-invalidated stale client `localStorage` translation cache (`kt_translations_cache` v3).
- **Documentation Alignment**:
  - Added missing markdown documentation for Frontpage Switching (`pergantian-frontpage.md`), KeenIcons Switching (`pergantian-icon.md`), and Theme Multi-Version (`pergantian-versi-tampilan.md`).
  - Synchronized `README.md` and `docs/skema-pemrograman/README.md` with active project architecture and GitHub repository URL.

---

## [v1.7.0] - 2026-09-06

### Added
- **Realtime Bilingual Live Localization (`KTLanguage`)**:
  - Implemented dynamic, zero-reload switching between English and Indonesian across all pages, sidebars, headers, breadcrumbs, user dropdowns, and components in `< 5ms`.
  - Added non-destructive DOM `TreeWalker` engine in `public/assets/js/custom/language.js` that traverses and translates all visible text nodes without replacing HTML elements, preserving icons, bullets, badges, and event listeners intact.
  - Multi-attribute support: `data-kt-translate`, `data-kt-translate-placeholder`, `data-kt-translate-title`, `data-kt-lang-en`, and `data-kt-lang-id`.
- **Precompiled In-Memory Dictionary (`LanguageManager`)**:
  - Auto-compiles all translation files (`menu`, `help`, `auth`, `education`, `passwords`) into a flattened key-value dictionary and bidirectional mapped dictionary (2,171 keys per locale, 1,887 bidirectional text mappings).
  - Preloaded directly into `_init.blade.php` for zero-latency, 100% offline-ready client localization.
- **Multi-Layer State Persistence & Backend Sync**:
  - Saved language preference across `localStorage` (`data-kt-lang`), cookie (`kt_lang`), and background async fetch to `/lang/{locale}` for Laravel session synchronization.
- **Modular Dropdown Component (`partials.lang._main`)**:
  - Standardized Metronic styling (`w-175px`), active status classes, checkmarks, and flag indicators (US / ID).
- **Mobile Toolbar Hub Integration**:
  - Integrated language switcher into `#hub_panel_lang` inside `_mobile-toolbar-menu.blade.php`.
  - Cleaned redundant mobile header language icon on smaller screens with `d-none d-lg-flex`.

### Fixed
- Fixed partial menu translation issue by implementing dual-layer fallback text matching in `language.js`.
- Fixed missing translation key `skema_pergantian_icon` in `lang/en/menu.php` and `lang/id/menu.php`.
- Fixed dropdown layout stretching issue by standardizing container dimensions and PopperJS attachments.

---

## [v1.6.0] - 2026-09-03

### Added
- App Support Menu Management module (`appsupport/menu`) with single menu, sub-menu, and complete multi-level hierarchy builder (Level 1 &rarr; Level 2 &rarr; Level 3).
- Multi-lingual and metadata JSON synchronization for menu items.
- Permissions and Spatie roles integration with CRUD action badges.
- Modular route architecture with `routes/masterdata.php`.

---

## [v1.5.1] - 2026-08-30

### Fixed
- Fixed breadcrumb hierarchy and toolbar title duplication without regressions.
- Added code integrity and regression prevention guidelines.
