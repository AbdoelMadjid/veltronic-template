@forelse ($presenceUsers as $item)
    @php
        $isOnline = ($item['status'] === 'online');
        $isIdle = ($item['status'] === 'idle');
        $statusColor = $isOnline ? 'success' : ($isIdle ? 'warning' : 'secondary');
        $statusText = $item['label'];
        $lastSeen = $item['last_seen_human'];
        $initial = $item['initial'] ?? strtoupper(substr($item['name'] ?? 'U', 0, 1));
        $avatarStyle = $item['avatar_style'] ?? '';
    @endphp
    <!--begin::User Item-->
    <div class="d-flex align-items-center justify-content-between p-3 rounded-3 hover-elevate-up bg-hover-light-primary transition-all border border-gray-100 border-dashed mb-3" id="presence_user_row_{{ $item['id'] }}">
        <!--begin::User Info & Avatar-->
        <div class="d-flex align-items-center me-3 flex-grow-1 min-w-0 cursor-pointer btn-view-public-profile" data-user-id="{{ $item['id'] }}" title="Lihat Profil {{ $item['name'] }}">
            <!--begin::Avatar with Presence Dot-->
            <div class="position-relative me-3 flex-shrink-0">
                <div class="symbol symbol-45px symbol-circle">
                    @if (!empty($item['avatar']))
                        <div class="symbol-label shadow-xs border border-2 border-body rounded-circle"
                            style="{{ $avatarStyle ?: "background-image: url('{$item['avatar_url']}'); background-size: cover; background-position: center;" }}">
                        </div>
                    @else
                        <div class="symbol-label fs-5 fw-bold bg-light-primary text-primary shadow-xs border border-2 border-body rounded-circle">
                            {{ $initial }}
                        </div>
                    @endif
                </div>

                <!--begin::Presence Indicator Dot-->
                <span class="position-absolute bottom-0 end-0 w-12px h-12px rounded-circle bg-{{ $statusColor }} border border-2 border-body {{ $isOnline ? 'pulse pulse-success' : '' }}"
                      data-bs-toggle="tooltip" 
                      data-bs-trigger="hover" 
                      data-bs-placement="top" 
                      title="Status: {{ $statusText }} ({{ $lastSeen }})"
                      style="transform: translate(15%, -15%);">
                    @if ($isOnline)
                        <span class="pulse-ring border-2"></span>
                    @endif
                </span>
                <!--end::Presence Indicator Dot-->
            </div>
            <!--end::Avatar with Presence Dot-->

            <!--begin::Details-->
            <div class="d-flex flex-column min-w-0 flex-grow-1 pe-2">
                <a href="javascript:void(0)" class="text-gray-900 text-hover-primary fs-6 fw-bold text-truncate mb-0 lh-sm btn-view-public-profile" data-user-id="{{ $item['id'] }}" title="{{ $item['name'] }}">
                    {{ $item['name'] }}
                </a>
                <div class="d-flex align-items-center gap-1 mt-1">
                    <span class="badge {{ $item['role_badge_class'] ?? 'badge-light-primary text-primary' }} fs-9 fw-bolder py-0 px-2 rounded-pill">
                        {{ $item['role'] }}
                    </span>
                    <span class="text-muted fs-8 text-truncate">
                        • {{ $lastSeen }}
                    </span>
                </div>
            </div>
            <!--end::Details-->
        </div>
        <!--end::User Info & Avatar-->

        <!--begin::Social Action Button (Friend Request / Sosmed Ready)-->
        <div class="flex-shrink-0">
            <button type="button" 
                    class="btn btn-sm btn-icon btn-light-primary btn-active-primary w-32px h-32px rounded-circle shadow-xs btn-social-friend-request" 
                    data-user-id="{{ $item['id'] }}"
                    data-user-name="{{ $item['name'] }}"
                    data-bs-toggle="tooltip" 
                    data-bs-trigger="hover" 
                    data-bs-placement="left" 
                    title="Tambah Teman">
                <span class="indicator-label">
                    <i class="ki-duotone ki-user-tick fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                </span>
                <span class="indicator-progress">
                    <span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
            </button>
        </div>
        <!--end::Social Action Button-->
    </div>
    <!--end::User Item-->
@empty
    <div class="text-center py-8 px-4">
        <div class="symbol symbol-50px symbol-circle bg-light-primary mb-3">
            <i class="ki-duotone ki-people fs-2x text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
        </div>
        <div class="fw-bold text-gray-800 fs-7 mb-1">Belum Ada Pengguna Lain</div>
        <p class="text-muted fs-8 mb-0">Pengguna lain yang sedang aktif akan muncul otomatis di sini.</p>
    </div>
@endforelse
