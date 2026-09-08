<?php

use App\Http\Controllers\AppSupport\AppFiturController;
use App\Http\Controllers\AppSupport\MenuController as AppSupportMenuController;
use Illuminate\Support\Facades\Route;

/**
 * Admin & AppSupport Routes (Routes untuk Menu Hasil Seeder & Pengaturan Sistem)
 */
Route::middleware(['auth'])->group(function () {

    // AppSupport: Modul Menu & Manajemen Fitur/Setting
    Route::prefix('appsupport')->name('appsupport.')->group(function () {

        // Fitur & Setting Management (App Fiturs)
        Route::get('/app-fiturs', [AppFiturController::class, 'index'])->name('app-fiturs');
        Route::post('/app-fiturs/toggle', [AppFiturController::class, 'toggle'])->name('app-fiturs.toggle');
        Route::post('/app-fiturs/bulk-toggle', [AppFiturController::class, 'bulkToggle'])->name('app-fiturs.bulk-toggle');
        Route::post('/app-fiturs/settings', [AppFiturController::class, 'saveSettings'])->name('app-fiturs.settings');
        Route::post('/app-fiturs/clear-cache', [AppFiturController::class, 'clearCache'])->name('app-fiturs.clear-cache');

        // Menu Management (Spatie Permission & Dynamic DB Menu)
        Route::post('menu/reorder', [AppSupportMenuController::class, 'reorder'])->name('menu.reorder');
        Route::resource('menu', AppSupportMenuController::class);
    });

    // Tempat untuk menambahkan route modul admin / master data lainnya yang berkaitan dengan database menu seeder di masa mendatang.

});
