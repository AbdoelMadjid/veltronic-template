<x-petunjuk-modal 
    id="kt_modal_menu_petunjuk"
    title="Petunjuk Operasional: Manajemen Menu & Navigasi"
    subtitle="Panduan operasional konfigurasi struktur menu dinamis, hierarki sub-menu, hak akses, dan drag & drop urutan"
    box1Title="Gambaran Umum & Navigasi Dinamis"
    box1Icon="ki-diamonds"
    box2Title="Hierarki Level & Struktur Menu"
    box2Icon="ki-element-11"
    box3Title="Alur Pengelolaan & Pengurutan Menu"
    box3Icon="ki-key"
    box4Title="Aturan Hak Akses & Proteksi Menu"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Manajemen Menu & Navigasi</strong> digunakan untuk mengelola susunan menu navigasi utama (sidebar & header) sistem Veltronic secara dinamis. Administrator dapat menambah, mengubah, menonaktifkan, serta mengatur hak akses peran pengguna terhadap setiap mata menu tanpa perlu memodifikasi kode sumber aplikasi.
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Header / Kategori:</strong> Pembatas kelompok menu (seperti <em>User Management</em>, <em>App Support</em>) untuk mengorganisasikan menu sidebar secara tematik.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Menu Utama (Level 1):</strong> Menu utama yang dapat berdiri sendiri sebagai tautan halaman langsung atau bertindak sebagai induk (<em>parent</em>) sub-menu.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Sub Menu (Level 2 & 3):</strong> Anak menu bertingkat yang berada di dalam menu induk untuk mempermudah navigasi fitur turunan yang lebih terinci.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Tambah Menu Baru:</strong> Klik tombol <em>Tambah Menu</em> pada sudut kanan atas tabel, tentukan jenis level (Utama/Sub), rute URL, icon KeenIcons, dan badge status jika diperlukan.</li>
            <li><strong>Tambah Cepat Sub Menu:</strong> Klik tombol ikon tambah (<code>+</code>) pada baris menu induk untuk langsung membuat sub-menu di bawah induk tersebut.</li>
            <li><strong>Ubah / Sunting Menu:</strong> Klik tombol pensil untuk memperbarui label nama (ID & EN), translation key, icon, atau status keaktifan menu.</li>
            <li><strong>Pengurutan Drag & Drop:</strong> Arahkan kursor dan seret (<em>drag & drop</em>) baris menu pada tabel untuk mengubah urutan tampilan secara instan (tersimpan otomatis).</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Penetapan Hak Akses (Roles & Permissions):</strong> Setiap menu hanya akan tampil pada pengguna yang memiliki peran (<em>role</em>) atau izin (<em>permission</em>) yang diizinkan.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pewarisan Akses Induk:</strong> Menu induk otomatis ditampilkan jika pengguna memiliki hak akses terhadap minimal salah satu anak sub-menunya.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Status Nonaktif:</strong> Menonaktifkan status menu akan menyembunyikan menu tersebut dari seluruh navigasi tanpa menghapus datanya dari sistem.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
