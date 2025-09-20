<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:3,1') // 3 attempts, 15-minute block
    ->middleware('throttle:6,2'); // 6 attempts, 45-minute block

Auth::routes(['login' => false]);

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
});

Route::get('/u/{user:short_code}', [FrontController::class, 'user'])->name('short-link');
