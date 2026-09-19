# Aturan Standar UI: Responsif Modal Dialog (Header, Section Content, & Footer Buttons)

## Scope & Trigger
Aturan ini **WAJIB** dipatuhi dalam setiap pembuatan atau modifikasi modal dialog (formulir tambah/ubah, modal detail/view, modal konfirmasi, modal petunjuk operasional `<x-petunjuk-modal>`, dan seluruh modal lainnya) di seluruh sistem Veltronic.

---

## 1. Standar Header Modal Responsif (3-Baris Center pada Mobile)

1. **TAMPILAN MOBILE / SMARTPHONE (`< sm`)**:
   - **Baris 1 (Paling Atas)**: Ikon/Logo modul berukuran besar (`fs-2x`) di dalam lingkaran sempurna (`rounded-circle`) dengan dimensi tetap (`width: 60px; height: 60px; min-width: 60px; min-height: 60px;`) berlatar warna tema (`bg-light-primary`, `bg-light-danger`, dll.) dan rata tengah (`d-flex justify-content-center d-sm-none mb-3`).
   - **Baris 2**: Judul modal tampil tegas rata tengah (`text-center text-sm-start`).
   - **Baris 3**: Deskripsi/keterangan modal tampil informatif rata tengah (`text-muted fw-semibold fs-7 mt-2 mb-0 text-center text-sm-start`).
   - **Tombol Tutup (`x`)**: Ditempatkan di pojok kanan atas secara absolut (`position-absolute top-0 end-0 m-3 m-sm-4 z-index-2`) sehingga tidak merusak perataan tengah header di layar HP.

2. **TAMPILAN DESKTOP (`>= sm`)**:
   - Header kembali ke susunan horizontal standar, rata kiri dengan tombol tutup di sisi kanan.

---

## 2. Standar Judul Konten / Section Modal (Elegan & Responsif)

Ketika di dalam badan modal (`modal-body`) terdapat judul pemisah bagian/section (seperti pengaturan, matriks, atau preferensi):
- Gunakan pembungkus responsif `d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 mb-4 pb-3 border-bottom text-center text-sm-start`.
- **Sisi Kiri**: Simbol ikon 35px lingkaran (`symbol symbol-35px symbol-circle bg-light-primary text-primary me-3`) berdampingan dengan judul utama (`fs-6 fw-bolder text-gray-800`) dan sub-deskripsi opsional.
- **Sisi Kanan**: Badge status / live indicator berdesain kapsul elegan (`badge badge-light-primary border border-primary border-opacity-25 fw-bold fs-8 px-3 py-2 rounded-pill`) dilengkapi ikon pendukung.

---

## 3. Standar Tombol Aksi Footer Modal (`modal-footer`)

1. **ATURAN JUMLAH TOMBOL**:
   - **Jumlah Tombol $\le 2$ (Standar Utama: Batal & Simpan / Tutup)**:
     - Teks label tombol **TETAP UTUH DITAMPILKAN** di mobile maupun desktop (Lengkap dengan teks dan ikon) agar informasi aksi jelas dan mudah dipahami pengguna.
   - **Jumlah Tombol $\ge 3$**:
     - Teks label tombol pada layar mobile (`< sm`) disembunyikan menggunakan `d-none d-sm-inline` sehingga hanya ikon yang tampil untuk menghemat ruang.

2. **TOOLTIP INTERAKTIF HOVER (WAJIB)**:
   - Setiap tombol aksi modal **WAJIB MEMILIKI HOVER TOOLTIP BOOTSTRAP**:
     ```html
     data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Keterangan Tombol"
     ```

3. **POSISI TOMBOL FOOTER**:
   - Rata tengah di layar mobile dan rata kanan di layar desktop: `justify-content-center justify-content-sm-end gap-2`.

4. **SPINNER LOADING SUBMIT**:
   - Tombol submit tetap wajib menyertakan `.indicator-label` dan `.indicator-progress` dengan spinner Metronic.

## 4. Standar Bebas Scroll Internal (Browser-Level Scroll Policy)

- **DILARANG** menggunakan `modal-dialog-scrollable`, batasan tinggi kaku `max-height` dengan `overflow-y: auto`, atau `scroll-y` pada `modal-body` yang menciptakan scrollbar ganda di dalam modal.
- Modal **WAJIB** memanjang secara alami mengikuti isi kontennya, sehingga proses scrolling dilakukan secara mulus oleh **scroll halaman/browser utama**.
- Hal ini menjamin:
  1. Header dan footer modal tidak pernah terpotong/terjepit oleh bug overflow internal.
  2. Pengalaman scroll di perangkat mobile terasa natural mengikuti gestur sentuh bawaan layar.
  3. Komponen di dalam modal (misalnya matriks CRUD) wajib diset `'scrollable' => false` agar tidak membuat scrollbar di dalam scrollbar.

---

## 5. Pola Standar Kode Blade Modal Dialog

```html
<!--begin::Modal Dialog-->
<div class="modal fade" id="kt_modal_example" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <!--begin::Modal header-->
            <div class="modal-header border-0 pb-0 position-relative pt-7 pt-sm-6 px-6 px-lg-8">
                <!--begin::Close Button-->
                <div class="position-absolute top-0 end-0 m-3 m-sm-4 z-index-2">
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tutup">
                        <i class="ki-outline ki-cross fs-2"></i>
                    </button>
                </div>
                <!--end::Close Button-->

                <!--begin::Header Info (3-Baris Center pada Mobile)-->
                <div class="w-100 text-center text-sm-start pe-0 pe-sm-10">
                    <!-- Row 1: Icon Logo Lingkaran Sempurna (Mobile Only) -->
                    <div class="d-flex justify-content-center d-sm-none mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light-primary text-primary rounded-circle" 
                             style="width: 60px; height: 60px; min-width: 60px; min-height: 60px;">
                            <i class="ki-outline ki-setting-2 fs-2x text-primary"></i>
                        </div>
                    </div>

                    <!-- Row 2: Title -->
                    <h3 class="fw-bolder text-gray-900 m-0 fs-3">Judul Modal Dialog</h3>

                    <!-- Row 3: Description -->
                    <div class="text-muted fw-semibold fs-7 mt-2 mb-0">
                        Deskripsi petunjuk ringkas mengenai isi dan tujuan modal formulir.
                    </div>
                </div>
                <!--end::Header Info-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body py-6 px-6 px-lg-8">
                <!-- Section Header Elegan -->
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 mb-5 border-bottom border-gray-200 pb-3 text-center text-sm-start">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle bg-light-primary text-primary me-3 d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ki-outline ki-element-11 fs-3 text-primary"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="fs-6 fw-bolder text-gray-800">Judul Bagian Konten</span>
                            <span class="text-muted fs-8 d-none d-sm-inline">Keterangan tambahan bagian</span>
                        </div>
                    </div>
                    <span class="badge badge-light-primary border border-primary border-opacity-25 fw-bold fs-8 px-3 py-2 rounded-pill d-inline-flex align-items-center gap-1">
                        <i class="ki-outline ki-eye fs-7 text-primary"></i>
                        <span>Indikator</span>
                    </span>
                </div>

                <!-- Isi Formulir / Konten Modal ... -->
            </div>
            <!--end::Modal body-->

            <!--begin::Modal footer (<= 2 Tombol: Teks Utuh & Tooltip Hover)-->
            <div class="modal-footer border-0 pt-0 px-6 px-lg-8 pb-6 justify-content-center justify-content-sm-end gap-2">
                <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Batal">
                    <i class="ki-outline ki-cross fs-4 me-1"></i>
                    <span>Batal</span>
                </button>
                <button type="submit" class="btn btn-primary fw-bold" id="kt_btn_submit"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Simpan Perubahan">
                    <span class="indicator-label">
                        <i class="ki-outline ki-check fs-5 me-1"></i>
                        <span>Simpan Perubahan</span>
                    </span>
                    <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                        <span>Menyimpan...</span>
                    </span>
                </button>
            </div>
            <!--end::Modal footer-->
        </div>
    </div>
</div>
```
