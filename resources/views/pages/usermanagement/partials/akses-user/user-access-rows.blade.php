@forelse($users as $user)
    <tr id="user-access-row-{{ $user->id }}">
        <td class="d-flex align-items-center">
            <div class="symbol symbol-50px me-3">
                @if(!empty($user->avatar))
                    <div class="image-input-wrapper w-50px h-50px rounded-3" style="{{ user_avatar_style($user) }}"></div>
                @else
                    <div class="symbol-label fs-3 bg-light-primary text-primary fw-bold rounded-3">
                        {{ $user->initial }}
                    </div>
                @endif
            </div>
            <div class="d-flex flex-column">
                <span class="text-gray-800 fw-bold fs-6 mb-1">{{ $user->name }}</span>
                <span class="text-muted fs-7">{{ $user->email ?? $user->username }}</span>
            </div>
        </td>
        <td>
            <div class="d-flex flex-wrap gap-1" id="user-roles-container-{{ $user->id }}">
                @forelse($user->roles as $role)
                    @php
                        $badgeClass = match($role->name) {
                            'master' => 'badge-light-danger',
                            'admin' => 'badge-light-primary',
                            default => 'badge-light-info'
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }} fw-bold">{{ $role->display_name ?? ucwords(str_replace(['_', '-'], ' ', $role->name)) }}</span>
                @empty
                    <span class="badge badge-light-secondary text-muted">Tanpa Peran</span>
                @endforelse
            </div>
        </td>
        <td>
            @php
                $directCount = $user->permissions->count();
            @endphp
            <div id="user-direct-perm-container-{{ $user->id }}">
                @if($directCount > 0)
                    <span class="badge badge-light-warning fw-bold">
                        {{ $directCount }} Izin Khusus
                    </span>
                @else
                    <span class="badge badge-light-secondary text-muted">Bawaan Peran</span>
                @endif
            </div>
        </td>
        <td>
            @if($user->is_active ?? true)
                <span class="badge badge-light-success fw-bold">Aktif</span>
            @else
                <span class="badge badge-light-danger fw-bold">Nonaktif</span>
            @endif
        </td>
        <td class="text-end pe-4">
            <div class="d-flex justify-content-end flex-shrink-0 gap-2">
                <button type="button" class="btn btn-icon btn-light-primary btn-sm btn-action-assign-role" 
                        data-user-id="{{ $user->id }}" 
                        data-user-name="{{ $user->name }}" 
                        data-user-roles="{{ json_encode($user->roles->pluck('name')->toArray()) }}"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ubah Peran Pengguna">
                    <i class="ki-outline ki-profile-user fs-4"></i>
                </button>
                <button type="button" class="btn btn-icon btn-light-warning btn-sm btn-action-direct-perm" 
                        data-user-id="{{ $user->id }}" 
                        data-user-name="{{ $user->name }}"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Atur Izin Khusus (Direct Permissions)">
                    <i class="ki-outline ki-shield-search fs-4"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center text-muted py-10">
            Tidak ada data pengguna yang ditemukan.
        </td>
    </tr>
@endforelse
