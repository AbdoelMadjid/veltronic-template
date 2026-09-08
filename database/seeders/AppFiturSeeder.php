<?php

namespace Database\Seeders;

use App\Models\AppFitur;
use Illuminate\Database\Seeder;

class AppFiturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fiturs = [
            // Topbar Tools (Action Icons & Modals)
            [
                'key' => 'tool_search',
                'name' => 'Search Icon & Modal',
                'category' => 'topbar_tools',
                'description' => 'Pencarian cepat global pada topbar header',
                'icon' => 'ki-magnifier',
                'is_enabled' => true,
                'order' => 1,
            ],
            [
                'key' => 'tool_activities',
                'name' => 'Activities / Messages Drawer',
                'category' => 'topbar_tools',
                'description' => 'Drawer panel aktivitas dan log interaksi',
                'icon' => 'ki-messages',
                'is_enabled' => false,
                'order' => 2,
            ],
            [
                'key' => 'tool_notifications',
                'name' => 'Notifications Menu Dropdown',
                'category' => 'topbar_tools',
                'description' => 'Menu dropdown notifikasi aktivitas sistem',
                'icon' => 'ki-notification-status',
                'is_enabled' => true,
                'order' => 3,
            ],
            [
                'key' => 'tool_chat',
                'name' => 'Quick Chat Drawer',
                'category' => 'topbar_tools',
                'description' => 'Drawer interaksi perpesanan cepat langsung',
                'icon' => 'ki-message-text-2',
                'is_enabled' => true,
                'order' => 4,
            ],
            [
                'key' => 'tool_my_apps',
                'name' => 'My Apps Quick Links',
                'category' => 'topbar_tools',
                'description' => 'Menu navigasi cepat modul & aplikasi eksternal',
                'icon' => 'ki-element-11',
                'is_enabled' => false,
                'order' => 5,
            ],
            [
                'key' => 'tool_theme_mode',
                'name' => 'Theme Mode Switcher',
                'category' => 'topbar_tools',
                'description' => 'Pengganti mode gelap & terang instan',
                'icon' => 'ki-night-day',
                'is_enabled' => false,
                'order' => 6,
            ],
            [
                'key' => 'tool_icon_style',
                'name' => 'Icon Style Switcher',
                'category' => 'topbar_tools',
                'description' => 'Pengganti variasi ikon Duotone / Solid / Outline',
                'icon' => 'ki-chart',
                'is_enabled' => false,
                'order' => 7,
            ],
            [
                'key' => 'tool_language',
                'name' => 'Language Switcher (ID/EN)',
                'category' => 'topbar_tools',
                'description' => 'Pengganti bahasa antarmuka ID/EN',
                'icon' => 'ki-flag',
                'is_enabled' => true,
                'order' => 8,
            ],
            [
                'key' => 'tool_theme_version',
                'name' => 'Theme Version Switcher',
                'category' => 'topbar_tools',
                'description' => 'Pengalih varian tema Metronic',
                'icon' => 'ki-cube-2',
                'is_enabled' => false,
                'order' => 9,
            ],
            [
                'key' => 'tool_frontpages',
                'name' => 'Frontpages & Landing Switcher',
                'category' => 'topbar_tools',
                'description' => 'Menu cepat ke landing page & template publik',
                'icon' => 'ki-screen',
                'is_enabled' => false,
                'order' => 10,
            ],

            // Topbar Header Menus
            [
                'key' => 'top_menu_dashboard',
                'name' => 'Menu Header: Dashboard',
                'category' => 'topbar_menus',
                'description' => 'Navigasi megamenu dashboard pada header atas',
                'icon' => 'ki-element-11',
                'is_enabled' => false,
                'order' => 11,
            ],
            [
                'key' => 'top_menu_pages',
                'name' => 'Menu Header: Pages',
                'category' => 'topbar_menus',
                'description' => 'Megamenu kumpulan halaman pages pada header',
                'icon' => 'ki-document',
                'is_enabled' => false,
                'order' => 12,
            ],
            [
                'key' => 'top_menu_apps',
                'name' => 'Menu Header: Apps',
                'category' => 'topbar_menus',
                'description' => 'Dropdown modul aplikasi fungsional pada header',
                'icon' => 'ki-abstract-26',
                'is_enabled' => false,
                'order' => 13,
            ],
            [
                'key' => 'top_menu_layouts',
                'name' => 'Menu Header: Layouts',
                'category' => 'topbar_menus',
                'description' => 'Koleksi opsi tata letak layout pada header',
                'icon' => 'ki-grid-2',
                'is_enabled' => false,
                'order' => 14,
            ],
            [
                'key' => 'top_menu_demo',
                'name' => 'Menu Header: Demo',
                'category' => 'topbar_menus',
                'description' => 'Koleksi demo tampilan dan widget template',
                'icon' => 'ki-eye',
                'is_enabled' => false,
                'order' => 15,
            ],
            [
                'key' => 'top_menu_help',
                'name' => 'Menu Header: Help',
                'category' => 'topbar_menus',
                'description' => 'Pusat dokumentasi dan bantuan teknis pada header',
                'icon' => 'ki-information-2',
                'is_enabled' => false,
                'order' => 16,
            ],

            // Sidebar Template Menus
            [
                'key' => 'side_menu_dashboard',
                'name' => 'Sidebar: Section Dashboards',
                'category' => 'sidebar_menus',
                'description' => 'Kategori dan submenu varian dashboard di sidebar',
                'icon' => 'ki-screen',
                'is_enabled' => false,
                'order' => 17,
            ],
            [
                'key' => 'side_menu_demo',
                'name' => 'Sidebar: Section Demos',
                'category' => 'sidebar_menus',
                'description' => 'Koleksi demo komponen dan widgets di sidebar',
                'icon' => 'ki-code',
                'is_enabled' => false,
                'order' => 18,
            ],
            [
                'key' => 'side_menu_pages',
                'name' => 'Sidebar: Section Pages',
                'category' => 'sidebar_menus',
                'description' => 'Kategori menu halaman umum di sidebar',
                'icon' => 'ki-folder',
                'is_enabled' => false,
                'order' => 19,
            ],
            [
                'key' => 'side_menu_apps',
                'name' => 'Sidebar: Section Apps',
                'category' => 'sidebar_menus',
                'description' => 'Kategori menu aplikasi terintegrasi di sidebar',
                'icon' => 'ki-abstract-26',
                'is_enabled' => false,
                'order' => 20,
            ],
            [
                'key' => 'side_menu_layouts',
                'name' => 'Sidebar: Section Layouts',
                'category' => 'sidebar_menus',
                'description' => 'Kategori opsi layout dan tata letak di sidebar',
                'icon' => 'ki-cube-3',
                'is_enabled' => false,
                'order' => 21,
            ],
            [
                'key' => 'side_menu_help',
                'name' => 'Sidebar: Section Help',
                'category' => 'sidebar_menus',
                'description' => 'Kategori panduan dan dokumentasi di sidebar',
                'icon' => 'ki-question-2',
                'is_enabled' => false,
                'order' => 22,
            ],
        ];

        foreach ($fiturs as $fitur) {
            AppFitur::updateOrCreate(
                ['key' => $fitur['key']],
                $fitur
            );
        }

        AppFitur::clearCache();
    }
}
