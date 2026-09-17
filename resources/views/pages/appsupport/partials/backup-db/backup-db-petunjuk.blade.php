<x-petunjuk-modal 
    id="kt_modal_backup_db_petunjuk"
    title="Petunjuk Operasional: Database Backup & Relasi"
    subtitle="Panduan operasional lengkap pencadangan basis data, inspeksi skema relasi, dan prosedur pemulihan data"
    box1Title="Gambaran Umum & Manajemen Cadangan"
    box1Icon="ki-diamonds"
    box2Title="Inspeksi Skema & Komponen Modul"
    box2Icon="ki-element-11"
    box3Title="Alur & Prosedur Pencadangan/Pemulihan"
    box3Icon="ki-key"
    box4Title="Aturan, Proteksi & Otomatisasi"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Database Backup & Relasi</strong> dirancang untuk menjaga integritas serta keberlangsungan data (<em>Data Continuity & Disaster Recovery</em>) sistem Veltronic. Pengguna dapat memantau keterhubungan relasional antar tabel dalam basis data, mengekspor berkas <em>dump</em> SQL terkompresi GZIP, serta memulihkan (<em>restore</em>) data aplikasi saat dibutuhkan secara aman.
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Struktur & Relasi Skema:</strong> Memetakan nama tabel, estimasi baris data (<em>row count</em>), ukuran penyimpanan, serta keterhubungan <em>Foreign Key</em> untuk mencegah data terputus (<em>orphaned data</em>).</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Riwayat & Berkas Cadangan:</strong> Menampung seluruh berkas hasil dump SQL (.sql / .sql.gz) lengkap dengan info ukuran, tanggal pembuatan, dan opsi unduh / pulihkan / hapus.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pengaturan Backup Otomatis:</strong> Konfigurasi frekuensi pencadangan otomatis (harian, mingguan, atau bulanan) dan batasan retensi berkas cadangan lama.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Backup Seluruh Database:</strong> Klik tombol <em>Backup Seluruh DB</em> di header tabel untuk mengekspor seluruh skema DDL dan data DML ke dalam satu berkas SQL terkompresi.</li>
            <li><strong>Backup Selektif / Parsial:</strong> Centang satu atau beberapa checkbox tabel pada daftar, lalu klik <em>Backup Terpilih</em> untuk mencadangkan tabel tertentu beserta relasinya.</li>
            <li><strong>Unduh Berkas Cadangan:</strong> Buka tab <em>Riwayat & Berkas Cadangan</em>, lalu klik tombol unduh untuk menyimpan berkas dump SQL ke penyimpanan lokal Anda.</li>
            <li><strong>Pemulihan Data (Restore):</strong> Klik tombol <em>Restore</em> pada baris berkas cadangan di riwayat untuk memulihkan seluruh struktur dan data database ke kondisi saat cadangan dibuat.</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Peringatan Kritis Restore:</strong> Proses <em>Restore</em> akan menimpa (<em>drop & recreate</em>) tabel database. Pastikan Anda telah membuat cadangan terbaru sebelum menjalankan pemulihan.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Foreign Key Checks:</strong> Sistem secara otomatis menonaktifkan pengecekan kunci asing selama proses pemulihan agar tidak terjadi konflik dependensi antar tabel.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pembersihan Otomatis (Retention):</strong> Berkas cadangan yang melampaui batas retensi hari yang telah dikonfigurasi akan dibersihkan secara otomatis oleh task scheduler.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
