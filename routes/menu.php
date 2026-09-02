<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$pagesPath = resource_path('views/pages');

$files = File::allFiles($pagesPath);

Route::middleware(['auth'])->group(function () use ($files) {
    Route::get('/demo/widget-preview-frame', function (Request $request) {
        $widget = (string) $request->query('widget', '');

        if (!preg_match('/^[a-z0-9]+\.__widget-[a-z0-9-]+$/i', $widget)) {
            abort(404);
        }

        $widgetView = 'partials.widgets-demo.' . $widget;
        if (!view()->exists($widgetView)) {
            abort(404);
        }

        return view('pages.demo._widget-preview-frame', compact('widget', 'widgetView'));
    })->name('demo.widget-preview-frame');

    Route::get('/demo/widget-preview', function (Request $request) {
        $widget = (string) $request->query('widget', '');

        if (!preg_match('/^[a-z0-9]+\.__widget-[a-z0-9-]+$/i', $widget)) {
            abort(404);
        }

        $widgetView = 'partials.widgets-demo.' . $widget;
        if (!view()->exists($widgetView)) {
            abort(404);
        }

        try {
            return view('pages.demo._widget-preview', compact('widget', 'widgetView'));
        } catch (\Throwable $th) {
            return response(
                '<div class="alert alert-warning mb-0">Widget tidak bisa dirender langsung. Kemungkinan membutuhkan parameter tambahan.</div>',
                200
            );
        }
    })->name('demo.widget-preview');

    Route::get('/demo/widget-source', function (Request $request) {
        $widget = (string) $request->query('widget', '');

        if (!preg_match('/^[a-z0-9]+\.__widget-[a-z0-9-]+$/i', $widget)) {
            return response()->json(['message' => 'Widget tidak valid.'], 422);
        }

        $relativeFile = str_replace('.', '/', $widget) . '.blade.php';
        $fullPath = resource_path('views/partials/widgets-demo/' . $relativeFile);

        if (!File::exists($fullPath)) {
            return response()->json(['message' => 'Source widget tidak ditemukan.'], 404);
        }

        return response()->json([
            'widget' => $widget,
            'source' => File::get($fullPath),
            'include' => "@include('partials.widgets-demo.{$widget}')",
        ]);
    })->name('demo.widget-source');

    foreach ($files as $file) {
        // Ambil path relatif terhadap folder "pages"
        $relativePath = $file->getRelativePathname(); // contoh: "apps/projects/targets.blade.php"

        // Hilangkan extension .blade.php
        $relativePath = str_replace('.blade.php', '', $relativePath);

        // Untuk route name (pakai titik)
        $routeName = str_replace(['/', '\\'], '.', $relativePath);

        // Untuk URL path (pakai slash)
        $routeUrl = '/' . str_replace(['\\'], '/', $relativePath);

        Route::get($routeUrl, function () use ($routeName) {
            return view('pages.' . $routeName);
        })->name($routeName);
    }
});

// Fallback tetap di luar middleware, supaya 404 bisa tampil meskipun belum login
Route::fallback(function () {
    return view('pages.pages.authentication.general.error-404');
})->name('fallback.404');
