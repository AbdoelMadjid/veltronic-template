<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Appearance & Defaults
            [
                'key' => 'default_icon_style',
                'value' => 'duotone',
                'group' => 'appearance',
                'type' => 'string',
                'description' => 'Gaya default icon KeenIcons (duotone, solid, outline)',
            ],
            [
                'key' => 'default_language',
                'value' => 'id',
                'group' => 'appearance',
                'type' => 'string',
                'description' => 'Bahasa default aplikasi (id = Bahasa Indonesia, en = English)',
            ],
            [
                'key' => 'default_theme_version',
                'value' => 'v1',
                'group' => 'appearance',
                'type' => 'string',
                'description' => 'Versi tata letak tema default (v1 = Sidebar Classic, v2 = Header Navbar)',
            ],
            [
                'key' => 'default_frontpage',
                'value' => 'landing',
                'group' => 'appearance',
                'type' => 'string',
                'description' => 'Halaman depan default (landing = Metronic Landing, education = Education Portal)',
            ],

            // Security & Auth Settings
            [
                'key' => 'enable_registration',
                'value' => '1',
                'group' => 'security',
                'type' => 'boolean',
                'description' => 'Izinkan pendaftaran akun baru oleh publik',
            ],
            [
                'key' => 'session_lifetime',
                'value' => '120',
                'group' => 'security',
                'type' => 'integer',
                'description' => 'Durasi masa aktif sesi pengguna dalam hitungan menit',
            ],
        ];

        foreach ($settings as $setting) {
            AppSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
