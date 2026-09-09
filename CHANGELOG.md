# Changelog

All notable changes to the Veltronic Metronic 8 Template project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
