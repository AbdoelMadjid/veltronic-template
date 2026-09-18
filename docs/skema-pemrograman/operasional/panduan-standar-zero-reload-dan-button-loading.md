# Panduan Standar Zero-Reload CRUD & Button Loading Spinner

Pedoman baku UX dan coding standard aplikasi untuk memastikan pengalaman pengguna yang mulus tanpa refresh halaman (Zero-Reload) serta pencegahan double submit melalui spinner tombol.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Kebijakan Zero-Reload CRUD (Rule #4)
- **Larangan Full Reload**: Dilarang menggunakan `location.reload()` pada submit formulir, toggle status, atau upload berkas.
- **AJAX & DOM Mutation**: Kirim data via AJAX, tangkap response, dan perbarui baris tabel / DOM secara realtime.
- **Preservasi Tab**: Tab yang sedang aktif harus tetap dipertahankan posisinya setelah aksi berhasil.

## 2. Standar Indikator Tombol (Rule #5)
- Sematkan atribut `data-kt-indicator="on"` dan `disabled = true` pada tombol submit selama proses berlangsung.
- Kembalikan ke status normal setelah menerima response sukses/gagal dari backend.

## 3. Standar Banner Header (Rule #7)
- Gunakan kartu `.card.card-flush.shadow-sm.border-0.mb-6.bg-body` dengan judul modul, deskripsi, dan tombol aksi di sisi kanan.
