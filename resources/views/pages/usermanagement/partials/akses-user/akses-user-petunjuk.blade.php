<x-petunjuk-modal 
    id="kt_modal_akses_user_petunjuk"
    title="Petunjuk Operasional: Hak Akses Pengguna"
    subtitle="Panduan operasional lengkap penetapan peran dan izin langsung per pengguna"
    box1Title="Gambaran Umum & Hak Akses Pengguna"
    box1Icon="ki-diamonds"
    box2Title="Komponen & Model Perizinan Pengguna"
    box2Icon="ki-element-11"
    box3Title="Alur Operasional Hak Akses Pengguna"
    box3Icon="ki-key"
    box4Title="Aturan & Proteksi Sistem"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Hak Akses Pengguna (User Access)</strong> mengatur penetapan peran (<em>role assignment</em>) serta pemberian izin khusus langsung (<em>direct permissions</em>) per akun pengguna yang melengkapi izin bawaan dari perannya.
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Peran Terikat (Assigned Roles):</strong> Pengguna dapat memiliki satu atau lebih peran sekaligus (contoh: <span class="badge badge-light-primary text-primary fs-8">Admin</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">Anggota</span>).</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Izin Khusus Langsung:</strong> Izin tambahan perorangan yang diberikan langsung ke akun tanpa perlu membuat peran baru.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Badge & Counter Izin:</strong> Kolom tabel menampilkan lencana peran aktif dan total izin yang efektif dimiliki pengguna.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Cari Pengguna Target:</strong> Gunakan kotak pencarian "Cari Pengguna..." atau filter peran di atas tabel data.</li>
            <li><strong>Tetapkan Peran (Assign Role):</strong> Klik tombol ikon profil biru (<i class="ki-outline ki-profile-user text-primary fs-7"></i>) pada kolom Aksi, centang peran yang sesuai, lalu klik simpan.</li>
            <li><strong>Atur Izin Khusus Langsung:</strong> Klik tombol ikon perisai kuning (<i class="ki-outline ki-shield-search text-warning fs-7"></i>) untuk mengedit matriks direct permissions perorangan.</li>
            <li><strong>Simpan Perubahan:</strong> Klik tombol <span class="badge bg-primary text-white fs-8">Simpan</span> untuk menerapkan perizinan secara realtime (Zero-Reload).</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Hirarki Hak Akses:</strong> Pengguna memiliki gabungan (<em>union</em>) seluruh izin dari semua peran miliknya ditambah direct permissions yang diberikan secara khusus.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Proteksi Akun Master:</strong> Akun dengan peran <span class="badge badge-light-danger text-danger fs-8">Master</span> memiliki wewenang penuh ke seluruh fitur sistem secara otomatis.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Sinkronisasi Sesi:</strong> Pembaruan peran dan perizinan langsung berlaku pada aksi berikutnya dari sesi pengguna yang bersangkutan.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
