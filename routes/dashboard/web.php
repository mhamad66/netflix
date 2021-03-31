<?php

use App\Http\Controllers\Dashboard\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\welcomeController;
// ------------------------------------------------------------------
// dashboard.welocme
Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth', 'role:super_admin|admin'])
    ->group(function () {

        Route::get('/', [welcomeController::class, 'index'])->name('welcome');
        Route::resource('categories', 'CategoryController')->except(['show']);
        Route::resource('roles', 'RoleController')->except(['show']);
        Route::resource('movies', 'movieController')->except(['show']);
        Route::resource('users', 'UserController')->except(['show']);
        Route::get('/setting/social_login', [SettingController::class, 'social_login'])->name('setting.social_login');
        Route::get('/setting/social_links', [SettingController::class, 'social_links'])->name('setting.social_links');
        Route::post('/setting', [SettingController::class, 'store'])->name('setting.store');
    });
