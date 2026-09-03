<?php

use App\Http\Controllers\AppSupport\MenuController as AppSupportMenuController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // AppSupport Modules
    Route::prefix('appsupport')->name('appsupport.')->group(function () {
        Route::resource('menu', AppSupportMenuController::class);
    });
});
