# Aturan Standar UI: Judul & Sub Judul Dilarang Menggunakan Ikon

## Scope & Trigger
Aturan ini **WAJIB** dipatuhi dalam pembuatan halaman baru, perombakan antarmuka (UI), atau pengeditan komponen di seluruh modul proyek (`appsupport/*`, `masterdata/*`, `apps/*`, `system/*`, dan semua modul lainnya).

---

## 1. Aturan Mutlak: Judul Maupun Sub Judul TIDAK PAKAI IKON

Untuk menjaga konsistensi visual dengan seluruh halaman template bawaan Veltronic / Metronic:

1. **DILARANG MENGGUNAKAN IKON** pada:
   - **Judul Halaman / Judul Header Banner** (contoh: *"Manajer Fitur & Pengaturan Sistem"*).
   - **Sub Judul Bagian / Section Header** (contoh: *"1. Fitur & Tools di Topbar Navbar"*, *"2. Menu Utama di Topbar Header"*, *"3. Menu Template di Sidebar"*).
   - **Header Sub Card / Form Groups / Accordion Header** (contoh: *"1. Identitas & Branding Aplikasi"*, *"2. Preferensi Tampilan Default"*).
   - **Navigasi Tab (`nav-line-tabs`)**: Tab wajib murni teks tanpa ikon (contoh: *"Visibilitas Fitur Dashboard"*, *"Pengaturan Aplikasi (Settings)"*).
   - **Judul Card Body / Card Header Title** yang berfungsi sebagai penamaan seksi/halaman.

2. **DILARANG MEMBUNGKUS DENGAN KOTAK / BULAT MAUPUN IKON LANGSUNG**:
   - Baik ikon langsung (`<i>...</i>`) maupun ikon berwadah (`<div class="symbol ...">`, `feature-icon-box`, bulat/kotak) **TIDAK BOLEH** dipasang di sebelah judul, sub judul, maupun tab navigasi.

3. **PENYAJIAN YANG BENAR**:
   - Menggunakan teks tipografi murni (`h1`-`h5`, `nav-link`) dengan class bawaan template (`fw-bolder`, `fw-bold`, `text-gray-900`) dan teks deskripsi pendukung (`text-muted fs-7/fs-8`).

---

## 2. Di Mana Ikon Boleh Digunakan?

Ikon **HANYA** digunakan untuk komponen aksi dan data:
- **Tombol Aksi**: `<button class="btn ..."><i class="ki-duotone ... me-1"></i> Simpan</button>`
- **Item Data / Grid Fitur**: Ikon representasi fitur individual di dalam kartu grid.
- **Badge Status Mini / Alert Icon**: Notifikasi toast/alert sistem.

---

## 3. Contoh Komparasi Standar

### A. Judul Header Banner

**❌ SALAH (Pakai Ikon / Kotak / Bulat):**
```html
<div class="d-flex align-items-center gap-4">
    <i class="ki-duotone ki-slider-vertical-2 fs-3x text-primary">...</i>
    <div>
        <h2 class="fw-bolder text-gray-900 m-0 fs-2">Manajer Fitur & Pengaturan Sistem</h2>
        <span class="badge badge-primary">...</span>
    </div>
</div>
```

**✅ BENAR (Murni Teks Judul & Deskripsi):**
```html
<div>
    <div class="d-flex align-items-center gap-2">
        <h2 class="fw-bolder text-gray-900 m-0 fs-2">Manajer Fitur & Pengaturan Sistem</h2>
        <span class="badge badge-primary fw-bold fs-8 px-3 py-1">Database-Backed Config</span>
    </div>
    <span class="text-muted fs-7 d-block mt-1">
        Atur visibilitas fitur dashboard serta kelola konfigurasi aplikasi secara permanen tanpa kedipan FOUC.
    </span>
</div>
```

---

### B. Sub Judul Seksi (*Section Header*)

**❌ SALAH (Pakai Ikon / Kotak / Bulat):**
```html
<div class="d-flex align-items-center gap-3">
    <i class="ki-duotone ki-wrench fs-2x text-primary">...</i>
    <div>
        <h4 class="fw-bolder text-gray-900 m-0">1. Fitur & Tools di Topbar Navbar</h4>
        <span class="text-muted fs-8">Tombol aksi cepat...</span>
    </div>
</div>
```

**✅ BENAR (Murni Teks Sub Judul & Keterangan):**
```html
<div>
    <h4 class="fw-bolder text-gray-900 m-0">1. Fitur & Tools di Topbar Navbar</h4>
    <span class="text-muted fs-8">Tombol aksi cepat di sudut kanan atas navbar.</span>
</div>
```

---

### C. Header Form Group / Pengaturan

**❌ SALAH (Pakai Ikon):**
```html
<div class="card-header bg-light py-3 px-6 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
        <i class="ki-duotone ki-badge fs-2 text-primary">...</i>
        <h5 class="fw-bolder text-gray-900 m-0">1. Identitas & Branding Aplikasi</h5>
    </div>
    <span class="badge badge-light-info fs-8">General Info</span>
</div>
```

**✅ BENAR (Tanpa Ikon):**
```html
<div class="card-header bg-light py-3 px-6 d-flex align-items-center justify-content-between">
    <h5 class="fw-bolder text-gray-900 m-0">1. Identitas & Branding Aplikasi</h5>
    <span class="badge badge-light-info fs-8">General Info</span>
</div>
```

---

## 4. Checklist Kepatuhan Modul (Wajib Dicek)
- [ ] Apakah judul utama / banner header sudah **100% bebas ikon**?
- [ ] Apakah semua sub judul (seksi 1, 2, 3, dst.) sudah **100% bebas ikon**?
- [ ] Apakah header grup formulir / accordion sudah **100% bebas ikon**?
- [ ] Apakah tipografi judul dan deskripsi sudah rapi menggunakan class bawaan Metronic?
