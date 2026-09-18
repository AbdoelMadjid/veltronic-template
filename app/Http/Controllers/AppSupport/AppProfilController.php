<?php

namespace App\Http\Controllers\AppSupport;

use App\Http\Controllers\Controller;
use App\Models\AppSupport\AppSetting;
use App\Models\Profil\UserLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AppProfilController extends Controller
{
    /**
     * Default settings template configuration for Dashboard Profile.
     */
    protected array $defaultProfileSettings = [
        'app_name' => 'Veltronic Template',
        'app_tagline' => 'Modern Metronic 8.3.2 Admin Dashboard',
        'app_version' => 'v1.0.0',
        'meta_description' => 'Sistem dashboard administrasi modern dengan Metronic 8.3.2 dan Laravel 12/13.',
        'meta_keywords' => 'laravel, metronic, dashboard, veltronic, admin template, bootstrap 5',
        'meta_author' => 'Veltronic Team',
        'og_title' => 'Veltronic - Metronic 8.3.2 Admin Dashboard',
        'og_site_name' => 'Veltronic',
        'app_logo_default' => 'media/logos/default.svg',
        'app_logo_dark' => 'media/logos/default-dark.svg',
        'app_logo_minimize' => 'media/logos/default-small.svg',
        'app_favicon' => 'media/logos/favicon.ico',
        'footer_copyright_year' => '2025',
        'footer_copyright_text' => 'AbdoelMadjid',
        'footer_copyright_url' => 'https://github.com/AbdoelMadjid/veltronic-template',
        'footer_show_system_info' => '1',
        'footer_links' => '[{"title":"About","url":"https://keenthemes.com","target":"_blank"},{"title":"Support","url":"https://devs.keenthemes.com","target":"_blank"},{"title":"Purchase","url":"https://1.envato.market/EA4JP","target":"_blank"}]',
    ];

    /**
     * Display the Dashboard App Profile Management Page.
     */
    public function index()
    {
        $dbSettings = AppSetting::all()->pluck('value', 'key')->toArray();
        $settings = array_merge($this->defaultProfileSettings, $dbSettings);

        // Decode footer links
        $footerLinks = [];
        if (!empty($settings['footer_links'])) {
            $decoded = is_array($settings['footer_links']) ? $settings['footer_links'] : json_decode($settings['footer_links'], true);
            $footerLinks = is_array($decoded) ? $decoded : [];
        }

        // Calculate completeness score & diagnostics
        $filledFields = 0;
        $totalFields = count($this->defaultProfileSettings);
        foreach ($this->defaultProfileSettings as $key => $default) {
            if (!empty($settings[$key])) {
                $filledFields++;
            }
        }
        $completenessScore = round(($filledFields / $totalFields) * 100);

        // Server diagnostics
        $serverInfo = [
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'PHP CLI / WebServer',
            'mysql_version' => 'N/A',
        ];
        try {
            $serverInfo['mysql_version'] = \Illuminate\Support\Facades\DB::connection()->getPdo()->getAttribute(\PDO::ATTR_SERVER_VERSION);
        } catch (\Throwable $e) {
            $serverInfo['mysql_version'] = 'N/A';
        }

        $stats = [
            'completeness_score' => $completenessScore,
            'total_fields' => $totalFields,
            'filled_fields' => $filledFields,
            'footer_links_count' => count($footerLinks),
            'has_custom_logo' => !empty($dbSettings['app_logo_default']) || !empty($dbSettings['app_logo_dark']),
            'has_custom_favicon' => !empty($dbSettings['app_favicon']),
        ];

        return view('pages.appsupport.app-profil', compact('settings', 'footerLinks', 'stats', 'serverInfo'));
    }

    /**
     * Update Dashboard Meta & Identity Settings.
     */
    public function updateMeta(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:100',
            'app_tagline' => 'nullable|string|max:200',
            'app_version' => 'nullable|string|max:50',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'meta_author' => 'nullable|string|max:100',
            'og_title' => 'nullable|string|max:150',
            'og_site_name' => 'nullable|string|max:100',
        ]);

        foreach ($validated as $key => $val) {
            AppSetting::set($key, (string) ($val ?? ''), 'meta', 'string');
        }

        $this->logActivity('Ubah Identitas & Meta App', 'Memperbarui data identitas & meta dashboard (' . ($validated['app_name'] ?? '') . ')', 'success');

        return response()->json([
            'success' => true,
            'message' => 'Identitas dan Data Meta Dashboard berhasil disimpan dan diperbarui.',
            'data' => $validated,
        ]);
    }

    /**
     * Update Dashboard Logo & Favicon Assets (Saved directly into public/assets/logo/).
     */
    public function updateLogo(Request $request): JsonResponse
    {
        $rules = [
            'logo_default_file' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'logo_dark_file' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'logo_minimize_file' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:512',
            'favicon_file' => 'nullable|file|mimes:png,ico,svg,webp|max:256',
            'app_logo_default_url' => 'nullable|string|max:500',
            'app_logo_dark_url' => 'nullable|string|max:500',
            'app_logo_minimize_url' => 'nullable|string|max:500',
            'app_favicon_url' => 'nullable|string|max:500',
        ];

        // Tambahkan aturan dimensions untuk file bitmap (non-SVG/non-ICO)
        if ($request->hasFile('logo_default_file') && $request->file('logo_default_file')->getClientOriginalExtension() !== 'svg') {
            $rules['logo_default_file'] .= '|dimensions:min_width=100,min_height=20,max_width=600,max_height=150';
        }
        if ($request->hasFile('logo_dark_file') && $request->file('logo_dark_file')->getClientOriginalExtension() !== 'svg') {
            $rules['logo_dark_file'] .= '|dimensions:min_width=100,min_height=20,max_width=600,max_height=150';
        }
        if ($request->hasFile('logo_minimize_file') && $request->file('logo_minimize_file')->getClientOriginalExtension() !== 'svg') {
            $rules['logo_minimize_file'] .= '|dimensions:min_width=30,min_height=30,max_width=200,max_height=200,ratio=1/1';
        }
        if ($request->hasFile('favicon_file') && !in_array($request->file('favicon_file')->getClientOriginalExtension(), ['ico', 'svg'], true)) {
            $rules['favicon_file'] .= '|dimensions:min_width=16,min_height=16,max_width=128,max_height=128,ratio=1/1';
        }

        $messages = [
            'logo_default_file.dimensions' => 'Logo Mode Terang harus beresolusi antara 100x20 px hingga 600x150 px.',
            'logo_default_file.max' => 'Ukuran berkas Logo Mode Terang maksimal 1 MB.',
            'logo_dark_file.dimensions' => 'Logo Mode Gelap harus beresolusi antara 100x20 px hingga 600x150 px.',
            'logo_dark_file.max' => 'Ukuran berkas Logo Mode Gelap maksimal 1 MB.',
            'logo_minimize_file.dimensions' => 'Logo Mini harus berasio persegi (1:1) dengan resolusi antara 30x30 px hingga 200x200 px.',
            'logo_minimize_file.max' => 'Ukuran berkas Logo Mini maksimal 512 KB.',
            'favicon_file.dimensions' => 'Favicon harus berasio persegi (1:1) dengan resolusi antara 16x16 px hingga 128x128 px.',
            'favicon_file.max' => 'Ukuran berkas Favicon maksimal 256 KB.',
        ];

        $request->validate($rules, $messages);

        $uploadDir = public_path('assets/logo');
        if (!File::isDirectory($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true, true);
        }

        $savedValues = [];

        // 1. Logo Default (Light Mode)
        if ($request->hasFile('logo_default_file')) {
            $file = $request->file('logo_default_file');
            $ext = $file->getClientOriginalExtension();
            $filename = 'logo-light.' . $ext;
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('app_logo_default', $path, 'logo', 'string');
            $savedValues['app_logo_default'] = asset($path);
        } elseif ($request->filled('app_logo_default_url')) {
            AppSetting::set('app_logo_default', $request->input('app_logo_default_url'), 'logo', 'string');
            $savedValues['app_logo_default'] = $request->input('app_logo_default_url');
        }

        // 2. Logo Dark Mode
        if ($request->hasFile('logo_dark_file')) {
            $file = $request->file('logo_dark_file');
            $ext = $file->getClientOriginalExtension();
            $filename = 'logo-dark.' . $ext;
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('app_logo_dark', $path, 'logo', 'string');
            $savedValues['app_logo_dark'] = asset($path);
        } elseif ($request->filled('app_logo_dark_url')) {
            AppSetting::set('app_logo_dark', $request->input('app_logo_dark_url'), 'logo', 'string');
            $savedValues['app_logo_dark'] = $request->input('app_logo_dark_url');
        }

        // 3. Logo Minimize (Icon Mini)
        if ($request->hasFile('logo_minimize_file')) {
            $file = $request->file('logo_minimize_file');
            $ext = $file->getClientOriginalExtension();
            $filename = 'logo-mini.' . $ext;
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('app_logo_minimize', $path, 'logo', 'string');
            $savedValues['app_logo_minimize'] = asset($path);
        } elseif ($request->filled('app_logo_minimize_url')) {
            AppSetting::set('app_logo_minimize', $request->input('app_logo_minimize_url'), 'logo', 'string');
            $savedValues['app_logo_minimize'] = $request->input('app_logo_minimize_url');
        }

        // 4. Favicon
        if ($request->hasFile('favicon_file')) {
            $file = $request->file('favicon_file');
            $ext = $file->getClientOriginalExtension();
            $filename = 'favicon.' . $ext;
            $file->move($uploadDir, $filename);
            $path = 'assets/logo/' . $filename;
            AppSetting::set('app_favicon', $path, 'logo', 'string');
            $savedValues['app_favicon'] = asset($path);
        } elseif ($request->filled('app_favicon_url')) {
            AppSetting::set('app_favicon', $request->input('app_favicon_url'), 'logo', 'string');
            $savedValues['app_favicon'] = $request->input('app_favicon_url');
        }

        $this->logActivity('Pembaruan Logo & Favicon', 'Memperbarui logo dan favicon dashboard aplikasi di public/assets/logo/', 'success');

        return response()->json([
            'success' => true,
            'message' => 'Logo dan Favicon Dashboard berhasil disimpan ke public/assets/logo/ dan diperbarui.',
            'data' => [
                'logo_default_url' => app_logo_url('default'),
                'logo_dark_url' => app_logo_url('dark'),
                'logo_minimize_url' => app_logo_url('minimize'),
                'favicon_url' => app_favicon_url(),
                'saved' => $savedValues,
            ],
        ]);
    }

    /**
     * Reset specific logo or favicon to theme default.
     */
    public function resetLogo(Request $request): JsonResponse
    {
        $target = $request->input('target', 'all');

        $keys = match ($target) {
            'default' => ['app_logo_default'],
            'dark' => ['app_logo_dark'],
            'minimize' => ['app_logo_minimize'],
            'favicon' => ['app_favicon'],
            default => ['app_logo_default', 'app_logo_dark', 'app_logo_minimize', 'app_favicon'],
        };

        foreach ($keys as $k) {
            AppSetting::where('key', $k)->delete();
        }
        AppSetting::clearCache();

        $this->logActivity('Reset Logo Default', "Mengembalikan logo/favicon ($target) ke standar bawaan tema", 'warning');

        return response()->json([
            'success' => true,
            'message' => 'Logo/Favicon berhasil dikembalikan ke standar bawaan tema.',
            'data' => [
                'logo_default_url' => app_logo_url('default'),
                'logo_dark_url' => app_logo_url('dark'),
                'logo_minimize_url' => app_logo_url('minimize'),
                'favicon_url' => app_favicon_url(),
            ],
        ]);
    }

    /**
     * Update Dashboard Footer Settings & Dynamic Links.
     */
    public function updateFooter(Request $request): JsonResponse
    {
        $request->validate([
            'footer_copyright_year' => 'nullable|string|max:50',
            'footer_copyright_text' => 'required|string|max:150',
            'footer_copyright_url' => 'nullable|string|max:255',
            'footer_show_system_info' => 'nullable|in:0,1',
            'links' => 'nullable|array',
            'links.*.title' => 'required|string|max:100',
            'links.*.url' => 'required|string|max:255',
            'links.*.target' => 'nullable|in:_blank,_self',
        ]);

        $year = $request->input('footer_copyright_year', date('Y'));
        $text = $request->input('footer_copyright_text', 'AbdoelMadjid');
        $url = $request->input('footer_copyright_url', 'https://github.com/AbdoelMadjid/veltronic-template');
        $showSys = $request->input('footer_show_system_info', '1');

        $rawLinks = $request->input('links', []);
        $cleanLinks = [];
        if (is_array($rawLinks)) {
            foreach ($rawLinks as $item) {
                if (!empty($item['title']) && !empty($item['url'])) {
                    $cleanLinks[] = [
                        'title' => trim((string) $item['title']),
                        'url' => trim((string) $item['url']),
                        'target' => in_array($item['target'] ?? '_blank', ['_blank', '_self'], true) ? $item['target'] : '_blank',
                    ];
                }
            }
        }

        AppSetting::set('footer_copyright_year', (string) $year, 'footer', 'string');
        AppSetting::set('footer_copyright_text', (string) $text, 'footer', 'string');
        AppSetting::set('footer_copyright_url', (string) $url, 'footer', 'string');
        AppSetting::set('footer_show_system_info', (string) $showSys, 'footer', 'boolean');
        AppSetting::set('footer_links', json_encode($cleanLinks), 'footer', 'json');

        $this->logActivity('Pembaruan Footer Dashboard', 'Memperbarui konfigurasi hak cipta, status sistem, dan ' . count($cleanLinks) . ' tautan footer', 'success');

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan Footer Dashboard berhasil disimpan dan diperbarui.',
            'data' => [
                'year' => $year,
                'text' => $text,
                'url' => $url,
                'show_system_info' => $showSys,
                'links' => $cleanLinks,
            ],
        ]);
    }

    /**
     * Sync and update the database/seeders/AppProfilSeeder.php file from current active settings.
     */
    public function syncToSeeder(): JsonResponse
    {
        $dbSettings = AppSetting::all()->pluck('value', 'key')->toArray();
        $current = array_merge($this->defaultProfileSettings, $dbSettings);

        $footerLinks = $current['footer_links'] ?? '[]';
        if (is_array($footerLinks)) {
            $footerLinks = json_encode($footerLinks);
        }

        $code = "<?php\n\n" .
            "namespace Database\Seeders;\n\n" .
            "use App\Models\AppSupport\AppSetting;\n" .
            "use Illuminate\Database\Seeder;\n\n" .
            "class AppProfilSeeder extends Seeder\n" .
            "{\n" .
            "    /**\n" .
            "     * Run the database seeds for App Profile (Meta, Logo, and Footer).\n" .
            "     */\n" .
            "    public function run(): void\n" .
            "    {\n" .
            "        \$profileSettings = [\n" .
            "            // Identitas & Meta SEO\n" .
            "            [\n" .
            "                'key' => 'app_name',\n" .
            "                'value' => " . var_export($current['app_name'] ?? 'Veltronic Template', true) . ",\n" .
            "                'group' => 'meta',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Nama utama aplikasi dashboard sistem',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'app_tagline',\n" .
            "                'value' => " . var_export($current['app_tagline'] ?? '', true) . ",\n" .
            "                'group' => 'meta',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Tagline / slogan deskriptif aplikasi dashboard',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'app_version',\n" .
            "                'value' => " . var_export($current['app_version'] ?? 'v1.0.0', true) . ",\n" .
            "                'group' => 'meta',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Versi rilis aktif dashboard aplikasi',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'meta_description',\n" .
            "                'value' => " . var_export($current['meta_description'] ?? '', true) . ",\n" .
            "                'group' => 'meta',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Deskripsi meta SEO untuk mesin pencari',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'meta_keywords',\n" .
            "                'value' => " . var_export($current['meta_keywords'] ?? '', true) . ",\n" .
            "                'group' => 'meta',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Kata kunci penelusuran meta SEO',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'meta_author',\n" .
            "                'value' => " . var_export($current['meta_author'] ?? 'Veltronic Team', true) . ",\n" .
            "                'group' => 'meta',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Penulis / author sistem aplikasi',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'og_title',\n" .
            "                'value' => " . var_export($current['og_title'] ?? '', true) . ",\n" .
            "                'group' => 'meta',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Judul Open Graph untuk pratinjau media sosial',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'og_site_name',\n" .
            "                'value' => " . var_export($current['og_site_name'] ?? '', true) . ",\n" .
            "                'group' => 'meta',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Nama situs Open Graph',\n" .
            "            ],\n\n" .
            "            // Logo & Favicon Dashboard\n" .
            "            [\n" .
            "                'key' => 'app_logo_default',\n" .
            "                'value' => " . var_export($current['app_logo_default'] ?? 'media/logos/default.svg', true) . ",\n" .
            "                'group' => 'logo',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Logo dashboard mode terang (Light sidebar/header)',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'app_logo_dark',\n" .
            "                'value' => " . var_export($current['app_logo_dark'] ?? 'media/logos/default-dark.svg', true) . ",\n" .
            "                'group' => 'logo',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Logo dashboard mode gelap (Dark sidebar/header)',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'app_logo_minimize',\n" .
            "                'value' => " . var_export($current['app_logo_minimize'] ?? 'media/logos/default-small.svg', true) . ",\n" .
            "                'group' => 'logo',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Icon logo mini saat sidebar diminimize',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'app_favicon',\n" .
            "                'value' => " . var_export($current['app_favicon'] ?? 'media/logos/favicon.ico', true) . ",\n" .
            "                'group' => 'logo',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Favicon icon tab browser aplikasi',\n" .
            "            ],\n\n" .
            "            // Footer Dashboard\n" .
            "            [\n" .
            "                'key' => 'footer_copyright_year',\n" .
            "                'value' => " . var_export((string) ($current['footer_copyright_year'] ?? '2025'), true) . ",\n" .
            "                'group' => 'footer',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Tahun hak cipta pada footer dashboard',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'footer_copyright_text',\n" .
            "                'value' => " . var_export($current['footer_copyright_text'] ?? 'AbdoelMadjid', true) . ",\n" .
            "                'group' => 'footer',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Teks pemilik hak cipta pada footer dashboard',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'footer_copyright_url',\n" .
            "                'value' => " . var_export($current['footer_copyright_url'] ?? 'https://github.com/AbdoelMadjid/veltronic-template', true) . ",\n" .
            "                'group' => 'footer',\n" .
            "                'type' => 'string',\n" .
            "                'description' => 'Tautan URL pemilik hak cipta pada footer dashboard',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'footer_show_system_info',\n" .
            "                'value' => " . var_export((string) ($current['footer_show_system_info'] ?? '1'), true) . ",\n" .
            "                'group' => 'footer',\n" .
            "                'type' => 'boolean',\n" .
            "                'description' => 'Tampilkan status versi Laravel, PHP, dan MySQL di footer',\n" .
            "            ],\n" .
            "            [\n" .
            "                'key' => 'footer_links',\n" .
            "                'value' => " . var_export((string) $footerLinks, true) . ",\n" .
            "                'group' => 'footer',\n" .
            "                'type' => 'json',\n" .
            "                'description' => 'Daftar tautan menu navigasi cepat pada footer dashboard',\n" .
            "            ],\n" .
            "        ];\n\n" .
            "        foreach (\$profileSettings as \$setting) {\n" .
            "            AppSetting::updateOrCreate(\n" .
            "                ['key' => \$setting['key']],\n" .
            "                \$setting\n" .
            "            );\n" .
            "        }\n\n" .
            "        AppSetting::clearCache();\n" .
            "    }\n" .
            "}\n";

        $seederPath = database_path('seeders/AppProfilSeeder.php');
        File::put($seederPath, $code);

        $this->logActivity('Sinkronisasi File Seeder', 'Memperbarui berkas database/seeders/AppProfilSeeder.php dari konfigurasi aktif', 'info');

        return response()->json([
            'success' => true,
            'message' => 'Berkas database/seeders/AppProfilSeeder.php berhasil diperbarui dengan konfigurasi aktif saat ini.',
        ]);
    }

    /**
     * Run the AppProfilSeeder to re-seed and reset settings to the seeder file content.
     */
    public function runSeeder(): JsonResponse
    {
        try {
            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\AppProfilSeeder',
                '--force' => true,
            ]);
            AppSetting::clearCache();

            $this->logActivity('Jalankan Seeder Profil', 'Menjalankan seeder AppProfilSeeder untuk memulihkan profil dari seeder', 'warning');

            return response()->json([
                'success' => true,
                'message' => 'Seeder AppProfilSeeder berhasil dijalankan dan data profil dashboard telah dimuat ulang.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menjalankan seeder: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Clear all App Settings Caches.
     */
    public function clearCache(): JsonResponse
    {
        AppSetting::clearCache();

        $this->logActivity('Bersihkan Cache Profil', 'Membersihkan seluruh cache profil aplikasi & aset tampilan', 'info');

        return response()->json([
            'success' => true,
            'message' => 'Cache profil aplikasi & asset berhasil dibersihkan secara instan.',
        ]);
    }

    /**
     * Helper to log user activity.
     */
    protected function logActivity(string $activity, string $description, string $level = 'info'): void
    {
        if (class_exists(UserLog::class)) {
            try {
                UserLog::record(
                    module: 'appsupport',
                    menu: 'app-profil',
                    activity: $activity,
                    description: $description,
                    user: auth()->user(),
                    level: $level
                );
            } catch (\Throwable $e) {
                // Non-blocking log failure
            }
        }
    }
}
