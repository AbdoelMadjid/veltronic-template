<?php

namespace App\Http\Controllers\ManajemenPengguna;

use App\DataTable\ManajemenPengguna\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManajemenPengguna\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserDataTable $dataTable): View|JsonResponse
    {
        if ($request->ajax() || $request->wantsJson()) {
            return $dataTable->render();
        }

        $roles = Role::orderBy('name')->get();
        return view('pages.manajemenpengguna.users', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse|JsonResponse
    {
        try {
            DB::beginTransaction();

            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }

            $user = User::create([
                'name' => $request->validated('name'),
                'email' => $request->validated('email'),
                'avatar' => $avatarPath,
                'password' => Hash::make($request->validated('password')),
                'email_verified_at' => now(),
            ]);

            $user->assignRole($request->validated('role'));

            DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pengguna baru berhasil ditambahkan.',
                    'data' => $user->load('roles'),
                ]);
            }

            return redirect()->route('manajemenpengguna.users.index')
                ->with('success', 'Pengguna baru berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();

            if (isset($avatarPath) && $avatarPath) {
                Storage::disk('public')->delete($avatarPath);
            }

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menambahkan pengguna: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse|View
    {
        $user->load('roles');

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar_url,
                    'email_verified_at' => $user->email_verified_at ? $user->email_verified_at->format('d M Y H:i') : null,
                    'created_at' => $user->created_at ? $user->created_at->format('d M Y H:i') : null,
                    'updated_at' => $user->updated_at ? $user->updated_at->format('d M Y H:i') : null,
                    'roles' => $user->roles->pluck('name')->toArray(),
                    'role' => $user->roles->first()?->name ?? 'user',
                ],
            ]);
        }

        return view('pages.manajemenpengguna.users', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): JsonResponse
    {
        $user->load('roles');

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar_url,
                'role' => $user->roles->first()?->name ?? 'user',
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): RedirectResponse|JsonResponse
    {
        try {
            DB::beginTransaction();

            $updateData = [
                'name' => $request->validated('name'),
                'email' => $request->validated('email'),
            ];

            // Handle Avatar Upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $updateData['avatar'] = $request->file('avatar')->store('avatars', 'public');
            } elseif ($request->boolean('remove_avatar')) {
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $updateData['avatar'] = null;
            }

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->validated('password'));
            }

            $user->update($updateData);
            $user->syncRoles([$request->validated('role')]);

            DB::commit();

            $user->refresh()->load('roles');

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data pengguna berhasil diperbarui.',
                    'data' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'avatar' => $user->avatar,
                        'avatar_url' => $user->avatar_url,
                        'role' => $user->roles->first()?->name ?? 'user',
                        'is_auth_user' => (auth()->id() === $user->id),
                    ],
                ]);
            }

            return redirect()->route('manajemenpengguna.users.index')
                ->with('success', 'Data pengguna berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal memperbarui pengguna: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui pengguna: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse|JsonResponse
    {
        // Cegah menghapus akun yang sedang login
        if (auth()->id() === $user->id) {
            $msg = 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.';
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json(['status' => 'error', 'message' => $msg], 422);
            }
            return redirect()->back()->with('error', $msg);
        }

        // Cegah menghapus jika merupakan satu-satunya role master
        if ($user->hasRole('master')) {
            $masterCount = User::role('master')->count();
            if ($masterCount <= 1) {
                $msg = 'Tidak dapat menghapus satu-satunya akun dengan peran Master.';
                if (request()->wantsJson() || request()->ajax()) {
                    return response()->json(['status' => 'error', 'message' => $msg], 422);
                }
                return redirect()->back()->with('error', $msg);
            }
        }

        try {
            // Delete avatar file from storage if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->delete();

            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pengguna berhasil dihapus.',
                ]);
            }

            return redirect()->route('manajemenpengguna.users.index')
                ->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Throwable $e) {
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menghapus pengguna: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }

    /**
     * Reset password of the user to default.
     */
    public function resetPassword(Request $request, User $user): JsonResponse|RedirectResponse
    {
        $newPassword = $request->input('password', 'password123');

        try {
            $user->update([
                'password' => Hash::make($newPassword),
            ]);

            $msg = "Kata sandi untuk pengguna {$user->name} berhasil direset ke '{$newPassword}'.";

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => $msg,
                ]);
            }

            return redirect()->back()->with('success', $msg);
        } catch (\Throwable $e) {
            $msg = 'Gagal mereset kata sandi: ' . $e->getMessage();
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $msg], 500);
            }
            return redirect()->back()->with('error', $msg);
        }
    }
}
