<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('home'));
});

Route::get('/users', function () {
    return [
        'tenant' => app('tenant'),
        'users' => \App\Models\User::all()
    ];
});

Route::get('/home', \App\Http\Controllers\HomeController::class)
    ->name('home')
    ->middleware('auth');
Route::post('/logout', \App\Http\Controllers\LogoutController::class)
    ->name('logout')
    ->middleware('auth');

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate'])
    ->name('login.authenticate');

