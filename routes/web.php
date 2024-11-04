<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lists\PostController;
use App\Http\Controllers\Lists\SearchController;
use App\Http\Controllers\Lists\ProductController;
use App\Http\Controllers\Lists\ServiceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Campus\HomeController as CampusUserHomeController;
use App\Http\Controllers\External\HomeController as ExternalUserHomeController;

Route::get('/', function () {
    return Inertia::render('LandingPage');
})->name('landing.page');

/*
|--------------------------------------------------------------------------
| Campus user routes
|--------------------------------------------------------------------------
*/

Route::middleware('campus_user')->group(function () {
    Route::get('campus/home', [CampusUserHomeController::class, 'index'])->name('campus.home');
});

/*
|--------------------------------------------------------------------------
| External user routes
|--------------------------------------------------------------------------
*/

Route::middleware('external_user')->group(function () {
    Route::get('external/home', [ExternalUserHomeController::class, 'index'])->name('external.home');
});

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| Guest routes
|--------------------------------------------------------------------------
*/
Route::post('/search', [SearchController::class, 'search'])->name('search');

Route::prefix('products')->name('products.')->group(function () {
    // Public routes (viewing)
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');

    // Protected routes (modifying)
    Route::middleware('auth')->group(function () {
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('services')->name('services.')->group(function () {
    // Public routes (viewing)
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{id}', [ServiceController::class, 'show'])->name('show');

    // Protected routes (modifying)
    Route::middleware('auth')->group(function () {
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('posts')->name('posts.')->group(function () {
    // Public routes (viewing)
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');

    // Protected routes (modifying)
    Route::middleware('auth')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
