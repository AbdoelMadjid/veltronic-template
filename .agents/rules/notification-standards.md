# Aturan Standar Notifikasi & Alert Template (Metronic 8.3.2)

Setiap modul di proyek ini **WAJIB** menggunakan sistem notifikasi standar bawaan template melalui helper global `Notify` (`window.Notify` atau `window.AppNotify`) yang berpusat di `public/assets/js/custom/notification-helper.js`.

---

## 1. Prinsip Utama Notifikasi

1. **DILARANG** membuat styling CSS manual atau struktur HTML *toast container* buatan sendiri per halaman.
2. **DILARANG** memanggil SweetAlert dengan styling bawaan non-Metronic. Seluruh dialog konfirmasi SweetAlert harus menggunakan `buttonsStyling: false` dan class Metronic (`btn btn-primary`, `btn btn-light`, `btn btn-danger`).
3. **Posisi Standar Toast**: Seluruh notifikasi *Toast* (Toastr) wajib berada di **Pojok Kanan Atas** (`toastr-top-right`) dengan fitur *close button* dan *progress bar*.
4. **Otomasi Flash Session Laravel**: Notifikasi dari controller via `session('success')`, `session('error')`, `session('warning')`, `session('info')`, atau `session('status')` otomatis dirender ke Toastr via partial `resources/views/partials/_notification.blade.php`.

---

## 2. API Helper JavaScript `window.Notify`

### A. Toast Pop-up Notifications (Toastr - Top Right)
```javascript
// Success
Notify.success('Data berhasil disimpan!', 'Sukses');

// Error / Gagal
Notify.error('Terjadi kesalahan saat memproses data.', 'Gagal');

// Warning / Peringatan
Notify.warning('Pilih setidaknya satu item terlebih dahulu.', 'Perhatian');

// Info
Notify.info('Sistem sedang melakukan sinkronisasi data.', 'Informasi');

// Clear all active toasts
Notify.toast.clear();
```

### B. SweetAlert2 Dialogs (Metronic Button Styling)

#### 1. Alert Biasa / Info Pop-up
```javascript
Notify.alert({
    title: 'Berhasil!',
    text: 'Konfigurasi telah diperbarui.',
    icon: 'success', // 'success' | 'error' | 'warning' | 'info' | 'question'
    confirmButtonText: 'Ok, Mengerti'
});
```

#### 2. Dialog Konfirmasi Umum (`confirm`)
```javascript
Notify.confirm({
    title: 'Simpan Perubahan?',
    text: 'Perubahan ini akan langsung diterapkan ke sistem.',
    icon: 'question',
    confirmButtonText: 'Ya, Simpan!',
    cancelButtonText: 'Batal',
    onConfirm: function() {
        // Callback saat user klik konfirmasi
        doSave();
    },
    onCancel: function() {
        // Callback saat user klik batal (opsional)
    }
});

// Atau menggunakan Promise:
Notify.confirm({
    text: 'Lanjutkan proses impor data?'
}).then((result) => {
    if (result.isConfirmed) {
        processImport();
    }
});
```

#### 3. Dialog Konfirmasi Hapus Data (`deleteConfirm`)
Pre-configured dengan tombol merah bahaya (`btn btn-danger`):
```javascript
Notify.deleteConfirm({
    text: 'Data pengguna ini akan dihapus permanen!',
    onConfirm: function() {
        submitDeleteForm();
    }
});
```

---

## 3. Cara Penggunaan di Controller (Laravel Flash Message)
Di controller cukup return redirect dengan flash session standar Laravel, layout otomatis menampilkannya:
```php
return redirect()->back()->with('success', 'Fitur berhasil diaktifkan.');
return redirect()->back()->with('error', 'Gagal memproses data.');
return redirect()->back()->with('warning', 'Beberapa item tidak dapat diperbarui.');
return redirect()->back()->with('info', 'Pembaruan sedang berjalan.');
```
