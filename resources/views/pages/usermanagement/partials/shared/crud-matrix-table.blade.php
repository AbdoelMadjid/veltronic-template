@php
    $prefix = $prefixId ?? 'crud_matrix';
    $input = $inputName ?? 'permissions[]';
    $isReadonly = $readonly ?? false;
    $showInherited = $showInherited ?? false;
    $isScrollable = $scrollable ?? true;
    $maxHeight = $tableMaxHeight ?? ($isScrollable ? '450px' : 'none');
@endphp

<div class="crud-matrix-wrapper" id="{{ $prefix }}_wrapper">
    <!--begin::Matrix Toolbar-->
    <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h5 class="text-gray-900 fw-bold m-0">{{ $matrixTitle ?? 'Hak Akses / Permissions (CRUD Matrix)' }}</h5>
            <span class="text-muted fs-7">{{ $matrixSubtitle ?? 'Pilih izin fitur yang berlaku untuk akun atau peran ini' }}</span>
        </div>
        <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2 flex-shrink-0">
            <div class="position-relative flex-grow-1 flex-sm-grow-0">
                <i class="ki-outline ki-magnifier fs-4 position-absolute top-50 translate-middle-y ms-3 text-gray-500"></i>
                <input type="text" class="form-control form-control-sm form-control-solid ps-9 w-100 w-sm-175px w-md-200px matrix-search-input h-35px" 
                       data-target="#{{ $prefix }}_table" 
                       placeholder="Cari Modul..." />
            </div>
            @if(!$isReadonly)
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <button type="button" class="btn btn-sm btn-light-primary fw-bold px-3 h-35px d-inline-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0 text-nowrap btn-matrix-check-all" 
                        data-target="#{{ $prefix }}_table"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pilih Semua Izin">
                        <i class="ki-outline ki-check-square fs-5 me-1"></i>
                        <span>Pilih Semua</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-light-danger fw-bold px-3 h-35px d-inline-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0 text-nowrap btn-matrix-uncheck-all" 
                        data-target="#{{ $prefix }}_table"
                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Kosongkan Semua Izin">
                        <i class="ki-outline ki-cross-square fs-5 me-1"></i>
                        <span>Kosongkan</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <!--end::Matrix Toolbar-->

    <!--begin::Matrix Table-->
    <div class="table-responsive border rounded border-gray-200" style="{{ $isScrollable && $maxHeight !== 'none' ? 'max-height: ' . $maxHeight . '; overflow-y: auto;' : '' }}">
        <table class="table table-row-bordered table-row-dashed gy-3 gs-4 align-middle fw-semibold fs-7 mb-0 matrix-table" id="{{ $prefix }}_table">
            <thead class="{{ $isScrollable ? 'position-sticky top-0 z-index-2' : '' }} bg-body shadow-xs" style="{{ $isScrollable ? 'position: sticky; top: 0; z-index: 5;' : '' }}">
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 bg-light">
                    <th class="min-w-250px ps-4">MODUL / FITUR</th>
                    <th class="text-center min-w-80px">CREATE</th>
                    <th class="text-center min-w-80px">READ</th>
                    <th class="text-center min-w-80px">UPDATE</th>
                    <th class="text-center min-w-80px">DELETE</th>
                    <th class="text-center min-w-100px">LAINNYA</th>
                    <th class="text-center min-w-80px pe-4">SEMUA</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 fw-semibold">
                @foreach($matrixTree as $row)
                    @php
                        $level = $row['level'] ?? ($row['is_parent'] ? 1 : 2);
                        $rowId = $prefix . '_row_' . $row['id'] . '_lvl' . $level;
                        $hasAnyPerm = $row['total_permissions'] > 0;
                        $hasChildren = !empty($row['has_children']);
                        $parentId = $row['parent_id'] ?? '';
                    @endphp
                    <tr class="matrix-row {{ $level === 1 ? 'matrix-parent-row bg-light-subtle' : ($level === 2 ? 'matrix-child-row' : 'matrix-subchild-row') }}" 
                        id="{{ $rowId }}"
                        data-menu-id="{{ $row['id'] }}"
                        data-menu-level="{{ $level }}"
                        data-parent-id="{{ $parentId }}"
                        data-has-children="{{ $hasChildren ? '1' : '0' }}"
                        data-module-name="{{ strtolower($row['name']) }}"
                        data-module-url="{{ strtolower($row['url']) }}"
                        data-parent-name="{{ strtolower($row['parent_name'] ?? '') }}">
                        
                        <!-- Col: Modul / Fitur Title & Badges -->
                        <td class="ps-4">
                            @if($level === 1)
                                <div class="d-flex align-items-center py-1">
                                    <div class="symbol symbol-35px symbol-circle bg-light-primary text-primary me-3 d-flex align-items-center justify-content-center flex-shrink-0">
                                        <i class="{{ $row['icon'] }} text-primary fs-3"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <span class="text-gray-900 fw-bolder fs-6">{{ $row['name'] }}</span>
                                            <span class="badge badge-light text-gray-700 fs-8 font-monospace">{{ $row['url'] }}</span>
                                        </div>
                                        <div>
                                            <span class="badge badge-light-secondary fs-8 mt-1 text-muted">
                                                <i class="ki-outline ki-home fs-8 me-1 text-muted"></i>Menu Utama
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @elseif($level === 2)
                                <div class="d-flex align-items-center py-1 ps-6">
                                    <span class="text-gray-400 me-2 fs-6">└─</span>
                                    <div class="symbol symbol-30px symbol-rounded bg-light-info text-info me-3 d-flex align-items-center justify-content-center flex-shrink-0">
                                        <i class="ki-outline ki-element-plus text-primary fs-4"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <span class="text-gray-800 fw-bold fs-7">{{ $row['name'] }}</span>
                                            <span class="badge badge-light text-gray-700 fs-8 font-monospace">{{ $row['url'] }}</span>
                                        </div>
                                        <div>
                                            <span class="badge badge-light-primary fs-8 mt-1">
                                                <i class="ki-outline ki-arrow-down fs-8 me-1"></i>Sub: {{ $row['parent_name'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center py-1 ps-12">
                                    <span class="text-gray-400 me-2 fs-6">└─</span>
                                    <div class="symbol symbol-25px symbol-rounded bg-light-warning text-warning me-3 d-flex align-items-center justify-content-center flex-shrink-0">
                                        <i class="ki-outline ki-dots-square text-warning fs-5"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <span class="text-gray-700 fw-semibold fs-7">{{ $row['name'] }}</span>
                                            <span class="badge badge-light text-gray-700 fs-8 font-monospace">{{ $row['url'] }}</span>
                                        </div>
                                        <div>
                                            <span class="badge badge-light-warning fs-8 mt-1">
                                                <i class="ki-outline ki-arrow-down fs-8 me-1"></i>Sub: {{ $row['parent_name'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>

                        <!-- Col: CREATE -->
                        <td class="text-center">
                            @if($row['create'])
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input matrix-perm-cb row-perm-{{ $rowId }}" 
                                               type="checkbox" 
                                               name="{{ $input }}" 
                                               value="{{ $row['create']['name'] }}" 
                                               id="{{ $prefix }}_perm_{{ $row['create']['id'] }}"
                                               data-menu-id="{{ $row['id'] }}"
                                               data-parent-id="{{ $parentId }}"
                                               data-action="create"
                                               data-perm-name="{{ $row['create']['name'] }}"
                                               {{ $isReadonly ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            @else
                                <span class="text-muted fw-bold">-</span>
                            @endif
                        </td>

                        <!-- Col: READ -->
                        <td class="text-center">
                            @if($row['read'])
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input matrix-perm-cb row-perm-{{ $rowId }}" 
                                               type="checkbox" 
                                               name="{{ $input }}" 
                                               value="{{ $row['read']['name'] }}" 
                                               id="{{ $prefix }}_perm_{{ $row['read']['id'] }}"
                                               data-menu-id="{{ $row['id'] }}"
                                               data-parent-id="{{ $parentId }}"
                                               data-action="read"
                                               data-perm-name="{{ $row['read']['name'] }}"
                                               {{ $isReadonly ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            @else
                                <span class="text-muted fw-bold">-</span>
                            @endif
                        </td>

                        <!-- Col: UPDATE -->
                        <td class="text-center">
                            @if($row['update'])
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input matrix-perm-cb row-perm-{{ $rowId }}" 
                                               type="checkbox" 
                                               name="{{ $input }}" 
                                               value="{{ $row['update']['name'] }}" 
                                               id="{{ $prefix }}_perm_{{ $row['update']['id'] }}"
                                               data-menu-id="{{ $row['id'] }}"
                                               data-parent-id="{{ $parentId }}"
                                               data-action="update"
                                               data-perm-name="{{ $row['update']['name'] }}"
                                               {{ $isReadonly ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            @else
                                <span class="text-muted fw-bold">-</span>
                            @endif
                        </td>

                        <!-- Col: DELETE -->
                        <td class="text-center">
                            @if($row['delete'])
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input matrix-perm-cb row-perm-{{ $rowId }}" 
                                               type="checkbox" 
                                               name="{{ $input }}" 
                                               value="{{ $row['delete']['name'] }}" 
                                               id="{{ $prefix }}_perm_{{ $row['delete']['id'] }}"
                                               data-menu-id="{{ $row['id'] }}"
                                               data-parent-id="{{ $parentId }}"
                                               data-action="delete"
                                               data-perm-name="{{ $row['delete']['name'] }}"
                                               {{ $isReadonly ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            @else
                                <span class="text-muted fw-bold">-</span>
                            @endif
                        </td>

                        <!-- Col: LAINNYA -->
                        <td class="text-center">
                            @if(!empty($row['other']))
                                <div class="d-flex flex-column align-items-center gap-1">
                                    @foreach($row['other'] as $oPerm)
                                        <div class="d-flex align-items-center gap-1">
                                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                <input class="form-check-input matrix-perm-cb row-perm-{{ $rowId }}" 
                                                       type="checkbox" 
                                                       name="{{ $input }}" 
                                                       value="{{ $oPerm['name'] }}" 
                                                       id="{{ $prefix }}_perm_{{ $oPerm['id'] }}"
                                                       data-menu-id="{{ $row['id'] }}"
                                                       data-parent-id="{{ $parentId }}"
                                                       data-action="other"
                                                       data-perm-name="{{ $oPerm['name'] }}"
                                                       {{ $isReadonly ? 'disabled' : '' }} />
                                            </div>
                                            <span class="badge badge-light-secondary fs-8">{{ $oPerm['action_label'] ?? $oPerm['name'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted fw-bold">-</span>
                            @endif
                        </td>

                        <!-- Col: SEMUA -->
                        <td class="text-center pe-4">
                            @if($hasAnyPerm)
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input matrix-row-check-all" 
                                               type="checkbox" 
                                               data-target-row="{{ $rowId }}"
                                               {{ $isReadonly ? 'disabled' : '' }} 
                                               title="Pilih semua izin di baris {{ $row['name'] }}" />
                                    </div>
                                </div>
                            @else
                                <span class="text-muted fw-bold">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--end::Matrix Table-->
</div>
