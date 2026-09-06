# Skema Pergantian Frontpage

Dokumen arsitektur dan alur teknis pergantian frontpage template secara dinamis pada runtime dan environment.

[⬅ Kembali ke Daftar Skema](../README.md)

---

## 1. Arsitektur Dynamic Frontpage Loader
- **Hierarchy Resolving**: Resolusi frontpage aktif memprioritaskan:
  1. Session (`session('frontpage_template')`)
  2. Cookie (`cookie('frontpage_template')`)
  3. Konfigurasi default (`config('frontpage.default')` / `.env` `DEFAULT_FRONTPAGE`)
- **Deklarasi Template**: Seluruh template terdaftar dalam file konfigurasi `config/frontpage.php`.
- **Integrasi Root View**: Route `/` pada `routes/website.php` meresolusi view frontpage sesuai template aktif.

## 2. Struktur Konfigurasi (`config/frontpage.php`)
```php
return [
    'default' => env('DEFAULT_FRONTPAGE', 'landing'),
    'pages' => [
        'landing' => [
            'name' => 'Landing Page',
            'desc' => 'Default Corporate & Marketing Landing Page',
            'view' => 'frontpages.landing.home',
            'url'  => '/',
            'icon' => 'ki-element-11',
            'badge' => 'Default',
            'color' => 'primary',
        ],
        'education' => [
            'name' => 'Education Portal',
            'desc' => 'Online Course, LMS & Education Frontpage',
            'view' => 'frontpages.education.home',
            'url'  => '/education',
            'icon' => 'ki-book-open',
            'badge' => 'Popular',
            'color' => 'info',
        ],
    ],
];
```

## 3. Komponen Pendukung
- `App\Support\FrontpageManager`: Helper untuk membaca konfigurasi, daftar template legal, dan meresolusi view aktif.
- `routes/website.php`: Menyediakan route `/frontpage/switch/{template}` untuk switch runtime via AJAX/session.
