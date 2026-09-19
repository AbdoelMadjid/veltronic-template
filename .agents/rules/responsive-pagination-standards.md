# Standar Responsif Navigasi Halaman & Footer Tabel / Kartu Mobile

Dokumen ini mengatur standar baku susunan tata letak footer informasi data, pilihan *page length*, dan navigasi halaman (*pagination*) pada seluruh modul web Veltronic, baik yang menggunakan **Laravel Blade Pagination** (misal: Pane Kartu, Akses User) maupun **Yajra DataTables** (misal: Pane Tabel Pengguna, Data Login).

---

## 1. Prinsip Utama & Bebas Scroll Horizontal
1. **Pemisahan Scroll Tabel**:
   - Area scroll horizontal (`table-responsive` atau `overflow-x: auto`) **HANYA BOLEH MEMBUNGKUS BARIS DATA TABEL**.
   - Footer DataTables (yang memuat *length menu*, teks informasi data, dan tombol navigasi) **DILARANG BERADA DI DALAM AREA SCROLL TABEL**.
   - Pada Blade template, jangan membungkus `<table>` dengan `<div class="table-responsive">` manual jika di DataTables `dom` sudah menggunakan `dom: "<'table-responsive'tr>..."`.

2. **Konsistensi Antar View**:
   - Pola tampilan dan logika angka halaman pada **Tampilan Tabel** wajib sama persis dengan **Tampilan Kartu**.

---

## 2. Struktur 3-Baris Rata Tengah pada Layar Mobile (`< 768px`)
Pada layar HP/mobile, seluruh elemen footer disusun bertumpuk secara vertikal (3 baris) rata tengah:

* **Baris 1**: `Tampilkan [10 v] data` — Pilihan jumlah data per halaman (`.dataTables_length`), tampil mandiri di baris atas rata tengah.
* **Baris 2**: `Menampilkan X sampai Y dari Z data` — Teks ringkasan informasi data (`.dataTables_info`), wajib utuh 1 baris horizontal (`white-space: nowrap !important;`), rata tengah tanpa pemecahan kata vertikal.
* **Baris 3**: Navigasi Tombol Halaman (`.dataTables_paginate` / `ul.pagination`) — Tersusun rata tengah dengan ukuran proporsional Metronic.

### Tampilan pada Layar Desktop (`>= 768px`)
* **Sisi Kiri**: Baris 1 & Baris 2 sejajar rapi berdampingan (`Tampilkan [10 v] data` &nbsp;&bull;&nbsp; `Menampilkan 1 sampai 10 dari 53 data`).
* **Sisi Kanan**: Navigasi tombol halaman rata kanan.

---

## 3. Logika Pola Angka Halaman Ringkas (*Compact Numbers Pattern*)
Untuk mencegah tombol navigasi meluap atau turun baris pada layar sempit, jumlah tombol angka dibatasi **maksimal 5 angka** dengan algoritma sebagai berikut:

| Posisi Halaman Aktif | Pola Tombol yang Ditampilkan | Contoh (Total 6 Halaman) |
| :--- | :--- | :--- |
| **Halaman 1** | Halaman 1, 2, dan Halaman Terakhir | `[1]  2  6  >` |
| **Halaman 2** | Halaman 1, 2, 3, dan Halaman Terakhir | `<  1  [2]  3  6  >` |
| **Halaman 3** | Halaman 1, 2, 3, 4, dan Halaman Terakhir | `<  1  2  [3]  4  6  >` |
| **Halaman Tengah ($n$)** | Halaman 1, $n-1$, $n$ (Aktif), $n+1$, dan Terakhir | `<  1  3  [4]  5  6  >` |
| **Halaman Terakhir ($N$)** | Halaman 1, $N-1$, dan $N$ (Aktif) | `<  1  5  [6]` |

---

## 4. Contoh Implementasi Teknis

### A. Pada Yajra DataTables (`assets/js/[modul].js`)
```javascript
// 1. Registrasi Custom Pager Compact
if (typeof $ !== 'undefined' && $.fn.DataTable && $.fn.DataTable.ext && $.fn.DataTable.ext.pager) {
    $.fn.DataTable.ext.pager.veltronic_compact = function (page, pages) {
        if (pages <= 1) return [];
        var numbers = [];
        for (var p = 0; p < pages; p++) {
            if (p === 0 || p === pages - 1 || Math.abs(p - page) <= 1) {
                numbers.push(p);
            }
        }
        return ['previous', numbers, 'next'];
    };
}

// 2. Inisialisasi DataTable
dataTable = $(tableEl).DataTable({
    responsive: false,
    searchDelay: 500,
    processing: true,
    serverSide: true,
    order: [[0, 'desc']],
    pageLength: 10,
    pagingType: 'veltronic_compact',
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    dom:
        "<'table-responsive'tr>" +
        "<'row align-items-center justify-content-between g-3 mt-4 pt-3 border-top border-gray-200'" +
        "<'col-12 col-md-auto d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-md-start gap-2 text-center text-sm-start text-muted fs-7'l i>" +
        "<'col-12 col-md-auto d-flex justify-content-center justify-content-md-end'p>" +
        ">",
    language: {
        emptyTable: "Belum ada data yang tercatat.",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        infoEmpty: "Menampilkan 0 data",
        infoFiltered: "(disaring dari _MAX_ total data)",
        lengthMenu: "Tampilkan _MENU_ data",
        loadingRecords: "Memuat data...",
        processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Memuat data...',
        search: "Cari:",
        zeroRecords: "Tidak ada data yang cocok dengan kriteria pencarian.",
        paginate: {
            first: '<i class="ki-outline ki-double-left fs-4"></i>',
            last: '<i class="ki-outline ki-double-right fs-4"></i>',
            next: '<i class="ki-outline ki-right fs-4"></i>',
            previous: '<i class="ki-outline ki-left fs-4"></i>'
        }
    }
});
```

### B. Pada Blade Pagination (`resources/views/vendor/pagination/bootstrap-5.blade.php`)
Pastikan container pagination dipanggil di luar tabel:
```blade
<div class="pt-5" id="[modul]_pagination">
    {{ $data->links('pagination::bootstrap-5') }}
</div>
```
