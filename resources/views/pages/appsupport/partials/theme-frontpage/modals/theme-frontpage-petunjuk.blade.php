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
                <span class="bullet bullet-dot bg-primary me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Tab Khusus Landing Page:</strong> Meliputi <em>Branding & Hero</em>, <em>Menu Navigasi (Anchor)</em>, <em>Section Konten (On/Off & Urutan)</em>, <em>Footer & Sosial</em>, dan <em>Pratinjau Landing</em>.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Tab Khusus Education Portal:</strong> Meliputi <em>Info & Identitas</em>, <em>Katalog Halaman (13 Rute Multipage)</em>, <em>Navigasi & Topbar</em>, <em>Footer & Kontak Kampus</em>, dan <em>Pratinjau Portal</em>.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-success me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pilihan Tema Terpusat:</strong> Tab <em>Pilihan Tema</em> selalu tersedia di posisi awal untuk berganti tema aktif secara instan tanpa reload halaman.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Mengganti Tema:</strong> Buka tab <em>Pilihan Tema</em> lalu klik <em>Aktifkan</em> pada kartu tema pilihan Anda (Landing atau Education). Tab konfigurasi akan berganti secara realtime.</li>
            <li><strong>Konfigurasi Landing Page:</strong> Atur banner hero, menu anchor, susunan section, serta footer promosi melalui tab-tab Landing.</li>
            <li><strong>Konfigurasi Education Portal:</strong> Kelola profil universitas, direktori 13 rute halaman akademik, preferensi topbar intake, serta footer kampus melalui tab-tab Education.</li>
            <li><strong>Menyimpan Perubahan:</strong> Klik tombol <em>Simpan</em> di setiap form untuk memperbarui konfigurasi seketika dengan feedback toast notifikasi.</li>
            <li><strong>Uji Pratinjau Interaktif:</strong> Buka tab <em>Pratinjau</em> untuk menguji tampilan halaman langsung dalam mode Desktop, Tablet, atau Mobile.</li>
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
