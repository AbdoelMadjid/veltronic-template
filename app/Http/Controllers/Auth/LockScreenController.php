<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LockScreenController extends Controller
{
    /**
     * Unlock the locked screen by verifying the user's password.
     */
    public function unlock(Request $request): JsonResponse
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi tidak ditemukan atau telah kedaluwarsa. Silakan muat ulang halaman.',
            ], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password yang Anda masukkan salah. Silakan coba lagi.',
            ], 422);
        }

        // Touch the session / mark unlocked
        $request->session()->put('last_activity', now()->timestamp);

        // Record lock screen unlock activity & check 24h point eligibility
        $user->recordLogin('lockscreen', $request);

        return response()->json([
            'success' => true,
            'message' => 'Layar berhasil dibuka.',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
}
