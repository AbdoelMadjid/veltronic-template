# Aturan Standar CRUD Realtime & Zero-Reload Halaman (Zero Page Reload)

Aturan ini **WAJIB DIPATUHI SECARA KONSISTEN** pada seluruh modul, halaman, form, dan operasi CRUD (Create, Read, Update, Delete) di proyek ini.

---

## 1. Prinsip Utama: Zero-Reload Page Policy
1. **DILARANG ME-RELOAD HALAMAN**:
   - Seluruh operasi CRUD (Create, Read, Update, Delete), upload berkas/foto/avatar/KTP, ganti password, simpan identitas, toggle switch/fitur, perataan urutan (reorder), dan penyimpanan konfigurasi **DILARANG KERAS** menggunakan `window.location.reload()`, `location.reload()`, atau reload browser via standard form action submit.
2. **Tab & State Preservation**:
   - Tab yang sedang aktif harus **tetap berada di tab yang sama** setelah proses CRUD selesai, tanpa mereset navigasi atau posisi scroll halaman.
3. **Interactive & Responsive Feedback**:
   - Setiap aksi harus memberikan feedback visual instan (indikator loading pada tombol via `data-kt-indicator="on"`, nonaktifkan tombol submit saat proses berjalan, dan kembalikan ke semula setelah respons diterima).

---

## 2. Alur Eksekusi CRUD & Pembaruan Data Realtime

Setiap aksi CRUD harus dijalankan secara asynchronous (AJAX / Fetch API) dengan alur:
1. **Pengiriman Request**: Data dikirim via `fetch` atau AJAX dengan header `X-Requested-With: XMLHttpRequest` dan `Accept: application/json`.
2. **Respons Sukses**:
   - Tampilkan notifikasi (SweetAlert2 atau Toastr) sesuai [notification-standards.md](file:///.agents/rules/notification-standards.md).
   - Perubahan data langsung diterapkan ke DOM secara realtime:
     - **Update**: Ubah teks, nilai atribut, gambar, badge, atau baris DOM yang bersangkutan secara instan atau saat alert ditutup.
     - **Create**: Tambahkan baris baru ke dalam DataTable/List atau reload data tabel secara internal (`table.ajax.reload(null, false)`) tanpa me-reload browser, lalu tutup dan reset formulir modal.
     - **Delete**: Hapus baris dari tabel/DOM secara instan (`table.row($(this).parents('tr')).remove().draw(false)`), dan perbarui counter/statistik jika ada.
     - **Upload/Media**: Perbarui `src` gambar, background image wrapper, dan link download/modal secara dinamis.
3. **Respons Gagal / Validasi Error (422 / 500)**:
   - Tampilkan pesan kesalahan secara ramah via SweetAlert2/Toastr tanpa me-reload halaman atau menghapus data yang telah diinput pengguna di form.

---

## 3. Standar Respons Controller (Backend Laravel)

Setiap controller yang menangani aksi formulir / CRUD **WAJIB** mendukung respons JSON ketika `$request->expectsJson() || $request->ajax()`:

```php
public function update(Request $request): JsonResponse|RedirectResponse
{
    // Validasi & Update Logika
    ...

    if ($request->expectsJson() || $request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.',
            'data' => $model->fresh(),
            // Kembalikan field / kalkulasi realtime yang dibutuhkan DOM
        ]);
    }

    return redirect()->back()->with('success', 'Data berhasil diperbarui.');
}
```

---

## 4. Standar JavaScript Frontend (Client-side)

```javascript
// Pola AJAX Form Handler Realtime
function handleRealtimeForm(formId, btnId, onSuccess) {
    const form = document.getElementById(formId);
    const btn = document.getElementById(btnId);
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (btn) {
            btn.setAttribute('data-kt-indicator', 'on');
            btn.disabled = true;
        }

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async res => {
            const data = await res.json();
            if (btn) {
                btn.removeAttribute('data-kt-indicator');
                btn.disabled = false;
            }

            if (res.ok && data.success) {
                // Tampilkan notifikasi
                Swal.fire({
                    text: data.message || 'Perubahan berhasil disimpan.',
                    icon: 'success',
                    buttonsStyling: false,
                    confirmButtonText: 'OK',
                    customClass: { confirmButton: 'btn btn-primary' }
                }).then(() => {
                    // Update data realtime saat notifikasi selesai/ditutup
                    if (typeof onSuccess === 'function') {
                        onSuccess(data);
                    }
                });
            } else {
                let errorMsg = data.message || 'Terjadi kesalahan.';
                if (data.errors) {
                    errorMsg = Object.values(data.errors).flat().join('<br>');
                }
                Swal.fire({
                    html: errorMsg,
                    icon: 'error',
                    buttonsStyling: false,
                    confirmButtonText: 'Tutup',
                    customClass: { confirmButton: 'btn btn-primary' }
                });
            }
        })
        .catch(err => {
            if (btn) {
                btn.removeAttribute('data-kt-indicator');
                btn.disabled = false;
            }
            Swal.fire({
                text: 'Gagal terhubung ke server.',
                icon: 'error',
                buttonsStyling: false,
                confirmButtonText: 'OK',
                customClass: { confirmButton: 'btn btn-primary' }
            });
        });
    });
}
```
