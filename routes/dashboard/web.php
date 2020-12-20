<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\welcomeController;
// ------------------------------------------------------------------
// dashboard.welocme
Route::prefix('dashboard')
->name('dashboard.')
->middleware(['auth','role:super_admin|admin'])
->group(function(){

Route::get('/',[welcomeController::class, 'index'])->name('welcome');
Route::resource('categories', 'CategoryController')->except(['show']);
Route::resource('roles', 'RoleController')->except(['show']);
Route::resource('users', 'UserController')->except(['show']);

});
