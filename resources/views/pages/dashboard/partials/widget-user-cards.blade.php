@php
    $currentAuthUser = auth()->user();

    // Ambil seluruh pertemanan pengguna yang berstatus 'accepted' untuk prioritas utama
    $friendUserIds = collect();
    if ($currentAuthUser) {
        $friendships = \App\Models\UserManagement\UserFriendship::where(function($q) use ($currentAuthUser) {
                $q->where('user_id', $currentAuthUser->id)
                  ->orWhere('friend_id', $currentAuthUser->id);
            })
            ->where('status', 'accepted')
            ->get();

        $friendUserIds = $friendships->map(function($f) use ($currentAuthUser) {
            return $f->user_id == $currentAuthUser->id ? $f->friend_id : $f->user_id;
        })->flip();
    }

    // Koleksi Moto Hidup / Kutipan Inspiratif & Profesional (fallback acak deterministik seperti foto background)
    $defaultMotos = [
        'Terus belajar, berkembang, dan memberikan kontribusi terbaik.',
        'Disiplin dan konsistensi adalah jembatan menuju pencapaian nyata.',
        'Bekerja dengan integritas tinggi dan berinovasi tanpa batas.',
        'Fokus pada proses berkualitas, hasil terbaik akan mengikuti.',
        'Kolaborasi yang solid melahirkan karya yang berdampak luas.',
        'Jadikan setiap tantangan sebagai batu loncatan untuk bertumbuh.',
        'Kualitas prima bukan kebetulan, melainkan hasil komitmen.',
        'Berpikir kritis, bertindak solutif, dan memberi nilai tambah.',
        'Kesuksesan berawal dari tekad yang kuat dan kerja terarah.',
        'Membangun masa depan melalui dedikasi dan profesionalisme.',
        'Berani memulai hal baru, tekun menjalani, dan tuntas menyelesaikan.',
        'Kreativitas dan kerja sama tim adalah kunci kemajuan bersama.',
        'Selalu rendah hati dan antusias belajar dari setiap pengalaman.',
        'Menghadirkan dampak positif dalam setiap langkah karya nyata.',
        'Pantang menyerah dalam memberikan hasil kerja yang optimal.',
        'Mengubah visi dan ide kreatif menjadi solusi yang bermanfaat.',
    ];

    // Ambil seluruh pengguna komunitas dan urutkan berdasarkan Pertemanan, Kelengkapan Data & Keaktifan riil
    $communityUsers = \App\Models\UserManagement\User::with(['detail', 'settingRecord', 'roles'])
        ->when($currentAuthUser, function($q) use ($currentAuthUser) {
            $q->where('id', '!=', $currentAuthUser->id);
        })
        ->get()
        ->sortByDesc(function ($u) use ($friendUserIds) {
            $isFriend = isset($friendUserIds[$u->id]) ? 1 : 0;
            $hasLogin = !empty($u->last_login_at) ? 1 : 0;
            $hasCustomAvatar = !empty($u->avatar) ? 1 : 0;
            $hasCustomCover = !empty($u->setting('cover_background')) ? 1 : 0;
            $hasCustomMoto = (!empty($u->detail?->moto_hidup) || !empty($u->detail?->bio)) ? 1 : 0;
            $hasPhone = !empty($u->detail?->no_hp) ? 1 : 0;
            $hasAddress = !empty($u->detail?->alamat) ? 1 : 0;
            $loginTimestamp = $u->last_login_at ? $u->last_login_at->timestamp : 0;
            $points = (int) ($u->points ?? 0);

            // Bobot Sorting:
            // 1. Sudah Berteman (Prioritas Teratas): 20.000.000
            // 2. Sudah Pernah Login: 10.000.000
            // 3. Sudah Ganti Avatar: 5.000.000
            // 4. Sudah Ganti Foto Background: 3.000.000
            // 5. Sudah Isi Moto Hidup / Bio: 1.000.000
            // 6. Sudah Isi Kontak / Alamat: 500.000
            // 7. Poin Keaktifan & Kebaruan Login
            return ($isFriend * 20000000)
                 + ($hasLogin * 10000000)
                 + ($hasCustomAvatar * 5000000)
                 + ($hasCustomCover * 3000000)
                 + ($hasCustomMoto * 1000000)
                 + ($hasPhone * 250000)
                 + ($hasAddress * 250000)
                 + ($points * 1000)
                 + ($loginTimestamp % 1000000);
        })
        ->values();

    $totalUsers = $communityUsers->count();
    $pageSize = 4;
@endphp

<!--begin::Community User Cards Section-->
<div class="mb-10" id="dashboard_user_cards_section">
    <!--begin::Header Section-->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-4 mb-6">
        <!-- Title & Icon -->
        <div class="d-flex align-items-center gap-3">
            <div class="symbol symbol-40px symbol-circle bg-light-primary d-flex align-items-center justify-content-center">
                <i class="ki-duotone ki-profile-user fs-2 text-primary">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
            </div>
            <div>
                <h3 class="fw-bolder text-gray-900 fs-3 mb-0">Rekan Komunitas &amp; Pengguna</h3>
                <span class="text-muted fw-semibold fs-7">Terhubung dan mulai obrolan bersama rekan tim</span>
            </div>
        </div>

        <!-- Toolbar: Search Input + Batch Navigation Controls -->
        <div class="d-flex align-items-center flex-wrap gap-3 ms-auto">
            <!--begin::Search Input Bar-->
            <div class="d-flex align-items-center position-relative w-100 w-sm-200px w-md-250px">
                <i class="ki-duotone ki-magnifier fs-4 text-gray-500 position-absolute start-0 ms-3">
                    <span class="path1"></span><span class="path2"></span>
                </i>
                <input type="text" class="form-control form-control-sm form-control-solid bg-body ps-9 pe-8 fs-7 border border-gray-200" id="input_search_user_cards" placeholder="Cari nama atau jabatan..." autocomplete="off" />
                <button type="button" class="btn btn-sm btn-icon btn-active-light-danger position-absolute end-0 me-1 d-none w-20px h-20px" id="btn_clear_user_cards_search" title="Hapus Pencarian">
                    <i class="ki-duotone ki-cross fs-6"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>
            <!--end::Search Input Bar-->

            <!--begin::Navigation Controls & Status-->
            <div class="d-flex align-items-center gap-2">
                <!-- Counter Badge -->
                <span class="badge badge-light-primary fw-bold fs-8 px-3 py-2 text-nowrap" id="user_cards_batch_counter">
                    1 - {{ min($pageSize, $totalUsers) }} dari {{ $totalUsers }} Rekan
                </span>

                <!-- Tombol Navigasi Batch Sebelumnya -->
                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary w-32px h-32px" id="btn_prev_user_cards" title="Pengguna Sebelumnya" disabled>
                    <i class="ki-duotone ki-left fs-4"></i>
                </button>

                <!-- Tombol Navigasi Batch Berikutnya -->
                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary w-32px h-32px" id="btn_next_user_cards" title="Pengguna Berikutnya" {{ $totalUsers <= $pageSize ? 'disabled' : '' }}>
                    <i class="ki-duotone ki-right fs-4"></i>
                </button>
            </div>
            <!--end::Navigation Controls & Status-->
        </div>
    </div>
    <!--end::Header Section-->

    <!--begin::Row Cards Container-->
    <div class="row g-6" id="community_user_cards_grid">
        @forelse($communityUsers as $index => $u)
            @php
                $isFriend = isset($friendUserIds[$u->id]);
                $uCoverBg = $u->cover_bg_url ?: \App\Support\ThemeAsset::url('media/stock/600x400/img-'.(($index % 10) + 1).'.jpg', $theme_asset_pack ?? null);
                $uCoverPos = (int) ($u->setting('cover_position_y', '30') ?? '30');
                $uRoleName = $u->roles->first()?->name ?? 'Member';

                // Ambil Moto Hidup riil pengguna jika ada, atau buatkan moto inspiratif random deterministik
                $customMoto = trim($u->detail?->moto_hidup ?: ($u->detail?->bio ?: ''));
                if (!empty($customMoto)) {
                    $uMoto = $customMoto;
                } else {
                    $motoSeed = abs(((int) ($u->id ?? ($index + 1)) - 1)) % count($defaultMotos);
                    $uMoto = $defaultMotos[$motoSeed];
                }

                $uPresence = \App\Services\UserManagement\UserPresenceService::getUserPresence($u);
                $uIsOnline = ($uPresence['status'] ?? 'offline') === 'online';
                $uPoints = (int) ($u->points ?? 0);
                $isHidden = $index >= $pageSize;
                $searchContent = strtolower($u->name . ' ' . $uRoleName . ' ' . $uMoto . ' ' . $u->email . ($isFriend ? ' teman' : ''));
            @endphp
            <!--begin::Col-->
            <div class="col-md-6 community-user-card-col {{ $isHidden ? 'd-none' : '' }}" data-card-index="{{ $index }}" data-search-term="{{ $searchContent }}">
                <!--begin::Card-->
                <div class="card shadow-sm border border-gray-200 h-100 d-flex flex-column hover-elevate-up transition-all overflow-hidden">
                    <!--begin::Cover Header-->
                    <div class="position-relative w-100" style="height: 110px; background-image: url('{{ $uCoverBg }}'); background-size: cover; background-position: center {{ $uCoverPos }}%;">
                        <!-- Overlay gradient agar teks/badge kontras -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25"></div>
                        <!-- Status Badge di Pojok Cover -->
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge {{ $uIsOnline ? 'badge-success' : 'badge-light-dark' }} bg-opacity-90 fw-bold fs-9 px-2 py-1 shadow-xs">
                                {{ $uIsOnline ? 'Online' : 'Offline' }}
                            </span>
                        </div>
                    </div>
                    <!--end::Cover Header-->

                    <!--begin::Card Body-->
                    <div class="card-body pt-0 px-6 pb-6 d-flex flex-column flex-grow-1 text-center position-relative">
                        <!--begin::Floating Avatar-->
                        <div class="symbol symbol-70px symbol-circle mt-n10 mb-3 mx-auto position-relative border border-3 border-body shadow-sm">
                            <div class="symbol-label" style="{{ user_avatar_style($u) }}"></div>
                            @if($uIsOnline)
                                <div class="symbol-badge bg-success start-100 top-100 border-4 h-12px w-12px ms-n3 mt-n3" title="Online"></div>
                            @endif
                        </div>
                        <!--end::Floating Avatar-->

                        <!--begin::Name & Role-->
                        <div class="mb-3">
                            <a href="javascript:void(0)" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-1 d-inline-block text-truncate mw-100 btn-view-public-profile btn-open-public-profile" data-user-id="{{ $u->id }}">
                                {{ $u->name }}
                            </a>
                            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                                @if($isFriend)
                                    <span class="badge badge-light-success fw-bold fs-8 d-flex align-items-center gap-1">
                                        <i class="ki-duotone ki-verify fs-8 text-success"><span class="path1"></span><span class="path2"></span></i>
                                        Teman
                                    </span>
                                @endif
                                <span class="badge badge-light-warning fw-semibold fs-8 d-flex align-items-center gap-1">
                                    <i class="ki-duotone ki-medal-star fs-8 text-warning"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    {{ number_format($uPoints, 0, ',', '.') }} pts
                                </span>
                            </div>
                        </div>
                        <!--end::Name & Role-->

                        <!--begin::Moto / Bio-->
                        <p class="text-muted fs-7 mb-4 flex-grow-1 text-truncate-2" style="min-height: 38px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" title="{{ $uMoto }}">
                            &ldquo;{{ $uMoto }}&rdquo;
                        </p>
                        <!--end::Moto / Bio-->

                        <!--begin::Card Footer Actions-->
                        <div class="d-flex align-items-center justify-content-center gap-2 pt-3 border-top border-gray-100 mt-auto">
                            <!-- Tombol Chat Realtime -->
                            <a href="{{ url('/profil/profil-pengguna/chat?user=' . $u->id) }}" class="btn btn-sm btn-primary fw-bold d-flex align-items-center justify-content-center gap-2 flex-grow-1">
                                <i class="ki-duotone ki-messages fs-5 text-white">
                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                </i>
                                <span>Kirim Pesan</span>
                            </a>

                            <!-- Tombol Detail Profil Publik Modal -->
                            <button type="button" class="btn btn-sm btn-light btn-active-light-primary fw-bold d-flex align-items-center justify-content-center gap-1 px-3 btn-view-public-profile btn-open-public-profile" data-user-id="{{ $u->id }}" title="Lihat Profil">
                                <i class="ki-duotone ki-user fs-5 text-gray-600">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                                <span class="d-none d-sm-inline">Profil</span>
                            </button>
                        </div>
                        <!--end::Card Footer Actions-->
                    </div>
                    <!--end::Card Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @empty
            <div class="col-12 text-center py-10 text-muted fs-7">
                Belum ada pengguna lainnya yang terdaftar di sistem.
            </div>
        @endforelse

        <!--begin::Search Empty State-->
        <div class="col-12 text-center py-12 d-none" id="user_cards_search_empty">
            <div class="symbol symbol-60px symbol-circle bg-light-warning mb-4 d-flex align-items-center justify-content-center mx-auto shadow-xs">
                <i class="ki-duotone ki-magnifier fs-2tx text-warning">
                    <span class="path1"></span><span class="path2"></span>
                </i>
            </div>
            <h4 class="fs-5 text-gray-800 fw-bold mb-1">Pengguna Tidak Ditemukan</h4>
            <p class="fs-7 text-muted mb-4">Tidak ada rekan yang cocok dengan kata kunci "<span id="user_cards_empty_query" class="fw-bold text-gray-900"></span>"</p>
            <button type="button" class="btn btn-sm btn-light-primary fw-bold" id="btn_reset_empty_search">
                <i class="ki-duotone ki-arrows-circle fs-5 me-1"></i> Reset Pencarian
            </button>
        </div>
        <!--end::Search Empty State-->
    </div>
    <!--end::Row Cards Container-->

    @if($totalUsers > $pageSize)
        <!--begin::Footer Action Bar-->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-6 pt-4 border-top border-gray-200" id="user_cards_footer_bar">
            <div class="text-muted fs-8 fw-semibold" id="user_cards_page_label">
                Halaman <span class="fw-bold text-gray-900" id="user_cards_current_page">1</span> dari <span class="fw-bold text-gray-900" id="user_cards_total_pages">{{ ceil($totalUsers / $pageSize) }}</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <!-- Tombol Kembali ke Halaman 1 -->
                <button type="button" class="btn btn-sm btn-light btn-active-light-primary fw-bold d-none" id="btn_footer_reset_user_cards">
                    <i class="ki-duotone ki-arrows-circle fs-5 me-1"></i> Ke Awal
                </button>

                <!-- Tombol Lihat 4 Pengguna Berikutnya -->
                <button type="button" class="btn btn-sm btn-light-primary fw-bold d-flex align-items-center gap-2" id="btn_footer_next_user_cards">
                    <span id="btn_footer_next_label">Lihat {{ min($pageSize, $totalUsers - $pageSize) }} Pengguna Berikutnya</span>
                    <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>
        </div>
        <!--end::Footer Action Bar-->
    @endif
</div>
<!--end::Community User Cards Section-->

<!--begin::User Cards Interactive Slider & Search Script-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalUsers = {{ $totalUsers }};
        const pageSize = {{ $pageSize }};
        let currentPage = 1;
        let activeQuery = '';

        const searchInput = document.getElementById('input_search_user_cards');
        const clearSearchBtn = document.getElementById('btn_clear_user_cards_search');
        const counterEl = document.getElementById('user_cards_batch_counter');
        const pageLabelEl = document.getElementById('user_cards_current_page');
        const totalPagesEl = document.getElementById('user_cards_total_pages');
        const footerBar = document.getElementById('user_cards_footer_bar');
        const btnPrev = document.getElementById('btn_prev_user_cards');
        const btnNext = document.getElementById('btn_next_user_cards');
        const btnFooterNext = document.getElementById('btn_footer_next_user_cards');
        const btnFooterNextLabel = document.getElementById('btn_footer_next_label');
        const btnFooterReset = document.getElementById('btn_footer_reset_user_cards');
        const searchEmptyEl = document.getElementById('user_cards_search_empty');
        const emptyQueryEl = document.getElementById('user_cards_empty_query');
        const btnResetEmpty = document.getElementById('btn_reset_empty_search');
        const allCardCols = Array.from(document.querySelectorAll('.community-user-card-col'));

        function getFilteredCards() {
            if (!activeQuery) return allCardCols;
            const q = activeQuery.toLowerCase().trim();
            return allCardCols.filter(col => {
                const term = col.getAttribute('data-search-term') || '';
                return term.includes(q);
            });
        }

        function updateBatchView(page = 1) {
            const filtered = getFilteredCards();
            const filteredTotal = filtered.length;
            const totalPages = Math.max(1, Math.ceil(filteredTotal / pageSize));

            currentPage = Math.max(1, Math.min(page, totalPages));
            const startIdx = (currentPage - 1) * pageSize;
            const endIdx = startIdx + pageSize;

            // Sembunyikan semua kartu terlebih dahulu
            allCardCols.forEach(col => col.classList.add('d-none'));

            if (filteredTotal === 0) {
                // Tampilkan Empty State
                if (searchEmptyEl) {
                    searchEmptyEl.classList.remove('d-none');
                    if (emptyQueryEl) emptyQueryEl.textContent = activeQuery;
                }
                if (counterEl) counterEl.textContent = '0 Rekan Ditemukan';
                if (footerBar) footerBar.classList.add('d-none');
                if (btnPrev) btnPrev.disabled = true;
                if (btnNext) btnNext.disabled = true;
                return;
            }

            if (searchEmptyEl) searchEmptyEl.classList.add('d-none');
            if (footerBar) footerBar.classList.remove('d-none');

            // Tampilkan kartu yang ada dalam slice batch halaman aktif
            filtered.forEach((col, idx) => {
                if (idx >= startIdx && idx < endIdx) {
                    col.classList.remove('d-none');
                }
            });

            // Update Counter Text
            const displayedStart = startIdx + 1;
            const displayedEnd = Math.min(endIdx, filteredTotal);
            if (counterEl) {
                if (activeQuery) {
                    counterEl.textContent = `Ditemukan ${displayedStart}-${displayedEnd} dari ${filteredTotal} Rekan`;
                } else {
                    counterEl.textContent = `${displayedStart} - ${displayedEnd} dari ${totalUsers} Rekan`;
                }
            }

            if (pageLabelEl) pageLabelEl.textContent = currentPage;
            if (totalPagesEl) totalPagesEl.textContent = totalPages;

            // Update Header Buttons Disabled State
            if (btnPrev) btnPrev.disabled = (currentPage === 1);
            if (btnNext) btnNext.disabled = (currentPage === totalPages);

            // Update Footer Buttons State
            if (btnFooterReset) {
                if (currentPage > 1) {
                    btnFooterReset.classList.remove('d-none');
                } else {
                    btnFooterReset.classList.add('d-none');
                }
            }

            if (btnFooterNext) {
                if (currentPage < totalPages) {
                    const remaining = filteredTotal - (currentPage * pageSize);
                    const nextBatchCount = Math.min(pageSize, remaining);
                    if (btnFooterNextLabel) btnFooterNextLabel.textContent = `Lihat ${nextBatchCount} Pengguna Berikutnya`;
                    btnFooterNext.disabled = false;
                    btnFooterNext.classList.remove('d-none');
                } else {
                    if (btnFooterNextLabel) btnFooterNextLabel.textContent = `Sudah di Halaman Terakhir`;
                    btnFooterNext.disabled = true;
                }
            }
        }

        // Live Search Input Listener
        if (searchInput) {
            let searchTimeout = null;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    activeQuery = searchInput.value.trim();
                    if (clearSearchBtn) {
                        if (activeQuery) {
                            clearSearchBtn.classList.remove('d-none');
                        } else {
                            clearSearchBtn.classList.add('d-none');
                        }
                    }
                    updateBatchView(1);
                }, 150);
            });
        }

        // Clear Search Button
        function clearSearch() {
            if (searchInput) searchInput.value = '';
            activeQuery = '';
            if (clearSearchBtn) clearSearchBtn.classList.add('d-none');
            updateBatchView(1);
            if (searchInput) searchInput.focus();
        }

        if (clearSearchBtn) clearSearchBtn.addEventListener('click', clearSearch);
        if (btnResetEmpty) btnResetEmpty.addEventListener('click', clearSearch);

        // Header Navigation Buttons
        if (btnPrev) {
            btnPrev.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentPage > 1) updateBatchView(currentPage - 1);
            });
        }

        if (btnNext) {
            btnNext.addEventListener('click', function(e) {
                e.preventDefault();
                updateBatchView(currentPage + 1);
            });
        }

        // Footer Navigation Buttons
        if (btnFooterNext) {
            btnFooterNext.addEventListener('click', function(e) {
                e.preventDefault();
                updateBatchView(currentPage + 1);
            });
        }

        if (btnFooterReset) {
            btnFooterReset.addEventListener('click', function(e) {
                e.preventDefault();
                updateBatchView(1);
            });
        }

        // Direct Profile Modal Trigger (Fallback Listener)
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-open-public-profile, .btn-view-public-profile');
            if (!btn) return;
            e.preventDefault();
            const targetId = btn.getAttribute('data-user-id');
            if (targetId && window.KTUserPresence && typeof window.KTUserPresence.openPublicProfile === 'function') {
                window.KTUserPresence.openPublicProfile(targetId);
            }
        });

        // Realtime Live Sync for User Cards Grid
        window.KTCommunityUserCardsSync = function(newHtml) {
            if (!newHtml) return;
            try {
                const parser = new DOMParser();
                const doc = parser.parseFromString(newHtml, 'text/html');
                const newGrid = doc.getElementById('community_user_cards_grid');
                const curGrid = document.getElementById('community_user_cards_grid');
                if (!newGrid || !curGrid) return;

                const newContent = newGrid.innerHTML.trim();
                if (curGrid.getAttribute('data-grid-hash') === newContent) return;

                curGrid.innerHTML = newContent;
                curGrid.setAttribute('data-grid-hash', newContent);
                allCardCols = Array.from(document.querySelectorAll('.community-user-card-col'));
                updateBatchView(currentPage);
            } catch (err) {
                console.error('Failed to sync user cards:', err);
            }
        };
    });
</script>
<!--end::User Cards Interactive Slider & Search Script-->

<!--begin::Public User Profile Modal-->
@include('pages.dashboard.partials.modal-public-profile')
<!--end::Public User Profile Modal-->
