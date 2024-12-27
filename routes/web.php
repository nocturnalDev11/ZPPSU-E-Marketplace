<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\MessagesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\Lists\PostController;
use App\Http\Controllers\User\Lists\SearchController;
use App\Http\Controllers\User\Lists\ProductController;

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
    });
});

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // User Management Routes
    // Route::get('/admin/all-users', [UserManagementController::class, 'index'])->name('all.users');
    // Route::post('/admin/user', [UserManagementController::class, 'store'])->name('users.store');
    // Route::get('/admin/user/{id}', [UserManagementController::class, 'show'])->name('users.show');
    // Route::get('/admin/user/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    // Route::put('/admin/user/{id}', [UserManagementController::class, 'update'])->name('user.update');
    // Route::delete('/admin/user/{id}', [UserManagementController::class, 'destroy'])->name('user.destroy');
});

require __DIR__ . '/auth.php';
