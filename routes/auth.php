<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Auth\AuthAdminController;
use App\Http\Controllers\Campus\Auth\AuthCampusController;
use App\Http\Controllers\External\Auth\AuthExternalController;

Route::middleware('guest')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Admin routes
    |--------------------------------------------------------------------------
    */
    Route::get('admin/login', [AuthAdminController::class, 'create'])->name('admin.login');
    Route::post('admin/login', [AuthAdminController::class, 'store']);

    /*
    |--------------------------------------------------------------------------
    | Campus user routes
    |--------------------------------------------------------------------------
    */
    Route::get('/verification', [AuthCampusController::class, 'verification'])->name('verification');
    Route::post('/send-credentials', [AuthCampusController::class, 'sendCredentials'])->name('send.credentials');
    Route::get('campus/login', [AuthCampusController::class, 'create'])->name('campus.login');
    Route::post('campus/login', [AuthCampusController::class, 'store']);

    /*
    |--------------------------------------------------------------------------
    | External user routes
    |--------------------------------------------------------------------------
    */
    Route::get('external/signup', [AuthExternalController::class, 'signupForm'])->name('external.signupForm');
    Route::post('external/signup', [AuthExternalController::class, 'signup'])->name('external.signup');
    Route::get('external/login', [AuthExternalController::class, 'create'])->name('external.login');
    Route::post('external/login', [AuthExternalController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('admin/logout', [AuthAdminController::class, 'destroy'])->name('admin.logout');

    Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('campus/logout', [AuthCampusController::class, 'destroy'])->name('campus.logout');


    Route::post('external/logout', [AuthExternalController::class, 'destroy'])->name('external.logout');
});
