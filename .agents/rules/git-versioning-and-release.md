# Git Versioning & Automatic Changelog Rule

## Trigger & Scope
Aturan ini berlaku setiap kali pengguna meminta untuk melakukan *push* atau *release* ke repository GitHub (contoh: "push ke github", "tolong push", "update github").

---

## 1. Analisis Semantic Versioning (SemVer)
Sebelum melakukan push, lakukan analisis terhadap akumulasi perubahan yang telah dilakukan:
- **MAJOR (`vX.0.0`)**: Terjadi perubahan arsitektur besar yang merusak kompatibilitas lama (breaking changes).
- **MINOR (`v1.X.0`)**: Penambahan fitur baru yang backwards-compatible (seperti *Dynamic KeenIcons Switcher*, *Dynamic Frontpages Switcher*, modul help/skema baru).
- **PATCH (`v1.1.X`)**: Perbaikan bug, hotfix, perbaikan typo, atau sinkronisasi minor tanpa penambahan fitur baru.
- **Commit Update Reguler**: Perubahan kecil/tahapan pengerjaan yang belum membentuk fitur rilis utuh.

---

## 2. Wajib Memperbarui Riwayat Versi di `overview.blade.php`
Setiap kali ada rilis versi baru (tag baru) atau pembaruan yang signifikan:
1. Buka file `resources/views/pages/help/pemrograman/overview.blade.php`.
2. Perbarui badge **Versi Saat Ini** pada header kartu:
   ```html
   Versi Saat Ini: vX.Y.Z
   ```
3. Tambahkan blok `<div class="timeline-item mb-7">` baru di urutan paling atas timeline catatan rilis:
   - Berikan badge versi baru (misal `v1.2.0`) dan tandai dengan badge `<span class="badge badge-light-success fs-8">Latest Release</span>`.
   - Ubah badge pada rilis sebelumnya menjadi rilis reguler (hilangkan `Latest Release`).
   - Tuliskan ringkasan perubahan serta daftar rincian fitur/perbaikan secara jelas dan terstruktur.

---

## 3. Workflow Eksekusi Git Push & Tagging
1. Pastikan file `overview.blade.php` sudah diperbarui dengan catatan rilis.
2. Lakukan staging dan commit:
   ```bash
   git add .
   git commit -m "feat/fix/chore: deskripsi perubahan"
   ```
3. Jika ditentukan perlu tag baru:
   ```bash
   git tag -a vX.Y.Z -m "Release vX.Y.Z: Deskripsi ringkas rilis"
   git push origin main
   git push origin vX.Y.Z
   ```
4. Jika hanya update biasa tanpa tag:
   ```bash
   git push origin main
   ```
5. Berikan konfirmasi status rilis dan nomor versi/tag kepada pengguna.
