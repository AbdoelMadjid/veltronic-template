<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ToolbarDateWidgetTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);
        $this->seed(AppSettingSeeder::class);
    }

    public function test_to_hijriah_with_and_without_islamic_day(): void
    {
        // 2026-09-15 is Tuesday, 2 Rabi' al-Thani 1448 AH / 2 Rabiul Akhir 1448 H
        $date = Carbon::create(2026, 9, 15, 12, 0, 0, 'Asia/Jakarta');

        $hijriIdWithoutDay = toHijriah($date, 'id', false);
        $this->assertEquals('2 Rabiul Akhir 1448 H', $hijriIdWithoutDay);

        $hijriEnWithoutDay = toHijriah($date, 'en', false);
        $this->assertEquals("2 Rabi' al-Thani 1448 AH", $hijriEnWithoutDay);

        $hijriIdWithDay = toHijriah($date, 'id', true);
        $this->assertEquals('Ats-Tsulatsa, 2 Rabiul Akhir 1448 H', $hijriIdWithDay);

        $hijriEnWithDay = toHijriah($date, 'en', true);
        $this->assertEquals("al-Thulatha', 2 Rabi' al-Thani 1448 AH", $hijriEnWithDay);
    }

    public function test_render_date_contains_two_lines_and_islamic_day(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 9, 15, 12, 0, 0, 'Asia/Jakarta'));

        $html = renderDate([], 'en');

        // Check English line 1 (Gregorian)
        $this->assertStringContainsString('Tuesday, 15 September 2026 AD', $html);
        // Check English line 2 (Hijri with Islamic day)
        $this->assertStringContainsString("al-Thulatha', 2 Rabi' al-Thani 1448 AH", $html);

        $htmlId = renderDate([], 'id');

        // Check Indonesian line 1 (Gregorian)
        $this->assertStringContainsString('Selasa, 15 September 2026 M', $htmlId);
        // Check Indonesian line 2 (Hijri with Islamic day)
        $this->assertStringContainsString('Ats-Tsulatsa, 2 Rabiul Akhir 1448 H', $htmlId);

        // Check plain tooltip helper
        $plainEn = renderDatePlain([], 'en');
        $this->assertEquals("Tuesday, 15 September 2026 AD • al-Thulatha', 2 Rabi' al-Thani 1448 AH", $plainEn);

        $plainId = renderDatePlain([], 'id');
        $this->assertEquals('Selasa, 15 September 2026 M • Ats-Tsulatsa, 2 Rabiul Akhir 1448 H', $plainId);

        Carbon::setTestNow();
    }

    public function test_toolbar_renders_dual_line_date_widget(): void
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('id="date-display"', false);
        $response->assertSee('ki-calendar-8', false);
        $response->assertSee('data-kt-lang-id=', false);
        $response->assertSee('data-kt-lang-en=', false);
        $response->assertSee('data-kt-lang-title-id=', false);
        $response->assertSee('data-kt-lang-title-en=', false);
    }
}
