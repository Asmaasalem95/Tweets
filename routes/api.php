<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/

Route::middleware(['lang'])->group(function () {

    Route::post('/register', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'register'])->name('register');
    Route::post('/login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login'])->name('login');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('tweets/store', [\App\Http\Controllers\Api\TweetController::class, 'store']);

    });
});

