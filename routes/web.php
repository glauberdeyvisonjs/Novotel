<?php

use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Staff\StaffAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

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
