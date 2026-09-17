<!--begin::Modal Petunjuk Operasional Akses Role-->
<div class="modal fade" id="kt_modal_akses_role_petunjuk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40px symbol-circle bg-light-primary me-3 d-flex align-items-center justify-content-center">
                        <i class="ki-outline ki-information-5 text-primary fs-2"></i>
                    </div>
                    <div>
                        <h3 class="fw-bolder text-gray-900 m-0">Petunjuk Operasional Hak Akses Peran</h3>
                        <span class="text-muted fs-8">Alur dan panduan penggunaan tombol aksi pada matriks hak akses peran.</span>
                    </div>
                </div>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-outline ki-cross fs-2"></i>
                </div>
            </div>

            <div class="modal-body py-6 px-8">
                <div class="d-flex flex-column gap-4">
                    <!-- Step 1: Pilih Tab Peran -->
                    <div class="d-flex align-items-start p-4 bg-light rounded">
                        <div class="symbol symbol-35px symbol-circle me-4 flex-shrink-0">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">1</span>
                        </div>
                        <div>
                            <div class="fw-bold text-gray-800 fs-6 mb-1">Cara Memilih Tab Peran</div>
                            <div class="text-gray-700 fs-7">
                                Klik pada salah satu tab nama peran di bagian atas tabel (seperti <em>Master</em>, <em>Admin</em>, atau peran lainnya). Angka badge di samping nama peran menunjukkan total izin yang saat ini aktif untuk peran tersebut.
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Atur Izin Matriks CRUD -->
                    <div class="d-flex align-items-start p-4 bg-light rounded">
                        <div class="symbol symbol-35px symbol-circle me-4 flex-shrink-0">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">2</span>
                        </div>
                        <div>
                            <div class="fw-bold text-gray-800 fs-6 mb-1">Cara Mengatur Izin & Relasi Hirarki Otomatis</div>
                            <div class="text-gray-700 fs-7">
                                Centang kotak aksi pada kolom <em>CREATE</em>, <em>READ</em>, <em>UPDATE</em>, <em>DELETE</em>, atau kotak <em>SEMUA</em> per baris modul. Jika ada izin pada anak/sub-menu yang dicentang, menu induk secara otomatis akan tercentang. Sebaliknya jika seluruh anak menu dikosongkan, menu induk otomatis dibatalkan. Anda juga dapat menggunakan tombol <strong>"Pilih Semua"</strong> atau <strong>"Kosongkan"</strong> di atas tabel.
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Simpan Peran Ini -->
                    <div class="d-flex align-items-start p-4 bg-light rounded">
                        <div class="symbol symbol-35px symbol-circle me-4 flex-shrink-0">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">3</span>
                        </div>
                        <div>
                            <div class="fw-bold text-gray-800 fs-6 mb-1">Cara Menyimpan Hak Akses Peran</div>
                            <div class="text-gray-700 fs-7">
                                Klik tombol biru <strong>"Simpan Peran Ini"</strong> di sudut kanan atas kartu setelah selesai mengatur izin. Perubahan hak akses akan langsung disimpan ke sistem secara realtime tanpa memuat ulang halaman (*Zero-Reload*).
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Cari Modul Cepat -->
                    <div class="d-flex align-items-start p-4 bg-light rounded">
                        <div class="symbol symbol-35px symbol-circle me-4 flex-shrink-0">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">4</span>
                        </div>
                        <div>
                            <div class="fw-bold text-gray-800 fs-6 mb-1">Cara Mencari Modul Tertentu</div>
                            <div class="text-gray-700 fs-7">
                                Ketikkan nama modul atau menu pada kotak pencarian <strong>"Cari Modul..."</strong> di atas tabel matriks. Daftar baris modul akan tersaring secara otomatis dan instan saat Anda mengetik.
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
<!--end::Modal Petunjuk Operasional Akses Role-->
