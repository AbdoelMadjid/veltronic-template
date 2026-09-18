<?php

namespace Database\Seeders;

use App\Models\AppSupport\AppShortcut;
use Illuminate\Database\Seeder;

class AppShortcutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shortcuts = [
            [
                'name' => 'Toggle Menu Template di Sidebar',
                'key' => 'm',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'toggle_sidebar_menus',
                'action_target' => null,
                'roles' => ['master', 'admin'],
                'description' => 'Menampilkan atau menyembunyikan seluruh section menu template bawaan di sidebar (Dashboards, Demos, Pages, Apps, Layouts, Help) khusus role Master dan Admin.',
                'is_enabled' => true,
                'order' => 1,
            ],
            [
                'name' => 'Toggle Fitur & Tools di Topbar Navbar',
                'key' => 't',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'toggle_topbar_tools',
                'action_target' => 'topbar_tools',
                'roles' => ['master', 'admin'],
                'description' => 'Menampilkan atau menyembunyikan seluruh fitur dan tools di topbar navbar (Pencarian, Notifikasi, Chat, Tema, Bahasa, Gaya Ikon, dll.) khusus role Master dan Admin.',
                'is_enabled' => true,
                'order' => 2,
            ],
            [
                'name' => 'Toggle Menu Utama di Topbar Header',
                'key' => 'h',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'toggle_topbar_menus',
                'action_target' => 'topbar_menus',
                'roles' => ['master', 'admin'],
                'description' => 'Menampilkan atau menyembunyikan seluruh menu utama di topbar header (Dashboards, Pages, Apps, Layouts, Demo, Help) khusus role Master dan Admin.',
                'is_enabled' => true,
                'order' => 3,
            ],
            [
                'name' => 'Pencarian Cepat Global (Global Search)',
                'key' => 'f',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'search',
                'action_target' => null,
                'roles' => null, // Semua role
                'description' => 'Membuka modal pencarian global topbar atau mengarahkan kursor ke kotak pencarian menu sidebar.',
                'is_enabled' => true,
                'order' => 4,
            ],
            [
                'name' => 'Beralih Mode Gelap & Terang',
                'key' => 'b',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'theme_mode',
                'action_target' => null,
                'roles' => null, // Semua role
                'description' => 'Mengalihkan tema antarmuka secara instan antara tema Gelap (Dark Mode) dan Terang (Light Mode).',
                'is_enabled' => true,
                'order' => 5,
            ],
            [
                'name' => 'Kunci Layar Pengguna (Lock Screen)',
                'key' => 'l',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'lock_screen',
                'action_target' => null,
                'roles' => null, // Semua role
                'description' => 'Mengunci sesi aktif dashboard seketika demi proteksi keamanan saat meninggalkan workstation.',
                'is_enabled' => true,
                'order' => 6,
            ],
            [
                'name' => 'Gaya Ikon: Duotone',
                'key' => 'd',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'icon_style',
                'action_target' => 'duotone',
                'roles' => null, // Semua role
                'description' => 'Mengubah gaya seluruh ikon sistem menjadi Duotone (kombinasi multi-tone visual) secara realtime.',
                'is_enabled' => true,
                'order' => 7,
            ],
            [
                'name' => 'Gaya Ikon: Solid',
                'key' => 's',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'icon_style',
                'action_target' => 'solid',
                'roles' => null, // Semua role
                'description' => 'Mengubah gaya seluruh ikon sistem menjadi Solid (terisi penuh / bold visual) secara realtime.',
                'is_enabled' => true,
                'order' => 8,
            ],
            [
                'name' => 'Gaya Ikon: Outline',
                'key' => 'o',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'icon_style',
                'action_target' => 'outline',
                'roles' => null, // Semua role
                'description' => 'Mengubah gaya seluruh ikon sistem menjadi Outline (garis tepi / line visual) secara realtime.',
                'is_enabled' => true,
                'order' => 9,
            ],
            [
                'name' => 'Pilihan Bahasa: Indonesia',
                'key' => 'i',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'switch_language',
                'action_target' => 'id',
                'roles' => null, // Semua role
                'description' => 'Mengubah bahasa aplikasi menjadi Bahasa Indonesia secara instan.',
                'is_enabled' => true,
                'order' => 10,
            ],
            [
                'name' => 'Pilihan Bahasa: English',
                'key' => 'e',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'switch_language',
                'action_target' => 'en',
                'roles' => null, // Semua role
                'description' => 'Mengubah bahasa aplikasi menjadi Bahasa Inggris (English) secara instan.',
                'is_enabled' => true,
                'order' => 11,
            ],
            [
                'name' => 'Pilihan Versi: Layout Versi 1',
                'key' => '1',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'switch_version',
                'action_target' => 'v1',
                'roles' => ['master', 'admin'],
                'description' => 'Beralih ke tata letak tampilan sistem Layout Versi 1 (V1) khusus Master dan Admin.',
                'is_enabled' => true,
                'order' => 12,
            ],
            [
                'name' => 'Pilihan Versi: Layout Versi 2',
                'key' => '2',
                'ctrl' => true,
                'alt' => true,
                'shift' => false,
                'meta' => false,
                'action_type' => 'switch_version',
                'action_target' => 'v2',
                'roles' => ['master', 'admin'],
                'description' => 'Beralih ke tata letak tampilan sistem Layout Versi 2 (V2) khusus Master dan Admin.',
                'is_enabled' => true,
                'order' => 13,
            ],
        ];

        foreach ($shortcuts as $item) {
            AppShortcut::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}
