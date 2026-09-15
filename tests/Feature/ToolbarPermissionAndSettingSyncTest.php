<?php

namespace Tests\Feature;

use App\Models\AppSetting;
use App\Models\User;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ToolbarPermissionAndSettingSyncTest extends TestCase
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

    public function test_guest_is_blocked_from_theme_version_and_icon_style_switch(): void
    {
        $themeResponse = $this->get('/theme/version/v2');
        $themeResponse->assertRedirect(route('login'));

        $iconResponse = $this->get('/icon-style/switch/solid');
        $iconResponse->assertRedirect(route('login'));

        $frontpageResponse = $this->get('/frontpage/switch/education');
        $frontpageResponse->assertRedirect(route('login'));
    }

    public function test_non_admin_user_is_forbidden_from_theme_version_and_icon_style_switch(): void
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $themeResponse = $this->actingAs($user)->get('/theme/version/v2');
        $themeResponse->assertStatus(403);

        $iconResponse = $this->actingAs($user)->get('/icon-style/switch/solid');
        $iconResponse->assertStatus(403);

        $frontpageResponse = $this->actingAs($user)->get('/frontpage/switch/education');
        $frontpageResponse->assertStatus(403);
    }

    public function test_admin_switching_theme_version_updates_app_settings(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/theme/version/v2');
        $response->assertStatus(302);
        $response->assertSessionHas('theme_version', 'v2');

        $this->assertEquals('v2', AppSetting::get('default_theme_version'));
    }

    public function test_admin_switching_frontpage_updates_app_settings(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/frontpage/switch/education');
        $response->assertStatus(302);
        $response->assertSessionHas('frontpage', 'education');

        $this->assertEquals('education', AppSetting::get('default_frontpage'));
    }

    public function test_master_switching_icon_style_updates_app_settings_and_returns_json(): void
    {
        $master = User::factory()->create();
        $master->assignRole('master');

        $response = $this->actingAs($master)->getJson('/icon-style/switch/outline');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'style' => 'outline',
        ]);
        $response->assertSessionHas('kt_icon_style', 'outline');

        $this->assertEquals('outline', AppSetting::get('default_icon_style'));
    }

    public function test_language_switch_is_personal_and_does_not_modify_default_language_in_database(): void
    {
        $initialDefaultLang = AppSetting::get('default_language', 'id');

        $user = User::factory()->create();
        $user->assignRole('siswa');

        $response = $this->actingAs($user)->getJson('/lang/en');
        $response->assertStatus(200);
        $response->assertSessionHas('locale', 'en');

        // Global default in DB must remain unchanged
        $this->assertEquals($initialDefaultLang, AppSetting::get('default_language'));
    }

    public function test_non_admin_does_not_see_icon_style_or_theme_version_tools_in_header(): void
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);

        // Language tool is visible
        $response->assertSee('tool_language');

        // Developer/system tools are hidden for non-admin
        $response->assertDontSee('tool_icon_style');
        $response->assertDontSee('tool_theme_version');
        $response->assertDontSee('tool_frontpages');
    }

    public function test_admin_sees_developer_tools_in_header(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/dashboard');
        $response->assertStatus(200);

        $response->assertSee('tool_language');
        $response->assertSee('tool_icon_style');
        $response->assertSee('tool_theme_version');
        $response->assertSee('tool_frontpages');
    }

    public function test_non_admin_does_not_see_template_topbar_menus_in_v2(): void
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $response = $this
            ->actingAs($user)
            ->withSession(['theme_version' => 'v2'])
            ->get('/dashboard');

        $response->assertStatus(200);
        $response->assertDontSee('data-kt-feature-menu="top_menu_dashboard"', false);
        $response->assertDontSee('data-kt-feature-menu="top_menu_pages"', false);
        $response->assertDontSee('data-kt-feature-menu="top_menu_apps"', false);
        $response->assertDontSee('data-kt-feature-menu="top_menu_demo"', false);
        $response->assertDontSee('data-kt-feature-menu="top_menu_help"', false);
    }

    public function test_app_fiturs_settings_page_reflects_updated_settings_from_toolbar_switches(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Initial settings check
        $response = $this->actingAs($admin)->get('/appsupport/app-fiturs');
        $response->assertStatus(200);
        $response->assertSee('value="duotone" checked', false);
        $response->assertSee('value="v1" checked', false);
        $response->assertSee('value="landing" checked', false);

        // Switch icon style via toolbar route
        $this->actingAs($admin)->getJson('/icon-style/switch/outline');
        // Switch theme version via toolbar route
        $this->actingAs($admin)->get('/theme/version/v2');
        // Switch frontpage via toolbar route
        $this->actingAs($admin)->get('/frontpage/switch/education');

        // Re-open settings tab on app-fiturs page
        $newResponse = $this->actingAs($admin)->get('/appsupport/app-fiturs');
        $newResponse->assertStatus(200);
        $newResponse->assertSee('value="outline" checked', false);
        $newResponse->assertSee('value="v2" checked', false);
        $newResponse->assertSee('value="education" checked', false);
    }

    public function test_save_settings_from_app_fiturs_updates_database_and_session(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $saveResponse = $this->actingAs($admin)->postJson('/appsupport/app-fiturs/settings', [
            'default_icon_style' => 'solid',
            'default_theme_version' => 'v2',
            'default_frontpage' => 'education',
            'default_language' => 'en',
            'enable_registration' => '0',
            'session_lifetime' => '60',
        ]);

        $saveResponse->assertStatus(200);
        $saveResponse->assertJson(['success' => true]);

        $this->assertEquals('solid', AppSetting::get('default_icon_style'));
        $this->assertEquals('v2', AppSetting::get('default_theme_version'));
        $this->assertEquals('education', AppSetting::get('default_frontpage'));
        $this->assertEquals('en', AppSetting::get('default_language'));
        $this->assertEquals('0', AppSetting::get('enable_registration'));
        $this->assertEquals('60', AppSetting::get('session_lifetime'));

        $this->assertEquals('v2', \App\Support\ThemeVersion::default());
        $this->assertEquals('education', \App\Support\Frontpage::default());
    }
}
