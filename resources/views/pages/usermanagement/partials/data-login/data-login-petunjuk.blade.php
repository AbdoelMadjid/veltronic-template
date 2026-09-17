<x-petunjuk-modal 
    id="kt_modal_data_login_petunjuk"
    title="Petunjuk Operasional: Riwayat Data Login & Reward Poin"
    subtitle="Panduan operasional lengkap mengenai reward poin login 24 jam, pencatatan sesi login, buka layar kunci, dan penyaringan data"
    box1Title="Gambaran Umum & Reward Poin 24 Jam"
    box1Icon="ki-diamonds"
    box2Title="Metode Autentikasi & Struktur Sesi"
    box2Icon="ki-element-11"
    box3Title="Alur Pemantauan & Operasi Data Login"
    box3Icon="ki-key"
    box4Title="Aturan Reward Poin & Proteksi Sistem"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Riwayat Data Login Pengguna</strong> berfungsi mencatat seluruh aktivitas autentikasi pengguna ke dalam sistem, baik melalui formulir <em>Login Web</em> maupun pembukaan <em>Layar Kunci (Lock Screen)</em>, sekaligus mengelola reward <strong>1 Poin per 24 Jam</strong> untuk setiap pengguna aktif.
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Login Web (Web Login):</strong> Sesi yang tercatat saat pengguna memasukkan kredensial akun melalui halaman login utama sistem.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Buka Layar Kunci (Lock Screen):</strong> Sesi saat pengguna membuka kunci layar setelah masa tidak aktif (<em>inactivity timeout</em>) dengan memasukkan kata sandi.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Rincian Teknis Sesi:</strong> Mencakup jenis perangkat (Desktop/Mobile/Tablet), peramban (Browser), sistem operasi (Platform), alamat IP klien, dan <em>User Agent</em> lengkap.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Penyaringan Data Cerdas:</strong> Gunakan kotak pencarian dan filter di atas tabel untuk menyaring riwayat berdasarkan nama/email pengguna, tipe sesi, status reward poin, peran pengguna, maupun rentang waktu (Hari Ini, Kemarin, Minggu Ini, Bulan Ini).</li>
            <li><strong>Inspeksi Detail Sesi:</strong> Klik tombol <span class="badge badge-light-primary text-primary fs-8">Ikon Mata</span> pada kolom aksi untuk melihat jendela detail lengkap profil pengguna, status poin, dan user agent mentah.</li>
            <li><strong>Hapus Riwayat Tunggal:</strong> Klik tombol <span class="badge badge-light-danger text-danger fs-8">Ikon Tempat Sampah</span> pada baris terkait untuk menghapus satu catatan riwayat sesi secara instan.</li>
            <li><strong>Hapus Terpilih Massal (Bulk Delete):</strong> Centang beberapa baris sesi login, lalu klik tombol <em>Hapus Terpilih</em> yang muncul di bilah filter atas.</li>
            <li><strong>Pembersihan Berkala (Clear Logs):</strong> Klik tombol <em>Bersihkan Log</em> di banner atas untuk menghapus data log lawas (>30 hari, >90 hari, atau reset total).</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Ketentuan 1 Poin per 24 Jam:</strong> Pengguna hanya mendapatkan +1 poin satu kali dalam rentang 24 jam. Jika pengguna login berkali-kali di hari yang sama, poin tetap sama dan log berstatus <span class="badge badge-light-secondary fs-9">0 Poin (Sudah Klaim)</span>.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Akumulasi Poin di Siklus Baru:</strong> Poin baru (+1) akan bertambah secara otomatis pada login pertama setelah melewati waktu $\ge 24\text{ jam}$ dari perolehan poin sebelumnya.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Zero-Reload Realtime:</strong> Seluruh penghapusan, filter, dan pembaruan statistik tabel berjalan secara asynchronous tanpa me-reload peramban.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
