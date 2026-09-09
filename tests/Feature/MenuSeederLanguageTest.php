<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MenuSeederLanguageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'master', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
    }

    public function test_profil_pengguna_renders_in_english_when_locale_is_en(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)
            ->withSession(['locale' => 'en'])
            ->get('/profil/profil-pengguna');

        $response->assertStatus(200);
        $response->assertSee('User Profile');
        $response->assertSee('Master Data');
    }

    public function test_profil_pengguna_renders_in_indonesian_when_locale_is_id(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)
            ->withSession(['locale' => 'id'])
            ->get('/profil/profil-pengguna');

        $response->assertStatus(200);
        $response->assertSee('Profil Pengguna');
    }

    public function test_app_fiturs_renders_in_english_and_indonesian(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Test English
        $responseEn = $this->actingAs($admin)
            ->withSession(['locale' => 'en'])
            ->get('/appsupport/app-fiturs');

        $responseEn->assertStatus(200);
        $responseEn->assertSee('App Support');
        $responseEn->assertSee('App Features');

        // Test Indonesian
        $responseId = $this->actingAs($admin)
            ->withSession(['locale' => 'id'])
            ->get('/appsupport/app-fiturs');

        $responseId->assertStatus(200);
        $responseId->assertSee('Dukungan Aplikasi');
        $responseId->assertSee('Fitur Aplikasi');
    }

    public function test_menu_management_renders_in_english_and_indonesian(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Test English
        $responseEn = $this->actingAs($admin)
            ->withSession(['locale' => 'en'])
            ->get('/appsupport/menu');

        $responseEn->assertStatus(200);
        $responseEn->assertSee('App Support');
        $responseEn->assertSee('Master Data');
        $responseEn->assertSee('Menu');

        // Test Indonesian
        $responseId = $this->actingAs($admin)
            ->withSession(['locale' => 'id'])
            ->get('/appsupport/menu');

        $responseId->assertStatus(200);
        $responseId->assertSee('Dukungan Aplikasi');
        $responseId->assertSee('Master Data');
        $responseId->assertSee('Menu');
    }

    public function test_get_page_breadcrumbs_helper_returns_ancestors_only(): void
    {
        app()->setLocale('en');
        $breadcrumbsMenuEn = getPageBreadcrumbs('appsupport.menu');
        $this->assertEquals(['Master Data', 'App Support'], $breadcrumbsMenuEn);

        app()->setLocale('id');
        $breadcrumbsMenuId = getPageBreadcrumbs('appsupport.menu');
        $this->assertEquals(['Master Data', 'Dukungan Aplikasi'], $breadcrumbsMenuId);

        app()->setLocale('en');
        $breadcrumbsProfilEn = getPageBreadcrumbs('profil.profil-pengguna');
        $this->assertEquals(['Master Data'], $breadcrumbsProfilEn);
    }
}
