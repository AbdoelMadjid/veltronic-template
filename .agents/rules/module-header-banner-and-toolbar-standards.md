# Standar Header Banner, Toolbar Petunjuk, & Tema Dinamis Modul Baru

Aturan ini **WAJIB DIPATUHI SECARA KONSISTEN** pada setiap pembuatan modul baru, pembaruan antarmuka (UI), dan standarisasi halaman di seluruh sistem.

---

## 1. Standar Header Banner (Judul & Tombol Aksi Utama)

Setiap halaman modul baru **WAJIB** memiliki kartu **Header Banner** terpisah di bagian paling atas sebelum kartu konten/tabel data.

### Struktur Standar HTML / Blade:
```blade
<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 text-center text-md-start">
        <!-- Baris 1-3 di Mobile (Logo, Judul, Deskripsi) / Sisi Kiri di Desktop -->
        <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-4 w-100 w-md-auto">
            <!-- Baris 1: Logo / Ikon Utama (Ukuran Lebih Besar di Mobile) -->
            <div class="symbol symbol-55px symbol-md-45px symbol-circle bg-light-primary mb-1 mb-md-0 me-0 me-md-4 d-flex align-items-center justify-content-center flex-shrink-0">
                <i class="ki-outline ki-[nama-ikon] text-primary fs-2x fs-md-2"></i>
            </div>
            <!-- Baris 2 & 3: Judul & Deskripsi -->
            <div class="d-flex flex-column align-items-center align-items-md-start">
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">{{ $title ?? 'Judul Modul Lengkap' }}</h2>
                <span class="text-muted fs-7 mt-1">{{ $subtitle ?? 'Penjelasan ringkas fungsi dan kegunaan modul ini.' }}</span>
            </div>
        </div>

        <!-- Baris 4: Kumpulan Tombol Aksi (Icon-only di mobile dengan Tooltip Hover) / Sisi Kanan di Desktop -->
        <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-2 gap-md-3 w-100 w-md-auto mt-2 mt-md-0">
            {{-- Contoh Tombol Aksi Utama (Kotak Standar Metronic) --}}
            <button type="button" class="btn btn-primary btn-sm fw-bold px-3 px-md-4" id="kt_btn_add_[nama_modul]"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Data Baru">
                <span class="indicator-label">
                    <i class="ki-outline ki-plus fs-3 fs-md-4 me-0 me-md-1"></i>
                    <span class="d-none d-md-inline">Tambah Data Baru</span>
                </span>
                <span class="indicator-progress">
                    Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </div>
</div>
<!--end::Header Banner-->
```

### Ketentuan Header Banner:
1. **Pemisahan dari Konten Utama**: Header Banner **harus terpisah** dalam kartu sendiri (`mb-6`), bukan digabung menjadi satu kartu di dalam table card atau form card.
2. **Tata Letak Responsif Mobile (`< md`)**:
   - **Semua elemen disusun rata tengah (*center-aligned*)** secara terstruktur dalam 4 baris:
     - **Baris 1**: Logo / Ikon utama di posisi paling atas dengan ukuran ikon yang lebih besar (`symbol-55px` & `fs-2x`).
     - **Baris 2**: Judul modul (`fs-3 fw-bolder text-gray-900`).
     - **Baris 3**: Deskripsi/keterangan modul (`text-muted fs-7`).
     - **Baris 4**: Kumpulan tombol aksi (bisa 1 atau lebih) yang disusun rata tengah, **hanya menampilkan ikon saja** (`d-none d-md-inline` pada label teks) serta **wajib dilengkapi tooltip hover** (`data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="..."`).
3. **Tata Letak Desktop (`>= md`)**: Logo, judul, dan deskripsi kembali berada di sisi kiri berdampingan, dan kumpulan tombol aksi berada di sisi paling kanan (`justify-content-md-end`).
4. **Styling Tombol**: Gunakan style tombol standar template Metronic (`btn btn-primary btn-sm fw-bold px-3 px-md-4`, tanpa `rounded-pill`) dengan indikator spinner Metronic `data-kt-indicator="on"`.

---

## 2. Standar Toolbar & Tombol Petunjuk Operasional

Tombol pemicu **Petunjuk Operasional** modul **WAJIB diletakkan di toolbar halaman** (`@section('toolbar')`), bukan di dalam body konten utama.

### Struktur Standar Blade Toolbar:
```blade
@section('title', 'Nama Modul')

@section('toolbar')
    @include('layouts.partials._toolbar', [
        'action' => view()->make('layouts.partials._action-petunjuk-button', [
            'targetModal' => '#kt_modal_[nama_modul]_petunjuk',
            'title' => 'Petunjuk Operasional [Nama Modul]'
        ])
    ])
@endsection
```

### Ketentuan Petunjuk Operasional:
1. Modal petunjuk operasional harus dipisah ke file `resources/views/pages/[kategori]/partials/[nama_modul]-petunjuk.blade.php`.
2. File Blade utama memanggil modal petunjuk di bagian bawah `@section('content')` menggunakan `@include`.

---

## 3. Kompatibilitas Dark Mode & Light Mode (Dynamic Color Scheme)

Seluruh komponen UI **WAJIB adaptif secara otomatis** terhadap mode gelap (*dark mode*) dan mode terang (*light mode*):

1. **DILARANG MENGGUNAKAN HARDCODED WARNA PUTIH/HITAM**:
   - Jangan gunakan `background-color: #ffffff`, `#fff`, `#000000`, `#000`, atau `class="bg-white"`.
   - Gunakan kelas dinamis Bootstrap/Metronic:
     - `bg-body` / `bg-body-secondary` / `bg-light` / `bg-light-subtle`
     - `text-gray-900` (untuk teks heading utama, otomatis putih di dark mode)
     - `text-gray-700` / `text-gray-600` / `text-muted` (untuk teks sekunder dan deskripsi)
     - `border-gray-200` / `border-gray-300` / `border-secondary`
2. **Pewarnaan Accent Dinamis**:
   - Gunakan kombinasi theme token: `bg-light-primary text-primary`, `bg-light-success text-success`, `bg-light-danger text-danger`, `bg-light-info text-info`.
3. **Avatar Pengguna**:
   - Gunakan helper standar `user_avatar($user)` atau `user_avatar_style($user)`.
   - Bentuk avatar foto atau inisial pengguna wajib menggunakan `rounded-3` (bukan lingkaran penuh `rounded-circle` untuk foto profil).

---

## 4. Referensi Implementasi di Sistem

Berikut adalah contoh rujukan halaman yang telah mengadopsi standar ini secara penuh:
- **Role**: `resources/views/pages/usermanagement/roles.blade.php` & `partials/roles/roles-cards-list.blade.php`
- **Permission**: `resources/views/pages/usermanagement/permissions.blade.php` & `partials/permissions/permissions-table.blade.php`
- **Akses Role**: `resources/views/pages/usermanagement/akses-role.blade.php` & `partials/akses-role/matrix-table.blade.php`
- **Akses User**: `resources/views/pages/usermanagement/akses-user.blade.php` & `partials/akses-user/user-access-table.blade.php`

---

## 5. Checklist Kepatuhan Modul Baru
- [ ] Apakah Header Banner kartu terpisah (`card card-flush shadow-sm border-0 mb-6`) sudah dibuat di atas konten?
- [ ] Apakah tombol aksi utama modul sudah ditempatkan di sisi paling kanan Header Banner?
- [ ] Apakah tombol Petunjuk Operasional sudah ditempatkan di toolbar (`@section('toolbar')`) via `_action-petunjuk-button.blade.php`?
- [ ] Apakah seluruh warna background, text, dan border sudah menggunakan kelas dinamis (bebas hardcoded `#fff`/`#000`) sehingga sempurna di Dark Mode & Light Mode?
