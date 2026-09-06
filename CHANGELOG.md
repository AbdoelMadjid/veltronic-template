# Changelog

All notable changes to the Veltronic Metronic 8 Template project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
