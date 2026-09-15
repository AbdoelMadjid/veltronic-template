<?php

namespace Tests\Feature;

use App\Models\AppSupport\AppSetting;
use App\Models\UserManagement\User;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class IconStyleSyncTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'master', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);

        $this->seed(AppSettingSeeder::class);
    }

    public function test_non_admin_and_guest_receive_database_icon_style_outline(): void
    {
        AppSetting::set('default_icon_style', 'outline', 'appearance');

        $this->assertEquals('outline', getActiveIconStyle());

        // Guest accessing frontpage
        $guestResponse = $this->get('/');
        $guestResponse->assertStatus(200);
        $guestResponse->assertSee('data-kt-icon-style="outline"', false);

        // Non-admin user accessing dashboard
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $userResponse = $this->actingAs($user)->get('/dashboard');
        $userResponse->assertStatus(200);
        $userResponse->assertSee('data-kt-icon-style="outline"', false);
    }

    public function test_stale_cookie_does_not_override_database_icon_style(): void
    {
        AppSetting::set('default_icon_style', 'outline', 'appearance');

        $user = User::factory()->create();
        $user->assignRole('siswa');

        // Request with stale duotone cookie
        $response = $this->actingAs($user)
            ->withUnencryptedCookie('kt_icon_style', 'duotone')
            ->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('data-kt-icon-style="outline"', false);
    }

    public function test_admin_switching_icon_style_updates_view_for_non_admin_immediately(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $siswa = User::factory()->create();
        $siswa->assignRole('siswa');

        // Admin switches to outline
        $switchResponse = $this->actingAs($admin)->getJson('/icon-style/switch/outline');
        $switchResponse->assertStatus(200);
        $this->assertEquals('outline', AppSetting::get('default_icon_style'));

        // Siswa opens dashboard and gets outline
        $siswaResponse = $this->actingAs($siswa)->get('/dashboard');
        $siswaResponse->assertStatus(200);
        $siswaResponse->assertSee('data-kt-icon-style="outline"', false);

        // Admin switches to solid
        $this->actingAs($admin)->getJson('/icon-style/switch/solid');
        $this->assertEquals('solid', AppSetting::get('default_icon_style'));

        // Siswa opens dashboard and immediately gets solid
        $siswaResponseSolid = $this->actingAs($siswa)->get('/dashboard');
        $siswaResponseSolid->assertStatus(200);
        $siswaResponseSolid->assertSee('data-kt-icon-style="solid"', false);
    }
}
