<?php
 
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Route modular admin dari seeder didaftarkan di sini
});
