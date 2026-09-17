<x-petunjuk-modal 
    id="kt_modal_akses_role_petunjuk"
    title="Petunjuk Operasional: Matriks Hak Akses Role"
    subtitle="Panduan operasional lengkap pengolahan matriks izin fitur per role pengguna"
    box1Title="Gambaran Umum & Matriks Perizinan"
    box1Icon="ki-diamonds"
    box2Title="Hirarki & Komponen Matriks Role"
    box2Icon="ki-element-11"
    box3Title="Alur Operasional Pengaturan Hak Akses"
    box3Icon="ki-key"
    box4Title="Aturan & Proteksi Sistem"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Halaman <strong>Matriks Hak Akses Role</strong> memungkinkan administrator mengatur izin akses fitur untuk setiap role pengguna secara visual. Setiap centang pada matriks terhubung langsung dengan permission Spatie pada role terpilih.
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pemilihan Role:</strong> Memilih role (contoh: <span class="badge badge-light-secondary text-gray-700 fs-8">Master</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">Admin</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">User</span>) untuk memuat matriks perizinan aktif.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Centang Aksi CRUD:</strong> Mengatur hak akses <span class="badge badge-light-secondary text-gray-700 fs-8">Create</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">Read</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">Update</span>, dan <span class="badge badge-light-secondary text-gray-700 fs-8">Delete</span> per modul.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pintas Baris Modul:</strong> Mengaktifkan atau mematikan seluruh izin baris modul dalam 1 klik.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Pilih Role Target:</strong> Klik item role di daftar sidebar kiri untuk memuat matriks perizinan aktif.</li>
            <li><strong>Centang Izin Individual:</strong> Centang atau hapus centang izin CRUD pada tiap baris modul.</li>
            <li><strong>Pintas Baris Modul:</strong> Gunakan switch toggle di sebelah kiri baris modul untuk memilih seluruh izin modul sekaligus.</li>
            <li><strong>Simpan Perubahan Matriks:</strong> Klik tombol <span class="badge bg-primary text-white fs-8">Simpan Peran Ini</span> untuk menyimpan pembaruan.</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Proteksi Role Master:</strong> Izin utama untuk role <span class="badge badge-light-danger text-danger fs-8">Master</span> dilindungi agar tidak dapat dimatikan secara tidak sengaja.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pembaruan Real-Time:</strong> Perubahan matriks perizinan langsung berlaku bagi sesi pengguna aktif setelah halaman diperbarui.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pencarian Cepat:</strong> Gunakan kotak pencarian matriks untuk menemukan nama modul secara cepat.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
