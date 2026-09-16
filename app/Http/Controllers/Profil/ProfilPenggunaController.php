<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Models\UserManagement\User;
use App\Models\Profil\UserDetail;
use App\Models\Profil\UserLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfilPenggunaController extends Controller
{
    /**
     * Display the User Profile page with all 5 tabs.
     */
    public function index(Request $request): View
    {
        /** @var User $user */
        $user = Auth::user();
        
        $detail = $user->detail ?? new UserDetail([
            'user_id' => $user->id,
            'nama_lengkap' => $user->name,
            'kewarganegaraan' => 'WNI',
            'berlaku_hingga' => 'Seumur Hidup',
        ]);

        $settings = $user->settingRecord?->toFlatArray() ?? [];
        $logs = $user->logs()->take(25)->get();

        // Get active login sessions
        $sessions = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('sessions')) {
                $sessions = DB::table('sessions')
                    ->where('user_id', $user->id)
                    ->orderBy('last_activity', 'desc')
                    ->get();
            }
        } catch (\Throwable $e) {}

        return view('pages.profil.profil-pengguna', [
            'user' => $user,
            'detail' => $detail,
            'settings' => $settings,
            'logs' => $logs,
            'sessions' => $sessions,
            'activeTab' => $request->query('tab', 'profil-saya'),
        ]);
    }

    /**
     * Calculate user profile completion percentage.
     */
    private function calculateCompletionPercent(User $user): int
    {
        $detail = $user->detail;
        $trackedFields = [
            'name' => !empty($user->name),
            'email' => !empty($user->email),
            'avatar' => !empty($user->avatar),
            'nik' => !empty($detail?->nik),
            'nama_lengkap' => !empty($detail?->nama_lengkap),
            'tempat_lahir' => !empty($detail?->tempat_lahir),
            'tanggal_lahir' => !empty($detail?->tanggal_lahir),
            'jenis_kelamin' => !empty($detail?->jenis_kelamin),
            'agama' => !empty($detail?->agama),
            'status_perkawinan' => !empty($detail?->status_perkawinan),
            'pekerjaan' => !empty($detail?->pekerjaan),
            'no_hp' => !empty($detail?->no_hp),
            'foto_ktp' => !empty($detail?->foto_ktp),
            'alamat_jalan' => !empty($detail?->alamat_jalan),
            'desa' => !empty($detail?->desa),
            'kecamatan' => !empty($detail?->kecamatan),
            'kabupaten' => !empty($detail?->kabupaten),
            'provinsi' => !empty($detail?->provinsi),
        ];
        $filledCount = count(array_filter($trackedFields));
        return (int) round(($filledCount / count($trackedFields)) * 100);
    }

    /**
     * Update user identity & KTP details.
     */
    public function updateIdentitas(Request $request): JsonResponse|RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'nik' => ['nullable', 'string', 'max:20'],
            'nama_lengkap' => ['nullable', 'string', 'max:255'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'string', 'in:Laki-laki,Perempuan'],
            'golongan_darah' => ['nullable', 'string', 'max:5'],
            'agama' => ['nullable', 'string', 'max:50'],
            'status_perkawinan' => ['nullable', 'string', 'max:50'],
            'pekerjaan' => ['nullable', 'string', 'max:100'],
            'moto_hidup' => ['nullable', 'string', 'max:500'],
            'kewarganegaraan' => ['nullable', 'string', 'max:50'],
            'berlaku_hingga' => ['nullable', 'string', 'max:50'],
            'alamat_jalan' => ['nullable', 'string', 'max:255'],
            'blok' => ['nullable', 'string', 'max:50'],
            'nomor_rumah' => ['nullable', 'string', 'max:50'],
            'rt' => ['nullable', 'string', 'max:10'],
            'rw' => ['nullable', 'string', 'max:10'],
            'desa' => ['nullable', 'string', 'max:100'],
            'kecamatan' => ['nullable', 'string', 'max:100'],
            'kabupaten' => ['nullable', 'string', 'max:100'],
            'provinsi' => ['nullable', 'string', 'max:100'],
            'kode_pos' => ['nullable', 'string', 'max:10'],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'foto_ktp' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'avatar_remove' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => $avatarPath]);
            UserLog::log('Pembaruan Avatar', 'Foto profil diperbarui melalui formulir identitas.', $user);
        } elseif ($request->input('avatar_remove') == '1' || $request->input('avatar_remove') == 'true') {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->update(['avatar' => null]);
            UserLog::log('Pembaruan Avatar', 'Foto profil dihapus.', $user);
        }
        unset($validated['avatar'], $validated['avatar_remove']);

        $detail = $user->detail ?? new UserDetail(['user_id' => $user->id]);

        if ($request->hasFile('foto_ktp')) {
            if ($detail->foto_ktp && Storage::disk('public')->exists($detail->foto_ktp)) {
                Storage::disk('public')->delete($detail->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        } else {
            unset($validated['foto_ktp']);
        }

        $detail->fill($validated);
        $detail->user_id = $user->id;
        $detail->save();

        UserLog::log('Pembaruan Identitas Diri', 'Memperbarui data KTP dan alamat terperinci.', $user);

        $freshUser = $user->fresh();
        $freshDetail = $detail->fresh();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Identitas diri dan data KTP berhasil disimpan.',
                'detail' => [
                    'nik' => $freshDetail->nik ?? '-',
                    'nama_lengkap' => $freshDetail->nama_lengkap ?? '-',
                    'tempat_lahir' => $freshDetail->tempat_lahir ?? '-',
                    'tanggal_lahir' => $freshDetail->tanggal_lahir ? $freshDetail->tanggal_lahir->format('Y-m-d') : '',
                    'tanggal_lahir_formatted' => $freshDetail->tanggal_lahir ? $freshDetail->tanggal_lahir->translatedFormat('d F Y') : '-',
                    'ttl' => ($freshDetail->tempat_lahir ?? '-') . ', ' . ($freshDetail->tanggal_lahir ? $freshDetail->tanggal_lahir->translatedFormat('d F Y') : '-'),
                    'jenis_kelamin' => $freshDetail->jenis_kelamin ?? '-',
                    'golongan_darah' => $freshDetail->golongan_darah ?? '-',
                    'agama' => $freshDetail->agama ?? '-',
                    'status_perkawinan' => $freshDetail->status_perkawinan ?? '-',
                    'pekerjaan' => $freshDetail->pekerjaan ?? '-',
                    'moto_hidup' => $freshDetail->moto_hidup ?? '',
                    'kewarganegaraan' => $freshDetail->kewarganegaraan ?? 'WNI',
                    'berlaku_hingga' => $freshDetail->berlaku_hingga ?? 'Seumur Hidup',
                    'no_hp' => $freshDetail->no_hp ?? '-',
                    'alamat_jalan' => $freshDetail->alamat_jalan ?? '-',
                    'blok' => $freshDetail->blok ?? '',
                    'nomor_rumah' => $freshDetail->nomor_rumah ?? '',
                    'blok_norumah' => ($freshDetail->blok ? 'Blok ' . $freshDetail->blok : '-') . ' / ' . ($freshDetail->nomor_rumah ? 'No. ' . $freshDetail->nomor_rumah : '-'),
                    'rt' => $freshDetail->rt ?? '-',
                    'rw' => $freshDetail->rw ?? '-',
                    'rt_rw' => 'RT ' . ($freshDetail->rt ?? '-') . ' / RW ' . ($freshDetail->rw ?? '-'),
                    'desa' => $freshDetail->desa ?? '-',
                    'kecamatan' => $freshDetail->kecamatan ?? '-',
                    'kabupaten' => $freshDetail->kabupaten ?? '-',
                    'provinsi' => $freshDetail->provinsi ?? '-',
                    'kode_pos' => $freshDetail->kode_pos ?? '-',
                    'alamat_lengkap' => $freshDetail->alamat_lengkap ?? '-',
                ],
                'user' => [
                    'name' => $freshUser->name,
                    'email' => $freshUser->email,
                    'avatar_url' => $freshUser->avatar_url,
                ],
                'completion_percent' => $this->calculateCompletionPercent($freshUser),
            ]);
        }

        return redirect()->route('profil.profil-pengguna', ['tab' => 'identitas-diri'])
            ->with('success', 'Identitas diri dan data KTP berhasil disimpan.');
    }

    /**
     * Update user life motto (Moto Hidup).
     */
    public function updateMotoHidup(Request $request): JsonResponse|RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'moto_hidup' => ['nullable', 'string', 'max:500'],
        ]);

        $detail = $user->detail ?? new UserDetail(['user_id' => $user->id]);
        $detail->moto_hidup = $validated['moto_hidup'] ?? null;
        $detail->user_id = $user->id;
        $detail->save();

        UserLog::log('Pembaruan Moto Hidup', 'Memperbarui kalimat moto hidup pengguna.', $user);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Moto hidup berhasil disimpan.',
                'moto_hidup' => $detail->moto_hidup ?? '',
            ]);
        }

        return redirect()->route('profil.profil-pengguna', ['tab' => 'profil-saya'])
            ->with('success', 'Moto hidup berhasil disimpan.');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request): JsonResponse|RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'current_password.current_password' => 'Password saat ini yang Anda masukkan tidak sesuai.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        UserLog::log('Perubahan Password', 'Password akun berhasil diubah.', $user);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Password akun Anda berhasil diperbarui.',
            ]);
        }

        return redirect()->route('profil.profil-pengguna', ['tab' => 'ganti-password'])
            ->with('success', 'Password akun Anda berhasil diperbarui.');
    }

    /**
     * Update user custom configuration settings.
     */
    public function updateKonfigurasi(Request $request): JsonResponse|RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'cover_background' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'cover_opacity' => ['nullable', 'integer', 'min:0', 'max:100'],
            'cover_overlay_color' => ['nullable', 'string', 'max:20'],
            'cover_position_y' => ['nullable', 'integer', 'min:0', 'max:100'],
            'cover_height' => ['nullable', 'integer', 'min:180', 'max:700'],
            'cover_blur' => ['nullable', 'integer', 'min:0', 'max:20'],
            'cover_background_remove' => ['nullable', 'string'],
        ], [
            'cover_background.image' => 'File background harus berupa gambar.',
            'cover_background.mimes' => 'Format background yang didukung: JPG, JPEG, PNG, WEBP.',
            'cover_background.max' => 'Ukuran file background maksimal 3MB.',
        ]);

        $section = $request->input('section');

        // 1. Handle Cover Background & Styling Section
        if (!$section || $section === 'cover') {
            // Handle Cover Background Removal
            if ($request->input('cover_background_remove') == '1' || $request->input('cover_background_remove') == 'true') {
                $oldCover = $user->setting('cover_background');
                if ($oldCover && Storage::disk('public')->exists($oldCover)) {
                    Storage::disk('public')->delete($oldCover);
                }
                $user->setSetting('cover_background', null, 'profile_cover');
                UserLog::log('Pembaruan Background Profil', 'Foto background cover dihapus (kembali ke default).', $user);
            }
            // Handle Cover Background Upload
            elseif ($request->hasFile('cover_background')) {
                $oldCover = $user->setting('cover_background');
                if ($oldCover && Storage::disk('public')->exists($oldCover)) {
                    Storage::disk('public')->delete($oldCover);
                }
                $coverPath = $request->file('cover_background')->store('covers', 'public');
                $user->setSetting('cover_background', $coverPath, 'profile_cover');
                UserLog::log('Pembaruan Background Profil', 'Foto background cover diperbarui.', $user);
            }

            // Cover Customization Settings
            if ($request->has('cover_opacity')) {
                $user->setSetting('cover_opacity', (string) $request->input('cover_opacity', '60'), 'profile_cover');
            }
            if ($request->has('cover_overlay_color')) {
                $user->setSetting('cover_overlay_color', (string) $request->input('cover_overlay_color', '#000000'), 'profile_cover');
            }
            if ($request->has('cover_position_y')) {
                $user->setSetting('cover_position_y', (string) $request->input('cover_position_y', '30'), 'profile_cover');
            }
            if ($request->has('cover_height')) {
                $user->setSetting('cover_height', (string) $request->input('cover_height', '250'), 'profile_cover');
            }
            if ($request->has('cover_blur')) {
                $user->setSetting('cover_blur', (string) $request->input('cover_blur', '0'), 'profile_cover');
            }
        }

        // 2. Handle Preferences & Notification Section
        if (!$section || $section === 'preferensi') {
            $allowedSettings = [
                'notifikasi_email' => 'boolean',
                'notifikasi_wa' => 'boolean',
                'autolock_screen' => 'boolean',
                'bahasa_default' => 'string',
                'tema_default' => 'string',
                'dua_faktor' => 'boolean',
                'hemat_data' => 'boolean',
                'rekap_mingguan' => 'boolean',
            ];

            foreach ($allowedSettings as $key => $type) {
                if ($type === 'boolean') {
                    $val = $request->boolean($key) ? '1' : '0';
                } else {
                    $val = (string) $request->input($key, '');
                }

                $user->setSetting($key, $val, 'preferences');
            }

            UserLog::log('Pembaruan Preferensi', 'Memperbarui konfigurasi preferensi dan tampilan pengguna.', $user);
        }

        $freshUser = $user->fresh();

        $successMessage = $section === 'cover' 
            ? 'Kustomisasi background & kontras header profil berhasil disimpan.' 
            : ($section === 'preferensi' 
                ? 'Preferensi dan notifikasi pengguna berhasil disimpan.' 
                : 'Pengaturan konfigurasi pengguna berhasil disimpan.');

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'settings' => [
                    'cover_background_url' => $freshUser->cover_bg_url,
                    'cover_has_custom' => !empty($freshUser->setting('cover_background')),
                    'cover_opacity' => (int) $freshUser->setting('cover_opacity', '60'),
                    'cover_overlay_color' => $freshUser->setting('cover_overlay_color', '#000000'),
                    'cover_position_y' => (int) $freshUser->setting('cover_position_y', '30'),
                    'cover_height' => (int) $freshUser->setting('cover_height', '250'),
                    'cover_blur' => (int) $freshUser->setting('cover_blur', '0'),
                ],
            ]);
        }

        return redirect()->route('profil.profil-pengguna', ['tab' => 'konfigurasi'])
            ->with('success', $successMessage);
    }

    /**
     * Update user profile avatar.
     */
    public function updateAvatar(Request $request): JsonResponse|RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($request->input('avatar_remove') == '1' || $request->input('avatar_remove') == 'true') {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->update(['avatar' => null]);
            UserLog::log('Pembaruan Avatar', 'Foto profil dihapus.', $user);

            $freshUser = $user->fresh();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Foto profil berhasil dihapus.',
                    'avatar_url' => null,
                    'completion_percent' => $this->calculateCompletionPercent($freshUser),
                ]);
            }

            return redirect()->route('profil.profil-pengguna')
                ->with('success', 'Foto profil berhasil dihapus.');
        }

        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $avatarPath]);

        UserLog::log('Pembaruan Avatar', 'Foto profil pengguna diperbarui.', $user);

        $freshUser = $user->fresh();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui.',
                'avatar_url' => $freshUser->avatar_url,
                'completion_percent' => $this->calculateCompletionPercent($freshUser),
            ]);
        }

        return redirect()->route('profil.profil-pengguna')
            ->with('success', 'Foto profil berhasil diperbarui.');
    }

    /**
     * Update or upload user KTP photo directly.
     */
    public function updateFotoKtp(Request $request): JsonResponse|RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $detail = $user->detail ?? new UserDetail(['user_id' => $user->id]);

        if ($request->input('ktp_remove') == '1' || $request->input('ktp_remove') == 'true') {
            if ($detail->foto_ktp && Storage::disk('public')->exists($detail->foto_ktp)) {
                Storage::disk('public')->delete($detail->foto_ktp);
            }
            $detail->foto_ktp = null;
            $detail->save();

            UserLog::log('Pembaruan Dokumen KTP', 'Foto KTP dihapus.', $user);

            $freshUser = $user->fresh();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Foto KTP berhasil dihapus.',
                    'foto_ktp_url' => null,
                    'completion_percent' => $this->calculateCompletionPercent($freshUser),
                ]);
            }

            return redirect()->route('profil.profil-pengguna')
                ->with('success', 'Foto KTP berhasil dihapus.');
        }

        $request->validate([
            'foto_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($detail->foto_ktp && Storage::disk('public')->exists($detail->foto_ktp)) {
            Storage::disk('public')->delete($detail->foto_ktp);
        }

        $ktpPath = $request->file('foto_ktp')->store('ktp', 'public');
        $detail->foto_ktp = $ktpPath;
        $detail->user_id = $user->id;
        $detail->save();

        UserLog::log('Pembaruan Dokumen KTP', 'Foto KTP pengguna diperbarui.', $user);

        $freshUser = $user->fresh();
        $freshDetail = $detail->fresh();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Foto KTP berhasil diunggah.',
                'foto_ktp_url' => $freshDetail->foto_ktp_url,
                'completion_percent' => $this->calculateCompletionPercent($freshUser),
            ]);
        }

        return redirect()->route('profil.profil-pengguna')
            ->with('success', 'Foto KTP berhasil diunggah.');
    }
}
