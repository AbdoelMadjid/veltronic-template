# Standar Header Banner, Toolbar Petunjuk, & Tema Dinamis Modul Baru

Aturan ini **WAJIB DIPATUHI SECARA KONSISTEN** pada setiap pembuatan modul baru, pembaruan antarmuka (UI), dan standarisasi halaman di seluruh sistem.

---

## 1. Standar Header Banner (Judul & Tombol Aksi Utama)

Setiap halaman modul baru **WAJIB** memiliki kartu **Header Banner** terpisah di bagian paling atas sebelum kartu konten/tabel data.

### Struktur Standar HTML / Blade:
```blade
<!--begin::Header Banner-->
<div class="card card-flush shadow-sm border-0 mb-6">
    <div class="card-body p-6 d-flex flex-wrap align-items-center justify-content-between gap-4">
        <!-- Sisi Kiri: Ikon, Judul, & Deskripsi -->
        <div class="d-flex align-items-center">
            <div class="symbol symbol-45px symbol-circle bg-light-primary me-4 d-flex align-items-center justify-content-center">
                <i class="ki-outline ki-[nama-ikon] text-primary fs-2"></i>
            </div>
            <div>
                <h2 class="fw-bolder text-gray-900 m-0 fs-3">{{ $title ?? 'Judul Modul Lengkap' }}</h2>
                <span class="text-muted fs-7">{{ $subtitle ?? 'Penjelasan ringkas fungsi dan kegunaan modul ini.' }}</span>
            </div>
        </div>

        <!-- Sisi Kanan: Tombol-tombol Aksi Utama / Badge Info -->
        <div class="d-flex align-items-center gap-3">
            {{-- Contoh Tombol Aksi Utama --}}
            <button type="button" class="btn btn-primary btn-sm fw-bold rounded-pill px-4" id="kt_btn_add_[nama_modul]">
                <span class="indicator-label">
                    <i class="ki-outline ki-plus fs-4 me-1"></i> Tambah Data Baru
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
2. **Posisi Tombol Aksi**: Seluruh tombol inisiasi aksi utama (misal: *Tambah Data Baru*, *Modul CRUD Praktis*, *Simpan Peran Ini*, *Single Permission*) **wajib diletakkan di sisi paling kanan Header Banner**.
3. **Styling Tombol**: Gunakan style seragam `rounded-pill btn-sm fw-bold px-4` dengan indikator spinner Metronic `data-kt-indicator="on"`.

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
