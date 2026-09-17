<x-petunjuk-modal 
    id="kt_modal_permissions_petunjuk"
    title="Petunjuk Operasional: Manajemen Izin (Permissions)"
    subtitle="Panduan operasional lengkap pembuatan, generator CRUD, dan pengelolaan unit izin sistem"
    box1Title="Gambaran Umum & Manajemen Izin"
    box1Icon="ki-diamonds"
    box2Title="Komponen & Format Standar Izin"
    box2Icon="ki-element-11"
    box3Title="Alur Operasional Pengelolaan Izin"
    box3Icon="ki-key"
    box4Title="Aturan & Proteksi Sistem"
    box4Icon="ki-security-user">

    <x-slot:box1>
        Modul <strong>Manajemen Izin (Permissions)</strong> mengelola unit perizinan individual terkecil (<em>atomic permissions</em>) berbasis Spatie. Izin ini menjadi dasar penentu wewenang controller, route, dan elemen antarmuka di seluruh modul aplikasi.
    </x-slot:box1>

    <x-slot:box2>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Generator CRUD Otomatis:</strong> Fasilitas untuk membuat 6 aksi CRUD standar (<span class="badge badge-light-secondary text-gray-700 fs-8">read</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">create</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">update</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">delete</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">sort</span>, <span class="badge badge-light-secondary text-gray-700 fs-8">export</span>) sekaligus.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Konvensi Penamaan:</strong> Menggunakan format standar titik (<code>modul.aksi</code>), contoh: <span class="badge badge-light text-gray-700 fs-8 font-monospace">usermanagement.users.read</span>.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-gray-500 me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pengelompokan Modul:</strong> Setiap izin dikelompokkan secara otomatis berdasarkan modul induknya agar mudah disaring.</div>
            </li>
        </ul>
    </x-slot:box2>

    <x-slot:box3>
        <ol class="text-gray-700 fs-7 mb-0 ps-4 d-flex flex-column gap-2">
            <li><strong>Generate Izin Praktis:</strong> Klik tombol <span class="badge bg-primary text-white fs-8">Modul CRUD Praktis</span> di header banner, ketik nama modul, centang opsi aksi, lalu generate.</li>
            <li><strong>Tambah Izin Tunggal:</strong> Klik tombol <span class="badge badge-light-primary text-primary fs-8">Single Permission</span> untuk menambah izin non-CRUD (misal: export, approve, verify).</li>
            <li><strong>Ubah / Hapus Izin:</strong> Gunakan tombol ikon pensil untuk mengubah atau ikon tempat sampah untuk menghapus izin dari tabel.</li>
            <li><strong>Filter & Pencarian Realtime:</strong> Ketikkan kata kunci pada <em>Cari Izin...</em> atau filter berdasarkan grup modul di atas tabel.</li>
        </ol>
    </x-slot:box3>

    <x-slot:box4>
        <ul class="text-gray-700 fs-7 mb-0 ps-0 list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Integritas Route & Middleware:</strong> Pastikan izin yang dihapus tidak lagi digunakan sebagai penjaga (guard) pada route controller sistem.</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Pembersihan Cache Otomatis:</strong> Sistem secara otomatis mereset cache perizinan Spatie setiap kali ada izin yang dibuat, diubah, atau dihapus (Zero-Reload).</div>
            </li>
            <li class="d-flex align-items-start">
                <span class="bullet bullet-dot bg-warning me-2 mt-2 flex-shrink-0"></span>
                <div><strong>Penamaan Unik:</strong> Setiap nama izin bersifat unik (unique) dan tidak boleh terduplikasi dalam database.</div>
            </li>
        </ul>
    </x-slot:box4>
</x-petunjuk-modal>
