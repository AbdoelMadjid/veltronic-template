<?php

namespace Database\Seeders;

use App\Models\AppSupport\AppSetting;
use Illuminate\Database\Seeder;

class AppProfilSeeder extends Seeder
{
    /**
     * Run the database seeds for App Profile (Meta, Logo, and Footer).
     */
    public function run(): void
    {
        $profileSettings = [
            // Identitas & Meta SEO
            [
                'key' => 'app_name',
                'value' => 'Veltronic Template',
                'group' => 'meta',
                'type' => 'string',
                'description' => 'Nama utama aplikasi dashboard sistem',
            ],
            [
                'key' => 'app_tagline',
                'value' => 'Modern Metronic 8.3.2 Admin Dashboard',
                'group' => 'meta',
                'type' => 'string',
                'description' => 'Tagline / slogan deskriptif aplikasi dashboard',
            ],
            [
                'key' => 'app_version',
                'value' => 'v1.0.0',
                'group' => 'meta',
                'type' => 'string',
                'description' => 'Versi rilis aktif dashboard aplikasi',
            ],
            [
                'key' => 'meta_description',
                'value' => 'Sistem dashboard administrasi modern dengan Metronic 8.3.2 dan Laravel 12/13.',
                'group' => 'meta',
                'type' => 'string',
                'description' => 'Deskripsi meta SEO untuk mesin pencari',
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'laravel, metronic, dashboard, veltronic, admin template, bootstrap 5',
                'group' => 'meta',
                'type' => 'string',
                'description' => 'Kata kunci penelusuran meta SEO',
            ],
            [
                'key' => 'meta_author',
                'value' => 'Veltronic Team',
                'group' => 'meta',
                'type' => 'string',
                'description' => 'Penulis / author sistem aplikasi',
            ],
            [
                'key' => 'og_title',
                'value' => 'Veltronic - Metronic 8.3.2 Admin Dashboard',
                'group' => 'meta',
                'type' => 'string',
                'description' => 'Judul Open Graph untuk pratinjau media sosial',
            ],
            [
                'key' => 'og_site_name',
                'value' => 'Veltronic',
                'group' => 'meta',
                'type' => 'string',
                'description' => 'Nama situs Open Graph',
            ],

            // Logo & Favicon Dashboard
            [
                'key' => 'app_logo_default',
                'value' => 'media/logos/default.svg',
                'group' => 'logo',
                'type' => 'string',
                'description' => 'Logo dashboard mode terang (Light sidebar/header)',
            ],
            [
                'key' => 'app_logo_dark',
                'value' => 'media/logos/default-dark.svg',
                'group' => 'logo',
                'type' => 'string',
                'description' => 'Logo dashboard mode gelap (Dark sidebar/header)',
            ],
            [
                'key' => 'app_logo_minimize',
                'value' => 'media/logos/default-small.svg',
                'group' => 'logo',
                'type' => 'string',
                'description' => 'Icon logo mini saat sidebar diminimize',
            ],
            [
                'key' => 'app_favicon',
                'value' => 'media/logos/favicon.ico',
                'group' => 'logo',
                'type' => 'string',
                'description' => 'Favicon icon tab browser aplikasi',
            ],

            // Footer Dashboard
            [
                'key' => 'footer_copyright_year',
                'value' => '2025',
                'group' => 'footer',
                'type' => 'string',
                'description' => 'Tahun hak cipta pada footer dashboard',
            ],
            [
                'key' => 'footer_copyright_text',
                'value' => 'AbdoelMadjid',
                'group' => 'footer',
                'type' => 'string',
                'description' => 'Teks pemilik hak cipta pada footer dashboard',
            ],
            [
                'key' => 'footer_copyright_url',
                'value' => 'https://github.com/AbdoelMadjid/veltronic-template',
                'group' => 'footer',
                'type' => 'string',
                'description' => 'Tautan URL pemilik hak cipta pada footer dashboard',
            ],
            [
                'key' => 'footer_show_system_info',
                'value' => '1',
                'group' => 'footer',
                'type' => 'boolean',
                'description' => 'Tampilkan status versi Laravel, PHP, dan MySQL di footer',
            ],
            [
                'key' => 'footer_links',
                'value' => '[{"title":"About","url":"https:\\/\\/keenthemes.com","target":"_blank"},{"title":"Support","url":"https:\\/\\/devs.keenthemes.com","target":"_blank"},{"title":"Purchase","url":"https:\\/\\/1.envato.market\\/EA4JP","target":"_blank"}]',
                'group' => 'footer',
                'type' => 'json',
                'description' => 'Daftar tautan menu navigasi cepat pada footer dashboard',
            ],
        ];

        foreach ($profileSettings as $setting) {
            AppSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        AppSetting::clearCache();
    }
}
