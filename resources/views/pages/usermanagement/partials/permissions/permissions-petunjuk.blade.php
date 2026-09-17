<!--begin::Modal Petunjuk Operasional Permissions-->
<div class="modal fade" id="kt_modal_permissions_petunjuk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40px symbol-circle bg-light-primary me-3 d-flex align-items-center justify-content-center">
                        <i class="ki-outline ki-information-5 text-primary fs-2"></i>
                    </div>
                    <div>
                        <h3 class="fw-bolder text-gray-900 m-0">Petunjuk Operasional Manajemen Izin</h3>
                        <span class="text-muted fs-8">Alur dan panduan penggunaan tombol aksi pada modul izin (permissions).</span>
                    </div>
                </div>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-outline ki-cross fs-2"></i>
                </div>
            </div>

            <div class="modal-body py-6 px-8">
                <div class="d-flex flex-column gap-4">
                    <!-- Step 1: Generate CRUD Otomatis -->
                    <div class="d-flex align-items-start p-4 bg-light rounded">
                        <div class="symbol symbol-35px symbol-circle me-4 flex-shrink-0">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">1</span>
                        </div>
                        <div>
                            <div class="fw-bold text-gray-800 fs-6 mb-1">Cara Generate Izin CRUD Modul Otomatis</div>
                            <div class="text-gray-700 fs-7">
                                Klik tombol biru <strong>"Generate CRUD Modul"</strong> di atas tabel. Pada jendela yang muncul, masukkan prefix nama modul (contoh: <code>masterdata.barang</code>), centang pilihan aksi (seperti <em>read, create, update, delete, sort, export</em>), lalu klik tombol <strong>Generate Izin Sekarang</strong>.
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Tambah Izin Manual -->
                    <div class="d-flex align-items-start p-4 bg-light rounded">
                        <div class="symbol symbol-35px symbol-circle me-4 flex-shrink-0">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">2</span>
                        </div>
                        <div>
                            <div class="fw-bold text-gray-800 fs-6 mb-1">Cara Menambah Izin Akses Manual</div>
                            <div class="text-gray-700 fs-7">
                                Klik tombol <strong>"Tambah Izin"</strong> di samping tombol generate. Ketikkan nama izin sesuai format konvensi (contoh: <code>laporan.cetak</code>) dan pilih modul induknya, kemudian klik tombol <strong>Simpan Izin</strong>.
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Ubah / Hapus Izin -->
                    <div class="d-flex align-items-start p-4 bg-light rounded">
                        <div class="symbol symbol-35px symbol-circle me-4 flex-shrink-0">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">3</span>
                        </div>
                        <div>
                            <div class="fw-bold text-gray-800 fs-6 mb-1">Cara Mengubah atau Menghapus Izin</div>
                            <div class="text-gray-700 fs-7">
                                Klik tombol ikon pensil <strong>"Ubah"</strong> pada baris izin untuk mengubah rincian izin, atau klik tombol ikon tempat sampah <strong>"Hapus"</strong> untuk menghapus izin yang tidak lagi digunakan setelah mengonfirmasi pesan pop-up.
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Pencarian & Filter Modul -->
                    <div class="d-flex align-items-start p-4 bg-light rounded">
                        <div class="symbol symbol-35px symbol-circle me-4 flex-shrink-0">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">4</span>
                        </div>
                        <div>
                            <div class="fw-bold text-gray-800 fs-6 mb-1">Cara Mencari & Memfilter Izin</div>
                            <div class="text-gray-700 fs-7">
                                Ketikkan kata kunci pada kotak <strong>"Cari Izin..."</strong> atau pilih kelompok modul pada dropdown <strong>"Semua Modul"</strong> di atas tabel. Daftar izin akan langsung disaring secara realtime.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 pt-0 px-8 pb-6">
                <button type="button" class="btn btn-primary fw-bold" data-bs-dismiss="modal">Tutup Petunjuk</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal Petunjuk Operasional Permissions-->
