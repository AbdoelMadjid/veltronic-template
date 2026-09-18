<x-petunjuk-modal 
    id="kt_modal_app_fiturs_petunjuk"
    title="Petunjuk Operasional: Manajer Fitur & Pengaturan Sistem"
    subtitle="Panduan operasional lengkap visibilitas fitur dashboard, pengaturan sistem, pintasan keyboard (shortcuts), dan pemantauan log aktivitas"
    box1Title="Gambaran Umum & Manajemen Fitur"
    box1Icon="ki-diamonds"
    box2Title="Komponen Modul & Tab Navigasi"
    box2Icon="ki-element-11"
    box3Title="Alur & Panduan Operasional"
    box3Icon="ki-key"
    box4Title="Pintasan Keyboard & Best Practices"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Manajer Fitur & Pengaturan Sistem</strong> berfungsi sebagai pusat kendali (*control center*) untuk mengatur visibilitas komponen antarmuka, menetapkan parameter sistem aplikasi secara permanen berbasis basis data (*database-backed configuration*), mengelola pintasan keyboard (*Shortcuts*), pembersihan *cache*, serta memantau jejak audit transaksi secara terpusat (*Centralized Activity Logging*).
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Visibilitas Fitur Dashboard:</strong> Mengaktifkan atau menyembunyikan tombol alat (*topbar tools*), navigasi menu atas (*topbar menus*), dan kategori menu samping (*sidebar menus*).</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pengaturan Aplikasi (Settings):</strong> Konfigurasi parameter umum, preferensi gaya ikon (KeenIcons *duotone, outline, solid*), bahasa bawaan, versi tata letak tema, dan pembersih *cache*.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pintasan Keyboard (Shortcuts):</strong> Pusat konfigurasi dan panduan pintasan tombol keyboard global untuk akses cepat fungsi sistem.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Log Aktivitas Sistem:</strong> Jejak rekam audit menyeluruh dari seluruh transaksi pengguna serta rekaman otomatis kesalahan teknis (*Backend Error*).</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Toggle Fitur Cepat & Pintasan Global:</strong>
                <ul class="ps-3 mt-1 text-muted fs-8">
                    <li><code>Ctrl + Alt + T</code>: Menampilkan / menyembunyikan seluruh Fitur & Tools di Topbar Navbar.</li>
                    <li><code>Ctrl + Alt + H</code>: Menampilkan / menyembunyikan seluruh Menu Utama di Topbar Header.</li>
                    <li><code>Ctrl + Alt + M</code>: Menampilkan / menyembunyikan seluruh Menu Template di Sidebar.</li>
                </ul>
            </li>
            <li><strong>Aksi Fitur Massal:</strong> Centang satu atau beberapa kotak centang fitur, lalu gunakan tombol <em>Aktifkan</em> atau <em>Sembunyikan</em> pada bilah aksi massal di bagian atas section.</li>
            <li><strong>Pusat Pintasan Keyboard:</strong> Buka tab *Pintasan Keyboard (Shortcuts)* untuk mengelola kombinasi tombol, role pengakses, dan target aksi secara dinamis.</li>
            <li><strong>Reset Konfigurasi (Seeder):</strong> Klik tombol <em>Reset Default (Seeder)</em> di banner atas untuk mengembalikan seluruh visibilitas fitur ke pengaturan bawaan awal basis data.</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-primary me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pintasan Keyboard Terintegrasi:</strong> Kombinasi tombol <code>Ctrl + Alt + T</code> (Topbar Navbar Tools), <code>Ctrl + Alt + H</code> (Topbar Header Menus), <code>Ctrl + Alt + M</code> (Menu Template Sidebar), <code>Ctrl + Alt + D/S/O</code> (Gaya Ikon), <code>Ctrl + Alt + B</code> (Mode Gelap/Terang), <code>Ctrl + Alt + I/E</code> (Bahasa Indonesia/English), <code>Ctrl + Alt + 1/2</code> (Versi Layout V1/V2), <code>Ctrl + Alt + F</code> (Pencarian Global), dan <code>Ctrl + Alt + L</code> (Lock Screen) aktif di seluruh halaman aplikasi.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Zero-Reload Realtime Sync:</strong> Seluruh interaksi perubahan fitur dan toggle pintasan tersinkronisasi langsung ke tampilan antarmuka dan basis data tanpa me-refresh browser.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
