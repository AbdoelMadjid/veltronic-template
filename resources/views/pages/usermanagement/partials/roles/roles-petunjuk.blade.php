<x-petunjuk-modal 
    id="kt_modal_role_petunjuk"
    title="Petunjuk Operasional: Manajemen Peran (Roles)"
    subtitle="Panduan operasional lengkap pengelolaan grup peran dan penetapan hak akses default pengguna"
    box1Title="Gambaran Umum & Manajemen Peran"
    box1Icon="ki-diamonds"
    box2Title="Komponen Kartu & Struktur Peran"
    box2Icon="ki-element-11"
    box3Title="Alur Operasional Pengelolaan Peran"
    box3Icon="ki-key"
    box4Title="Aturan & Proteksi Sistem"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Manajemen Peran (Roles)</strong> memungkinkan administrator mengelompokkan hak akses pengguna ke dalam tingkatan wewenang tertentu. Setiap peran menentukan batasan menu dan aksi yang dapat diakses oleh anggotanya secara terstruktur.
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Daftar Kartu Peran:</strong> Setiap kartu menampilkan nama peran, status proteksi sistem, daftar perizinan utama, serta total akun pengguna aktif.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Kartu Tambah Cepat:</strong> Kartu bergaris putus-putus (<em>dashed border</em>) di akhir daftar untuk membuat peran baru secara instan.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Menu Aksi Peran:</strong> Tersedia tombol <span class="badge badge-light-secondary text-gray-700 fs-8">Rincian</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">Ubah</span>, dan <span class="badge badge-light-danger text-danger fs-8">Hapus</span> pada masing-masing kartu peran.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Tambah Peran Baru:</strong> Klik kartu <em>Tambah Peran Baru</em> atau tombol di banner, ketikkan nama peran serta centang matriks izinnya.</li>
            <li><strong>Lihat Rincian & Anggota:</strong> Klik tombol <em>Rincian</em> untuk melihat informasi peran dan daftar akun pengguna pemegang peran tersebut.</li>
            <li><strong>Ubah Data & Izin:</strong> Klik tombol <em>Ubah</em> untuk memperbarui nama peran atau menyesuaikan tanda centang matriks hak aksesnya.</li>
            <li><strong>Hapus Peran Kustom:</strong> Klik tombol <em>Hapus</em> (ikon tempat sampah) untuk menghapus peran kustom yang sudah tidak digunakan.</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Proteksi Peran Bawaan:</strong> Peran bawaan sistem (<span class="badge badge-light-danger text-danger fs-8">Master</span> / <span class="badge badge-light-primary text-primary fs-8">Admin</span>) diproteksi secara otomatis agar tidak dapat dihapus demi integritas sistem.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Sinkronisasi Real-Time:</strong> Perubahan izin pada suatu peran langsung diterapkan ke seluruh pengguna terkait secara otomatis (Zero-Reload).</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Relasi Pengguna:</strong> Pastikan anggota dalam peran telah dialihkan sebelum peran kustom dihapus dari sistem.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
