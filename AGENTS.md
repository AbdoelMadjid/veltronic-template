# Antigravity Agent Guidelines & Rules

## 1. Efisiensi & Larangan Full Test Suite (Zero Full-Suite Blocking)
- **DILARANG** menjalankan pengujian menyeluruh/full test suite (`phpunit`, `phpunit tests/Feature`, dll.) yang memakan waktu lama saat menangani permintaan pengguna.
- Proses verifikasi dilakukan secara cepat, fokus, dan hanya pada titik perubahan spesifik (targeted test) jika benar-benar diperlukan.
- Jangan membuat pengguna menunggu lama hanya untuk menjalankan pengujian yang tidak esensial.

## 2. Preservasi Logika Eksisting (Anti-Regresi & Non-Destructive)
- Setiap kali menambahkan atau memodifikasi **Logika C**, pastikan **Logika A & B** yang sebelumnya sudah berfungsi dengan baik **TIDAK BOLEH RUSAK** atau berubah perilakunya.
- Modifikasi kode harus terisolasi, modular, dan menjaga kompatibilitas ke belakang (backward compatibility).
- Jangan merombak arsitektur atau pola yang sudah berjalan tanpa instruksi eksplisit dari pengguna.

## 3. Eksekusi Cepat, Ramping, & Tepat Sasaran
- Fokus langsung pada file dan baris kode yang diminta pengguna tanpa refactoring liar di luar ruang lingkup.
- Gunakan komponen bawaan Metronic/Veltronic tanpa membuat custom CSS berlebih per halaman.
- Pastikan seluruh aturan di `.agents/rules/` dipatuhi secara konsisten.
