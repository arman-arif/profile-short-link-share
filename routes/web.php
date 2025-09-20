<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('/u/{user:short_code}', [FrontController::class, 'user'])->name('home');
});
