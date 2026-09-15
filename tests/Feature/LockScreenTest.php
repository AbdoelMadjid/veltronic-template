<?php

namespace Tests\Feature;

use App\Models\AppSupport\AppSetting;
use App\Models\UserManagement\User;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LockScreenTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        $this->seed(AppSettingSeeder::class);
    }

    public function test_guest_is_redirected_when_attempting_to_unlock(): void
    {
        $response = $this->postJson('/lock-screen/unlock', [
            'password' => 'secret123',
        ]);

        $response->assertStatus(401);
    }

    public function test_authenticated_user_fails_to_unlock_with_wrong_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->actingAs($user)->postJson('/lock-screen/unlock', [
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
        ]);
    }

    public function test_authenticated_user_successfully_unlocks_with_correct_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->actingAs($user)->postJson('/lock-screen/unlock', [
            'password' => 'correct-password',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Layar berhasil dibuka.',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function test_lock_screen_modal_and_session_lifetime_attribute_are_present_for_authenticated_users(): void
    {
        AppSetting::set('session_lifetime', '45', 'security');

        $user = User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);
        $user->assignRole('user');

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('id="kt_modal_lock_screen"', false);
        $response->assertSee('data-session-lifetime="45"', false);
        $response->assertSee('data-user-auth="1"', false);
        $response->assertSee('Budi Santoso');
        $response->assertSee('budi@example.com');
        $response->assertSee('assets/js/custom/lock-screen.js');
    }

    public function test_lock_screen_settings_can_be_saved_via_app_fiturs_controller(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->postJson('/appsupport/app-fiturs/settings', [
            'session_lifetime' => '30',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertEquals('30', AppSetting::get('session_lifetime'));
    }
}
