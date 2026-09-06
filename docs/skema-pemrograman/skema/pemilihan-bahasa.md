# Skema Pemilihan Bahasa (Realtime Zero-Reload Bilingual Localization)

URL aplikasi: `/help/pemrograman/skema/pemilihan-bahasa`

[⬅ Kembali ke README Docs](../README.md)

Blueprint arsitektur lokalisasi bilingual **English & Indonesian** secara real-time di seluruh aplikasi tanpa reload layar (< 5ms), terintegrasi dengan engine `KTLanguage`, inisialisasi anti-flicker, sinkronisasi session latar belakang, dan pengamatan DOM dinamis.

Tag:
- `zero reload`
- `offline ready`
- `cookie & session sync`
- `ktlanguage engine`

---

## 1. Alur Siklus Hidup (Live Zero-Reload Flow)

1. **Load Awal Anti-Flicker**: `partials.lang._init` membaca `localStorage['data-kt-lang']` / Cookie `kt_lang` dan menyematkan `<html data-kt-lang="id" lang="id">` sebelum render selesai.
2. **Inisialisasi KTLanguage Engine**: `KTLanguage.init()` memuat kamus inti secara offline dan mengambil kamus penuh secara asinkron dari `/lang/translations.json` (atau payload in-memory Blade).
3. **User Mengubah Bahasa**: Saat user memilih English / Indonesia dari dropdown navbar, mobile toolbar, atau user menu:
   - Memperbarui atribut `data-kt-lang` dan `lang` pada `<html>`.
   - Menyimpan preferensi ke `localStorage` dan Cookie `kt_lang`.
   - Mengirim request fetch asinkron ke `/lang/{locale}` untuk sinkronisasi Session Laravel di latar belakang.
   - Memperbarui bendera aktif dan checkmark pada dropdown seketika.
   - Menerjemahkan teks DOM secara live via `data-kt-translate` dan kamus dua arah (EN ↔ ID).
   - Memicu event kustom `kt.lang.change`.
4. **Observasi Dinamis (MutationObserver)**: Elemen baru yang dimasukkan via modal atau AJAX otomatis diterjemahkan sesuai bahasa aktif.
5. **Pengecualian Konten Help**: Kontainer dengan `data-kt-lang-ignore="true"`, `.schema-shell`, `.schema-hero`, dan `.schema-card` secara otomatis diabaikan agar dokumen internal tetap berbahasa Indonesia murni.

---

## 2. Struktur Komponen & File Terkait

- `public/assets/js/custom/language.js`: Engine utama `KTLanguage` untuk manipulasi DOM dan sync.
- `resources/views/partials/lang/_init.blade.php`: Script inisialisasi awal di layout head.
- `resources/views/partials/lang/_main.blade.php`: Komponen dropdown pilihan bahasa universal (navbar, topbar v2).
- `app/Support/LanguageManager.php`: Backend helper untuk mengelola locale dan kompilasi kamus terjemahan JSON.
- `app/Http/Middleware/SetLocale.php`: Middleware runtime dengan fallback session dan cookie `kt_lang`.
- `routes/web.php`: Endpoint `/lang/{locale}` (AJAX JSON) dan `/lang/translations.json`.

---

## 3. API JavaScript (KTLanguage)

```javascript
// Mengambil bahasa yang aktif saat ini ('en' | 'id')
var currentLang = KTLanguage.getLanguage();

// Mengubah bahasa secara programatik tanpa reload
KTLanguage.setLanguage('id'); // 'en' atau 'id'

// Mengambil string terjemahan berdasarkan key
var text = KTLanguage.translate('menu.dashboards', 'id'); // "Dasbor"

// Menerapkan terjemahan pada kontainer tertentu
KTLanguage.apply(document.querySelector('#modal_content'), 'id');

// Mendengarkan event perubahan bahasa
document.documentElement.addEventListener('kt.lang.change', function (e) {
    console.log('Language changed to:', e.detail.locale);
});
```

---

## 4. Panduan Menulis Elemen di Blade

```html
<!-- Opsi A: Menggunakan data-kt-translate (Direkomendasikan) -->
<span class="menu-title" data-kt-translate="menu.my_profile">
    {{ __('menu.my_profile') }}
</span>

<!-- Opsi B: Placeholder & Title Input -->
<input type="text"
    data-kt-translate-placeholder="menu.search_menu_placeholder"
    placeholder="{{ __('menu.search_menu_placeholder') }}" />

<!-- Opsi C: Pengecualian Translasi (Konten Hardcoded) -->
<div data-kt-lang-ignore="true">
    <p>Teks ini tidak akan diterjemahkan oleh KTLanguage engine.</p>
</div>
```
