# Git Versioning, Tags & Changelog Rule

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
  - Perbarui catatan rincian perubahan pada entri tag/versi tersebut di `changelog.blade.php`.
  - Jika diperlukan me-repoint tag lokal & remote:
    ```bash
    git tag -f -a vX.Y.Z -m "Release vX.Y.Z: [deskripsi ringkas terupdate]"
    git push origin vX.Y.Z --force
    ```

---

### 2. Wajib Perbarui `resources/views/pages/help/pemrograman/changelog.blade.php`
Sebelum melakukan commit & push:
1. Buka file `resources/views/pages/help/pemrograman/changelog.blade.php`.
2. **Jika Tag Baru**:
   - Perbarui badge **Versi Saat Ini** pada header:
     ```html
     Versi Saat Ini: vX.Y.Z
     ```
   - Tambahkan blok `<div class="timeline-item mb-7">` baru di urutan **paling atas** timeline:
     - Badge versi baru + `<span class="badge badge-light-success fs-8 ms-auto">Latest Release</span>`.
     - Badge tipe versi (`Major` / `Minor` / `Patch`).
     - Badge tanggal & jam: `DD Mmm YYYY, HH:mm WIB`.
     - Judul rilis, paragraf ringkasan, dan rincian perubahan dalam card rounded `border-dashed`.
     - Ubah rilis sebelumnya dari `Latest Release` menjadi `Stable Release` (`badge-light-dark`).
3. **Jika Update Tag Sebelumnya**:
   - Perbarui daftar rincian perubahan pada blok timeline versi tersebut agar mencakup perubahan terbaru.

---

### 3. Eksekusi Commit, Tag & Push
Jalankan langkah git:

```bash
# 1. Stage semua file yang berubah termasuk changelog.blade.php
git add .

# 2. Commit dengan format pesan yang jelas
git commit -m "feat/fix/docs/refactor: deskripsi perubahan (vX.Y.Z)"

# 3. Buat / update tag jika ada
# Jika tag baru:
git tag -a vX.Y.Z -m "Release vX.Y.Z: Deskripsi rilis"

# 4. Push commit dan tag ke GitHub
git push origin main
# Jika ada tag baru:
git push origin vX.Y.Z
# Jika update tag sebelumnya:
# git push origin vX.Y.Z --force
```

---

### 4. Konfirmasi ke Pengguna
Laporkan hasil eksekusi kepada pengguna:
- Status tag (Tag baru `vX.Y.Z` atau update pada tag sebelumnya).
- Ringkasan catatan yang ditambahkan/diperbarui di `help/pemrograman/changelog`.
- Konfirmasi branch dan tag berhasil di-push ke GitHub.
