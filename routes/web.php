<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\External\HomeController as ExternalUserHomeController;
use App\Http\Controllers\Campus\HomeController as CampusUserHomeController;

Route::get('/', function () {
    return Inertia::render('LandingPage');
});

Route::middleware('campus_user')->group(function () {
    Route::get('campus/home', [CampusUserHomeController::class, 'index'])->name('campus.home');

    // Route::prefix('seller/products')->name('products.')->group(function () {
    //     Route::get('/', [ProductController::class, 'index'])->name('index');
    //     Route::get('/create', [ProductController::class, 'create'])->name('create');
    //     Route::post('/', [ProductController::class, 'store'])->name('store');
    //     Route::get('/{id}', [ProductController::class, 'show'])->name('show');
    //     Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
    //     Route::put('/{id}', [ProductController::class, 'update'])->name('update');
    //     Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
    // });
});

Route::middleware('external_user')->group(function () {
    Route::get('external/home', [ExternalUserHomeController::class, 'index'])->name('external.home');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
});

require __DIR__ . '/auth.php';
