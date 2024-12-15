<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Auth\AuthAdminController;
use App\Http\Controllers\Campus\Auth\AuthCampusController;

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
});

Route::middleware('auth')->group(function () {
    Route::post('admin/logout', [AuthAdminController::class, 'destroy'])->name('admin.logout');

    Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('campus/logout', [AuthCampusController::class, 'destroy'])->name('campus.logout');

});
