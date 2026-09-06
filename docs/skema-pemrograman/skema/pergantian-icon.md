# Skema Pergantian Icon (KeenIcons Dynamic Switching)

Dokumen arsitektur dan alur teknis pergantian gaya ikon KeenIcons (Duotone, Solid, Outline) secara dinamis tanpa reload layar.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Konsep & Arsitektur Utama
- **KeenIcons Engine**: Metronic menyediakan 3 varian ikon utama: `duotone`, `solid`, dan `outline`.
- **Anti-Flicker Init**: Script inisialisasi pada `<head>` membaca preferensi dari `localStorage` / Cookie sebelum rendering selesai untuk mencegah flicker style icon.
- **Dynamic DOM Transformation**: Modul `KTIconStyle` memindai seluruh elemen dengan class `ki-duotone`, `ki-solid`, `ki-outline`, serta menyisipkan/membersihkan elemen span `path` secara real-time.
- **MutationObserver**: Mengamati perubahan DOM dinamis (misalnya modal baru atau konten AJAX) dan otomatis menyesuaikan style icon aktif.

## 2. Struktur Komponen & File Terkait
- `public/assets/js/custom/icon-style.js`: Engine utama `KTIconStyle` untuk transformasi DOM class dan path span.
- `resources/views/partials/icon-style/_init.blade.php`: Inisialisasi awal di layout head.
- `resources/views/partials/icon-style/_main.blade.php`: Dropdown pilihan gaya icon pada navbar/topbar.
- `config/icon-style.php`: Daftar varian icon dan default konfigurasi.

## 3. API JavaScript (KTIconStyle)
```javascript
// Mengambil gaya ikon aktif ('duotone' | 'solid' | 'outline')
var currentStyle = KTIconStyle.getStyle();

// Mengubah gaya ikon secara realtime
KTIconStyle.setStyle('outline');

// Menerapkan gaya ikon ke kontainer tertentu
KTIconStyle.apply(document.querySelector('#my_container'), 'solid');
```
