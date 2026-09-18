<!--begin::Modal - Petunjuk Operasional Theme Frontpage-->
<x-petunjuk-modal 
    id="kt_modal_theme_frontpage_petunjuk"
    title="Petunjuk Operasional: Pengaturan Tema Halaman Depan (Theme Frontpage)"
    subtitle="Panduan komprehensif pemilihan tema publik, dinamisasi landing page, varian versi, menu anchor, dan section konten"
    box1Title="Gambaran Umum & Pemilihan Tema"
    box1Icon="ki-diamonds"
    box2Title="Komponen & Hirarki Antarmuka"
    box2Icon="ki-element-11"
    box3Title="Alur Operasional Penggunaan"
    box3Icon="ki-key"
    box4Title="Aturan, Proteksi & Keamanan Sistem"
    box4Icon="ki-security-user">

    <x-slot:box1>
        <p class="text-gray-700 fs-7 mb-2">
            Modul <strong>Tema Halaman Depan</strong> dirancang untuk mengelola pengalaman publik halaman depan aplikasi web:
        </p>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-primary me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Landing Page (Metronic 8):</strong> Template satu halaman (One-Page) modern untuk promosi, showcase produk, dan korporat.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Education Portal (Unify v2.6):</strong> Portal akademik multi-halaman untuk universitas, institusi pendidikan, dan riset.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-success me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Dukungan Varian Versi:</strong> Mendukung pemilihan sub-template versi landing (misal <code>v1</code>, <code>v2</code>) secara otomatis.</div>
            </li>
        </ul>
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-info me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Branding & Hero Banner:</strong> Pengaturan logo terang/gelap, favicon, judul hero, teks highlight gradien, dan tombol CTA.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-info me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Menu Navigasi & Anchor:</strong> Pengelolaan tautan header yang terhubung langsung ke ID section (<code>#how-it-works</code>, <code>#pricing</code>, dll.).</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-info me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Manajemen Section:</strong> Mengaktifkan/menonaktifkan bagian konten, mengubah urutan kemunculan, dan membuat section kustom baru.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-info me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Footer & Sosial:</strong> Pengaturan informasi kontak, legalitas, hak cipta, serta tautan ke media sosial resmi.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Mengganti Tema Aktif:</strong> Buka tab <em>Pilihan Tema</em> lalu klik tombol <em>Aktifkan</em> pada kartu Landing atau Education.</li>
            <li><strong>Menyesuaikan Versi Landing:</strong> Pilih varian versi pada dropdown (misal: Versi V1) lalu klik <em>Terapkan Versi</em>.</li>
            <li><strong>Mengatur Menu & Anchor:</strong> Tambahkan item menu baru pada tab <em>Menu Navigasi</em> dan tentukan target anchor (misal: <code>#pricing</code>).</li>
            <li><strong>Menyusun Ulang Section:</strong> Gunakan tombol panah Naik/Turun pada tab <em>Section Konten</em> untuk mengubah urutan bagian di landing page.</li>
            <li><strong>Menyimpan & Meninjau:</strong> Klik <em>Simpan</em> pada masing-masing form, lalu buka tab <em>Pratinjau</em> untuk melihat hasilnya secara realtime.</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Kesesuaian ID Anchor:</strong> Pastikan target anchor menu (misal: <code>#team</code>) memiliki section dengan slug anchor yang sama agar tautan navigasi berfungsi sempurna.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Zero-Reload Policy:</strong> Seluruh perubahan tersimpan dan diperbarui melalui AJAX realtime tanpa perlu reload halaman penuh.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pembersihan Cache:</strong> Gunakan tombol <em>Bersihkan Cache</em> jika terdapat pembaruan aset logo atau konfigurasi yang belum ter-refresh di browser publik.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
<!--end::Modal - Petunjuk Operasional Theme Frontpage-->
