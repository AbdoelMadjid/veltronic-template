<?php

namespace App\Http\Controllers\ManajemenPengguna;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax() || $request->expectsJson()) {
            $users = User::with('roles')->latest()->get();
            return response()->json(['data' => $users]);
        }

        $roles = Role::all();
        return view('pages.manajemenpengguna.users', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['nullable', 'string'],
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'email_verified_at' => now(),
            ]);

            if (!empty($validated['role'])) {
                $user->assignRole($validated['role']);
            }

            DB::commit();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User berhasil ditambahkan.',
                    'user' => $user->load('roles'),
                ]);
            }

            return redirect()->route('manajemenpengguna.users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse|View
    {
        $user->load(['roles', 'detail', 'settings']);
        if (request()->expectsJson()) {
            return response()->json(['data' => $user]);
        }
        return view('pages.manajemenpengguna.user-detail', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['nullable', 'string'],
        ]);

        DB::beginTransaction();
        try {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            if (isset($validated['role'])) {
                $user->syncRoles([$validated['role']]);
            }

            DB::commit();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User berhasil diperbarui.',
                    'user' => $user->fresh(['roles']),
                ]);
            }

            return redirect()->route('manajemenpengguna.users.index')->with('success', 'User berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse|RedirectResponse
    {
        try {
            $user->delete();

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User berhasil dihapus.',
                ]);
            }

            return redirect()->route('manajemenpengguna.users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Throwable $e) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Reset user password to default.
     */
    public function resetPassword(User $user): JsonResponse|RedirectResponse
    {
        try {
            $user->update([
                'password' => Hash::make('password123'),
            ]);

            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password user berhasil direset ke "password123".',
                ]);
            }

            return redirect()->route('manajemenpengguna.users.index')->with('success', 'Password user berhasil direset.');
        } catch (\Throwable $e) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
