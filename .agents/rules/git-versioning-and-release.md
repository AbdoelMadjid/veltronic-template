# Git Versioning, Tags & Dual Changelog Synchronization Rule

## Trigger & Scope
Aturan ini **WAJIB** dijalankan setiap kali pengguna meminta untuk melakukan *push* ke repository GitHub (contoh: *"push ke github"*, *"tolong push"*, *"bantu push"*, *"push"*).

---

## Prosedur Wajib Setiap Perintah Push:

### 1. Evaluasi Kebutuhan Tag Baru vs Update Tag Sebelumnya
Sebelum melakukan push, evaluasi perubahan yang ada:

- **Kapan Bikin Tag Baru (New Tag / Bump Version)**:
  - Terdapat penambahan fitur baru, halaman/modul baru, perubahan struktur/arsitektur, atau perbaikan bug signifikan.
  - Tentukan kenaikan versi sesuai SemVer:
    - **PATCH (`vX.Y.Z+1`)**: Bug fix, refactoring, penyesuaian route/error handler, modularisasi view.
    - **MINOR (`vX.Y+1.0`)**: Penambahan modul/halaman baru, fitur bisnis baru, skema seeder baru.
    - **MAJOR (`vX+1.0.0`)**: Breaking changes / perombakan arsitektur besar.

- **Kapan Update ke Tag Sebelumnya (Same Tag)**:
  - Perubahan hanya perbaikan kecil/lanjutan (typo, formatting, revisi teks kecil) yang masih satu konteks dengan rilis/tag terakhir yang baru saja dibuat.
  - Perbarui catatan rincian perubahan pada entri tag/versi tersebut di kedua file changelog (`CHANGELOG.md` dan `changelog.blade.php`).
  - Jika diperlukan me-repoint tag lokal & remote:
    ```bash
    git tag -f -a vX.Y.Z -m "Release vX.Y.Z: [deskripsi ringkas terupdate]"
    git push origin vX.Y.Z --force
    ```

---

### 2. WAJIB Sinkronisasi Ganda Changelog (Dual Synchronization)
Sebelum melakukan `git commit` dan `git push`, **KEDUA** berkas changelog berikut **WAJIB DIPERBARUI SECARA BERSAMAAN TANPA TERLEWAT**:

#### A. Berkas Root Markdown: `CHANGELOG.md`
1. Tambahkan entri rilis versi baru `## [vX.Y.Z] - YYYY-MM-DD` di urutan paling atas di bawah header utama.
2. Cantumkan kategori perubahan: `### Added`, `### Changed`, `### Fixed`, dsb.

#### B. Berkas Tampilan UI Web: `resources/views/pages/help/log/changelog.blade.php`
1. **Perbarui Badge Versi Saat Ini** pada header card:
   ```html
   Versi Saat Ini: vX.Y.Z
   ```
2. **Tambahkan Blok Timeline Rilis Baru** di urutan paling atas timeline (`<div class="timeline-label">`):
   - Badge versi: `<span class="badge badge-primary fw-bold text-white">vX.Y.Z</span>`
   - Badge tipe rilis: `<span class="badge badge-light-primary fw-bold fs-8">Minor/Major/Patch</span>`
   - Badge tanggal & jam rilis: `<span class="badge badge-light text-gray-700 fs-8 border">... DD Mmm YYYY, HH:mm WIB</span>`
   - Badge status: `<span class="badge badge-light-success fs-8 ms-auto">Latest Release</span>`
   - Judul rilis `<h4>`, paragraf deskripsi `<p>`, dan boks rincian perubahan `<div class="bg-light rounded p-4 border border-dashed border-gray-300">` berisi daftar `<ul><li>`.
3. **Pindahkan Badge Latest Release Sebelumnya**:
   - Hapus `<span class="badge badge-light-success fs-8 ms-auto">Latest Release</span>` dari rilis sebelumnya atau ganti menjadi `Stable Release` jika relevan.

---

### 3. Eksekusi Commit, Tag & Push
Jalankan langkah git:

```bash
# 1. Stage SEMUA file yang berubah (termasuk CHANGELOG.md & resources/views/pages/help/log/changelog.blade.php)
git add .

# 2. Commit dengan format pesan yang jelas
git commit -m "feat/fix/docs/refactor: deskripsi perubahan (vX.Y.Z)"

# 3. Buat / update tag
# Jika tag baru:
git tag -a vX.Y.Z -m "Release vX.Y.Z: Deskripsi rilis"
# Jika update tag sebelumnya:
# git tag -fa vX.Y.Z -m "Release vX.Y.Z: Deskripsi rilis terupdate"

# 4. Push commit dan tag ke GitHub
git push origin main
# Jika ada tag baru:
git push origin vX.Y.Z
# Jika update tag sebelumnya:
# git push origin vX.Y.Z --force
```

---

### 4. Konfirmasi ke Pengguna
Laporkan hasil eksekusi kepada pengguna secara transparan:
- Status tag (Tag baru `vX.Y.Z` atau update pada tag sebelumnya).
- Konfirmasi sinkronisasi ganda: `CHANGELOG.md` dan `resources/views/pages/help/log/changelog.blade.php`.
- Konfirmasi branch dan tag berhasil di-push ke GitHub.
