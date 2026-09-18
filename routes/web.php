<?php

use App\Http\Controllers\ProfileController;
use App\Support\Frontpage;
use App\Support\ThemeVersion;
use Illuminate\Support\Facades\Route;

use App\Support\LanguageManager;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/lang/{locale}', function (Request $request, string $locale) {
    if (in_array($locale, LanguageManager::availableLocales(), true)) {
        session(['locale' => $locale]);
        \Illuminate\Support\Facades\Cookie::queue('kt_lang', $locale, 525600);
        \Illuminate\Support\Facades\App::setLocale($locale);

        $langLabel = match(strtolower($locale)) {
            'id' => 'Bahasa Indonesia (ID)',
            'en' => 'English (EN)',
            default => strtoupper($locale),
        };

        if (class_exists(\App\Models\Profil\UserLog::class)) {
            \App\Models\Profil\UserLog::record(
                module: 'appsupport',
                menu: 'topbar-tools',
                activity: 'Ganti Bahasa Antarmuka',
                description: 'Mengubah preferensi bahasa antarmuka menjadi: ' . $langLabel,
                user: auth()->user(),
                level: 'info'
            );
        }

        if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'status' => 'success',
                'locale' => $locale,
                'message' => 'Language switched successfully'
            ]);
        }
    }

    return redirect()->back();
})->name('lang.switch');

Route::get('/lang/translations.json', function () {
    $payload = LanguageManager::getClientPayload();
    return response()->json($payload)
        ->header('Cache-Control', 'public, max-age=3600');
})->name('lang.translations');

Route::match(['get', 'post'], '/theme-mode/switch/{mode}', function (Request $request, string $mode) {
    if (in_array($mode, ['light', 'dark', 'system'], true)) {
        session(['kt_theme_mode' => $mode]);
        \Illuminate\Support\Facades\Cookie::queue('kt_theme_mode', $mode, 525600);
        if (class_exists(\App\Models\AppSupport\AppSetting::class)) {
            \App\Models\AppSupport\AppSetting::set('default_theme_mode', $mode, 'appearance');
        }

        $modeLabel = match ($mode) {
            'dark' => 'Mode Gelap (Dark Mode)',
            'light' => 'Mode Terang (Light Mode)',
            'system' => 'Mode Sistem (Auto)',
            default => ucfirst($mode),
        };

        if (class_exists(\App\Models\Profil\UserLog::class)) {
            \App\Models\Profil\UserLog::record(
                module: 'appsupport',
                menu: 'topbar-tools',
                activity: 'Ganti Mode Tema (Dark/Light)',
                description: 'Mengubah preferensi mode tema antarmuka menjadi: ' . $modeLabel,
                user: auth()->user(),
                level: 'info'
            );
        }

        if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'status' => 'success',
                'mode' => $mode,
                'message' => 'Theme mode updated successfully.'
            ]);
        }
    }

    return redirect()->back();
})->name('theme.mode.switch');

Route::get('/theme/version/{version}', function (Request $request, $version) {
    if (in_array($version, ThemeVersion::available(), true)) {
        session(['theme_version' => $version]);
        if (class_exists(\App\Models\AppSupport\AppSetting::class)) {
            \App\Models\AppSupport\AppSetting::set('default_theme_version', $version, 'appearance');
        }

        if (class_exists(\App\Models\Profil\UserLog::class)) {
            \App\Models\Profil\UserLog::record(
                module: 'appsupport',
                menu: 'topbar-tools',
                activity: 'Ganti Varian Tema (Theme Version)',
                description: 'Mengubah versi tata letak layout tema menjadi: ' . strtoupper($version),
                user: auth()->user(),
                level: 'info'
            );
        }

        if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'status' => 'success',
                'version' => $version,
                'message' => 'Theme layout version switched to ' . strtoupper($version)
            ]);
        }
    }
    return redirect()->back();
})->middleware(['auth', 'role:master|admin'])->name('theme.version.switch');

Route::get('/frontpage/switch/{frontpage}', function ($frontpage) {
    if (in_array($frontpage, Frontpage::available(), true)) {
        session(['frontpage' => $frontpage]);
        \Illuminate\Support\Facades\Cookie::queue('frontpage', $frontpage, 525600);
        if (class_exists(\App\Models\AppSupport\AppSetting::class)) {
            \App\Models\AppSupport\AppSetting::set('default_frontpage', $frontpage, 'appearance');
        }

        if (class_exists(\App\Models\Profil\UserLog::class)) {
            \App\Models\Profil\UserLog::record(
                module: 'appsupport',
                menu: 'topbar-tools',
                activity: 'Ganti Halaman Depan (Frontpage)',
                description: 'Mengubah preferensi halaman depan (frontpage) menjadi: ' . ucfirst($frontpage),
                user: auth()->user(),
                level: 'info'
            );
        }
    }
    return redirect()->back();
})->middleware(['auth', 'role:master|admin'])->name('frontpage.switch');

Route::match(['get', 'post'], '/icon-style/switch/{style}', function (Request $request, string $style) {
    if (in_array($style, ['duotone', 'solid', 'outline'], true)) {
        session(['kt_icon_style' => $style]);
        \Illuminate\Support\Facades\Cookie::queue('kt_icon_style', $style, 525600);
        if (class_exists(\App\Models\AppSupport\AppSetting::class)) {
            \App\Models\AppSupport\AppSetting::set('default_icon_style', $style, 'appearance');
        }

        if (class_exists(\App\Models\Profil\UserLog::class)) {
            \App\Models\Profil\UserLog::record(
                module: 'appsupport',
                menu: 'topbar-tools',
                activity: 'Ganti Icon Style',
                description: 'Mengubah varian gaya ikon antarmuka menjadi: ' . ucfirst($style),
                user: auth()->user(),
                level: 'info'
            );
        }

        if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'status' => 'success',
                'style' => $style,
                'message' => 'Icon style updated successfully and saved to system settings.'
            ]);
        }
    }
    return redirect()->back();
})->middleware(['auth', 'role:master|admin'])->name('icon.style.switch');


Route::get('/landing', function () {
    return view('frontpages.landing.v1.landing');
})->name('dashboards.landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/menu.php';
require __DIR__ . '/website.php';


