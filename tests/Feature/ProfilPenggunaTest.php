<?php

namespace Tests\Feature;

use App\Models\UserManagement\User;
use App\Models\Profil\UserDetail;
use App\Models\Profil\UserSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProfilPenggunaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
    }

    public function test_guest_is_redirected_when_accessing_profil_pengguna(): void
    {
        $response = $this->get('/profil/profil-pengguna');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_profil_pengguna(): void
    {
        $user = User::factory()->create([
            'name' => 'Ahmad Dahlan',
            'email' => 'ahmad@example.com',
        ]);
        $user->assignRole('user');

        $response = $this->actingAs($user)->get('/profil/profil-pengguna');

        $response->assertStatus(200);
        $response->assertSee('Ahmad Dahlan');
        $response->assertSee('ahmad@example.com');
        $response->assertSee('Profil Saya');
        $response->assertSee('Identitas Diri');
        $response->assertSee('Ganti Password');
        $response->assertSee('Konfigurasi');
        $response->assertSee('Riwayat Pengguna');
    }

    public function test_user_can_update_identitas_diri_and_ktp(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $user->assignRole('user');

        $ktpFile = UploadedFile::fake()->image('ktp.jpg', 600, 400);

        $response = $this->actingAs($user)->postJson('/profil/profil-pengguna/identitas', [
            'nik' => '3201234567890001',
            'nama_lengkap' => 'Ahmad Dahlan S.Kom',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1995-05-20',
            'jenis_kelamin' => 'Laki-laki',
            'golongan_darah' => 'O',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Software Engineer',
            'kewarganegaraan' => 'WNI',
            'berlaku_hingga' => 'Seumur Hidup',
            'alamat_jalan' => 'Jl. Asia Afrika',
            'blok' => 'B2',
            'nomor_rumah' => '15',
            'rt' => '003',
            'rw' => '007',
            'desa' => 'Braga',
            'kecamatan' => 'Sumur Bandung',
            'kabupaten' => 'Kota Bandung',
            'provinsi' => 'Jawa Barat',
            'kode_pos' => '40111',
            'no_hp' => '081234567890',
            'foto_ktp' => $ktpFile,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('users_details', [
            'user_id' => $user->id,
            'nik' => '3201234567890001',
            'desa' => 'Braga',
            'kabupaten' => 'Kota Bandung',
        ]);

        $this->assertDatabaseHas('users_logs', [
            'user_id' => $user->id,
            'activity' => 'Pembaruan Identitas Diri',
        ]);
    }

    public function test_user_can_update_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('oldpassword123'),
        ]);

        $response = $this->actingAs($user)->postJson('/profil/profil-pengguna/password', [
            'current_password' => 'oldpassword123',
            'password' => 'newpassword1234',
            'password_confirmation' => 'newpassword1234',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $user->refresh();
        $this->assertTrue(Hash::check('newpassword1234', $user->password));

        $this->assertDatabaseHas('users_logs', [
            'user_id' => $user->id,
            'activity' => 'Perubahan Password',
        ]);
    }

    public function test_user_can_update_konfigurasi_settings(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/profil/profil-pengguna/konfigurasi', [
            'notifikasi_email' => '1',
            'notifikasi_wa' => '1',
            'autolock_screen' => '0',
            'bahasa_default' => 'id',
            'tema_default' => 'dark',
            'dua_faktor' => '1',
            'cover_opacity' => '45',
            'cover_overlay_color' => '#0f172a',
            'cover_position_y' => '25',
            'cover_blur' => '3',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'settings' => [
                'cover_opacity' => 45,
                'cover_overlay_color' => '#0f172a',
                'cover_position_y' => 25,
                'cover_blur' => 3,
            ],
        ]);

        $this->assertEquals('1', $user->setting('notifikasi_email'));
        $this->assertEquals('dark', $user->setting('tema_default'));
        $this->assertEquals('45', $user->setting('cover_opacity'));
        $this->assertEquals('#0f172a', $user->setting('cover_overlay_color'));
        $this->assertEquals('25', $user->setting('cover_position_y'));
        $this->assertEquals('3', $user->setting('cover_blur'));
    }

    public function test_user_can_upload_and_remove_cover_background(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $coverFile = UploadedFile::fake()->image('banner.jpg', 1200, 400);

        $response = $this->actingAs($user)->postJson('/profil/profil-pengguna/konfigurasi', [
            'cover_background' => $coverFile,
            'cover_position_y' => '10',
            'cover_opacity' => '50',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'settings' => [
                'cover_has_custom' => true,
                'cover_position_y' => 10,
                'cover_opacity' => 50,
            ],
        ]);

        $coverPath = $user->setting('cover_background');
        $this->assertNotNull($coverPath);
        Storage::disk('public')->assertExists($coverPath);

        // Test remove cover background
        $removeResponse = $this->actingAs($user)->postJson('/profil/profil-pengguna/konfigurasi', [
            'cover_background_remove' => '1',
        ]);

        $removeResponse->assertStatus(200);
        $removeResponse->assertJson([
            'success' => true,
            'settings' => [
                'cover_has_custom' => false,
            ],
        ]);

        $this->assertNull($user->setting('cover_background'));
    }

    public function test_user_can_update_moto_hidup(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->postJson('/profil/profil-pengguna/moto-hidup', [
            'moto_hidup' => 'Pantang menyerah sebelum berhasil',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'moto_hidup' => 'Pantang menyerah sebelum berhasil',
        ]);

        $this->assertDatabaseHas('users_details', [
            'user_id' => $user->id,
            'moto_hidup' => 'Pantang menyerah sebelum berhasil',
        ]);

        $this->assertDatabaseHas('users_logs', [
            'user_id' => $user->id,
            'activity' => 'Pembaruan Moto Hidup',
        ]);
    }

    public function test_user_can_submit_account_deletion_request(): void
    {
        Role::firstOrCreate(['name' => 'master', 'guard_name' => 'web']);

        $user = User::factory()->create([
            'password' => Hash::make('secret123'),
        ]);
        $user->assignRole('user');

        $response = $this->actingAs($user)->postJson('/profil/profil-pengguna/request-deletion', [
            'password' => 'secret123',
            'reason' => 'Ingin berhenti menggunakan layanan.',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'status' => 'pending',
            'reason' => 'Ingin berhenti menggunakan layanan.',
        ]);

        $this->assertDatabaseHas('account_deletion_requests', [
            'user_id' => $user->id,
            'status' => 'pending',
            'reason' => 'Ingin berhenti menggunakan layanan.',
        ]);

        $this->assertDatabaseHas('app_notifications', [
            'category' => 'security',
            'type' => 'account_deletion_request',
            'target_role' => 'master',
        ]);

        $this->assertDatabaseHas('app_notifications', [
            'category' => 'security',
            'type' => 'account_deletion_request',
            'target_role' => 'admin',
        ]);
    }

    public function test_user_cannot_submit_account_deletion_with_wrong_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('secret123'),
        ]);
        $user->assignRole('user');

        $response = $this->actingAs($user)->postJson('/profil/profil-pengguna/request-deletion', [
            'password' => 'wrong-password',
            'reason' => 'Test',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
    }

    public function test_user_can_cancel_pending_account_deletion_request(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('secret123'),
        ]);
        $user->assignRole('user');

        $this->actingAs($user)->postJson('/profil/profil-pengguna/request-deletion', [
            'password' => 'secret123',
            'reason' => 'Test reason',
        ]);

        $cancelResponse = $this->actingAs($user)->postJson('/profil/profil-pengguna/cancel-deletion');
        $cancelResponse->assertStatus(200);
        $cancelResponse->assertJson(['success' => true]);

        $this->assertDatabaseHas('account_deletion_requests', [
            'user_id' => $user->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_admin_can_accept_account_deletion_request_via_notification(): void
    {
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'master', 'guard_name' => 'web']);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'password' => Hash::make('secret123'),
        ]);
        $user->assignRole('user');

        $this->actingAs($user)->postJson('/profil/profil-pengguna/request-deletion', [
            'password' => 'secret123',
            'reason' => 'Saya ingin keluar akun',
        ]);

        $notif = \App\Models\AppSupport\AppNotification::where('type', 'account_deletion_request')
            ->where('target_role', 'admin')
            ->first();

        $this->assertNotNull($notif);

        $actionResponse = $this->actingAs($admin)->postJson("/notifications/{$notif->id}/action", [
            'action' => 'accept_account_deletion',
        ]);

        $actionResponse->assertStatus(200);
        $actionResponse->assertJson(['status' => 'success', 'action_state' => 'accepted']);

        // User should be deleted
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_can_decline_account_deletion_request_via_notification(): void
    {
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'password' => Hash::make('secret123'),
        ]);
        $user->assignRole('user');

        $this->actingAs($user)->postJson('/profil/profil-pengguna/request-deletion', [
            'password' => 'secret123',
            'reason' => 'Saya ingin keluar akun',
        ]);

        $notif = \App\Models\AppSupport\AppNotification::where('type', 'account_deletion_request')
            ->where('target_role', 'admin')
            ->first();

        $this->assertNotNull($notif);

        $actionResponse = $this->actingAs($admin)->postJson("/notifications/{$notif->id}/action", [
            'action' => 'decline_account_deletion',
        ]);

        $actionResponse->assertStatus(200);
        $actionResponse->assertJson(['status' => 'success', 'action_state' => 'declined']);

        // User should still exist
        $this->assertDatabaseHas('users', ['id' => $user->id]);

        // User should receive declined notification
        $this->assertDatabaseHas('app_notifications', [
            'user_id' => $user->id,
            'type' => 'account_deletion_declined',
        ]);
    }
}
