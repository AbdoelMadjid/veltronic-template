<?php

namespace Tests\Feature;

use App\Models\AppSupport\AppSetting;
use App\Models\UserManagement\User;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class FrontpageAccessTest extends TestCase
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

    public function test_guest_can_access_frontpages(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $landingResponse = $this->get('/landing');
        $landingResponse->assertStatus(200);

        $educationResponse = $this->get('/education');
        $educationResponse->assertStatus(200);
    }

    public function test_non_admin_user_can_access_frontpages(): void
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $rootResponse = $this->actingAs($user)->get('/');
        $rootResponse->assertStatus(200);

        $landingResponse = $this->actingAs($user)->get('/landing');
        $landingResponse->assertStatus(200);

        $educationResponse = $this->actingAs($user)->get('/education');
        $educationResponse->assertStatus(200);
    }

    public function test_admin_and_master_can_access_frontpages(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $adminResponse = $this->actingAs($admin)->get('/');
        $adminResponse->assertStatus(200);

        $master = User::factory()->create();
        $master->assignRole('master');

        $masterResponse = $this->actingAs($master)->get('/');
        $masterResponse->assertStatus(200);
    }

    public function test_guest_and_non_admin_cannot_switch_system_default_frontpage(): void
    {
        $guestResponse = $this->get('/frontpage/switch/education');
        $guestResponse->assertRedirect(route('login'));

        $user = User::factory()->create();
        $user->assignRole('siswa');

        $userResponse = $this->actingAs($user)->get('/frontpage/switch/education');
        $userResponse->assertStatus(403);
    }

    public function test_admin_can_switch_system_default_frontpage(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/frontpage/switch/education');
        $response->assertStatus(302);
        $this->assertEquals('education', AppSetting::get('default_frontpage'));
    }
}
