<!--begin::Tab Pane Education Pages Catalog-->
<div class="card shadow-sm mb-6">
    <!--begin::Card header-->
    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 py-5 py-md-0">
        <div class="d-flex flex-column align-items-center align-items-md-start text-center text-md-start w-100 w-md-auto">
            <h3 class="fw-bolder text-gray-900 m-0 fs-4">Katalog Halaman & Modul Portal Akademik</h3>
            <span class="text-muted fs-7 mt-1">Direktori 13 halaman rute multi-page Unify Education yang aktif dalam sistem</span>
        </div>
        <div class="card-toolbar d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-center justify-content-md-end gap-2 w-100 w-md-auto mt-2 mt-md-0">
            <div class="d-flex align-items-center position-relative w-100 w-md-250px">
                <i class="ki-outline ki-magnifier fs-4 position-absolute ms-3 text-gray-500"></i>
                <input type="text" id="kt_edu_pages_search" class="form-control form-control-solid form-control-sm w-100 ps-10 h-35px" placeholder="Cari modul halaman..." />
            </div>
            <a href="{{ url('/education') }}" target="_blank" class="btn btn-warning text-white btn-sm fw-bold h-35px d-inline-flex align-items-center justify-content-center px-3 w-100 w-md-auto" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Buka education portal di tab baru">
                <i class="ki-outline ki-exit-right-corner fs-4 me-1 text-white"></i> <span>Kunjungi Portal</span>
            </a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-6 px-4 px-md-6">
        <!--begin::Info Banner-->
        <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row p-4 mb-6 border border-warning border-opacity-25 rounded-3">
            <i class="ki-outline ki-information-5 fs-2 text-warning me-3 mb-2 mb-sm-0 flex-shrink-0"></i>
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <span class="fw-bold text-gray-800 fs-7">Struktur Routing Mandiri (Multipage Architecture)</span>
                <span class="text-gray-600 fs-8">Tema Education bekerja secara multi-halaman dengan routing terpusat di <code>routes/website.php</code>. Seluruh berkas Blade tersimpan di direktori <code>resources/views/frontpages/education/</code>.</span>
            </div>
        </div>
        <!--end::Info Banner-->

        <!--begin::Pages Grid / Table-->
        <div class="table-responsive">
            <table class="table table-row-bordered table-row-dashed align-middle gs-4 gy-4 fs-7" id="kt_table_edu_pages">
                <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-40px w-50px text-center">No</th>
                        <th class="min-w-220px">Nama Halaman & Modul</th>
                        <th class="min-w-160px">Rute / URL Akses</th>
                        <th class="min-w-100px text-center">Kategori</th>
                        <th class="min-w-250px">Deskripsi Fungsi</th>
                        <th class="pe-4 min-w-100px text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600" id="kt_edu_pages_tbody">
                    @foreach($educationPages as $index => $page)
                        <tr class="edu-page-row" data-search="{{ strtolower($page['title'] . ' ' . $page['url'] . ' ' . $page['desc']) }}">
                            <td class="ps-4 text-center fw-bold text-gray-500">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-35px symbol-circle bg-light-{{ $page['badge_color'] ?? 'primary' }} me-3 d-flex align-items-center justify-content-center flex-shrink-0">
                                        <i class="ki-outline {{ $page['icon'] ?? 'ki-document' }} text-{{ $page['badge_color'] ?? 'primary' }} fs-4"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold fs-7 mb-0">{{ $page['title'] }}</span>
                                        <span class="text-muted fs-8 font-monospace">frontpages/education/{{ $page['id'] }}.blade.php</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <code class="text-primary fs-8 px-2 py-1 bg-light-primary rounded">{{ $page['url'] }}</code>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light-{{ $page['badge_color'] ?? 'secondary' }} fw-bold fs-8 px-2 py-1">
                                    {{ $page['badge'] ?? 'Umum' }}
                                </span>
                            </td>
                            <td>
                                <span class="text-gray-700 fs-8">{{ $page['desc'] }}</span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ url($page['url']) }}" target="_blank" class="btn btn-icon btn-light-warning btn-sm"
                                   data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Buka Halaman: {{ $page['title'] }}">
                                    <i class="ki-outline ki-exit-right-corner fs-4"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Pages Grid / Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Tab Pane Education Pages Catalog-->
