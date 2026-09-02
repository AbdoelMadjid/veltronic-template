<?php

namespace Tests\Feature;

use Tests\TestCase;

class ThemeVersionRenderTest extends TestCase
{
    public function test_dashboard_renders_v1_layout_when_theme_version_is_v1(): void
    {
        $response = $this
            ->withoutMiddleware()
            ->withSession(['theme_version' => 'v1'])
            ->get('/dashboard');

        $response->assertOk();
        $response->assertSee('id="kt_app_wrapper"', false);
        $response->assertDontSee('id="kt_wrapper"', false);
    }

    public function test_dashboard_renders_v2_layout_when_theme_version_is_v2(): void
    {
        $response = $this
            ->withoutMiddleware()
            ->withSession(['theme_version' => 'v2'])
            ->get('/dashboard');

        $response->assertOk();
        $response->assertSee('id="kt_wrapper"', false);
        $response->assertDontSee('id="kt_app_wrapper"', false);
    }

    public function test_file_manager_files_renders_v1_layout_when_theme_version_is_v1(): void
    {
        $response = $this
            ->withoutMiddleware()
            ->withSession(['theme_version' => 'v1'])
            ->get('/apps/file-manager/files');

        $response->assertOk();
        $response->assertSee('id="kt_app_wrapper"', false);
        $response->assertDontSee('id="kt_wrapper"', false);
    }

    public function test_file_manager_files_renders_v2_layout_when_theme_version_is_v2(): void
    {
        $response = $this
            ->withoutMiddleware()
            ->withSession(['theme_version' => 'v2'])
            ->get('/apps/file-manager/files');

        $response->assertOk();
        $response->assertSee('id="kt_wrapper"', false);
        $response->assertDontSee('id="kt_app_wrapper"', false);
    }

    public function test_login_page_can_still_render_under_v1_and_v2_sessions(): void
    {
        $responseV1 = $this
            ->withSession(['theme_version' => 'v1'])
            ->get('/login');

        $responseV1->assertOk();
        $responseV1->assertSee('id="kt_app_root"', false);

        $responseV2 = $this
            ->withSession(['theme_version' => 'v2'])
            ->get('/login');

        $responseV2->assertOk();
        $responseV2->assertSee('id="kt_app_root"', false);
    }
}
