<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:admin', 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::patch('user/{user}/{status}', [UserController::class, 'toggleStatus'])->name('user.status');
    Route::get('profile', [DashboardController::class, 'index'])->name('profile');
    Route::post('logout', [LoginController::class, 'adminLogout'])->name('logout');
});
