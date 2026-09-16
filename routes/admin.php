<?php

use App\Http\Controllers\AppSupport\AppFiturController;
use App\Http\Controllers\AppSupport\MenuController as AppSupportMenuController;
use App\Http\Controllers\UserManagement\UserController;
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

    // User Management (Users, Roles, Permissions, Akses)
    Route::prefix('usermanagement')->name('usermanagement.')->group(function () {
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::resource('users', UserController::class);
    });

    // Profil Pengguna (Identitas Diri, Ganti Password, Konfigurasi, Riwayat)
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/profil-pengguna', [\App\Http\Controllers\Profil\ProfilPenggunaController::class, 'index'])->name('profil-pengguna');
        Route::post('/profil-pengguna/identitas', [\App\Http\Controllers\Profil\ProfilPenggunaController::class, 'updateIdentitas'])->name('profil-pengguna.identitas');
        Route::post('/profil-pengguna/password', [\App\Http\Controllers\Profil\ProfilPenggunaController::class, 'updatePassword'])->name('profil-pengguna.password');
        Route::post('/profil-pengguna/konfigurasi', [\App\Http\Controllers\Profil\ProfilPenggunaController::class, 'updateKonfigurasi'])->name('profil-pengguna.konfigurasi');
        Route::post('/profil-pengguna/avatar', [\App\Http\Controllers\Profil\ProfilPenggunaController::class, 'updateAvatar'])->name('profil-pengguna.avatar');
        Route::post('/profil-pengguna/ktp', [\App\Http\Controllers\Profil\ProfilPenggunaController::class, 'updateFotoKtp'])->name('profil-pengguna.ktp');
        Route::post('/profil-pengguna/moto-hidup', [\App\Http\Controllers\Profil\ProfilPenggunaController::class, 'updateMotoHidup'])->name('profil-pengguna.moto-hidup');
    });

    // Tempat untuk menambahkan route modul admin / master data lainnya yang berkaitan dengan database menu seeder di masa mendatang.

});

