<?php

use App\Http\Controllers\AppSupport\AppFiturController;
use App\Http\Controllers\AppSupport\AppProfilController;
use App\Http\Controllers\AppSupport\BackupDbController;
use App\Http\Controllers\AppSupport\MenuController as AppSupportMenuController;
use App\Http\Controllers\AppSupport\ThemeFrontpageController;
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

        // Profil & Identitas Aplikasi Dashboard (App Profil)
        Route::get('/app-profil', [AppProfilController::class, 'index'])->name('app-profil');
        Route::post('/app-profil/meta', [AppProfilController::class, 'updateMeta'])->name('app-profil.meta');
        Route::post('/app-profil/logo', [AppProfilController::class, 'updateLogo'])->name('app-profil.logo');
        Route::post('/app-profil/logo/reset', [AppProfilController::class, 'resetLogo'])->name('app-profil.logo.reset');
        Route::post('/app-profil/footer', [AppProfilController::class, 'updateFooter'])->name('app-profil.footer');
        Route::post('/app-profil/sync-seeder', [AppProfilController::class, 'syncToSeeder'])->name('app-profil.sync-seeder');
        Route::post('/app-profil/run-seeder', [AppProfilController::class, 'runSeeder'])->name('app-profil.run-seeder');
        Route::post('/app-profil/clear-cache', [AppProfilController::class, 'clearCache'])->name('app-profil.clear-cache');

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

        // Tema Halaman Depan (Theme Frontpage Management)
        Route::get('/theme-frontpage', [ThemeFrontpageController::class, 'index'])->name('theme-frontpage');
        Route::post('/theme-frontpage/switch-theme', [ThemeFrontpageController::class, 'switchTheme'])->name('theme-frontpage.switch-theme');
        Route::post('/theme-frontpage/switch-landing-version', [ThemeFrontpageController::class, 'switchLandingVersion'])->name('theme-frontpage.switch-landing-version');
        Route::post('/theme-frontpage/hero', [ThemeFrontpageController::class, 'updateHero'])->name('theme-frontpage.hero');
        Route::post('/theme-frontpage/logo', [ThemeFrontpageController::class, 'updateLogo'])->name('theme-frontpage.logo');
        Route::post('/theme-frontpage/logo/reset', [ThemeFrontpageController::class, 'resetLogo'])->name('theme-frontpage.logo.reset');
        Route::post('/theme-frontpage/menu/save', [ThemeFrontpageController::class, 'saveMenu'])->name('theme-frontpage.menu.save');
        Route::post('/theme-frontpage/menu/reorder', [ThemeFrontpageController::class, 'reorderMenu'])->name('theme-frontpage.menu.reorder');
        Route::post('/theme-frontpage/menu/toggle', [ThemeFrontpageController::class, 'toggleMenu'])->name('theme-frontpage.menu.toggle');
        Route::post('/theme-frontpage/menu/delete', [ThemeFrontpageController::class, 'deleteMenu'])->name('theme-frontpage.menu.delete');
        Route::post('/theme-frontpage/menu/reset', [ThemeFrontpageController::class, 'resetMenu'])->name('theme-frontpage.menu.reset');
        Route::post('/theme-frontpage/sections/save', [ThemeFrontpageController::class, 'saveSection'])->name('theme-frontpage.sections.save');
        Route::post('/theme-frontpage/sections/toggle', [ThemeFrontpageController::class, 'toggleSection'])->name('theme-frontpage.sections.toggle');
        Route::post('/theme-frontpage/sections/reorder', [ThemeFrontpageController::class, 'reorderSections'])->name('theme-frontpage.sections.reorder');
        Route::post('/theme-frontpage/sections/delete', [ThemeFrontpageController::class, 'deleteSection'])->name('theme-frontpage.sections.delete');
        Route::post('/theme-frontpage/sections/reset', [ThemeFrontpageController::class, 'resetSections'])->name('theme-frontpage.sections.reset');
        Route::post('/theme-frontpage/sections/get-code', [ThemeFrontpageController::class, 'getSectionCode'])->name('theme-frontpage.sections.get-code');
        Route::post('/theme-frontpage/sections/save-code', [ThemeFrontpageController::class, 'saveSectionCode'])->name('theme-frontpage.sections.save-code');
        Route::post('/theme-frontpage/sections/reset-code', [ThemeFrontpageController::class, 'resetSectionCode'])->name('theme-frontpage.sections.reset-code');
        Route::post('/theme-frontpage/footer', [ThemeFrontpageController::class, 'updateFooter'])->name('theme-frontpage.footer');
        // Education Portal Configurations
        Route::post('/theme-frontpage/education/info', [ThemeFrontpageController::class, 'updateEducationInfo'])->name('theme-frontpage.education.info');
        Route::post('/theme-frontpage/education/logo', [ThemeFrontpageController::class, 'updateEducationLogo'])->name('theme-frontpage.education.logo');
        Route::post('/theme-frontpage/education/logo/reset', [ThemeFrontpageController::class, 'resetEducationLogo'])->name('theme-frontpage.education.logo.reset');
        Route::post('/theme-frontpage/education/nav', [ThemeFrontpageController::class, 'updateEducationNav'])->name('theme-frontpage.education.nav');
        Route::post('/theme-frontpage/education/footer', [ThemeFrontpageController::class, 'updateEducationFooter'])->name('theme-frontpage.education.footer');
        Route::post('/theme-frontpage/clear-cache', [ThemeFrontpageController::class, 'clearCache'])->name('theme-frontpage.clear-cache');
        Route::post('/theme-frontpage/reset-all', [ThemeFrontpageController::class, 'resetAll'])->name('theme-frontpage.reset-all');
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

        // Chat Pribadi (Private Messenger)
        Route::get('/profil-pengguna/chat', [\App\Http\Controllers\Profil\ChatController::class, 'index'])->name('profil-pengguna.chat');
        Route::get('/profil-pengguna/chat/contacts', [\App\Http\Controllers\Profil\ChatController::class, 'getContacts'])->name('profil-pengguna.chat.contacts');
        Route::get('/profil-pengguna/chat/conversation/{user}', [\App\Http\Controllers\Profil\ChatController::class, 'getConversation'])->name('profil-pengguna.chat.conversation');
        Route::post('/profil-pengguna/chat/send/{user}', [\App\Http\Controllers\Profil\ChatController::class, 'sendMessage'])->name('profil-pengguna.chat.send');
        Route::post('/profil-pengguna/chat/edit/{id}', [\App\Http\Controllers\Profil\ChatController::class, 'editMessage'])->name('profil-pengguna.chat.edit');
        Route::post('/profil-pengguna/chat/pin/{id}', [\App\Http\Controllers\Profil\ChatController::class, 'togglePinMessage'])->name('profil-pengguna.chat.pin');
        Route::post('/profil-pengguna/chat/react/{id}', [\App\Http\Controllers\Profil\ChatController::class, 'reactMessage'])->name('profil-pengguna.chat.react');
        Route::post('/profil-pengguna/chat/forward/{id}', [\App\Http\Controllers\Profil\ChatController::class, 'forwardMessage'])->name('profil-pengguna.chat.forward');
        Route::delete('/profil-pengguna/chat/message/{id}', [\App\Http\Controllers\Profil\ChatController::class, 'deleteMessage'])->name('profil-pengguna.chat.delete');
    });

    // Tempat untuk menambahkan route modul admin / master data lainnya yang berkaitan dengan database menu seeder di masa mendatang.

});

