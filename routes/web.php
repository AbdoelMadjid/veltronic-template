<?php

use App\Http\Controllers\ProfileController;
use App\Support\Frontpage;
use App\Support\ThemeVersion;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

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

