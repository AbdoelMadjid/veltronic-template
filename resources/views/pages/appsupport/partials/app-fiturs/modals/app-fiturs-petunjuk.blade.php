<x-petunjuk-modal 
    id="kt_modal_app_fiturs_petunjuk"
    title="Petunjuk Operasional: Manajer Fitur & Pengaturan Sistem"
    subtitle="Panduan operasional lengkap visibilitas fitur dashboard, konfigurasi parameter sistem, pembersihan cache, dan pemantauan log audit aktivitas"
    box1Title="Gambaran Umum & Manajemen Fitur"
    box1Icon="ki-diamonds"
    box2Title="Komponen Modul & Tab Navigasi"
    box2Icon="ki-element-11"
    box3Title="Alur & Panduan Operasional"
    box3Icon="ki-key"
    box4Title="Aturan, Proteksi & Best Practices"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Manajer Fitur & Pengaturan Sistem</strong> berfungsi sebagai pusat kendali (*control center*) untuk mengatur visibilitas komponen antarmuka, menetapkan parameter sistem aplikasi secara permanen berbasis basis data (*database-backed configuration*), mengelola pembersihan *cache*, serta memantau jejak audit transaksi dan *backend error* secara terpusat (*Centralized Activity Logging*).
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Visibilitas Fitur Dashboard:</strong> Mengaktifkan atau menyembunyikan tombol alat (*topbar tools*), navigasi menu atas (*topbar menus*), dan kategori menu samping (*sidebar menus*).</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pengaturan Aplikasi (Settings):</strong> Konfigurasi parameter umum, preferensi gaya ikon (KeenIcons *duotone, outline, solid*), bahasa bawaan, versi tata letak tema, dan pembersih *cache* modular.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Log Aktivitas Sistem:</strong> Jejak rekam audit menyeluruh dari modul *User Management*, *App Support*, *Profil Pengguna*, serta rekaman otomatis kesalahan teknis sistem (*Backend Exception/Error*).</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Toggle Fitur Cepat:</strong> Klik langsung pada lencana status (<em>Aktif / Tersembunyi</em>) pada kartu fitur untuk mengubah visibilitas secara instan tanpa memuat ulang halaman.</li>
            <li><strong>Aksi Fitur Massal:</strong> Centang satu atau beberapa kotak centang fitur, lalu gunakan tombol <em>Aktifkan</em> atau <em>Sembunyikan</em> pada bilah aksi massal di bagian atas section.</li>
            <li><strong>Reset Konfigurasi (Seeder):</strong> Klik tombol <em>Reset Default (Seeder)</em> di banner atas untuk mengembalikan seluruh visibilitas fitur ke pengaturan bawaan awal basis data.</li>
            <li><strong>Simpan Konfigurasi & Bersihkan Cache:</strong> Pada tab *Pengaturan Aplikasi*, ubah parameter yang diinginkan lalu klik <em>Simpan Pengaturan</em> atau pilih tombol jenis *cache* untuk pembersihan instan.</li>
            <li><strong>Inspeksi Log Audit:</strong> Buka tab *Log Aktivitas Sistem*, gunakan filter Modul, Level (*Info, Success, Warning, Error*), Rentang Waktu, dan klik tombol ikon mata untuk melihat rincian lengkap jejak kejadian.</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Zero-Reload Realtime Sync:</strong> Seluruh interaksi perubahan fitur dan pencatatan log tersinkronisasi secara langsung ke tampilan antarmuka dan DataTables tanpa me-refresh halaman.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Isolasi Log Profil vs Sistem:</strong> Riwayat perubahan pada halaman *Profil Pengguna* hanya menampilkan audit pribadi pengguna yang sedang login, sementara log administratif seluruh modul tersimpan di modul ini.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Backend Error Recording:</strong> Setiap exception yang terjadi pada server backend otomatis tercatat dengan level <code>error</code> tanpa menghentikan atau merusak pengalaman pengguna.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
