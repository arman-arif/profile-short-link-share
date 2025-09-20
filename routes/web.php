<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Auth::routes(['login' => false]);

Route::group(['middleware' => ['auth:web', 'user.check']], function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
});

Route::get('/u/{user:short_code}', [FrontController::class, 'user'])->name('short-link');
