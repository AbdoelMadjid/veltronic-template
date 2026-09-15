# Aturan Efisiensi Kerja & Eksekusi Terfokus (Efficiency & Targeted Execution)

## Scope & Trigger
Aturan ini **WAJIB** dipatuhi secara ketat di setiap sesi interaksi, perbaikan bug, penambahan logika, atau modifikasi kode pada proyek ini.

---

## 1. Larangan Test Menyeluruh (Zero Full-Suite Blocking)
- **DILARANG** menjalankan full test suite (`phpunit`, `phpunit tests/Feature`, dll.) yang memakan waktu lama saat mengerjakan tugas/permintaan spesifik.
- User tidak boleh dibuat menunggu lama oleh proses pengujian massal yang tidak efisien.
- **Protokol Verifikasi**:
  - Lakukan inspeksi kode (code review/lint/dry-run) secara langsung dan presisi.
  - Jika pengujian otomatis mutlak diperlukan, **HANYA** jalankan targeted unit/feature test untuk file spesifik yang sedang dikerjakan (single-test method) dengan waktu eksekusi cepat (< 2 detik).

---

## 2. Preservasi Logika Eksisting (Non-Destructive & Anti-Regresi)
- Ketika mengimplementasikan **Logika C** yang diminta user, fungsionalitas dan arsitektur dari **Logika A & Logika B** yang sudah berjalan dan disetujui **TIDAK BOLEH DIRUSAK ATAU TERUBAH PERILAKUNYA**.
- **Isolasi Logika**:
  - Tambahkan fitur baru secara modular tanpa merombak struktur global yang sudah stabil.
  - Pastikan setiap fungsi baru mempertahankan backward compatibility penuh dengan logika yang telah ada.
- Jangan mengubah pola desain, kontrak data, atau konfigurasi global yang sudah disepakati sebelumnya kecuali user secara eksplisit meminta perubahan tersebut.

---

## 3. Eksekusi Cepat, Presisi, & Tepat Sasaran
- Fokus hanya pada elemen, baris kode, dan berkas yang menjadi inti permintaan user.
- Hindari perubahan liar atau refactoring sampingan di luar ruang lingkup (out-of-scope) yang berisiko menciptakan bug baru.
- Berikan respons yang cepat, lugas, dan solutif agar user dapat melanjutkan tahap pengembangan berikutnya tanpa hambatan waktu.
