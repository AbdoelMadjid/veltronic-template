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
