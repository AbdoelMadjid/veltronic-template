# Standar Struktur Kartu (Card Structure) & Responsif Mobile

## 1. Prinsip Utama & Struktur Modular Kartu
Setiap kartu modul, pengaturan, formulir, atau seksi konten di Veltronic/Metronic wajib dibangun dengan struktur terpadu:
1. **Container Kartu**: `card shadow-sm border border-gray-200 h-100 d-flex flex-column`
   - Memiliki batas fisik tegas (*subtle border*) dan bayangan lembut (*shadow-sm*) tanpa warna hardcoded.
2. **Header Kartu (`card-header`)**:
   - Memiliki garis pembatas bawah `border-bottom border-gray-200`.
   - Menggunakan tata letak responsif `d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0`.
3. **Body Kartu (`card-body`)**:
   - Padding adaptif yang konsisten: `py-6 px-4 px-md-6 flex-grow-1`.
4. **Footer Kartu (`card-footer`)**: (Jika diperlukan ringkasan, status, atau tombol aksi)
   - Memiliki garis pembatas atas `border-top border-gray-200` dengan latar belakang bernada kontras lembut `bg-light bg-opacity-50`.
   - Padding adaptif: `py-4 px-4 px-md-6 mt-auto`.

---

## 2. Aturan Judul Header Bersih (No Icon Box Policy)
- Judul kartu pada `card-header` **DILARANG** menggunakan kotak simbol ikon (`symbol symbol-circle` / `symbol-45px`) di samping teks judul.
- Judul harus bersih (*clean typography*) menggunakan:
  - Judul: `<h3 class="fw-bolder text-gray-900 m-0 fs-4">[Judul Kartu]</h3>` (atau `h4`)
  - Subketerangan: `<span class="text-muted fs-7 mt-1">[Subjudul / Deskripsi Pendukung]</span>`
- Sisi kanan header (*toolbar*) menampung badge kategori (`h-35px px-3 fs-7`) atau tombol aksi cepat.

---

## 3. Aturan Rata Tengah di Mode Mobile (Mobile Center Alignment)
- Pada perangkat **mobile (`< md` atau `< sm`)**, seluruh susunan teks judul header, toolbar, dan footer **WAJIB RATA TENGAH (`text-center`)**:
  - **Header Container**: `d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0`
  - **Teks Header**: `d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto`
  - **Toolbar Header**: `d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0`
  - **Footer Container**: `d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between text-center text-sm-start gap-2`

---

## 4. Standar Tombol Solid Penuh (Full Button Policy)
- Tombol aksi pada kartu (aksi massal, submit, toggle, dsb.) saat berada pada mode mobile **WAJIB MENAMPILKAN TEKS LABEL UTUH** (*Full Button*), dilarang menyembunyikan teks menjadi ikon kecil samar (`btn-light-*` tanpa teks).
- Gunakan tombol solid penuh warna yang tegas (`btn-primary`, `btn-success`, `btn-danger`) dengan ikon putih (`text-white`) agar memiliki kontras tinggi dan mudah ditekan (*touch-friendly*).
- Ketinggian elemen (tombol, badge penghitung, checkbox) harus diselaraskan secara presisi (`h-32px`, `h-35px`, atau `h-38px`).

---

## 5. Contoh Implementasi Standar (Template Blade)

```blade
<div class="card shadow-sm border border-gray-200 h-100 d-flex flex-column justify-content-between">
    <!--begin::Card header-->
    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0 border-bottom border-gray-200">
        <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
            <h3 class="fw-bolder text-gray-900 m-0 fs-4">Judul Kartu Pengaturan</h3>
            <span class="text-muted fs-7 mt-1">Deskripsi singkat fungsi pengaturan atau konten modul</span>
        </div>
        <div class="card-toolbar d-flex align-items-center justify-content-center justify-content-md-end w-100 w-md-auto mt-2 mt-md-0">
            <span class="badge badge-light-primary fw-bold px-3 fs-7 d-inline-flex align-items-center justify-content-center h-35px w-100 w-md-auto">
                Kategori
            </span>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-6 px-4 px-md-6 flex-grow-1">
        <!-- Konten / Formulir Kartu -->
    </div>
    <!--end::Card body-->

    <!--begin::Card footer-->
    <div class="card-footer py-4 px-4 px-md-6 mt-auto border-top border-gray-200 bg-light bg-opacity-50">
        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-sm-between text-center text-sm-start gap-2">
            <div class="d-flex align-items-center gap-2 text-muted fs-7">
                <i class="ki-outline ki-information-2 fs-5 text-primary"></i>
                <span>Ringkasan status atau informasi bantuan</span>
            </div>
            <span class="badge badge-light-primary fw-semibold fs-8">Status Info</span>
        </div>
    </div>
    <!--end::Card footer-->
</div>
```
