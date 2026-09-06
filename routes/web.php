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

Route::get('/theme/version/{version}', function ($version) {
    if (in_array($version, ThemeVersion::available(), true)) {
        session(['theme_version' => $version]);
    }
    return redirect()->back();
})->name('theme.version.switch');

Route::get('/frontpage/switch/{frontpage}', function ($frontpage) {
    if (in_array($frontpage, Frontpage::available(), true)) {
        session(['frontpage' => $frontpage]);
        \Illuminate\Support\Facades\Cookie::queue('frontpage', $frontpage, 525600);
    }
    return redirect()->back();
})->name('frontpage.switch');


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
require __DIR__ . '/masterdata.php';
require __DIR__ . '/menu.php';
require __DIR__ . '/website.php';

