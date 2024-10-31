<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthAdminController;
use App\Http\Controllers\Campus\Auth\AuthCampusController;
use App\Http\Controllers\External\Auth\AuthExternalController;

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AuthAdminController::class, 'create'])->name('admin.login');
    Route::post('admin/login', [AuthAdminController::class, 'store']);

    Route::get('campus/login', [AuthCampusController::class, 'create'])->name('campus.login');
    Route::post('campus/login', [AuthCampusController::class, 'store']);

    Route::get('external/login', [AuthExternalController::class, 'create'])->name('external.login');
    Route::post('external/login', [AuthExternalController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('admin/logout', [AuthAdminController::class, 'destroy'])->name('admin.logout');
    Route::post('campus/logout', [AuthCampusController::class, 'destroy'])->name('campus.logout');
    Route::post('external/logout', [AuthExternalController::class, 'destroy'])->name('external.logout');
});
