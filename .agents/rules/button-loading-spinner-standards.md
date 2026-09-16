# Aturan Standar Indikator Loading Spinner Tombol (Button Loading Policy)

Aturan ini **WAJIB DIPATUHI SECARA KONSISTEN** pada setiap tombol aksi, submit formulir, eksekusi AJAX, proses login/autentikasi, modal, dan operasi data di seluruh modul template Veltronic/Metronic.

---

## 1. Prinsip Utama: Wajib Spinner Saat Ada Proses
1. **Feedback Visual Instan (Zero Silent Operations)**:
   - Setiap kali sebuah tombol diklik dan menjalankan proses (submit formulir, permintaan AJAX, autentikasi, upload berkas, simpan data, hapus data, atau kunci/buka layar), tombol tersebut **WAJIB** langsung menampilkan animasi *loading spinner* (*Metronic Indicator Spinner*).
2. **Pencegahan Klik Ganda (Double-Submit Prevention)**:
   - Saat proses sedang berjalan, tombol harus otomatis berada dalam status nonaktif (`disabled = true` dan `setAttribute('data-kt-indicator', 'on')`) untuk mencegah pengguna mengirimkan permintaan berulang yang dapat menyebabkan duplikasi data atau error server.
3. **Pemulihan Status Setelah Respons (Auto Reset/Restore)**:
   - Segera setelah respons diterima (baik berhasil maupun gagal), status tombol **wajib dikembalikan** ke kondisi normal (`removeAttribute('data-kt-indicator')` dan `disabled = false`).

---

## 2. Struktur HTML Standar Tombol dengan Indikator

Setiap tombol submit atau eksekusi wajib menggunakan struktur elemen bawaan Metronic yang memisahkan teks utama (`indicator-label`) dan status proses (`indicator-progress`):

```html
<button type="submit" id="btn_submit_data" class="btn btn-primary">
    <!--begin::Indicator label-->
    <span class="indicator-label">
        <i class="ki-duotone ki-check fs-3 me-1">
            <span class="path1"></span><span class="path2"></span>
        </i>
        Simpan Perubahan
    </span>
    <!--end::Indicator label-->

    <!--begin::Indicator progress-->
    <span class="indicator-progress">
        Mohon tunggu...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
    <!--end::Indicator progress-->
</button>
```

---

## 3. Standar Implementasi JavaScript

### A. Pola Manual (Fetch / AJAX)
```javascript
const submitBtn = document.getElementById('btn_submit_data');

// 1. Saat proses dimulai
if (submitBtn) {
    submitBtn.setAttribute('data-kt-indicator', 'on');
    submitBtn.disabled = true;
}

// 2. Eksekusi proses
fetch(url, { method: 'POST', body: formData })
    .then(async res => {
        const data = await res.json();
        // Tangani respons...
    })
    .catch(err => {
        // Tangani error...
    })
    .finally(() => {
        // 3. Wajib pulihkan tombol setelah proses selesai
        if (submitBtn) {
            submitBtn.removeAttribute('data-kt-indicator');
            submitBtn.disabled = false;
        }
    });
```

### B. Menggunakan Helper Universal (`KTButtonLoader`)
Helper global `window.KTButtonLoader` tersedia di `notification-helper.js`:

```javascript
// Aktifkan loading spinner pada tombol
KTButtonLoader.show(buttonElement, 'Memproses...');

// Matikan loading spinner dan aktifkan tombol kembali
KTButtonLoader.hide(buttonElement);
```

### C. Standard Form Submit (Non-AJAX)
Pada form submit tradisional (seperti halaman auth login, register, reset password), aktifkan spinner segera setelah validasi sisi klien (*client-side validation*) terpenuhi sebelum form dikirim ke backend:

```javascript
form.addEventListener('submit', function (e) {
    if (!validateForm()) {
        e.preventDefault();
        return;
    }
    
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.setAttribute('data-kt-indicator', 'on');
        submitBtn.disabled = true;
    }
});
```

---

## 4. Checklist Kepatuhan Agen
- [ ] Apakah setiap tombol aksi/submit sudah memiliki elemen `.indicator-label` dan `.indicator-progress`?
- [ ] Apakah tombol mengaktifkan `data-kt-indicator="on"` dan `disabled = true` saat proses berjalan?
- [ ] Apakah tombol mematikan indikator dan mengaktifkan tombol kembali pada blok `finally` atau setelah error validasi?
- [ ] Apakah tidak ada tombol submit yang "diam tanpa reaksi visual" saat diklik pengguna?
