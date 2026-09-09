<?php

namespace App\DataTable\ManajemenPengguna;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;

class UserDataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('user_info', function (User $user) {
                $initial = strtoupper(substr($user->name, 0, 1));
                return [
                    'initial' => $initial,
                    'name' => e($user->name),
                    'email' => e($user->email),
                    'avatar' => $user->avatar_url,
                ];
            })
            ->addColumn('role_badge', function (User $user) {
                $role = $user->roles->first()?->name ?? 'user';
                $badgeClass = match ($role) {
                    'master' => 'badge-light-danger',
                    'admin' => 'badge-light-warning',
                    default => 'badge-light-primary',
                };
                return '<span class="badge ' . $badgeClass . ' fw-bold fs-7 px-3 py-1">' . ucfirst(e($role)) . '</span>';
            })
            ->addColumn('email_status', function (User $user) {
                if ($user->email_verified_at) {
                    return '<span class="badge badge-light-success fw-bold fs-8">Terverifikasi</span>';
                }
                return '<span class="badge badge-light-secondary fw-bold fs-8">Belum Diverifikasi</span>';
            })
            ->addColumn('joined_at', function (User $user) {
                return $user->created_at ? $user->created_at->format('d M Y') : '-';
            })
            ->addColumn('actions', function (User $user) {
                $authId = auth()->id();
                $isSelf = $authId === $user->id;

                $html = '<div class="d-flex justify-content-end align-items-center gap-1">';

                // Detail Button
                $html .= '<button type="button" class="btn btn-icon btn-sm btn-light-info btn-view-user" data-id="' . $user->id . '" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Lihat Detail"><i class="ki-duotone ki-eye fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></button>';

                // Edit Button
                $html .= '<button type="button" class="btn btn-icon btn-sm btn-light-warning btn-edit-user" data-id="' . $user->id . '" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Ubah Pengguna"><i class="ki-duotone ki-pencil fs-5"><span class="path1"></span><span class="path2"></span></i></button>';

                // Reset Password Button
                $html .= '<button type="button" class="btn btn-icon btn-sm btn-light-dark btn-reset-password" data-id="' . $user->id . '" data-name="' . e($user->name) . '" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Atur Ulang Kata Sandi"><i class="ki-duotone ki-key fs-5"><span class="path1"></span><span class="path2"></span></i></button>';

                // Delete Button
                if (!$isSelf) {
                    $html .= '<button type="button" class="btn btn-icon btn-sm btn-light-danger btn-delete-user" data-id="' . $user->id . '" data-name="' . e($user->name) . '" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Hapus Pengguna"><i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i></button>';
                }

                $html .= '</div>';
                return $html;
            })
            ->filterColumn('user_info', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('users.name', 'like', "%{$keyword}%")
                      ->orWhere('users.email', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('user_info', function ($query, $order) {
                $query->orderBy('users.name', $order);
            })
            ->rawColumns(['role_badge', 'email_status', 'actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $query = $model->newQuery()->with('roles')->select('users.*');

        if (request()->filled('role')) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', request('role'));
            });
        }

        return $query;
    }

    /**
     * Render the DataTable response to JsonResponse.
     */
    public function render()
    {
        return $this->dataTable($this->query(new User()))->toJson();
    }
}
