# Git Versioning, Tags & Automatic Changelog Rule

## Trigger & Scope
Aturan ini **WAJIB** dijalankan setiap kali pengguna meminta untuk melakukan *push* ke repository GitHub (contoh: *"push ke github"*, *"tolong push"*, *"bantu untuk di push"*, *"upsh"*). **Tidak boleh melakukan push langsung tanpa menyertakan tag dan memperbarui riwayat versi.**

---

## Prosedur Wajib Setiap Perintah Push:

### 1. Tentukan Semantic Versioning (SemVer) & Tag
- Periksa tag / versi terakhir di `resources/views/pages/help/pemrograman/overview.blade.php` atau `git tag`.
- Tentukan versi berikutnya sesuai bobot perubahan:
  - **PATCH (`v1.3.x`)**: Perbaikan bug, refactoring kecil, update teks/style/route.
  - **MINOR (`v1.x.0`)**: Penambahan fitur baru, halaman baru, modul baru, skema baru.
  - **MAJOR (`vx.0.0`)**: Perubahan arsitektur besar / breaking changes.

### 2. Wajib Perbarui Riwayat Versi di `overview.blade.php`
Sebelum melakukan commit & tag:
1. Buka `resources/views/pages/help/pemrograman/overview.blade.php`.
2. Perbarui badge **Versi Saat Ini** pada header:
   ```html
   Versi Saat Ini: vX.Y.Z
   ```
3. Tambahkan blok `<div class="timeline-item mb-7">` baru di urutan **paling atas** timeline:
   - Pasang badge versi baru dengan status `<span class="badge badge-light-success fs-8">Latest Release</span>`.
   - Pasang badge tipe versi:
     - **Major**: `<span class="badge badge-light-danger fw-bold fs-8">Major</span>` (dot badge: `text-danger`)
     - **Minor**: `<span class="badge badge-light-primary fw-bold fs-8">Minor</span>` (dot badge: `text-primary`)
     - **Patch**: `<span class="badge badge-light-warning fw-bold fs-8">Patch</span>` (dot badge: `text-warning`)
   - Pasang badge tanggal & waktu rilis:
     ```html
     <span class="badge badge-light text-gray-700 fs-8 border">
         <i class="ki-duotone ki-calendar-8 fs-8 me-1 text-gray-600">
             <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
         </i>DD Mmm YYYY, HH:mm WIB
     </span>
     ```
   - Ubah rilis sebelumnya menjadi `<span class="badge badge-light-dark fs-8">Stable Release</span>`.
   - Cantumkan judul rilis, ringkasan, dan rincian perubahan (dalam bahasa Indonesia baku).

### 3. Eksekusi Commit, Tag, dan Push
Jalankan urutan perintah git berikut secara berurutan:
```bash
# 1. Stage semua perubahan termasuk file overview.blade.php
git add .

# 2. Commit dengan pesan standar
git commit -m "feat/fix/chore: deskripsi ringkas perubahan (vX.Y.Z)"

# 3. Buat annotated tag
git tag -a vX.Y.Z -m "Release vX.Y.Z: Deskripsi ringkas rilis"

# 4. Push branch utama dan tag ke GitHub
git push origin main
git push origin vX.Y.Z
```

### 4. Konfirmasi ke Pengguna
Laporkan kepada pengguna:
- Nomor versi / tag yang baru dibuat.
- Status update changelog di `overview.blade.php`.
- Bukti push commit dan push tag berhasil.
