# Changelog

All notable changes to the Veltronic Metronic 8 Template project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
