<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            AppFiturSeeder::class,
            AppSettingSeeder::class,
        ]);

        if (class_exists(\App\Support\LanguageManager::class)) {
            \App\Support\LanguageManager::clearCache();
        }
        if (class_exists(\App\Models\AppSetting::class)) {
            \App\Models\AppSetting::clearCache();
        }
        if (class_exists(\Illuminate\Support\Facades\Cache::class)) {
            \Illuminate\Support\Facades\Cache::forget('kt_language_client_payload');
        }
    }
}
