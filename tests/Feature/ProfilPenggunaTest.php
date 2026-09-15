<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserSetting;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProfilPenggunaTest extends TestCase
{
    use DatabaseTransactions;

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
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertEquals('1', $user->setting('notifikasi_email'));
        $this->assertEquals('dark', $user->setting('tema_default'));
    }
}
