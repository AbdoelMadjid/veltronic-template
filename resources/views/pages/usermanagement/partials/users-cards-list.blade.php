@forelse ($users as $u)
    @php
        $initial = $u->initial;

        // Ambil setting background cover & styling dari database (Profil Pengguna)
        $coverBgUrl = $u->cover_bg_url ?: asset('assets/img-temp/1200x800/img1.jpg');
        $coverOpacity = (int) ($u->setting('cover_opacity', '60') ?? '60');
        $coverOverlayColor = $u->setting('cover_overlay_color', '#000000') ?? '#000000';
        $coverPositionY = (int) ($u->setting('cover_position_y', '30') ?? '30');
        $coverBlur = (int) ($u->setting('cover_blur', '0') ?? '0');
    @endphp
    <!--begin::Col-->
    <div class="col-md-6 col-xxl-4 user-card-item" id="user_card_{{ $u->id }}">
        <!--begin::Card-->
        <div class="card card-flush shadow-sm h-100 hover-elevate-up border-0 overflow-hidden">
            <!--begin::Card header / Cover-->
            <div class="card-header border-0 min-h-100px p-6 rounded-top position-relative overflow-hidden">
                <!-- Cover Background Image from Database -->
                <div class="w-100 h-100 position-absolute top-0 start-0" style="
                    background-image: url('{{ $coverBgUrl }}');
                    background-size: cover;
                    background-position: center {{ $coverPositionY }}%;
                    background-repeat: no-repeat;
                    filter: blur({{ $coverBlur }}px);
                    -webkit-filter: blur({{ $coverBlur }}px);
                    transform: scale({{ $coverBlur > 0 ? 1.05 : 1 }});
                "></div>

                <!-- Adjustable Overlay Layer (Penutup Kontras) from Database -->
                <div class="w-100 h-100 position-absolute top-0 start-0" style="
                    background-color: {{ $coverOverlayColor }};
                    opacity: {{ $coverOpacity / 100 }};
                "></div>

                <!--begin::Card title (Badges)-->
                <div class="card-title m-0 position-relative z-index-1">
                    <div class="d-flex flex-wrap gap-1">
                        @forelse ($u->roles as $r)
                            @php
                                $badgeClass = match (strtolower($r->name)) {
                                    'master' => 'bg-danger text-white',
                                    'admin' => 'bg-primary text-white',
                                    default => 'bg-white bg-opacity-90 text-gray-800',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} fw-bold px-2 py-1 text-uppercase fs-8 shadow-xs">
                                {{ $r->name }}
                            </span>
                        @empty
                            <span class="badge bg-white bg-opacity-90 text-gray-800 fw-bold px-2 py-1 fs-8 shadow-xs">
                                USER
                            </span>
                        @endforelse
                    </div>
                </div>
                <!--end::Card title-->

                <!--begin::Card toolbar (Actions dropdown)-->
                <div class="card-toolbar m-0 position-relative z-index-1">
                    <button type="button" class="btn btn-sm btn-icon btn-color-white bg-black bg-opacity-25 bg-hover-opacity-50 text-hover-white shadow-xs" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-dots-vertical fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-175px py-3" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3 btn-view-user" data-id="{{ $u->id }}">
                                <i class="ki-duotone ki-eye fs-5 me-2 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                Lihat Detail
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3 btn-edit-user" data-id="{{ $u->id }}">
                                <i class="ki-duotone ki-pencil fs-5 me-2 text-warning"><span class="path1"></span><span class="path2"></span></i>
                                Edit Pengguna
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3 btn-reset-password" data-id="{{ $u->id }}" data-name="{{ $u->name }}">
                                <i class="ki-duotone ki-key fs-5 me-2 text-info"><span class="path1"></span><span class="path2"></span></i>
                                Reset Password
                            </a>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3 text-danger btn-delete-user" data-id="{{ $u->id }}" data-name="{{ $u->name }}">
                                <i class="ki-duotone ki-trash fs-5 me-2 text-danger"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                Hapus Pengguna
                            </a>
                        </div>
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body d-flex flex-center flex-column pt-0 p-8">
                <!--begin::Avatar-->
                <div class="symbol symbol-80px mb-3 mt-n12">
                    @if ($u->avatar)
                        <div class="symbol-label shadow-sm border border-4 border-body rounded-3"
                            style="{{ user_avatar_style($u) }}">
                        </div>
                    @else
                        <div class="symbol-label fs-1 fw-bold bg-light-primary text-primary shadow-sm border border-4 border-body rounded-3">
                            {{ $initial }}
                        </div>
                    @endif
                </div>
                <!--end::Avatar-->

                <!--begin::Name-->
                <a href="javascript:void(0)" class="fs-5 text-gray-900 text-hover-primary fw-bolder mb-1 text-center btn-view-user" data-id="{{ $u->id }}">
                    {{ $u->name }}
                </a>
                <!--end::Name-->

                <!--begin::Email-->
                <div class="fw-semibold text-muted fs-7 mb-4 text-center text-truncate max-w-200px">
                    {{ $u->email }}
                </div>
                <!--end::Email-->

                <!--begin::Info grid-->
                <div class="d-flex flex-center flex-wrap w-100 mb-2 gap-2">
                    <div class="border border-gray-200 border-dashed rounded min-w-90px py-2 px-3 text-center flex-grow-1">
                        <div class="fs-7 fw-bolder text-gray-800">
                            {{ $u->created_at ? $u->created_at->format('d M Y') : '-' }}
                        </div>
                        <div class="fw-semibold text-muted fs-9">Terdaftar</div>
                    </div>
                    <div class="border border-gray-200 border-dashed rounded min-w-90px py-2 px-3 text-center flex-grow-1">
                        <div class="fs-7 fw-bolder {{ $u->email_verified_at ? 'text-success' : 'text-warning' }}">
                            {{ $u->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}
                        </div>
                        <div class="fw-semibold text-muted fs-9">Status Email</div>
                    </div>
                </div>
                <!--end::Info grid-->
            </div>
            <!--end::Card body-->

            <!--begin::Card footer-->
            <div class="card-footer py-4 px-8 border-top d-flex align-items-center justify-content-between">
                <button type="button" class="btn btn-sm btn-light btn-active-light-primary fw-bold w-100 me-2 btn-view-user"
                    data-id="{{ $u->id }}">
                    Rincian
                </button>
                <button type="button" class="btn btn-sm btn-light-primary fw-bold w-100 btn-edit-user"
                    data-id="{{ $u->id }}">
                    Ubah
                </button>
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Col-->
@empty
    <div class="col-12 text-center py-12">
        <div class="text-gray-400 fs-1 mb-2">
            <i class="ki-duotone ki-profile-user fs-4x text-gray-400"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
        </div>
        <h4 class="fw-bolder text-gray-800 mb-1">Tidak Ada Pengguna Ditemukan</h4>
        <p class="text-muted fs-7">Coba sesuaikan kata kunci pencarian atau filter peran di sebelah kiri.</p>
    </div>
@endforelse
