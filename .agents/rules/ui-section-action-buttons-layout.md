# Aturan Standar UI: Posisi & Tampilan Tombol Aksi Seksi/Header (Right-Aligned & Responsive)

## Scope & Trigger
Aturan ini **WAJIB** dipatuhi dalam pembuatan halaman baru, perombakan antarmuka (UI), atau pengeditan komponen di seluruh modul proyek (`appsupport/*`, `masterdata/*`, `apps/*`, `system/*`, dan semua modul lainnya).

---

## 1. Prinsip Utama: Tombol Aksi Wajib Selalu Rata Kanan (Right-Aligned)

Pada setiap header banner, seksi (*section header*), toolbar kartu (*card toolbar*), maupun baris kontrol yang memiliki **1 tombol aksi atau lebih**:

1. **POSISI TOMBOL DI SEMUA UKURAN LAYAR**:
   - Tombol aksi **WAJIB SELALU BERADA DI SEBELAH KANAN (RATA KANAN)**, terpisah secara rapi dari judul/teks seksi di sebelah kiri.
   - Gunakan flexbox utility: `d-flex align-items-center justify-content-between` dengan kontainer aksi yang memiliki `ms-auto flex-shrink-0`.
   - Hindari `flex-wrap` yang membuat tombol jatuh ke bawah lalu menempel di sebelah kiri.

2. **RESPONSIVE MOBILE / HP (SCREEN < SM / MD)**:
   - Pada layar ukuran mobile / HP, tombol aksi **HANYA MENAMPILKAN IKON SAJA** (teks label disembunyikan menggunakan utility `d-none d-sm-inline`).
   - Tombol **TETAP WAJIB RATA KANAN** di layar mobile, tidak boleh berantakan atau menempel di kiri.
   - Ikon tombol diberi `data-bs-toggle="tooltip"` dan atribut `title="..."` agar pengguna mobile tetap dapat membaca fungsi tombol saat disentuh/hover.

3. **WARNA IKON PADA TOMBOL (ANTI-HILANG SAAT HOVER)**:
   - **JANGAN** menambahkan class warna teks statis (seperti `text-success`, `text-danger`, `text-primary`) pada tag `<i>` di dalam tombol `btn-light-*`.
   - Hal ini karena saat tombol di-hover, latar belakang tombol berubah menjadi warna solid (`success`/`danger`) dan ikon dengan class warna statis akan tersamar/hilang tertutup warna latar.
   - Biarkan ikon mewarisi warna teks tombol secara natural (`<i class="ki-duotone ki-check-circle fs-6 me-0 me-sm-1">`).

---

## 2. Pola Penulisan Standar HTML & Bootstrap

### A. Pola Header Banner / Section Header dengan 1 Tombol

```html
<div class="card card-flush shadow-sm mb-6 border-0 bg-light-primary">
    <div class="card-body py-7 px-8">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-4">
            <!-- Sisi Atas (Mobile) / Kiri (Desktop): Judul & Keterangan -->
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h2 class="fw-bolder text-gray-900 m-0 fs-2">Judul Halaman</h2>
                    <span class="badge badge-primary fw-bold fs-8 px-3 py-1">Badge Info</span>
                </div>
                <span class="text-muted fs-7 d-block mt-1">Deskripsi ringkas modul...</span>
            </div>

            <!-- Sisi Bawah Rata Kanan (Mobile) / Kanan (Desktop): Tombol Aksi -->
            <div class="d-flex align-items-center justify-content-end w-100 w-md-auto flex-shrink-0 ms-md-auto">
                <button type="button" class="btn btn-sm btn-light-danger fw-bold"
                    data-bs-toggle="tooltip" title="Reset Default">
                    <i class="ki-duotone ki-arrows-circle fs-5 me-1">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                    Reset Default (Seeder)
                </button>
            </div>
        </div>
    </div>
</div>
```

---

### B. Pola Section Header / Card Pill dengan Banyak Tombol

```html
<div class="d-flex align-items-center justify-content-between category-header-pill mb-5 gap-3">
    <!-- Sisi Kiri: Sub Judul -->
    <div class="flex-grow-1 pe-2">
        <h4 class="fw-bolder text-gray-900 m-0">1. Nama Sub Bagian / Seksi</h4>
        <span class="text-muted fs-8">Keterangan sub seksi...</span>
    </div>

    <!-- Sisi Kanan: Tombol-tombol Aksi (Rata Kanan) -->
    <div class="d-flex align-items-center gap-2 flex-shrink-0 ms-auto">
        <button type="button" class="btn btn-xs btn-light-success py-1 px-2"
            data-bs-toggle="tooltip" title="Semua Aktif">
            <i class="ki-duotone ki-check fs-6 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
            <span class="d-none d-sm-inline">Semua Aktif</span>
        </button>
        <button type="button" class="btn btn-xs btn-light-danger py-1 px-2"
            data-bs-toggle="tooltip" title="Semua Nonaktif">
            <i class="ki-duotone ki-cross fs-6 me-0 me-sm-1"><span class="path1"></span><span class="path2"></span></i>
            <span class="d-none d-sm-inline">Semua Nonaktif</span>
        </button>
    </div>
</div>
```

---

## 3. Ringkasan Utility Class Kunci

| Kebutuhan Layout | Class Bootstrap / Metronic | Fungsi |
| :--- | :--- | :--- |
| **Pemisah Kiri - Kanan** | `justify-content-between align-items-center` | Memisahkan teks di kiri dan tombol di kanan |
| **Kunci Posisi Rata Kanan** | `ms-auto flex-shrink-0` | Memastikan wadah tombol selalu rapat kanan dan tidak terjepit |
| **Icon-Only di Mobile** | `<span class="d-none d-sm-inline">Label</span>` | Menyembunyikan teks label di layar HP sehingga hanya ikon yang tampil |
| **Jarak Ikon Responsif** | `me-0 me-sm-1` | Tanpa margin kanan saat mobile (hanya ikon), margin 1 saat ada teks di desktop |
| **Aksesibilitas Tooltip** | `data-bs-toggle="tooltip" title="..."` | Menampilkan penjelasan tooltip saat tombol icon-only dihover/tap |

---

## 4. Checklist Kepatuhan Modul
- [ ] Apakah tombol aksi pada header/seksi selalu berada di sisi kanan (`ms-auto flex-shrink-0`)?
- [ ] Apakah pada layar mobile tombol hanya menampilkan ikon (`d-none d-sm-inline` untuk teks)?
- [ ] Apakah tombol pada tampilan mobile tetap konsisten rata kanan?
- [ ] Apakah setiap tombol sudah dilengkapi `data-bs-toggle="tooltip"` dan `title`?
