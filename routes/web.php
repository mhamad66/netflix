<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/auth/{provider}', function ($provider) {

    config([
        'services' . $provider . 'client_id' => setting($provider . '_client_id'),
        'services' . $provider . 'client_secret' => setting($provider . 'client_secret'),
        'services' . $provider . '_redirect_url' => setting($provider . '_redirect_url'),

    ]);
    return Socialite::driver($provider)->redirect();
})->where('provider', 'facebook|google');

Route::get('/auth/{provider}/callback', function ($provider) {
    try {
        $social_user = Socialite::driver($provider)->user();
    } catch (Exception $e) {
        return redirect()->intended('/');
    }
    $user = User::where('porvider', $provider)->where('provider_id', $social_user->getId())->first();
    if (!$user) {
        User::create([
            'name' => $social_user->getName(),
            'email' => $social_user->getEmail(),
            'provider' => $provider,
            'profider_id' => $social_user->getId()

        ]);
    }
    $user->attachRole('user');
    Auth::login($user, true);
})->where('provider', 'facebook|google');
