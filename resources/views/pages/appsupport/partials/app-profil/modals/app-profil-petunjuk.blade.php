<x-petunjuk-modal 
    id="kt_modal_app_profil_petunjuk"
    title="Petunjuk Operasional: Profil & Identitas Aplikasi Dashboard"
    subtitle="Panduan lengkap pengelolaan data meta SEO, aset logo terang/gelap, favicon, footer, serta sinkronisasi seeder"
    box1Title="Gambaran Umum & Identitas Dashboard"
    box1Icon="ki-diamonds"
    box2Title="Komponen & 4 Tab Navigasi Modul"
    box2Icon="ki-element-11"
    box3Title="Alur Operasional & Manajemen Profil"
    box3Icon="ki-key"
    box4Title="Aturan, Sinkronisasi Seeder & Proteksi"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Profil & Identitas Aplikasi Dashboard</strong> digunakan oleh administrator untuk memantau status konfigurasi sistem, mengatur identitas aplikasi, data meta SEO & Open Graph, aset visual (logo mode terang, logo mode gelap, logo mini, favicon), serta teks hak cipta dan tautan dinamis pada footer dashboard.
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Ringkasan (Overview):</strong> Kartu statistik skor kelengkapan konfigurasi profil, jumlah parameter terisi, status logo, tautan footer, serta tabel rincian metadata dan lingkungan server.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Identitas & Meta SEO:</strong> Mengatur nama aplikasi, tagline, versi rilis, deskripsi pencarian, kata kunci, author, dan live preview Google Search serta Open Graph social card.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Logo & Favicon:</strong> Mengunggah dan memperbarui logo terang, logo gelap, logo mini, dan favicon tab peramban langsung ke direktori <code>public/assets/logo/</code>.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pengaturan Footer:</strong> Mengatur tahun copyright, nama pemilik, URL tautan, switch status info server (Laravel, PHP, MySQL), dan tabel repeater tautan footer.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Tinjau Status Kelengkapan:</strong> Buka tab <em>Ringkasan</em> untuk melihat persentase kelengkapan data profil dan verifikasi parameter sistem aktif.</li>
            <li><strong>Ubah Data Meta:</strong> Buka tab <em>Identitas & Meta SEO</em>, ketik perubahan data, perhatikan live preview Google Search & Social Card, lalu klik <em>Simpan Data Meta</em>.</li>
            <li><strong>Unggah / Perbarui Logo:</strong> Buka tab <em>Logo & Favicon</em>, pilih berkas gambar baru (SVG/PNG/JPG/WebP/ICO), lalu klik <em>Simpan & Terapkan Logo</em>.</li>
            <li><strong>Kelola Footer Dashboard:</strong> Buka tab <em>Pengaturan Footer</em>, sesuaikan teks copyright dan kelola baris tautan (Tambah/Hapus), lalu klik <em>Simpan Pengaturan Footer</em>.</li>
            <li><strong>Sinkronisasi File Seeder:</strong> Klik tombol <em>Perbarui File Seeder</em> di banner atas untuk mengekspor konfigurasi aktif saat ini ke <code>database/seeders/AppProfilSeeder.php</code>.</li>
            <li><strong>Jalankan Ulang Seeder:</strong> Klik tombol <em>Jalankan Seeder</em> jika ingin mereset/memuat ulang basis data dari berkas seeder.</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Zero-Reload Realtime Policy:</strong> Seluruh perubahan tersimpan otomatis via AJAX dan antarmuka dashboard (header, sidebar, title, footer) langsung ter-update tanpa me-refresh browser.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Penyimpanan Berkas Permanen:</strong> Aset gambar disimpan di <code>public/assets/logo/</code> sehingga aman dan terbawa saat <code>git push</code> atau <code>git clone</code>.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pembersihan Cache:</strong> Gunakan tombol <em>Bersihkan Cache</em> jika browser masih menyimpan cache aset lama.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
