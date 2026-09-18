<?php

use App\Http\Controllers\AppSupport\AppFiturController;
use App\Http\Controllers\AppSupport\BackupDbController;
use App\Http\Controllers\AppSupport\MenuController as AppSupportMenuController;
use App\Http\Controllers\UserManagement\DataLoginController;
use App\Http\Controllers\UserManagement\PermissionController;
use App\Http\Controllers\UserManagement\RoleAccessController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserAccessController;
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
        Route::get('/app-fiturs/activity-logs', [AppFiturController::class, 'activityLogs'])->name('app-fiturs.activity-logs');
        Route::post('/app-fiturs/toggle', [AppFiturController::class, 'toggle'])->name('app-fiturs.toggle');
        Route::post('/app-fiturs/bulk-toggle', [AppFiturController::class, 'bulkToggle'])->name('app-fiturs.bulk-toggle');
        Route::post('/app-fiturs/settings', [AppFiturController::class, 'saveSettings'])->name('app-fiturs.settings');
        Route::post('/app-fiturs/clear-cache', [AppFiturController::class, 'clearCache'])->name('app-fiturs.clear-cache');

        // Keyboard Shortcuts CRUD
        Route::post('/shortcuts', [AppFiturController::class, 'shortcutStore'])->name('shortcuts.store');
        Route::get('/shortcuts/{appShortcut}', [AppFiturController::class, 'shortcutShow'])->name('shortcuts.show');
        Route::put('/shortcuts/{appShortcut}', [AppFiturController::class, 'shortcutUpdate'])->name('shortcuts.update');
        Route::post('/shortcuts/{appShortcut}/toggle', [AppFiturController::class, 'shortcutToggle'])->name('shortcuts.toggle');
        Route::delete('/shortcuts/{appShortcut}', [AppFiturController::class, 'shortcutDestroy'])->name('shortcuts.destroy');
        Route::get('/shortcuts-active', [AppFiturController::class, 'getUserShortcutsJson'])->name('shortcuts.active');

        // Database Backup & Table Relations (Backup DB)
        Route::get('/backup-db', [BackupDbController::class, 'index'])->name('backup-db');
        Route::get('/backup-db/tables', [BackupDbController::class, 'getTablesData'])->name('backup-db.tables');
        Route::get('/backup-db/tables/{table}', [BackupDbController::class, 'getTableRelationDetail'])->name('backup-db.table-detail');
        Route::post('/backup-db/create', [BackupDbController::class, 'createBackup'])->name('backup-db.create');
        Route::get('/backup-db/download/{fileName}', [BackupDbController::class, 'downloadBackup'])->name('backup-db.download');
        Route::post('/backup-db/delete', [BackupDbController::class, 'deleteBackup'])->name('backup-db.delete');
        Route::post('/backup-db/restore', [BackupDbController::class, 'restoreBackup'])->name('backup-db.restore');
        Route::post('/backup-db/settings', [BackupDbController::class, 'saveSettings'])->name('backup-db.settings');
        Route::post('/backup-db/test-auto', [BackupDbController::class, 'testAutoBackup'])->name('backup-db.test-auto');

        // Menu Management (Spatie Permission & Dynamic DB Menu)
        Route::post('menu/reorder', [AppSupportMenuController::class, 'reorder'])->name('menu.reorder');
        Route::resource('menu', AppSupportMenuController::class);
    });

    // User Management (Users, Roles, Permissions, Akses, Data Login)
    Route::prefix('usermanagement')->name('usermanagement.')->group(function () {
        // Users
        Route::post('users/bulk-assign-role', [UserController::class, 'bulkAssignRole'])->name('users.bulk-assign-role');
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::resource('users', UserController::class);

        // Roles
        Route::get('roles/{role}/permissions', [RoleController::class, 'getPermissions'])->name('roles.permissions');
        Route::resource('roles', RoleController::class);

        // Permissions
        Route::post('permissions/generate', [PermissionController::class, 'generateModulePermissions'])->name('permissions.generate');
        Route::resource('permissions', PermissionController::class);

        // Akses Role (Role-Permission Matrix)
        Route::get('akses-role', [RoleAccessController::class, 'index'])->name('akses-role');
        Route::post('akses-role/sync', [RoleAccessController::class, 'syncRole'])->name('akses-role.sync');
        Route::post('akses-role/toggle', [RoleAccessController::class, 'togglePermission'])->name('akses-role.toggle');
        Route::post('akses-role/bulk-toggle', [RoleAccessController::class, 'bulkToggle'])->name('akses-role.bulk-toggle');

        // Akses User (User Role Assignment & Direct Permissions)
        Route::get('akses-user', [UserAccessController::class, 'index'])->name('akses-user');
        Route::post('akses-user/assign-role', [UserAccessController::class, 'assignRole'])->name('akses-user.assign-role');
        Route::get('akses-user/{user}/permissions', [UserAccessController::class, 'getUserPermissions'])->name('akses-user.permissions');
        Route::post('akses-user/{user}/direct-permissions', [UserAccessController::class, 'updateDirectPermissions'])->name('akses-user.direct-permissions');

        // Data Login & Riwayat Poin
        Route::get('data-login', [DataLoginController::class, 'index'])->name('data-login');
        Route::post('data-login/bulk-delete', [DataLoginController::class, 'bulkDestroy'])->name('data-login.bulk-delete');
        Route::post('data-login/clear', [DataLoginController::class, 'clear'])->name('data-login.clear');
        Route::delete('data-login/{login}', [DataLoginController::class, 'destroy'])->name('data-login.destroy');
    });

    // Alias URL Bahasa Indonesia (/manajemenpengguna/*)
    Route::prefix('manajemenpengguna')->group(function () {
        Route::get('permissions', [PermissionController::class, 'index']);
        Route::get('roles', [RoleController::class, 'index']);
        Route::get('akses-role', [RoleAccessController::class, 'index']);
        Route::get('akses-user', [UserAccessController::class, 'index']);
        Route::get('users', [UserController::class, 'index']);
        Route::get('data-login', [DataLoginController::class, 'index']);
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

