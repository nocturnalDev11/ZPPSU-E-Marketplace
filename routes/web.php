<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\Lists\PostController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Lists\TradeController;
use App\Http\Controllers\Lists\SearchController;
use App\Http\Controllers\Lists\ProductController;
use App\Http\Controllers\Lists\ServiceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile/{id?}', [ProfileController::class, 'show'])->name('profile.show');

    Route::prefix('messages')->group(function () {
        Route::get('/', [MessagesController::class, 'index'])->name('messages.index');
        Route::get('/{user}', [MessagesController::class, 'conversation'])->name('messages.conversation');
        Route::post('/store', [MessagesController::class, 'store'])->name('messages.store');
        Route::post('/product-inquiry', [MessagesController::class, 'storeListInquiry'])->name('message.storeListInquiry');
        Route::post('/reply/{user}', [MessagesController::class, 'reply'])->name('messages.reply');
        Route::delete('/{message}', [MessagesController::class, 'destroy'])->name('messages.destroy');
    });
});


/*
|--------------------------------------------------------------------------
| Campus user routes
|--------------------------------------------------------------------------
*/

Route::middleware('campus_user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // User Management Routes
    Route::get('/admin/all-users', [UserManagementController::class, 'index'])->name('all.users');
    Route::post('/admin/user', [UserManagementController::class, 'store'])->name('users.store');
    Route::get('/admin/user/{id}', [UserManagementController::class, 'show'])->name('users.show');
    Route::get('/admin/user/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/admin/user/{id}', [UserManagementController::class, 'update'])->name('user.update');
    Route::delete('/admin/user/{id}', [UserManagementController::class, 'destroy'])->name('user.destroy');
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

Route::prefix('trades')->name('trades.')->group(function () {
    // Public routes (viewing)
    Route::get('/', [TradeController::class, 'index'])->name('index');
    Route::get('/{id}', [TradeController::class, 'show'])->name('show');

    // Protected routes
    Route::middleware('auth')->group(function () {
        Route::get('/create', [TradeController::class, 'create'])->name('create');
        Route::post('/', [TradeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TradeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TradeController::class, 'update'])->name('update');
        Route::delete('/{id}', [TradeController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
