<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$pagesPath = resource_path('views/pages');

$files = File::allFiles($pagesPath);

Route::middleware(['auth'])->group(function () use ($files) {
    Route::get('/main/demo/widget-preview-frame', function (Request $request) {
        $widget = (string) $request->query('widget', '');

        if (!preg_match('/^[a-z0-9]+\.__widget-[a-z0-9-]+$/i', $widget)) {
            abort(404);
        }

        $widgetView = 'partials.widgets-demo.' . $widget;
        if (!view()->exists($widgetView)) {
            abort(404);
        }

        $frameView = view()->exists('pages.main.demo._widget-preview-frame')
            ? 'pages.main.demo._widget-preview-frame'
            : 'pages.demo._widget-preview-frame';

        return view($frameView, compact('widget', 'widgetView'));
    })->name('main.demo.widget-preview-frame');

    Route::get('/main/demo/widget-preview', function (Request $request) {
        $widget = (string) $request->query('widget', '');

        if (!preg_match('/^[a-z0-9]+\.__widget-[a-z0-9-]+$/i', $widget)) {
            abort(404);
        }

        $widgetView = 'partials.widgets-demo.' . $widget;
        if (!view()->exists($widgetView)) {
            abort(404);
        }

        $previewView = view()->exists('pages.main.demo._widget-preview')
            ? 'pages.main.demo._widget-preview'
            : 'pages.demo._widget-preview';

        try {
            return view($previewView, compact('widget', 'widgetView'));
        } catch (\Throwable $th) {
            return response(
                '<div class="alert alert-warning mb-0">Widget tidak bisa dirender langsung. Kemungkinan membutuhkan parameter tambahan.</div>',
                200
            );
        }
    })->name('main.demo.widget-preview');

    Route::get('/main/demo/widget-source', function (Request $request) {
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
    })->name('main.demo.widget-source');

    // Compatibility aliases
    Route::get('/demo/widget-preview-frame', function (Request $request) {
        return redirect()->route('main.demo.widget-preview-frame', $request->query());
    })->name('demo.widget-preview-frame');

    Route::get('/demo/widget-preview', function (Request $request) {
        return redirect()->route('main.demo.widget-preview', $request->query());
    })->name('demo.widget-preview');

    Route::get('/demo/widget-source', function (Request $request) {
        return redirect()->route('main.demo.widget-source', $request->query());
    })->name('demo.widget-source');

    foreach ($files as $file) {
        // Lewati file kosong (belum diimplementasikan / MVC belum dibuat) agar diarahkan ke 404
        if ($file->getSize() === 0) {
            continue;
        }

        // Ambil path relatif terhadap folder "pages"
        $relativePath = $file->getRelativePathname(); // contoh: "apps/projects/targets.blade.php" atau "main/dashboards/ecommerce.blade.php"

        // Lewati file partials atau file internal yang diawali underscore
        if (str_contains($relativePath, 'partials/') || str_contains($relativePath, 'partials\\') || str_starts_with(basename($relativePath), '_')) {
            continue;
        }

        // Hilangkan extension .blade.php
        $cleanPath = str_replace('.blade.php', '', $relativePath);
        $cleanPathNorm = str_replace('\\', '/', $cleanPath);

        // View name selalu merujuk ke path sebenarnya di dalam folder pages
        $viewName = 'pages.' . str_replace('/', '.', $cleanPathNorm);

        // Untuk route name (pakai titik)
        $routeName = str_replace('/', '.', $cleanPathNorm);

        // Untuk URL path (pakai slash)
        $routeUrl = '/' . $cleanPathNorm;

        // Jangan menimpa route yang sudah didefinisikan oleh controller/resource
        if (str_starts_with($cleanPathNorm, 'appsupport/') || str_starts_with($cleanPathNorm, 'usermanagement/') || str_starts_with($cleanPathNorm, 'manajemenpengguna/') || str_starts_with($cleanPathNorm, 'profil/') || Route::has($routeName) || Route::has($routeName . '.index')) {
            continue;
        }

        Route::get($routeUrl, function () use ($viewName, $file) {
            if (!view()->exists($viewName) || $file->getSize() === 0) {
                abort(404);
            }
            return view($viewName);
        })->name($routeName);
    }
});

// Fallback tetap di luar middleware, supaya 404 bisa tampil meskipun belum login
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
})->name('fallback.404');
