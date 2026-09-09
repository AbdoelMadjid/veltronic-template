<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$educationViews = collect(File::isDirectory(resource_path('views/frontpages/education')) ? File::files(resource_path('views/frontpages/education')) : [])
    ->map(fn ($file) => Str::before($file->getFilename(), '.blade.php'))
    ->sort()
    ->values();

Route::prefix('education')->name('education.')->middleware(['auth', 'role:master|admin'])->group(function () use ($educationViews) {
    Route::get('lang/{locale}', function (Request $request, string $locale) {
        if (in_array($locale, ['en', 'id'], true)) {
            $request->session()->put('locale', $locale);
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

    if ($educationViews->contains('home-page')) {
        Route::view('/', 'frontpages.education.home-page')->name('home');
    }

    foreach ($educationViews as $view) {
        if ($view === 'home-page') {
            continue;
        }

        $routeName = $view === 'apply-for-all-intake' ? 'apply-all-intake' : $view;
        Route::view($view, "frontpages.education.{$view}")->name($routeName);
    }
});
