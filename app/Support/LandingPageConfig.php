<?php

namespace App\Support;

use App\Models\AppSupport\AppSetting;
use Illuminate\Support\Facades\Cache;

class LandingPageConfig
{
    const CACHE_KEY = 'landing_page_config_cache';

    protected static ?array $cachedConfig = null;

    /**
     * Default core settings for Landing Page.
     */
    public static function defaults(): array
    {
        return [
            // Branding & Meta
            'landing_page_title' => 'Metronic - Template Admin Bootstrap #1 Terlaris di Dunia oleh KeenThemes',
            'landing_meta_description' => 'Tema Admin Bootstrap 5 tercanggih dengan 40 tata letak bawaan unik di Themeforest yang dipercaya oleh 100.000 pemula dan profesional.',
            'landing_meta_keywords' => 'metronic, bootstrap, bootstrap 5, angular, vuejs, react, laravel, starter kits, tema admin',
            'landing_og_title' => 'Metronic - Template Admin Bootstrap #1 Terlaris di Dunia',

            // Logo & Assets
            'landing_logo_light' => 'media/logos/landing.svg',
            'landing_logo_dark' => 'media/logos/landing-dark.svg',
            'landing_favicon' => 'media/logos/favicon.ico',

            // Hero Section
            'landing_hero_badge' => 'Metronic 8 v8.3.2',
            'landing_hero_title' => 'Bangun Solusi yang Luar Biasa',
            'landing_hero_with' => 'dengan',
            'landing_hero_highlight' => 'Tema Terbaik Sepanjang Masa',
            'landing_hero_cta_text' => 'Coba Metronic',
            'landing_hero_cta_url' => '/#pricing',
            'landing_hero_cta2_text' => 'Dokumentasi',
            'landing_hero_cta2_url' => 'https://preview.keenthemes.com/metronic8/laravel/documentation',
            'landing_show_clients' => '1',

            // Menu Items (JSON encoded)
            'landing_menu_items' => json_encode(self::defaultMenuItems()),

            // Sections list (JSON encoded)
            'landing_sections' => json_encode(self::defaultSections()),

            // Footer & Kontak
            'landing_footer_about' => 'Metronic 8 - Solusi template admin modern dan lengkap untuk akselerasi proyek web & aplikasi Anda bersama KeenThemes & Veltronic.',
            'landing_footer_copyright' => '2025 Keenthemes Inc. Veltronic Template.',
            'landing_footer_email' => 'support@keenthemes.com',
            'landing_footer_phone' => '+62 812-3456-7890',
            'landing_footer_address' => 'Jakarta, Indonesia',

            // Social links (JSON encoded)
            'landing_social_links' => json_encode(self::defaultSocialLinks()),

            // Footer navigation links (JSON encoded)
            'landing_footer_links' => json_encode(self::defaultFooterLinks()),
        ];
    }

    /**
     * Default navigation menu items for header with anchor targets.
     */
    public static function defaultMenuItems(): array
    {
        return [
            [
                'id' => 'menu-home',
                'title' => 'Beranda',
                'title_en' => 'Home',
                'target' => '#kt_body',
                'order' => 1,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'id' => 'menu-how-it-works',
                'title' => 'Cara Kerja',
                'title_en' => 'How It Works',
                'target' => '#how-it-works',
                'order' => 2,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'id' => 'menu-achievements',
                'title' => 'Pencapaian',
                'title_en' => 'Achievements',
                'target' => '#achievements',
                'order' => 3,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'id' => 'menu-team',
                'title' => 'Tim',
                'title_en' => 'Team',
                'target' => '#team',
                'order' => 4,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'id' => 'menu-portfolio',
                'title' => 'Portofolio',
                'title_en' => 'Portfolio',
                'target' => '#portfolio',
                'order' => 5,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'id' => 'menu-pricing',
                'title' => 'Harga',
                'title_en' => 'Pricing',
                'target' => '#pricing',
                'order' => 6,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'id' => 'menu-clients',
                'title' => 'Klien & Ulasan',
                'title_en' => 'Clients',
                'target' => '#clients',
                'order' => 7,
                'is_active' => true,
                'is_external' => false,
            ],
        ];
    }

    /**
     * Default sections with anchors and metadata.
     */
    public static function defaultSections(): array
    {
        return [
            [
                'id' => 'section-how-it-works',
                'anchor' => 'how-it-works',
                'name' => 'Cara Kerja (How It Works)',
                'title' => 'Cara Kerja Kami',
                'subtitle' => 'Hemat jutaan biaya dengan menggunakan satu alat untuk berbagai kebutuhan admin yang canggih dan bermanfaat',
                'icon' => 'ki-abstract-26',
                'badge' => 'Workflow',
                'order' => 1,
                'is_active' => true,
                'is_custom' => false,
                'content_html' => '',
            ],
            [
                'id' => 'section-achievements',
                'anchor' => 'achievements',
                'name' => 'Statistik & Pencapaian',
                'title' => 'Kami Membuat Segalanya Lebih Baik',
                'subtitle' => 'Hemat jutaan biaya dengan menggunakan satu alat untuk berbagai kebutuhan admin',
                'icon' => 'ki-chart-line',
                'badge' => 'Highlights',
                'order' => 2,
                'is_active' => true,
                'is_custom' => false,
                'content_html' => '',
            ],
            [
                'id' => 'section-team',
                'anchor' => 'team',
                'name' => 'Tim Pengembang & Pakar',
                'title' => 'Tim Hebat Kami',
                'subtitle' => 'Didukung oleh para insinyur perangkat lunak, desainer kreatif, dan arsitek sistem terkemuka',
                'icon' => 'ki-profile-user',
                'badge' => 'Leadership',
                'order' => 3,
                'is_active' => true,
                'is_custom' => false,
                'content_html' => '',
            ],
            [
                'id' => 'section-portfolio',
                'anchor' => 'portfolio',
                'name' => 'Portofolio & Showcase Proyek',
                'title' => 'Proyek Kami',
                'subtitle' => 'Desain web modern, aplikasi mobile responsif, dan solusi enterprise yang telah sukses kami luncurkan',
                'icon' => 'ki-element-11',
                'badge' => 'Showcase',
                'order' => 4,
                'is_active' => true,
                'is_custom' => false,
                'content_html' => '',
            ],
            [
                'id' => 'section-pricing',
                'anchor' => 'pricing',
                'name' => 'Paket & Biaya Langganan',
                'title' => 'Harga Transparan Memudahkan Anda',
                'subtitle' => 'Pilihan paket fleksibel untuk startup, bisnis berkembang, hingga korporasi enterprise skala besar',
                'icon' => 'ki-tag',
                'badge' => 'Pricing Plans',
                'order' => 5,
                'is_active' => true,
                'is_custom' => false,
                'content_html' => '',
            ],
            [
                'id' => 'section-clients',
                'anchor' => 'clients',
                'name' => 'Klien & Testimoni',
                'title' => 'Apa Kata Klien Kami',
                'subtitle' => 'Dipercaya oleh lebih dari 100.000 pengembang, agensi, dan perusahaan teknologi di seluruh dunia',
                'icon' => 'ki-message-text-2',
                'badge' => 'Testimonials',
                'order' => 6,
                'is_active' => true,
                'is_custom' => false,
                'content_html' => '',
            ],
            [
                'id' => 'section-cta',
                'anchor' => 'cta-contact',
                'name' => 'Panggilan Aksi (Call To Action)',
                'title' => 'Mulai Bersama Metronic Hari Ini',
                'subtitle' => 'Bergabunglah dengan komunitas profesional untuk tetap menjadi yang terdepan dalam akselerasi sistem',
                'icon' => 'ki-send',
                'badge' => 'Action',
                'order' => 7,
                'is_active' => true,
                'is_custom' => false,
                'content_html' => '',
            ],
        ];
    }

    /**
     * Default social links.
     */
    public static function defaultSocialLinks(): array
    {
        return [
            ['name' => 'Facebook', 'icon' => 'facebook', 'url' => 'https://facebook.com/keenthemes', 'is_active' => true],
            ['name' => 'Twitter / X', 'icon' => 'twitter', 'url' => 'https://twitter.com/keenthemes', 'is_active' => true],
            ['name' => 'Instagram', 'icon' => 'instagram', 'url' => 'https://instagram.com/keenthemes', 'is_active' => true],
            ['name' => 'GitHub', 'icon' => 'github', 'url' => 'https://github.com/AbdoelMadjid/veltronic-template', 'is_active' => true],
            ['name' => 'Dribbble', 'icon' => 'dribbble', 'url' => 'https://dribbble.com/keenthemes', 'is_active' => true],
        ];
    }

    /**
     * Default footer navigation links.
     */
    public static function defaultFooterLinks(): array
    {
        return [
            [
                'group' => 'Ekosistem',
                'links' => [
                    ['title' => 'Dokumentasi', 'url' => 'https://preview.keenthemes.com/metronic8/laravel/documentation', 'target' => '_blank'],
                    ['title' => 'Changelog', 'url' => '#', 'target' => '_self'],
                    ['title' => 'Tutorial Video', 'url' => '#', 'target' => '_self'],
                    ['title' => 'Forum Dukungan', 'url' => 'https://devs.keenthemes.com', 'target' => '_blank'],
                ],
            ],
            [
                'group' => 'Tautan Cepat',
                'links' => [
                    ['title' => 'Beranda', 'url' => '#kt_body', 'target' => '_self'],
                    ['title' => 'Cara Kerja', 'url' => '#how-it-works', 'target' => '_self'],
                    ['title' => 'Pencapaian', 'url' => '#achievements', 'target' => '_self'],
                    ['title' => 'Daftar Harga', 'url' => '#pricing', 'target' => '_self'],
                ],
            ],
            [
                'group' => 'Legalitas',
                'links' => [
                    ['title' => 'Ketentuan Lisensi', 'url' => 'https://1.envato.market/EA4JP', 'target' => '_blank'],
                    ['title' => 'Kebijakan Privasi', 'url' => '#', 'target' => '_self'],
                    ['title' => 'Syarat & Ketentuan', 'url' => '#', 'target' => '_self'],
                ],
            ],
        ];
    }

    /**
     * Clear config cache.
     */
    public static function clearCache(): void
    {
        self::$cachedConfig = null;
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Get all merged landing page configurations or a specific key.
     */
    public static function get(?string $key = null, $default = null)
    {
        if (self::$cachedConfig === null) {
            self::$cachedConfig = Cache::rememberForever(self::CACHE_KEY, function () {
                $defaults = self::defaults();
                try {
                    $keys = array_keys($defaults);
                    $dbSettings = AppSetting::whereIn('key', $keys)->pluck('value', 'key')->toArray();
                    return array_merge($defaults, $dbSettings);
                } catch (\Throwable $e) {
                    return $defaults;
                }
            });
        }

        if ($key === null) {
            return self::$cachedConfig;
        }

        return self::$cachedConfig[$key] ?? $default;
    }

    /**
     * Get parsed navigation menu items.
     *
     * @return array
     */
    public static function getMenuItems(): array
    {
        $raw = self::get('landing_menu_items');
        $items = [];
        if (!empty($raw)) {
            $items = is_array($raw) ? $raw : json_decode($raw, true);
        }

        if (!is_array($items) || empty($items)) {
            $items = self::defaultMenuItems();
        }

        usort($items, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        return $items;
    }

    /**
     * Get only active menu items.
     */
    public static function getActiveMenuItems(): array
    {
        $items = self::getMenuItems();
        return array_values(array_filter($items, fn($item) => !empty($item['is_active'])));
    }

    /**
     * Get parsed sections.
     *
     * @return array
     */
    public static function getSections(): array
    {
        $raw = self::get('landing_sections');
        $sections = [];
        if (!empty($raw)) {
            $sections = is_array($raw) ? $raw : json_decode($raw, true);
        }

        if (!is_array($sections) || empty($sections)) {
            $sections = self::defaultSections();
        }

        usort($sections, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        return $sections;
    }

    /**
     * Get only active sections.
     */
    public static function getActiveSections(): array
    {
        $sections = self::getSections();
        return array_values(array_filter($sections, fn($s) => !empty($s['is_active'])));
    }

    /**
     * Check if a section is active by anchor/slug.
     */
    public static function isSectionActive(string $anchor): bool
    {
        $sections = self::getActiveSections();
        foreach ($sections as $sec) {
            if (($sec['anchor'] ?? '') === $anchor) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get social links array.
     */
    public static function getSocialLinks(): array
    {
        $raw = self::get('landing_social_links');
        $links = [];
        if (!empty($raw)) {
            $links = is_array($raw) ? $raw : json_decode($raw, true);
        }
        return is_array($links) && !empty($links) ? $links : self::defaultSocialLinks();
    }

    /**
     * Get footer links array.
     */
    public static function getFooterLinks(): array
    {
        $raw = self::get('landing_footer_links');
        $links = [];
        if (!empty($raw)) {
            $links = is_array($raw) ? $raw : json_decode($raw, true);
        }
        return is_array($links) && !empty($links) ? $links : self::defaultFooterLinks();
    }
}
