<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\PasswordController;
use App\Http\Controllers\User\Auth\VerifyEmailController;
use App\Http\Controllers\User\Auth\ConfirmablePasswordController;
use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/verification', [VerifyEmailController::class, 'verification'])->name('verification');
    Route::post('/send-credentials', [VerifyEmailController::class, 'sendCredentials'])->name('send.credentials');
});

Route::middleware('auth')->group(function () {
    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('admin/login', [AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('admin/login', [AdminAuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:admin')->group(function () {
    Route::put('admin/password', [PasswordController::class, 'update'])->name('admin.password.update');
    Route::post('admin/logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});
