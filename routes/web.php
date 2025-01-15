<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\MessagesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Lists\UserProductsController;
use App\Http\Controllers\User\Lists\PostController;
use App\Http\Controllers\User\Lists\TradeController;
use App\Http\Controllers\User\Lists\SearchController;
use App\Http\Controllers\User\Lists\ProductController;
use App\Http\Controllers\User\Lists\ServiceController;
use App\Http\Controllers\Admin\Users\UserManagementController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');
/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/{id?}', [ProfileController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('update.picture');
    });

    Route::prefix('messages')->group(function () {
        Route::get('/', [MessagesController::class, 'index'])->name('messages.index');
        Route::get('/{user}', [MessagesController::class, 'conversation'])->name('messages.conversation');
        Route::post('/store', [MessagesController::class, 'store'])->name('messages.store');
        Route::post('/product-inquiry', [MessagesController::class, 'storeListInquiry'])->name('message.storeListInquiry');
        Route::post('/reply/{user}', [MessagesController::class, 'reply'])->name('messages.reply');
        Route::delete('/{message}', [MessagesController::class, 'destroy'])->name('messages.destroy');
    });
});

Route::post('/search', [SearchController::class, 'search'])->name('search');

Route::prefix('products')->name('products.')->group(function () {
    // Public routes (viewing)
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');

    // Protected routes (modifying)
    Route::middleware('auth')->group(function () {
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::post('/rate', [ProductController::class, 'rate'])->name('rate');
        Route::post('/reply', [ProductController::class, 'reply'])->name('reply');
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
        Route::post('/rate', [ServiceController::class, 'rate'])->name('rate');
        Route::post('/reply', [ServiceController::class, 'reply'])->name('reply');
    });
});

Route::prefix('posts')->name('posts.')->group(function () {
    // Public routes (viewing)
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');

    // Protected routes (modifying)
    Route::middleware('auth')->group(function () {
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::post('/comment', [PostController::class, 'comment'])->name('comment');
        Route::delete('/comments/{id}', [PostController::class, 'deleteComment'])->name('comments.delete');
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
        Route::post('/rate', [TradeController::class, 'rate'])->name('rate');
        Route::post('/reply', [TradeController::class, 'reply'])->name('reply');
    });
});

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('user')->group(function() {
        // User Management Routes
        Route::get('/', [UserManagementController::class, 'index'])->name('all.users');
        Route::post('/', [UserManagementController::class, 'store'])->name('users.store');
        Route::get('/{id}', [UserManagementController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserManagementController::class, 'update'])->name('user.update');
        Route::delete('/{id}', [UserManagementController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('user-products')->group(function() {
        Route::get('/', [UserProductsController::class, 'index'])->name('user-product.index');
        Route::delete('/{id}', [UserProductsController::class, 'destroy'])->name('user-product.destroy');
    });
});

require __DIR__ . '/auth.php';
