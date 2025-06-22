<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Http\Controllers\Auth\ClientAuthController;

Route::prefix('/client')
    ->name('client.')
    ->middleware('guest')
    ->group(function () {
        Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [ClientAuthController::class, 'login']);
    });

Route::prefix('/client')
    ->name('client.')
    ->middleware(['auth', 'verified', 'client'])
    ->group(function () {
        Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', fn() => 'Bem-vindo cliente')->name('dashboard');
    });
