<?php

namespace App\Support;

use App\Models\AppSupport\AppSetting;
use Illuminate\Support\Facades\Cache;

class EducationPageConfig
{
    const CACHE_KEY = 'education_page_config_cache';

    protected static ?array $cachedConfig = null;

    /**
     * Default core settings for Education Portal.
     */
    public static function defaults(): array
    {
        return [
            // Branding & General Info
            'education_portal_title' => 'Unify University - Higher Education & Academic Portal',
            'education_portal_tagline' => 'Empowering Minds, Shaping the Future of Excellence',
            'education_portal_description' => 'Portal akademik terpadu untuk calon mahasiswa, civitas akademika, riset unggulan, dan program studi berkualitas internasional.',
            'education_meta_keywords' => 'education, university, academic, campus life, research, programs, faculty, students, admissions',
            'education_badge' => 'Unify v2.6 Multipage',

            // Logo & Assets
            'education_logo_light' => 'assets/img/logo/logo.png',
            'education_logo_dark' => 'assets/img/logo/logo-mini.png',
            'education_favicon' => 'assets/img/logo/logo-mini.png',

            // Topbar & Actions
            'education_topbar_apply_text' => 'Apply for Fall Intake',
            'education_topbar_apply_url' => '/education/apply-for-all-intake',
            'education_topbar_show_lang' => '1',
            'education_topbar_show_jump_to' => '1',
            'education_topbar_show_search' => '1',

            // Hero / Home Banner Info
            'education_hero_title' => 'Find Your Future at Unify University',
            'education_hero_subtitle' => 'Jelajahi beragam program studi sarjana, pascasarjana, serta peluang beasiswa riset kelas dunia.',
            'education_hero_cta_text' => 'Jelajahi Program Studi',
            'education_hero_cta_url' => '/education/programs',

            // Footer & Kontak
            'education_footer_about' => 'Unify Education Portal - Mengedepankan keunggulan akademik, riset mutakhir, serta pembinaan mahasiswa yang berdaya saing global.',
            'education_footer_copyright' => '2026 Unify University. All rights reserved. Powered by Veltronic Template.',
            'education_footer_email' => 'admissions@unify-edu.ac.id',
            'education_footer_phone' => '+62 (021) 789-0123',
            'education_footer_address' => 'Jl. Pendidikan Tinggi No. 45, Kampus Utama, Jakarta',

            // Social links
            'education_social_facebook' => 'https://facebook.com',
            'education_social_twitter' => 'https://twitter.com',
            'education_social_instagram' => 'https://instagram.com',
            'education_social_youtube' => 'https://youtube.com',
            'education_social_linkedin' => 'https://linkedin.com',
        ];
    }

    /**
     * Catalog of all 13 Education Portal Pages with route details.
     */
    public static function getPages(): array
    {
        return [
            [
                'id' => 'home-page',
                'title' => 'Beranda Utama (Home Page)',
                'route' => 'education.home',
                'url' => '/education',
                'icon' => 'ki-home',
                'badge' => 'Utama',
                'badge_color' => 'primary',
                'desc' => 'Halaman muka portal dengan carousel banner, pencarian jurusan, modul tahapan pendaftaran, dan CTA.',
            ],
            [
                'id' => 'programs',
                'title' => 'Program Studi (Programs)',
                'route' => 'education.programs',
                'url' => '/education/programs',
                'icon' => 'ki-book-open',
                'badge' => 'Akademik',
                'badge_color' => 'info',
                'desc' => 'Katalog lengkap jurusan, jenjang strata (S1/S2/S3), kurikulum, dan persyaratan akademik.',
            ],
            [
                'id' => 'future-students',
                'title' => 'Calon Mahasiswa (Future Students)',
                'route' => 'education.future-students',
                'url' => '/education/future-students',
                'icon' => 'ki-user-tick',
                'badge' => 'Admisi',
                'badge_color' => 'success',
                'desc' => 'Informasi jalur masuk, biaya studi, beasiswa, dan panduan bagi pendaftar baru.',
            ],
            [
                'id' => 'current-students',
                'title' => 'Mahasiswa Aktif (Current Students)',
                'route' => 'education.current-students',
                'url' => '/education/current-students',
                'icon' => 'ki-people',
                'badge' => 'Layanan',
                'badge_color' => 'secondary',
                'desc' => 'Pusat layanan mahasiswa, kalender akademik, bimbingan konseling, dan aktivitas kampus.',
            ],
            [
                'id' => 'faculty-and-staff',
                'title' => 'Dosen & Staf (Faculty & Staff)',
                'route' => 'education.faculty-and-staff',
                'url' => '/education/faculty-and-staff',
                'icon' => 'ki-teacher',
                'badge' => 'Direktori',
                'badge_color' => 'warning',
                'desc' => 'Profil jajaran dekanat, guru besar, dosen pengajar, dan staf administrasi universitas.',
            ],
            [
                'id' => 'research',
                'title' => 'Riset & Inovasi (Research)',
                'route' => 'education.research',
                'url' => '/education/research',
                'icon' => 'ki-technology-4',
                'badge' => 'Inovasi',
                'badge_color' => 'primary',
                'desc' => 'Publikasi ilmiah, laboratorium penelitian terdepan, hibah riset, dan inovasi terapan.',
            ],
            [
                'id' => 'events',
                'title' => 'Agenda & Acara (Events)',
                'route' => 'education.events',
                'url' => '/education/events',
                'icon' => 'ki-calendar',
                'badge' => 'Agenda',
                'badge_color' => 'info',
                'desc' => 'Jadwal seminar internasional, lokakarya, wisuda, pameran inovasi, dan festival kampus.',
            ],
            [
                'id' => 'campus-life',
                'title' => 'Kehidupan Kampus (Campus Life)',
                'route' => 'education.campus-life',
                'url' => '/education/campus-life',
                'icon' => 'ki-coffee',
                'badge' => 'Komunitas',
                'badge_color' => 'success',
                'desc' => 'Fasilitas asrama, unit kegiatan mahasiswa (UKM), gelanggang olahraga, dan seni budaya.',
            ],
            [
                'id' => 'alumni',
                'title' => 'Ikatan Alumni (Alumni)',
                'route' => 'education.alumni',
                'url' => '/education/alumni',
                'icon' => 'ki-crown-2',
                'badge' => 'Jaringan',
                'badge_color' => 'warning',
                'desc' => 'Jejaring lulusan, kisah sukses alumni, peluang karir, dan kontribusi bagi almamater.',
            ],
            [
                'id' => 'apply-all-intake',
                'title' => 'Pendaftaran Online (Apply Intake)',
                'route' => 'education.apply-all-intake',
                'url' => '/education/apply-for-all-intake',
                'icon' => 'ki-document',
                'badge' => 'Pendaftaran',
                'badge_color' => 'danger',
                'desc' => 'Formulir aplikasi seleksi masuk mahasiswa baru periode ganjil dan genap.',
            ],
            [
                'id' => 'signin',
                'title' => 'Portal Masuk Mahasiswa (Sign-In)',
                'route' => 'education.signin',
                'url' => '/education/signin',
                'icon' => 'ki-key',
                'badge' => 'Otentikasi',
                'badge_color' => 'dark',
                'desc' => 'Akses Single Sign-On (SSO) untuk akun mahasiswa, dosen, dan staf pendidikan.',
            ],
            [
                'id' => 'help',
                'title' => 'Pusat Bantuan & FAQ (Help)',
                'route' => 'education.help',
                'url' => '/education/help',
                'icon' => 'ki-information-5',
                'badge' => 'Dukungan',
                'badge_color' => 'info',
                'desc' => 'Pertanyaan umum (FAQ), panduan teknis portal, dan layanan helpdesk mahasiswa.',
            ],
            [
                'id' => 'contacts',
                'title' => 'Kontak & Lokasi Kampus (Contacts)',
                'route' => 'education.contacts',
                'url' => '/education/contacts',
                'icon' => 'ki-sms',
                'badge' => 'Kontak',
                'badge_color' => 'primary',
                'desc' => 'Alamat sekretariat, peta navigasi Google Maps, formulir pesan, dan nomor darurat kampus.',
            ],
        ];
    }

    /**
     * Get all Education configuration with defaults fallback.
     */
    public static function get(): array
    {
        if (self::$cachedConfig !== null) {
            return self::$cachedConfig;
        }

        try {
            $config = Cache::rememberForever(self::CACHE_KEY, function () {
                $defaults = self::defaults();
                $result = [];

                foreach ($defaults as $key => $defaultVal) {
                    $result[$key] = AppSetting::get($key, $defaultVal);
                }

                return $result;
            });

            self::$cachedConfig = is_array($config) ? $config : self::defaults();
            return self::$cachedConfig;
        } catch (\Throwable $e) {
            return self::defaults();
        }
    }

    /**
     * Get a specific configuration key.
     */
    public static function getValue(string $key, mixed $default = null): mixed
    {
        $all = self::get();

        return $all[$key] ?? $default;
    }

    /**
     * Clear config cache.
     */
    public static function clearCache(): void
    {
        self::$cachedConfig = null;
        Cache::forget(self::CACHE_KEY);
    }
}
