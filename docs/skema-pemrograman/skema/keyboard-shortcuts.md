# Skema Keyboard Shortcuts (Global Hotkeys & Action Registry)

Dokumen cetak biru arsitektur teknis sistem pintasan keyboard (hotkey) global pada aplikasi dengan otorisasi berbasis Role, deteksi dual-key, dan integrasi Action Registry modular.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Konsep & Arsitektur Utama
- **5-Tier Action Classification**: Seluruh shortcut dikelompokkan ke dalam 5 kategori:
  1. `visibility`: Toggle tampilan elemen (Sidebar, Header Menu, Toolbar Tools).
  2. `appearance`: Switch Dark/Light Mode, rotasi gaya KeenIcons.
  3. `system`: Lock screen instan, modal petunjuk modul.
  4. `nav`: Quick jump navigasi ke modul utama (Dashboard, Fitur, Profil, User Management).
  5. `element`: Interaksi elemen formulir, trigger modal, search bar.
- **Standar Bebas Benturan Browser**: Menggunakan standar kombinasi `Ctrl + Alt + [Key]` untuk mencegah benturan (collision) dengan hotkey sistem operasi dan pintasan bawaan web browser.
- **Dual-Key Matching (`e.key` & `e.code`)**: Engine mengevaluasi kode tombol fisik (`KeyT`) dan nama karakter (`t`/`T`) sehingga kebal terhadap status *Caps Lock* atau tombol *Shift*.
- **Role Scoping & JSON Policy**: Kolom `roles` pada tabel `app_shortcuts` mengatur otorisasi pengguna sehingga aksi berisiko tinggi hanya dapat dieksekusi oleh peran yang diizinkan (e.g. Master, Admin).

## 2. Struktur Data & File Terkait
- `app/Models/AppSupport/AppShortcut.php`: Model Eloquent untuk data pintasan keyboard.
- `database/migrations/2026_09_18_000001_create_app_shortcuts_table.php`: Migration tabel `app_shortcuts`.
- `database/seeders/AppShortcutSeeder.php`: Seeder 13 shortcut default.
- `public/assets/js/custom/shortcuts.js`: Engine client-side `VeltronicShortcuts` dan `ActionRegistry`.
- `app/Http/Controllers/AppSupport/AppFiturController.php`: Controller CRUD dan API endpoint `/appsupport/shortcuts-active`.

## 3. Registrasi Action Handler di JavaScript
```javascript
// Menambahkan handler aksi baru secara dinamis
window.VeltronicShortcuts.registerActionHandler('custom_print_report', function() {
    window.print();
});

// Menjalankan aksi programatik
window.VeltronicShortcuts.executeAction('toggle_sidebar');
```
