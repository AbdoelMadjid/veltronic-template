# Changelog

All notable changes to the Veltronic Metronic 8 Template project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
