<?php

namespace Tests\Feature;

use App\Models\User;
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
    }

    public function test_guest_is_redirected_to_login_from_root(): void
    {
        $response = $this->get('/');
        $response->assertRedirect(route('login'));
    }

    public function test_guest_is_redirected_to_login_from_landing(): void
    {
        $response = $this->get('/landing');
        $response->assertRedirect(route('login'));
    }

    public function test_guest_is_redirected_to_login_from_education(): void
    {
        $response = $this->get('/education');
        $response->assertRedirect(route('login'));
    }

    public function test_non_admin_user_redirected_from_root(): void
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $response = $this->actingAs($user)->get('/');
        $response->assertRedirect(route('dashboard'));
    }

    public function test_non_admin_user_cannot_access_landing(): void
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $response = $this->actingAs($user)->get('/landing');
        $response->assertStatus(403);
    }

    public function test_non_admin_user_cannot_access_education(): void
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $response = $this->actingAs($user)->get('/education');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_frontpages(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $rootResponse = $this->actingAs($admin)->get('/');
        $rootResponse->assertStatus(200);

        $landingResponse = $this->actingAs($admin)->get('/landing');
        $landingResponse->assertStatus(200);

        $educationResponse = $this->actingAs($admin)->get('/education');
        $educationResponse->assertStatus(200);
    }

    public function test_master_can_access_frontpages(): void
    {
        $master = User::factory()->create();
        $master->assignRole('master');

        $rootResponse = $this->actingAs($master)->get('/');
        $rootResponse->assertStatus(200);

        $landingResponse = $this->actingAs($master)->get('/landing');
        $landingResponse->assertStatus(200);

        $educationResponse = $this->actingAs($master)->get('/education');
        $educationResponse->assertStatus(200);
    }
}
