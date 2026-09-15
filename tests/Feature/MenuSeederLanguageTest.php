<?php

namespace Tests\Feature;

use App\Models\UserManagement\User;
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

    public function test_help_pemrograman_views_render_successfully(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $responseChangelog = $this->actingAs($admin)
            ->get('/help/pemrograman/changelog');
        $responseChangelog->assertStatus(200);
        $responseChangelog->assertSee('Riwayat Versi');
        $responseChangelog->assertSee('v1.12.1');

        $responseOverview = $this->actingAs($admin)
            ->get('/help/pemrograman/overview');
        $responseOverview->assertStatus(200);

        $responseSkema = $this->actingAs($admin)
            ->get('/help/pemrograman/skema/page-title-dan-breadcrumbs');
        $responseSkema->assertStatus(200);

        $responseOperasional = $this->actingAs($admin)
            ->get('/help/pemrograman/operasional/panduan-page-title-dan-breadcrumbs');
        $responseOperasional->assertStatus(200);
    }

    public function test_widgets_cards_renders_bilingual_title_and_clean_breadcrumbs(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Test Indonesian
        $responseId = $this->actingAs($admin)
            ->withSession(['locale' => 'id'])
            ->get('/pages/widgets/cards');

        $responseId->assertStatus(200);
        $responseId->assertSee('Kartu');
        $responseId->assertSee('Beranda');
        $responseId->assertSee('Halaman');
        $responseId->assertSee('Widget');

        // Test English
        $responseEn = $this->actingAs($admin)
            ->withSession(['locale' => 'en'])
            ->get('/pages/widgets/cards');

        $responseEn->assertStatus(200);
        $responseEn->assertSee('Cards');
        $responseEn->assertSee('Home');
        $responseEn->assertSee('Pages');
        $responseEn->assertSee('Widgets');
    }

    public function test_widgets_calendar_renders_bilingual_title_and_clean_breadcrumbs(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Test Indonesian
        $responseId = $this->actingAs($admin)
            ->withSession(['locale' => 'id'])
            ->get('/pages/widgets/calendar');

        $responseId->assertStatus(200);
        $responseId->assertSee('Kalender');
        $responseId->assertSee('Beranda');
        $responseId->assertSee('Halaman');
        $responseId->assertSee('Widget');

        // Test English
        $responseEn = $this->actingAs($admin)
            ->withSession(['locale' => 'en'])
            ->get('/pages/widgets/calendar');

        $responseEn->assertStatus(200);
        $responseEn->assertSee('Calendar');
        $responseEn->assertSee('Home');
        $responseEn->assertSee('Pages');
        $responseEn->assertSee('Widgets');
    }

    public function test_icon_style_persists_from_cookie_without_reverting(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Test outline icon style switch
        $this->actingAs($admin)->getJson('/icon-style/switch/outline');
        $responseOutline = $this->actingAs($admin)->get('/dashboard');
        $responseOutline->assertStatus(200);
        $responseOutline->assertSee('data-kt-icon-style="outline"', false);

        // Test solid icon style switch
        $this->actingAs($admin)->getJson('/icon-style/switch/solid');
        $responseSolid = $this->actingAs($admin)->get('/dashboard');
        $responseSolid->assertStatus(200);
        $responseSolid->assertSee('data-kt-icon-style="solid"', false);
    }
}
