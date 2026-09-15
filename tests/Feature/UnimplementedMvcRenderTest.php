<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnimplementedMvcRenderTest extends TestCase
{
    use RefreshDatabase;
    public function test_authenticated_user_accessing_unimplemented_mvc_renders_inside_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['theme_version' => 'v1'])
            ->get('/usermanagement/roles');

        $response->assertStatus(404);
        // Dashboard layout is present
        $response->assertSee('id="kt_app_wrapper"', false);
        // Title & breadcrumb & date are present
        $response->assertSee('Role', false);
        $response->assertSee('Manajemen Pengguna', false);
        $response->assertSee('ki-calendar-8', false);
        // MVC error card is present
        $response->assertSee('Modul MVC Belum Diimplementasikan', false);
        $response->assertSee('/usermanagement/roles', false);
    }

    public function test_authenticated_user_accessing_unimplemented_mvc_renders_inside_dashboard_v2(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['theme_version' => 'v2'])
            ->get('/usermanagement/roles');

        $response->assertStatus(404);
        // Dashboard v2 layout is present
        $response->assertSee('id="kt_wrapper"', false);
        // Title & breadcrumb & date are present
        $response->assertSee('Role', false);
        $response->assertSee('Manajemen Pengguna', false);
        $response->assertSee('ki-calendar-8', false);
        // MVC error card is present
        $response->assertSee('Modul MVC Belum Diimplementasikan', false);
        $response->assertSee('/usermanagement/roles', false);
    }

    public function test_v2_header_menu_does_not_open_internal_unimplemented_routes_in_blank(): void
    {
        $this->seed(\Database\Seeders\RoleSeeder::class);
        $this->seed(\Database\Seeders\MenuSeeder::class);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this
            ->actingAs($admin)
            ->withSession(['theme_version' => 'v2'])
            ->get('/dashboard');

        $response->assertStatus(200);
        // It should contain the internal url href
        $response->assertSee('/usermanagement/roles', false);
        // It should NOT have target="_blank" on the internal /usermanagement/roles menu link
        $response->assertDontSee('href="http://localhost/usermanagement/roles" target="_blank"', false);
        $response->assertDontSee('href="/usermanagement/roles" target="_blank"', false);
    }

    public function test_guest_user_accessing_nonexistent_page_renders_standalone_error(): void
    {
        $response = $this->get('/non-existent-page-xyz');

        $response->assertStatus(404);
        $response->assertDontSee('id="kt_app_wrapper"', false);
        $response->assertSee('Oops!', false);
    }
}

