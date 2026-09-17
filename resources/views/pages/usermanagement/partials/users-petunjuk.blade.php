<x-petunjuk-modal 
    id="kt_modal_users_petunjuk"
    title="Petunjuk Operasional: Manajemen Pengguna (Users)"
    subtitle="Panduan operasional pengelolaan akun pengguna, penugasan peran massal, dan penyaringan data"
    box1Title="Gambaran Umum & Manajemen Pengguna"
    box1Icon="ki-diamonds"
    box2Title="Struktur Data & Mode Tampilan"
    box2Icon="ki-element-11"
    box3Title="Alur Operasi Akun & Peran Massal"
    box3Icon="ki-key"
    box4Title="Aturan, Proteksi & Keamanan Akun"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Manajemen Pengguna (Users)</strong> memungkinkan administrator mengelola seluruh akun pengguna sistem Veltronic secara terpusat. Fitur ini mencakup pembuatan akun baru, pembaruan profil dan avatar, pengaturan peran ganda (<em>multi-role</em>), penetapan peran massal (<em>bulk assign</em>), serta kontrol keamanan kata sandi.
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Tampilan Kartu (Card View):</strong> Menampilkan profil visual interaktif, foto avatar dengan fokus vertikal, badge peran aktif, dan cover kustom masing-masing pengguna.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Tampilan Tabel (Table View):</strong> Menyajikan data terstruktur yang mendukung penomoran, sortir kolom dinamis, dan seleksi baris secara cepat.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Sidebar Filter Canggih:</strong> Saring data berdasarkan kata kunci (nama/email), peran spesifik, status verifikasi akun, dan urutan tanggal/abjad.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Tambah Pengguna Baru:</strong> Klik tombol <em>Tambah Pengguna</em> di kanan atas, lengkapi identitas, peran, kata sandi, dan foto avatar.</li>
            <li><strong>Pemberian Peran Massal (Bulk Assign):</strong> Centang satu atau beberapa pengguna (di kartu atau tabel), lalu klik tombol <em>Beri Role Massal</em> untuk menambahkan atau mengganti peran sekaligus.</li>
            <li><strong>Ubah Data & Foto Profil:</strong> Klik tombol <em>Ubah</em> untuk memperbarui data akun dan foto profil (posisi foto otomatis fokus di bagian atas).</li>
            <li><strong>Reset Kata Sandi:</strong> Klik opsi <em>Reset Password</em> pada menu aksi pengguna untuk mengembalikan kata sandi ke standar <code>password123</code>.</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Proteksi Akun Aktif:</strong> Anda tidak dapat menghapus akun Anda sendiri yang sedang digunakan saat ini demi integritas sistem.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Dukungan Multi-Role:</strong> Pengguna dapat memiliki lebih dari satu peran secara bersamaan (misal: Admin sekaligus Anggota).</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Zero-Reload Realtime:</strong> Seluruh pembaruan data, filter, dan penetapan peran diproses seketika tanpa perlu me-reload halaman peramban.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
