<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Http\Controllers\Auth\StaffAuthController;

Route::prefix('/staff')
    ->name('staff.')
    ->middleware('guest')
    ->group(function () {
        Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [StaffAuthController::class, 'login']);
    });

Route::prefix('/staff')
    ->name('staff.')
    ->middleware(['auth', 'verified', 'staff'])
    ->group(function () {
        Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', fn() => 'Bem-vindo staff')->name('dashboard');
    });
